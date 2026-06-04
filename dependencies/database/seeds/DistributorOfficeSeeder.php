<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * 匯入 PSBG 授權經銷商（office, type_id=2），來源：2025 deltapsu Distributor filter.xlsx「Data」分頁。
 *
 * - 各語系一律先填英文，實際在地化由客戶後台逐一處理（比照 DistributorCategorySeeder）。
 * - 須在 DistributorCategorySeeder 之後執行（分類 slug 需先存在）。
 * - Idempotent：同名經銷商（en title）跳過、同 slug territory 跳過、pivot 已存在不重複插入。
 *   Excel 的 Certification 欄全空，故不處理。
 */
class DistributorOfficeSeeder extends Seeder
{
    public function run()
    {
        $locales = DB::table('language')->pluck('name')->toArray();

        // Excel region → continents.id（type_id=2）。SEA 實為泰國曼谷經銷商 → Thailand。
        $regionToContinent = [
            'Americas' => 2, 'Europe' => 4, 'Japan' => 5, 'Korea' => 9,
            'SEA' => 11, 'Taiwan' => 12, 'China' => 13,
        ];

        // Online shop 不在 DistributorCategorySeeder 的啟用清單 → 確保存在但停用(status=0)，以保留 Excel 的勾選資料。
        $this->ensureCategory('distributor_service', 'online-shop', 'Online Shop', 0, $locales);

        // Excel J–W 的勾選分類分散在這 3 張「打勾型」分類表（sales_territory / certification 另行處理）。
        // 一次建好 slug → {pivot, id}：分類定義以 DB 為單一來源，pivot 推導讀 config/distributor.php（與全站同一套規則）。
        $catIndex = [];
        foreach (['distributor_specialized_application', 'distributor_product_line', 'distributor_service'] as $table) {
            $pivot = config("distributor.categories.{$table}.pivot");
            foreach (DB::table($table)->pluck('id', 'slug') as $slug => $id) {
                $catIndex[$slug] = ['pivot' => $pivot, 'id' => $id];
            }
        }

        foreach ($this->rows() as $r) {
            $continentId = $regionToContinent[$r['region']] ?? null;

            // office：同名(en title) + type_id=2 視為已存在 → 跳過建立
            $officeId = DB::table('office as o')
                ->join('office_translations as ot', 'o.id', '=', 'ot.fk_office_id')
                ->where('o.type_id', 2)->where('ot.local', 'en')->where('ot.title', $r['name'])
                ->value('o.id');

            if (!$officeId) {
                $officeId = DB::table('office')->insertGetId([
                    'type_id' => 2,
                    'status' => 1,
                    'continent_id' => $continentId,
                    'website' => $r['website'] ?: null,
                    'telephone' => $r['tel'] ?: null,
                    'email' => $r['email'] ?: null,
                    'google_maps' => $r['maps'] ?: null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                foreach ($locales as $local) {
                    DB::table('office_translations')->insert([
                        'fk_office_id' => $officeId,
                        'local' => $local,
                        'title' => $r['name'],
                        'sub_title' => '',
                        'content' => $r['address'],
                    ]);
                }
                echo "Created distributor: {$r['name']}\n";
            }

            // Sales territory（以 ; 分隔）→ find-or-create + 掛 pivot
            foreach (preg_split('/\s*;\s*/', $r['territory'], -1, PREG_SPLIT_NO_EMPTY) as $terrName) {
                $slug = Str::slug($terrName) ?: ('territory-' . Str::slug($terrName, '-', null));
                $terrId = DB::table('distributor_sales_territory')->where('slug', $slug)->value('id');
                if (!$terrId) {
                    $terrId = DB::table('distributor_sales_territory')->insertGetId([
                        'slug' => $slug,
                        'continent_id' => $continentId,
                        'status' => 1,
                        'order_seq' => 0,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    foreach ($locales as $local) {
                        DB::table('distributor_sales_territory_translation')->insert([
                            'fk_id' => $terrId,
                            'name' => $terrName,
                            'local' => $local,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                }
                $this->link('office_has_sales_territory', $officeId, $terrId);
            }

            // 分類勾選（J–W）→ 掛各 pivot
            foreach ($r['cats'] as $slug) {
                if (!isset($catIndex[$slug])) { continue; }
                $this->link($catIndex[$slug]['pivot'], $officeId, $catIndex[$slug]['id']);
            }
        }
    }

    /** pivot 去重插入 */
    private function link($pivot, $officeId, $categoryId)
    {
        $exists = DB::table($pivot)
            ->where('office_id', $officeId)->where('category_id', $categoryId)->exists();
        if (!$exists) {
            DB::table($pivot)->insert([
                'office_id' => $officeId,
                'category_id' => $categoryId,
                'created_at' => now(),
                'updated_at' => now(),
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

    /** @return array<int,array<string,mixed>> 來源：Excel「Data」分頁，56 筆（已去 2 筆 Sample） */
    private function rows()
    {
        return [
            ['region' => 'Americas', 'name' => 'Arrow Electronics, Inc.', 'website' => 'www.arrow.com/en/products/manufacturers/d/delta-electronics', 'tel' => '+1 800 833 3557', 'email' => 'advantagesales@arrow.com', 'maps' => 'https://www.google.com/maps/?q=48.146118,11.689726&sensor=true', 'address' => '9201 East Dry Creek Road, Centennial, CO 80112', 'territory' => 'US', 'cats' => ['industrial', 'medical', 'lighting', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'configurable', 'adapter', 'led-driver', 'stocking', 'after-sales', 'online-shop']],
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
            ['region' => 'Europe', 'name' => 'MEV Elektronik Service GmbH', 'website' => 'https://www.mev-elektronik.com/lieferanten/delta', 'tel' => '+49 (0) 54 24 23 40-0, +49 (0) 54 24 23 40-0', 'email' => 'info@mev-elektronik.com', 'maps' => 'https://www.google.com/maps/?q=52.13207698805076,8.157520455335362&sensor=true', 'address' => 'Nordel 5a, 49176 Hilter a.T.W., 49176 Germany', 'territory' => 'Germany', 'cats' => ['industrial', 'medical', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'configurable', 'adapter', 'after-sales']],
            ['region' => 'Europe', 'name' => 'FORTEC Switzerland', 'website' => 'https://www.fortec.ch/de', 'tel' => '+41447446111', 'email' => 'info@fortec.ch', 'maps' => 'https://www.google.com/maps/?q=47.44554,8.35982&sensor=true', 'address' => 'Bahnhofstrasse 3, CH-5436 Würenlos, Switzerland', 'territory' => 'Switzerland', 'cats' => ['industrial', 'medical', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'configurable', 'wireless-charging-system', 'stocking', 'after-sales']],
            ['region' => 'Europe', 'name' => 'Fortec Power GmbH', 'website' => 'https://www.fortec.ch/de', 'tel' => '+41447446111', 'email' => 'info@fortec.ch', 'maps' => '', 'address' => 'Bahnhofstrasse 3, CH-5436 Würenlos, Switzerland', 'territory' => '', 'cats' => []],
            ['region' => 'Europe', 'name' => 'Elgood Oy', 'website' => 'Power Supplies - Elgood', 'tel' => '+358207981140', 'email' => 'joonas.holviala@elgood.fi', 'maps' => 'https://www.google.com/maps/?q=60.29145511755065,24.991059555406295&sensor=true', 'address' => 'Juurakkotie 5B, 01510 VANTAA, Finland', 'territory' => 'Finland', 'cats' => ['industrial', 'medical', 'panel-mount', 'enclosed', 'wireless-charging-system', 'adapter', 'stocking', 'after-sales']],
            ['region' => 'Europe', 'name' => 'Future Electronics', 'website' => 'https://www.futureelectronics.com/c/electromechanical/power-supplies--ac-dc/products?q=Delta:relevance:manufacturerName:Delta', 'tel' => '+44 1784 275000', 'email' => '', 'maps' => 'https://www.google.com/maps/?q=51.434555085391,-0.5340554255271626&sensor=true', 'address' => 'The Glanty, Egham, Surrey, United Kingdom TW20 9AH', 'territory' => 'EMEA', 'cats' => ['industrial', 'medical', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'after-sales']],
            ['region' => 'Europe', 'name' => 'Luso Electronics', 'website' => 'https://www.lusoelectronics.com/manufacturers/delta-electronics/', 'tel' => '+44 (0) 207 588 1109', 'email' => 'sales@lusoelectronics.com', 'maps' => 'https://www.google.com/maps/?q=51.51743904690537,-0.08743432222106894&sensor=true', 'address' => '595 Salisbury House, London Wall, London EC2M 5QQ, United Kingdom', 'territory' => 'UK', 'cats' => ['industrial', 'medical', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'configurable', 'adapter', 'stocking', 'after-sales']],
            ['region' => 'Europe', 'name' => 'Steliau Technology', 'website' => 'Delta | Steliau', 'tel' => '+33 (0)1 55 58 04 04', 'email' => 'contact@steliau.fr', 'maps' => 'https://www.google.com/maps/?q=48.81408188816697,2.3159843953288815&sensor=true', 'address' => 'A. 41/43 rue Périer 92120 Montrouge France', 'territory' => 'France', 'cats' => ['industrial', 'medical', 'panel-mount', 'open-frame', 'enclosed', 'configurable', 'adapter', 'stocking', 'after-sales']],
            ['region' => 'Europe', 'name' => 'AE Service', 'website' => 'https://aeservice.fr/product/delta-electronics', 'tel' => '+33(0)4 77 41 21 47', 'email' => 'aeservice@aeservice.fr', 'maps' => 'https://www.google.com/maps/?q=45.4098957639448,4.364581425446536&sensor=true', 'address' => '1 rue des Cytises, ZAC de Montrambert Pigeot, 42150 La Ricamarie, France', 'territory' => 'France', 'cats' => ['industrial', 'medical', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'stocking']],
            ['region' => 'Europe', 'name' => 'Arrow Central Europe Gmbh', 'website' => 'https://www.arrow.com/en/manufacturers/delta-electronics', 'tel' => '+49231218010', 'email' => '', 'maps' => 'https://www.google.com/maps/?q=51.53185808667624,7.630207495529387&sensor=true', 'address' => 'Hildebrandstraße 11, 44319 Dortmund, Germany', 'territory' => 'EMEA', 'cats' => ['industrial', 'medical', 'lighting', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'configurable', 'wireless-charging-system', 'adapter', 'led-driver', 'after-sales']],
            ['region' => 'Europe', 'name' => 'Elektrospoji d.o.o.', 'website' => 'Delta Electronics | Delta IABG | Electrical Connections - Electrical Connections', 'tel' => '+386 (1) 511 38 10', 'email' => 'info@elektrospoji.si', 'maps' => 'https://www.google.com/maps/?q=46.08826754983997,14.481887012689942&sensor=true', 'address' => 'Stegne 27, 1000 Ljubljana, Slovenia', 'territory' => 'Slovenia', 'cats' => ['industrial', 'medical', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'configurable', 'stocking', 'after-sales']],
            ['region' => 'Europe', 'name' => 'Verbax', 'website' => 'https://www.verbax.it/en/manufacturer/delta', 'tel' => '+39 0426 270021', 'email' => 'sales@verbax.it', 'maps' => 'https://www.google.com/maps/?q=45.66816121266383,12.229088083836702&sensor=true', 'address' => 'Piazza delle, Istituzioni 39F, 31100 Treviso, Italia', 'territory' => 'Italy', 'cats' => ['lighting', 'led-driver', 'online-shop']],
            ['region' => 'Europe', 'name' => 'Perel Oy', 'website' => 'AC/DC Power Supplies for DIN Rail | Power Supplies | Power Supplies | Automation Components | Perel Ltd', 'tel' => '(019) 871 11', 'email' => 'niko.karttunen@perel.fi', 'maps' => 'https://www.google.com/maps/?q=60.61871591467061,24.81375982688589&sensor=true', 'address' => 'Torpankatu 28, 05830 Hyvinkää, Finland', 'territory' => 'Finland', 'cats' => ['industrial', 'din-rail', 'stocking', 'online-shop']],
            ['region' => 'Europe', 'name' => 'MECTER SL', 'website' => 'Distribuidor de componentes electrónicos: DELTA', 'tel' => '+34 93 422 71 85', 'email' => 'infos@mecter.com', 'maps' => 'https://www.google.com/maps/?q=41.35765998577143,2.11182639715283&sensor=true', 'address' => 'Ctra. del Mig, 53, 08907 L\'Hospitalet de Llobregat, Barcelona, Spain', 'territory' => 'Spain', 'cats' => ['industrial', 'medical', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'configurable', 'after-sales']],
            ['region' => 'Europe', 'name' => 'Electro Pneumatic Solutions DOO (EP-Solutions)', 'website' => 'https://www.ep-solutions.rs/en/delta', 'tel' => '+381 64 659 66 55', 'email' => 'office@ep-solutions.rs', 'maps' => 'https://www.google.com/maps/?q=44.726939816372486,20.363365214818206&sensor=true', 'address' => 'Jugoslovenska 2/13A, Čukarica, Beograd, Serbia', 'territory' => 'Serbia', 'cats' => ['industrial', 'medical', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'adapter', 'stocking', 'after-sales', 'online-shop']],
            ['region' => 'Europe', 'name' => 'EasyComp', 'website' => 'https://www.easycomp.nl/delta-power-supplies-nu-ook-bij-easycomp-als-officiele-distributeur-van-hoogwaardige-industriele-voedingen-en-led-drivers', 'tel' => '+31 318 70 13 43', 'email' => 'sales@easycomp.nl', 'maps' => 'https://www.google.com/maps/?q=52.03990904620167,5.568779097040344&sensor=true', 'address' => 'Stationsstraat 70, 3905 JK, Veenendaal, Nederland', 'territory' => 'the Netherlands', 'cats' => ['industrial', 'lighting', 'din-rail', 'panel-mount', 'led-driver', 'stocking', 'after-sales', 'online-shop']],
            ['region' => 'Europe', 'name' => 'Rutronik Elektronische Bauelemente Gmbh', 'website' => 'DELTA Industrial Power Supplies | Rutronik24 Distributor', 'tel' => '+49 7231 801-0', 'email' => 'svetozara.pencheva@rutronik.com', 'maps' => 'https://www.google.com/maps/?q=48.91324219568249,8.66692298213555&sensor=true', 'address' => 'Industriestraße 2, 75228 Ispringen, Germany', 'territory' => 'EMEA', 'cats' => ['industrial', 'medical', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'adapter', 'online-shop']],
            ['region' => 'Europe', 'name' => 'Milexia UK', 'website' => 'Products by Partner | Milexia Products', 'tel' => '+44 (0)1256 812222', 'email' => 'sales-uk@milexia.com', 'maps' => 'https://www.google.com/maps/?q=51.29620902544404,-1.0639957951709709&sensor=true', 'address' => '3 Hazelwood, Lime Tree Way, Chineham Park, Basingstoke, Hampshire, RG24 8WZ', 'territory' => 'UK', 'cats' => ['industrial', 'medical', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'after-sales']],
            ['region' => 'Europe', 'name' => 'ACAL bfi', 'website' => 'https://www.acalbfi.com/partners/delta-electronics', 'tel' => '+31402507400', 'email' => 'contact-uk@acalbfi.com', 'maps' => 'https://www.google.com/maps/?q=51.45913126837615,5.3939525269070705&sensor=true', 'address' => 'Luchthavenweg 53, 5657 EA Eindhoven, Nederlands', 'territory' => 'EMEA', 'cats' => ['industrial', 'medical', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'wireless-charging-system', 'after-sales']],
            ['region' => 'Europe', 'name' => 'Bicker Elektronik GmbH', 'website' => 'https://www.bicker.de/en/products/industrial-power-supplies/din-rail?p=1', 'tel' => '+49 906 70595-42', 'email' => 'info@bicker.de', 'maps' => 'https://www.google.com/maps/?q=48.7065704946035,10.756299687966305&sensor=true', 'address' => 'Ludwig-Auer-Straße 23 86609 Donauwörth, Germany', 'territory' => 'Germany', 'cats' => ['industrial', 'medical', 'lighting', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'configurable', 'wireless-charging-system', 'adapter', 'led-driver', 'stocking', 'after-sales']],
            ['region' => 'Europe', 'name' => 'Günter Dienstleistungen GmbH', 'website' => 'https://www.guenter-psu.de/', 'tel' => '+49 (0) 7082 491350', 'email' => 'info@guenter-psu.de', 'maps' => 'https://www.google.com/maps/?q=48.8495794,8.5896599&sensor=true', 'address' => 'Poststr. 11, D-75305 Neuenbürg', 'territory' => 'Germany', 'cats' => ['medical', 'open-frame', 'enclosed', 'configurable', 'adapter', 'stocking', 'after-sales']],
            ['region' => 'Europe', 'name' => 'HorizonElectronics Ltd', 'website' => 'Advanced Power Supply Solutions | Horizon Electronics', 'tel' => '972-3-9230091', 'email' => 'sales@horizon-pss.com', 'maps' => '3 Bazel st. Kiryat Arie Petah Tikva 4951037, Israel - Google Maps', 'address' => '3 Bazel st. Kiryat Arie - Petah Tikva 4951037, Israel', 'territory' => 'Israel', 'cats' => ['medical', 'enclosed', 'configurable', 'adapter', 'stocking', 'after-sales']],
            ['region' => 'Europe', 'name' => 'Consystem Srl', 'website' => 'https://consystem.it/en/fornitori/delta', 'tel' => '+39024241471', 'email' => 'support@consystem.it', 'maps' => 'https://www.google.com/maps/?q=45.4560306133205,9.157509012662604&sensor=true', 'address' => 'Via E. Stendhal, 55 - 20144 Milan', 'territory' => 'Italy', 'cats' => ['industrial', 'din-rail', 'panel-mount']],
            ['region' => 'Europe', 'name' => 'Totem Electro srl', 'website' => 'Distributore Delta PSU | Totem Electro framework', 'tel' => '+39 02.28.85.111', 'email' => 'totem@totemelectro.com', 'maps' => 'TOTEM Electro - Google Maps', 'address' => 'Viale Lombardia, 66- 20131 Milano ITALIA', 'territory' => 'Italy', 'cats' => ['industrial', 'medical', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'stocking']],
            ['region' => 'Europe', 'name' => 'Swelex AB', 'website' => 'Power supply - SWELEX', 'tel' => '08-683 33 00', 'email' => 'info@swelex.se', 'maps' => 'Swelex AB - Google Maps', 'address' => 'Mårbackagatan 27- 123 43 Farsta', 'territory' => 'Sweden', 'cats' => ['industrial', 'medical', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'adapter', 'after-sales']],
            ['region' => 'Europe', 'name' => 'Direktronik AB', 'website' => 'Power Aggregates and Power Supplies - Direktronik AB', 'tel' => '+46 8 52 400 700', 'email' => 'info@direktronik.se', 'maps' => 'Direktronik AB - Google Maps', 'address' => 'Konsul Johnsons väg 15, 149 45 Nynäshamn', 'territory' => 'Sweden', 'cats' => ['industrial', 'din-rail', 'online-shop']],
            ['region' => 'Japan', 'name' => 'RESTAR EMBEDDED SOLUTIONS Corporation', 'website' => 'https://www.res.restargp.com/', 'tel' => '+81-3-3502-2521', 'email' => '', 'maps' => 'https://www.google.com/maps/?q=35.6242679227968,139.74465476198964&sensor=true', 'address' => '2-10-9, Konan, Minato-ku, Tokyo 108-0075, Japan', 'territory' => 'Japan', 'cats' => ['industrial', 'medical', 'lighting', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'adapter', 'led-driver', 'after-sales']],
            ['region' => 'Korea', 'name' => 'Bluecosmos', 'website' => 'http://www.bluecosmos.co.kr', 'tel' => '+82-32-662-2350', 'email' => 'shawn.yoon@bluecosmos.co.kr', 'maps' => 'https://www.google.com/maps/?q=37.50025251346668,126.78940941796873&sensor=true', 'address' => 'Chunui Techno Tower 4F RM 404, 80 Jomaru-ro 385 Beongil, Bucheon-si, Gyeonggi-do, Korea', 'territory' => 'Korea', 'cats' => ['medical']],
            ['region' => 'Korea', 'name' => 'One Corporation', 'website' => 'www.onecorp.co.kr', 'tel' => '+82-3283-4105', 'email' => 'sam@onecorp.co.kr', 'maps' => 'https://www.google.com/maps/?q=37.48118615695118,126.87606330926208&sensor=true', 'address' => '1302, 648, Seobusaet-Gil, Geumcheon-Gu, Seoul, Korea, 08504', 'territory' => 'Korea', 'cats' => ['industrial', 'panel-mount', 'open-frame', 'enclosed', 'configurable', 'adapter', 'stocking']],
            ['region' => 'Korea', 'name' => 'UNITRONTECH Co., Ltd.', 'website' => 'http://www.unitrontech.com/', 'tel' => '+82-2-573-6800', 'email' => 'anthony@unitrontech.com', 'maps' => 'https://www.google.com/maps/?q=37.51743277297858,127.05927335773093&sensor=true', 'address' => 'Sambo Bldg 9F, 638, Yeongdong-daero, Gangnam-gu, Seoul, Republic of Korea, 06080', 'territory' => 'Korea', 'cats' => ['industrial', 'din-rail', 'panel-mount', 'open-frame', 'adapter', 'stocking']],
            ['region' => 'SEA', 'name' => 'Electronics Source Co.,Ltd.', 'website' => 'http://www.es.co.th', 'tel' => '+66 2 0624970', 'email' => 'info@es.co.th', 'maps' => 'https://www.google.com/maps/?q=13.7746324,100.5432432&sensor=true', 'address' => '256 Floor 5 and 6 Phahonyothin Road, Sam Sen Nai, Phayathai, Bangkok 10400, Thailand', 'territory' => 'Thailand', 'cats' => ['din-rail', 'panel-mount', 'open-frame', 'adapter', 'stocking']],
            ['region' => 'Taiwan', 'name' => 'ACE PILLAR CO., LTD.', 'website' => 'www.acepillar.com', 'tel' => '+886 2-2995-8400', 'email' => 'sales@acepillar.com.tw', 'maps' => 'https://maps.app.goo.gl/BqdrcKoghmTH5KZp9', 'address' => '2F, No.7, Ln 83, Sec. 1, Guangfu Rd., Sanchong Dist., New Taipei City 241, Taiwan, R.O.C.', 'territory' => 'Taiwan', 'cats' => ['industrial', 'medical', 'lighting', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'configurable', 'adapter', 'led-driver', 'stocking', 'after-sales', 'online-shop']],
            ['region' => 'Taiwan', 'name' => 'Faith Automation Enterprise, Co., Ltd.', 'website' => 'www.faith.com.tw', 'tel' => '+886 2 2299 7828', 'email' => 'master@faith.com.tw', 'maps' => 'https://www.google.com/maps/?q=25.066093,121.447911&sensor=true', 'address' => 'No.10, Wuchuan 7th Rd., Wugu Dist., New Taipei City 24890, Taiwan (R.O.C)', 'territory' => 'Taiwan', 'cats' => ['industrial', 'lighting', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'configurable', 'adapter', 'led-driver', 'stocking', 'after-sales']],
            ['region' => 'Taiwan', 'name' => 'NINE BIG Co., Ltd.', 'website' => 'www.tdk-ninebig.com.tw', 'tel' => '+886 4-2258-9900', 'email' => 'ninebig@tdk-ninebig.com.tw, sales@tdk-ninebig.com.tw', 'maps' => 'https://www.google.com/maps/?q=24.15185,120.64546&sensor=true', 'address' => 'No. 85,Dajeng St.,Taichung,Taiwan 40862', 'territory' => 'Taiwan', 'cats' => ['industrial', 'medical', 'lighting', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'configurable', 'wireless-charging-system', 'adapter', 'led-driver', 'stocking', 'after-sales', 'online-shop']],
            ['region' => 'Taiwan', 'name' => 'Honya Electronic Co., Ltd.', 'website' => 'www.honyabiz.com.tw', 'tel' => '+886 2 2785-6812', 'email' => 'honya@honyabiz.com.tw', 'maps' => 'https://www.google.com/maps/?q=25.052994494934335,121.58797359112621&sensor=true', 'address' => '8F., No. 99, Sec. 3, Nangang Rd., Nangang Dist., Taipei City , Taiwan (R.O.C.)', 'territory' => 'Taiwan', 'cats' => ['industrial', 'medical', 'lighting', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'configurable', 'adapter', 'led-driver', 'after-sales']],
            ['region' => 'Taiwan', 'name' => 'O-DEAR INTERNATIONAL CORP.', 'website' => 'www.e-odear.com.tw', 'tel' => '+886 2-8512-2893', 'email' => 'odear@e-odear.com.tw', 'maps' => 'https://www.google.com/maps/?q=,&sensor=true', 'address' => '4F., No. 123, Xingde Rd., Sanchong Dist., New Taipei City 241 , Taiwan (R.O.C.)', 'territory' => 'Taiwan', 'cats' => ['industrial', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'adapter', 'after-sales']],
            ['region' => 'China', 'name' => 'Shenzhen BDW Electric Co., Ltd', 'website' => 'www.bdwdq.com', 'tel' => '+86 13 622348987, +86 13 925264925', 'email' => 'yebin@bdwasia.com', 'maps' => 'https://www.google.com/maps/?q=22.635892521021834,114.06736899731423&sensor=true', 'address' => 'Room 2805, 28th floor, Building F, Galaxy WORLD, Yabao Road No.1, BanTian Street, Longgang District, Shenzhen', 'territory' => 'China', 'cats' => []],
            ['region' => 'China', 'name' => 'Beijing Zhonghai Jia Technology Co., Ltd.', 'website' => 'www.zhjpower.net', 'tel' => '+86 18 911125003', 'email' => 'zyy369369@126.com', 'maps' => 'https://www.google.com/maps/?q=40.036521910125046,116.33642691311012&sensor=true', 'address' => 'Room 522, Building 8, No.16, Xiaoying West Road, Qinghe Town, Haiding District, Beijing', 'territory' => 'China', 'cats' => []],
            ['region' => 'China', 'name' => 'Shenzhen AJC Electronics Co., Ltd.', 'website' => 'www.ajc-ele.com', 'tel' => '+86 13 425119012', 'email' => 'xiayf@ajc-ele.com', 'maps' => 'https://www.google.com/maps/?q=22.577744236991087,114.05932787417323&sensor=true', 'address' => '17A, Fusen Building, Huaxia 2nd Road, Dongzhou Community, Guangming Street, Guangming New District, Shenzhen', 'territory' => 'China', 'cats' => []],
            ['region' => 'China', 'name' => 'ShenZhen CESTAR Electronic Technology Co., Ltd.', 'website' => 'http://www.ce-power.com', 'tel' => '+86 755 82531600', 'email' => 'lina.lv@ce-power.com', 'maps' => 'http://www.ce-power.com', 'address' => 'No.1 Building, De tai Industrial Zone, No. 496, Huarong Road, Dalang, Longhua District, Shenzhen', 'territory' => 'China', 'cats' => []],
            ['region' => 'Europe', 'name' => 'Energom electronic kft', 'website' => 'Energom : akkumulátor, inverter, tápegység forgalmazás ipari és orvosi területekre is', 'tel' => '+36 1 459 8010', 'email' => 'ajanlatkeres@energom.hu', 'maps' => '', 'address' => 'Budapest, Komáromi út 28, 1142 Hungary', 'territory' => 'Hungary', 'cats' => ['industrial', 'medical', 'lighting', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'configurable', 'wireless-charging-system', 'adapter', 'led-driver', 'stocking', 'after-sales', 'online-shop']],
            ['region' => 'Europe', 'name' => 'Futura Electronics Ltd', 'website' => 'Electronic and Electrical Components - Futura.ie', 'tel' => '3538020044', 'email' => 'sales@futura.ie', 'maps' => '', 'address' => 'Units 3 & 4, Balbriggan Business Park, Clonard Or Folkstown Great, Balbriggan, Co. Dublin, K32 YV96, Ireland', 'territory' => 'Ireland', 'cats' => ['industrial', 'medical', 'lighting', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'configurable', 'wireless-charging-system', 'adapter', 'stocking', 'after-sales', 'online-shop']],
            ['region' => 'Europe', 'name' => 'Sunpower Group Holdings Ltd', 'website' => 'https://www.sunpowergroupholdings.com', 'tel' => '', 'email' => '+44 118 982 3745', 'maps' => '', 'address' => 'Sunpower Group Holdings Ltd, Orion House, Calleva Park, Aldermaston, Reading RG7 8SN, United Kingdom', 'territory' => 'UK', 'cats' => ['industrial', 'medical', 'lighting', 'din-rail', 'panel-mount', 'open-frame', 'enclosed', 'configurable', 'wireless-charging-system', 'adapter', 'led-driver', 'stocking', 'after-sales', 'online-shop']],
        ];
    }
}
