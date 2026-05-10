## 為什麼

活動頁（DIN Rail landing page）的申請諮詢表單目前只有前端假送出，沒有真正把資料傳到後端。需要串接官網的聯絡功能，讓資料寫入 `contacts` 資料表並寄出通知信。

活動頁多一個「產品系列」下拉選單（DIN Pro / DIN Eco），`contacts` 資料表目前沒有對應欄位。

## 變更內容

- `contacts` 資料表新增 `series` 欄位（nullable varchar），記錄申請的產品系列
- 新增專用路由 `POST /landing/contact` 與 `FrontendController@landingContact` method，不需要 reCAPTCHA，回傳 JSON
- 活動頁 `submitContactForm()` 改為實際 AJAX POST 到新端點，成功後維持現有的感謝頁邏輯
- 寄出通知信，使用現有的 `Contact` Mailable

## 欄位對應

| 活動頁欄位 | contacts 欄位 | 備註 |
|-----------|-------------|------|
| cf-company | company | |
| cf-name | name | |
| cf-email | email | |
| cf-country | country | |
| cf-phone | tel | |
| cf-product | series | 新增欄位 |
| contact-message | message | |
| （固定值） | subject | 固定 `'DIN Rail Inquiry'` |
| （固定值） | type_name | 固定 `'DIN Rail'` |

## 功能範圍

### 新功能

- `landing-contact-form`：活動頁申請諮詢表單串接後端，寫入 `contacts` 並寄通知信

### 修改既有功能

（無）

## 影響範圍

- 資料庫：`contacts` 表新增 `series` 欄位（migration）
- `dependencies/routes/web.php`：新增 `POST /landing/contact` 路由（群組外）
- `app/Http/Controllers/FrontendController.php`：新增 `landingContact()` method
- `resources/views/front-end/landing-din-rail-infinity-ready.blade.php`：`submitContactForm()` 改為 AJAX
