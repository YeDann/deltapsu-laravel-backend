## 1. CSS：移除舊小卡片 padding/gap 規則，改為 flex column

- [x] 1.1 刪除舊 `#din-pro .bento-grid-horiz .feature-card.pos-2, ...` 的 padding/gap/overflow CSS 區塊
- [x] 1.2 新增小卡片 flex column 規則（display:flex, flex-direction:column, align-items:center, justify-content:flex-end, text-align:center, padding, gap, overflow:hidden）
- [x] 1.3 新增小卡片 icon zone 規則：選擇器 `#din-pro .bento-grid-horiz .feature-card.pos-2 .icon-wrap, ...`（PRO pos-4/5, ECO pos-3/5/6 同樣），屬性 `flex:1 1 auto; width:100%; display:flex; align-items:center; justify-content:center`
- [x] 1.4 新增小卡片 `p` 的 min-height:2.6em 規則

## 2. CSS：統一標題字體

- [x] 2.1 修改 `.feature-card .card-header, .pos1-subtitle, .temp-label` 為 `clamp(0.88rem,1.3vw,1.25rem)`, font-weight:700, line-height:1.2, margin:0

## 3. CSS：描述文字字體與顏色

- [x] 3.1 修改描述文字 font-size 為 `clamp(0.72rem,0.85vw,0.95rem)`，加上 `color:rgba(255,255,255,0.80)`

## 4. CSS：圖示尺寸

- [x] 4.1 修改 `.feature-card img`（或對應選擇器）width/height 為 `clamp(48px,7.5vw,110px)`，加 `display:block; flex-shrink:0`

## 5. CSS：pos-1 元素間距清零

- [x] 5.1 修改 `.pos1-icon` flex-shrink 為 0，height 上限改 110px
- [x] 5.2 修改 `.pos1-big-num` line-height:1.1, margin:0, padding-top:clamp(2px,0.3vw,5px)
- [x] 5.3 修改 `.pos1-subtitle` 和 `.pos1-label` margin:0
- [x] 5.4 新增 PRO/ECO pos-1 `.icon-wrap .pos1-label` 的 margin-bottom:clamp(6px,0.8vw,12px)

## 6. CSS：大數字字體縮小 + PRO pos-3 不換行

- [x] 6.1 修改 `#din-eco .feature-card.pos-1 .pos1-big-num` font-size 為 `clamp(1rem,2.6vw,2.6rem)`
- [x] 6.2 修改對應 media query（1280px, 1100px）的字體大小
- [x] 6.3 修改 `#din-pro .feature-card.pos-1 .pos1-big-num` font-size 為 `clamp(1rem,2.6vw,2.6rem)`
- [x] 6.4 新增 `#din-pro .feature-card.pos-3 .pos1-big-num` white-space:nowrap, overflow:visible 規則
- [x] 6.5 新增 PRO/ECO pos-1 `.pos1-subtitle` 的 font-size/font-weight 統一規則

## 7. CSS：溫度卡片樣式更新

- [x] 7.1 修改 `.temp-icon-wrap` flex-shrink:0
- [x] 7.2 修改 `.temp-text-wrap` 加 align-items:flex-start, text-align:left
- [x] 7.3 修改 `.temp-label` font-size/font-weight
- [x] 7.4 修改 `.temp-big-num` font-size 為 clamp(1rem,2.6vw,2.6rem), font-weight:800, line-height:1.1
- [x] 7.5 修改 `.temp-to` font-size 為 clamp(0.7rem,1.2vw,1.2rem)
- [x] 7.6 修改 `.temp-range` font-size 和顏色

## 8. CSS：溫度數字 inline-grid 排版（PRO pos-6 / ECO pos-4）

- [x] 8.1 新增 `#din-pro .feature-card.pos-6 .temp-big-num` inline-grid 規則，顏色 #05a3f7
- [x] 8.2 新增 `.temp-sign` / `.temp-digits` / `.temp-to` 在 pos-6 的顏色規則
- [x] 8.3 新增 `#din-eco .feature-card.pos-4 .temp-big-num` inline-grid 規則，顏色 #00F1CD
- [x] 8.4 新增 `.temp-sign` / `.temp-digits` / `.temp-to` 在 ECO pos-4 的顏色規則

## 9. CSS：pos-1 text column flex 排列（desktop）

- [x] 9.1 新增 `#din-pro .feature-card.pos-1 > div:last-child, #din-eco .feature-card.pos-1 > div:last-child` flex 規則（justify-content:flex-end, align-items:flex-start, align-self:stretch, gap）
- [x] 9.2 新增 pos-1 `icon-wrap` flex 規則（flex:1 1 auto, flex-direction:column, align-items:flex-start, justify-content:center）
- [x] 9.3 新增 `#din-pro .feature-card.pos-1 > div:last-child .pos1-label:last-child` min-height:2.6em

## 10. CSS：Mobile breakpoint 新增樣式

- [x] 10.1 在 mobile media query 新增 PRO/ECO pos-1 `> div:last-child` 置中規則
- [x] 10.2 在 mobile media query 新增 PRO pos-6 / ECO pos-4 `.temp-text-wrap` 左對齊覆蓋

## 11. HTML：PRO pos-1 容器結構調整

- [x] 11.1 PRO pos-1 外層 div 加上 flex 樣式（display:flex, flex-direction:column, justify-content:flex-end 等）
- [x] 11.2 內部新增 `<div class="icon-wrap">` 包裹大數字、副標題等元素
- [x] 11.3 各元素加上 `margin:0` style

## 12. HTML：各小卡片圖示加 icon-wrap

- [x] 12.1 PRO pos-2 img 加 `<div class="icon-wrap">` 包裹
- [x] 12.2 PRO pos-4 img 加 `<div class="icon-wrap">` 包裹
- [x] 12.3 PRO pos-5 img 加 `<div class="icon-wrap">` 包裹
- [x] 12.4 ECO pos-3 img 加 `<div class="icon-wrap">` 包裹
- [x] 12.5 ECO pos-5 img 加 `<div class="icon-wrap">` 包裹
- [x] 12.6 ECO pos-6 img 加 `<div class="icon-wrap">` 包裹

## 13. HTML：PRO pos-3（85~305V）加 icon-wrap

- [x] 13.1 PRO pos-3 大數字 div 外加 `<div class="icon-wrap">` 包裹，margin-bottom 改為 0

## 14. HTML：溫度數字拆分 span 結構

- [x] 14.1 PRO pos-6 `.temp-big-num` 改為 `<span class="temp-sign">-</span><span class="temp-digits">40°C <span class="temp-to">to</span></span><span class="temp-sign">+</span><span class="temp-digits">80°C</span>`
- [x] 14.2 ECO pos-4 `.temp-big-num` 改為相同結構（70°C）

## 15. HTML：ECO pos-1（3 Phase）結構調整

- [x] 15.1 容器 div 加 `display:flex; flex-direction:column; gap:0`
- [x] 15.2 `pos1-label`（Input range）加 `margin-bottom:0.1em`
- [x] 15.3 `pos1-big-num`（3 Phase）加 `margin-top:-0.1em`
- [x] 15.4 `pos1-label`（340~600V）改為 `<span>` 並套用 font-size/color/line-height 樣式
- [x] 15.5 `pos1-note`（3EN series）改為 `<span>` 並套用相同樣式，加 `margin-top:-0.3em`

## 16. HTML：ECO pos-2（95% High Efficiency）調整

- [x] 16.1 「Up to」div 改用 `pos1-label` class，調整 margin-bottom
- [x] 16.2 「95%」div 調整 margin-top/bottom
- [x] 16.3 「High Efficiency」div font-size 改為 `clamp(0.88rem,1.3vw,1.25rem)`，margin-top:0
