## 修改既有需求

### MODIFIED Requirements

### Requirement: 官網訂閱寫入時記錄來源
官網訂閱（`/subscribe` 與 `subCheckBox`）寫入 `subscribes` 時，`source` 欄位必須為 `'web'`，由 Controller 直接硬寫，不依賴前端傳值。

#### Scenario: 官網訂閱後 source 為 web
- **WHEN** 使用者透過官網訂閱表單成功訂閱
- **THEN** `subscribes` 表對應記錄的 `source` 欄位值為 `'web'`

#### Scenario: 前端未傳 source 仍寫入 web
- **WHEN** 表單送出時未帶 `source` 參數（官網 view 不改，永不帶此值）
- **THEN** 系統以 `'web'` 寫入，行為與有帶相同
