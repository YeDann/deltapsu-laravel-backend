## Why

Landing Page Series Comparison 區塊的 Force GT「LEARN MORE」連結，點進去後 Input Voltage Range 沒有預設選到「90-264 Vac」。用戶需要手動展開 filter 才能看到對應產品，體驗不佳。

## What Changes

- Force GT Learn More 連結加上 `onclick` handler
- 點擊時先將 `arr_inputtxt: [{type:'31', value_text:'90-264 Vac'}]` 寫入 `localStorage('productFilters')`
- 不修改 `product.blade.php`：現有的 `checkAndRestoreFilters` 機制會自動讀取、套用 filter、打勾 checkbox、清除 localStorage

## Capabilities

### New Capabilities
- `force-gt-prefilter-input-voltage`: 從 Landing Page 跳轉至 Force GT 產品頁時，自動預選 Input Voltage Range「90-264 Vac」

### Modified Capabilities
（無現有 spec 需要異動）

## Impact

- 影響範圍：Landing Page
- 受影響檔案：
  - `resources/views/front-end/landing-din-rail-infinity-ready.blade.php`（Force GT Learn More 連結加 onclick）
- 不修改 `product.blade.php`、Controller、DB
