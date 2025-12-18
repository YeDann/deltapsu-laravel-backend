# Database Migration SQL Commands

## 1. 加入 Products_Overview 的資料

```sql
INSERT INTO `static_keyword` (`key_word`)
VALUES ('Products_Overview');

INSERT INTO `static_keyword_translations` (`key_word`, `word`, `local`)
VALUES
/* English */
('Products_Overview', 'Products Overview', 'en'),
/* Simplified Chinese */
('Products_Overview', 'CN-商品總覽', 'cn'),
/* Traditional Chinese (Taiwan) */
('Products_Overview', '商品總覽', 'tw'),
/* German (新增) */
('Products_Overview', 'Products Overview', 'de'),
/* Russian (新增) */
('Products_Overview', 'Products Overview', 'ru'),
/* Japan (jp) - 日文 */
('Products_Overview', 'Products Overview', 'jp');
```

## 2. 加入 Industrial Power Supplies Modules 多語系設定

```sql
INSERT INTO `static_keyword` (`key_word`)
VALUES ('Industrial_Power_Supplies_Modules');

INSERT INTO `static_keyword_translations` (`key_word`, `word`, `local`)
VALUES
/* English (en) - 原文 */
('Industrial_Power_Supplies_Modules', 'Industrial Power Supplies & Modules', 'en'),
/* Traditional Chinese (tw) - 繁體中文 */
('Industrial_Power_Supplies_Modules', '工業電源供應器與模組', 'tw'),
/* Simplified Chinese (cn) - 簡體中文 (加入 CN 前綴以區分) */
('Industrial_Power_Supplies_Modules', '工業電源供應器與模組', 'cn'),
/* German (de) - 德文 */
('Industrial_Power_Supplies_Modules', 'Industrial Power Supplies & Modules', 'de'),
/* Russian (ru) - 俄文 */
('Industrial_Power_Supplies_Modules', 'Industrial Power Supplies & Modules', 'ru'),
/* Japan (jp) - 日文 */
('Industrial_Power_Supplies_Modules', 'Industrial Power Supplies & Modules', 'jp');
```

## 3. 加入 Technical Support 多語系設定

```sql
INSERT INTO `static_keyword` (`key_word`)
VALUES ('Technical_Support');

INSERT INTO `static_keyword_translations` (`key_word`, `word`, `local`)
VALUES
/* English (en) - 原文 */
('Technical_Support', 'Technical Support', 'en'),
/* Traditional Chinese (tw) - 繁體中文 */
('Technical_Support', '技術支援', 'tw'),
/* Simplified Chinese (cn) - 簡體中文 */
('Technical_Support', '技術支援', 'cn'),
/* German (de) - 德文 */
('Technical_Support', 'Technical Support', 'de'),
/* Russian (ru) - 俄文 */
('Technical_Support', 'Technical Support', 'ru'),
/* Japan (jp) - 日文 */
('Technical_Support', 'Technical Support', 'jp');
```

## 4. 加入 Technical Service 多語系設定

```sql
INSERT INTO `static_keyword` (`key_word`)
VALUES ('Technical_Service');

INSERT INTO `static_keyword_translations` (`key_word`, `word`, `local`)
VALUES
/* English (en) - 原文 */
('Technical_Service', 'Technical Service', 'en'),
/* Traditional Chinese (tw) - 繁體中文 */
('Technical_Service', '技術服務', 'tw'),
/* Simplified Chinese (cn) - 簡體中文 */
('Technical_Service', '技術服務', 'cn'),
/* German (de) - 德文 */
('Technical_Service', 'Technical Service', 'de'),
/* Russian (ru) - 俄文 */
('Technical_Service', 'Technical Service', 'ru'),
/* Japan (jp) - 日文 */
('Technical_Service', 'Technical Service', 'jp');
```

## 5. 更新 news type Industry Know-How 多語系設定

```sql
UPDATE news_type_translation
SET title = 'Industry Know-How'
WHERE fk_nt_id = (
    SELECT id 
    FROM news_type 
    WHERE name = 'Knowledge'
    LIMIT 1
)
AND local IN ('en', 'jp');

UPDATE news_type 
SET name = 'Industry Know-How' 
WHERE name = 'Knowledge';
```
## 6. 更新 news type Compony 多語系設定

```sql
UPDATE news_type_translation
SET title = 'Event News'
WHERE fk_nt_id = (
    SELECT id 
    FROM news_type 
    WHERE name = 'Company'
    LIMIT 1
)
AND local IN ('en', 'jp');

UPDATE news_type 
SET name = 'Event News' 
WHERE name = 'Company';
```

## 7. 更新 news type New Products 多語系設定

```sql
UPDATE news_type_translation
SET title = 'Product News'
WHERE fk_nt_id = (
    SELECT id 
    FROM news_type 
    WHERE name = 'New Products'
    LIMIT 1
)
AND local IN ('en', 'jp');

UPDATE news_type 
SET name = 'Product News' 
WHERE name = 'New Products';
```

## 8. 加入 Technical Service 多語系設定

```sql
INSERT INTO `static_keyword` (`key_word`)
VALUES ('Where to Buy');

INSERT INTO `static_keyword_translations` (`key_word`, `word`, `local`)
VALUES
/* English (en) - 原文 */
('Where_to_Buy', 'Where to Buy', 'en'),
/* Traditional Chinese (tw) - 繁體中文 */
('Where_to_Buy', '購買管道', 'tw'),
/* Simplified Chinese (cn) - 簡體中文 */
('Where_to_Buy', '購買管道', 'cn'),
/* German (de) - 德文 */
('Where_to_Buy', 'Where to Buy', 'de'),
/* Russian (ru) - 俄文 */
('Where_to_Buy', 'Where to Buy', 'ru'),
/* Japan (jp) - 日文 */
('Where_to_Buy', 'Where to Buy', 'jp');
```


## 3. 調整 main category 的資料 Industrial Power Supplies Modules - 分類更改

```sql
DELETE FROM `categories_has_main_pro`
WHERE `main_cateid` = 2;

INSERT INTO `categories_has_main_pro` (`cate_id`, `main_cateid`, `order_seq`)
VALUES
/* main_cateid = 2 的資料：cate_id 1, 2, 3, 8, 4 */
(1, 2, 1), -- 順序 1
(2, 2, 2), -- 順序 2
(3, 2, 3), -- 順序 3
(8, 2, 4), -- 順序 4
(5, 2, 5); -- 順序 5
```

## 4. 加入 Medical_Power_Supplies 多語系設定

```sql
INSERT INTO `static_keyword` (`key_word`)
VALUES ('Medical_Power_Supplies');

INSERT INTO `static_keyword_translations` (`key_word`, `word`, `local`)
VALUES
/* English (en) - 原文 */
('Medical_Power_Supplies', 'Medical Power Supplies', 'en'),
/* Traditional Chinese (tw) - 繁體中文 */
('Medical_Power_Supplies', '醫用電源', 'tw'),
/* Simplified Chinese (cn) - 簡體中文 (加入 CN 前綴以區分) */
('Medical_Power_Supplies', '醫用電源', 'cn'),
/* German (de) - 德文 */
('Medical_Power_Supplies', 'Medical Power Supplies', 'de'),
/* Russian (ru) - 俄文 */
('Medical_Power_Supplies', 'Medical Power Supplies', 'ru'),
/* Japan (jp) - 日文 */
('Medical_Power_Supplies', 'Medical Power Supplies', 'jp');
```

## 5. 調整 main category 的資料 Medical Power Supplies - 分類更改

```sql
DELETE FROM `categories_has_main_pro`
WHERE `main_cateid` = 1;

INSERT INTO `categories_has_main_pro` (`cate_id`, `main_cateid`, `order_seq`)
VALUES
/* main_cateid = 1 的資料：cate_id 3,9,8 */
(3, 1, 1), -- 順序 1
(9, 1, 2), -- 順序 2
(8, 1, 3); -- 順序 3
```

## 6. 調整 main category 的資料 LED Drivers - 分類更改 TODO 待確認

```sql
DELETE FROM `categories_has_main_pro`
WHERE `main_cateid` = 3;

INSERT INTO `categories_has_main_pro` (`cate_id`, `main_cateid`, `order_seq`)
VALUES
/* main_cateid = 3 的資料：cate_id 3,9,8 */
(6, 3, 1), -- 順序 1
```

## 7. Configurable Power Supplies 多語系設定

```sql
INSERT INTO `static_keyword` (`key_word`)
VALUES ('Configurable_Power_Supplies');

INSERT INTO `static_keyword_translations` (`key_word`, `word`, `local`)
VALUES
/* English (en) - 原文 */
('Configurable_Power_Supplies', 'Configurable Power Supplies', 'en'),
/* Traditional Chinese (tw) - 繁體中文 */
('Configurable_Power_Supplies', '可配置式電源', 'tw'),
/* Simplified Chinese (cn) - 簡體中文 (加入 CN 前綴以區分) */
('Configurable_Power_Supplies', '可配置式电源', 'cn'),
/* German (de) - 德文 */
('Configurable_Power_Supplies', 'Configurable Power Supplies', 'de'),
/* Russian (ru) - 俄文 */
('Configurable_Power_Supplies', 'Configurable Power Supplies', 'ru'),
/* Japan (jp) - 日文 */
('Configurable_Power_Supplies', 'Configurable Power Supplies', 'jp');
```
