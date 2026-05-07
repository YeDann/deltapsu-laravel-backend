## 1. 資料庫

- [x] 1.1 建立 migration（用 `php artisan make:migration create_landing_saleskit_requests_table`），欄位：id、name、email、company、phone（nullable）、locale、application、created_at（無 updated_at）

## 2. 後端 API

- [x] 2.1 在 `routes/web.php` 新增路由：`Route::post('/landing/saleskit-request', 'FrontendController@landingSkitRequest')->name('landingSkitRequest');`
- [x] 2.2 在 `FrontendController.php` 新增 `landingSkitRequest()` method：驗證 name/email/company/application 必填、application 白名單、寫入 DB、回傳 `{"status":"success","download_url":"/downloads/saleskit/<filename>"}`
- [x] 2.3 建立 `public/downloads/saleskit/` 目錄（加 `.gitkeep`）

## 3. Landing Page 前端

- [x] 3.1 在 `saleskit-form` 的 submit button 前插入隱私權核取方塊 HTML（`saleskit-privacy` checkbox + `saleskit-privacy-err` span）
- [x] 3.2 在所有語系的 translations 物件加入 `saleskit.privacyAgree` i18n key（en/tw/cn/ja）
- [x] 3.3 在 `setLang` 函式的 `data-i18n` 渲染邏輯中支援 `saleskit-privacy-label`（用 `data-i18n` attribute 即可）
- [x] 3.4 修改 `saleskit-form` 的 submit event handler：加入 privacy checkbox 驗證，改為 `fetch('{{ route("landingSkitRequest") }}')` 呼叫 API，成功後用 `<a download>` 觸發下載並關閉 modal
- [x] 3.5 在 blade 的 `<script>` 區加入 `window._locale = '{{ App::getLocale() }}'`，API 呼叫時帶入 locale

## 4. 後台管理

- [x] 4.1 建立 `app/Http/Controllers/SaleskitRequestController.php`（auth middleware、index 分頁、export CSV）
- [x] 4.2 在 `routes/web.php` admin 群組加入路由：`saleskit-requests/index` 和 `saleskit-requests/export`
- [x] 4.3 建立 `resources/views/saleskit-requests/index.blade.php`（繼承 `layouts.admin`，列表顯示所有欄位，含 Export CSV 按鈕）

## 5. 驗證

- [ ] 5.1 未勾選 privacy 時無法送出，確認錯誤提示顯示
- [ ] 5.2 正常填寫送出後確認 DB 有記錄，檔案下載觸發
- [ ] 5.3 後台 `/admin/saleskit-requests` 可看到列表
