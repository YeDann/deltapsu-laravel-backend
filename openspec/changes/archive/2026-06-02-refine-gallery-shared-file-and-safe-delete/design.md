## Context

行銷資源編輯表單（`MarketResource/edit.blade.php`）為所有分類共用。原本逐語系 file input 讓各語系檔分歧；且各語系常共用同一實體檔，逐語系刪除會誤刪共用檔。Product Images / Videos 分類以英文名定位（`whereIn('name', ['Product Images','Product Images / Videos'])`）。

## Goals / Non-Goals

**Goals:**
- Product Images / Videos 編輯用一個共用檔（套用所有語系），避免分歧；其他分類不受影響。
- 刪除/換檔不誤刪仍被引用的共用檔。

**Non-Goals:**
- 不改其他分類的逐語系編輯行為。
- 不改前台 `product-images-gallery` 顯示（本變更只動後台編輯/刪除）。

## Decisions

- **以 `$isGallery` 旗標（cate 是否為 Product Images / Videos）在共用的 edit 表單分流**：gallery 顯示單一 file input（hidden `file_uploaded` 單值、單一 oldfile），其他分類維持逐語系（`file_uploaded[locale]`）。`update()` 以 `is_array($uploaded)` 判斷：陣列→逐語系（`applyChunkedFiles`），字串→共用檔套用所有語系。`removefileMargeting` 對 gallery 清除所有語系引用。如此其他分類零影響。
- **刪除統一走 `deleteOrphanFiles`**：先確認 `marketing_resource_translations` 中已無任何列引用該檔，才 `deleteResourceFile`（刪檔 + 影片同名縮圖）。`update`（換檔後）、`removefileMargeting`（移除後）皆用之；`destroy`（整筆刪除）直接刪（記錄連同所有語系一起刪）。

## Risks / Trade-offs

- [既有資料各語系檔名分歧（歷史遺留）] → 已修復 cate-6 測試資料；新行為避免再分歧。
- [`is_array($uploaded)` 區分 gallery/其他] → 表單欄位名決定（`file_uploaded` vs `file_uploaded[locale]`），與 `$isGallery` 一致。

## Migration Plan

純程式 + spec 同步，無 DB schema 變更。Rollback：還原相關檔。

## Open Questions

無。
