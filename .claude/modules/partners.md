# 合作夥伴模組 (Partners Module)

## 概覽
合作夥伴帳號管理、Success Stories、文件分享（Sale Kit/Cross Reference）、產品發佈計畫、Banner 管理、電子報訂閱者。

---

## Controllers

### `PartnerController`
合作夥伴帳號 + Success Stories 管理。

#### 帳號管理
- `index()` — 合作夥伴列表
- `create()` / `store()` — 新增（含 email 驗證、role）
- `edit($id)` / `update()` — 編輯
- `destroy()` — 刪除
- `updatestatuspartner($id)` — 啟用/停用
- `ExportPartner()` — 匯出合作夥伴清單 Excel

#### Success Stories（後台管理）
- `successStory()` — Success Stories 列表
- `sucess_story_edit($id)` / `succes_stories_update()` — 編輯
- `sucess_story_view($id)` — 檢視
- `deteleteSuccessStories($id)` — 刪除
- `storyImage($id)` — 管理故事圖片
- `uploadImageStory()` — 上傳圖片
- `deleteImageStory_back()` — 刪除圖片

> Success Stories 前台由 FrontendController 處理（`/partners/marketing-resources/success-stories/...`），合作夥伴可自行新增/編輯。

### `PartnerDetailController`
產品發佈排程管理（Product Launch Schedule）。

#### 發佈計畫 (Launch Schedule)
- `pro_lauch()` — 排程列表
- `pro_lauch_create()` / `pro_lauch_store()` — 新增
- `pro_lauch_edit($id)` / `pro_lauch_update()` — 編輯
- `prolaunchDestroy()` — 刪除
- `launch_datail($id)` — 排程詳細項目列表
- `launch_datail_create($id)` / `store_launch_datail()` — 新增詳細項目
- `pro_lauch_DetailEdit($headId, $id)` / `update_launch_datail()` — 編輯
- `prolaunchdetailDelete()` — 刪除

#### 月份排程
- `schedules_month($id)` — 月份排程列表
- `store_schedule()` / `scheduleUpdate()` / `scheduleDelete()` — CRUD
- `edit_schedule($id)` — 編輯

### `PartnerDocumentController`
合作夥伴文件（Sale Kit、Product Cross Reference）。
- `index($id, $name)` — 依類型列表
- `create($typeId, $typeName)` / `store()` — 新增（含語系特定檔案上傳）
- `edit($id, $typeId, $typeName)` / `update()` — 編輯
- `deleteSaleKit()` — 刪除

### `PartnerPageController`
合作夥伴入口頁面內容。
- `index()` — 頁面資訊列表
- `page_info_edit($id)` / `part_page_update()` — 編輯
- `page_info_create()` / `store()` — 新增
- `deteletepartpage()` — 刪除

### `BannerSlideController`
首頁 Banner 輪播。
- `index()` — 依使用者語系篩選列表（`users.lang` 控制可見範圍）
- `create()` / `store()` — 新增
- `edit($id)` / `update()` — 編輯
- `destroy()` — 刪除
- `update_order_Banner()` — AJAX 拖曳排序

### `SubscribeController`
電子報訂閱者管理。
- `index()` — 訂閱者列表（分頁）
- `exportSubscribes()` — 匯出 Excel

---

## Key Tables
| Table | 用途 |
|-------|------|
| `partners` | 合作夥伴帳號 |
| `success_stories` / `success_stories_image` | Success Stories |
| `partner_documents` | Sale Kit / Cross Reference |
| `pro_launch` / `pro_launch_detail` | 產品發佈排程 |
| `banner_slide` / `banner_slide_translations` | 首頁 Banner |
| `subscribes` | 電子報訂閱者 |
