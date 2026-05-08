## Why

`landing_saleskit_requests` 資料表已記錄 Sales Kit 下載申請，但後台目前沒有獨立的瀏覽入口。需要在側邊欄新增「SALES KIT DOWNLOADS」選單項目，與現有的「GUI Downloads」分開顯示，讓管理員可以直接查看並匯出 Sales Kit 申請記錄。

## What Changes

- 在後台側邊欄（`sidenav.blade.php`）的「GUI Downloads」選單項目下方，新增獨立的「SALES KIT DOWNLOADS」連結
- 指向已存在的 `saleskit_requests_index` route（`SaleskitRequestController@index`）
- 選單 active 狀態使用 `$name == 'saleskit-requests'` 判斷

## Capabilities

### New Capabilities
- `saleskit-downloads-admin-menu`: 後台側邊欄新增 Sales Kit Downloads 獨立選單項目

### Modified Capabilities
（無現有 spec 需要異動）

## Impact

- 影響範圍：Admin CRUD（後台選單）
- 受影響檔案：
  - `resources/views/partials/sidenav.blade.php`（新增選單項目）
- 不異動 Controller、Route、View（已存在且正常運作）
- 不影響 Frontend 頁面、Landing Page、Redirect System、DB Schema
