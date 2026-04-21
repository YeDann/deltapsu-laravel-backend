---
name: Search category dropdown (deferred)
description: Category filter dropdown next to search box — built but commented out, client wants to enable later
type: project
---

A category filter `<select>` dropdown was built for the `resultsearch.blade.php` search results page to replace the Bootstrap tabs. Currently commented out at the top of the results page (above the tabs). When the client is ready to switch:

1. Uncomment the `<div class="d-flex...">` block containing `<select id="search-category-filter">` in `resultsearch.blade.php`
2. Remove (or hide) the `<nav id="bar-search-results-page-nav">` tab block
3. Remove the mobile `<select id="select-search-results">` block
4. Change all `tab-pane fade` section classes to `search-section`
5. Replace the tab sync JS with `filterSearchSections()` JS (already commented out in `@section('js')`)

**Why:** Client preferred tabs for now; dropdown was designed for future use as a cleaner filter UX.
**How to apply:** When client asks to switch from tabs to dropdown, follow the 5 steps above.
