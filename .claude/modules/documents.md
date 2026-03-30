# 文件模組 (Document Module)

## 概覽
商品文件（Datasheet、Manual、Certificate 等）的完整管理，包含分類、多對多關聯、特殊語系設定。

---

## Controller: `DucumentController`

### 文件列表/篩選
- `index()` — 所有文件列表
- `docFilerBy($value)` — 依分類篩選
- `getDucumentType()` — 取得文件類型
- `getDocument($id)` — 取得單一文件

### 文件分類 (Document Categories)
- `index_categories()` — 分類列表
- `createProDocCategories()` / `storedocCategories()` — 新增分類
- `editProDocCategories($id)` / `updateDocCategories()` — 編輯
- `deletedocCategories()` — 刪除

### 文件 CRUD
- `createDocMutidoc()` — 新增多語系文件（主要新增介面）
- `editDocMutidoc($id)` — 編輯
- `storeProdoc()` — 儲存文件（含多語系檔案上傳）
- `updateProdoc()` — 更新
- `deleteproDoc()` — 刪除文件
- `removefileDoc($lang, $id)` — 刪除特定語系檔案

### 商品 ↔ 文件 關聯
- `storeProDocuments()` — 建立商品文件關聯
- `deleteproHasDoc()` — 刪除關聯
- `createProdocuments()` — 建立關聯（另一介面）
- `searhModelProductByCatedoc()` — AJAX，依分類搜尋商品

### 特殊語系 (Special Language)
某些文件需要特殊語系規則（如特定國家用不同語言版本）。
- `SpecialLang()` — 特殊語系設定列表
- `store_spelang()` / `Update_spelang()` — 新增/更新
- `deleteSpecailLang()` — 刪除

---

## Key Tables
| Table | 用途 |
|-------|------|
| `documents` | 文件主表（含多語系檔案路徑） |
| `doc_categories` | 文件分類 |
| `product_has_documents` | 商品 ↔ 文件 M:N |
| `special_lang` (推測) | 特殊語系設定 |

---

## 注意
- 文件有分類（Datasheet/Manual/Certificate 等），docFilerBy 用分類 id 篩選
- 一個文件可有多語系版本（不同語言不同檔案）
- SpecialLang 機制較特殊，動到時先確認現有設定
