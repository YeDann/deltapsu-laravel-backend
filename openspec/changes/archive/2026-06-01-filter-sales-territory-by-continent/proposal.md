## Why

後台經銷商（Distributors, `office` type_id=2）編輯／新增表單的 Sales Territory 區塊原本列出**所有地區**的銷售區域，並依 Region 分組（左欄 region 標籤 + 右欄該區勾選項）。但每家經銷商本身已歸屬於某個地區（continent），列出其他地區的選項既多餘、又容易讓管理者跨區誤勾。

## What Changes

- 後台 Distributors 編輯／新增表單的 **Sales Territory 勾選改為只列出該經銷商所屬 continent 的選項**（依表單已帶入的 `$conid` 過濾 `distributor_sales_territory.continent_id`）。
- 移除 Sales Territory 的 **Region 分組與左欄 region 標籤**，改為與其他四類一致的**平鋪 inline checkbox**。
- 實作清理：`OfficeController::distributorCategories()` 加入 `$conid` 參數做地區過濾，並移除原本僅為取 region 名稱而做的 `continents`／`continents_translations` join、`region` 別名與重複查詢。
- 非 **BREAKING**：前台 Find a Distributor 篩選頁行為不變；Sales Offices（type_id=1）表單不受影響；DB schema、資料、pivot 皆不動。

## Capabilities

### New Capabilities

（無）

### Modified Capabilities

- `distributor-filter`：修改「後台維護經銷商與分類」requirement —— Distributors 編輯／新增表單的 Sales Territory 勾選範圍縮為該經銷商所屬地區，並改平鋪呈現（移除 Region 分組）。

## Impact

- 影響範圍：**Admin CRUD**（Distributors 編輯／新增表單）。不影響 Frontend、Landing、Redirect。
- **無 DB schema／migration／seeder 變更**。
- 受影響檔案：
  - `dependencies/app/Http/Controllers/OfficeController.php`（`distributorCategories()`）
  - `dependencies/resources/views/office/create.blade.php`（Sales Territory 渲染）
  - `dependencies/resources/views/office/edit.blade.php`（Sales Territory 渲染）
