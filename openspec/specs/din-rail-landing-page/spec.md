### Requirement: 語系化 URL 可正常存取
系統必須在所有 LaravelLocalization 支援的語系前綴下（`en`、`tw`、`cn`、`jp`、`de`、`tr`），透過 `/{locale}/landing/din-rail-infinity-ready` 提供 landing page。

#### Scenario: 英文 URL 回傳 200
- **WHEN** 使用者造訪 `/en/landing/din-rail-infinity-ready`
- **THEN** 伺服器回傳 HTTP 200 及 landing page HTML

#### Scenario: 繁中 URL 回傳 200
- **WHEN** 使用者造訪 `/tw/landing/din-rail-infinity-ready`
- **THEN** 伺服器回傳 HTTP 200 及 landing page HTML

### Requirement: 頁面語系由 URL 語系段落決定
頁面必須以 URL 語系段落對應的語言初始化，不依賴 `localStorage` 或瀏覽器語言偵測。

頁面的 JS `translations` 物件定義了支援的 HTML lang code（`en`、`zh-TW`、`zh-CN`、`ja`）。Controller 將 Laravel locale 對應至 HTML lang code；沒有對應的 locale 一律 fallback 到 `en`。

對應表：
- `en` → `en`
- `tw` → `zh-TW`
- `cn` → `zh-CN`
- `jp` → `ja`
- 其他語系 → `en`（活動頁無此翻譯，自動帶英語）

#### Scenario: 英文語系顯示英文內容
- **WHEN** 使用者造訪 `/en/landing/din-rail-infinity-ready`
- **THEN** `<html lang>` 為 `en`，所有 `[data-i18n]` 元素顯示英文

#### Scenario: 繁中語系顯示繁中內容
- **WHEN** 使用者造訪 `/tw/landing/din-rail-infinity-ready`
- **THEN** `<html lang>` 為 `zh-TW`，所有 `[data-i18n]` 元素顯示繁體中文

#### Scenario: 日文語系顯示日文內容
- **WHEN** 使用者造訪 `/jp/landing/din-rail-infinity-ready`
- **THEN** `<html lang>` 為 `ja`，所有 `[data-i18n]` 元素顯示日文

#### Scenario: 無翻譯的語系 fallback 英文
- **WHEN** 使用者造訪 `/de/landing/din-rail-infinity-ready`
- **THEN** 頁面以英文顯示

### Requirement: 語系切換器導向對應 URL
使用者點選頁面內建語系切換器的語言選項時，瀏覽器必須導向 `/{locale}/landing/din-rail-infinity-ready`，而不是在頁面內直接切換內容。

#### Scenario: 從英文切換到繁中
- **WHEN** 使用者在 `/en/landing/din-rail-infinity-ready` 點選語系切換器中的「繁體中文」
- **THEN** 瀏覽器導向 `/tw/landing/din-rail-infinity-ready`

#### Scenario: 從繁中切換到英文
- **WHEN** 使用者在 `/tw/landing/din-rail-infinity-ready` 點選語系切換器中的「English」
- **THEN** 瀏覽器導向 `/en/landing/din-rail-infinity-ready`

### Requirement: 頁面視覺與互動功能完整保留
所有動畫、滾動效果、影片背景、瓦數篩選、產品卡片、Modal、側邊導覽列、行動版底部導覽列，必須與原始 `delta-zh-TW.html` 完全相同。

#### Scenario: GSAP 滾動動畫正常觸發
- **WHEN** 使用者向下滾動頁面
- **THEN** `.reveal-up` 元素如原始 HTML 般動畫進場

#### Scenario: 瓦數篩選器正常運作
- **WHEN** 使用者點選 DIN Pro 或 DIN Eco 區塊的瓦數篩選按鈕
- **THEN** 只顯示符合該瓦數的產品卡片
