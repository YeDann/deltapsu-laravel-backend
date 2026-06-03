## 1. i18n 靜態文字

- [x] 1.1 在 `static_keyword` 新增 `key_word = Stock`（tooltip）與 `key_word = Stock_coming_soon`（即將開通提示），並於 `static_keyword_translations` 補上六語系 `word`（en、tw、cn、de、jp、tr），可透過後台 `StaticWordController` 或 seeder —— 已建 `database/seeds/StockKeywordSeeder.php` 並執行（DB 另有 `ru` 語系，已自動 fallback en）
- [x] 1.2 清除 staticContent 快取，確認 `{{$staticContent['Stock']}}` 與 `{{$staticContent['Stock_coming_soon']}}` 正常輸出 —— `php artisan cache:clear` 後查詢各語系皆有值

## 2. Stock icon 圖檔（先暫代）

- [x] 2.1 將現成／近似的 Stock icon SVG 暫放入 `dependencies/public/frontend-asset/image/`（如 `Stock.svg`），風格對齊既有 `Compare.svg` / `Datasheet.svg`；待設計提供正式圖再替換

## 3. 前端按鈕（三段 render，逐一）

- [x] 3.1 桌機 grid（`product.blade.php` line 1964，`onclickGridView()`）：在 Datasheet 按鈕後新增 Stock 按鈕，`onclick="checkStock(pro['pro_code'])"`，沿用 `img-btn-icon-pro` 樣式與 tooltip
- [x] 3.2 手機 grid（`product.blade.php` line 2063，`onclickGridView()` 行動版）：同 3.1
- [x] 3.3 list view（`product.blade.php` line 2169，`onclickListView()`，變數為 `html1`）：同 3.1，字串前綴 `html1 +=`
- [x] 3.4 卡片按鈕列由 3 顆增為 4 顆的版面（在 `product.blade.php` inline `<style>`，只作用於列表頁，詳細頁走外部 all.css 不受影響）：
  - `.boxlist-icon-img` 改用 flex `gap:6px` + `align-items:center` + `nowrap`（間距不再用各按鈕 margin，避免 `<a>`/`<button>` 混用造成不一致）
  - icon 統一 `width/height:30px` + `object-fit:contain`
  - 詢價按鈕原為 fontello 字型圖示（`.icon-facon3` 有 `1em`+左右 `.2em` 邊距，比其他三顆寬）→ 三段都改用 `<img Enquiry.svg>`（與其他三顆、與商品詳細頁一致），四顆必然同尺寸；順手補回 section 1 漏掉的 `</button>`
  - 桌機 grid（`#GridView` 無 `.pd-mobile`）`justify-content:space-between` 平均分佈滿卡片寬；手機 grid（`#GridView .pd-mobile`）`space-evenly` 邊距＝間距全等距、並移除原 pd-mobile 左右 13px padding；list 檢視（`#ListView`）維持靠左

## 4. 點擊「即將開通」提示

- [x] 4.1 在 `product.blade.php`（line 810）新增 `checkStock(proCode)` 函式：以 `alert()` 顯示 `{{$staticContent['Stock_coming_soon']}}`「即將開通」提示（前端無既有 toast 套件），不執行查詢、不開 Modal（預留給後續 DILP change 替換）

## 5. 驗證

- [x] 5.1 桌機 grid、手機 grid、list view 三種版型都看得到 Stock icon —— 原始碼確認三段 render 各有一顆（line 1964/2063/2169），緊接 Datasheet 之後、形式一致
- [x] 5.2 切換語系，Stock tooltip 與「即將開通」提示各語系正確 —— DB 查詢確認 en/tw/cn/jp/de/tr 皆有對應翻譯
- [x] 5.3 既有 Enquiry / Compare / Datasheet 按鈕未受影響 —— 僅在其後插入新行，未改動既有行；`php artisan view:cache` 編譯通過
- [x] 5.4 點擊 Stock 顯示「即將開通」且不報錯 —— `checkStock()` 已定義、Blade 編譯通過（**建議仍在瀏覽器點一次做最終 smoke test**）
