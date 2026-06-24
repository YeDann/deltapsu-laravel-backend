<?php

namespace Database\Seeders;

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

        // UI — 產品列表頁表格欄位標題的頁面專用 static key（可單獨調整不影響其他頁）
        $this->call(ProductListHeaderKeywordSeeder::class);

        // Phase II — Stock icon 標籤
        $this->call(StockKeywordSeeder::class);

        // Phase II — Stock Checking 庫存 Modal 標籤（DILP）
        $this->call(StockModalKeywordSeeder::class);

        // Phase II — Stock Modal 文案調整（表頭 Stock_model_number→Stock_model_name、footer 文案）
        $this->call(StockModalCopyFixSeeder::class);

        // Phase II — Stock Modal 國別篩選標籤（All Regions）
        $this->call(StockRegionKeywordSeeder::class);

        // Phase II — Stock Modal 兩層（洲→國）篩選標籤（All Countries + 各洲名）
        $this->call(StockCountryFilterKeywordSeeder::class);

        // Phase II — Stock Modal 無購物車連結時的「Go to Distributor」按鈕標籤
        $this->call(StockContactKeywordSeeder::class);

        // Phase II — Distributor Filter（只建分類結構與標籤；經銷商資料、洲別名稱由後台維護）
        $this->call(DistributorCategorySeeder::class);
        $this->call(DistributorLabelSeeder::class);
        $this->call(DistributorServicesOfferedLabelSeeder::class);

        // Phase II — 經銷商名錄匯入（2025 Excel；須在 DistributorCategorySeeder 之後）
        $this->call(DistributorOfficeSeeder::class);

        // Phase II — Find a Distributor：Certificate 按鈕 static word + Certifications→Expertise 顯示值
        $this->call(DistributorExpertiseKeywordSeeder::class);

        // Phase II — Configurable Power Selector：Dual Output 上限說明文字（多語模板）
        $this->call(ConfigurableDualLimitSeeder::class);

        // Phase II — Product Comparison：跨類選項（Industrial × Medical）標籤
        $this->call(ComparisonCrossKeywordSeeder::class);
    }
}
