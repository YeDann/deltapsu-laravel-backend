## ADDED Requirements

### Requirement: 活動頁訂閱表單收集 name 和 country
訂閱 modal 必須包含 Name（必填）和 Country（必填）欄位，送出時連同 email 一起傳到後端。

#### Scenario: 欄位齊全時訂閱成功
- **WHEN** 使用者填寫 email、name、country 並勾選同意後送出
- **THEN** 後端儲存 email、name、country_name 至 `subscribes` 表，同步 Mailchimp，回傳 `{"status":"success"}`

#### Scenario: 必填欄位缺少時顯示錯誤
- **WHEN** 使用者未填 name 或 country
- **THEN** 顯示欄位錯誤提示，不呼叫後端

#### Scenario: Mailchimp 呼叫失敗時仍回傳成功
- **WHEN** Mailchimp API 呼叫拋出例外
- **THEN** 資料已寫入 DB，後端 log error，仍回傳 `{"status":"success"}`
