## ADDED Requirements

### Requirement: 點擊 Stock 開啟庫存查詢 Modal

點擊產品卡片的 Stock 按鈕 MUST 透過既有入口函式 `checkStock(pro_code)` 開啟庫存 Modal，並以該料號（`pro_code`）向後端 `stock-check` 端點發出查詢。此行為 MUST 在桌機 grid、手機 grid、list view 三種版型皆一致（三處 render 共用同一 `checkStock` 與同一份 Modal 標記）。Modal MUST 不造成 JS 錯誤、不影響頁面其他功能。

#### Scenario: 點擊開啟 Modal 並送出查詢
- **WHEN** 使用者在產品列表頁點擊某商品卡片的 Stock 按鈕
- **THEN** 開啟庫存 Modal、先顯示載入中狀態，並以該商品 `pro_code` 對 `GET /{locale}/stock-check?code=<pro_code>` 發出 AJAX 查詢

#### Scenario: 三種版型共用同一入口
- **WHEN** 使用者分別在桌機 grid、手機 grid、list view 點擊 Stock 按鈕
- **THEN** 三者皆呼叫同一 `checkStock(pro_code)`、開啟同一份共用 Modal，行為一致

### Requirement: 後端代理 DILP 查詢且憑證不外露

庫存查詢 MUST 由後端（`StockController@check` → `DilpClient`）代理 DILP API，前端 MUST 只取得整理後的 JSON、永不接觸 DILP 憑證或 token。`DilpClient` MUST 以 `config('services.dilp.*')` 取得憑證（不得直接 `env()`），並 MUST 將 AuthToken 快取重用；當 DILP 回應 401 時 MUST 自動重新登入一次後重試。回傳 MUST 整理為 `[part, distributor, availability, buyUrl]` 結構。

#### Scenario: 前端只拿到整理後 JSON
- **WHEN** 前端呼叫 `stock-check` 端點
- **THEN** 回應為 `{ok:true, rows:[{part, distributor, availability, buyUrl}, ...]}`，且回應與前端程式碼中皆不含 DILP 帳密或 AuthToken

#### Scenario: token 快取與 401 自動重登
- **WHEN** 短時間內連續查詢多個料號
- **THEN** 重用快取中的 AuthToken（不每次 Login）；若 DILP 回 401，`DilpClient` 自動重新 Login 一次再重試該查詢

#### Scenario: 各語系 URL 皆可查詢
- **WHEN** 使用者在任一支援語系（en、tw、cn、jp、de、tr）的頁面點擊 Stock
- **THEN** 對應 `/{locale}/stock-check?code=<pro_code>` 路由皆能正確回傳 JSON

### Requirement: Modal 呈現經銷商庫存表

查詢成功且有結果時，Modal MUST 以表格列出每個經銷商一列，欄位為 **Model Number / Distributor / Availability / Buy Now**。Availability MUST 為唯讀數字（不提供數量輸入或加入購物車）。Modal MUST 不顯示價格欄。

#### Scenario: 有庫存時顯示各經銷商列
- **WHEN** 查詢回傳一筆以上經銷商庫存
- **THEN** Modal 表格逐列顯示 `Model Number`(料號)、`Distributor`(經銷商名)、`Availability`(數量) 與該列的 Buy Now 動作，桌機與手機版型皆可正常呈現

### Requirement: Buy Now 導向經銷商網址

每列的 Buy Now MUST 連向該經銷商的購物車網址（DILP `Distributor.ShoppingCartLink.URL`），並 MUST 以新分頁開啟（`target="_blank" rel="noopener"`）。當該經銷商無購物車網址時，Buy Now MUST 呈現為停用（disable）狀態，且 MUST NOT 產生失效連結。

#### Scenario: 有購物車網址
- **WHEN** 某經銷商列具有 `ShoppingCartLink.URL`
- **THEN** Buy Now 可點擊，於新分頁開啟該網址

#### Scenario: 無購物車網址
- **WHEN** 某經銷商列無 `ShoppingCartLink.URL`
- **THEN** 該列 Buy Now 呈停用狀態、不可點擊、不導向

### Requirement: 依國別篩選經銷商

Modal MUST 在右上角提供國別篩選下拉，預設選項為多語「All Regions」（`Stock_all_regions`）。下拉選項 MUST 依當前查詢結果出現的國別動態產生（去重），顯示文字 MUST 為當前語系的國名（由 DILP 國別代碼 `Distributor.MultiCountry.Primary.ShortCode` 經 intl 在地化），而篩選比對 MUST 以國別代碼進行（與語系無關）。選擇某國別時 MUST 只顯示該國別的經銷商列，選回 All Regions MUST 顯示全部。當查詢結果無任何國別資訊時，此下拉 MUST 不顯示。

#### Scenario: 依國別篩選經銷商列
- **WHEN** 使用者在 Modal 選擇某個國別
- **THEN** 僅顯示該國別的經銷商列；選回 All Regions 則顯示全部

#### Scenario: 國名多語化、篩選用代碼
- **WHEN** 使用者以不同語系（如 cn、jp）開啟 Modal 並展開國別下拉
- **THEN** 下拉顯示對應語系國名（cn「美国」、jp「アメリカ合衆国」），而篩選行為一致（皆以國別代碼比對）

#### Scenario: 無國別資訊不顯示下拉
- **WHEN** 查詢結果中所有經銷商皆無國別資訊
- **THEN** 不顯示國別篩選下拉

### Requirement: 載入中、查無庫存與錯誤狀態

Modal MUST 呈現三種非成功狀態：查詢進行中顯示載入中、查詢成功但無任何經銷商庫存顯示「查無庫存」訊息、查詢失敗（逾時／非 2xx／例外）顯示錯誤訊息。三者皆 MUST 為多語、且 MUST NOT 造成頁面 JS 中斷。

#### Scenario: 查詢進行中
- **WHEN** AJAX 查詢尚未回應
- **THEN** Modal 顯示載入中狀態

#### Scenario: 查無庫存
- **WHEN** 查詢成功但回傳 0 筆經銷商庫存（如 DILP 回 `Parts:[]`）
- **THEN** Modal 顯示多語「查無庫存」訊息，而非空白表格

#### Scenario: 查詢失敗
- **WHEN** DILP 逾時、回非 2xx 或後端拋例外（端點回 `{ok:false}`）
- **THEN** Modal 顯示多語錯誤訊息，頁面其他功能不受影響

### Requirement: Modal 文字多語化

Modal 的欄位標題與狀態訊息 MUST 依當前語系顯示，文字來源 MUST 為 `static_keyword` / `static_keyword_translations`，key 為 `Stock_model_number`、`Stock_distributor`、`Stock_availability`、`Stock_buy_now`、`Stock_no_results`、`Stock_loading`、`Stock_error`。缺對應語系時 MUST 依既有 `staticContent` 機制 fallback 英文。

#### Scenario: 英文語系顯示對應標籤
- **WHEN** 使用者以 en 瀏覽並開啟 Modal
- **THEN** 欄位標題顯示 `Model Number` / `Distributor` / `Availability` / `Buy Now`，狀態訊息顯示對應英文（如查無庫存、載入中、錯誤）

#### Scenario: 其他語系顯示對應翻譯
- **WHEN** 使用者以 tw、cn、jp、de、tr 任一語系開啟 Modal
- **THEN** 上述欄位標題與狀態訊息顯示該語系翻譯；若某語系缺翻譯則 fallback 英文，不顯示 key 名或空白

### Requirement: Mock 模式供無庫存環境開發

當設定 `services.dilp.mock` 為真（`DILP_MOCK=true`）時，`DilpClient` MUST 不呼叫真實 DILP API，改回傳固定的 fixture 資料（數筆經銷商庫存），使整條流程在空庫存的測試環境仍可完整呈現。當 mock 為否時 MUST 走真實 DILP API。

#### Scenario: mock 開啟回傳 fixture
- **WHEN** `DILP_MOCK=true` 且使用者查詢任一料號
- **THEN** Modal 顯示 fixture 中的數筆經銷商庫存（含可點與停用的 Buy Now 各情境），不發出真實 DILP 請求

#### Scenario: mock 關閉走真實 API
- **WHEN** `DILP_MOCK=false`
- **THEN** `DilpClient` 對真實 DILP API 發出 Login 與 Search 請求並回傳其結果
