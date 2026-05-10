## Context

`#promo-mini-btn` 是固定在右下角的浮動按鈕，現在的 HTML 是：
```html
<button id="promo-mini-btn" onclick="document.getElementById('promo-overlay').classList.add('is-open')" ...>
```

## Goals / Non-Goals

**Goals:**
- 改為 `<a href="#contact">` 錨點，點擊後平滑捲動至 contact section。

**Non-Goals:**
- 不修改按鈕外觀（SVG icon、CSS 樣式保持不變）。
- 不移除 promo-overlay modal 本身（只是解除這個按鈕與它的綁定）。

## Decisions

**用 `<a>` 取代 `<button>`**，保留所有現有 CSS（`#promo-mini-btn` 樣式同時適用於 `a` 和 `button`）。加上 `scroll-behavior: smooth` 已在全域 CSS 設定，錨點跳轉自動平滑。
