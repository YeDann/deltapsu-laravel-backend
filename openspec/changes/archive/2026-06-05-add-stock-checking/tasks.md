## 1. Config 與憑證

- [x] 1.1 在 `config/services.php` 新增 `dilp` 區塊：`base_url` / `username` / `password` / `token_ttl`(預設 840) / `cache_ttl`(預設 300) / `mock`，皆以 `env()` 讀取
- [x] 1.2 在 `.env` 補上 `DILP_BASE_URL`、`DILP_USERNAME`、`DILP_PASSWORD`（密碼加單引號）、`DILP_MOCK=true`；測試環境填 `apitest.netcomponents.com` 與測試帳密
- [x] 1.3 在 `.env.example` 補上同名 key（空值或佔位），讓 ops 知道要設定哪些變數

## 2. DilpClient Service

- [x] 2.1 新增 `app/Services/Dilp/DilpClient.php`，建構式由 `config('services.dilp')` 取得設定
- [x] 2.2 實作 `authToken()`：先讀 Laravel Cache；無則 `POST {base}/Login?TTL=900` 帶 `Authorization: Basic base64(user:pass)` 與**空 body（確保有 Content-Length，避免 411）**，解析 `AuthToken` 後存 Cache（TTL = `token_ttl`）
- [x] 2.3 實作 `search($proCode)`：`GET {base}/Search?pn1=<urlencode>&SearchType=EQUALS&ClientIP=<req ip>` 帶 `Authorization: {AuthToken}`；遇 401 清 token 後重新登入一次再重試
- [x] 2.4 將 `SearchedParts[0].Parts[]` 逐筆 map 成 `['part'=>PartNumber, 'distributor'=>Distributor.Name, 'availability'=>Quantity, 'buyUrl'=>Distributor.ShoppingCartLink.URL ?? null]`；查無結果回空陣列
- [x] 2.5 加結果短快取：以 `dilp_stock_{proCode}` 為 key 快取整理後陣列（TTL = `cache_ttl`）
- [x] 2.6 mock 模式：當 `config('services.dilp.mock')` 為真，`search()` 直接回固定 fixture（含「有購物車網址」與「無購物車網址」各至少一筆，如 Mouser / DigiKey / Farnell），不打真實 API

## 3. Controller 與 Route

- [x] 3.1 新增 `app/Http/Controllers/StockController.php` 的 `check(Request $request)`：驗證 `code`（必填），呼叫 `DilpClient->search($code)`，回 `{ok:true, rows:[...]}`
- [x] 3.2 `check()` 以 try/catch 包住，DILP 失敗或例外時回 `{ok:false}`（HTTP 200，讓前台優雅顯示），並記錄 log
- [x] 3.3 在 `routes/web.php` 的 LaravelLocalization group 內新增 `GET stock-check` → `StockController@check`，命名 `stockCheck`（**須置於 `/{page?}` 萬用路由之前，否則單段路徑被 index 攔截**）

## 4. i18n（Modal 多語文字）

- [x] 4.1 新增獨立 `database/seeds/StockModalKeywordSeeder.php`（**不修改 stock-icon 的 `StockKeywordSeeder`**）並於 `DatabaseSeeder` 註冊，含 keyword：`Stock_model_number`、`Stock_distributor`、`Stock_availability`、`Stock_buy_now`、`Stock_no_results`、`Stock_loading`、`Stock_error`，各補六語系（en、tw、cn、de、jp、tr；en 預設值如 Model Number / Distributor / Availability / Buy Now / No stock found / Loading… / Unable to load stock）
- [x] 4.2 `composer dump-autoload`（seeds 走 classmap）→ `php artisan db:seed --class='\StockModalKeywordSeeder'` → `php artisan cache:clear`，確認 `$staticContent[...]` 各語系皆有值（已驗：7 keyword × 6 語系全到位）

## 5. Frontend Modal（product.blade.php）

- [x] 5.1 在 `product.blade.php` `@section` 內容尾端新增一份共用 Bootstrap Modal 標記（標題放料號 + ✕、表頭 Model Number / Distributor / Availability / Buy Now、含 載入中 / 查無庫存 / 錯誤 三種狀態容器），欄位標題用 `{{$staticContent[...]}}`
- [x] 5.2 改寫 `checkStock(proCode)`（約 line 840）：開啟 Modal 並顯示載入中 → `$.get` 呼叫 `route('stockCheck')` 帶 `code=proCode` → 成功且有列則渲染表格、0 列顯示「查無庫存」、`ok:false` 或 AJAX error 顯示「錯誤」
- [x] 5.3 表格每列渲染：料號 / 經銷商 / 數量 / Buy Now；有 `buyUrl`（且為 http(s)）→ `<a target="_blank" rel="noopener">`，無 → disable 按鈕（DOM 建構，避免 XSS）
- [x] 5.4 確認三處 Stock 按鈕 render（約 line 1994 / 2093 / 2199）皆已呼叫 `checkStock(pro['pro_code'])`，共用此 Modal（不需各自複製）

## 6. 驗證

- [x] 6.1 驗證 DilpClient / 端點邏輯（**依專案慣例不保留自動化測試、本專案無 CI**）：tinker mock 模式跑 `search()` 回 3 筆 fixture（含 buyUrl=null 的 disable 情境）；真 dev server `curl /en/stock-check?code=X` 確認 Login→Search→JSON 整條回 200 + 正確 rows、無 code 回 `{ok:false}`
- [x] 6.2 `php -l` 檢查新增 PHP 檔（綠）；`product.blade.php` Blade compileString 通過
- [x] 6.3 本機（`DILP_MOCK=true`）瀏覽器點 Stock，驗證桌機 grid / 手機 grid / list 三版型皆開 Modal、表格 / Buy Now（可點與停用）/ 載入中 / 查無庫存 / 錯誤 狀態正常 —— 端點已用真 dev server `curl` 驗證回 200 + 正確 JSON；**瀏覽器已實際確認（含手機版 iPhone SE）**
- [x] 6.4 切換各語系，確認 Modal 欄位標題與狀態訊息顯示對應翻譯、缺翻譯 fallback 英文 —— 資料面已驗（keyword × 6 語系全到位）；**瀏覽器已實際確認（含 cn 等語系）**

## 7. 國別篩選（後加）

- [x] 7.1 `DilpClient::mapParts` 多 map `country`(`Distributor.MultiCountry.Primary.ShortCode`) + `countryName`（新增 `countryName()` helper：站台 locale→intl，`Locale::getDisplayRegion` 在地化）；`mockRows` 補國別（US/US/GB）
- [x] 7.2 Modal header 右上加膠囊 `<select id="stockRegion">`（預設 `Stock_all_regions`）+ scoped CSS；`checkStock` 依結果動態填國別（顯示當前語系國名、值用代碼）、列帶 `data-country`、每次開重置、綁 change 篩選；無國別則不顯示下拉
- [x] 7.3 新增獨立 `StockRegionKeywordSeeder`（`Stock_all_regions` 六語系，不動 `StockModalKeywordSeeder`）並註冊 `DatabaseSeeder`；部署需 `composer dump-autoload` 再 `db:seed --class='\StockRegionKeywordSeeder'`
- [x] 7.4 驗證：endpoint 回傳含 `country/countryName`、各語系國名正確（en/tw/jp）、blade 編譯通過、`Stock_all_regions` 6 語系到位
