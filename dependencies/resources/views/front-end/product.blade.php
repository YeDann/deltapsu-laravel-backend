@extends('layouts.front-end')
@section('css')
<?php $imgDown = asset('frontend-asset/image/arrow-down.svg') ?>
<style>
    /* select */
    .form-control {
        font-size: 14px;
        -webkit-appearance: none;
        -moz-appearance: none;
        border-radius: 0;
        border: 1px solid #444444;
        background-position: right 50%;
        background-repeat: no-repeat;
        background-image: url('{{$imgDown}}');
        padding-right: 24px;
    }

    .form-control:disabled,
    .form-control[readonly] {
        background-color: #F2F2F2;
        border: 1px solid #C1C1C1 !important;
        opacity: 1;
        color: #C1C1C1;
        background-image: unset;
    }

    .form-control:focus {
        color: #495057;
        background-color: #fff;
        border-color: #0087DC;
        outline: unset;
        box-shadow: unset;
    }

    input[type=text],
    input[type=email] {
        background-image: unset;

    }

    .input-label {
        position: relative;
    }

    input[required]+label {
        color: #707070;
        font-family: Arial;
        font-size: 14px;
        position: absolute;
        bottom: 0;
        left: 12px;
        /* the negative of the input width */
    }

    #showfiler a {
        text-decoration: none;
        font-size: 14px;
        color: #000;
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

    .table thead th {
        vertical-align: middle !important;
        text-align: center;
    }

    .table td {
        /* border-top: unset; */
    }

    tbody td {
        border-top: 2px solid #e4e4e4 !important;
        border-bottom: 2px solid #e4e4e4;
    }

    tbody td:first-child {
        border-left: 2px solid #e4e4e4;
    }

    tbody td:last-child {
        border-right: 2px solid #e4e4e4;
    }

    /* tr td {
    padding: 10px;
    } */

    .table td,
    .table th {
        padding: 0;
    }

    .table th {
        padding: 3px 11px !important;
    }



    .list-group {
        margin-top: 20px;
    }

    .modal-open {
        overflow: auto;
        padding-right: 0 !important;
    }

    @media(max-width:414px) {
        .selectSort {
            width: 200px;
            text-overflow: ellipsis;
        }

        .form-control {
            font-size: 12px !important;
            padding: .375rem 6px !important;
        }

    }

    @media(max-width:320px) {
        .selectSort {
            width: 154px;
        }

    }


    a {
        color: #0087DC;
    }

    .in-volt {
        height: 50px;
    }

    .w-tabfix {
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
        color: #000;
        top: 50%;
        right: 0.25rem;
        transform: translateY(calc(50% - 2rem));
    }

    .w-tabfix:after {
        right: 4.5px;
        content: "\f107";
        font-family: 'FontAwesome';
        font-weight: 900;
        font-size: 1rem;
        line-height: 7px;
        display: block;
        visibility: visible;
        position: absolute;
        color: #000;
        top: 50%;
        right: 0.25rem;
        transform: translateY(calc(50% - 0rem));
    }

    .w-tabfix.active {
        color: #0087DC;
    }

    .pro_desc.w-tabfix:before {
        color: #0087DC;
        opacity: 1;
    }

    .pro_asc.w-tabfix:after {
        color: #0087DC;
        opacity: 1;
    }

    .w-td-con {
        width: 83px;
        word-break: break-all;
    }

    .w-td-con-text-editor {
        width: 100%;
        text-align: center;
        word-break: break-all;
    }
</style>
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .select2-container .select2-selection--single {
        height: 40px;
        border-radius: 0px;
    }

    .select2-container .select2-selection--single .select2-selection__rendered {
        padding-top: 6px;
        padding-bottom: 6px
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        font-size: 14px;
        -webkit-appearance: none;
        -moz-appearance: none;
        background-position: right 50%;
        background-repeat: no-repeat;
        background-image: url('{{$imgDown}}');
        top: 6px;

    }

    .select2-container--default .select2-selection--single .select2-selection__arrow b {
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

    .w-number {
        width: 20px !important;
    }

    .w-120 {
        width: 130px;
    }

    .icon-inquiry-product {
        font-size: 25px;
        color: #ffffff;
    }
    /* 加入 Stock 按鈕後，列表卡片按鈕列由 3 顆增為 4 顆（僅作用於列表頁，商品詳細頁不受影響）。
       間距改用容器 gap 而非各按鈕 margin —— 因部分按鈕外層包 <a>、部分為裸 <button>，
       margin 加在 button 上會造成 flex 子元素間距不一致；gap 對所有子元素一致，並縮小 icon 以容於窄卡片。 */
    .boxlist-icon-img {
        display: flex;
        flex-wrap: nowrap;
        align-items: center;
        gap: 6px;
        padding-bottom: 12px;   /* icon 列下方多留一點 padding */
    }
    .boxlist-icon-img .img-btn-icon-pro {
        margin-right: 0;
    }
    .boxlist-icon-img .img-btn-icon-pro img {
        width: 30px;
        height: 30px;
        object-fit: contain;
    }
    /* grid 檢視（桌機 + 手機，皆在 #GridView）：四顆平均分佈滿卡片寬，左右貼齊卡片內邊距；
       list 檢視（#ListView）寬卡片維持靠左、不套用，避免 icon 被撐得太開。 */
    #GridView .boxlist-icon-img {
        justify-content: space-between;
    }
    /* 手機 grid icon 列（帶 .pd-mobile，較具體故蓋過上方桌機的 space-between）：改用 space-evenly，
       讓最左/最右 icon 與卡片邊的距離跟 icon 之間的間距一致（全部等距）；移除原 .pd-mobile 左右 13px padding
       以免疊加破壞等距。桌機 grid（無 .pd-mobile）維持 space-between。 */
    #GridView .boxlist-icon-img.pd-mobile {
        justify-content: space-evenly;
        padding-left: 0;
        padding-right: 0;
    }

    /* 769–991px：桌機 banner 兩欄(col-lg-6)會上下堆疊，圖原本 .middle-img 絕對定位會疊到文字。
       改成正常流：文字與圖垂直堆疊、各自水平置中，banner 貼合內容＋上下對稱留白，不重疊 */
    @media (min-width: 769px) and (max-width: 991px) {
        #products-index-banner-type .banner-type-product-all {
            height: auto;
            padding: 32px 0;
        }
        #products-index-banner-type .box-banner-pro-type-all {
            height: auto;
        }
        #products-index-banner-type .box-banner-pro-type-all .text-middle {
            position: static;
            transform: none;
            text-align: center;
        }
        #products-index-banner-type .banner-products-pic {
            display: flex;
            justify-content: center;
            margin-bottom: 0;
        }
        #products-index-banner-type .banner-products-pic .middle-img {
            position: static;
            transform: none;
            margin-top: 16px;
            max-height: 240px;
        }
    }

    /* ≤768px 手機版 banner：圖原本只有 max-width、無 max-height，整張會撐高溢出蓋到下方 Search。
       banner 改貼合內容、圖限制最大高度，不再溢出 */
    @media (max-width: 768px) {
        .products-index-banner-tablet-down .banner-type-product-all-tablet-down {
            height: auto;
            padding: 24px 0;
        }
        .products-index-banner-tablet-down .img-res-prolis {
            max-height: 200px;
            width: auto;
        }
    }

    /* filter 側欄 checkbox：長標籤換行時用 flex 讓框固定在左、文字縮排對齊第一行
       （取代 inline-block 換行整段掉到框下方的問題）；單行標籤外觀不變 */
    .box-input-checkbox .cbx {
        display: flex;
        align-items: flex-start;
    }
    .box-input-checkbox .cbx span:first-child {
        flex-shrink: 0;
        margin-top: 2px;
    }
    .add-hight{
        margin-top:10px;
    }
    .text-editor-card {
        color: #5f5f5f;
        font-size: 14px;
        line-height: 20px;
        font-weight: 300;
        margin-bottom: .25rem;
    }

    .pad-right-1rem {
        padding-right: 1rem !important;
    }

    .js-example-basic-single {
        width: 100%;
    }
    .box-search-icon {
        border-top-left-radius: 6px;
        border-bottom-left-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;   /* icon 在框內置中 */
    }

    .select2-container .select2-selection--single {
        /* border-top-left-radius: 6px;
        border-bottom-left-radius: 6px; */
        border-bottom-right-radius: 6px;
        border-top-right-radius: 6px;
    }

    .select2-container {
        width: 174px !important;
    }

    .break-word {
        word-break: break-word !important;
    }

    .break-word > .w-td-con-text-editor {
        word-break: break-word !important;
    }

    @media (min-width: 350px) and (max-width: 768px) {
        .select2-container {
            width: 100% !important;
        }
    }
</style>

@endsection

@section('meta')
<title>{{isset($metatag[0]->title)? $metatag[0]->title :''}}</title>
<meta name="description" content="{{isset($metatag[0]->description)? $metatag[0]->description :''}}">
<?php
  $url_name = isset($subCategories[0]) ? $subCategories[0]->url_item  : null;
  $categories_id = isset($subCategories[0]) ? $subCategories[0]->sub_pro_id  : null;
  // 定義 $subCate 變數供 JavaScript 使用
  $subCate = isset($subCategories[0]) ? $subCategories[0] : null;

  // 建立分類 ID 到 url_item 的對應表
  $cateUrlMap = [];
  foreach($subCategories as $subCategory) {
      $cateUrlMap[$subCategory->sub_pro_id] = $subCategory->url_item;
  }
  $cateUrlMapJson = json_encode($cateUrlMap);
?>
@if(isset($catename) && $catename && isset($cateid) && $cateid)
<link rel="canonical" href="{{ config('app.url') }}/{{App::getLocale()}}/product/{{$main_cate_id}}/{{$catename}}/{{$cateid}}" />
@else
<link rel="canonical" href="{{ config('app.url') }}/{{App::getLocale()}}/product/{{$main_cate_id}}" />
@endif
@endsection
@section('container')
<div class="padding-top-content">
</div>
<div class="products-index-banner visible-upper-mobile" id="products-index-banner-type">
    <div class="products-index-nav">
        <div class="bg-bredcrumb">
            <div class="container">
                <nav aria-label="breadcrumb" id="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item text-breadcrumb-home">
                            <a href="{{route('index','home')}}">{{$staticContent['Home']}}</a>
                        </li>
                        <li class="breadcrumb-item active text-breadcrumb" aria-current="page">
                            <a href="#">{{$staticContent['Products']}}</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="padding-top-content-breadcrumb"></div>
    <div class="banner-type-product-all item"
        style="background-image: url('{{asset('frontend-asset/image/Categories@2x.png')}}');">
        {{-- style="background-color: #818181;background-image: url('');" --}}
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="box-banner-pro-type-all">
                        <div class="text-middle">
                            <h1 class="text-title-banner">{{ $mainCategory->name }}</h1>
                            <div class="text-p-banner my-2">{!! $mainCategory->content !!}</div>
                            @if(isset($mainCategory->file) && $mainCategory->file)
                            <a class="text-color-delta text-bold"
                                href="{{ config('app.url') }}/medias/categories/{{ $mainCategory->file }}" target="_blank"><img
                                    class="align-baseline mr-2"
                                    src="{{ asset('frontend-asset/image/icon/download-icon.svg') }}" alt="">
                                {{ $staticContent['Download_selection_guide'] }}
                            </a>
                            @else
                            {{-- <a class="text-color-delta text-bold" href="#"><img class="align-baseline mr-1"
                                    src="{{asset('frontend-asset/image/icon/download-icon.svg')}}" alt=""> Empty
                                selection
                                guide
                            </a> --}}
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 banner-products-pic ">
                    {{-- <img src="{{asset('frontend-asset/image/DIN RAIL POWER SUPPLY@2x.png')}}" alt=""> --}}
                    @if(isset($mainCategory->banner))
                    <img class="img-fluid middle-img" src="{{ config('app.url') }}/medias/categories/{{ $mainCategory->banner }}"
                        alt="Main Category Banner">
                    @else
                    <img class="img-fluid middle-img" src="{{ asset('frontend-asset/image/blank.png') }}" alt="">
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<div class="products-index-banner-tablet-down visible-mobile-only">
    <div class="banner-type-product-all-tablet-down"
        style="background-image: url('{{asset('frontend-asset/image/Categories@2x.png')}}');">
        <div class="container">
            <div class="py-xl-5 py-2 text-center">
                <p class="text-delta text-bold mt-5">{{$mainCategory->name}}</p>
                @if(isset($mainCategory->file))
                <a href="{{config('app.url')}}/medias/categories/{{$mainCategory->file}}"
                    download="{{$staticContent['Download_selection_guide']}}_{{$mainCategory->name}}"><img
                        class="align-baseline mr-1" src="{{asset('frontend-asset/image/icon/download-icon.svg')}}"
                        alt="">
                    {{$staticContent['Download_selection_guide']}}
                </a>
                @else
                @endif
            </div>
            <div class="text-center">
                @if(isset($mainCategory->banner))
                <img class="m-auto img-res-prolis" style=""
                    src="{{config('app.url')}}/medias/categories/{{$mainCategory->banner}}" alt="">
                @else
                <img class="m-auto  img-res-prolis" style="" src="{{asset('frontend-asset/image/blank.png')}}" alt="">
                @endif
            </div>
        </div>
    </div>
</div>
<div class="bg-menu-filler visible-upper-mobile">
    <div class="container">
        <div class="row">
            <div class="col-lg-2 pr-0 col-xl-4 col-md-2 my-auto">
                <div id="showfiler">
                    <a href="#sidebar" data-toggle="collapse" onclick="onclickshow(2);">
                        <img src="{{asset('frontend-asset/image/icon/filter-icon.svg')}}" alt="">
                        {{$staticContent['Show_Filters']}}
                    </a>
                </div>
            </div>
            <div class="col-lg-10 col-xl-8 col-md-10 col-right my-auto">
                <div class="row mr-0 ml-0">
                    <div class="text-lable my-auto">
                        {{$staticContent['Display_Options']}} :
                    </div>
                    <div class="grid-icon icon-grid" onclick="onclickGridViewloadData();">
                        <img src="{{asset('frontend-asset/image/icon/grid-icon.svg')}}" alt="">
                        {{-- <i class="fa fa-th icon-size-grid"></i> --}} {{-- Grid View --}}
                    </div>

                    <div class="grid-icon icon-list visible-upper-mobile" onclick="onclickListViewloadData();">
                        <img src="{{asset('frontend-asset/image/icon/list-icon.svg')}}" alt="">
                        {{-- <i class="fa fa-list icon-size-grid"></i> --}} {{-- List View --}}
                    </div>
                    <div class="text-lable my-auto">
                        {{$staticContent['Sort_by']}} :
                    </div>
                    <div class="input-label">
                        <select id="selectSortDestop" onchange="onselectSortDestop();" class="form-control border-radius-6">
                            <option value="1">{{$staticContent['Model_Name_A-Z']}}</option>
                            <option value="2">{{$staticContent['Output_Voltage_low_to_high']}}</option>
                            <option value="3">{{$staticContent['Output_Current _low_to_high']}}</option>
                            <option value="4">{{$staticContent['Output_Power_low_to_high']}}</option>
                            <option value="5">{{$staticContent['Modifired_Date_newest_to_oldest']}}</option>
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
            <label class="text-dark text-bold mt-2">{{$staticContent['Search_By_Model_Name']}}</label>
            <div class="d-flex justify-content-between">
                {{-- <div class=" search-box-product-mobile mr-2">
                    <div class="box-search-filters-icon ">
                        <img src="{{asset('frontend-asset/image/search-filters-icon.svg')}}" alt="">
                    </div>
                    <label for="key_mobile" class="searchinput-filters">
                        <input type="text" id="key_mobile" placeholder="eg. DRC-24V100W1AZ">
                    </label>
                </div> --}}
                <div class="box-search-input  mr-3">
                    <div class="box-search-icon">
                        <img src="{{asset('frontend-asset/image/search-filters-icon.svg')}}" alt="">
                    </div>
                    <label for="key_mobile" class="searchinput-filters-input">
                        {{-- <input type="text" id="key_mobile"
                            placeholder="{{$staticContent['Search_By_Model_Name']}}"> --}}
                        <select id="key_mobile" class="js-example-basic-single form-control">
                            <option></option>
                            @foreach ($products as $pro)
                            <option value="{{$pro->pro_code}}">{{$pro->pro_code}}</option>
                            @endforeach
                        </select>
                    </label>
                </div>
                <button onclick="onsearchProductMobile();"
                    class="btn-filters btn-search search-btn-product-mobile">{{$staticContent['Search']}}</button>
            </div>

        </div>
        <div class="menu-filler-mobile-filter ">
            <div class=" d-flex justify-content-between h-100">
                <div id="showfiler-mobile" class="my-auto">
                    <div style="color:#fff;" id="filterMobile-btn" onclick="OpenFiiter();"
                        class="filter-mobile-link text-bold"><img
                            src="{{asset('frontend-asset/image/icon/filter-icon.svg')}}"
                            alt="">{{$staticContent['filters']}}</div>
                </div>
                <div class="d-flex">
                    <p class="text-white my-auto mr-2 text-card-detial text-bold">{{$staticContent['Sort_by']}}:</p>
                    <div class="input-label my-auto">
                        <select onchange="onselectSort();" class="form-control selectSort border-radius-6">
                            <option value="1">{{$staticContent['Model_Name_A-Z']}}</option>
                            <option value="2">{{$staticContent['Output_Voltage_low_to_high']}}</option>
                            <option value="3">{{$staticContent['Output_Current _low_to_high']}}</option>
                            <option value="4">{{$staticContent['Output_Power_low_to_high']}}</option>
                            <option value="5">{{$staticContent['Modifired_Date_newest_to_oldest']}}</option>
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
                        data-target="#btn-addremove-filer-model">{{$staticContent['add']}} /
                        {{$staticContent['Remove_Filter']}}</button>
                </div>
                <div class="box-btn-filters btn-box-clear-filer text-center">
                    <button class="btn-filters btn-clear-filer"
                        onclick="resetAllTab();">{{$staticContent['Clear_Filters']}}</button>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="container">
    <!-- Modal -->
    <div class="modal fade" id="btn-addremove-filer-model" tabindex="-1" role="dialog" aria-labelledby="ModalLongTitle"
        aria-hidden="true" style="padding-right:0px !important;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title-cx" id="ModalLongTitle">{{$staticContent['add']}} /
                        {{$staticContent['Remove_Filter']}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="popUp_filter1" class="modal-body">

                </div>
                <div class="modal-footer">
                    <span disabled="disabled" data-dismiss="modal"
                        class="btn btn-sm btn-primary reset">{{$staticContent['Reset']}} </span>
                    <span data-dismiss="modal" class="btn btn-sm btn-primary btn-done"> {{$staticContent['Done']}}
                    </span>
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
                        <div class="search-filter-action border-2px border-radius-6">
                            <p class="text-sixteen-dark">{{$staticContent['Search_By_Model_Name']}}</p>
                            <div class="box-search-input  mr-3">
                                <div class="box-search-icon" style="border-top-left-radius: 6px;border-bottom-left-radius: 6px;">
                                    <img src="{{asset('frontend-asset/image/search-filters-icon.svg')}}" alt="">
                                </div>
                                <label for="key_destop" class="searchinput-filters-input">
                                    {{-- <input type="text" id="key_destop"
                                        placeholder="{{$staticContent['Search_By_Model_Name']}}"> --}}
                                    <select id="key_destop" class="js-example-basic-single form-control">
                                        <option></option>
                                        @foreach ($products as $pro)
                                        <option value="{{$pro->pro_code}}">{{$pro->pro_code}}</option>
                                        @endforeach
                                    </select>

                                </label>
                            </div>
                            <div class="search-filter-action-btn text-center">
                                <button onclick="onsearchProduct();"
                                    class="btn-filters btn-search">{{$staticContent['Search']}}</button>
                            </div>
                        </div>
                    </div>
                    <div id="sort-filter-content" class="tap-filter mb-0">

                    </div>

                    {{-- <div class="box-btn-filters btn-box-use-filer text-center">
                        <button class="btn-filters btn-use-filer">USE FILTERS</button>
                    </div> --}}
                    <div class="box-btn-filters btn-box-addremove-filer text-center">
                        <button class="btn-filters btn-addremove-filer" data-toggle="modal"
                            data-target="#btn-addremove-filer-model"> {{$staticContent['add']}} /
                            {{$staticContent['Remove_Filter']}}</button>
                    </div>
                    <div class="box-btn-filters btn-box-clear-filer text-center">
                        <button class="btn-filters btn-clear-filer" onclick="resetAllTab();">
                            {{$staticContent['Clear_Filters']}}</button>
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


@endsection


@section('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script>
    $('.js-example-basic-single').select2({
        placeholder: '{{$staticContent['Model_Name']}}'
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
    /**
     *
     * 1. 初始化與篩選邏輯
     *    # popcheckSerries()
     *      功能：初始化系列篩選的勾選狀態。
     *      邏輯：如果有傳入 series_id，則自動勾選該系列並展開側邊欄；否則僅展開側邊欄但不預設勾選任何系列。
     *    # filterBaseData()
     *      功能：根據勾選的系列篩選產品。
     *      邏輯：如果有勾選系列，則過濾出屬於該系列的產品；否則顯示所有產品。
     *    # fillerData()
     *      功能：執行所有篩選條件並更新產品列表。
     *      邏輯：綜合處理系列、屬性、認證、狀態等多重篩選條件，並更新 productFilter 陣列。
     *    # series_filter(type, value)
     *      功能：處理系列篩選的勾選與取消勾選。
     *      邏輯：將選中的系列 ID 加入或移出 ser_arr，並呼叫 fillerData() 重新篩選。
     * 2. 視圖切換
     *    # onclickListView(productarray, type, id)
     *      功能：切換至列表視圖 (List View)。
     *      參數：productarray (產品資料), type (排序類型), id (排序欄位 ID)。
     *    # onclickGridView(productarray)
     *      功能：切換至網格視圖 (Grid View)。
     *      參數：productarray (產品資料)。
     *    # onclickshow(id)
     *      功能：切換側邊欄 (篩選器) 的顯示與隱藏。
     *      參數：id (1: 隱藏, 2: 顯示)。
     * 3. 搜尋功能
     *    # onsearchProduct()
     *      功能：桌面版搜尋產品。
     *      邏輯：根據桌面版輸入框的關鍵字篩選產品，並重置其他篩選條件。
     *    # onsearchProductMobile()
     *      功能：手機版搜尋產品。
     *      邏輯：根據手機版輸入框的關鍵字篩選產品，並同步關鍵字到桌面版輸入框。
     * 4. 排序功能
     *    # sortModelName(array_value)：依型號名稱排序 (A-Z)。
     *    # sortModelNameZA(array_value)：依型號名稱排序 (Z-A)。
     *    # sortOutputLH(array_value, type)：依輸出規格排序 (數值小到大)。
     *    # sortOutputHL(array_value, type)：依輸出規格排序 (數值大到小)。
     *    # sortInputLH(array_value, type)：依輸入規格排序 (數值小到大)。
     *    # sortInputHL(array_value, type)：依輸入規格排序 (數值大到小)。
     *    # dimensionLH(array_value)：依尺寸排序 (小到大)。
     *    # dimensionHL(array_value)：依尺寸排序 (大到小)。
     *    # sortDateModify(array_value)：依更新日期排序 (新到舊)。
     *    # onselectSortArr(re_arr)：對搜尋結果進行排序並顯示。
     * 5. 滑桿與數值處理
     *    # createSlider()
     *      功能：建立手機版數值滑桿 (Slider)。
     *      邏輯：使用 noUiSlider 套件建立雙向滑桿，用於數值範圍篩選。
     *    # createSliderDestop()
     *      功能：建立桌面版數值滑桿。
     *      邏輯：同上，但針對桌面版介面。
     *    # findDataRage(arrRage, type)
     *      功能：根據滑桿數值範圍篩選產品。
     *      參數：arrRage (數值範圍 [min, max]), type (規格類型 ID)。
     *    # getMinMaxValueById(id)
     *      功能：取得指定規格類型的最大最小值。
     *      用途：用於設定滑桿的初始範圍。
     **/
    // ==================================================================
    // 篩選面板 UI（Filter Panel UI）
    // ==================================================================
    /**
     * 切換側邊欄顯示/隱藏
     * @param {Number} id 狀態ID (1: 隱藏, 2: 顯示)
     */
    function onclickshow(id) {
        var element = document.getElementById("contentProList");

        if (id == 2) {
            // Show Sidebar
            $(element).removeClass("col-md-12").addClass("col-xl-9 col-lg-12 pl-lg-0");

            if (!$("#sidebar").hasClass("show")) {
                $("#sidebar").addClass("show");
            }

            var html = '<a href="#sidebar" data-toggle="collapse" onclick="onclickshow(1);" ><img src="{{asset('frontend-asset/image/icon/filter-icon.svg')}}" alt=""> {{$staticContent['hide_filters']}}</a>';
            document.getElementById("showfiler").innerHTML = html;

        } else {
            // Hide Sidebar
            $(element).removeClass("col-xl-9 col-lg-12 pl-lg-0").addClass("col-md-12");

            if ($("#sidebar").hasClass("show")) {
                $("#sidebar").removeClass("show");
            }

            var html = '<a href="#sidebar" data-toggle="collapse" onclick="onclickshow(2);" ><img src="{{asset('frontend-asset/image/icon/filter-icon.svg')}}" alt=""> {{$staticContent['Show_Filters']}}</a>';
            document.getElementById("showfiler").innerHTML = html;
        }
    }

    var products = <?= json_encode($products);?>;
    var product_has_property = <?= json_encode($product_has_property);?>;
    var filter_pro = <?= json_encode($filter_pro);?>;
    var domainUrl = '{{config('app.url')}}';
    var series_id = '{{$se_id}}';
    var categoriesHasMainPro =  <?= json_encode($categoriesHasMainPro);?>;
    var series =  <?= json_encode($series);?>;
    var modeSeries = <?= json_encode($modeSeries);?>;
    var section =  <?= json_encode($section);?>;
    var documents_cate =  <?= json_encode($documents_cate);?>;
    var certi_products =  <?= json_encode($certi_products);?>;
    var defaultfilters =  <?= json_encode($defaultfilters);?>;
    var catename = <?= json_encode($catename);?>;
    var cateid = <?= json_encode($cateid);?>;
    var main_cate_id = <?= json_encode($main_cate_id);?>;
    var url_name =  <?= json_encode($url_name);?>;
    var subCategories = <?= json_encode($subCategories);?>;
    var pro_perti = [];

    // 從產品資料獲取分類 ID 的函數
    function getProductCategoryId(product) {
        // 如果產品有分類資訊，取第一個分類
        if (product && product.cate_ids && product.cate_ids.length > 0) {
            return product.cate_ids[0];
        }

        // 回退到原來的邏輯
        return cateid || 0;
    }

    // 產品比較函數，通過產品 ID 查找產品資料
    function addToComparison(productId) {
        // 在全域產品陣列中找到對應的產品
        var product = products.find(function(p) {
            return p.pro_id == productId;
        });

        var categoryId = getProductCategoryId(product);
        showNavCoparison(productId, categoryId);
    }
    
    // 生成詢價連結的函數，從產品分類資料獲取資訊
    function generateEnquiryLink(proCode, product) {
        var typeId = '';
        var typeName = '';

        // 如果有產品物件且包含分類資訊，從產品資料中取得
        if (product && product.cate_ids && product.cate_ids.length > 0) {
            // 取得產品的第一個分類 ID
            typeId = product.cate_ids[0];

            // 在子分類資料中找到對應的 url_item
            var subCat = subCategories.find(function(cat) {
                return cat.sub_pro_id == typeId;
            });

            if (subCat) {
                typeName = subCat.url_item || '';
            }
        }

        // 如果從產品資料中找不到，回退到原來的邏輯
        if (!typeId && cateid) {
            typeId = cateid;
        }
        if (!typeName && catename) {
            typeName = catename;
        }

        var productCode = productKey(proCode);

        // 構建 URL 路徑部分，然後與 route 基礎 URL 結合
        var pathPart = '/' + typeId + '/' + typeName + '/' + productCode;
        pathPart = pathPart.replace(/\/+/g, '/'); // 去除多餘斜線

        return '{{route('LinktoEnquiry')}}' + pathPart;
    }
    var ser_arr = [];
    var mode_series_arr = [];
    var pro_type_arr = [];
    var productFilter = [];
    var productTextSearch = [];
    var fildnumber = [];
    var fildnumberMobile = [];
    var static_product = [];
    var stateType = '';
    var arr_type_an_val = [];
    var arr_value1 = [];

    // ==================================================================
    // 初始化（Initialization）
    // ==================================================================

    $(document).ready(function () {
        // 初始化 URL 參數到篩選陣列
        if (cateid && main_cate_id != 3) {
            pro_type_arr.push(parseInt(cateid));
        }
        if (cateid && main_cate_id == 3) {
            mode_series_arr.push(parseInt(cateid));
        }

        loadAddContent();
        filtercontentMobile();
        filtercontent();
        loadPopUpfilter();

        // 先檢查並恢復瀏覽器返回時的篩選狀態
        var hasRestoredFilters = checkAndRestoreFilters();

        var size  = $(window).width();
        if (size <= 768) {
            $('#current_list_item').val(1);
            // 如果沒有恢復篩選，則執行初始 fillerData
            if (!hasRestoredFilters) {
                setTimeout(function() {
                    fillerData();
                }, 100); // 延遲執行避免與異步恢復衝突
            }
            // var arraydata = loadData(products, product_has_property);
            // onclickGridView(arraydata);
            // $(".moreBox").slice(0, 12).show();
            // $(".moreBox_mobile").slice(0, 12).show();
            // $(".row_table").slice(0, 6).show();
        } else {
            // 桌面版預設開啟 Sidebar
            if (!$("#sidebar").hasClass("show")) {
                $("#sidebar").addClass("show");
                onclickshow(2);
            }
            // 如果沒有恢復篩選，則執行初始 fillerData
            if (!hasRestoredFilters) {
                setTimeout(function() {
                    fillerData();
                }, 100); // 延遲執行避免與異步恢復衝突
            }
            // FirstloadData();
        }
        $.each(filter_pro, function(index_con, fil_con) {
            checkboxaddremove(fil_con['field_id']);
       });

    });

    // ------------------------------------------------------------------
    // localStorage 篩選狀態恢復
    // ------------------------------------------------------------------

    /**
     * 檢查並恢復瀏覽器返回時的篩選狀態
     * 按照正確順序：product type → series → 其他篩選
     */
    function checkAndRestoreFilters() {
        var needsUpdate = false;

        // 嘗試從 localStorage 恢復篩選狀態（加上 checkbox 同步）
        try {
            var savedFilters = JSON.parse(localStorage.getItem('productFilters') || '{}');
            console.log('從 localStorage 讀取篩選狀態:', savedFilters);

            if (savedFilters.pro_type_arr && savedFilters.pro_type_arr.length > 0) {
                pro_type_arr = savedFilters.pro_type_arr;
                needsUpdate = true;

                // 同步更新 checkbox 勾選狀態
                savedFilters.pro_type_arr.forEach(function(typeId) {
                    $("#cx-product_type" + typeId).prop("checked", true);
                    $("#cx-product_type" + typeId + "_mobile").prop("checked", true);
                });
            }

            if (savedFilters.ser_arr && savedFilters.ser_arr.length > 0) {
                ser_arr = savedFilters.ser_arr;
                needsUpdate = true;

                // series checkbox 會在 updateSeriesOptions 後同步
            }

            if (savedFilters.mode_series_arr && savedFilters.mode_series_arr.length > 0) {
                mode_series_arr = savedFilters.mode_series_arr;
                needsUpdate = true;
            }

            // status filter (arr_status)
            if (savedFilters.arr_status && savedFilters.arr_status.length > 0) {
                arr_status = savedFilters.arr_status;
                needsUpdate = true;
                $("#collapse-fliter_status02").addClass('show');
                // status hardcoded: [{id:2}, {id:3}, {id:4}] → idx 0, 1, 2
                var statusDef = [2, 3, 4];
                savedFilters.arr_status.forEach(function(statusId) {
                    var idx = statusDef.indexOf(statusId);
                    if (idx !== -1) {
                        $("#cx-status02" + idx).prop("checked", true);
                        $("#cx-status02" + idx + "_mobile").prop("checked", true);
                    }
                });
            }

            // safety filter (arr_safety)
            if (savedFilters.arr_safety && savedFilters.arr_safety.length > 0) {
                arr_safety = savedFilters.arr_safety;
                needsUpdate = true;
                $("#collapse-fliter_safety03").addClass('show');
                savedFilters.arr_safety.forEach(function(safetyId) {
                    var idx = -1;
                    $.each(documents_cate, function(i, s) {
                        if (s.id == safetyId) { idx = i; return false; }
                    });
                    if (idx !== -1) {
                        $("#cx-safety03" + idx).prop("checked", true);
                        $("#cx-safety03" + idx + "_mobile").prop("checked", true);
                    }
                });
            }

            // application/certificate filter (arr_cer)
            if (savedFilters.arr_cer && savedFilters.arr_cer.length > 0) {
                arr_cer = savedFilters.arr_cer;
                needsUpdate = true;
                $("#collapse-fliter_certifi04").addClass('show');
                // certificates: [{id:1}, {id:2}, {id:3}, {id:4}] → idx = id - 1
                savedFilters.arr_cer.forEach(function(cerId) {
                    var idx = cerId - 1;
                    if (idx >= 0) {
                        $("#cx-certifi04" + idx).prop("checked", true);
                        $("#cx-certifi04" + idx + "_mobile").prop("checked", true);
                    }
                });
            }

            // spec number filter (arr_type_an_val)
            if (savedFilters.arr_type_an_val && savedFilters.arr_type_an_val.length > 0) {
                arr_type_an_val = savedFilters.arr_type_an_val;
                needsUpdate = true;
                savedFilters.arr_type_an_val.forEach(function(saved) {
                    $("#collapse-fliter_" + saved.type).addClass('show');
                    $.each(pro_perti, function(index_per, ppt) {
                        if (ppt.type_id == saved.type && ppt.data_1 == saved.value1 && ppt.data_2 == saved.value2) {
                            $("#cx-normalnum" + saved.type + index_per).prop("checked", true);
                            $("#cx-normalnumber" + saved.type + index_per + "_mobile").prop("checked", true);
                            return false;
                        }
                    });
                });
            }

            // spec text filter (arr_inputtxt)
            if (savedFilters.arr_inputtxt && savedFilters.arr_inputtxt.length > 0) {
                arr_inputtxt = savedFilters.arr_inputtxt;
                needsUpdate = true;
                savedFilters.arr_inputtxt.forEach(function(saved) {
                    $("#collapse-fliter_" + saved.type).addClass('show');
                    $.each(pro_perti, function(index_per, ppt) {
                        if (ppt.type_id == saved.type && ppt.value_text == saved.value_text) {
                            $("#cx-normaltext" + saved.type + index_per).prop("checked", true);
                            $("#cx-" + saved.type + index_per + "_mobile").prop("checked", true);
                            return false;
                        }
                    });
                });
            }
        } catch (e) {
            // localStorage 讀取失敗，忽略
        }

        // 如果 localStorage 沒有數據，檢查 URL 參數
        if (!needsUpdate && typeof cateid !== 'undefined' && cateid && typeof main_cate_id !== 'undefined') {
            if (main_cate_id != 3 && pro_type_arr.indexOf(parseInt(cateid)) === -1) {
                pro_type_arr.push(parseInt(cateid));
                needsUpdate = true;
            }
            if (main_cate_id == 3 && mode_series_arr.indexOf(parseInt(cateid)) === -1) {
                mode_series_arr.push(parseInt(cateid));
                needsUpdate = true;
            }
        }

        // 如果已經從 localStorage 或 URL 恢復了 product type，更新 series 選項
        if (pro_type_arr.length > 0) {
            updateSeriesOptions();
        }

        // 步驟2: 延遲執行篩選（在 series 選項更新後）
        setTimeout(function() {
            // 同步 series checkbox 勾選狀態
            if (ser_arr.length > 0) {
                ser_arr.forEach(function(seriesId) {
                    $("#cx-series01" + seriesId).prop("checked", true);
                    $("#cx-series01" + seriesId + "_mobile").prop("checked", true);
                });
            }

            // 步驟3: 如果有任何篩選條件，執行篩選
            if (pro_type_arr.length > 0 || ser_arr.length > 0 || mode_series_arr.length > 0
                || arr_status.length > 0 || arr_safety.length > 0 || arr_cer.length > 0
                || arr_type_an_val.length > 0 || arr_inputtxt.length > 0
                || (savedFilters.arr_slider && savedFilters.arr_slider.length > 0)) {
                fillerData();
            }

            // 步驟4: slider 在 fillerData() 之後還原，讓 findDataRage() 正確過濾
            if (savedFilters.arr_slider && savedFilters.arr_slider.length > 0) {
                savedFilters.arr_slider.forEach(function(saved) {
                    var sliderDes = document.getElementById('slidebar-value-box_des' + saved.field_id);
                    if (sliderDes && sliderDes.noUiSlider) {
                        sliderDes.noUiSlider.set([saved.min, saved.max]);
                    }
                    var sliderMobile = document.getElementById('slidebar-value-box' + saved.field_id);
                    if (sliderMobile && sliderMobile.noUiSlider) {
                        sliderMobile.noUiSlider.set([saved.min, saved.max]);
                    }
                });
            }

            // 恢復完成後清理 localStorage，避免影響下次正常瀏覽
            setTimeout(function() {
                localStorage.removeItem('productFilters');
            }, 500);
        }, 50); // 給 updateSeriesOptions() 時間完成

        // 返回是否需要更新，讓調用者決定是否執行 fillerData
        return needsUpdate;
    }

    /**
     * 將 slider 篩選套用到指定陣列（不影響 productFilter）
     */
    function applySliderFilters(arr) {
        var result = arr;
        $.each(fildnumber, function(index_con, fil_con) {
            var field_id = fil_con['field_id'];
            if (field_id == 'series01' || field_id == 'status02' || field_id == 'certifi04' || field_id == 'safety03' || field_id == 'mode_series') return;
            var sliderEl = document.getElementById('slidebar-value-box_des' + field_id);
            if (!sliderEl || !sliderEl.noUiSlider) return;
            var values = sliderEl.noUiSlider.get();
            var options = sliderEl.noUiSlider.options;
            var rangeMin = options.range['min'][0];
            var rangeMax = options.range['max'][0];
            var movedMin = Math.abs(parseFloat(values[0]) - rangeMin) > 1;
            var movedMax = Math.abs(parseFloat(values[1]) - rangeMax) > 1;
            if (!movedMin && !movedMax) return;
            var arrRage = values;
            var filtered = [];
            $.each(result, function(index, value) {
                value['contentFilter'].filter(function(data) {
                    if (data['type_id'] == field_id) {
                        if (data['data_1'] && data['data_2'] == null) {
                            if (data['data_1'] >= arrRage[0] && data['data_1'] <= arrRage[1]) {
                                var idx = filtered.findIndex(function(x) { return x.pro_code === value['pro_code']; });
                                if (idx == -1) filtered.push(value);
                            }
                        } else if (data['data_1'] != null && data['data_2'] != null) {
                            if (data['data_1'] >= arrRage[0] && data['data_2'] <= arrRage[1]) {
                                var idx = filtered.findIndex(function(x) { return x.pro_code === value['pro_code']; });
                                if (idx == -1) filtered.push(value);
                            }
                        }
                    }
                });
            });
            result = filtered;
        });
        return result;
    }

    function saveFiltersToLocalStorage() {
        try {
            var arr_slider = [];
            $.each(fildnumber, function(index_con, fil_con) {
                var sliderEl = document.getElementById('slidebar-value-box_des' + fil_con['field_id']);
                if (sliderEl && sliderEl.noUiSlider) {
                    var values = sliderEl.noUiSlider.get();
                    var options = sliderEl.noUiSlider.options;
                    var rangeMin = options.range['min'][0];
                    var rangeMax = options.range['max'][0];
                    var movedMin = Math.abs(parseFloat(values[0]) - rangeMin) > 1;
                    var movedMax = Math.abs(parseFloat(values[1]) - rangeMax) > 1;
                    if (movedMin || movedMax) {
                        arr_slider.push({
                            field_id: fil_con['field_id'],
                            min: values[0],
                            max: values[1]
                        });
                    }
                }
            });
            var filtersToSave = {
                pro_type_arr: pro_type_arr,
                ser_arr: ser_arr,
                mode_series_arr: mode_series_arr,
                arr_status: arr_status,
                arr_safety: arr_safety,
                arr_cer: arr_cer,
                arr_type_an_val: arr_type_an_val,
                arr_inputtxt: arr_inputtxt,
                arr_slider: arr_slider
            };
            localStorage.setItem('productFilters', JSON.stringify(filtersToSave));
        } catch (e) {
            // localStorage 保存失敗，忽略
        }
    }

    // ==================================================================
    // 資料載入（Data Loading）
    // ==================================================================

    /**
     * 透過 AJAX 載入產品規格屬性到 pro_perti
     * 注意：使用同步 AJAX (async: false)，確保後續邏輯可直接使用資料
     */
    function loadAddContent() {
        var arr = [];
        var arrproid = [];
        $.each(filter_pro, function(index, element) {
            if (element['field_id'] != 'series01' && element['field_id'] != 'status02' && element['field_id'] != 'safety03' && element['field_id'] != 'certifi04' && element['field_id'] != 'mode_series' ) {
            arr.push(element['field_id']);
            }
        });
        $.each(products, function(index, pro) {
            arrproid.push(pro['pro_id']);
        });
        $.ajax({
            url: "{{route('loadPropoperty')}}",
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

    /**
     * 建立 Popup 篩選面板的 HTML 結構（依 section 分群）
     */
    function loadPopUpfilter() {
        var html1 = '';
        var html2 = '';
        var arr_same = [];

        $.each(filter_pro, function(index_con, fil_con) {
            if (arr_same.indexOf(fil_con['section_id']) == -1 ) {
                arr_same.push(fil_con['section_id']);
                if (fil_con['section_id'] == null) {
                    html2  += '<h6 class="title-cx" style="margin-top: 10px;">{{$staticContent['Other']}}</h6>'
                    html2  += ' <hr>';
                    html2  +='<div id="settingFilter0"></div>';
                } else {
                    html2  += '<h6 class="title-cx" style="margin-top: 10px;">'+searchsecname(fil_con['section_id'])+'</h6>'
                    html2  +=' <hr>';
                    html2  +='<div id="settingFilter'+fil_con['section_id']+ '"></div>';

                }

            }
        });
        $('#popUp_filter1').html(html2);
        getappendhtml();

    }
    /**
     * 將各篩選條件的 checkbox HTML 附加到 Popup 面板對應 section
     */
    function getappendhtml() {

        $.each(filter_pro, function(index_con, fil_con) {
            var html2 = '';
            html2  += ' <input type="checkbox"  id="checkpop'+fil_con['field_id']+'" value="'+fil_con['field_id']+'"';
            html2  += 'class="inp-cbx checkfilter'+fil_con['field_id']+'" style="display: none;">';
            html2  += '<label class="cbx" for="checkpop'+fil_con['field_id']+'"><span>';
            html2  += '<svg width="12px" height="10px" viewbox="0 0 12 10">';
            html2  += '<polyline points="1.5 6 4.5 9 10.5 1"></polyline>';
            html2  += '</svg></span><span>'+fil_con['title']+'</span></label>';
            $('#settingFilter'+fil_con['section_id']).append(html2);

        if (fil_con['field_id'] == 'series01' || fil_con['field_id'] == 'status02'  || fil_con['field_id'] == 'certifi04' || fil_con['field_id'] == 'safety03' || fil_con['field_id'] == 'mode_series' ) {
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
    /**
     * 依 section ID 查找 section 名稱
     * @param {Number} id section ID
     * @returns {String} section 名稱，找不到回傳空字串
     */
    function searchsecname(id) {
        var dataname = '';
        section.filter(function(data) {
         if (data['id'] == id) {
            dataname =  data['name'];
         }
        });
        return dataname;
    }
    var defultfilter = [];
        $.each(defaultfilters, function(index, defaultfil) {
            defultfilter.push(defaultfil['filter_id']);
        });

        // Force default filters based on main_cate_id (Mutually Exclusive)
        // Note: Total products (160) vs Filtered Sum (124) discrepancy:
        // Products with mode_series values NOT in [1, 2, 3] (or null) will not be counted
        // in the hardcoded filter options, but will appear in the "All" list.
        if (main_cate_id == 3) {
            // For Adapter category (ID 3), force 'mode_series'
            if (defultfilter.indexOf('mode_series') == -1) {
                defultfilter.push('mode_series');
            }
        } else {
            // For other categories, force 'product_type'
            if (defultfilter.indexOf('product_type') == -1) {
                defultfilter.push('product_type');
            }
        }
    /**
     * 依 defultfilter 勾選預設篩選項目並觸發顯示/隱藏
     */
    function setDefultShow() {
        $.each(defultfilter, function(index, defilId) {
           $("#checkpop"+defilId).prop("checked" , true);
           checkboxaddremove(defilId);
        });

    }
    $('.reset').click(function () {
        $.each(filter_pro, function(index_con, fil_con) {
            var index = defultfilter.indexOf(fil_con['field_id']);
            if (index == -1) {
                $("#checkpop"+fil_con['field_id']).prop("checked" , false);
                checkboxaddremove(fil_con['field_id']);
            }
         });

    });
    $('.btn-done').click(function () {
        $.each(filter_pro, function(index_con, fil_con) {
            checkboxaddremove(fil_con['field_id']);
        });
    });
    function checkboxaddremove(i) {
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

    // 分類 ID → URL slug 對應表（由 PHP 注入）
    var cateUrlMap = {!! $cateUrlMapJson !!};

    /**
     * 依產品的 cate_ids 取得對應的 URL slug
     * @param {Array} cateIds 產品分類 ID 陣列
     * @returns {String|null} URL slug，找不到回傳 null
     */
    function getCateUrlById(cateIds) {
        if (cateIds && cateIds.length > 0) {
            return cateUrlMap[cateIds[0]] || null;
        }
        return null;
    }

    /**
     * 將 products 與 product_has_property / pro_perti 組合成前端用的產品陣列
     * 若 series_id 不為空，只回傳符合該系列的產品
     * @param {Array} products 產品清單（PHP 注入）
     * @param {Array} product_has_property 產品規格顯示資料（PHP 注入）
     * @returns {Array} 組合後的產品陣列（同時更新全域 productFilter）
     */
    function loadData(products, product_has_property) {
        var productarray = [];
        $.each(products, function(index, value) {
        if (series_id == '') {
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
          productObj['alt_img'] = value['alt_img'];
          productObj['content'] = [];
          productObj['contentFilter'] = [];
            $.each(product_has_property, function(index2, value2) {
            if (value['pro_id'] == value2['product_id']) {
                productObj['content'].push(value2);
            }
         });

         $.each(pro_perti, function(index3, value3) {
                if (value['pro_id'] == value3['product_id']) {
                    productObj['contentFilter'].push(value3);
                }
              });
         productarray.push(productObj);
        } else if (value['series_id'] == series_id) {
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
          productObj['alt_img'] = value['alt_img'];
          productObj['content'] = [];
          productObj['contentFilter'] = [];
            $.each(product_has_property, function(index2, value2) {
            if (value['pro_id'] == value2['product_id']) {
                productObj['content'].push(value2);
            }
         });

            $.each(pro_perti, function(index3, value3) {
                if (value['pro_id'] == value3['product_id']) {
                    productObj['contentFilter'].push(value3);
                }
              });
         productarray.push(productObj);
        }

      });
      productarray.sort(
          function (a, b) {
              return (a.pro_code > b.pro_code) ? 1 : -1;
          });
      productFilter = productarray;

       return productarray;
    }
    /**
     * 將公釐數值換算為英吋
     * @param {Number} value 公釐數值
     * @returns {String} 英吋數值（四捨五入到小數點後2位），輸入 null 時回傳 0
     */
    function mmtonich(value) {
        var sum = 0;
        if (value != null) {
            var cal = value * 0.0393701;
            sum = (Math.round(cal * 100) / 100).toFixed(2);
        }
        return sum;
    }

    function onclickGridViewloadData() {
      $('#current_list_item').val(1);
      var meth =  $('#current_method').val();
      if (meth == 0) {
        fillerData();
      } else if (meth == 1) {
        onsearchProduct();
      } else if (meth == 2) {
        onsearchProductMobile();
      }

    }
    // ==================================================================
    // 核心篩選流程（Core Filter Pipeline）
    // ==================================================================

    /**
     * 執行所有篩選條件並更新產品列表
     * 流程：filterBaseData → 屬性 → 安規 → 認證 → 狀態 → slider → listItemFiler
     * 注意：slider 另由 findDataRage() 處理，此處以 applySliderFilters() 整合
     */
    function fillerData() {
       // 初始化產品篩選陣列
       productFilter = [];
       // 設定篩選模式為預設 (0)
       $('#current_method').val(0);

       // 1. 執行基礎篩選 (系列 Series)
       filterBaseData();

      var arr_filterall = [];

        // 檢查是否所有篩選條件都屬於同一屬性類型
        checktypegroup = arr_type_an_val.every(
            function(val, i, arr) {
               return  val.type === arr[0].type
            }
        );

        if (checktypegroup) {
            // 情況 A：單一屬性類型篩選 (例如僅篩選 Output Voltage)
            // 邏輯：只要符合該類型中的任一條件即可 (OR 邏輯)

            $.each(productFilter, function(index, value) {
            productFilter[index]['contentFilter'].filter(function(data) {
            arr_type_an_val.forEach(function(element) {
                    if (data.type_id == parseInt(element['type']) ) {
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
                        // if (data.type_id == 4 && data.product_id == 103 ) {
                        //     console.log(data1 == datacom1, data2 == datacom2, data3 == datacom3, data4 == datacom4, data5 == datacom5);
                        // }
                        if (data1 == datacom1
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
                            && data12 == datacom12) {
                            var  index = arr_filterall.findIndex( function(x) {
                                return  x.pro_code === value.pro_code;
                            })

                            if (index == -1) {
                                arr_filterall.push(value);
                            }
                          }
                   }
                });
            });
          });

        } else {
            // 情況 B：多重屬性類型篩選 (例如同時篩選 Output Voltage 與 Input Voltage)
            // 邏輯：必須同時符合所有不同類型的條件 (AND 邏輯)

            $.each(productFilter, function(index, value) {
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

                            if (data.type_id == parseInt(element['type'])) {
                                if (data1 == datacom1
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
                                    && data12 == datacom12) {
                                    arrcheck.push(data.type_id);
                                }
                            }

                    });

                });
                var con = checkmethod(arr_type_an_val);
                var uniqueMatches = arrcheck.filter(function(v, i, a) { return a.indexOf(v) === i; }).length;
                if (uniqueMatches >= con) {
                    var  index = arr_filterall.findIndex( function(x) {
                    return  x.pro_code === value.pro_code;
                    })
                    if (index == -1) {
                        arr_filterall.push(value);
                    }
                }
            });

        }

        // 2. 文字屬性篩選 (Input Text Filter)
        var resultinputtext = [];
        if (arr_type_an_val.length > 0) {
            // 若已有數值篩選結果，則基於該結果進行文字篩選
            resultinputtext  = loaddatafilterTypeText(arr_filterall);
        } else {
            // 否則基於基礎篩選結果進行文字篩選
            resultinputtext  = loaddatafilterTypeText(productFilter);
        }

        // 3. 安全認證篩選 (Safety/Certificate Filter)
        var resultCertificate = [];
        if (arr_safety.length > 0) {
          resultCertificate = loadfilterCertificate(resultinputtext);
        } else {
          resultCertificate = resultinputtext;
        }

        // 4. 應用領域篩選 (Segment/Application Filter)
        var resultSegment = [];
        if (arr_cer.length > 0) {
           resultSegment =  loadSegment(resultCertificate);
        } else {
          resultSegment = resultCertificate;
        }

        // 5. 產品狀態篩選 (Status Filter: New, EOL, etc.)
        var resultstatus = [];
        if (arr_status.length > 0) {
            resultstatus =  filterStatusAll(resultSegment);
        } else {
            resultstatus  = resultSegment;
        }


    // 最終篩選結果彙整
    var summaryResult = resultstatus;

    // 套用 slider 篩選（不影響 productFilter，保留 checkbox-only 基底）
    var sliderResult = applySliderFilters(summaryResult);
    var hasCheckboxFilter = arr_status.length > 0 || arr_cer.length > 0 || arr_safety.length > 0 || arr_type_an_val.length > 0 || arr_inputtxt.length > 0;
    var hasSliderFilter = sliderResult.length !== summaryResult.length;

    // 若有啟用任何篩選條件，更新 UI 顯示篩選後的結果
    // filter 選項永遠基於 productFilter（series/type 基礎篩選後），不受 checkbox/slider filter 影響
    // 這樣才能正確顯示當前 series 下所有可用的規格選項（faceted search 行為）
    if (hasCheckboxFilter || hasSliderFilter) {
        listItemFiler(sliderResult); // 更新列表視圖
        findresultfeildbypro(productFilter); // 更新篩選器選項（基於 series/type 篩選結果，非 spec filter 結果）
        productFilter = summaryResult; // 保留 checkbox-only 結果供 findDataRage() 使用
    } else {
        // 若無額外篩選條件，顯示基礎篩選結果
        listItemFiler(productFilter);
        findresultfeildbypro(productFilter);
    }

      // 清空搜尋框內容
      $('#key_destop').val("");
      $('#key_mobile').val("");
    }
    function loaddatafilterTypeText(arr_filterall) {
        var filterIn = [];
        checktypegroupText = arr_inputtxt.every(
            function(val, i, arr) {
                return  val.type === arr[0].type
            }
        );
        if (arr_inputtxt.length > 0) {
            if (checktypegroupText) {
                $.each(arr_filterall, function(index, value) {
                arr_filterall[index]['contentFilter'].filter(function(data) {
                    arr_inputtxt.forEach(function(element) {
                            if (data.type_id == element['type']) {
                                if (data.value_text == null) {
                                    data.value_text = '';
                                }
                                if (element['value_text'] == null) {
                                    data.value_text = '';
                                }
                                if (data.value_text.trim() == element['value_text'].trim()) {
                                    var  index = filterIn.findIndex(
                                        function(x) {
                                            return x.pro_code === value.pro_code;
                                        })
                                    if (index == -1) {
                                        filterIn.push(value);
                                    }
                                }
                        }
                    });
                });
            });
        } else {
            $.each(arr_filterall, function(index, value) {
                var checkarr = [];
                arr_filterall[index]['contentFilter'].filter(function(data) {
                    arr_inputtxt.forEach(function(element) {
                            if (data.type_id == element['type']) {
                                if (data.value_text == null) {
                                    data.value_text = '';
                                }
                                if (element['value_text'] == null) {
                                    data.value_text = '';
                                }
                                if (data.value_text.trim() == element['value_text'].trim()) {
                                    checkarr.push(data.type_id);
                                }
                        }
                    });
                });
                var con = checkmethod(arr_inputtxt);
                var uniqueMatches = checkarr.filter(function(v, i, a) { return a.indexOf(v) === i; }).length;
                if (uniqueMatches >= con) {
                    var  index = filterIn.findIndex(
                        function(x) {
                        return x.pro_code === value.pro_code;
                        })
                        if (index == -1) {
                        filterIn.push(value);
                    }
                }

            });
        }
        } else {
            filterIn = arr_filterall;
        }
        return filterIn;
    }
    function loadSegment(arrFilterInput) {
        var profilter = [];
        var arr_seg = [];
        var proreFilter = [];
        if (arr_cer.length > 0) {
            arr_cer.forEach(function(element) {
                certi_products.filter(function(data) {
                    if (data.certificate_id == element) {
                        arr_seg.push(data);
                    }
                });
                });
                profilter =  arr_seg;
                profilter.forEach(function(element) {
                    arrFilterInput.filter(function(data) {
                        if (data.pro_id == element.product_id) {
                            var  index = proreFilter.findIndex(
                                function(x) {
                                    return x.pro_code === data.pro_code;
                                })
                            if (index == -1) {
                                proreFilter.push(data);
                            }
                        }
                    });
                });
            return  proreFilter;
        } else {

            return  arrFilterInput;
        }
    }
    function loadfilterCertificate(arrFilter) {

        var arr_pro_doc = [];
        var profilter = [];
        var proarr = [];
        var values = [];
        $.ajax({
           url: "{{route('loaddocumentPro')}}",
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
                 if (index2 == -1) {
                    proarr.push(data.product_id);
                 }
             });
             arrFilter.filter(function(data2) {
            proarr.forEach(function(element2) {
                if (data2.pro_id == element2) {
                    var  index = arr_pro_doc.findIndex(
                        function(x) {
                        return x.pro_code === data2.pro_code;
                        })
                        if (index == -1) {
                        arr_pro_doc.push(data2);
                        }
                }
            });
        });

        return arr_pro_doc;
    }
    function filterStatusAll(arrFilter) {
        var filter = [];
        arrFilter.filter(function(data) {
            arr_status.forEach(function(element) {
                if (data.status_product == element) {
                    var  index = filter.findIndex(
                        function(x) {
                            return x.pro_code === data.pro_code;
                        })
                        if (index == -1) {
                            filter.push(data);
                        }
                    }
            });
        });
      return filter;
    }


    // ==================================================================
    // 視圖渲染（View Rendering）
    // ==================================================================

    /**
     * 初始載入產品列表（list view）
     * 注意：目前由 fillerData() 取代，保留供需要時手動呼叫
     */
    function FirstloadData() {
        var arraydata = loadData(products, product_has_property);
        onclickListView(arraydata, 1, 1);
        $(".moreBox").slice(0, 8).show();
        $(".moreBox_mobile").slice(0, 8).show();
        $(".row_table").slice(0, 8).show();
    }

    function onclickListViewloadData() {
        $('#current_list_item').val(0);
        var meth =  $('#current_method').val();
        if (meth == 0) {
        fillerData();
         } else if (meth == 1) {
        onsearchProduct();
      } else if (meth == 2) {
        onsearchProductMobile();
      }

    }
    function viewKey(key) {
            var newkey = key.replace(/[/]/g,'@');
           return newkey;
    }
    /**
     * 切換至網格視圖
     * @param {Array} productarray 產品陣列
     */
    function onclickGridView(productarray) {
        $('#current_list_item').val(1);
        var html = '';
        html += '<div class="GridView visible-upper-mobile" id="GridView">';
        html += '<div class="margin-top-card">';
        html += '<div class="count-products">';
        html += '<span class="countproduct"></span> {{$staticContent['Product(s)']}}';
        html += '</div>';
        html += '<div id="cardGridList" class="row">';
        $.each(productarray, function(index_pro, pro) {
        html += '<div class=" col-xl-3 col-lg-4 col-md-4">';
        html += '<a href="{{route('productsDetailsByType')}}/'+(getCateUrlById(pro['cate_ids']) || '{{ preg_replace('/\s+/', '-', $subCate->url_item)}}')+'/'+viewKey(pro['pro_code']) +'" onclick="saveFiltersToLocalStorage()">';
        html += '<div class=" margin-p-left-card item card moreBox"  style="display: none;">';
        if (pro['status_product'] != 1) {
        html += '<div style="background-color:'+set_sta_color(pro['status_product']) +';" class="new-tag">'+statuspro(pro['status_product'])+'</div>';
        }
        html += '<div class="card-body ft-products-item hover01"><figure><img src="'+domainUrl+'/upload/thumbs/'+pro['picture']+'" class="product-cat mb-2" style="width:70%;"></figure>';
        html += '<div class="">';
        html += '<h4 class="text-title-ft">'+pro['pro_code']+'</h4>';
        html += '</a>';
        html += '<div class="d-flex flex-wrap" >';
        html += '<div class="mr-3">';
        html += '<div class="out-volt ">';
        html += '<h6 class="text-title-ft-sub">{{$staticContent['Output_Voltage']}}</h6>';
        var content = onlycontent(pro['content']);
        // if (content[0]['data_1'] != null) {
        //    html += '<div class="text-ft-sub text-one">'+content[1]['data_1']+content[1]['unit_name']+'</div>';
        // } else {
        //     html += '<div class="text-ft-sub text-one">-</div>';
        // }
        var arrcon1 = [content[1]['data_1'], content[1]['data_2'], content[1]['data_3'], content[1]['data_4'], content[1]['data_5'],
            content[1]['data_6'], content[1]['data_7'], content[1]['data_8'], content[1]['data_9'], content[1]['data_10'], content[1]['data_11'],
            content[1]['data_12']
            ]
            var arrcon2 = [content[2]['data_1'], content[2]['data_2'], content[2]['data_3'], content[2]['data_4'], content[2]['data_5'],
            content[2]['data_6'], content[2]['data_7'], content[2]['data_8'], content[2]['data_9'], content[2]['data_10'], content[2]['data_11'],
            content[2]['data_12']
            ]
            var arrcon3 = [content[0]['data_1'], content[0]['data_2'], content[0]['data_3'], content[0]['data_4'], content[0]['data_5'],
            content[0]['data_6'], content[0]['data_7'], content[0]['data_8'], content[0]['data_9'], content[0]['data_10'], content[0]['data_11'],
            content[0]['data_12']
            ]

        html += '<div class="text-ft-sub text-one">'+checkNullShow(arrcon1, content[1]['unit_name'], content[1]['status_input']).substr(0, 19) +'</div>';
        html += '</div>';
        html += '<div class="out-power">';
        html += '<h6 class="text-title-ft-sub"> {{$staticContent['Output_Power']}}</h6>';
        html += '<div class="text-ft-sub text-one">'+checkNullShow(arrcon2, content[2]['unit_name'], content[2]['status_input']).substr(0, 19)+'</div>';

        html += '</div>';
        html += '</div>';
        html += '<div class="">';
        html += '<div class="out-current">';
        html += '<h6 class="text-title-ft-sub">{{$staticContent['Output_Current']}}</h6>';
        html += '<div class="text-ft-sub text-one">'+checkNullShow(arrcon3, content[0]['unit_name'], content[0]['status_input']).substr(0, 19) +'</div>';
        html += '</div>';
        html += '<div class="in-volt">';
        html += '<h6 class="text-title-ft-sub">{{$staticContent['Input_Voltage']}}</h6>';
        if (typeof content[3]['value_text'] != 'undefined' && content[3]['value_text'] != null && content[3]['value_text'] != 'null') {
        html += '<div class="text-ft-sub text-one">'+content[3]['value_text'].substr(0, 14)+'</div>';
        } else {
            html += '<div class="text-ft-sub text-one">-</div>';
        }
        html += '</div>';
        html += '</div>';
        html += '</div>';
        if (url_name == "wireless-charging-system") {
        html += '<p class="text-title-ft-sub text-two add-hight">{{$staticContent['product_highLights']}}</p>';
        html += '<div class="text-editor-card mt-2"> '+checkNullTexteditor(pro['short_features']) +'</div>';
        } else {
        html += '<div class="dimension">';
        html += '<h6 class="text-title-ft-sub text-one">{{$staticContent['Dimensions']}}</h6>';
        if (pro['dimensionL'] != null && pro['dimensionL'].length < 7 && ['dimensionW'] != '' && pro['dimensionD'] != '') {
        html += '<p class="text-ft-sub text-one">'+pro['dimensionL']+'x'+pro['dimensionW']+'x'+pro['dimensionD']+' mm</p>';
        html += '<p class="text-ft-sub text-one">'+mmtonich(pro['dimensionL'])+'”x'+mmtonich(pro['dimensionW'])+'”x'+mmtonich(pro['dimensionD'])+'”</p>';
        } else if (pro['dimensionL'] != null) {
        html += '<p class="text-ft-sub text-one">'+pro['dimensionL'].substr(0, 18)+'</p>';
        } else {
        html += '<p class="text-ft-sub text-one">-</p>';
        }
        html += '</div>';
        }


        // html += '<div><a class="btn btn-datasheet w-50 mr-2 mt-2" href="{{route('downloadFIle')}}/Datasheet/'+productKey(pro['pro_code'])+'" target="_blank" > {{$staticContent['data_sheet']}}</a></div>';
        // html += '<div href="#" class="btn btn-ft mt-2" onclick="showNavCoparison('+pro['pro_id']+' , {{$cateid}})" >{{$staticContent['Add_to_Compare']}}</div>';
        // html += '<div class="btn-enq-d mt-2"><a class="btn btn-enquiry w-50 mr-2" href="{{route('LinktoEnquiry')}}/'+cateid+'/'+catename+'/'+productKey(pro['pro_code'])+'">{{$staticContent['Enquiry']}}</a></div>';

        html += '<div class="w-100">';
        html += '<div class="boxlist-icon-img">';
        html += '<a href="' + generateEnquiryLink(pro['pro_code'], pro) + '" ><button class="btn img-btn-icon-pro tooltip2"><span>{{$staticContent['Enquiry']}}</span><i class="icon-inquiry-product icon-facon3 icon-question"></i></a>';
        html += '<button onclick="addToComparison('+pro['pro_id']+')" class="btn img-btn-icon-pro tooltip2"><span>{{$staticContent['Add_to_Compare']}}</span><img src="{{asset('/frontend-asset/image/Compare.svg')}}"></button>';
        html += '<a href="{{route('downloadFIle')}}/Datasheet/'+productKey(pro['pro_code'])+'" target="_blank" ><button class="btn img-btn-icon-pro tooltip2"><span>{{$staticContent['data_sheet']}}</span><img src="{{asset('/frontend-asset/image/Datasheet.svg')}}"></button></a>';
        html += '</div>';
        html += '</div>';

        html += '</div>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
         });
        html += '</div>';
        html += '</div>';
        html += ' <div class="text-center mb-2" id="loadMore" style="" onclick="loadeMore(event, 4)">';
        html += '<a href="#"  class="btn btn-boxen"> {{$staticContent['See_More']}}</a>';
        html += '</div>';
        html += '</div>';


        html += '<div class="GridView visible-mobile-only" id="GridView">';
        html += '<div class="margin-top-card ">';
        html += '<div id="cardGridList" class="d-flex flex-wrap">';
        $.each(productarray, function(index_pro, pro) {
            html += '<div class="margin-p-left-card column-grid-card-mobile moreBox_mobile"  style="display: none;">';
            html += '<div class="item card border-radius-6">';
            html += '<a href="{{route('productsDetailsByType')}}/'+(getCateUrlById(pro['cate_ids']) || '{{ preg_replace('/\s+/', '-', $subCate->url_item)}}')+'/'+viewKey(pro['pro_code']) +'" onclick="saveFiltersToLocalStorage()">';
            if (pro['status_product'] != 1) {
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
            html += '<p class="text-title-ft-sub text-two">{{$staticContent['Output_Voltage']}}</p>';
                var arrcon1 = [
                    content[1]['data_1'], content[1]['data_2'], content[1]['data_3'], content[1]['data_4'], content[1]['data_5'],
                    content[1]['data_6'], content[1]['data_7'], content[1]['data_8'], content[1]['data_9'], content[1]['data_10'], content[1]['data_11'],
                    content[1]['data_12']
                ]
                var arrcon2 = [
                    content[2]['data_1'], content[2]['data_2'], content[2]['data_3'], content[2]['data_4'], content[2]['data_5'],
                    content[2]['data_6'], content[2]['data_7'], content[2]['data_8'], content[2]['data_9'], content[2]['data_10'], content[2]['data_11'],
                    content[2]['data_12']
                ]
                var arrcon3 = [
                    content[0]['data_1'], content[0]['data_2'], content[0]['data_3'], content[0]['data_4'], content[0]['data_5'],
                    content[0]['data_6'], content[0]['data_7'], content[0]['data_8'], content[0]['data_9'], content[0]['data_10'], content[0]['data_11'],
                    content[0]['data_12']
                ]

            html += '<div class="text-ft-sub text-two">'+checkNullShow(arrcon1, content[1]['unit_name'], content[1]['status_input']).substr(0, 19)+'</div>';
            html += '</div>';
            html += '<div class="out-power mt-2">';
            html += '<p class="text-title-ft-sub text-two">{{$staticContent['Output_Power']}}</p>';
            html += '<div class="text-ft-sub text-two">'+checkNullShow(arrcon2, content[2]['unit_name'], content[2]['status_input']).substr(0, 19)+'</div>';
            html += '</div>';
            html += '</div>';
            html += '<div class="">';
            html += '<div class="out-current mt-2">';
            html += '<p class="text-title-ft-sub text-two">{{$staticContent['Output_Current']}}</p>';
            html += '<div class="text-ft-sub text-two">'+checkNullShow(arrcon3, content[0]['unit_name'], content[0]['status_input']).substr(0, 19)+'</div>';
            html += '</div>';
            html += '<div class="in-volt mt-2">';
            html += '<p class="text-title-ft-sub text-two">{{$staticContent['Input_Voltage']}}</p>';
            if (content[3]['value_text'] != null && content[3]['value_text'] != 'null') {
                html += '<div class="text-ft-sub text-two">'+content[3]['value_text'].substr(0, 18)+'</div>';
            } else {
                html += '<div class="text-ft-sub text-two">-</div>';
            }
            html += '</div>';
            html += '</div>';
            html += '</div>';

            if (url_name == "wireless-charging-system") {
                html += '<p class="text-title-ft-sub text-two">{{$staticContent['product_highLights']}}</p>';
                html += '<div class="text-editor-card mt-2"> '+checkNullTexteditor(pro['short_features']) +'</div>';
            } else {
                html += '<div class="dimension mt-2">';
                html += '<p class="text-title-ft-sub text-two">{{$staticContent['Dimensions']}}</p>';
                if (pro['dimensionL'] != null && pro['dimensionL'].length < 7 && pro['dimensionW'] != '' && pro['dimensionD'] != '') {
                    html += '<p class="text-ft-sub text-two">'+pro['dimensionL']+'x'+pro['dimensionW']+'x'+pro['dimensionD']+' mm</p>';
                    html += '<p class="text-ft-sub text-two">'+mmtonich(pro['dimensionL'])+'”x'+mmtonich(pro['dimensionW'])+'”x'+mmtonich(pro['dimensionD'])+'”</p>';
                } else if (pro['dimensionL'] != null) {
                    html += '<p class="text-ft-sub text-two">'+pro['dimensionL'].substr(0, 14)+'</p>';
                } else {
                    html += '<p class="text-ft-sub text-two">-</p>';
                }
                html += '</div>';
            }

            html += '</div>';
            html += '</div>';
            html += '<div class="w-100">';
            html += '<div class="boxlist-icon-img pd-mobile">';
            html += '<a href="' + generateEnquiryLink(pro['pro_code'], pro) + '" ><button class="btn img-btn-icon-pro tooltip2"><span>{{$staticContent['Enquiry']}}</span><i class="icon-inquiry-product icon-facon3 icon-question"></i></button></a>';
            html += '<button onclick="addToComparison('+pro['pro_id']+')" class="btn img-btn-icon-pro tooltip2"><span>{{$staticContent['Add_to_Compare']}}</span><img src="{{asset('/frontend-asset/image/Compare.svg')}}"></button>';
            html += '<a href="{{route('downloadFIle')}}/Datasheet/'+productKey(pro['pro_code'])+'" target="_blank" ><button class="btn img-btn-icon-pro tooltip2"><span>{{$staticContent['data_sheet']}}</span><img src="{{asset('/frontend-asset/image/Datasheet.svg')}}"></button></a>';
            html += '</div>';
            html += '</div>';
            html += '</div>';
            html += '</div>';
        });

        html += '</div>';
        html += '</div>';
        html += ' <div class="text-center my-3" id="loadMore_mobile" style="" onclick="loadeMoreMobile(event, 4)">';
        html += '<a href="#"  class="btn btn-boxen"> {{$staticContent['See_More']}} </a>';
        html += '</div>';
        html += '</div>';

        $('#contentProList').html(html);
        $(document).ready(function () {
            $('.icon-grid img').addClass('bord-icon');
            $('.icon-list img').removeClass('bord-icon');
            $('#contentProList').removeClass('space-listviews');
        });
    }

    /**
     * 切換至列表視圖
     * @param {Array} productarray 產品陣列
     * @param {Number} type 排序類型
     * @param {Number} id 排序欄位ID
     */
    function onclickListView(productarray, type , id) {
        var html1 = '';
        html1 += '<div class="ListView visible-upper-mobile" id="ListView">';
        html1 += '<div class="count-products">';
        html1 += '<span class="countproduct"></span> {{$staticContent['Product(s)']}}';
        html1 += '</div>';
        html1 += '<table id="dtBasicExample" class="table" cellspacing="1em" width="100%">';
        html1 += '<thead>';
        html1 += '<tr class="headder-bg-table">';
        html1 += '<th  id="sortdata1" class=" header-font-table w-tabfix"  onclick="selectTable(1)">{{$staticContent['Model_Name']}}</th>';
        html1 += '<th id="sortdata2" class=" header-font-table w-tabfix w-120"  onclick="selectTable(2)">{{$staticContent['Output_Voltage']}}</th>';
        html1 += '<th id="sortdata3" class=" header-font-table w-tabfix w-120"  onclick="selectTable(3)">{{$staticContent['Output_Current']}}</th>';
        html1 += '<th id="sortdata4" class=" header-font-table w-tabfix w-120"  onclick="selectTable(4)">{{$staticContent['Output_Power']}} </th>';
        html1 += '<th id="sortdata5" class=" header-font-table w-tabfix"  onclick="selectTable(5)">{{$staticContent['Input_Voltage']}}</th>';
        if (url_name == "wireless-charging-system") {
            html1 += '<th  class="header-font-table" >{{$staticContent['product_highLights']}}</th>';
        } else {
            html1 += '<th id="sortdata6" class="header-font-table w-tabfix" onclick="selectTable(6)" >{{$staticContent['Dimensions']}}</th>';
        }

        html1 += '</tr>';
        html1 += '</thead>';
        html1 += '<tbody id="listcardList">';
        html1 += '</tbody>';
        html1 += ' </table>';
        html1 += '</div>';
        html1 += ' <div class="text-center mb-2" id="loadlistview" style="" onclick="loadlistview(event, 4)">';
        html1 += '<a href="#"  class="btn btn-boxen">{{$staticContent['See_More']}}</a>';
        html1 += '</div>';
        $('#contentProList').html(html1);
        listviewCard(productarray);
        // if (type == 0) {
        //     $('#dtBasicExample').DataTable({"order": [[ 0, "asc" ]] ,  paging: false} );
        // } else if (type == 1) {
        //     $('#dtBasicExample').DataTable({"order": [[ 1, "asc" ]] ,  paging: false}  );
        // } else if (type == 2) {
        //     $('#dtBasicExample').DataTable({"order": [[ 2, "asc" ]],  paging: false}  );
        // } else if (type == 3) {
        //     $('#dtBasicExample').DataTable({"order": [[ 3, "asc" ]],  paging: false} );
        // }
        if (type == 1) {
            $('#sortdata'+id).addClass('pro_asc active');
        } else {
            $('#sortdata'+id).addClass('pro_desc active');
        }
        $('.countproduct').text(productarray.length);
        $(document).ready(function () {
            $('.icon-list img').addClass('bord-icon');
            $('.icon-grid img').removeClass('bord-icon');
            $('#contentProList').addClass('space-listviews');
        });
    }

    function listviewCard(productarray)
    {
        var html1 = '';

        $.each(productarray, function(index_pro, pro) {
            html1 += '<tr class="box-cardlist row_table" style="display: none;">';
            html1 += '<td class="border-radius-6">';
            html1 += '<div class="cardlist-toadd">';
            html1 += '<div class="cardlist-view hover01">';
            html1 += '<a href="{{route('productsDetailsByType')}}/'+(getCateUrlById(pro['cate_ids']) || '{{ preg_replace('/\s+/', '-', $subCate->url_item)}}')+'/'+viewKey(pro['pro_code']) +'" onclick="saveFiltersToLocalStorage()">';
            if (pro['status_product'] != 1) {
                html1 += '<div style="background-color:'+set_sta_color(pro['status_product']) +';" class="text-over-cardlist"> '+ statuspro(pro['status_product'])+'';
                html1 += '</div>';
            }
            html1 += '<figure><img class="img-card-list" alt="'+checkNullImg(pro['alt_img']) +'" src="'+domainUrl+'/upload/thumbs/'+pro['picture']+'"></figure>';
            html1 += '</div>';
            html1 += '<div class="cardlist-text">';
            html1 += '<h5 class="text-title-ft-listv">'+pro['pro_code']+'</h5>';
            html1 += '</div>';
            html1 += '</a>';
            html1 += '<div class="w-100">';
            html1 += '<div class="boxlist-icon-img">';
            html1 += '<a href="' + generateEnquiryLink(pro['pro_code'], pro) + '" ><button class="btn img-btn-icon-pro tooltip2"><span>{{$staticContent['Enquiry']}}</span><i class="icon-inquiry-product icon-facon3 icon-question"></i></button></a>';
            html1 += '<button onclick="addToComparison('+pro['pro_id']+')" class="btn img-btn-icon-pro tooltip2"><span>{{$staticContent['Add_to_Compare']}}</span><img src="{{asset('/frontend-asset/image/Compare.svg')}}"></button>';
            html1 += '<a href="{{route('downloadFIle')}}/Datasheet/'+productKey(pro['pro_code'])+'" target="_blank" ><button class="btn img-btn-icon-pro tooltip2"><span>{{$staticContent['data_sheet']}}</span><img src="{{asset('/frontend-asset/image/Datasheet.svg')}}"></button></a>';
            html1 += '</div>';
            html1 += '</div>';
            // html1 += '<div class="w-100">';
            // html1 += '<div class="btn btn-ft" onclick="showNavCoparison('+pro['pro_id']+' , {{$cateid}})"> + {{$staticContent['Add_to_Compare']}}</div>';
            html1 += '</div>';
            html1 += '</td>';
            var content = onlycontent(pro['content']);
            var arrcon1 = [content[1]['data_1'], content[1]['data_2'], content[1]['data_3'], content[1]['data_4'], content[1]['data_5'],
                    content[1]['data_6'], content[1]['data_7'], content[1]['data_8'], content[1]['data_9'], content[1]['data_10'], content[1]['data_11'],
                    content[1]['data_12']
                ]
                var arrcon2 = [content[0]['data_1'], content[0]['data_2'], content[0]['data_3'], content[0]['data_4'], content[0]['data_5'],
                    content[0]['data_6'], content[0]['data_7'], content[0]['data_8'], content[0]['data_9'], content[0]['data_10'], content[0]['data_11'],
                    content[0]['data_12']
                ]
                var arrcon3 = [content[2]['data_1'], content[2]['data_2'], content[2]['data_3'], content[2]['data_4'], content[2]['data_5'],
                    content[2]['data_6'], content[2]['data_7'], content[2]['data_8'], content[2]['data_9'], content[2]['data_10'], content[2]['data_11'],
                    content[2]['data_12']
                ]
            // html1 += '<td>';
            // html1 += '<div class="card-btn-a">';

            // html1 += '<div class="card-btn-a-detail">';
            // html1 += '<a class="link-d-sheet" href="{{route('downloadFIle')}}/Datasheet/'+productKey(pro['pro_code'])+'" target="_blank">';
            // html1 += '<div class="text-name-data">Datasheet</div>';
            // html1 += '<div class="icon-datasheet">';
            // html1 += '<i class="icon-facon2 icon-download"></i>';
            // html1 += '</div>' ;
            // html1 += '</a>';
            // html1 += '<div class="btn-enq-d"><a class="btn btn-enquiry w-50 mr-2" href="{{route('LinktoEnquiry')}}/'+cateid+'/'+catename+'/'+productKey(pro['pro_code'])+'">{{$staticContent['Enquiry']}}</a></div>';
            // html1 += '</div></div>';
            // html1 += '</td>';
            html1 += '<td class="text-middle-td"> <div class="w-td-con">'+checkNullShow(arrcon1, content[1]['unit_name'] , content[1]['status_input'])+'</div></td>';
            html1 += '<td class="text-middle-td"> <div class="w-td-con">'+checkNullShow(arrcon2, content[0]['unit_name'] , content[0]['status_input'])+'</div></td>';
            html1 += '<td class="text-middle-td"> <div class="w-td-con">'+checkNullShow(arrcon3, content[2]['unit_name'] , content[2]['status_input'])+'</div></td>';

            if (typeof content[3]['value_text'] != 'undefined' && content[3]['value_text'] != null && content[3]['value_text'] !='' && content[3]['value_text'] != 'null') {
                html1 += ' <td class="text-middle-td">'+ stringfor(content[3]['value_text'])+'</td>';
            } else if (content[3]['value_text'] != null && content[3]['value_text'] != 'null') {
                html1 += ' <td class="text-middle-td">'+content[3]['value_text']+'</td>';
            } else {
                html1 += ' <td class="text-middle-td">-</td>';
            }
            if (url_name == "wireless-charging-system") {
                html1 += ' <td class="text-middle-td border-radius-6 pad-right-1rem break-word"> <div class="w-td-con-text-editor">'+checkNullTexteditor(pro['short_features'])+'</div></td>';
            } else {
                if (pro['dimensionL'] != null && pro['dimensionL'].length < 7 && pro['dimensionW'] != '' && pro['dimensionD'] != '') {
                    html1 += '<td class="text-middle-td border-radius-6 pad-right-1rem break-word">'+pro['dimensionL']+' x '+pro['dimensionW']+' x '+pro['dimensionD']+' mm ';
                    html1 += '<br>'+mmtonich(pro['dimensionL'])+'” x '+mmtonich(pro['dimensionW'])+'” x '+mmtonich(pro['dimensionD'])+'”</td>';
                } else {
                    html1 += '<td class="text-middle-td border-radius-6 pad-right-1rem break-word">'+pro['dimensionL']+'</td>';
                }
            }
            html1 += '</tr>';
        });

        $('#listcardList').html(html1);
    }

    // ------------------------------------------------------------------
    // 顯示工具函式（Display Utilities）
    // ------------------------------------------------------------------

    /**
     * 將產品代碼中的 '/' 替換為 '@' 以用於 URL
     * @param {String} key 產品代碼
     * @returns {String} URL 安全的產品代碼
     * @see viewKey() — 功能相同，兩者擇一即可
     */
    function productKey(key) {
        var newkey = key.replace(/[/]/g,'@');
        return newkey;
    }

    /**
     * 若值為 truthy 則回傳原值，否則回傳空字串（用於 rich text editor 欄位）
     * @param {*} data
     * @returns {String}
     */
    function checkNullTexteditor(data) {
        if (data) {
            return data;
        } else {
            return '';
        }
    }

    /**
     * 格式化規格數值陣列為顯示字串
     * @param {Array}  dataarr 數值陣列
     * @param {String} unit    單位字串（例如 'V', 'A'）
     * @param {Number} status  status_input：1/2=列舉, 3=範圍
     * @returns {String} 格式化字串，無值時回傳 '-'
     */
    function checkNullShow(dataarr, unit, status) {
        var string = '';
        var arrstri = [];
        if (status == 1 || status == 2) {
            $.each(dataarr, function(index, data) {
                if (data != null && data != '') {
                arrstri.push(data+unit);
                }
            });
            string = arrstri.join(', ');
        } else if (status == 3) {
            string = dataarr[0]+'-'+dataarr[1]+unit;
        }
        if (string == '') {
            string = '-';
        }
        return  string;
    }

    /**
     * 將長字串在超過9字元的單字後插入 <br> 換行，短單字間保留空格
     * 用於卡片視圖中避免長型號名稱溢出
     * @param {String} str 原始字串
     * @returns {String} 處理後含 <br> 的字串
     */
    function stringfor(str) {
        var arrStr = str.split(/\s/g);
        var strfor = '';
        $.each(arrStr, function(index, data) {
            if (data.length != 0) {
                if (data.length < 9 ) {
                    strfor += data.replace("<br>", "");
                    strfor += ' ';
                } else {
                    strfor += data.replace("<br>", "");
                    strfor += '<br>';
                }
            }
        });
        return strfor;
    }
    // ------------------------------------------------------------------
    // 列表視圖欄位排序（Table Column Sort）
    // ------------------------------------------------------------------

    var arr_select = []; // 目前已點擊過的排序欄位 ID（用於切換升/降冪）
    function selectTable(id) {
        $('.w-tabfix').removeClass('pro_asc active');
        $('.w-tabfix').removeClass('pro_desc active');
        var index = arr_select.indexOf(id);
        if (index == -1) {
            $('#sortdata'+id).addClass('pro_asc active');
            arr_select.push(id);
            orderTable(id, 1);
        } else {
            orderTable(id, 2);
            arr_select.splice(index, 1);
            $('#sortdata'+id).addClass('pro_desc active');
        }
    }
    /**
     * 依欄位 ID 與方向對 productFilter 排序並重新渲染
     * @param {Number} id   欄位代號（1=型號, 2=Output Power, 3=Output Voltage, 4=Input Voltage, 5=Output Power text, 6=尺寸）
     * @param {Number} type 排序方向（1=升冪, 2=降冪）
     */
    function orderTable(id, type) {
        var arr_val = productFilter;
        var arr_result = [];
        if (type == 1) {
            if (id == 1) {
            arr_result = sortModelName(arr_val);
            } else if (id == 2) {
                arr_result = sortOutputLH(arr_val, 4);
            } else if (id == 3) {
                arr_result = sortOutputLH(arr_val, 3);
            } else if (id == 4) {
                arr_result = sortOutputLH(arr_val, 8);
            } else if (id == 5) {
                arr_result = sortInputLH(arr_val, 31);
            } else if (id == 6) {
                arr_result = dimensionLH(arr_val);
            }
        } else {
            if (id == 1) {
            arr_result = sortModelNameZA(arr_val);
            } else if (id == 2) {
                arr_result = sortOutputHL(arr_val, 4);
            } else if (id == 3) {
                arr_result = sortOutputHL(arr_val, 3);
            } else if (id == 4) {
                arr_result = sortOutputHL(arr_val, 8);
            } else if (id == 5) {
                arr_result = sortInputHL(arr_val, 31);
            } else if (id == 6) {
                arr_result = dimensionHL(arr_val);
            }
        }

        var current_list =  $('#current_list_item').val();
        if (current_list == 0) {
            onclickListView(arr_result, type , id);
        } else {
            onclickGridView(arr_result);
        }
        $(".moreBox").slice(0, 8).show();
        $(".moreBox_mobile").slice(0, 8).show();
        $(".row_table").slice(0, 8).show();
        $('.countproduct').text(arr_result.length);
    }

    /**
     * 格式化單一數值，null 時回傳 '-'
     * @param {*}      value 數值
     * @param {String} unit  單位字串
     * @returns {String}
     */
    function df(value, unit) {
        var data = '-';
        if (value != null) {
          data = value+unit;
        }
        return data;
    }
    /**
     * 將狀態 ID 轉換為顯示文字
     * @param {Number} id 狀態 ID（2=NEW, 3=NRND, 4=EOL）
     * @returns {String} 狀態名稱，未知 ID 回傳空字串
     */
    function statuspro(id) {
        var name = '';
         if (id == 2) {
            name = 'NEW';
         } else if (id == 3) {
            name = 'NRND';
         } else if (id == 4) {
            name = 'EOL';
         }
         return name;
    }
    /**
     * 將狀態 ID 轉換為色碼
     * @param {Number} id 狀態 ID（2=NEW #76B900綠, 3=NRND #337ab7藍, 4=EOL #f0ad4e橘）
     * @returns {String} Hex 色碼，未知 ID 回傳空字串
     */
    function set_sta_color(id) {
        var color = '';
        if (id == 2) {
            color = '#76B900';
         } else if (id == 3) {
            color = '#337ab7';
         } else if (id == 4) {
            color = '#f0ad4e';
         }
         return color;
    }
    /**
     * 若圖片路徑為 truthy 則回傳原值，否則回傳空字串
     * @param {*} data
     * @returns {String}
     */
    function checkNullImg(data) {
        if (data) {
          return data;
        } else {
          return '';
        }
    }
    /**
     * 從 contentFilter 陣列中取出主要規格欄位並依 type_id 排序
     * type_id 對應：3=Output Voltage, 4=Output Current, 8=Input Voltage, 31=Output Power
     * @param {Array} arr contentFilter 陣列
     * @returns {Array} 過濾並排序後的規格陣列
     */
    function onlycontent(arr) {
        var arrcontent = [];
        // 主要規格 type_id：Output Voltage(3), Output Current(4), Input Voltage(8), Output Power(31)
        var arr_id = [4, 3, 8, 31];
        $.each(arr, function(index, data) {
            $.each(arr_id, function(index2, data2) {
              if (data2 == data['type_id'] ) {
                arrcontent.push(data);
              }
            });
        });
        return arrcontent.sort(function(a, b) {
            return a.type_id > b.type_id ? 1 : -1;
        });
    }


    // ==================================================================
    // 篩選 UI 建構（Filter UI Construction）
    // 注意：filtercontent（桌面）與 filtercontentMobile（手機）邏輯相近，
    //       未來可合併為帶 isMobile 參數的單一函式
    // ==================================================================

    function filtercontent() {
        var property_load = [];
        property_load = pro_perti;
        var doc_safety = documents_cate;
        var status = [ {id:2, name:'New'}, {id:3, name:'NRND'}, {id:4, name:'EOL'}];
        var certificates = [
            {id:1, name:'{{$staticContent['Industrial_filter']}}'},
            {id:2, name:'{{$staticContent['Medical_filter']}}'},
            {id:3, name:'{{$staticContent['Lighting_Signage_filter']}}'},
            {id:4, name:'{{$staticContent['wireless_charging']}}'}
        ];
        var data_1 = [];
        var data_text = [];
        var html3 = '';
        $.each(filter_pro, function(index_con, fil_con) {
            html3 += '<div class="fliter_head'+fil_con['field_id']+'"><div class="card-header-filter collapsed" data-toggle="collapse"';
            html3 += 'href="#collapse-fliter_'+fil_con['field_id']+'">';
            html3 += '<a class="card-title text-sixteen-dark">';
            html3 += fil_con['title'];
            html3 += '</a>';
            html3 += '</div>';
            // 預設展開 product_type, series01, mode_series 的 accordion
            html3 += '<div id="collapse-fliter_'+fil_con['field_id']+'" class="card-body-filter collapse '+(fil_con['field_id']== 'product_type' || fil_con['field_id']== 'series01' || fil_con['field_id']== 'mode_series'?'show':'') +'" >';
            html3 += '<form id="form-'+fil_con['field_id']+'" class="'+fil_con['field_id']+'">';
            html3 += '<div class="scrollbar dataserchfilter'+fil_con['field_id']+'" id="style-1">';

            // 新增 product type 的 filter 區塊
            if (fil_con['field_id'] == 'product_type') {
                $.each(categoriesHasMainPro, function(index_category, category) {
                    html3 += '<div onchange="product_type_filter('+"'"+fil_con['field_id']+"'"+','+category['cate_id']+');" class="box-input-checkbox">';
                    html3 += '<input class="inp-cbx" id="cx-'+fil_con['field_id']+category['cate_id']+'" type="checkbox" style="display: none;" >';
                    html3 += '<label class="cbx" for="cx-'+fil_con['field_id']+category['cate_id']+'"><span>';
                    html3 += '<svg width="12px" height="10px" viewbox="0 0 12 10">';
                    html3 += '<polyline points="1.5 6 4.5 9 10.5 1"></polyline>';
                    html3 += '</svg></span><span>'+category['name']+'</span></label>';
                    html3 += '</div>' ;
                });
            }
            if (fil_con['field_id'] == 'mode_series') {
                // Hardcoded Mode Series options as requested
                var hardcodedModeSeries = [
                    {id: 1, title: 'CC + CV Mode'},
                    {id: 2, title: 'CC Mode'},
                    {id: 3, title: 'CV Mode'}
                ];
                $.each(hardcodedModeSeries, function(index_mode, mode) {
                    html3 += '<div onchange="mode_series_filter('+"'"+fil_con['field_id']+"'"+','+mode['id']+');" class="box-input-checkbox">';
                    html3 += '<input  class="inp-cbx" id="cx-'+fil_con['field_id']+mode['id']+'" type="checkbox" style="display: none;" >';
                    html3 += '<label class="cbx" for="cx-'+fil_con['field_id']+mode['id']+'"><span>';
                    html3 += '<svg width="12px" height="10px" viewbox="0 0 12 10">';
                    html3 += '<polyline points="1.5 6 4.5 9 10.5 1"></polyline>';
                    html3 += '</svg></span><span>'+mode['title']+'</span></label>';
                    html3 += '</div>' ;
                });
            }
            if (fil_con['field_id'] == 'series01') {
                // 根據目前選中的主分類篩選 series
                var filteredSeries = series;
                if (main_cate_id && main_cate_id !== 0) {
                    filteredSeries = series.filter(function(serie) {
                        // 首先根據主分類篩選
                        if (serie.main_cate != main_cate_id) {
                            return false;
                        }

                        // LED Driver (main_cate_id = 3) 使用 mode_series 篩選
                        if (main_cate_id == 3) {
                            if (mode_series_arr.length > 0) {
                                return mode_series_arr.indexOf(serie.mode_series) !== -1;
                            }
                        } else {
                            // 其他分類使用 product type 篩選
                            if (pro_type_arr.length > 0) {
                                return pro_type_arr.indexOf(serie.pro_categories_id) !== -1;
                            }
                        }

                        return true;
                    });
                }

                // 根據 se_id 去重
                var uniqueSeries = [];
                var seenIds = [];
                filteredSeries.forEach(function(serie) {
                    if (seenIds.indexOf(serie.se_id) === -1) {
                        seenIds.push(serie.se_id);
                        uniqueSeries.push(serie);
                    }
                });
                filteredSeries = uniqueSeries;


                $.each(filteredSeries, function(index_serie, serie) {
                    html3 += '<div onchange="series_filter('+"'"+fil_con['field_id']+"'"+','+serie['se_id']+');" class="box-input-checkbox">';
                    html3 += '<input  class="inp-cbx" id="cx-'+fil_con['field_id']+serie['se_id']+'" type="checkbox" style="display: none;" >';
                    html3 += '<label class="cbx" for="cx-'+fil_con['field_id']+serie['se_id']+'"><span>';
                    html3 += '<svg width="12px" height="10px" viewbox="0 0 12 10">';
                    html3 += '<polyline points="1.5 6 4.5 9 10.5 1"></polyline>';
                    html3 += '</svg></span><span>'+serie['title']+'</span></label>';
                    html3 += '</div>' ;
                });
            }
            if (fil_con['field_id'] == 'status02') {
                $.each(status, function(index_status, sta) {
                    html3 += '<div onchange="filterstatus('+"'"+fil_con['field_id']+"'"+','+sta['id']+');" class="box-input-checkbox">';
                    html3 += '<input  class="inp-cbx" id="cx-'+fil_con['field_id']+index_status+'" type="checkbox" style="display: none;" />';
                    html3 += '<label class="cbx" for="cx-'+fil_con['field_id']+index_status+'"><span>';
                    html3 += '<svg width="12px" height="10px" viewbox="0 0 12 10">';
                    html3 += '<polyline points="1.5 6 4.5 9 10.5 1"></polyline>';
                    html3 += '</svg></span><span class="">'+sta['name']+'</span></label>';
                    html3 += '</div>' ;
                });
            }
            if (fil_con['field_id'] == 'safety03') {
                $.each(doc_safety, function(id_doc, safety) {
                    html3 += '<div onchange="filtersafety('+"'"+fil_con['field_id']+"'"+','+safety['id']+');" class="box-input-checkbox">';
                    html3 += '<input  class="inp-cbx" id="cx-'+fil_con['field_id']+id_doc+'" type="checkbox" style="display: none;" />';
                    html3 += '<label class="cbx" for="cx-'+fil_con['field_id']+id_doc+'"><span>';
                    html3 += '<svg width="12px" height="10px" viewbox="0 0 12 10">';
                    html3 += '<polyline points="1.5 6 4.5 9 10.5 1"></polyline>';
                    html3 += '</svg></span><span class="">'+safety['title']+'</span></label>';
                    html3 += '</div>' ;
                });
            }
            if (fil_con['field_id'] == 'certifi04') {
                $.each(certificates, function(index_cer, certi) {
                    html3 += '<div onchange="filterCerti('+"'"+fil_con['field_id']+"'"+','+certi['id']+');" class="box-input-checkbox">';
                    html3 += '<input  class="inp-cbx" id="cx-'+fil_con['field_id']+index_cer+'" type="checkbox" style="display: none;" />';
                    html3 += '<label class="cbx" for="cx-'+fil_con['field_id']+index_cer+'"><span>';
                    html3 += '<svg width="12px" height="10px" viewbox="0 0 12 10">';
                    html3 += '<polyline points="1.5 6 4.5 9 10.5 1"></polyline>';
                    html3 += '</svg></span><span>'+certi['name']+'</span></label>';
                    html3 += '</div>' ;
                });
            }
            if (fil_con['field_id'] != 'series01' && fil_con['field_id'] != 'status02' && fil_con['field_id'] != 'certifi04' && fil_con['field_id'] != 'safety03'  ) {
                var property =  property_load.sort(
                    function(a, b) {
                        if (a.data_1 < b.data_1) {
                            if (a.data_2 &&  b.data_2 &&  a.data_2 < b.data_2 ) {
                                return -1;
                            }
                            return -1;
                        } else {
                            return 1;
                        }
                    });

                $.each(property, function(index_per, ppt) {
                    if (fil_con['field_id'] == ppt['type_id']) {
                        var object  = {};
                        var text = null;
                        if (ppt['value_text'] != null && typeof ppt['value_text']  != 'undefined') {
                            text = ppt['value_text'].replace(/\s/g, '').toLowerCase().replace(/^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g, '').trim();
                        }

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
                        ];

                        object = {
                            'id':index_per,
                            'type':fil_con['field_id'],
                            'data':checkNull(dataarr, ppt['unit_name'], ppt['status_input']),
                            'status_input':ppt['status_input'],
                            'text':text,
                        }
                        if (ppt['type_value'] == 'number' && ppt['data_1'] != null) {
                            objectFiled = {
                                'field_id':fil_con['field_id'],
                                'type_box':ppt['status_input'],
                            }
                            var index_fi = fildnumber.findIndex(
                                function(x) {
                                    return  x.field_id === fil_con['field_id'];
                                }
                            )
                            if (index_fi == -1) {
                                fildnumber.push(objectFiled);
                            }
                            if (containsObject(object, data_1)) {
                                data_1.push(object);
                                html3 += '<div onchange="fillerNumber('+"'"+fil_con['field_id']+"'"+','+ppt['data_1']+','+ppt['data_2']+','+ppt['data_3'] +','+ppt['data_4'] +','+ppt['data_5']+');" class="box-input-checkbox">';
                                html3 += '<input  class="inp-cbx" id="cx-normalnum'+fil_con['field_id']+index_per+'" type="checkbox" style="display: none;" />';
                                html3 += '<label class="cbx" for="cx-normalnum'+fil_con['field_id']+index_per+'"><span>';
                                html3 += '<svg width="12px" height="10px" viewbox="0 0 12 10">';
                                html3 += '<polyline points="1.5 6 4.5 9 10.5 1"></polyline>';
                                html3 += '</svg></span ><span class="'+ppt['product_id']+'">'+ checkNull(dataarr, ppt['unit_name'], ppt['status_input']) +'</span></label>';
                                html3 += '</div>' ;
                            }
                        } else if (ppt['type_value'] == 'text' && ppt['value_text'] != null && ppt['value_text'] != '' && typeof ppt['value_text']  != 'undefined') {
                            if (containsObjectText(object, data_text)) {
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
            html3 += '<button onclick="resetformById('+"'"+fil_con['field_id']+"'"+');" class="btn-reset" type="button">{{$staticContent['Clear']}}</button>';
            html3 +=  '</form>';
            if (fil_con['field_id'] != 'series01' && fil_con['field_id'] != 'status02' && fil_con['field_id'] != 'certifi04' && fil_con['field_id'] != 'safety03' && fil_con['field_id'] != 'mode_series' && fil_con['type'] == 'number'  ) {
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
        popcheckProductType();
        popcheckSerries();
        popcheckModeSeries();

    }

    /**
     * 渲染手機版篩選器內容
     * Render mobile filter content
     */
    function  filtercontentMobile() {
       var property_load = [];
       var doc_safety = [{id:2, name:'ABS'}, {id:3, name:'ATEX'}, {id:4, name:'BSMI'}];
       property_load = pro_perti;
        var status = [ {id:2, name:'NEW'}, {id:3, name:'NRND'}, {id:4, name:'EOL'}];
        var certificates = [ {id:1, name:'{{$staticContent['Industrial_filter']}}'}, {id:2, name:'{{$staticContent['Medical_filter']}}'}, {id:3, name:'{{$staticContent['Lighting_Signage_filter']}}'} , {id:4, name:'{{$staticContent['wireless_charging']}}'} ];
        var data_1 = [];
        var data_text = [];
        var html3 = '';
        $.each(filter_pro, function(index_con, fil_con) {
            html3 += '<div class="fliter_head_mobile'+fil_con['field_id']+'"><div class="card-header-filter collapsed fliter_head_mobile'+fil_con['field_id']+'" data-toggle="collapse"';
            html3 += 'href="#collapse-fliter_'+fil_con['field_id']+'_mobile">';
            html3 += '<a class="card-title text-sixteen-dark">';
            html3 += fil_con['title'];
            html3 += '</a>';
            html3 += '</div>';
            // 預設展開 product_type, series01, mode_series 的 accordion
            html3 += '<div id="collapse-fliter_'+fil_con['field_id']+'_mobile" class="card-body-filter collapse '+(fil_con['field_id']== 'product_type' || fil_con['field_id']== 'series01' || fil_con['field_id']== 'mode_series'?'show':'') +'">';
            html3 += '<form id="form-mobile'+fil_con['field_id']+'" class="'+fil_con['field_id']+'_mobile">';
            html3 += '<div class="scrollbar dataserchfiltermobile'+fil_con['field_id']+'" id="style-1">';

            // 產品類型 (Product Type)
            if (fil_con['field_id'] == 'product_type') {
                $.each(categoriesHasMainPro, function(index_category, category) {
                    html3 += '<div class="box-input-checkbox">';
                    html3 += '<input onchange="product_type_filter('+"'"+fil_con['field_id']+"'"+','+category['cate_id']+');" class="inp-cbx" id="cx-'+fil_con['field_id']+category['cate_id']+'_mobile" type="checkbox" style="display: none;" >';
                    html3 += '<label class="cbx" for="cx-'+fil_con['field_id']+category['cate_id']+'_mobile"><span>';
                    html3 += '<svg width="12px" height="10px" viewbox="0 0 12 10">';
                    html3 += '<polyline points="1.5 6 4.5 9 10.5 1"></polyline>';
                    html3 += '</svg></span><span>'+category['name']+'</span></label>';
                    html3 += '</div>' ;
                  });
            }

            // Mode Series
            if (fil_con['field_id'] == 'mode_series') {
                // Hardcoded Mode Series options as requested
                var hardcodedModeSeries = [
                    {id: 1, title: 'CC + CV Mode'},
                    {id: 2, title: 'CC Mode'},
                    {id: 3, title: 'CV Mode'}
                ];
                $.each(hardcodedModeSeries, function(index_mode, mode) {
                    html3 += '<div class="box-input-checkbox">';
                    html3 += '<input onchange="mode_series_filter('+"'"+fil_con['field_id']+"'"+','+mode['id']+');" class="inp-cbx" id="cx-'+fil_con['field_id']+mode['id']+'_mobile" type="checkbox" style="display: none;" >';
                    html3 += '<label class="cbx" for="cx-'+fil_con['field_id']+mode['id']+'_mobile"><span>';
                    html3 += '<svg width="12px" height="10px" viewbox="0 0 12 10">';
                    html3 += '<polyline points="1.5 6 4.5 9 10.5 1"></polyline>';
                    html3 += '</svg></span><span>'+mode['title']+'</span></label>';
                    html3 += '</div>' ;
                  });
            }

            // 系列 (Series)
            if (fil_con['field_id'] == 'series01') {
                // 根據目前選中的主分類篩選 series (手機版)
                var filteredSeries = series;
                if (main_cate_id && main_cate_id !== 0) {
                    filteredSeries = series.filter(function(serie) {
                        // 首先根據主分類篩選
                        if (serie.main_cate != main_cate_id) {
                            return false;
                        }

                        // LED Driver (main_cate_id = 3) 使用 mode_series 篩選
                        if (main_cate_id == 3) {
                            if (mode_series_arr.length > 0) {
                                return mode_series_arr.indexOf(serie.mode_series) !== -1;
                            }
                        } else {
                            // 其他分類使用 product type 篩選
                            if (pro_type_arr.length > 0) {
                                return pro_type_arr.indexOf(serie.pro_categories_id) !== -1;
                            }
                        }

                        return true;
                    });
                }

                // 根據 se_id 去重
                var uniqueSeries = [];
                var seenIds = [];
                filteredSeries.forEach(function(serie) {
                    if (seenIds.indexOf(serie.se_id) === -1) {
                        seenIds.push(serie.se_id);
                        uniqueSeries.push(serie);
                    }
                });
                filteredSeries = uniqueSeries;

                $.each(filteredSeries, function(index_serie, serie) {
                    html3 += '<div class="box-input-checkbox">';
                    html3 += '<input onchange="series_filter('+"'"+fil_con['field_id']+"'"+','+serie['se_id']+');" class="inp-cbx" id="cx-'+fil_con['field_id']+serie['se_id']+'_mobile" type="checkbox" style="display: none;" >';
                    html3 += '<label class="cbx" for="cx-'+fil_con['field_id']+serie['se_id']+'_mobile"><span>';
                    html3 += '<svg width="12px" height="10px" viewbox="0 0 12 10">';
                    html3 += '<polyline points="1.5 6 4.5 9 10.5 1"></polyline>';
                    html3 += '</svg></span><span>'+serie['title']+'</span></label>';
                    html3 += '</div>' ;
                  });
             }
             // 狀態 (Status: NEW, NRND, EOL)
             if (fil_con['field_id'] == 'status02') {
                $.each(status, function(index_status, sta) {
                    html3 += '<div class="box-input-checkbox">';
                    html3 += '<input onchange="filterstatus('+"'"+fil_con['field_id']+"'"+','+sta['id']+');" class="inp-cbx" id="cx-'+fil_con['field_id']+index_status+'_mobile" type="checkbox" style="display: none;" />';
                    html3 += '<label class="cbx" for="cx-'+fil_con['field_id']+index_status+'_mobile"><span>';
                    html3 += '<svg width="12px" height="10px" viewbox="0 0 12 10">';
                    html3 += '<polyline points="1.5 6 4.5 9 10.5 1"></polyline>';
                    html3 += '</svg></span><span class="">'+sta['name']+'</span></label>';
                    html3 += '</div>' ;
                  });
             }
             // 安規 (Safety: ABS, ATEX, BSMI)
             if (fil_con['field_id'] == 'safety03') {
                $.each(doc_safety, function(id_doc, safety) {
                    html3 += '<div class="box-input-checkbox">';
                    html3 += '<input onchange="filtersafety('+"'"+fil_con['field_id']+"'"+','+safety['id']+');" class="inp-cbx" id="cx-'+fil_con['field_id']+id_doc+'_mobile" type="checkbox" style="display: none;" />';
                    html3 += '<label class="cbx" for="cx-'+fil_con['field_id']+id_doc+'_mobile"><span>';
                    html3 += '<svg width="12px" height="10px" viewbox="0 0 12 10">';
                    html3 += '<polyline points="1.5 6 4.5 9 10.5 1"></polyline>';
                    html3 += '</svg></span><span class="">'+safety['name']+'</span></label>';
                    html3 += '</div>' ;
                });
             }

             // 應用領域/證書 (Certificates/Applications)
             if (fil_con['field_id'] == 'certifi04') {
                $.each(certificates, function(index_cer, certi) {
                    html3 += '<div class="box-input-checkbox">';
                    html3 += '<input onchange="filterCerti('+"'"+fil_con['field_id']+"'"+','+certi['id']+');" class="inp-cbx" id="cx-'+fil_con['field_id']+index_cer+'_mobile" type="checkbox" style="display: none;" />';
                    html3 += '<label class="cbx" for="cx-'+fil_con['field_id']+index_cer+'_mobile"><span>';
                    html3 += '<svg width="12px" height="10px" viewbox="0 0 12 10">';
                    html3 += '<polyline points="1.5 6 4.5 9 10.5 1"></polyline>';
                    html3 += '</svg></span><span>'+certi['name']+'</span></label>';
                    html3 += '</div>' ;
                  });
             }
            // 其他動態屬性 (Other dynamic properties)
            if (fil_con['field_id'] != 'series01' && fil_con['field_id'] != 'status02' && fil_con['field_id'] != 'certifi04' && fil_con['field_id'] != 'safety03'  ) {
                var property =  property_load.sort(function(a, b) {
                    if (a.data_1 < b.data_1) {
                        if (a.data_2 &&  b.data_2 &&  a.data_2 < b.data_2 ) {
                            return -1;
                        }
                        return -1;
                    } else {
                        return 1;
                    }
                });

                $.each(property, function(index_per, ppt) {
                    if (fil_con['field_id'] == ppt['type_id']) {
                        var object  = {};
                        var text = null;
                        if (ppt['value_text'] != null && typeof ppt['value_text']  != 'undefined') {
                            text = ppt['value_text'].replace(/\s/g, '').toLowerCase().replace(/^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g, '').trim();
                        }

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
                        ];

                        object = {
                            'id':index_per,
                            'type':fil_con['field_id'],
                            'data':checkNull(dataarr, ppt['unit_name'], ppt['status_input']),
                            'status_input':ppt['status_input'],
                            'text':text,
                        }

                        if (ppt['type_value'] == 'number' && ppt['data_1'] != null) {
                            objectFiled = {
                                'field_id':fil_con['field_id'],
                                'type_box':ppt['status_input'],
                            }
                            var  index_fi = fildnumberMobile.findIndex(function(x) {
                                return x.field_id === fil_con['field_id'];
                            })
                            if (index_fi == -1) {
                                fildnumberMobile.push(objectFiled);
                            }
                            if (containsObject(object, data_1)) {
                                data_1.push(object);
                                html3 += '<div class="box-input-checkbox ">';
                                html3 += '<input onchange="fillerNumber('+"'"+fil_con['field_id']+"'"+','
                                +ppt['data_1']+','+ppt['data_2']+','+ppt['data_3'] +','+ppt['data_4'] +','+ppt['data_5']+','+ppt['data_6']+','+ppt['data_7']
                                +','+ppt['data_8']+','+ppt['data_9']+','+ppt['data_10']+','+ppt['data_11']+','+ppt['data_12']+
                                ');" class="inp-cbx" id="cx-normalnumber'+fil_con['field_id']+index_per+'_mobile" type="checkbox" style="display: none;" />';
                                html3 += '<label class="cbx" for="cx-normalnumber'+fil_con['field_id']+index_per+'_mobile"><span>';
                                html3 += '<svg width="12px" height="10px" viewbox="0 0 12 10">';
                                html3 += '<polyline points="1.5 6 4.5 9 10.5 1"></polyline>';
                                html3 += '</svg></span ><span class="'+ppt['product_id']+'">'+ checkNull(dataarr, ppt['unit_name'], ppt['status_input']) +'</span></label>';
                                html3 += '</div>' ;
                            }
                        } else if (ppt['type_value'] == 'text' && ppt['value_text'] != null && ppt['value_text'] != '' && typeof ppt['value_text']  != 'undefined') {
                            if (containsObjectText(object, data_text)) {
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
            if (fil_con['field_id'] != 'series01' && fil_con['field_id'] != 'status02' && fil_con['field_id'] != 'certifi04' && fil_con['field_id'] != 'safety03' && fil_con['field_id'] != 'mode_series' && fil_con['type'] == 'number'  ) {
            html3 +=  '<div class="slidebar-value-box mb-4 mt-4">';
            html3 +=  '<div  id="slidebar-value-box'+fil_con['field_id']+'"class="slider noUi-target noUi-ltr noUi-horizontal slider'+fil_con['field_id']+'"  ></div>';
            html3 +=  ' <div  class="value-form-bar-box">';
            html3 +=  '<span class="value-form-bar value-form-bar-min" id="slider-limit-value-min'+fil_con['field_id']+'"></span>';
            html3 +=  ' <span class="value-form-bar value-form-bar-max"id="slider-limit-value-max'+fil_con['field_id']+'"></span>';
            html3 +=  '</div>';
            html3 +=  '</div>';
            }
            html3 +=  '</div></div>';
        });
        $('#sort-filter-content_mobile').html(html3);
        createSlider();
        popcheckProductType();
        popcheckModeSeries();
    }

    /**
     * 初始化系列篩選勾選狀態
     * 如果有傳入 series_id，則勾選該系列並展開側邊欄
     * 否則展開側邊欄但不預設勾選任何系列
     */
    function popcheckSerries() {
        if (series_id) {
            $("#cx-series01"+series_id).prop("checked" , true);
            $("#cx-series01"+series_id+"_mobile").prop("checked" , true);

            // 展開 Series Accordion
            $("#collapse-fliter_series01").addClass("show");
            $("#collapse-fliter_series01_mobile").addClass("show");

            onclickshow(2);
            ser_arr.push({{$se_id}});
        }
    }

    /**
     * 初始化 Product Type 篩選
     * 如果有 cateid (URL 參數)，則自動勾選並展開
     * 如果沒有參數，且 series 也沒展開，則預設展開側邊欄
     */
    function popcheckProductType() {
        if (cateid && main_cate_id != 3) {
            $("#cx-product_type"+cateid).prop("checked" , true);
            $("#cx-product_type"+cateid+"_mobile").prop("checked" , true);

            onclickshow(2);

            if (pro_type_arr.indexOf(cateid) == -1) {
                pro_type_arr.push(cateid);
            }
        }
    }

    /**
     * 初始化 Mode Series 篩選
     * 如果有 cateid (URL 參數) 且 main_cate_id 為 3，則自動勾選並展開
     */
    function popcheckModeSeries() {
        if (cateid && main_cate_id == 3) {
            $("#cx-mode_series"+cateid).prop("checked" , true);
            $("#cx-mode_series"+cateid+"_mobile").prop("checked" , true);

            // Expand the accordion
            $("#collapse-fliter_mode_series").addClass("show");
            $("#collapse-fliter_mode_series_mobile").addClass("show");

            onclickshow(2);

            if (mode_series_arr.indexOf(cateid) == -1) {
                mode_series_arr.push(cateid);
            }
        }
    }

    // ==================================================================
    // 篩選狀態管理（Filter State Management）
    // ==================================================================

    /**
     * 檢查物件是否已存在於篩選陣列中（依 data / type / status_input 比對）
     * @returns {Boolean} true = 不存在（可新增），false = 已存在
     */
    function containsObject(obj, list) {
        var  index = list.findIndex(function(x) {
            return x.data === obj['data'] && x.type === obj['type'] && x.status_input === obj['status_input'];
        })

        if (index == -1) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 檢查文字篩選物件是否已存在於篩選陣列中（依 text / type 比對）
     * @returns {Boolean} true = 不存在（可新增），false = 已存在
     */
    function containsObjectText(obj, list) {
        var  index = list.findIndex(function(x) {
           return x.text === obj['text'] && x.type === obj['type'];
        })

        if (index == -1) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 處理系列篩選的勾選/取消勾選
     * @param {String} type 類型
     * @param {Number} value 系列ID
     */
    function product_type_filter(type, value)
    {
        // 強制轉為數字，避免字串與數字比對問題
        var val = parseInt(value);
        var index_se = -1;


        // 檢查是否存在（用寬鬆比較）
        var exists = false;
        $.each(pro_type_arr, function(i, v) {
            if (v == val) {
                exists = true;
                return false;
            }
        });

        if (exists) {
            // 如果存在，移除所有相同的值（數字和字串版本）
            pro_type_arr = pro_type_arr.filter(function(v) {
                return v != val && v != value;
            });
        } else {
            // 如果不存在，添加（只添加數字版本）
            pro_type_arr.push(val);
        }


        fillerData();

        // 延遲更新 series 選項，避免影響 product type 勾選
        setTimeout(function() {
            updateSeriesOptions();
        }, 10);
    }

    /**
     * 更新 series 選項（桌面版和手機版）
     */
    function updateSeriesOptions()
    {
        // 桌面版 - 更新 series 選項
        var filteredSeries = series;
        if (main_cate_id && main_cate_id !== 0) {
            filteredSeries = series.filter(function(serie) {
                // 首先根據主分類篩選
                if (serie.main_cate != main_cate_id) {
                    return false;
                }

                // LED Driver (main_cate_id = 3) 使用 mode_series 篩選
                if (main_cate_id == 3) {
                    if (mode_series_arr.length > 0) {
                        return mode_series_arr.indexOf(serie.mode_series) !== -1;
                    }
                } else {
                    // 其他分類使用 product type 篩選
                    if (pro_type_arr.length > 0) {
                        return pro_type_arr.indexOf(serie.pro_categories_id) !== -1;
                    }
                }

                return true;
            });
        }

        // 根據 se_id 去重
        var uniqueSeries = [];
        var seenIds = [];
        filteredSeries.forEach(function(serie) {
            if (seenIds.indexOf(serie.se_id) === -1) {
                seenIds.push(serie.se_id);
                uniqueSeries.push(serie);
            }
        });

        // 更新桌面版 HTML
        var html = '';
        $.each(uniqueSeries, function(index_serie, serie) {
            var isChecked = ser_arr.indexOf(serie.se_id) !== -1 ? 'checked' : '';
            html += '<div onchange="series_filter(\'series01\','+serie['se_id']+');" class="box-input-checkbox">';
            html += '<input class="inp-cbx" id="cx-series01'+serie['se_id']+'" type="checkbox" style="display: none;" '+isChecked+'>';
            html += '<label class="cbx" for="cx-series01'+serie['se_id']+'"><span>';
            html += '<svg width="12px" height="10px" viewbox="0 0 12 10">';
            html += '<polyline points="1.5 6 4.5 9 10.5 1"></polyline>';
            html += '</svg></span><span>'+serie['title']+'</span></label>';
            html += '</div>';
        });

        $('.dataserchfilterseries01').html(html);

        // 更新手機版 HTML
        var htmlMobile = '';
        $.each(uniqueSeries, function(index_serie, serie) {
            var isChecked = ser_arr.indexOf(serie.se_id) !== -1 ? 'checked' : '';
            htmlMobile += '<div class="box-input-checkbox">';
            htmlMobile += '<input onchange="series_filter(\'series01\','+serie['se_id']+');" class="inp-cbx" id="cx-series01'+serie['se_id']+'_mobile" type="checkbox" style="display: none;" '+isChecked+'>';
            htmlMobile += '<label class="cbx" for="cx-series01'+serie['se_id']+'_mobile"><span>';
            htmlMobile += '<svg width="12px" height="10px" viewbox="0 0 12 10">';
            htmlMobile += '<polyline points="1.5 6 4.5 9 10.5 1"></polyline>';
            htmlMobile += '</svg></span><span>'+serie['title']+'</span></label>';
            htmlMobile += '</div>';
        });
        $('.dataserchfiltermobileseries01').html(htmlMobile);
    }

    function series_filter(type, value) {
        var val = parseInt(value);
        var index_se = -1;

        $.each(ser_arr, function(i, v) {
            if (v == val) {
                index_se = i;
                return false;
            }
        });

        if (index_se == -1) {
            ser_arr.push(val);
        } else {
            ser_arr.splice(index_se, 1);
        }

        fillerData();
    }

    function mode_series_filter(type, value) {
        var val = parseInt(value);
        var index_se = -1;

        $.each(mode_series_arr, function(i, v) {
            if (v == val) {
                index_se = i;
                return false;
            }
        });

        if (index_se == -1) {
            mode_series_arr.push(val);
        } else {
            mode_series_arr.splice(index_se, 1);
        }
        fillerData();

        // 延遲更新 series 選項，避免影響 mode_series 勾選
        setTimeout(function() {
            updateSeriesOptions();
        }, 10);
    }

    // ------------------------------------------------------------------
    // 基礎篩選：series / product type / mode series
    // ------------------------------------------------------------------

    /**
     * 根據 ser_arr / pro_type_arr / mode_series_arr 重建 productFilter
     * 三個條件為 AND 關係；各自為空時視為「選全部」
     */
    function filterBaseData()
    {
        var eachpro = [];
        var matchedCount = 0;
        $.each(products, function(index, value) {
            var productObj = {};
            var productObj2 = {};
            var is_match = false;
            var is_match_type = false;
            var is_match_mode = false;

            // 確認 商品的 series 是否再篩選條件中
            if (ser_arr.length > 0) {
                $.each(ser_arr, function(index_ser, value_ser) {
                    if (value_ser == value['series_id']) {
                        is_match = true;
                    }
                });
            } else {
                // 沒有任何勾選，預設選全部
                is_match = true;
            }

            // 確認 商品的 product_type（sub_category） 是否再篩選條件中
            if (pro_type_arr.length > 0) {
                $.each(pro_type_arr, function(index_type, value_type) {
                    // 檢查 cate_ids 是否包含該分類
                    if (value['cate_ids']) {
                        $.each(value['cate_ids'], function(i, id) {
                            if (id == value_type) {
                                is_match_type = true;
                            }
                        });
                    }

                    // 檢查 cate_id 是否匹配 (相容舊資料)
                    if (value['cate_id'] == value_type) {
                        is_match_type = true;
                    }
                });
            } else {
                // 沒有任何勾選，預設選全部
                is_match_type = true;
            }

            // 確認 商品的 mode_series 是否再篩選條件中
            if (mode_series_arr.length > 0) {
                $.each(mode_series_arr, function(index_mode, value_mode) {
                    if (value_mode == value['mode_series']) {
                        is_match_mode = true;
                    }
                });
            } else {
                // 沒有任何勾選，預設選全部
                is_match_mode = true;
            }

            if (is_match && is_match_type && is_match_mode) {
                matchedCount++;
                productObj['pro_id'] = value['pro_id'];
                productObj['pro_code'] = value['pro_code'];
                productObj['cate_id'] = value['cate_id'];
                productObj['cate_ids'] = value['cate_ids'];
                productObj['series_id'] = value['series_id'];
                productObj['mode_series'] = value['mode_series'];
                productObj['status_product'] = value['status_product'];
                productObj['certificate'] = value['certificate'];
                productObj['updated_at'] = value['updated_at'];
                productObj['picture'] = value['picture'];
                productObj['dimensionL'] = value['dimensionL'];
                productObj['dimensionW'] = value['dimensionW'];
                productObj['dimensionD'] = value['dimensionD'];
                productObj['short_features'] = value['short_features'];
                productObj['alt_img'] = value['alt_img'];
                productObj['content'] = [];
                productObj['contentFilter'] = [];
                $.each(product_has_property, function(index2, value2) {
                    if (value['pro_id'] == value2['product_id']) {
                        productObj['content'].push(value2);
                    }
                });
                $.each(pro_perti, function(index3, value3) {
                    if (value['pro_id'] == value3['product_id']) {
                        productObj['contentFilter'].push(value3);
                    }
                });
                productFilter.push(productObj);
            }
        });

    }

    // ------------------------------------------------------------------
    // 狀態 / 安規 / 認證篩選
    // ------------------------------------------------------------------

    var arr_status = []; // 勾選的狀態 ID 清單（2=New, 3=NRND, 4=EOL）
    /**
     * 切換狀態篩選（New / NRND / EOL）
     * @param {String} type  (未使用)
     * @param {Number} value 狀態 ID
     */
    function filterstatus(type, value) {
        if (arr_status.indexOf(value) == -1) {
            arr_status.push(value);
        } else {
            var index = arr_status.indexOf(value);
            if (index > -1) {
                arr_status.splice(index, 1);
            }
        }
        // filerallStatus();
        fillerData();
    }

    var arr_safety = []; // 勾選的安規文件分類 ID 清單（documents_cate）
    /**
     * 切換安規文件篩選（Safety / Regulatory）
     * @param {String} type  (未使用)
     * @param {Number} value documents_cate ID
     */
    function filtersafety(type, value) {
        if (arr_safety.indexOf(value) == -1) {
            arr_safety.push(value);
        } else {
            var index = arr_safety.indexOf(value);
            if (index > -1) {
                arr_safety.splice(index, 1);
            }
        }
        fillerData();
        // filerallDoc();
    }
    /**
     * 以 AJAX 查詢安規文件篩選結果（舊流程，已由 fillerData() 內的 loadfilterCertificate() 取代）
     * @deprecated 目前 filtersafety() 直接呼叫 fillerData()，此函式保留但不再使用
     */
    function filerallDoc() {
        var arr_pro_doc = [];
        var profilter = [];
        var proarr = [];
        var values = [];
        $.ajax({
            url: "{{route('loaddocumentPro')}}",
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

        if (arr_safety.length > 1) {
            // var lookup = values.reduce((a, e) => {
            // a[e.product_id] = ++a[e.product_id] || 0;
            // return a;
            // }, {});
            // profilter =  values.filter(e => lookup[e.product_id]);

            var lookup = values.reduce(function(a, e) {
                    a[e.product_id] = ++a[e.product_id] || 0;
                    return a;
                    }, {});
                    profilter =  values.filter(function(e) {
                        return lookup[e.product_id];
                    });

        } else {
            profilter = values;
        }
        profilter.filter(function(data) {
            var index2  = proarr.indexOf(data.product_id);
            if (index2 == -1) {
                proarr.push(data.product_id);
            }
        });
        productFilter.filter(function(data2) {
            proarr.forEach(function(element2) {
                if (data2.pro_id == element2) {
                    var  index = arr_pro_doc.findIndex(function(x) {
                        return x.pro_id === data2.pro_id;
                    })
                    if (index == -1) {
                        arr_pro_doc.push(data2);
                    }
                }
            });
        });
        if (arr_safety.length == 0) {
            arr_pro_doc = [];
            arr_pro_doc = productFilter;
        }
        listItemFiler(arr_pro_doc);
    }

    /**
     * 依 arr_status 篩選 productFilter（舊流程，已由 fillerData() 內的 filterStatusAll() 取代）
     * @deprecated 目前 filterstatus() 直接呼叫 fillerData()，此函式保留但不再使用
     */
    function filerallStatus() {
        var arr_filter = [];
        productFilter.filter(function(data) {
            arr_status.forEach(function(element) {
                if (data.status_product == element) {
                    var  index = arr_filter.findIndex(function(x) {
                        return x.pro_id === data.pro_id;
                    })
                    if (index == -1) {
                        arr_filter.push(data);
                    }
                }
            });
        });
        if (arr_status.length == 0) {
            arr_filter = [];
            arr_filter = productFilter;
        }
        listItemFiler(arr_filter);
    }
    var arr_cer = []; // 勾選的認證 ID 清單（certi_products certificate_id）
    /**
     * 切換認證篩選（CE / UL / CCC 等）
     * @param {String} type  (未使用)
     * @param {Number} value 認證 ID
     */
    function filterCerti(type, value) {
        if (arr_cer.indexOf(value) == -1) {
            arr_cer.push(value);
        } else {
            var index = arr_cer.indexOf(value);
            if (index > -1) {
                arr_cer.splice(index, 1);
            }
        }
        fillerData();
    }

    /**
     * 依 arr_cer 篩選 productFilter（舊流程，已由 fillerData() 內的 loadSegment() 取代）
     * @deprecated 目前 filterCerti() 直接呼叫 fillerData()，此函式保留但不再使用
     */
    function filerallCer() {
        var arr_filter_ser = [];
        var arr_seg  = [];
        var profilter  = [];

        arr_cer.forEach(function(element) {
            certi_products.filter(function(data) {
                if (data.certificate_id == element) {
                    arr_seg.push(data);
                }
            });
        });
        if (arr_cer.length > 1) {
            // var lookup = arr_seg.reduce((a, e) => {
            // a[e.product_id] = ++a[e.product_id] || 0;
            // return a;
            // }, {});
            // profilter =  arr_seg.filter(e => lookup[e.product_id]);

            var lookup = arr_seg.reduce(function(a, e) {
                a[e.product_id] = ++a[e.product_id] || 0;
                return a;
            }, {});
            profilter =  arr_seg.filter(function(e) {
                return lookup[e.product_id];
            });
        } else {
            profilter =  arr_seg;
        }
        profilter.forEach(function(element) {
            productFilter.filter(function(data) {
                if (data.pro_id == element.product_id) {
                    var  index = arr_filter_ser.findIndex(
                        function(x) {
                            return x.pro_id === data.pro_id;
                        })
                    if (index == -1) {
                       arr_filter_ser.push(data);
                    }
                }
            });
        });

        if (arr_cer.length == 0) {
            arr_filter_ser = [];
            arr_filter_ser = productFilter;
        }
        listItemFiler(arr_filter_ser);
    }

    // ------------------------------------------------------------------
    // 規格數值 / 文字篩選
    // ------------------------------------------------------------------

    /**
     * 切換規格數值篩選（numeric spec checkbox）
     * 12 個 value 參數對應 data_1..data_12，由 blade 模板動態傳入
     * @param {Number} type 規格 type_id
     */
    function fillerNumber(type, value1, value2, value3, value4, value5, value6, value7, value8, value9, value10, value11, value12) {
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

        var index = arr_type_an_val.findIndex(function(x) {
            return parseInt(x.type) === parseInt(type)
               && x.value1 === value1
               && x.value2 === value2
               && x.value3 === value3
               && x.value4 === value4
               && x.value5 === value5
               && x.value6 === value6
               && x.value7 === value7
               && x.value8 === value8
               && x.value9 === value9
               && x.value10 === value10
               && x.value11 === value11
               && x.value12 === value12
               && x.value1 === value1;
            })

        if (index == -1) {
            arr_type_an_val.push(obj);
        } else {
            if (index > -1) {
                arr_type_an_val.splice(index, 1);
            }
        }

        fillerData();
    }

    /**
     * 計算 arr_type_an_val 中有多少個不同的規格類型（type）被勾選
     * @param {Array} arr arr_type_an_val
     * @returns {Number} 唯一 type 的數量
     */
    function checkmethod(arr) {
        var arrcont = [];
        arr.forEach(function(element) {
            var index =  arrcont.indexOf(element['type']);
            if (index == -1) {
                arrcont.push(element['type']);
            }
        });
        return arrcont.length;
    }
    /**
     * 檢查指定 type 是否尚未有任何篩選條件（用於判斷新增還是疊加）
     * @param {Number} type 規格 type_id
     * @returns {Boolean} true = 尚未有該 type 的篩選
     */
    function checkDataStep(type) {
        var  index = arr_type_an_val.findIndex(
           function(x) {
            //    return  x.value1 === value1;
               return parseInt(x.type) ===  parseInt(type);
           })
           if (index == -1) {
               return true;
           } else {
               return false;
           }
    }
    /**
     * 依篩選後的產品清單，重新載入可用的規格篩選選項
     * @param {Array} array_fil_type 篩選後的產品陣列
     */
    function findresultfeildbypro(array_fil_type) {
        var fieldFilter = [];
        $.each(array_fil_type, function(index, value) {
            pro_perti.filter(function(poper) {
                if (value['pro_id'] == poper['product_id']) {
                    // 用 product_id + type_id + data_1 + data_2 組合去重，避免重複渲染同一 spec option
                    var exists = fieldFilter.findIndex(function(x) {
                        return x.product_id == poper.product_id
                            && x.type_id == poper.type_id
                            && x.data_1 == poper.data_1
                            && x.data_2 == poper.data_2;
                    });
                    if (exists == -1) {
                        fieldFilter.push(poper);
                    }
                }
            });
        });

        loadNewFilter(fieldFilter, stateType);
    }

    /**
     * 檢查 ID 是否不在 loop 陣列中（用於去重）
     * @returns {Boolean} true = 不在陣列中
     */
    function checkloop(id, loop) {
        var  index = loop.indexOf(id);

         if (index == -1) {
             return true;
         } else {
             return false;
         }
    }
    /**
     * 檢查指定 type + value1 的篩選是否已存在於 arr_type_an_val
     * @returns {Boolean} true = 已存在
     */
    function checkdatainfild(type, data) {

       var  index =  arr_type_an_val.findIndex(
        function(x) {
         return parseInt(x.type) === parseInt(type)
         && x.value1 === data

        })

        if (index == -1) {
            return false;
        } else {
           return true;
        }
    }
    /**
     * 若篩選條件已勾選，同步勾上對應的 checkbox DOM
     * @param {Number} type   規格 type_id
     * @param {*}      value1 value1 比對值
     * @param {String} Filid  checkbox 後綴 ID
     */
    function checkedfilter(type, value1, value2, value3, value4, value5 , Filid) {
        var  index =  arr_type_an_val.findIndex(
        function(x) {
         return parseInt(x.type) ===  parseInt(type)
         && x.value1 === value1
         && x.value2 === value2

        })


        if (index == -1) {
            return '';
        } else {
            $("#cx-"+type+Filid).prop("checked" , true);
            $("#cx-mobile"+type+Filid).prop("checked" , true);
        }
    }
    function checkedfilterInputtext(type, val_text, filid) {
        var  index = arr_inputtxt.findIndex(function(x) {
                        if (x.value_text == null) {
                            data.value_text = '';
                         }
                         if (val_text == null) {
                            val_text = '';
                         }
       return x.value_text.trim() === val_text.trim();
       })
        if (index == -1) {
            return '';
        } else {
            $("#cx-text"+type+filid).prop("checked" , true);
            $("#cx-mobiletext"+type+filid).prop("checked" , true);
        }
    }

    function loadNewFilter(fieldFilter, stateType) {
                var data_1 = [];
                var data_text = [];
                 var checklooparr = [];
               var property =  fieldFilter.sort(
                   function(a, b) {

                       if (a.data_1 < b.data_1) {
                           if (a.data_2 &&  b.data_2 &&  a.data_2 < b.data_2 ) {
                            return -1;
                            }
                            return -1;
                       } else {
                        return 1;
                       }

                    });
                $.each(property, function(index_per, ppt) {
                    var html3 = '';
                    var htmlmobile = '';
                    if (checkloop(ppt['type_id'] , checklooparr)) {
                        checklooparr.push(ppt['type_id']);
                        $('.dataserchfilter'+ppt['type_id']).empty();
                        $('.dataserchfiltermobile'+ppt['type_id']).empty();
                    }
                  if (ppt['type_id'] == ppt['type_id']) {
                    var object  = {};
                    var text = null;
                    if (ppt['value_text'] != null && typeof ppt['value_text']  != 'undefined') {
                        text = ppt['value_text'].replace(/\s/g, '').toLowerCase().replace(/^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g, '').trim();

                    }
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
                    ];
                    object = {
                       'id':index_per,
                       'type':ppt['type_id'],
                       'data':checkNull(dataarr, ppt['unit_name'], ppt['status_input']) ,
                       'status_input':ppt['status_input'],
                       'text':text,
                    }
                    if (ppt['type_value'] == 'number' && ppt['data_1'] != null) {
                      objectFiled = {
                        'field_id':ppt['type_id'],
                        'type_box':ppt['status_input'],
                      }
                      var  index_fi = fildnumber.findIndex(
                         function(x) {
                         return  x.field_id === ppt['type_id'];
                         })
                        if (index_fi == -1) {
                            fildnumber.push(objectFiled);
                        }
                        if (containsObject(object, data_1)) {
                            data_1.push(object);
                            html3 += '<div onchange="fillerNumber('+"'"+ppt['type_id']+"'"+','+ppt['data_1']+','+ppt['data_2']+','+ppt['data_3']
                            +','+ppt['data_4'] +','+ppt['data_5'] +','+ppt['data_6'] +','+ppt['data_7'] +','+ppt['data_8'] +','+ppt['data_9']
                            +','+ppt['data_10'] +','+ppt['data_11'] +','+ppt['data_12']
                            +');" class="box-input-checkbox new-filter">';
                            html3 += '<input  class="inp-cbx" id="cx-'+ppt['type_id']+index_per+'" type="checkbox" style="display: none;" />';
                            html3 += '<label class="cbx" for="cx-'+ppt['type_id']+index_per+'"><span>';
                            html3 += '<svg width="12px" height="10px" viewbox="0 0 12 10">';
                            html3 += '<polyline points="1.5 6 4.5 9 10.5 1"></polyline>';

                            html3 += '</svg></span ><span class="'+ppt['product_id']+'">'+ checkNull(dataarr, ppt['unit_name'], ppt['status_input']) +'</span></label>';
                            html3 += '</div>' ;
                            htmlmobile += '<div onchange="fillerNumber('+"'"+ppt['type_id']+"'"+','+ppt['data_1']+','+ppt['data_2']+','+ppt['data_3'] +','+ppt['data_4'] +','+ppt['data_5']
                            +','+ppt['data_6']+','+ppt['data_7']+','+ppt['data_8'] +','+ppt['data_9'] +','+ppt['data_10'] +','+ppt['data_11'] +','+ppt['data_12']
                            +');" class="box-input-checkbox">';
                            htmlmobile += '<input  class="inp-cbx" id="cx-mobile'+ppt['type_id']+index_per+'" type="checkbox" style="display: none;" />';
                            htmlmobile += '<label class="cbx" for="cx-mobile'+ppt['type_id']+index_per+'"><span>';
                            htmlmobile += '<svg width="12px" height="10px" viewbox="0 0 12 10">';
                            htmlmobile += '<polyline points="1.5 6 4.5 9 10.5 1"></polyline>';
                            htmlmobile += '</svg></span ><span>'+ checkNull(dataarr, ppt['unit_name'], ppt['status_input']) +'</span></label>';
                            htmlmobile += '</div>' ;
                            $('.dataserchfilter'+ppt['type_id']).append(html3);
                            $('.dataserchfiltermobile'+ppt['type_id']).append(htmlmobile);

                            checkedfilter(ppt['type_id'], ppt['data_1'], ppt['data_2'], ppt['data_3'], ppt['data_4'] , ppt['data_5'] , index_per);
                        }
                    }
                    // } else if (ppt['type_value'] == 'text' && ppt['value_text'] != null && ppt['value_text'] != '') {
                    //     if (containsObjectText(object, data_text)) {
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
                    //         checkedfilterInputtext(ppt['type_id'] , ppt['value_text'] , index_per);
                    //     }
                    // }
                }
                });
               var property2 =  fieldFilter.sort(
                   function(a, b) {
                       return a.value_text > b.value_text ? 1 : -1;
                    });


                $.each(property2, function(index_per, ppt) {
                    if (checkDataStep(ppt['type_id'])) {
                    var html3 = '';
                    var htmlmobile = '';
                    if (checkloop(ppt['type_id'] , checklooparr)) {
                        checklooparr.push(ppt['type_id']);
                        $('.dataserchfilter'+ppt['type_id']).empty();
                        $('.dataserchfiltermobile'+ppt['type_id']).empty();
                    }
                  if (ppt['type_id'] == ppt['type_id']) {
                    var object  = {};
                    var text = null;
                    if (ppt['value_text'] != null && typeof ppt['value_text']  != 'undefined') {
                        text = ppt['value_text'].replace(/\s/g, '').toLowerCase().replace(/^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g, '').trim();

                    }
                    object = {
                       'id':index_per,
                       'type':ppt['type_id'],
                       'data':ppt['data_1'],
                       'text':text,
                    }

                    if (ppt['type_value'] == 'text' && ppt['value_text'] != null && ppt['value_text'] != '' && typeof ppt['value_text']  != 'undefined') {
                        if (containsObjectText(object, data_text)) {
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
                            checkedfilterInputtext(ppt['type_id'] , ppt['value_text'] , index_per);
                        }
                    }
                }
                    }
                });

    }


    var arr_inputtxt = []; // 勾選的文字規格篩選清單 [{type, value_text}, ...]

    /**
     * 切換文字規格篩選（text-type spec checkbox）
     * @param {Number} type  規格 type_id
     * @param {String} value 規格值（value_text）
     */
    function fillerInputText(type, value) {
        stateType = type;
        var obj = {
          'type':type,
          'value_text':value,
        }

       var  index = arr_inputtxt.findIndex(function(x) {
                return x.value_text === value;
             })
             if (index == -1) {
                arr_inputtxt.push(obj);
             } else {
                if (index > -1) {
                arr_inputtxt.splice(index, 1);
                 }
             }

             fillerData();
            //  filAllTypeInputText();
    }
    /**
     * 格式化規格數值陣列為顯示字串（含排序）
     * @see checkNullShow() — 功能相同，兩者擇一即可
     * @param {Array}  dataarr 數值陣列
     * @param {String} unit    單位字串
     * @param {Number} status  status_input：1/2=列舉（排序）, 3=範圍
     * @returns {String}
     */
    function checkNull(dataarr, unit, status) {
        var string = '';
        var arrstri = [];

       if (status == 1 || status == 2 ) {
        var data_fi =  dataarr.sort(
            function(a, b) {
                return a > b && a && b ? 1 : -1;
             });
        $.each(data_fi, function(index, data) {
            if (data != null && data != '') {
              arrstri.push(data+unit);
            }
        });
        string = arrstri.join(', ');
       } else if (status == 3) {

        string = dataarr[0]+'-'+dataarr[1]+unit;
       }
         return  string;
    }
    /**
     * 依 arr_inputtxt 篩選 productFilter（舊流程，已由 fillerData() 內的 loaddatafilterTypeText() 取代）
     * @deprecated 目前 fillerInputText() 直接呼叫 fillerData()，此函式保留但不再使用
     */
    function filAllTypeInputText() {
        var array_fil_type = [];
        $.each(productFilter, function(index, value) {
        productFilter[index]['contentFilter'].filter(function(data) {
            arr_inputtxt.forEach(function(element) {
                    if (data.type_id == element['type']) {
                         if (data.value_text == null) {
                            data.value_text = '';
                         }
                         if (element['value_text'] == null && typeof element['value_text']  != 'undefined') {
                            data.value_text = '';
                         }
                        if (data.value_text.trim() == element['value_text'].trim()) {
                            var  index = array_fil_type.findIndex(
                                 function(x) {
                                    return x.pro_id === value.pro_id;
                                })

                            if (index == -1) {

                             array_fil_type.push(value);
                            }
                          }
                   }
            });
        });
      });
      if (arr_inputtxt.length == 0) {
        array_fil_type = [];
        array_fil_type = productFilter;
      }

      listItemFiler(array_fil_type);
    }
    // ==================================================================
    // 渲染入口（Render Entry Points）
    // ==================================================================

    /**
     * 排序並渲染產品清單（所有篩選完成後的最終顯示入口）
     * @param {Array} arr 篩選後的產品陣列
     */
    function listItemFiler(arr) {
        var current_list =  $('#current_list_item').val();
        var showarr =  onFilterSetSor(arr);
      if (current_list == 0) {
        onclickListView(showarr, 1 , 1);
      } else {
        onclickGridView(showarr);
      }
        $(".moreBox").slice(0, 8).show();
        $(".moreBox_mobile").slice(0, 8).show();
        $(".row_table").slice(0, 8).show();
      if (showarr.length > 8) {
        $("#loadlistview").show();
      } else {
        $("#loadlistview").fadeOut('hide');
      }
      $('.countproduct').text(showarr.length);
    }
    /**
     * 清除所有篩選條件
     * 重置所有表單並重新載入資料
     */
    function resetAllTab() {
        ser_arr = [];
        arr_status = [];
        arr_cer = [];
        arr_inputtxt = [];
        arr_type_an_val = [];
        arr_value1 = [];
        pro_type_arr = [];
        mode_series_arr = [];
        $.each(filter_pro, function(index_con, fil_con) {
              $('#collapse-fliter_'+fil_con['field_id']).removeClass('show');
              $('#form-'+fil_con['field_id'] )[0].reset();
              $('#form-mobile'+fil_con['field_id'] )[0].reset();
        });
        $('#collapse-fliter_series01').addClass('show');

        // 更新 series 選項
        updateSeriesOptions();

        fillerData();
    }
    function resetformById(id) {
        $('#form-'+id)[0].reset();
        $('#form-mobile'+id)[0].reset();
        if (id == 'series01') {
            ser_arr = [];
        } else if (id == 'product_type') {
            pro_type_arr = [];
            // 更新 series 選項
            updateSeriesOptions();
        } else if (id == 'mode_series') {
            mode_series_arr = [];
        } else if (id == 'status02') {
            arr_status = [];
        } else if (id == 'certifi04') {
            arr_cer = [];
        } else if (id == 'safety03') {
            arr_safety = [];
        } else {
            arr_type_an_val = [];
            arr_value1 = [];
        }
        fillerData();
    }
    // ==================================================================
    // 排序（Sort）
    // ==================================================================

    /**
     * 依 .selectSort 下拉選單的值排序產品陣列
     * @param {Array} arr_val 產品陣列
     * @returns {Array} 排序後的陣列
     */
    function onFilterSetSor(arr_val) {
        var arr_result = [];
       var type_se = $('.selectSort').val();
       if (type_se == 1) {
        arr_result = sortByStatus(arr_val);
       } else if (type_se == 2) {
        arr_result = sortOutputLH(arr_val, 4);
       } else if (type_se == 3) {
        arr_result = sortOutputLH(arr_val, 3);
       } else if (type_se == 4) {
        arr_result = sortOutputLH(arr_val, 8);

       } else if (type_se == 5) {
        arr_result = sortModelName(arr_val);
       }
        return  arr_result;
    }
    /**
     * 手機版排序：重新從 products 建立陣列後排序並渲染
     * 注意：會重建整個產品陣列，忽略現有篩選條件
     */
    function onselectSort() {
        var arr_val = loadData(products, product_has_property);
        var arr_result = [];
       var type_se = $('.selectSort').val();
       var typesor = 0;
       if (type_se == 1) {
        arr_result = sortByStatus(arr_val);
         typesor = 1;
       } else if (type_se == 2) {
        arr_result = sortOutputLH(arr_val, 4);
        typesor = 2;
       } else if (type_se == 3) {
        arr_result = sortOutputLH(arr_val, 3);
        typesor = 3;
       } else if (type_se == 4) {
        arr_result = sortOutputLH(arr_val, 8);
        typesor = 4;
       } else if (type_se == 5) {
        arr_result = sortDateModify(arr_val);
       }
       var current_list =  $('#current_list_item').val();
      if (current_list == 0) {
        onclickListView(arr_result, 1 , typesor);
      } else {
        onclickGridView(arr_result);
      }
        $(".moreBox").slice(0, 8).show();
        $(".moreBox_mobile").slice(0, 8).show();
        $(".row_table").slice(0, 8).show();
        $('.countproduct').text(arr_result.length);
        productFilter = arr_result;
    }

    /**
     * 桌面版排序：對現有 productFilter 排序並渲染（不重建陣列）
     */
    function onselectSortDestop() {

        var arr_val = productFilter;
        var arr_result = [];
        var typesor = 0;
        var type_se = $('#selectSortDestop').val();
        if (type_se == 1) {
            arr_result = sortByStatus(arr_val);
            typesor = 1;
        } else if (type_se == 2) {
            arr_result = sortOutputLH(arr_val, 4);
            typesor = 2;
        } else if (type_se == 3) {
            arr_result = sortOutputLH(arr_val, 3);
            typesor = 3;
        } else if (type_se == 4) {
            arr_result = sortOutputLH(arr_val, 8);
            typesor = 4;
        } else if (type_se == 5) {
            arr_result = sortDateModify(arr_val);
        }
        var current_list =  $('#current_list_item').val();
        if (current_list == 0) {
            onclickListView(arr_result, 1, typesor);
        } else {
            onclickGridView(arr_result);
        }
        if (arr_result.length > 0) {
            $(".moreBox").slice(0, 8).show();
            $(".moreBox_mobile").slice(0, 8).show();
            $(".row_table").slice(0, 8).show();
        }

        $('.countproduct').text(arr_result.length);
    }

    /**
     * 依狀態排序 (New > No status > NRND > EOL)
     */
    function sortByStatus(array_value) {
        return array_value.sort(function(a, b) {
            // 定義狀態優先級
            function getStatusPriority(status) {
                if (status == 2) return 1; // New
                if (status == 1 || status == null || (status != 2 && status != 3 && status != 4)) return 2; // No status
                if (status == 3) return 3; // NRND
                if (status == 4) return 4; // EOL
                return 5; // 其他
            }

            var priorityA = getStatusPriority(a.status_product);
            var priorityB = getStatusPriority(b.status_product);

            // 狀態相同時，按產品代碼排序
            if (priorityA === priorityB) {
                return a.pro_code > b.pro_code ? 1 : -1;
            }

            return priorityA - priorityB;
        });
    }

    /**
     * 依型號名稱排序 (A-Z)
     */
    function sortModelName(array_value) {
        var arr = [];
         arr = array_value.sort(
             function (a, b) {
                 return a.pro_code > b.pro_code ? 1 : -1;
             });
        return arr;
    }
    /**
     * 依型號名稱排序 (Z-A)
     */
    function sortModelNameZA(array_value) {
        var arr = [];
         arr = array_value.sort(
             function (a, b) {
                 return a.pro_code < b.pro_code ? 1 : -1;
             });


        return arr;
    }

    /**
     * 依尺寸排序 (小到大)
     * @param {Array} array_value 產品陣列
     * @returns {Array} 依 dimensionL 升冪排序後的陣列
     */
    function dimensionLH(array_value) {

        var arr = [];
         arr = array_value.sort(
             function (a, b) {
                 return parseInt(a.dimensionL) > parseInt(b.dimensionL) ? 1 : -1;
             });
        return arr;
    }
    /**
     * 依尺寸排序 (大到小)
     * @param {Array} array_value 產品陣列
     * @returns {Array} 依 dimensionL 降冪排序後的陣列
     */
    function dimensionHL(array_value) {
        var arr = [];
         arr = array_value.sort(
             function (a, b) {
                 return parseInt(a.dimensionL) < parseInt(b.dimensionL) ? 1 : -1;
             });

        return arr;
    }

    /**
     * 依更新日期排序
     */
    function sortDateModify(array_value) {
        var arr = [];
        arr = array_value.sort(
            function (a, b) {
                 return a.updated_at > b.updated_at ? 1 : -1;
             });
        return arr;
    }
    /**
     * 依輸出規格排序 (小到大)
     * @param {Array} array_value 產品陣列
     * @param {Number} type 規格類型ID
     */
    function sortOutputLH(array_value, type) {
        var value_data = [];
        var arr_sort = [];

        // Step 1: Collect relevant contentFilter data
        $.each(array_value, function(index, value) {
            var filters = value['contentFilter'];
            $.each(filters, function(i, data) {
                if (data['type_id'] == type) {
                    value_data.push({
                        "pro_id": value['pro_id'],
                        "data": data['data_1']
                    });
                }
            });
        });

        // Step 2: Sort by data_1
        value_data.sort(function(a, b) {
            return a.data > b.data ? 1 : -1;
        });

        // Step 3: Map pro_id to item for fast lookup
        var idMap = {};
        $.each(array_value, function(index, item) {
            idMap[item.pro_id] = item;
        });

        // Step 4: Rebuild sorted array
        $.each(value_data, function(index, val) {
            if (idMap[val.pro_id]) {
                arr_sort.push(idMap[val.pro_id]);
            }
        });

        return arr_sort;
    }

    /**
     * 依輸出規格排序 (大到小)
     * @param {Array} array_value 產品陣列
     * @param {Number} type 規格類型ID
     */
    function sortOutputHL(array_value, type) {
        var value_data = [];
        var arr_sort = [];

        // Step 1: Collect relevant contentFilter data
        $.each(array_value, function(index, value) {
            var filters = value['contentFilter'];
            $.each(filters, function(i, data) {
                if (data['type_id'] == type) {
                    value_data.push({
                        "pro_id": value['pro_id'],
                        "data": data['data_1']
                    });
                }
            });
        });

        // Step 2: Sort by data_1
        value_data.sort(function(a, b) {
            return a.data < b.data ? 1 : -1;
        });

        // Step 3: Map pro_id to item for fast lookup
        var idMap = {};
        $.each(array_value, function(index, item) {
            idMap[item.pro_id] = item;
        });

        // Step 4: Rebuild sorted array
        $.each(value_data, function(index, val) {
            if (idMap[val.pro_id]) {
                arr_sort.push(idMap[val.pro_id]);
            }
        });

        return arr_sort;
    }

    /**
     * 依輸入規格排序 (大到小)
     * @param {Array} array_value 產品陣列
     * @param {Number} type 規格類型ID
     */
    function sortInputHL(array_value, type) {
        var value_data = [];
        var arr_sort = [];

        // Step 1: Collect relevant contentFilter data
        $.each(array_value, function(index, value) {
            var filters = value['contentFilter'];
            $.each(filters, function(i, data) {
                if (data['type_id'] == type) {
                    value_data.push({
                        "pro_id": value['pro_id'],
                        "data":data['value_text'],
                    });
                }
            });
        });

        // Step 2: Sort by data_1
        value_data.sort(function(a, b) {
            return a.data < b.data ? 1 : -1;
        });

        // Step 3: Map pro_id to item for fast lookup
        var idMap = {};
        $.each(array_value, function(index, item) {
            idMap[item.pro_id] = item;
        });

        // Step 4: Rebuild sorted array
        $.each(value_data, function(index, val) {
            if (idMap[val.pro_id]) {
                arr_sort.push(idMap[val.pro_id]);
            }
        });

        return arr_sort;
    }

    /**
     * 依輸入規格排序 (小到大)
     * @param {Array} array_value 產品陣列
     * @param {Number} type 規格類型ID
     */
    function sortInputLH(array_value, type) {
        var value_data = [];
        var arr_sort = [];

        // Step 1: Collect relevant contentFilter data
        $.each(array_value, function(index, value) {
            var filters = value['contentFilter'];
            $.each(filters, function(i, data) {
                if (data['type_id'] == type) {
                    value_data.push({
                        "pro_id": value['pro_id'],
                        "data":data['value_text'],
                    });
                }
            });
        });

        // Step 2: Sort by data_1
        value_data.sort(function(a, b) {
            return a.data > b.data ? 1 : -1;
        });

        // Step 3: Map pro_id to item for fast lookup
        var idMap = {};
        $.each(array_value, function(index, item) {
            idMap[item.pro_id] = item;
        });

        // Step 4: Rebuild sorted array
        $.each(value_data, function(index, val) {
            if (idMap[val.pro_id]) {
                arr_sort.push(idMap[val.pro_id]);
            }
        });

        return arr_sort;
    }

    /**
     * 取得指定規格類型的最大最小值
     * @param {Number} id 規格類型ID
     * @returns {Object} 包含 min 和 max 的物件
     */
    function getMinMaxValueById(id) {
        var value_data = [];
        pro_perti.filter(function(data) {
            if (data['type_id'] == id) {
                value_data.push(data['data_1']);
                if (data['data_2'] != null) {
                    value_data.push(data['data_2']);
                }
                if (data['data_3'] != null) {
                    value_data.push(data['data_3']);
                }
                if (data['data_4'] != null) {
                    value_data.push(data['data_4']);
                }
                if (data['data_5'] != null) {
                    value_data.push(data['data_5']);
                }

            }
        });

        var min = Math.min.apply(null, value_data);
        var max = Math.max.apply(null, value_data);
       return {
            "min": min,
            "max": max,
       };
    }

    // ==================================================================
    // 搜尋（Search）
    // ==================================================================

    /**
     * 桌面版關鍵字搜尋：依 pro_code regex 篩選，清空所有其他篩選條件
     * 搜尋結果存入 productTextSearch，並同步關鍵字到手機版輸入框
     */
    function onsearchProduct() {
        var re_arr = [];
            ser_arr = [];
            arr_status = [];
            arr_cer = [];
            arr_inputtxt = [];
            arr_type_an_val = [];
            arr_value1 = [];
        $.each(filter_pro, function(index_con, fil_con) {
            $('#collapse-fliter_'+fil_con['field_id']).removeClass('show');
            $('#form-'+fil_con['field_id'] )[0].reset();
            $('#form-mobile'+fil_con['field_id'] )[0].reset();
        });

        $.each(products, function(index, value) {
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
            productObj['short_features'] = value['short_features'];
            productObj['alt_img'] = value['alt_img'];
            productObj['content'] = [];
            productObj['contentFilter'] = [];
                $.each(product_has_property, function(index2, value2) {
                if (value['pro_id'] == value2['product_id']) {
                    productObj['content'].push(value2);
                }
            });
            $.each(pro_perti, function(index3, value3) {
                if (value['pro_id'] == value3['product_id']) {
                    productObj['contentFilter'].push(value3);
                }
            });

            productTextSearch.push(productObj);
        });
        var key = $('#key_destop').val();
        $('#key_mobile').val(key);
        var term = key; // search term (regex pattern)
        var search = new RegExp(term, 'i'); // prepare a regex object
        productTextSearch.filter(function(data) {
        if (search.test(data.pro_code)) {
            var index = re_arr.findIndex(function(x) {
                return  x.pro_id === data.pro_id;
            })
            if (index == -1) {
                re_arr.push(data);
            }
        }
        });
        onselectSortArr(re_arr);
        $('#current_method').val(1);
     }
    /**
     * 手機版關鍵字搜尋：邏輯同 onsearchProduct()，讀取手機版輸入框並同步到桌面版
     */
     function onsearchProductMobile() {
        var re_arr = [];
        $.each(filter_pro, function(index_con, fil_con) {
            $('#collapse-fliter_'+fil_con['field_id']).removeClass('show');
            $('#form-'+fil_con['field_id'] )[0].reset();
            $('#form-mobile'+fil_con['field_id'] )[0].reset();
        });

        $.each(products, function(index, value) {
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
            productObj['short_features'] = value['short_features'];
            productObj['alt_img'] = value['alt_img'];
            productObj['content'] = [];
            productObj['contentFilter'] = [];
                $.each(product_has_property, function(index2, value2) {
                if (value['pro_id'] == value2['product_id']) {
                    productObj['content'].push(value2);
                }
            });
            $.each(pro_perti, function(index3, value3) {
                if (value['pro_id'] == value3['product_id']) {
                    productObj['contentFilter'].push(value3);
                }
            });

            productTextSearch.push(productObj);
        });
        var key = $('#key_mobile').val();
        $('#key_destop').val(key);
        var term = key; // search term (regex pattern)
        var search = new RegExp(term, 'i'); // prepare a regex object
        productTextSearch.filter(function(data) {
        if (search.test(data.pro_code)) {
            var index = re_arr.findIndex(function(x) {
                return x.pro_id === data.pro_id;
            })
            if (index == -1) {
                re_arr.push(data);
            }
        }
        });
        onselectSortArr(re_arr);
        $('#current_method').val(2);
     }

    /**
     * 對搜尋結果進行排序並顯示
     * @param {Array} re_arr 搜尋結果陣列
     */
    function onselectSortArr(re_arr) {
        var arr_val = re_arr;
        var arr_result = [];
        var type_se = $('.selectSort').val();
        var typesor = 0;
        if (type_se == 1) {
            arr_result = sortByStatus(arr_val);
            typesor = 1;
        } else if (type_se == 2) {
            arr_result = sortOutputLH(arr_val, 4);
            typesor = 2;
        } else if (type_se == 3) {
            arr_result = sortOutputLH(arr_val, 3);
            typesor = 3;
        } else if (type_se == 4) {
            arr_result = sortOutputLH(arr_val, 8);
            typesor = 4;
        } else if (type_se == 5) {
            arr_result = sortModelName(arr_val);
        }
        var current_list =  $('#current_list_item').val();
        if (current_list == 0) {
            onclickListView(arr_result, typesor);
        } else {
            onclickGridView(arr_result);
        }
        if (arr_result.length < 8) {
            $('#loadMore').hide();
            $('#loadlistview').hide();
            $('#loadMore_mobile').hide();
        }
        if (arr_result.length > 0) {
            $(".moreBox").slice(0, 8).show();
            $(".moreBox_mobile").slice(0, 8).show();
            $(".row_table").slice(0, 8).show();
        }

        $('.countproduct').text(arr_result.length);
        //   productFilter = arr_result;
    }



    // ==================================================================
    // 滑桿（Sliders）
    // ==================================================================

    /**
     * 建立手機版 noUiSlider 數值滑桿，依 fildnumberMobile 建立所有數值型篩選欄位
     */
    function createSlider() {
        $.each(fildnumberMobile, function(index_con, fil_con) {
            if (fil_con['field_id'] != 'series01' && fil_con['field_id'] != 'status02' && fil_con['field_id'] != 'certifi04' && fil_con['field_id'] != 'safety03' && fil_con['field_id'] != 'mode_series' ) {
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

    /**
     * 建立桌面版 noUiSlider 數值滑桿，依 fildnumber 建立所有數值型篩選欄位
     * 每次 update 事件都會呼叫 findDataRage() 重新篩選
     */
    function createSliderDestop() {
        $.each(fildnumber, function(index_con, fil_con) {
            var data = getMinMaxValueById(fil_con['field_id']);
            if (fil_con['field_id'] != 'series01' && fil_con['field_id'] != 'status02' && fil_con['field_id'] != 'certifi04' && fil_con['field_id'] != 'safety03' && fil_con['field_id'] != 'mode_series' ) {
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
                    findDataRage(nonLinearSlider2.noUiSlider.get() , fil_con['field_id'] );
                });
            }
        });
    }
    /**
     * 根據滑桿數值範圍篩選產品
     * @param {Array} arrRage 數值範圍 [min, max]
     * @param {Number} type 規格類型ID
     */
    function findDataRage(arrRage, type) {
        var pro_arr = [];
        $.each(productFilter, function(index, value) {
            value['contentFilter'].filter(function(data) {
                if (data['type_id'] == type) {
                    if (data['data_1'] && data['data_2'] == null) {
                        if (data['data_1'] >= arrRage[0] &&  data['data_1'] <= arrRage[1]) {
                            var index = pro_arr.findIndex(
                                function(x) {
                                    return x.pro_code === value['pro_code'];
                                }
                            )
                            if (index == -1) {
                                pro_arr.push(value);
                            }
                        }
                    } else if (data['data_1'] != null && data['data_2'] != null) {
                        if (data['data_1'] >= arrRage[0] &&  data['data_2'] <= arrRage[1]) {
                            var index = pro_arr.findIndex(
                                function(x) {
                                    return x.pro_code === value['pro_code'];
                                }
                                )
                            if (index == -1) {
                                pro_arr.push(value);
                            }
                        }
                    }
                }
            });
        });
        var arr_val = pro_arr;
        var arr_result = [];
        var type_sor = 0;
        var type_se = $('.selectSort').val();
        if (type_se == 1) {
            arr_result =   sortByStatus(arr_val);
            type_sor = 1;
        } else if (type_se == 2) {
            arr_result = sortOutputLH(arr_val, 4);
            type_sor = 2;
        } else if (type_se == 3) {
            arr_result = sortOutputLH(arr_val, 3);
            type_sor = 3;
        } else if (type_se == 4) {
            arr_result = sortOutputLH(arr_val, 8);
            type_sor = 4;
        } else if (type_se == 5) {
            arr_result = sortModelName(arr_val);
        }
        var current_list =  $('#current_list_item').val();
        if (current_list == 0) {
            onclickListView(arr_result, 1, type_sor);
        } else {
            onclickGridView(arr_result);
        }
        if (arr_result.length > 0) {
            $(".moreBox").slice(0, 8).show();
            $(".moreBox_mobile").slice(0, 8).show();
            $(".row_table").slice(0, 8).show();
        }

        $('.countproduct').text(arr_result.length);
    }

    // ==================================================================
    // 分頁載入（Pagination / Load More）
    // ==================================================================

    /**
     * 桌面版 Grid：顯示下一批 4 個隱藏的產品卡片
     */
    function loadeMore(event, i) {
        if ($(".moreBox:hidden").length != 0) {
            $("#loadMore").show();
        }
        event.preventDefault();

        $(".moreBox:hidden").slice(0, 4).slideDown();
        if ($(".moreBox:hidden").length == 0) {
            $("#loadMore").fadeOut('hide');
        }
    }
    /**
     * 手機版 Grid：顯示下一批 4 個隱藏的產品卡片
     */
    function loadeMoreMobile(event, i) {
        if ($(".moreBox_mobile:hidden").length != 0) {
            $("#loadMore_mobile").show();
        }
        event.preventDefault();

        $(".moreBox_mobile:hidden").slice(0, 4).slideDown();
        if ($(".moreBox_mobile:hidden").length == 0) {
            $("#loadMore_mobile").fadeOut('hide');
        }
    }
    /**
     * List View：顯示下一批 4 筆隱藏的表格列
     */
    function loadlistview(event, i) {
        if ($(".row_table:hidden").length != 0) {
            $("#loadlistview").show();
        }
        event.preventDefault();

        $(".row_table:hidden").slice(0, 4).slideDown();
        if ($(".row_table:hidden").length == 0) {
            $("#loadlistview").fadeOut('hide');
        }
    }

    // ==================================================================
    // RWD
    // ==================================================================

    // 視窗縮小至手機寬度時，強制切換為 Grid View 並重新渲染
    $(window).resize(function() {
        if ($(window).width() <= 786) {
            $('#current_list_item').val(1);
            fillerData();
        }
    });
</script>
@endsection
