## 1. Landing Page Force GT 連結加 onclick

- [x] 1.1 在 `landing-din-rail-infinity-ready.blade.php` 的 Force GT Learn More `<a>` 標籤（Compare 區塊，line ~1755）加上 `onclick`，在導頁前執行：`try{localStorage.setItem('productFilters',JSON.stringify({arr_inputtxt:[{type:'31',value_text:'90-264 Vac'}]}))}catch(e){}`

## 2. 驗證

- [x] 2.1 確認點擊後 `localStorage('productFilters')` 包含正確的 `arr_inputtxt` 資料
- [x] 2.2 確認其他 Learn More 連結（DIN Pro、DIN Eco）不受影響
