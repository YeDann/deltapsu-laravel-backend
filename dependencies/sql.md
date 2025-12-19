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

INSERT INTO `main_pro_categories_translations` (`tran_id`, `main_pro_id`, `name`, `local`)
VALUES
(5, 'Configurable Power', 'en'),
(5, '可配置電源', 'tw'),
(5, '可配置電源', 'cn'),
(5, 'Configurable Power', 'de'),
(5, 'Configurable Power', 'ru'),
(5, 'Configurable Power', 'jp');

```