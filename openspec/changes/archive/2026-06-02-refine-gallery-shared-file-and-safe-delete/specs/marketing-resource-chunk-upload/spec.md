## MODIFIED Requirements

### Requirement: 後台行銷資源分塊上傳與重組

後台 Marketing Resources **新增與編輯**表單 MUST 以分塊上傳（resumable.js + `pion/laravel-chunk-upload`，共用 JS 模組）將檔案分塊 POST 至受保護的 `MarketResource.chunk` 端點（須通過後台 auth 與 CSRF）。伺服器 MUST 在收齊所有 chunk 後重組為完整檔、move 至行銷資源目錄（沿用既有檔名格式），並回傳最終檔名。

最終檔名的套用 MUST 依分類分流：**Product Images / Videos 分類採「一個共用檔」**——編輯表單只出現一個 file input、最終檔名為單一 `file_uploaded`，`update` MUST 將其套用至**所有語系**（名稱仍逐語系）；**其他分類採逐語系**——最終檔名為 `file_uploaded[locale]`，`update` MUST 逐語系套用。`store`/`update` MUST 以最終檔名建立/更新記錄，**不再於表單 POST 夾帶檔案本體**。每個 chunk MUST 夠小（約 1MB），使單一請求不觸及 `post_max_size`／`upload_max_filesize`／nginx `client_max_body_size` 上限，從而支援最高 2GB 而**無需將伺服器單一上限拉到 2GB**。檔型 MUST 不限（圖片／影片／PDF／ZIP）；最終檔名 MUST 經 basename 處理防路徑穿越。

#### Scenario: 分塊上傳大檔成功（新增）
- **WHEN** 管理者於新增表單選擇一個大檔（如數百 MB 影片）
- **THEN** 檔案分塊上傳，伺服器收齊後重組存檔並回傳檔名，送出表單即建立含該檔的記錄

#### Scenario: 編輯換檔 — Product Images / Videos（共用檔）
- **WHEN** 管理者於 Product Images / Videos 的編輯表單（單一 file input）上傳新檔
- **THEN** 換檔套用至**所有語系**（各語系指向同一新檔），不會只更新單一語系造成分歧

#### Scenario: 編輯換檔 — 其他分類（逐語系）
- **WHEN** 管理者於非 Product Images / Videos 分類的編輯表單某語系 tab 上傳新檔
- **THEN** 該語系以新檔取代，未換檔的語系沿用原檔

#### Scenario: 免拉高伺服器單一上限
- **WHEN** 伺服器 `post_max_size`/`upload_max_filesize` 維持小值（如 8M/2M）
- **THEN** 因每塊約 1MB，大檔仍可成功上傳，不出現 413 PostTooLarge

#### Scenario: 未選檔維持非必填
- **WHEN** 管理者未選擇任何檔案即送出表單
- **THEN** 維持「檔案非必填」原行為（新增建立不含檔案的記錄；編輯沿用原檔）

### Requirement: 刪除與換檔清理

刪除行銷資源、編輯換檔、或移除檔案（垃圾桶）時 MUST 清理不再需要的實體檔（影片連同同名 .jpg 縮圖），但 MUST **僅在該實體檔已無任何語系/記錄引用時才刪除實體檔**，避免誤刪多語系共用的同一檔。Product Images / Videos 的移除（垃圾桶）MUST 先清除**所有語系**對該檔的引用，再依此判斷刪除；整筆刪除資源時連同所有語系一起刪除，該檔即可移除。

#### Scenario: 刪除整筆資源連同縮圖
- **WHEN** 管理者刪除一筆影片行銷資源
- **THEN** 影片檔與其同名 .jpg 縮圖皆被刪除

#### Scenario: 換檔/移除後無其他引用才刪
- **WHEN** 換檔或移除後，某舊實體檔已無任何語系/記錄引用
- **THEN** 刪除該舊檔與其同名縮圖

#### Scenario: 仍被引用則不刪（共用安全）
- **WHEN** 換檔或移除後，該實體檔仍被其他語系/記錄引用
- **THEN** 不刪除該實體檔（避免破壞仍在使用它的語系/記錄）
