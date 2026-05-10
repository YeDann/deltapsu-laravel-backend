## ADDED Requirements

### Requirement: Header 顯示
Landing page 頂部 SHALL 顯示官網 header（`layouts/header-front.blade.php`），包含 Delta logo、主選單、語言選擇器、搜尋。

#### Scenario: 頁面載入時顯示 header
- **WHEN** 使用者開啟任何語系的 landing page
- **THEN** 頁面頂部顯示與官網相同的 header，包含 logo 和導覽選單

### Requirement: CSS 依賴載入
Landing page MUST 在 `<head>` 載入 `frontend-asset/css/all.css`，確保 header 樣式正確顯示。

#### Scenario: Bootstrap CSS 不破壞 landing page 排版
- **WHEN** `frontend-asset/css/all.css`（含 Bootstrap 4）與 UIKit 同時載入
- **THEN** Landing page 的所有區塊（bento grid、feature cards、comparison table 等）版面正常，未被 Bootstrap reset 破壞

### Requirement: JS 依賴與 header functions
Landing page MUST 載入 jQuery，且 MUST 在 `@include('layouts.header-front')` 之前完成載入。header 所需的 JS functions（`openNav`、`closeNav`、`bigImg`、`mainCate`、`changeLangLocationmobile`、`clickLangLocationmobile`、`toggle_visibility`、`toggle_only`）MUST 定義在 landing page 中。

#### Scenario: 行動版漢堡選單可開關
- **WHEN** 使用者在行動裝置點擊 header 漢堡選單按鈕
- **THEN** 側滑選單（`#Sidenav`）正常展開與關閉

#### Scenario: 桌面版下拉選單可展開
- **WHEN** 使用者 hover 主選單項目
- **THEN** 下拉子選單正常顯示

### Requirement: 語言切換兩套並存，不修改 header
`header-front.blade.php` 的語言切換邏輯 MUST NOT 被修改。Landing page 保留自製語言切換器（`#langSwitcher`）。

#### Scenario: 自製語言切換器正常顯示
- **WHEN** 頁面載入完成
- **THEN** 畫面右上角的 `#langSwitcher` 浮動按鈕正常顯示，不被 header 遮蓋
