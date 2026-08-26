## Context

經銷商（`office` type_id=2）的編輯／新增表單透過 route（`editOffices/{id}/{conId}/{type_id}`、`createOffices/{conId}/{type_id}`）帶入所屬地區 `$conid`。`distributor_sales_territory.continent_id` 與 `office.continent_id` 同指 type_id=2 的 `continents`（已驗證：2=Americas、4=Europe、5=Japan、9=Korea、11=Thailand、12=Taiwan、13=China）。原本表單的 Sales Territory 列出全部地區選項並依 Region 分組，與經銷商已固定所屬單一地區的事實重複。

## Goals / Non-Goals

**Goals:**
- 後台表單的 Sales Territory 只列出該經銷商所屬 continent 的選項，並以平鋪 inline checkbox 呈現。
- 清理去掉 region 名稱需求後變成多餘的 join／別名／重複查詢。

**Non-Goals:**
- 不動前台 Find a Distributor 篩選頁（其 Sales Territory 下拉仍依頁籤地區連動）。
- 不動 DB schema／pivot／seeder，不動其他四類分類，不動 Sales Offices（type_id=1）。

## Decisions

- **在 controller 過濾，而非 blade**：`distributorCategories($conid)` 於既有泛型迴圈加 `->when($t === 'distributor_sales_territory' && $conid, fn → where('c.continent_id', $conid))`。理由：資料層只送必要資料給 view，blade 的 `groupBy('region')` 自然只剩一區、可直接移除分組。替代方案（blade 端 `$items->where('continent_id', $conid)`）被否決，因為仍會留下為取 region 名稱而做的 join／別名與重複查詢。
- **移除 distributor_sales_territory 專屬查詢**：去掉 region 名稱需求後，原專屬查詢（`continents`／`continents_translations` leftJoin、`COALESCE(...) as region` 別名、`orderBy('cont.order_seq')`、覆寫泛型迴圈結果的重複 query）與泛型迴圈僅差一個地區過濾，故併入迴圈。translation join 維持既有 `*_translation` + `local='en'` baseline 模式；排序留在 controller（`orderBy('c.order_seq')`），非前端 JS。
- **blade 平鋪**：移除 `@if($g['field'] === 'distributor_sales_territory')` 的 `groupBy` 分支，五類統一走同一段 inline checkbox（`custom-control custom-checkbox custom-control-inline`）。`create.blade.php` 與 `edit.blade.php` 的 Sales Territory 區塊皆為單一渲染段、無 desktop/mobile 分版，兩檔同步修改；定位字串為 `@if($g['field'] === 'distributor_sales_territory')` 起至對應 `@endif`。

## Risks / Trade-offs

- [若 `$conid` 對不上 `distributor_sales_territory.continent_id` → 區塊空白] → 已驗證兩者同指 type_id=2 continents，且 `when($conid)` 在無 `$conid` 時退回列出全部。
- [編輯既有經銷商若其 pivot 含非所屬地區的 territory → 過濾後該勾選不顯示、儲存時會被取消] → 實務上 territory 均落在所屬地區內；若有跨區歷史資料需人工確認。

## Migration Plan

無 DB 變更，部署即生效。Rollback：還原 `OfficeController.php`、`office/create.blade.php`、`office/edit.blade.php` 三檔即可。

## Open Questions

無。
