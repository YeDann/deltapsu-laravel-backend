## MODIFIED Requirements

### Requirement: Event time display by locale
`overview.videoExpiry` 的時間欄位 SHALL 依語系顯示：
- EN：`03:30 PM (UTC +8)`
- JP：`03:30 PM (UTC +8)`
- TC：`上午 09:30 (UTC +8)`
- SC：`上午 09:30 (UTC +8)`

#### Scenario: EN locale shows 03:30 PM
- **WHEN** 使用者以 `/en/` 語系造訪 landing page
- **THEN** `overview.videoExpiry` 元素顯示 `2026.05.20 (Wed.) | 03:30 PM (UTC +8)`

#### Scenario: TC locale shows 上午 09:30
- **WHEN** 使用者以 `/tw/` 語系造訪 landing page
- **THEN** `overview.videoExpiry` 元素顯示 `2026.05.20 (星期三) | 上午 09:30 (UTC +8)`

### Requirement: Countdown timer targets locale-specific time
倒數計時器 SHALL 依 `document.documentElement.lang` 選擇目標時間：
- `zh-TW` / `zh-CN`：`2026-05-20T09:30:00+08:00`
- 其他（en、ja 等）：`2026-05-20T15:30:00+08:00`

Hero 和 video-countdown 兩個計時器均套用此邏輯。

#### Scenario: TC locale timer targets 09:30
- **WHEN** 語系為 `zh-TW` 或 `zh-CN` 時頁面載入
- **THEN** 兩個計時器的目標時間為 2026-05-20 09:30 UTC+8

#### Scenario: EN/JP locale timer targets 15:30
- **WHEN** 語系為 `en` 或 `ja` 時頁面載入
- **THEN** 兩個計時器的目標時間為 2026-05-20 15:30 UTC+8
