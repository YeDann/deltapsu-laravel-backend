## 1. Controller

- [x] 1.1 `FrontendController@searchAll` 的 events 查詢（約行 3721）：將 `->where('ct.title', 'LIKE', '%' . $keysearch . '%')` 改為包 `title OR content` 的 where closure（`$q->where('ct.title','LIKE',...)->orWhere('ct.content','LIKE',...)`）；`searchByTag` / `searchByOptionalModel` 的 events 查詢維持不動

## 2. 本機驗證

- [x] 2.1 `php -l` FrontendController 無語法錯誤
- [x] 2.2 搜尋「只出現在某 event 內文、不在標題」的關鍵字 → 確認該 event 出現在結果（使用者本機已驗）
- [x] 2.3 搜尋出現在 event 標題的關鍵字 → 確認 event 照舊出現（原行為不變）
- [x] 2.4 確認 news / 其他內容類型的搜尋範圍未受影響、頁面 HTTP 200 無 PHP 錯誤
