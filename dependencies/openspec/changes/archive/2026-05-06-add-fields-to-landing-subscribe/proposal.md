## Why

活動頁（DIN Rail landing page）的訂閱 modal 目前只收集 email，缺少 Mailchimp 必填的 NAME 和 COUNTRY merge fields，導致訂閱資料無法同步至 Mailchimp 名單。

## What Changes

- 訂閱 modal 新增 Name 和 Country 輸入欄位
- 前端 fetch() 帶 name 和 country 送出
- `landingSubscribe()` 接收並寫入 `subscribes` 表的 `name` 和 `country_name` 欄位
- 開啟 Mailchimp 整合，帶入實際的 NAME 和 COUNTRY 值

## Capabilities

### New Capabilities

- `landing-subscribe-with-name-country`：活動頁訂閱表單收集 name、country，寫入 DB 並同步 Mailchimp

### Modified Capabilities

（無）

## Impact

- `resources/views/front-end/landing-din-rail-infinity-ready.blade.php`：notify modal 新增欄位、JS 送出邏輯更新
- `app/Http/Controllers/FrontendController.php`：`landingSubscribe()` 新增 name、country 接收與儲存，開啟 Mailchimp 呼叫
- 不需要新 migration（`subscribes` 表已有 `name`、`country_name` 欄位）
