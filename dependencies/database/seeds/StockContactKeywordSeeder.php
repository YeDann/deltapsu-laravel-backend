<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StockContactKeywordSeeder extends Seeder
{
    /**
     * Seed the Stock-checking Modal「Contact」按鈕 keyword（無購物車連結時 mailto 該經銷商）
     * into static_keyword / static_keyword_translations for all locales.
     * 獨立一支，不動既有 Stock seeders。Idempotent。
     *
     * @return void
     */
    public function run()
    {
        // 各語系一律先填對應翻譯；缺項 fallback en
        // 全語系先同值「Go to Distributor」，客戶之後到後台 Static Word 各語系自行微調
        $keywords = [
            'Stock_contact' => [
                'en' => 'Go to Distributor', 'tw' => 'Go to Distributor', 'cn' => 'Go to Distributor',
                'de' => 'Go to Distributor', 'jp' => 'Go to Distributor', 'tr' => 'Go to Distributor',
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
