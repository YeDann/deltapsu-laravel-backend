## 為什麼

行銷團隊需要區分訂閱者是從官網還是活動站（DIN Rail landing page）來的，目前 `subscribes` 資料表沒有來源欄位，無法判斷。同時，活動頁的訂閱 Modal 目前只有前端驗證，還沒真的把資料送進後端。

## 變更內容

- `subscribes` 資料表新增 `source` 欄位（nullable varchar），記錄訂閱來源
- 官網訂閱 controller 寫入時預設 `source='web'`，**無需改動 `subscribe.blade.php`**
- 活動頁訂閱 Modal 改為實際呼叫後端，新增專用路由 `POST /{lang}/landing/subscribe`，寫入時帶 `source='din-rail'`
- 活動頁端點共用核心邏輯（DB insert + Mailchimp subscribe），不需要 reCAPTCHA、name、country

## 功能範圍

### 新功能

- `landing-page-subscribe`：活動頁專用訂閱端點，僅需 email，寫入 `subscribes` 表並呼叫 Mailchimp，記錄 `source='din-rail'`

### 修改既有功能

- `web-subscribe`：官網訂閱 controller 寫入時以 `'web'` 作為預設 source，不依賴前端傳值

## 影響範圍

- 資料庫：`subscribes` 表新增 `source` 欄位（migration）
- `dependencies/routes/web.php`：新增 `POST /landing/subscribe` 路由
- `app/Http/Controllers/FrontendController.php`：新增 `landingSubscribe()` method；修改 `subscribe()` 與 `subCheckBox()` 兩個 insert 點加上 `'source' => 'web'`
- `resources/views/front-end/landing-din-rail-infinity-ready.blade.php`：Modal 改為 AJAX POST 到新端點
