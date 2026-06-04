<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StockCountryFilterKeywordSeeder extends Seeder
{
    /**
     * Seed the Stock-checking Modal 兩層（洲→國）篩選新增的 keyword：
     * 國別下拉的「All Countries」預設選項，以及各洲（continent）在地化名稱。
     * 洲名因 PHP intl 無法在地化，改走靜態字；前端未對應到的洲碼會 fallback DILP 英文。
     * 獨立一支，不動既有 StockRegionKeywordSeeder / StockModalKeywordSeeder。Idempotent。
     *
     * @return void
     */
    public function run()
    {
        // 各語系一律先填對應翻譯；缺項 fallback en。洲碼比照 DILP Region.ShortCode（AM/SA/EU/AS/AF/OC/ME）
        $keywords = [
            'Stock_all_countries' => [
                'en' => 'All Countries', 'tw' => '所有國家', 'cn' => '所有国家',
                'de' => 'Alle Länder', 'jp' => 'すべての国', 'tr' => 'Tüm Ülkeler',
            ],
            'Stock_region_am' => [
                'en' => 'North America', 'tw' => '北美洲', 'cn' => '北美洲',
                'de' => 'Nordamerika', 'jp' => '北アメリカ', 'tr' => 'Kuzey Amerika',
            ],
            'Stock_region_sa' => [
                'en' => 'South America', 'tw' => '南美洲', 'cn' => '南美洲',
                'de' => 'Südamerika', 'jp' => '南アメリカ', 'tr' => 'Güney Amerika',
            ],
            'Stock_region_eu' => [
                'en' => 'Europe', 'tw' => '歐洲', 'cn' => '欧洲',
                'de' => 'Europa', 'jp' => 'ヨーロッパ', 'tr' => 'Avrupa',
            ],
            'Stock_region_as' => [
                'en' => 'Asia', 'tw' => '亞洲', 'cn' => '亚洲',
                'de' => 'Asien', 'jp' => 'アジア', 'tr' => 'Asya',
            ],
            'Stock_region_af' => [
                'en' => 'Africa', 'tw' => '非洲', 'cn' => '非洲',
                'de' => 'Afrika', 'jp' => 'アフリカ', 'tr' => 'Afrika',
            ],
            'Stock_region_oc' => [
                'en' => 'Oceania', 'tw' => '大洋洲', 'cn' => '大洋洲',
                'de' => 'Ozeanien', 'jp' => 'オセアニア', 'tr' => 'Okyanusya',
            ],
            'Stock_region_me' => [
                'en' => 'Middle East', 'tw' => '中東', 'cn' => '中东',
                'de' => 'Naher Osten', 'jp' => '中東', 'tr' => 'Orta Doğu',
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
