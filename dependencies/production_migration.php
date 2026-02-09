<?php

/**
 * Production Database Migration Script (Laravel Version)
 * 生產環境資料庫遷移腳本 (Laravel 版本)
 * 
 * 使用方法：
 * php artisan tinker --execute="require 'production_migration.php'; (new ProductionMigration())->run();"
 */

class ProductionMigration
{
    public function run()
    {
        echo "開始生產環境資料庫遷移...\n\n";

        try {
            DB::transaction(function () {
                $this->step1_ProductsOverview();
                $this->step2_TechnicalSupport();
                $this->step3_TechnicalService();
                $this->step4_UpdateNewsTypes();
                $this->step5_WhereToBuy();
                $this->step6_AdjustCategories();
                $this->step7_ConfigurablePower();
                $this->step8_SuccessCase();
                $this->step9_Videos();
                $this->step10_DownloadCSV();
                $this->step11_StandardPowerSupplies();
                $this->step12_AdjustMainCategoryOrder();
                $this->step13_CreateNewsCategories();
            });

            echo "\n✅ 所有遷移完成！\n";

        } catch (Exception $e) {
            echo "\n❌ 遷移失敗: " . $e->getMessage() . "\n";
            throw $e;
        }
    }

    private function step1_ProductsOverview()
    {
        echo "1. 加入 Products_Overview 多語系設定\n";

        // 插入關鍵字
        DB::table('static_keyword')->insertOrIgnore([
            'key_word' => 'Products_Overview'
        ]);

        // 插入翻譯
        $translations = [
            ['key_word' => 'Products_Overview', 'word' => 'Products Overview', 'local' => 'en'],
            ['key_word' => 'Products_Overview', 'word' => '商品總覽', 'local' => 'cn'],
            ['key_word' => 'Products_Overview', 'word' => '商品總覽', 'local' => 'tw'],
            ['key_word' => 'Products_Overview', 'word' => 'Products Overview', 'local' => 'de'],
            ['key_word' => 'Products_Overview', 'word' => 'Products Overview', 'local' => 'ru'],
            ['key_word' => 'Products_Overview', 'word' => 'Products Overview', 'local' => 'jp']
        ];

        foreach ($translations as $translation) {
            DB::table('static_keyword_translations')
                ->updateOrInsert(
                    ['key_word' => $translation['key_word'], 'local' => $translation['local']],
                    $translation
                );
        }
    }

    private function step2_TechnicalSupport()
    {
        echo "2. 加入 Technical Support 多語系設定\n";

        DB::table('static_keyword')->insertOrIgnore([
            'key_word' => 'Technical_Support'
        ]);

        $translations = [
            ['key_word' => 'Technical_Support', 'word' => 'Technical Support', 'local' => 'en'],
            ['key_word' => 'Technical_Support', 'word' => '技術支援', 'local' => 'tw'],
            ['key_word' => 'Technical_Support', 'word' => '技術支援', 'local' => 'cn'],
            ['key_word' => 'Technical_Support', 'word' => 'Technical Support', 'local' => 'de'],
            ['key_word' => 'Technical_Support', 'word' => 'Technical Support', 'local' => 'ru'],
            ['key_word' => 'Technical_Support', 'word' => 'Technical Support', 'local' => 'jp']
        ];

        foreach ($translations as $translation) {
            DB::table('static_keyword_translations')
                ->updateOrInsert(
                    ['key_word' => $translation['key_word'], 'local' => $translation['local']],
                    $translation
                );
        }
    }

    private function step3_TechnicalService()
    {
        echo "3. 加入 Technical Service 多語系設定\n";

        DB::table('static_keyword')->insertOrIgnore([
            'key_word' => 'Technical_Service'
        ]);

        $translations = [
            ['key_word' => 'Technical_Service', 'word' => 'Technical Service', 'local' => 'en'],
            ['key_word' => 'Technical_Service', 'word' => '技術服務', 'local' => 'tw'],
            ['key_word' => 'Technical_Service', 'word' => '技術服務', 'local' => 'cn'],
            ['key_word' => 'Technical_Service', 'word' => 'Technical Service', 'local' => 'de'],
            ['key_word' => 'Technical_Service', 'word' => 'Technical Service', 'local' => 'ru'],
            ['key_word' => 'Technical_Service', 'word' => 'Technical Service', 'local' => 'jp']
        ];

        foreach ($translations as $translation) {
            DB::table('static_keyword_translations')
                ->updateOrInsert(
                    ['key_word' => $translation['key_word'], 'local' => $translation['local']],
                    $translation
                );
        }
    }

    private function step4_UpdateNewsTypes()
    {
        echo "4. 更新 news type 多語系設定\n";

        // 更新 Industry Know-How
        $knowledgeId = DB::table('news_type')->where('name', 'Knowledge')->value('id');
        if ($knowledgeId) {
            DB::table('news_type_translation')
                ->where('fk_nt_id', $knowledgeId)
                ->whereIn('local', ['en', 'jp'])
                ->update(['title' => 'Industry Know-How']);

            DB::table('news_type')->where('name', 'Knowledge')->update(['name' => 'Industry Know-How']);
        }

        // 更新 Event News
        $companyId = DB::table('news_type')->where('name', 'Company')->value('id');
        if ($companyId) {
            DB::table('news_type_translation')
                ->where('fk_nt_id', $companyId)
                ->whereIn('local', ['en', 'jp'])
                ->update(['title' => 'Event News']);

            DB::table('news_type')->where('name', 'Company')->update(['name' => 'Event News']);
        }

        // 更新 Product News
        $newProductsId = DB::table('news_type')->where('name', 'New Products')->value('id');
        if ($newProductsId) {
            DB::table('news_type_translation')
                ->where('fk_nt_id', $newProductsId)
                ->whereIn('local', ['en', 'jp'])
                ->update(['title' => 'Product News']);

            DB::table('news_type')->where('name', 'New Products')->update(['name' => 'Product News']);
        }
    }

    private function step5_WhereToBuy()
    {
        echo "5. 加入 Where to Buy 多語系設定\n";

        DB::table('static_keyword')->insertOrIgnore([
            'key_word' => 'Where_to_Buy'
        ]);

        $translations = [
            ['key_word' => 'Where_to_Buy', 'word' => 'Where to Buy', 'local' => 'en'],
            ['key_word' => 'Where_to_Buy', 'word' => '購買管道', 'local' => 'tw'],
            ['key_word' => 'Where_to_Buy', 'word' => '購買管道', 'local' => 'cn'],
            ['key_word' => 'Where_to_Buy', 'word' => 'Where to Buy', 'local' => 'de'],
            ['key_word' => 'Where_to_Buy', 'word' => 'Where to Buy', 'local' => 'ru'],
            ['key_word' => 'Where_to_Buy', 'word' => 'Where to Buy', 'local' => 'jp']
        ];

        foreach ($translations as $translation) {
            DB::table('static_keyword_translations')
                ->updateOrInsert(
                    ['key_word' => $translation['key_word'], 'local' => $translation['local']],
                    $translation
                );
        }
    }

    private function step6_AdjustCategories()
    {
        echo "6. 調整主分類關聯設定\n";

        // 刪除 Industrial Power Supplies 分類關聯
        DB::table('categories_has_main_pro')->where('main_cateid', 2)->delete();

        // 重新插入 Industrial Power Supplies 分類關聯
        $industrialCategories = [
            ['cate_id' => 1, 'main_cateid' => 2, 'order_seq' => 1],
            ['cate_id' => 2, 'main_cateid' => 2, 'order_seq' => 2],
            ['cate_id' => 3, 'main_cateid' => 2, 'order_seq' => 3],
            ['cate_id' => 8, 'main_cateid' => 2, 'order_seq' => 4],
            ['cate_id' => 5, 'main_cateid' => 2, 'order_seq' => 5]
        ];
        DB::table('categories_has_main_pro')->insert($industrialCategories);

        // 刪除 Medical Power Supplies 分類關聯
        DB::table('categories_has_main_pro')->where('main_cateid', 1)->delete();

        // 重新插入 Medical Power Supplies 分類關聯
        $medicalCategories = [
            ['cate_id' => 3, 'main_cateid' => 1, 'order_seq' => 1],
            ['cate_id' => 9, 'main_cateid' => 1, 'order_seq' => 2],
            ['cate_id' => 8, 'main_cateid' => 1, 'order_seq' => 3]
        ];
        DB::table('categories_has_main_pro')->insert($medicalCategories);
    }

    private function step7_ConfigurablePower()
    {
        echo "7. 加入 Configurable Power 主分類\n";

        // 檢查是否已存在
        $existsMainCategory = DB::table('main_pro_categories')->where('order_seq', 5)->exists();
        
        if (!$existsMainCategory) {
            DB::table('main_pro_categories')->insert([
                'order_seq' => 5,
                'active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        // 插入翻譯
        $mainCategoryTranslations = [
            ['main_pro_id' => 5, 'name' => 'Configurable Power', 'local' => 'en'],
            ['main_pro_id' => 5, 'name' => '可配置電源', 'local' => 'tw'],
            ['main_pro_id' => 5, 'name' => '可配置電源', 'local' => 'cn'],
            ['main_pro_id' => 5, 'name' => 'Configurable Power', 'local' => 'de'],
            ['main_pro_id' => 5, 'name' => 'Configurable Power', 'local' => 'ru'],
            ['main_pro_id' => 5, 'name' => 'Configurable Power', 'local' => 'jp']
        ];

        foreach ($mainCategoryTranslations as $translation) {
            DB::table('main_pro_categories_translations')
                ->updateOrInsert(
                    ['main_pro_id' => $translation['main_pro_id'], 'local' => $translation['local']],
                    $translation
                );
        }

        // 插入靜態關鍵字
        DB::table('static_keyword')->insertOrIgnore([
            'key_word' => 'Configurable_Power'
        ]);

        $staticTranslations = [
            ['key_word' => 'Configurable_Power', 'word' => 'Configurable Power', 'local' => 'en'],
            ['key_word' => 'Configurable_Power', 'word' => '可配置電源', 'local' => 'tw'],
            ['key_word' => 'Configurable_Power', 'word' => '可配置電源', 'local' => 'cn'],
            ['key_word' => 'Configurable_Power', 'word' => 'Configurable Power', 'local' => 'de'],
            ['key_word' => 'Configurable_Power', 'word' => 'Configurable Power', 'local' => 'ru'],
            ['key_word' => 'Configurable_Power', 'word' => 'Configurable Power', 'local' => 'jp']
        ];

        foreach ($staticTranslations as $translation) {
            DB::table('static_keyword_translations')
                ->updateOrInsert(
                    ['key_word' => $translation['key_word'], 'local' => $translation['local']],
                    $translation
                );
        }
    }

    private function step8_SuccessCase()
    {
        echo "8. 加入 Success Case 多語系設定\n";

        DB::table('static_keyword')->insertOrIgnore([
            'key_word' => 'Success_Case'
        ]);

        $translations = [
            ['key_word' => 'Success_Case', 'word' => 'Success Case', 'local' => 'en'],
            ['key_word' => 'Success_Case', 'word' => '成功案例', 'local' => 'tw'],
            ['key_word' => 'Success_Case', 'word' => '成功案例', 'local' => 'cn'],
            ['key_word' => 'Success_Case', 'word' => 'Success Case', 'local' => 'de'],
            ['key_word' => 'Success_Case', 'word' => 'Success Case', 'local' => 'ru'],
            ['key_word' => 'Success_Case', 'word' => 'Success Case', 'local' => 'jp']
        ];

        foreach ($translations as $translation) {
            DB::table('static_keyword_translations')
                ->updateOrInsert(
                    ['key_word' => $translation['key_word'], 'local' => $translation['local']],
                    $translation
                );
        }
    }

    private function step9_Videos()
    {
        echo "9. 加入 Videos 多語系設定\n";

        DB::table('static_keyword')->insertOrIgnore([
            'key_word' => 'Videos'
        ]);

        $translations = [
            ['key_word' => 'Videos', 'word' => 'Videos', 'local' => 'en'],
            ['key_word' => 'Videos', 'word' => '影音', 'local' => 'tw'],
            ['key_word' => 'Videos', 'word' => '視頻', 'local' => 'cn'],
            ['key_word' => 'Videos', 'word' => 'Videos', 'local' => 'de'],
            ['key_word' => 'Videos', 'word' => 'Videos', 'local' => 'ru'],
            ['key_word' => 'Videos', 'word' => 'Videos', 'local' => 'jp']
        ];

        foreach ($translations as $translation) {
            DB::table('static_keyword_translations')
                ->updateOrInsert(
                    ['key_word' => $translation['key_word'], 'local' => $translation['local']],
                    $translation
                );
        }
    }

    private function step10_DownloadCSV()
    {
        echo "10. 加入 Download_AS_CSV 多語系設定\n";

        DB::table('static_keyword')->insertOrIgnore([
            'key_word' => 'Download_AS_CSV'
        ]);

        $translations = [
            ['key_word' => 'Download_AS_CSV', 'word' => 'Download as CSV', 'local' => 'en'],
            ['key_word' => 'Download_AS_CSV', 'word' => 'Download as CSV', 'local' => 'tw'],
            ['key_word' => 'Download_AS_CSV', 'word' => 'Download as CSV', 'local' => 'cn'],
            ['key_word' => 'Download_AS_CSV', 'word' => 'Download as CSV', 'local' => 'de'],
            ['key_word' => 'Download_AS_CSV', 'word' => 'Download as CSV', 'local' => 'ru'],
            ['key_word' => 'Download_AS_CSV', 'word' => 'Download as CSV', 'local' => 'jp']
        ];

        foreach ($translations as $translation) {
            DB::table('static_keyword_translations')
                ->updateOrInsert(
                    ['key_word' => $translation['key_word'], 'local' => $translation['local']],
                    $translation
                );
        }
    }

    private function step11_StandardPowerSupplies()
    {
        echo "11. 加入 Standard_Power_Supplies 多語系設定\n";

        DB::table('static_keyword')->insertOrIgnore([
            'key_word' => 'Standard_Power_Supplies'
        ]);

        $translations = [
            ['key_word' => 'Standard_Power_Supplies', 'word' => 'Standard Power Supplies', 'local' => 'en'],
            ['key_word' => 'Standard_Power_Supplies', 'word' => '標準電源', 'local' => 'tw'],
            ['key_word' => 'Standard_Power_Supplies', 'word' => '标准电源', 'local' => 'cn'],
            ['key_word' => 'Standard_Power_Supplies', 'word' => 'Standard-Netzteil', 'local' => 'de'],
            ['key_word' => 'Standard_Power_Supplies', 'word' => 'Standard Power Supplies', 'local' => 'ru'],
            ['key_word' => 'Standard_Power_Supplies', 'word' => 'Standart Güç Kaynağı', 'local' => 'tr'],
            ['key_word' => 'Standard_Power_Supplies', 'word' => '標準電源', 'local' => 'jp']
        ];

        foreach ($translations as $translation) {
            DB::table('static_keyword_translations')
                ->updateOrInsert(
                    ['key_word' => $translation['key_word'], 'local' => $translation['local']],
                    $translation
                );
        }
    }

    private function step12_AdjustMainCategoryOrder()
    {
        echo "12. 調整主分類排序\n";

        DB::table('main_pro_categories')->where('main_id', 5)->update(['order_seq' => 3]);
        DB::table('main_pro_categories')->where('main_id', 3)->update(['order_seq' => 5]);
    }

    private function step13_CreateNewsCategories()
    {
        echo "13. 建立 News 分類表結構\n";

        // 這部分只建立基礎結構，實際遷移由 migrate_news_data.php 處理
        echo "   (新聞內容遷移請執行 migrate_news_data.php)\n";
    }
}

// 執行腳本的方式已在檔案開頭說明