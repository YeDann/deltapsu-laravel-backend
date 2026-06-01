<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DistributorLabelSeeder extends Seeder
{
    /**
     * Seed the Find-a-Distributor filter UI labels into static_keyword /
     * static_keyword_translations (six locales). Idempotent by key_word.
     *
     * @return void
     */
    public function run()
    {
        $labels = [
            'Sales_Territory'          => ['en' => 'Sales Territory', 'tw' => '銷售區域', 'cn' => '销售区域', 'de' => 'Vertriebsgebiet',   'jp' => '販売地域', 'tr' => 'Satış Bölgesi'],
            'Certifications'           => ['en' => 'Certifications',  'tw' => '認證',     'cn' => '认证',     'de' => 'Zertifizierungen',  'jp' => '認証',     'tr' => 'Sertifikalar'],
            'Specialized_Applications' => ['en' => 'Specialized Applications', 'tw' => '專業應用', 'cn' => '专业应用', 'de' => 'Spezialanwendungen', 'jp' => '専門用途', 'tr' => 'Özel Uygulamalar'],
            'Product_Lines'            => ['en' => 'Product Lines',   'tw' => '產品線',   'cn' => '产品线',   'de' => 'Produktlinien',     'jp' => '製品ライン', 'tr' => 'Ürün Hatları'],
            'Services'                 => ['en' => 'Services',        'tw' => '服務',     'cn' => '服务',     'de' => 'Dienstleistungen',  'jp' => 'サービス', 'tr' => 'Hizmetler'],
            'No_Results'               => ['en' => 'No matching distributors', 'tw' => '查無符合的經銷商', 'cn' => '未找到符合的经销商', 'de' => 'Keine passenden Distributoren', 'jp' => '該当する販売店がありません', 'tr' => 'Eşleşen distribütör yok'],
            'Telephone'                => ['en' => 'Tel', 'tw' => '電話', 'cn' => '电话', 'de' => 'Tel', 'jp' => '電話', 'tr' => 'Tel'],
        ];

        $languages = DB::table('language')->pluck('name')->toArray();

        foreach ($labels as $key => $translations) {
            if (!DB::table('static_keyword')->where('key_word', $key)->exists()) {
                DB::table('static_keyword')->insert(['key_word' => $key]);
                echo "Created static_keyword: {$key}\n";
            }
            foreach ($languages as $local) {
                $word = $translations[$local] ?? $translations['en'];
                $exists = DB::table('static_keyword_translations')->where('key_word', $key)->where('local', $local)->exists();
                if (!$exists) {
                    DB::table('static_keyword_translations')->insert([
                        'key_word' => $key, 'word' => $word, 'local' => $local,
                    ]);
                }
            }
        }
    }
}
