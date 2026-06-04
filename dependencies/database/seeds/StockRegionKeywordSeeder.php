<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StockRegionKeywordSeeder extends Seeder
{
    /**
     * Seed the Stock-checking Modal 國別篩選相關 keyword（目前只有「All Regions」預設選項）
     * into static_keyword / static_keyword_translations for all locales.
     * 獨立一支，不動既有 StockModalKeywordSeeder。Idempotent。
     *
     * @return void
     */
    public function run()
    {
        // 各語系一律先填對應翻譯；缺項 fallback en
        $keywords = [
            'Stock_all_regions' => [
                'en' => 'All Regions',
                'tw' => '所有地區',
                'cn' => '所有地区',
                'de' => 'Alle Regionen',
                'jp' => 'すべての地域',
                'tr' => 'Tüm Bölgeler',
            ],
        ];

        $languages = DB::table('language')->get();

        foreach ($keywords as $key => $translations) {
            // 主表：key_word 不存在才新增
            if (!DB::table('static_keyword')->where('key_word', $key)->exists()) {
                DB::table('static_keyword')->insert(['key_word' => $key]);
                echo "Created static_keyword: {$key}\n";
            }

            // 翻譯表：每個語系補一筆（已存在則略過），缺對應字串 fallback en
            foreach ($languages as $language) {
                $local = $language->name;
                $word = $translations[$local] ?? $translations['en'];

                $exists = DB::table('static_keyword_translations')
                    ->where('key_word', $key)
                    ->where('local', $local)
                    ->exists();

                if (!$exists) {
                    DB::table('static_keyword_translations')->insert([
                        'key_word' => $key,
                        'word' => $word,
                        'local' => $local,
                    ]);
                    echo "Created translation: {$key} [{$local}] = {$word}\n";
                }
            }
        }
    }
}
