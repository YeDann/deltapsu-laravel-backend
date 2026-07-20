<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IncorrectEmailPasswordKeywordSeeder extends Seeder
{
    /**
     * Seed the partner login "incorrect credentials" message keyword
     * into static_keyword / static_keyword_translations for all locales.
     *
     * @return void
     */
    public function run()
    {
        // 每個 key 對應各語系的文字；缺語系時 fallback 到 en
        $keywords = [
            'Incorrect_Email_Or_Password' => [
                'en' => 'Incorrect email or password.',
                'tw' => '電子信箱或密碼不正確。',
                'cn' => '电子邮箱或密码不正确。',
                'de' => 'Die E-Mail-Adresse oder das Passwort ist falsch',
                'jp' => 'メールアドレスまたはパスワードが正しくありません。',
                'tr' => 'E-posta veya şifre hatalı.',
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
