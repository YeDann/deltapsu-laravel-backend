## 為什麼

Phase II ③：在 DeltaPSU 網站新增「Find a Distributor」篩選頁（對應投影片 Slide5），讓使用者依地區、銷售區域、認證徽章、專屬應用、產品線、服務等條件，篩選出 Delta 授權的區域經銷商，並看到每家的 logo、地址、電話、網站、徽章與所代理的產品線。

現有的 `/contact/find-a-distributor` 頁面只有地區頁籤 + 簡單卡片，**沒有任何篩選、也沒有 logo／電話／網站／徽章／產品線**。本變更在既有的經銷商資料機制（`office` 表 type_id=2 + `continents` type_id=2）上擴充，補足篩選所需的資料結構、後台輸入介面與新版前端。

> 註：本功能的經銷商為 **Delta 策展的授權經銷商名錄**，與 Stock Checking（②）所用的 netCOMPONENT DILP API（依料號查庫存帶出的零件通路商）**無關**，兩者資料來源不同、不共用。

## 變更內容

> 分類定義以 Delta 提供的「2025 deltapsu Distributor filter.xlsx」為準（含 ~60 家經銷商實際資料），取代先前依 Slide5 的猜測。

- **資料結構**：擴充 `office` 主表（logo、website、telephone、email、google_maps、sales_territory 文字、certification 文字）；新增三張可管理分類表（specialized_application、product_line、distributor_service，各帶 `_translation` 多語）；新增三組經銷商↔分類關聯表（多對多）。Sales territory、certification 因 Excel 為自由文字，存文字欄不另開管理表。
- **匯入**：將 Excel 經銷商資料匯入為初始資料（region→continent，SEA→Thailand，略過範例列與 India）。
- **後台**：擴充既有 Contact Us → Distributors 編輯表單（logo 上傳、文字欄位、勾選 Specialized Application／Product Line／Service）；新增三張分類表的 CRUD，讓 Delta 維護選項與多語名稱。
- **前端**：將 `find-distributor.blade.php` 改為篩選頁 —— 地區頁籤 + 篩選列（Sales Territory／Certification 下拉、Specialized Application／Product Line／Service 勾選）+ 結果卡（logo 或名稱／地址／電話／email／Google Maps／website／應用服務標籤／產品線打勾），篩選於前端 JS 即時運作。logo 圖檔待客戶提供，結構與上傳介面先備、無圖時以名稱呈現。

## 功能範圍

### 新功能

- `distributor-filter`：Find a Distributor 篩選頁與其後台管理 —— 經銷商資料（含 logo/聯絡/徽章/產品線/服務/應用/銷售區域）的後台維護，與前端依地區與多條件篩選的呈現。

### 修改既有功能

- 既有 `/contact/find-a-distributor` 前端頁面改版（從簡單卡片改為含篩選的版型）。
- 既有後台 Distributors（`OfficeController`）編輯表單擴充欄位與分類指派。
- （`openspec/specs/` 下目前無經銷商相關 spec，故以新增 capability 處理。）

## 影響範圍

本變更涉及 **DB schema、Admin CRUD、Frontend 頁面**，分三階段實作（schema → 後台 → 前端）。

- `dependencies/database/migrations/`：office 加欄位、五張分類表 + 其 translation、關聯表（新增多個 migration）
- `dependencies/app/Http/Controllers/OfficeController.php`：經銷商編輯表單存取擴充（logo/phone/website + 分類指派）
- `dependencies/app/Http/Controllers/`：新增分類 CRUD controller（徽章/產品線/服務/專屬應用/銷售區域）
- `dependencies/app/Http/Controllers/FrontendController.php`：`contactFindDistributor` 查詢擴充（帶出各經銷商屬性）
- `dependencies/resources/views/office/`：後台經銷商表單擴充
- `dependencies/resources/views/`（新增分類管理 views）
- `dependencies/resources/views/front-end/find-distributor.blade.php`：改版為 Slide5 篩選頁
- `dependencies/routes/web.php`：新增分類 CRUD 後台路由
- 靜態文字（`static_keyword`）：篩選列標籤多語
