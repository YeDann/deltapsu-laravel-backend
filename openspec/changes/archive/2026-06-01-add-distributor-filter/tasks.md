## 階段一：DB Schema

- [x] 1.1 migration：`office` 主表新增 `logo`、`website`、`telephone`、`email`、`google_maps` —— `2026_05_29_000001_add_distributor_fields_to_office.php`（原 sales_territory/certification text 欄位已不使用，改為下方分類關聯）
- [x] 1.2 migration：三張分類表 + `_translation`（specialized_application / product_line / distributor_service）—— `..._000002_create_distributor_category_tables.php`（query-builder 風格，不另建 Eloquent model）
- [x] 1.3 migration：三組 pivot（office_has_specialized_application / office_has_product_line / office_has_service）—— `..._000003_create_distributor_pivot_tables.php`（office_id 用 signed int 對應 legacy office.id）
- [x] 1.4 migration：Sales Territory / Certification 升級為可管理 —— `..._000004_create_distributor_territory_cert_tables.php`（sales_territory、distributor_certification + 各 `_translation` + office_has_sales_territory / office_has_certification）
- [x] 1.5 migration：sales_territory 加 `continent_id` —— `..._000005_add_continent_to_sales_territory.php`（綁所屬地區）
- [x] 1.6 seeder：五類分類初始值（依 Slide5）—— `DistributorCategorySeeder`：Specialized Application 5（Industrial/Medical/LED Lighting/LED Signage/Railway）、Product Line 9（含 LED Signage Power Supply）、Service 3（Stocking/After Sales/Technical Configuration）；各語系一律填英文 baseline，後台再在地化；既有 slug 保留、不在清單者停用（status=0）
- [x] 1.7 ~~匯入 Excel 經銷商資料~~ —— 已移除（`DistributorImportSeeder` 與 `distributors.csv` 刪除）；經銷商資料、洲別名稱皆由後台維護，不灌假資料

## 階段二：後台（Admin）

- [x] 2.1 分類 CRUD：泛型 `DistributorCategoryController` 管 **5 類** + `distributor-category/*` views（index/create/edit）+ 路由（名稱、order、show/hide）。Sales Territory 含 Region（continent_id）選擇；分類管理獨立成「Distributor Filter」後台選單群組（置於 Distributors 之前），順序 Sales Territory→Certifications→Specialized Applications→Product Lines→Services
- [x] 2.2 `OfficeController` create/edit 擴充：帶 5 類 `$categories`（edit 帶已勾選 `$selected`）、logo 與聯絡欄位
- [x] 2.3 `OfficeController` store/update 擴充：`saveDistributorPivots()` 先刪後插寫入 5 組 pivot；logo 上傳沿用 medias/distributor
- [x] 2.4 `office/` create.blade / edit.blade 擴充：logo 上傳（edit 顯示舊圖）、聯絡欄、5 組勾選框（順序同選單）；皆置於 `@if($type_id == 2)` 內
- [x] 2.5 type_id=1（Sales Offices）不顯示經銷商欄位、行為不受影響

## 階段三：前端（篩選頁）

- [x] 3.1 `FrontendController@contactFindDistributor` 擴充：帶出各經銷商屬性 + 五類選項；Sales Territory 依 continent_id 分區（`territoryByContinent`）傳前端
- [x] 3.2 `find-distributor.blade.php` 改版：地區頁籤（沿用 News 的 `.box-news .nav-tabs` 樣式）+ 篩選列（Sales Territory／Certifications 下拉、三類勾選，All 僅 Product Lines）
- [x] 3.3 前端 JS 即時篩選：類間 AND、類內 OR；Sales Territory／Certifications 下拉於切換地區頁籤時重建（territory 依 continent_id）
- [x] 3.4 結果卡三欄：左=logo 或名稱 + 地址/聯絡（單一 content，不重複）、中=Certifications 藍標、右=Product Line 打勾
- [x] 3.5 下拉固定寬度避免箭頭位移；卡片名稱粗體黑字置於 logo 下
- [x] 3.6 分類名稱與篩選列 UI 標籤皆英文 baseline（`DistributorCategorySeeder` / `DistributorLabelSeeder`），後台可在地化

## 驗證

- [x] 4.1 前端三視覺（頁籤 / 篩選列 / 三欄卡片 / 排序 / 下拉對齊）經客戶截圖確認
- [x] 4.2 套用篩選結果正確（類間 AND、類內 OR；Sales Territory 依地區連動，選 Americas 不出現 China）
- [x] 4.3 結果卡：有/無 logo 皆正確；Certifications 藍標、Product Line 打勾正確
- [x] 4.4 分類與 UI 標籤英文 baseline 各語系一致顯示
- [ ] 4.5 後台實機點選最終確認：分類 CRUD 存取、經銷商指派 5 類 + logo 上傳、Sales Offices（type_id=1）不受影響（邏輯與 lint 已通過，建議登入後台各點一次）
