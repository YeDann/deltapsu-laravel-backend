## Context

Landing page（`landing-din-rail-infinity-ready.blade.php`）是一個 ~2750 行的 standalone HTML 檔，不繼承任何 Laravel layout。官網其他頁面使用 `layouts/front-end.blade.php`，其中包含 `@include('layouts.header-front')`。

官網 header（`header-front.blade.php`，2005 行）的依賴：
- CSS：`frontend-asset/css/all.css`（含 Bootstrap 4、自訂樣式）
- JS：jQuery 3.4.1、Bootstrap.js、popper.js
- JS functions：`openNav()`、`closeNav()`、`bigImg()`、`changeLangLocationmobile()` 等，定義在 `layouts/front-end.blade.php` 的 `<script>` 區塊
- Blade：`LaravelLocalization::getSupportedLocales()`、`App::getLocale()`（無額外 controller 變數）

Landing page 目前的依賴：
- CSS：UIKit 3.17.11（CDN）、自訂 CSS
- JS：UIKit JS、GSAP、自訂 JS（無 jQuery）

**衝突點：**
1. Bootstrap 4 Reset/Grid vs UIKit Reset 可能影響 landing page 的排版
2. Landing page 有自製語言切換器（`#langSwitcher`），官網 header 也有語言切換（`LaravelLocalization` 全頁跳轉）
3. 官網 header 的 JS functions 未定義在 header-front.blade.php 本身

## Goals / Non-Goals

**Goals:**
- Landing page 頂部顯示官網 header（logo、主選單、語言切換、搜尋）
- 語言切換改用官網 header 機制（全頁跳轉），行為與主站一致
- Landing page 原有版面（UIKit、GSAP、自訂區塊）不受破壞

**Non-Goals:**
- 不修改 `header-front.blade.php` 本身
- 不將 landing page 改為繼承 `layouts/front-end.blade.php`（工程量過大且會引入不需要的腳本）
- 不引入 landing page 不需要的 JS（nouislider、datatables、owl.carousel 等）

## Decisions

### 決策 1：直接 @include header-front，不繼承 layout

不改變 landing page 的 standalone 結構，在 `<body>` 開頭加 `@include('layouts.header-front')`，並在 `<head>` 補齊 header 所需的 CSS 與 JS。

**理由：**
- 繼承 layout 需要拆解 2750 行檔案，工程量不合比例
- 直接 include 只需補充依賴，風險可控

**替代方案考慮：**繼承 `layouts/front-end.blade.php` → 會載入大量不需要的 JS，且需重構整個檔案結構

### 決策 2：Bootstrap CSS 加 namespace 隔離

在 `<head>` 載入 `frontend-asset/css/all.css` 前，用 CSS `@layer` 或 wrapper class 降低 Bootstrap 的選擇器優先度，避免蓋掉 UIKit 的排版。

具體做法：在引入 Bootstrap CSS 後立即加一段 CSS reset，針對 landing page 的根容器（`<main>`、`.container-wide` 等）還原可能被 Bootstrap 影響的屬性（`box-sizing`、`*` reset 等）。

**理由：**
- Bootstrap 的 `*,::before,::after { box-sizing: border-box }` 與 UIKit 一致，不衝突
- Bootstrap normalize.css 可能影響 `ul`、`a`、`img` 的預設樣式 → 在 landing page CSS 區塊用高優先度選擇器覆蓋回去

### 決策 3：保留自製語言切換器，header 語言切換不動

保留 `#langSwitcher`、`switchLang()` 與翻譯物件，不修改 `header-front.blade.php` 中任何語言切換相關的邏輯或 HTML。`@include` 就是原封不動地把 header 引入，header 的語言切換行為完全不干預。

**理由：**
- header 是共用元件，不能為 landing page 特別改動
- 自製切換器與 landing page JS 翻譯機制深度整合，保留即可

**注意：** 確認 `#langSwitcher`（z-index: 99999）不被 header 的下拉選單遮蓋。

### 決策 4：header 所需的 JS functions 以 inline script 定義在 landing page

將 `front-end.blade.php` 中 header 需要的函式（`openNav`、`closeNav`、`changeLangLocationmobile`、`clickLangLocationmobile`、`setlocaltion`、`bigImg`、`mainCate`、`toggle_visibility`、`toggle_only`）複製到 landing page 的 `<script>` 區塊，並補充 jQuery、Bootstrap.js、popper.js 載入。

**理由：**
- header-front.blade.php 本身沒有定義這些函式
- 不能 @include front-end.blade.php（那是一個完整 layout）
- Inline 定義是最簡單且可控的方式

## Risks / Trade-offs

- **[風險] Bootstrap CSS 與 UIKit 衝突** → 上線前在測試站驗證所有 landing page 區塊的排版，針對有問題的選擇器加 `!important` 覆蓋
- **[風險] header 的 JS 函式依賴 jQuery**（`$(...)`）→ 確保 jQuery 在 header-front.blade.php 之前載入（landing page `<head>` 加 jQuery CDN）
- **[Trade-off] 語言切換從 no-reload 改為 full page reload** → 使用者體驗略有差異，但行為與主站一致，可接受
- **[風險] `data-url-template` 的 `switchLang()` 調用消失** → LEARN MORE 連結的多語 URL 邏輯需改用 PHP `{{ App::getLocale() }}` server-side render，不再依賴 client-side 更新

## Migration Plan

1. 在 landing page `<head>` 加入 Bootstrap CSS（`frontend-asset/css/all.css`）與 jQuery CDN
2. 在 `<body>` 開頭加 `@include('layouts.header-front')`
3. 加入 header 所需的 JS functions（inline script）
4. 移除 `#langSwitcher` HTML 與相關 JS
5. 將 LEARN MORE 連結的 `data-url-template` 邏輯改為純 PHP server-side render
6. 修復 CSS 衝突（如有）
7. FrontendController `dinRailLandingPage()` 補充 header 需要的 `$mail_chimp_country` 變數（若 header 有用到）

**Rollback：** 恢復 `#langSwitcher`，移除 `@include('layouts.header-front')` 與新增的依賴

## Open Questions

- **`mail_chimp_country` 變數：** header-front.blade.php 是否需要此變數？需確認 header 是否有 Mailchimp 相關區塊（目前主站 controller 會傳此變數）
- **`frontend-asset/css/all.css` 是否已包含 Bootstrap？** 或需單獨引入 bootstrap.min.css
