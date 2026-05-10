## Why

Landing page 目前語系切換會執行 `window.location.href = url`，導致整頁重載。客戶要求改為原地切換內容（不重載），但網址仍需同步更新為對應語系的 URL。

## What Changes

- `switchLang()` 函式：移除 `window.location.href` 跳頁邏輯，改為呼叫 `setLang(lang)` 切換內容，並用 `history.pushState` 更新網址列。
- 同步更新 `window._locale`，確保後續 API 呼叫（如 saleskit-request）帶正確語系。

## Capabilities

### New Capabilities

<!-- 無新 capability -->

### Modified Capabilities

- `din-rail-landing-page`: 語系切換行為改為原地切換 + `history.pushState`，不再整頁重載。

## Impact

- 僅修改 `landing-din-rail-infinity-ready.blade.php` 的 `switchLang` 函式（約第 2478 行）。
- 不影響後端路由；語系 URL 仍由 `$langUrls` 提供，只是不再用 `href` 跳頁。
