## 1. 活動頁 View

- [x] 1.1 在 notify modal 的 email 欄位下方新增 Name 輸入欄位（id: `nf-name`，必填）
- [x] 1.2 在 Name 欄位下方新增 Country 下拉選單（id: `nf-country`，必填），選項使用 `@foreach ($mail_chimp_country as $c)` 產生，value 為 `{{ $c->name }}`
- [x] 1.3 更新 JS 驗證邏輯，加入 nf-name、nf-country 必填檢查
- [x] 1.4 更新 fetch() 送出，帶入 name 和 country

## 2. Controller

- [x] 2.1 `landingSubscribe()` 接收 name 和 country 並驗證非空
- [x] 2.2 DB insert 加入 `name` 和 `country_name` 欄位
- [x] 2.3 開啟 Mailchimp 呼叫，傳入 `['NAME' => $name, 'COUNTRY' => $country]`，例外只 log 不影響回傳

## 3. 驗證

- [x] 3.1 填寫完整欄位送出，確認 `subscribes` 表有 name 和 country_name
- [x] 3.2 未填 name 或 country，確認前端顯示錯誤訊息
- [x] 3.3 確認 Mailchimp 名單有新訂閱者
