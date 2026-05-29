<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StockKeywordSeeder extends Seeder
{
    /**
     * Seed the Stock UI static keywords (button tooltip + coming-soon notice)
     * into static_keyword / static_keyword_translations for all locales.
     *
     * @return void
     */
    public function run()
    {
        // 每個 key 對應各語系的文字；缺語系時 fallback 到 en
        $keywords = [
            'Stock' => [
                'en' => 'Stock',
                'tw' => '庫存',
                'cn' => '库存',
                'de' => 'Lagerbestand',
                'jp' => '在庫',
                'tr' => 'Stok',
            ],
            'Stock_coming_soon' => [
                'en' => 'Coming soon',
                'tw' => '即將開通',
                'cn' => '即将开通',
                'de' => 'Demnächst verfügbar',
                'jp' => '近日公開',
                'tr' => 'Çok yakında',
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
