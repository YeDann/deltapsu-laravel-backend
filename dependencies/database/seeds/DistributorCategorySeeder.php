<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DistributorCategorySeeder extends Seeder
{
    /**
     * Seed the three distributor category lookup tables and their translations:
     * specialized_application / product_line / distributor_service.
     * Values come from Delta's "2025 deltapsu Distributor filter.xlsx".
     * Idempotent: keyed by slug; missing locales fall back to en.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'specialized_application' => [
                ['slug' => 'industrial', 'names' => ['en' => 'Industrial', 'tw' => '工業', 'cn' => '工业', 'de' => 'Industrie', 'jp' => '産業用', 'tr' => 'Endüstriyel']],
                ['slug' => 'medical',    'names' => ['en' => 'Medical',    'tw' => '醫療', 'cn' => '医疗', 'de' => 'Medizin',   'jp' => '医療',   'tr' => 'Tıbbi']],
                ['slug' => 'lighting',   'names' => ['en' => 'Lighting',   'tw' => '照明', 'cn' => '照明', 'de' => 'Beleuchtung', 'jp' => '照明', 'tr' => 'Aydınlatma']],
            ],
            'product_line' => [
                ['slug' => 'din-rail',                 'names' => ['en' => 'DIN Rail',                 'tw' => 'DIN 導軌',     'cn' => 'DIN 导轨',     'de' => 'DIN-Schiene',        'jp' => 'DINレール',       'tr' => 'DIN Ray']],
                ['slug' => 'panel-mount',              'names' => ['en' => 'Panel Mount',              'tw' => '面板安裝型',   'cn' => '面板安装型',   'de' => 'Panelmontage',       'jp' => 'パネル取付型',     'tr' => 'Panel Montaj']],
                ['slug' => 'open-frame',               'names' => ['en' => 'Open Frame',               'tw' => '開放式',       'cn' => '开放式',       'de' => 'Open Frame',         'jp' => 'オープンフレーム', 'tr' => 'Açık Çerçeve']],
                ['slug' => 'enclosed',                 'names' => ['en' => 'Enclosed',                 'tw' => '封閉式',       'cn' => '封闭式',       'de' => 'Geschlossen',        'jp' => '密閉型',           'tr' => 'Kapalı']],
                ['slug' => 'configurable',             'names' => ['en' => 'Configurable',             'tw' => '可配置式',     'cn' => '可配置式',     'de' => 'Konfigurierbar',     'jp' => 'コンフィギュラブル', 'tr' => 'Yapılandırılabilir']],
                ['slug' => 'wireless-charging-system', 'names' => ['en' => 'Wireless Charging System', 'tw' => '無線充電系統', 'cn' => '无线充电系统', 'de' => 'Drahtloses Laden',   'jp' => 'ワイヤレス充電',   'tr' => 'Kablosuz Şarj']],
                ['slug' => 'adapter',                  'names' => ['en' => 'Adapter',                  'tw' => '電源轉接器',   'cn' => '适配器',       'de' => 'Adapter',            'jp' => 'アダプター',       'tr' => 'Adaptör']],
                ['slug' => 'led-driver',               'names' => ['en' => 'LED Driver',               'tw' => 'LED 驅動器',   'cn' => 'LED 驱动器',   'de' => 'LED-Treiber',        'jp' => 'LEDドライバー',    'tr' => 'LED Sürücü']],
            ],
            'distributor_service' => [
                ['slug' => 'stocking',    'names' => ['en' => 'Stocking',    'tw' => '備貨',     'cn' => '备货',     'de' => 'Lagerhaltung', 'jp' => '在庫',           'tr' => 'Stoklama']],
                ['slug' => 'after-sales', 'names' => ['en' => 'After Sales', 'tw' => '售後服務', 'cn' => '售后服务', 'de' => 'Kundendienst', 'jp' => 'アフターサービス', 'tr' => 'Satış Sonrası']],
                ['slug' => 'online-shop', 'names' => ['en' => 'Online Shop', 'tw' => '線上商店', 'cn' => '在线商店', 'de' => 'Online-Shop',  'jp' => 'オンラインショップ', 'tr' => 'Çevrimiçi Mağaza']],
            ],
        ];

        $languages = DB::table('language')->pluck('name')->toArray();

        foreach ($data as $table => $items) {
            foreach ($items as $order => $item) {
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
                }

                foreach ($languages as $local) {
                    $name = $item['names'][$local] ?? $item['names']['en'];
                    $exists = DB::table($table . '_translation')
                        ->where('fk_id', $id)->where('local', $local)->exists();
                    if (!$exists) {
                        DB::table($table . '_translation')->insert([
                            'fk_id' => $id,
                            'name' => $name,
                            'local' => $local,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                }
            }
        }
    }
}
