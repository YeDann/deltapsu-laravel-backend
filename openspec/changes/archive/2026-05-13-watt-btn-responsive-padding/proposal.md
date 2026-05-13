## Why

`.watt-btn` 目前使用固定 `padding: 8px 22px`，在小螢幕上按鈕過寬、排版擁擠，雖然 `≤768px` 已有 override（`6px 10px`），但仍是硬切兩個斷點，無法平滑縮放。改為 `clamp()` 響應式寫法可讓按鈕寬度隨螢幕尺寸自然縮放，不需多個 `!important` override。

## What Changes

- 將 `.watt-btn` 的 `padding` 改為 `clamp()` 響應式值，水平 padding 隨 viewport 寬度縮放
- 移除 `@media (max-width: 768px)` 區塊內對 `.watt-btn` 的 `padding` `!important` override（已由 clamp 取代）
- `font-size` 的 mobile override 視情況也可改為 `clamp()`

## Capabilities

### New Capabilities

- 無

### Modified Capabilities

- `din-rail-landing-page`: `.watt-btn` padding 由固定值改為 clamp() 響應式，移除舊 mobile override

## Impact

- 影響頁面：Landing page（`resources/views/front-end/landing-din-rail-infinity-ready.blade.php`）
- 受影響元素：`.watt-btn`（第 166、737 行的 CSS）
- 無後端、DB、或其他頁面影響
