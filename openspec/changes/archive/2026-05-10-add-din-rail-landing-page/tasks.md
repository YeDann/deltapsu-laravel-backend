## 1. 路由與 Controller

- [x] 1.1 在 `dependencies/routes/web.php` LaravelLocalization 路由群組內新增路由 `GET /landing/din-rail-infinity-ready`，指向 `FrontendController@dinRailLandingPage`
- [x] 1.2 在 `app/Http/Controllers/FrontendController.php` 新增 `dinRailLandingPage()` method —— 定義 `$localeMap` 陣列（`['en'=>'en','tw'=>'zh-TW','cn'=>'zh-CN','jp'=>'ja']`），透過 `App::getLocale()` 查表，不在 map 內的 locale 一律 fallback `en`，組建語系切換器用的 `$langUrls` 陣列後回傳 view

## 2. Blade View

- [x] 2.1 將 `delta-zh-TW.html` 複製到 `resources/views/front-end/landing-din-rail-infinity-ready.blade.php`
- [x] 2.2 在 `</head>` 前插入 `<script>window._serverLang = '{{ $htmlLang }}';</script>`
- [x] 2.3 修改 `DOMContentLoaded` init 區塊，讓語系初始化優先讀取 `window._serverLang`（在 localStorage 和瀏覽器偵測之前）
- [x] 2.4 在每個 `.lang-option` 元素加上 `data-lang-url` 屬性，值為 controller 傳入的 `$langUrls` 對應 URL
- [x] 2.5 在既有 `window.switchLang` 定義之後覆寫：若被點選的 option 有 `data-lang-url`，則用 `window.location.href` 跳頁，而非呼叫 `setLang`

## 3. 驗證

- [x] 3.1 造訪 `/en/landing/din-rail-infinity-ready`，確認 200、英文內容、`<html lang="en">`
- [x] 3.2 造訪 `/tw/landing/din-rail-infinity-ready`，確認 200、繁中內容、`<html lang="zh-TW">`
- [x] 3.3 造訪 `/cn/landing/din-rail-infinity-ready`，確認 200、簡中內容、`<html lang="zh-CN">`
- [x] 3.4 造訪 `/jp/landing/din-rail-infinity-ready`，確認 200、日文內容、`<html lang="ja">`
- [x] 3.5 在 `/en/` 頁點選語系切換器，確認瀏覽器導向 `/tw/landing/din-rail-infinity-ready`
- [x] 3.6 確認 Blade 轉換後 GSAP 滾動動畫與瓦數篩選器仍正常運作
