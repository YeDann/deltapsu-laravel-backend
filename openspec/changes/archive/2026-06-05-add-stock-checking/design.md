## Context

`stock-icon` 變更已在 `product.blade.php` 的三段 render（桌機 grid、手機 grid、list view）放上 Stock 按鈕，並預留前端入口 `checkStock(pro_code)`（目前只 `alert()`「即將開通」）。本變更把這個入口接上 netCOMPONENT **DILP API**（Distributor Inventory Lookup Protocol，REST/JSON）。

DILP 協定（已實測）：
- `POST /Login?TTL=900`，帶 `Authorization: Basic base64(user:pass)` → 回 `{"AuthToken":"Basic ...", ...}`。**注意：此 POST 一定要帶 Content-Length（空 body 也行），否則回 411 Length Required。**
- 之後每個請求帶 `Authorization: {AuthToken}`；遇 401 重新 Login 再重試。token 由 API 給 15 分鐘有效。
- `GET /Search?pn1={料號}&SearchType=EQUALS&ClientIP={ip}` → `SearchedParts[0].Parts[]`，每筆含 `PartNumber` / `Distributor.Name` / `Quantity` / `Distributor.ShoppingCartLink.URL`。

現況限制：測試環境（`apitest.netcomponents.com`）認證與查詢都可運作，但**查無任何庫存**（所有料號回 `Parts:[]`），且庫存由經銷商上傳、查詢端無法灌入。真實資料需 production 帳密（Delta 於開發完成後核發）。

## Goals / Non-Goals

**Goals:**
- 點 Stock → Modal 顯示該料號（= `pro_code`）在各經銷商的庫存：Model Number / Distributor / Availability / Buy Now。
- 後端代理查詢，DILP 憑證**永不外露**到前端。
- 在測試環境（空庫存）即可完整跑通流程：以 mock 假資料撐 Modal 顯示。
- prod 帳密到手後**只改 `.env`**（含關閉 mock）即可切真實資料，程式碼不動。

**Non-Goals:**
- 不做數量輸入 / 加入購物車 / 結帳（Availability 唯讀、Buy Now 僅外連經銷商網址）。
- 不做區域（All Regions）篩選、不做 Request Quote / Contact Us 頁腳、標題不帶規格（參考圖有，但本階段不做）。
- 不顯示價格（DILP `/Search` 不回價格）。
- 不修 `resultsearch` / 產品詳細頁；Stock 只在產品列表頁。

## Decisions

**1. 後端用獨立 `DilpClient` service，而非塞進 FrontendController。**
DILP 有外部相依、token 生命週期、401 重登、欄位 map、mock 切換、之後要按 Terms 調整——隔離成 `App\Services\Dilp\DilpClient` 可單獨抽換與驗證、可一鍵切 mock/prod、也不再養肥已是 god-class 的 FrontendController。Controller（`StockController@check`）保持薄：validate → 呼叫 service → 回 JSON。
_替代方案：全寫在 FrontendController inline（檔案少但混雜職責、難測），不採用。_

**2. 憑證走 `config/services.php`（`dilp` 區塊）+ `.env`，程式只用 `config()` 讀。**
跟既有 sendgrid/stripe 同慣例。**不直接 `env()`**：正式機跑 `php artisan config:cache` 後，config 檔以外的 `env()` 會回 `null`。
_密碼含 `$`、`%`，`.env` 內必須加引號（建議單引號），否則 dotenv 可能把 `$LR` 當變數插值。_

**3. 兩層快取：token ~14 分、查詢結果每料號 ~5 分（皆可由 `.env` 調）。**
token 快取省去每次 Login；結果短快取在 rate limit 未知下先保守省呼叫。Terms 文件到手再調整時間或停用。
_替代方案：每次點都即時打 DILP（最新但呼叫量大、rate limit 風險），不採用為預設。_

**4. mock 模式（`DILP_MOCK=true`）由 service 回固定 fixture。**
測試環境空庫存且無法灌入 → 沒 mock 就永遠只能看到「查無庫存」，UI 無從驗收。fixture 給數筆（Mouser / DigiKey / Farnell + 數量 + 一個假購物車網址），讓「前端 → 後端 → Modal」整條在測試環境跑得起來。prod 帳密到手改 `false` 即真資料。

**5. 料號 = `pro_code`，`SearchType=EQUALS`。**
前端三處 render 的 Stock 按鈕本就傳 `pro['pro_code']`。料號是否等於 NetComponents 的 MPN 待 Instructions/真資料確認；因 map 集中在 `DilpClient`，屆時只改一處。

**6. Buy Now = `Distributor.ShoppingCartLink.URL`，新分頁開啟（`target="_blank" rel="noopener"`）。**
無此網址的經銷商 → Buy Now 灰掉 disable，不顯示死連結。

**7. Modal 標記共用一份、放 `product.blade.php` 底部；JS 動態填表。**
三段 render（桌機/手機/list）的 Stock 按鈕都呼叫同一個 `checkStock(proCode)`，共用同一個 Modal，避免重複。

## Risks / Trade-offs

- **缺 DILP API Instructions（含 Terms of Use / rate limit / 料號規則）** → 先以保守快取與 server-side 代理實作；Modal 顯示數量/快取時間等若與 Terms 衝突，待文件到手微調（影響面侷限在 `DilpClient` 與 Modal 模板）。
- **`pro_code` 未必等於 NetComponents MPN** → 真資料才驗得出；map 集中在 service，調整成本低。
- **測試環境永遠空庫存** → 無法用真資料驗收渲染 → 以 mock 覆蓋整條流程；最終真實渲染待 prod。
- **憑證外洩** → 一律 server-side 代理、前端只拿整理後的 JSON；`.env` 已 gitignore，`config/services.php` 只放 `env()` 參照。
- **`product.blade.php` ~5000 行、Edit 需唯一字串** → 定位點：`checkStock(` 約 line 840（改寫函式本體）；三處 Stock 按鈕 render 約 line 1994 / 2093 / 2199（不需動，皆已呼叫 `checkStock(pro['pro_code'])`）；Modal 標記新增在 `@section` 內容尾端。JS 不涉語系偵測（多語走後端 `$staticContent[...]` 注入字串）。

## Migration Plan

部署步驟：
1. 各環境 `.env` 補 `DILP_*`（測試/ UAT 用測試帳密、`DILP_MOCK=true`）。
2. `composer dump-autoload` → `php artisan db:seed --class='\StockModalKeywordSeeder'`（補 Modal 多語 keyword；獨立 seeder，不動 stock-icon 的 StockKeywordSeeder）。
3. `php artisan cache:clear`（清 staticContent 快取）+（正式機若有跑 config:cache 則 `php artisan config:clear && config:cache`）。
4. prod 帳密核發後：prod `.env` 改 `DILP_BASE_URL` / `DILP_USERNAME` / `DILP_PASSWORD` + `DILP_MOCK=false`，`config:clear`。

Rollback：移除/退回 `routes/web.php` 的 `stock-check` 並把 `checkStock()` 還原為 `alert()`（或設 `DILP_MOCK=true` 維持假資料），不影響其他頁面；無 DB schema 異動可回。

## Open Questions

- DILP API Instructions（Terms of Use / rate limit / 料號對應規則）尚未取得 → 影響快取時間、是否可顯示確切數量、料號欄位。
- production base URL 與正式帳密尚未核發。
- 是否需要區域（All Regions）篩選——本階段不做，列為後續可能 case。
