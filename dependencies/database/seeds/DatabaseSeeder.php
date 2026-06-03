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
    }
}
