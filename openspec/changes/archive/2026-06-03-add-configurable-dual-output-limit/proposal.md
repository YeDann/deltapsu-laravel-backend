## Why

Configurable Power Selector（`/en/tools/configurable-product-selection`）讓使用者逐 slot 配置 Single / Dual Output 模組。實務限制：單一 frame 內可安裝的 **dual output 模組數有上限**，依 frame model 不同（MEG-700A=3、MEG-1K2A≤3、MEG-2K1A≤2、MEG-3K0A≤3）。目前工具未驗證，使用者可超量選擇、組出實際做不出來的配置。

## What Changes

- **Dual Output 數上限驗證**：選滿該 frame 的上限後，其餘**尚未選 Dual** 的 slot 之 Dual Output 選項 MUST 灰掉 disable；已選 Dual 的 slot 仍可改回 Single 來解除。判斷依**已選 Dual 的總數**，非出現順序。
- **多語說明文字**：每個 Dual Output 選項旁 MUST 顯示說明文字（frame 名與上限數隨當前選擇變），文案存 `static_keyword`（後台可維護），6 語系（EN/DE/TC/SC/JP/TR）用 deck 文案。
- **不動** 既有 `validateDualInputs`（dual/single 的 voltage/current 必填檢查）與 `checkSlotMax`（slot 總數上限），兩者與 dual 模組數無關。

## Capabilities

### New Capabilities

- `configurable-power-selector`：Dual Output 模組數上限驗證 + 每個 Dual Output 選項旁的多語說明文字。

### Modified Capabilities

（無）

## Impact

- 影響範圍：**Frontend**（Configurable Power Selector 工具），純前端 JS + static_keyword 文案。
- 受影響檔案：
  - `dependencies/resources/views/front-end/configurableproduct.blade.php`（新增 `dualOutputMax`/`countDualSlots`/`applyDualLimit`、slot 模板加說明節點、掛載點）
  - `dependencies/database/seeds/ConfigurableDualLimitSeeder.php`（新增；seed `static_keyword` 6 語系模板）
- **無 DB schema 變更**（沿用既有 `static_keyword` / `static_keyword_translations`）。
- 部署：跑 `ConfigurableDualLimitSeeder` + `php artisan view:clear`。
