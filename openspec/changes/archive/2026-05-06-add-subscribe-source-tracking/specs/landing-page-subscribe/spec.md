## 新增需求

### Requirement: 活動頁訂閱寫入資料庫並記錄來源
系統必須提供 `POST /{lang}/landing/subscribe` 端點，接受 email，將訂閱資料寫入 `subscribes` 表，`source` 欄位為 `din-rail`，並呼叫 Mailchimp 訂閱。

#### Scenario: 新 email 訂閱成功
- **WHEN** 使用者在活動頁 Modal 輸入有效 email 並送出
- **THEN** 系統將 email 寫入 `subscribes`，`source='din-rail'`，並呼叫 Mailchimp 訂閱，回傳 JSON `{"status":"success"}`

#### Scenario: 重複 email 不重複寫入
- **WHEN** 使用者送出的 email 已存在於 `subscribes` 或 Mailchimp
- **THEN** 系統不重複寫入 DB，回傳 JSON `{"status":"already"}`

#### Scenario: email 格式無效
- **WHEN** 使用者送出空白或格式錯誤的 email
- **THEN** 系統回傳 JSON `{"status":"error","message":"Invalid email"}`

### Requirement: 活動頁 Modal 改為實際送出
活動頁訂閱 Modal 的「SUBSCRIBE NOW」按鈕必須透過 AJAX 送出到後端，不再只做 `alert()`。

#### Scenario: 送出成功後維持現有 alert 行為
- **WHEN** 後端回傳 `{"status":"success"}` 或 `{"status":"already"}`
- **THEN** 維持現有 `alert('Thank you for subscribing!')` 行為並關閉 Modal
