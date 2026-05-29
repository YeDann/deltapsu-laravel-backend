## ADDED Requirements

### Requirement: 經銷商資料結構支援篩選屬性

系統 MUST 在既有 `office`（type_id=2）基礎上，儲存每家經銷商的 logo、website、telephone、email、Google Maps 連結、sales territory（文字）、certification（文字），以及其所屬的 Specialized Application、Product Line、Service。後三者 MUST 為多對多關聯（一家可多項），其選項 MUST 可由後台管理；sales territory 與 certification MUST 為文字欄位（自由輸入）。

#### Scenario: 經銷商帶完整屬性
- **WHEN** 後台為某經銷商填入聯絡資訊與 sales territory，並勾選若干 Specialized Application / Product Line / Service
- **THEN** 系統儲存主表欄位與各關聯，前台查詢該經銷商時可取得全部屬性

#### Scenario: 分類選項由後台維護
- **WHEN** Delta 在後台新增或修改一個 Specialized Application／Product Line／Service 選項及其多語名稱
- **THEN** 該選項即出現在經銷商指派介面與前端篩選，無需改動程式碼

### Requirement: 匯入既有經銷商資料

系統 MUST 能將 Delta 提供的經銷商清單（2025 deltapsu Distributor filter.xlsx）匯入為初始資料：依 region 對應 continent（SEA 對應 Thailand），略過範例列與不收的地區（India），並依 V 標記寫入三類關聯。

#### Scenario: 匯入後資料正確
- **WHEN** 執行匯入
- **THEN** 各經銷商以正確地區、聯絡資訊與三類屬性建立；範例列與 India 不被匯入

### Requirement: 後台維護經銷商與分類

後台 MUST 提供三類分類選項的 CRUD（Specialized Application、Product Line、Service，含多語名稱），並 MUST 在既有 Distributors（type_id=2）編輯表單擴充 logo 上傳與文字欄位與三類勾選。對 Sales Offices（type_id=1）的表單與行為 MUST 不受影響。

#### Scenario: 指派分類給經銷商
- **WHEN** 管理者在 Distributors 編輯頁勾選 Product Line 與 Service 並儲存
- **THEN** 系統以先刪後插更新關聯，重新編輯時呈現已勾選狀態

#### Scenario: 之後補上 logo
- **WHEN** 客戶日後提供某經銷商 logo，管理者於後台上傳
- **THEN** 結果卡改以 logo 呈現，無需改動程式碼

#### Scenario: Sales Offices 不受影響
- **WHEN** 管理者編輯 type_id=1 的 Sales Office
- **THEN** 不顯示經銷商專屬欄位，且儲存行為與本變更前相同

### Requirement: 前端 Find a Distributor 篩選頁

前端 MUST 以地區頁籤（continents type_id=2）載入該區經銷商，並 MUST 提供篩選：Sales Territory 與 Certification 下拉、Specialized Application／Product Line／Service 勾選。套用篩選後 MUST 即時更新結果。結果卡 MUST 顯示經銷商識別（有 logo 顯示 logo、否則顯示名稱）、地址、電話、email、Google Maps 連結、website，以及所代理 Product Line（打勾）與應用／服務標籤。

#### Scenario: 依地區載入
- **WHEN** 使用者點選某地區頁籤
- **THEN** 只顯示該 continent（type_id=2）下的經銷商

#### Scenario: 套用篩選條件
- **WHEN** 使用者勾選一或多個 Product Line 與 Service
- **THEN** 結果即時縮減為符合條件的經銷商（類間 AND、類內 OR）

#### Scenario: 無 logo 時以名稱呈現
- **WHEN** 某經銷商尚無 logo
- **THEN** 結果卡以其文字名稱呈現，不顯示破圖

#### Scenario: 查無符合
- **WHEN** 篩選條件下該地區無符合的經銷商
- **THEN** 顯示「查無符合」訊息，而非空白

### Requirement: 篩選頁與分類多語化

篩選列 UI 標籤、分類名稱與經銷商名稱／地址 MUST 依當前語系顯示。分類名稱與經銷商文字 MUST 來自對應 `_translation` 表；篩選列固定標籤 MUST 來自 `static_keyword`。缺對應語系時 MUST fallback 英文。

#### Scenario: 各語系顯示
- **WHEN** 使用者以任一支援語系（en/tw/cn/de/jp/tr）瀏覽
- **THEN** 篩選列標籤、分類名稱、經銷商名稱與地址皆以該語系顯示

#### Scenario: 缺翻譯 fallback
- **WHEN** 某分類選項或經銷商缺該語系翻譯
- **THEN** 以英文呈現，不顯示空白或 key 名
