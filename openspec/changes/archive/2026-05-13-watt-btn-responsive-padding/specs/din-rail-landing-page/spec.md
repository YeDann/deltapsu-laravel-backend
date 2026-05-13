## MODIFIED Requirements

### Requirement: Wattage filter button 響應式尺寸
`.watt-btn` 的 padding 與 font-size SHALL 使用 `clamp()` 隨 viewport 寬度連續縮放，不得使用固定值搭配多個媒體查詢 override。

#### Scenario: 寬螢幕（≥880px）按鈕尺寸正常
- **WHEN** 使用者在 ≥880px 的視窗瀏覽 landing page
- **THEN** `.watt-btn` 水平 padding 接近 22px，視覺與原設計相同

#### Scenario: 手機螢幕（≤400px）按鈕自動縮小
- **WHEN** 使用者在 ≤400px 的視窗瀏覽 landing page
- **THEN** `.watt-btn` 水平 padding 縮小至約 10px，按鈕不溢出容器

#### Scenario: 中間尺寸（約 600px）平滑過渡
- **WHEN** 使用者在約 600px 的視窗瀏覽 landing page
- **THEN** `.watt-btn` padding 介於最小與最大值之間，不出現跳躍式尺寸變化
