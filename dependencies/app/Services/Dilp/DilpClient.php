<?php

namespace App\Services\Dilp;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * netCOMPONENT DILP API 客戶端：封裝認證、AuthToken 快取、經銷商庫存查詢與回傳欄位整理。
 *
 * 憑證一律由 config('services.dilp') 取得，不直接讀 env（避開 config:cache 後 env() 回 null）。
 * 測試環境（DILP_MOCK=true）回固定 fixture，使空庫存環境仍可完整呈現流程。
 */
class DilpClient
{
    private string $baseUrl;
    private string $username;
    private string $password;
    private int $tokenTtl;
    private int $cacheTtl;
    private bool $mock;

    public function __construct()
    {
        $cfg = config('services.dilp', []);
        $this->baseUrl  = rtrim($cfg['base_url'] ?? '', '/');
        $this->username = $cfg['username'] ?? '';
        $this->password = $cfg['password'] ?? '';
        $this->tokenTtl = (int) ($cfg['token_ttl'] ?? 840);
        $this->cacheTtl = (int) ($cfg['cache_ttl'] ?? 300);
        $this->mock     = (bool) ($cfg['mock'] ?? false);
    }

    /**
     * 查詢某料號在各經銷商的即時庫存，回傳整理後陣列（查無庫存回空陣列）。
     *
     * @return array<int, array{part:string, distributor:string, distributorId:?string, availability:int|string, buyUrl:?string, countries:array<int, array{code:string, name:string, region:?string, regionName:?string}>, uploadDate:?string}>
     */
    public function search(string $partNumber, ?string $clientIp = null): array
    {
        $partNumber = trim($partNumber);
        if ($partNumber === '') {
            return [];
        }

        if ($this->mock) {
            return $this->mockRows($partNumber);
        }

        // 結果短快取（每料號 × 每語系），降低呼叫量；失敗會丟例外故不會被快取。
        // ⚠️ key 必須帶語系：快取值已含在地化的國名/洲名，不分語系會讓先查到的語系污染其他語系。
        return Cache::remember('dilp_stock_' . app()->getLocale() . '_' . md5($partNumber), $this->cacheTtl, function () use ($partNumber, $clientIp) {
            return $this->fetchFromApi($partNumber, $clientIp);
        });
    }

    /**
     * 實際打 DILP /Search；遇 401 清 token 重登一次再試。
     */
    private function fetchFromApi(string $partNumber, ?string $clientIp): array
    {
        $response = $this->doSearch($partNumber, $clientIp, $this->authToken());

        if ($response->status() === 401) {
            Cache::forget($this->tokenCacheKey());
            $response = $this->doSearch($partNumber, $clientIp, $this->authToken());
        }

        if (! $response->successful()) {
            Log::warning('DILP search failed', ['part' => $partNumber, 'status' => $response->status()]);
            throw new RuntimeException('DILP search failed: HTTP ' . $response->status());
        }

        return $this->mapParts($response->json() ?? []);
    }

    private function doSearch(string $partNumber, ?string $clientIp, string $token)
    {
        return Http::timeout(30)
            ->withHeaders([
                'Content-Type'  => 'application/json',
                'Authorization' => $token,
            ])
            ->get($this->baseUrl . '/Search', [
                'pn1'        => $partNumber,
                'SearchType' => 'EQUALS',
                'ClientIP'   => $clientIp ?: request()->ip(),
            ]);
    }

    /**
     * 取得 AuthToken（快取重用）。
     * Login 為 POST，必須帶（空）body 以提供 Content-Length，否則 DILP 回 411 Length Required。
     */
    private function authToken(): string
    {
        return Cache::remember($this->tokenCacheKey(), $this->tokenTtl, function () {
            $basic = 'Basic ' . base64_encode($this->username . ':' . $this->password);

            $response = Http::timeout(30)
                ->withHeaders(['Authorization' => $basic])
                ->withBody('', 'application/json')   // 空 body → 有 Content-Length，避開 411
                ->post($this->baseUrl . '/Login?TTL=900');

            if (! $response->successful()) {
                throw new RuntimeException('DILP login failed: HTTP ' . $response->status());
            }

            $token = $response->json('AuthToken');
            if (! $token) {
                throw new RuntimeException('DILP login: AuthToken missing in response');
            }

            return $token; // 已含 "Basic " 前綴，後續請求直接當 Authorization 帶
        });
    }

    private function tokenCacheKey(): string
    {
        return 'dilp_token_' . md5($this->baseUrl . '|' . $this->username);
    }

    /**
     * 把 DILP /Search 回應整理成乾淨陣列。
     *
     * @param array<string, mixed> $json
     * @return array<int, array{part:string, distributor:string, distributorId:?string, availability:int|string, buyUrl:?string, countries:array<int, array{code:string, name:string, region:?string, regionName:?string}>, uploadDate:?string}>
     */
    private function mapParts(array $json): array
    {
        $parts = $json['SearchedParts'][0]['Parts'] ?? [];
        $rows = [];

        foreach ($parts as $p) {
            $rows[] = [
                'part'          => $p['PartNumber'] ?? '',
                'distributor'   => $p['Distributor']['Name'] ?? '',
                'distributorId' => $this->distributorId($p['Distributor']['URI'] ?? null),
                'availability'  => $p['Quantity'] ?? 0,
                'buyUrl'        => $p['Distributor']['ShoppingCartLink']['URL'] ?? null,
                'countries'     => $this->mapCountries($p['Distributor']['MultiCountry'] ?? []),
                'uploadDate'    => $p['UploadDate'] ?? null,
            ];
        }

        return $rows;
    }

    /**
     * 把 Distributor.MultiCountry 整理成「國家清單（含所屬洲）」，供前台兩層（洲→國）篩選。
     * 取 Countries[] 全部；若缺則退回 Primary 單國。國名在地化、洲名回 DILP 英文供前端 fallback。
     *
     * @param array<string, mixed> $mc Distributor.MultiCountry
     * @return array<int, array{code:string, name:string, region:?string, regionName:?string}>
     */
    private function mapCountries(array $mc): array
    {
        $list = $mc['Countries'] ?? [];
        if (empty($list) && ! empty($mc['Primary'])) {
            $list = [$mc['Primary']];   // 無多國清單時退回主要國家
        }

        $out = [];
        $seen = [];
        foreach ($list as $c) {
            $code = $c['ShortCode'] ?? null;
            if (! $code || isset($seen[$code])) {
                continue;   // 略過無代碼 / 重複國家
            }
            $seen[$code] = true;
            $out[] = [
                'code'       => $code,
                'name'       => $this->countryName($code) ?? $code,
                'region'     => $c['Region']['ShortCode'] ?? null,
                'regionName' => $c['Region']['Region'] ?? null,
            ];
        }

        return $out;
    }

    /**
     * 國家代碼（US/GB…）→ 當前語系國名（intl CLDR）；供 Modal 國別篩選下拉顯示，篩選本身仍用代碼。
     */
    private function countryName(?string $code): ?string
    {
        if (! $code) {
            return null;
        }
        // 站台 locale → intl locale（en/de/tr 直接通用）
        $intl = ['tw' => 'zh-Hant', 'cn' => 'zh-Hans', 'jp' => 'ja'][app()->getLocale()] ?? app()->getLocale();
        $name = \Locale::getDisplayRegion('-' . $code, $intl);

        return $name ?: $code;
    }

    /**
     * 取得某經銷商的聯絡 email（供前台「無購物車連結」時以 mailto 聯絡用）。
     * 打 DILP /Distributor/{id}，回第一個非空的 Offices[].Contacts[].Email；查無回 null。
     * email 不在地化，故快取 key 不帶語系。
     */
    public function distributorEmail(string $id, ?string $clientIp = null): ?string
    {
        $id = trim($id);
        if ($id === '') {
            return null;
        }

        if ($this->mock) {
            return 'sales@example.com';
        }

        return Cache::remember('dilp_dist_email_' . md5($id), $this->cacheTtl, function () use ($id, $clientIp) {
            $response = $this->doDistributor($id, $clientIp, $this->authToken());

            if ($response->status() === 401) {
                Cache::forget($this->tokenCacheKey());
                $response = $this->doDistributor($id, $clientIp, $this->authToken());
            }

            if (! $response->successful()) {
                Log::warning('DILP distributor fetch failed', ['id' => $id, 'status' => $response->status()]);
                throw new RuntimeException('DILP distributor failed: HTTP ' . $response->status());
            }

            return $this->firstEmail($response->json() ?? []);
        });
    }

    private function doDistributor(string $id, ?string $clientIp, string $token)
    {
        return Http::timeout(30)
            ->withHeaders([
                'Content-Type'  => 'application/json',
                'Authorization' => $token,
            ])
            ->get($this->baseUrl . '/Distributor/' . rawurlencode($id), [
                'ClientIP' => $clientIp ?: request()->ip(),
            ]);
    }

    /**
     * 從 Distributor.URI（/api/DILP/v3/Distributor/{id}）取出末段 id。
     */
    private function distributorId(?string $uri): ?string
    {
        if (! $uri) {
            return null;
        }
        $id = basename((string) (parse_url($uri, PHP_URL_PATH) ?: $uri));

        return $id !== '' ? $id : null;
    }

    /**
     * 從 /Distributor 回應掃出第一個非空的聯絡 email。
     *
     * @param array<string, mixed> $json
     */
    private function firstEmail(array $json): ?string
    {
        foreach ($json['Offices'] ?? [] as $office) {
            foreach ($office['Contacts'] ?? [] as $contact) {
                $email = trim((string) ($contact['Email'] ?? ''));
                if ($email !== '') {
                    return $email;
                }
            }
        }

        return null;
    }

    /**
     * 測試環境（空庫存）用的固定假資料：含「有購物車網址」與「無購物車網址（改顯示 Contact）」、
     * 以及「單國」與「跨洲多國（DigiKey: DE/HK/US）」各情境，方便驗證兩層篩選與 Contact 行為。
     *
     * @return array<int, array{part:string, distributor:string, distributorId:string, availability:int, buyUrl:?string, countries:array<int, array{code:string, name:string, region:?string, regionName:?string}>, uploadDate:?string}>
     */
    private function mockRows(string $partNumber): array
    {
        return [
            ['part' => $partNumber, 'distributor' => 'Mouser Electronics Inc.',  'distributorId' => 'mock-mouser',  'availability' => 52, 'buyUrl' => 'https://www.mouser.com/',  'countries' => [$this->mockCountry('US')], 'uploadDate' => '6/13/2026'],
            ['part' => $partNumber, 'distributor' => 'DigiKey',                   'distributorId' => 'mock-digikey', 'availability' => 54, 'buyUrl' => 'https://www.digikey.com/',  'countries' => [$this->mockCountry('DE'), $this->mockCountry('HK'), $this->mockCountry('US')], 'uploadDate' => '6/12/2026'],
            ['part' => $partNumber, 'distributor' => 'Farnell, An Avnet Company', 'distributorId' => 'mock-farnell', 'availability' => 40, 'buyUrl' => null,                        'countries' => [$this->mockCountry('GB')], 'uploadDate' => '6/10/2026'],
        ];
    }

    /**
     * 產生 mock 用的單一國家項目（含所屬洲），欄位比照 mapCountries 的輸出。
     *
     * @return array{code:string, name:string, region:?string, regionName:?string}
     */
    private function mockCountry(string $code): array
    {
        $regions = [
            'US' => ['AM', 'North America'],
            'DE' => ['EU', 'Europe'],
            'GB' => ['EU', 'Europe'],
            'HK' => ['AS', 'Asia'],
        ];
        [$rCode, $rName] = $regions[$code] ?? [null, null];

        return [
            'code'       => $code,
            'name'       => $this->countryName($code) ?? $code,
            'region'     => $rCode,
            'regionName' => $rName,
        ];
    }
}
