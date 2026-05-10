## 背景

本專案使用 LaravelLocalization 以語系前綴（`/en`、`/tw`、`/cn`、`/jp`、`/de`、`/tr`）服務多語系產品目錄網站。`delta-zh-TW.html` 是一個獨立的行銷 landing page，目前在框架外，需要整合進來但不能改變其視覺與互動功能。

**頁面現有語系系統：**
- 所有文字元素使用 `data-i18n` 屬性標記
- `window.setLang(lang)` 讀取 JS `translations` 物件來替換所有文字
- 載入時依序偵測：`localStorage` → 瀏覽器 `navigator.language` → 預設 `en`
- 語系切換器呼叫 `switchLang(lang)`，只更新頁面內狀態

頁面的 JS `translations` 物件支援：`en`、`zh-TW`、`zh-CN`、`ja`。
Laravel locale 對應 HTML lang：`en→en`、`tw→zh-TW`、`cn→zh-CN`、`jp→ja`。
不在對應表內的 locale（如 `de`、`tr`）一律 fallback 到 `en`，依據是頁面 `translations` 物件實際有的語系，而非硬寫哪幾個要 fallback。

## 目標 / 非目標

**目標：**
- 讓所有 LaravelLocalization 支援的語系都能存取 `/{lang}/landing/din-rail-infinity-ready`
- 頁面語系由 URL 語系（伺服器端）決定，不依賴 localStorage 或瀏覽器偵測
- 保留頁面所有現有的 JS、CSS、動畫、互動功能
- 語系切換器改為導向對應 URL

**非目標：**
- 為 de/tr 新增翻譯字串
- 更動任何視覺設計或內容
- 套用網站共用 layout（header/footer）—— 此頁為完全獨立頁面

## 技術決策

### 1. 完整獨立的 Blade view（不 `@extends` 任何 layout）

Landing page 有自己的 `<!DOCTYPE html>`，使用 UIkit、GSAP、自訂 CSS 與黑色背景。若套用 `layouts.app` 需要拔掉 `<html>/<head>/<body>` 標籤，且會與其他頁面的 Bootstrap 4 產生 CSS 衝突。

**決策**：Blade 檔案輸出完整 HTML 文件，不 `@extends`。

### 2. 伺服器端語系 → 客戶端初始化

Laravel 在頁面載入前就知道 URL 語系。透過 Blade 將語系傳給頁面，在 `</head>` 前插入一行 script：

```blade
<script>window._serverLang = '{{ $htmlLang }}';</script>
```

修改既有的 `DOMContentLoaded` init 區塊，讓它優先讀取 `window._serverLang`：

```js
var lang = window._serverLang || (saved && translations[saved] ? saved : computedFromBrowser);
window.setLang(lang);
```

只改 init 區塊一行，其餘 JS 完全不動。

**排除方案**：用伺服器端覆寫 `localStorage`。原因：localStorage 會跨頁面持續，可能影響網站其他部分。

### 3. 語系切換器改為 URL 導向

現有行為：`onclick="switchLang('zh-TW', this)"` 只更新頁面內狀態。
新行為：點選語系選項後導向對應 URL。

在每個 `.lang-option` 加上 `data-lang-url` 屬性，覆寫 `window.switchLang` 讓它在有 URL 時直接 `window.location.href` 跳頁。

Controller 傳入 `$langUrls` 陣列（HTML lang → URL）：
- `en` → `/en/landing/din-rail-infinity-ready`
- `zh-TW` → `/tw/landing/din-rail-infinity-ready`
- `zh-CN` → `/cn/landing/din-rail-infinity-ready`
- `ja` → `/jp/landing/din-rail-infinity-ready`

### 4. 路由放在 LaravelLocalization 群組內

確保語系 middleware 正確解析前綴，`App::getLocale()` 在 controller 執行前就設定好。

## 風險 / 取捨

- **風險**：部分語系（de、tr）無翻譯 → 因應：controller 的 `$localeMap` 只列出頁面 `translations` 實際支援的語系，不在 map 內的一律 fallback `en`。往後活動頁新增語系，只需更新 controller 的 map 即可。
- **風險**：Blade 檔案約 2700 行，未來編輯時字串可能不唯一 → 因應：編輯時提供更多前後文給 Edit 工具。
- **風險**：UIkit JS 與既有 jQuery/Bootstrap 衝突 → 因應：此頁為完整獨立文件，UIkit 只存在此頁，不影響其他頁面。

## 部署計畫

1. 新增路由（不影響任何既有路由）
2. 新增 controller method（只加一個 public method，不動其他方法）
3. 建立 Blade view（純新增檔案）
4. 原始 `delta-zh-TW.html` 保留不動

回滾：刪除路由那一行和 Blade 檔案即可，對現有頁面零風險。

## 待確認問題

- `<title>` 是否要跟著語系變化？（目前硬寫 "Delta Industrial Power Solutions"）——可在 controller 加一個小型 i18n 對應表。
- 是否需要排除 `HtmlMinifier` middleware？（頁面有 inline script 大量字串，壓縮可能造成問題，實作時確認。）
