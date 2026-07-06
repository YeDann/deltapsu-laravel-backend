## 背景

產品列表頁 `product.blade.php`（~5000 行）的商品卡片按鈕列（Enquiry / Compare / Datasheet）由 JS 組 HTML 字串產生，**共有三段重複的 render**：

- `onclickGridView()` 桌機 grid（按鈕列約 `product.blade.php:1955-1957`）
- `onclickGridView()` 手機 grid（按鈕列約 `product.blade.php:2053-2055`）
- `onclickListView()` list view（按鈕列約 `product.blade.php:2158-2160`，變數為 `html1`）

三段都要同步加 Stock 按鈕，否則桌機／手機／list 其中一種會漏（本專案 blade 的已知地雷）。

既有按鈕字串範例（Datasheet）：
```js
html += '<a href="{{route('downloadFIle')}}/Datasheet/'+productKey(pro['pro_code'])+'" target="_blank" ><button class="btn img-btn-icon-pro tooltip2"><span>{{$staticContent['data_sheet']}}</span><img src="{{asset('/frontend-asset/image/Datasheet.svg')}}"></button></a>';
```

staticContent 標籤實際來源（已查 `app/Http/Middleware/ShareData.php:150`）：表 `static_keyword` + `static_keyword_translations`（join `key_word`，值在 `word` 欄），有 `Cache::remember` 快取層；後台 `StaticWordController` 可新增。注意專案文件寫的表名（`static_content` / `static_word`）是過時錯誤，**以程式碼為準**。

## 目標 / 非目標

**目標：**
- 產品列表三段 render 的 Datasheet 按鈕右邊各新增一顆 Stock icon，沿用 `img-btn-icon-pro` 樣式與 tooltip。
- 按鈕點擊入口（`checkStock()` stub）預留好，方便後續 DILP change 直接接上。

**非目標：**
- 不串接 DILP API、不做庫存 Modal、不新增任何後端 route／Service／設定（另開 change）。
- 不把按鈕改成「icon＋文字」實心按鈕版本（客戶明確否決）。
- 不改動既有 Enquiry / Compare / Datasheet 按鈕的行為。
- 不在產品詳細頁加 Stock。

## 技術決策

### 1. 按鈕沿用既有 `img-btn-icon-pro` 樣式

直接複製 Datasheet 按鈕結構，換 icon 與 tooltip 文字、把 `<a>` 外層拿掉改為按鈕觸發：
```js
html += '<button onclick="checkStock(\'' + pro['pro_code'] + '\')" class="btn img-btn-icon-pro tooltip2"><span>{{$staticContent['Stock']}}</span><img src="{{asset('/frontend-asset/image/Stock.svg')}}"></button>';
```
list view 該段變數為 `html1`，需對應改前綴。三段字串前後文相近，Edit 時需帶足夠唯一前後文以免誤改。

### 2. 點擊顯示「即將開通」提示

本階段 `checkStock(proCode)` 不執行查詢、不開庫存 Modal，僅向使用者顯示「即將開通」提示（多語，見決策 3）。後續 DILP change 只需替換此函式內容為實際查詢與 Modal，按鈕標記不必再動。提示方式採輕量做法（如既有 toast／alert 樣式），不另建庫存 Modal。

### 3. i18n 標籤

於 `static_keyword` 新增兩個 key（六語系 en、tw、cn、de、jp、tr 各補 `word`）：
- `Stock` —— 按鈕 tooltip 文字
- `Stock_coming_soon` —— 點擊時的「即將開通」提示文字

blade 以 `{{$staticContent['Stock']}}` 取用；新增後需清 staticContent 快取才生效。

### 5. 第 4 顆按鈕的版面修正（實作時發現）

列表卡片按鈕列原本 3 顆剛好填滿 `col-md-4` 窄卡片寬度（每顆 icon 34px + padding + `margin-right:10px` ≈ 46px，`.boxlist-icon-img` 為 `display:flex` 不換行）。加第 4 顆 Stock 後超出卡片。`.img-btn-icon-pro` / `.boxlist-icon-img` 為全域 class，商品詳細頁也用（且詳細頁在寬版面、還可能有 ec 自訂按鈕，本來就多顆、不會爆）。

**決策**：把規則寫進 `product.blade.php` 的 inline `<style>`（只在列表頁載入），不動全域 all.css，詳細頁完全不受影響。

注意：按鈕列裡詢價、下載外層包 `<a>`，比較、Stock 為裸 `<button>`，若把間距 `margin-right` 加在 `.img-btn-icon-pro`（button）上，因部分 button 在 `<a>` 內、部分不在，flex 子元素（`<a>` vs `<button>`）間距會不一致，視覺呈現 2+2 / 3+1 分組且未對齊。

**做法**：間距改用 flex 容器的 `gap`（對所有 flex 子元素一致，不論 `<a>` 或 `<button>`），並加 `align-items:center` 對齊、`flex-wrap:nowrap` 防換行；各按鈕 `margin-right:0`；icon 34→30px。4 顆約 146px，可容於最窄卡片（`col-md-4`），四顆一起縮、彼此一致。

### 4. Stock icon 圖檔（先暫代）

Stock 按鈕做成與旁邊三顆（Enquiry / Compare / Datasheet）**完全一樣的形式**（`img-btn-icon-pro` + `<img>` SVG + tooltip）。icon 圖本階段**先用現成／近似的 SVG 暫代**放入 `public/frontend-asset/image/`（如 `Stock.svg`），尺寸風格對齊 `Compare.svg` / `Datasheet.svg`；待設計提供正式圖再替換檔案即可，不需改動按鈕程式。

## 風險 / 取捨

- **風險**：三段 render 漏改其一 → 因應：tasks 拆成桌機／手機／list 三個獨立任務，逐一驗證。
- **風險**：Stock icon 圖檔尚未由設計提供 → 因應：可先用既有近似 icon 暫代，圖到位再替換；不阻擋按鈕邏輯。
- **取捨**：按鈕點了暫不查庫存 → 已決定顯示「即將開通」提示，使用者不會誤以為壞掉；DILP change 上線時替換 `checkStock` 內容即可。

## 部署計畫

1. 後台或 seeder 新增 `Stock` 六語系標籤，清除 staticContent 快取。
2. 放入 Stock icon 圖檔。
3. 前端三段 render 加按鈕、新增 `checkStock()` stub。
4. 三種版型驗證。

回滾：移除三段按鈕字串與 stub 函式即可，對既有頁面零風險（純新增）。

## 待確認問題

（本階段決策已定：icon 暫代、點擊顯示「即將開通」。無待確認項目。後續 DILP 串接的 API 帳密／料號規則於該 change 再處理。）
