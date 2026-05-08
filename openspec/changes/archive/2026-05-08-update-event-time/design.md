## Context

Landing page 的活動時間資訊分散在三處：
1. Hero 區塊靜態 HTML fallback 文字（`<span data-i18n="overview.videoExpiry">`）
2. JS i18n translations 物件中各語系的 `overview.videoExpiry` 值（en, tw, cn, jp 四個語系 block）
3. 倒數計時器 JS：`new Date('2026-05-20T15:00:00+08:00')` 共兩處（line ~902 和 line ~2172）

## Goals / Non-Goals

**Goals:**
- EN/JP: 時間顯示改為 `03:30 PM`
- TC/SC: 時間顯示改為 `上午 09:30`
- 倒數計時器目標改為 `2026-05-20T09:30:00+08:00`

**Non-Goals:**
- 不修改其他語系（de, tr）
- 不改日期 `2026.05.20`
- 不改其他活動文字

## Decisions

**計時器統一目標為 09:30 UTC+8**：TC/SC 由 15:00 改為 上午 09:30，代表活動時間提前至當天早上，計時器應對應最早的活動時間點。

## Risks / Trade-offs

- 修改點分散，需確認 blade 檔中所有 `15:00:00+08:00` 都已替換
