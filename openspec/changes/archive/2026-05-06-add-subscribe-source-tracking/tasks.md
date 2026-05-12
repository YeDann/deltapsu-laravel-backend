## 1. 資料庫 Migration

- [x] 1.1 建立 migration：`php artisan make:migration add_source_to_subscribes_table --table=subscribes`
- [x] 1.2 在 `up()` 加入 `$table->string('source', 50)->nullable()->after('accept');`，`down()` 加入 `$table->dropColumn('source');`
- [x] 1.3 執行 `php artisan migrate` 確認 `source` 欄位成功加入

## 2. 路由

- [x] 2.1 在 `dependencies/routes/web.php` LaravelLocalization 路由群組內新增 `Route::post('/landing/subscribe', 'FrontendController@landingSubscribe')->name('landingSubscribe');`

## 3. Controller

- [x] 3.1 在 `FrontendController.php` 新增 `landingSubscribe(Request $request)` method：驗證 email 格式、查重複（`subscribes` 表 + Mailchimp）、DB insert（含 `'source' => 'din-rail'`）、Mailchimp subscribe，回傳 JSON `{"status":"success"}` / `{"status":"already"}` / `{"status":"error"}`
- [x] 3.2 修改 `subscribe()` method 的 `DB::table('subscribes')->insert()` 呼叫，加入 `'source' => 'web'`
- [x] 3.3 修改 `subCheckBox()` method 的 `DB::table('subscribes')->insert()` 呼叫，加入 `'source' => 'web'`

## 4. 活動頁 View

- [x] 4.1 在 `landing-din-rail-infinity-ready.blade.php` 的 `<head>` 加入 `<script>window._csrfToken = '{{ csrf_token() }}';</script>`
- [x] 4.2 將 Modal 的 `notify-submit-btn` click handler 改為 `fetch()` AJAX POST 到 `{{ route('landingSubscribe') }}`，帶 email 與 CSRF token（`X-CSRF-TOKEN` header）；成功後維持現有 `alert()` 行為

## 5. 驗證

- [x] 5.1 官網訂閱後確認 `subscribes` 表有 `source='web'`
- [x] 5.2 活動頁 Modal 訂閱後確認 `subscribes` 表有 `source='din-rail'`
- [x] 5.3 重複 email 送出活動頁 Modal，確認不重複寫入且 Modal 顯示對應提示
- [x] 5.4 確認 CSRF token 正確（不出現 419 錯誤）
