## Why

`filecenter.deltaww.com` 的圖片因未列入 CSP `img-src` 白名單而被瀏覽器封鎖，導致部分頁面（如 Landing Page）的圖片無法正常顯示。

## What Changes

- 將 `https://filecenter.deltaww.com` 加入 CSP `img-src` 指令的允許來源清單。

## Capabilities

### New Capabilities

- `csp-filecenter-img-src`: 允許從 `filecenter.deltaww.com` 載入圖片，解除 CSP 封鎖。

### Modified Capabilities

<!-- 無現有 spec 需要修改 -->

## Impact

- **CSP 設定檔**（`ContentSecurityPolicy` middleware 或相關 HTTP header 設定）需新增 `filecenter.deltaww.com`。
- 影響所有使用 `filecenter.deltaww.com` 圖片的頁面。
- 不影響任何 API、資料庫或業務邏輯。
