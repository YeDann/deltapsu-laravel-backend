## ADDED Requirements

### Requirement: Industrial × Medical 跨類型比較

Product Comparison 工具 MUST 支援 **Industrial Power（main 2）與 Medical Power（main 1）跨類型比較**：Type 下拉 MUST 提供一個跨類選項（顯示文字來自 `static_keyword`、多語、後台可維護）；選擇後產品下拉 MUST 列出 Industrial 與 Medical 兩類的全部產品（跨 sub category，沿用既有排序、不分組）。加入比較清單時，MUST 允許兩類（sub 都屬 main 1 或 2）的產品共存。其餘 main（LED Driver / Industrial Battery Charging / Configurable Power）MUST 維持原本「同 sub category 才能比較」的限制。比較表 MUST 沿用動態欄位呈現，某產品沒有的欄位 MUST 留空。

#### Scenario: 選跨類選項列兩類產品
- **WHEN** 使用者在 Type 下拉選擇「Industrial × Medical」跨類選項
- **THEN** 產品下拉列出 Industrial 與 Medical 兩類的全部上架產品（跨不同 sub category）

#### Scenario: 跨類加入比較清單
- **WHEN** 使用者選一個 Industrial 產品與一個 Medical 產品加入比較
- **THEN** 兩者可共存於同一比較清單，比較表並列顯示各自 spec

#### Scenario: 缺對應欄位留空
- **WHEN** 跨類比較中某產品沒有另一產品才有的規格欄位
- **THEN** 該產品在該欄位顯示空白（不報錯、不影響其他欄位）

#### Scenario: 其他類型維持原規則
- **WHEN** 使用者選一般 sub category（如 LED Driver 下的某類）
- **THEN** 僅能加入同一 sub category 的產品，不可跨類

#### Scenario: 比較表與下載沿用
- **WHEN** 跨類比較清單已建立
- **THEN** 比較表以既有動態欄位呈現，CSV / PDF 下載功能照常可用
