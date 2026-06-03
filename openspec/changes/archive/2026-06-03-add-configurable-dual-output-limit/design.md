## Context

Configurable Power Selector（`configurableproduct.blade.php`）以 JS 動態產生 slot 列表，每個 `.child-slot` 有一組 radio：`#single{i}`（value=1）/ `#dual{i}`（value=2），`name="slot-type-{i}"`。frame 資訊在 `model_alldata[index]`（`max_power`/`max_slot`/`product_code`）；現有 code 已用 `max_power == 700` / `== 3000` 判斷 frame。多語 UI 文字全走 `$staticContent['key']`（來源 `static_keyword`，後台 `StaticWordController` 可維護）。

既有 `validateDualInputs()`（slot 選了之後檢查 voltage/current 必填、控制 Next 按鈕）與 `checkSlotMax()`（slot 總數 vs `max_slot`）皆與 dual 模組數上限無關，本變更不動。

## Decisions

- **新增獨立函式、不改既有**：以 `max_power` 為 key 的 `maxDual` map `{700:3, 1200:3, 2100:2, 3000:3}`（對應 MEG-700A/1K2A/2K1A/3K0A）。`dualOutputMax()` 查不到時回 `Infinity`（fallback 不誤限制）。`countDualSlots()` 數已選 Dual；`applyDualLimit()` 在達上限時 disable 其餘**未選 Dual** slot 的 `#dual{i}`、已選 Dual 的不動（可改回 Single 解除）。依**已選總數**判斷，非出現順序。
- **掛載點**：`getSelecter()`（radio onchange）尾呼叫 `applyDualLimit()`；`addSlotOutput()`/刪 slot 後、frame `#model` change 後各呼叫一次，確保新增/移除/換 frame 後重算。
- **說明文字走 static_keyword（後台可維護）**：與全頁多語一致。存**模板**（含 `{frame}`/`{n}` placeholder），JS 取出後以 `replace` 帶入當前 `product_code` 與上限數。以**問號 tooltip** 呈現於每個 Dual Output 選項旁（`<img src="tooltip.svg" data-toggle="tooltip" title="...">`，比照頁面既有 Option/Communication/Control Code 問號），切 frame 重建 slot 時隨之更新並 re-init tooltip。
- **文案來源**：deck Slide 4 的 6 語系。locale 對應 `en/de/tw/cn/jp/tr`（TC→tw、SC→cn、DE 沿用 EN 英文）。

### 說明文字模板（seed 進 static_keyword，key 例：`configurable_dual_limit_desc`）

- en / de：`The maximum number of dual output modules that can be installed in a single {frame} frame is {n} slots.`
- tw：`{frame}機殼可安裝的雙輸出模組數量上限為{n}槽。`
- cn：`{frame}机壳可安装的双输出模块数量上限为{n}槽。`
- jp：`1基の{frame}フレームに搭載可能なデュアル出力モジュールの最大数は{n}スロットです。`
- tr：`Tek bir {frame} ürününe takılabilecek maksimum çift çıkışlı modül sayısı {n} slottur.`

## Risks / Trade-offs

- [frame `product_code` 與 deck 的 MEG-700A/1K2A/2K1A/3K0A 命名需對得上] → 實作時確認 `product_code` 即顯示名；`{frame}` 用 `product_code`。
- [說明文字放每個 slot → 視覺重複] → 改以問號 tooltip 呈現（hover 才展開），與頁面既有問號一致、不佔版面。
- [初始化順序：`var maxDualMap`/`dualLimitTpl` 須在 `selectionGenerate()` 之前定義] → 否則初始 `addSlotOutput → dualOutputMax` 會讀到未賦值的 var（`var` 賦值不 hoist）而 TypeError，中斷整頁初始化。已將兩個 var 移到 `selectionGenerate()` 前。
- [`max_power` 不在 map（未來新 frame）] → `dualOutputMax()` 回 Infinity、不限制，不會誤擋。

## Migration Plan

純前端 + static_keyword 新增文案，無 DB schema 變更。部署：跑 `ConfigurableDualLimitSeeder` + `php artisan view:clear`。Rollback：還原 blade、移除該 keyword（或留著無害）。

## Open Questions

無（文案、上限、判斷依據、位置均依 0603 deck 定案）。
