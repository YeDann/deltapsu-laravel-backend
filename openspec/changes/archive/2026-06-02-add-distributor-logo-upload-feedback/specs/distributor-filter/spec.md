## MODIFIED Requirements

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
