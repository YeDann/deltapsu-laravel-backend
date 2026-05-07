## ADDED Requirements

### Requirement: 後台可列表查看索取紀錄
後台 SHALL 在 `/admin/saleskit-requests` 提供分頁列表，顯示：姓名、Email、公司、電話、語系、申請類別、下載檔案、申請時間。需 auth middleware 保護。

#### Scenario: 管理員查看列表
- **WHEN** 已登入的管理員造訪 `/admin/saleskit-requests`
- **THEN** 顯示所有記錄（最新在前，每頁 15 筆）

#### Scenario: 未登入者被導向登入頁
- **WHEN** 未認證的使用者造訪 `/admin/saleskit-requests`
- **THEN** 系統導向登入頁

### Requirement: 後台可匯出 CSV
後台 SHALL 在 `/admin/saleskit-requests/export` 提供 CSV 下載，包含所有欄位。

#### Scenario: 匯出全部記錄
- **WHEN** 管理員點選「Export CSV」
- **THEN** 瀏覽器下載包含所有欄位的 CSV 檔案
