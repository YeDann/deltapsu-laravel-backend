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

        // Phase II — Distributor Filter（順序：分類 → 匯入經銷商 → 篩選標籤 → 洲別名稱修正）
        $this->call(DistributorCategorySeeder::class);
        $this->call(DistributorImportSeeder::class);
        $this->call(DistributorLabelSeeder::class);
        $this->call(DistributorContinentNameSeeder::class);
    }
}
