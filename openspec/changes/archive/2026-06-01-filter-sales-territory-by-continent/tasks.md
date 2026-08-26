## 1. Controller 過濾與清理

- [x] 1.1 `OfficeController::distributorCategories()` 加入 `$conid = null` 參數（含 docblock 說明）
- [x] 1.2 泛型迴圈加 `->when($t === 'distributor_sales_territory' && $conid, fn → where('c.continent_id', $conid))` 過濾
- [x] 1.3 移除 distributor_sales_territory 專屬查詢（`continents`／`continents_translations` leftJoin、`region` 別名、`orderBy('cont.order_seq')`、覆寫迴圈結果的重複 query）
- [x] 1.4 `create()` 與 `edit()` 兩處呼叫改為 `distributorCategories($conid)`

## 2. Blade 平鋪呈現

- [x] 2.1 `office/create.blade.php`：移除 Sales Territory 的 `@if($g['field'] === 'distributor_sales_territory')` groupBy 分組分支，改與其他四類一致的平鋪 inline checkbox
- [x] 2.2 `office/edit.blade.php`：同上

## 3. 驗證

- [x] 3.1 `php -l app/Http/Controllers/OfficeController.php` 無語法錯誤
- [x] 3.2 模擬過濾結果正確：Americas(conid=2)→US/Mexico、Europe(conid=4)→歐洲全列、Korea(conid=9)→Korea
- [x] 3.3 兩 blade `@foreach`/`@endforeach`、`@if`/`@endif` 標籤平衡，無 groupBy/region 殘留
