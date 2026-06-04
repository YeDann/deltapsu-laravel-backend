## ADDED Requirements

### Requirement: Product Images 縮圖網格

Marketing Resources Downloads 的 **Product Images** 分類 MUST 以縮圖網格呈現（媒體中心風格），其他分類 MUST 維持原本「檔名 + Download」列表。圖片項目 MUST 顯示縮圖；非圖片項目（如 ZIP）MUST 以佔位卡呈現。縮圖 MUST 沿用站上 lazyload 慣例（`data-src`）載入。

#### Scenario: Product Images 顯示縮圖網格
- **WHEN** 合作夥伴開啟 Marketing Resources Downloads 並切到 Product Images 分類
- **THEN** 圖片以縮圖網格顯示；非圖片（ZIP）以佔位卡顯示

#### Scenario: 其他分類維持列表
- **WHEN** 合作夥伴切到 Catalogs / Leaflets / Sales Tool / Product Cross Reference
- **THEN** 維持原本「檔名 + Download」列表，不受影響

### Requirement: 縮圖 hover 顯示檔名與操作

縮圖卡片平常 MUST 只顯示縮圖；當使用者 hover（或於觸控裝置）時 MUST 於底部顯示一列含「檔名」與操作圖示的小 bar。圖片 MUST 提供預覽(👁)與下載(⬇)；非圖片 MUST 只提供下載。

#### Scenario: hover 顯示檔名列
- **WHEN** 使用者將游標移到某張縮圖上
- **THEN** 底部滑出小 bar，顯示該檔名與預覽、下載圖示

#### Scenario: 非圖片不提供預覽
- **WHEN** 卡片為非圖片（如 ZIP）
- **THEN** 小 bar 僅提供下載，無預覽圖示

### Requirement: 圖片線上預覽彈窗

點選縮圖的預覽 MUST 開啟彈窗顯示該圖片。彈窗 MUST 無標題列、以圖片為主、右上角提供關閉(X)。預覽影像 MUST 透過僅供 inline 顯示的後端端點取得，且 MUST 沿用合作夥伴下載的權限檢查（僅該 role 可存取之 Product Images 圖片）。

#### Scenario: 開啟圖片預覽
- **WHEN** 使用者點選某圖片縮圖的預覽圖示
- **THEN** 彈窗顯示該圖片（無標題列、右上角 X 可關閉）

#### Scenario: 無權限或檔案不存在
- **WHEN** 預覽請求未通過權限檢查或檔案不存在
- **THEN** 端點 MUST 回傳精簡訊息（不得回傳整頁網站或強制下載）

#### Scenario: 僅圖片可預覽
- **WHEN** 檔案非圖片類型（如 ZIP / PDF）
- **THEN** 不提供預覽，僅能下載

### Requirement: 下載行為不變

各項目的下載 MUST 維持既有行為與權限（透過既有下載流程），不受縮圖網格與預覽變更影響。

#### Scenario: 下載維持原樣
- **WHEN** 使用者點選下載
- **THEN** 以既有合作夥伴下載流程取得檔案
