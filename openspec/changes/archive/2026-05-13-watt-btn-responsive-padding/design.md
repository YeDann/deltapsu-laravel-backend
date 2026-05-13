## Context

`landing-din-rail-infinity-ready.blade.php` 第 166 行的 `.watt-btn` 使用固定 `padding: 8px 22px`；第 737 行在 `@media (max-width: 768px)` 區塊內以 `!important` 覆寫為 `6px 10px`。這造成兩個問題：1) 在 480~768px 之間按鈕仍偏大，2) 維護需同步兩處。

## Goals / Non-Goals

**Goals:**
- 讓 `.watt-btn` 的水平 padding 隨 viewport 寬度連續縮放
- 移除 mobile `!important` override，單一來源控制尺寸

**Non-Goals:**
- 不改動 `.wattage-filter` 容器排版邏輯
- 不修改按鈕顏色、border-radius 等非尺寸樣式
- 不影響其他頁面

## Decisions

**用 `clamp()` 取代雙斷點 padding**

將 `padding: 8px 22px` 改為：
```css
.watt-btn {
  padding: clamp(6px, 1.2vw, 8px) clamp(10px, 2.5vw, 22px);
}
```
- `1.2vw` 在 667px 時 ≈ 8px（上限），在 500px 時 ≈ 6px（下限）
- `2.5vw` 在 880px 時 ≈ 22px（上限），在 400px 時 ≈ 10px（下限）

移除第 737 行的 `.watt-btn { padding: 6px 10px !important; }` — clamp 本身已涵蓋此範圍。

**font-size 也改為 clamp（選擇性）**

同理將 `font-size: 0.95rem` 改為 `clamp(0.8rem, 1.8vw, 0.95rem)`，並移除 mobile override 的 `font-size: 0.8rem !important`。

**定位方式**：第 166 行 `.watt-btn { ... }` 在 `<style>` 區塊內，為獨立一行，Edit tool 可精確定位；第 737 行亦為獨立一行，在 `@media (max-width: 768px)` 內，可直接刪除整行。

## Risks / Trade-offs

- [clamp 值需手動驗證] → 在 DevTools 拖拉視窗確認各斷點視覺效果
- [舊瀏覽器不支援 clamp()] → IE 已不在支援範圍，無需 fallback
- [移除 !important 可能被其他 rule 覆蓋] → 目前無其他 rule 影響此 selector，風險低
