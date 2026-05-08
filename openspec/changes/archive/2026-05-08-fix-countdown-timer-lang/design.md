## Context

兩個計時器目前的模式：
```js
// 啟動時讀取一次，之後固定
var _lang = document.documentElement.lang;
var _heroTarget = (_lang === 'zh-TW' || _lang === 'zh-CN') ? ... : ...;
function tick() { var target = _heroTarget; ... }
```

`setLang()` 會更新 `document.documentElement.lang`，但計時器 closure 已持有固定的目標時間，不受影響。

## Goals / Non-Goals

**Goals:**
- 語系切換後，下一個 tick（最多 1 秒後）即反映新語系的目標時間

**Non-Goals:**
- 不修改 `setLang` 本身
- 不添加額外事件監聽或 MutationObserver（過度設計）

## Decisions

**在 tick() 內動態讀 lang**：最簡單、zero-overhead，每秒讀一次 attribute 成本可忽略。不需要額外事件系統。

```js
function tick() {
  var _l = document.documentElement.lang;
  var target = (_l === 'zh-TW' || _l === 'zh-CN')
    ? new Date('2026-05-20T09:30:00+08:00')
    : new Date('2026-05-20T15:30:00+08:00');
  ...
}
```

## Risks / Trade-offs

- 每秒 `getAttribute('lang')` 一次：完全可接受，無效能疑慮
- 兩個計時器邏輯需各自修改：互相獨立，不共用 helper（避免額外複雜度）
