<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MetaTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 定義要新增的 meta tag 資料
        $metaTags = [
            [
                'id' => 30,
                'page' => 'ProductNotice',
                'meta_title' => 'ProductNotice',
                'meta_description' => 'ProductNotice',
                'meta_key' => 'ProductNotice'
            ],
            [
                'id' => 31,
                'page' => 'Industry Know-How',
                'meta_title' => 'Industry Know-How',
                'meta_description' => 'Industry Know-How',
                'meta_key' => 'Industry Know-How'
            ],
            [
                'id' => 32,
                'page' => 'Videos',
                'meta_title' => 'Videos',
                'meta_description' => 'Videos',
                'meta_key' => 'Videos'
            ],
            [
                'id' => 33,
                'page' => 'EOL',
                'meta_title' => 'EOL',
                'meta_description' => 'EOL',
                'meta_key' => 'EOL'
            ]
        ];

        // 取得所有語言
        $languages = DB::table('language')->get();

        foreach ($metaTags as $metaTag) {
            // 檢查是否已存在該 ID 的記錄
            $exists = DB::table('meta_tag_page')->where('id', $metaTag['id'])->exists();
            
            if (!$exists) {
                // 插入主要 meta tag 記錄
                DB::table('meta_tag_page')->insert([
                    'id' => $metaTag['id'],
                    'page' => $metaTag['page'],
                    'meta_title' => $metaTag['meta_title'],
                    'meta_description' => $metaTag['meta_description'],
                    'meta_key' => $metaTag['meta_key']
                ]);

                // 為每個語言創建翻譯記錄
                foreach ($languages as $language) {
                    DB::table('meta_tag_page_translations')->insert([
                        'meta_id' => $metaTag['id'],
                        'title' => $metaTag['meta_title'],
                        'description' => $metaTag['meta_description'],
                        'h1' => $metaTag['page'],
                        'local' => $language->name
                    ]);
                }

                echo "Created meta tag: {$metaTag['page']} (ID: {$metaTag['id']})\n";
            } else {
                echo "Meta tag already exists: {$metaTag['page']} (ID: {$metaTag['id']})\n";
            }
        }
    }
}