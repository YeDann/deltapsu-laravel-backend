## 1. 後端預覽端點

- [x] 1.1 `routes/web.php`：新增 `GET /partners/marketing-resources/preview` → `FrontendController@previewMarketingResource`（LaravelLocalization 群組內）
- [x] 1.2 `FrontendController@previewMarketingResource`：驗 partner session、`basename` 防穿越、限圖片副檔名、限 Product Images 分類 + role 權限；通過回 `response()->file()`（inline），失敗回極簡 HTML 小訊息
- [x] 1.3 `FrontendController@marketingResourcesDownloads`：以英文分類名 'Product Images' 查 `previewCateId` 並傳給 view

## 2. 前端 Product Images 縮圖網格

- [x] 2.1 `marketing-resources-downloads.blade.php`：Product Images 分類（`$cate->cate_id == $previewCateId`）改為 `.mr-image-grid` 縮圖網格；其他分類維持列表
- [x] 2.2 圖片卡：`<img class="mr-img-thumb lazyload" data-src="preview-url&v={updated_at}">`（lazyload 慣例 + cache-buster）；非圖片卡：灰底佔位（副檔名）
- [x] 2.3 hover bar：底部滑出 `.mr-img-bar`，左檔名、右預覽(👁)/下載(⬇) icon；觸控裝置直接顯示
- [x] 2.4 預覽彈窗：無 header、透明 content、純圖片、右上角 X；點預覽先 `fetch(HEAD)` 判類型（圖片→img，其餘→小訊息）
- [x] 2.5 搜尋（`searchmarketingbycate`）動態結果：Product Images 同樣產出縮圖卡，其他分類產出列表

## 3. 驗證

- [x] 3.1 後端：未登入打預覽端點回 403/小訊息；帶 partner session 打圖片回 `image/png`（curl 實測）
- [x] 3.2 前端：Product Images 縮圖正常顯示（lazyload data-src）、hover 出檔名 bar 與 icon、點預覽開無框彈窗
- [x] 3.3 非圖片（ZIP）以佔位卡 + 下載呈現、無預覽；其他分類維持列表
- [x] 3.4 待 Delta 確認：Product Images 改上傳個別圖片（現為 ZIP，否則縮圖無圖可顯示）；上傳上限 2GB（伺服器設定，另案）
