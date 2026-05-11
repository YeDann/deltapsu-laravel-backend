## Context

Landing page 的申請諮詢表單由 `FrontendController::landingContact()` 處理，資料寫入 `contacts` 資料表（已有 `name`, `email`, `company`, `country`, `tel`, `series`, `message`, `subject` 欄位）。最近已新增 `series` 欄位（migration `2026_05_06_112009_add_series_to_contacts_table.php`）。

前端 i18n 由 JS `translations` 物件管理（setLang 用 innerHTML 套用），支援 en / tw / cn / jp 四語系。

新增的問題為下拉式選單，位於訊息內容（`#cf-message`）欄位上方，4 個固定選項，需多語系顯示。

## Goals / Non-Goals

**Goals:**
- 在申請諮詢表單「訊息內容」上方新增 `question_project_status` 下拉欄位
- 支援 EN / TC / SC / JP 四語系（問題文字與選項均翻譯）
- 表單送出時將選取值傳至後端並存入 `contacts.question_project_status`
- 欄位 nullable，不影響現有記錄或其他表單

**Non-Goals:**
- 後台 admin 介面篩選 / 匯出 question_project_status（範疇外）
- 寄出的通知信件格式調整（可後續處理）
- de / tr 語系翻譯（landing page 不支援）

## Decisions

### 決策 1：存英文固定 key 還是顯示文字

存**單字元 key**（`a` / `b` / `c` / `d`），對應關係：
- `a` = Yes, currently in development
- `b` = Yes, planning within the next 6 months
- `c` = Researching for future projects
- `d` = No specific project at the moment

原因：DB 欄位精簡，前端只需傳 option value，後台若需顯示完整文字另行 mapping。

替代方案考慮：存英文完整文字 → 欄位較長且與語系耦合。

### 決策 2：欄位型態

`question_project_status CHAR(1) NULL DEFAULT NULL`，原因：
- 最長選項文字約 50 字元，120 給足空間
- Nullable → 舊記錄不受影響，其他表單（非 landing page）不需傳此欄位

### 決策 3：HTML 結構

使用原生 `<select>` 元素，class 沿用現有 `input-neon` 樣式（與 `cf-country` 一致），id 為 `cf-project-status`。問題文字用 `<label>` + `data-i18n`，選項文字用 `<option data-i18n>` 搭配 setLang 的 `select option` 邏輯。

由於現有 `setLang` 只處理 `[data-i18n]` 的 `innerHTML`，`<option>` 需改用 `.text` 或 `textContent`。在 setLang 後加一個 helper 專門更新 select options 的文字。

## Risks / Trade-offs

- **[風險] select option 翻譯**：現有 `setLang` 用 `innerHTML`，`<option>` 需用 `.textContent`。需在 setLang 末加一段邏輯處理 `[data-i18n-option]` 屬性 → 直接在 blade 新增 3 行 JS 即可。
- **[Trade-off] 不驗證必填**：此欄位 optional（nullable DB），前端不強制必選（預設空值「-- Select --」）。如需改為必填，可後續在 `submitContactForm()` 加驗證。
- **[Migration Plan]**：新增 migration `add_question_project_status_to_contacts_table`，`up()` 加欄位，`down()` dropColumn。
