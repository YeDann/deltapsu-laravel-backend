## 1. CSS 修改

- [x] 1.1 將第 166 行 `.watt-btn` 的 `padding: 8px 22px` 改為 `padding: clamp(6px, 1.2vw, 8px) clamp(10px, 2.5vw, 22px)`
- [x] 1.2 將第 166 行 `.watt-btn` 的 `font-size: 0.95rem` 改為 `font-size: clamp(0.8rem, 1.8vw, 0.95rem)`

## 2. 移除 Mobile Override

- [x] 2.1 刪除第 737 行 `@media (max-width: 768px)` 區塊內的 `.watt-btn { padding: 6px 10px !important; font-size: 0.8rem !important; }`（已由 clamp 取代）

## 3. 驗證

- [x] 3.1 在 DevTools 拖拉視窗寬度（400px → 900px），確認 padding 連續縮放、無跳躍
- [x] 3.2 確認 PRO 與 ECO 兩組 `.wattage-filter` 按鈕在各尺寸下皆不溢出容器
