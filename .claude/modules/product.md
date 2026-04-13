# 商品模組 (Product Module)

## 概覽
核心商品管理，包含商品 CRUD、規格欄位定義、篩選器、分類、系列、選配型號、外部連結、EC Link、影片圖片、特色商品等。

---

## Controllers

### `ProductsController`
後台商品管理，功能最多的 controller。

#### 基本 CRUD
- `index()` — 商品列表（依 showstatus + created_at）
- `create()` — 新增表單（帶入分類、語系、section、product_field）
- `store()` — 儲存：products → products_translation → product_has_property → product_part_numbers → product_has_categories
- `edit($id)` — 編輯表單（含 partNumbers）
- `update($id)` — 更新（同 store 邏輯，part_numbers 先 delete 再 insert）
- `deleteProduct()` — 刪除商品
- `duplicateProduct($id)` — 複製商品

#### Latest Products（精選/最新商品）
- `lastetproducts()` — 最新商品列表
- `createlastproduct()` / `StoreLastProduct()` — 新增最新商品關聯
- `editLastest($id)` / `UpdateLastProduct()` — 編輯
- `deleteLastestPro()` — 刪除

#### Feature Products（特色商品）
- `featureProduct()` — 特色商品管理頁
- `setFeatureproducts()` — 設定特色商品

#### Product Selection（商品選擇器排序）
- `ProductSelection()` — 商品選擇器清單
- `unSetting($id)` — 取消設定
- `updateProSection($id)` — 更新排序
- `update_order_productselect()` — AJAX 拖曳排序
- `update_order_seriesLeast()` — Series 排序

#### External Links（外部連結）
- `listexternal_link()` — 列表
- `createExternallist()` / `storeExternallink()` — 新增
- `editExternallink($id)` / `updateExternalLink()` — 編輯
- `deleteExternallink()` — 刪除

#### EC Links（電商連結）
- `listEcLink()` — 列表
- `createEcLink()` / `storeEcLink()` — 新增
- `editEcLink($id)` / `updateEcLink()` — 編輯
- `deleteEcLink($id)` — 刪除

#### 輔助
- `searhSeries()` — AJAX，依 sub_cate_id 搜尋 series

---

### `ProductFieldController`
規格欄位定義（Output Voltage、Output Current 等）。
- 標準 CRUD
- `copyProductField()` / `copyProductFieldsingle()` — 複製到新語系
- Key type_ids: 3=Output Voltage, 4=Output Current, 8=Input Voltage, 31=Output Power

### `SectionController`
規格分組（Output Ratings、Input Ratings 等）。
- 標準 CRUD + `copySection()` / `copySectionsingle()` 語系複製

### `ProductFilterController`
子分類篩選器設定（前台 filter 面板）。
- `filter_setting($cate_id)` — 某子分類的篩選器
- `storeFilter()` / `deletefilter()` — 新增/刪除
- `update_order_filer()` — AJAX 拖曳排序
- `default_filer()` / `storeDefaultfiler()` / `deleteDefaultfilter()` — 預設篩選器
- `editFilterSelector()` / `updateFilterSection()` — 多語系篩選器名稱

### `ProductCategoriesController`
主分類 + 子分類 + **Series** 完整管理（都在這個 controller）。

#### 主分類
- `index()` / `create()` / `store()` / `edit()` / `update()` / `destroy()`
- `order_pro_categories()` / `update_order_cate()` — 排序
- `removefileMainCategoriesDoc()` — 刪除文件

#### 子分類
- `subCatories()` — 子分類列表
- `createSubCategories()` / `storeSubCategories()` — 新增
- `editSubCategories($id)` / `UpdateSubCategories()` — 編輯
- `destroysubcategories()` — 刪除
- `order_pro_categoriesBymain($id)` / `update_order_procate()` — 排序
- `removefileDocWaranfile($id)` / `removefileDocSelectionGuide($id, $lang)` — 刪除關聯文件

#### Series
- `series_index($cate_id)` / `series_all()` — 列表
- `createSeries($cate_id)` / `storeSeries()` — 新增
- `editSeries($id, $cateId)` / `updateSeries()` — 編輯
- `destroySeries()` — 刪除
- `orderSeries($id)` / `update_order_Series()` — 排序

### `OptionalModelController`
商品選配型號。
- `index($product_id)` — 列表
- `saveOptionalModel()` — 更新
- `deleteOptionalModel()` — 刪除

### `ProductVideoImageController`
商品媒體（圖片、影片、iframe）。
- `index($product_id)` / `SaveVideoPro()` / `SaveImagePro()` / `deleteVideImagePro()` / `getProImageContent()`

### `EolController` / `EolTypeController`
EOL 公告 + 分類。含多語系、copy 功能、檔案刪除。

### `ProductNoticeController` / `ProductNoticeTypeController`
商品公告 + 分類（結構同 EOL）。

---

## Key Tables
| Table | 用途 |
|-------|------|
| `products` | 商品主表 |
| `products_translation` | 多語系（content_1/2, short_features, meta_description）|
| `product_has_property` | 動態規格欄位 |
| `product_has_property_translation` | text 類規格翻譯 |
| `product_field` / `product_field_translation` | 規格欄位定義 |
| `section` / `section_translation` | 規格分組 |
| `product_part_numbers` | Part Number（no + text 雙欄） |
| `product_has_categories` | 商品 ↔ 子分類 M:N |
| `product_optional_model` | 選配型號 |
| `product_tags` | 商品 tag（搜尋用） |
| `series` / `series_translations` | 系列 |
| `series_has_pro_categories` | 系列 ↔ 子分類 |
| `sub_pro_has_product_filter` | 子分類篩選器 |
| `default_filter` | 預設篩選器 |
| `external_link` | 外部連結 |
| `custom_product_button` | EC Link |
| `documents` / `product_has_documents` | 文件下載 |
| `certificate_product` | 認證 |

---

## 重要邏輯

### status_product 值
- 1=None, 2=New, 3=NRND, 4=EOL
- 排序優先：2 → 1/null → 3 → 4

### 規格欄位 (product_has_property)
- `status_input=1` Single: data_1
- `status_input=2` Multiple: data_1~data_12
- `status_input=3` Range: data_1=min, data_2=max
- `type_value='text'`: 值在 translation.value_text，只能一個值 ← **不適合多欄位**

### Part Number
- 獨立 table `product_part_numbers`（不用 product_has_property）
- store/update 皆 delete → re-insert
