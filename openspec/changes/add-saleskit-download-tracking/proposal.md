## Why

Landing page 的「索取銷售資料」功能目前只有前端 alert，不會記錄任何使用者資訊，也無法追蹤哪個人下載了哪份檔案。需要串接後端 API、建立資料庫記錄，並加上隱私權同意核取方塊。

## What Changes

- 新增資料庫表 `landing_saleskit_requests`，記錄姓名、Email、公司、電話、語系、申請類別。
- 新增後端 API 路由 `POST /landing/saleskit-request`，驗證欄位、寫入 DB，回傳對應 PDF 下載 URL。
- 前端表單加入隱私權核取方塊（必填），submit 改為呼叫 API，成功後觸發下載。
- 新增後台管理頁面，可列表查看索取紀錄（含 CSV 匯出）。

## Capabilities

### New Capabilities

- `saleskit-request-api`: 後端 API 接收表單、寫入 DB、回傳下載 URL。
- `saleskit-request-admin`: 後台管理頁面列表查看索取紀錄。

### Modified Capabilities

- `din-rail-landing-page`: 前端 modal 加隱私權勾選、submit 改 API 呼叫。

## Impact

- 新增 migration、controller method、admin controller、admin view、admin route。
- 修改 `landing-din-rail-infinity-ready.blade.php`：modal form、JS submit handler、i18n keys。
- PDF 檔案放 `public/downloads/saleskit/`，由 API 回傳路徑供前端下載。
