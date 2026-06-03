## ADDED Requirements

### Requirement: searchAll 的 news 模糊搜尋涵蓋標題與內文

searchAll 搜尋結果頁對 news 的模糊比對 MUST 同時涵蓋標題（`contents_translations.title`）與內文（`contents_translations.content`）；標題或內文任一命中關鍵字即列入 news 結果。其他內容類型（events、articles 等）的搜尋範圍 MUST 維持不變，本變更也 MUST NOT 更動 `searchByTag` / `searchByOptionalModel`。

#### Scenario: 關鍵字只出現在內文

- **WHEN** 使用者在 searchAll 搜尋一個只出現在某 news 內文、不在其標題的關鍵字
- **THEN** 該 news 出現在搜尋結果的 news 區塊

#### Scenario: 關鍵字出現在標題（原行為不變）

- **WHEN** 使用者搜尋一個出現在 news 標題的關鍵字
- **THEN** 該 news 照舊出現在結果，與本變更前一致

#### Scenario: 其他內容類型不受影響

- **WHEN** 使用者在 searchAll 搜尋
- **THEN** events、articles 等其他內容類型的搜尋比對範圍與變更前相同（不因本變更納入其內文）
