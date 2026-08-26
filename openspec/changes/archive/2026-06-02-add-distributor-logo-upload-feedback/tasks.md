## 1. logo 上傳即時回饋

- [x] 1.1 `office/create.blade.php`、`office/edit.blade.php` logo input 加 `data-toggle="custom-file-input"`（顯示檔名）+ `accept="image/*"`
- [x] 1.2 加縮圖預覽（FileReader → data URL，CSP `img-src` 已允許 data:）
- [x] 1.3 超過 `upload_max_filesize`（後端 `ini_get` 換算 bytes 帶入前端）即時 alert + 清除選擇 + 還原 label；hint 顯示上限 MB

## 2. 前台卡片 logo 尺寸

- [x] 2.1 `find-distributor.blade.php` `.fd-logo` `max-height` 44→96px、`max-width` 200→300px

## 3. 驗證

- [x] 3.1 `view:cache` 全 blade 編譯通過
- [ ] 3.2 瀏覽器實測：選 logo 顯示檔名+預覽、選超大檔跳提醒、前台卡片 logo 尺寸合適（待使用者實測）
