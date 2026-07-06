## 1. Type 下拉跨類入口

- [x] 1.1 `productcoparison.blade.php` Type 下拉（`#proType` + `#proType_mobile`）新增跨類 option（value=`cross`、文字 `$staticContent['comparison_cross_industrial_medical']`）
- [x] 1.2 `chageProductType()` / `chageProductTypeMobile()` 已用 `$('#proType').val()` 傳 `typeId` → `cross` 直接帶給 `getProductByType`（不需改）

## 2. 跨類取產品 + 放寬加入

- [x] 2.1 `getProductByType`：`typeId==='cross'` → 取 `categories_has_main_pro.main_cateid IN (1,2)` 的所有 sub 之產品（distinct、enable、checkContentPro、pro_code 排序、含 optional models）
- [x] 2.2 `checkProductSection`：放寬 —— `$maybeCross`（該 sub 屬 main 1/2）控制；同 cate（`sameType`）或都屬 main 1/2（`crossOk`）才允許加入；其他 main 維持 `when(!$maybeCross)` 同 sub。`$data` 回傳（彈窗）跨類時回全清單。【附帶：產品列表頁「加入比較」入口也支援跨類】
- [x] 2.3 加更多來源 → **已由 Type 下拉 cross 選項 + `getProductByType('cross')` 涵蓋**（comparison 頁「加更多」就是切 Type → ajax 重填產品下拉，不需改初始 `$products`）

## 3. 文案 + 比較表

- [x] 3.1 `ComparisonCrossKeywordSeeder`：`comparison_cross_industrial_medical` static_keyword（6 語系，預設 `Industrial × Medical`，已跑）
- [x] 3.2 比較表渲染確認：`selectprocom1/2/3` 無類型檢查、`contentLoad`/`loadnewPerti` 以 `pd_field × product_has_property` 逐欄位取值 → 跨類產品缺的欄位自然留空（不需改）

## 4. 驗證

- [x] 4.1 cross 取產品資料驗證：涵蓋 Industrial(DIN/Panel/Open Frame/Adapter/Modules)+Medical(Open Frame/Enclosed/Adapter) 全部，不誤含 Battery/Configurable 特有 sub（使用者確認資料正確）
- [x] 4.2 同類維持原行為（`when(!$maybeCross)`）；LED/Battery/Configurable 特有 sub（cate 6/7/10）不在 crossCates
- [x] 4.3 `view:clear` + 跑 seeder 完成；comparison 頁 Type 下拉 cross 選項就位
- [x] 4.4 最終瀏覽器實測（選 cross → 產品下拉兩類 → 跨類比較表渲染 / 缺值留空）— 由使用者上線前實測
