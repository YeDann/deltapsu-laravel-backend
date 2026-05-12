## Why

Landing page 的倒數計時器目標時間依語系不同（TC/SC 為 09:30、EN/JP 為 15:30），但目前兩個計時器在 script 載入時就把 `document.documentElement.lang` 讀取並固定為目標時間，語系切換後（`setLang` 呼叫）計時器不會重算，導致切換語系後顯示錯誤的倒數時間。

## What Changes

- **Hero 計時器**（`syncHeroCountdown`，line ~901）：移除啟動時固定的 `_heroTarget` 變數，改為在 `tick()` 內每次動態讀取 `document.documentElement.lang` 並計算目標時間
- **Video 計時器**（`video-countdown`，line ~2172）：同樣移除啟動時固定的 `target`，改為在 `tick()` 內動態計算

## Capabilities

### New Capabilities
- (none)

### Modified Capabilities
- `din-rail-landing-page`: 倒數計時器語系響應行為修正

## Impact

- 僅影響 `resources/views/front-end/landing-din-rail-infinity-ready.blade.php` 的兩段 JS（line ~899-924、line ~2171-2195）
- 無後端、無 DB、無 CSS 變更
