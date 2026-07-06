## ADDED Requirements

### Requirement: 行銷資源分類內名稱搜尋

Marketing Resources Downloads 每個分類分頁 MUST 提供「依名稱搜尋」，且 MUST 只在**當前 active 分頁**範圍內取值與過濾（依該分頁的搜尋輸入與分類 id）；搜尋結果 MUST 只更新當前分頁的結果容器、不得污染其他分頁。搜尋結果 MUST 沿用該分頁的呈現方式：Product Images / Videos 分類以縮圖網格（圖片縮圖、影片 ▶ 角標）呈現，其他分類以「檔名 + Download」列表呈現。Product Images / Videos 分頁搜尋結果中**動態注入的圖片 MUST 正常載入縮圖**（不得因站上 lazyload 僅處理初始 DOM 而破圖）。

#### Scenario: 在當前分頁內搜尋
- **WHEN** 合作夥伴於某分頁（如 Product Images / Videos）輸入名稱關鍵字並送出
- **THEN** 只在該分頁的項目中依名稱過濾，結果只更新該分頁，其他分頁不受影響

#### Scenario: 搜尋結果的圖片正常顯示
- **WHEN** 搜尋在 Product Images / Videos 分頁產生含圖片的結果（動態注入縮圖）
- **THEN** 動態注入的圖片縮圖正常載入顯示，不破圖

#### Scenario: 搜尋結果沿用分頁呈現
- **WHEN** 在 Product Images / Videos 分頁搜尋
- **THEN** 結果以縮圖網格（圖片縮圖 / 影片 ▶ 角標 + 預覽／下載）呈現，與該分頁初始呈現一致
