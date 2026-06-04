## Context

searchAll 結果頁的產品卡由 `FrontendController@searchAll()`（約 `FrontendController.php:3507` 起）組裝 `$pro_results`，再由 `resources/views/front-end/resultsearch.blade.php` 渲染。產品卡目前的「Dimensions」區塊：

- 桌面卡：`resultsearch.blade.php` 約第 287 行起（`<div class="dimension">`），含標籤 `$staticContent['Dimensions']`、`$pro['dimensionL/W/D']`（mm + 英吋），其後接 Tags、Optional Models、Add to Compare。
- 行動卡：約第 494 行起的對應區塊。

**product 列表頁的既有做法（要比照）**：`product.blade.php` 在 grid 桌面（行 1967-1972）、grid 行動（行 2069-2074）、table 表頭（行 2135-2138）與 table 內容（行 2243-2244）共 4 處，皆以 `if (url_name == "wireless-charging-system")` 切換：
- 標籤用 `{{$staticContent['product_highLights']}}`（此 key 各語系 word 皆為 "Other Features"）。
- 內容用 `checkNullTexteditor(pro['short_features'])`。
- 其他類別則顯示 `{{$staticContent['Dimensions']}}` 與 L×W×D。

資料驗證（本機 DB）：
- `product_highLights` 在 `static_keyword_translations` 有 7 語系（en/tw/cn/de/jp/tr/ru），值皆 "Other Features"，**現成可用、不需新增**。
- `wireless-charging-system` 為 Industrial Battery Charging 唯一子類（cate_id=10）的 `url_item`。
- MOOVair 產品（pro_id 880-886）的 `short_features` 為 HTML `<ul><li>` bullet，逐產品內容不同，依 `local` 多語系，部分語系（如 tr）為空。
- searchAll 主 query（`FrontendController.php:3521`）已 `GROUP BY p.pro_id`，且已 select `MAX(sp.url_item) as url_item`、`dimensionL/W/D`；`$pro_results` map（約 3624 行）已含 `'url_item' => $pro->url_item`。**唯一缺的是 short_features**。

## Goals / Non-Goals

**Goals:**
- searchAll 頁僅對 `url_item == 'wireless-charging-system'` 產品卡，將 Dimensions 區塊替換為 Other Features（標籤 `product_highLights`、內容 `short_features`）。
- 與 product 列表頁採完全相同的判斷條件與標籤來源。
- 桌面與行動卡行為一致；其他類別、其他頁面完全不變。
- **完全不碰 DB**（不改 schema、不新增/修改資料）。

**Non-Goals:**
- 不修改 `product.blade.php`、`productdetails.blade.php` 或其他頁面。
- 不新建 static_keyword key、不寫 seeder。
- 不變更 searchAll 排序/篩選邏輯，不調整其他搜尋結果區塊。
- 不提供 Other Features 後台編輯介面（沿用既有 short_features 編輯流程）。

## Decisions

**判斷依據用既有的 `$pro['url_item'] == 'wireless-charging-system'`。**
理由：與 product 列表頁 4 處判斷完全一致；searchAll 的 `$pro` 已含 `url_item`（query `MAX(sp.url_item)`、map 已輸出），**不需新增任何 join 或欄位**。
替代方案：join `categories_has_main_pro` 取 `main_cateid==4`（多一個 join，且與 product 列表頁判斷方式不一致），不採用。

**標籤重用既有 key `product_highLights`，不新建。**
`$staticContent['product_highLights']` 各語系皆為 "Other Features"，由既有 ShareData middleware 注入，與 product 列表頁同源。完全不需 seeder 或 DB 異動。

**`short_features` 以 `LEFT JOIN products_translation` 取得（唯一的 controller 改動）。**
`LEFT JOIN products_translation as pt ON pt.product_id = p.pro_id AND pt.local = $lang`，select `MAX(pt.short_features) as short_features`（用 MAX 聚合以相容既有 `GROUP BY p.pro_id`）。`$pro_results` map 補 `'short_features' => $pro->short_features`。沿用「join on local = $lang」翻譯慣例。

**空值處理：顯示標籤、內容留空，不 fallback。**
`wireless-charging-system` 產品一律顯示 Other Features 標籤以維持類別內一致性；`short_features` 為空時內容區留空（與 product 列表頁同類行為）。blade 直接 `{!! $pro['short_features'] !!}`，空字串即不顯示內容。

**Blade 編輯定位（大檔案，需唯一上下文）。**
桌面卡搜尋字串：`<div class="dimension">` 後接 `{{$staticContent['Dimensions']}}`（約 287-302 行），用 `@if($pro['url_item'] == 'wireless-charging-system')` 包成 product_highLights 標籤 + short_features / `@else` 維持原 Dimensions；Tags/Optional Models/Add to Compare 留在條件外。行動卡以對應的 `text-title-ft-sub` + Dimensions 區塊（約 494 行）比照處理。`short_features` 以 `{!! !!}` 輸出（含 HTML），與 product 列表頁一致。

## Risks / Trade-offs

- **[GROUP BY 相容性]** 新增的 `short_features` 必須以 `MAX(...)` 包起，否則 `ONLY_FULL_GROUP_BY` 模式下 query 報錯 → 用 `MAX(pt.short_features)`，不加入 GROUP BY 子句。
- **[short_features 為 HTML，XSS]** 以 `{!! !!}` 渲染 → 資料僅來自後台管理員輸入，且 product 列表頁既有做法相同，風險與現況一致；不在本變更額外處理。
- **[url_item 聚合]** `MAX(sp.url_item)` 在產品跨多子類時取字母序最大者；僅當值等於 `'wireless-charging-system'` 才觸發，其他產品不會誤觸（除非該產品確實屬於此子類），風險低。
- **[行動/桌面不一致]** 兩段 blade 縮排與結構略有差異 → 分別讀取確認後再各自編輯。

## Migration Plan

1. 改 `FrontendController@searchAll` query（補 `products_translation` join 與 `MAX(short_features)`）與 `$pro_results` map（補 `short_features`）。
2. 改 `resultsearch.blade.php` 桌面卡與行動卡兩處條件分支。
3. 本機驗證：搜尋 moov 確認 wireless-charging 卡顯示 Other Features、其他類別仍 Dimensions、各語系標籤正確、tr 語系內容留空不報錯。

**Rollback：** 還原 blade 條件與 controller 的 short_features 欄位即可；無任何 DB 異動需回復。

## Open Questions

- 無。標籤、內容、判斷依據皆使用既有資料與既有條件，無待確認項。

## Notes

- `resultsearch.blade.php` 另被 `searchByTag`、`searchByOptionalModel` 兩個 method 共用，但這兩者未傳齊 view 變數（缺 `$industryKnowHow` 等，僅傳 applications/margetCate/margeting），在 `resultsearch.blade.php:77` 的 `count($industryKnowHow)` 即拋例外 → **本變更前就是 HTTP 500**（既有 bug，與本變更無關）。本次僅實作 searchAll；該兩個 method 維持原狀（已回退試加的 short_features），其 pre-existing 500 另案處理。
