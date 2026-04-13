# 匯入匯出模組 (Import/Export Module)

## 概覽
Excel/CSV 批次匯入商品資料、匯出各類報表。主要用於後台資料維護，非日常使用。

---

## Controller: `ImportController`

### 商品規格匯入
- `getExcelProduct()` / `importExel()` — 商品規格 Excel 匯入（product_has_property）
- `getExcelProductCerti()` / `importCertificate()` — 商品認證批次匯入
- `importProdoctCate()` — 商品分類批次匯入
- `importStatusProduct()` — 商品 status_product 批次更新

### 商品資料匯出
- `getExportProduct()` — 匯出商品清單 Excel
- `getExportProductSpecification()` — 匯出商品規格 Excel
- `getExportProductProperty()` — 匯出 product_has_property 資料
- `getExportProductImage()` — 匯出商品圖片清單

### 訂閱者
- `getpageSubscriber()` / `importSubscriber()` — 訂閱者批次匯入

---

## Controller: `ImportTagsController`

### Tags & Optional Model 匯入
- `getExcelProTag()` / `importProductTag()` — 商品 tag 批次匯入
- `getExcelProOptional()` / `importProductOptionalModel()` — 選配型號批次匯入

### 匯出
- `exports_tags()` — 匯出所有商品 tag
- `export_static()` — 匯出靜態文字

---

## 使用時機
- 大量商品上架時（搭配 Excel 模板）
- 舊資料 migration
- 產生 status 更新清單後批次套用
