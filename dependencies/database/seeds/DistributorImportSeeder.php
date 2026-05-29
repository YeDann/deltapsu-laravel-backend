<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DistributorImportSeeder extends Seeder
{
    /**
     * Import distributors from Delta's spreadsheet (exported to
     * database/data/distributors.csv) into office(type_id=2) + office_translations
     * + the three category pivots. Region maps to continents(type_id=2); SEA→Thailand.
     * Upsert by name + continent: enriches the matching existing record (the live site
     * already lists many of these) or creates a new one; category pivots are reset each run.
     *
     * @return void
     */
    public function run()
    {
        $csv = database_path('data/distributors.csv');
        if (!is_file($csv)) {
            echo "CSV not found: {$csv}\n";
            return;
        }

        // region(Excel) → continent name(continents_translations, en)
        $regionToContinent = [
            'Americas' => 'Americas', 'Europe' => 'Europe', 'Japan' => 'Japan',
            'Korea' => 'Korea', 'SEA' => 'Thailand', 'Taiwan' => 'Taiwan Region', 'China' => 'China',
        ];

        // continent name(en) → id (type_id=2)
        $continentIdByName = DB::table('continents as c')
            ->join('continents_translations as ct', 'ct.cont_id', '=', 'c.id')
            ->where('c.type_id', 2)->where('ct.local', 'en')
            ->pluck('c.id', 'ct.name')->toArray();

        // category slug → id, per table
        $catId = [];
        foreach (['specialized_application', 'product_line', 'distributor_service'] as $t) {
            $catId[$t] = DB::table($t)->pluck('id', 'slug')->toArray();
        }

        // CSV flag column → [pivot table, category table, slug]
        $flagMap = [
            'industrial' => ['office_has_specialized_application', 'specialized_application'],
            'medical'    => ['office_has_specialized_application', 'specialized_application'],
            'lighting'   => ['office_has_specialized_application', 'specialized_application'],
            'din-rail'                 => ['office_has_product_line', 'product_line'],
            'panel-mount'              => ['office_has_product_line', 'product_line'],
            'open-frame'               => ['office_has_product_line', 'product_line'],
            'enclosed'                 => ['office_has_product_line', 'product_line'],
            'configurable'             => ['office_has_product_line', 'product_line'],
            'wireless-charging-system' => ['office_has_product_line', 'product_line'],
            'adapter'                  => ['office_has_product_line', 'product_line'],
            'led-driver'               => ['office_has_product_line', 'product_line'],
            'stocking'    => ['office_has_service', 'distributor_service'],
            'after-sales' => ['office_has_service', 'distributor_service'],
            'online-shop' => ['office_has_service', 'distributor_service'],
        ];

        $languages = DB::table('language')->pluck('name')->toArray();

        $fh = fopen($csv, 'r');
        $header = fgetcsv($fh);
        $created = 0;
        $updated = 0;

        $fields = function (array $r) {
            return [
                'website' => $r['website'] ?: null,
                'telephone' => $r['telephone'] ?: null,
                'email' => $r['email'] ?: null,
                'google_maps' => $r['google_maps'] ?: null,
                'sales_territory' => $r['sales_territory'] ?: null,
                'certification' => $r['certification'] ?: null,
            ];
        };

        while (($row = fgetcsv($fh)) !== false) {
            $r = array_combine($header, $row);
            $name = trim($r['name']);
            $region = trim($r['region']);
            $continentName = $regionToContinent[$region] ?? null;
            $continentId = $continentName ? ($continentIdByName[$continentName] ?? null) : null;
            if (!$name || !$continentId) {
                echo "Skip (no continent): {$name} / {$region}\n";
                continue;
            }

            // 以同名 + 同洲別 + type_id=2 對應既有經銷商（現有網站多已收錄）
            $officeId = DB::table('office as f')
                ->join('office_translations as t', 't.fk_office_id', '=', 'f.id')
                ->where('f.type_id', 2)->where('f.continent_id', $continentId)
                ->where('t.local', 'en')->where('t.title', $name)
                ->value('f.id');

            if ($officeId) {
                // 既有：更新新欄位（不動既有多語 translation）
                DB::table('office')->where('id', $officeId)
                    ->update($fields($r) + ['updated_at' => now()]);
                $updated++;
            } else {
                // 新建：office + 每語系一筆 translation（英文內容，待 Delta 在地化）
                $officeId = DB::table('office')->insertGetId([
                    'type_id' => 2,
                    'continent_id' => $continentId,
                    'status' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ] + $fields($r));
                foreach ($languages as $local) {
                    DB::table('office_translations')->insert([
                        'fk_office_id' => $officeId,
                        'title' => $name,
                        'sub_title' => null,
                        'content' => $r['address'] ?: null,
                        'local' => $local,
                    ]);
                }
                $created++;
            }

            // 三類 pivot：先刪後插（依 V 標記），確保可重跑
            foreach (['office_has_specialized_application', 'office_has_product_line', 'office_has_service'] as $pivot) {
                DB::table($pivot)->where('office_id', $officeId)->delete();
            }
            foreach ($flagMap as $col => [$pivot, $table]) {
                if (trim($r[$col] ?? '') === '1') {
                    $cid = $catId[$table][$col] ?? null;
                    if ($cid) {
                        DB::table($pivot)->insert([
                            'office_id' => $officeId,
                            'category_id' => $cid,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                }
            }
        }
        fclose($fh);
        echo "Distributors imported: created {$created}, updated {$updated}\n";
    }
}
