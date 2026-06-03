## Context

`product-images-gallery`（change `add-product-images-preview` 封存）已提供 Product Images 圖片縮圖網格 + inline 預覽端點 `previewMarketingResource`。本變更在其上擴充影片，並解決大檔上傳。專案為 Laravel 9 + PHP 8.2。檔案存於 `<repo>/uploads_delta/partner/marketing_resources/`，`public/uploads_delta` 為 symlink（同源可直接由 web server serve）。分類定位原以寫死英文名 `'Product Images'` 比對。

## Goals / Non-Goals

**Goals:**
- 圖庫混排圖片與影片，影片可辨識、可預覽播放、靜止有縮圖、桌機 hover/手機捲動播放。
- 大檔（最高 2GB）可靠上傳（create + edit），且免把伺服器單一上限拉到 2GB；頁面載入不被大影片拖慢。

**Non-Goals:**
- ffmpeg 伺服器端封面（改瀏覽器端 canvas 擷取）；影片轉碼/faststart（屬 Delta 上傳前處理）。
- 重構全站 44 個 `config('app.url')` 資產 URL（改以 CSP local 放行解 host 不一致）。

## Decisions

- **分塊上傳用 `pion/laravel-chunk-upload` + resumable.js（vendored），共用 JS 模組 `mr-chunk-upload.js`**（create 單檔、edit 逐語系多檔皆用同一模組，避免重複）。每塊 1MB → 單塊遠小於 `post_max_size`/`upload_max_filesize`/nginx 上限，2GB 免改主機單一上限（prod nginx `client_max_body_size` 只需 ≥ 數 MB）。上傳與表單解耦：分塊傳到 `chunkUpload` 收齊重組後回最終檔名，表單以 `file_uploaded`(create)／`file_uploaded[locale]`(edit) 送出，`store`/`update` 用該檔名（取代 `$request->file()->move()`）。
- **影片串流改 302 轉址靜態檔**：`previewMarketingResource` 對影片在權限通過後 `redirect(asset('uploads_delta/...'))`，交給 web server（支援 HTTP Range、不吃 PHP `max_execution_time`），避免 `response()->file()` 串流大檔逾時（`BinaryFileResponse` 逾 30s 致命錯誤）。圖片維持 `response()->file()` inline。
- **影片縮圖（poster）瀏覽器端產生**：上傳時以隱藏 `<video>` + `<canvas>` 擷取一幀（`loadedmetadata`→seek→`seeked`→`toBlob`），POST 到 `savePoster` 存為「影片同名 .jpg」；前台 `<video poster>` 顯示。理由：無 ffmpeg；避免靜止為了顯示第一幀去載整支大檔（非 faststart 會拉整檔）。代價：僅新上傳且瀏覽器能解該格式者有縮圖。
- **影片 lazy-load + 播放策略**：縮圖 `<video data-src preload="none">`；`IntersectionObserver`(0.6) 捲入才設 src。桌機（`hover: hover`）hover 播放、不在捲動時自動播；手機（`hover: none`）捲入自動靜音播、捲出暫停。開預覽彈窗暫停所有縮圖、關閉後手機重播在視窗內者。
- **分類定位改名單比對**：`marketing_resource_cate` 無 slug 欄；controller 改 `whereIn('name', ['Product Images','Product Images / Videos'])`（env-safe、撐得住更名）。更名以 migration 更新各語系（en/de/tr/ru 英文、tw/cn/jp 在地化）。
- **基礎建設 bug 修正**：`ModifyRedirects` 原本無條件 301（破壞 POST-redirect-GET 與 auth，且 302→301 被瀏覽器永久快取使 AJAX/表單卡在導 login）→ 改成只對 GET 且非導 login 套 301。`ContentSecurityPolicy` `media-src` 加 `blob:`（縮圖擷取用 blob video）、local 放行 localhost/127.0.0.1（前後台不同 host 時同源資產被擋）。

## Risks / Trade-offs

- [vendor 被 gitignore → UAT/prod 缺 pion 套件 fatal] → 部署改跑 `composer install`（記憶/部署筆記原只寫 dump-autoload，需更新）。
- [大檔且非 faststart → 開始播放仍需 buffer] → 頁面載入已不受影響；順播需 Delta 上傳前轉 faststart + 壓小。
- [瀏覽器端 poster 僅新上傳/支援格式有效；mov 在部分瀏覽器解不出] → 舊影片需重新上傳取得縮圖；缺 poster 時前台 `<video poster>` 404 後退回深色底（不破版）。
- [`ModifyRedirects` 改窄了行為] → 屬修正既有 bug；GET 非 login 的 SEO 301 仍保留。

## Migration Plan

部署：`composer install`（裝 pion）→ `php artisan migrate`（分類更名）。Rollback：還原相關檔 + `php artisan migrate:rollback`（migration 提供 down 還原舊名）+ `composer remove pion/laravel-chunk-upload`。

## Open Questions

無。
