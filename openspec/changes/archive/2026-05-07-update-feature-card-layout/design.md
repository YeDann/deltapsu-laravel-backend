## Context

Landing page (`landing-din-rail-infinity-ready.blade.php`) 的 Feature Card 區塊包含 PRO 和 ECO 兩個產品系列的特色卡片（bento-grid 佈局）。目前小卡片圖示對齊不一致、標題字體大小不統一、溫度數字正負號排版難以精確控制。

## Goals / Non-Goals

**Goals:**
- 小卡片一律改為 flex column，icon 區彈性延伸，desc 固定 min-height 使同行標題對齊
- 所有標題統一字體規格
- 溫度數字正負號改用 inline-grid 精確對齊
- mobile 下 pos-1 置中、溫度卡片左對齊

**Non-Goals:**
- 不修改後端邏輯、路由、資料庫
- 不改變 i18n key 或翻譯內容
- 不調整其他頁面

## Decisions

**決策 1：統一在 blade 檔的 `<style>` 區塊修改 CSS，不拆到外部 CSS 檔**
- 原因：landing page CSS 目前全部內嵌，維持一致。拆檔需要 build pipeline 變更。

**決策 2：HTML 結構加 `icon-wrap` div 包裹圖示**
- 原因：讓 flex 容器可以用 `flex: 1 1 auto` 讓圖示區彈性延伸，desc 固定在底部。

**決策 3：溫度數字改為 `inline-grid` + 分拆 span**
- 原因：`-40°C to +80°C` 的正負號（-/+）需要固定寬度欄位對齊，`inline-grid` 比 flex 更精確。

## Risks / Trade-offs

- [風險] 大量 CSS `!important` 可能造成後續維護困難 → 接受，現有程式碼已大量使用
- [風險] blade 檔 2746 行，字串不唯一時 Edit tool 會失敗 → 使用更多上下文確保唯一性
