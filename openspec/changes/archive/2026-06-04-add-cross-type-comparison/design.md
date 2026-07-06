## Context

`/tools/comparison`（`FrontendController@productCoparison`、`productcoparison.blade.php`）：使用者先在 Type 下拉（`#proType`，列所有 sub category）選一個 type → `chageProductType()` 呼叫 `getProductByType`（POST `typeId`=sub cate id）取該 type 產品 → 加入比較清單（`checkProductSection`，存 session `product_comp`，最多 3）。比較表欄位是動態的（`product_field`+`section`），逐欄位取產品 spec 值。

**現有限制**：`checkProductSection` 要求新產品 `pro_categories_id == 清單已有產品.pro_categories_id`（同一 sub category 才能加）。

**main 對應**（已查 `categories_has_main_pro`）：Medical=main 1、Industrial=main 2；`Open Frame(cate 3)`/`Adapter(cate 8)` 同 id 同時掛 1+2，`DIN Rail(1)/Panel Mount(2)/Modules(5)` 只 2，`Enclosed(9)` 只 1。

## Decisions

- **方案 B：單一 Type 下拉 + 一個跨類選項**（沿用 deck UI，改動最小）。跨類 option 用特殊 value（如 `cross`），顯示文字走 static_keyword（多語、後台可改）。
- **跨類取產品（`getProductByType`）**：`typeId === 'cross'` 時，改取「`categories_has_main_pro.main_cateid IN (1,2)` 的所有 sub 之產品」（distinct），照原本 pro_code 排序、不分組；一般 typeId 維持原本單一 cate 查詢。
- **放寬加入（`checkProductSection`）**：原「同 `categories_id`」改為 —— **同 `categories_id`，或（新產品與清單產品的 sub 都屬於 main 1/2）**。判斷「屬 main 1/2」用 `categories_has_main_pro`。其他 main（3/4/5）不符合放寬條件，維持同 sub。不需顯式儲存「跨類模式」，靠產品的 main 歸屬判斷即可。
- **比較表缺值留空**：既有渲染本就逐 `product_field` 取該產品 spec 值，跨類產品缺該欄位時自然顯示空白，無需特別處理。
- **「加更多產品」來源（`productCoparison` 的 `$seachpro`）**：清單已是跨類（含 main 1+2 產品）時，下拉來源比照跨類（列兩 main 產品），讓使用者能繼續補另一類。

## Risks / Trade-offs

- [跨類取產品數量多] → 沿用既有 `getProductByType` 的 enable/checkContentPro 過濾與 pro_code 排序，不額外分頁（與現行單類一致）。
- [未來 deck 可能有 Case#2…] → 本次只做 Case#1（Industrial×Medical 寫死 main {1,2}）；未來擴充再抽成可設定。已於 spec 標明範圍。
- [判斷產品 main 需 join `categories_has_main_pro`，且 sub 可屬多 main] → 用「該 sub 是否存在 main 1 或 2 的對應列」判斷，Open Frame/Adapter（屬 1+2）自然涵蓋。

## Migration Plan

純 Frontend 邏輯 + static_keyword 新增文案，無 DB schema 變更。部署：跑跨類文字 seeder + `php artisan view:clear`。Rollback：還原 controller/blade。

## Open Questions

無（範圍鎖定 Case#1：Industrial main 2 × Medical main 1）。
