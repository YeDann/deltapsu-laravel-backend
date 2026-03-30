---
name: Data Flow
description: How data flows from DB → Controller → Blade for product listing and product detail pages
type: project
---

## Product Listing Page (`product.blade.php`)

### Route
`/{lang}/product/{main_cate}/{cate_name}/{cate_id}` → `productList`
`/{lang}/product/{main_cate}/{cate_name}/{cate_id}/{se_name}/{se_id}` → `productList` (with series filter)

### Controller: `productList()` in FrontendController
1. Queries `products` joined with `products_translation`, `series_translations`, `product_has_categories`, `sub_pro_categories`, `categories_has_main_pro`
2. Filters by `enable_pro = 1`, `local = $lang`, target `sub_pro_id`
3. **NO ORDER BY for status** — JS handles sorting client-side
4. Returns `$products` array to `front-end/product.blade.php`

### Blade → JS Pipeline
- Products injected as PHP → JSON via `json_encode()` into JS variable
- All filtering/sorting done client-side with jQuery
- Products rendered by `displayProducts()` function

### JS Sort Flow
```
User selects sort option
  → onselectSort() / onselectSortDestop()
  → type_se == 1: sortByStatus(array) → sort by status_product priority
  → type_se == 5: sort by modified_at desc
  → displayProducts(sorted_array)
```

### Sort Priority (sortByStatus)
- status=2 (New) → priority 1
- status=1 / null / other → priority 2
- status=3 (NRND) → priority 3
- status=4 (EOL) → priority 4
- Tie-break: pro_code alphabetically

---

## Product Detail Page (`productdetails.blade.php`)

### Route
`/{lang}/product/{cate_name}/{pro_code}` → `productsDetailsByType`

### Controller: `productsDetailsByType()` in FrontendController
1. Finds sub_category by fuzzy-matching `$catename` to `url_item`
2. Validates `$procode` via `checkHaveModel()` / `checkHaveModelOptional()`
3. Main product query: joins `products`, `products_translation`, `series_translations`, `product_has_categories`, `sub_pro_categories`
4. Queries for each data type and builds `$data[0]` array:
   - `part_numbers` ← `product_part_numbers` ordered by `order`
   - `properties` ← `product_has_property` + `product_has_property_translation`
   - `documents` ← `documents` + `product_has_documents`
   - `certificates` ← `certificate_product`
   - `external_link` ← `external_link`
   - `ec_link` ← `custom_product_button`
   - `related` ← `product_related`
   - `optional_models` ← `product_optional_model`
5. Returns `$product = $data` to `front-end/productdetails.blade.php`

### Blade Layout Order (productdetails.blade.php)
1. Breadcrumb + product header (image, name, series)
2. Spec table (product_has_property grouped by section)
3. **Part Number table** ← new, above Highlights
4. Highlights & Features (`content_1`)
5. Detailed description (`content_2`)
6. Documents / Certificates
7. Related products

---

## Search Page (`resultsearch.blade.php`)

### Route
`/{lang}/searchAll/{keyword}` → `searchAll()`

### Controller: `searchAll()` in FrontendController
- Fuzzy search across `pro_code`, `series title`, `product_tags`, `optional_model`
- Uses `REPLACE(REPLACE(...))` to normalize dashes/spaces
- **ORDER BY in controller** (no JS re-sort on this page):
  1. pro_code exact match first
  2. status_product CASE: 2→1, 1/null/other→2, 3→3, 4→4
  3. pro_code alphabetically
- Limit: 100 products

---

## Admin Product Flow

### Create: `ProductsController@store()`
1. Insert into `products`
2. Loop over languages → insert `products_translation`
3. Insert `product_has_property` rows
4. Insert `product_part_numbers` rows (no/text/order)
5. Sync `product_has_categories`

### Edit: `ProductsController@update()`
1. Update `products`
2. Update/insert `products_translation`
3. Delete + re-insert `product_has_property`
4. Delete + re-insert `product_part_numbers`
5. Sync `product_has_categories`
