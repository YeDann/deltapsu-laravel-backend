## Why

Phase II 規劃在產品列表頁提供「經銷商即時庫存查詢」（投影片 6-8）。前一個變更 `stock-icon` 已把 Stock 按鈕放上產品卡片、預留 `checkStock(pro_code)` 入口，但目前點擊只顯示「即將開通」佔位提示。本變更接上 netCOMPONENT **DILP API**，讓使用者點 Stock 後查到該料號在各經銷商的即時庫存，並以彈窗（Modal）呈現，行為參考投影片 6-7 的 Advanced Energy 頁面。

Delta 已提供 DILP **測試環境**帳密（`apitest.netcomponents.com`），實測 Login／Search／回傳格式皆可運作；但測試環境查無任何庫存資料，且庫存由經銷商上傳、查詢端（我方）無法自行灌入，真實資料需 Delta 於開發完成後核發 **production 帳密**。因此本階段以測試 API 串通整條流程，並以 mock 假資料撐起 Modal 顯示；待 prod 帳密到手，僅需更換 `.env` 即可上線。

## What Changes

- 新增 `DilpClient` service：封裝 DILP 認證（Login + token 快取 + 401 自動重登）、`/Search` 查詢、回傳欄位整理、mock 模式。
- 新增 `StockController@check`：薄控制器，驗證料號 → 呼叫 service → 回傳 JSON；失敗回優雅錯誤結構供前台顯示。
- 新增 localized route `stock-check`（GET，免 CSRF），料號以 `?code=` 傳入。
- `product.blade.php` 的 `checkStock()` 由「即將開通」alert 改為：開啟 Modal（載入中）→ AJAX 查詢 → 渲染經銷商庫存表；並新增一份三段 render 共用的 Modal 標記。
- Modal 僅呈現精簡經銷商表：**Model Number / Distributor / Availability / Buy Now**。Availability 為唯讀數字，不做數量輸入或購物車；Buy Now 於新分頁開啟該經銷商的購物車網址（無網址則 disable）。
- Modal 右上加**國別篩選**下拉（預設 All Regions）：`DilpClient` 多 map 國別代碼（`MultiCountry.Primary.ShortCode`）+ 經 intl 在地化的國名；下拉依結果動態產生、顯示當前語系國名、以代碼篩選；多語標籤由獨立的 `StockRegionKeywordSeeder`（`Stock_all_regions`）提供、註冊於 `DatabaseSeeder`。
- 憑證放 `.env`，程式透過 `config/services.php` 的 `dilp` 區塊以 `config()` 讀取（避開 `config:cache` 後 `env()` 回 null 的問題）。
- 新增 Modal 多語文字至 `static_keyword`，並新增獨立的 `StockModalKeywordSeeder`（不修改既有 stock-icon 的 `StockKeywordSeeder`），於 `DatabaseSeeder` 註冊。
- 修改 `stock-icon`：點擊 Stock 的行為由「顯示即將開通」改為「開啟庫存 Modal 並查詢」（移除舊佔位需求）。

## Capabilities

### New Capabilities
- `stock-checking`: 點 Stock 後透過後端代理查詢 DILP 經銷商庫存，並以 Modal 呈現 Model Number / Distributor / Availability / Buy Now；含**國別篩選**（多語國名）、token 快取、結果短快取、錯誤與空結果處理、多語、以及測試環境用的 mock 模式。

### Modified Capabilities
- `stock-icon`: 點擊 Stock 按鈕的行為由「顯示『即將開通』提示」改為「開啟庫存查詢 Modal 並向 DILP 查詢」。

## Impact

影響層：**Frontend 頁面** + **新增後端 Service／Controller／route** + 一筆靜態多語文字；**無資料庫 schema 異動**。

- `dependencies/config/services.php`：新增 `dilp` 憑證與設定區塊（讀 `env()`）
- `dependencies/.env` / `.env.example`：新增 `DILP_BASE_URL` / `DILP_USERNAME` / `DILP_PASSWORD` / `DILP_MOCK`（含 `DILP_TOKEN_TTL` / `DILP_CACHE_TTL` 選用）
- `dependencies/app/Services/Dilp/DilpClient.php`（新）：DILP 認證、查詢、欄位整理、快取、mock
- `dependencies/app/Http/Controllers/StockController.php`（新）：`check()` 端點
- `dependencies/routes/web.php`：localized group 新增 `GET stock-check`（name `stockCheck`）
- `dependencies/resources/views/front-end/product.blade.php`：改寫 `checkStock()`、新增共用 Modal 標記
- `dependencies/database/seeds/StockModalKeywordSeeder.php`（新）：Modal 多語 keyword（`Stock_model_number` / `Stock_distributor` / `Stock_availability` / `Stock_buy_now` / `Stock_no_results` / `Stock_loading` / `Stock_error`）
- `dependencies/database/seeds/DatabaseSeeder.php`：註冊 `StockModalKeywordSeeder`
- `static_keyword` / `static_keyword_translations` 資料表：新增上述 keyword 各語系翻譯（透過 seeder 或後台 Static Word）

外部相依：netCOMPONENT DILP API（`apitest.netcomponents.com` 測試 / production 待核發）。憑證僅存於各環境 `.env`，不進版控。

部署：`.env` 補 DILP 設定 → `composer dump-autoload` → 跑 `php artisan db:seed --class='\StockModalKeywordSeeder'` → `php artisan cache:clear`；prod 帳密到手改 `DILP_MOCK=false` 並更換帳密與 `BASE_URL`。
