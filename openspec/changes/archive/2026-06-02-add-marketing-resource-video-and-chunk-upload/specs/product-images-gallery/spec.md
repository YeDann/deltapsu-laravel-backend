## MODIFIED Requirements

### Requirement: Product Images 縮圖網格

Marketing Resources Downloads 的 **Product Images / Videos** 分類 MUST 以縮圖網格呈現（媒體中心風格），其他分類 MUST 維持原本「檔名 + Download」列表。圖片項目 MUST 顯示縮圖；**影片項目（mp4/webm/mov）MUST 以 `<video>` 呈現、右上標示 ▶ 角標、並以 `data-src` + `preload="none"` 延後載入（捲入視窗才載入，避免大影片拖慢頁面）**；其他非媒體項目（如 ZIP）MUST 以佔位卡呈現。圖片縮圖 MUST 沿用站上 lazyload 慣例（`data-src`）。分類定位 MUST 以英文名稱比對（含更名前後的 `Product Images` 與 `Product Images / Videos`），不因顯示名更名而失效。

#### Scenario: Product Images / Videos 顯示混合縮圖網格
- **WHEN** 合作夥伴開啟 Marketing Resources Downloads 並切到 Product Images / Videos 分類
- **THEN** 圖片以縮圖、影片以 `<video>`（含 ▶ 角標）、其他（ZIP）以佔位卡，混排於同一縮圖網格

#### Scenario: 其他分類維持列表
- **WHEN** 合作夥伴切到 Catalogs / Leaflets / Sales Tool / Product Cross Reference
- **THEN** 維持原本「檔名 + Download」列表，不受影響

#### Scenario: 影片延後載入不拖慢頁面
- **WHEN** 分類含大影片檔且頁面載入
- **THEN** 影片以 `preload="none"` + `data-src` 呈現，未捲入視窗前不下載影片資料

### Requirement: 縮圖 hover 顯示檔名與操作

縮圖卡片平常 MUST 只顯示縮圖；當使用者 hover（或於觸控裝置）時 MUST 於底部顯示一列含「檔名」與操作圖示的小 bar。**圖片與影片 MUST 提供預覽(👁)與下載(⬇)；其他非媒體（如 ZIP）MUST 只提供下載**。

#### Scenario: hover 顯示檔名列
- **WHEN** 使用者將游標移到某張縮圖上
- **THEN** 底部滑出小 bar，顯示該檔名與（圖片/影片）預覽、下載圖示

#### Scenario: 非媒體不提供預覽
- **WHEN** 卡片為非媒體（如 ZIP）
- **THEN** 小 bar 僅提供下載，無預覽圖示

### Requirement: 圖片線上預覽彈窗

點選縮圖的預覽 MUST 開啟彈窗顯示該圖片**或影片**。彈窗 MUST 無標題列、以內容為主、右上角提供關閉(X)；**影片 MUST 以 `<video controls autoplay playsinline>` 播放（有聲）**。預覽內容 MUST 透過僅供 inline 顯示的後端端點取得並沿用合作夥伴下載的權限檢查（僅該 role 可存取之 Product Images / Videos 媒體）；該端點對**圖片**以 inline 回傳，對**影片**在權限通過後 MUST 302 轉址到同源靜態檔，交由 web server 串流（支援 HTTP Range、不受 PHP 執行時間上限影響，避免大影片逾時）。

#### Scenario: 開啟圖片預覽
- **WHEN** 使用者點選某圖片縮圖的預覽圖示
- **THEN** 彈窗顯示該圖片（無標題列、右上角 X 可關閉）

#### Scenario: 開啟影片預覽
- **WHEN** 使用者點選某影片縮圖（或其預覽圖示）
- **THEN** 彈窗以 `<video controls>` 播放該影片（有聲，串流自靜態檔），關閉時停止播放

#### Scenario: 無權限或檔案不存在
- **WHEN** 預覽請求未通過權限檢查或檔案不存在
- **THEN** 端點 MUST 回傳精簡訊息（不得回傳整頁網站或強制下載）

#### Scenario: 非媒體不可預覽
- **WHEN** 檔案非圖片亦非影片（如 ZIP）
- **THEN** 不提供預覽，僅能下載

## ADDED Requirements

### Requirement: 影片縮圖播放行為（桌機 hover / 手機捲動）

影片縮圖 MUST 在桌機（`hover: hover`）以 hover 觸發**靜音**播放、移開暫停並退回開頭；在手機／觸控（`hover: none`）MUST 於影片捲入視窗達門檻時**自動靜音播放**、捲出視窗時暫停退回開頭。桌機 MUST 不在捲動時自動播放。開啟預覽彈窗時 MUST 暫停所有縮圖影片；關閉彈窗後在手機上 MUST 讓仍在視窗內者繼續播放。播放所需的影片來源 MUST 於該情境（hover 或捲入）才設定（延後載入）。

#### Scenario: 桌機 hover 播放
- **WHEN** 桌機使用者將游標移到影片縮圖上
- **THEN** 該影片靜音播放；移開游標時暫停並退回開頭

#### Scenario: 手機捲入自動播放、捲出暫停
- **WHEN** 觸控裝置使用者將影片縮圖捲入／捲出視窗
- **THEN** 捲入（達可見門檻）自動靜音播放；捲出時暫停並退回開頭

#### Scenario: 開預覽暫停背景、關閉接著播
- **WHEN** 手機使用者開啟某影片的預覽彈窗、之後關閉
- **THEN** 開啟時背景所有縮圖影片暫停（不重疊播放）；關閉後仍在視窗內的縮圖影片接著播

### Requirement: 影片縮圖（poster）

影片項目 MUST 以縮圖（poster）呈現靜止畫面，避免靜止黑屏。poster MUST 為與影片同名的 `.jpg`，以 `<video poster>` 顯示。poster 由上傳時於瀏覽器端擷取產生（見 marketing-resource-chunk-upload）。當 poster 不存在時，前台 MUST 優雅退回（不破版）。

#### Scenario: 影片有縮圖
- **WHEN** 影片已有同名 .jpg 縮圖
- **THEN** 影片縮圖靜止時顯示該 poster（非黑屏），不需下載影片資料

#### Scenario: 影片無縮圖時不破版
- **WHEN** 影片尚無同名 .jpg（如舊影片）
- **THEN** `<video poster>` 來源不存在時優雅退回深色底，不顯示破圖
