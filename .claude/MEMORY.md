# Memory Index

- [Project Overview](project_overview.md) — DeltaPSU Laravel backend: multilingual product site with complex filtering, SEO redirects, and admin management
- [Tech Stack](project_tech.md) — Laravel 6, Blade, jQuery, Bootstrap, MySQL - key files and architecture
- [Database Schema](project_database.md) — Full table list, key relationships, product_has_property patterns, translation pattern
- [Data Flow](project_data_flow.md) — Controller → Blade flow for product listing, product detail, search, admin CRUD
- [Frontend JS](project_frontend.md) — Filter system, sort system, localStorage back-button behavior in product.blade.php
- [Admin CRUD](project_admin.md) — Admin create/edit/store/update flow, Part Number pattern, gotchas
- [Feedback](feedback.md) — Key behavioral rules: don't ask questions, no trailing summaries, don't change unrelated code

## Module Docs (`modules/`)
- [Product Module](modules/product.md) — ProductsController, 規格欄位, 篩選器, Part Number, EOL, 匯入
- [Frontend Module](modules/frontend.md) — FrontendController, 路由結構, product.blade JS, 多語系模式
- [Content Module](modules/content.md) — 新聞/活動/FAQ/技術文章/影片/行銷資源/靜態文字
- [Users & Auth](modules/users-auth.md) — BackendUserController, Auth, role 控制
- [Partners Module](modules/partners.md) — 合作夥伴帳號/文件/排程/Banner/訂閱者
- [Site Config](modules/site-config.md) — 語系管理, SEO meta, 辦公室/據點, Email 模板
- [Middleware & Redirect](modules/middleware-redirect.md) — CsvRedirectMiddleware, redirect_map, 所有 middleware 說明
- [Document Module](modules/documents.md) — DucumentController, 文件分類, 多語系檔案, SpecialLang, 商品文件關聯
- [Import/Export Module](modules/import-export.md) — ImportController, ImportTagsController, 批次匯入匯出
- [Configurable Product](modules/configurable-product.md) — 配置型商品, Parallel Connection, Connector Image, 詢價
- [Product Listing & Detail](modules/product-listing-detail.md) — productList/productsDetailsByType 完整查詢流程、JS 篩選排序、Blade 變數對照
