<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductListHeaderKeywordSeeder extends Seeder
{
    /**
     * 為產品列表頁的表格欄位標題建立「頁面專用」static_keyword，
     * 讓後台可單獨調整列表頁標題（如縮短德文）而不影響其他頁面。
     *
     * 初始值：de 用德文，其餘語言（en/tw/cn/jp/tr/ru…）一律先給英文，
     * 其他語言的在地化由客戶之後在後台 Static Word 自行設定。
     * insert-only 冪等：已存在的翻譯不覆蓋，避免蓋掉客戶後台改過的值。
     *
     * @return void
     */
    public function run()
    {
        // 種純文字基準值；德文若要在窄欄斷字，由後台在斷點插入一般連字號 '-'（如 Ausgangs-spannung），看得見、可編輯
        $keywords = [
            'ProductList_Output_Voltage' => ['en' => 'Output Voltage',      'de' => 'Ausgangs-spannung'],
            'ProductList_Output_Current' => ['en' => 'Output Current',      'de' => 'Ausgangsstrom'],
            'ProductList_Output_Power'   => ['en' => 'Output Power',        'de' => 'Ausgangs-leistung'],
            'ProductList_Input_Voltage'  => ['en' => 'Input Voltage Range', 'de' => 'Eingangs-spannungsbereich'],
            'ProductList_Dimensions'     => ['en' => 'Dimensions',          'de' => 'Abmessungen'],
        ];

        $languages = DB::table('language')->get();

        foreach ($keywords as $key => $vals) {
            if (!DB::table('static_keyword')->where('key_word', $key)->exists()) {
                DB::table('static_keyword')->insert(['key_word' => $key]);
                echo "Created static_keyword: {$key}\n";
            }

            foreach ($languages as $language) {
                $local = $language->name;
                // de 用德文，其餘語言先給英文（客戶之後到後台各自設定）
                $word = ($local === 'de') ? $vals['de'] : $vals['en'];

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
