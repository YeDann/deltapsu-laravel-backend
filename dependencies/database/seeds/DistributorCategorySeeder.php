<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DistributorCategorySeeder extends Seeder
{
    /**
     * Seed/upsert the three distributor category lookup tables and their translations.
     * Labels follow the client mockup (Slide5). Existing slugs are preserved so imported
     * pivot data stays linked; display names are updated; new options are added; any
     * category slug not in the desired set is deactivated (status=0) but kept (e.g. online-shop).
     * Idempotent.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'specialized_application' => [
                ['slug' => 'industrial',  'names' => ['en' => 'Industrial',  'tw' => '工業',     'cn' => '工业',     'de' => 'Industrie',        'jp' => '産業用',     'tr' => 'Endüstriyel']],
                ['slug' => 'medical',     'names' => ['en' => 'Medical',     'tw' => '醫療',     'cn' => '医疗',     'de' => 'Medizin',          'jp' => '医療',       'tr' => 'Tıbbi']],
                ['slug' => 'lighting',    'names' => ['en' => 'LED Lighting', 'tw' => 'LED 照明', 'cn' => 'LED 照明', 'de' => 'LED-Beleuchtung',  'jp' => 'LED照明',    'tr' => 'LED Aydınlatma']],
                ['slug' => 'led-signage', 'names' => ['en' => 'LED Signage', 'tw' => 'LED 看板', 'cn' => 'LED 标牌', 'de' => 'LED-Beschilderung', 'jp' => 'LEDサイネージ', 'tr' => 'LED Tabela']],
                ['slug' => 'railway',     'names' => ['en' => 'Railway',     'tw' => '鐵路',     'cn' => '铁路',     'de' => 'Bahn',             'jp' => '鉄道',       'tr' => 'Demiryolu']],
            ],
            'product_line' => [
                ['slug' => 'din-rail',                 'names' => ['en' => 'DIN Rail Power Supply',      'tw' => 'DIN 導軌電源',   'cn' => 'DIN 导轨电源',   'de' => 'DIN-Schienen-Netzteil',      'jp' => 'DINレール電源',     'tr' => 'DIN Ray Güç Kaynağı']],
                ['slug' => 'panel-mount',              'names' => ['en' => 'Panel Mount Power Supply',   'tw' => '面板安裝電源',   'cn' => '面板安装电源',   'de' => 'Panelmontage-Netzteil',      'jp' => 'パネル取付電源',   'tr' => 'Panel Montaj Güç Kaynağı']],
                ['slug' => 'open-frame',               'names' => ['en' => 'Open Frame Power Supply',    'tw' => '開放式電源',     'cn' => '开放式电源',     'de' => 'Open-Frame-Netzteil',        'jp' => 'オープンフレーム電源', 'tr' => 'Açık Çerçeve Güç Kaynağı']],
                ['slug' => 'enclosed',                 'names' => ['en' => 'Enclosed Power Supply',      'tw' => '封閉式電源',     'cn' => '封闭式电源',     'de' => 'Geschlossenes Netzteil',     'jp' => '密閉型電源',       'tr' => 'Kapalı Güç Kaynağı']],
                ['slug' => 'configurable',             'names' => ['en' => 'Configurable Power Supply',  'tw' => '可配置電源',     'cn' => '可配置电源',     'de' => 'Konfigurierbares Netzteil',  'jp' => 'コンフィギュラブル電源', 'tr' => 'Yapılandırılabilir Güç Kaynağı']],
                ['slug' => 'adapter',                  'names' => ['en' => 'Adapter',                    'tw' => '電源轉接器',     'cn' => '适配器',         'de' => 'Adapter',                    'jp' => 'アダプター',       'tr' => 'Adaptör']],
                ['slug' => 'wireless-charging-system', 'names' => ['en' => 'Wireless Charging',          'tw' => '無線充電',       'cn' => '无线充电',       'de' => 'Drahtloses Laden',           'jp' => 'ワイヤレス充電',   'tr' => 'Kablosuz Şarj']],
                ['slug' => 'led-driver',               'names' => ['en' => 'LED Driver',                 'tw' => 'LED 驅動器',     'cn' => 'LED 驱动器',     'de' => 'LED-Treiber',                'jp' => 'LEDドライバー',    'tr' => 'LED Sürücü']],
                ['slug' => 'led-signage-power-supply', 'names' => ['en' => 'LED Signage Power Supply',   'tw' => 'LED 看板電源',   'cn' => 'LED 标牌电源',   'de' => 'LED-Beschilderungs-Netzteil', 'jp' => 'LEDサイネージ電源', 'tr' => 'LED Tabela Güç Kaynağı']],
            ],
            'distributor_service' => [
                ['slug' => 'stocking',                 'names' => ['en' => 'Stocking',                'tw' => '備貨',     'cn' => '备货',     'de' => 'Lagerhaltung',            'jp' => '在庫',           'tr' => 'Stoklama']],
                ['slug' => 'after-sales',              'names' => ['en' => 'After Sales',             'tw' => '售後服務', 'cn' => '售后服务', 'de' => 'Kundendienst',            'jp' => 'アフターサービス', 'tr' => 'Satış Sonrası']],
                ['slug' => 'technical-configuration',  'names' => ['en' => 'Technical Configuration', 'tw' => '技術組態', 'cn' => '技术配置', 'de' => 'Technische Konfiguration', 'jp' => '技術コンフィグ', 'tr' => 'Teknik Yapılandırma']],
            ],
        ];

        $languages = DB::table('language')->pluck('name')->toArray();

        foreach ($data as $table => $items) {
            $wantedSlugs = [];
            foreach ($items as $order => $item) {
                $wantedSlugs[] = $item['slug'];

                $id = DB::table($table)->where('slug', $item['slug'])->value('id');
                if (!$id) {
                    $id = DB::table($table)->insertGetId([
                        'slug' => $item['slug'],
                        'status' => 1,
                        'order_seq' => $order,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    echo "Created {$table}: {$item['slug']}\n";
                } else {
                    DB::table($table)->where('id', $id)->update(['status' => 1, 'order_seq' => $order, 'updated_at' => now()]);
                }

                // upsert 各語系名稱（缺語系 fallback en）
                foreach ($languages as $local) {
                    $name = $item['names'][$local] ?? $item['names']['en'];
                    $exists = DB::table($table . '_translation')->where('fk_id', $id)->where('local', $local)->exists();
                    if ($exists) {
                        DB::table($table . '_translation')->where('fk_id', $id)->where('local', $local)->update(['name' => $name, 'updated_at' => now()]);
                    } else {
                        DB::table($table . '_translation')->insert([
                            'fk_id' => $id, 'name' => $name, 'local' => $local,
                            'created_at' => now(), 'updated_at' => now(),
                        ]);
                    }
                }
            }

            // 不在期望清單中的分類停用（保留資料，例如 Excel 才有的 online-shop）
            $deactivated = DB::table($table)->whereNotIn('slug', $wantedSlugs)->update(['status' => 0, 'updated_at' => now()]);
            if ($deactivated) {
                echo "Deactivated {$deactivated} legacy item(s) in {$table}\n";
            }
        }
    }
}
