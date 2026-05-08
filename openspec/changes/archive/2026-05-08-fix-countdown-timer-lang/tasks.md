## 1. Hero 計時器修正（line ~899-924）

- [x] 1.1 移除啟動時固定的 `var _lang` 和 `var _heroTarget` 兩行
- [x] 1.2 在 `tick()` 函式內第一行加入動態 lang 讀取與目標時間計算，取代原本的 `var target = _heroTarget`

## 2. Video 計時器修正（line ~2171-2179）

- [x] 2.1 移除啟動時固定的 `var _l` 和 `var target` 兩行
- [x] 2.2 在 `tick()` 函式內第一行加入動態 lang 讀取與目標時間計算
