1## 1. 資料庫 Migration

- [x] 1.1 新增 migration `add_question_project_status_to_contacts_table`，`up()` 加 `question_project_status CHAR(1) NULL AFTER message`，`down()` dropColumn

## 2. 後端 Controller

- [x] 2.1 在 `FrontendController::landingContact()` 讀取 `cf-project-status` 並 sanitize
- [x] 2.2 將 `question_project_status` 加入 `DB::table('contacts')->insert([...])` 的欄位

## 3. 前端 HTML（Landing Page）

- [x] 3.1 在 `#cf-message` `<textarea>` 上方新增 `<label data-i18n="contact.projectStatusLabel">` 與 `<select id="cf-project-status">` 結構，包含空白預設選項與 4 個 `<option data-i18n-option>`
- [x] 3.2 在 `submitContactForm()` 的 `FormData` 區段加入 `formData.append('cf-project-status', ...)`

## 4. 前端 i18n（JS 翻譯物件）

- [x] 4.1 EN 翻譯：新增 `contact.projectStatusLabel`、`contact.projectStatusPlaceholder`、`contact.projectStatusOpt1` ~ `Opt4`
- [x] 4.2 TC 翻譯：同上繁體中文版
- [x] 4.3 SC 翻譯：同上簡體中文版
- [x] 4.4 JP 翻譯：同上日文版

## 5. 前端 setLang 擴充

- [x] 5.1 在 `setLang` 函式末加一段邏輯，遍歷 `[data-i18n-option]` 元素，將 `option.textContent` 更新為對應翻譯 key 的值
