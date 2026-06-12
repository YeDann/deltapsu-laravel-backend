<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        // $this->call(MetaTagSeeder::class);
        $this->call(RegenerateSlugSeeder::class);

        // Phase II — Stock icon 標籤
        $this->call(StockKeywordSeeder::class);

        // Phase II — Distributor Filter（只建分類結構與標籤；經銷商資料、洲別名稱由後台維護）
        $this->call(DistributorCategorySeeder::class);
        $this->call(DistributorLabelSeeder::class);

        // Phase II — 經銷商名錄匯入（2025 Excel；須在 DistributorCategorySeeder 之後）
        $this->call(DistributorOfficeSeeder::class);

        // Phase II — Find a Distributor：Certificate 按鈕 static word + Certifications→Expertise 顯示值
        $this->call(DistributorExpertiseKeywordSeeder::class);
    }
}
