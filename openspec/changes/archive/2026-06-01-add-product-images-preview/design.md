## 背景

Marketing Resources Downloads（`FrontendController@marketingResourcesDownloads` → `front-end/marketing-resources-downloads.blade.php`）依分類（`marketing_resource_cate` + permission）顯示，每筆為「檔名 + Download」列。下載走 `POST partnerLoginDoc_success`（`response()->download()` 強制附件），並驗合作夥伴 role 對該分類的權限（`permission_marketcate`）。檔案實體存於專案外 `uploads_delta/partner/marketing_resources/`。

關鍵限制：
- 既有下載為 attachment（強制下載），iframe/img 無法 inline 顯示 → 需另開 inline 端點。
- 站上圖片採 lazyload（`class="lazyload"` + `data-src`，由 all.js 處理），直接用 `src` + `loading="lazy"` 會被改成 `src="undefined"`。
- 有 CSP middleware：`img-src 'self'`、`frame-src 'self'`、`connect-src 'self'`（同源 img/iframe/fetch 皆允許）。
- Product Images 分類目前內容為 ZIP（人為打包），上傳程式不會自動轉檔；要真正當圖庫需 Delta 改上傳個別圖片。

## 目標 / 非目標

**目標：**
- Product Images 分類以縮圖網格呈現，hover 顯示檔名與預覽/下載，點預覽開彈窗看圖。
- 預覽沿用既有權限模型，僅圖片、僅 Product Images。

**非目標：**
- 不改其他分類（維持列表）。
- 不做 PDF/Excel/PPT 預覽（瀏覽器無法原生顯示；Office 需後端轉檔，另議）。
- 不做上傳上限 2GB（伺服器 php.ini/nginx，非程式）。
- 不做後端縮圖產生（目前直接以原圖當縮圖；量大時再優化）。

## 技術決策

### 1. inline 預覽端點（與下載分離）
新增 `GET /partners/marketing-resources/preview?doc=<檔名>` → `previewMarketingResource()`：以 `session('partner_id')`/`session('partner_role')` 驗權、`basename($doc)` 防穿越、副檔名限圖片（jpg/jpeg/png/gif/webp）、且該檔須屬該 role 可存取的 **Product Images** 分類（join `permission_marketcate` + `marketing_resource_cate_translations` 英文名 = 'Product Images'）。通過則 `response()->file($path)`（inline、自動 MIME）。任何失敗回傳極簡 HTML 小訊息（非整頁 404），因內容是塞在彈窗 iframe/img。

### 2. Product Images 分類定位
`marketing_resource_cate` 無 slug，故以英文分類名 'Product Images' 查 `previewCateId` 傳給 view；blade 以 `$cate->cate_id == $previewCateId` 決定該分類走網格。

### 3. 縮圖載入沿用 lazyload 慣例
`<img class="mr-img-thumb lazyload" data-src="{preview-url}&v={updated_at}">`。`data-src` 給 lazyload 填 `src`；`&v=updated_at` 作 cache-buster（換圖自動更新、避免舊快取）。縮圖即原圖（無縮放產生）。

### 4. hover bar（仿 News 卡 hover 展開）
卡片 `overflow:hidden`，底部 `.mr-img-bar` 預設 `translateY(100%)`，`:hover` → `translateY(0)`，內含檔名 + 預覽/下載 icon。觸控裝置（`@media (hover:none)`）直接顯示 bar。

### 5. 彈窗預覽
共用一個 Bootstrap modal，無 header、`modal-content` 透明、圖片填滿、右上角疊一個 X（`data-dismiss`）。點預覽先以 `fetch(HEAD)` 看 content-type：image → `<img>`、其餘（缺檔/notice）→ 小訊息，避免重複下載與大空白。

### 6. 非圖片（ZIP）卡片
以灰底佔位卡（顯示副檔名如 ZIP）+ hover bar 檔名與下載呈現，不提供預覽。

## 風險 / 取捨

- **取捨：縮圖=原圖**（無後端縮圖）→ 圖多/檔大時前台載入較重；未來可加縮圖產生（需圖片庫）。
- **相依：真正圖庫效果需 Delta 改上傳個別圖片**（現為 ZIP）。上傳程式不自動轉檔，屬操作習慣；ZIP 維持只能下載。
- **權限模型沿用既有**（信任 session role），與既有下載一致；inline 端點額外加副檔名與分類限制，較下載更嚴。

## 部署計畫

純前端 + 一個後端端點，**無 migration/seeder**。部署 3 個檔即可：`routes/web.php`、`FrontendController.php`、`marketing-resources-downloads.blade.php`。

## 待確認問題

- **Product Images 改上傳個別圖片？** 否則現有 ZIP 無縮圖、只能下載。
- **是否要後端產縮圖**以優化載入（量大時）？
- 上傳上限 2GB 的伺服器設定（另案、需主機權限）。
