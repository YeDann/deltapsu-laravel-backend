# DeltaPSU Laravel Backend — Claude Guide

## Project
Multilingual product catalog site for Delta Electronics power supplies (psu.deltaww.com).
Working directory: `dependencies/`

## Stack
- Laravel 6, MySQL, Blade, jQuery, Bootstrap 4
- Languages: en, tw, cn, de, jp, tr (via LaravelLocalization)

## Key Files
| File | Purpose |
|------|---------|
| `app/Http/Controllers/FrontendController.php` | All frontend pages |
| `app/Http/Controllers/ProductsController.php` | Admin product CRUD |
| `resources/views/front-end/product.blade.php` | Product listing + JS filter/sort |
| `resources/views/front-end/productdetails.blade.php` | Product detail |
| `resources/views/front-end/resultsearch.blade.php` | Search results (searchAll) |
| `resources/views/product/create.blade.php` | Admin product create |
| `resources/views/product/edit.blade.php` | Admin product edit |
| `resources/views/components/hreflang.blade.php` | Shared hreflang SEO component |
| `app/Http/Middleware/CsvRedirectMiddleware.php` | Bulk 301/410 redirects |
| `storage/app/redirect_map.php` | Pre-processed redirect map (auto-generated) |
| `storage/app/psu.deltaww.csv` | Source CSV for bulk redirects |

## Critical Patterns

### Product Sorting
Sorting on the product listing page is done entirely in **front-end JavaScript** (`product.blade.php`).
Do NOT add ORDER BY to controller queries for product.blade — it will be overridden.
Functions to update: `sortByStatus()`, `onFilterSetSor()`, `onselectSort()`, `onselectSortArr()`, `onselectSortDestop()`

Sort priority (status_product): 2=New → 1/null=None → 3=NRND → 4=EOL

For `searchAll` page: sorting IS done in controller (no JS re-sort there).

### Product Spec Fields (Dynamic)
- Table: `product_has_property` + `product_has_property_translation`
- `status_input`: 1=Single, 2=Multiple (data_1..data_12), 3=Range (data_1=min, data_2=max)
- `type_value='text'`: value stored in `value_text` of translation table — only ONE value per row
- type_id: 3=Output Voltage, 4=Output Current, 8=Input Voltage, 31=Output Power

### Part Number (New Feature)
- Table: `product_part_numbers` (id, product_id, no, text, order)
- Admin UI: after Unit Weight in create.blade.php and edit.blade.php
- Frontend: displayed ABOVE Highlights & Features in productdetails.blade.php, table without header row
- store/update pattern: delete all for product_id, then re-insert

### Redirect System
- CSV source: `storage/app/psu.deltaww.csv`
- Pre-process: `php artisan redirects:generate` → generates `storage/app/redirect_map.php`
- Test: `php artisan test:csv-redirects [--url=URL]`
- Supports 301 redirects and 410 Gone responses
- Middleware runs globally (before routing) via `app/Http/Kernel.php`

### URL Routing
- Old product URL: `/{lang}/product/{main_cate}/{cate_id}` → redirected
- Old product detail URL: `/{lang}/product/{main_cate}/{cate_id}/{se_name}/{se_id}` → redirected
- New product list URL: `/{lang}/product/{main_cate_id}/{main_cate}/{cate_id}`
- New product detail URL: `/{lang}/product/{cate_name}/{pro_code}`
- Route constraints use negative lookahead to avoid conflicts with `index`, `all-product-categories`

### Database Translation Pattern
Every content table has `{table}_translation` with `local` column.
Always join on `local = $lang` where `$lang = App::getLocale()`.
Supported locales: en, tw, cn, de, jp, tr

### Multi-main-category Gotcha
`categories_has_main_pro`: one sub-category can belong to multiple main categories.
When joining, use `CASE WHEN main_cateid = 2 THEN 0` to prefer Industrial (id=2) as default.

## productdetails.blade.php Section Order
1. Breadcrumb + product header
2. Spec table (product_has_property by section)
3. **Part Number table** (own row, "Part Number" title in blue `text-color-delta`)
4. Highlights & Features (content_1)
5. Detailed description (content_2)
6. Documents / Certificates
7. Related products

## Admin Product Form Input Naming
- Static fields: `pro_code`, `series_id`, `enable_pro`, etc.
- Multilingual: `content_1[en]`, `content_1[tw]`, etc.
- Spec properties: `property[type_id][index]`, `property[data_1][index]`, etc.
- Part numbers: `partNumber[no][0]`, `partNumber[text][0]`, `partNumber[no][1]`, ...

## Git Workflow

### Remotes
| Remote | URL | 用途 |
|--------|-----|------|
| `origin` | git@gitlab.twjoin.com:deltapsu-group/deltapsu-laravel-backend.git | 主要 remote |
| `uat` | git@github.com:YeDann/deltapsu-laravel-backend.git | UAT & Prod 環境（同 remote，分支不同） |
| `cn` | git@github.com:YeDann/deltapsu-cn-laravel-backend.git | CN 站專用 |

> **原則：所有開發都在 `origin` 進行。`uat` 和 `cn` 只用來 merge/cherry-pick 後部署，不在上面開發。**

### UAT 測試流程

**「推 origin develop」** — 把目前分支 merge 進 develop，推 origin：
```bash
git checkout develop
git merge <current-branch> --no-ff
git push origin develop
```

**「推 uat develop」** — 切到 develop，推 uat（不重複推 origin）：
```bash
git checkout develop
git push uat develop
```

### 正式站流程（全站）
```bash
# 1. 從 origin/staging 開分支，cherry-pick 需要的 commit
git checkout -b <branch> staging
git cherry-pick <hash1> <hash2> ...

# 2. merge 回 staging
git checkout staging
git merge <branch> --no-edit

# 3. 先推 origin，再推 uat，去正式站 pull
git push origin staging
git push uat staging
```

### 正式站流程（CN，無測試環境）
```bash
# 1. 從 cn/staging 開分支，cherry-pick 需要的 commit
git fetch cn
git checkout -b <branch> cn/staging
git cherry-pick <hash>
# 衝突一律以 CN 站為準（保留 HEAD）

# 2. merge 回 cn/staging
git checkout <cn-staging-branch>
git merge <branch> --no-edit

# 3. 推到 cn，去 CN 正式站 pull
git push cn <branch>
```

### 分支命名慣例
- 功能縮寫：`staging-lp`（lp = landing page 專案）
- 日期：`staging-0413`
- 不用描述性英文內容當後綴（`staging-bilibili` ❌）

### CN 注意事項
- CN 站 CSP（`ContentSecurityPolicy.php`）格式與全站不同，衝突時保留 CN 版本
- CN 站影片用 Bilibili（`player.bilibili.com`），全站用 YouTube
- CN locale 判斷：`App::getLocale() === 'cn'`

### 常見地雷
- `index.lock` 存在：`rm -f .git/index.lock`
- cherry-pick 前確認 commit hash 在對的 branch，不要漏撿
- force push 前確認 log 乾淨再推

## Artisan Commands
```bash
php artisan redirects:generate    # Rebuild redirect map from CSV
php artisan test:csv-redirects    # Verify redirect mappings
php artisan test:csv-redirects --url="https://..."  # Test specific URL
```

## Common Gotchas
- Edit tool may fail on large blade files if strings aren't unique — use more surrounding context
- Desktop and mobile sections in blade files often have slightly different indentation
- Never use product_has_property for multi-field-per-row data (it only supports 1 value_text for text type)
- product.blade.php is ~5000+ lines — always read the specific section before editing
