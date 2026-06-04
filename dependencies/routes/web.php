<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// $lang =   LaravelLocalization::setLocale();
// if($lang  == 'en'){
//     $lang   == '';
// }

// $protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === 0 ? 'https' : 'http';

// if($protocol == 'https'){
//  URL::forceSchema('https');
// }

// LaravelLocalization::setLocale(App::getLocale());

Route::get('/products/download/{cate_name?}/{modelname?}', 'FrontendController@downloadFIle')->name('downloadFIle');
Route::get('/products/download/{lang?}/{cate_name?}/{modelname?}', 'FrontendController@downloadFIleManual')->name('downloadFIleManual');

Route::group([
     'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'HtmlMinifier', 'verifyLang'],
        ], function () {
            // 庫存查詢端點：須在 /{page?} 萬用路由之前，否則單段路徑會被 index 攔截
            Route::get('/stock-check', 'StockController@check')->name('stockCheck');
            // 經銷商聯絡 email（無購物車連結時，前台「Contact」mailto 用）
            Route::get('/stock-check/distributor', 'StockController@contact')->name('stockContact');
            Route::get('/{page?}', 'FrontendController@index')->name('index');
            Route::get('/download/{doc?}', 'FrontendController@oldDoc')->name('downloadDocData');
            Route::get('/download/resources-catalogs/{doc?}', 'FrontendController@downloadoldCatalogs')->name('downloadoldCatalogs');
            Route::get('/download/resources-leaflets/{doc?}', 'FrontendController@downloadoldLeaflets')->name('downloadoldLeaflets');
            Route::get('/file_doc_2/marketing_resources/{doc?}', 'FrontendController@checkPermission')->name('checkpermission');
            Route::post('/partnerLoginDocSuccess', 'FrontendController@partnerLoginDocSuccess')->name('partnerLoginDoc_success');
            Route::post('partnerLoginDoc', 'FrontendController@partnerLoginDoc')->name('partnerLoginDoc');
            Route::get('/loginDocPartner/{doc?}', 'FrontendController@loginDocPartner')->name('loginDocPartner');
            Route::get('/main/download_guide/{doc?}', 'FrontendController@downloadGuide')->name('download_guide');
            Route::get('/tools/configurable-product-selection', 'FrontendController@configurableProduct')->name('configurableproduct');
            Route::get('/configurable-power/details', 'FrontendController@configurableProductDetail')->name('configurableProductDetail');
            Route::get('/products/{cate?}', 'FrontendController@productCate')->name('productCate');
            Route::get('/products/series/{cate?}', 'FrontendController@oldlinkSeries')->name('oldlinkSeries');
            Route::get('/products/{cateid?}/{pro_code?}', 'FrontendController@productsDetailsByType')->name('productsDetailsByType');
            Route::get('/products_search/search', 'FrontendController@resultSearch')->name('resultSearch');
            Route::get('/product/index/{cate_name?}/{cate_id?}/{mainId?}', 'FrontendController@allproductsByType')->name('allproductsByType');
            Route::get('/product/all-product-categories', 'FrontendController@allproduct')->name('allproduct');
            // 舊版商品頁面重定向到新版 (301 redirect) - 必須在 productList 路由之前，排除 "index" 和 "all-product-categories"
            Route::get('/product/{main_cate}/{cate_id}', 'FrontendController@redirectOldProductUrl')
                ->where(['main_cate' => '^(?!index$|all-product-categories$)[a-zA-Z0-9\-_]+$', 'cate_id' => '[0-9]+'])
                ->name('redirectOldProductUrl');
            
            // 舊版商品頁面重定向到新版 (301 redirect)
            Route::get('/product/{main_cate}/{cate_id}/{se_name}/{se_id}', 'FrontendController@redirectOldProductDetailUrl')
                ->where(['main_cate' => '^(?!index$|all-product-categories$)[a-zA-Z0-9\-_]+$', 'cate_id' => '[0-9]+', 'se_name' => '[a-zA-Z0-9\-_]+', 'se_id' => '[0-9]+'])
                ->name('redirectOldProductDetailUrl');
            Route::get('/product/{main_cate}/{cate_name?}/{cate_id?}/{se_name?}/{se_id?}', 'FrontendController@productList')->name('productList');
            Route::get('/productBySeries/{name?}/{series?}', 'FrontendController@productBySeries')->name('productBySeries');
            Route::get('/products/download/{cate_name?}/{modelname?}', 'FrontendController@downloadFIle')->name('downloadFIle');
            Route::post('/loaddocumentPro', 'FrontendController@loaddocumentPro')->name('loaddocumentPro');
            Route::post('/loadPropoperty', 'FrontendController@loadPropoperty')->name('loadPropoperty');
            Route::post('/loadProduct', 'FrontendController@loadProduct')->name('loadProduct');
            Route::post('/checkProductSection', 'FrontendController@checkProductSection')->name('checkProductSection');
            Route::post('/RemovedataInSection', 'FrontendController@RemovedataInSection')->name('RemovedataInSection');
            Route::post('/getProductByType', 'FrontendController@getProductByType')->name('getProductByType');
            Route::post('/loadImageProByArr', 'FrontendController@loadImageProByArr')->name('loadImageProByArr');
            Route::get('/searchAll/{key?}', 'FrontendController@searchAll')->name('searchAll');
            Route::get('/searchByTag/{key?}', 'FrontendController@searchByTag')->name('searchByTag');
            Route::get('/searchByOptionalModel/{key?}', 'FrontendController@searchByOptionalModel')->name('searchByOptionalModel');
            Route::post('/loadpdf', 'FrontendController@loadPdffilePDF')->name('loadPdffilePDF');
            Route::post('/loadcsv', 'FrontendController@loadPdffile')->name('loadPdffile');
            Route::post('savepdfConfig', 'FrontendController@savepdfConfig')->name('savepdfConfig');
            Route::get('/user/login', 'FrontendController@loginpartner')->name('loginpartner');
            Route::get('/faq/detail/{name?}', 'FrontendController@faq_detail')->name('faq_detail');
            Route::get('/file/marketing_resources/{filename?}', 'FrontendController@checkPermission')->name('marketingLink');

            Route::get('/partners/marketing-resources/configurable-history', 'FrontendController@confighistory')->name('confighistory');
            Route::get('/partners/marketing-resources/product-launch-schedule', 'FrontendController@productLaunchSchedule')->name('productLaunchSchedule');
            Route::get('/partners/marketing-resources/marketing-resources-downloads', 'FrontendController@marketingResourcesDownloads')->name('marketingResourcesDownloads');
            Route::get('/partners/marketing-resources/preview', 'FrontendController@previewMarketingResource')->name('previewMarketingResource');
            Route::get('/partners/marketing-resources/sale-kit', 'FrontendController@saleKit')->name('saleKit');
            Route::get('/partners/marketing-resources/product-cross-reference', 'FrontendController@productCrossReference')->name('productCrossReference');
            Route::get('/partners/marketing-resources/partnerinfo/{id?}/{name?}', 'FrontendController@partnerinfo')->name('partnerinfo');
            Route::get('/partners/marketing-resources/success-stories', 'FrontendController@successStories')->name('successStories');
            Route::get('/partners/marketing-resources/success-stories/edit-success-stories/{id?}', 'FrontendController@editSuccessStories')->name('editSuccessStories');
            Route::get('/partners/marketing-resources/success-stories/add-success-stories', 'FrontendController@addSuccessStories')->name('addSuccessStories');
            Route::post('/deleteImageSucess', 'FrontendController@deleteImageSucess')->name('deleteImageSucess');
            Route::post('/updateSuccessStories', 'FrontendController@updateSuccessStories')->name('updateSuccessStories');
            Route::post('/deleteSucessStory', 'FrontendController@deleteSucessStory')->name('deleteSucessStory');

            Route::get('/partners/marketing-resources', 'FrontendController@marketingResources')->name('marketingResources');
            Route::get('/partners/marketing-resources/product-documents', 'FrontendController@productDocLogin')->name('productDocLogin');
            Route::get('/tools/comparison', 'FrontendController@productCoparison')->name('productCoparison');
            Route::get('/tools/product-selector', 'FrontendController@productFinder')->name('productFinder');
            Route::get('/application/detail/{name?}', 'FrontendController@applicationDetail')->name('applicationDetail');
            Route::get('/application/detail/{name?}/{id?}', 'FrontendController@appDetailById')->name('appDetail');

            Route::get('/about-us/{pagename?}', 'FrontendController@aboutUs')->name('aboutUs');

            Route::get('/news/{name?}', 'FrontendController@updateNewsDetail')->name('updateNewsDetail');
            Route::get('/video/{name?}', 'FrontendController@updateVideoDetail')->name('updateVideoDetail');
            Route::get('/events/{name?}', 'FrontendController@updateEventDetail')->name('updateEventDetail');
            Route::get('/technical-articles/{name?}', 'FrontendController@updateTechnicalDetail')->name('updateTechnicalDetail');
            Route::get('/product-notice/{name?}', 'FrontendController@updateProductNoticeDetail')->name('updateProductNoticeDetail');
            Route::get('/industry-know-how/{name?}', 'FrontendController@updateIndustryKnowHowDetail')->name('updateIndustryKnowHowDetail');
            Route::get('/eol/{name?}', 'FrontendController@updateEOLDetail')->name('updateEOLDetail');
            Route::get('/contact/support', 'FrontendController@contactSupport')->name('contactSupport');
            Route::get('/contact/sales-offices', 'FrontendController@contactSalesOffices')->name('contactSalesOffices');
            Route::get('/contact/find-a-distributor', 'FrontendController@contactFindDistributor')->name('contactFindDistributor');
            Route::get('/etc/privacy-policy', 'FrontendController@privacyPolicy')->name('privacyPolicy');
            Route::get('/etc/terms-of-use', 'FrontendController@termsOfUse')->name('termsOfUse');
            Route::post('/subscribe', 'FrontendController@subscribe')->name('subscribe');
            Route::post('/partnerLogin', 'FrontendController@partnerLogin')->name('partnerLogin');
            Route::post('/SaveSuccesStories', 'FrontendController@SaveSuccesStories')->name('SaveSuccesStories');
            Route::post('/uploadmulImagestory', 'FrontendController@uploadmulImagestory')->name('uploadmulImagestory');
            Route::post('/SubmitContact', 'FrontendController@SubmitContact')->name('SubmitContact');
            Route::get('/inquiry/{type_id?}/{type_name?}/{pro_code?}', 'FrontendController@LinktoEnquiry')->name('LinktoEnquiry');
            Route::get('/enquiry/{type_id?}/{type_name?}/{pro_code?}', 'FrontendController@LinktoEnquiryRedirect')->name('LinktoEnquiryRedirect');
            Route::post('/downloadGui', 'FrontendController@downloadGui')->name('downloadGui');
            Route::post('searhstate', 'FrontendController@searhstate')->name('searhstate');
            Route::post('searhProductByType', 'FrontendController@searhProductByType')->name('searhProductByType');
            Route::post('checkpartnerAccount', 'FrontendController@checkpartnerAccount')->name('checkpartnerAccount');

            Route::get('/changePassword/{pin?}', 'FrontendController@changePassword')->name('changePassword');
            Route::post('resetPassword', 'FrontendController@resetPassword')->name('resetPassword');
            Route::post('loadnewPerti', 'FrontendController@loadnewPerti')->name('loadnewPerti');
            Route::post('clearproductsection', 'FrontendController@clearproductsection')->name('clearproductsection');
            Route::post('setlocaltion', 'FrontendController@setlocaltion')->name('setlocaltion');
            Route::get('/etc/imagelink/showimage/{name?}', 'FrontendController@imagelink')->name('imagelink');
            Route::post('tag_product', 'FrontendController@tag_product')->name('tag_product');
            Route::post('getProById', 'FrontendController@getProById')->name('getProById');
            Route::post('/loadparallercon', 'FrontendController@loadparallercon')->name('loadparallercon');
            Route::get('/upload/product_image/{doc?}', 'FrontendController@checkOldfileUrl')->name('checkOldfileUrl');

            Route::post('/searchDocByModelId', 'FrontendController@searchDocByModelId')->name('searchDocByModelId');
            Route::post('/searchDocManualByModelId', 'FrontendController@searchDocManualByModelId')->name('searchDocManualByModelId');
            Route::post('/searchLoginDocByModelId', 'FrontendController@searchLoginDocByModelId')->name('searchLoginDocByModelId');

            Route::get('/landing/din-rail-infinity-ready', 'FrontendController@dinRailLandingPage')->name('dinRailLandingPage');
        });

Route::post('/landing/subscribe', 'FrontendController@landingSubscribe')->name('landingSubscribe');
Route::post('/landing/contact', 'FrontendController@landingContact')->name('landingContact');
Route::post('/landing/saleskit-request', 'FrontendController@landingSkitRequest')->name('landingSkitRequest');
Route::get('/landing/saleskit-download/{application}', 'FrontendController@landingSkitDownload')->name('landingSkitDownload');

Route::prefix('/backend')->group(function () {
    Auth::routes();

    Route::get('deshboard', 'HomeController@index')->name('deshboard');

    // Route::resource('doc_download', 'Doc_DownloadController');

    //Language
    Route::resource('language', 'LanguageController');
    Route::get('languageDestroy/{id?}', 'LanguageController@destroy')->name('languageDestroy');
    Route::get('updateLangStatus/{id?}', 'LanguageController@updateLangStatus')->name('updateLangStatus');
    Route::get('copyToLang/{newlang?}', 'LanguageController@copyToLang')->name('copyToLang');
    Route::post('copyDataActionReq', 'LanguageController@copyDataActionReq')->name('copyDataActionReq');
    //products
    Route::resource('products', 'ProductsController');
    Route::get('searhSeries', 'ProductsController@searhSeries')->name('searhSeries');
    Route::post('storeproduct', 'ProductsController@store')->name('storeProduct');
    Route::get('edit/{id?}', 'ProductsController@edit')->name('editproduct');
    Route::post('updateProduct', 'ProductsController@update')->name('updateProduct');
    Route::post('deleteProduct', 'ProductsController@deleteProduct')->name('deleteProduct');
    Route::get('duplicateProduct/{id?}', 'ProductsController@duplicateProduct')->name('duplicateProduct');
    Route::get('lastetproducts', 'ProductsController@lastetproducts')->name('lastetproducts');
    Route::get('createlastproduct', 'ProductsController@createlastproduct')->name('createlastproduct');
    Route::post('StoreLastProduct', 'ProductsController@StoreLastProduct')->name('StoreLastProduct');
    Route::get('editLastest/{id?}', 'ProductsController@editLastest')->name('editLastest');
    Route::post('deleteLastestPro', 'ProductsController@deleteLastestPro')->name('deleteLastestPro');
    Route::post('UpdateLastProduct', 'ProductsController@UpdateLastProduct')->name('UpdateLastProduct');

    Route::get('featureProduct', 'ProductsController@featureProduct')->name('featureProduct');
    Route::post('setFeatureproducts', 'ProductsController@setFeatureproducts')->name('setFeatureproducts');
    Route::get('ProductSelection', 'ProductsController@ProductSelection')->name('ProductSelection');
    Route::get('unSetting/{id?}', 'ProductsController@unSetting')->name('unSetting');
    Route::get('updateProSection/{id?}', 'ProductsController@updateProSection')->name('updateProSection');
    Route::post('update_order_productselect', 'ProductsController@update_order_productselect')->name('update_order_productselect');
    Route::post('update_order_seriesLeast', 'ProductsController@update_order_seriesLeast')->name('update_order_seriesLeast');
    Route::get('externallist', 'ProductsController@listexternal_link')->name('externallist');
    Route::get('createExternallist', 'ProductsController@createExternallist')->name('createExternallist');
    Route::get('editExternallink/{id?}', 'ProductsController@editExternallink')->name('editExternallink');
    Route::post('deleteExternallink', 'ProductsController@deleteExternallink')->name('deleteExternallink');

    Route::post('storeExternallink', 'ProductsController@storeExternallink')->name('storeExternallink');

    // EC Link Routes
    Route::get('eclinklist', 'ProductsController@listEcLink')->name('eclinklist');
    Route::get('createEcLink', 'ProductsController@createEcLink')->name('createEcLink');
    Route::get('editEcLink/{id?}', 'ProductsController@editEcLink')->name('editEcLink');
    Route::post('storeEcLink', 'ProductsController@storeEcLink')->name('storeEcLink');
    Route::post('updateEcLink', 'ProductsController@updateEcLink')->name('updateEcLink');
    Route::get('deleteEcLink/{id?}', 'ProductsController@deleteEcLink')->name('deleteEcLink');
    Route::post('updateExternalLink', 'ProductsController@updateExternalLink')->name('updateExternalLink');
    //video products
    Route::get('videos_images/{id?}', 'ProductVideoImageController@index')->name('videos_images');
    Route::post('SaveVideoPro', 'ProductVideoImageController@SaveVideoPro')->name('SaveVideoPro');
    Route::post('SaveImagePro', 'ProductVideoImageController@SaveImagePro')->name('SaveImagePro');
    Route::post('getProImageContent', 'ProductVideoImageController@getProImageContent')->name('getProImageContent');
    Route::post('deleteVideImagePro', 'ProductVideoImageController@deleteVideImagePro')->name('deleteVideImagePro');

    Route::get('optional_models/{id?}', 'OptionalModelController@index')->name('optional_models');
    Route::post('saveOptionalModel', 'OptionalModelController@saveOptionalModel')->name('saveOptionalModel');
    Route::post('deleteOptionalModel', 'OptionalModelController@deleteOptionalModel')->name('deleteOptionalModel');
    Route::get('getAllSubCategories', 'GetDataController@getAllSubCategories')->name('getAllSubCategories');
    //Route::get('getAllSeries','GetDataController@getAllSeries')->name('getAllSeries');
    Route::get('getProductFildData', 'GetDataController@getProductFildData')->name('getProductFildData');
    Route::get('getfeatureProduct', 'GetDataController@getfeatureProduct')->name('getfeatureProduct');
    Route::get('getCreateDataFilter', 'GetDataController@getCreateDataFilter')->name('getCreateDataFilter');
    Route::get('getExcelProCategories', 'GetDataController@getExcelProCategories')->name('getExcelProCategories');

    Route::get('static_content/{id?}', 'StaticContentController@index')->name('static_content');
    Route::post('storeContent', 'StaticContentController@store')->name('storeContent');
    Route::get('popUp/{id?}', 'StaticContentController@popUp')->name('popUp');
    //Product Ducuments
    Route::get('product_doc', 'DucumentController@index')->name('product_doc');
    Route::get('product_doc_categories', 'DucumentController@index_categories')->name('index_categories');
    Route::get('createProDocCategories', 'DucumentController@createProDocCategories')->name('createProDocCategories');
    Route::post('storedocCategories', 'DucumentController@storedocCategories')->name('storedocCategories');
    Route::post('deletedocCategories', 'DucumentController@deletedocCategories')->name('deletedocCategories');
    Route::get('editProDocCategories/{id?}', 'DucumentController@editProDocCategories')->name('editProDocCategories');
    Route::post('updateDocCategories', 'DucumentController@updateDocCategories')->name('updateDocCategories');
    Route::get('getDucumentType', 'DucumentController@getDucumentType')->name('getDucumentType');
    Route::get('docFilerBy/{value?}', 'DucumentController@docFilerBy')->name('docFilerBy');

    Route::get('createDocMutidoc', 'DucumentController@createDocMutidoc')->name('createDocMutidoc');
    Route::get('editDocMutidoc/{id?}', 'DucumentController@editDocMutidoc')->name('editDocMutidoc');
    Route::post('storeProdoc', 'DucumentController@storeProdoc')->name('storeProdoc');
    Route::post('updateProdoc', 'DucumentController@updateProdoc')->name('updateProdoc');
    Route::post('deleteproDoc', 'DucumentController@deleteproDoc')->name('deleteproDoc');
    Route::get('getDocument/{id?}', 'DucumentController@getDocument')->name('getDocument');
    Route::post('storeProDocuments', 'DucumentController@storeProDocuments')->name('storeProDocuments');
    Route::post('deleteproHasDoc', 'DucumentController@deleteproHasDoc')->name('deleteproHasDoc');
    Route::get('removefileDoc/{lang?}/{id?}', 'DucumentController@removefileDoc')->name('removefileDoc');
    Route::post('createProdocuments', 'DucumentController@createProdocuments')->name('createProdocuments');
    Route::get('SpecialLang', 'DucumentController@SpecialLang')->name('SpecialLang');
    Route::post('store_spelang', 'DucumentController@store_spelang')->name('store_spelang');
    Route::post('Update_spelang', 'DucumentController@Update_spelang')->name('Update_spelang');
    Route::post('deleteSpecailLang', 'DucumentController@deleteSpecailLang')->name('deleteSpecailLang');
    Route::post('searhModelProductByCatedoc', 'DucumentController@searhModelProductByCatedoc')->name('searhModelProductByCatedoc');

    //Import Optional Model and Export Tag

    Route::get('export_tags', 'ImportTagsController@exports_tags')->name('exports_tags');
    Route::get('export_static', 'ImportTagsController@export_static')->name('export_static');
    Route::get('import_tags', 'ImportTagsController@getExcelProTag')->name('getExcelProTag');
    Route::get('import_optional_model', 'ImportTagsController@getExcelProOptional')->name('getExcelProOptional');
    Route::post('importProductTag', 'ImportTagsController@importProductTag')->name('importProductTag');
    Route::post('importProductOptionalModel', 'ImportTagsController@importProductOptionalModel')->name('importProductOptionalModel');

    //Configurable Product
    Route::get('configurableProduct', 'ConfigurableProduct@index')->name('configurableProduct');
    Route::get('createConfigProduct', 'ConfigurableProduct@createConfigProduct')->name('createConfigProduct');
    Route::get('editConfigProduct/{id?}', 'ConfigurableProduct@editConfigProduct')->name('editConfigProduct');
    Route::post('storeConfigProduct', 'ConfigurableProduct@storeConfigProduct')->name('storeConfigProduct');
    Route::post('updateConfigProduct', 'ConfigurableProduct@updateConfigProduct')->name('updateConfigProduct');
    Route::post('deleteConfigProduct', 'ConfigurableProduct@deleteConfigProduct')->name('deleteConfigProduct');
    Route::get('configuration_history', 'ConfigurableProduct@getHistoryConfig')->name('getHistoryConfig');
    Route::get('exportConfigable', 'ConfigurableProduct@exportConfigable')->name('exportConfigable');
    Route::get('enquiryContact', 'ConfigurableProduct@getEnquiryContact')->name('getEnquiryContact');

    Route::get('ParallelConnection/{id?}', 'ConfigurableProduct@ParallelCon')->name('ParallelConnection');
    Route::post('storeParallel', 'ConfigurableProduct@storeParallel')->name('storeParallel');
    Route::post('deleteParalle', 'ConfigurableProduct@deleteParalle')->name('deleteParalle');
    Route::post('editParallel', 'ConfigurableProduct@editParallel')->name('editParallel');
    Route::get('connector_image/{id?}', 'ConfigurableProduct@connectorImage')->name('connector_image');
    Route::get('create_connectorimage/{id?}', 'ConfigurableProduct@create_connectorimage')->name('create_connectorimage');
    Route::get('edit_connectorimage/{pro_id?}/{id?}', 'ConfigurableProduct@edit_connectorimage')->name('edit_connectorimage');
    Route::post('updateConnectorImage', 'ConfigurableProduct@updateConnectorImage')->name('updateConnectorImage');
    Route::post('storeConnectorImage', 'ConfigurableProduct@storeConnectorImage')->name('storeConnectorImage');
    Route::post('deleteConnectorImage', 'ConfigurableProduct@deleteConnectorImage')->name('deleteConnectorImage');
    //Section
    Route::resource('section', 'SectionController');
    Route::post('sectionUpdate', 'SectionController@update')->name('sectionUpdate');
    Route::get('sectionDestroy/{id?}', 'SectionController@destroy')->name('sectionDestroy');
    Route::post('copySection', 'SectionController@copySection')->name('copySection');
    Route::post('copySectionsingle', 'SectionController@copySectionsingle')->name('copySectionsingle');

    //Product Field
    Route::resource('product-field', 'ProductFieldController');
    Route::post('productfieldUpdate', 'ProductFieldController@update')->name('productfieldUpdate');
    Route::get('productfieldDestroy/{id?}', 'ProductFieldController@destroy')->name('productfieldDestroy');
    Route::post('copyProductField', 'ProductFieldController@copyProductField')->name('copyProductField');
    Route::post('copyProductFieldsingle', 'ProductFieldController@copyProductFieldsingle')->name('copyProductFieldsingle');

    Route::resource('mainprotype', 'ProductCategoriesController');
    Route::post('updatemainpro', 'ProductCategoriesController@update')->name('updatemainpro');
    Route::post('deleteMain', 'ProductCategoriesController@destroy')->name('destroypromain');

    Route::get('order_pro_categoriesBymain/{id?}', 'ProductCategoriesController@order_pro_categoriesBymain')->name('order_pro_categoriesBymain');
    Route::get('order_categories', 'ProductCategoriesController@order_pro_categories')->name('order_categories');
    Route::post('update_order_cate', 'ProductCategoriesController@update_order_cate')->name('update_order_cate');

    Route::post('update_order_procate', 'ProductCategoriesController@update_order_procate')->name('update_order_procate');
    Route::get('subCategories', 'ProductCategoriesController@subCatories')->name('subCategories');
    Route::get('createSubCategories', 'ProductCategoriesController@createSubCategories')->name('createSubCategories');
    Route::get('editSubCategories/{id?}', 'ProductCategoriesController@editSubCategories')->name('editSubCategories');
    Route::post('storeSubCategories', 'ProductCategoriesController@storeSubCategories')->name('storeSubCategories');
    Route::post('UpdateSubCategories', 'ProductCategoriesController@UpdateSubCategories')->name('UpdateSubCategories');
    Route::post('destroysubcategories', 'ProductCategoriesController@destroysubcategories')->name('destroysubcategories');
    Route::get('removefileDocWaranfile/{id?}', 'ProductCategoriesController@removefileDocWaranfile')->name('removefileDocWaranfile');

    Route::get('filter_setting/{id?}', 'ProductFilterController@filter_setting')->name('filter_setting');
    Route::post('storeFilter', 'ProductFilterController@storeFilter')->name('storeFilter');
    Route::post('deletefilter', 'ProductFilterController@deletefilter')->name('deletefilter');
    Route::post('update_order_filer', 'ProductFilterController@update_order_filer')->name('update_order_filer');

    Route::get('default_filer', 'ProductFilterController@default_filer')->name('default_filer');
    Route::post('storedefault_filer', 'ProductFilterController@storeDefaultfiler')->name('storeDefaultfiler');
    Route::post('deleteDefaultfilter', 'ProductFilterController@deleteDefaultfilter')->name('deleteDefaultfilter');
    Route::get('editFilterSelector/{id?}', 'ProductFilterController@editFilterSelector')->name('editFilterSelector');
    Route::post('updateFilterSection', 'ProductFilterController@updateFilterSection')->name('updateFilterSection');

    Route::get('createSeries/{id?}', 'ProductCategoriesController@createSeries')->name('createSeries');
    Route::get('editSeries/{id?}/{cateId?}', 'ProductCategoriesController@editSeries')->name('editSeries');
    Route::get('series_index/{id?}', 'ProductCategoriesController@series_index')->name('series_index');
    Route::get('series_all', 'ProductCategoriesController@series_all')->name('series_all');
    Route::post('storeSeries', 'ProductCategoriesController@storeSeries')->name('storeSeries');
    Route::post('updateSeries', 'ProductCategoriesController@updateSeries')->name('updateSeries');
    Route::post('destroySeries', 'ProductCategoriesController@destroySeries')->name('destroySeries');
    Route::post('update_order_Series', 'ProductCategoriesController@update_order_Series')->name('update_order_Series');
    Route::get('orderSeries/{id?}', 'ProductCategoriesController@orderSeries')->name('orderSeries');

    Route::get('removefileDocSelectionGuide/{id?}/{lang?}', 'ProductCategoriesController@removefileDocSelectionGuide')->name('removefileDocSelectionGuide');
    Route::get('removefileMainCategoriesDoc/{id?}/{lang?}', 'ProductCategoriesController@removefileMainCategoriesDoc')->name('removefileMainCategoriesDoc');
    //News Type
    Route::resource('newstype', 'NewstypeController');
    Route::post('newstypeUpdate', 'NewstypeController@update')->name('newstypeUpdate');
    Route::get('newstypeDestroy/{id?}', 'NewstypeController@destroy')->name('newstypeDestroy');

    // Distributor Filter 分類管理（specialized_application / product_line / distributor_service / sales_territory / distributor_expertise）
    Route::get('distributor-category/{type}', 'DistributorCategoryController@index')->name('distributorCategory.index');
    Route::get('distributor-category/{type}/create', 'DistributorCategoryController@create')->name('distributorCategory.create');
    Route::post('distributor-category/{type}', 'DistributorCategoryController@store')->name('distributorCategory.store');
    Route::get('distributor-category/{type}/{id}/edit', 'DistributorCategoryController@edit')->name('distributorCategory.edit');
    Route::post('distributorCategoryUpdate', 'DistributorCategoryController@update')->name('distributorCategory.update');
    Route::get('distributorCategoryDestroy/{type}/{id}', 'DistributorCategoryController@destroy')->name('distributorCategory.destroy');

    //News
    Route::resource('news', 'NewsController');
    Route::post('newsUpdate', 'NewsController@update')->name('newsUpdate');
    Route::post('deleteNews', 'NewsController@deleteNews')->name('deleteNews');
    Route::get('destroyNews/{id?}', 'NewsController@destroy')->name('destroyNews');
    Route::post('copyNewssingle', 'NewsController@copyNewssingle')->name('copyNewssingle');
    Route::post('copyNews', 'NewsController@copyNews')->name('copyNews');
    Route::get('removefileDocNews/{name?}/{id?}', 'NewsController@removeFileNewsDoc')->name('removeFileNewsDoc');

    //Industry Know-How Type
    Route::resource('industry-know-how-type', 'IndustryKnowHowTypeController');
    Route::post('industryKnowHowTypeUpdate', 'IndustryKnowHowTypeController@update')->name('industryKnowHowTypeUpdate');
    Route::get('industryKnowHowTypeDestroy/{id?}', 'IndustryKnowHowTypeController@destroy')->name('industryKnowHowTypeDestroy');

    //Industry Know-How
    Route::resource('industry-know-how', 'IndustryKnowHowController');
    Route::post('industryKnowHowUpdate', 'IndustryKnowHowController@update')->name('industryKnowHowUpdate');
    Route::get('destroyIndustryKnowHow/{id?}', 'IndustryKnowHowController@destroy')->name('destroyIndustryKnowHow');
    Route::post('copyIndustryKnowHowsingle', 'IndustryKnowHowController@copyIndustryKnowHowsingle')->name('copyIndustryKnowHowsingle');
    Route::post('copyIndustryKnowHow', 'IndustryKnowHowController@copyIndustryKnowHow')->name('copyIndustryKnowHow');
    Route::get('removeFileIndustryKnowHowDoc/{name?}/{id?}', 'IndustryKnowHowController@removeFileIndustryKnowHowDoc')->name('removeFileIndustryKnowHowDoc');

    //Product Notice Type
    Route::resource('product-notice-type', 'ProductNoticeTypeController');
    Route::post('productNoticeTypeUpdate', 'ProductNoticeTypeController@update')->name('productNoticeTypeUpdate');
    Route::get('productNoticeTypeDestroy/{id?}', 'ProductNoticeTypeController@destroy')->name('productNoticeTypeDestroy');

    //Product Notice
    Route::resource('product-notice', 'ProductNoticeController');
    Route::post('productNoticeUpdate', 'ProductNoticeController@update')->name('productNoticeUpdate');
    Route::get('destroyProductNotice/{id?}', 'ProductNoticeController@destroy')->name('destroyProductNotice');
    Route::post('copyProductNoticesingle', 'ProductNoticeController@copyProductNoticesingle')->name('copyProductNoticesingle');
    Route::post('copyProductNotice', 'ProductNoticeController@copyProductNotice')->name('copyProductNotice');
    Route::get('removeFileProductNoticeDoc/{name?}/{id?}', 'ProductNoticeController@removeFileProductNoticeDoc')->name('removeFileProductNoticeDoc');

    //EOL Type
    Route::resource('eol-type', 'EolTypeController');
    Route::post('eolTypeUpdate', 'EolTypeController@update')->name('eolTypeUpdate');
    Route::get('eolTypeDestroy/{id?}', 'EolTypeController@destroy')->name('destroyEolType');
    Route::get('sortEolType', 'EolTypeController@sort')->name('sortEolType');

    //EOL
    Route::resource('eol', 'EolController');
    Route::post('eolUpdate', 'EolController@update')->name('eolUpdate');
    Route::get('destroyEol/{id?}', 'EolController@destroy')->name('destroyEol');
    Route::post('copyEolsingle', 'EolController@copyEolsingle')->name('copyEolsingle');
    Route::post('copyEol', 'EolController@copyEol')->name('copyEol');
    Route::get('removeFileEolDoc/{name?}/{id?}', 'EolController@removeFileEolDoc')->name('removeFileEolDoc');

    //Video Type
    Route::resource('video-type', 'VideoTypeController');
    Route::post('videoTypeUpdate', 'VideoTypeController@update')->name('videoTypeUpdate');
    Route::get('videoTypeDestroy/{id?}', 'VideoTypeController@destroy')->name('videoTypeDestroy');

    //Video
    Route::resource('video', 'VideoController');
    Route::post('videoUpdate', 'VideoController@update')->name('videoUpdate');
    Route::get('destroyVideo/{id?}', 'VideoController@destroy')->name('destroyVideo');
    Route::post('copyVideosingle', 'VideoController@copyVideosingle')->name('copyVideosingle');
    Route::post('copyVideo', 'VideoController@copyVideo')->name('copyVideo');
    Route::get('removeFileVideoDoc/{name?}/{id?}', 'VideoController@removeFileVideoDoc')->name('removeFileVideoDoc');

    //Event
    Route::resource('event', 'EventController');
    Route::post('eventUpdate', 'EventController@update')->name('eventUpdate');
    Route::get('destroyEvent/{id?}', 'EventController@destroy')->name('destroyEvent');
    Route::post('copyEventsingle', 'EventController@copyEventsingle')->name('copyEventsingle');
    Route::post('copyEvent', 'EventController@copyEvent')->name('copyEvent');

    //Technical Type
    Route::resource('technical-type', 'TechnicalType');
    Route::post('technicaltypeUpdate', 'TechnicalType@update')->name('technicaltypeUpdate');
    Route::get('technicaltypeDestroy/{id?}', 'TechnicalType@destroy')->name('technicaltypeDestroy');

    //Technical
    Route::resource('technical', 'TechnicalController');
    Route::post('technicalUpdate', 'TechnicalController@update')->name('technicalUpdate');
    Route::get('destroyTechnical/{id?}', 'TechnicalController@destroy')->name('destroyTechnical');
    Route::post('copyTechnicalsingle', 'TechnicalController@copyTechsingle')->name('copyTechnicalsingle');
    Route::post('copyTechnical', 'TechnicalController@copyTechnical')->name('copyTechnical');

    Route::resource('AboutUs', 'AboutUsController');
    Route::post('AboutUsUpdate', 'AboutUsController@update')->name('AboutUsUpdate');
    Route::post('AboutUsDestroy', 'AboutUsController@destroy')->name('AboutUsDestroy');

    //Application view
    Route::resource('application-view', 'ApplicationView');
    Route::post('applicationUpdate', 'ApplicationView@update')->name('applicationUpdate');
    Route::get('destroyApp/{id?}', 'ApplicationView@destroy')->name('destroyApp');
    Route::post('copyAppsingle', 'ApplicationView@copyAppsingle')->name('copyAppsingle');
    Route::post('copyApp', 'ApplicationView@copyApp')->name('copyApp');
    Route::get('relateApplication/{id?}', 'ApplicationView@relateApplication')->name('relateApplication');
    Route::post('update_order_series', 'ApplicationView@update_order_series')->name('update_order_series');
    Route::post('deleteRelatedSeries', 'ApplicationView@deleteRelatedSeries')->name('deleteRelatedSeries');
    Route::post('addRelatedSeries', 'ApplicationView@addRelatedSeries')->name('addRelatedSeries');
    Route::post('update_order_application', 'ApplicationView@update_order_application')->name('update_order_application');

    Route::get('addMoreImage/{id?}', 'ApplicationView@addMoreImage')->name('addMoreImage');
    Route::post('deleteImage', 'ApplicationView@deleteImage')->name('deleteImage');
    Route::post('uploadImagemultiple', 'ApplicationView@uploadImagemultiple')->name('uploadImagemultiple');

    Route::get('ImportNewsData/{type?}', 'NewsController@ImportNewsData')->name('ImportNewsData');
    //Route::get('ImportEvent/{type?}','EventController@ImportEvent')->name('ImportEvent');
    //Route::get('ImportArticle/{type?}','TechnicalController@ImportArticle')->name('ImportArticle');
    Route::get('ImportOldProduct/{type?}', 'ProductsController@ImportOldProduct')->name('ImportOldProduct');

    Route::resource('FaqCategories', 'FaqCategoriesController');
    Route::get('editfaqCategories/{id?}', 'FaqCategoriesController@editfaqCategories')->name('editfaqCategories');
    Route::post('update_faqcategories', 'FaqCategoriesController@update')->name('update_faqcategories');
    Route::post('deleteFaqCategories', 'FaqCategoriesController@destroy')->name('deleteFaqCategories');

    Route::resource('Faq', 'FaqController');
    Route::get('editFaq/{id?}', 'FaqController@edit')->name('editFaq');
    Route::post('updateFaq', 'FaqController@update')->name('updateFaq');
    Route::post('deleteFaq', 'FaqController@destroy')->name('deleteFaq');
    Route::get('order_faqs', 'FaqController@order_faqs')->name('order_faqs');
    Route::post('update_order_Faqs', 'FaqController@update_order_Faqs')->name('update_order_Faqs');

    Route::resource('MarketResourceCategories', 'MarketResourceCateController');
    Route::get('editMarketResourceCategories/{id?}', 'MarketResourceCateController@edit')->name('editMarketResourceCategories');
    Route::post('update_MarketResourceCategories', 'MarketResourceCateController@update')->name('update_MarketResourceCategories');
    Route::post('delete_MarketResourceCategories', 'MarketResourceCateController@destroy')->name('delete_MarketResourceCategories');

    Route::post('MarketResource/chunk', 'MarketResourceController@chunkUpload')->name('MarketResource.chunk');
    Route::post('MarketResource/poster', 'MarketResourceController@savePoster')->name('MarketResource.poster');
    Route::resource('MarketResource', 'MarketResourceController');
    Route::get('editMarketResource/{id?}', 'MarketResourceController@edit')->name('editMarketResource');
    Route::post('update_MarketResource', 'MarketResourceController@update')->name('update_MarketResource');
    Route::post('delete_MarketResource', 'MarketResourceController@destroy')->name('delete_MarketResource');
    Route::get('removefileMargeting/{id?}/{lang?}', 'MarketResourceController@removefileMargeting')->name('removefileMargeting');

    Route::get('getContinent/{id?}', 'ContinentsController@index')->name('getContinent');
    Route::get('createContinent/{id?}', 'ContinentsController@create')->name('createContinent');
    Route::post('storeContinent', 'ContinentsController@store')->name('storeContinent');
    Route::get('editContinent/{id?}/{type_id?}', 'ContinentsController@edit')->name('editContinent');
    Route::post('deleteContinent', 'ContinentsController@destroy')->name('deleteContinent');
    Route::post('updateContinent', 'ContinentsController@update')->name('updateContinent');

    Route::post('update_order_Continent', 'ContinentsController@update_order_Continent')->name('update_order_Continent');

    Route::get('getOffices/{conId?}/{type_id?}', 'OfficeController@index')->name('getOffices');
    Route::get('createOffices/{conId?}/{type_id?}', 'OfficeController@create')->name('createOffices');
    Route::get('editOffices/{id?}/{conId?}/{type_id?}', 'OfficeController@edit')->name('editOffices');
    Route::post('storeOffices', 'OfficeController@store')->name('storeOffices');
    Route::post('updateOffices', 'OfficeController@update')->name('updateOffices');
    Route::post('deleteOffices', 'OfficeController@destroy')->name('deleteOffices');
    Route::get('removefileCerDis/{conId?}', 'OfficeController@removefileCerDis')->name('removefileCerDis');

    Route::resource('bannerSlide', 'BannerSlideController');
    Route::get('editBanner/{id?}', 'BannerSlideController@edit')->name('editBanner');
    Route::post('updateBanner', 'BannerSlideController@update')->name('updateBanner');
    Route::post('deleteBanner', 'BannerSlideController@destroy')->name('deleteBanner');
    Route::post('update_order_Banner', 'BannerSlideController@update_order_Banner')->name('update_order_Banner');

    Route::resource('backendUser', 'BackendUserController');
    Route::post('updateBackendUser', 'BackendUserController@update')->name('updateBackendUser');
    Route::get('updatestatusbackend/{id?}', 'BackendUserController@updatestatusbackend')->name('updatestatusbackend');
    Route::post('destroyUserBackend', 'BackendUserController@destroy')->name('destroyUserBackend');

    Route::resource('partner', 'PartnerController');
    Route::post('updatepartner', 'PartnerController@update')->name('updatepartner');
    Route::get('updatestatuspartner/{id?}', 'PartnerController@updatestatuspartner')->name('updatestatuspartner');
    Route::post('destroyUserPartner', 'PartnerController@destroy')->name('destroyUserPartner');

    Route::get('successStory', 'PartnerController@successStory')->name('successStory');
    Route::get('sucess_story_edit/{id?}', 'PartnerController@sucess_story_edit')->name('sucess_story_edit');
    Route::get('sucess_story_view/{id?}', 'PartnerController@sucess_story_view')->name('sucess_story_view');
    Route::post('succes_stories_update', 'PartnerController@succes_stories_update')->name('succes_stories_update');
    Route::post('deteleteSuccessStories/{id?}', 'PartnerController@deteleteSuccessStories')->name('deteleteSuccessStories');
    Route::get('storyImage/{id?}', 'PartnerController@storyImage')->name('storyImage');
    Route::post('uploadImageStory', 'PartnerController@uploadImageStory')->name('uploadImageStory');
    Route::post('deleteImageStory_back', 'PartnerController@deleteImageStory_back')->name('deleteImageStory_back');

    Route::get('pro_lauch', 'PartnerDetailController@pro_lauch')->name('pro_lauch');
    Route::get('pro_lauch_create', 'PartnerDetailController@pro_lauch_create')->name('pro_lauch_create');
    Route::get('pro_lauch_edit/{id?}', 'PartnerDetailController@pro_lauch_edit')->name('pro_lauch_edit');
    Route::post('pro_lauch_store', 'PartnerDetailController@pro_lauch_store')->name('pro_lauch_store');
    Route::post('pro_lauch_update', 'PartnerDetailController@pro_lauch_update')->name('pro_lauch_update');
    Route::post('prolaunchDestroy', 'PartnerDetailController@prolaunchDestroy')->name('prolaunchDestroy');
    Route::get('schedules_month/{id?}', 'PartnerDetailController@schedules_month')->name('schedules_month');
    Route::post('store_schedule', 'PartnerDetailController@store_schedule')->name('store_schedule');
    Route::post('scheduleUpdate', 'PartnerDetailController@scheduleUpdate')->name('scheduleUpdate');
    Route::post('scheduleDelete', 'PartnerDetailController@scheduleDelete')->name('scheduleDelete');
    Route::get('edit_schedule/{id?}', 'PartnerDetailController@edit_schedule')->name('edit_schedule');
    Route::get('launch_datail/{id?}', 'PartnerDetailController@launch_datail')->name('launch_datail');
    Route::get('launch_datail_create/{id?}', 'PartnerDetailController@launch_datail_create')->name('launch_datail_create');
    Route::get('pro_lauch_DetailEdit/{headId?}/{id?}', 'PartnerDetailController@pro_lauch_DetailEdit')->name('pro_lauch_DetailEdit');
    Route::post('store_launch_datail', 'PartnerDetailController@store_launch_datail')->name('store_launch_datail');
    Route::post('update_launch_datail', 'PartnerDetailController@update_launch_datail')->name('update_launch_datail');
    Route::post('prolaunchdetailDelete', 'PartnerDetailController@prolaunchdetailDelete')->name('prolaunchdetailDelete');

    Route::get('partner_doc_index/{id?}/{name?}', 'PartnerDocumentController@index')->name('partner_doc_index');
    Route::get('partner_doc_create/{typeId?}/{typeName?}', 'PartnerDocumentController@create')->name('partner_doc_create');
    Route::get('partner_doc_edit/{id?}/{typeId?}/{typeName?}', 'PartnerDocumentController@edit')->name('partner_doc_edit');
    Route::post('deleteSaleKit', 'PartnerDocumentController@deleteSaleKit')->name('deleteSaleKit');
    Route::post('storeSaleKit', 'PartnerDocumentController@store')->name('storeSaleKit');
    Route::post('updatesaleKit', 'PartnerDocumentController@update')->name('updatesaleKit');

    Route::get('partner_page', 'PartnerPageController@index')->name('partner_page');
    Route::get('partner_page_create', 'PartnerPageController@page_info_create')->name('partner_page_create');
    Route::get('page_info_edit/{id?}', 'PartnerPageController@page_info_edit')->name('page_info_edit');
    Route::post('part_page_store', 'PartnerPageController@store')->name('part_page_store');
    Route::post('part_page_update', 'PartnerPageController@update')->name('part_page_update');
    Route::post('deteletepartpage', 'PartnerPageController@deteletepartpage')->name('deteletepartpage');

    Route::get('static_word', 'StaticWordController@index')->name('static_word');
    Route::get('static_create', 'StaticWordController@static_create')->name('static_create');
    Route::get('static_edit/{id?}', 'StaticWordController@static_edit')->name('static_edit');
    Route::post('store_staticword', 'StaticWordController@store_staticword')->name('store_staticword');
    Route::post('update_staticword', 'StaticWordController@update_staticword')->name('update_staticword');
    Route::post('importExel', 'ImportController@importExel')->name('importExel');
    Route::get('getExcelProduct', 'ImportController@getExcelProduct')->name('getExcelProduct');
    Route::get('getExportProduct', 'ImportController@getExportProduct')->name('getExportProduct');
    Route::get('getExcelProductCerti', 'ImportController@getExcelProductCerti')->name('getExcelProductCerti');
    Route::post('importCertificate', 'ImportController@importCertificate')->name('importCertificate');
    Route::post('importProdoctCate', 'ImportController@importProdoctCate')->name('importProdoctCate');
    Route::post('importStatusProduct', 'ImportController@importStatusProduct')->name('importStatusProduct');
    Route::get('getpageSubscriber', 'ImportController@getpageSubscriber')->name('getpageSubscriber');
    Route::post('importSubscriber', 'ImportController@importSubscriber')->name('importSubscriber');
    Route::get('getExportProductSpecification', 'ImportController@getExportProductSpecification')->name('getExportProductSpecification');

    //Route::get('getExportOldProduct','ImportController@getExportOldProduct')->name('getExportOldProduct');

    //Route::post('importSuccessStory','ImportController@importSuccessStory')->name('importSuccessStory');
    Route::get('getExportProductProperty', 'ImportController@getExportProductProperty')->name('getExportProductProperty');
    Route::get('getExportProductImage', 'ImportController@getExportProductImage')->name('getExportProductImage');
    Route::get('subscribers/index', 'SubscribeController@index')->name('subscribers_index');
    Route::get('exportSubscribes', 'SubscribeController@exportSubscribes')->name('exportSubscribes');
    Route::get('saleskit-requests/index', 'SaleskitRequestController@index')->name('saleskit_requests_index');
    Route::get('saleskit-requests/export', 'SaleskitRequestController@export')->name('saleskit_requests_export');
    Route::get('ExportPartner', 'PartnerController@ExportPartner')->name('ExportPartner');

    Route::get('metaTags', 'MetaTagController@index')->name('metaTags');
    Route::get('create_metaTag', 'MetaTagController@create')->name('create_metaTag');
    Route::get('edit_metaTag/{id?}', 'MetaTagController@edit')->name('edit_metaTag');
    Route::post('store_metaTag', 'MetaTagController@store')->name('store_metaTag');
    Route::post('update_metaTag', 'MetaTagController@update')->name('update_metaTag');
    Route::post('deleteMeta', 'MetaTagController@deleteMeta')->name('deleteMeta');

    Route::get('emailnotification/{type?}', 'EmailController@index')->name('emailnotification');
    Route::get('createEmail/{type?}', 'EmailController@create')->name('createEmail');
    Route::get('editEmail/{type?}/{id?}', 'EmailController@editEmail')->name('editEmail');
    Route::post('storeEmailNotification', 'EmailController@storeEmail')->name('storeEmail');
    Route::post('UpdateEmail', 'EmailController@UpdateEmail')->name('UpdateEmail');
    Route::post('deleteEmailNotification', 'EmailController@deleteEmailNotification')->name('deleteEmailNotification');
    Route::get('getEmailNotificationList', 'EmailController@getEmailNotificationList')->name('getEmailNotificationList');
    Route::post('importEmailNotification', 'EmailController@importEmailNotification')->name('importEmailNotification');
    Route::get('gui_dowload_index', 'EmailController@gui_dowload_index')->name('gui_dowload_index');
    Route::get('exportGui', 'EmailController@exportGui')->name('exportGui');
    Route::get('feedbackform/{type?}', 'EmailController@feedbackform')->name('feedbackform');
    Route::get('exportfeedbackFrom/{type?}', 'EmailController@exportfeedbackFrom')->name('exportfeedbackFrom');
    Route::post('uploadtoTexteditor', 'StaticContentController@uploadtoTexteditor')->name('uploadtoTexteditor');

    Route::post('CheckApiMail', 'GetDataController@CheckApiMail')->name('CheckApiMail');
});
