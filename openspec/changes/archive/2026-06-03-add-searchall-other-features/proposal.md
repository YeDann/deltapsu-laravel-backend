## Why

Delta 0528 追加需求：搜尋結果頁（searchAll）上，Industrial Battery Charging（MOOVair 系列，子分類 `wireless-charging-system`）的產品卡目前顯示「Dimensions（L×W×D 尺寸）」，但這類產品對使用者而言「尺寸」並非主要選型資訊，反而是 IP 防護等級、效率、通訊介面等特性更有參考價值。產品列表頁（`product.blade.php`）對此類別早已改顯示「Other Features」，searchAll 頁需比照一致。

## What Changes

本變更只影響 **Frontend pages（searchAll 搜尋結果頁）**，不動 Admin CRUD、Landing page、Redirect system，**不變更 DB schema、不新增或修改任何 DB 資料**。

- searchAll 產品卡：**僅對子分類 `wireless-charging-system`（Industrial Battery Charging）的產品**，把「Dimensions」標籤與 L×W×D 內容整塊替換為「Other Features」標籤與 `products_translation.short_features` 內容。
- 判斷依據沿用 product 列表頁既有條件 `url_item == 'wireless-charging-system'`（searchAll 的 `$pro` 已含 `url_item`）。
- 標籤**重用** product 列表頁既有的多語系 key `product_highLights`（各語系 word 皆已為 "Other Features"），不新建 key、不寫 seeder。
- 桌面版與行動版產品卡兩處皆套用相同條件。
- short_features 為空時（部分產品或部分語言未填）顯示「Other Features」標籤、內容留空，不 fallback 回尺寸。
- 其他子分類的產品卡維持原本 Dimensions 顯示完全不變；不修改 `product.blade.php`、`productdetails.blade.php` 或其他頁面；不更動任何既有產品資料。

## Capabilities

### New Capabilities
- `searchall-other-features`: searchAll 搜尋結果頁針對 `wireless-charging-system`（Industrial Battery Charging）產品卡，以「Other Features」（標籤重用 `product_highLights`、內容取自 `products_translation.short_features`）取代「Dimensions」的顯示行為與範圍限制。

### Modified Capabilities
<!-- 無：不變更任何既有 spec 的 requirement。 -->

## Impact

- **影響頁面**：Frontend — searchAll 搜尋結果頁（`/{lang}/searchAll/{key?}`）。
- **影響檔案**：
  - `app/Http/Controllers/FrontendController.php` — `searchAll()` 的產品 query 補 `LEFT JOIN products_translation` 取 `MAX(short_features)`，`$pro_results` 補 `short_features` 一個 key。
  - `resources/views/front-end/resultsearch.blade.php` — 桌面卡與行動卡的 Dimensions 區塊加上 `url_item == 'wireless-charging-system'` 條件分支。
- **資料庫**：完全不動（不改 schema、不新增/修改任何資料）；標籤與內容皆使用既有資料（`product_highLights`、`short_features`）。
- **相依/風險**：低。條件分支只在 `url_item == 'wireless-charging-system'` 生效，其他類別走原邏輯；不影響排序、篩選、其他搜尋結果區塊（news/events/applications 等）。與 product 列表頁採完全相同的判斷與標籤來源。
