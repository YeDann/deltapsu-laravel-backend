## ADDED Requirements

### Requirement: LEARN MORE 連結初始載入時反映當前語系
頁面載入時，所有 `data-url-template` 連結的 `href` SHALL 使用 PHP `App::getLocale()` 對應的語系路徑（如 `/tw/`、`/cn/`、`/jp/`）。

#### Scenario: 以繁中語系載入頁面
- **WHEN** 用戶以 `tw` 語系訪問 Landing Page
- **THEN** DIN Pro、DIN Eco、Compare DIN Pro、Compare Force GT 的 href SHALL 包含 `/tw/`

#### Scenario: 以英文語系載入頁面
- **WHEN** 用戶以 `en` 語系訪問 Landing Page
- **THEN** 所有 LEARN MORE 連結的 href SHALL 包含 `/en/`

### Requirement: 切換語系後 LEARN MORE 連結即時更新
`switchLang` 執行後，所有帶有 `data-url-template` 屬性的連結 SHALL 立即更新 `href`，以新語系路徑替換 `{locale}` 佔位符。

#### Scenario: 從 EN 切換至繁中
- **WHEN** 用戶在頁面上切換語系至 `zh-TW`
- **THEN** 所有 LEARN MORE 連結的 href SHALL 從 `/en/` 變更為 `/tw/`，且不需重載頁面

#### Scenario: 語系無對應路徑時使用 en
- **WHEN** 用戶語系為 de 或 tr（psu.deltaww.com 無此路徑）
- **THEN** 連結 SHALL 預設使用 `/en/` 路徑
