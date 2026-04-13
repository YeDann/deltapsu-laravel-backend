# 使用者與認證模組 (Users & Auth Module)

## 概覽
後台使用者管理與登入認證。使用 Laravel 內建 Auth 系統，搭配自訂角色控制。

---

## Controllers

### `BackendUserController`
後台使用者（admin/staff）管理。
- `index()` — 使用者列表
- `create()` — 新增表單
- `store()` — 建立使用者（含密碼 Hash、role 指派）
- `edit($id)` — 編輯表單
- `update($id)` — 更新資料或密碼
- `updatestatusbackend()` — AJAX 啟用/停用帳號
- `destroy($id)` — 刪除帳號

### `HomeController`
登入後的 Admin Dashboard 首頁。
- `index()` — 顯示後台儀表板

### `Auth/` 目錄
Laravel 標準 Auth controllers（LoginController、RegisterController 等）。

---

## Key Tables

| Table | 用途 |
|-------|------|
| `users` | 後台使用者，含 `lang`（負責語系）、`role` 欄位 |

## Role 說明
`users.role` 控制後台權限。不同 role 可能只看得到特定語系的內容（如 BannerSlideController 依 user.lang 篩選）。

---

## 認證流程
- 所有後台 Controller 在 `__construct()` 加 `$this->middleware('auth')`
- 未登入 → 跳轉 login 頁
- FrontendController 不需認證（公開前台）
