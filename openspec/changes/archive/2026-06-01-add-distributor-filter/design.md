## 背景

本設計以 Delta 提供的「2025 deltapsu Distributor filter.xlsx」實際資料為準（取代先前依 Slide5 的猜測）。Excel 提供 ~60 家經銷商與真正的分類定義。

既有可重用機制（已探索確認）：
- `continents`（type_id=2）+ `continents_translations`：地區，內容 Americas / Europe / Japan / Korea / Thailand / Taiwan Region / China，**直接重用為頁籤**。
- `office`（type_id=2）+ `office_translations`：經銷商實體。`office` 欄位 `id, status, continent_id, type_id, lat, lon, file_cer, status_cer`；`office_translations` 欄位 `tran_id, fk_office_id, title(名稱), sub_title, content(地址 HTML), local`。
- 後台：Contact Us → Distributors → 選洲別 → `OfficeController`；地區由 `ContinentsController`。
- 既有 `application` 表為產品應用情境（Building/Machine Automation…），**與本功能的 Specialized Application 無關，不重用**。

前端篩選沿用產品列表頁模式：`@json` 注入 + 前端 JS 即時過濾（每區數十家，無需逐次打後端）。

## Excel 實際資料（分類與欄位的依據）

**地區（Region）**：Americas / Europe / Japan / Korea / SEA / Taiwan / China（**India 決定不收**）。SEA 目前僅一家（Thailand），匯入時對應到既有 continents 的 **Thailand** 頁籤。Excel 的「Sample」列（ABC/DEF）為範例，匯入時略過。

**每家經銷商欄位**：Distributor(名稱)、Website、Address、Telephone、Email、Google Maps(連結)、Sales territory(自由文字，多個以 `;` 分隔，多為國家)、Certification(自由文字，**幾乎全空**)。**無 logo 欄**。

**三類可勾選分類（真實值，取代 Slide5 版本）**：
- **Specialized Application（3）**：Industrial、Medical、Lighting
- **Product Line（8）**：DIN rail、Panel Mount、Open Frame、Enclosed、Configurable、Wireless Charging System、Adapter、LED Driver
- **Service（3）**：Stocking、After sales、Online shop

## 目標 / 非目標

**目標：**
- 在既有 office(type_id=2) 上補足經銷商欄位與三類分類，匯入 Excel 資料。
- 後台讓 Delta 維護分類與經銷商屬性（含日後補 logo）。
- 前端依地區 + 條件篩選，呈現結果卡。

**非目標：**
- 不串 DILP API（那是 ②）。
- 不動 Sales Offices（type_id=1）。
- 不為 Specialized Application 增加 Slide5 才有、Excel 沒有的項目（LED Signage / Railway）。

## 技術決策

### 1. 接既有 office 擴充欄位

`office` 主表新增語言中性欄位：`logo`（nullable，先留空待客戶補）、`website`、`telephone`、`email`、`google_maps`、`sales_territory`（text，`;` 分隔）、`certification`（text）。名稱／地址維持 `office_translations`（多語）。

### 2. 三張可管理分類表（各帶 `_translation` 多語）

| 表 | 初始 seed 值 |
|----|------|
| `specialized_application` | Industrial、Medical、Lighting |
| `product_line` | DIN rail、Panel Mount、Open Frame、Enclosed、Configurable、Wireless Charging System、Adapter、LED Driver |
| `distributor_service` | Stocking、After sales、Online shop |

結構統一：`id, slug, status, order_seq, timestamps` + `{table}_translation(fk_id, name, local)`。後台可增刪改、加多語名稱。

> Sales territory 與 Certification **不開管理表**：Excel 為自由文字，故存於 office 文字欄；前端 Sales Territory 下拉由現有值去重產生，Certification 下拉同理（目前資料幾乎全空，下拉可能為空或先隱藏）。

### 3. 經銷商 ↔ 分類的多對多關聯（pivot）

- `office_has_specialized_application` (office_id, specialized_application_id)
- `office_has_product_line` (office_id, product_line_id)
- `office_has_service` (office_id, distributor_service_id)

前端篩選比對這些關聯；結果卡的「產品線打勾」「應用/服務標籤」讀同一批關聯。

### 4. 匯入 Excel 為 seed 資料

以 seeder（或一次性匯入指令）讀 Excel 內容：建立分類選項 → 建立各經銷商（對應 region→continent，SEA→Thailand，略過 Sample/India）→ 寫入文字欄與三類 pivot（依 V 標記）。Excel 可先轉 CSV/陣列供 seeder 使用。

### 5. logo 結構先備、之後補圖

office 加 `logo` 欄、後台加上傳欄位**現在就建好**，先留空。結果卡渲染規則：**有 logo 顯示圖、無 logo 顯示經銷商文字名稱**（graceful fallback）。日後客戶提供 logo 圖，Delta 從後台上傳即可，不需改程式。

### 6. 前端篩選於 JS 即時運作

`contactFindDistributor` 回傳該地區經銷商 + 其屬性，前端：
- 地區頁籤切換 → 載入該 continent 經銷商。
- Sales Territory／Certification 下拉（由現有值去重）+ Specialized Application／Product Line／Service 勾選（含 All 全選捷徑）→ JS 即時過濾（類間 AND、類內 OR，依 Delta 確認微調）。
- 結果卡：logo 或名稱、地址、電話、email、Google Maps 連結、website、應用/服務標籤、產品線打勾。

### 7. 後台兩層

- **分類 CRUD**（新增 controller + views + 路由）：維護三張分類表選項與多語名稱。
- **經銷商表單擴充**（`OfficeController` create/edit + `office/` views）：logo 上傳、website、telephone、email、google_maps、sales_territory、certification；三類勾選框。存檔沿用「先刪後插」pivot 寫法。僅 type_id=2 顯示。

### 8. 多語

分類表與 office 名稱/地址走 `_translation`（en/tw/cn/de/jp/tr，DB 另有 ru，seed fallback en）。篩選列 UI 標籤走 `static_keyword`。經銷商的 website/email/territory 等為語言中性，不翻譯。

## 風險 / 取捨

- **取捨：Sales territory / Certification 為自由文字** —— 貼合 Excel 現況、實作快；缺點是下拉選項由資料去重、不如管理表整齊。若 Delta 日後要規範化，再升級為管理表（office 已有欄位，遷移成本低）。
- **風險：Certification 資料幾乎全空** → 前端該下拉可能無選項；實作時若全空則先隱藏該篩選，待資料補齊再顯示。
- **風險：region 與 continents 命名不完全一致**（Excel「SEA」對 continents「Thailand」）→ 匯入時做對應表；India 不收。
- **風險：office 同時服務 type_id=1/2** → 新欄位/關聯僅對 type_id=2 有意義，表單依 type_id 顯示，type_id=1 不受影響。
- **風險：find-distributor.blade 改版** → 分階段，前端最後做，schema/後台先穩。

## 部署計畫（分三階段）

1. **Schema**：migrations（office 加欄、五類分類表 + translation + pivot、sales_territory 加 continent_id）+ seeder（分類與 UI 標籤，英文 baseline；不含 Excel 匯入）。
2. **後台**：分類 CRUD + 經銷商表單擴充。
3. **前端**：find-distributor.blade 改版為篩選頁 + JS 篩選 + 結果卡。

每階段可獨立 review、合併。回滾以 migration rollback + view 還原。

## 待確認問題（多數已由 Excel 解決，剩餘）

- **篩選邏輯**：類間 / 類內的 AND/OR 規則？目前假設「類間 AND、類內 OR」。
- **Sales Territory 下拉呈現**：直接列各家 territory 文字（去重），或要 Delta 規範成固定清單？目前採前者。
- **Certification 篩選**：資料幾乎全空，先隱藏或保留空下拉？目前傾向有值才顯示。
- **logo**：圖檔待客戶提供；結構與上傳介面先備、卡片無圖時以名稱呈現。

## 實作後調整（與上述初版設計的差異，以此為準）

實作過程依客戶回饋調整，最終狀態如下（上方初版段落保留為歷史脈絡）：

1. **Sales Territory / Certification 升級為可管理分類**：不再是 office 的自由文字欄，而是與其他三類相同的 lookup 表 + `_translation` + 與 office 的 M:N pivot（migration `..._000004`）。因此分類由「三類」變「**五類**」。
2. **Sales Territory 綁地區**：加 `continent_id`（migration `..._000005`），後台新增/編輯可選 Region，前台下拉依此分區、隨頁籤連動（不再靠各家文字去重推算）。
3. **移除 Excel 匯入**：`DistributorImportSeeder` 與 `distributors.csv` 刪除；經銷商資料、洲別名稱皆由後台維護，避免假資料覆寫正式站既有資料。
4. **分類標籤依 Slide5、非 Excel**：5 應用 / 9 產品線 / 3 服務（含 LED Signage、Railway、Technical Configuration、LED Signage PS）；Excel 才有的 Online shop 停用保留。
5. **結果卡藍標只顯示 Certifications**（應用/服務僅作篩選條件，不上卡）。
6. **i18n 改英文 baseline**：分類名稱與篩選列 UI 標籤的所有語系先填英文，後台再逐一在地化（取代「依語系顯示翻譯」）。
7. **後台選單**：分類管理獨立成「Distributor Filter」群組（置於 Distributors 之前）。
8. **部署 seeder**：`DatabaseSeeder` 自動跑 `DistributorCategorySeeder` + `DistributorLabelSeeder`（只建分類結構與標籤）。
