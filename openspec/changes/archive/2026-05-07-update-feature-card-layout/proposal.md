## Why

Landing page 的 DIN Rail 產品 Feature Card 視覺設計需要調整，以改善 RWD 對齊、文字縮放一致性，以及溫度數字的排版精確度。

## What Changes

- **CSS**：Feature Card 小卡片（pos-2/4/5/6）改為 flexbox 縱向排列，圖示區域彈性延伸，描述文字固定 min-height 以對齊標題
- **CSS**：所有標題（card-header / pos1-subtitle / temp-label）統一字體大小為 `clamp(0.88rem,1.3vw,1.25rem)` 並加粗
- **CSS**：描述文字改為 `clamp(0.72rem,0.85vw,0.95rem)` 並加上 `rgba(255,255,255,0.80)` 透明度
- **CSS**：圖示尺寸從 36px~100px 改為 48px~110px
- **CSS**：pos-1 元素間距全部清零，改用 flex gap 控制
- **CSS**：大數字字體縮小（eco: 3.5rem → 2.6rem；pro: 3rem → 2.6rem），新增 pos-3 85~305V 不換行規則
- **CSS**：溫度卡片（PRO pos-6 / ECO pos-4）改用 `inline-grid` 排版正負符號與數字
- **CSS**：新增 mobile breakpoint 下 pos-1 置中對齊、溫度卡片左對齊覆蓋
- **HTML**：PRO pos-1 容器加 flex 排列，內部加 `icon-wrap` 包裹大數字區域
- **HTML**：PRO/ECO 各小卡片（pos-2/4/5/6 等）圖示加上 `<div class="icon-wrap">` 包裹
- **HTML**：PRO pos-3 大數字加 `icon-wrap` 包裹
- **HTML**：PRO pos-6 / ECO pos-4 溫度數字拆分為 `temp-sign` + `temp-digits` span 結構
- **HTML**：ECO pos-1（3 Phase）容器加 flex、移除舊 `pos1-note` 改用 `span` 行內顯示
- **HTML**：ECO pos-2（95% High Efficiency）標題字體改用 clamp，調整各元素 margin

## Capabilities

### New Capabilities
- (none)

### Modified Capabilities
- `din-rail-landing-page`: Feature Card 的 CSS 排版規則與 HTML 結構調整（不改變功能，僅視覺/RWD）

## Impact

- 僅影響 `resources/views/front-end/landing-din-rail-infinity-ready.blade.php`
- 無後端邏輯、無 DB、無 API 變更
