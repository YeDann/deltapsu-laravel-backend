## 1. 修改 CSP Middleware

- [x] 1.1 在 `app/Http/Middleware/ContentSecurityPolicy.php` 的 `img-src` 指令中新增 `https://filecenter.deltaww.com`

## 2. 驗證

- [x] 2.1 開啟包含 `filecenter.deltaww.com` 圖片的頁面，確認瀏覽器 console 不再出現 CSP violation 錯誤
