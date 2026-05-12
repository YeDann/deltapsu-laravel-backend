## Why

Landing page 的申請諮詢表單目前只收集公司、姓名、Email、國家、電話、產品、訊息等基本欄位，缺乏了解潛在客戶專案意圖的資料。加入一個「是否有進行中/即將啟動的電源供應專案」的下拉式問題，可以讓業務團隊更精準地評估詢問優先順序。

## What Changes

- 在申請諮詢表單的「訊息內容」欄位**上方**新增一個下拉式選單（4 個選項）
- 選項支援 EN / TC / SC / JP 四語系
- 表單送出時將選取值隨其他欄位一起傳送至後端
- 後端將此欄位值存入 `contacts` 資料表的新欄位 `question_project_status`
- 後台管理介面（若有展示詢問記錄）同步顯示此欄位

## Capabilities

### New Capabilities

（無新增獨立 capability，此為現有 landing page 表單的功能擴充）

### Modified Capabilities

- `din-rail-landing-page`：申請諮詢表單新增 `question_project_status` 下拉欄位，表單送出 payload 及後端儲存欄位均有變動

## Impact

- **Landing page**：`landing-din-rail-infinity-ready.blade.php` — 新增下拉 HTML 與 i18n 翻譯 key
- **DB schema**：`contacts` 資料表新增 `question_project_status` VARCHAR 欄位（遷移檔）
- **後端 API/Controller**：處理 landing contact 表單的 controller 方法需接收並寫入新欄位
- **Migration**：新增一支 migration 檔
