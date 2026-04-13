# 前台模組 (Frontend Module)

## 概覽
所有前台頁面由 `FrontendController` 處理。多語系路由由 LaravelLocalization 管理，URL 自動帶語系前綴。

---

## 路由結構 (`routes/web.php`)

### 商品相關
```
GET  /product/{main_cate}/{cate_name}/{cate_id}                → productList
GET  /product/{main_cate}/{cate_name}/{cate_id}/{se_name}/{se_id} → productList (with series)
GET  /products/{cateid}/{pro_code}                             → productsDetailsByType (new URL)
GET  /products/{cate}                                          → productCate (舊分類頁)
GET  /products/series/{cate}                                   → oldlinkSeries
GET  /product/all-product-categories                           → allproduct
GET  /product/index/{cate_name}/{cate_id}/{mainId}             → allproductsByType
GET  /product/{main_cate}/{cate_id}                            → redirectOldProductUrl (301)
GET  /product/{main_cate}/{cate_id}/{se_name}/{se_id}          → redirectOldProductDetailUrl (301)
GET  /productBySeries/{name}/{series}                          → productBySeries
GET  /searchAll/{key}                                          → searchAll
GET  /searchByTag/{key}                                        → searchByTag
GET  /searchByOptionalModel/{key}                              → searchByOptionalModel
```

### 工具頁面
```
GET  /tools/configurable-product-selection  → configurableProduct
GET  /configurable-power/details            → configurableProductDetail
GET  /tools/comparison                      → productCoparison
GET  /tools/product-selector                → productFinder
GET  /inquiry/{type_id}/{type_name}/{pro_code} → LinktoEnquiry
GET  /enquiry/...                           → LinktoEnquiryRedirect
```

### 文件下載
```
GET  /products/download/{cate_name}/{modelname} → downloadFIle
GET  /products/download/{lang}/{cate_name}/{modelname} → downloadFIleManual
GET  /download/{doc}                        → oldDoc
GET  /download/resources-catalogs/{doc}     → downloadoldCatalogs
GET  /download/resources-leaflets/{doc}     → downloadoldLeaflets
GET  /file/marketing_resources/{filename}   → checkPermission
GET  /main/download_guide/{doc}             → downloadGuide
GET  /upload/product_image/{doc}            → checkOldfileUrl
```

### 內容頁面
```
GET  /news/{name}                          → updateNewsDetail
GET  /video/{name}                         → updateVideoDetail
GET  /events/{name}                        → updateEventDetail
GET  /technical-articles/{name}            → updateTechnicalDetail
GET  /product-notice/{name}                → updateProductNoticeDetail
GET  /industry-know-how/{name}             → updateIndustryKnowHowDetail
GET  /eol/{name}                           → updateEOLDetail
GET  /about-us/{pagename}                  → aboutUs
GET  /faq/detail/{name}                    → faq_detail
GET  /application/detail/{name}            → applicationDetail / appDetailById
```

### 聯絡/靜態
```
GET  /contact/support                      → contactSupport
GET  /contact/sales-offices                → contactSalesOffices
GET  /contact/find-a-distributor           → contactFindDistributor
GET  /etc/privacy-policy                   → privacyPolicy
GET  /etc/terms-of-use                     → termsOfUse
POST /SubmitContact                        → SubmitContact
POST /subscribe                            → subscribe
```

### 合作夥伴前台 (Partner Portal)
```
GET  /user/login                           → loginpartner
POST /partnerLogin                         → partnerLogin
POST /checkpartnerAccount                  → checkpartnerAccount
GET  /changePassword/{pin}                 → changePassword
POST /resetPassword                        → resetPassword
GET  /loginDocPartner/{doc}                → loginDocPartner
POST /partnerLoginDoc                      → partnerLoginDoc
POST /partnerLoginDocSuccess               → partnerLoginDocSuccess

GET  /partners/marketing-resources                                    → marketingResources
GET  /partners/marketing-resources/product-documents                  → productDocLogin
GET  /partners/marketing-resources/marketing-resources-downloads      → marketingResourcesDownloads
GET  /partners/marketing-resources/sale-kit                           → saleKit
GET  /partners/marketing-resources/product-cross-reference            → productCrossReference
GET  /partners/marketing-resources/configurable-history               → confighistory
GET  /partners/marketing-resources/product-launch-schedule            → productLaunchSchedule
GET  /partners/marketing-resources/success-stories                    → successStories
GET  /partners/marketing-resources/success-stories/edit-success-stories/{id} → editSuccessStories
GET  /partners/marketing-resources/add-success-stories                → addSuccessStories
POST /SaveSuccesStories / /updateSuccessStories / /deleteSucessStory  → success story CRUD
GET  /partners/marketing-resources/partnerinfo/{id}/{name}            → partnerinfo
```

### AJAX Endpoints (POST)
```
POST /loaddocumentPro         → 載入商品文件
POST /loadPropoperty          → 載入商品規格
POST /loadProduct             → 載入商品資料
POST /checkProductSection     → 檢查商品 section
POST /RemovedataInSection     → 移除 section 資料
POST /getProductByType        → 依類型取得商品
POST /loadImageProByArr       → 批次取商品圖片
POST /loadpdf / /loadcsv      → PDF/CSV 下載處理
POST /savepdfConfig           → 儲存 PDF 設定
POST /loadnewPerti            → 載入新規格
POST /clearproductsection     → 清除商品 section
POST /setlocaltion            → 設定地區
POST /tag_product             → 取得標籤商品
POST /getProById              → 依 ID 取商品
POST /loadparallercon         → 載入並聯設定
POST /searchDocByModelId      → 搜尋文件
POST /searchDocManualByModelId → 搜尋手冊
POST /searchLoginDocByModelId  → 搜尋登入後文件
```

---

## FrontendController 關鍵方法

### 商品列表：`productList()`
- 查詢商品（**不加 ORDER BY status**，JS 處理）
- 帶入篩選器、series 清單
- View: `front-end/product.blade.php`

### 商品詳細：`productsDetailsByType()`
- 模糊比對 catename → sub_category
- 帶入 part_numbers、properties、documents、certificates、related
- View: `front-end/productdetails.blade.php`

### 搜尋：`searchAll()`
- 正規化字串搜尋（去 -/空格）
- **ORDER BY 在 controller**（status 優先 + pro_code alpha）
- View: `front-end/resultsearch.blade.php`

---

## Blade 檔案

### `product.blade.php`（~5000+ 行）
- PHP → `json_encode()` → JS
- 關鍵 JS 函數：`sortByStatus()`, `onFilterSetSor()`, `onselectSort()`, `onselectSortDestop()`, `onselectSortArr()`, `displayProducts()`
- Sort type: 1=Status, 5=Modified Date newest

### `productdetails.blade.php`
1. Breadcrumb + 商品 header
2. 規格 table（依 section）
3. **Part Number table**（藍色標題，無 thead）
4. Highlights & Features（content_1）
5. Detailed description（content_2）
6. Documents / Certificates
7. Related products

### `resultsearch.blade.php`
- Server-side 排序，無 JS re-sort
