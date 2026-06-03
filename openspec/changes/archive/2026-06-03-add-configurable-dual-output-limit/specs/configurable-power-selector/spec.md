## ADDED Requirements

### Requirement: Dual Output 模組數上限驗證

Configurable Power Selector MUST 限制單一 frame 內可選為 Dual Output 的 slot 總數，上限依 frame model：MEG-700A=3、MEG-1K2A≤3、MEG-2K1A≤2、MEG-3K0A≤3（以 frame 的 `max_power` 對應：700/1200/2100/3000）。達上限時，其餘**尚未選 Dual** 的 slot 之 Dual Output 選項 MUST 被 disable（灰掉、不可選）；已選 Dual 的 slot MUST 仍可改回 Single 以解除限制。判斷 MUST 依**已選 Dual 的總數**，而非出現順序。此驗證 MUST 不影響既有的 voltage/current 必填檢查與 slot 總數上限。

#### Scenario: 選滿上限後其餘 Dual 灰掉
- **WHEN** 使用者在某 frame（如 MEG-2K1A，上限 2）已將 2 個 slot 選為 Dual Output
- **THEN** 其餘尚未選 Dual 的 slot 之 Dual Output 選項被 disable、不可再選；已選 Dual 的 slot 仍可改回 Single

#### Scenario: 解除後恢復可選
- **WHEN** 使用者把其中一個已選 Dual 的 slot 改回 Single（低於上限）
- **THEN** 其餘 slot 的 Dual Output 選項恢復可選

#### Scenario: 依總數非順序
- **WHEN** 使用者以任意順序選取 Dual（中間 slot、前後跳選）
- **THEN** 以已選 Dual 的總數判斷是否達上限，與選取順序無關

#### Scenario: 切換 frame 重新計算
- **WHEN** 使用者切換到不同 frame model
- **THEN** 依新 frame 的上限重新計算 disable 狀態

### Requirement: Dual Output 多語說明文字

每個 Dual Output 選項旁 MUST 提供說明，以**問號 tooltip** 呈現（比照頁面既有 Option / Communication / Control Code 的問號圖示，hover 展開），說明該 frame 可安裝的 dual output 模組數上限。文字 MUST 為多語（EN/DE/TC/SC/JP/TR）、來自 `static_keyword`（後台可維護），且 MUST 以模板帶入當前 frame 名與上限數（隨選擇變）。

#### Scenario: 顯示對應語系與當前 frame
- **WHEN** 使用者以某語系瀏覽、選定某 frame，hover Dual Output 旁的問號
- **THEN** tooltip 顯示該語系說明，frame 名與上限數對應當前 frame

#### Scenario: 後台可維護文案
- **WHEN** 管理者於後台 static_word 修改該說明文字的某語系（保留 frame/數字 placeholder）
- **THEN** 前台以該語系瀏覽時顯示更新後文案
