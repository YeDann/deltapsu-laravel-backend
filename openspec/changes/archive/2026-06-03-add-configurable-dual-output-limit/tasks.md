## 1. Dual 數上限驗證

- [x] 1.1 `maxDual` map（by `max_power`）`{700:3, 1200:3, 2100:2, 3000:3}` + `dualOutputMax()`（查不到回 Infinity 不誤限制）
- [x] 1.2 `countDualSlots()`：數所有 `input[name^="slot-type-"]:checked` 且 `value==2`
- [x] 1.3 `applyDualLimit()`：`count >= max` 時 disable 其餘**未選 Dual** slot 的 `#dual{i}` + label 灰；`count < max` 還原；依總數非順序
- [x] 1.4 掛載：`getSelecter()`、`addSlotOutput()`/刪 slot 後、frame（`#model`）change 後
- [x] 1.5 `var maxDualMap`/`dualLimitTpl` 定義須在 `selectionGenerate()` 之前（避免 var 未賦值 TypeError）

## 2. 多語說明文字（static_keyword，問號 tooltip）

- [x] 2.1 `ConfigurableDualLimitSeeder`：seed 1 筆 keyword `configurable_dual_limit_desc`（模板含 `{frame}`/`{n}`）6 語系（EN/DE/TC/SC/JP/TR，deck 文案）
- [x] 2.2 `addSlotOutput()` 在 Dual Output 旁加**問號 tooltip**（`<img tooltip.svg data-toggle="tooltip" title>`，比照既有 Option/Communication 問號）；`{frame}`=當前 `product_code`、`{n}`=上限帶入
- [x] 2.3 動態產生 slot 後 `.dual-limit-tip` re-init tooltip；切 frame 重建 slot 時內容隨之更新

## 3. 驗證

- [x] 3.1 各 frame（700A/1K2A/2K1A/3K0A）選 Dual 到上限→其餘 Dual 灰；改回 Single→恢復；切 frame 重算
- [x] 3.2 問號 tooltip 顯示各語系說明、frame/數字隨選擇變（使用者實測 OK）
- [x] 3.3 既有 single/dual 選擇、`checkSlotMax`、Next 按鈕不受影響
- [x] 3.4 `php artisan view:clear` + 跑 seeder 後瀏覽器實測（使用者確認 OK）

## 部署備註

- seeder（`database/seeds/` 無 namespace）跑法：`php artisan db:seed --class='\ConfigurableDualLimitSeeder'`（leading backslash，因 classmap autoload）
- UAT/正式需：跑此 seeder + `php artisan view:clear`
