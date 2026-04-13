# 內容模組 (Content Module)

## 概覽
網站內容管理，包含新聞、活動、FAQ、技術文章、產業 Know-How、影片、行銷資源、靜態文字等。結構大致相同：主表 + `_translation` 多語系表 + type 分類。

---

## Controllers

### `NewsController` / `NewstypeController`
新聞/部落格文章管理。
- NewsController: 列表、新增（含分類關聯）
- NewstypeController: 新聞分類定義，含顏色標記和排序

### `EventController`
活動管理。含日期區間、語系翻譯、圖片上傳。

### `FaqController` / `FaqCategoriesController`
FAQ 管理。
- FaqController:
  - `index()` — 列表，並自動更新 URL name
  - `order_faqs()` — 拖曳排序介面
  - `update_order_Faqs()` — AJAX 儲存排序
  - `create()` — 新增
- FaqCategoriesController: FAQ 分類 CRUD，含多語系

### `TechnicalController` / `TechnicalType`
技術文章/白皮書管理。
- TechnicalController: 依類型篩選、排序列表
- TechnicalType: 文章類型定義，含顏色和排序

### `IndustryKnowHowController` / `IndustryKnowHowTypeController`
產業 Know-How 文章管理（結構同 Technical）。

### `VideoController` / `VideoTypeController`
影片內容管理。
- VideoController: 列表、新增（含類型、縮圖上傳、語系翻譯）
- VideoTypeController: 影片分類定義，含顏色排序

### `MarketResourceController` / `MarketResourceCateController`
行銷資源管理（型錄、白皮書下載等）。
- MarketResourceController: 列表、新增（含檔案上傳）
- MarketResourceCateController: 資源分類 CRUD，含多語系

### `StaticContentController`
靜態頁面內容（Privacy Policy、Terms of Use、FAQ banner、聯絡資訊等）。
- `index()` — 依 `type_con_id` 篩選靜態內容
- `video_guidline()` — 合作夥伴影片說明內容
- `popUp()` — 彈窗內容管理

### `StaticWordController`
UI 靜態文字管理（按鈕、標籤、提示文字等）。
- `index()` — 所有關鍵字列表
- `static_edit()` / `update_staticword()` — 編輯多語系翻譯
- `static_create()` / `store_staticword()` — 新增

### `AboutUsController`
關於我們頁面內容管理。含語系翻譯。

---

## 共同結構模式

幾乎所有內容模組都遵循：
```
主表 (e.g., news)
  ↓ 1:N
翻譯表 (e.g., news_translations) — local 欄位區分語系
  ↓ 選配
類型表 (e.g., news_type) — 分類/顏色/排序
```

---

## Key Tables
| Table | 用途 |
|-------|------|
| `contents` / `contents_translations` | 新聞/活動/文章（共用） |
| `faq` / `faq_translation` | FAQ |
| `faq_categories` / `faq_categories_translation` | FAQ 分類 |
| `videos` / `videos_translations` | 影片 |
| `static_content` / `static_content_translations` | 靜態頁面 |
| `static_word` / `static_word_translation` | UI 靜態文字 |
| `market_resource` | 行銷資源 |
| `application` / `application_translation` | 應用情境 |
