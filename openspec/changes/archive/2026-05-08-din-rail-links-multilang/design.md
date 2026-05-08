## Context

Landing Page 的語系切換（`switchLang`）使用 `history.pushState` 不重載頁面，因此 PHP render 的 href 不會重新計算。需要 JS 在切換時同步更新連結。`window._locale` 在 `switchLang` 中已同步更新，可直接使用。

現有的語系對應：`en→en`、`zh-TW→tw`、`zh-CN→cn`、`ja→jp`，對應 psu.deltaww.com 的 URL 路徑。

## Goals / Non-Goals

**Goals:**
- 初始載入正確語系 URL（PHP）
- 切換語系後連結即時更新（JS）

**Non-Goals:**
- 不處理 de/tr（psu.deltaww.com 無此語系，連結預設用 `en`）

## Decisions

**data-url-template 方式**：在每個連結加上 `data-url-template="https://psu.deltaww.com/{locale}/..."` 屬性。`switchLang` 中用一段通用代碼 `querySelectorAll('[data-url-template]')` 統一替換，不需針對每個連結寫個別邏輯。

## Risks / Trade-offs

無顯著風險；純 HTML attribute + JS 替換，影響範圍僅限 Landing Page。
