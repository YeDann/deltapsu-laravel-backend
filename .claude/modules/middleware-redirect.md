# Middleware 與 Redirect 模組

## 概覽
HTTP 請求攔截、URL 正規化、批次跳轉、安全性處理。

---

## Middleware 一覽

### `CsvRedirectMiddleware` ← 自訂
批次 301/410 跳轉（最重要的自訂 middleware）。
- 在 global middleware 最前面執行（Kernel.php）
- 載入 `storage/app/redirect_map.php`（precompiled PHP array）
- 比對完整 URL：
  - `301` 命中 → `redirect($target, 301)`
  - `410` 命中 → `response()->view('errors.410', [], 410)`
  - 未命中 → `$next($request)`

**更新流程**：
```bash
# 修改 CSV 後重新產生
php artisan redirects:generate

# 驗證
php artisan test:csv-redirects
php artisan test:csv-redirects --url="https://..."
```

**相關檔案**：
- `storage/app/psu.deltaww.csv` — 來源 CSV
- `storage/app/redirect_map.php` — 編譯後的 PHP array（自動產生，不要手動改）
- `app/Console/Commands/GenerateRedirectMap.php` — 產生器
- `app/Console/Commands/TestCsvRedirects.php` — 測試工具

**redirect_map.php 結構**：
```php
return [
    '301' => ['https://old-url' => 'https://new-url', ...],
    '410' => ['https://gone-url' => true, ...],
];
```

---

### `VerifyLang`
驗證語系 prefix 有效性，無效語系 → redirect 到預設語系。

### `ModifyRedirects`
處理 URL 結尾斜線正規化。

### `SanitizeUrl`
清理/過濾 URL 特殊字元。

### `ContentSecurityPolicy`
注入 CSP headers。

### `Cors`
跨域請求設定。

### `HtmlMinifier`
壓縮 HTML 輸出。

### `RejectFatGetRequests`
拒絕過大的 GET 請求（防止 DoS）。

### `ShareData`
全域分享資料（如語系清單、靜態文字）到所有 views。

### `CheckForMaintenanceMode`
維護模式檢查（Laravel 標準）。

---

## Kernel.php 順序（Global Middleware）
```
CheckForMaintenanceMode
TrustProxies
CsvRedirectMiddleware   ← 自訂，最早執行
Cors
HtmlMinifier
...
```
