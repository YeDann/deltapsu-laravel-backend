## ADDED Requirements

### Requirement: 產品列表顯示 Stock 按鈕

產品列表頁的每張商品卡片 MUST 在既有 Datasheet（下載）按鈕的右邊顯示一顆 Stock 按鈕，沿用既有 icon-only 樣式（`img-btn-icon-pro` + tooltip），且 MUST 不改變既有 Enquiry / Compare / Datasheet 按鈕。此規則 MUST 在桌機 grid、手機 grid、list view 三種版型皆成立。

#### Scenario: 桌機 grid 版顯示 Stock 按鈕
- **WHEN** 使用者在桌機以 grid 檢視產品列表
- **THEN** 每張商品卡片在 Datasheet 按鈕右邊顯示一顆 Stock icon，滑過顯示對應語系的「Stock」tooltip

#### Scenario: 手機 grid 版顯示 Stock 按鈕
- **WHEN** 使用者在手機以 grid 檢視產品列表
- **THEN** 每張商品卡片在 Datasheet 按鈕右邊顯示一顆 Stock icon

#### Scenario: list view 顯示 Stock 按鈕
- **WHEN** 使用者切換為 list view 檢視產品列表
- **THEN** 每筆商品在 Datasheet 按鈕右邊顯示一顆 Stock icon

#### Scenario: 既有按鈕不受影響
- **WHEN** 任一版型顯示商品卡片
- **THEN** Enquiry、Compare、Datasheet 三顆按鈕的位置與行為與新增 Stock 前相同

### Requirement: 點擊 Stock 顯示「即將開通」提示

Stock 按鈕 MUST 綁定點擊入口（`checkStock` 函式）。本階段點擊時 MUST 顯示多語「即將開通」提示，且 MUST 不執行庫存查詢、不開啟 Modal、不造成 JS 錯誤或影響頁面其他功能。實際庫存查詢行為由後續 DILP 串接變更定義。

#### Scenario: 點擊顯示即將開通提示
- **WHEN** 使用者點擊 Stock 按鈕
- **THEN** 畫面顯示對應語系的「即將開通」提示，頁面不產生 JS 錯誤，其他功能正常

### Requirement: Stock 文字多語化

Stock 按鈕的 tooltip 與「即將開通」提示 MUST 依當前語系顯示對應文字，文字來源 MUST 為 `static_keyword` / `static_keyword_translations`（key：`Stock`、`Stock_coming_soon`）。

#### Scenario: 各語系顯示對應標籤
- **WHEN** 使用者以任一支援語系（en、tw、cn、de、jp、tr）瀏覽產品列表
- **THEN** Stock 按鈕 tooltip 與點擊後的「即將開通」提示，皆顯示該語系對應的文字

#### Scenario: 缺對應語系時 fallback 英文
- **WHEN** 某語系尚未建立 Stock 標籤翻譯
- **THEN** 依既有 staticContent 機制 fallback 為英文，不顯示空白或 key 名
