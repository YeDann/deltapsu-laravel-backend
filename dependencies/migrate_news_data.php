<?php

/**
 * News Data Migration Script
 * 將特定的 news_type 資料遷移到獨立的表結構
 * 
 * 使用方法：
 * php artisan tinker --execute="require 'migrate_news_data.php'; (new NewsDataMigration())->preview();"
 * php artisan tinker --execute="require 'migrate_news_data.php'; (new NewsDataMigration())->run();"
 */
class NewsDataMigration
{
    // 要遷移的 news_type IDs
    const NEWS_TYPES_TO_MIGRATE = [
        9  => 'product-notice',     // Product Notice
        10 => 'industry-know-how',  // Industry Know How
        12 => 'eol'                 // EOL
    ];

    public function run()
    {
        echo "開始 News 資料遷移...\n\n";

        // 先建立預設分類
        $this->createDefaultCategories();

        foreach (self::NEWS_TYPES_TO_MIGRATE as $newsTypeId => $newContentType) {
            echo "處理 news_type: {$newsTypeId} -> {$newContentType}\n";
            $this->migrateNewsType($newsTypeId, $newContentType);
            echo "完成 {$newContentType} 遷移\n\n";
        }

        echo "所有遷移完成！\n";
    }

    private function migrateNewsType($newsTypeId, $newContentType)
    {
        // 1. 取得該類型的所有內容
        $contents = DB::table('contents as c')
            ->join('product_news_has_categories as pnhc', 'c.id', '=', 'pnhc.content_id')
            ->where('c.content_type', 'news')
            ->where('pnhc.categories_id', $newsTypeId)
            ->select('c.*')
            ->get();

        echo "找到 {$contents->count()} 筆內容需要遷移\n";

        foreach ($contents as $content) {
            DB::transaction(function () use ($content, $newsTypeId, $newContentType) {
                // 2. 更新 contents 表的 content_type
                DB::table('contents')
                    ->where('id', $content->id)
                    ->update(['content_type' => $newContentType]);

                // 3. 遷移到對應的新關聯表
                $this->moveToNewCategoryTable($content->id, $newsTypeId, $newContentType);

                // 4. 從舊的關聯表中刪除
                DB::table('product_news_has_categories')
                    ->where('content_id', $content->id)
                    ->where('categories_id', $newsTypeId)
                    ->delete();
            });
        }
    }

    private function moveToNewCategoryTable($contentId, $oldCategoryId, $newContentType)
    {
        $tableMapping = [
            'product-notice'     => 'product_product_notice_has_categories',
            'industry-know-how'  => 'product_industry_know_how_has_categories',
            'eol'                => 'product_eol_has_categories'
        ];

        $newTable = $tableMapping[$newContentType];
        
        // 找到對應的新分類 ID (假設是 1，因為這些獨立表通常只有預設分類)
        $newCategoryId = 1;

        // 檢查是否已經存在
        $exists = DB::table($newTable)
            ->where('content_id', $contentId)
            ->exists();

        if (!$exists) {
            DB::table($newTable)->insert([
                'content_id' => $contentId,
                'categories_id' => $newCategoryId,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }

    public function preview()
    {
        echo "預覽將要遷移的資料：\n\n";

        foreach (self::NEWS_TYPES_TO_MIGRATE as $newsTypeId => $newContentType) {
            // 取得該類型名稱
            $typeName = DB::table('news_type_translation')
                ->where('fk_nt_id', $newsTypeId)
                ->where('local', 'en')
                ->value('title');

            echo "News Type: {$typeName} (ID: {$newsTypeId})\n";
            echo "將遷移到: {$newContentType}\n";

            // 取得內容數量
            $count = DB::table('contents as c')
                ->join('product_news_has_categories as pnhc', 'c.id', '=', 'pnhc.content_id')
                ->where('c.content_type', 'news')
                ->where('pnhc.categories_id', $newsTypeId)
                ->count();

            echo "影響的內容數量: {$count}\n";

            // 顯示幾個範例
            $samples = DB::table('contents as c')
                ->join('product_news_has_categories as pnhc', 'c.id', '=', 'pnhc.content_id')
                ->where('c.content_type', 'news')
                ->where('pnhc.categories_id', $newsTypeId)
                ->select('c.id', 'c.slug', 'c.date_publish')
                ->limit(3)
                ->get();

            foreach ($samples as $sample) {
                echo "  - ID: {$sample->id}, Slug: {$sample->slug}, Date: {$sample->date_publish}\n";
            }
            echo "\n";
        }
    }

    private function createDefaultCategories()
    {
        echo "建立預設分類...\n";

        $categories = [
            'product-notice' => ['table' => 'product_notice_type', 'translation_table' => 'product_notice_type_translation', 'fk' => 'fk_pnt_id'],
            'industry-know-how' => ['table' => 'industry_know_how_type', 'translation_table' => 'industry_know_how_type_translation', 'fk' => 'fk_ikht_id'],
            'eol' => ['table' => 'eol_type', 'translation_table' => 'eol_type_translation', 'fk' => 'fk_et_id']
        ];

        foreach ($categories as $type => $config) {
            // 檢查是否已存在
            $exists = DB::table($config['table'])->exists();
            
            if (!$exists) {
                echo "  建立 {$type} 預設分類\n";
                
                // 建立主分類記錄
                $categoryId = DB::table($config['table'])->insertGetId([
                    'created_at' => now(),
                    'updated_at' => now()
                ]);

                // 建立翻譯記錄
                $languages = ['en', 'zh-TW', 'zh-CN', 'ja', 'th'];
                $titles = [
                    'product-notice' => [
                        'en' => 'Product Notice',
                        'zh-TW' => '產品公告',
                        'zh-CN' => '产品公告', 
                        'ja' => '製品のお知らせ',
                        'th' => 'ประกาศผลิตภัณฑ์'
                    ],
                    'industry-know-how' => [
                        'en' => 'Industry Know-How',
                        'zh-TW' => '產業知識',
                        'zh-CN' => '行业知识',
                        'ja' => '業界ノウハウ',
                        'th' => 'ความรู้ในอุตสาหกรรม'
                    ],
                    'eol' => [
                        'en' => 'End of Life',
                        'zh-TW' => '產品停產',
                        'zh-CN' => '产品停产',
                        'ja' => '生産終了',
                        'th' => 'สิ้นสุดการผลิต'
                    ]
                ];

                foreach ($languages as $lang) {
                    DB::table($config['translation_table'])->insert([
                        $config['fk'] => $categoryId,
                        'title' => $titles[$type][$lang] ?? $titles[$type]['en'],
                        'local' => $lang,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }
            } else {
                echo "  {$type} 分類已存在\n";
            }
        }

        echo "預設分類建立完成\n\n";
    }
}

// 執行腳本的方式已在檔案開頭說明