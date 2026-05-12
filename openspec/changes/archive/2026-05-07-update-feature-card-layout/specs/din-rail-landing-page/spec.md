## MODIFIED Requirements

### Requirement: Feature Card small card layout
Feature 小卡片（pos-2/4/5/6）SHALL 使用 flex column 縱向排列，圖示區域 `icon-wrap` 彈性延伸（`flex: 1 1 auto`），描述文字區塊具備 `min-height: 2.6em` 以確保同行標題對齊。

#### Scenario: Small card icon and title alignment
- **WHEN** 瀏覽器渲染 bento-grid 小卡片
- **THEN** 所有小卡片的描述文字頂部對齊，不因圖示大小差異而錯位

### Requirement: Feature Card title typography
所有標題元素（`.card-header`、`.pos1-subtitle`、`.temp-label`）SHALL 使用統一字體大小 `clamp(0.88rem,1.3vw,1.25rem)`、`font-weight: 700`、`line-height: 1.2`、`margin: 0`。

#### Scenario: Title font unified
- **WHEN** 瀏覽器渲染 PRO 和 ECO 的所有 Feature Card
- **THEN** 所有標題文字大小視覺上一致

### Requirement: Feature Card description typography
描述文字 SHALL 使用 `clamp(0.72rem,0.85vw,0.95rem)`、`color: rgba(255,255,255,0.80)`。

#### Scenario: Description color and size
- **WHEN** 瀏覽器渲染卡片描述文字
- **THEN** 描述文字比標題小且帶半透明白色

### Requirement: Feature Card icon size
小卡片圖示 SHALL 尺寸為 `clamp(48px,7.5vw,110px)`，並加上 `display: block`、`flex-shrink: 0`。

#### Scenario: Icon size responsive
- **WHEN** 視窗寬度從 mobile 到 desktop 縮放
- **THEN** 圖示大小在 48px 到 110px 之間線性縮放

### Requirement: Temperature card number grid layout
PRO pos-6 / ECO pos-4 的溫度數字 SHALL 使用 `inline-grid`（`grid-template-columns: 0.6em auto`）排版正負符號（`.temp-sign`）與數字（`.temp-digits`），顏色分別為 PRO `#05a3f7`、ECO `#00F1CD`。

#### Scenario: Temperature sign alignment
- **WHEN** 瀏覽器渲染溫度範圍（-40°C to +80°C）
- **THEN** 正負號（-/+）欄位寬度固定，數字欄位對齊基線

### Requirement: pos-1 Peak Power layout
PRO pos-1 容器 SHALL 改為 flex column（`justify-content: flex-end`），內部加 `icon-wrap` 包裹大數字與副標題，gap 由 CSS clamp 控制，所有 margin 清零。

#### Scenario: Peak Power card structure
- **WHEN** 瀏覽器渲染 PRO pos-1 卡片
- **THEN** 大數字「150%」和副標題「Peak Power」及描述文字底部對齊，間距一致

### Requirement: Mobile responsive overrides
Mobile breakpoint 下 pos-1 SHALL 置中對齊（`align-items: center; text-align: center`），溫度卡片（pos-6 / pos-4）文字欄 SHALL 保持左對齊。

#### Scenario: Mobile pos-1 centered
- **WHEN** 視窗寬度觸發 mobile breakpoint
- **THEN** pos-1 卡片內容水平置中

#### Scenario: Mobile temp card left-aligned
- **WHEN** 視窗寬度觸發 mobile breakpoint
- **THEN** 溫度卡片文字區塊保持左對齊，不被 pos-1 置中規則影響
