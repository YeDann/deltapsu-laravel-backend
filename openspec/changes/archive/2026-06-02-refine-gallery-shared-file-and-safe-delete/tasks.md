## 1. Product Images / Videos 共用檔編輯

- [x] 1.1 `MarketResourceController::edit` 帶 `$isGallery`（以 `galleryCateId()` 判斷分類）
- [x] 1.2 `edit.blade.php`：`$isGallery` 時顯示單一共用 file input（hidden `file_uploaded`、單一 oldfile）；其他分類維持逐語系
- [x] 1.3 `update()`：`is_array($uploaded)` → 逐語系（`applyChunkedFiles`）；否則共用檔套用所有語系
- [x] 1.4 `removefileMargeting`：Product Images / Videos 清除所有語系引用；其他分類維持清單一語系

## 2. 孤兒安全刪除

- [x] 2.1 `deleteOrphanFiles`：確認 `marketing_resource_translations` 已無引用才 `deleteResourceFile`
- [x] 2.2 `update`（換檔後）、`removefileMargeting`（移除後）改用 `deleteOrphanFiles`；`destroy` 整筆刪直接刪

## 3. 驗證

- [x] 3.1 `php -l` 通過、`view:cache` 全 blade 編譯通過、`edit.blade` `@if/@endif` 平衡
- [x] 3.2 cate-6 既有測試資料修復（各語系統一指到存在的檔）
- [ ] 3.3 瀏覽器實測：Product Images / Videos 換檔全語系一起更新、垃圾桶清掉實體檔、換語系顯示一致（待使用者實測）
