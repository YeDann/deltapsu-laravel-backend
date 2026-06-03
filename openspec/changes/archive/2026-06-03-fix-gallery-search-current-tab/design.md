## Context

Marketing Resources Downloads（`marketing-resources-downloads.blade.php`）用 Bootstrap tabs，每個分類分頁各有一份搜尋 `<form>`（含 `name="modelname"`／`name="cateid"`）與一個 `.contentdatasearch` 結果容器。搜尋是純前端：JS 以 regex 比對後端一次帶入的 `margeting`（含各資源 name／file／cate_id），結果重繪到 `.contentdatasearch`。圖片沿用站上 lazyload 慣例（`class="lazyload" data-src`）。

## Decisions

- **以 `.tab-pane.active` 限定範圍**：各分頁 form 共用相同 `name`，全域選擇器 `$("input[name=modelname]")` 只取 DOM 第一個（第一個分頁），故在其他分頁搜尋取到空值。改用當前 active 分頁內 `find()` 取值與渲染，最小改動且不需改 blade 的 form 結構（不動既有 `name`）。`cateid` 雖因 `setdatainput()` 點 tab 時被全域設值而剛好正確，仍一併改為從當前分頁取，行為一致。
- **動態注入圖片手動載入**：站上 lazyload 只處理初始 DOM、不接手動態節點；影片本來就有自訂 observer（`mrObserveVideos`）在搜尋後重新處理，圖片缺對等處理。新增 `mrLoadImages()` 在渲染後把 `.mr-img-thumb[data-src]` 設 `src`（`if (!src)` 守衛，不影響初始已載入者）。

## Risks / Trade-offs

- [`.tab-pane.active` 依賴 Bootstrap tab 的 active class] → 此頁 tab 結構單層，active class 由既有 tab 行為維護。
- [`mrLoadImages` 用全域選擇器 + `if(!src)` 守衛] → 與 `mrObserveVideos` 一致；只載入尚無 `src` 者（搜尋注入的），不重複載入初始項目。

## Migration Plan

純前端，無 DB 變更。部署清 view cache 即生效。

## Open Questions

無。
