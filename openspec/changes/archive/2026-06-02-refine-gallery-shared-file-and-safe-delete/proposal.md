## Why

`add-marketing-resource-video-and-chunk-upload` 封存後，依實測回饋追加兩項調整：（1）行銷資源是「一個檔給所有語系共用」，逐語系編輯會造成各語系媒體分歧、換語系顯示不一致；（2）行銷資源各語系常共用同一實體檔，原本「換檔/移除即刪實體檔」會誤刪其他語系還在用的檔。需更新 `marketing-resource-chunk-upload` spec 以反映現況。

## What Changes

- **Product Images / Videos 編輯改「一個共用檔」**：該分類編輯表單只出現一個 file input，換檔套用**所有語系**（名稱仍逐語系）；**其他分類維持逐語系**檔不變。
- **刪除/換檔改「孤兒安全刪除」**：移除檔案（垃圾桶）、換檔、刪除資源時，僅在**已無任何語系/記錄引用**該實體檔時才刪除實體檔（與其同名縮圖），避免誤刪共用檔。Product Images / Videos 的垃圾桶會清除所有語系的引用。

## Capabilities

### New Capabilities

（無）

### Modified Capabilities

- `marketing-resource-chunk-upload`：修正「分塊上傳與重組」（gallery 共用檔 vs 其他逐語系）與「刪除與換檔清理」（孤兒安全刪除）兩條 requirement，以符合實作。

## Impact

- 影響範圍：**Admin CRUD**（行銷資源編輯/刪除）。
- 受影響檔案：
  - `dependencies/app/Http/Controllers/MarketResourceController.php`（`edit` 帶 `$isGallery`、`galleryCateId`、`update` 共用檔/逐語系分支、`removefileMargeting` gallery 清全語系、`deleteOrphanFiles` 孤兒檢查、`deleteResourceFile`）
  - `dependencies/resources/views/MarketResource/edit.blade.php`（`$isGallery` 條件：gallery 一個共用檔 / 其他逐語系）
- 既有 cate-6 測試資料已修復（各語系統一指到存在的檔）。純文件/spec 同步，無 schema 變更。
