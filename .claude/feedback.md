---
name: Behavioral Feedback
description: Rules learned from corrections and confirmations during work on this project
type: feedback
---

**Don't ask questions before acting on straightforward tasks.**
Why: User said "你在山一次" (你再問一次) when asked about committing — prefers direct action.
How to apply: For reversible local actions (commits, file edits), just do it. Only confirm for destructive/remote actions.

**Product listing sorting belongs in front-end JS, not the controller.**
Why: User pointed out "沒有用處誒 兄弟 product blade 有跑排序嗎？" — the controller ORDER BY was being overridden by JS.
How to apply: For product.blade.php sorting changes, update `sortByStatus()`, `onFilterSetSor()`, `onselectSort()`, `onselectSortArr()`, `onselectSortDestop()` in JS. Controller ORDER BY only matters for pages that don't re-sort in JS (like searchAll, resultsearch).

**Don't touch code unrelated to the task.**
Why: User said "還是錯 而且Series變成沒有依照對應的type出現了 妳返回的壞了＝＝ 完全改錯" after over-engineering the back button fix.
How to apply: Make the minimum change needed. Don't refactor surrounding code.

**Don't remove features by accident when reorganizing.**
Why: User said "Modifired_Date_newest_to_oldest 妳是不是亂改了啥" after I replaced option value=5 with a new label.
How to apply: When reordering dropdown options, always check all existing options are preserved with correct values.

**localStorage should only apply when coming from product pages, not on direct load/refresh.**
Why: User said "但很靠北 如果我沒有走這流程 我直接重新整理就會吃到localstorage" — localStorage filter state must not persist across unrelated navigations.
How to apply: Check referrer or use sessionStorage flags to detect back-navigation before restoring state.

**Verify the full data storage approach before building the UI.**
Why: User said "我覺得你應該確認所有的流程再來看說要怎麼儲存資料誒" — I was about to use product_has_property for Part Number without checking its limitations (text type = only 1 value_text).
How to apply: For any new feature storing product data, read product_has_property + its translation table first to understand constraints. New dedicated table may be needed.

**Read exact file content before using Edit tool on large blade files.**
Why: Edit tool fails with "Found 2 matches" when duplicate blocks exist, or "String not found" when indentation differs between desktop/mobile versions.
How to apply: Read the specific section first, copy exact whitespace, then use a larger unique context window in old_string.

**Always place new frontend sections in the exact location specified.**
Why: User sent screenshot correction "妳前端放錯地方了 要放上面 不是下面" and "不是 是Highlights & Features上面 然後你要標Part Number".
How to apply: When inserting content in productdetails.blade.php, read the full structure first to identify the precise insertion point. Part Number table goes ABOVE Highlights & Features (`content_1`), in its own separate row with "Part Number" title.
