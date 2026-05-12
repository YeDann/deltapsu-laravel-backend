## Purpose

Force GT Learn More 連結在導頁至產品頁前，透過 localStorage 預先設定 Input Voltage Range 篩選條件，使用戶到達產品頁時自動套用對應 filter。

## Requirements

### Requirement: 點擊 Force GT Learn More 時預設 Input Voltage Range 篩選
點擊 Force GT Learn More 連結時，系統 SHALL 在導頁前將 `{arr_inputtxt: [{type:'31', value_text:'90-264 Vac'}]}` 寫入 `localStorage('productFilters')`。

#### Scenario: 正常點擊
- **WHEN** 用戶在 Landing Page 點擊 Force GT LEARN MORE 連結
- **THEN** `localStorage('productFilters')` SHALL 被寫入 `arr_inputtxt` 資料，導頁至 Force GT 產品頁

#### Scenario: 到達 Force GT 產品頁後 filter 已預選
- **WHEN** 用戶從 Landing Page 點擊 Force GT Learn More 後到達產品頁
- **THEN** Input Voltage Range「90-264 Vac」SHALL 自動勾選，產品列表依此 filter 顯示

#### Scenario: localStorage 不可用時靜默降級
- **WHEN** 用戶瀏覽器禁用 localStorage
- **THEN** 連結 SHALL 正常導頁，不預選 filter（不顯示錯誤）
