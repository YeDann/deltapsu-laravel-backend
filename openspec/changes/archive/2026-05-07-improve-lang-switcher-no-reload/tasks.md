## 1. 修改 switchLang 函式

- [x] 1.1 在 `landing-din-rail-infinity-ready.blade.php` 修改 `switchLang` 函式：將 `if (url) { window.location.href = url; return; }` 改為 `if (url) { history.pushState(null, '', url); }` 並在之後加入 `window._locale = {'en':'en','zh-TW':'tw','zh-CN':'cn','ja':'jp'}[lang] || 'en';`，移除 `return` 讓後續邏輯繼續執行

## 2. 驗證

- [x] 2.1 在 `/en/landing/...` 切換至繁中，確認內容原地切換、網址變為 `/tw/landing/...`、無重載
- [x] 2.2 切換語系後送出 saleskit 表單，確認 DB 記錄的 locale 為新語系
