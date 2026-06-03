## 1. Controller（FrontendController@searchAll）

- [x] 1.1 主 query（約 `FrontendController.php:3521`）加 `LEFT JOIN products_translation as pt ON pt.product_id = p.pro_id AND pt.local = $lang`
- [x] 1.2 select 補 `MAX(pt.short_features) as short_features`（用聚合函式，不動既有 GROUP BY）
- [x] 1.3 `$pro_results` map（約 `FrontendController.php:3624`）補 `'short_features' => $pro->short_features`（`url_item` 已存在，無需新增）

## 2. Blade — 桌面卡（resultsearch.blade.php）

- [x] 2.1 定位桌面卡 `<div class="dimension">` 內 `{{$staticContent['Dimensions']}}` 區塊（約 287-302 行）
- [x] 2.2 包成 `@if($pro['url_item'] == 'wireless-charging-system')`：顯示 `{{ $staticContent['product_highLights'] }}` 標籤 + `{!! $pro['short_features'] !!}`；`@else` 維持原 Dimensions 標籤與 L×W×D 內容
- [x] 2.3 確認 Tags、Optional Models、Add to Compare 留在條件分支之外，不受影響

## 3. Blade — 行動卡（resultsearch.blade.php）

- [x] 3.1 定位行動卡對應的 Dimensions 區塊（約 494 行）
- [x] 3.2 比照桌面卡套用 `@if($pro['url_item'] == 'wireless-charging-system')` 條件分支，確認縮排與結構正確

## 4. 本機驗證

- [x] 4.1 搜尋 `moov`：確認 wireless-charging 產品卡（桌面+行動）顯示「Other Features」與該產品 short_features bullet，不再顯示尺寸
- [x] 4.2 確認其他類別（如 Industrial / Medical / LED Driver）產品卡仍顯示「Dimensions」L×W×D，未受影響
- [x] 4.3 切換各語系（en/tw/cn/de/jp/tr）確認標籤顯示 "Other Features"；tr 等 short_features 為空時內容留空且頁面不報錯
- [x] 4.4 確認 product 列表頁、productdetails 等其他頁面與 DB 資料完全未改變
