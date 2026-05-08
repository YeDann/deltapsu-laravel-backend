## 1. i18n 文字更新

- [x] 1.1 EN translations block：`overview.videoExpiry` 改為 `'2026.05.20 (Wed.) | 03:30 PM (UTC +8)'`
- [x] 1.2 JP translations block：`overview.videoExpiry` 改為 `'2026.05.20 (水) | 03:30 PM (UTC +8)'`
- [x] 1.3 TC translations block：`overview.videoExpiry` 改為 `'2026.05.20 (星期三) | 上午 09:30 (UTC +8)'`
- [x] 1.4 SC translations block：`overview.videoExpiry` 改為 `'2026.05.20 (星期三) | 上午 09:30 (UTC +8)'`

## 2. Hero 靜態 fallback 文字

- [x] 2.1 Hero 區塊 `<span data-i18n="overview.videoExpiry">` 的 fallback 文字更新（對應 EN）

## 3. 倒數計時器（依語系）

- [x] 3.1 Hero 計時器（`syncHeroCountdown`）：`var target = new Date(...)` 改為依 `document.documentElement.lang` 判斷——`zh-TW` 或 `zh-CN` 用 `2026-05-20T09:30:00+08:00`，其他用 `2026-05-20T15:30:00+08:00`
- [x] 3.2 Video 計時器（`video-countdown`）：`var target = new Date(...).getTime()` 同樣改為語系判斷邏輯
