<?php $__env->startSection('css'); ?>

<style>
   
    /* select */
	.form-control{
        font-size: 14px;
		-webkit-appearance: none;
		-moz-appearance: none;
		border-radius: 0;
		border: 1px solid #444444; background-position: right 50%;
		background-repeat: no-repeat;
		background-image: url('<?php echo e(asset('frontend-asset/image/arrow-down.svg')); ?>');
        padding-right: 24px;
	}
	.form-control:disabled, .form-control[readonly] {
		background-color: #F2F2F2;
		border: 1px solid #C1C1C1 !important;
		opacity: 1;
		color: #C1C1C1;
		background-image:unset;
	}
	.form-control:focus {
		color: #495057;
		background-color: #fff;
		border-color: #80bdff;
		outline: unset;
		box-shadow: unset;
    }
    input[type=text],input[type=email]{
		background-image:unset;
		
    }
    .input-label{
        position: relative;
    }
    input[required] + label {
        color: #707070;
        font-family: Arial;
        font-size: 14px;
        position: absolute;
        bottom: 0;
        left: 12px;  /* the negative of the input width */
    }

    #showfiler a {
        text-decoration: none;
        font-size: 14px;
        color: #ffffff;
        font-weight: bold;
    }
    .accordion .card-header-filter:after {
        font-family: 'Material-Design-Iconic-Font';
        content: "\f273";
        float: right;
        font-size: 24px;
        color: #444444;
    }

    .accordion .card-header-filter.collapsed:after {
        /* symbol for "collapsed" panels */
        content: "\f278";
    }

    .accordion_mobile .card-header-filter:after {
        font-family: 'Material-Design-Iconic-Font';
        content: "\f273";
        float: right;
        font-size: 24px;
        color: #444444;
    }

    .accordion_mobile .card-header-filter.collapsed:after {
        /* symbol for "collapsed" panels */
        content: "\f278";
    }

    table {
        border-collapse: unset;
        border-spacing: 0px 16px;
    }

    .space-listviews {
        margin-top: 4px;
    }
    .table thead th{
        vertical-align: middle !important;
    }
    .table td {
        /* border-top: unset; */
    }

    tbody td {
        border-top: 2px solid #E3EFF8 !important;
        border-bottom: 2px solid #E3EFF8;
    }
    tbody td:first-child{
        border-left: 2px solid #E3EFF8;
    }
    tbody td:last-child{
        border-right: 2px solid #E3EFF8;
    }
    /* tr td {
    padding: 10px;
    } */
    
    .table td, .table th {
        padding: 0;
    }
    .table th{
        padding: 3px 11px  !important;
    }
    .list-group{
        margin-top: 20px;
    }
    .modal-open{overflow:auto;padding-right:0 !important;}
    @media(max-width:414px){
        .selectSort{
            width: 200px;
            text-overflow: ellipsis;
        }
        .form-control {
        font-size: 12px !important;
        padding: .375rem 6px !important; 
        }
     
    }
    @media(max-width:320px){
     .selectSort {
        width: 154px;
     }
   
    }
 

    a{
        color: #0087DC;
    }
   .w-tabfix{
       /* width: 100px !important; */
    }
    .in-volt{
        height: 50px;
    }

.w-tabfix{
    position: relative;
    cursor: pointer;
}

 .w-tabfix:before {
  right: 4.5px;
  content: "\f106";
  font-family: 'FontAwesome';
  font-weight: 900;
  font-size: 1rem; 
   display: block;
  visibility: visible;
  position: absolute;
  margin-top: -6px;
  color: #fff;
}

.w-tabfix:after {
  right:4.5px;
  content: "\f107";
  font-family: 'FontAwesome';
  font-weight: 900;
  font-size: 1rem; 
  line-height: 7px;
  display:block;
  visibility: visible;
  position: absolute;
  margin-top: -8px;
  color: #fff;
}
.w-tabfix.active{
    color: #0087DC;
}
.pro_desc.w-tabfix:before {
  color: #0087DC;
  opacity: 1; }
 .pro_asc.w-tabfix:after {
    color: #0087DC;
  opacity: 1;
  }
  .w-td-con{
      width: 122px;
      word-break: break-all;
  }
  
</style>
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<style>
  .select2-container .select2-selection--single {
    height: 40px;
    border-radius: 0px;
   }
   .select2-container .select2-selection--single .select2-selection__rendered{
       padding-top: 6px;
       padding-bottom: 6px
   }
   .select2-container--default .select2-selection--single .select2-selection__arrow{
    font-size: 14px;
    -webkit-appearance: none;
    -moz-appearance: none;
    background-position: right 50%;
    background-repeat: no-repeat;
    background-image: url(<?php echo e(asset('frontend-asset/image/arrow-down.svg')); ?>);
    top: 6px;
  
   }
   .select2-container--default .select2-selection--single .select2-selection__arrow b{
       display: none;
   }
    /* Zoom In #1 */
    .hover01 figure img {
        -webkit-transform: scale(1);
        transform: scale(1);
        -webkit-transition: .3s ease-in-out;
        transition: .3s ease-in-out;
    }
    .hover01 figure:hover img {
        -webkit-transform: scale(1.12);
        transform: scale(1.12);
    }
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('meta'); ?>
<title><?php echo e(isset($metatag[0]->meta_title)? $metatag[0]->meta_title :''); ?></title>
<meta name="description" content="<?php echo e(isset($metatag[0]->meta_description)? $metatag[0]->meta_description :''); ?>">
<meta name="keywords" content="<?php echo e(isset($metatag[0]->meta_key) ? $metatag[0]->meta_key :''); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('container'); ?>
<div class="padding-top-content">
</div>
<div class="products-index-banner visible-upper-mobile" id="products-index-banner-type">
    <div class="products-index-nav">
        <div class="bg-bredcrumb">
            <div class="container">
                <nav aria-label="breadcrumb" id="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item text-breadcrumb-home">
                            <a href="<?php echo e(route('index','home')); ?>"><?php echo e($staticContent['Home']); ?></a>
                        </li>
                        <li class="breadcrumb-item active text-breadcrumb" aria-current="page">
                            <a  href="#"><?php echo e($staticContent['Products']); ?></a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="padding-top-content-breadcrumb"></div>
    <div class="banner-type-product-all item"
        style="background-image: url('<?php echo e(asset('frontend-asset/image/Categories@2x.png')); ?>');">
        
        <div class="container">
            <?php $__currentLoopData = $subCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subCate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="row">
                <div class="col-lg-6">
                    <div class="box-banner-pro-type-all">
                        <div class="text-middle">
                            <h1 class="text-title-banner"><?php echo e($subCate->name); ?></h1>
                            <div class="text-p-banner my-2"><?php echo $subCate->content; ?></div>
                                <?php if(isset($subCate->file)): ?>
                                <a class="text-color-delta text-bold" href="<?php echo e(config('app.url')); ?>/medias/categories/<?php echo e($subCate->file); ?>" download="<?php echo e($subCate->name); ?>_selection_guide"><img
                                    class="align-baseline mr-2"  src="<?php echo e(asset('frontend-asset/image/icon/download-icon.svg')); ?>" alt="">
                                     <?php echo e($staticContent['Download_selection_guide']); ?>

                                </a>
                                <?php else: ?>
                                
                                <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 banner-products-pic ">
                    
                    <?php if(isset($subCate->image)): ?>
                    <img class="img-fluid middle-img" 
                        src="<?php echo e(config('app.url')); ?>/medias/categories/<?php echo e($subCate->image); ?>" alt="">
                    <?php else: ?>
                    <img class="img-fluid middle-img" 
                        src="<?php echo e(asset('frontend-asset/image/blank.png')); ?>" alt="">
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<div class="products-index-banner-tablet-down visible-mobile-only">
    <?php $__currentLoopData = $subCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subCate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="banner-type-product-all-tablet-down"
        style="background-image: url('<?php echo e(asset('frontend-asset/image/Categories@2x.png')); ?>');">
        <div class="container">
            <div class="py-xl-5 py-2 text-center">
                <p class="text-delta text-bold mt-5"><?php echo e($subCate->name); ?></p>
                    <?php if(isset($subCate->file)): ?>
                    <a href="<?php echo e(config('app.url')); ?>/medias/categories/<?php echo e($subCate->file); ?>" download="<?php echo e($staticContent['Download_selection_guide']); ?>_<?php echo e($subCate->name); ?>"><img class="align-baseline mr-1" src="<?php echo e(asset('frontend-asset/image/icon/download-icon.svg')); ?>" alt="">
                        <?php echo e($staticContent['Download_selection_guide']); ?>

                    </a>
                    <?php else: ?>
                    <?php endif; ?>
            </div>
            <div class="">
                <?php if(isset($subCate->image)): ?>
                <img class="m-auto img-res-prolis" style=""
                    src="<?php echo e(config('app.url')); ?>/medias/categories/<?php echo e($subCate->image); ?>" alt="">
                <?php else: ?>
                <img class="m-auto  img-res-prolis" style=""
                    src="<?php echo e(asset('frontend-asset/image/blank.png')); ?>" alt="">
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<div class="bg-menu-filler visible-upper-mobile">
    <div class="container">
        <div class="row">
            <div class="col-lg-2 pr-0 col-xl-4 col-md-2 my-auto">
                <div id="showfiler">
                    <a href="#sidebar" data-toggle="collapse" onclick="onclickshow(2);">
                    <img src="<?php echo e(asset('frontend-asset/image/icon/filter-icon.svg')); ?>" alt="">
                    <?php echo e($staticContent['Show_Filters']); ?>

                     </a>
                </div>
            </div>
            <div class="col-lg-10 col-xl-8 col-md-10 col-right my-auto">
                <div class="row mr-0 ml-0">
                    <div class="text-lable my-auto">
                        <?php echo e($staticContent['Display_Options']); ?> :
                    </div>
                    <div class="grid-icon icon-grid" onclick="onclickGridViewloadData();">
                        <img src="<?php echo e(asset('frontend-asset/image/icon/grid-icon.svg')); ?>" alt="">
                         
                    </div>
                    
                    <div class="grid-icon icon-list visible-upper-mobile" onclick="onclickListViewloadData();">
                        <img src="<?php echo e(asset('frontend-asset/image/icon/list-icon.svg')); ?>" alt="">
                         
                    </div>
                    <div class="text-lable my-auto">
                         <?php echo e($staticContent['Sort_by']); ?> :
                    </div>
                    <div class="input-label">                      
                        <select id="selectSortDestop" onchange="onselectSortDestop();" class="form-control ">
                            <option value="1"><?php echo e($staticContent['Model_Name_A-Z']); ?></option>
                            <option value="2"><?php echo e($staticContent['Output_Voltage_low_to_high']); ?></option>
                            <option value="3"><?php echo e($staticContent['Output_Current _low_to_high']); ?></option>
                            <option value="4"><?php echo e($staticContent['Output_Power_low_to_high']); ?></option>
                            <option value="5"><?php echo e($staticContent['Modifired_Date_newest_to_oldest']); ?></option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="visible-mobile-only">
    <div class="menu-filler-mobile">
        <div class="menu-filler-mobile-search ">
            <label class="text-dark text-bold mt-2"><?php echo e($staticContent['Search_By_Model_Name']); ?></label>
            <div class="d-flex justify-content-between">
                
                    <div class="box-search-input  mr-3">
                        <div class="box-search-icon">
                            <img src="<?php echo e(asset('frontend-asset/image/search-filters-icon.svg')); ?>" alt="">
                        </div>
                        <label for="key_mobile" class="searchinput-filters-input">
                            
                            <select id="key_mobile" class="js-example-basic-single form-control" >
                                <option></option>
                                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($pro->pro_code); ?>" ><?php echo e($pro->pro_code); ?></option> 
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </label>
                    </div>
                <button onclick="onsearchProductMobile();" class="btn-filters btn-search search-btn-product-mobile"><?php echo e($staticContent['Search']); ?></button>
            </div>
            
        </div>
        <div class="menu-filler-mobile-filter ">
            <div class=" d-flex justify-content-between h-100"> 
                <div id="showfiler-mobile" class="my-auto">
                    <div style="color:#fff;" id="filterMobile-btn" onclick="OpenFiiter();" class="filter-mobile-link text-bold"><img src="<?php echo e(asset('frontend-asset/image/icon/filter-icon.svg')); ?>" alt="">Filters</div>
                </div>
                <div class="d-flex">
                    <p class="text-white my-auto mr-2 text-card-detial text-bold">Sort by:</p>
                    <div class="input-label my-auto">                      
                        <select onchange="onselectSort();" class="form-control selectSort">
                            <option value="1"><?php echo e($staticContent['Model_Name_A-Z']); ?></option>
                            <option value="2"><?php echo e($staticContent['Output_Voltage_low_to_high']); ?></option>
                            <option value="3"><?php echo e($staticContent['Output_Current _low_to_high']); ?></option>
                            <option value="4"><?php echo e($staticContent['Output_Power_low_to_high']); ?></option>
                            <option value="5"><?php echo e($staticContent['Modifired_Date_newest_to_oldest']); ?></option>
                        </select>
                    </div>
                </div> 
            </div>
        </div>
    </div>
    
    <div class="filter-mobilenav" id="filterMobile">
        <div id="filterMobileClose" onclick="closeNavFilter()"></div>
        <div class="filter-mobile-list" id="filterMobileLdist">
            
            <div class="accordion_mobile mx-3">
            <div id="sort-filter-content_mobile" class="tap-filter mb-0"></div>
                  
                    <div class="box-btn-filters btn-box-addremove-filer text-center">
                        <button class="btn-filters btn-addremove-filer" data-toggle="modal"
                            data-target="#btn-addremove-filer-model"><?php echo e($staticContent['add']); ?> / <?php echo e($staticContent['Remove_Filter']); ?></button>
                    </div>
                    <div class="box-btn-filters btn-box-clear-filer text-center">
                        <button class="btn-filters btn-clear-filer" onclick="resetAllTab();" ><?php echo e($staticContent['Clear_Filters']); ?></button>
                    </div>
             </div>
        </div>
        
    </div>
</div>

<div class="container">
    <!-- Modal -->
    <div class="modal fade" id="btn-addremove-filer-model" tabindex="-1" role="dialog"
        aria-labelledby="ModalLongTitle" aria-hidden="true" style="padding-right:0px !important;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title-cx" id="ModalLongTitle"><?php echo e($staticContent['add']); ?> /  <?php echo e($staticContent['Remove_Filter']); ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="popUp_filter1" class="modal-body">

                </div>
                <div class="modal-footer">
                    <span disabled="disabled" data-dismiss="modal" class="btn btn-sm btn-primary reset"><?php echo e($staticContent['Reset']); ?> </span>
                    <span data-dismiss="modal"  class="btn btn-sm btn-primary btn-done"> <?php echo e($staticContent['Done']); ?> </span>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="container mb-5">
    <div class="row">
        <div class="col-xl-3 col-lg-12 col-md-12 col-xs-1 p-l-0 p-r-0 collapse in" id="sidebar">
            <div class="list-group panel">
                <div id="accordion" class="accordion visible-upper-mobile">
                    <div class="search-filter">
                        <div class="search-filter-action border-2px">
                            <p class="text-sixteen-dark"><?php echo e($staticContent['Search_By_Model_Name']); ?></p>
                            <div class="box-search-input  mr-3">
                                <div class="box-search-icon">
                                    <img src="<?php echo e(asset('frontend-asset/image/search-filters-icon.svg')); ?>" alt="">
                                </div>
                                <label for="key_destop" class="searchinput-filters-input">
                                    
                                    <select id="key_destop" class="js-example-basic-single form-control" >
                                        <option></option>
                                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($pro->pro_code); ?>" ><?php echo e($pro->pro_code); ?></option> 
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>

                                </label>
                            </div>
                            <div class="search-filter-action-btn text-center">
                                <button  onclick="onsearchProduct();" class="btn-filters btn-search"><?php echo e($staticContent['Search']); ?></button>
                            </div>
                            

                        </div>
                    </div>
                    <div id="sort-filter-content" class="tap-filter mb-0">
             
                        
                    </div>

                    
                    <div class="box-btn-filters btn-box-addremove-filer text-center">
                        <button class="btn-filters btn-addremove-filer" data-toggle="modal"
                            data-target="#btn-addremove-filer-model"> <?php echo e($staticContent['add']); ?> / <?php echo e($staticContent['Remove_Filter']); ?></button>
                    </div>
                    <div class="box-btn-filters btn-box-clear-filer text-center">
                        <button class="btn-filters btn-clear-filer" onclick="resetAllTab();"> <?php echo e($staticContent['Clear_Filters']); ?></button>
                    </div>
                </div>
            </div>
        </div>
      
        <main class="col-md-12 p-l-2 p-t-2" id="contentProList">
         
        </main>
    </div>
</div>
<input type="hidden" id="current_list_item" value="0">
<input type="hidden" id="current_method" value="0">


<?php $__env->stopSection(); ?>


<?php $__env->startSection('js'); ?>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script>
    $('.js-example-basic-single').select2({
        placeholder: '<?php echo e($staticContent['Search_By_Model_Name']); ?>'
});
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#slide-banner-products-type").owlCarousel({
            navigation: true,
            slideSpeed: 300,
            paginationSpeed: 400,
            singleItem: true,
            items: 1,
        });
      
    });
</script>
<script type="text/javascript">
    /* filter */
    function checkboxaddremove(i){
        if ($('.checkfilter' + i).is(':checked')) {
                    var inputValue = $('.checkfilter' + i).attr("value");
                    $("." + inputValue).show();
                } else {
                    var inputValue = $('.checkfilter' + i).attr("value");
                    $("." + inputValue).hide();
            }
    }
    function onclickshow(id) {
        var element = document.getElementById("contentProList");
        if ($("#sidebar").hasClass("show") == true) {
            $(element).toggleClass("col-xl-9 col-lg-12 col-md-12 pl-lg-0");
        } else {
            $(element).toggleClass("col-md-12 col-xl-9 col-lg-12");
        }
        if (id == 2) {

            var html = '';
            html =
                '<a href="#sidebar" data-toggle="collapse" onclick="onclickshow(1);" ><img src="<?php echo e(asset('frontend-asset/image/icon/filter-icon.svg')); ?>" alt=""> Hide Filters</a>';
            document.getElementById("showfiler").innerHTML = html;

        } else {

            var html = '';
            html =
                '<a href="#sidebar" data-toggle="collapse" onclick="onclickshow(2);" ><img src="<?php echo e(asset('frontend-asset/image/icon/filter-icon.svg')); ?>" alt="">Show Filters</a>';
            document.getElementById("showfiler").innerHTML = html;
        }

    }
       
    var products = <?= json_encode($products);?>;
    var product_has_property = <?= json_encode($product_has_property);?>;
    var filter_pro = <?= json_encode($filter_pro);?>;
    var domainUrl = '<?php echo e(config('app.url')); ?>';
    var series_id = '<?php echo e($se_id); ?>';
    var series =  <?= json_encode($series);?>;
    var section =  <?= json_encode($section);?>;
    var unit_dimension =  <?= json_encode($subCategories[0]->unit_dimension);?>;
    var documents_cate =  <?= json_encode($documents_cate);?>;
    var certi_products =  <?= json_encode($certi_products);?>;
    var defaultfilters =  <?= json_encode($defaultfilters);?>; 
    var pro_perti = [];
    var ser_arr = [];
    var productFilter = [];
    var productTextSearch = [];
    var fildnumber = [];
    var fildnumberMobile = [];
    var static_product = [];
    var stateType = '';
    var arr_type_an_val = [];
    var arr_value1 = [];
   
    $(document).ready(function () {
        loadAddContent();
        filtercontentMobile();
        filtercontent();
        loadPopUpfilter();
     

        var size  = $(window).width();
        if(size <= 768){
            $('#current_list_item').val(1);
            fillerData();
            // var arraydata =  loadData(products,product_has_property);
            //  onclickGridView(arraydata);
            //  $(".moreBox").slice(0, 12).show();
            //  $(".moreBox_mobile").slice(0, 12).show();
            //  $(".row_table").slice(0, 6).show();
        }else{
            fillerData();
            // FristloadData();
        }
        $.each(filter_pro, function(index_con,fil_con){
          checkboxaddremove(fil_con['field_id']);
       });
     
    });
    function loadAddContent(){
        var arr = [];
        var arrproid = [];
     
       $.each(filter_pro, function(index,element){
             if(element['field_id'] != 'series01' && element['field_id'] != 'status02' && element['field_id'] != 'safety03' && element['field_id'] != 'certifi04'  ){
                arr.push(element['field_id']);
             }
         });
         $.each(products, function(index,pro){
            arrproid.push(pro['pro_id']);  
         });
        $.ajax({
           url: "<?php echo e(route('loadPropoperty')); ?>",
           data: {
          'data': arr,
          'proid':arrproid
           },
           type: 'POST',
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
           success: function (res) {
            pro_perti =  res['data'];
           },
           async: false,
           });
      
    }
    function loadPopUpfilter(){
        var html1 = '';
        var html2 = '';
        var arr_same = [];
   
        $.each(filter_pro, function(index_con,fil_con){
            if(arr_same.indexOf(fil_con['section_id']) == -1 ){
                arr_same.push(fil_con['section_id']);
                if(fil_con['section_id'] == null){
                    html2  += '<h6 class="title-cx" style="margin-top: 10px;"><?php echo e($staticContent['Other']); ?></h6>'
                    html2  += ' <hr>';
                    html2  +='<div id="settingFilter0"></div>';
                }else{
                    html2  += '<h6 class="title-cx" style="margin-top: 10px;">'+searchsecname(fil_con['section_id'])+'</h6>'
                    html2  +=' <hr>';
                    html2  +='<div id="settingFilter'+fil_con['section_id']+ '"></div>';
                  
                }
               
            }
        // if(fil_con['field_id'] == 'series01' || fil_con['field_id'] == 'status02'  || fil_con['field_id'] == 'certifi04' || fil_con['field_id'] == 'safety03'  ){
        //     html2  += ' <input type="checkbox"  id="checkpop'+fil_con['field_id']+'" value="'+fil_con['field_id']+'"';        
        //     html2  += 'class="inp-cbx checkfilter'+fil_con['field_id']+'" style="display: none;">';       
        //     html2  += '<label class="cbx" for="checkpop'+fil_con['field_id']+'"><span>';            
        //     html2  += '<svg width="12px" height="10px" viewbox="0 0 12 10">';     
        //     html2  += '<polyline points="1.5 6 4.5 9 10.5 1"></polyline>';               
        //     html2  += '</svg></span><span>'+fil_con['title']+'</span></label>';
        // }      
              
        });
        $('#popUp_filter1').html(html2);  
        getappendhtml();
      
    }
    function getappendhtml(){
      
        $.each(filter_pro, function(index_con,fil_con){
            var html2 = '';
            html2  += ' <input type="checkbox"  id="checkpop'+fil_con['field_id']+'" value="'+fil_con['field_id']+'"';        
            html2  += 'class="inp-cbx checkfilter'+fil_con['field_id']+'" style="display: none;">';       
            html2  += '<label class="cbx" for="checkpop'+fil_con['field_id']+'"><span>';            
            html2  += '<svg width="12px" height="10px" viewbox="0 0 12 10">';     
            html2  += '<polyline points="1.5 6 4.5 9 10.5 1"></polyline>';               
            html2  += '</svg></span><span>'+fil_con['title']+'</span></label>'; 
            $('#settingFilter'+fil_con['section_id']).append(html2); 

        if(fil_con['field_id'] == 'series01' || fil_con['field_id'] == 'status02'  || fil_con['field_id'] == 'certifi04' || fil_con['field_id'] == 'safety03'  ){
           var html1 = '';
            html1  += ' <input type="checkbox"  id="checkpop'+fil_con['field_id']+'" value="'+fil_con['field_id']+'"';        
            html1  += 'class="inp-cbx checkfilter'+fil_con['field_id']+'" style="display: none;">';       
            html1  += '<label class="cbx" for="checkpop'+fil_con['field_id']+'"><span>';            
            html1  += '<svg width="12px" height="10px" viewbox="0 0 12 10">';     
            html1  += '<polyline points="1.5 6 4.5 9 10.5 1"></polyline>';               
            html1  += '</svg></span><span>'+fil_con['title']+'</span></label>'; 
            $('#settingFilter0').append(html1); 
        }

        });
        setDefultShow();
    }
    function searchsecname(id){
        var dataname = '';
        section.filter(function(data) {
         if(data['id'] == id){
            dataname =  data['name'];
         }
        });
        return dataname;
    }
    var defultfilter = [];
        $.each(defaultfilters, function(index,defaultfil){
            defultfilter.push(defaultfil['filter_id']);
        });
    function setDefultShow(){

        // var defultfilter = ['series01','status02','safety03' ,'certifi04' ,3 ,4, 8 ,31 ];
        $.each(defultfilter, function(index,defilId){
           $("#checkpop"+defilId).prop("checked" ,true);
           checkboxaddremove(defilId);
        });
      
    }
    $('.reset').click(function () {
        $.each(filter_pro, function(index_con,fil_con){
            var index = defultfilter.indexOf(fil_con['field_id']);
            if(index == -1){
                $("#checkpop"+fil_con['field_id']).prop("checked" ,false);
                checkboxaddremove(fil_con['field_id']);
            }
         });
        
    });
    $('.btn-done').click(function () {
     $.each(filter_pro, function(index_con,fil_con){
     checkboxaddremove(fil_con['field_id']);
    });

    });
    function checkboxaddremove(i){
      
        if ($('.checkfilter'+i).is(':checked')) {
                    var inputValue = $('.checkfilter' + i).attr("value");
                    $(".fliter_head"+inputValue).show();
                    $(".fliter_head_mobile"+inputValue).show();
                } else {
                    var inputValue = $('.checkfilter' + i).attr("value");
                    $(".fliter_head"+inputValue).hide();
                    $(".fliter_head_mobile"+inputValue).hide();
            }
    }

    function loadData(products ,product_has_property){
        var productarray = [];
        $.each(products, function(index,value){
        if(series_id == ''){
            var productObj = {};
          productObj['pro_id'] = value['pro_id'];
          productObj['pro_code'] = value['pro_code'];
          productObj['picture'] = value['picture'];
          productObj['series_id'] = value['series_id'];
          productObj['status_product'] = value['status_product'];
          productObj['certificate'] = value['certificate'];
          productObj['updated_at'] = value['updated_at'];
          productObj['dimensionL'] = value['dimensionL'];
          productObj['dimensionW'] = value['dimensionW'];
          productObj['dimensionD'] = value['dimensionD'];
          productObj['content'] = [];
          productObj['contentFilter'] = [];
            $.each(product_has_property, function(index2,value2){
            if(value['pro_id'] == value2['product_id']){
                productObj['content'].push(value2);
            }
         });

         $.each(pro_perti, function(index3,value3){
                if(value['pro_id'] == value3['product_id']){
                    productObj['contentFilter'].push(value3);
                }
              });
         productarray.push(productObj);
        }else if(value['series_id'] == series_id){
            var productObj = {};
          productObj['pro_id'] = value['pro_id'];
          productObj['pro_code'] = value['pro_code'];
          productObj['picture'] = value['picture'];
          productObj['series_id'] = value['series_id'];
          productObj['status_product'] = value['status_product'];
          productObj['certificate'] = value['certificate'];
          productObj['updated_at'] = value['updated_at'];
          productObj['dimensionL'] = value['dimensionL'];
          productObj['dimensionW'] = value['dimensionW'];
          productObj['dimensionD'] = value['dimensionD'];
          productObj['content'] = [];
          productObj['contentFilter'] = [];
            $.each(product_has_property, function(index2,value2){
            if(value['pro_id'] == value2['product_id']){
                productObj['content'].push(value2);
            }
         });

            $.each(pro_perti, function(index3,value3){
                if(value['pro_id'] == value3['product_id']){
                    productObj['contentFilter'].push(value3);
                }
              });
         productarray.push(productObj);
        }
     
      });
      productarray.sort(
          function (a ,b){
              return (a.pro_code > b.pro_code) ? 1 : -1;
          });
      productFilter = productarray;
    
   
       return productarray;
    }
    function mmtonich(value){
     var sum  = 0;
      if(value != null){
       cal = value * 0.0393701;
       sum = (Math.round(cal * 100) / 100).toFixed(2);
      }
      return sum;
    }

    function onclickGridViewloadData(){
      $('#current_list_item').val(1);
      var meth =  $('#current_method').val();
      if(meth == 0){
        fillerData();
      }else if(meth == 1){
        onsearchProduct();
      }else if(meth == 2){
        onsearchProductMobile();
      }
      
    }
    function fillerData(){
       productFilter = [];
       $('#current_method').val(0);
       filterAllSeries();
      var arr_filterall = [];
        checktypegroup = arr_type_an_val.every( 
                 function(val, i, arr){
                    return  val.type === arr[0].type
                 }
            );
 
        if(checktypegroup){
            $.each(productFilter, function(index,value){
            productFilter[index]['contentFilter'].filter(function(data) {
            arr_type_an_val.forEach(function(element) {
                    if(data.type_id == parseInt(element['type']) ){
                        var data1 = data.data_1 || 0;
                        var datacom1 = element['value1'] || 0;
                        var data2 = data.data_2 || 0;
                        var datacom2 = element['value2'] || 0;
                        var data3 = data.data_3 || 0;
                        var datacom3 = element['value3'] || 0;
                        var data4 = data.data_4 || 0;
                        var datacom4 = element['value4'] || 0;
                        var data5 = data.data_5 || 0;
                        var datacom5 = element['value5'] || 0;
                        var data6 = data.data_6 || 0;
                        var datacom6 = element['value6'] || 0;
                        var data7 = data.data_7 || 0;
                        var datacom7 = element['value7'] || 0;
                        var data8 = data.data_8 || 0;
                        var datacom8 = element['value8'] || 0;
                        var data9 = data.data_9 || 0;
                        var datacom9 = element['value9'] || 0;
                        var data10 = data.data_10 || 0;
                        var datacom10 = element['value10'] || 0;
                        var data11 = data.data_11 || 0;
                        var datacom11 = element['value11'] || 0;
                        var data12 = data.data_12 || 0;
                        var datacom12 = element['value12'] || 0;
                        // if(data.type_id == 4 && data.product_id == 103 ){
                        //     console.log(data1 == datacom1 ,data2 == datacom2 ,data3 == datacom3, data4 == datacom4 , data5 == datacom5);
                        // }
                        if(data1 == datacom1 
                            && data2 == datacom2
                            && data3 == datacom3
                            && data4 == datacom4
                            && data5 == datacom5
                            && data6 == datacom6
                            && data7 == datacom7
                            && data8 == datacom8
                            && data9 == datacom9
                            && data10 == datacom10 
                            && data11 == datacom11
                            && data12 == datacom12){
                            var  index = arr_filterall.findIndex( function(x){
                                return  x.pro_id === value.pro_id;
                            })
                         
                            if(index == -1){
                                arr_filterall.push(value);  
                            }
                          }
                   }
            });
            });
          });
         
        }else{
            $.each(productFilter, function(index,value){
                var arrcheck = [];
                productFilter[index]['contentFilter'].filter(function(data) {
                    arr_type_an_val.forEach(function(element) {
                                var data1 = data.data_1 || 0;
                                var datacom1 = element['value1'] || 0;
                                var data2 = data.data_2 || 0;
                                var datacom2 = element['value2'] || 0;
                                var data3 = data.data_3 || 0;
                                var datacom3 = element['value3'] || 0;
                                var data4 = data.data_4 || 0;
                                var datacom4 = element['value4'] || 0;
                                var data5 = data.data_5 || 0;
                                var datacom5 = element['value5'] || 0;
                                var data6 = data.data_6 || 0;
                                var datacom6 = element['value6'] || 0;
                                var data7 = data.data_7 || 0;
                                var datacom7 = element['value7'] || 0;
                                var data8 = data.data_8 || 0;
                                var datacom8 = element['value8'] || 0;
                                var data9 = data.data_9 || 0;
                                var datacom9 = element['value9'] || 0;
                                var data10 = data.data_10 || 0;
                                var datacom10 = element['value10'] || 0;
                                var data11 = data.data_11 || 0;
                                var datacom11 = element['value11'] || 0;
                                var data12 = data.data_12 || 0;
                                var datacom12 = element['value12'] || 0;
                        
                            if(data.type_id == parseInt(element['type'])){
                                if(data1 == datacom1 
                                    && data2 == datacom2
                                    && data3 == datacom3
                                    && data4 == datacom4
                                    && data5 == datacom5
                                    && data6 == datacom6
                                    && data7 == datacom7
                                    && data8 == datacom8
                                    && data9 == datacom9
                                    && data10 == datacom10 
                                    && data11 == datacom11
                                    && data12 == datacom12){
                                    arrcheck.push(true);
                                }
                            }
                          
                    });
                    // console.log(arr_type_an_val.length);
                });
                var con = checkmethod(arr_type_an_val);
                if(arrcheck.length >= con){
                    var  index = arr_filterall.findIndex( function(x){
                    return  x.pro_id === value.pro_id;
                    })
                    if(index == -1){
                        arr_filterall.push(value);  
                    }
                }
            });
          
        }
      
        var resultinputtext = [];
        if(arr_type_an_val.length > 0){
            resultinputtext  = loaddatafilterTypeText(arr_filterall);
        }else{
            resultinputtext  = loaddatafilterTypeText(productFilter);
        }
       
        var resultCertificate = [];
        if(arr_safety.length > 0){
          resultCertificate = loadfilterCertificate(resultinputtext);
        }else{
          resultCertificate = resultinputtext;
        }
        var resultSegment = [];
        if(arr_cer.length > 0){
           resultSegment =  loadSegment(resultCertificate);
        }else{
          resultSegment = resultCertificate;
        }
        var resultstatus = [];
        if(arr_status.length > 0){
            resultstatus =  filterStatusAll(resultSegment);
        }else{
            resultstatus  = resultSegment;
        }
      
  
        
    var summaryResult = resultstatus;
    if(arr_status.length > 0 ||  arr_cer.length > 0 ||  arr_safety.length > 0 || arr_type_an_val.length > 0 || arr_inputtxt.length > 0 ){
        listItemFiler(summaryResult);
        findresultfeildbypro(summaryResult);
        productFilter = summaryResult;
     }else{
        listItemFiler(productFilter);
        findresultfeildbypro(productFilter);
     }
       
      $('#key_destop').val("");
      $('#key_mobile').val("");
    }
    function loaddatafilterTypeText(arr_filterall){
       var filterIn = [];
        checktypegroupText = arr_inputtxt.every( 
                 function(val, i, arr){
                    return  val.type === arr[0].type
                 }
            );
    if(arr_inputtxt.length > 0){
        if(checktypegroupText){
            $.each(arr_filterall, function(index,value){
            arr_filterall[index]['contentFilter'].filter(function(data) {
                arr_inputtxt.forEach(function(element) {
                        if(data.type_id == element['type']){
                            if(data.value_text == null){
                                data.value_text = '';
                            }
                            if(element['value_text'] == null){
                                data.value_text = '';
                            }
                            if(data.value_text.trim() == element['value_text'].trim()){
                                var  index = filterIn.findIndex(
                                    function(x){
                                        return x.pro_id === value.pro_id;
                                    })
                                if(index == -1){
                                    filterIn.push(value);  
                                }
                            }
                    }
                });
            });
        });
      }else{
        $.each(arr_filterall, function(index,value){
            var checkarr = [];
            arr_filterall[index]['contentFilter'].filter(function(data) {
                arr_inputtxt.forEach(function(element) {
                        if(data.type_id == element['type']){
                            if(data.value_text == null){
                                data.value_text = '';
                            }
                            if(element['value_text'] == null){
                                data.value_text = '';
                            }
                            if(data.value_text.trim() == element['value_text'].trim()){
                                checkarr.push(true);
                            }
                    }
                });
            });
            var con = checkmethod(arr_inputtxt);
           if(checkarr.length >= con){
            var  index = filterIn.findIndex(
                     function(x){
                    return x.pro_id === value.pro_id;
                     })
                    if(index == -1){
                     filterIn.push(value);  
                }
           }
         
        });
      }   
    }else{
        filterIn = arr_filterall;
    }
      return filterIn;
    }
    function loadSegment(arrFilterInput){
        var profilter = [];
        var arr_seg = [];
        var proreFilter = [];
        if(arr_cer.length > 0){
            arr_cer.forEach(function(element) {
                certi_products.filter(function(data) {
                    if(data.certificate_id == element){
                        arr_seg.push(data);
                    }
                });
                });
                // if(arr_cer.length > 1){
                //         var lookup = arr_seg.reduce(function(a,e) {
                //         a[e.product_id] = ++a[e.product_id] || 0;
                //         return a;
                //         }, {});
                //         profilter =  arr_seg.filter(function(e) {
                //            return lookup[e.product_id];
                //         });
                //     }else{
                       
                //     }
                profilter =  arr_seg;
                profilter.forEach(function(element) {
                    arrFilterInput.filter(function(data) {
                        if(data.pro_id == element.product_id){
                            var  index = proreFilter.findIndex(
                                function(x){
                                    return x.pro_id === data.pro_id;
                                })
                            if(index == -1){
                                proreFilter.push(data);
                            }
                        }
                    });
                });
            return  proreFilter;
        }else{
            return  arrFilterInput;
        }
    }
    function loadfilterCertificate(arrFilter){
       
        var arr_pro_doc = [];
        var profilter = [];
        var proarr = [];
        var values = [];
        $.ajax({
           url: "<?php echo e(route('loaddocumentPro')); ?>",
           data: {
          'data': arr_safety,
           },
           type: 'POST',
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
           success: function (res) {
             values = res['data']
           },
           async: false,
           });

           profilter =  values;
            profilter.filter(function(data) {
               var index2  = proarr.indexOf(data.product_id);
                 if(index2 == -1){
                    proarr.push(data.product_id);
                 }
             });
             arrFilter.filter(function(data2) {
            proarr.forEach(function(element2) {
                if(data2.pro_id == element2){
                    var  index = arr_pro_doc.findIndex(
                        function(x){
                        return x.pro_id === data2.pro_id;
                        })
                        if(index == -1){
                        arr_pro_doc.push(data2);  
                        }
                }
            });
        });

        return arr_pro_doc;
    }
    function filterStatusAll(arrFilter){
        var filter = [];
        arrFilter.filter(function(data) {
            arr_status.forEach(function(element) {
                if(data.status_product == element){
                    var  index = filter.findIndex(
                        function(x){
                            return x.pro_id === data.pro_id;
                        })
                        if(index == -1){
                            filter.push(data);  
                        }
                    }
            });
        });
      return filter;
    }
    

    function FristloadData(){   
        var arraydata =  loadData(products,product_has_property);
        onclickListView(arraydata ,1 ,1);
        $(".moreBox").slice(0, 8).show();
        $(".moreBox_mobile").slice(0,8).show();
        $(".row_table").slice(0, 8).show();
    }
   
    function onclickListViewloadData(){
        $('#current_list_item').val(0);
        var meth =  $('#current_method').val();
        if(meth == 0){
        fillerData();
         }else if(meth == 1){
        onsearchProduct();
      }else if(meth == 2){
        onsearchProductMobile();
      }
     
    }
    function viewKey(key){
            var newkey = key.replace('/', '@');
           return newkey;
    }
    function onclickGridView(productarray) {
        $('#current_list_item').val(1);
        var html = '';
        html += '<div class="GridView visible-upper-mobile" id="GridView">';
        html += '<div class="margin-top-card">';
        html += '<div class="count-products">';
        html += '<span class="countproduct"></span> <?php echo e($staticContent['Product(s)']); ?>';
        html += '</div>';
        html += '<div id="cardGridList" class="row">';
        $.each(productarray, function(index_pro,pro){
        html += '<div class=" col-xl-3 col-lg-4 col-md-4">';
        html += '<a href="<?php echo e(route('productsDetailsByType')); ?>/<?php echo e(preg_replace('/\s+/', '-', $subCate->url_item)); ?>/'+viewKey(pro['pro_code']) +'">';
        html += '<div class=" margin-p-left-card item card moreBox"  style="display: none;">';
        if(pro['status_product'] != 1){
        html += '<div style="background-color:'+set_sta_color(pro['status_product']) +';" class="new-tag">'+statuspro(pro['status_product'])+'</div>';
        }
        html += '<div class="card-body ft-products-item hover01"><figure><img src="'+domainUrl+'/upload/thumbs/'+pro['picture']+'" class="product-cat mb-2" style="width:70%;"></figure>';
        html += '<div class="">';
        html += '<h4 class="text-title-ft">'+pro['pro_code']+'</h4>';
        html += '</a>';
        html += '<div class="d-flex flex-wrap" >';
        html += '<div class="mr-3">';
        html += '<div class="out-volt ">';
        html += '<h6 class="text-title-ft-sub"><?php echo e($staticContent['Output_Voltage']); ?></h6>';
        var content = onlycontent(pro['content']);
        // if(content[0]['data_1'] != null){
        //    html += '<div class="text-ft-sub text-one">'+content[1]['data_1']+content[1]['unit_name']+'</div>';
        // }else{
        //     html += '<div class="text-ft-sub text-one">-</div>';
        // } 
        var arrcon1 = [content[1]['data_1'],content[1]['data_2'],content[1]['data_3'],content[1]['data_4'],content[1]['data_5'],
            content[1]['data_6'],content[1]['data_7'],content[1]['data_8'],content[1]['data_9'],content[1]['data_10'],content[1]['data_11'],
            content[1]['data_12']
            ]
            var arrcon2 = [content[2]['data_1'],content[2]['data_2'],content[2]['data_3'],content[2]['data_4'],content[2]['data_5'],
            content[2]['data_6'],content[2]['data_7'],content[2]['data_8'],content[2]['data_9'],content[2]['data_10'],content[2]['data_11'],
            content[2]['data_12']
            ]
            var arrcon3 = [content[0]['data_1'],content[0]['data_2'],content[0]['data_3'],content[0]['data_4'],content[0]['data_5'],
            content[0]['data_6'],content[0]['data_7'],content[0]['data_8'],content[0]['data_9'],content[0]['data_10'],content[0]['data_11'],
            content[0]['data_12']
            ]

        html += '<div class="text-ft-sub text-one">'+checkNullShow(arrcon1,content[1]['unit_name'],content[1]['status_input']).substr(0, 19) +'</div>';
        html += '</div>';
        html += '<div class="out-power">';
        html += '<h6 class="text-title-ft-sub"> <?php echo e($staticContent['Output_Power']); ?></h6>';
        html += '<div class="text-ft-sub text-one">'+checkNullShow(arrcon2,content[2]['unit_name'],content[2]['status_input']).substr(0, 19)+'</div>';
     
        html += '</div>';
        html += '</div>';
        html += '<div class="">';
        html += '<div class="out-current">';
        html += '<h6 class="text-title-ft-sub"><?php echo e($staticContent['Output_Current']); ?></h6>';
        html += '<div class="text-ft-sub text-one">'+checkNullShow(arrcon3,content[0]['unit_name'],content[0]['status_input']).substr(0, 19) +'</div>'; 
        html += '</div>';
        html += '<div class="in-volt">';
        html += '<h6 class="text-title-ft-sub"><?php echo e($staticContent['Input_Voltage']); ?></h6>';
        if(content[3]['value_text'] != null && content[3]['value_text'] != 'null'){
        html += '<div class="text-ft-sub text-one">'+content[3]['value_text'].substr(0, 14)+'</div>';
        }else{
            html += '<div class="text-ft-sub text-one">-</div>'; 
        }
        html += '</div>';
        html += '</div>';
        html += '</div>';
        html += '<div class="dimension">';
        html += '<h6 class="text-title-ft-sub text-one"><?php echo e($staticContent['Dimensions']); ?> (L x W x '+unit_dimension+') </h6>';
        if(pro['dimensionL'] != null && pro['dimensionL'].length < 7 && ['dimensionW'] != '' && pro['dimensionD'] != ''){
        html += '<p class="text-ft-sub text-one">'+pro['dimensionL']+'x'+pro['dimensionW']+'x'+pro['dimensionD']+' mm</p>';
        html += '<p class="text-ft-sub text-one">'+mmtonich(pro['dimensionL'])+'”x'+mmtonich(pro['dimensionW'])+'”x'+mmtonich(pro['dimensionD'])+'”</p>';
        }else if(pro['dimensionL'] != null){
        html += '<p class="text-ft-sub text-one">'+pro['dimensionL'].substr(0, 18)+'</p>';
        }else{
        html += '<p class="text-ft-sub text-one">-</p>';
        }
        html += '</div>';
        html += '<div href="#" class="btn btn-ft mt-2" onclick="showNavCoparison('+pro['pro_id']+' ,<?php echo e($cateid); ?>)" >+<?php echo e($staticContent['Add_to_Compare']); ?></div>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
         });
        html += '</div>';
        html += '</div>';
        html += ' <div class="text-center mb-2" id="loadMore" style="" onclick="loadeMore(event,4)">';
        html += '<a href="#"  class="btn btn-boxen"> <?php echo e($staticContent['See_More']); ?></a>';
        html += '</div>';
        html += '</div>';
      

        html += '<div class="GridView visible-mobile-only" id="GridView">';
        html += '<div class="margin-top-card ">';
        html += '<div id="cardGridList" class="d-flex flex-wrap">';
        $.each(productarray, function(index_pro,pro){
        html += '<div class="margin-p-left-card column-grid-card-mobile moreBox_mobile"  style="display: none;">';
        html += '<div class="item card">';
        html += '<a href="<?php echo e(route('productsDetailsByType')); ?>/<?php echo e(preg_replace('/\s+/', '-', $subCate->url_item)); ?>/'+viewKey(pro['pro_code']) +'">';
            if(pro['status_product'] != 1){
        html += '<div style="background-color:'+set_sta_color(pro['status_product']) +';" class="new-tag">'+statuspro(pro['status_product'])+'</div>';
            }
        html += '<div class="card-body ft-products-item hover01"><figure><img src="'+domainUrl+'/upload/thumbs/'+pro['picture']+'" class="product-cat mb-2" style="width:70%;"></figure>';
        html += '<div class="">';
        html += '<h6 class="text-title-ft">'+pro['pro_code']+'</h6>';
        html += '</a>';
        html += '<div class="d-flex flex-wrap" >';
        html += '<div class="mr-5">';
        html += '<div class="out-volt mt-1">';
        var content = onlycontent(pro['content']);
        html += '<p class="text-title-ft-sub text-two"><?php echo e($staticContent['Output_Voltage']); ?></p>';
            var arrcon1 = [content[1]['data_1'],content[1]['data_2'],content[1]['data_3'],content[1]['data_4'],content[1]['data_5'],
            content[1]['data_6'],content[1]['data_7'],content[1]['data_8'],content[1]['data_9'],content[1]['data_10'],content[1]['data_11'],
            content[1]['data_12']
            ]
            var arrcon2 = [content[2]['data_1'],content[2]['data_2'],content[2]['data_3'],content[2]['data_4'],content[2]['data_5'],
            content[2]['data_6'],content[2]['data_7'],content[2]['data_8'],content[2]['data_9'],content[2]['data_10'],content[2]['data_11'],
            content[2]['data_12']
            ]
            var arrcon3 = [content[0]['data_1'],content[0]['data_2'],content[0]['data_3'],content[0]['data_4'],content[0]['data_5'],
            content[0]['data_6'],content[0]['data_7'],content[0]['data_8'],content[0]['data_9'],content[0]['data_10'],content[0]['data_11'],
            content[0]['data_12']
            ]
            
        html += '<div class="text-ft-sub text-two">'+checkNullShow(arrcon1,content[1]['unit_name'],content[1]['status_input']).substr(0, 19)+'</div>';
 
        html += '</div>';
        html += '<div class="out-power mt-2">';
        html += '<p class="text-title-ft-sub text-two"><?php echo e($staticContent['Output_Power']); ?></p>';
        html += '<div class="text-ft-sub text-two">'+checkNullShow(arrcon2,content[2]['unit_name'],content[2]['status_input']).substr(0, 19)+'</div>'; 
        html += '</div>';
        html += '</div>';
        html += '<div class="">';
        html += '<div class="out-current mt-2">';
        html += '<p class="text-title-ft-sub text-two"><?php echo e($staticContent['Output_Current']); ?></p>';
        html += '<div class="text-ft-sub text-two">'+checkNullShow(arrcon3,content[0]['unit_name'],content[0]['status_input']).substr(0, 19)+'</div>';
      
        html += '</div>';
        html += '<div class="in-volt mt-2">';
        html += '<p class="text-title-ft-sub text-two"><?php echo e($staticContent['Input_Voltage']); ?></p>';
        if(content[3]['value_text'] != null && content[3]['value_text'] != 'null'){
        html += '<div class="text-ft-sub text-two">'+content[3]['value_text'].substr(0, 18)+'</div>';
        }else{
        html += '<div class="text-ft-sub text-two">-</div>'; 
        }
        html += '</div>';
        html += '</div>';
        html += '</div>';
        html += '<div class="dimension mt-2">';
        html += '<p class="text-title-ft-sub text-two"><?php echo e($staticContent['Dimensions']); ?> (L X W X '+unit_dimension+')</p>';
        if(pro['dimensionL'] != null && pro['dimensionL'].length < 7 && pro['dimensionW'] != '' && pro['dimensionD'] != ''){
        html += '<p class="text-ft-sub text-two">'+pro['dimensionL']+'x'+pro['dimensionW']+'x'+pro['dimensionD']+' mm</p>';
        html += '<p class="text-ft-sub text-two">'+mmtonich(pro['dimensionL'])+'”x'+mmtonich(pro['dimensionW'])+'”x'+mmtonich(pro['dimensionD'])+'”</p>';
        }else if(pro['dimensionL'] != null){
        html += '<p class="text-ft-sub text-two">'+pro['dimensionL'].substr(0, 14)+'</p>';    
        }else{
        html += '<p class="text-ft-sub text-two">-</p>';  
        }
        html += '</div>';
        html += '</div>';
        html += '</div>'; 
        html += '<div  class="btn btn-ft rounded-0" onclick="showNavCoparison('+pro['pro_id']+',<?php echo e($cateid); ?>)">+ <?php echo e($staticContent['Add_to_Compare']); ?> </div>';
        html += '</div>';
        html += '</div>';
       });
        html += '</div>';
        html += '</div>';
        html += ' <div class="text-center my-3" id="loadMore_mobile" style="" onclick="loadeMoreMobile(event,4)">';
        html += '<a href="#"  class="btn btn-boxen"> <?php echo e($staticContent['See_More']); ?> </a>';
        html += '</div>';
        html += '</div>';
    
       

        $('#contentProList').html(html);
        $(document).ready(function () {
            $('.icon-grid img').addClass('bord-icon');
            $('.icon-list img').removeClass('bord-icon');
            $('#contentProList').removeClass('space-listviews');
        });
    }


    function onclickListView(productarray ,type ,id) {
  
        var html1 = '';
        html1 += '<div class="ListView visible-upper-mobile" id="ListView">';
        html1 += '<div class="count-products">';
        html1 += '<span class="countproduct"></span> <?php echo e($staticContent['Product(s)']); ?>';
        html1 += '</div>';
        html1 += '<table id="dtBasicExample" class="table" cellspacing="5em" width="100%">';
        html1 += '<thead>';
        html1 += '<tr class="headder-bg-table">';
        html1 += '<th id="sortdata1" class="th-sm header-font-table w-tabfix" onclick="selectTable(1)"><?php echo e($staticContent['Model_Name']); ?></th>';
        html1 += '<th id="sortdata2" class="th-sm header-font-table w-tabfix" onclick="selectTable(2)"><span><?php echo e($staticContent['Output_Voltage']); ?> </span></th>';
        html1 += '<th id="sortdata3" class="th-sm header-font-table w-tabfix" onclick="selectTable(3)"><?php echo e($staticContent['Output_Current']); ?></th>';
        html1 += '<th id="sortdata4" class="th-sm header-font-table w-tabfix"onclick="selectTable(4)"><?php echo e($staticContent['Output_Power']); ?> </th>';
        html1 += '<th id="sortdata5" class="th-sm header-font-table w-tabfix" onclick="selectTable(5)"><?php echo e($staticContent['Input_Voltage']); ?></th>';
        html1 += '<th id="sortdata6" class="th-sm header-font-table w-tabfix"onclick="selectTable(6)" ><?php echo e($staticContent['Dimensions']); ?> (L x W x '+unit_dimension+')</th>';
        html1 += '</tr>';
        html1 += '</thead>';
        html1 += '<tbody id="listcardList">';
        html1 += '</tbody>';
        html1 += ' </table>';
        html1 += '</div>';
        html1 += ' <div class="text-center mb-2" id="loadlistview" style="" onclick="loadlistview(event,4)">';
        html1 += '<a href="#"  class="btn btn-boxen"><?php echo e($staticContent['See_More']); ?></a>';
        html1 += '</div>';
        $('#contentProList').html(html1);
        listviewCard(productarray);
        // if(type == 0){
        //     $('#dtBasicExample').DataTable({"order": [[ 0, "asc" ]] ,  paging: false} );
        // }else if(type == 1){
        //     $('#dtBasicExample').DataTable({"order": [[ 1, "asc" ]] ,  paging: false}  );
        // }else if(type == 2){
        //     $('#dtBasicExample').DataTable({"order": [[ 2, "asc" ]],  paging: false}  );
        // }else if(type == 3){
        //     $('#dtBasicExample').DataTable({"order": [[ 3, "asc" ]],  paging: false} );
        // }
        if(type == 1){
            $('#sortdata'+id).addClass('pro_asc active');
        }else{
            $('#sortdata'+id).addClass('pro_desc active');
        }
        $('.countproduct').text(productarray.length);
        $(document).ready(function () {
            $('.icon-list img').addClass('bord-icon');
            $('.icon-grid img').removeClass('bord-icon');
            $('#contentProList').addClass('space-listviews');

        });
    }

    function listviewCard(productarray) {
       
        var html1 = '';
    
        $.each(productarray, function(index_pro,pro){
        html1 += '<tr class="box-cardlist row_table" style="display: none;">';
        html1 += '<td>';
        html1 += '<div class="cardlist-toadd">';
        html1 += '<div class="cardlist-view hover01">';
        html1 += '<a href="<?php echo e(route('productsDetailsByType')); ?>/<?php echo e(preg_replace('/\s+/', '-', $subCate->url_item)); ?>/'+viewKey(pro['pro_code']) +'">';
            if(pro['status_product'] != 1){
        html1 += '<div style="background-color:'+set_sta_color(pro['status_product']) +';" class="text-over-cardlist"> '+ statuspro(pro['status_product'])+'';
        html1 += '</div>';
            }
        html1 += '<figure><img class="img-card-list" src="'+domainUrl+'/upload/thumbs/'+pro['picture']+'"></figure>';
        html1 += '</div>';
        html1 += '<div class="cardlist-text">';
        html1 += '<h5 class="text-title-ft-listv">'+pro['pro_code']+'</h5>';
        html1 += '</div>';
        html1 += '</a>';
        html1 += '<div class="w-100">';
        html1 += '<div class="btn btn-ft" onclick="showNavCoparison('+pro['pro_id']+' ,<?php echo e($cateid); ?>)"> + <?php echo e($staticContent['Add_to_Compare']); ?></div>';
        html1 += '</div>';
        html1 += '</div>';
        html1 += '</td>';
        var content =  onlycontent(pro['content']);
         var arrcon1 = [content[1]['data_1'],content[1]['data_2'],content[1]['data_3'],content[1]['data_4'],content[1]['data_5'],
            content[1]['data_6'],content[1]['data_7'],content[1]['data_8'],content[1]['data_9'],content[1]['data_10'],content[1]['data_11'],
            content[1]['data_12']
            ]
            var arrcon2 = [content[0]['data_1'],content[0]['data_2'],content[0]['data_3'],content[0]['data_4'],content[0]['data_5'],
            content[0]['data_6'],content[0]['data_7'],content[0]['data_8'],content[0]['data_9'],content[0]['data_10'],content[0]['data_11'],
            content[0]['data_12']
            ]
            var arrcon3 = [content[2]['data_1'],content[2]['data_2'],content[2]['data_3'],content[2]['data_4'],content[2]['data_5'],
            content[2]['data_6'],content[2]['data_7'],content[2]['data_8'],content[2]['data_9'],content[2]['data_10'],content[2]['data_11'],
            content[2]['data_12']
            ]
       
        html1 += ' <td class="text-middle-td"> <div class="w-td-con">'+checkNullShow(arrcon1,content[1]['unit_name'] ,content[1]['status_input'])+'</div></td>';
        html1 += '<td class="text-middle-td"> <div class="w-td-con">'+checkNullShow(arrcon2,content[0]['unit_name'] ,content[0]['status_input'])+'</div></td>';
        html1 += ' <td class="text-middle-td"> <div class="w-td-con">'+checkNullShow(arrcon3,content[2]['unit_name'] ,content[2]['status_input'])+'</div></td>';
        if(content[3]['value_text'] != null && content[3]['value_text'] !='' && content[3]['value_text'] != 'null'){
            html1 += ' <td class="text-middle-td">'+ stringfor(content[3]['value_text'])+'</td>';
        }else if(content[3]['value_text'] != null && content[3]['value_text'] != 'null'){
            html1 += ' <td class="text-middle-td">'+content[3]['value_text']+'</td>';
        }else{
            html1 += ' <td class="text-middle-td">-</td>';
        }
    
        if(pro['dimensionL'] != null && pro['dimensionL'].length < 7 &&pro['dimensionW'] != '' && pro['dimensionD'] != ''){
        html1 += '<td class="text-middle-td">'+pro['dimensionL']+' x '+pro['dimensionW']+' x '+pro['dimensionD']+' mm ';
        html1 += '<br>'+mmtonich(pro['dimensionL'])+'” x '+mmtonich(pro['dimensionW'])+'” x '+mmtonich(pro['dimensionD'])+'”</td>';
        }else{
        html1 += '<td class="text-middle-td">'+pro['dimensionL']+'</td>';  
        }
        html1 += '</tr>';

       });


        $('#listcardList').html(html1);

    }
    function checkNullShow(dataarr,unit,status){
     
        var string = '';
        var arrstri = [];
       if(status == 1 || status == 2){
        $.each(dataarr, function(index,data){
            if(data != null && data != ''){
              arrstri.push(data+unit);
            }
        });
        string = arrstri.join();
       }else if(status == 3){
        string = dataarr[0]+'-'+dataarr[1]+unit;
       }
       if(string == ''){
        string = '-';
       }
    //    console.log(string);
         return  string;
    }
    function stringfor(str){
        var arrStr = str.split(/\s/g);
        var strfor = '';
        $.each(arrStr, function(index,data){
            if(data.length != 0){
                if(data.length < 9 ){
                strfor += data.replace("<br>", "");
                strfor += ' ';
              
             }else{
                strfor += data.replace("<br>", "");
                strfor += '<br>';
             }
            }
            });
            return strfor;
    }
     var arr_select = [];
    function selectTable(id){
               $('.w-tabfix').removeClass('pro_asc active');
               $('.w-tabfix').removeClass('pro_desc active');
              var index = arr_select.indexOf(id);
            if (index == -1) {
                $('#sortdata'+id).addClass('pro_asc active');
                arr_select.push(id);
                orderTable(id,1);
            }else{
                orderTable(id,2);
                arr_select.splice(index, 1);
              $('#sortdata'+id).addClass('pro_desc active');
              
            }
    }
    function orderTable(id ,type){
        var arr_val = productFilter;
        var arr_result = [];
       if(type == 1){
            if(id == 1){
            arr_result = sortModelName(arr_val);
            }else if(id == 2){
                arr_result = sortOutputLH(arr_val ,4);
            }else if(id == 3){
                arr_result = sortOutputLH(arr_val ,3);
            }else if(id == 4){
                arr_result = sortOutputLH(arr_val ,8);
            }else if(id == 5){
                arr_result = sortInputLH(arr_val ,31);
            }else if(id == 6){
                arr_result = diminsionLH(arr_val);
            }
       }else{
            if(id == 1){
            arr_result = sortModelNameZA(arr_val);
            }else if(id == 2){
                arr_result = sortOutputHL(arr_val ,4);
            }else if(id == 3){
                arr_result = sortOutputHL(arr_val ,3);
            }else if(id == 4){
                arr_result = sortOutputHL(arr_val ,8);
            }else if(id == 5){
                arr_result = sortInputHL(arr_val ,31);
            }else if(id == 6){
                arr_result = diminsionHL(arr_val);
            }
       }
 
       var current_list =  $('#current_list_item').val();
      if(current_list == 0){
        onclickListView(arr_result ,type ,id);
      }else{
        onclickGridView(arr_result);
      }
        $(".moreBox").slice(0, 8).show();
        $(".moreBox_mobile").slice(0, 8).show();
        $(".row_table").slice(0, 8).show();
        $('.countproduct').text(arr_result.length);

  
    }
      
    function df(value ,unit){
        var data = '-';
        if(value != null){
          data = value+unit;
        }
        return data;
    }
    function statuspro(id){
        var name = '';
         if(id == 2){
            name = 'NEW';
         }else if(id == 3){
            name = 'UPDATED';
         }else if(id == 4){
            name = 'EOL';
         }
         return name;
    }
    function set_sta_color(id){
        var color = '';
        if(id == 2){
            color = '#76B900';
         }else if(id == 3){
            color = '#337ab7';
         }else if(id == 4){
            color = '#f0ad4e';
         }
         return color;
    }

    function onlycontent(arr){
        var arrcontent = [];
        var arr_id = [4,3,8,31];
        $.each(arr, function(index,data){
            $.each(arr_id, function(index2,data2){
              if(data2 == data['type_id'] ){
                arrcontent.push(data);
              }
            });
        });
        return arrcontent.sort(function(a, b) {
            return a.type_id > b.type_id ? 1 : -1;
        });
    }
   

    function  filtercontent(){
     
       var property_load = [];
       property_load = pro_perti;
       var doc_safety = documents_cate;
        var status = [ {id:2,name:'New'}, {id:3,name:'Updated'},{id:4,name:'EOL'}];
        var certificates = [ {id:1,name:'Industrial'}, {id:2,name:'Medical'},{id:3,name:'Lighting & Signage'}];
        var data_1 = [];
        var data_text = [];
        var html3 = '';
        $.each(filter_pro, function(index_con,fil_con){
            html3 += '<div class="fliter_head'+fil_con['field_id']+'"><div class="card-header-filter collapsed" data-toggle="collapse"';
            html3 += 'href="#collapse-fliter_'+fil_con['field_id']+'">';
            html3 += '<a class="card-title text-sixteen-dark">';
            html3 += fil_con['title'];
            html3 += '</a>';
            html3 += '</div>';
            html3 += '<div id="collapse-fliter_'+fil_con['field_id']+'" class="card-body-filter collapse '+(fil_con['field_id']== 'series01'?'show':'') +'" >';
            html3 += '<form id="form-'+fil_con['field_id']+'" class="'+fil_con['field_id']+'">';
            html3 += '<div class="scrollbar dataserchfilter'+fil_con['field_id']+'" id="style-1">';
            if(fil_con['field_id'] == 'series01'){
                $.each(series, function(index_serie,serie){
                    html3 += '<div onchange="series_filter('+"'"+fil_con['field_id']+"'"+','+serie['se_id']+');" class="box-input-checkbox">';
                    html3 += '<input  class="inp-cbx" id="cx-'+fil_con['field_id']+serie['se_id']+'" type="checkbox" style="display: none;" >';
                    html3 += '<label class="cbx" for="cx-'+fil_con['field_id']+serie['se_id']+'"><span>';
                    html3 += '<svg width="12px" height="10px" viewbox="0 0 12 10">';
                    html3 += '<polyline points="1.5 6 4.5 9 10.5 1"></polyline>';
                    html3 += '</svg></span><span>'+serie['title']+'</span></label>';
                    html3 += '</div>' ; 
                  });
             }
             if(fil_con['field_id'] == 'status02'){
                $.each(status, function(index_status,sta){
                    html3 += '<div onchange="filterstatus('+"'"+fil_con['field_id']+"'"+','+sta['id']+');" class="box-input-checkbox">';
                    html3 += '<input  class="inp-cbx" id="cx-'+fil_con['field_id']+index_status+'" type="checkbox" style="display: none;" />';
                    html3 += '<label class="cbx" for="cx-'+fil_con['field_id']+index_status+'"><span>';
                    html3 += '<svg width="12px" height="10px" viewbox="0 0 12 10">';
                    html3 += '<polyline points="1.5 6 4.5 9 10.5 1"></polyline>';
                    html3 += '</svg></span><span class="">'+sta['name']+'</span></label>';
                    html3 += '</div>' ; 
                  });
             }
             if(fil_con['field_id'] == 'safety03'){
                $.each(doc_safety, function(id_doc,safety){
                    html3 += '<div onchange="filtersafety('+"'"+fil_con['field_id']+"'"+','+safety['id']+');" class="box-input-checkbox">';
                    html3 += '<input  class="inp-cbx" id="cx-'+fil_con['field_id']+id_doc+'" type="checkbox" style="display: none;" />';
                    html3 += '<label class="cbx" for="cx-'+fil_con['field_id']+id_doc+'"><span>';
                    html3 += '<svg width="12px" height="10px" viewbox="0 0 12 10">';
                    html3 += '<polyline points="1.5 6 4.5 9 10.5 1"></polyline>';
                    html3 += '</svg></span><span class="">'+safety['title']+'</span></label>';
                    html3 += '</div>' ; 
                  });
             }
             if(fil_con['field_id'] == 'certifi04'){
                $.each(certificates, function(index_cer,certi){
                    html3 += '<div onchange="filterCerti('+"'"+fil_con['field_id']+"'"+','+certi['id']+');" class="box-input-checkbox">';
                    html3 += '<input  class="inp-cbx" id="cx-'+fil_con['field_id']+index_cer+'" type="checkbox" style="display: none;" />';
                    html3 += '<label class="cbx" for="cx-'+fil_con['field_id']+index_cer+'"><span>';
                    html3 += '<svg width="12px" height="10px" viewbox="0 0 12 10">';
                    html3 += '<polyline points="1.5 6 4.5 9 10.5 1"></polyline>';
                    html3 += '</svg></span><span>'+certi['name']+'</span></label>';
                    html3 += '</div>' ; 
                  });
             }
             if(fil_con['field_id'] != 'series01' && fil_con['field_id'] != 'status02' && fil_con['field_id'] != 'certifi04' && fil_con['field_id'] != 'safety03'  ){
               var property =  property_load.sort( 
                   function(a, b){
                       return a.data_1 > b.data_1 ? 1 : -1;
                    });
               
               
                $.each(property, function(index_per,ppt){
                      
                  if(fil_con['field_id'] == ppt['type_id']){
                    var object  = {};
                    var text = null;
                    if(ppt['value_text'] != null){
                        text = ppt['value_text'].replace(/\s/g, '').toLowerCase().replace(/^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g, '').trim();
                       
                    }
                    object = {
                       'id':index_per,
                       'type':fil_con['field_id'],
                       'data':ppt['data_1'],
                       'status_input':ppt['status_input'],
                       'text':text,
                    }
                    if(ppt['type_value'] == 'number' && ppt['data_1'] != null){
                      objectFiled = {
                        'field_id':fil_con['field_id'],
                        'type_box':ppt['status_input'],
                      }
                      var  index_fi = fildnumber.findIndex(
                         function(x) {
                         return  x.field_id === fil_con['field_id'];
                         })
                        if(index_fi == -1){
                            fildnumber.push(objectFiled);
                        }
                        if(containsObject(object, data_1)){
                            data_1.push(object);
                            html3 += '<div onchange="fillerNumber('+"'"+fil_con['field_id']+"'"+','+ppt['data_1']+','+ppt['data_2']+','+ppt['data_3'] +','+ppt['data_4'] +','+ppt['data_5']+');" class="box-input-checkbox">';
                            html3 += '<input  class="inp-cbx" id="cx-normalnum'+fil_con['field_id']+index_per+'" type="checkbox" style="display: none;" />';
                            html3 += '<label class="cbx" for="cx-normalnum'+fil_con['field_id']+index_per+'"><span>';
                            html3 += '<svg width="12px" height="10px" viewbox="0 0 12 10">';
                            html3 += '<polyline points="1.5 6 4.5 9 10.5 1"></polyline>';
                            if(ppt['status_input'] == 2 || ppt['status_input'] == 1 ){
                                if(ppt['data_2'] != null && ppt['data_3'] != null && ppt['data_4'] != null && ppt['data_5'] != null ){
                                html3 += '</svg></span><span>'+ppt['data_1'] +ppt['unit_name']+','+ppt['data_2'] +ppt['unit_name'] +','+ppt['data_3'] +ppt['unit_name']+','+ppt['data_4'] +ppt['unit_name']+','+ppt['data_5'] +ppt['unit_name']+'</span></label>';
                            }else if(ppt['data_2'] != null && ppt['data_3'] != null && ppt['data_4'] != null  ){
                                html3 += '</svg></span><span>'+ppt['data_1'] +ppt['unit_name']+','+ppt['data_2'] +ppt['unit_name'] +','+ppt['data_3'] +ppt['unit_name']+','+ppt['data_4'] +ppt['unit_name']+'</span></label>';
                            }else if(ppt['data_2'] != null && ppt['data_3'] != null  ){
                                html3 += '</svg></span><span>'+ppt['data_1'] +ppt['unit_name']+','+ppt['data_2'] +ppt['unit_name'] +','+ppt['data_3'] +ppt['unit_name']+'</span></label>';
                            }else if(ppt['data_2'] != null ){
                                html3 += '</svg></span><span>'+ppt['data_1'] +ppt['unit_name']+','+ppt['data_2'] +ppt['unit_name'] +'</span></label>';
                            }else{
                                html3 += '</svg></span><span>'+ppt['data_1'] +ppt['unit_name'] +'</span></label>';
                             }
                            }else if(ppt['status_input'] == 3){
                                if(ppt['data_1'] != null &&  ppt['data_2'] != null){
                                    html3 += '</svg></span><span>'+ppt['data_1']+'-'+ppt['data_2']+' '+ppt['unit_name'] +'</span></label>';
                                }
                               
                            }
                         
                       
                            html3 += '</div>' ; 
                        }
                    }else if(ppt['type_value'] == 'text' && ppt['value_text'] != null && ppt['value_text'] != ''){
                        if(containsObjectText(object, data_text)){
                            data_text.push(object);
                            html3 += '<div onchange="fillerInputText('+"'"+fil_con['field_id']+"'"+','+"'"+ppt['value_text']+"'"+');" class="box-input-checkbox">';
                            html3 += '<input   class="inp-cbx" id="cx-normaltext'+fil_con['field_id']+index_per+'" type="checkbox" style="display: none;" />';
                            html3 += '<label class="cbx" for="cx-normaltext'+fil_con['field_id']+index_per+'"><span>';
                            html3 += '<svg width="12px" height="10px" viewbox="0 0 12 10">';
                            html3 += '<polyline points="1.5 6 4.5 9 10.5 1"></polyline>';
                            html3 += '</svg></span><span>'+ppt['value_text'] +'</span></label>';
                            html3 += '</div>' ; 
                        }
                    }
                }
                });
             }
             
            html3 += '</div>';
            html3 += '<button onclick="resetformById('+"'"+fil_con['field_id']+"'"+');" class="btn-reset" type="button"><?php echo e($staticContent['Clear']); ?></button>';
            html3 +=  '</form>';
            if(fil_con['field_id'] != 'series01' && fil_con['field_id'] != 'status02' && fil_con['field_id'] != 'certifi04' && fil_con['field_id'] != 'safety03' && fil_con['type'] == 'number'  ){
            html3 +=  '<div class="slidebar-value-box mb-4 mt-4">';
            html3 +=  '<div   id="slidebar-value-box_des'+fil_con['field_id']+'"class="slider noUi-target noUi-ltr noUi-horizontal type'+fil_con['field_id']+'"  ></div>';
            html3 +=  ' <div class="value-form-bar-box">'; 
            html3 +=  '<span class="value-form-bar value-form-bar-min" id="slider-limit-value-min_des'+fil_con['field_id']+'"></span>';
            html3 +=  ' <span class="value-form-bar value-form-bar-max"id="slider-limit-value-max_des'+fil_con['field_id']+'"></span>';
            html3 +=  '</div>';
            html3 +=  '</div>';
            }
            html3 +=  '</div></div>';
        });
        $('#sort-filter-content').html(html3);
        createSliderDestop();
        popcheckSerries();
       
    }
    function  filtercontentMobile(){
       var property_load = [];
       var doc_safety = [{id:2,name:'ABS'}, {id:3,name:'ATEX'},{id:4,name:'BSMI'}];
       property_load = pro_perti;
        var status = [ {id:2,name:'NEW'}, {id:3,name:'UPDATED'},{id:4,name:'EOL'}];
        var certificates = [ {id:1,name:'Industrial'}, {id:2,name:'Medical'},{id:3,name:'Lighting & Signage'}];
        var data_1 = [];
        var data_text = [];
        var html3 = '';
        $.each(filter_pro, function(index_con,fil_con){
            html3 += '<div class="fliter_head_mobile'+fil_con['field_id']+'"><div class="card-header-filter collapsed fliter_head_mobile'+fil_con['field_id']+'" data-toggle="collapse"';
            html3 += 'href="#collapse-fliter_'+fil_con['field_id']+'_mobile">';
            html3 += '<a class="card-title text-sixteen-dark">';
            html3 += fil_con['title'];
            html3 += '</a>';
            html3 += '</div>';
            html3 += '<div id="collapse-fliter_'+fil_con['field_id']+'_mobile" class="card-body-filter collapse '+(fil_con['field_id']== 'series01'?'show':'') +'">';
            html3 += '<form id="form-mobile'+fil_con['field_id']+'" class="'+fil_con['field_id']+'_mobile">';
            html3 += '<div class="scrollbar dataserchfiltermobile'+fil_con['field_id']+'" id="style-1">';
            if(fil_con['field_id'] == 'series01'){
                $.each(series, function(index_serie,serie){
                    html3 += '<div class="box-input-checkbox">';
                    html3 += '<input onchange="series_filter('+"'"+fil_con['field_id']+"'"+','+serie['se_id']+');" class="inp-cbx" id="cx-'+fil_con['field_id']+serie['se_id']+'_mobile" type="checkbox" style="display: none;" >';
                    html3 += '<label class="cbx" for="cx-'+fil_con['field_id']+serie['se_id']+'_mobile"><span>';
                    html3 += '<svg width="12px" height="10px" viewbox="0 0 12 10">';
                    html3 += '<polyline points="1.5 6 4.5 9 10.5 1"></polyline>';
                    html3 += '</svg></span><span>'+serie['title']+'</span></label>';
                    html3 += '</div>' ; 
                  });
             }
             if(fil_con['field_id'] == 'status02'){
                $.each(status, function(index_status,sta){
                    html3 += '<div class="box-input-checkbox">';
                    html3 += '<input onchange="filterstatus('+"'"+fil_con['field_id']+"'"+','+sta['id']+');" class="inp-cbx" id="cx-'+fil_con['field_id']+index_status+'_mobile" type="checkbox" style="display: none;" />';
                    html3 += '<label class="cbx" for="cx-'+fil_con['field_id']+index_status+'_mobile"><span>';
                    html3 += '<svg width="12px" height="10px" viewbox="0 0 12 10">';
                    html3 += '<polyline points="1.5 6 4.5 9 10.5 1"></polyline>';
                    html3 += '</svg></span><span class="">'+sta['name']+'</span></label>';
                    html3 += '</div>' ; 
                  });
             }
             if(fil_con['field_id'] == 'safety03'){
                $.each(doc_safety, function(id_doc,safety){
                    html3 += '<div class="box-input-checkbox">';
                    html3 += '<input onchange="filtersafety('+"'"+fil_con['field_id']+"'"+','+safety['id']+');" class="inp-cbx" id="cx-'+fil_con['field_id']+id_doc+'_mobile" type="checkbox" style="display: none;" />';
                    html3 += '<label class="cbx" for="cx-'+fil_con['field_id']+id_doc+'_mobile"><span>';
                    html3 += '<svg width="12px" height="10px" viewbox="0 0 12 10">';
                    html3 += '<polyline points="1.5 6 4.5 9 10.5 1"></polyline>';
                    html3 += '</svg></span><span class="">'+safety['name']+'</span></label>';
                    html3 += '</div>' ; 
                  });
             }
             
             if(fil_con['field_id'] == 'certifi04'){
                $.each(certificates, function(index_cer,certi){
                    html3 += '<div class="box-input-checkbox">';
                    html3 += '<input onchange="filterCerti('+"'"+fil_con['field_id']+"'"+','+certi['id']+');" class="inp-cbx" id="cx-'+fil_con['field_id']+index_cer+'_mobile" type="checkbox" style="display: none;" />';
                    html3 += '<label class="cbx" for="cx-'+fil_con['field_id']+index_cer+'_mobile"><span>';
                    html3 += '<svg width="12px" height="10px" viewbox="0 0 12 10">';
                    html3 += '<polyline points="1.5 6 4.5 9 10.5 1"></polyline>';
                    html3 += '</svg></span><span>'+certi['name']+'</span></label>';
                    html3 += '</div>' ; 
                  });
             }
             if(fil_con['field_id'] != 'series01' && fil_con['field_id'] != 'status02' && fil_con['field_id'] != 'certifi04' && fil_con['field_id'] != 'safety03'  ){
               var property =  property_load.sort(function(a, b) {
                   return a.data_1 > b.data_1 ? 1 : -1;
               });
               
                $.each(property, function(index_per,ppt){
                  if(fil_con['field_id'] == ppt['type_id']){
                    var object  = {};
                    var text = null;
                    if(ppt['value_text'] != null){
                        text = ppt['value_text'].replace(/\s/g, '').toLowerCase().replace(/^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g, '').trim();
                    }
                    object = {
                       'id':index_per,
                       'type':fil_con['field_id'],
                       'data':ppt['data_1'],
                       'status_input':ppt['status_input'],
                       'text':text,
                    }
                    
                    if(ppt['type_value'] == 'number' && ppt['data_1'] != null){
                        objectFiled = {
                        'field_id':fil_con['field_id'],
                        'type_box':ppt['status_input'],
                      }
                      var  index_fi = fildnumberMobile.findIndex(function(x){
                          return x.field_id === fil_con['field_id'];
                      })
                        if(index_fi == -1){
                            fildnumberMobile.push(objectFiled);
                        }
                        if(containsObject(object, data_1)){
                            data_1.push(object);
                            html3 += '<div class="box-input-checkbox">';
                            html3 += '<input onchange="fillerNumber('+"'"+fil_con['field_id']+"'"+','
                            +ppt['data_1']+','+ppt['data_2']+','+ppt['data_3'] +','+ppt['data_4'] +','+ppt['data_5']+','+ppt['data_6']+','+ppt['data_7']
                            +','+ppt['data_8']+','+ppt['data_9']+','+ppt['data_10']+','+ppt['data_11']+','+ppt['data_12']+
                            ');" class="inp-cbx" id="cx-normalnumber'+fil_con['field_id']+index_per+'_mobile" type="checkbox" style="display: none;" />';
                            html3 += '<label class="cbx" for="cx-normalnumber'+fil_con['field_id']+index_per+'_mobile"><span>';
                            html3 += '<svg width="12px" height="10px" viewbox="0 0 12 10">';
                            html3 += '<polyline points="1.5 6 4.5 9 10.5 1"></polyline>';
                            if(ppt['data_2'] != null && ppt['data_3'] != null && ppt['data_4'] != null && ppt['data_5'] != null ){
                                html3 += '</svg></span><span>'+ppt['data_1'] +ppt['unit_name']+','+ppt['data_2'] +ppt['unit_name'] +','+ppt['data_3'] +ppt['unit_name']+','+ppt['data_4'] +ppt['unit_name']+','+ppt['data_5'] +ppt['unit_name']+'</span></label>';
                            }else if(ppt['data_2'] != null && ppt['data_3'] != null && ppt['data_4'] != null  ){
                                html3 += '</svg></span><span>'+ppt['data_1'] +ppt['unit_name']+','+ppt['data_2'] +ppt['unit_name'] +','+ppt['data_3'] +ppt['unit_name']+','+ppt['data_4'] +ppt['unit_name']+'</span></label>';
                            }else if(ppt['data_2'] != null && ppt['data_3'] != null  ){
                                html3 += '</svg></span><span>'+ppt['data_1'] +ppt['unit_name']+','+ppt['data_2'] +ppt['unit_name'] +','+ppt['data_3'] +ppt['unit_name']+'</span></label>';
                            }else if(ppt['data_2'] != null ){
                                html3 += '</svg></span><span>'+ppt['data_1'] +ppt['unit_name']+','+ppt['data_2'] +ppt['unit_name'] +'</span></label>';
                            }else{
                                html3 += '</svg></span><span>'+ppt['data_1'] +ppt['unit_name'] +'</span></label>';
                             }
                       
                            html3 += '</div>' ; 
                           
                        }
                    }else if(ppt['type_value'] == 'text' && ppt['value_text'] != null && ppt['value_text'] != ''){
                        if(containsObjectText(object, data_text)){
                            data_text.push(object);
                            html3 += '<div class="box-input-checkbox">';
                            html3 += '<input  onchange="fillerInputText('+"'"+fil_con['field_id']+"'"+','+"'"+ppt['value_text']+"'"+');" class="inp-cbx" id="cx-'+fil_con['field_id']+index_per+'_mobile" type="checkbox" style="display: none;" />';
                            html3 += '<label class="cbx" for="cx-normaltext'+fil_con['field_id']+index_per+'_mobile"><span>';
                            html3 += '<svg width="12px" height="10px" viewbox="0 0 12 10">';
                            html3 += '<polyline points="1.5 6 4.5 9 10.5 1"></polyline>';
                            html3 += '</svg></span><span>'+ppt['value_text']+'</span></label>';
                            html3 += '</div>' ; 
                        }
                    }

                    }
                  
                });
               
             }
             
            html3 += '</div>';
            html3 += '<button onclick="resetformById('+"'"+fil_con['field_id']+"'"+');" class="btn-reset" type="button">CLEAR</button>';
            html3 +=  '</form>';
            if(fil_con['field_id'] != 'series01' && fil_con['field_id'] != 'status02' && fil_con['field_id'] != 'certifi04' && fil_con['field_id'] != 'safety03' && fil_con['type'] == 'number'  ){
            html3 +=  '<div class="slidebar-value-box mb-4 mt-4">';
            html3 +=  '<div  id="slidebar-value-box'+fil_con['field_id']+'"class="slider noUi-target noUi-ltr noUi-horizontal slider'+fil_con['field_id']+'"  ></div>';
            html3 +=  ' <div  class="value-form-bar-box">'; 
            html3 +=  '<span class="value-form-bar value-form-bar-min" id="slider-limit-value-min'+fil_con['field_id']+'"></span>';
            html3 +=  ' <span class="value-form-bar value-form-bar-max"id="slider-limit-value-max'+fil_con['field_id']+'"></span>';
            html3 +=  '</div>';
            html3 +=  '</div>';
            }
            html3 +=  '</div></div>';
        
            // createSlider('slidebar-value-box'+fil_con['field_id']);
        });
        $('#sort-filter-content_mobile').html(html3);
         createSlider();
    
       
    }


    function popcheckSerries(){
        if(series_id){
            $("#cx-series01"+series_id).prop("checked" ,true);
            $("#cx-series01"+series_id+"_mobile").prop("checked" ,true);
            $("#sidebar").addClass("show");
            onclickshow(2);
            ser_arr.push(<?php echo e($se_id); ?>);
        }else{
            $.each(series, function(index,val){
            ser_arr.push(val['se_id']);
            $("#cx-series01"+val['se_id']).prop("checked" ,true);
            $("#cx-series01"+val['se_id']+"_mobile").prop("checked" ,true);
            });
           $("#sidebar").addClass("show");
            onclickshow(2);
        }
    }
   

    function containsObject(obj, list) {
     var  index = list.findIndex(
        //  x => x.data === obj['data'] && x.type === obj['type'] 
        
         function(x){
           return x.data === obj['data'] && x.type === obj['type'] && x.status_input === obj['status_input']; 
         })
   
         if(index == -1){
            return true;
         }else{
            return false;
         }
    }
    function containsObjectText(obj, list){
        // var  index = list.findIndex(x => x.text === obj['text'] && x.type === obj['type'] )
        var  index = list.findIndex(
         function(x){
           return x.text === obj['text'] && x.type === obj['type']; 
         })

         if(index == -1){
            return true;
         }else{
            return false;
         }
    }
    
  
    function series_filter(type,value){
       if(ser_arr.indexOf(value) == -1){
           ser_arr.push(value);
       }else{
        var index_se = ser_arr.indexOf(value);
            if (index_se > -1) {
                ser_arr.splice(index_se, 1);
            }
       }
       fillerData();
    }
    function filterAllSeries(){
     
        var eachpro = [];
        $.each(products, function(index,value){
         var productObj = {};
         var productObj2 = {};
         $.each(ser_arr, function(index_ser,value_ser){
           if(value_ser == value['series_id']){
            productObj['pro_id'] = value['pro_id'];
            productObj['pro_code'] = value['pro_code'];
            productObj['series_id'] = value['series_id'];
            productObj['status_product'] = value['status_product'];
            productObj['certificate'] = value['certificate'];
            productObj['updated_at'] = value['updated_at'];
            productObj['picture'] = value['picture'];
            productObj['dimensionL'] = value['dimensionL'];
            productObj['dimensionW'] = value['dimensionW'];
            productObj['dimensionD'] = value['dimensionD'];
            productObj['content'] = [];
            productObj['contentFilter'] = [];
            $.each(product_has_property, function(index2,value2){
                if(value['pro_id'] == value2['product_id']){
                    productObj['content'].push(value2);
                }
              });
              $.each(pro_perti, function(index3,value3){
                if(value['pro_id'] == value3['product_id']){
                    productObj['contentFilter'].push(value3);
                }
              
           
              });
            productFilter.push(productObj);     
              
          }
       
         });
        
      });
    
    //  findresultfeildbypro(productFilter);
    
    }


    var arr_status = [];
    function filterstatus(type ,value){
        if(arr_status.indexOf(value) == -1){
            arr_status.push(value);
       }else{
        var index = arr_status.indexOf(value);
            if (index > -1) {
                arr_status.splice(index, 1);
            }
       }
    //    filerallStatus();
       fillerData(); 
    }
    var arr_safety = [];
    function filtersafety(type ,value){
        if(arr_safety.indexOf(value) == -1){
            arr_safety.push(value);
       }else{
        var index = arr_safety.indexOf(value);
            if (index > -1) {
                arr_safety.splice(index, 1);
            }
       }
       fillerData();
    //    filerallDoc();
    }
    function filerallDoc(){
        var arr_pro_doc = [];
        var profilter = [];
        var proarr = [];
        var values = [];
        $.ajax({
           url: "<?php echo e(route('loaddocumentPro')); ?>",
           data: {
          'data': arr_safety,
           },
           type: 'POST',
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
           success: function (res) {
             values = res['data']
           },
           async: false,
           });

            if(arr_safety.length > 1){
                // var lookup = values.reduce((a, e) => {
                // a[e.product_id] = ++a[e.product_id] || 0;
                // return a;
                // }, {});
                // profilter =  values.filter(e => lookup[e.product_id]);

                var lookup = values.reduce(function(a,e) {
                        a[e.product_id] = ++a[e.product_id] || 0;
                        return a;
                        }, {});
                        profilter =  values.filter(function(e) {
                           return lookup[e.product_id];
                        });
                
            }else{
                profilter =  values;
            }
            profilter.filter(function(data) {
               var index2  = proarr.indexOf(data.product_id);
                 if(index2 == -1){
                    proarr.push(data.product_id);
                 }
             });
        productFilter.filter(function(data2) {
            proarr.forEach(function(element2) {
                if(data2.pro_id == element2){
                    var  index = arr_pro_doc.findIndex(
                        function(x){
                        return x.pro_id === data2.pro_id;
                        })
                        if(index == -1){
                        arr_pro_doc.push(data2);  
                        }
                }
            });
        });
        if(arr_safety.length == 0){
            arr_pro_doc = [];
            arr_pro_doc = productFilter;
        }
       listItemFiler(arr_pro_doc);
    }

    function filerallStatus(){
        var arr_filter = [];
        productFilter.filter(function(data) {
            arr_status.forEach(function(element) {
                if(data.status_product == element){
                    var  index = arr_filter.findIndex(
                        function(x){
                            return x.pro_id === data.pro_id;
                        })
                        if(index == -1){
                            arr_filter.push(data);  
                        }
                    }
            });
        });
       if(arr_status.length == 0){
          arr_filter = [];
          arr_filter = productFilter;
        }
       listItemFiler(arr_filter);
    }
     var arr_cer = [];
    function filterCerti(type ,value){
        if(arr_cer.indexOf(value) == -1){
            arr_cer.push(value);
       }else{
        var index = arr_cer.indexOf(value);
            if (index > -1) {
                arr_cer.splice(index, 1);
            }
       }
       fillerData();
    }
    function filerallCer(){
       var arr_filter_ser = [];
       var arr_seg  = [];
       var profilter  = [];

        arr_cer.forEach(function(element) {
         certi_products.filter(function(data) {
            if(data.certificate_id == element){
                arr_seg.push(data);
            }
         });
        });
         if(arr_cer.length > 1){
                // var lookup = arr_seg.reduce((a, e) => {
                // a[e.product_id] = ++a[e.product_id] || 0;
                // return a;
                // }, {});
                // profilter =  arr_seg.filter(e => lookup[e.product_id]);

                var lookup = arr_seg.reduce(function(a,e) {
                        a[e.product_id] = ++a[e.product_id] || 0;
                        return a;
                        }, {});
                        profilter =  arr_seg.filter(function(e) {
                           return lookup[e.product_id];
                        });
            }else{
                profilter =  arr_seg;
            }
        profilter.forEach(function(element) {
           productFilter.filter(function(data) {
                if(data.pro_id == element.product_id){
                    var  index = arr_filter_ser.findIndex(
                        function(x){
                            return x.pro_id === data.pro_id;
                        })
                    if(index == -1){
                       arr_filter_ser.push(data);
                     }
                }
            });
        });

      

        if(arr_cer.length == 0){
            arr_filter_ser = [];
            arr_filter_ser = productFilter;
        }
       listItemFiler(arr_filter_ser);
    }

    function fillerNumber(type ,value1 , value2,value3, value4 ,value5 ,value6 ,value7 ,value8,value9,value10,value11,value12){
        stateType = type;
        var obj = {
            'type':type,
            'value1':value1,
            'value2':value2,
            'value3':value3,
            'value4':value4,
            'value5':value5,
            'value6':value6,
            'value7':value7,
            'value8':value8,
            'value9':value9,
            'value10':value10,
            'value11':value11,
            'value12':value12,
            
        }
        // console.log(obj);
       var  index = arr_type_an_val.findIndex(
           function(x){
            //    return  x.value1 === value1;
               return parseInt(x.type) ===  parseInt(type)  && x.value1 === value1;
           })
             if(index == -1){
                arr_type_an_val.push(obj);  
             }else{
                if (index > -1) {
                    arr_type_an_val.splice(index, 1);
                 }
             }
           
            fillerData();

       
    }
    function checkmethod(arr){
        var arrcont = [];
        arr.forEach(function(element) {
            var index =  arrcont.indexOf(element['type']);
            if(index == -1){
                arrcont.push(element['type']);
            }
        });
        return arrcont.length;
    }
    function checkDataStep(type){
        var  index = arr_type_an_val.findIndex(
           function(x){
            //    return  x.value1 === value1;
               return parseInt(x.type) ===  parseInt(type);
           })
           if(index == -1){
               return true;
           }else{
               return false;
           }
    }
    function findresultfeildbypro(array_fil_type){
        var fieldFilter = [];
      
        $.each(array_fil_type, function(index,value){
            pro_perti.filter(function(poper) {
                if(value['pro_id'] == poper['product_id'] ){
                // if(value['pro_id'] == poper['product_id']  ){
                    var  index = fieldFilter.findIndex(
                            function(x){
                            return x.per_id === value.per_id;
                            })
                            if(index == -1){
                                fieldFilter.push(poper);
                            }
                }
            });
        });


          loadNewFilter(fieldFilter,stateType);
    }

    function checkloop(id ,loop){
        var  index = loop.indexOf(id);
    
         if(index == -1){
             return true;
         }else{
             return false;
         }
    }
    function checkdatainfild(type ,data){
      
       var  index =  arr_type_an_val.findIndex(
        function(x){
         return parseInt(x.type) === parseInt(type) 
         && x.value1 === data 

        })

        if(index == -1){
            return false;
        }else{         
           return true;
        }
    }
    function checkedfilter(type ,value1 , value2,value3, value4 ,value5 ,Filid){
        var  index =  arr_type_an_val.findIndex(
        function(x){
         return parseInt(x.type) ===  parseInt(type) 
         && x.value1 === value1 

        })
        
      
        if(index == -1){
            return '';
        }else{         
            $("#cx-"+type+Filid).prop("checked" ,true);
            $("#cx-mobile"+type+Filid).prop("checked" ,true);
        }
    }
    function checkedfilterInputtext(type , val_text ,filid){
        var  index = arr_inputtxt.findIndex(function(x){
                        if(x.value_text == null){
                            data.value_text = '';
                         }
                         if(val_text == null){
                            val_text = '';
                         }
       return x.value_text.trim() === val_text.trim();
       })
        if(index == -1){
            return '';
        }else{         
            $("#cx-text"+type+filid).prop("checked" ,true);
            $("#cx-mobiletext"+type+filid).prop("checked" ,true);
        }
    }

    function loadNewFilter(fieldFilter,stateType){
                var data_1 = [];
                var data_text = [];
                 var checklooparr = [];
               var property =  fieldFilter.sort( 
                   function(a, b){
                       return a.data_1 > b.data_1 ? 1 : -1;
                    });
              
                $.each(property, function(index_per,ppt){
                    if(checkDataStep(ppt['type_id'])){

                
                    var html3 = '';
                    var htmlmobile = '';
                    if(checkloop(ppt['type_id'] ,checklooparr)){
                        checklooparr.push(ppt['type_id']);
                        $('.dataserchfilter'+ppt['type_id']).empty();
                        $('.dataserchfiltermobile'+ppt['type_id']).empty();
                    }
                  if(ppt['type_id'] == ppt['type_id']){
                    var object  = {};
                    var text = null;
                    if(ppt['value_text'] != null){
                        text = ppt['value_text'].replace(/\s/g, '').toLowerCase().replace(/^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g, '').trim();
                      
                    }
                    object = {
                       'id':index_per,
                       'type':ppt['type_id'],
                       'data':ppt['data_1'],
                       'status_input':ppt['status_input'],
                       'text':text,
                    }
                    if(ppt['type_value'] == 'number' && ppt['data_1'] != null){
                      objectFiled = {
                        'field_id':ppt['type_id'],
                        'type_box':ppt['status_input'],
                      }
                      var  index_fi = fildnumber.findIndex(
                         function(x) {
                         return  x.field_id === ppt['type_id'];
                         })
                        if(index_fi == -1){
                            fildnumber.push(objectFiled);
                        }

                        if(containsObject(object, data_1)){
                            data_1.push(object);
                            html3 += '<div onchange="fillerNumber('+"'"+ppt['type_id']+"'"+','+ppt['data_1']+','+ppt['data_2']+','+ppt['data_3'] 
                            +','+ppt['data_4'] +','+ppt['data_5'] +','+ppt['data_6'] +','+ppt['data_7'] +','+ppt['data_8'] +','+ppt['data_9']
                            +','+ppt['data_10'] +','+ppt['data_11'] +','+ppt['data_12']
                            +');" class="box-input-checkbox new-filter">';
                            html3 += '<input  class="inp-cbx" id="cx-'+ppt['type_id']+index_per+'" type="checkbox" style="display: none;" />';
                            html3 += '<label class="cbx" for="cx-'+ppt['type_id']+index_per+'"><span>';
                            html3 += '<svg width="12px" height="10px" viewbox="0 0 12 10">';
                            html3 += '<polyline points="1.5 6 4.5 9 10.5 1"></polyline>';
                             var dataarr = [
                                ppt['data_1'],
                                ppt['data_2'],
                                ppt['data_3'],
                                ppt['data_4'],
                                ppt['data_5'],
                                ppt['data_6'],
                                ppt['data_7'],
                                ppt['data_8'],
                                ppt['data_9'],
                                ppt['data_10'],
                                ppt['data_11'],
                                ppt['data_12'],
                             ]
                             
                            html3 += '</svg></span><span>'+ checkNull(dataarr,ppt['unit_name'],ppt['status_input']) +'</span></label>';
                            html3 += '</div>' ;
                            htmlmobile += '<div onchange="fillerNumber('+"'"+ppt['type_id']+"'"+','+ppt['data_1']+','+ppt['data_2']+','+ppt['data_3'] +','+ppt['data_4'] +','+ppt['data_5']
                            +','+ppt['data_6']+','+ppt['data_7']+','+ppt['data_8'] +','+ppt['data_9'] +','+ppt['data_10'] +','+ppt['data_11'] +','+ppt['data_12']
                            +');" class="box-input-checkbox">';
                            htmlmobile += '<input  class="inp-cbx" id="cx-mobile'+ppt['type_id']+index_per+'" type="checkbox" style="display: none;" />';
                            htmlmobile += '<label class="cbx" for="cx-mobile'+ppt['type_id']+index_per+'"><span>';
                            htmlmobile += '<svg width="12px" height="10px" viewbox="0 0 12 10">';
                            htmlmobile += '<polyline points="1.5 6 4.5 9 10.5 1"></polyline>';
                            htmlmobile += '</svg></span><span>'+ checkNull(dataarr,ppt['unit_name'],ppt['status_input']) +'</span></label>';
                            htmlmobile += '</div>' ; 
                            $('.dataserchfilter'+ppt['type_id']).append(html3);
                            $('.dataserchfiltermobile'+ppt['type_id']).append(htmlmobile);

                            checkedfilter(ppt['type_id'],ppt['data_1'],ppt['data_2'],ppt['data_3'], ppt['data_4'] ,ppt['data_5'] ,index_per);
                        }
                    }
                    // }else if(ppt['type_value'] == 'text' && ppt['value_text'] != null && ppt['value_text'] != ''){
                    //     if(containsObjectText(object, data_text)){
                    //         data_text.push(object);
                    //         html3 += '<div onchange="fillerInputText('+"'"+ppt['type_id']+"'"+','+"'"+ppt['value_text']+"'"+');" class="box-input-checkbox">';
                    //         html3 += '<input   class="inp-cbx" id="cx-text'+ppt['type_id']+index_per+'" type="checkbox" style="display: none;" />';
                    //         html3 += '<label class="cbx" for="cx-text'+ppt['type_id']+index_per+'"><span>';
                    //         html3 += '<svg width="12px" height="10px" viewbox="0 0 12 10">';
                    //         html3 += '<polyline points="1.5 6 4.5 9 10.5 1"></polyline>';
                    //         html3 += '</svg></span><span>'+ppt['value_text'] +'</span></label>';
                    //         html3 += '</div>' ; 

                    //         htmlmobile += '<div onchange="fillerInputText('+"'"+ppt['type_id']+"'"+','+"'"+ppt['value_text']+"'"+');" class="box-input-checkbox">';
                    //         htmlmobile += '<input   class="inp-cbx" id="cx-mobiletext'+ppt['type_id']+index_per+'" type="checkbox" style="display: none;" />';
                    //         htmlmobile += '<label class="cbx" for="cx-mobiletext'+ppt['type_id']+index_per+'"><span>';
                    //         htmlmobile += '<svg width="12px" height="10px" viewbox="0 0 12 10">';
                    //         htmlmobile += '<polyline points="1.5 6 4.5 9 10.5 1"></polyline>';
                    //         htmlmobile += '</svg></span><span>'+ppt['value_text'] +'</span></label>';
                    //         htmlmobile += '</div>' ; 


                    //         $('.dataserchfilter'+ppt['type_id']).append(html3);
                    //         $('.dataserchfiltermobile'+ppt['type_id']).append(htmlmobile);
                    //         checkedfilterInputtext(ppt['type_id'] , ppt['value_text'] ,index_per);
                    //     }
                    // }
                }
                    }
                });
               var property2 =  fieldFilter.sort( 
                   function(a, b){
                       return a.value_text > b.value_text ? 1 : -1;
                    });
                

                $.each(property2, function(index_per,ppt){
                    if(checkDataStep(ppt['type_id'])){
                    var html3 = '';
                    var htmlmobile = '';
                    if(checkloop(ppt['type_id'] ,checklooparr)){
                        checklooparr.push(ppt['type_id']);
                        $('.dataserchfilter'+ppt['type_id']).empty();
                        $('.dataserchfiltermobile'+ppt['type_id']).empty();
                    }
                  if(ppt['type_id'] == ppt['type_id']){
                    var object  = {};
                    var text = null;
                    if(ppt['value_text'] != null){
                        text = ppt['value_text'].replace(/\s/g, '').toLowerCase().replace(/^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g, '').trim();
                      
                    }
                    object = {
                       'id':index_per,
                       'type':ppt['type_id'],
                       'data':ppt['data_1'],
                       'text':text,
                    }
               
                    if(ppt['type_value'] == 'text' && ppt['value_text'] != null && ppt['value_text'] != ''){
                        if(containsObjectText(object, data_text)){
                            data_text.push(object);
                            html3 += '<div onchange="fillerInputText('+"'"+ppt['type_id']+"'"+','+"'"+ppt['value_text']+"'"+');" class="box-input-checkbox">';
                            html3 += '<input   class="inp-cbx" id="cx-text'+ppt['type_id']+index_per+'" type="checkbox" style="display: none;" />';
                            html3 += '<label class="cbx" for="cx-text'+ppt['type_id']+index_per+'"><span>';
                            html3 += '<svg width="12px" height="10px" viewbox="0 0 12 10">';
                            html3 += '<polyline points="1.5 6 4.5 9 10.5 1"></polyline>';
                            html3 += '</svg></span><span>'+ppt['value_text'] +'</span></label>';
                            html3 += '</div>' ; 

                            htmlmobile += '<div onchange="fillerInputText('+"'"+ppt['type_id']+"'"+','+"'"+ppt['value_text']+"'"+');" class="box-input-checkbox">';
                            htmlmobile += '<input   class="inp-cbx" id="cx-mobiletext'+ppt['type_id']+index_per+'" type="checkbox" style="display: none;" />';
                            htmlmobile += '<label class="cbx" for="cx-mobiletext'+ppt['type_id']+index_per+'"><span>';
                            htmlmobile += '<svg width="12px" height="10px" viewbox="0 0 12 10">';
                            htmlmobile += '<polyline points="1.5 6 4.5 9 10.5 1"></polyline>';
                            htmlmobile += '</svg></span><span>'+ppt['value_text'] +'</span></label>';
                            htmlmobile += '</div>' ; 


                            $('.dataserchfilter'+ppt['type_id']).append(html3);
                            $('.dataserchfiltermobile'+ppt['type_id']).append(htmlmobile);
                            checkedfilterInputtext(ppt['type_id'] , ppt['value_text'] ,index_per);
                        }
                    }
                }
                    }
                });
                
    }


    var arr_inputtxt = [];
 
    function fillerInputText(type ,value){
        stateType = type;
        var obj = {
          'type':type,
          'value_text':value,
        }
   
       var  index = arr_inputtxt.findIndex(function(x){
                return x.value_text === value;
             })
             if(index == -1){ 
                arr_inputtxt.push(obj);  
             }else{
                if (index > -1) {
                arr_inputtxt.splice(index, 1);
                 }
             }
             
             fillerData();
            //  filAllTypeInputText();
    }
    function checkNull(dataarr,unit,status){
        var string = '';
        var arrstri = [];
       if(status == 1 || status == 2 || status == 3){
        $.each(dataarr, function(index,data){
            if(data != null && data != ''){
              arrstri.push(data+unit);
            }
        });
        string = arrstri.join();
       }
    //    }else if(status == 3){
    //     string = dataarr[0]+'-'+dataarr[1]+unit;
    //    }
         return  string;
    }
    function filAllTypeInputText(){
        var array_fil_type = [];
        $.each(productFilter, function(index,value){
        productFilter[index]['contentFilter'].filter(function(data) {
            arr_inputtxt.forEach(function(element) {
                    if(data.type_id == element['type']){
                         if(data.value_text == null){
                            data.value_text = '';
                         }
                         if(element['value_text'] == null){
                            data.value_text = '';
                         }
                        if(data.value_text.trim() == element['value_text'].trim()){
                            var  index = array_fil_type.findIndex(
                                 function(x){
                                    return x.pro_id === value.pro_id;
                                })
                             
                            if(index == -1){
                               
                             array_fil_type.push(value);  
                            }
                          }
                   }
            });
        });
      });
      if(arr_inputtxt.length == 0){
        array_fil_type = [];
        array_fil_type = productFilter;
      }
 
      listItemFiler(array_fil_type);
    }
    function listItemFiler(arr){
        var current_list =  $('#current_list_item').val();
        var showarr =  onfilsetSort(arr);
      if(current_list == 0){
        onclickListView(showarr ,1 ,1);
      }else{
        onclickGridView(showarr);
      }
        $(".moreBox").slice(0, 8).show();
        $(".moreBox_mobile").slice(0, 8).show();
        $(".row_table").slice(0, 8).show();
      if(showarr.length > 8){
        $("#loadlistview").show();
      }else{
        $("#loadlistview").fadeOut('hide');
      }
      $('.countproduct').text(showarr.length);
    }
    function resetAllTab(){
        ser_arr = [];
        arr_status = [];
        arr_cer = [];
        arr_inputtxt = [];
        arr_type_an_val = [];
        arr_value1 = [];
        $.each(filter_pro, function(index_con,fil_con){
              $('#collapse-fliter_'+fil_con['field_id']).removeClass('show');
              $('#form-'+fil_con['field_id'] )[0].reset();
              $('#form-mobile'+fil_con['field_id'] )[0].reset();
        });
        $('#collapse-fliter_series01').addClass('show');
        fillerData();
    }
    function resetformById(id){
        $('#form-'+id)[0].reset();
        $('#form-mobile'+id)[0].reset();
        if(id == 'series01'){
            ser_arr = [];
        }else if(id == 'status02'){
            arr_status = [];
        }else if(id == 'certifi04'){
            arr_cer = [];
        }else if(id == 'safety03'){
            arr_safety = [];
        }else{
            arr_type_an_val = [];
            arr_value1 = [];
        }
        fillerData();
    }
    function onfilsetSort(arr_val){
        var arr_result = [];
       var type_se = $('.selectSort').val();
       if(type_se == 1){
        arr_result =   sortModelName(arr_val);
       }else if(type_se == 2){
        arr_result = sortOutputLH(arr_val ,4);
       }else if(type_se == 3){
        arr_result = sortOutputLH(arr_val ,3);
       }else if(type_se == 4){
        arr_result = sortOutputLH(arr_val ,8);
    
       }else if(type_se == 5){
        arr_result = sortModelName(arr_val);
       }
        return  arr_result;
    }
    function onselectSort(){
        var arr_val = productFilter;
        var arr_result = [];
       var type_se = $('.selectSort').val();
       var typesor = 0;
       if(type_se == 1){
        arr_result = sortModelName(arr_val);
         typesor = 1;
       }else if(type_se == 2){
        arr_result = sortOutputLH(arr_val ,4);
        typesor = 2;
       }else if(type_se == 3){
        arr_result = sortOutputLH(arr_val ,3);
        typesor = 3;
       }else if(type_se == 4){
        arr_result = sortOutputLH(arr_val ,8);
        typesor = 4;
       }else if(type_se == 5){
        arr_result = sortDateModify(arr_val);
       }
       var current_list =  $('#current_list_item').val();
      if(current_list == 0){
        onclickListView(arr_result ,1 ,typesor);
      }else{
        onclickGridView(arr_result);
      }
        $(".moreBox").slice(0, 8).show();
        $(".moreBox_mobile").slice(0, 8).show();
        $(".row_table").slice(0, 8).show();
        $('.countproduct').text(arr_result.length);
        productFilter = arr_result;
    }
    function onselectSortDestop(){
        // var table = $('#dtBasicExample').DataTable();
        var arr_val = productFilter;
        var arr_result = [];
        var typesor = 0;
       var type_se = $('#selectSortDestop').val();
       if(type_se == 1){
        arr_result = sortModelName(arr_val);
        typesor = 1;
       }else if(type_se == 2){
        arr_result = sortOutputLH(arr_val ,4);
        typesor = 2;
       }else if(type_se == 3){
        arr_result = sortOutputLH(arr_val ,3);
        typesor = 3;
       }else if(type_se == 4){
        arr_result = sortOutputLH(arr_val ,8);
        typesor = 4;
       }else if(type_se == 5){
        arr_result = sortDateModify(arr_val);
       }
       var current_list =  $('#current_list_item').val();
      if(current_list == 0){
        onclickListView(arr_result ,1,typesor);
      }else{
        onclickGridView(arr_result);
      }
      if(arr_result.length > 0){
        $(".moreBox").slice(0, 8).show();
        $(".moreBox_mobile").slice(0, 8).show();
        $(".row_table").slice(0, 8).show();
      }
      
        $('.countproduct').text(arr_result.length);
        productFilter = arr_result;

    }

    function sortModelName(array_value){
        var arr = [];
         arr = array_value.sort(
             function (a,b){
                 return a.pro_code > b.pro_code ? 1 : -1;
             });
        return arr;
    }
    function sortModelNameZA(array_value){
        var arr = [];
         arr = array_value.sort(
             function (a,b){
                 return a.pro_code < b.pro_code ? 1 : -1;
             });

   
        return arr;
    }

    function diminsionLH(array_value){

        var arr = [];
         arr = array_value.sort(
             function (a,b){
                 return parseInt(a.dimensionL) > parseInt(b.dimensionL) ? 1 : -1;
             });
        return arr;
    }
    function diminsionHL(array_value){
        var arr = [];
         arr = array_value.sort(
             function (a,b){
                 return parseInt(a.dimensionL) < parseInt(b.dimensionL) ? 1 : -1;
             });
       
        return arr;
    }

    function sortDateModify(array_value){
        var arr = [];
        arr = array_value.sort(
            function (a,b){
                 return a.updated_at > b.updated_at ? 1 : -1;
             });
        return arr;
    }
    function sortOutputLH(array_value ,type){
        var arr_sort = [];
        var value_data = [];
        $.each(array_value, function(index,value){   
            value['contentFilter'].filter(function(data) {
              if(data['type_id'] == type){
                var obj = {
                "pro_id":value['pro_id'],
                 "data":data['data_1'],
               }
                value_data.push(obj);    
               }
            });
        });
        value_data.sort(
            function (a,b){
                 return a.data > b.data ? 1 : -1;
             });
         $.each(value_data, function(index,value){ 
           array_value.filter(function(data){
               if(value['pro_id'] == data['pro_id'] ){
                  arr_sort.push(data);  
               }
             
           });
         });
        return arr_sort;
    }

    function sortOutputHL(array_value ,type){
        var arr_sort = [];
        var value_data = [];
        $.each(array_value, function(index,value){   
            value['contentFilter'].filter(function(data) {
              if(data['type_id'] == type){
                var obj = {
                "pro_id":value['pro_id'],
                 "data":data['data_1'],
               }
                value_data.push(obj);    
               }
            });
        });
        value_data.sort(
            function (a,b){
                 return a.data < b.data ? 1 : -1;
             });
         $.each(value_data, function(index,value){ 
           array_value.filter(function(data){
               if(value['pro_id'] == data['pro_id'] ){
                  arr_sort.push(data);  
               }
             
           });
         });
        return arr_sort;
    }

    function sortInputHL(array_value ,type){
        var arr_sort = [];
        var value_data = [];
        $.each(array_value, function(index,value){   
            value['contentFilter'].filter(function(data) {
              if(data['type_id'] == type){
                var obj = {
                "pro_id":value['pro_id'],
                 "data":data['value_text'],
               }
                value_data.push(obj);    
               }
            });
        });
        value_data.sort(
            function (a,b){
                 return a.data < b.data ? 1 : -1;
             });
         $.each(value_data, function(index,value){ 
           array_value.filter(function(data){
               if(value['pro_id'] == data['pro_id'] ){
                  arr_sort.push(data);  
               }
             
           });
         });
        return arr_sort;
    }

    function sortInputLH(array_value ,type){
        var arr_sort = [];
        var value_data = [];
        $.each(array_value, function(index,value){   
            value['contentFilter'].filter(function(data) {
              if(data['type_id'] == type){
                var obj = {
                "pro_id":value['pro_id'],
                 "data":data['value_text'],
               }
                value_data.push(obj);    
               }
            });
        });
        value_data.sort(
            function (a,b){
                 return a.data > b.data ? 1 : -1;
             });
         $.each(value_data, function(index,value){ 
           array_value.filter(function(data){
               if(value['pro_id'] == data['pro_id'] ){
                  arr_sort.push(data);  
               }
             
           });
         });
        return arr_sort;
    }

    function getMinMaxValueById(id){
        var value_data = [];
        pro_perti.filter(function(data) {
              if(data['type_id'] == id){
                value_data.push(data['data_1']); 
                if(data['data_2'] != null){
                    value_data.push(data['data_2']); 
                }
                if(data['data_3'] != null){
                    value_data.push(data['data_3']); 
                }
                if(data['data_4'] != null){
                    value_data.push(data['data_4']); 
                }
                if(data['data_5'] != null){
                    value_data.push(data['data_5']); 
                }
                    
               }
            });
   
        var min = Math.min.apply(null, value_data);
        var max = Math.max.apply(null, value_data);
       return object ={
             "min":min,
             "max":max,
       };
    }

     function  onsearchProduct(){
        var re_arr = [];
            ser_arr = [];
            arr_status = [];
            arr_cer = [];
            arr_inputtxt = [];
            arr_type_an_val = [];
            arr_value1 = [];
        $.each(filter_pro, function(index_con,fil_con){
            $('#collapse-fliter_'+fil_con['field_id']).removeClass('show');
              $('#form-'+fil_con['field_id'] )[0].reset();
              $('#form-mobile'+fil_con['field_id'] )[0].reset();
        });

        $.each(products, function(index,value){
            var productObj = {};
          productObj['pro_id'] = value['pro_id'];
          productObj['pro_code'] = value['pro_code'];
          productObj['picture'] = value['picture'];
          productObj['series_id'] = value['series_id'];
          productObj['status_product'] = value['status_product'];
          productObj['certificate'] = value['certificate'];
          productObj['updated_at'] = value['updated_at'];
          productObj['dimensionL'] = value['dimensionL'];
          productObj['dimensionW'] = value['dimensionW'];
          productObj['dimensionD'] = value['dimensionD'];
          productObj['content'] = [];
          productObj['contentFilter'] = [];
            $.each(product_has_property, function(index2,value2){
            if(value['pro_id'] == value2['product_id']){
                productObj['content'].push(value2);
            }
         });
         $.each(pro_perti, function(index3,value3){
                if(value['pro_id'] == value3['product_id']){
                    productObj['contentFilter'].push(value3);
                }
              });

         productTextSearch.push(productObj);
        });
        var key = $('#key_destop').val();
        // console.log(key);
        $('#key_mobile').val(key);
        var term = key; // search term (regex pattern)
        var search = new RegExp(term , 'i'); // prepare a regex object     
           productTextSearch.filter(function(data){
            if(search.test(data.pro_code)){
                var index = re_arr.findIndex(function(x){
                  return  x.pro_id === data.pro_id;
                })
                    if(index == -1){
                        re_arr.push(data);  
                    }
            }
           });
           onselectSortArr(re_arr);
           $('#current_method').val(1);
       
     }
     function onsearchProductMobile(){
        var re_arr = [];
        $.each(filter_pro, function(index_con,fil_con){
            $('#collapse-fliter_'+fil_con['field_id']).removeClass('show');
              $('#form-'+fil_con['field_id'] )[0].reset();
              $('#form-mobile'+fil_con['field_id'] )[0].reset();
        });

        $.each(products, function(index,value){
            var productObj = {};
          productObj['pro_id'] = value['pro_id'];
          productObj['pro_code'] = value['pro_code'];
          productObj['picture'] = value['picture'];
          productObj['series_id'] = value['series_id'];
          productObj['status_product'] = value['status_product'];
          productObj['certificate'] = value['certificate'];
          productObj['updated_at'] = value['updated_at'];
          productObj['dimensionL'] = value['dimensionL'];
          productObj['dimensionW'] = value['dimensionW'];
          productObj['dimensionD'] = value['dimensionD'];
          productObj['content'] = [];
          productObj['contentFilter'] = [];
            $.each(product_has_property, function(index2,value2){
            if(value['pro_id'] == value2['product_id']){
                productObj['content'].push(value2);
            }
         });
         $.each(pro_perti, function(index3,value3){
                if(value['pro_id'] == value3['product_id']){
                    productObj['contentFilter'].push(value3);
                }
              });

         productTextSearch.push(productObj);
        });
        var key = $('#key_mobile').val();
        $('#key_destop').val(key);
        var term = key; // search term (regex pattern)
        var search = new RegExp(term , 'i'); // prepare a regex object     
           productTextSearch.filter(function(data){
            if(search.test(data.pro_code)){
                var index = re_arr.findIndex(function(x){
                    return x.pro_id === data.pro_id;
                })
                    if(index == -1){
                        re_arr.push(data);  
                    }
            }
           });
           onselectSortArr(re_arr);
           $('#current_method').val(2);
     }

     function onselectSortArr(re_arr){
        var arr_val = re_arr;
        var arr_result = [];
       var type_se = $('.selectSort').val();
       var typesor = 0;
       if(type_se == 1){
        arr_result = sortModelName(arr_val);
        typesor = 1;
       }else if(type_se == 2){
        arr_result = sortOutputLH(arr_val ,4);
        typesor = 2;
       }else if(type_se == 3){
        arr_result = sortOutputLH(arr_val ,3);
        typesor = 3;
       }else if(type_se == 4){
        arr_result = sortOutputLH(arr_val ,8);
        typesor = 4;
       }else if(type_se == 5){
        arr_result = sortModelName(arr_val);
       }
       var current_list =  $('#current_list_item').val();
      if(current_list == 0){
        onclickListView(arr_result ,typesor);
      }else{
        onclickGridView(arr_result);
      }
      if(arr_result.length < 8){
          $('#loadMore').hide();
          $('#loadlistview').hide();
          $('#loadMore_mobile').hide();
      }
      if(arr_result.length > 0){
        $(".moreBox").slice(0, 8).show();
        $(".moreBox_mobile").slice(0, 8).show();
        $(".row_table").slice(0, 8).show();
      }
       
        $('.countproduct').text(arr_result.length);
        //   productFilter = arr_result;
    }
   


    /* slidebar */

    function createSlider(){
        $.each(fildnumberMobile, function(index_con,fil_con){
        if(fil_con['field_id'] != 'series01' && fil_con['field_id'] != 'status02' && fil_con['field_id'] != 'certifi04' && fil_con['field_id'] != 'safety03'  ){
            var data = 'slidebar-value-box'+fil_con['field_id'];
            var valuemin ='slider-limit-value-min'+fil_con['field_id'];
            var valuemax ='slider-limit-value-max'+fil_con['field_id'];
            var nonLinearSlider = document.getElementById(data);
            var datacon = getMinMaxValueById(fil_con['field_id']);
            noUiSlider.create(nonLinearSlider, {
                connect: true,
                behaviour: 'tap',
                step: 1,
                start: [datacon['min'] , datacon['max']],
                range: {
                    // Starting at 500, step the value by 500,
                    // until 4000 is reached. From there, step by 1000.
                    'min': [datacon['min']],
                    'max': [datacon['max']]
                }
            });
            var limitFieldMin = document.getElementById(valuemin);
            var limitFieldMax = document.getElementById(valuemax);
            nonLinearSlider.noUiSlider.on('update', function (values, handle) {
            (handle ? limitFieldMax : limitFieldMin).innerHTML = values[handle];
            });

        

            }
        });
    }

    function createSliderDestop(){
         $.each(fildnumber, function(index_con,fil_con){
        var data = getMinMaxValueById(fil_con['field_id']);
        if(fil_con['field_id'] != 'series01' && fil_con['field_id'] != 'status02' && fil_con['field_id'] != 'certifi04' && fil_con['field_id'] != 'safety03'  ){
            var data_des = 'slidebar-value-box_des'+fil_con['field_id'];
            var valuemindes ='slider-limit-value-min_des'+fil_con['field_id'];
            var valuemaxdes ='slider-limit-value-max_des'+fil_con['field_id'];
            var nonLinearSlider2 = document.getElementById(data_des);
            
            noUiSlider.create(nonLinearSlider2, {
                connect: true,
                behaviour: 'tap',
                step: 1,
                start: [data['min'] , data['max']],
                range: {
                    'min': [data['min']],
                    'max': [data['max']]
                }
            });

        var limitFieldMin_des = document.getElementById(valuemindes);
        var limitFieldMax_des = document.getElementById(valuemaxdes);
        nonLinearSlider2.noUiSlider.on('update', function (values, handle) {
        (handle ? limitFieldMax_des : limitFieldMin_des).innerHTML = values[handle];
        });
        nonLinearSlider2.noUiSlider.on('update', function (values, handle) {
           findDataRage(nonLinearSlider2.noUiSlider.get() ,fil_con['field_id'] );
        });
     }
          
    });

    }
    function findDataRage(arrRage ,type){
         
        var pro_arr = [];
        $.each(productFilter, function(index,value){   
            value['contentFilter'].filter(function(data) {
              if(data['type_id'] == type){
                  if(data['data_1'] >= arrRage[0] &&  data['data_1'] <= arrRage[1]){
                    var index = pro_arr.findIndex(
                        function(x){
                            return x.pro_id === value['pro_id'];
                        }
                        )
                    if(index == -1){
                        pro_arr.push(value);  
                    }
                  } 
               }
            });
        });
        var arr_val = pro_arr;
        var arr_result = [];
        var type_sor = 0;
       var type_se = $('.selectSort').val();
       if(type_se == 1){
        arr_result =   sortModelName(arr_val);
          type_sor = 1;
       }else if(type_se == 2){
        arr_result = sortOutputLH(arr_val ,4);
        type_sor = 2;
       }else if(type_se == 3){
        arr_result = sortOutputLH(arr_val ,3);
        type_sor = 3;
       }else if(type_se == 4){
        arr_result = sortOutputLH(arr_val ,8);
        type_sor = 4;
       }else if(type_se == 5){
        arr_result = sortModelName(arr_val);
       }
       var current_list =  $('#current_list_item').val();
      if(current_list == 0){
        onclickListView(arr_result,1 ,type_sor);
      }else{
        onclickGridView(arr_result);
      }
      if(arr_result.length > 0){
        $(".moreBox").slice(0, 8).show();
        $(".moreBox_mobile").slice(0, 8).show();
        $(".row_table").slice(0, 8).show();
      }
  
        $('.countproduct').text(arr_result.length);
        
    }

</script>
<script>

function loadeMore(event,i){
    if ($(".moreBox:hidden").length != 0) {
      $("#loadMore").show();
    }  
      event.preventDefault();
     
      $(".moreBox:hidden").slice(0, 4).slideDown();
      if ($(".moreBox:hidden").length == 0) {
        $("#loadMore").fadeOut('hide');
      }
  }
  function loadeMoreMobile(event,i){
    if ($(".moreBox_mobile:hidden").length != 0) {
      $("#loadMore_mobile").show();
    }  
      event.preventDefault();
     
      $(".moreBox_mobile:hidden").slice(0, 4).slideDown();
      if ($(".moreBox_mobile:hidden").length == 0) {
        $("#loadMore_mobile").fadeOut('hide');
      }
  }
  function loadlistview(event ,i){
    if ($(".row_table:hidden").length != 0) {
      $("#loadlistview").show();
    }  
      event.preventDefault();
     
      $(".row_table:hidden").slice(0, 4).slideDown();
      if ($(".row_table:hidden").length == 0) {
        $("#loadlistview").fadeOut('hide');
      }
  }

  $(window).resize(function() {
   if($(window).width() <= 786){
    $('#current_list_item').val(1);
    fillerData();
   }
 });

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front-end', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Deltapsu_Production\dependencies\resources\views/front-end/product.blade.php ENDPATH**/ ?>