## 階段一：DB Schema + 匯入

- [x] 1.1 migration：`office` 主表新增 `logo`(nullable)、`website`、`telephone`、`email`、`google_maps`、`sales_territory`(text)、`certification`(text) —— `2026_05_29_000001_add_distributor_fields_to_office.php`
- [x] 1.2 migration：`specialized_application` + `specialized_application_translation`（fk_id, name, local）—— 併於 `..._000002_create_distributor_category_tables.php`（codebase 為 query-builder 風格，不另建 Eloquent model）
- [x] 1.3 migration：`product_line` + `product_line_translation` —— 同上
- [x] 1.4 migration：`distributor_service` + `distributor_service_translation` —— 同上
- [x] 1.5 migration：pivot `office_has_specialized_application`、`office_has_product_line`、`office_has_service` —— `..._000003_create_distributor_pivot_tables.php`（office_id 用 signed int 對應 legacy office.id）
- [x] 1.6 seeder：三張分類表初始值（3+8+3 項）+ 各語系 —— `database/seeds/DistributorCategorySeeder.php`（已執行）
- [x] 1.7 匯入 Excel 經銷商資料 —— Excel 轉 `database/data/distributors.csv`（56 家），`database/seeds/DistributorImportSeeder.php` 以「同名+同洲別」upsert（region→continent，SEA→Thailand，略過 Sample/India）；已執行，56 家補上欄位與三類 pivot（既有 46 家更新、先前新建 10 家）

## 階段二：後台（Admin）

- [x] 2.1 分類 CRUD：泛型 `DistributorCategoryController` 管 **5 類**（specialized_application / product_line / distributor_service / sales_territory / distributor_certification）+ `distributor-category/*` views（index/create/edit）+ 路由（含多語名稱編輯、order、status）。Sales Territory 另綁所屬地區（continent_id，create/edit 有 Region 下拉、前台依此分區）；Certification 亦升級為可管理。後台選單獨立成「Distributor Filter」群組（置於 Distributors 前），順序 Sales Territory→Certifications→Specialized Applications→Product Lines→Services。Sales Territory / Certification 在經銷商表單改為「清單勾選」、匯入時自由文字 find-or-create 成選項 + 關聯
- [x] 2.2 `OfficeController` create/edit 擴充：讀寫 logo(上傳)、website、telephone、email、google_maps、sales_territory、certification —— create() / edit() 帶 `$categories`（+ edit 帶 `$selected`）
- [x] 2.3 `OfficeController` store/update 擴充：`saveDistributorPivots()` 以「先刪後插」寫入三組 pivot；logo 上傳沿用 medias/distributor
- [x] 2.4 `office/` create.blade / edit.blade 擴充：logo 上傳（edit 顯示舊圖）、六個文字欄、三組勾選框；皆置於 `@if($type_id == 2)` 內
- [x] 2.5 type_id=1 不顯示經銷商欄位（包在 type_id==2 區塊）；pivot helper 對 type_id=1 無輸入時不寫入（建議瀏覽器最終確認）

## 階段三：前端（篩選頁）

- [x] 3.1 `FrontendController@contactFindDistributor` 擴充查詢：帶出各經銷商文字欄 + 三類屬性 slug 陣列 + 分類選項清單（status=1，依圖 5/9/3），territory/cert 去重在前端 JS 產生
- [x] 3.2 `find-distributor.blade.php` 改版：地區頁籤（continents type_id=2）+ 篩選列（Sales Territory／Certifications 內聯下拉、三類勾選，All 僅 Product Lines）；樣式比照 Slide5（置中頁籤、白底、粗體區塊標題、內聯下拉）
- [x] 3.3 前端 JS 即時篩選：依地區與條件過濾（類間 AND、類內 OR）
- [x] 3.4 結果卡渲染：有 logo 顯示圖、無 logo 顯示名稱；地址、電話、email、Google Maps、website、應用/服務藍標、產品線打勾
- [x] 3.5 Certification 篩選：客戶要求「欄位都先做、篩不到就篩不到」→ 一律顯示（不因空隱藏）
- [x] 3.6 篩選列 UI 標籤多語 —— `database/seeds/DistributorLabelSeeder.php`（7 個 key × 六語系，已執行）；分類名稱多語走分類 `_translation`

## 階段一補充（依客戶「依圖標籤」）

- [x] 1.6 重跑：分類改為依 Slide5 —— Specialized Application 5 項（Industrial/Medical/LED Lighting/LED Signage/Railway）、Product Line 9 項（含 LED Signage Power Supply）、Service 3 項（Stocking/After Sales/Technical Configuration）；Excel 才有的 Online shop 停用（status=0，資料保留）。保留既有 slug 不斷鏈已匯入資料。

## 驗證

- [ ] 4.1 後台可新增/編輯分類選項與多語名稱，前台對應顯示正確語系
- [ ] 4.2 後台可為某經銷商設定文字欄、上傳 logo、勾選三類屬性並儲存
- [ ] 4.3 Excel 匯入後，各地區頁籤顯示正確家數與資料
- [ ] 4.4 套用各篩選條件後結果正確（含類間 AND、類內 OR）
- [ ] 4.5 結果卡：有/無 logo 皆正確呈現；聯絡資訊與產品線打勾正確
- [ ] 4.6 切換語系，篩選列標籤與分類名稱、經銷商名稱/地址正確顯示
- [ ] 4.7 確認 Sales Offices（type_id=1）頁面與後台未受影響
