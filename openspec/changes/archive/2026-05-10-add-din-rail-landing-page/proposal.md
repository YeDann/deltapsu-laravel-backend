## 為什麼

`delta-zh-TW.html` 是 DIN Rail Infinity Ready 產品發表活動的獨立 landing page，需要整合進 Laravel 專案，讓它能透過現有的語系路由系統（`/{lang}/landing/din-rail-infinity-ready`）來提供服務，而不是一個孤立的靜態檔案。

## 變更內容

- 在 LaravelLocalization 路由群組內新增路由：`GET /landing/din-rail-infinity-ready`
- 新增 controller 方法 `FrontendController@dinRailLandingPage`，將當前語系傳給 view
- 新增 Blade view：`resources/views/front-end/landing-din-rail-infinity-ready.blade.php`，由 `delta-zh-TW.html` 轉換而來，為完整獨立的 HTML 文件
- 頁面語系初始化改為由伺服器驅動（Laravel locale → HTML lang 屬性），不再依賴 localStorage 或瀏覽器偵測
- 頁面內建的語系切換器改為導向對應的 `/{locale}/landing/din-rail-infinity-ready` URL，而非在頁面內直接切換

## 功能範圍

### 新功能

- `din-rail-landing-page`：透過 URL 語系段落決定顯示語言的 landing page，網址為 `/{lang}/landing/din-rail-infinity-ready`

### 修改既有功能

（無）

## 影響範圍

- `dependencies/routes/web.php`：在語系群組內新增一條路由
- `app/Http/Controllers/FrontendController.php`：新增一個 method
- `resources/views/front-end/landing-din-rail-infinity-ready.blade.php`：新建檔案（由 `delta-zh-TW.html` 轉換）
- 無資料庫異動、無既有路由異動、無既有 view 異動
