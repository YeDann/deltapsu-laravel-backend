<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * 依「2025 deltapsu Distributor filter_0824.xlsx」更新經銷商資料。
 *
 * 來源為該檔 Global_0824 分頁「篩選後可見」的 53 家 —— 該分頁套了 AutoFilter，
 * 濾掉的 13 家與前一版 Global 分頁逐欄相同（本次未異動），故不納入、不觸碰。
 *
 * 與 DistributorOfficeUpdateSeeder（0806）相同之處：
 * - 一律以英文 title 比對既有 office（各站 office id 不同，不能靠 id）。
 * - 不刪除任何 office；不觸碰 logo（保留客戶已上傳的圖）。
 * - 分類（3 張打勾表）與 sales territory 採「完整同步」：新增的補上、取消勾選的移除。
 * - 座標由 maps URL 解析，優先序 !3d!4d 圖釘 > @ 中心 > q=lat,lon；解不出則保留原 lat/lon。
 * - Idempotent：可重複執行，結果一致。Certification 欄全空，不處理。
 *
 * 本次新增的行為：
 * - 找不到同名 office 時「建立」而非跳過（0824 新增 8 家，logo 待客戶後台補上）。
 * - prev_name：Excel 改了名稱寫法者，以舊名比對到既有 office 後，將各語系 title 更名為新寫法。
 * - region 新增 'Thailand'；對應洲別 id 與原本的 'SEA' 相同（該洲在前台本來就顯示 Thailand）。
 *
 * 執行：php artisan db:seed --class=DistributorOfficeUpdate0824Seeder
 */
class DistributorOfficeUpdate0824Seeder extends Seeder
{
    public function run()
    {
        $locales = DB::table('language')->pluck('name')->toArray();

        // 'SEA' 保留相容：0806 版用此名稱，指向的洲別與 'Thailand' 同一筆
        $regionToContinent = [
            'Americas' => 2, 'Europe' => 4, 'Japan' => 5, 'Korea' => 9,
            'SEA' => 11, 'Thailand' => 11, 'Taiwan' => 12, 'China' => 13,
        ];

        // Online shop 分類可能停用，確保存在以便掛 pivot（比照 DistributorOfficeSeeder）
        $this->ensureCategory('distributor_service', 'online-shop', 'Online Shop', 0, $locales);

        // slug => {pivot, id}：分類定義以 DB 為單一來源，pivot 讀 config/distributor.php
        $catIndex = [];
        foreach (['distributor_specialized_application', 'distributor_product_line', 'distributor_service'] as $table) {
            $pivot = config("distributor.categories.{$table}.pivot");
            foreach (DB::table($table)->pluck('id', 'slug') as $slug => $id) {
                $catIndex[$slug] = ['pivot' => $pivot, 'id' => $id];
            }
        }

        $updated = 0;
        $created = 0;
        $renamed = 0;

        foreach ($this->rows() as $r) {
            $continentId = $regionToContinent[$r['region']] ?? null;

            // 先用新名比對；比不到再用舊名（Excel 改了寫法者）
            $officeId = $this->findOfficeId($r['name']);
            if (!$officeId && isset($r['prev_name'])) {
                $officeId = $this->findOfficeId($r['prev_name']);
            }
            // MySQL 字串比對不分大小寫，只差大小寫的舊名會被上面比中，故更名一律另外判斷實際字串
            if ($officeId && isset($r['prev_name'])) {
                $current = DB::table('office_translations')
                    ->where('fk_office_id', $officeId)->where('local', 'en')->value('title');
                if (0 !== strcmp((string) $current, $r['name'])) {
                    DB::table('office_translations')->where('fk_office_id', $officeId)->update(['title' => $r['name']]);
                    $renamed++;
                    echo "Renamed: {$current} -> {$r['name']}\n";
                }
            }

            $coords = $this->parseLatLon($r['maps']);

            if (!$officeId) {
                $officeId = $this->createOffice($r, $continentId, $coords, $locales);
                $created++;
                echo "Created: {$r['name']}\n";
            } else {
                // office 欄位（不含 logo）。地址以 office.address 為來源（非 office_translations.content）
                $officeUpdate = [
                    'continent_id' => $continentId,
                    'website' => $r['website'] ?: null,
                    'telephone' => $r['tel'] ?: null,
                    'email' => $r['email'] ?: null,
                    'address' => $r['address'] ?: null,
                    'google_maps' => $r['maps'] ?: null,
                    'updated_at' => now(),
                ];
                if (null !== $coords) {
                    $officeUpdate['lat'] = $coords[0];
                    $officeUpdate['lon'] = $coords[1];
                }
                DB::table('office')->where('id', $officeId)->update($officeUpdate);
                $updated++;
                echo "Updated: {$r['name']}\n";
            }

            // sales territory：find-or-create 後完整同步 pivot
            $terrIds = [];
            foreach (preg_split('/\s*;\s*/', $r['territory'], -1, PREG_SPLIT_NO_EMPTY) as $terrName) {
                $slug = Str::slug($terrName) ?: ('territory-' . Str::slug($terrName, '-', null));
                $terrId = DB::table('distributor_sales_territory')->where('slug', $slug)->value('id');
                if (!$terrId) {
                    $terrId = DB::table('distributor_sales_territory')->insertGetId([
                        'slug' => $slug, 'continent_id' => $continentId, 'status' => 1,
                        'order_seq' => 0, 'created_at' => now(), 'updated_at' => now(),
                    ]);
                    foreach ($locales as $local) {
                        DB::table('distributor_sales_territory_translation')->insert([
                            'fk_id' => $terrId, 'name' => $terrName, 'local' => $local,
                            'created_at' => now(), 'updated_at' => now(),
                        ]);
                    }
                }
                $terrIds[] = $terrId;
            }
            $this->syncPivot('office_has_sales_territory', $officeId, $terrIds);

            // 分類勾選：依 pivot 分組後完整同步
            $byPivot = [];
            foreach ($r['cats'] as $slug) {
                if (!isset($catIndex[$slug])) { continue; }
                $byPivot[$catIndex[$slug]['pivot']][] = $catIndex[$slug]['id'];
            }
            foreach (['office_has_specialized_application', 'office_has_product_line', 'office_has_service'] as $pivot) {
                $this->syncPivot($pivot, $officeId, $byPivot[$pivot] ?? []);
            }
        }

        echo "\n=== Done. updated={$updated}, created={$created}, renamed={$renamed} ===\n";
        if ($created) {
            echo "  註：新建的經銷商沒有 logo，需由後台上傳。\n";
        }
    }

    /** 以英文 title 找 distributor（type_id=2）；查無回 null */
    private function findOfficeId($title)
    {
        return DB::table('office as o')
            ->join('office_translations as ot', 'o.id', '=', 'ot.fk_office_id')
            ->where('o.type_id', 2)->where('ot.local', 'en')->where('ot.title', $title)
            ->value('o.id');
    }

    /**
     * 建立新的 distributor（office + 各語系 translation）。
     * logo 留空由後台補；office_translations 各語系先填英文名，內文留空
     * （地址等聯絡資訊已改由 office 欄位提供，content 僅 Sales Offices 仍在用）。
     *
     * @param array{0:string,1:string}|null $coords
     */
    private function createOffice(array $r, $continentId, $coords, array $locales)
    {
        $officeId = DB::table('office')->insertGetId([
            'status' => 1,
            'type_id' => 2,
            'continent_id' => $continentId,
            'website' => $r['website'] ?: null,
            'telephone' => $r['tel'] ?: null,
            'email' => $r['email'] ?: null,
            'address' => $r['address'] ?: null,
            'google_maps' => $r['maps'] ?: null,
            'lat' => null !== $coords ? $coords[0] : null,
            'lon' => null !== $coords ? $coords[1] : null,
            'logo' => null,
            'file_cer' => '',
            'status_cer' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // office_translations 沒有 created_at / updated_at 欄位，不可帶 timestamps
        foreach ($locales as $local) {
            DB::table('office_translations')->insert([
                'fk_office_id' => $officeId,
                'local' => $local,
                'title' => $r['name'],
                'sub_title' => null,
                'content' => null,
            ]);
        }

        return $officeId;
    }

    /**
     * 從 Google Maps URL 解析座標，優先序比照後台：圖釘 !3d!4d > 中心 @ > 查詢 q=lat,lon。
     * 解不出（短網址、純文字、q=, 空值）回傳 null，呼叫端據此保留原 lat/lon。
     *
     * @return array{0:string,1:string}|null [lat, lon]
     */
    private function parseLatLon($maps)
    {
        if (!$maps) {
            return null;
        }
        if (preg_match('/!3d(-?\d+(?:\.\d+)?)!4d(-?\d+(?:\.\d+)?)/', $maps, $m)) {
            return [$m[1], $m[2]];
        }
        if (preg_match('/@(-?\d+(?:\.\d+)?),(-?\d+(?:\.\d+)?)/', $maps, $m)) {
            return [$m[1], $m[2]];
        }
        if (preg_match('/[?&]q=(-?\d+(?:\.\d+)?),(-?\d+(?:\.\d+)?)/', $maps, $m)) {
            return [$m[1], $m[2]];
        }
        return null;
    }

    /** 將某 office 在指定 pivot 的關聯完整同步為 $categoryIds（多刪少補） */
    private function syncPivot($pivot, $officeId, array $categoryIds)
    {
        $categoryIds = array_values(array_unique($categoryIds));

        $del = DB::table($pivot)->where('office_id', $officeId);
        if ($categoryIds) { $del->whereNotIn('category_id', $categoryIds); }
        $del->delete();

        $existing = DB::table($pivot)->where('office_id', $officeId)->pluck('category_id')->all();
        foreach (array_diff($categoryIds, $existing) as $cid) {
            DB::table($pivot)->insert([
                'office_id' => $officeId, 'category_id' => $cid,
                'created_at' => now(), 'updated_at' => now(),
            ]);
        }
    }

    /** 確保某分類存在（不存在才建），各語系填英文 */
    private function ensureCategory($table, $slug, $name, $status, array $locales)
    {
        $id = DB::table($table)->where('slug', $slug)->value('id');
        if (!$id) {
            $id = DB::table($table)->insertGetId([
                'slug' => $slug, 'status' => $status, 'order_seq' => 99,
                'created_at' => now(), 'updated_at' => now(),
            ]);
            foreach ($locales as $local) {
                DB::table($table . '_translation')->insert([
                    'fk_id' => $id, 'name' => $name, 'local' => $local,
                    'created_at' => now(), 'updated_at' => now(),
                ]);
            }
        }
        return $id;
    }

    /** @return array<int,array<string,mixed>> Global_0824 篩選後可見的 53 筆 */
    private function rows()
    {
        return [
            ['region' => 'Americas', 'name' => 'Arrow Electronics, Inc.', 'website' => 'www.arrow.com/en/products/manufacturers/d/delta-electronics', 'tel' => '+1 800 833 3557', 'email' => 'advantagesales@arrow.com', 'maps' => 'https://www.google.com/maps/place/Arrow+Electronics+Panorama/@39.5799443,-104.8819574,869m/data=!3m2!1e3!4b1!4m6!3m5!1s0x876c85cfddad62e7:0xaebaefb87119d6c2!8m2!3d39.5799443!4d-104.8819574!16s%2Fg%2F11dzzj3nnw!5m1!1e1?entry=ttu&g_ep=EgoyMDI2MDgxOS4wIKXMDSoASAFQAw%3D%3D', 'address' => '9201 East Dry Creek Road, Centennial, CO 80112', 'territory' => 'US', 'cats' => ['industrial', 'medical', 'lighting', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'configurable', 'adapter', 'led-driver', 'stocking', 'after-sales', 'online-shop']],
            ['region' => 'Americas', 'name' => 'Avnet Inc', 'website' => 'www.avnet.com/shop/us/m/delta-group', 'tel' => '+1 800 408 8353', 'email' => 'onlinesupportUS@avnet.com', 'maps' => 'https://www.google.com/maps/search/Avnet,+Inc./@33.3361048,-111.8943717,942m/data=!3m1!1e3!5m1!1e1?entry=ttu&g_ep=EgoyMDI2MDgxOS4wIKXMDSoASAFQAw%3D%3D', 'address' => '2211 South 47th St, Phoenix, AZ 85034', 'territory' => 'US', 'cats' => ['industrial', 'medical', 'lighting', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'configurable', 'adapter', 'led-driver', 'stocking', 'after-sales', 'online-shop']],
            ['region' => 'Americas', 'name' => 'DigiKey', 'website' => 'www.digikey.com/en/supplier-centers/delta-product-groups', 'tel' => '+1 800 344 4539', 'email' => 'sales@digikey.com', 'maps' => 'https://www.google.com/maps/place/DigiKey/@48.1094481,-96.1964748,753m/data=!3m2!1e3!4b1!4m6!3m5!1s0x52c7105768547a6f:0xb3bda9362973afe1!8m2!3d48.1094445!4d-96.1938999!16s%2Fg%2F1tg4wh9v!5m1!1e1?entry=ttu&g_ep=EgoyMDI2MDgxOS4wIKXMDSoASAFQAw%3D%3D', 'address' => '701 Brooks Avenue South, Thief River Falls, MN 56701', 'territory' => 'US', 'cats' => ['industrial', 'medical', 'lighting', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'configurable', 'adapter', 'led-driver', 'stocking', 'after-sales', 'online-shop']],
            ['region' => 'Americas', 'name' => 'Mouser Electronics', 'website' => 'www.mouser.com/delta-electronics', 'tel' => '+1 800 346 6873', 'email' => 'sales@mouser.com', 'maps' => 'https://www.google.com/maps/place/Mouser+Electronics/@32.5786915,-97.1479123,950m/data=!3m2!1e3!4b1!4m6!3m5!1s0x864e6112490e65cb:0xe6f922ed95e777ab!8m2!3d32.5786915!4d-97.1479123!16s%2Fg%2F1tmpfbdt!5m1!1e1?entry=ttu&g_ep=EgoyMDI2MDgxOS4wIKXMDSoASAFQAw%3D%3D', 'address' => '1000 North Main Street Mansfield, TX 76063', 'territory' => 'US', 'cats' => ['industrial', 'medical', 'lighting', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'configurable', 'adapter', 'led-driver', 'stocking', 'after-sales', 'online-shop']],
            ['region' => 'Americas', 'name' => 'Future Electronics Corp', 'website' => 'www.futureelectronics.com/m/delta', 'tel' => '+1 (800) 675-1619', 'email' => '', 'maps' => 'https://www.google.com/maps/place/Future+Electronics/@33.0784133,-96.8199644,945m/data=!3m2!1e3!4b1!4m6!3m5!1s0x864c2206144b70e9:0xe8853c3207e1ab0b!8m2!3d33.0784133!4d-96.8199644!16s%2Fg%2F126294hg_!5m1!1e1?entry=ttu&g_ep=EgoyMDI2MDgxOS4wIKXMDSoASAFQAw%3D%3D', 'address' => '237 Hymus Boulevard, Pointe Claire, Quebec, Canada H9R 5C7', 'territory' => 'US', 'cats' => ['industrial', 'medical', 'lighting', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'configurable', 'adapter', 'led-driver', 'stocking', 'after-sales', 'online-shop']],
            ['region' => 'Americas', 'name' => 'Master Electronics', 'website' => 'https://www.masterelectronics.com/en/suppliers/delta-power-industrial-automation-2322/', 'tel' => '+1 888-473-5297', 'email' => 'webstore@masterelectronics.com', 'maps' => 'https://www.google.com/maps/place/Master+Electronics/@33.4259386,-112.0367346,941m/data=!3m2!1e3!4b1!4m6!3m5!1s0x872b0fb51e009d3b:0x37aa2c4726d4493b!8m2!3d33.4259386!4d-112.0367346!16s%2Fg%2F11h3mv3rk0!5m1!1e1?entry=ttu&g_ep=EgoyMDI2MDgxOS4wIKXMDSoASAFQAw%3D%3D', 'address' => '2425 South 21st Street, Phoenix, AZ 85034', 'territory' => 'US', 'cats' => ['industrial', 'medical', 'lighting', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'configurable', 'adapter', 'led-driver', 'stocking', 'after-sales', 'online-shop']],
            ['region' => 'Americas', 'name' => 'TRC Electronics, Inc.', 'website' => 'https://trcelectronics.com/pages/delta', 'tel' => '+1-888-612-9514', 'email' => 'sales@trcelectronics.com', 'maps' => 'https://www.google.com/maps/place/TRC+Electronics,+Inc./@40.3383376,-75.1210097,859m/data=!3m2!1e3!4b1!4m6!3m5!1s0x89c6a46aecff02ad:0xb7d749882f27b350!8m2!3d40.3383335!4d-75.1184348!16s%2Fg%2F1hc6s801w!5m1!1e1?entry=ttu&g_ep=EgoyMDI2MDgxOS4wIKXMDSoASAFQAw%3D%3D', 'address' => '4171 Stony Lane, Doylestown, PA 18902', 'territory' => 'US', 'cats' => ['industrial', 'medical', 'lighting', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'configurable', 'adapter', 'led-driver', 'stocking', 'after-sales', 'online-shop']],
            ['region' => 'Americas', 'name' => 'Electro Sonic', 'website' => 'https://www.e-sonic.com/en/suppliers/delta-power-industrial-automation-2322/', 'tel' => '+1 905-946-0100', 'email' => 'info@e-sonic.com', 'maps' => 'https://www.google.com/maps/place/Electro+Sonic/data=!4m2!3m1!1s0x0:0x7d503866e1252783?sa=X&ved=1t:2428&ictx=111', 'address' => '60 Renfrew Dr., Suite 110, Markham, Ontario L3R 0E1 Canada', 'territory' => 'US; Canada', 'cats' => ['industrial', 'medical', 'lighting', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'configurable', 'adapter', 'led-driver', 'stocking', 'after-sales', 'online-shop']],
            ['region' => 'Americas', 'name' => 'OnlineComponents.com', 'website' => 'https://www.onlinecomponents.com/en/suppliers/delta-power-industrial-automation-2322/', 'tel' => '+1 833-393-8007', 'email' => 'cs@onlinecomponents.com', 'maps' => 'https://www.google.com/maps/place/Onlinecomponents.com/@33.4255449,-112.0391276,941m/data=!3m2!1e3!4b1!4m6!3m5!1s0x80c8cdfb905dde19:0xd807439528a8f3dd!8m2!3d33.4255404!4d-112.0365527!16s%2Fg%2F1w15zqpf!5m1!1e1?entry=ttu&g_ep=EgoyMDI2MDgxOS4wIKXMDSoASAFQAw%3D%3D', 'address' => '2425 South 21st Street Phoenix, AZ 85034', 'territory' => 'US', 'cats' => ['industrial', 'medical', 'lighting', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'configurable', 'adapter', 'led-driver', 'stocking', 'after-sales', 'online-shop']],
            ['region' => 'Europe', 'name' => 'Avnet Abacus', 'website' => 'https://my.avnet.com/abacus/manufacturers/m/delta-group/', 'tel' => '+49893888820', 'email' => 'OnlineSupportEU@Avnet.com', 'maps' => 'https://www.google.com/maps/place/Avnet+Abacus+-+AVNET+EMG+GmbH/@48.1460618,11.6872101,752m/data=!3m2!1e3!4b1!4m6!3m5!1s0x479e0915578d776b:0x3e9af7ed15f2714b!8m2!3d48.1460582!4d11.689785!16s%2Fg%2F11b6dm386_!5m1!1e1?entry=ttu&g_ep=EgoyMDI2MDgxOS4wIKXMDSoASAFQAw%3D%3D', 'address' => 'Einsteinring 1, 85609, Dornach, Germany', 'territory' => 'EMEA', 'cats' => ['industrial', 'medical', 'lighting', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'configurable', 'wireless-charging-system', 'adapter', 'led-driver', 'stocking', 'after-sales']],
            ['region' => 'Europe', 'name' => 'MPL', 'website' => 'https://b2b.mplpower.pl/product/list/page/1?productcategoryid=1190', 'tel' => '+48 32 44 00 850', 'email' => 'power@mplpower.pl', 'maps' => 'https://www.google.com/maps/place/MPL+Power+Elektro+sp.+z+o.o./@50.3551451,18.7565712,719m/data=!3m2!1e3!4b1!4m6!3m5!1s0x471133d6d0a41945:0x240474dc21f503f2!8m2!3d50.3551451!4d18.7565712!16s%2Fg%2F1tcx5r7n!5m1!1e1?entry=ttu&g_ep=EgoyMDI2MDgxOS4wIKXMDSoASAFQAw%3D%3D', 'address' => '44-119 Gliwice, Wschodnia 40, Poland', 'territory' => 'Poland', 'cats' => ['industrial', 'medical', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'adapter', 'stocking', 'after-sales']],
            ['region' => 'Europe', 'name' => 'Neumueller Elektronik GmbH', 'website' => 'https://www.neumueller.com/en/hersteller/delta-electronics', 'tel' => '+49 9135 7366665', 'email' => 'info@neumueller.com', 'maps' => 'https://www.google.com/maps/place/Electronic+Distribution+and+LED+Kompetenz+Center/@49.6291461,10.8363332,730m/data=!3m2!1e3!4b1!4m6!3m5!1s0x47a204614d240a91:0xc4fbd7fbb2c9a45a!8m2!3d49.6291427!4d10.8389081!16s%2Fg%2F1tk6ty14!5m1!1e1?entry=ttu&g_ep=EgoyMDI2MDgxOS4wIKXMDSoASAFQAw%3D%3D', 'address' => 'Gewerbegebiet Ost 7, D-91085 Weisendorf, Germany', 'territory' => 'Germany', 'cats' => ['industrial', 'medical', 'lighting', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'configurable', 'wireless-charging-system', 'adapter', 'led-driver', 'stocking', 'after-sales']],
            ['region' => 'Europe', 'name' => 'SGE Syscom', 'website' => 'https://www.sge-syscom.com/it/catalogo/delta-psu', 'tel' => '+39 02 617901 (15 Linee r.a.)', 'email' => 'info@sge-syscom.com', 'maps' => 'https://www.google.com/maps/place/Sge+Syscom/@45.5593936,9.2027161,789m/data=!3m2!1e3!4b1!4m6!3m5!1s0x4786bf3051240a77:0xfc7f0985a1cc678a!8m2!3d45.5593899!4d9.205291!16s%2Fg%2F1hc1yl6pn!5m1!1e1?entry=ttu&g_ep=EgoyMDI2MDgxOS4wIKXMDSoASAFQAw%3D%3D', 'address' => 'Sede Commerciale e Amministrativa, Via Gran Sasso, 35 - 20092 CINISELLO BALSAMO (MI), Italy', 'territory' => 'Italy', 'cats' => ['industrial', 'medical', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'configurable', 'stocking', 'after-sales']],
            ['region' => 'Europe', 'name' => 'MEV Elektronik Service GmbH', 'website' => 'https://www.mev-elektronik.com/lieferanten/delta', 'tel' => '+49 (0) 54 24 23 40-0, +49 (0) 54 24 23 40-0', 'email' => 'info@mev-elektronik.com', 'maps' => 'https://www.google.com/maps/place/MEV+Elektronik+Service+GmbH/@52.1314564,8.1569272,145m/data=!3m1!1e3!4m6!3m5!1s0x47b9f3a3581dcbed:0x2feefda6ee50ad03!8m2!3d52.1319322!4d8.1575312!16s%2Fg%2F1td29f5l!5m1!1e1?entry=ttu&g_ep=EgoyMDI2MDgxOS4wIKXMDSoASAFQAw%3D%3D', 'address' => 'Nordel 5a, 49176 Hilter a.T.W., 49176 Germany', 'territory' => 'Germany', 'cats' => ['industrial', 'medical', 'lighting', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'configurable', 'wireless-charging-system', 'adapter', 'led-driver', 'stocking', 'after-sales']],
            ['region' => 'Europe', 'name' => 'FORTEC Switzerland', 'website' => 'https://www.fortec.ch/de', 'tel' => '+41447446111', 'email' => 'info@fortec.ch', 'maps' => 'https://www.google.com/maps/place/FORTEC+Switzerland+AG/@47.4454843,8.3572798,762m/data=!3m2!1e3!4b1!4m6!3m5!1s0x47900db6be037513:0x942a7a72faac1c57!8m2!3d47.4454807!4d8.3598547!16s%2Fg%2F1tmpcvny!5m1!1e1?entry=ttu&g_ep=EgoyMDI2MDgxOS4wIKXMDSoASAFQAw%3D%3D', 'address' => 'Bahnhofstrasse 3, CH-5436 Würenlos, Switzerland', 'territory' => 'Switzerland', 'cats' => ['industrial', 'medical', 'lighting', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'configurable', 'wireless-charging-system', 'adapter', 'led-driver', 'stocking', 'after-sales']],
            ['region' => 'Europe', 'name' => 'Elgood Oy', 'website' => 'https://www.elgood.fi/tuotteet/virtalahteet/', 'tel' => '+358207981140', 'email' => 'joonas.holviala@elgood.fi', 'maps' => 'https://www.google.com/maps/place/Elgood+Oy/@60.2914756,24.9884714,559m/data=!3m2!1e3!4b1!4m6!3m5!1s0x46920863253e5afb:0xd15a5c0d2b58371e!8m2!3d60.291473!4d24.9910463!16s%2Fg%2F1tcy2z5s!5m1!1e1?entry=ttu&g_ep=EgoyMDI2MDgxOS4wIKXMDSoASAFQAw%3D%3D', 'address' => 'Juurakkotie 5B, 01510 VANTAA, Finland', 'territory' => 'Finland', 'cats' => ['industrial', 'medical', 'panel-mount', 'enclosed', 'wireless-charging-system', 'adapter', 'stocking', 'after-sales']],
            ['region' => 'Europe', 'name' => 'Luso Electronics', 'website' => 'https://www.lusoelectronics.com/manufacturers/delta-electronics/', 'tel' => '+44 (0) 207 588 1109', 'email' => 'sales@lusoelectronics.com', 'maps' => 'https://www.google.com/maps/place/Luso+Electronic+Products+Ltd/@51.5174336,-0.0900426,702m/data=!3m3!1e3!4b1!5s0x48769c31c2597f57:0x7ebcef034a6bf669!4m6!3m5!1s0x48761cac7e21a4f9:0x2516f866aef938ed!8m2!3d51.5174303!4d-0.0874677!16s%2Fg%2F1tvm27fk!5m1!1e1?entry=ttu&g_ep=EgoyMDI2MDgxOS4wIKXMDSoASAFQAw%3D%3D', 'address' => '595 Salisbury House, London Wall, London EC2M 5QQ, United Kingdom', 'territory' => 'UK', 'cats' => ['industrial', 'medical', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'configurable', 'adapter', 'stocking', 'after-sales']],
            ['region' => 'Europe', 'name' => 'Steliau Technology', 'website' => 'https://www.steliau.fr/en/manufacturers/delta', 'tel' => '+33 (0)1 55 58 04 04', 'email' => 'contact@steliau.fr', 'maps' => 'https://www.google.com/maps/place/Steliau+Technology+-+Si%C3%A8ge+social/data=!4m2!3m1!1s0x0:0xca38e7a76a69a508?sa=X&ved=1t:2428&ictx=111', 'address' => '6 Rue des Gémeaux, 94150 Rungis, France', 'territory' => 'France', 'cats' => ['industrial', 'medical', 'panel-mount', 'open-frame', 'enclosed', 'configurable', 'adapter', 'stocking', 'after-sales']],
            ['region' => 'Europe', 'name' => 'AE Service', 'website' => 'https://aeservice.fr/product/delta-electronics', 'tel' => '+33(0)4 77 41 21 47', 'email' => 'aeservice@aeservice.fr', 'maps' => 'https://www.google.com/maps/place/AE+Service/@45.4093116,4.3616515,791m/data=!3m2!1e3!4b1!4m6!3m5!1s0x47f5aec2f092bdef:0xbb0ad64943ae5a54!8m2!3d45.4093079!4d4.3642264!16s%2Fg%2F1wn_5gbq!5m1!1e1?entry=ttu&g_ep=EgoyMDI2MDgxOS4wIKXMDSoASAFQAw%3D%3D', 'address' => '1 rue des Cytises, ZAC de Montrambert Pigeot, 42150 La Ricamarie, France', 'territory' => 'France', 'cats' => ['industrial', 'medical', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'stocking']],
            ['region' => 'Europe', 'name' => 'Arrow Central Europe Gmbh', 'website' => 'https://www.arrow.com/en/manufacturers/delta-electronics', 'tel' => '+49231218010', 'email' => '', 'maps' => 'https://www.google.com/maps/place/Arrow+Central+Europe+GmbH/@50.0446286,8.6924035,724m/data=!3m2!1e3!4b1!4m6!3m5!1s0x47bd0d2e9f675a49:0xa6e5fc9f15b0e366!8m2!3d50.0446252!4d8.6949784!16s%2Fg%2F1tltlh53!5m1!1e1?entry=ttu&g_ep=EgoyMDI2MDgxOS4wIKXMDSoASAFQAw%3D%3D', 'address' => 'Hildebrandstraße 11, 44319 Dortmund, Germany', 'territory' => 'EMEA', 'cats' => ['industrial', 'medical', 'lighting', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'configurable', 'wireless-charging-system', 'adapter', 'led-driver', 'after-sales']],
            ['region' => 'Europe', 'name' => 'Elektrospoji d.o.o.', 'website' => 'https://www.elektrospoji.si/proizvajalci/delta-electronics-delta-iabg?category=213&fset=default&page=1&pagesize=12&view=grid&sort=name', 'tel' => '+386 (1)  2352 001', 'email' => 'aleksandra.memon@elektrospoji.si', 'maps' => 'https://www.google.com/maps/place/Elektrospoji+-+Vse+na+enem+mestu+za+razdelilne+in+krmilne+elektro+omare/@46.0883177,14.4790351,782m/data=!3m2!1e3!4b1!4m6!3m5!1s0x477acd2e6b4f9bb9:0x57608d7f80384450!8m2!3d46.088314!4d14.48161!16s%2Fg%2F1tdnd2dc!5m1!1e1?entry=ttu&g_ep=EgoyMDI2MDgxOS4wIKXMDSoASAFQAw%3D%3D', 'address' => 'Stegne 27, 1000 Ljubljana, Slovenia', 'territory' => 'Slovenia', 'cats' => ['industrial', 'medical', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'stocking', 'online-shop']],
            ['region' => 'Europe', 'name' => 'MECTER SL', 'website' => 'https://mecter.com/productos/delta/', 'tel' => '+34 93 422 71 85', 'email' => 'infos@mecter.com', 'maps' => 'https://www.google.com/maps/place/MECTER/@41.3574949,2.1092515,846m/data=!3m2!1e3!4b1!4m6!3m5!1s0x4067b9c353ac54cd:0xef3d9c790307892c!8m2!3d41.3574909!4d2.1118264!16s%2Fg%2F11b7216pr9!5m1!1e1?entry=ttu&g_ep=EgoyMDI2MDgxOS4wIKXMDSoASAFQAw%3D%3D', 'address' => 'Ctra. del Mig, 53, 08907 L\'Hospitalet de Llobregat, Barcelona, Spain', 'territory' => 'Spain', 'cats' => ['industrial', 'medical', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'configurable', 'after-sales']],
            ['region' => 'Europe', 'name' => 'EasyComp', 'website' => 'https://www.easycomp.nl/delta-power-supplies-nu-ook-bij-easycomp-als-officiele-distributeur-van-hoogwaardige-industriele-voedingen-en-led-drivers', 'tel' => '+31 318 70 13 43', 'email' => 'sales@easycomp.nl', 'maps' => 'https://www.google.com/maps/place/Easy+Comp+BV/@52.0398268,5.5661613,693m/data=!3m2!1e3!4b1!4m6!3m5!1s0x47c653d113195c4f:0xed582cba81929a66!8m2!3d52.0398235!4d5.5687362!16s%2Fg%2F1hc262shl!5m1!1e1?entry=ttu&g_ep=EgoyMDI2MDgxOS4wIKXMDSoASAFQAw%3D%3D', 'address' => 'Stationsstraat 70, 3905 JK, Veenendaal, Nederland', 'territory' => 'the Netherlands', 'cats' => ['industrial', 'lighting', 'din-rail', 'panel-mount', 'led-driver', 'stocking', 'after-sales', 'online-shop']],
            ['region' => 'Europe', 'name' => 'ACAL bfi', 'website' => 'https://www.acalbfi.com/partners/delta-electronics', 'tel' => '+31402507400', 'email' => 'contact-uk@acalbfi.com', 'maps' => 'https://www.google.com/maps/place/Acal+BFi+Nederland+BV/@51.4591357,5.3914195,702m/data=!3m2!1e3!4b1!4m6!3m5!1s0x47c6db971b7ec105:0xfc87491f9ba293e7!8m2!3d51.4591324!4d5.3939944!16s%2Fg%2F1tf39rs1!5m1!1e1?entry=ttu&g_ep=EgoyMDI2MDgxOS4wIKXMDSoASAFQAw%3D%3D', 'address' => 'Luchthavenweg 53, 5657 EA Eindhoven, Nederlands', 'territory' => 'EMEA', 'cats' => ['industrial', 'medical', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'wireless-charging-system', 'after-sales']],
            ['region' => 'Europe', 'name' => 'Bicker Elektronik GmbH', 'website' => 'https://www.bicker.de/en/products/industrial-power-supplies/din-rail?p=1', 'tel' => '+49 906 70595-42', 'email' => 'info@bicker.de', 'maps' => 'https://www.google.com/maps/place/Bicker+Elektronik+GmbH/@48.7064615,10.7532673,744m/data=!3m2!1e3!4b1!4m6!3m5!1s0x479ed038e7566f07:0x6aba94877181c3b9!8m2!3d48.706458!4d10.7558422!16s%2Fg%2F1td6fgp1!5m1!1e1?entry=ttu&g_ep=EgoyMDI2MDgxOS4wIKXMDSoASAFQAw%3D%3D', 'address' => 'Ludwig-Auer-Straße 23 86609 Donauwörth, Germany', 'territory' => 'Germany', 'cats' => ['industrial', 'medical', 'lighting', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'configurable', 'wireless-charging-system', 'adapter', 'led-driver', 'stocking', 'after-sales']],
            ['region' => 'Europe', 'name' => 'Günter Dienstleistungen GmbH', 'website' => 'https://www.guenter-psu.de/', 'tel' => '+49 (0) 7082 491350', 'email' => 'info@guenter-psu.de', 'maps' => 'https://www.google.com/maps/place/G%C3%BCnter+Power+Supplies/@48.8495829,8.587085,742m/data=!3m3!1e3!4b1!5s0x479712d319daa1f1:0x3d28f6b021e96068!4m6!3m5!1s0x479712d319e0876b:0xd591cd5e61b06044!8m2!3d48.8495794!4d8.5896599!16s%2Fg%2F1v_nbg9n!5m1!1e1?entry=ttu&g_ep=EgoyMDI2MDgxOS4wIKXMDSoASAFQAw%3D%3D', 'address' => 'Poststr. 11, D-75305 Neuenbürg', 'territory' => 'Germany', 'cats' => ['industrial', 'medical', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'configurable', 'adapter', 'stocking', 'after-sales']],
            ['region' => 'Europe', 'name' => 'Horizon Electronics Ltd', 'prev_name' => 'HorizonElectronics Ltd', 'website' => 'https://www.horizon-pss.com/', 'tel' => '+972-3-9230091', 'email' => 'sales@horizon-pss.com', 'maps' => 'https://www.google.com/maps/place/Horizon+Electronics+Ltd./@32.0944906,34.8638862,15z/data=!4m6!3m5!1s0x151d361c62a1b265:0x8488d499a32fff60!8m2!3d32.0956532!4d34.866744!16s%2Fg%2F1tg96hbp', 'address' => '3 Bazel st. Kiryat Arie - Petah Tikva 4951037, Israel', 'territory' => 'Israel', 'cats' => ['medical', 'enclosed', 'configurable', 'adapter', 'stocking', 'after-sales']],
            ['region' => 'Europe', 'name' => 'Consystem Srl', 'website' => 'https://consystem.it/en/fornitori/delta', 'tel' => '+39024241471', 'email' => 'support@consystem.it', 'maps' => 'https://www.google.com/maps/place/Consystem+Srl/@42.8878538,13.8442408,826m/data=!3m2!1e3!4b1!4m6!3m5!1s0x1331f46ae9c1781f:0x6f6bf375bf895aa!8m2!3d42.8878499!4d13.8468157!16s%2Fg%2F1hc7bkygy!5m1!1e1?entry=ttu&g_ep=EgoyMDI2MDgxOS4wIKXMDSoASAFQAw%3D%3D', 'address' => 'Via E. Stendhal, 55 - 20144 Milan', 'territory' => 'Italy', 'cats' => ['industrial', 'din-rail', 'panel-mount']],
            ['region' => 'Japan', 'name' => 'RESTAR EMBEDDED SOLUTIONS Corporation', 'website' => 'https://www.res.restargp.com/', 'tel' => '+81-3-3502-2521', 'email' => '', 'maps' => 'https://www.google.com/maps/place/Restar+Corporation/@35.6237458,139.7443854,229m/data=!3m1!1e3!4m6!3m5!1s0x60188b0006863f5f:0x5b6e27d5f2a1658a!8m2!3d35.6243185!4d139.744829!16s%2Fg%2F11vq2ntppd!5m1!1e1?entry=ttu&g_ep=EgoyMDI2MDgxOS4wIKXMDSoASAFQAw%3D%3D', 'address' => '2-10-9, Konan, Minato-ku, Tokyo 108-0075, Japan', 'territory' => 'Japan', 'cats' => ['industrial', 'medical', 'lighting', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'adapter', 'led-driver', 'after-sales']],
            ['region' => 'Japan', 'name' => 'Daitron Co., Ltd.', 'website' => 'https://www.daitron.co.jp/', 'tel' => '+81-6-6399-5041', 'email' => '', 'maps' => 'https://www.google.com/maps/place/%E3%83%80%E3%82%A4%E3%83%88%E3%83%AD%E3%83%B3(%E6%A0%AA)+%E6%9C%AC%E7%A4%BE/@34.7364351,135.4918408,926m/data=!3m2!1e3!4b1!4m6!3m5!1s0x6000e44854a86695:0xfe99c349a67ef0dd!8m2!3d34.7364307!4d135.4944157!16s%2Fg%2F11s7p8hkbk!5m1!1e1?entry=ttu&g_ep=EgoyMDI2MDgxOS4wIKXMDSoASAFQAw%3D%3D', 'address' => '4-6-11 Miyahara, Yodogawa-ku, Osaka-shi, Osaka', 'territory' => 'Japan', 'cats' => ['industrial', 'medical', 'lighting', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'adapter', 'led-driver', 'after-sales']],
            ['region' => 'Japan', 'name' => 'KAGA ELECTRONICS CO., LTD.', 'website' => 'https://www.taxan.co.jp/jp/', 'tel' => '+81-3-5657-0111', 'email' => '', 'maps' => 'https://www.google.com/maps/place/%E5%8A%A0%E8%B3%80%E9%9B%BB%E5%AD%90%E3%88%B1/@35.7010825,139.7725444,17z/data=!4m10!1m2!2m1!1sKAGA+ELECTRONICS+CO.,+LTD.!3m6!1s0x60188f87b2c32377:0x53e1ef395db9c472!8m2!3d35.7010787!4d139.775152!15sChpLQUdBIEVMRUNUUk9OSUNTIENPLiwgTFRELloZIhdrYWdhIGVsZWN0cm9uaWNzIGNvIGx0ZJIBEGNvcnBvcmF0ZV9vZmZpY2WaAURDaTlEUVVsUlFVTnZaRU5vZEhsalJqbHZUMmt4VTJGVlRqRlhWMUpMWW10dmVXTlZiRzloUnpGWVZqSkdNR05XUlJBQuABAPoBBAgAEA0!16s%2Fg%2F11b6h_cm30?authuser=0&entry=ttu&g_ep=EgoyMDI2MDYyOS4wIKXMDSoASAFQAw%3D%3D', 'address' => '20 Kanda Matsunagacho, Chiyoda-ku, Tokyo', 'territory' => 'Japan', 'cats' => ['industrial', 'medical', 'lighting', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'adapter', 'led-driver', 'after-sales']],
            ['region' => 'Japan', 'name' => 'RYODEN Corporation', 'website' => 'https://www.ryoden.co.jp/', 'tel' => '+81-3-5396-6111', 'email' => '', 'maps' => 'https://www.google.com/maps/place/RYODEN+%E6%9C%AC%E7%A4%BE/@35.6838834,139.7340447,19.08z/data=!4m14!1m7!3m6!1s0x60188d6589fc5489:0xb2e96698b4502bb4!2zUllPREVOIOacrOekvg!8m2!3d35.6838433!4d139.7345506!16s%2Fg%2F1tdvv9b9!3m5!1s0x60188d6589fc5489:0xb2e96698b4502bb4!8m2!3d35.6838433!4d139.7345506!16s%2Fg%2F1tdvv9b9?authuser=0&entry=ttu&g_ep=EgoyMDI2MDYyOS4wIKXMDSoASAFQAw%3D%3D', 'address' => 'Kosaido Bldg.10F, 5-1 Kojimachi, Chiyoda-ku, Tokyo', 'territory' => 'Japan', 'cats' => ['industrial', 'medical', 'lighting', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'adapter', 'led-driver', 'after-sales']],
            ['region' => 'Japan', 'name' => 'Sumitomo Kikai Co., Ltd.', 'website' => 'https://www.sumitomokizai.co.jp/', 'tel' => '+81-3-3986-7131', 'email' => '', 'maps' => 'https://www.google.com/maps/place/%E4%BD%8F%E5%8F%8B%E6%A9%9F%E6%9D%90%E6%A0%AA%E5%BC%8F%E4%BC%9A%E7%A4%BE/@35.7281854,139.7134951,17z/data=!4m14!1m7!3m6!1s0x60188d66c7ef8563:0x58a8b6c695d02422!2z5L2P5Y-L5qmf5p2Q5qCq5byP5Lya56S-!8m2!3d35.7281854!4d139.71607!16s%2Fg%2F1td4dk29!3m5!1s0x60188d66c7ef8563:0x58a8b6c695d02422!8m2!3d35.7281854!4d139.71607!16s%2Fg%2F1td4dk29?authuser=0&entry=ttu&g_ep=EgoyMDI2MDYyOS4wIKXMDSoASAFQAw%3D%3D', 'address' => '1-25-6 Higashi-Ikebukuro, Toshima-ku, Tokyo', 'territory' => 'Japan', 'cats' => ['industrial', 'medical', 'lighting', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'adapter', 'led-driver', 'after-sales']],
            ['region' => 'Japan', 'name' => 'Torii Electric Co., Ltd.', 'website' => 'https://torii-ec.co.jp/', 'tel' => '+81-75-221-7171', 'email' => '', 'maps' => 'https://www.google.com/maps/place/%E9%B3%A5%E5%B1%85%E9%9B%BB%E6%A5%AD%E3%88%B1+%E6%9D%B1%E4%BA%AC%E6%9C%AC%E7%A4%BE/@35.7013096,139.7686294,19.34z/data=!4m15!1m8!3m7!1s0x60188c1e9884a413:0x168060067f128bdf!2z44CSMTAxLTAwMjEg5p2x5Lqs6YO95Y2D5Luj55Sw5Yy65aSW56We55Sw77yS5LiB55uu77yR77yQ4oiS77yZIOmzpeWxhembu-alreadseS6rOacrOekvg!3b1!8m2!3d35.7013516!4d139.7690568!16s%2Fg%2F11ddyxvwpn!3m5!1s0x60188c1e9882bd6b:0xc862a0231d503bbf!8m2!3d35.7013498!4d139.7690517!16s%2Fg%2F1tdbfd_h?authuser=0&entry=ttu&g_ep=EgoyMDI2MDYyOS4wIKXMDSoASAFQAw%3D%3D', 'address' => '2-10-9 Sotokanda, Chiyoda-ku, Tokyo', 'territory' => 'Japan', 'cats' => ['industrial', 'medical', 'lighting', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'adapter', 'led-driver', 'after-sales']],
            ['region' => 'Japan', 'name' => 'OS Electronics Co., Ltd.', 'website' => 'https://www.oselec.jp/', 'tel' => '+81-3-3255-5985', 'email' => '', 'maps' => 'https://www.google.com/maps/place/%E3%82%AA%E3%83%BC%E3%82%A8%E3%82%B9%E3%82%A8%E3%83%AC%E3%82%AF%E3%83%88%E3%83%AD%E3%83%8B%E3%82%AF%E3%82%B9%E3%88%B1+%E6%9C%AC%E7%A4%BE/@35.7028039,139.7710094,19.86z/data=!3m1!5s0x60188c1e6ad4fd15:0x486cece45032d550!4m14!1m7!3m6!1s0x60188c1e6c082edd:0x6c785e0b47cee0b!2z44Kq44O844Ko44K544Ko44Os44Kv44OI44Ot44OL44Kv44K544ixIOacrOekvg!8m2!3d35.7027612!4d139.7713023!16s%2Fg%2F1thvspp2!3m5!1s0x60188c1e6c082edd:0x6c785e0b47cee0b!8m2!3d35.7027612!4d139.7713023!16s%2Fg%2F1thvspp2?authuser=0&entry=ttu&g_ep=EgoyMDI2MDYyOS4wIKXMDSoASAFQAw%3D%3D', 'address' => 'Akihabara Sanwa Toyo Bldg.5F, Akihabara Sanwa Toyo Bldg. 5F, 3-16-8 Sotokanda, Chiyoda-ku, Tokyo', 'territory' => 'Japan', 'cats' => ['industrial', 'medical', 'lighting', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'adapter', 'led-driver', 'after-sales']],
            ['region' => 'Korea', 'name' => 'Bluecosmos', 'website' => 'http://www.bluecosmos.co.kr', 'tel' => '+82-32-662-2350', 'email' => 'shawn.yoon@bluecosmos.co.kr', 'maps' => 'https://www.google.com/maps/?q=37.50025251346668,126.78940941796873&sensor=true', 'address' => 'Chunui Techno Tower 4F RM 404, 80 Jomaru-ro 385 Beongil, Bucheon-si, Gyeonggi-do, Korea', 'territory' => 'Korea', 'cats' => ['industrial', 'medical', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'adapter', 'after-sales']],
            ['region' => 'Korea', 'name' => 'One Corporation', 'website' => 'www.onecorp.co.kr', 'tel' => '+82-3283-4105', 'email' => 'sam@onecorp.co.kr', 'maps' => 'https://www.google.com/maps/?q=37.48118615695118,126.87606330926208&sensor=true', 'address' => '1302, 648, Seobusaet-Gil, Geumcheon-Gu, Seoul, Korea, 08504', 'territory' => 'Korea', 'cats' => ['industrial', 'medical', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'adapter', 'after-sales']],
            ['region' => 'Korea', 'name' => 'UNITRONTECH Co., Ltd.', 'website' => 'http://www.unitrontech.com/', 'tel' => '+82-2-573-6800', 'email' => 'anthony@unitrontech.com', 'maps' => 'https://www.google.com/maps/?q=37.51743277297858,127.05927335773093&sensor=true', 'address' => 'Sambo Bldg 9F, 638, Yeongdong-daero, Gangnam-gu, Seoul, Republic of Korea, 06080', 'territory' => 'Korea', 'cats' => ['industrial', 'medical', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'adapter', 'after-sales']],
            ['region' => 'Korea', 'name' => 'ERsystem', 'website' => 'https://www.ersystem.co.kr/', 'tel' => '+82-31-653-9343', 'email' => 'ctj@ersystem.co.kr', 'maps' => 'https://www.google.com/maps/place/%EC%9D%B4%EC%95%8C%EC%8B%9C%EC%8A%A4%ED%85%9C/@36.9936938,127.1250398,900m/data=!3m2!1e3!4b1!4m6!3m5!1s0x357b3b17be84f8cb:0x785ca31bff44cfcf!8m2!3d36.9936938!4d127.1250398!16s%2Fg%2F11sj5qnwnq!5m1!1e1?entry=ttu&g_ep=EgoyMDI2MDgxOS4wIKXMDSoASAFQAw%3D%3D', 'address' => 'YJ Bldg 4F, 23, Yongjuk 3-ro, Pyeongtaek-si, Gyeonggi-do, Republic of Korea,', 'territory' => 'Korea', 'cats' => ['industrial', 'medical', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'adapter', 'stocking', 'after-sales']],
            ['region' => 'Thailand', 'name' => 'Electronics Source Co.,Ltd.', 'website' => 'http://www.es.co.th', 'tel' => '+66 2 0624970', 'email' => 'info@es.co.th', 'maps' => 'https://www.google.com/maps/place/Electronics+Source+Co.,+Ltd.(Headquarter+-+Sanam+Pao+Branch)/@13.7748467,100.5384187,1095m/data=!3m2!1e3!4b1!4m6!3m5!1s0x30e29ea67ae02d5b:0xc408c49a97e4b45c!8m2!3d13.7748415!4d100.5432896!16s%2Fg%2F11cspgypxl!5m1!1e1?entry=ttu&g_ep=EgoyMDI2MDgxOS4wIKXMDSoASAFQAw%3D%3D', 'address' => '256 Floor 5 and 6 Phahonyothin Road, Sam Sen Nai, Phayathai, Bangkok 10400, Thailand', 'territory' => 'Thailand', 'cats' => ['industrial', 'din-rail', 'panel-mount', 'open-frame', 'wireless-charging-system', 'adapter', 'stocking', 'after-sales', 'online-shop']],
            ['region' => 'Taiwan', 'name' => 'ACE PILLAR CO., LTD.', 'website' => 'www.acepillar.com', 'tel' => '+886 2-2995-8400', 'email' => 'sales@acepillar.com.tw', 'maps' => 'https://www.google.com/maps/place/%E7%BE%85%E6%98%87%E4%BC%81%E6%A5%AD%E8%82%A1%E4%BB%BD%E6%9C%89%E9%99%90%E5%85%AC%E5%8F%B8/@25.0546858,121.442595,17z/data=!3m2!4b1!5s0x3442a62aaf96f19f:0xc3b0ba22247ec8c7!4m6!3m5!1s0x3442a8f5cebac577:0x2d0f94bca5b760b0!8m2!3d25.054681!4d121.4451699!16s%2Fg%2F1pzptpc9y?entry=tts&g_ep=EgoyMDI1MTAyOC4wIPu8ASoASAFQAw%3D%3D&skid=53bc5288-097c-424e-acfa-394e5c05b6df', 'address' => '2F, No.7, Ln 83, Sec. 1, Guangfu Rd., Sanchong Dist., New Taipei City 241, Taiwan, R.O.C.', 'territory' => 'Taiwan', 'cats' => ['industrial', 'medical', 'lighting', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'configurable', 'adapter', 'led-driver', 'stocking', 'after-sales', 'online-shop']],
            ['region' => 'Taiwan', 'name' => 'Faith Automation Enterprise, Co., Ltd.', 'website' => 'www.faith.com.tw', 'tel' => '+886 2 2299 7828', 'email' => 'master@faith.com.tw', 'maps' => 'https://www.google.com/maps/place/Faith+Automation+Enterprises,+Co.,+Ltd./@25.066055,121.4453731,1021m/data=!3m3!1e3!4b1!5s0x3442a89b8947a13d:0x13aefdb99ef1e617!4m6!3m5!1s0x3442a900ae63c765:0x403906572819bb52!8m2!3d25.0660502!4d121.447948!16s%2Fg%2F11h2fgnqmh!5m1!1e1?entry=ttu&g_ep=EgoyMDI2MDgxOS4wIKXMDSoASAFQAw%3D%3D', 'address' => 'No.10, Wuchuan 7th Rd., Wugu Dist., New Taipei City 24890, Taiwan (R.O.C)', 'territory' => 'Taiwan', 'cats' => ['industrial', 'lighting', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'configurable', 'adapter', 'led-driver', 'stocking', 'after-sales']],
            ['region' => 'Taiwan', 'name' => 'NINE BIG Co., Ltd.', 'website' => 'www.tdk-ninebig.com.tw', 'tel' => '+886 4-2258-9900', 'email' => 'ninebig@tdk-ninebig.com.tw,  sales@tdk-ninebig.com.tw', 'maps' => 'https://www.google.com/maps/place/%E4%B9%9D%E5%AF%A7%E8%82%A1%E4%BB%BD%E6%9C%89%E9%99%90%E5%85%AC%E5%8F%B8/@24.1514937,120.6452863,129m/data=!3m1!1e3!4m6!3m5!1s0x34693d9505c26ded:0x934e3a9fe117cad9!8m2!3d24.1517311!4d120.6453569!16s%2Fg%2F11c7hcyqz1!5m1!1e1?entry=ttu&g_ep=EgoyMDI2MDgxOS4wIKXMDSoASAFQAw%3D%3D', 'address' => 'No. 85,Dajeng St.,Taichung,Taiwan 40862', 'territory' => 'Taiwan', 'cats' => ['industrial', 'medical', 'lighting', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'configurable', 'adapter', 'led-driver', 'stocking', 'after-sales', 'online-shop']],
            ['region' => 'Taiwan', 'name' => 'Honya Electronic Co., Ltd.', 'website' => 'www.honyabiz.com.tw', 'tel' => '+886 2 2785-6812', 'email' => 'honya@honyabiz.com.tw', 'maps' => 'https://www.google.com/maps/place/%E7%9A%87%E6%9B%84%E5%AF%A6%E6%A5%AD%E6%9C%89%E9%99%90%E5%85%AC%E5%8F%B8/@25.0528393,121.587641,1021m/data=!3m2!1e3!4b1!4m6!3m5!1s0x3442ab79e2d394cf:0x7af54855464f21c1!8m2!3d25.0528393!4d121.587641!16s%2Fg%2F1pzykcvns!5m1!1e1?entry=ttu&g_ep=EgoyMDI2MDgxOS4wIKXMDSoASAFQAw%3D%3D', 'address' => '8F., No. 99, Sec. 3, Nangang Rd., Nangang Dist., Taipei City , Taiwan (R.O.C.)', 'territory' => 'Taiwan', 'cats' => ['industrial', 'medical', 'lighting', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'configurable', 'adapter', 'led-driver', 'after-sales']],
            ['region' => 'Taiwan', 'name' => 'O-DEAR INTERNATIONAL CORP.', 'website' => 'www.e-odear.com.tw', 'tel' => '+886 2-8512-2893', 'email' => 'odear@e-odear.com.tw', 'maps' => 'https://www.google.com/maps/place/%E6%AD%90%E8%BF%AA%E7%88%BE%E8%82%A1%E4%BB%BD%E6%9C%89%E9%99%90%E5%85%AC%E5%8F%B8/@25.0531871,121.4709124,1021m/data=!3m2!1e3!4b1!4m6!3m5!1s0x3442a8f47fb33d13:0xe9076662eda8d3c5!8m2!3d25.0531871!4d121.4709124!16s%2Fg%2F1pzvlwrfl!5m1!1e1?entry=ttu&g_ep=EgoyMDI2MDgxOS4wIKXMDSoASAFQAw%3D%3D', 'address' => '4F., No. 123, Xingde Rd., Sanchong Dist., New Taipei City 241 , Taiwan (R.O.C.)', 'territory' => 'Taiwan', 'cats' => ['industrial', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'adapter', 'after-sales']],
            ['region' => 'China', 'name' => 'Shenzhen BDW Electric Co., Ltd', 'website' => 'www.bdwdq.com', 'tel' => '+86 13 622348987, +86 13 925264925', 'email' => 'yebin@bdwasia.com', 'maps' => 'https://www.google.com/maps/?q=22.635892521021834,114.06736899731423&sensor=true', 'address' => 'Room 2805, 28th floor, Building F, Galaxy WORLD, Yabao Road No.1, BanTian Street, Longgang District, Shenzhen', 'territory' => 'China', 'cats' => ['industrial', 'medical', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'configurable', 'adapter', 'stocking']],
            ['region' => 'China', 'name' => 'Beijing Zhonghai Jia Technology Co., Ltd.', 'website' => 'www.zhjpower.net', 'tel' => '+86 18 911125003', 'email' => 'zyy369369@126.com', 'maps' => 'https://www.google.com/maps/?q=40.036521910125046,116.33642691311012&sensor=true', 'address' => 'Room 522, Building 8, No.16, Xiaoying West Road, Qinghe Town, Haiding District, Beijing', 'territory' => 'China', 'cats' => ['industrial', 'medical', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'configurable', 'adapter', 'stocking']],
            ['region' => 'China', 'name' => 'Shenzhen AJC Electronics Co., Ltd.', 'website' => 'www.ajc-ele.com', 'tel' => '+86 13 425119012', 'email' => 'xiayf@ajc-ele.com', 'maps' => 'https://www.google.com/maps/?q=22.577744236991087,114.05932787417323&sensor=true', 'address' => '17A, Fusen Building, Huaxia 2nd Road, Dongzhou Community, Guangming Street, Guangming New District, Shenzhen', 'territory' => 'China', 'cats' => ['industrial', 'medical', 'lighting', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'configurable', 'adapter', 'led-driver', 'stocking']],
            ['region' => 'China', 'name' => 'ShenZhen CESTAR Electronic Technology Co., Ltd.', 'website' => 'http://www.ce-power.com', 'tel' => '+86 755 82531600', 'email' => 'lina.lv@ce-power.com', 'maps' => 'https://www.google.com/maps/place/Detai+Technology+Industrial+Park/@22.681252,113.9921561,17z/data=!3m1!4b1!4m6!3m5!1s0x34038dae0c872e59:0xb10fdac3db4b757f!8m2!3d22.681252!4d113.994731!16s%2Fg%2F1tgpvscz!5m1!1e1?entry=ttu&g_ep=EgoyMDI2MDgxOS4wIKXMDSoASAFQAw%3D%3D', 'address' => 'No.1 Building, De tai Industrial Zone, No. 496, Huarong Road, Dalang, Longhua District, Shenzhen', 'territory' => 'China', 'cats' => ['industrial', 'medical', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'configurable', 'adapter', 'stocking']],
            ['region' => 'Europe', 'name' => 'Energom Electronic Kft', 'prev_name' => 'Energom electronic kft', 'website' => 'https://www.energom.hu/', 'tel' => '+36 1 459 8010', 'email' => 'ajanlatkeres@energom.hu', 'maps' => 'https://www.google.com/maps/place/Energom+Electronic+Kft./@13.5528448,100.6764032,13z/data=!3m1!4b1!4m6!3m5!1s0x4741dcee45cf952b:0x4b853c4117737c18!8m2!3d47.5160828!4d19.266687!16s%2Fg%2F11f4lk0wmn!5m1!1e1?entry=ttu&g_ep=EgoyMDI2MDgxOS4wIKXMDSoASAFQAw%3D%3D', 'address' => 'Budapest, Komáromi út 28, 1142 Hungary', 'territory' => 'Hungary', 'cats' => ['industrial', 'medical', 'lighting', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'configurable', 'wireless-charging-system', 'adapter', 'led-driver', 'stocking', 'after-sales', 'online-shop']],
            ['region' => 'Europe', 'name' => 'Sunpower Group Holdings Ltd', 'website' => 'https://www.sunpowergroupholdings.com', 'tel' => '+44 118 982 3745', 'email' => '', 'maps' => 'https://www.google.com/maps/place/Sunpower+Group+Holdings+Ltd/@51.3623423,-1.1635189,17z/data=!3m1!4b1!4m6!3m5!1s0x4876a041d80e1405:0x4606dbb30bf67847!8m2!3d51.362339!4d-1.160944!16s%2Fg%2F11dymwkk_6!5m1!1e1?entry=ttu&g_ep=EgoyMDI2MDgxOS4wIKXMDSoASAFQAw%3D%3D', 'address' => 'Sunpower Group Holdings Ltd, Orion House, Calleva Park, Aldermaston, Reading RG7 8SN, United Kingdom', 'territory' => 'UK', 'cats' => ['industrial', 'medical', 'lighting', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'configurable', 'wireless-charging-system', 'adapter', 'led-driver', 'stocking', 'after-sales', 'online-shop']],
            ['region' => 'Europe', 'name' => 'WEID-BUL LTD', 'website' => 'https://weidbul.com/delta-electronics', 'tel' => '+359 (0) 2 963 25 60', 'email' => 'stela.peneva@weidbul.com', 'maps' => 'https://www.google.com/maps/place/%D0%92%D0%B0%D0%B9%D0%B4-%D0%91%D1%83%D0%BB+%D0%9E%D0%9E%D0%94/@42.653945,23.3599379,651m/data=!3m2!1e3!4b1!4m6!3m5!1s0x40aa8427930c5bed:0xb23fbf3510f6a22e!8m2!3d42.653945!4d23.3599379!16s%2Fg%2F1vkxkryj?entry=ttu&g_ep=EgoyMDI2MDYyOS4wIKXMDSoASAFQAw%3D%3D', 'address' => 'g.k. Darvenitsa, bul. "Kliment Ohridski" 13, 1756 Sofia, Bulgaria', 'territory' => 'Bulgaria', 'cats' => ['industrial', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'stocking', 'online-shop']],
            ['region' => 'Americas', 'name' => 'Newark', 'website' => 'https://www.newark.com/c/power-supplies/ac-dc-converters?brand=delta-electronics', 'tel' => '+1 800 463 9275', 'email' => 'order@newark.com', 'maps' => 'https://www.google.com/maps/place/Newark+Electronics/@41.2168731,-81.6444778,848m/data=!3m2!1e3!4b1!4m6!3m5!1s0x8830db805e9250df:0x75e9828d57231e7f!8m2!3d41.2168731!4d-81.6444778!16s%2Fg%2F1tf43lz9!5m1!1e1?entry=ttu&g_ep=EgoyMDI2MDgxOS4wIKXMDSoASAFQAw%3D%3D', 'address' => '4180 Highlander Pkwy, Richfield, OH USA 44286', 'territory' => 'US', 'cats' => ['industrial', 'medical', 'lighting', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'adapter', 'led-driver', 'stocking']],
        ];
    }
}
