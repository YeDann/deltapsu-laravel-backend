## ADDED Requirements

### Requirement: 後台行銷資源分塊上傳與重組

後台 Marketing Resources **新增與編輯**表單 MUST 以分塊上傳（resumable.js + `pion/laravel-chunk-upload`，共用 JS 模組）將檔案分塊 POST 至受保護的 `MarketResource.chunk` 端點（須通過後台 auth 與 CSRF）。伺服器 MUST 在收齊所有 chunk 後重組為完整檔、move 至行銷資源目錄（沿用既有檔名格式），並回傳最終檔名。表單 MUST 以最終檔名送出（新增為 `file_uploaded`、編輯為逐語系 `file_uploaded[locale]`），`store`/`update` MUST 以此檔名建立/更新記錄，**不再於表單 POST 夾帶檔案本體**。每個 chunk MUST 夠小（約 1MB），使單一請求不觸及 `post_max_size`／`upload_max_filesize`／nginx `client_max_body_size` 上限，從而支援最高 2GB 而**無需將伺服器單一上限拉到 2GB**。檔型 MUST 不限（圖片／影片／PDF／ZIP）；最終檔名 MUST 經 basename 處理防路徑穿越。

#### Scenario: 分塊上傳大檔成功（新增）
- **WHEN** 管理者於新增表單選擇一個大檔（如數百 MB 影片）
- **THEN** 檔案分塊上傳，伺服器收齊後重組存檔並回傳檔名，送出表單即建立含該檔的記錄

#### Scenario: 編輯換檔（逐語系）
- **WHEN** 管理者於編輯表單某語系 tab 選擇新檔上傳
- **THEN** 該語系以新檔取代並刪除舊檔（與其縮圖）；未換檔的語系沿用原檔

#### Scenario: 免拉高伺服器單一上限
- **WHEN** 伺服器 `post_max_size`/`upload_max_filesize` 維持小值（如 8M/2M）
- **THEN** 因每塊約 1MB，大檔仍可成功上傳，不出現 413 PostTooLarge

#### Scenario: 未選檔維持非必填
- **WHEN** 管理者未選擇任何檔案即送出表單
- **THEN** 維持「檔案非必填」原行為（新增建立不含檔案的記錄；編輯沿用原檔）

### Requirement: 上傳進度與送出防呆

上傳期間 MUST 顯示進度（進度條）。**上傳完成前 MUST 禁止送出表單**；已選檔但尚未上傳完成即嘗試送出 MUST 被擋下並提示。多個檔案輸入（編輯的逐語系）時 MUST 等所有進行中的上傳完成才解鎖送出。上傳失敗 MUST 提示可重試。

#### Scenario: 顯示上傳進度
- **WHEN** 檔案正在分塊上傳
- **THEN** 介面顯示上傳進度百分比

#### Scenario: 未傳完擋下送出
- **WHEN** 有任一檔案上傳尚未完成，管理者按下送出
- **THEN** 送出被擋下並提示「檔案尚未上傳完成」

#### Scenario: 全部完成後可送出
- **WHEN** 所有進行中的分塊上傳完成、最終檔名已寫入表單
- **THEN** 送出鈕恢復可用，表單正常送出

### Requirement: 影片縮圖瀏覽器端產生

上傳影片（mp4/webm/mov）時 MUST 於瀏覽器端以隱藏 `<video>` + `<canvas>` 擷取一幀、輸出小 JPEG，並上傳至受保護的 `MarketResource.poster` 端點存為「影片同名 .jpg」（免伺服器 ffmpeg）。擷取與分塊上傳何者先完成 MUST 由後完成者觸發縮圖上傳（避免競態）。擷取所需的瀏覽器端 `blob:` 媒體 MUST 被 CSP `media-src` 允許。

#### Scenario: 上傳影片產生縮圖
- **WHEN** 管理者上傳一支可由瀏覽器解碼的影片
- **THEN** 瀏覽器擷取一幀並上傳，伺服器存為該影片同名 .jpg，前台據此顯示 poster

#### Scenario: 無法擷取時不影響上傳
- **WHEN** 瀏覽器無法解碼該影片（如部分瀏覽器的 mov）
- **THEN** 影片仍正常上傳，僅無縮圖（前台優雅退回）

### Requirement: 刪除與換檔清理

刪除行銷資源或編輯換檔時 MUST 一併刪除該檔；若為影片，MUST 一併刪除其同名縮圖（.jpg），避免孤兒檔。

#### Scenario: 刪除影片連同縮圖
- **WHEN** 管理者刪除一筆影片行銷資源
- **THEN** 影片檔與其同名 .jpg 縮圖皆被刪除

#### Scenario: 換檔清理舊檔
- **WHEN** 編輯時以新檔取代某語系的舊影片
- **THEN** 舊影片檔與其舊縮圖被刪除
