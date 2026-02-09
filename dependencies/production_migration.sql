-- =========================================
-- Production Database Migration Script
-- 生產環境資料庫遷移腳本
-- Execute Date: 2026-02-09
-- =========================================

-- 設定字符集
SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- =========================================
-- 1. 加入 Products_Overview 多語系設定
-- =========================================

INSERT INTO `static_keyword` (`key_word`)
VALUES ('Products_Overview')
ON DUPLICATE KEY UPDATE `key_word` = `key_word`;

INSERT INTO `static_keyword_translations` (`key_word`, `word`, `local`)
VALUES
/* English */
('Products_Overview', 'Products Overview', 'en'),
/* Simplified Chinese */
('Products_Overview', '商品總覽', 'cn'),
/* Traditional Chinese (Taiwan) */
('Products_Overview', '商品總覽', 'tw'),
/* German */
('Products_Overview', 'Products Overview', 'de'),
/* Russian */
('Products_Overview', 'Products Overview', 'ru'),
/* Japan */
('Products_Overview', 'Products Overview', 'jp')
ON DUPLICATE KEY UPDATE `word` = VALUES(`word`);

-- =========================================
-- 2. 加入 Technical Support 多語系設定
-- =========================================

INSERT INTO `static_keyword` (`key_word`)
VALUES ('Technical_Support')
ON DUPLICATE KEY UPDATE `key_word` = `key_word`;

INSERT INTO `static_keyword_translations` (`key_word`, `word`, `local`)
VALUES
/* English */
('Technical_Support', 'Technical Support', 'en'),
/* Traditional Chinese */
('Technical_Support', '技術支援', 'tw'),
/* Simplified Chinese */
('Technical_Support', '技術支援', 'cn'),
/* German */
('Technical_Support', 'Technical Support', 'de'),
/* Russian */
('Technical_Support', 'Technical Support', 'ru'),
/* Japan */
('Technical_Support', 'Technical Support', 'jp')
ON DUPLICATE KEY UPDATE `word` = VALUES(`word`);

-- =========================================
-- 3. 加入 Technical Service 多語系設定
-- =========================================

INSERT INTO `static_keyword` (`key_word`)
VALUES ('Technical_Service')
ON DUPLICATE KEY UPDATE `key_word` = `key_word`;

INSERT INTO `static_keyword_translations` (`key_word`, `word`, `local`)
VALUES
/* English */
('Technical_Service', 'Technical Service', 'en'),
/* Traditional Chinese */
('Technical_Service', '技術服務', 'tw'),
/* Simplified Chinese */
('Technical_Service', '技術服務', 'cn'),
/* German */
('Technical_Service', 'Technical Service', 'de'),
/* Russian */
('Technical_Service', 'Technical Service', 'ru'),
/* Japan */
('Technical_Service', 'Technical Service', 'jp')
ON DUPLICATE KEY UPDATE `word` = VALUES(`word`);

-- =========================================
-- 4. 更新 news type Industry Know-How 多語系設定
-- =========================================

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

-- =========================================
-- 5. 更新 news type Event News 多語系設定
-- =========================================

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

-- =========================================
-- 6. 更新 news type Product News 多語系設定
-- =========================================

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

-- =========================================
-- 7. 加入 Where to Buy 多語系設定
-- =========================================

INSERT INTO `static_keyword` (`key_word`)
VALUES ('Where_to_Buy')
ON DUPLICATE KEY UPDATE `key_word` = `key_word`;

INSERT INTO `static_keyword_translations` (`key_word`, `word`, `local`)
VALUES
/* English */
('Where_to_Buy', 'Where to Buy', 'en'),
/* Traditional Chinese */
('Where_to_Buy', '購買管道', 'tw'),
/* Simplified Chinese */
('Where_to_Buy', '購買管道', 'cn'),
/* German */
('Where_to_Buy', 'Where to Buy', 'de'),
/* Russian */
('Where_to_Buy', 'Where to Buy', 'ru'),
/* Japan */
('Where_to_Buy', 'Where to Buy', 'jp')
ON DUPLICATE KEY UPDATE `word` = VALUES(`word`);

-- =========================================
-- 8. 調整 Industrial Power Supplies 分類設定
-- =========================================

DELETE FROM `categories_has_main_pro`
WHERE `main_cateid` = 2;

INSERT INTO `categories_has_main_pro` (`cate_id`, `main_cateid`, `order_seq`)
VALUES
/* main_cateid = 2 的資料：cate_id 1, 2, 3, 8, 5 */
(1, 2, 1), -- 順序 1
(2, 2, 2), -- 順序 2
(3, 2, 3), -- 順序 3
(8, 2, 4), -- 順序 4
(5, 2, 5); -- 順序 5

-- =========================================
-- 9. 調整 Medical Power Supplies 分類設定
-- =========================================

DELETE FROM `categories_has_main_pro`
WHERE `main_cateid` = 1;

INSERT INTO `categories_has_main_pro` (`cate_id`, `main_cateid`, `order_seq`)
VALUES
/* main_cateid = 1 的資料：cate_id 3, 9, 8 */
(3, 1, 1), -- 順序 1
(9, 1, 2), -- 順序 2
(8, 1, 3); -- 順序 3

-- =========================================
-- 10. 加入新的主分類：Configurable Power
-- =========================================

INSERT INTO `main_pro_categories` (`order_seq`, `active`, `created_at`, `updated_at`)
VALUES (5, 1, NOW(), NOW())
ON DUPLICATE KEY UPDATE `updated_at` = NOW();

-- 獲取剛插入的 main_pro_id (假設為 5，請根據實際情況調整)
INSERT INTO `main_pro_categories_translations` (`main_pro_id`, `name`, `local`)
VALUES
(5, 'Configurable Power', 'en'),
(5, '可配置電源', 'tw'),
(5, '可配置電源', 'cn'),
(5, 'Configurable Power', 'de'),
(5, 'Configurable Power', 'ru'),
(5, 'Configurable Power', 'jp')
ON DUPLICATE KEY UPDATE `name` = VALUES(`name`);

INSERT INTO `static_keyword` (`key_word`)
VALUES ('Configurable_Power')
ON DUPLICATE KEY UPDATE `key_word` = `key_word`;

INSERT INTO `static_keyword_translations` (`key_word`, `word`, `local`)
VALUES
/* English */
('Configurable_Power', 'Configurable Power', 'en'),
/* Traditional Chinese */
('Configurable_Power', '可配置電源', 'tw'),
/* Simplified Chinese */
('Configurable_Power', '可配置電源', 'cn'),
/* German */
('Configurable_Power', 'Configurable Power', 'de'),
/* Russian */
('Configurable_Power', 'Configurable Power', 'ru'),
/* Japan */
('Configurable_Power', 'Configurable Power', 'jp')
ON DUPLICATE KEY UPDATE `word` = VALUES(`word`);

-- =========================================
-- 11. 加入 Success Case 多語系設定
-- =========================================

INSERT INTO `static_keyword` (`key_word`)
VALUES ('Success_Case')
ON DUPLICATE KEY UPDATE `key_word` = `key_word`;

INSERT INTO `static_keyword_translations` (`key_word`, `word`, `local`)
VALUES
/* English */
('Success_Case', 'Success Case', 'en'),
/* Traditional Chinese */
('Success_Case', '成功案例', 'tw'),
/* Simplified Chinese */
('Success_Case', '成功案例', 'cn'),
/* German */
('Success_Case', 'Success Case', 'de'),
/* Russian */
('Success_Case', 'Success Case', 'ru'),
/* Japan */
('Success_Case', 'Success Case', 'jp')
ON DUPLICATE KEY UPDATE `word` = VALUES(`word`);

-- =========================================
-- 12. 加入 Videos 多語系設定
-- =========================================

INSERT INTO `static_keyword` (`key_word`)
VALUES ('Videos')
ON DUPLICATE KEY UPDATE `key_word` = `key_word`;

INSERT INTO `static_keyword_translations` (`key_word`, `word`, `local`)
VALUES
/* English */
('Videos', 'Videos', 'en'),
/* Traditional Chinese */
('Videos', '影音', 'tw'),
/* Simplified Chinese */
('Videos', '視頻', 'cn'),
/* German */
('Videos', 'Videos', 'de'),
/* Russian */
('Videos', 'Videos', 'ru'),
/* Japan */
('Videos', 'Videos', 'jp')
ON DUPLICATE KEY UPDATE `word` = VALUES(`word`);

-- =========================================
-- 13. 加入 Download_AS_CSV 多語系設定
-- =========================================

INSERT INTO `static_keyword` (`key_word`)
VALUES ('Download_AS_CSV')
ON DUPLICATE KEY UPDATE `key_word` = `key_word`;

INSERT INTO `static_keyword_translations` (`key_word`, `word`, `local`)
VALUES
/* English */
('Download_AS_CSV', 'Download as CSV', 'en'),
/* Traditional Chinese */
('Download_AS_CSV', 'Download as CSV', 'tw'),
/* Simplified Chinese */
('Download_AS_CSV', 'Download as CSV', 'cn'),
/* German */
('Download_AS_CSV', 'Download as CSV', 'de'),
/* Russian */
('Download_AS_CSV', 'Download as CSV', 'ru'),
/* Japan */
('Download_AS_CSV', 'Download as CSV', 'jp')
ON DUPLICATE KEY UPDATE `word` = VALUES(`word`);

-- =========================================
-- 14. 加入 Standard_Power_Supplies 多語系設定
-- =========================================

INSERT INTO `static_keyword` (`key_word`)
VALUES ('Standard_Power_Supplies')
ON DUPLICATE KEY UPDATE `key_word` = `key_word`;

INSERT INTO `static_keyword_translations` (`key_word`, `word`, `local`)
VALUES
/* English */
('Standard_Power_Supplies', 'Standard Power Supplies', 'en'),
/* Traditional Chinese */
('Standard_Power_Supplies', '標準電源', 'tw'),
/* Simplified Chinese */
('Standard_Power_Supplies', '标准电源', 'cn'),
/* German */
('Standard_Power_Supplies', 'Standard-Netzteil', 'de'),
/* Russian */
('Standard_Power_Supplies', 'Standard Power Supplies', 'ru'),
/* Turkish */
('Standard_Power_Supplies', 'Standart Güç Kaynağı', 'tr'),
/* Japan */
('Standard_Power_Supplies', '標準電源', 'jp')
ON DUPLICATE KEY UPDATE `word` = VALUES(`word`);

-- =========================================
-- 15. 調整主分類排序
-- =========================================

UPDATE `main_pro_categories` SET `order_seq` = 3 WHERE `main_id` = 5;
UPDATE `main_pro_categories` SET `order_seq` = 5 WHERE `main_id` = 3;

-- =========================================
-- 16. News 資料遷移相關 - 建立新的分類表
-- =========================================

-- 注意：以下 SQL 可能需要根據生產環境的實際狀況調整

-- 建立 Product Notice Type 預設分類
INSERT INTO `product_notice_type` (`name`, `color_type`, `order_seq`, `created_at`, `updated_at`)
VALUES ('Product Notice', '#C68080', 0, NOW(), NOW())
ON DUPLICATE KEY UPDATE `updated_at` = NOW();

-- 建立 Industry Know-How Type 預設分類  
INSERT INTO `industry_know_how_type` (`name`, `color_type`, `order_seq`, `created_at`, `updated_at`)
VALUES ('Industry Know-How', '#C68080', 0, NOW(), NOW())
ON DUPLICATE KEY UPDATE `updated_at` = NOW();

-- 建立 EOL Type 預設分類
INSERT INTO `eol_type` (`name`, `color_type`, `order_seq`, `created_at`, `updated_at`)
VALUES ('EOL', '#C68080', 0, NOW(), NOW())
ON DUPLICATE KEY UPDATE `updated_at` = NOW();

-- 建立對應的翻譯記錄
-- Product Notice 翻譯
INSERT INTO `product_notice_type_translation` (`fk_pnt_id`, `title`, `local`, `created_at`, `updated_at`)
SELECT 1, 'Product Notice', 'en', NOW(), NOW()
FROM DUAL WHERE NOT EXISTS (SELECT 1 FROM `product_notice_type_translation` WHERE `fk_pnt_id` = 1 AND `local` = 'en');

INSERT INTO `product_notice_type_translation` (`fk_pnt_id`, `title`, `local`, `created_at`, `updated_at`)
SELECT 1, '产品须知', 'cn', NOW(), NOW()
FROM DUAL WHERE NOT EXISTS (SELECT 1 FROM `product_notice_type_translation` WHERE `fk_pnt_id` = 1 AND `local` = 'cn');

INSERT INTO `product_notice_type_translation` (`fk_pnt_id`, `title`, `local`, `created_at`, `updated_at`)
SELECT 1, 'Produktankündigungen', 'de', NOW(), NOW()
FROM DUAL WHERE NOT EXISTS (SELECT 1 FROM `product_notice_type_translation` WHERE `fk_pnt_id` = 1 AND `local` = 'de');

INSERT INTO `product_notice_type_translation` (`fk_pnt_id`, `title`, `local`, `created_at`, `updated_at`)
SELECT 1, 'Уведомление о продукте', 'ru', NOW(), NOW()
FROM DUAL WHERE NOT EXISTS (SELECT 1 FROM `product_notice_type_translation` WHERE `fk_pnt_id` = 1 AND `local` = 'ru');

INSERT INTO `product_notice_type_translation` (`fk_pnt_id`, `title`, `local`, `created_at`, `updated_at`)
SELECT 1, '產品須知', 'tw', NOW(), NOW()
FROM DUAL WHERE NOT EXISTS (SELECT 1 FROM `product_notice_type_translation` WHERE `fk_pnt_id` = 1 AND `local` = 'tw');

INSERT INTO `product_notice_type_translation` (`fk_pnt_id`, `title`, `local`, `created_at`, `updated_at`)
SELECT 1, 'Product Notice', 'jp', NOW(), NOW()
FROM DUAL WHERE NOT EXISTS (SELECT 1 FROM `product_notice_type_translation` WHERE `fk_pnt_id` = 1 AND `local` = 'jp');

INSERT INTO `product_notice_type_translation` (`fk_pnt_id`, `title`, `local`, `created_at`, `updated_at`)
SELECT 1, 'Product Notice', 'tr', NOW(), NOW()
FROM DUAL WHERE NOT EXISTS (SELECT 1 FROM `product_notice_type_translation` WHERE `fk_pnt_id` = 1 AND `local` = 'tr');

-- Industry Know-How 翻譯
INSERT INTO `industry_know_how_type_translation` (`fk_ikht_id`, `title`, `local`, `created_at`, `updated_at`)
SELECT 1, 'Industry Know-How', 'en', NOW(), NOW()
FROM DUAL WHERE NOT EXISTS (SELECT 1 FROM `industry_know_how_type_translation` WHERE `fk_ikht_id` = 1 AND `local` = 'en');

INSERT INTO `industry_know_how_type_translation` (`fk_ikht_id`, `title`, `local`, `created_at`, `updated_at`)
SELECT 1, '产业知识', 'cn', NOW(), NOW()
FROM DUAL WHERE NOT EXISTS (SELECT 1 FROM `industry_know_how_type_translation` WHERE `fk_ikht_id` = 1 AND `local` = 'cn');

INSERT INTO `industry_know_how_type_translation` (`fk_ikht_id`, `title`, `local`, `created_at`, `updated_at`)
SELECT 1, 'Wissen', 'de', NOW(), NOW()
FROM DUAL WHERE NOT EXISTS (SELECT 1 FROM `industry_know_how_type_translation` WHERE `fk_ikht_id` = 1 AND `local` = 'de');

INSERT INTO `industry_know_how_type_translation` (`fk_ikht_id`, `title`, `local`, `created_at`, `updated_at`)
SELECT 1, 'Знания', 'ru', NOW(), NOW()
FROM DUAL WHERE NOT EXISTS (SELECT 1 FROM `industry_know_how_type_translation` WHERE `fk_ikht_id` = 1 AND `local` = 'ru');

INSERT INTO `industry_know_how_type_translation` (`fk_ikht_id`, `title`, `local`, `created_at`, `updated_at`)
SELECT 1, '產業知識', 'tw', NOW(), NOW()
FROM DUAL WHERE NOT EXISTS (SELECT 1 FROM `industry_know_how_type_translation` WHERE `fk_ikht_id` = 1 AND `local` = 'tw');

INSERT INTO `industry_know_how_type_translation` (`fk_ikht_id`, `title`, `local`, `created_at`, `updated_at`)
SELECT 1, 'Industry Know-How', 'jp', NOW(), NOW()
FROM DUAL WHERE NOT EXISTS (SELECT 1 FROM `industry_know_how_type_translation` WHERE `fk_ikht_id` = 1 AND `local` = 'jp');

INSERT INTO `industry_know_how_type_translation` (`fk_ikht_id`, `title`, `local`, `created_at`, `updated_at`)
SELECT 1, 'Industry Know-How', 'tr', NOW(), NOW()
FROM DUAL WHERE NOT EXISTS (SELECT 1 FROM `industry_know_how_type_translation` WHERE `fk_ikht_id` = 1 AND `local` = 'tr');

-- EOL 翻譯
INSERT INTO `eol_type_translation` (`fk_et_id`, `title`, `local`, `created_at`, `updated_at`)
SELECT 1, 'EOL', 'en', NOW(), NOW()
FROM DUAL WHERE NOT EXISTS (SELECT 1 FROM `eol_type_translation` WHERE `fk_et_id` = 1 AND `local` = 'en');

INSERT INTO `eol_type_translation` (`fk_et_id`, `title`, `local`, `created_at`, `updated_at`)
SELECT 1, '下架产品', 'cn', NOW(), NOW()
FROM DUAL WHERE NOT EXISTS (SELECT 1 FROM `eol_type_translation` WHERE `fk_et_id` = 1 AND `local` = 'cn');

INSERT INTO `eol_type_translation` (`fk_et_id`, `title`, `local`, `created_at`, `updated_at`)
SELECT 1, 'Lebensdauer', 'de', NOW(), NOW()
FROM DUAL WHERE NOT EXISTS (SELECT 1 FROM `eol_type_translation` WHERE `fk_et_id` = 1 AND `local` = 'de');

INSERT INTO `eol_type_translation` (`fk_et_id`, `title`, `local`, `created_at`, `updated_at`)
SELECT 1, 'EOL', 'ru', NOW(), NOW()
FROM DUAL WHERE NOT EXISTS (SELECT 1 FROM `eol_type_translation` WHERE `fk_et_id` = 1 AND `local` = 'ru');

INSERT INTO `eol_type_translation` (`fk_et_id`, `title`, `local`, `created_at`, `updated_at`)
SELECT 1, '停產產品', 'tw', NOW(), NOW()
FROM DUAL WHERE NOT EXISTS (SELECT 1 FROM `eol_type_translation` WHERE `fk_et_id` = 1 AND `local` = 'tw');

INSERT INTO `eol_type_translation` (`fk_et_id`, `title`, `local`, `created_at`, `updated_at`)
SELECT 1, 'EOL', 'jp', NOW(), NOW()
FROM DUAL WHERE NOT EXISTS (SELECT 1 FROM `eol_type_translation` WHERE `fk_et_id` = 1 AND `local` = 'jp');

INSERT INTO `eol_type_translation` (`fk_et_id`, `title`, `local`, `created_at`, `updated_at`)
SELECT 1, 'EOL', 'tr', NOW(), NOW()
FROM DUAL WHERE NOT EXISTS (SELECT 1 FROM `eol_type_translation` WHERE `fk_et_id` = 1 AND `local` = 'tr');

-- =========================================
-- 17. 遷移 News 內容到新的分類系統
-- =========================================

-- 注意：這部分需要手動執行 News 遷移腳本
-- 請先上傳 migrate_news_data.php 到生產環境並執行：
-- php artisan tinker --execute="require 'migrate_news_data.php'; (new NewsDataMigration())->run();"

-- 恢復外鍵檢查
SET FOREIGN_KEY_CHECKS = 1;

-- =========================================
-- 腳本執行完成
-- =========================================
SELECT 'Database migration completed successfully!' as result;