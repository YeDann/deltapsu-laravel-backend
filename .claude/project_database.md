---
name: Database Schema
description: Full table list, key relationships, and data patterns for DeltaPSU
type: project
---

## Core Product Tables

### `products`
主表。欄位：`pro_id`, `pro_code`, `series_id`, `picture`, `enable_pro`, `status_product`, `manaul_page`, `dimensionL/W/D`, `unit_weight`, `alt_img`

**status_product**: 1=None, 2=New, 3=NRND, 4=EOL

### `products_translation`
多語系：`product_id`, `local`, `content_1`(Highlights), `content_2`(詳細說明), `short_features`, `meta_description`, `showstatus`

### `product_has_categories`
商品與 sub_pro_categories 的 M:N 關係：`product_id`, `categories_id`

### `product_has_property` + `product_has_property_translation`
商品規格動態欄位：
- `per_id`, `product_id`, `type_id`(→product_field), `type_value`('text'|'number'), `status_input`(1=Single/2=Multiple/3=Range), `data_1`..`data_12`
- Translation: `per_fk_id`, `product_id`, `local`, `value_text`
- **重要**: type_id 3=Output Voltage, 4=Output Current, 8=Input Voltage, 31=Output Power
- Multiple 最多 12 個值存在 data_1~data_12
- Range: data_1=min, data_2=max
- Text type: 值存在 translation.value_text，只有一個值

### `product_field` + `product_field_translation`
定義規格欄位類型：`id`, `type`('text'|'number'), `section_id`, `unit_name`
Translation: `field_name`, `local`

### `product_part_numbers` ← 新增
Part Number：`id`, `product_id`, `no`, `text`, `order`

### `product_tags`
商品 tag：`product_id`, `tag`

### `product_optional_model`
選配型號：`product_id`, `optional_model`

### `product_related`
相關商品：`product_id`, `related_id`

---

## 分類 Tables

### `main_pro_categories` + `main_pro_categories_translations`
主分類（Industrial/Medical/...）：`id`, `name`

### `sub_pro_categories` + `sub_pro_categories_translation`
子分類（Din-Rail/Panel-Mount/...）：`sub_pro_id`, `url_item`, `name`, `unit_dimension`

### `categories_has_main_pro`
子分類對應主分類：`cate_id`, `main_cateid`
**注意**: 一個子分類可能對應多個主分類，用 `CASE WHEN main_cateid = 2 THEN 0` 優先選 Industrial(2)

### `series` + `series_translations`
系列：`se_id`, `slug`, `mode_series`, `title`

### `series_has_pro_categories`
系列對應子分類：`se_id`, `sub_pro_id`

### `section` + `section_translation`
商品規格 section 群組：`id`, `name`, `sortname`

---

## 多語系 Pattern

幾乎每個內容表都有對應的 `_translation` 表，加上 `local` 欄位：
- `local` 值：`en`, `tw`, `cn`, `de`, `jp`, `tr`
- 查詢時永遠 join 並 `where local = $lang`
- `$lang = App::getLocale()` 取得當前語系

---

## 其他重要 Tables

| Table | 用途 |
|-------|------|
| `documents` / `product_has_documents` | 文件下載 |
| `certificate_product` | 商品認證 |
| `static_content` / `static_content_translations` | 前台靜態文字（按鈕、標籤等） |
| `users` | 後台使用者，有 `lang`, `role` 欄位 |
| `language` | 支援的語系清單 |
| `external_link` / `product_has_property` type_id 115 | 外部連結 |
| `sub_pro_has_product_filter` / `subpro_has_profilter_translation` | 前台篩選器定義 |
| `default_filter` | 篩選器預設值 |
