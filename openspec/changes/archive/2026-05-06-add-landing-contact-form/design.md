## 背景

`contacts` 資料表欄位：id, name, subject, tel, email, company, country, state, type_name, model_name, message, file, accept_signup_news, web_site, created_at, ticket_id, run_num, agree_policy。

官網 `SubmitContact()` 需要 reCAPTCHA 且回傳 redirect，不適合 AJAX 呼叫。活動頁 `submitContactForm()` 目前驗證通過後只顯示感謝畫面，沒有打後端。

## 目標 / 非目標

**目標：**
- `contacts` 表新增 `series` 欄位
- 活動頁諮詢表單實際送出資料到後端
- 寫入 `contacts` 並寄通知信
- 成功後維持現有感謝頁邏輯（隱藏表單、顯示綠色感謝文字 + toast）

**非目標：**
- 修改官網 `SubmitContact()` 或官網聯絡表單
- 加 reCAPTCHA 到活動頁
- 複製官網的國家路由收件人邏輯（寄固定收件人即可）

## 技術決策

### 1. Migration 新增 `series` 欄位

```sql
ALTER TABLE contacts ADD COLUMN series VARCHAR(100) NULL DEFAULT NULL;
```

nullable，不影響現有資料。

### 2. 路由放在語系群組外

與 `landingSubscribe` 相同，API 端點不需要語系前綴：
- `POST /landing/contact` → `FrontendController@landingContact`

### 3. `landingContact()` method

只需 email、name、company、country（必填），tel、series、message 選填。不做 reCAPTCHA。

寫入 `contacts` 時：
- `subject` 固定 `'DIN Rail Inquiry'`
- `type_name` 固定 `'DIN Rail'`
- `series` 從 `cf-product` 取值（`din-pro` / `din-eco` / 空）
- 其餘欄位直接對應

通知信使用現有 `Contact` Mailable，收件人從 config 取固定地址（`config('mail.from.address')` 或另設 config key）。

回傳 JSON：`{"status":"success"}` / `{"status":"error"}`。

### 4. 活動頁 JS 改為 AJAX

在 `submitContactForm()` 的驗證通過後，先送 `fetch()` POST，成功後才執行現有的感謝頁邏輯（隱藏表單、顯示感謝文字、toast）。失敗時重新啟用按鈕。

CSRF token 已在前一個 change 注入（`window._csrfToken`），直接使用。

## 風險 / 取捨

- **風險**：通知信收件人需確認 config key → 實作時確認
- **風險**：`Contact` Mailable 的 `$request->except('_token')` 以陣列傳入，需確認 `series` 欄位有被包含
