## 1. 後台側邊欄新增選單項目

- [x] 1.1 在 `resources/views/partials/sidenav.blade.php` 的「GUI Downloads」`<li>` 區塊下方，新增「SALES KIT DOWNLOADS」`<li>` 項目，使用 `@if($name == 'saleskit-requests')` 判斷 active 狀態，連結指向 `route('saleskit_requests_index')`

## 2. 驗證

- [x] 2.1 確認側邊欄在非 Sales Kit Downloads 頁面時，SALES KIT DOWNLOADS 連結不帶 active class
- [x] 2.2 確認造訪 `/saleskit-requests/index` 時，SALES KIT DOWNLOADS 連結顯示為 active
- [x] 2.3 確認 GUI Downloads 選單項目未被異動
