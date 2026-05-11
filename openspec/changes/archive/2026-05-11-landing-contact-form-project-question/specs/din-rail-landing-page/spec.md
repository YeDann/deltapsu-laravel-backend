## MODIFIED Requirements

### Requirement: 申請諮詢表單欄位
申請諮詢表單 SHALL 在「訊息內容」欄位上方包含一個 `question_project_status` 下拉選單，問題文字與 4 個選項均依當前語系顯示。欄位為 optional（可不選）。

#### Scenario: 下拉選單顯示於訊息欄位上方
- **WHEN** 使用者開啟任何語系的 landing page
- **THEN** 申請諮詢表單中「訊息內容」`<textarea>` 上方出現 `cf-project-status` 下拉選單與對應問題標籤

#### Scenario: EN 語系顯示英文選項
- **WHEN** 使用者以 `en` 語系開啟頁面
- **THEN** 問題顯示 "Do you have an active or upcoming project that requires a power supply solution?" 且 4 個選項為英文

#### Scenario: TC 語系顯示繁體中文選項
- **WHEN** 使用者以 `tw` 語系開啟頁面
- **THEN** 問題與選項顯示繁體中文

#### Scenario: SC 語系顯示簡體中文選項
- **WHEN** 使用者以 `cn` 語系開啟頁面
- **THEN** 問題與選項顯示簡體中文

#### Scenario: JP 語系顯示日文選項
- **WHEN** 使用者以 `jp` 語系開啟頁面
- **THEN** 問題與選項顯示日文

#### Scenario: 語系切換後選項更新
- **WHEN** 使用者切換語系
- **THEN** `cf-project-status` 的問題文字與所有 option 文字即時更新為新語系

## ADDED Requirements

### Requirement: question_project_status 欄位寫入資料庫
`contacts` 資料表 SHALL 包含 `question_project_status CHAR(1) NULL` 欄位。`landingContact()` MUST 讀取 `cf-project-status` 的 value 並寫入此欄位。option value 對應：`a`=目前開發中、`b`=6個月內計劃、`c`=研究中、`d`=無具體專案。

#### Scenario: 使用者選取選項後送出
- **WHEN** 使用者選取第一個選項並送出表單
- **THEN** `contacts.question_project_status` 存入 `"a"`

#### Scenario: 使用者未選取送出
- **WHEN** 使用者保持下拉選單為預設空值並送出表單
- **THEN** `contacts.question_project_status` 存入 `NULL`，表單仍可成功送出
