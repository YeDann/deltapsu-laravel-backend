---
name: Admin CRUD Flow
description: Admin product create/edit/store/update flow, gotchas, and field handling
type: project
---

## Admin Product Management

### Controller: `app/Http/Controllers/ProductsController.php`
- Protected by `auth` middleware in constructor

### Views
- `resources/views/product/create.blade.php` — new product form
- `resources/views/product/edit.blade.php` — edit existing product
- `resources/views/product/index.blade.php` — product list

---

## Field Types in Admin

### Static Fields (products table)
- `pro_code`, `series_id`, `picture`, `enable_pro`, `status_product`
- `manaul_page`, `dimensionL/W/D`, `unit_weight`, `alt_img`

### Multilingual Fields (products_translation)
- One row per language × product
- `content_1` = Highlights & Features (rich text / text editor)
- `content_2` = Detailed Description
- `short_features`, `meta_description`, `showstatus`

### Dynamic Spec Fields (product_has_property)
- `type_id` → references `product_field` (e.g. 3=Output Voltage, 4=Output Current)
- `type_value` = 'text' | 'number'
- `status_input` = 1 (Single) | 2 (Multiple) | 3 (Range)
- Single: one value in `data_1`
- Multiple: up to 12 values in `data_1`..`data_12`
- Range: `data_1` = min, `data_2` = max
- Text type: value in `product_has_property_translation.value_text` (only ONE value)

### Part Number (product_part_numbers) ← New Feature
- Multiple rows per product
- Fields: `no` (Part Number code), `text` (description), `order` (display order)
- Admin UI: after Unit Weight in create/edit pages
- Add row with "+ Add" button, remove with "-" button
- Input names: `partNumber[no][0]`, `partNumber[text][0]`, etc.

---

## store() / update() Pattern for Part Numbers

```php
// update() only: clear existing
DB::table('product_part_numbers')->where('product_id', $pro_id)->delete();

$partNumberNos = $request->input('partNumber.no', []);
$partNumberTexts = $request->input('partNumber.text', []);
foreach ($partNumberNos as $index => $no) {
    $text = $partNumberTexts[$index] ?? '';
    if (!empty($no) || !empty($text)) {
        DB::table('product_part_numbers')->insert([
            'product_id' => $pro_id,
            'no' => $no,
            'text' => $text,
            'order' => $index,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
```

---

## edit() Data Loading Pattern

```php
$partNumbers = DB::table('product_part_numbers')
    ->where('product_id', $pro_id)
    ->orderBy('order', 'asc')
    ->get();
return view('product.edit')->with('partNumbers', $partNumbers);
```

In edit.blade.php, pre-populate rows:
```blade
@foreach($partNumbers as $index => $pn)
<div class="part-number-row" data-index="{{ $index }}">
    <input name="partNumber[no][{{ $index }}]" value="{{ $pn->no }}">
    <input name="partNumber[text][{{ $index }}]" value="{{ $pn->text }}">
    <button onclick="removePartNumber(this)">-</button>
</div>
@endforeach
```

---

## Gotchas

- When adding new input groups in admin forms, track the incrementing index carefully (JS counter)
- `Output Voltage Range` Multiple type uses one field per value; Part Number uses TWO fields per row — different pattern
- `product_has_property` text type only supports ONE value_text — not suitable for Part Number
- Always use delete + re-insert pattern for dynamic rows (not update) — simpler and avoids orphans
