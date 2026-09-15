<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StockHqSuffixKeywordSeeder extends Seeder
{
    /**
     * Seed 庫存 Modal 國別下拉「台灣＝Delta 總部」後綴 keyword（Stock_hq_suffix）
     * into static_keyword / static_keyword_translations for all locales.
     * 前台把此後綴接在台灣（TW）選項名稱後（如「台灣 (總部)」），不影響 val='TW' 篩選。
     * 獨立一支，不動既有 Stock keyword seeder。Idempotent。
     *
     * @return void
     */
    public function run()
    {
        // 各語系一律先填對應翻譯；缺項 fallback en
        $keywords = [
            'Stock_hq_suffix' => [
                'en' => '(HQ)',
                'tw' => '(總部)',
                'cn' => '(总部)',
                'de' => '(Zentrale)',
                'jp' => '(本社)',
                'tr' => '(Merkez)',
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
