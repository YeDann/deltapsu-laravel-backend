<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * 更新既有經銷商資料。
 *
 * 名單與 DistributorOfficeSeeder相同 56 家，無增減，僅欄位／分類勾選異動。
 * 設計重點：
 * - 一律以「英文 title」比對既有 office（測站／正式站 office id 不同，不能靠 id）。找不到同名者 → 跳過並記錄，不新增。
 * - 就地更新，不刪除任何 office；不觸碰 logo 與 office id（保留客戶已上傳的 logo 與外部引用）。
 * - 地址寫入 office.address（2026-06-18 新欄，取代 office_translations.content 作為 distributor 地址來源）；
 *   座標從 maps URL 解析寫入 lat/lon（皆為後台實際使用欄位；解不出的 maps 值保留原 lat/lon）。
 * - 分類（3 張打勾表）與 sales territory 採「完整同步」： 新增的補上、取消勾選的移除；僅動關聯表，不動分類定義。
 * - Idempotent：可重複執行，結果一致。
 * - Certification 欄全空，不處理。
 *
 * 執行：php artisan db:seed --class=DistributorOfficeUpdateSeeder
 */
class DistributorOfficeUpdateSeeder extends Seeder
{
    public function run()
    {
        $locales = DB::table('language')->pluck('name')->toArray();

        $regionToContinent = [
            'Americas' => 2, 'Europe' => 4, 'Japan' => 5, 'Korea' => 9,
            'SEA' => 11, 'Taiwan' => 12, 'China' => 13,
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
        $skipped = [];

        foreach ($this->rows() as $r) {
            $continentId = $regionToContinent[$r['region']] ?? null;

            $officeId = DB::table('office as o')
                ->join('office_translations as ot', 'o.id', '=', 'ot.fk_office_id')
                ->where('o.type_id', 2)->where('ot.local', 'en')->where('ot.title', $r['name'])
                ->value('o.id');

            if (!$officeId) {
                $skipped[] = $r['name'];
                continue;
            }

            // office 欄位（不含 logo）。
            // 作為 distributor 地址來源；客戶幾乎未編輯過（僅 1 筆），依指示直接覆蓋。
            $officeUpdate = [
                'continent_id' => $continentId,
                'website' => $r['website'] ?: null,
                'telephone' => $r['tel'] ?: null,
                'email' => $r['email'] ?: null,
                'address' => $r['address'] ?: null,
                'google_maps' => $r['maps'] ?: null,
                'updated_at' => now(),
            ];
            // lat/lon 從 maps URL 解析（與後台同步）；解不出（短網址／純文字／q=,）則保留原值
            $coords = $this->parseLatLon($r['maps']);
            if (null !== $coords) {
                $officeUpdate['lat'] = $coords[0];
                $officeUpdate['lon'] = $coords[1];
            }
            DB::table('office')->where('id', $officeId)->update($officeUpdate);

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

            $updated++;
            echo "Updated: {$r['name']}\n";
        }

        echo "\n=== Done. updated={$updated}, skipped=" . count($skipped) . " ===\n";
        foreach ($skipped as $s) { echo "  SKIP (no matching office): {$s}\n"; }
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

    /** @return array<int,array<string,mixed>> 56 筆 */
    private function rows()
    {
        return [
            ['region' => 'Americas', 'name' => 'Arrow Electronics, Inc.', 'website' => 'https://www.arrow.com/en/manufacturers/d/delta-electronics.html', 'tel' => '+1 800 833 3557', 'email' => 'advantagesales@arrow.com', 'maps' => 'https://www.google.com/maps/?q=48.146118,11.689726&sensor=true', 'address' => '9201 East Dry Creek Road, Centennial, CO 80112', 'territory' => 'US', 'cats' => ['industrial', 'medical', 'lighting', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'configurable', 'adapter', 'led-driver', 'stocking', 'after-sales', 'online-shop']],
            ['region' => 'Americas', 'name' => 'Avnet Inc', 'website' => 'www.avnet.com/shop/us/m/delta-group', 'tel' => '+1 800 408 8353', 'email' => 'onlinesupportUS@avnet.com', 'maps' => 'https://www.google.com/maps/?q=33.4274752,-111.9800088&sensor=true', 'address' => '2211 South 47th St, Phoenix, AZ 85034', 'territory' => 'US', 'cats' => ['industrial', 'medical', 'lighting', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'configurable', 'adapter', 'led-driver', 'stocking', 'after-sales', 'online-shop']],
            ['region' => 'Americas', 'name' => 'DigiKey', 'website' => 'www.digikey.com/en/supplier-centers/delta-product-groups', 'tel' => '+1 800 344 4539', 'email' => 'sales@digikey.com', 'maps' => 'https://www.google.com/maps/?q=48.1097337,-96.1960184&sensor=true', 'address' => '701 Brooks Avenue South, Thief River Falls, MN 56701', 'territory' => 'US', 'cats' => ['industrial', 'medical', 'lighting', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'configurable', 'adapter', 'led-driver', 'stocking', 'after-sales', 'online-shop']],
            ['region' => 'Americas', 'name' => 'Mouser Electronics', 'website' => 'www.mouser.com/delta-electronics', 'tel' => '+1 800 346 6873', 'email' => 'sales@mouser.com', 'maps' => 'https://www.google.com/maps/?q=32.5789443,-97.1471074&sensor=true', 'address' => '1000 North Main Street Mansfield, TX 76063', 'territory' => 'US', 'cats' => ['industrial', 'medical', 'lighting', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'configurable', 'adapter', 'led-driver', 'stocking', 'after-sales', 'online-shop']],
            ['region' => 'Americas', 'name' => 'Future Electronics Corp', 'website' => 'www.futureelectronics.com/m/delta', 'tel' => '+1 (800) 675-1619', 'email' => '', 'maps' => 'https://www.google.com/maps/?q=45.45971856033397,-73.82475397747795&sensor=true', 'address' => '237 Hymus Boulevard, Pointe Claire, Quebec, Canada H9R 5C7', 'territory' => 'US', 'cats' => ['industrial', 'medical', 'lighting', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'configurable', 'adapter', 'led-driver', 'stocking', 'after-sales', 'online-shop']],
            ['region' => 'Americas', 'name' => 'Master Electronics', 'website' => 'https://www.masterelectronics.com/en/suppliers/delta-power-industrial-automation-2322/', 'tel' => '+1 888-473-5297', 'email' => 'webstore@masterelectronics.com', 'maps' => 'https://www.google.com/maps/?q=33.42568503440705,-112.03567693068197&sensor=true', 'address' => '2425 South 21st Street, Phoenix, AZ 85034', 'territory' => 'US', 'cats' => ['industrial', 'medical', 'lighting', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'configurable', 'adapter', 'led-driver', 'stocking', 'after-sales', 'online-shop']],
            ['region' => 'Americas', 'name' => 'TRC Electronics, Inc.', 'website' => 'https://trcelectronics.com/pages/delta', 'tel' => '+1-888-612-9514', 'email' => 'sales@trcelectronics.com', 'maps' => 'https://www.google.com/maps/?q=40.338489872411024,-75.11925810179146&sensor=true', 'address' => '4171 Stony Lane, Doylestown, PA 18902', 'territory' => 'US', 'cats' => ['industrial', 'medical', 'lighting', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'configurable', 'adapter', 'led-driver', 'stocking', 'after-sales', 'online-shop']],
            ['region' => 'Americas', 'name' => 'Electro Sonic', 'website' => 'https://www.e-sonic.com/en/suppliers/delta-power-industrial-automation-2322/', 'tel' => '+1 905-946-0100', 'email' => 'info@e-sonic.com', 'maps' => 'https://www.google.com/maps/?q=43.85797625412811,-79.36284504048814&sensor=true', 'address' => '60 Renfrew Dr., Suite 110, Markham, Ontario L3R 0E1 Canada', 'territory' => 'US', 'cats' => ['industrial', 'medical', 'lighting', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'configurable', 'adapter', 'led-driver', 'stocking', 'after-sales', 'online-shop']],
            ['region' => 'Americas', 'name' => 'OnlineComponents.com', 'website' => 'https://www.onlinecomponents.com/en/suppliers/delta-power-industrial-automation-2322/', 'tel' => '+1 833-393-8007', 'email' => 'cs@onlinecomponents.com', 'maps' => 'https://www.google.com/maps/?q=33.42631046742548,-112.03479317099321&sensor=true', 'address' => '2425 South 21st Street Phoenix, AZ 85034', 'territory' => 'US', 'cats' => ['industrial', 'medical', 'lighting', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'configurable', 'adapter', 'led-driver', 'stocking', 'after-sales', 'online-shop']],
            ['region' => 'Europe', 'name' => 'Avnet Abacus', 'website' => 'https://my.avnet.com/abacus/manufacturers/m/delta-group/', 'tel' => '+49893888820', 'email' => 'OnlineSupportEU@Avnet.com', 'maps' => 'https://www.google.com/maps/?q=48.146118,11.689726&sensor=true', 'address' => 'Einsteinring 1, 85609, Dornach, Germany', 'territory' => 'EMEA', 'cats' => ['industrial', 'medical', 'lighting', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'configurable', 'wireless-charging-system', 'adapter', 'led-driver', 'stocking', 'after-sales']],
            ['region' => 'Europe', 'name' => 'MPL', 'website' => 'https://b2b.mplpower.pl/product/list/page/1?productcategoryid=1190', 'tel' => '+48 32 44 00 850', 'email' => 'power@mplpower.pl', 'maps' => 'https://www.google.com/maps/?q=50.277158111592826,18.73710014476625&sensor=true', 'address' => '44-119 Gliwice, Wschodnia 40, Poland', 'territory' => 'Poland', 'cats' => ['industrial', 'medical', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'adapter', 'stocking', 'after-sales']],
            ['region' => 'Europe', 'name' => 'Neumueller Elektronik GmbH', 'website' => 'https://www.neumueller.com/en/hersteller/delta-electronics', 'tel' => '+49 9135 7366665', 'email' => 'info@neumueller.com', 'maps' => 'https://www.google.com/maps/?q=49.6290712,10.8390038&sensor=true', 'address' => 'Gewerbegebiet Ost 7, D-91085 Weisendorf, Germany', 'territory' => 'Germany', 'cats' => ['industrial', 'medical', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'configurable', 'adapter', 'stocking', 'after-sales']],
            ['region' => 'Europe', 'name' => 'SGE Syscom', 'website' => 'https://www.sge-syscom.com/it/catalogo/delta-psu', 'tel' => '+39 02 617901 (15 Linee r.a.)', 'email' => 'info@sge-syscom.com', 'maps' => 'https://www.google.com/maps/?q=45.559601,9.206356&sensor=true', 'address' => 'Sede Commerciale e Amministrativa, Via Gran Sasso, 35 - 20092 CINISELLO BALSAMO (MI), Italy', 'territory' => 'Italy', 'cats' => ['industrial', 'medical', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'configurable', 'stocking', 'after-sales']],
            ['region' => 'Europe', 'name' => 'A&C Solutions', 'website' => 'https://www.ac-solutions.be/nl/merken/delta', 'tel' => '+3214735370', 'email' => 'sales@ac-solutions.be', 'maps' => 'https://www.google.com/maps/?q=51.30446,4.92328&sensor=true', 'address' => 'Slachthuisstraat 68 bus 6, 2300 Turnhout, Belgium', 'territory' => 'Belgium', 'cats' => ['industrial', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'after-sales']],
            ['region' => 'Europe', 'name' => 'MEV Elektronik Service GmbH', 'website' => 'https://www.mev-elektronik.com/lieferanten/delta', 'tel' => '+49 (0) 54 24 23 40-0,
+49 (0) 54 24 23 40-0', 'email' => 'info@mev-elektronik.com', 'maps' => 'https://www.google.com/maps/?q=52.13207698805076,8.157520455335362&sensor=true', 'address' => 'Nordel 5a, 49176 Hilter a.T.W., 49176 Germany', 'territory' => 'Germany', 'cats' => ['industrial', 'medical', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'configurable', 'adapter', 'after-sales']],
            ['region' => 'Europe', 'name' => 'FORTEC Switzerland', 'website' => 'https://www.fortec.ch/de', 'tel' => '+41447446111', 'email' => 'info@fortec.ch', 'maps' => 'https://www.google.com/maps/?q=47.44554,8.35982&sensor=true', 'address' => 'Bahnhofstrasse 3, CH-5436 Würenlos, Switzerland', 'territory' => 'Switzerland', 'cats' => ['industrial', 'medical', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'configurable', 'wireless-charging-system', 'stocking', 'after-sales']],
            ['region' => 'Europe', 'name' => 'Fortec Power GmbH', 'website' => 'https://www.fortec.ch/de', 'tel' => '+41447446111', 'email' => 'info@fortec.ch', 'maps' => '', 'address' => 'Bahnhofstrasse 3, CH-5436 Würenlos, Switzerland', 'territory' => '', 'cats' => []],
            ['region' => 'Europe', 'name' => 'Elgood Oy', 'website' => 'https://www.elgood.fi/tuotteet/virtalahteet/', 'tel' => '+358207981140', 'email' => 'joonas.holviala@elgood.fi', 'maps' => 'https://www.google.com/maps/?q=60.29145511755065,24.991059555406295&sensor=true', 'address' => 'Juurakkotie 5B, 01510 VANTAA, Finland', 'territory' => 'Finland', 'cats' => ['industrial', 'medical', 'panel-mount', 'enclosed', 'wireless-charging-system', 'adapter', 'stocking', 'after-sales']],
            ['region' => 'Europe', 'name' => 'Future Electronics', 'website' => 'https://www.futureelectronics.com/c/electromechanical/power-supplies--ac-dc/products?q=Delta:relevance:manufacturerName:Delta', 'tel' => '+44 1784 275000', 'email' => '', 'maps' => 'https://www.google.com/maps/?q=51.434555085391,-0.5340554255271626&sensor=true', 'address' => 'The Glanty, Egham, Surrey, United Kingdom TW20 9AH', 'territory' => 'EMEA', 'cats' => ['industrial', 'medical', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'after-sales']],
            ['region' => 'Europe', 'name' => 'Luso Electronics', 'website' => 'https://www.lusoelectronics.com/manufacturers/delta-electronics/', 'tel' => '+44 (0) 207 588 1109', 'email' => 'sales@lusoelectronics.com', 'maps' => 'https://www.google.com/maps/?q=51.51743904690537,-0.08743432222106894&sensor=true', 'address' => '595 Salisbury House, London Wall, London EC2M 5QQ, United Kingdom', 'territory' => 'UK', 'cats' => ['industrial', 'medical', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'configurable', 'adapter', 'stocking', 'after-sales']],
            ['region' => 'Europe', 'name' => 'Steliau Technology', 'website' => 'https://www.steliau.fr/en/manufacturers/delta', 'tel' => '+33 (0)1 55 58 04 04', 'email' => 'contact@steliau.fr', 'maps' => 'https://www.google.com/maps/?q=48.81408188816697,2.3159843953288815&sensor=true', 'address' => 'A. 41/43 rue Périer 92120 Montrouge France', 'territory' => 'France', 'cats' => ['industrial', 'medical', 'panel-mount', 'open-frame', 'enclosed', 'configurable', 'adapter', 'stocking', 'after-sales']],
            ['region' => 'Europe', 'name' => 'AE Service', 'website' => 'https://aeservice.fr/product/delta-electronics', 'tel' => '+33(0)4 77 41 21 47', 'email' => 'aeservice@aeservice.fr', 'maps' => 'https://www.google.com/maps/?q=45.4098957639448,4.364581425446536&sensor=true', 'address' => '1 rue des Cytises, ZAC de Montrambert Pigeot, 42150 La Ricamarie, France', 'territory' => 'France', 'cats' => ['industrial', 'medical', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'stocking']],
            ['region' => 'Europe', 'name' => 'Arrow Central Europe Gmbh', 'website' => 'https://www.arrow.com/en/manufacturers/delta-electronics', 'tel' => '+49231218010', 'email' => '', 'maps' => 'https://www.google.com/maps/?q=51.53185808667624,7.630207495529387&sensor=true', 'address' => 'Hildebrandstraße 11, 44319 Dortmund, Germany', 'territory' => 'EMEA', 'cats' => ['industrial', 'medical', 'lighting', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'configurable', 'wireless-charging-system', 'adapter', 'led-driver', 'after-sales']],
            ['region' => 'Europe', 'name' => 'Elektrospoji d.o.o.', 'website' => 'https://www.elektrospoji.si/proizvajalci/delta-electronics-delta-iabg?category=213&fset=default&page=1&pagesize=12&view=grid&sort=name', 'tel' => '+386 (1) 511 38 10', 'email' => 'info@elektrospoji.si', 'maps' => 'https://www.google.com/maps/?q=46.08826754983997,14.481887012689942&sensor=true', 'address' => 'Stegne 27, 1000 Ljubljana, Slovenia', 'territory' => 'Slovenia', 'cats' => ['industrial', 'medical', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'configurable', 'stocking', 'after-sales']],
            ['region' => 'Europe', 'name' => 'Verbax', 'website' => 'https://www.verbax.it/en/manufacturer/delta', 'tel' => '+39 0426 270021', 'email' => 'sales@verbax.it', 'maps' => 'https://www.google.com/maps/?q=45.66816121266383,12.229088083836702&sensor=true', 'address' => 'Piazza delle, Istituzioni 39F, 31100 Treviso, Italia', 'territory' => 'Italy', 'cats' => ['lighting', 'led-driver', 'online-shop']],
            ['region' => 'Europe', 'name' => 'Perel Oy', 'website' => 'https://www.perel.fi/tuotteet/44798977/ac-dc-teholaehteet-din-kiskoon?s=nd', 'tel' => '(019) 871 11', 'email' => 'niko.karttunen@perel.fi', 'maps' => 'https://www.google.com/maps/?q=60.61871591467061,24.81375982688589&sensor=true', 'address' => 'Torpankatu 28, 05830 Hyvinkää, Finland', 'territory' => 'Finland', 'cats' => ['industrial', 'din-rail', 'stocking', 'online-shop']],
            ['region' => 'Europe', 'name' => 'MECTER SL', 'website' => 'https://mecter.com/productos/delta/', 'tel' => '+34 93 422 71 85', 'email' => 'infos@mecter.com', 'maps' => 'https://www.google.com/maps/?q=41.35765998577143,2.11182639715283&sensor=true', 'address' => 'Ctra. del Mig, 53, 08907 L\'Hospitalet de Llobregat, Barcelona, Spain', 'territory' => 'Spain', 'cats' => ['industrial', 'medical', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'configurable', 'after-sales']],
            ['region' => 'Europe', 'name' => 'Electro Pneumatic Solutions DOO (EP-Solutions)', 'website' => 'https://www.ep-solutions.rs/en/delta', 'tel' => '+381 64 659 66 55', 'email' => 'office@ep-solutions.rs', 'maps' => 'https://www.google.com/maps/?q=44.726939816372486,20.363365214818206&sensor=true', 'address' => 'Jugoslovenska 2/13A, Čukarica, Beograd, Serbia', 'territory' => 'Serbia', 'cats' => ['industrial', 'medical', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'adapter', 'stocking', 'after-sales', 'online-shop']],
            ['region' => 'Europe', 'name' => 'EasyComp', 'website' => 'https://www.easycomp.nl/delta-power-supplies-nu-ook-bij-easycomp-als-officiele-distributeur-van-hoogwaardige-industriele-voedingen-en-led-drivers', 'tel' => '+31 318 70 13 43', 'email' => 'sales@easycomp.nl', 'maps' => 'https://www.google.com/maps/?q=52.03990904620167,5.568779097040344&sensor=true', 'address' => 'Stationsstraat 70, 3905 JK, Veenendaal, Nederland', 'territory' => 'the Netherlands', 'cats' => ['industrial', 'lighting', 'din-rail', 'panel-mount', 'led-driver', 'stocking', 'after-sales', 'online-shop']],
            ['region' => 'Europe', 'name' => 'Rutronik Elektronische Bauelemente Gmbh', 'website' => 'https://www.rutronik24.com/pgm/delta/industrial_power_supplies/dispsu/', 'tel' => '+49 7231 801-0', 'email' => 'svetozara.pencheva@rutronik.com', 'maps' => 'https://www.google.com/maps/?q=48.91324219568249,8.66692298213555&sensor=true', 'address' => 'Industriestraße 2, 75228 Ispringen, Germany', 'territory' => 'EMEA', 'cats' => ['industrial', 'medical', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'adapter', 'online-shop']],
            ['region' => 'Europe', 'name' => 'Milexia UK', 'website' => 'https://milexia.com/products/partner-listing/products-by-partner?partner=21310', 'tel' => '+44 (0)1256 812222', 'email' => 'sales-uk@milexia.com', 'maps' => 'https://www.google.com/maps/?q=51.29620902544404,-1.0639957951709709&sensor=true', 'address' => '3 Hazelwood, Lime Tree Way, Chineham Park, Basingstoke, Hampshire, RG24 8WZ', 'territory' => 'UK', 'cats' => ['industrial', 'medical', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'after-sales']],
            ['region' => 'Europe', 'name' => 'ACAL bfi', 'website' => 'https://www.acalbfi.com/partners/delta-electronics', 'tel' => '+31402507400', 'email' => 'contact-uk@acalbfi.com', 'maps' => 'https://www.google.com/maps/?q=51.45913126837615,5.3939525269070705&sensor=true', 'address' => 'Luchthavenweg 53, 5657 EA Eindhoven, Nederlands', 'territory' => 'EMEA', 'cats' => ['industrial', 'medical', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'wireless-charging-system', 'after-sales']],
            ['region' => 'Europe', 'name' => 'Bicker Elektronik GmbH', 'website' => 'https://www.bicker.de/en/products/industrial-power-supplies/din-rail?p=1', 'tel' => '+49 906 70595-42', 'email' => 'info@bicker.de', 'maps' => 'https://www.google.com/maps/?q=48.7065704946035,10.756299687966305&sensor=true', 'address' => 'Ludwig-Auer-Straße 23 86609 Donauwörth, Germany', 'territory' => 'Germany', 'cats' => ['industrial', 'medical', 'lighting', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'configurable', 'wireless-charging-system', 'adapter', 'led-driver', 'stocking', 'after-sales']],
            ['region' => 'Europe', 'name' => 'Günter Dienstleistungen GmbH', 'website' => 'https://www.guenter-psu.de/', 'tel' => '+49 (0) 7082 491350', 'email' => 'info@guenter-psu.de', 'maps' => 'https://www.google.com/maps/?q=48.8495794,8.5896599&sensor=true', 'address' => 'Poststr. 11, D-75305 Neuenbürg', 'territory' => 'Germany', 'cats' => ['medical', 'open-frame', 'enclosed', 'configurable', 'adapter', 'stocking', 'after-sales']],
            ['region' => 'Europe', 'name' => 'HorizonElectronics Ltd', 'website' => 'https://www.horizon-pss.com/', 'tel' => '972-3-9230091', 'email' => 'sales@horizon-pss.com', 'maps' => 'https://www.google.com/maps/place/Horizon+Electronics+Ltd./@32.0944906,34.8638862,15z/data=!4m6!3m5!1s0x151d361c62a1b265:0x8488d499a32fff60!8m2!3d32.0956532!4d34.866744!16s%2Fg%2F1tg96hbp', 'address' => '3 Bazel st. Kiryat Arie - Petah Tikva 4951037, Israel', 'territory' => 'Israel', 'cats' => ['medical', 'enclosed', 'configurable', 'adapter', 'stocking', 'after-sales']],
            ['region' => 'Europe', 'name' => 'Consystem Srl', 'website' => 'https://consystem.it/en/fornitori/delta', 'tel' => '+39024241471', 'email' => 'support@consystem.it', 'maps' => 'https://www.google.com/maps/?q=45.4560306133205,9.157509012662604&sensor=true', 'address' => 'Via E. Stendhal, 55 - 20144 Milan', 'territory' => 'Italy', 'cats' => ['industrial', 'din-rail', 'panel-mount']],
            ['region' => 'Europe', 'name' => 'Totem Electro srl', 'website' => 'https://www.totemelectro.com/delta/', 'tel' => '+39 02.28.85.111', 'email' => 'totem@totemelectro.com', 'maps' => 'https://www.google.com/maps/place/TOTEM+Electro/@45.4866653,9.223759,17z/data=!3m1!4b1!4m6!3m5!1s0x4786c6e4fa8f8259:0x386b18b0f9068c24!8m2!3d45.4866653!4d9.223759!16s%2Fg%2F1tdjvxb1', 'address' => 'Viale Lombardia, 66- 20131 Milano ITALIA', 'territory' => 'Italy', 'cats' => ['industrial', 'medical', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'stocking']],
            ['region' => 'Europe', 'name' => 'Swelex AB', 'website' => 'https://swelex.se/en/products/power-supply-relays/', 'tel' => '08-683 33 00', 'email' => 'info@swelex.se', 'maps' => 'https://www.google.com/maps/place/Swelex+AB/@59.2387374,18.1124826,17z/data=!3m1!4b1!4m6!3m5!1s0x465f7979ee691b4d:0x95996ae6d2cc4635!8m2!3d59.2387374!4d18.1124826!16s%2Fg%2F11vm9fpdtl', 'address' => 'Mårbackagatan 27- 123 43 Farsta', 'territory' => 'Sweden', 'cats' => ['industrial', 'medical', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'adapter', 'after-sales']],
            ['region' => 'Europe', 'name' => 'Direktronik AB', 'website' => 'https://www.direktronik.se/direktronik/stromforsorjning/nataggeragat-och-natdelar/', 'tel' => '+46 8 52 400 700', 'email' => 'info@direktronik.se', 'maps' => 'https://www.google.com/maps/place/Direktronik+AB/@58.9226379,17.9314174,17z/data=!3m1!4b1!4m6!3m5!1s0x465f5dcc137823e1:0x91c55efa39a4de46!8m2!3d58.9226379!4d17.9339923!16s%2Fg%2F1hc5pnmzh', 'address' => 'Konsul Johnsons väg 15, 149 45 Nynäshamn', 'territory' => 'Sweden', 'cats' => ['industrial', 'din-rail', 'online-shop']],
            ['region' => 'Japan', 'name' => 'RESTAR EMBEDDED SOLUTIONS Corporation', 'website' => 'https://www.res.restargp.com/', 'tel' => '+81-3-3502-2521', 'email' => '', 'maps' => 'https://www.google.com/maps/?q=35.6242679227968,139.74465476198964&sensor=true', 'address' => '2-10-9, Konan, Minato-ku, Tokyo 108-0075, Japan', 'territory' => 'Japan', 'cats' => ['industrial', 'medical', 'lighting', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'adapter', 'led-driver', 'after-sales']],
            ['region' => 'Korea', 'name' => 'Bluecosmos', 'website' => 'http://www.bluecosmos.co.kr', 'tel' => '+82-32-662-2350', 'email' => 'shawn.yoon@bluecosmos.co.kr', 'maps' => 'https://www.google.com/maps/?q=37.50025251346668,126.78940941796873&sensor=true', 'address' => 'Chunui Techno Tower 4F RM 404, 80 Jomaru-ro 385 Beongil, Bucheon-si, Gyeonggi-do, Korea', 'territory' => 'Korea', 'cats' => ['medical']],
            ['region' => 'Korea', 'name' => 'One Corporation', 'website' => 'www.onecorp.co.kr', 'tel' => '+82-3283-4105', 'email' => 'sam@onecorp.co.kr', 'maps' => 'https://www.google.com/maps/?q=37.48118615695118,126.87606330926208&sensor=true', 'address' => '1302, 648, Seobusaet-Gil, Geumcheon-Gu, Seoul, Korea, 08504', 'territory' => 'Korea', 'cats' => ['industrial', 'panel-mount', 'open-frame', 'enclosed', 'configurable', 'adapter', 'stocking']],
            ['region' => 'Korea', 'name' => 'UNITRONTECH Co., Ltd.', 'website' => 'http://www.unitrontech.com/', 'tel' => '+82-2-573-6800', 'email' => 'anthony@unitrontech.com', 'maps' => 'https://www.google.com/maps/?q=37.51743277297858,127.05927335773093&sensor=true', 'address' => 'Sambo Bldg 9F, 638, Yeongdong-daero, Gangnam-gu, Seoul, Republic of Korea, 06080', 'territory' => 'Korea', 'cats' => ['industrial', 'din-rail', 'panel-mount', 'open-frame', 'adapter', 'stocking']],
            ['region' => 'SEA', 'name' => 'Electronics Source Co.,Ltd.', 'website' => 'http://www.es.co.th', 'tel' => '+66 2 0624970', 'email' => 'info@es.co.th', 'maps' => 'https://www.google.com/maps/?q=13.7746324,100.5432432&sensor=true', 'address' => '256 Floor 5 and 6 Phahonyothin Road, Sam Sen Nai, Phayathai, Bangkok 10400, Thailand', 'territory' => 'Thailand', 'cats' => ['din-rail', 'panel-mount', 'open-frame', 'adapter', 'stocking']],
            ['region' => 'Taiwan', 'name' => 'ACE PILLAR CO., LTD.', 'website' => 'www.acepillar.com', 'tel' => '+886 2-2995-8400', 'email' => 'sales@acepillar.com.tw', 'maps' => 'https://maps.app.goo.gl/BqdrcKoghmTH5KZp9', 'address' => '2F, No.7, Ln 83, Sec. 1, Guangfu Rd., Sanchong Dist., New Taipei City 241, Taiwan, R.O.C.', 'territory' => 'Taiwan', 'cats' => ['industrial', 'medical', 'lighting', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'configurable', 'adapter', 'led-driver', 'stocking', 'after-sales', 'online-shop']],
            ['region' => 'Taiwan', 'name' => 'Faith Automation Enterprise, Co., Ltd.', 'website' => 'www.faith.com.tw', 'tel' => '+886 2 2299 7828', 'email' => 'master@faith.com.tw', 'maps' => 'https://www.google.com/maps/?q=25.066093,121.447911&sensor=true', 'address' => 'No.10, Wuchuan 7th Rd., Wugu Dist., New Taipei City 24890, Taiwan (R.O.C)', 'territory' => 'Taiwan', 'cats' => ['industrial', 'lighting', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'configurable', 'adapter', 'led-driver', 'stocking', 'after-sales']],
            ['region' => 'Taiwan', 'name' => 'NINE BIG Co., Ltd.', 'website' => 'www.tdk-ninebig.com.tw', 'tel' => '+886 4-2258-9900', 'email' => 'ninebig@tdk-ninebig.com.tw,  sales@tdk-ninebig.com.tw', 'maps' => 'https://www.google.com/maps/?q=24.15185,120.64546&sensor=true', 'address' => 'No. 85,Dajeng St.,Taichung,Taiwan 40862', 'territory' => 'Taiwan', 'cats' => ['industrial', 'medical', 'lighting', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'configurable', 'wireless-charging-system', 'adapter', 'led-driver', 'stocking', 'after-sales', 'online-shop']],
            ['region' => 'Taiwan', 'name' => 'Honya Electronic Co., Ltd.', 'website' => 'www.honyabiz.com.tw', 'tel' => '+886 2 2785-6812', 'email' => 'honya@honyabiz.com.tw', 'maps' => 'https://www.google.com/maps/?q=25.052994494934335,121.58797359112621&sensor=true', 'address' => '8F., No. 99, Sec. 3, Nangang Rd., Nangang Dist., Taipei City , Taiwan (R.O.C.)', 'territory' => 'Taiwan', 'cats' => ['industrial', 'medical', 'lighting', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'configurable', 'adapter', 'led-driver', 'after-sales']],
            ['region' => 'Taiwan', 'name' => 'O-DEAR INTERNATIONAL CORP.', 'website' => 'www.e-odear.com.tw', 'tel' => '+886 2-8512-2893', 'email' => 'odear@e-odear.com.tw', 'maps' => 'https://www.google.com/maps/?q=,&sensor=true', 'address' => '4F., No. 123, Xingde Rd., Sanchong Dist., New Taipei City 241 , Taiwan (R.O.C.)', 'territory' => 'Taiwan', 'cats' => ['industrial', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'adapter', 'after-sales']],
            ['region' => 'China', 'name' => 'Shenzhen BDW Electric Co., Ltd', 'website' => 'www.bdwdq.com', 'tel' => '+86 13 622348987, +86 13 925264925', 'email' => 'yebin@bdwasia.com', 'maps' => 'https://www.google.com/maps/?q=22.635892521021834,114.06736899731423&sensor=true', 'address' => 'Room 2805, 28th floor, Building F, Galaxy WORLD, Yabao Road No.1, BanTian Street, Longgang District, Shenzhen', 'territory' => 'China', 'cats' => []],
            ['region' => 'China', 'name' => 'Beijing Zhonghai Jia Technology Co., Ltd.', 'website' => 'www.zhjpower.net', 'tel' => '+86 18 911125003', 'email' => 'zyy369369@126.com', 'maps' => 'https://www.google.com/maps/?q=40.036521910125046,116.33642691311012&sensor=true', 'address' => 'Room 522, Building 8, No.16, Xiaoying West Road, Qinghe Town, Haiding District, Beijing', 'territory' => 'China', 'cats' => []],
            ['region' => 'China', 'name' => 'Shenzhen AJC Electronics Co., Ltd.', 'website' => 'www.ajc-ele.com', 'tel' => '+86 13 425119012', 'email' => 'xiayf@ajc-ele.com', 'maps' => 'https://www.google.com/maps/?q=22.577744236991087,114.05932787417323&sensor=true', 'address' => '17A, Fusen Building, Huaxia 2nd Road, Dongzhou Community, Guangming Street, Guangming New District, Shenzhen', 'territory' => 'China', 'cats' => []],
            ['region' => 'China', 'name' => 'ShenZhen CESTAR Electronic Technology Co., Ltd.', 'website' => 'http://www.ce-power.com', 'tel' => '+86 755 82531600', 'email' => 'lina.lv@ce-power.com', 'maps' => 'http://www.ce-power.com', 'address' => 'No.1 Building, De tai Industrial Zone, No. 496, Huarong Road, Dalang, Longhua District, Shenzhen', 'territory' => 'China', 'cats' => []],
            ['region' => 'Europe', 'name' => 'Energom electronic kft', 'website' => 'https://www.energom.hu/', 'tel' => '+36 1 459 8010', 'email' => 'ajanlatkeres@energom.hu', 'maps' => 'https://www.google.com/maps/place/data=!4m2!3m1!1s0x4741dcee45cf952b:0x4b853c4117737c18?sa=X&ved=1t:8290&ictx=111', 'address' => 'Budapest, Komáromi út 28, 1142 Hungary', 'territory' => 'Hungary', 'cats' => ['industrial', 'medical', 'lighting', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'configurable', 'wireless-charging-system', 'adapter', 'led-driver', 'stocking', 'after-sales', 'online-shop']],
            ['region' => 'Europe', 'name' => 'Futura Electronics Ltd', 'website' => 'https://www.futura.ie/', 'tel' => '3538020044', 'email' => 'sales@futura.ie', 'maps' => 'https://www.google.com/maps/place/data=!4m2!3m1!1s0x486722c3ca2d833d:0xa0c57346c5b994e7?sa=X&ved=1t:8290&ictx=111', 'address' => 'Units 3 & 4, Balbriggan Business Park, Clonard Or Folkstown Great, Balbriggan, Co. Dublin, K32 YV96, Ireland', 'territory' => 'Ireland', 'cats' => ['industrial', 'medical', 'lighting', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'configurable', 'wireless-charging-system', 'adapter', 'stocking', 'after-sales', 'online-shop']],
            ['region' => 'Europe', 'name' => 'Sunpower Group Holdings Ltd', 'website' => 'https://www.sunpowergroupholdings.com', 'tel' => '+44 118 982 3745', 'email' => '', 'maps' => 'https://www.google.com/maps/place/data=!4m2!3m1!1s0x4876a041d80e1405:0x4606dbb30bf67847?sa=X&ved=1t:8290&ictx=111', 'address' => 'Sunpower Group Holdings Ltd, Orion House, Calleva Park, Aldermaston, Reading RG7 8SN, United Kingdom', 'territory' => 'UK', 'cats' => ['industrial', 'medical', 'lighting', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'configurable', 'wireless-charging-system', 'adapter', 'led-driver', 'stocking', 'after-sales', 'online-shop']],
        ];
    }
}
