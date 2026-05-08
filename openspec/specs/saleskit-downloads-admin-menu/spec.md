## Purpose

後台側邊欄加入獨立的「SALES KIT DOWNLOADS」選單項目，位於 GUI Downloads 下方，並支援 active state 高亮。

## Requirements

### Requirement: Admin sidenav shows Sales Kit Downloads entry
後台側邊欄 SHALL 在「GUI Downloads」項目下方顯示獨立的「SALES KIT DOWNLOADS」連結，指向 `saleskit_requests_index` route。

#### Scenario: Active state when on Sales Kit Downloads page
- **WHEN** 管理員在 Sales Kit Downloads 頁面（`$name == 'saleskit-requests'`）
- **THEN** 對應的 sidenav 連結 SHALL 帶有 `active` class

#### Scenario: Inactive state on other pages
- **WHEN** 管理員在非 Sales Kit Downloads 的任何其他頁面
- **THEN** 該連結 SHALL 不帶 `active` class，且仍可點擊跳轉

#### Scenario: Position relative to GUI Downloads
- **WHEN** 管理員查看側邊欄
- **THEN** SALES KIT DOWNLOADS SHALL 緊接在 GUI Downloads 項目下方顯示，兩者各為獨立的 `<li>` 元素
