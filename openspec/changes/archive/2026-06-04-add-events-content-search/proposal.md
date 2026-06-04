## Why

searchAll 搜尋頁目前對 events 只比對標題（`contents_translations.title`），使用者以「只出現在內文的關鍵字」搜尋時找不到該則 event。需把 events 內文也納入模糊搜尋範圍（前一變更 `add-news-content-search` 已對 news 做過相同處理）。

## What Changes

本變更只影響 **Frontend pages（searchAll 搜尋結果頁）的 events 查詢**，不變更 DB schema 或資料。

- searchAll 的 events 查詢從「只 `ct.title` LIKE」改為「`ct.title` **OR** `ct.content` LIKE」：標題或內文任一命中關鍵字即列入 events 結果。
- 僅針對 **events**（`content_type = 'event'`）；news、articles 等其他內容類型的搜尋範圍維持不變。
- 僅針對 **searchAll**；`searchByTag` / `searchByOptionalModel` 也有 events 的 title LIKE，但為既有 HTTP 500（缺 view 變數、與本功能無關），不在本變更處理。
- `content` 為完整內文（含 HTML），直接 LIKE，不額外 strip。

## Capabilities

### New Capabilities
- `searchall-events-search`: searchAll 對 events 的模糊搜尋比對範圍（標題 + 內文）。

### Modified Capabilities
<!-- 無：不變更任何既有 spec 的 requirement。 -->

## Impact

- **影響頁面**：Frontend — searchAll 搜尋結果頁（`/{lang}/searchAll/{key?}`）。
- **影響檔案**：`app/Http/Controllers/FrontendController.php` — `searchAll()` 的 events 查詢（約行 3721），`where('ct.title', 'LIKE', ...)` 改為包 `title OR content` 的 where closure。
- **資料庫**：完全不動。
- **相依/風險**：低。只新增一個 OR 條件，標題命中行為不變；content LIKE 全表掃描但 events 量小 + 既有 limit，影響可忽略。
