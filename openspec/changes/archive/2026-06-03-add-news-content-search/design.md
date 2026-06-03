## Context

`FrontendController@searchAll()`（約 `FrontendController.php:3507`）的 news 查詢（約行 3649-3661）目前以 `->where('ct.title', 'LIKE', '%' . $keysearch . '%')` 只比對標題。`contents_translations` 內文相關欄位有 `title`、`description`、`content`，其中 `content` 為完整內文（含 HTML）。`searchByTag`(3888) / `searchByOptionalModel`(4171) 也有 news 的 title LIKE 查詢，但這兩支是 pre-existing HTTP 500（未傳齊 `$industryKnowHow` 等 view 變數），與本功能無關，不在此處理。

## Goals / Non-Goals

**Goals:**
- searchAll 的 news 模糊搜尋同時涵蓋 `title` 與 `content`。

**Non-Goals:**
- 不改其他內容類型（events/articles…）的搜尋範圍。
- 不改 `searchByTag` / `searchByOptionalModel`（既有 500）。
- 不查 `description`（使用者只要內文）。不動 DB；不 strip HTML。

## Decisions

**`title OR content`：用 where closure 包 `orWhere`。**
把單一 `->where('ct.title', 'LIKE', ...)` 改為 `->where(function ($q) use ($keysearch) { $q->where('ct.title','LIKE',...)->orWhere('ct.content','LIKE',...); })`，確保 OR 群組與其他條件（`ct.local` / `c.content_type` / `c.status`）維持 AND 關係，不會擴散到整個 WHERE。

**不查 `description`：** YAGNI，使用者只要內文。

**`content` 含 HTML 直接 LIKE：** 搜內容詞不會誤中 tag；strip 需 PHP 端處理、過度複雜，不採用。

## Risks / Trade-offs

- **[HTML token 誤匹配]** 關鍵字剛好是 HTML token（如 `div`、`span`）→ 可能誤中內文裡的標籤 → 實務上使用者搜內容詞，風險低，不處理。
- **[效能]** `content LIKE '%kw%'` 無法用索引、全表掃描 → news 量不大且查詢已有 `limit`，影響可忽略。

## Migration Plan

改 `FrontendController@searchAll` 的 news 查詢一處 → 本機驗證（內文詞可搜到、標題詞仍可搜到、其他類型不變）。無 DB 異動、無 rollback 顧慮。

## Open Questions

- 無。
