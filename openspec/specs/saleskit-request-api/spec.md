## Purpose

後端 API，接收 Landing Page saleskit 表單提交，驗證資料後寫入資料庫並回傳下載連結。

## Requirements

### Requirement: API 接受表單並寫入 DB
系統 SHALL 在 `POST /landing/saleskit-request` 接收 JSON body（name, email, company, phone, application, locale），驗證必填欄位後寫入 `landing_saleskit_requests` 資料表。

#### Scenario: 必填欄位齊全時寫入成功
- **WHEN** 前端送出包含 name、email、company、application、locale 的 POST 請求
- **THEN** API 回傳 `{"status":"success","download_url":"/downloads/saleskit/<filename>"}` 且資料庫新增一筆記錄

#### Scenario: Email 格式錯誤
- **WHEN** email 不符合 `FILTER_VALIDATE_EMAIL`
- **THEN** API 回傳 HTTP 422 `{"status":"error","message":"Invalid email"}`

#### Scenario: application key 不在白名單
- **WHEN** application 值不在以下 6 個合法 key 內
- **THEN** API 回傳 HTTP 422 `{"status":"error","message":"Invalid application"}`

合法 application key 清單：
- `sol.cobotArm` — Cobot / 協作機器人
- `sol.semiconductor` — Semiconductor / 半導體
- `sol.dataCenter` — Data Center / 資料中心
- `sol.evCharger` — EV Charger / EV 充電站
- `sol.greenEnergy` — Green Energy / 綠色能源
- `sol.processAuto` — Process Automation / 流程自動化

### Requirement: 記錄包含語系與申請類別
`landing_saleskit_requests` 資料表 SHALL 包含以下欄位：id、name、email、company、phone（nullable）、locale、application、created_at。不記錄檔名，application key 本身即代表申請類別。

#### Scenario: locale 寫入實際語系代碼
- **WHEN** 使用者從 `/tw/landing/din-rail-infinity-ready` 提交
- **THEN** 該筆記錄的 locale 欄位為 `tw`

#### Scenario: application 寫入 key 字串
- **WHEN** 使用者申請 Cobot 類別
- **THEN** 該筆記錄的 application 欄位為 `sol.cobotArm`
