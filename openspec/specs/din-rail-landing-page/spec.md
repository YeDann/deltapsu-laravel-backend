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
語系切換 SHALL 原地更新頁面內容，並用 `history.pushState` 同步網址列為對應語系 URL，不重載頁面。`window._locale` 同步更新供後續 API 呼叫使用。

#### Scenario: 切換語系後內容立即更新
- **WHEN** 使用者點選語系切換器中的「繁體中文」
- **THEN** 頁面所有 `[data-i18n]` 元素立即切換為繁體中文，無頁面重載

#### Scenario: 切換語系後網址更新
- **WHEN** 使用者在 `/en/landing/din-rail-infinity-ready` 點選「繁體中文」
- **THEN** 網址列更新為 `/tw/landing/din-rail-infinity-ready`，無頁面重載

#### Scenario: 切換後 saleskit API 帶正確語系
- **WHEN** 使用者切換至日文後送出 saleskit 表單
- **THEN** API 的 locale 欄位為 `jp`，而非原始載入語系

### Requirement: 頁面視覺與互動功能完整保留
所有動畫、滾動效果、影片背景、瓦數篩選、產品卡片、Modal、側邊導覽列、行動版底部導覽列，必須與原始 `delta-zh-TW.html` 完全相同。`#promo-mini-btn` SHALL 為錨點連結，點擊後捲動至 `#contact` section。

#### Scenario: GSAP 滾動動畫正常觸發
- **WHEN** 使用者向下滾動頁面
- **THEN** `.reveal-up` 元素如原始 HTML 般動畫進場

#### Scenario: 瓦數篩選器正常運作
- **WHEN** 使用者點選 DIN Pro 或 DIN Eco 區塊的瓦數篩選按鈕
- **THEN** 只顯示符合該瓦數的產品卡片

#### Scenario: 點擊 promo-mini-btn 捲動至 contact
- **WHEN** 使用者點擊右下角的 `#promo-mini-btn`
- **THEN** 頁面平滑捲動至 `id="contact"` 的 section

### Requirement: Feature Card small card layout
Feature 小卡片（pos-2/4/5/6）SHALL 使用 flex column 縱向排列，圖示區域 `icon-wrap` 彈性延伸（`flex: 1 1 auto`），描述文字區塊具備 `min-height: 2.6em` 以確保同行標題對齊。

#### Scenario: Small card icon and title alignment
- **WHEN** 瀏覽器渲染 bento-grid 小卡片
- **THEN** 所有小卡片的描述文字頂部對齊，不因圖示大小差異而錯位

### Requirement: Feature Card title typography
所有標題元素（`.card-header`、`.pos1-subtitle`、`.temp-label`）SHALL 使用統一字體大小 `clamp(0.88rem,1.3vw,1.25rem)`、`font-weight: 700`、`line-height: 1.2`、`margin: 0`。

#### Scenario: Title font unified
- **WHEN** 瀏覽器渲染 PRO 和 ECO 的所有 Feature Card
- **THEN** 所有標題文字大小視覺上一致

### Requirement: Feature Card description typography
描述文字 SHALL 使用 `clamp(0.72rem,0.85vw,0.95rem)`、`color: rgba(255,255,255,0.80)`。

#### Scenario: Description color and size
- **WHEN** 瀏覽器渲染卡片描述文字
- **THEN** 描述文字比標題小且帶半透明白色

### Requirement: Feature Card icon size
小卡片圖示 SHALL 尺寸為 `clamp(48px,7.5vw,110px)`，並加上 `display: block`、`flex-shrink: 0`。

#### Scenario: Icon size responsive
- **WHEN** 視窗寬度從 mobile 到 desktop 縮放
- **THEN** 圖示大小在 48px 到 110px 之間線性縮放

### Requirement: Temperature card number grid layout
PRO pos-6 / ECO pos-4 的溫度數字 SHALL 使用 `inline-grid`（`grid-template-columns: 0.6em auto`）排版正負符號（`.temp-sign`）與數字（`.temp-digits`），顏色分別為 PRO `#05a3f7`、ECO `#00F1CD`。

#### Scenario: Temperature sign alignment
- **WHEN** 瀏覽器渲染溫度範圍（-40°C to +80°C）
- **THEN** 正負號（-/+）欄位寬度固定，數字欄位對齊基線

### Requirement: pos-1 Peak Power layout
PRO pos-1 容器 SHALL 改為 flex column（`justify-content: flex-end`），內部加 `icon-wrap` 包裹大數字與副標題，gap 由 CSS clamp 控制，所有 margin 清零。

#### Scenario: Peak Power card structure
- **WHEN** 瀏覽器渲染 PRO pos-1 卡片
- **THEN** 大數字「150%」和副標題「Peak Power」及描述文字底部對齊，間距一致

### Requirement: Mobile responsive overrides
Mobile breakpoint 下 pos-1 SHALL 置中對齊（`align-items: center; text-align: center`），溫度卡片（pos-6 / pos-4）文字欄 SHALL 保持左對齊。

#### Scenario: Mobile pos-1 centered
- **WHEN** 視窗寬度觸發 mobile breakpoint
- **THEN** pos-1 卡片內容水平置中

#### Scenario: Mobile temp card left-aligned
- **WHEN** 視窗寬度觸發 mobile breakpoint
- **THEN** 溫度卡片文字區塊保持左對齊，不被 pos-1 置中規則影響

### Requirement: JP locale brand and event copy
JP 語系的品牌名稱與活動標題 SHALL 顯示為：
- `overview.event.line1`：`デルタ標準電源`
- `overview.event.line2`：`2026年 新製品発表イベント`
- `overview.title1`：`卓越したパワーを追求する`
- `hero.upcomingLabel`：`デルタ最新製品ラインナップ一覧`

#### Scenario: JP locale shows updated copy
- **WHEN** 使用者以 `/jp/` 語系造訪 landing page
- **THEN** 上述 4 個 key 的文字顯示為新版日文內容

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
倒數計時器 SHALL 在每次 tick 時動態讀取 `document.documentElement.lang` 並計算目標時間：
- `zh-TW` / `zh-CN`：`2026-05-20T09:30:00+08:00`
- 其他（en、ja 等）：`2026-05-20T15:30:00+08:00`

語系切換後，下一個 tick（最多 1 秒）須反映新語系的倒數時間。Hero 和 video-countdown 兩個計時器均套用此邏輯。

#### Scenario: TC locale timer targets 09:30
- **WHEN** 語系為 `zh-TW` 或 `zh-CN` 時頁面載入
- **THEN** 兩個計時器的目標時間為 2026-05-20 09:30 UTC+8

#### Scenario: EN/JP locale timer targets 15:30
- **WHEN** 語系為 `en` 或 `ja` 時頁面載入
- **THEN** 兩個計時器的目標時間為 2026-05-20 15:30 UTC+8

#### Scenario: 語系切換後 Hero 計時器重算
- **WHEN** 使用者從 EN 切換至 zh-TW
- **THEN** Hero 計時器在 1 秒內更新為 09:30 的倒數時間

#### Scenario: 語系切換後 Video 計時器重算
- **WHEN** 使用者從 EN 切換至 zh-TW
- **THEN** video-countdown 計時器在 1 秒內更新為 09:30 的倒數時間
