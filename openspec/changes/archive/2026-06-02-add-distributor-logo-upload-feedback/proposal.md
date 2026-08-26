## Why

後台經銷商（Distributors）編輯／新增表單的 logo 上傳原本沒有任何回饋：選檔後 label 不變、無預覽；且超過 `upload_max_filesize` 的檔被 PHP 默默丟掉、表單仍顯示成功，管理者誤以為上傳成功。前台結果卡的 logo 顯示也偏小。

## What Changes

- **logo 上傳即時回饋**：選檔後 MUST 顯示檔名（`data-toggle="custom-file-input"`）與**縮圖預覽**；限定 `accept="image/*"`。
- **超過上限即時提醒**：所選檔超過伺服器 `upload_max_filesize`（門檻由後端讀 ini 帶入前端）時 MUST 立即提醒並清除選擇，避免「以為成功其實被丟掉」。
- **前台卡片 logo 放大**：`.fd-logo` 顯示上限由 44px 調整為 96px（純 CSS）。

## Capabilities

### New Capabilities

（無）

### Modified Capabilities

- `distributor-filter`：「後台維護經銷商與分類」requirement 補上 logo 上傳的即時回饋（檔名/預覽/超限提醒）。

## Impact

- 影響範圍：**Admin CRUD**（經銷商編輯/新增 logo 上傳）與 **Frontend**（Find a Distributor 卡片 logo 尺寸）。純前端回饋/顯示，無 schema、無控制器存檔邏輯變更。
- 受影響檔案：
  - `dependencies/resources/views/office/create.blade.php`、`office/edit.blade.php`（logo input data-toggle/accept + 預覽 + 超限提醒）
  - `dependencies/resources/views/front-end/find-distributor.blade.php`（`.fd-logo` 尺寸）
- 注意：要實際上傳較大的 logo，仍需伺服器 `upload_max_filesize`/`post_max_size` 設足夠（屬主機設定）。
