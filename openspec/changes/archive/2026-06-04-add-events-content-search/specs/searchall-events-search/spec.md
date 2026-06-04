## ADDED Requirements

### Requirement: searchAll 的 events 模糊搜尋涵蓋標題與內文

searchAll 搜尋結果頁對 events 的模糊比對 MUST 同時涵蓋標題（`contents_translations.title`）與內文（`contents_translations.content`）；標題或內文任一命中關鍵字即列入 events 結果。其他內容類型（news、articles 等）的搜尋範圍 MUST 維持不變，本變更也 MUST NOT 更動 `searchByTag` / `searchByOptionalModel`。

#### Scenario: 關鍵字只出現在內文

- **WHEN** 使用者在 searchAll 搜尋一個只出現在某 event 內文、不在其標題的關鍵字
- **THEN** 該 event 出現在搜尋結果的 events 區塊

#### Scenario: 關鍵字出現在標題

- **WHEN** 使用者在 searchAll 搜尋一個出現在某 event 標題的關鍵字
- **THEN** 該 event 仍出現在搜尋結果的 events 區塊（原標題比對行為不變）
