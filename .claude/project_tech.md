---
name: Tech Stack & Key Files
description: Laravel architecture, key files, and database patterns for DeltaPSU
type: project
---

**Stack:** Laravel 6, MySQL, Blade, jQuery, Bootstrap 4

**Working directory:** `/Users/dan/Documents/project/deltapsu-laravel-backend/dependencies/`

**Key Controllers:**
- `app/Http/Controllers/FrontendController.php` — all frontend pages (product list, product detail, search, redirects)
- `app/Http/Controllers/ProductsController.php` — admin product CRUD (store/edit/update)

**Key Views:**
- `resources/views/front-end/product.blade.php` — product listing page with complex JS filter + sort
- `resources/views/front-end/productdetails.blade.php` — product detail page
- `resources/views/front-end/resultsearch.blade.php` — searchAll results page
- `resources/views/product/create.blade.php` — admin product create
- `resources/views/product/edit.blade.php` — admin product edit
- `resources/views/components/hreflang.blade.php` — shared hreflang component

**Key Middleware:**
- `app/Http/Middleware/CsvRedirectMiddleware.php` — bulk 301/410 from `storage/app/redirect_map.php`

**Database patterns:**
- `products` table — core product fields (pro_code, series_id, unit_weight, status_product, etc.)
- `product_has_property` + `product_has_property_translation` — dynamic numeric spec fields (voltage, current, power, etc.)
  - `status_input`: 1=Single, 2=Multiple (up to 12 values in data_1..data_12), 3=Range (data_1=min, data_2=max)
- `product_field` + `product_field_translation` — defines the spec field types
- `product_part_numbers` — NEW: (id, product_id, no, text, order) for Part Number feature
- `_translation` tables pattern — every content table has a `{table}_translation` table with `local` column for language

**Routes:** `routes/web.php` — grouped under LaravelLocalization with language prefix

**Artisan commands:**
- `php artisan redirects:generate` — regenerate redirect_map.php from CSV
- `php artisan test:csv-redirects [--url=]` — test redirect mappings

**How to apply:** Check if sorting/filtering logic is in blade JS before touching controller queries.
