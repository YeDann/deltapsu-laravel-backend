# searchall-other-features Specification

## Purpose
TBD - created by archiving change add-searchall-other-features. Update Purpose after archive.
## Requirements
### Requirement: wireless-charging-system 產品卡以 Other Features 取代 Dimensions

在 searchAll 搜尋結果頁中，凡子分類為 `wireless-charging-system`（Industrial Battery Charging，判斷依據 `$pro['url_item'] == 'wireless-charging-system'`）的產品卡，原本顯示「Dimensions」標籤與 L×W×D 尺寸的區塊 MUST 改為顯示「Other Features」標籤，內容 MUST 取自 `products_translation.short_features`（依目前語系 `local` 對應的那筆）。此規則 MUST 同時套用於桌面版與行動版產品卡，且 MUST 與 product 列表頁採相同的判斷條件與標籤來源。

#### Scenario: wireless-charging 產品有 short_features 資料（桌面）

- **WHEN** 使用者在桌面版瀏覽 searchAll 結果，且某產品卡 `url_item == 'wireless-charging-system'` 並有 short_features 內容
- **THEN** 該卡顯示「Other Features」標籤，標籤下渲染 short_features 的 HTML 內容（如 92% efficiency / CANbus communication / IP65），且不再顯示任何 L×W×D 尺寸

#### Scenario: wireless-charging 產品有 short_features 資料（行動）

- **WHEN** 使用者在行動版瀏覽 searchAll 結果，且某產品卡 `url_item == 'wireless-charging-system'` 並有 short_features 內容
- **THEN** 該行動卡顯示「Other Features」標籤與 short_features 內容，行為與桌面版一致

#### Scenario: short_features 為空（含部分語系未填）

- **WHEN** 某 `wireless-charging-system` 產品在目前語系（例如 tr）的 short_features 為空或不存在
- **THEN** 該卡仍顯示「Other Features」標籤，標籤下內容留空，且不 fallback 回顯示 L×W×D 尺寸

### Requirement: 其他子分類產品卡維持 Dimensions 不變

在 searchAll 搜尋結果頁中，凡 `url_item != 'wireless-charging-system'` 的產品卡 MUST 維持原本「Dimensions」標籤與 L×W×D 尺寸顯示，不得有任何變更。產品卡上的 Tags、Optional Models、Add to Compare 元素 MUST 在所有類別維持原樣。

#### Scenario: 其他類別維持 Dimensions

- **WHEN** 使用者瀏覽 searchAll 結果，且某產品卡 `url_item != 'wireless-charging-system'`（如 Industrial Power、Medical Power、LED Driver 等）
- **THEN** 該卡照舊顯示「Dimensions」標籤與 L×W×D（mm 與英吋）尺寸，與本變更前完全相同

#### Scenario: 共用元素不受影響

- **WHEN** 任一產品卡（wireless-charging 或其他）渲染完成
- **THEN** 該卡的 Tags、Optional Models 區塊與 Add to Compare 按鈕維持原有位置與行為

### Requirement: Other Features 標籤重用既有多語系 key

「Other Features」標籤 MUST 重用 product 列表頁既有的 static_keyword key `product_highLights`（`$staticContent['product_highLights']`），不得新建 key、不得寫入或修改任何 DB 資料。該 key 在所有支援語系（en, tw, cn, de, jp, tr, ru）的值皆已為 "Other Features"。

#### Scenario: 各語系顯示 Other Features 標籤

- **WHEN** 使用者以任一支援語系瀏覽含 wireless-charging 產品的 searchAll 結果
- **THEN** 該產品卡標籤顯示為 `$staticContent['product_highLights']` 的值（"Other Features"），與 product 列表頁完全一致

