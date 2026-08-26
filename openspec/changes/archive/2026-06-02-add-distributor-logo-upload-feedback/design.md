## Context

經銷商 logo 走一般表單檔案上傳（`name="logo"`，於 store/update 存到 `medias/distributor`）。原本 logo file input 少了 `data-toggle="custom-file-input"`（旁邊的 filecer 有），故選檔無檔名、無預覽；超過 `upload_max_filesize` 的檔被 PHP 默默丟掉、無提示。

## Goals / Non-Goals

**Goals:**
- 選 logo 有即時回饋（檔名、縮圖預覽）、超過上限即時提醒。
- 前台卡片 logo 放大到合適尺寸。

**Non-Goals:**
- 不改 logo 存檔機制、不做分塊上傳（logo 為小檔，調主機上限即可）。
- 不改其他分類/欄位行為。

## Decisions

- **縮圖預覽用 FileReader → data URL**（非 `blob:`）：CSP `img-src` 已允許 `data:`，免動 CSP。
- **超限門檻由後端帶入**：blade 以 `ini_get('upload_max_filesize')` 換算 bytes 傳給前端 JS（`max`），故調整伺服器上限後前端門檻自動同步，不會對不上。超限時 `alert` + 清除 input + 還原 label。
- **前台 `.fd-logo`** 純 CSS 調 `max-height`（44→96px）/`max-width`。

## Risks / Trade-offs

- [前端 JS 檢查可被繞過] → 屬即時回饋，非安全控制；伺服器端本就會丟超大檔（只是原本無提示）。
- [實際能傳多大仍受 `upload_max_filesize` 限制] → 屬主機設定，需 ops 配合。

## Migration Plan

純前端/CSS，無 DB 變更。Rollback：還原相關 blade。

## Open Questions

無。
