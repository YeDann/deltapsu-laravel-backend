## Why

Partner Portal 的 Marketing Resources「Product Images」圖庫原本只支援圖片，且後台上傳受 80MB JS 限制與伺服器 `post_max_size`(8M)/`upload_max_filesize`(2M) 限制，無法上傳高畫質影片或 2GB 大檔（單一表單 POST 一律 413 PostTooLarge）。需擴充為「Product Images / Videos」圖庫並讓大檔可靠上傳。過程中也修正了兩個會卡住此功能的既有基礎建設 bug（全域 301 轉址被瀏覽器永久快取、CSP 未放行 blob 媒體）。

## What Changes

- **影片圖庫**（前台 Partner Portal）：Product Images 更名 **Product Images / Videos**（含 cn/jp/tw 在地化），混排圖片與影片（mp4/webm/mov）。
  - 影片縮圖以 `<video>` 呈現、右上 ▶ 角標；以 `data-src` + `preload="none"` **lazy-load**（捲入才載，避免大檔拖慢頁面）。
  - **桌機 hover 播放（靜音）、手機捲入視窗自動播放、捲出暫停**；開預覽彈窗暫停背景縮圖、關閉後手機接著播。
  - 影片可預覽：點 👁／點縮圖開彈窗以 `<video controls>` 播放（有聲）。
  - 靜止顯示**瀏覽器端擷取的縮圖（poster）**，避免黑屏。
  - inline 預覽端點放行影片副檔名；**影片改 302 轉址到靜態檔**交給 web server 串流（支援 Range、不吃 PHP `max_execution_time`，避免大檔逾時）。分類定位以英文名單比對（撐得住更名）。
  - tab 間距縮小，更名後不換行。
- **大檔分塊上傳（最高 2GB，create + edit）**：後台 Marketing Resources 新增／編輯表單改用 **resumable.js + `pion/laravel-chunk-upload`**（共用 JS 模組 `mr-chunk-upload.js`）。
  - 每塊 1MB → **繞過 `post_max_size`/`upload_max_filesize`/nginx 上限**，免把伺服器單一上限拉到 2GB。收齊重組後 move、回傳最終檔名；表單以檔名（`file_uploaded`）送出。
  - 有進度條、上傳完成前禁止送出。**影片上傳時瀏覽器端 canvas 擷取縮圖**上傳存為同名 .jpg。
  - 刪除資源／編輯換檔時，連同同名縮圖一併清除。
- **基礎建設修正**：
  - `ModifyRedirects`：原本無腦把所有 redirect 改 301 → 改成**只對 GET 且非導向 login** 套 301，POST/AJAX 與導 login 維持 302（修正 302→301 被瀏覽器永久快取、導致 AJAX/表單卡死的 bug）。
  - `ContentSecurityPolicy`：`media-src` 加 `blob:`（瀏覽器端縮圖擷取需要）；local 環境放行 `localhost`/`127.0.0.1`（前後台不同 host 時，寫死 `config('app.url')` 的同源資產不被 CSP 擋）。

## Capabilities

### New Capabilities

- `marketing-resource-chunk-upload`：後台行銷資源檔案的分塊上傳（最高 2GB、免拉高伺服器單一上限）、影片瀏覽器端縮圖產生、刪除／換檔清理。

### Modified Capabilities

- `product-images-gallery`：圖庫由「只圖片」擴充為「圖片 + 影片」（更名、影片 `<video>` 縮圖與 poster、桌機/手機播放行為、預覽彈窗影片、影片靜態串流）。

## Impact

- 影響範圍：**Admin CRUD**（Marketing Resources 新增/編輯上傳）、**Frontend**（Partner Portal 圖庫頁），以及兩個**全站共用 middleware**（ModifyRedirects、ContentSecurityPolicy）。
- 新增 composer 依賴 `pion/laravel-chunk-upload`：**`vendor/` 被 gitignore，UAT/prod 部署必須跑 `composer install`（非僅 dump-autoload）**。
- 新增 migration 更名分類（cate_id=6 各語系），需 `php artisan migrate`。
- 受影響檔案：
  - `dependencies/app/Http/Controllers/FrontendController.php`（`marketingResourcesDownloads`、`previewMarketingResource`）
  - `dependencies/app/Http/Controllers/MarketResourceController.php`（`chunkUpload`、`savePoster`、`store`、`update`、`applyChunkedFiles`、`deleteResourceFile`、`destroy`）
  - `dependencies/app/Http/Middleware/ModifyRedirects.php`、`ContentSecurityPolicy.php`
  - `dependencies/routes/web.php`（`MarketResource.chunk`、`MarketResource.poster`）
  - `dependencies/resources/views/front-end/marketing-resources-downloads.blade.php`
  - `dependencies/resources/views/MarketResource/create.blade.php`、`edit.blade.php`
  - `dependencies/database/migrations/2026_06_01_000001_rename_product_images_cate_to_videos.php`
  - `backend-asset/js/resumable.js`、`backend-asset/js/mr-chunk-upload.js`（vendored，public 為 symlink）
  - `dependencies/composer.json` / `composer.lock`
- **未做**：無 ffmpeg 影片封面（poster 由瀏覽器端擷取，僅對「上傳當下」與支援該格式的瀏覽器有效；既有舊影片需重新上傳才有縮圖）。
