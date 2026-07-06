## Why

Marketing Resources Downloads 的「依名稱搜尋」在 Product Images / Videos 分頁實測有兩個問題：

1. **搜尋不過濾**：每個分頁的搜尋 form 共用 `name="modelname"`／`name="cateid"`，JS 用全域 `$("input[name=modelname]")` 只會取到 DOM 第一個分頁（Catalogs）的值，在其他分頁搜尋等於拿到空字串、regex `//` 配中全部；結果又以全域 `$('.contentdatasearch')` 塞進所有分頁。
2. **搜尋結果圖片破圖**：動態注入的圖片用 `class="lazyload" data-src`，但站上 lazyload 只處理初始 DOM、不接手動態節點；搜尋後只重新處理影片（`mrObserveVideos`）、未處理圖片，導致 `data-src` 未載入成 `src`。

## What Changes

- 搜尋 MUST 限定在**當前 active 分頁**內取值與渲染：改用 `$('.tab-pane.active')` 內的 `modelname`／`cateid`，結果只更新該分頁的 `.contentdatasearch`，不再污染其他分頁。
- 搜尋後動態注入的圖片 MUST 手動載入 `data-src`→`src`（新增 `mrLoadImages()`，對稱於影片的 `mrObserveVideos()`），修正破圖。

## Capabilities

### New Capabilities

- `product-images-gallery`：補記「行銷資源分類內名稱搜尋」requirement（限定當前分頁取值/渲染、搜尋結果沿用分頁呈現、結果圖片正常載入）。

### Modified Capabilities

（無）

## Impact

- 影響範圍：**Frontend**（合作夥伴 Marketing Resources Downloads 搜尋）。純前端 JS，無 schema／controller 變更。
- 受影響檔案：
  - `dependencies/resources/views/front-end/marketing-resources-downloads.blade.php`（`searchmarketingbycate()` 取值/渲染限定當前分頁、新增 `mrLoadImages()`）
- 部署：清 view cache（`php artisan view:clear`）即生效。
