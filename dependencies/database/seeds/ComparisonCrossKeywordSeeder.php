<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComparisonCrossKeywordSeeder extends Seeder
{
    /**
     * Seed Product Comparison 跨類選項（Industrial × Medical）的多語文字到 static_keyword。
     *
     * @return void
     */
    public function run()
    {
        $keywords = [
            'comparison_cross_industrial_medical' => [
                'en' => 'Industrial × Medical',
                'de' => 'Industrial × Medical',
                'tw' => 'Industrial × Medical',
                'cn' => 'Industrial × Medical',
                'jp' => 'Industrial × Medical',
                'tr' => 'Industrial × Medical',
            ],
        ];

        $languages = DB::table('language')->get();

        foreach ($keywords as $key => $translations) {
            if (!DB::table('static_keyword')->where('key_word', $key)->exists()) {
                DB::table('static_keyword')->insert(['key_word' => $key]);
                echo "Created static_keyword: {$key}\n";
            }

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
                    echo "Created translation: {$key} [{$local}]\n";
                }
            }
        }
    }
}
