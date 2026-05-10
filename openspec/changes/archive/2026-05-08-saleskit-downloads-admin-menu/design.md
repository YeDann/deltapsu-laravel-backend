## Context

後台側邊欄定義於 `resources/views/partials/sidenav.blade.php`，每個選單項目透過 `$name` 變數判斷 active 狀態。`SaleskitRequestController@index` 已傳入 `name = 'saleskit-requests'`，route 與 view 均已存在。唯一缺少的是對應的 sidenav 選單項目。

## Goals / Non-Goals

**Goals:**
- 在「GUI Downloads」項目下方新增「SALES KIT DOWNLOADS」選單連結
- active 狀態判斷與現有 Controller 的 `$name` 對齊

**Non-Goals:**
- 不修改 Controller、Route、View
- 不改動 GUI Downloads 選單項目的現有結構

## Decisions

沿用現有 sidenav 的 `@if($name == "...")` active 判斷模式，與其他選單項目保持一致。

## Risks / Trade-offs

無顯著風險；單一檔案、單一區塊的 Blade 修改。
