## Why

活動時間調整，Landing Page 顯示的時間文字與 JavaScript 倒數計時器需同步更新。

## What Changes

- **EN/JP locales**：`overview.videoExpiry` 時間由 `3 PM` 改為 `03:30 PM`
- **TC/SC locales**：`overview.videoExpiry` 時間由 `15:00` 改為 `上午 09:30`
- **Hero 區塊靜態文字**：`<span data-i18n="overview.videoExpiry">` fallback 文字同步更新
- **JavaScript 倒數計時器**：兩處計時器改為依語系選目標時間——TC/SC 用 `09:30:00+08:00`，EN/JP 用 `15:30:00+08:00`，透過 `document.documentElement.lang` 判斷

## Capabilities

### New Capabilities
- (none)

### Modified Capabilities
- `din-rail-landing-page`: 活動時間文字與倒數計時器目標時間更新

## Impact

- 僅影響 `resources/views/front-end/landing-din-rail-infinity-ready.blade.php`
- 無後端邏輯、無 DB、無 API 變更
