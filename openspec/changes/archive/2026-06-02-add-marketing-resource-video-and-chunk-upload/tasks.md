## 1. 影片圖庫（product-images-gallery）

- [x] 1.1 `FrontendController::marketingResourcesDownloads` — `previewCateId` 改 `whereIn(['Product Images','Product Images / Videos'])`
- [x] 1.2 `FrontendController::previewMarketingResource` — 白名單加 mp4/webm/mov、範圍 `whereIn`；**影片改 302 轉址靜態檔**（Range 串流、不吃 PHP 逾時），圖片維持 inline
- [x] 1.3 blade grid — 影片 `<video data-src preload="none" muted playsinline poster>` + ▶ 角標；圖片縮圖；其他佔位
- [x] 1.4 blade 搜尋結果 JS — 同步影片渲染（data-src + ▶ + poster）
- [x] 1.5 blade 預覽彈窗 — content-type video → `<video controls autoplay>`；開啟先暫停所有縮圖、aria-hidden 前先 blur
- [x] 1.6 blade — IntersectionObserver：lazy-load + 手機捲入播/捲出暫停；桌機 hover 播放；關閉彈窗後手機重播在視窗內者
- [x] 1.7 blade — tab 間距 32px→16px（更名後不換行）
- [x] 1.8 migration — cate_id=6 更名 Product Images / Videos（en/de/tr/ru 英文、tw/cn/jp 在地化）、已執行

## 2. 分塊上傳（marketing-resource-chunk-upload）

- [x] 2.1 `composer require pion/laravel-chunk-upload`（Laravel 9 自動 discovery）
- [x] 2.2 vendored `resumable.js` + 共用模組 `mr-chunk-upload.js`（置於 `backend-asset/js/`，public 為 symlink）
- [x] 2.3 路由 `POST MarketResource/chunk`→`chunkUpload`、`POST MarketResource/poster`→`savePoster`（auth 群組、resource 前以保優先）
- [x] 2.4 `chunkUpload` + `saveChunkedFile`（FileReceiver 收塊、收齊重組 move、回最終檔名）
- [x] 2.5 `savePoster`（存瀏覽器端擷取的影片同名 .jpg）
- [x] 2.6 `store` 改吃 `file_uploaded`；`update` 改吃 `file_uploaded[locale]`（`applyChunkedFiles`，取代 `UpdateOldfile`）
- [x] 2.7 `deleteResourceFile`（刪檔連同影片縮圖）；`destroy` 與換檔皆使用
- [x] 2.8 `create.blade` / `edit.blade` 改用共用模組：進度條、hidden `file_uploaded`、完成前禁送出、影片瀏覽器端擷取縮圖；edit 逐語系各一組

## 3. 基礎建設修正

- [x] 3.1 `ModifyRedirects` — 只對 GET 且非導 login 套 301（修 302→301 被永久快取、AJAX/表單卡死）
- [x] 3.2 `ContentSecurityPolicy` — `media-src` 加 `blob:`（縮圖擷取）；local 放行 localhost/127.0.0.1（前後台不同 host 同源資產）

## 4. 驗證

- [x] 4.1 改過的 PHP `php -l` 全通過；`view:cache` 全 blade 編譯通過
- [x] 4.2 `route:list` 確認 chunk/poster 註冊、app boot（pion 可解析）；migration 已跑
- [x] 4.3 curl 確認 poster 端點未登入導向為 302（非 301）；影片靜態檔 HEAD 200
- [x] 4.4 瀏覽器實測：create/edit 大檔上傳、影片縮圖產生、hover/手機捲動播放、刪除清縮圖（待使用者實測）
