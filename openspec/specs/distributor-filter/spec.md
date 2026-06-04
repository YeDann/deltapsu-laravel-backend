# distributor-filter Specification

## Purpose
TBD - created by archiving change add-distributor-filter. Update Purpose after archive.
## Requirements
### Requirement: 經銷商資料結構支援篩選屬性

系統 MUST 在既有 `office`（type_id=2）基礎上，儲存每家經銷商的 logo、website、telephone、email、Google Maps 連結。經銷商的篩選屬性 MUST 以五類「可管理分類」表達：Specialized Application、Product Line、Service、Sales Territory、Certification。每一類 MUST 為獨立的 lookup 表（含 `_translation` 多語名稱、status、order_seq）並以多對多 pivot 與 office 關聯（一家可多項）。Sales Territory MUST 額外綁定所屬地區（continents type_id=2 的 `continent_id`）。

#### Scenario: 經銷商帶完整屬性
- **WHEN** 後台為某經銷商填入聯絡資訊，並勾選若干 Sales Territory / Certification / Specialized Application / Product Line / Service
- **THEN** 系統儲存主表欄位與五組關聯（先刪後插），前台查詢該經銷商時可取得全部屬性

#### Scenario: 分類選項由後台維護
- **WHEN** Delta 在後台新增或修改任一類（含 Sales Territory、Certification）的選項及其名稱
- **THEN** 該選項即出現在經銷商指派介面與前端篩選，無需改動程式碼

### Requirement: 後台維護經銷商與分類

後台 MUST 提供五類分類選項的 CRUD（Specialized Application、Product Line、Service、Sales Territory、Certification，含名稱、order、show/hide），並 MUST 在既有 Distributors（type_id=2）編輯／新增表單擴充 logo 上傳、聯絡欄位與五組勾選。分類管理 MUST 置於獨立的「Distributor Filter」後台選單群組（與存放 Continents 的 Distributors 分開）。新增／編輯 Sales Territory 時 MUST 可選擇其所屬地區（Region）。

Distributors 編輯／新增表單的 **Sales Territory 勾選 MUST 只列出該經銷商所屬地區的選項**（依表單已帶入的 continent id `$conid` 過濾 `distributor_sales_territory.continent_id`），且 MUST 以**平鋪 inline checkbox** 呈現（不依 Region 分組、不顯示 region 標籤）；其餘四類（Specialized Application、Product Line、Service、Certification）仍列出全部啟用選項。當表單未帶 `$conid` 時，Sales Territory MUST 退回列出全部選項（安全 fallback）。對 Sales Offices（type_id=1）的表單與行為 MUST 不受影響。

**logo 上傳 MUST 提供即時回饋**：選檔後 MUST 顯示檔名與縮圖預覽，且 MUST 限定影像類型（`accept="image/*"`）；當所選檔超過伺服器 `upload_max_filesize`（門檻由後端讀 ini 帶入前端）時 MUST 即時提醒並清除選擇，避免檔案被默默丟棄卻誤以為上傳成功。

#### Scenario: 指派分類給經銷商
- **WHEN** 管理者在 Distributors 編輯頁勾選 Product Line 與 Certification 並儲存
- **THEN** 系統以先刪後插更新關聯，重新編輯時呈現已勾選狀態

#### Scenario: 設定 Sales Territory 所屬地區
- **WHEN** 管理者新增一個 Sales Territory 並選擇 Region（如 Americas）
- **THEN** 該 Sales Territory 出現在前台 Americas 地區頁籤的篩選下拉中

#### Scenario: Sales Territory 依經銷商所屬地區過濾
- **WHEN** 管理者編輯或新增某地區（如 Americas，continent_id=2）底下的經銷商，檢視 Sales Territory 區塊
- **THEN** 只列出該地區的 Sales Territory 選項（如 US、Mexico），以平鋪 checkbox 呈現，不出現其他地區（Europe/Japan/Korea…）的選項，也不顯示 Region 分組標籤

#### Scenario: 未帶地區時列出全部
- **WHEN** 進入未帶 continent id（`$conid` 為空）的經銷商表單
- **THEN** Sales Territory 退回列出全部啟用選項，不因過濾而呈現空白

#### Scenario: logo 上傳即時回饋（預覽 / 超限提醒）
- **WHEN** 管理者於經銷商表單選擇一張 logo 圖片
- **THEN** 顯示檔名與縮圖預覽；若該檔超過 `upload_max_filesize` 上限，則立即提醒並清除選擇（不會誤以為已上傳）

#### Scenario: 之後補上 logo
- **WHEN** 客戶日後提供某經銷商 logo，管理者於後台上傳
- **THEN** 結果卡改以 logo 呈現，無需改動程式碼

#### Scenario: Sales Offices 不受影響
- **WHEN** 管理者編輯 type_id=1 的 Sales Office
- **THEN** 不顯示經銷商專屬欄位，且儲存行為與本變更前相同

### Requirement: 前端 Find a Distributor 篩選頁

前端 MUST 以地區頁籤（continents type_id=2）載入該區經銷商，並 MUST 提供篩選：Sales Territory 與 Certifications 下拉、Specialized Application／Product Line／Service 勾選。Sales Territory 下拉 MUST 依其所屬地區（continent_id）只列出當前頁籤對應的選項，並於切換頁籤時重建。套用篩選後 MUST 即時更新結果（類間 AND、類內 OR）。結果卡 MUST 為三欄：左欄顯示經銷商識別（有 logo 顯示 logo、否則顯示名稱）與地址／聯絡；中欄顯示 Certifications 標籤；右欄顯示所代理 Product Line（打勾）。

#### Scenario: 依地區載入
- **WHEN** 使用者點選某地區頁籤
- **THEN** 只顯示該 continent（type_id=2）下的經銷商，且 Sales Territory 下拉只含該地區的選項

#### Scenario: 套用篩選條件
- **WHEN** 使用者勾選一或多個 Product Line 與 Service
- **THEN** 結果即時縮減為符合條件的經銷商（類間 AND、類內 OR）

#### Scenario: 無 logo 時以名稱呈現
- **WHEN** 某經銷商尚無 logo
- **THEN** 結果卡以其文字名稱呈現，不顯示破圖

#### Scenario: 查無符合
- **WHEN** 篩選條件下該地區無符合的經銷商
- **THEN** 顯示「查無符合」訊息，而非空白

### Requirement: 分類與 UI 標籤可在地化

分類名稱（五類，來自各 `_translation` 表）與篩選列 UI 標籤（來自 `static_keyword`）MUST 可依語系維護。初始 seed MUST 為所有語系填入英文作為 baseline，實際在地化由後台逐一處理。前台 MUST 依當前語系顯示對應名稱／標籤。

#### Scenario: 英文 baseline
- **WHEN** 尚未在後台在地化某分類或 UI 標籤
- **THEN** 各語系皆顯示英文，不出現空白或 key 名

#### Scenario: 後台在地化後反映
- **WHEN** 管理者於後台將某分類名稱或 UI 標籤改為特定語系翻譯
- **THEN** 以該語系瀏覽前台時顯示對應翻譯

