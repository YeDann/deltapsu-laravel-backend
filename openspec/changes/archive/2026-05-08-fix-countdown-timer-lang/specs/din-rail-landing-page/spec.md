## MODIFIED Requirements

### Requirement: Countdown timer targets locale-specific time
倒數計時器 SHALL 在每次 tick 時動態讀取當前語系（`document.documentElement.lang`）並計算目標時間：
- `zh-TW` / `zh-CN`：`2026-05-20T09:30:00+08:00`
- 其他（en、ja 等）：`2026-05-20T15:30:00+08:00`

語系切換後，下一個 tick（最多 1 秒）須反映新語系的倒數時間。Hero 和 video-countdown 兩個計時器均套用此邏輯。

#### Scenario: 語系切換後 Hero 計時器重算
- **WHEN** 使用者從 EN 切換至 zh-TW
- **THEN** Hero 計時器在 1 秒內更新為 09:30 的倒數時間

#### Scenario: 語系切換後 Video 計時器重算
- **WHEN** 使用者從 EN 切換至 zh-TW
- **THEN** video-countdown 計時器在 1 秒內更新為 09:30 的倒數時間

#### Scenario: TC locale timer targets 09:30
- **WHEN** 語系為 `zh-TW` 或 `zh-CN`
- **THEN** 兩個計時器顯示距 2026-05-20 09:30 UTC+8 的倒數

#### Scenario: EN/JP locale timer targets 15:30
- **WHEN** 語系為 `en` 或 `ja`
- **THEN** 兩個計時器顯示距 2026-05-20 15:30 UTC+8 的倒數
