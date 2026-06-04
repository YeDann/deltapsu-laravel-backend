## 1. 搜尋限定當前分頁

- [x] 1.1 `searchmarketingbycate()` 改用 `$('.tab-pane.active')` 取 `modelname`／`cateid`（取代全域 `$("input[name=...]")`）
- [x] 1.2 結果改塞 `$pane.find('.contentdatasearch')`（取代全域 `$('.contentdatasearch')`），不污染其他分頁
- [x] 1.3 移除殘留的 `console.log(cateid)` debug

## 2. 搜尋結果圖片載入

- [x] 2.1 新增 `mrLoadImages()`：把動態注入的 `.mr-img-thumb[data-src]` 手動設 `src`（站上 lazyload 只處理初始 DOM）
- [x] 2.2 `searchmarketingbycate()` 渲染後呼叫 `mrLoadImages()`（對稱於 `mrObserveVideos()`）

## 3. 驗證

- [x] 3.1 `php artisan view:clear` 後，Product Images / Videos 分頁搜尋：filter 正確、圖片不破、影片正常
- [x] 3.2 其他分頁（Catalogs 等）搜尋不互相污染
