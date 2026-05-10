## Context

`switchLang(lang, el)` 現在的邏輯：
```javascript
var url = el && el.getAttribute('data-lang-url');
if (url) { window.location.href = url; return; }  // 整頁重載
// 後面的 setLang() 永遠不會執行到
```

`data-lang-url` 已由 controller 傳入，四個語系都有對應 URL，只需改變觸發方式。

## Goals / Non-Goals

**Goals:**
- 語系切換原地完成，用 `history.pushState` 更新網址，不重載頁面。
- `window._locale` 同步更新，讓 saleskit API 呼叫帶正確語系。

**Non-Goals:**
- 不處理瀏覽器 back/forward 按鈕的 `popstate` 事件（目前頁面為單頁活動頁，無需處理）。

## Decisions

**直接修改 `switchLang` 的前兩行**，移除 `window.location.href` 跳頁，改為：
```javascript
if (url) history.pushState(null, '', url);
window._locale = ...  // 從 url 解析或從 lang 對應表取得
// 繼續執行後面的 setLang() 邏輯
```

locale 對應表（HTML lang → Laravel locale）：
- `en` → `en`
- `zh-TW` → `tw`
- `zh-CN` → `cn`
- `ja` → `jp`
