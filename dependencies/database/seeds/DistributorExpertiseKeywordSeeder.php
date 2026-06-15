<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DistributorExpertiseKeywordSeeder extends Seeder
{
    /**
     * Find a Distributor 的 static_keyword 文字（資料層，schema rename 由 migration 處理）：
     *   建立 Certificate 按鈕、Expertise 分類下拉的 static word（可後台多語系設定，預設各語系＝英文名）。
     *
     * 注意：分類顯示改用獨立的 'Expertise' key，不再借用 'Certifications'（'Certifications' 另有他用，需保留原意）。
     * Idempotent，可重複執行；各環境部署後跑一次即可。
     *
     * @return void
     */
    public function run()
    {
        $languages = DB::table('language')->get();

        // 各語系預設值＝英文名；之後在後台「Static Word」微調各語系
        $keywords = [
            'Certificate' => 'Certificate',
            'Expertise'   => 'Expertise',
        ];

        foreach ($keywords as $key => $default) {
            if (!DB::table('static_keyword')->where('key_word', $key)->exists()) {
                DB::table('static_keyword')->insert(['key_word' => $key]);
                echo "Created static_keyword: {$key}\n";
            }

            foreach ($languages as $language) {
                $local = $language->name;
                $exists = DB::table('static_keyword_translations')
                    ->where('key_word', $key)
                    ->where('local', $local)
                    ->exists();

                if (!$exists) {
                    DB::table('static_keyword_translations')->insert([
                        'key_word' => $key,
                        'word' => $default,
                        'local' => $local,
                    ]);
                    echo "Created translation: {$key} [{$local}]\n";
                }
            }
        }
    }
}
