## Context

活動頁訂閱 modal 目前只有 email 欄位。`landingSubscribe()` 只儲存 email，Mailchimp 呼叫已全部注解（因為 NAME/COUNTRY 為空字串導致 400 錯誤）。`subscribes` 表已有 `name` 和 `country_name` 欄位（官網訂閱流程使用），不需要新 migration。

## Goals / Non-Goals

**Goals:**
- notify modal 新增 Name（必填）、Country（必填）輸入欄位
- `landingSubscribe()` 儲存 name → `name`、country → `country_name`
- 開啟 Mailchimp 呼叫，傳入 `['NAME' => $name, 'COUNTRY' => $country]`

**Non-Goals:**
- 修改官網 `subscribe()` 或相關表單
- 加 reCAPTCHA 到活動頁訂閱
- 修改 `subscribes` 資料表結構

## Decisions

### 1. Name 和 Country 均為必填

與官網一致，Mailchimp merge field 要求不能傳空值。前端驗證 + 後端驗證雙重把關。

### 2. Country 使用下拉選單，資料來自 `$mail_chimp_country`

與官網 subscribe.blade.php 一致。`mail_chimp_country` 由 `ShareData` middleware 共享給所有 view，活動頁可直接使用，不需另外查詢。

### 3. 直接開啟 Mailchimp 整合

加上 name/country 之後，Mailchimp API 不再因 400 錯誤失敗，可以取消注解。若 Mailchimp 呼叫失敗，仍然回傳 success（資料已寫入 DB），僅 log error。

## Risks / Trade-offs

- **風險**：Mailchimp API key 或 list ID 設定不正確 → Mailchimp 失敗時只寫 log，不影響使用者體驗
- **風險**：`mail_chimp_country` 清單為空 → select 只顯示空選項，後端仍會驗證 country 非空
