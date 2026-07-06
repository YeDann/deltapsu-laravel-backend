## Why

Product Comparison（`/tools/comparison`）目前**只能比較同一個 sub category** 的產品（`checkProductSection` 限制新產品 `categories_id` 必須等於清單已有產品）。0603 deck Case#1 要求開放 **Industrial Power 與 Medical Power 跨類型比較**（這兩個 main 之間，涵蓋各自的 sub：Industrial=DIN Rail/Panel Mount/Open Frame/Adapter/Modules、Medical=Open Frame/Enclosed/Adapter）。其餘類型（LED Driver / Battery Charging / Configurable）維持原本「同 type」規則。

## What Changes

- Type 下拉（`#proType`）新增一個**跨類選項**（如 `Industrial × Medical`，文字走 static_keyword、多語、後台可改）。
- 選一般 sub category → 維持現行「同 type 比較」行為（不變）。
- 選跨類選項 → 產品下拉列出 **Industrial(main 2) + Medical(main 1) 全部產品**（跨 sub，照原本排序、不分組）。
- 加入比較放寬：兩產品的 sub 都屬於 Industrial/Medical 時可共存於同一清單；其他 main 仍限同 sub。
- 比較表沿用動態欄位，跨類產品**某產品沒有的欄位留空**。

## Capabilities

### New Capabilities

- `product-comparison`：Industrial × Medical 跨類型比較（Type 下拉跨類入口 + 加入規則放寬 + 缺值欄留空）。

### Modified Capabilities

（無）

## Impact

- 影響範圍：**Frontend**（Product Comparison 工具）。
- 受影響檔案：
  - `dependencies/app/Http/Controllers/FrontendController.php`（`getProductByType` 跨類取兩 main 產品、`checkProductSection` 放寬加入限制、`productCoparison` Type 下拉加跨類選項與「加更多」來源）
  - `dependencies/resources/views/front-end/productcoparison.blade.php`（Type 下拉跨類 option、`chageProductType()` 處理跨類）
  - 新增 seeder：跨類選項顯示文字的 static_keyword
- **無 DB schema 變更**（沿用 `categories_has_main_pro` 判斷 main、`static_keyword` 文案）。部署：跑 seeder + `view:clear`。
