## MODIFIED Requirements

### Requirement: 語系切換器導向對應 URL
原需求：瀏覽器導向新 URL（整頁重載）。
**修正後**：語系切換 SHALL 原地更新頁面內容，並用 `history.pushState` 同步網址，不重載頁面。

#### Scenario: 切換語系後內容立即更新
- **WHEN** 使用者點選語系切換器中的「繁體中文」
- **THEN** 頁面所有 `[data-i18n]` 元素立即切換為繁體中文，無頁面重載

#### Scenario: 切換語系後網址更新
- **WHEN** 使用者在 `/en/landing/din-rail-infinity-ready` 點選「繁體中文」
- **THEN** 網址列更新為 `/tw/landing/din-rail-infinity-ready`，無頁面重載

#### Scenario: 切換後 saleskit API 帶正確語系
- **WHEN** 使用者切換至日文後送出 saleskit 表單
- **THEN** API 的 locale 欄位為 `jp`，而非原始載入語系
