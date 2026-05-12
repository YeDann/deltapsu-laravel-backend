## ADDED Requirements

### Requirement: Allow filecenter.deltaww.com as image source
CSP `img-src` 指令 SHALL 包含 `https://filecenter.deltaww.com`，允許瀏覽器從該域名載入圖片而不觸發 CSP 違規。

#### Scenario: Image from filecenter.deltaww.com loads successfully
- **WHEN** 頁面包含來自 `https://filecenter.deltaww.com` 的 `<img>` 標籤
- **THEN** 瀏覽器不應產生 CSP violation，圖片正常顯示

#### Scenario: Other deltaww.com subdomains remain blocked
- **WHEN** 頁面包含來自 `https://other.deltaww.com`（非 filecenter）的圖片
- **THEN** 瀏覽器應因 CSP 限制而封鎖該圖片（未明確開放的子域名不受影響）
