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
VALUES ('Where_to_Buy');

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

## 9. 調整 main category 的資料 Industrial Power Supplies Modules - 分類更改

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

## 11. 調整 main category 的資料 Medical Power Supplies - 分類更改

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

## 12. 加入 main category 

```sql
INSERT INTO `main_pro_categories` (`order_seq`, `active`, `created_at`, `updated_at`)
VALUES (5, 1, NOW(), NOW());

INSERT INTO `main_pro_categories_translations` (`main_pro_id`, `name`, `local`)
VALUES
(5, 'Configurable Power', 'en'),
(5, '可配置電源', 'tw'),
(5, '可配置電源', 'cn'),
(5, 'Configurable Power', 'de'),
(5, 'Configurable Power', 'ru'),
(5, 'Configurable Power', 'jp');

INSERT INTO `static_keyword` (`key_word`)
VALUES ('Configurable_Power');

INSERT INTO `static_keyword_translations` (`key_word`, `word`, `local`)
VALUES
/* English (en) - 原文 */
('Configurable_Power', 'Configurable Power', 'en'),
/* Traditional Chinese (tw) - 繁體中文 */
('Configurable_Power', '可配置電源', 'tw'),
/* Simplified Chinese (cn) - 簡體中文 */
('Configurable_Power', '可配置電源', 'cn'),
/* German (de) - 德文 */
('Configurable_Power', 'Configurable Power', 'de'),
/* Russian (ru) - 俄文 */
('Configurable_Power', 'Configurable Power', 'ru'),
/* Japan (jp) - 日文 */
('Configurable_Power', 'Configurable Power', 'jp');
```

## 13. 加入 success case

```sql
INSERT INTO `static_keyword` (`key_word`)
VALUES ('Success_Case');

INSERT INTO `static_keyword_translations` (`key_word`, `word`, `local`)
VALUES
/* English (en) - 原文 */
('Success_Case', 'Success Case', 'en'),
/* Traditional Chinese (tw) - 繁體中文 */
('Success_Case', '成功案例', 'tw'),
/* Simplified Chinese (cn) - 簡體中文 */
('Success_Case', '成功案例', 'cn'),
/* German (de) - 德文 */
('Success_Case', 'Success Case', 'de'),
/* Russian (ru) - 俄文 */
('Success_Case', 'Success Case', 'ru'),
/* Japan (jp) - 日文 */
('Success_Case', 'Success Case', 'jp');
```

## 14. 加入 Video

```sql
INSERT INTO `static_keyword` (`key_word`)
VALUES ('Videos');

INSERT INTO `static_keyword_translations` (`key_word`, `word`, `local`)
VALUES
/* English (en) - 原文 */
('Videos', 'Videos', 'en'),
/* Traditional Chinese (tw) - 繁體中文 */
('Videos', '影音', 'tw'),
/* Simplified Chinese (cn) - 簡體中文 */
('Videos', '視頻', 'cn'),
/* German (de) - 德文 */
('Videos', 'Videos', 'de'),
/* Russian (ru) - 俄文 */
('Videos', 'Videos', 'ru'),
/* Japan (jp) - 日文 */
('Videos', 'Videos', 'jp');
```

## 15. 加入 Download_AS_CSV 多語系設定

```sql
INSERT INTO `static_keyword` (`key_word`)
VALUES ('Download_AS_CSV');

INSERT INTO `static_keyword_translations` (`key_word`, `word`, `local`)
VALUES
/* English (en) - 原文 */
('Download_AS_CSV', 'Download as CSV', 'en'),
/* Traditional Chinese (tw) - 繁體中文 */
('Download_AS_CSV', 'Download as CSV', 'tw'),
/* Simplified Chinese (cn) - 簡體中文 */
('Download_AS_CSV', 'Download as CSV', 'cn'),
/* German (de) - 德文 */
('Download_AS_CSV', 'Download as CSV', 'de'),
/* Russian (ru) - 俄文 */
('Download_AS_CSV', 'Download as CSV', 'ru'),
/* Japan (jp) - 日文 */
('Download_AS_CSV', 'Download as CSV', 'jp');
```

## 16. 加入 Standard_Power_Supplies 多語系設定

```sql
INSERT INTO `static_keyword` (`key_word`)
VALUES ('Standard_Power_Supplies');

INSERT INTO `static_keyword_translations` (`key_word`, `word`, `local`)
VALUES
/* English (en) - 原文 */
('Standard_Power_Supplies', 'Standard Power Supplies', 'en'),
/* Traditional Chinese (tw) - 繁體中文 */
('Standard_Power_Supplies', 'Standard Power Supplies', 'tw'),
/* Simplified Chinese (cn) - 簡體中文 */
('Standard_Power_Supplies', 'Standard Power Supplies', 'cn'),
/* German (de) - 德文 */
('Standard_Power_Supplies', 'Standard Power Supplies', 'de'),
/* Russian (ru) - 俄文 */
('Standard_Power_Supplies', 'Standard Power Supplies', 'ru'),
/* Japan (jp) - 日文 */
('Standard_Power_Supplies', 'Standard Power Supplies', 'jp');
```

## 16. 調整主分類排序

```sql
UPDATE `main_pro_categories` SET `order_seq` = '3' WHERE `main_pro_categories`.`main_id` = 5;
UPDATE `main_pro_categories` SET `order_seq` = '5' WHERE `main_pro_categories`.`main_id` = 3;
```