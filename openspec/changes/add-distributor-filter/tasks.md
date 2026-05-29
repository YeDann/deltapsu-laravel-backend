## 階段一：DB Schema + 匯入

- [x] 1.1 migration：`office` 主表新增 `logo`(nullable)、`website`、`telephone`、`email`、`google_maps`、`sales_territory`(text)、`certification`(text) —— `2026_05_29_000001_add_distributor_fields_to_office.php`
- [x] 1.2 migration：`specialized_application` + `specialized_application_translation`（fk_id, name, local）—— 併於 `..._000002_create_distributor_category_tables.php`（codebase 為 query-builder 風格，不另建 Eloquent model）
- [x] 1.3 migration：`product_line` + `product_line_translation` —— 同上
- [x] 1.4 migration：`distributor_service` + `distributor_service_translation` —— 同上
- [x] 1.5 migration：pivot `office_has_specialized_application`、`office_has_product_line`、`office_has_service` —— `..._000003_create_distributor_pivot_tables.php`（office_id 用 signed int 對應 legacy office.id）
- [x] 1.6 seeder：三張分類表初始值（3+8+3 項）+ 各語系 —— `database/seeds/DistributorCategorySeeder.php`（已執行）
- [x] 1.7 匯入 Excel 經銷商資料 —— Excel 轉 `database/data/distributors.csv`（56 家），`database/seeds/DistributorImportSeeder.php` 以「同名+同洲別」upsert（region→continent，SEA→Thailand，略過 Sample/India）；已執行，56 家補上欄位與三類 pivot（既有 46 家更新、先前新建 10 家）

## 階段二：後台（Admin）

- [ ] 2.1 分類 CRUD：specialized_application / product_line / distributor_service 的後台 controller + views + 路由（含多語名稱），沿用本專案內容模組 CRUD 模式
- [ ] 2.2 `OfficeController` create/edit 擴充：讀寫 logo(上傳)、website、telephone、email、google_maps、sales_territory、certification
- [ ] 2.3 `OfficeController` store/update 擴充：以「先刪後插」寫入三組 pivot（specialized application／product line／service）
- [ ] 2.4 `office/` 後台表單 views 擴充：logo 上傳欄、文字欄位、三組勾選框；依 type_id=2 才顯示
- [ ] 2.5 確認 Sales Offices（type_id=1）表單與行為不受影響

## 階段三：前端（篩選頁）

- [ ] 3.1 `FrontendController@contactFindDistributor` 擴充查詢：帶出各經銷商文字欄 + 三類屬性 id 陣列，連同分類選項清單與各 territory/certification 去重清單，傳給 view
- [ ] 3.2 `find-distributor.blade.php` 改版：地區頁籤（continents type_id=2）+ 篩選列（Sales Territory／Certification 下拉、Specialized Application／Product Line／Service 勾選，含 All 全選捷徑）
- [ ] 3.3 前端 JS 即時篩選：依地區與條件過濾（類間 AND、類內 OR，依 Delta 確認調整）
- [ ] 3.4 結果卡渲染：有 logo 顯示圖、無 logo 顯示名稱；地址、電話、email、Google Maps 連結、website、應用/服務標籤、產品線打勾
- [ ] 3.5 Certification 篩選：若資料全空則先隱藏該下拉
- [ ] 3.6 篩選列 UI 標籤多語（`static_keyword` 新增所需字串，六語系）

## 驗證

- [ ] 4.1 後台可新增/編輯分類選項與多語名稱，前台對應顯示正確語系
- [ ] 4.2 後台可為某經銷商設定文字欄、上傳 logo、勾選三類屬性並儲存
- [ ] 4.3 Excel 匯入後，各地區頁籤顯示正確家數與資料
- [ ] 4.4 套用各篩選條件後結果正確（含類間 AND、類內 OR）
- [ ] 4.5 結果卡：有/無 logo 皆正確呈現；聯絡資訊與產品線打勾正確
- [ ] 4.6 切換語系，篩選列標籤與分類名稱、經銷商名稱/地址正確顯示
- [ ] 4.7 確認 Sales Offices（type_id=1）頁面與後台未受影響
