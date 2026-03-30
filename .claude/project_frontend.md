---
name: Frontend JS Architecture
description: JS filter system, sort system, localStorage back-button behavior in product.blade.php
type: project
---

## product.blade.php JS Architecture

### Core Data Flow
- PHP injects product data into JS as JSON at page load
- All display logic is client-side jQuery
- `allProducts` = full product array from PHP
- `currentProducts` = currently filtered subset

### Filter System
- Filters defined in `sub_pro_has_product_filter` / `subpro_has_profilter_translation`
- User checks filter → `onFilterChange()` fires
- Filters applied sequentially: each active filter reduces `currentProducts`
- Filter state stored in `activeFilters` object

### Sort System
Key functions (ALL must be updated when changing sort behavior):
- `sortByStatus(array)` — sorts by status_product priority (2→1→3→4→null)
- `onFilterSetSor(type)` — called when filter panel sort changes
- `onselectSort(type)` — desktop dropdown sort handler
- `onselectSortArr(type)` — mobile/array sort handler
- `onselectSortDestop(type)` — alternate desktop handler
- Unnamed function at ~line 4390 — initial sort on page load

Sort type values:
- `type_se == 1` → Product Status sort (`sortByStatus`)
- `type_se == 5` → Modified Date newest to oldest

### localStorage Back-Button Behavior
- Filter state is saved to localStorage when user navigates to product detail
- On page load, check if coming from a product page (referrer check)
- **CRITICAL**: Only restore localStorage if navigating back from product detail, NOT on direct load/refresh
- Use sessionStorage flag or referrer check to distinguish

### Display
- `displayProducts(array)` — renders product cards into DOM
- Called after every filter/sort change
- Handles both grid and list view

---

## productdetails.blade.php JS

- Minimal JS — mostly static content rendered server-side
- Image gallery switcher (thumbnail clicks)
- Document download buttons
- Compare product functionality (uses session)

---

## resultsearch.blade.php

- No client-side re-sort
- Results ordered by controller (status priority + pro_code alpha)
- Infinite scroll or pagination for large result sets
