## MODIFIED Requirements

### Requirement: 多語 LEARN MORE 連結
LEARN MORE 連結的多語 URL SHALL 由 PHP server-side render（`{{ App::getLocale() }}`）產生，不再依賴 client-side `switchLang()` 動態更新。SC 語系（`cn`）domain 改為 `deltapsu.cn`，其餘語系使用 `psu.deltaww.com`。

#### Scenario: EN 語系 LEARN MORE 連結
- **WHEN** 使用者以 `en` 語系開啟頁面
- **THEN** LEARN MORE 連結 href 為 `https://psu.deltaww.com/en/product/...`

#### Scenario: SC 語系 LEARN MORE 連結
- **WHEN** 使用者以 `cn` 語系開啟頁面
- **THEN** LEARN MORE 連結 href 為 `https://deltapsu.cn/cn/product/...`

#### Scenario: TC 語系 LEARN MORE 連結
- **WHEN** 使用者以 `tw` 語系開啟頁面
- **THEN** LEARN MORE 連結 href 為 `https://psu.deltaww.com/tw/product/...`

### Requirement: i18n 文字渲染
Landing page 的 JS 翻譯物件（`window._currentTranslations`）MUST 在頁面 load 時依 `window._locale` 套用一次，不再需要 `switchLang()` 觸發更新。

#### Scenario: 頁面載入時文字顯示正確語系
- **WHEN** 使用者以 `tw` 語系開啟頁面
- **THEN** 所有 `data-i18n` 元素顯示繁體中文文字

#### Scenario: 切換語系後文字顯示正確
- **WHEN** 使用者點擊 header 語言切換，跳轉至 `jp` 語系頁面
- **THEN** 頁面重新載入後所有 `data-i18n` 元素顯示日文文字
