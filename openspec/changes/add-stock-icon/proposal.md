## 為什麼

Phase II 規劃在產品列表頁加入經銷商即時庫存查詢（對應投影片 6-8）。客戶已確認 **本階段先只做 UI**：在現有 Datasheet（下載）icon 右邊「加一顆 Stock icon」，沿用現有 icon-only 樣式與 tooltip，**不**改成投影片下方那種「icon＋文字」實心按鈕版本。

庫存資料來源（netCOMPONENT DILP API）的後端串接與庫存 Modal **不在本變更範圍**，將另開 change 處理（待 Delta 提供 API 帳密與料號規則）。本變更只負責把按鈕放上去並接好預留的點擊入口。

## 變更內容

- 產品列表頁三段 render（grid 桌機、grid 手機、list view）的按鈕列，各在 Datasheet 按鈕後新增一顆 Stock icon 按鈕，沿用既有 `img-btn-icon-pro` 樣式與 tooltip。
- 按鈕 `onclick` 接一個前端 stub 函式 `checkStock(proCode)`，本階段不執行實際查詢（預留給後續 DILP 串接 change），不影響頁面其他功能。
- 新增 `Stock` UI 文字標籤至 `static_keyword` / `static_keyword_translations`（六語系），供按鈕 tooltip 使用。
- 新增 Stock icon 圖檔至 `frontend-asset/image/`，風格對齊既有 `Compare.svg` / `Datasheet.svg`。

## 功能範圍

### 新功能

- `stock-icon`：產品列表頁商品卡片按鈕列，於 Datasheet 右邊新增 Stock icon 按鈕（純 UI，點擊入口預留）。

### 修改既有功能

（無 —— 僅在按鈕列新增一顆按鈕，不改動既有 Enquiry / Compare / Datasheet 行為；既有 `openspec/specs/` 下無相關 spec。）

## 影響範圍

本變更僅影響 **Frontend 頁面** 與一筆靜態文字資料，**無後端 Service／route／資料庫 schema 異動**。

- `dependencies/resources/views/front-end/product.blade.php`：三段 render 各加一顆 Stock 按鈕；新增 `checkStock()` stub 函式
- `dependencies/public/frontend-asset/image/`：新增 Stock icon 圖檔（如 `Stock.svg`）
- `static_keyword` / `static_keyword_translations` 資料表：新增 `key_word = Stock` 的六語系翻譯（透過後台 `StaticWordController` 或 seeder）
