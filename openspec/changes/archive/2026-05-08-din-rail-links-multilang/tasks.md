## 1. HTML 連結改為動態 URL

- [x] 1.1 Line 1230：DIN Pro LEARN MORE — 將 `href` 改為 PHP 語系路徑，並加上 `data-url-template="https://psu.deltaww.com/{locale}/product/2/din-rail-power-supply/1/din-pro/123"`
- [x] 1.2 Line 1332：DIN Eco LEARN MORE — 同上，template 為 `https://psu.deltaww.com/{locale}/product/2/din-rail-power-supply/1/DIN%20Eco/119`
- [x] 1.3 Line 1735：Compare DIN Pro LEARN MORE — 同上，template 為 `https://psu.deltaww.com/{locale}/product/2/din-rail-power-supply/1/din-pro/123`
- [x] 1.4 Line 1755：Compare Force GT LEARN MORE — 同上，template 為 `https://psu.deltaww.com/{locale}/product/2/din-rail-power-supply/1/force-gt/108`

## 2. switchLang 加入連結更新邏輯

- [x] 2.1 在 `switchLang` 函式內（`window._locale` 更新之後），加入通用替換邏輯：`querySelectorAll('[data-url-template]')` 遍歷，將 `{locale}` 替換為當前 `window._locale`，並更新 `href`

## 3. 驗證

- [x] 3.1 確認 4 個連結在各語系初始載入時 href 包含正確語系路徑
- [x] 3.2 確認切換語系後 href 即時更新，不需重載
