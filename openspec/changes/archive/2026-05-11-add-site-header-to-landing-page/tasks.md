## 1. 確認依賴與前置調查

- [x] 1.1 確認 `frontend-asset/css/all.css` 是否包含 Bootstrap 4（還是需單獨引入 bootstrap.css）
- [x] 1.2 確認 `header-front.blade.php` 中是否使用 `$mail_chimp_country` 或其他需要 controller 傳入的變數
- [x] 1.3 列出 header 所需的 JS functions（從 `layouts/front-end.blade.php` 找出 header-front 依賴的函式）

## 2. Landing page `<head>` 補充依賴

- [x] 2.1 在 landing page `<head>` 加入 jQuery CDN（在 UIKit 之前）
- [x] 2.2 在 `<head>` 加入 `frontend-asset/css/all.css`（Bootstrap CSS）
- [x] 2.3 在 `</body>` 前加入 Bootstrap.js 與 popper.js（`frontend-asset/js/`）

## 3. 引入官網 header

- [x] 3.1 在 landing page `<body>` 開頭加 `@include('layouts.header-front')`
- [x] 3.2 在 header include 之前加入 inline script，定義 header 所需的 JS functions（`openNav`、`closeNav`、`bigImg`、`mainCate`、`changeLangLocationmobile`、`clickLangLocationmobile`、`toggle_visibility`、`toggle_only`、`setlocaltion`）
- [x] 3.3 如 controller 需要補充變數（如 `$mail_chimp_country`），在 `FrontendController::dinRailLandingPage()` 補充查詢與傳入

## 4. CSS 衝突修正

- [ ] 4.1 在測試站驗證 landing page 所有區塊排版（bento grid、feature cards、countdown、comparison table、contact form）
- [ ] 4.2 針對 Bootstrap normalize 破壞的樣式加 CSS 修正（如 `ul` margin、`a` 顏色、`img` max-width 等）
- [ ] 4.3 確認 header 在 landing page 上的樣式正常（logo、nav link、語言選擇器）
- [ ] 4.4 確認自製語言切換器（`#langSwitcher`）與 header 語言選擇器的 z-index 不衝突

## 5. 功能驗證

- [ ] 5.1 行動版漢堡選單可正常開關
- [ ] 5.2 桌面版主選單 hover 下拉正常
- [ ] 5.3 header 語言切換器可正常跳轉至對應語系 landing page
- [ ] 5.4 自製語言切換器（`#langSwitcher`）仍可正常切換語言與翻譯文字
- [ ] 5.5 landing page 的 CTA 按鈕、表單、倒數計時器正常運作
