## Why

Landing page（`landing-din-rail-infinity-ready.blade.php`）目前是獨立的 standalone HTML，沒有引入官網的 header，導致使用者從官網進入 landing page 後缺少品牌導覽列，無法回到主站或切換語言（與現有語言切換機制不一致）。

## What Changes

- Landing page 從 standalone HTML 改為引入官網 header（`layouts/header-front.blade.php`）
- 載入官網 header 所需的 CSS（`frontend-asset/css/all.css`）與 JS 依賴（jQuery、Bootstrap JS）
- 移除 landing page 現有的自製語言切換器（`#langSwitcher`），改由官網 header 的語言切換機制處理
- 處理 UIKit（landing page）與 Bootstrap 4（官網 header）的 CSS 衝突
- 確保 landing page 的 `custom-navbar`（頁面內區塊錨點導覽列）仍正常運作，不受 header 影響

## Capabilities

### New Capabilities
- `landing-page-site-header`: Landing page 整合官網 header，包含 CSS 衝突隔離、JS 依賴管理、語言切換統一

### Modified Capabilities
- `din-rail-landing-page`: landing page 的 HTML 結構、`<head>` 區塊、語言切換邏輯需調整

## Impact

**受影響檔案：**
- `resources/views/front-end/landing-din-rail-infinity-ready.blade.php` — 主要修改對象
- `resources/views/layouts/header-front.blade.php` — 引入但不修改（只讀）

**依賴：**
- `public/frontend-asset/css/all.css` — header 的樣式
- `public/frontend-asset/js/` — Bootstrap、popper 等 header 需要的 JS
- `layouts/header-front.blade.php` — 需要 `$langUrls`、`App::getLocale()` 等 controller 傳入的變數，FrontendController 的 `landingDinRailInfinityReady()` 已傳入 `$langUrls`，需確認 header 所需的其他變數也有傳入

**技術風險：**
- Bootstrap 4 CSS 與 UIKit CSS 可能衝突（主要是 `.uk-*` class 與 Bootstrap grid 的 box-model 差異）
- 官網 header 使用 jQuery（`$`），landing page 目前不依賴 jQuery，需確保載入順序正確
- 官網 header 的 JS（`openNav`、`closeNav`、`bigImg` 等）定義在 `layouts/front-end.blade.php` 的 `<script>` 區塊，不在 header-front.blade.php 本身，需一併引入
