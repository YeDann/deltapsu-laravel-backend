## 背景

`subscribes` 資料表目前有 `id`、`country_name`、`name`、`email`、`accept`、`created_at`，沒有來源欄位。訂閱的寫入有兩個路徑：
1. `subscribe()` method：官網訂閱表單（有 reCAPTCHA、name、country），回傳 redirect
2. `subCheckBox()` method：其他觸發點（如 GUI 下載）

活動頁 Modal 目前的送出邏輯只有前端驗證，成功後 `alert()` 了事，沒有實際打後端。

## 目標 / 非目標

**目標：**
- `subscribes` 表新增 `source` 欄位，記錄 `'web'` 或 `'din-rail'`
- 官網兩個 insert 點寫入時固定帶 `'source' => 'web'`，不依賴前端傳值
- 活動頁 Modal 真正送資料到後端，帶 `source='din-rail'`
- 活動頁訂閱共用核心邏輯（DB insert + Mailchimp）

**非目標：**
- 修改 `subscribe.blade.php`（官網 view 完全不動）
- 為活動頁加 reCAPTCHA
- 修改 Mailchimp 設定或後台訂閱管理介面

## 技術決策

### 1. Migration 新增 `source` 欄位

```sql
ALTER TABLE subscribes ADD COLUMN source VARCHAR(50) NULL DEFAULT NULL;
```

欄位設 nullable，舊資料 source 維持 NULL，不影響現有查詢。

### 2. 官網 source 硬寫在 Controller，不從前端傳入

`subscribe()` 與 `subCheckBox()` 的 insert 直接寫 `'source' => 'web'`，不讀 `$request->source`。

**原因**：不需要前端配合，也避免前端被竄改（例如惡意傳 `source=din-rail`）。官網永遠就是 `web`，沒有例外。

### 3. 活動頁新增專用路由與 Method

現有 `subscribe()` 回傳 `redirect()->back()`，不適合 AJAX。若共用路由需改動現有 method 才能同時支援 redirect 和 JSON，增加破壞風險。

**決策**：新增獨立路由與 method：
- `POST /{lang}/landing/subscribe` → `FrontendController@landingSubscribe`
- 只需要 `email`，不做 reCAPTCHA，回傳 JSON
- 核心邏輯（重複檢查 + DB insert + Mailchimp）與現有 method 相同

### 4. 活動頁 Modal 改為 AJAX 送出

用 `fetch()` POST，CSRF token 從 Blade 注入 JS 變數：

```blade
<script>window._csrfToken = '{{ csrf_token() }}';</script>
```

成功後在 Modal 內顯示提示文字，替換現有 `alert()`。失敗顯示錯誤訊息，表單維持開啟。

## 風險 / 取捨

- **風險**：活動頁沒有 reCAPTCHA，可能被 spam → 暫時接受，之後可補 honeypot 或 rate limiting
- **風險**：CSRF 419 → 用 `{{ csrf_token() }}` 確保 token 正確傳遞

## 部署計畫

1. 跑 `php artisan migrate`
2. 部署程式碼（路由、controller、landing page view）
3. 官網訂閱 view 不動，零風險
