<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StockModalKeywordSeeder extends Seeder
{
    /**
     * Seed the Stock-checking Modal static keywords (column headers + state messages)
     * into static_keyword / static_keyword_translations for all locales.
     *
     * @return void
     */
    public function run()
    {
        // 每個 key 對應各語系的文字；缺語系時 fallback 到 en
        $keywords = [
            'Stock_model_number' => [
                'en' => 'Model Number',
                'tw' => '型號',
                'cn' => '型号',
                'de' => 'Modellnummer',
                'jp' => '型番',
                'tr' => 'Model Numarası',
            ],
            'Stock_distributor' => [
                'en' => 'Distributor',
                'tw' => '經銷商',
                'cn' => '经销商',
                'de' => 'Distributor',
                'jp' => '販売代理店',
                'tr' => 'Distribütör',
            ],
            'Stock_availability' => [
                'en' => 'Availability',
                'tw' => '可供數量',
                'cn' => '可供数量',
                'de' => 'Verfügbarkeit',
                'jp' => '在庫数',
                'tr' => 'Mevcut',
            ],
            'Stock_upload_date' => [
                'en' => 'Date Updated',
                'tw' => '更新日期',
                'cn' => '更新日期',
                'de' => 'Aktualisiert am',
                'jp' => '更新日',
                'tr' => 'Güncellenme Tarihi',
            ],
            'Stock_buy_now' => [
                'en' => 'Buy Now',
                'tw' => '立即購買',
                'cn' => '立即购买',
                'de' => 'Jetzt kaufen',
                'jp' => '今すぐ購入',
                'tr' => 'Şimdi Al',
            ],
            'Stock_no_results' => [
                'en' => 'No stock found',
                'tw' => '查無庫存',
                'cn' => '查无库存',
                'de' => 'Kein Lagerbestand gefunden',
                'jp' => '在庫が見つかりません',
                'tr' => 'Stok bulunamadı',
            ],
            'Stock_loading' => [
                'en' => 'Loading…',
                'tw' => '載入中…',
                'cn' => '加载中…',
                'de' => 'Wird geladen…',
                'jp' => '読み込み中…',
                'tr' => 'Yükleniyor…',
            ],
            'Stock_error' => [
                'en' => 'Unable to load stock',
                'tw' => '無法載入庫存',
                'cn' => '无法加载库存',
                'de' => 'Lagerbestand konnte nicht geladen werden',
                'jp' => '在庫を読み込めません',
                'tr' => 'Stok yüklenemedi',
            ],
            // footer：「Powered by」後接 netCOMPONENTS logo，翻譯會卡 logo 位置故各語系維持英文（客戶可後台改）
            'Stock_powered_by' => [
                'en' => 'Powered by',
                'tw' => 'Powered by',
                'cn' => 'Powered by',
                'de' => 'Powered by',
                'jp' => 'Powered by',
                'tr' => 'Powered by',
            ],
            'Stock_sales_support' => [
                'en' => 'For other buy options / Sales support',
                'tw' => '其他購買選項 / 業務支援',
                'cn' => '其他购买选项 / 销售支持',
                'de' => 'Weitere Kaufoptionen / Vertriebssupport',
                'jp' => 'その他の購入オプション / 営業サポート',
                'tr' => 'Diğer satın alma seçenekleri / Satış desteği',
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
