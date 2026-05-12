## Context

CSP 設定集中在 `app/Http/Middleware/ContentSecurityPolicy.php` 的 `img-src` 指令（第 18 行）。目前白名單包含 `*.deltapsu.com` 但不含 `filecenter.deltaww.com`，導致來自該域名的圖片（如 Landing Page 使用的 `about-*.jpg`）被瀏覽器封鎖。

## Goals / Non-Goals

**Goals:**
- 在 `img-src` 指令中新增 `https://filecenter.deltaww.com`，允許該域名的圖片載入。

**Non-Goals:**
- 不修改其他 CSP 指令（`script-src`、`style-src` 等）。
- 不開放 `*.deltaww.com` 整個萬用字元域名（最小權限原則）。

## Decisions

**只新增精確域名，不用萬用字元**
- `https://filecenter.deltaww.com` 而非 `https://*.deltaww.com`
- 理由：最小權限，避免開放整個 deltaww.com 子域名的圖片來源。

## Risks / Trade-offs

- **[風險] 未來新增其他 deltaww.com 子域名**：需再次修改此 middleware，但這是可接受的明確性代價。
- **[風險] 快取/部署延遲**：CSP header 改動立即生效，不需 DB migration，風險極低。
