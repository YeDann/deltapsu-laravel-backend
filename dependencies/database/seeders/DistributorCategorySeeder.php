<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DistributorCategorySeeder extends Seeder
{
    /**
     * Seed/upsert the three distributor category lookup tables (Slide5 labels).
     * All locales are filled with the English name; localization is done later in the
     * admin backend. Existing slugs are preserved so imported pivot data stays linked;
     * any slug not in the desired set is deactivated (status=0) but kept (e.g. online-shop).
     * Idempotent.
     *
     * @return void
     */
    public function run()
    {
        // 各語系一律先填英文，實際在地化由後台逐一處理
        $data = [
            'distributor_specialized_application' => [
                ['slug' => 'industrial',  'name' => 'Industrial'],
                ['slug' => 'medical',     'name' => 'Medical'],
                ['slug' => 'lighting',    'name' => 'LED Lighting'],
                ['slug' => 'led-signage', 'name' => 'LED Signage'],
                ['slug' => 'railway',     'name' => 'Railway'],
            ],
            'distributor_product_line' => [
                ['slug' => 'din-rail',                 'name' => 'DIN Rail Power Supply'],
                ['slug' => 'panel-mount',              'name' => 'Panel Mount Power Supply'],
                ['slug' => 'open-frame',               'name' => 'Open Frame Power Supply'],
                ['slug' => 'enclosed',                 'name' => 'Enclosed Power Supply'],
                ['slug' => 'configurable',             'name' => 'Configurable Power Supply'],
                ['slug' => 'adapter',                  'name' => 'Adapter'],
                ['slug' => 'wireless-charging-system', 'name' => 'Wireless Charging'],
                ['slug' => 'led-driver',               'name' => 'LED Driver'],
                ['slug' => 'led-signage-power-supply', 'name' => 'LED Signage Power Supply'],
            ],
            'distributor_service' => [
                ['slug' => 'stocking',                'name' => 'Stocking'],
                ['slug' => 'after-sales',             'name' => 'After Sales'],
                ['slug' => 'technical-configuration', 'name' => 'Technical Configuration'],
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

                // 各語系一律填英文，後台再逐一在地化
                foreach ($languages as $local) {
                    $name = $item['name'];
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
