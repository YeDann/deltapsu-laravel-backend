## Context

`product.blade.php` 已有 `checkAndRestoreFilters` 函式，在頁面載入時讀取 `localStorage('productFilters')`，還原 `arr_inputtxt`，並透過遍歷 `pro_perti` 找到對應 checkbox 打勾，最後清除 localStorage。這個機制完全符合需求，不需要額外修改。

Force GT Learn More 連結目前只有 `href` 和 `data-url-template`。加上 onclick 在導頁前寫入 localStorage 即可。

## Goals / Non-Goals

**Goals:**
- 點擊 Force GT Learn More 後，product 頁面自動套用 Input Voltage Range = 90-264 Vac

**Non-Goals:**
- 不修改 product.blade.php
- 不影響其他連結的行為
- 不處理 localStorage 被清除的 edge case（使用者禁用 localStorage 時不 prefilter，靜默降級）

## Decisions

**使用 localStorage 注入**：複用現有 `productFilters` key 和 `checkAndRestoreFilters` 機制，零額外代碼在 product 頁面。

## Risks / Trade-offs

[localStorage 被 block] → 靜默降級，導頁正常但 filter 不預選。可接受。
