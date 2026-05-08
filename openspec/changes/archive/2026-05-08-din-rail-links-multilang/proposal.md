## Why

Landing Page 上的「LEARN MORE」連結目前全部 hardcode `/en/` 語系路徑。當用戶切換語系時，連結仍指向 `/en/` 頁面，造成語系不一致的體驗。

## What Changes

- 4 個 `btn-cyber` / `compare-learn-more` 連結的 `href` 改為根據當前語系動態產生：
  - DIN Pro LEARN MORE（section 區塊，line 1230）
  - DIN Eco LEARN MORE（section 區塊，line 1332）
  - Compare 區塊 DIN Pro LEARN MORE（line 1735）
  - Compare 區塊 Force GT LEARN MORE（line 1755）
- 初始載入時用 PHP `App::getLocale()` 產生正確 URL
- 切換語系時（`switchLang`）同步更新這些連結的 `href`
- 做法：在連結加上 `data-url-template` 屬性（含 `{locale}` 佔位符），`switchLang` 統一替換

## Capabilities

### New Capabilities
- `din-rail-links-multilang`: Landing Page LEARN MORE 連結依語系動態切換

### Modified Capabilities
（無現有 spec 需要異動）

## Impact

- 影響範圍：Landing Page
- 受影響檔案：
  - `resources/views/front-end/landing-din-rail-infinity-ready.blade.php`（修改 4 個連結 + `switchLang` 函式）
- 不影響 DB、Controller、其他頁面
