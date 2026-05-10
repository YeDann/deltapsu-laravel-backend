## 1. 資料庫 Migration

- [x] 1.1 建立 migration：`php artisan make:migration add_series_to_contacts_table --table=contacts`
- [x] 1.2 在 `up()` 加入 `$table->string('series', 100)->nullable()->after('model_name');`，`down()` 加入 `$table->dropColumn('series');`
- [x] 1.3 執行 `php artisan migrate` 確認 `series` 欄位成功加入

## 2. 路由

- [x] 2.1 在 `dependencies/routes/web.php` 語系群組外新增 `Route::post('/landing/contact', 'FrontendController@landingContact')->name('landingContact');`

## 3. Controller

- [x] 3.1 在 `FrontendController.php` 新增 `landingContact(Request $request)` method：驗證必填欄位（email、name、company、country）、寫入 `contacts` 表（series、subject 固定 `'DIN Rail Inquiry'`、type_name 固定 `'DIN Rail'`）、寄 `Contact` Mailable 通知信、回傳 JSON

## 4. 活動頁 View

- [x] 4.1 修改 `submitContactForm()` 中驗證通過後的邏輯：先執行 `fetch()` AJAX POST 到 `{{ route('landingContact') }}`，帶所有欄位與 CSRF token；成功（`status==='success'`）後才執行現有感謝頁邏輯；失敗時重新啟用按鈕

## 5. 驗證

- [x] 5.1 填寫完整欄位送出，確認 `contacts` 表有新資料且 `series` 正確
- [x] 5.2 選擇 DIN Pro 送出，確認 `contacts.series = 'din-pro'`
- [x] 5.3 未選產品送出，確認 `contacts.series` 為 null
- [x] 5.4 確認通知信有寄出
- [x] 5.5 確認送出失敗時按鈕重新啟用
