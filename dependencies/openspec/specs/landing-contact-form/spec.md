## 新增需求

### Requirement: 活動頁諮詢表單寫入資料庫並寄通知信
系統必須提供 `POST /landing/contact` 端點，接受表單欄位，將資料寫入 `contacts` 表（含 `series` 欄位），並寄出通知信。

#### Scenario: 必填欄位齊全時送出成功
- **WHEN** 使用者填寫 company、name、email、country 並送出
- **THEN** 系統寫入 `contacts` 表，`series` 對應 cf-product 值，寄通知信，回傳 `{"status":"success"}`

#### Scenario: 必填欄位缺少時回傳錯誤
- **WHEN** 使用者未填寫必填欄位（email、name、company、country 任一）
- **THEN** 系統回傳 `{"status":"error","message":"Missing required fields"}`，不寫入 DB

#### Scenario: series 為空時寫入 null
- **WHEN** 使用者未選擇產品系列
- **THEN** `contacts.series` 欄位寫入 null

### Requirement: 活動頁感謝頁邏輯在後端成功後才顯示
`submitContactForm()` 必須在後端回傳成功後，才執行感謝頁邏輯（隱藏表單、顯示感謝文字、toast）。

#### Scenario: 後端成功後顯示感謝畫面
- **WHEN** 後端回傳 `{"status":"success"}`
- **THEN** 表單隱藏，顯示綠色感謝文字與 toast，維持現有樣式

#### Scenario: 後端失敗時重新啟用按鈕
- **WHEN** 後端回傳錯誤或網路失敗
- **THEN** 送出按鈕重新啟用，表單維持顯示，不顯示感謝畫面
