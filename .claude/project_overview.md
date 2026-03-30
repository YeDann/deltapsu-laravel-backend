---
name: DeltaPSU Project Overview
description: Core purpose, domain, and ongoing work for the DeltaPSU Laravel backend
type: project
---

DeltaPSU is a multilingual product catalog site for Delta Electronics power supplies (psu.deltaww.com). The backend is Laravel, with Chinese/English/German/Japanese/Turkish language support.

**Why:** Delta Electronics' product showcase site - products, news, events, distributor finder, document downloads.

**Key domains:**
- Product listing with complex JS filtering (series, type, specs)
- Product detail pages with spec tables
- Admin backend for product CRUD
- SEO: hreflang tags, 301/410 redirects from CSV
- Multilingual content via `_translation` tables

**Active work:**
- CSV-based bulk redirect middleware (574 × 301, 63 × 410 Gone) — `storage/app/redirect_map.php`, regenerate with `php artisan redirects:generate`
- Product status sorting: New > No status > NRND > EOL — done in front-end JS `sortByStatus()` in product.blade.php (NOT in controller)
- Part Number feature added to admin product create/edit — `product_part_numbers` table (id, product_id, no, text, order)
- Browser back-button filter state preserved via localStorage in product.blade.php

**How to apply:** When touching product listing, check if sorting is in blade JS not controller. When touching admin product pages, check both create.blade.php and edit.blade.php.
