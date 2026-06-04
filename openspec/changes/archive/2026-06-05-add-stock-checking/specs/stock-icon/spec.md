## REMOVED Requirements

### Requirement: 點擊 Stock 顯示「即將開通」提示

**Reason**: 本變更接上 netCOMPONENT DILP API，點擊 Stock 改為開啟庫存查詢 Modal 並查詢實際庫存，「即將開通」佔位行為不再適用。
**Migration**: 點擊行為改由 `stock-checking` 能力的「點擊 Stock 開啟庫存查詢 Modal」需求定義；前端入口函式 `checkStock(pro_code)` 保留，其本體由顯示 alert 改寫為開啟 Modal 並發出查詢。`Stock_coming_soon` 多語 keyword 不再被觸發（保留於資料庫無害）。
