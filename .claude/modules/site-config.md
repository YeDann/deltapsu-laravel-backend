# 網站設定模組 (Site Config Module)

## 概覽
語系管理、SEO、辦公室/分銷商據點、Email 模板與通知記錄、靜態文字、應用情境。

---

## Controllers

### `LanguageController`
多語系管理（最重要的設定功能）。
- `index()` — 語系列表
- `create()` / `store()` — 新增語系
- `destroy($id)` — 刪除語系及所有翻譯資料
- `updateLangStatus($id)` — 啟用/停用
- `copyToLang($newlang)` — 語系複製介面（列出所有需複製的 table）
- `copyDataActionReq()` — AJAX，逐 table 複製翻譯（en → 新語系）

> **重要**: 新增語系後需手動觸發複製，否則新語系無任何內容。

### `MetaTagController`
SEO meta tag 管理。
- `index()` — 所有頁面 meta 列表
- `create()` / `store()` — 新增（title、description、H1 per 語系）
- `edit($id)` / `update()` — 更新
- `deleteMeta()` — 刪除

### `ContinentsController`
銷售辦公室/分銷商 — 洲別/地區。
- `index($type)` — 依類型（sales/distributors）列出洲別
- `create($id)` / `store()` — 新增
- `edit($id, $type_id)` / `update()` — 編輯
- `destroy()` — 刪除
- `update_order_Continent()` — 排序

### `OfficeController`
個別辦公室/分銷商據點。
- `index($conId, $type_id)` — 某洲別據點列表
- `create($conId, $type_id)` / `store()` — 新增
- `edit($id, $conId, $type_id)` / `update()` — 編輯
- `destroy()` — 刪除
- `removefileCerDis($conId)` — 刪除認證圖檔

### `EmailController`
Email 通知模板 + GUI Download 記錄 + Feedback Form。
- `index($type)` — 依類型列出通知設定
- `create($type)` / `storeEmail()` — 新增模板
- `editEmail($type, $id)` / `UpdateEmail()` — 編輯
- `deleteEmailNotification()` — 刪除
- `getEmailNotificationList()` — AJAX 取得清單
- `importEmailNotification()` — 批次匯入通知設定
- `gui_dowload_index()` — GUI Download 下載記錄列表
- `exportGui()` — 匯出 GUI Download 記錄 Excel
- `feedbackform($type)` — Feedback Form 提交記錄
- `exportfeedbackFrom($type)` — 匯出 Feedback Form 記錄 Excel

### `StaticContentController`
靜態頁面內容（Privacy Policy、Terms of Use、FAQ banner、聯絡資訊）。
- `index($id)` — 依 `type_con_id` 篩選
- `store()` — 儲存
- `popUp($id)` — 彈窗內容管理
- `video_guidline()` — 合作夥伴影片說明
- `uploadtoTexteditor()` — 文字編輯器圖片上傳

### `StaticWordController`
UI 靜態文字管理（按鈕、標籤等）。
- `index()` / `static_edit($id)` / `update_staticword()` — 列表/編輯
- `static_create()` / `store_staticword()` — 新增

### `ApplicationView`
應用情境（use cases）管理。
- `index()` — 依使用者語系篩選列表
- `create()` / `store()` — 新增（含圖片）
- `edit($id)` / `update()` — 編輯
- `destroy($id)` — 刪除
- `copyAppsingle()` / `copyApp()` — 複製到新語系
- `relateApplication($id)` — 相關系列設定
- `addRelatedSeries()` / `deleteRelatedSeries()` — 管理關聯系列
- `update_order_application()` / `update_order_series()` — 排序
- `addMoreImage($id)` / `uploadImagemultiple()` / `deleteImage()` — 多圖管理

---

## Key Tables
| Table | 用途 |
|-------|------|
| `language` | 支援語系清單（控制前台可見語系）|
| `meta_tag` | SEO meta 設定 |
| `continents` | 洲別/地區 |
| `offices` | 據點資料 |
| `email_notification` | Email 模板 |
| `static_content` / `static_content_translations` | 靜態頁面內容 |
| `static_word` / `static_word_translation` | UI 文字 |
| `application` / `application_translation` | 應用情境 |

---

## 語系設定注意事項
- 支援語系：`en`, `tw`, `cn`, `de`, `jp`, `tr`
- `language` table 的 active 欄位控制前台顯示
- LaravelLocalization 負責 URL prefix 和語系切換
- 新增語系必須執行 copyToLang 才有內容
