## Why

`#promo-mini-btn` 目前是開啟 promo-overlay modal 的按鈕，使用者點擊後預期應該滾動到 `#contact` 區塊，改為錨點連結較直覺。

## What Changes

- 將 `#promo-mini-btn` 從 `<button onclick="...">` 改為 `<a href="#contact">`，點擊直接跳至頁面的 contact section。

## Capabilities

### New Capabilities

<!-- 無新 capability，屬於現有 landing page 的行為修正 -->

### Modified Capabilities

- `din-rail-landing-page`: promo-mini-btn 的點擊行為改為錨點捲動至 `#contact`。

## Impact

- 僅修改 `landing-din-rail-infinity-ready.blade.php` 第 2065 行附近的一個元素。
- promo-overlay modal 不受影響（其他觸發點若有保留則不動）。
