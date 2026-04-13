# 配置型商品模組 (Configurable Product Module)

## 概覽
客製化/可配置商品管理，包含並聯連接設定（Parallel Connection）、接頭圖片（Connector Image）、配置歷史記錄、詢價管理。

---

## Controller: `ConfigurableProduct`

### 基本 CRUD
- `index()` — 配置型商品列表
- `createConfigProduct()` / `storeConfigProduct()` — 新增
- `editConfigProduct($id)` / `updateConfigProduct()` — 編輯
- `deleteConfigProduct()` — 刪除

### 並聯連接 (Parallel Connection)
- `ParallelCon($id)` — 某商品的並聯連接設定
- `storeParallel()` — 新增並聯
- `editParallel()` — 編輯
- `deleteParalle()` — 刪除

### 接頭圖片 (Connector Image)
- `connectorImage($id)` — 接頭圖片列表
- `create_connectorimage($id)` / `storeConnectorImage()` — 新增
- `edit_connectorimage($pro_id, $id)` / `updateConnectorImage()` — 編輯
- `deleteConnectorImage()` — 刪除

### 歷史記錄與匯出
- `getHistoryConfig()` — 配置歷史記錄列表
- `exportConfigable()` — 匯出配置記錄 Excel

### 詢價
- `getEnquiryContact()` — 詢價聯絡人列表

---

## 前台對應
- 前台路由：`/tools/configurable-product-selection` → `FrontendController@configurableProduct`
- 詳細頁：`/configurable-power/details` → `FrontendController@configurableProductDetail`
- 歷史記錄（合作夥伴）：`/partners/marketing-resources/configurable-history`

---

## 注意
ConfigurableProduct 比一般商品複雜：除了規格外，還有電氣連接邏輯（並聯）和實體接頭圖示。動到此模組時需了解這層關係。
