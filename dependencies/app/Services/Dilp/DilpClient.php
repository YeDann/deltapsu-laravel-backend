<?php

namespace App\Services\Dilp;

use Illuminate\Http\Client\ConnectionException;
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
    private bool $debug;
    /** @var array<int, string> 限定顯示的國碼（大寫）；空陣列＝不限國家 */
    private array $countries;

    public function __construct()
    {
        $cfg = config('services.dilp', []);
        $this->baseUrl  = rtrim($cfg['base_url'] ?? '', '/');
        $this->username = $cfg['username'] ?? '';
        $this->password = $cfg['password'] ?? '';
        $this->tokenTtl = (int) ($cfg['token_ttl'] ?? 840);
        $this->cacheTtl = (int) ($cfg['cache_ttl'] ?? 300);
        $this->mock     = (bool) ($cfg['mock'] ?? false);
        $this->debug    = (bool) ($cfg['debug'] ?? false);
        $this->countries = $this->parseCountries($cfg['countries'] ?? '');
    }

    /**
     * 解析限定國家設定（"US" 或 "US,CA"，亦接受陣列）成大寫國碼陣列；空值＝不限國家。
     *
     * @param mixed $value
     * @return array<int, string>
     */
    private function parseCountries($value): array
    {
        $list = is_array($value) ? $value : explode(',', (string) $value);
        $codes = array_map(static fn ($c): string => strtoupper(trim((string) $c)), $list);

        return array_values(array_unique(array_filter($codes, static fn (string $c): bool => $c !== '')));
    }

    /**
     * 查詢某料號在各經銷商的即時庫存，回傳整理後陣列（查無庫存回空陣列）。
     * 結果會依 config('services.dilp.countries') 限縮國家（現設為只開放美國）。
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
            return $this->filterByCountries($this->mockRows($partNumber));
        }

        // 結果短快取（每料號 × 每語系），降低呼叫量；失敗會丟例外故不會被快取。
        // ⚠️ key 必須帶語系：快取值已含在地化的國名/洲名，不分語系會讓先查到的語系污染其他語系。
        $rows = Cache::remember('dilp_stock_' . app()->getLocale() . '_' . md5($partNumber), $this->cacheTtl, function () use ($partNumber, $clientIp) {
            return $this->fetchFromApi($partNumber, $clientIp);
        });

        // 國家限定刻意在快取「之後」才套用：快取存的是完整結果，改 DILP_COUNTRIES 立即生效、不必清快取。
        return $this->filterByCountries($rows);
    }

    /**
     * 依 config('services.dilp.countries') 限縮結果：
     * 只留在限定國家有據點的經銷商，且該列的國家清單同步縮成限定國家
     * （否則跨國經銷商如 DigiKey(DE/HK/US) 會讓前台洲/國下拉冒出非限定的選項）。
     * 未設定限定國家時原樣回傳。
     *
     * @param array<int, array<string, mixed>> $rows
     * @return array<int, array<string, mixed>>
     */
    private function filterByCountries(array $rows): array
    {
        if ($this->countries === []) {
            return $rows;
        }

        $out = [];
        foreach ($rows as $row) {
            $kept = array_values(array_filter(
                $row['countries'] ?? [],
                fn (array $c): bool => in_array(strtoupper((string) ($c['code'] ?? '')), $this->countries, true)
            ));

            // 在限定國家沒有據點（或 DILP 根本沒給國別）→ 整列不顯示
            if ($kept === []) {
                continue;
            }

            $row['countries'] = $kept;
            $out[] = $row;
        }

        return $out;
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
            Log::warning('DILP search failed', [
                'part'   => $partNumber,
                'status' => $response->status(),
                'body'   => $this->snippet($response->body()),
            ]);
            throw new RuntimeException('DILP search failed: HTTP ' . $response->status());
        }

        if ($this->debug) {
            Log::info('DILP search ok', ['part' => $partNumber, 'body' => $this->snippet($response->body(), 2000)]);
        }

        return $this->mapParts($response->json() ?? []);
    }

    private function doSearch(string $partNumber, ?string $clientIp, string $token)
    {
        $url = $this->baseUrl . '/Search';
        $query = [
            'pn1'        => $partNumber,
            'SearchType' => 'EQUALS',
            'ClientIP'   => $clientIp ?: request()->ip(),
        ];

        if ($this->debug) {
            Log::info('DILP search request', ['url' => $url, 'query' => $query]);
        }

        try {
            return Http::timeout(30)
                ->withHeaders([
                    'Content-Type'  => 'application/json',
                    'Authorization' => $token,
                ])
                ->get($url, $query);
        } catch (ConnectionException $e) {
            $this->logConnError('search', ['part' => $partNumber, 'url' => $url], $e);
            throw $e;
        }
    }

    /**
     * 取得 AuthToken（快取重用）。
     * Login 為 POST，必須帶（空）body 以提供 Content-Length，否則 DILP 回 411 Length Required。
     */
    private function authToken(): string
    {
        return Cache::remember($this->tokenCacheKey(), $this->tokenTtl, function () {
            $basic = 'Basic ' . base64_encode($this->username . ':' . $this->password);
            $url = $this->baseUrl . '/Login?TTL=900';

            if ($this->debug) {
                Log::info('DILP login request', ['url' => $url, 'username' => $this->username]);
            }

            try {
                $response = Http::timeout(30)
                    ->withHeaders(['Authorization' => $basic])
                    ->withBody('', 'application/json')   // 空 body → 有 Content-Length，避開 411
                    ->post($url);
            } catch (ConnectionException $e) {
                $this->logConnError('login', ['url' => $url], $e);
                throw $e;
            }

            if (! $response->successful()) {
                Log::warning('DILP login failed', [
                    'url'    => $url,
                    'status' => $response->status(),
                    'body'   => $this->snippet($response->body()),
                ]);
                throw new RuntimeException('DILP login failed: HTTP ' . $response->status());
            }

            $token = $response->json('AuthToken');
            if (! $token) {
                Log::warning('DILP login: AuthToken missing', ['body' => $this->snippet($response->body())]);
                throw new RuntimeException('DILP login: AuthToken missing in response');
            }

            if ($this->debug) {
                Log::info('DILP login ok', ['url' => $url]);
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
                Log::warning('DILP distributor fetch failed', [
                    'id'     => $id,
                    'status' => $response->status(),
                    'body'   => $this->snippet($response->body()),
                ]);
                throw new RuntimeException('DILP distributor failed: HTTP ' . $response->status());
            }

            return $this->firstEmail($response->json() ?? []);
        });
    }

    private function doDistributor(string $id, ?string $clientIp, string $token)
    {
        $url = $this->baseUrl . '/Distributor/' . rawurlencode($id);

        try {
            return Http::timeout(30)
                ->withHeaders([
                    'Content-Type'  => 'application/json',
                    'Authorization' => $token,
                ])
                ->get($url, [
                    'ClientIP' => $clientIp ?: request()->ip(),
                ]);
        } catch (ConnectionException $e) {
            $this->logConnError('distributor', ['id' => $id, 'url' => $url], $e);
            throw $e;
        }
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

    /**
     * 連線層級錯誤（timeout / DNS / refused / SSL）統一記 error，附 base_url 與例外訊息，方便定位「打不進去」。
     */
    private function logConnError(string $what, array $ctx, ConnectionException $e): void
    {
        Log::error("DILP {$what} connection error", $ctx + [
            'base_url'  => $this->baseUrl,
            'exception' => get_class($e),
            'message'   => $e->getMessage(),
        ]);
    }

    /**
     * 截短回應 body 供 log 用，避免整包塞進 log。
     */
    private function snippet(?string $body, int $limit = 500): string
    {
        $body = trim((string) $body);

        return mb_strlen($body) > $limit ? mb_substr($body, 0, $limit) . '…' : $body;
    }
}
