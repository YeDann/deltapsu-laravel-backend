# 商品列表頁與商品內頁 — 詳細說明

## 商品列表頁 (`productList`)

### 路由
```
GET /{lang}/product/{main_cate_id}/{cate_name}/{cate_id}
GET /{lang}/product/{main_cate_id}/{cate_name}/{cate_id}/{se_name}/{se_id}
```
→ `FrontendController@productList`
View: `resources/views/front-end/product.blade.php`

---

### Controller 資料查詢流程

#### Step 1 — 驗證與取得子分類清單
```php
// 依 main_cate_id 取得所有子分類（用於後續多個查詢）
$categoriesHasMainPro = categories_has_main_pro JOIN sub_pro_categories_translation
    WHERE main_cateid = $mainCateId AND local = $lang
$subCategoriesIds = $categoriesHasMainPro->pluck('cate_id')

// URL 正確性驗證：若 cate_name 與 DB 的 url_item 不符 → 301 redirect
```

#### Step 2 — Certificate Mapping
主分類 ID 對應認證類型（用於篩選商品）：
```php
1 (Medical)     → certificate_id = [2]
2 (Industrial)  → certificate_id = [1]
3 (LED Driver)  → certificate_id = [3]
4 (Ind. Battery)→ certificate_id = [4]
5 (Configurable)→ certificate_id = [1,2,3,4]
```

#### Step 3 — 商品查詢（核心）
```sql
product_has_categories phc
JOIN categories_has_main_pro chmp ON cate_id = phc.categories_id AND main_cateid = $mainCateId
JOIN products p
JOIN products_translation pt
JOIN series s
WHERE p.enable_pro = 1
  AND (certificate 條件 via whereExists)
  AND (main_cate != 3 → whereIn phc.categories_id IN $subCategoryIds)
  AND (main_cate = 3 → s.mode_series IS NOT NULL)  ← LED 特殊邏輯
ORDER BY p.pro_code ASC
```
結果 `groupBy('pro_id')` — 同一商品若跨多分類只保留一筆

#### Step 4 — 過濾：必須有 4 個規格欄位
```php
// 預先批次查詢 type_id IN [3,4,8,31]（Output Voltage/Current/Input Voltage/Power）
$productHasPrmGroupByPrdId = product_has_property WHERE type_id IN [3,4,8,31]

// 只有 count >= 4 的商品才進入最終陣列
if ($productHasPrm->count() >= 4) → 加入 $productsArr
```
> **重要**：規格不完整的商品不會顯示在列表頁

#### Step 5 — Optional Model 合併
```php
// 取得所有選配型號，合併進 $productsArr（繼承主商品的 cate_ids 與 mode_series）
// 用 $productCodeArr 去重，避免 optional model 與主商品 pro_code 重複
```

#### Step 6 — 其他資料查詢（批次）
| 變數 | 用途 | Blade |
|------|------|-------|
| `$productHasProperty` | type_id [3,4,8,31] 規格值 | filter 面板數值範圍 |
| `$filterPro` | sub_pro_has_product_filter（篩選器定義）| filter 面板 |
| `$pdField` | product_field（所有欄位定義）| filter 面板欄位名稱 |
| `$defaultfilters` | default_filter | 預設篩選條件 |
| `$certi_products` | certificate_product | 認證篩選 |
| `$section` | section + section_translation | 規格分組 |
| `$documents_cate` | products_documents_categories | 文件分類（排除 id 4,6,7）|
| `$series` | series_has_pro_categories JOIN series | series 篩選下拉 |
| `$modeSeries` | mode_series | LED mode 篩選 |
| `$subCategories` | sub_pro_categories | 子分類描述 |
| `$mainCategory` | main_pro_categories | 主分類資訊（breadcrumb/SEO）|
| `$metatag` | meta_tag_page id=3 | SEO |

#### Step 7 — 去重並回傳
```php
$proNew = self::removeDuplicates($productsArr, 'pro_code')
// removeDuplicates：保留第一筆出現的 pro_code，移除後續重複
```

---

### Blade JS 架構（`product.blade.php`，~5000+ 行）

#### 資料注入
```javascript
// PHP → JSON
var products = @json($products);              // 商品陣列
var product_has_property = @json($product_has_property);  // 規格值
var filter_pro = @json($filter_pro);          // 篩選器定義
var pd_field = @json($pd_field);              // 欄位定義
```

#### 篩選流程
1. 使用者勾選 filter → `onFilterChange()`
2. 遍歷 `activeFilters` 物件，依序縮減 `currentProducts`
3. 數值型規格：比對 `product_has_property` 的 data_1/data_2 範圍
4. 類型篩選（Product Type）：比對 `cate_ids` 陣列（商品可屬多分類）
5. LED Mode 篩選：比對 `mode_series`
6. 篩選完成 → 觸發排序 → `displayProducts()`

#### 排序流程（所有入口必須同步更新）
| 函數 | 觸發時機 |
|------|---------|
| `sortByStatus(array)` | 核心排序邏輯（被其他函數呼叫）|
| `onFilterSetSor(type)` | filter 面板內的排序改變 |
| `onselectSort(type)` | 桌面版下拉選單 |
| `onselectSortArr(type)` | 行動版排序 |
| `onselectSortDestop(type)` | 桌面版另一入口 |
| 匿名函數 ~line 4390 | 頁面初始排序 |

**type_se 值：**
- `1` → `sortByStatus()`（2=New → 1/null=None → 3=NRND → 4=EOL，同 status 按 pro_code 字母）
- `5` → Modified Date newest to oldest

#### localStorage back-button 邏輯
- 使用者點擊商品 → 儲存目前 filter 狀態到 localStorage
- 返回時讀取 localStorage 還原篩選狀態
- **只在從商品詳細頁返回時有效**（需檢查 referrer 或 sessionStorage flag）
- 直接重新整理不應套用 localStorage

---

## 商品內頁 (`productsDetailsByType`)

### 路由
```
GET /{lang}/products/{cateid}/{pro_code}
```
→ `FrontendController@productsDetailsByType`
View: `resources/views/front-end/productdetails.blade.php`

---

### Controller 資料查詢流程

#### Step 1 — 找到對應 sub_category
```php
// 模糊比對 $catename 與所有 sub_pro_categories.url_item
// 取 similarity 最高者為 $findoldCate
// 若 findoldCate.url_item != $catename → 301 redirect 到正確 URL
```

#### Step 2 — 驗證商品代碼
```php
$check   = checkHaveModel($proCode)         // 直接比對 pro_code
$check_2 = checkHaveModelOptional($proCode) // 比對 optional_model
// optional model → redirect 到主商品 URL（帶 ?optional_model=xxx）
```

#### Step 3 — 主商品查詢
```sql
products p
JOIN products_translation pt    (local = $prolang，fallback to en)
JOIN series_translations st     (取 series title)
JOIN product_has_categories phc
JOIN sub_pro_categories sp
JOIN sub_pro_categories_translation spt
WHERE p.pro_id = $check->pro_id
SELECT p.*, pt.*, serieName, catename, url_item, pro_categories_id, unit_dimension
```

#### Step 4 — 各類附加資料查詢

| 變數 | 來源 | 說明 |
|------|------|------|
| `$product_has_property` | product_has_property JOIN 4 tables | 完整規格（排除 type_id=115）|
| `$arraysub` | 同上，只取 type_id [3,4,8,31] | 商品卡片規格摘要 |
| `$partNumbers` | product_part_numbers ORDER BY order | Part Number 列表 |
| `$documents` | product_has_documents JOIN 多表 | 文件下載（排除分類 id=4）|
| `$vieo_img` | product_image | 商品圖片/影片 |
| `$external_link` | external_link WHERE products = $pro_id | 外部連結 |
| `$ec_link` | custom_product_button（LIKE 比對 products 欄位）| 電商按鈕 |
| `$tags_pro` | product_tags WHERE tag != ' ' | 商品 tag |
| `$optional_pro` | product_optional_model | 選配型號 |
| `$series_has_application` | series_has_application JOIN application | 應用情境 |
| `$section` | section + section_translation | 規格分組（含 sortname）|

#### Step 5 — Related Products 邏輯
```php
// 優先：product_related 表（手動設定的相關商品）
$product_related = product_related WHERE product_id = $pro->pro_id

// Fallback（若 product_related 為空）：
// 同子分類、enable_pro=1、2年內新增、隨機取 4 筆
WHERE phc.categories_id = $pro->pro_categories_id
  AND p.created_at > (now - 2年)
ORDER BY RAND()
LIMIT 4
```

#### Step 6 — 組裝 $data[0]
```php
$data[0] = [
    'pro_id', 'pro_code', 'picture', 'created_at', 'updated_at',
    'unit_weight', 'unit_dimension', 'unit_dimension_1',
    'content_1',        // Highlights & Features
    'content_2',        // Detailed Description
    'meta_description',
    'serie_id', 'serie_name', 'cate_name', 'url_item', 'cate_id',
    'alt_img',
    'content'  => $arraysub,     // type_id [3,4,8,31] 規格摘要
    'dimensionL', 'dimensionW', 'dimensionD',
    'part_numbers' => $partNumbers,
]
```

#### 傳入 Blade 的所有變數
| 變數 | 說明 |
|------|------|
| `$product` | `$data`（$data[0] 為主商品資料）|
| `$product_has_property` | 完整規格（依 section 分組顯示）|
| `$documents` | 文件下載清單 |
| `$vieo_img` | 圖片/影片 |
| `$external_link` | 外部連結 |
| `$ec_link` | 電商按鈕 |
| `$tags_pro` | tags |
| `$optional_pro` | 選配型號 |
| `$optional_model` | GET 參數傳入的 optional model |
| `$series_has_application` | 應用情境 |
| `$section` | 規格分組（含 sortname 用於排序顯示）|
| `$Otherpros` | Related products |
| `$current_main_cate_id` | 主分類 ID（breadcrumb 用）|

---

### Blade 頁面結構（`productdetails.blade.php`）

```
1. Breadcrumb + 商品 header（圖片、pro_code、series name）
2. 規格 table（product_has_property，依 section.sortname 分組）
   └─ type_id=115 排除（是 external link，另外顯示）
3. Part Number table（$product[0]['part_numbers']）
   └─ 標題「Part Number」藍色（text-color-delta）
   └─ 無 thead，兩欄：no (40%) | text
4. Highlights & Features（$product[0]['content_1']，富文本）
5. Detailed Description（$product[0]['content_2']，富文本）
6. Documents（依 catename 分組，含下載按鈕）
7. Certificates / Applications
8. Related Products（$Otherpros，最多 4 筆）
```

> **注意**：Desktop 和 Mobile 區塊結構相同但縮排不同，Edit tool 操作前必須先 Read 確認。

---

## 商品比較頁（`productCoparison`）
路由：`/tools/comparison`

- 從 `session('product_comp')` 讀取要比較的 pro_id 清單
- 查詢這些商品的完整資訊 + 同分類其他商品（供加入比較）
- 傳入所有 `pd_field`（規格欄位）和 `section`（分組）
- View: `front-end/productcoparison.blade.php`
