## 為什麼

Phase II ④ Partner Portal（投影片 Slide 9）：合作夥伴的「Marketing Resources Downloads」頁目前只有「檔名 + Download」列表、無法預覽。客戶希望像 Delta Media Center 一樣，圖片以縮圖圖庫呈現、可線上預覽。

經與客戶確認，本變更聚焦在 **Product Images 分類的圖片預覽**（縮圖網格 + 線上預覽），其餘分類（Catalogs/Leaflets/Sales Tool/Product Cross Reference，內容多為 PDF）維持原本列表。Slide 9 另提到的「上傳上限 20MB→2GB」屬伺服器設定（php.ini/nginx），不在本變更範圍。

## 變更內容

- **後端預覽端點**：新增 `GET previewMarketingResource`，以 inline（瀏覽器內顯示而非下載）回傳檔案，沿用既有合作夥伴下載的權限檢查，僅允許圖片且限定 Product Images 分類，`basename` 防路徑穿越，失敗時回傳乾淨的小訊息（非整頁網站）。
- **前端**：Product Images 分類改為縮圖網格（媒體中心風格）。每張卡片平常只顯示縮圖；hover 時底部滑出小 bar 顯示「檔名 + 預覽(👁) + 下載(⬇)」。圖片才有預覽，非圖片（如 ZIP）以佔位卡呈現、只給下載。點預覽開無框彈窗（純圖片、右上角 X）。
- 縮圖沿用站上 lazyload 慣例（`class="lazyload"` + `data-src`），並以檔案 `updated_at` 作為 cache-buster；預覽前以 HEAD 預檢回傳類型，避免重複下載。

## 功能範圍

### 新功能

- `product-images-gallery`：Marketing Resources Downloads 的 Product Images 分類圖片縮圖網格與線上預覽（hover 檔名列、預覽/下載、彈窗預覽）。

### 修改既有功能

- 既有 `marketingResourcesDownloads` 頁面：Product Images 分類由列表改為縮圖網格；其他分類維持列表。

## 影響範圍

僅 **Frontend 頁面 + 一個後端預覽端點**，**無資料庫 schema 異動、無 migration、無 seeder**（沿用既有 `marketing_resource` 系列表；以英文分類名 "Product Images" 定位分類）。

- `dependencies/routes/web.php`：新增 `previewMarketingResource` GET route
- `dependencies/app/Http/Controllers/FrontendController.php`：新增 `previewMarketingResource()`，`marketingResourcesDownloads()` 帶出 `previewCateId`
- `dependencies/resources/views/front-end/marketing-resources-downloads.blade.php`：Product Images 縮圖網格、hover bar、預覽彈窗與 JS
