## Context

Landing page 現有 `saleskit-form` modal，submit 後直接在前端用 `<a>` 觸發下載，無後端介入。需要改為 API-driven 流程，並補上資料庫記錄與後台管理。

## Goals / Non-Goals

**Goals:**
- 每次下載都記錄到 DB（無論是否重複申請）。
- 後台可依申請類別、語系過濾查看。
- 隱私權勾選為前端必填，後端不額外驗證。

**Non-Goals:**
- 不寄送 Email 通知（不同於 landingContact）。
- 不做 rate limiting（短期無需求）。
- 不做多語系 PDF（目前只有 EN 版）。

## Decisions

**PDF 存放在 `public/downloads/saleskit/`**
- 理由：靜態檔案，由 nginx/Apache 直接 serve，不需透過 PHP。
- API 只回傳相對路徑，前端用 `<a download>` 觸發瀏覽器下載。

**Application key 對應表（固定在 controller 陣列）**
```
sol.cobotArm      → Sales_kit_for_Cobot(EN)_20260504.pdf
sol.dataCenter    → Sales_kit_for_Data_Center(EN)_20260504.pdf
sol.evCharger     → Sales_kit_for_EV_Charger(EN)_20260504.pdf
sol.greenEnergy   → Sales_kit_for_Green_Energy(EN)_20260504.pdf
sol.processAuto   → Sales_kit_for_Process_Automation(EN)_20260504.pdf
sol.semiconductor → Sales_Kit_for_Semi-com(EN)_20260504.pdf
```
- 若 key 不在表內，回傳 422 error。
- DB 只記錄 `application` key，不記錄檔名（從 key 就能推導出下載了哪份）。

**Admin 用獨立 controller `SaleskitRequestController`**
- 繼承現有 `SubscribeController` 模式（auth middleware、paginate、CSV export）。

## Risks / Trade-offs

- **[風險] 檔案未放到 public/** → API 回傳 URL 但瀏覽器 404。移轉時需手動將 PDF 放入目錄。
- **[Trade-off] 不寄 Email** → 業務無即時通知；可之後補上。
