@extends('layouts.front-end')
@section('css')

<style>
   
    /* select */
	.form-control{
        font-size: 14px;
		-webkit-appearance: none;
		-moz-appearance: none;
		border-radius: 0;
		border: 1px solid #444444; background-position: right 50%;
		background-repeat: no-repeat;
		background-image: url('{{asset('frontend-asset/image/arrow-down.svg')}}');
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

    table {
        border-collapse: unset;
        border-spacing: 0px 15px;
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
        border-top: 2px solid #E3EFF8;
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
        padding: unset;
    }
    .table th{
        padding: 3px 10px !important;
    }
    .list-group{
        margin-top: 6%;
    }
    .modal-open{overflow:auto;padding-right:0 !important;}
</style>
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
                        <li class="breadcrumb-item text-breadcrumb-home"><a href="{{route('index','home')}}">HOME</a>
                        </li>
                        <li class="breadcrumb-item active text-breadcrumb" aria-current="page"><a
                                href="{{route('index','product/index')}}">PRODUCTS</a></li>

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
            @foreach ($subCategories as $subCate)
            <div class="row">
                <div class="col-lg-6">
                    <div class="box-banner-pro-type-all">
                        <div class="text-middle">
                            <h1 class="text-title-banner">{{$subCate->name}}</h1>
                            <div class="text-p-banner my-2">{!!$subCate->content!!}</div>
                                @if(isset($subCate->file))
                                <a class="text-color-delta text-bold  " href="{{config('app.url')}}/medias/categories/{{$subCate->file}}" download=""><img
                                    class="align-baseline mr-2"    src="{{asset('frontend-asset/image/icon/download-icon.svg')}}" alt=""> Download selection
                                    guide</a>
                                @else
                                <a class="text-color-delta text-bold" href="#"><img class="align-baseline mr-1" src="{{asset('frontend-asset/image/icon/download-icon.svg')}}" alt=""> Empty
                                    selection
                                    guide</a>
                                @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 banner-products-pic ">
                    {{-- <img src="{{asset('frontend-asset/image/DIN RAIL POWER SUPPLY@2x.png')}}" alt=""> --}}
                    @if(isset($subCate->image))
                    <img class="img-fluid" style="width:50%"
                        src="{{config('app.url')}}/medias/categories/{{$subCate->image}}" alt="">
                    @else
                    <img class="img-fluid" style="width:50%"
                        src="{{asset('frontend-asset/image/blank.png')}}" alt="">
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<div class="products-index-banner-tablet-down visible-mobile-only">
    @foreach ($subCategories as $subCate)
    <div class="banner-type-product-all-tablet-down"
        style="background-image: url('{{asset('frontend-asset/image/Categories@2x.png')}}');">
        <div class="container">
            <div class="py-5 text-center">
                <p class="text-delta text-bold mt-5">{{$subCate->name}}</p>
                    @if(isset($subCate->file))
                    <a href="{{config('app.url')}}/medias/categories/{{$subCate->file}}" download=""><img
                            src="{{asset('frontend-asset/image/downlode.svg')}}" alt=""> Download selection
                        guide</a>
                    @else
                    <a href="#"><img src="{{asset('frontend-asset/image/downlode.svg')}}" alt=""> Empty
                        selection
                        guide</a>
                    @endif
            </div>
            <div class="d-flex">
                @if(isset($subCate->image))
                <img class="m-auto" style="width:50%;max-width: 250px;"
                    src="{{config('app.url')}}/medias/categories/{{$subCate->image}}" alt="">
                @else
                <img class="m-auto" style="width:50%; max-width: 250px;"
                    src="{{asset('frontend-asset/image/blank.png')}}" alt="">
                @endif
            </div>
        </div>
    </div>
    @endforeach
</div>
<div class="bg-menu-filler visible-upper-mobile">
    <div class="container">
        <div class="row">
            <div class="col-lg-2 col-xl-6 col-md-2 my-auto">
                <div id="showfiler">
                    <a href="#sidebar" data-toggle="collapse" onclick="onclickshow(2);">{{-- <i
                            class="fa fa-filter fa-lg"></i> --}} <img src="{{asset('frontend-asset/image/icon/filter-icon.svg')}}" alt="">
                        Show Filters</a>
                </div>
            </div>
            <div class="col-lg-10 col-xl-6 col-md-10 col-right my-auto">
                <div class="row">
                    <div class="text-lable my-auto">
                        Display Options:
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
                        Sort by:
                    </div>
                    <div class="input-label">                      
                        <select class="form-control">
                            <option value="1">Model Name A-Z</option>
                            <option value="2">Output Voltage – low to high</option>
                            <option value="3">Output Current – low to high</option>
                            <option value="4">Output Power – low to high</option>
                            <option value="5">Modifired Date – newest to oldest</option>
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
            <label class="text-dark text-bold mt-2">SEARCH BY MODEL NAME</label>
            <div class="d-flex justify-content-between">
                <div class=" search-box-product-mobile mr-2">
                    <div class="box-search-filters-icon ">
                        <img src="{{asset('frontend-asset/image/search-filters-icon.svg')}}" alt="">
                    </div>
                    <label for="searchinput-filters" class="searchinput-filters">
                        <input type="text" id="searchinput-filters" placeholder="eg. DRC-24V100W1AZ">
                    </label>
                    </div>
                <button class="btn-filters btn-search search-btn-product-mobile">SEARCH</button>
            </div>
            
        </div>
        <div class="menu-filler-mobile-filter ">
            <div class=" d-flex justify-content-between h-100"> 
                <div id="showfiler-mobile" class="my-auto">
                    <a href="#" id="filterMobile-btn" class="filter-mobile-link"><img src="{{asset('frontend-asset/image/icon/filter-icon.svg')}}" alt="">Filters</a>
                </div>
                <div class="d-flex">
                    <p class="text-white my-auto mr-2 text-card-detial text-bold">Sort by:</p>
                    <div class="input-label my-auto">                      
                        <select class="form-control">
                            <option value="1">Model Name A-Z</option>
                            <option value="2">Output Voltage – low to high</option>
                            <option value="3">Output Current – low to high</option>
                            <option value="4">Output Power – low to high</option>
                            <option value="5">Modifired Date – newest to oldest</option>
                        </select>
                    </div>
                </div> 
            </div>
        </div>
    </div>
    
    <div class="filter-mobilenav" id="filterMobile">
        <div id="filterMobileClose" onclick="closeNavFilter()"></div>
        <div class="filter-mobile-list" id="filterMobileLdist">
            
            <div class="accordion mx-3">
            <div class="tap-filter mb-0">
                        {{-- type --}}
                        {{-- <div class="card-header-filter collapsed fliter_type hide-box" data-toggle="collapse"
                            data-parent="#accordion" href="#collapse-fliter_type_mobile">
                            <a class="card-title text-sixteen-dark">
                                TYPE
                            </a>
                        </div> --}}
                        {{-- <div id="collapse-fliter_type_mobile" class="card-body-filter collapse" data-parent="#accordion">
                            <form >
                                <div class="scrollbar" id="style-1">
                                    <div class="force-overflow">
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="mobile-cx-type1" type="checkbox"
                                                style="display: none;" />
                                            <label class="cbx" for="mobile-cx-type1"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>DIN Rail Power Supply</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="mobile-cx-type2" type="checkbox"
                                                style="display: none;" />
                                            <label class="cbx" for="mobile-cx-type2"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>Panel Mount Power Supply</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="mobile-cx-type3" type="checkbox"
                                                style="display: none;" />
                                            <label class="cbx" for="mobile-cx-type3"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>Open Frame Power Supply</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="mobile-cx-type4" type="checkbox"
                                                style="display: none;" />
                                            <label class="cbx" for="mobile-cx-type4"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>Medical Power Solution</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="mobile-cx-type5" type="checkbox"
                                                style="display: none;" />
                                            <label class="cbx" for="mobile-cx-type5"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>Modules</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="mobile-cx-type6" type="checkbox"
                                                style="display: none;" />
                                            <label class="cbx" for="mobile-cx-type6"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>LED Driver</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="mobile-cx-type7" type="checkbox"
                                                style="display: none;" />
                                            <label class="cbx" for="mobile-cx-type7"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>Configurable Power Supply</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="mobile-cx-type8" type="checkbox"
                                                style="display: none;" />
                                            <label class="cbx" for="mobile-cx-type8"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>Adapter</span></label>
                                        </div>

                                    </div>
                                </div>
                                <button class="btn-reset" type="reset">CLEAR</button>
                            </form>
                        </div> --}}
                        <div class="card-header-filter collapsed fliter_series" data-toggle="collapse"
                            href="#collapse-fliter_series_mobile">
                            <a class="card-title text-sixteen-dark">
                                SERIES
                            </a>
                        </div>
                        <div id="collapse-fliter_series_mobile" class="card-body-filter collapse" data-parent="#accordion">
                            <form >
                                <div class="scrollbar" id="style-1">
                                <div class="box-input-checkbox">
                                    <input class="inp-cbx" id="mobile-cx-series1" type="checkbox" style="display: none;" />
                                    <label class="cbx" for="mobile-cx-series1"><span>
                                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                            </svg></span><span>CliQ</span></label>
                                </div>
                                <div class="box-input-checkbox">
                                    <input class="inp-cbx" id="mobile-cx-series2" type="checkbox" style="display: none;" />
                                    <label class="cbx" for="mobile-cx-series2"><span>
                                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                            </svg></span><span>CliQ II</span></label>
                                </div>
                                <div class="box-input-checkbox">
                                    <input class="inp-cbx" id="mobile-cx-series3" type="checkbox" style="display: none;" />
                                    <label class="cbx" for="mobile-cx-series3"><span>
                                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                            </svg></span><span>CliQ III</span></label>
                                </div>
                                <div class="box-input-checkbox">
                                    <input class="inp-cbx" id="mobile-cx-series4" type="checkbox" style="display: none;" />
                                    <label class="cbx" for="mobile-cx-series4"><span>
                                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                            </svg></span><span> CliQ M</span></label>
                                </div>
                                <div class="box-input-checkbox">
                                    <input class="inp-cbx" id="mobile-cx-series5" type="checkbox" style="display: none;" />
                                    <label class="cbx" for="mobile-cx-series5"><span>
                                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                            </svg></span><span>CliQ VA</span></label>
                                </div>
                                <div class="box-input-checkbox">
                                    <input class="inp-cbx" id="mobile-cx-series6" type="checkbox" style="display: none;" />
                                    <label class="cbx" for="mobile-cx-series6"><span>
                                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                            </svg></span><span>Lyte</span></label>
                                </div>
                                <div class="box-input-checkbox">
                                    <input class="inp-cbx" id="mobile-cx-series7" type="checkbox" style="display: none;" />
                                    <label class="cbx" for="mobile-cx-series7"><span>
                                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                            </svg></span><span>Chrome</span></label>
                                </div>
                                <div class="box-input-checkbox">
                                    <input class="inp-cbx" id="mobile-cx-series8" type="checkbox" style="display: none;" />
                                    <label class="cbx" for="mobile-cx-series8"><span>
                                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                            </svg></span><span>Sync</span></label>
                                </div>
                                <div class="box-input-checkbox">
                                    <input class="inp-cbx" id="mobile-cx-series9" type="checkbox" style="display: none;" />
                                    <label class="cbx" for="mobile-cx-series9"><span>
                                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                            </svg></span><span>PMC</span></label>
                                </div>
                                <div class="box-input-checkbox">
                                    <input class="inp-cbx" id="mobile-cx-series10" type="checkbox" style="display: none;" />
                                    <label class="cbx" for="mobile-cx-series10"><span>
                                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                            </svg></span><span>PMT</span></label>
                                </div>
                                <div class="box-input-checkbox">
                                    <input class="inp-cbx" id="mobile-cx-series11" type="checkbox" style="display: none;" />
                                    <label class="cbx" for="mobile-cx-series11"><span>
                                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                            </svg></span><span>PMT2</span></label>
                                </div>
                                <div class="box-input-checkbox">
                                    <input class="inp-cbx" id="mobile-cx-series12" type="checkbox" style="display: none;" />
                                    <label class="cbx" for="mobile-cx-series12"><span>
                                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                            </svg></span><span>PMF</span></label>
                                </div>
                                <div class="box-input-checkbox">
                                    <input class="inp-cbx" id="mobile-cx-series13" type="checkbox" style="display: none;" />
                                    <label class="cbx" for="mobile-cx-series13"><span>
                                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                            </svg></span><span>PMH</span></label>
                                </div>
                                <div class="box-input-checkbox">
                                    <input class="inp-cbx" id="mobile-cx-series14" type="checkbox" style="display: none;" />
                                    <label class="cbx" for="mobile-cx-series14"><span>
                                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                            </svg></span><span>PMR</span></label>
                                </div>
                                <div class="box-input-checkbox">
                                    <input class="inp-cbx" id="mobile-cx-series15" type="checkbox" style="display: none;" />
                                    <label class="cbx" for="mobile-cx-series15"><span>
                                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                            </svg></span><span>PMU</span></label>
                                </div>
                                <div class="box-input-checkbox">
                                    <input class="inp-cbx" id="mobile-cx-series16" type="checkbox" style="display: none;" />
                                    <label class="cbx" for="mobile-cx-series16"><span>
                                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                            </svg></span><span>PJ</span></label>
                                </div>
                                <div class="box-input-checkbox">
                                    <input class="inp-cbx" id="mobile-cx-series17" type="checkbox" style="display: none;" />
                                    <label class="cbx" for="mobile-cx-series17"><span>
                                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                            </svg></span><span>PJB</span></label>
                                </div>
                                <div class="box-input-checkbox">
                                    <input class="inp-cbx" id="mobile-cx-series18" type="checkbox" style="display: none;" />
                                    <label class="cbx" for="mobile-cx-series18"><span>
                                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                            </svg></span><span>PJT</span></label>
                                </div>
                                <div class="box-input-checkbox">
                                    <input class="inp-cbx" id="mobile-cx-series19" type="checkbox" style="display: none;" />
                                    <label class="cbx" for="mobile-cx-series19"><span>
                                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                            </svg></span><span>PJU</span></label>
                                </div>
                                <div class="box-input-checkbox">
                                    <input class="inp-cbx" id="mobile-cx-series20" type="checkbox" style="display: none;" />
                                    <label class="cbx" for="mobile-cx-series20"><span>
                                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                            </svg></span><span>PJL</span></label>
                                </div>
                                <div class="box-input-checkbox">
                                    <input class="inp-cbx" id="mobile-cx-series21" type="checkbox" style="display: none;" />
                                    <label class="cbx" for="mobile-cx-series21"><span>
                                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                            </svg></span><span>PJH</span></label>
                                </div>
                                <div class="box-input-checkbox">
                                    <input class="inp-cbx" id="mobile-cx-series22" type="checkbox" style="display: none;" />
                                    <label class="cbx" for="mobile-cx-series22"><span>
                                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                            </svg></span><span>Open Frame</span></label>
                                </div>
                                <div class="box-input-checkbox">
                                    <input class="inp-cbx" id="mobile-cx-series23" type="checkbox" style="display: none;" />
                                    <label class="cbx" for="mobile-cx-series23"><span>
                                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                            </svg></span><span>Enclosed</span></label>
                                </div>
                                <div class="box-input-checkbox">
                                    <input class="inp-cbx" id="mobile-cx-series24" type="checkbox" style="display: none;" />
                                    <label class="cbx" for="mobile-cx-series24"><span>
                                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                            </svg></span><span>IMA</span></label>
                                </div>
                                <div class="box-input-checkbox">
                                    <input class="inp-cbx" id="mobile-cx-series25" type="checkbox" style="display: none;" />
                                    <label class="cbx" for="mobile-cx-series25"><span>
                                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                            </svg></span><span>MDS ATX</span></label>
                                </div>
                                <div class="box-input-checkbox">
                                    <input class="inp-cbx" id="mobile-cx-series26" type="checkbox" style="display: none;" />
                                    <label class="cbx" for="mobile-cx-series26"><span>
                                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                            </svg></span><span>MDS / MEA Adapter</span></label>
                                </div>
                                <div class="box-input-checkbox">
                                    <input class="inp-cbx" id="mobile-cx-series27" type="checkbox" style="display: none;" />
                                    <label class="cbx" for="mobile-cx-series27"><span>
                                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                            </svg></span><span>Buffer Modules</span></label>
                                </div>
                            </div>
                                <button class="btn-reset" type="reset">CLEAR</button>
                            </form>
                        </div>
                        <div class="card-header-filter collapsed fliter_status " data-toggle="collapse"
                            data-parent="#accordion" href="#collapse-fliter_status_mobile">
                            <a class="card-title text-sixteen-dark">
                                STATUS
                            </a>
                        </div>
                        <div id="collapse-fliter_status_mobile" class="card-body-filter collapse" data-parent="#accordion">
                            <form >
                                <div class="box-input-checkbox">
                                    <input class="inp-cbx" id="mobile-cx-status1" type="checkbox" style="display: none;" />
                                    <label class="cbx" for="mobile-cx-status1"><span>
                                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                            </svg></span><span>NEW</span></label>
                                </div>
                                <div class="box-input-checkbox">
                                    <input class="inp-cbx" id="mobile-cx-status2" type="checkbox" style="display: none;" />
                                    <label class="cbx" for="mobile-cx-status2"><span>
                                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                            </svg></span><span>UPDATED</span></label>
                                </div>
                                <div class="box-input-checkbox">
                                    <input class="inp-cbx" id="mobile-cx-status3" type="checkbox" style="display: none;" />
                                    <label class="cbx" for="mobile-cx-status3"><span>
                                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                            </svg></span><span>EOL</span></label>
                                </div>
                                <button class="btn-reset" type="reset">CLEAR</button>
                            </form>
                        </div>
                        <div class="card-header-filter collapsed fliter_safety " data-toggle="collapse"
                            data-parent="#accordion" href="#collapse-fliter_safety_mobile">
                            <a class="card-title text-sixteen-dark">
                                SAFETY
                            </a>
                        </div>
                        <div id="collapse-fliter_safety_mobile" class="card-body-filter collapse" data-parent="#accordion">
                            <form >
                                <div class="scrollbar" id="style-1">
                                    <div class="force-overflow">
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="mobile-cx-safety1" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="mobile-cx-safety1"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>ABS</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="mobile-cx-safety2" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="mobile-cx-safety2"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>ATEX</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="mobile-cx-safety3" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="mobile-cx-safety3"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>BSMI</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="mobile-cx-safety4" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="mobile-cx-safety4"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>CB</span></label>
                                        </div>
                                        
                                    </div>
                                    
                                </div>
                                <button class="btn-reset" type="reset">CLEAR</button>
                            </form>
                        </div>
                        <div class="card-header-filter collapsed fliter_nominal-output-voltage " data-toggle="collapse"
                            data-parent="#accordion" href="#collapse-fliter_nominal-output-voltage_mobile">
                            <a class="card-title text-sixteen-dark">
                                NOMINAL OUTPUT VOLTAGE
                            </a>
                        </div>
                        <div id="collapse-fliter_nominal-output-voltage_mobile" class="has-nouislider card-body-filter collapse" data-parent="#accordion">
                            <form >
                                <div class="scrollbar" id="style-1">
                                    <div class="force-overflow">
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cbx12" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="cbx12"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>22 V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cbx6" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="cbx6"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>20 V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cbx7" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="cbx7"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>4.2V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cbx8" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="cbx8"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span> 5.1V, 12V, -15V, 15V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cbx9" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="cbx9"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>6V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cbx10" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="cbx10"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>12V, 12V, 5V, 3.3V, 5V, -5V, -12V</span></label>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn-reset" type="reset">CLEAR</button>
                             </form>
                             <div class="slidebar-value-box">
                                 <div id="slidebar-value-box1"class="slider noUi-target noUi-ltr noUi-horizontal"  ></div>
                                    <div class="value-form-bar-box"> 
                                        <span class="value-form-bar value-form-bar-min" id="slider-limit-value-min1"></span>
                                        <span class="value-form-bar value-form-bar-max"id="slider-limit-value-max1"></span>
                                    </div>
                             </div>
                             
                        </div>
                        <div class="card-header-filter collapsed fliter_output-current " data-toggle="collapse"
                            data-parent="#accordion" href="#collapse-fliter_output-current_mobile">
                            <a class="card-title text-sixteen-dark">
                                OUTPUT CURRENT
                            </a>
                        </div>
                        <div id="collapse-fliter_output-current_mobile" class="has-nouislider card-body-filter collapse" data-parent="#accordion">
                            <form >
                                <div class="scrollbar" id="style-1">
                                    <div class="force-overflow">
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cbx12-1" type="checkbox"
                                                style="display: none;" />
                                            <label class="cbx" for="cbx12-1"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>22 V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cbx6-1" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="cbx6-1"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>20 V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cbx7-1" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="cbx7-1"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>4.2V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cbx8-1" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="cbx8-1"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span> 5.1V, 12V, -15V, 15V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cbx9-1" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="cbx9-1"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>6V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cbx10-1" type="checkbox"
                                                style="display: none;" />
                                            <label class="cbx" for="cbx10-1"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>12V, 12V, 5V, 3.3V, 5V, -5V, -12V</span></label>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn-reset" type="reset">CLEAR</button>
                            </form>
                            <div class="slidebar-value-box">
                                    <div id="slidebar-value-box2"class="slider noUi-target noUi-ltr noUi-horizontal"  ></div>
                                       <div class="value-form-bar-box"> 
                                           <span class="value-form-bar value-form-bar-min" id="slider-limit-value-min2"></span>
                                           <span class="value-form-bar value-form-bar-max"id="slider-limit-value-max2"></span>
                                       </div>
                                </div>
                        </div>
                        <div class="card-header-filter collapsed fliter_output-power " data-toggle="collapse"
                            data-parent="#accordion" href="#collapse-fliter_output-power_mobile">
                            <a class="card-title text-sixteen-dark">
                                OUTPUT POWER
                            </a>
                        </div>
                        <div id="collapse-fliter_output-power_mobile" class="has-nouislider card-body-filter collapse" data-parent="#accordion">
                            <form >
                                <div class="scrollbar" id="style-1">
                                    <div class="force-overflow">
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cbx12-2" type="checkbox"
                                                style="display: none;" />
                                            <label class="cbx" for="cbx12-2"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>22 V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cbx6-2" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="cbx6-2"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>20 V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cbx7-2" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="cbx7-2"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>4.2V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cbx8-2" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="cbx8-2"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span> 5.1V, 12V, -15V, 15V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cbx9-2" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="cbx9-2"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>6V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cbx10-2" type="checkbox"
                                                style="display: none;" />
                                            <label class="cbx" for="cbx10-2"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>12V, 12V, 5V, 3.3V, 5V, -5V, -12V</span></label>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn-reset" type="reset">CLEAR</button>
                            </form>
                            <div class="slidebar-value-box">
                                <div id="slidebar-value-box3"class="slider noUi-target noUi-ltr noUi-horizontal"  ></div>
                                    <div class="value-form-bar-box"> 
                                        <span class="value-form-bar value-form-bar-min" id="slider-limit-value-min3"></span>
                                        <span class="value-form-bar value-form-bar-max"id="slider-limit-value-max3"></span>
                                    </div>
                            </div>
                        </div>
                        <div class="card-header-filter collapsed fliter_output-current-adjustment-range hide-box" data-toggle="collapse"
                            data-parent="#accordion" href="#collapse-fliter_output-current-adjustment-range_mobile">
                            <a class="card-title text-sixteen-dark">
                                OUTPUT CURRENT ADJUSTMENT RANGE
                            </a>
                        </div>
                        <div id="collapse-fliter_output-current-adjustment-range_mobile" class="has-nouislider card-body-filter collapse" data-parent="#accordion">
                            <form >
                                <div class="scrollbar" id="style-1">
                                    <div class="force-overflow">
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="mobile-cx-output-current-adjustment-range1" type="checkbox"
                                                style="display: none;" />
                                            <label class="cbx" for="mobile-cx-output-current-adjustment-range1"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>22 V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="mobile-cx-output-current-adjustment-range2" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="mobile-cx-output-current-adjustment-range2"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>20 V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="mobile-cx-output-current-adjustment-range3" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="mobile-cx-output-current-adjustment-range3"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>4.2V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="mobile-cx-output-current-adjustment-range4" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="mobile-cx-output-current-adjustment-range4"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span> 5.1V, 12V, -15V, 15V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="mobile-cx-output-current-adjustment-range5" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="mobile-cx-output-current-adjustment-range5"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>6V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="mobile-cx-output-current-adjustment-range6" type="checkbox"
                                                style="display: none;" />
                                            <label class="cbx" for="mobile-cx-output-current-adjustment-range6"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>12V, 12V, 5V, 3.3V, 5V, -5V, -12V</span></label>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn-reset" type="reset">CLEAR</button>
                            </form>
                            <div class="slidebar-value-box">
                                <div id="slidebar-value-box4"class="slider noUi-target noUi-ltr noUi-horizontal"  ></div>
                                    <div class="value-form-bar-box"> 
                                        <span class="value-form-bar value-form-bar-min" id="slider-limit-value-min4"></span>
                                        <span class="value-form-bar value-form-bar-max"id="slider-limit-value-max4"></span>
                                    </div>
                            </div>
                        </div>
                        <div class="card-header-filter collapsed fliter_max-output-voltage hide-box" data-toggle="collapse"
                            data-parent="#accordion" href="#collapse-fliter_max-output-voltage_mobile">
                            <a class="card-title text-sixteen-dark">
                                    MAX OUTPUT VOLTAGE    
                            </a>
                        </div>
                        <div id="collapse-fliter_max-output-voltage_mobile" class="has-nouislider card-body-filter collapse" data-parent="#accordion">
                            <form >
                                <div class="scrollbar" id="style-1">
                                    <div class="force-overflow">
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="mobile-cx-max-output-voltage1" type="checkbox"
                                                style="display: none;" />
                                            <label class="cbx" for="mobile-cx-max-output-voltage1"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>22 V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="mobile-cx-max-output-voltage2" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="mobile-cx-max-output-voltage2"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>20 V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="mobile-cx-max-output-voltage3" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="mobile-cx-max-output-voltage3"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>4.2V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="mobile-cx-max-output-voltage4" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="mobile-cx-max-output-voltage4"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span> 5.1V, 12V, -15V, 15V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="mobile-cx-max-output-voltage5" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="mobile-cx-max-output-voltage5"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>6V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="mobile-cx-max-output-voltage6" type="checkbox"
                                                style="display: none;" />
                                            <label class="cbx" for="mobile-cx-max-output-voltage6"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>12V, 12V, 5V, 3.3V, 5V, -5V, -12V</span></label>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn-reset" type="reset">CLEAR</button>
                            </form>
                            <div class="slidebar-value-box">
                                <div id="slidebar-value-box5"class="slider noUi-target noUi-ltr noUi-horizontal"  ></div>
                                    <div class="value-form-bar-box"> 
                                        <span class="value-form-bar value-form-bar-min" id="slider-limit-value-min5"></span>
                                        <span class="value-form-bar value-form-bar-max"id="slider-limit-value-max5"></span>
                                    </div>
                            </div>
                        </div>
                        <div class="card-header-filter collapsed fliter_hold-up-time hide-box"
                            data-toggle="collapse" data-parent="#accordion" href="#collapse-fliter_hold-up-time_mobile">
                            <a class="card-title text-sixteen-dark">
                                HOLD-UP TIME
                            </a>
                        </div>
                        <div id="collapse-fliter_hold-up-time_mobile" class="card-body-filter collapse" data-parent="#accordion">
                            <form >
                                <div class="scrollbar" id="style-1">
                                    <div class="force-overflow">
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="mobile-cx-hold-up-time1" type="checkbox"
                                                style="display: none;" />
                                            <label class="cbx" for="mobile-cx-hold-up-time1"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>22 V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="mobile-cx-hold-up-time2" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="mobile-cx-hold-up-time2"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>20 V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="mobile-cx-hold-up-time3" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="mobile-cx-hold-up-time3"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>4.2V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="mobile-cx-hold-up-time4" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="mobile-cx-hold-up-time4"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span> 5.1V, 12V, -15V, 15V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="mobile-cx-hold-up-time5" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="mobile-cx-hold-up-time5"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>6V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="mobile-cx-hold-up-time6" type="checkbox"
                                                style="display: none;" />
                                            <label class="cbx" for="mobile-cx-hold-up-time6"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>12V, 12V, 5V, 3.3V, 5V, -5V, -12V</span></label>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn-reset" type="reset">CLEAR</button>
                            </form>
                        </div>
                        <div class="card-header-filter collapsed fliter_output-voltage-range hide-box" data-toggle="collapse"
                            data-parent="#accordion" href="#collapse-fliter_output-voltage-range_mobile">
                            <a class="card-title text-sixteen-dark">
                                   OUTPUT VOLTAGE RANGE   
                            </a>
                        </div>
                        <div id="collapse-fliter_output-voltage-range_mobile" class="has-nouislider card-body-filter collapse" data-parent="#accordion">
                            <form >
                                <div class="scrollbar" id="style-1">
                                    <div class="force-overflow">
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="mobile-cx-output-voltage-range1" type="checkbox"
                                                style="display: none;" />
                                            <label class="cbx" for="mobile-cx-output-voltage-range1"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>22 V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="mobile-cx-output-voltage-range2" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="mobile-cx-output-voltage-range2"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>20 V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="mobile-cx-output-voltage-range3" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="mobile-cx-output-voltage-range3"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>4.2V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="mobile-cx-output-voltage-range4" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="mobile-cx-output-voltage-range4"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span> 5.1V, 12V, -15V, 15V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="mobile-cx-output-voltage-range5" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="mobile-cx-output-voltage-range5"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>6V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="mobile-cx-output-voltage-range6" type="checkbox"
                                                style="display: none;" />
                                            <label class="cbx" for="mobile-cx-output-voltage-range6"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>12V, 12V, 5V, 3.3V, 5V, -5V, -12V</span></label>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn-reset" type="reset">CLEAR</button>
                            </form>
                            <div class="slidebar-value-box">
                                <div id="slidebar-value-box6"class="slider noUi-target noUi-ltr noUi-horizontal"  ></div>
                                    <div class="value-form-bar-box"> 
                                        <span class="value-form-bar value-form-bar-min" id="slider-limit-value-min6"></span>
                                        <span class="value-form-bar value-form-bar-max"id="slider-limit-value-max6"></span>
                                    </div>
                            </div>
                        </div>
                        <div class="card-header-filter collapsed fliter_input-voltage-range "
                            data-toggle="collapse" data-parent="#accordion" href="#collapse-fliter_input-voltage-range_mobile">
                            <a class="card-title text-sixteen-dark">
                                INPUT VOLTAGE RANGE
                            </a>
                        </div>
                        <div id="collapse-fliter_input-voltage-range_mobile" class="card-body-filter collapse" data-parent="#accordion">
                            <form >
                                <div class="scrollbar" id="style-1">
                                    <div class="force-overflow">
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="mobile-cx-input-voltage-range1" type="checkbox"
                                                style="display: none;" />
                                            <label class="cbx" for="mobile-cx-input-voltage-range1"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>22 V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="mobile-cx-input-voltage-range2" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="mobile-cx-input-voltage-range2"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>20 V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="mobile-cx-input-voltage-range3" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="mobile-cx-input-voltage-range3"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>4.2V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="mobile-cx-input-voltage-range4" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="mobile-cx-input-voltage-range4"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span> 5.1V, 12V, -15V, 15V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="mobile-cx-input-voltage-range5" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="mobile-cx-input-voltage-range5"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>6V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="mobile-cx-input-voltage-range6" type="checkbox"
                                                style="display: none;" />
                                            <label class="cbx" for="mobile-cx-input-voltage-range6"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>12V, 12V, 5V, 3.3V, 5V, -5V, -12V</span></label>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn-reset" type="reset">CLEAR</button>
                            </form>
                        </div>
                        <div class="card-header-filter collapsed fliter_input-frequency-range hide-box" data-toggle="collapse"
                            data-parent="#accordion" href="#collapse-fliter_input-frequency-range_mobile">
                            <a class="card-title text-sixteen-dark">
                                    INPUT FREQUENCY RANGE
                            </a>
                        </div>
                        <div id="collapse-fliter_input-frequency-range_mobile" class="has-nouislider card-body-filter collapse" data-parent="#accordion">
                            <form >
                                <div class="scrollbar" id="style-1">
                                    <div class="force-overflow">
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="mobile-cx-input-frequency-range1" type="checkbox"
                                                style="display: none;" />
                                            <label class="cbx" for="mobile-cx-input-frequency-range1"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>22 V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="mobile-cx-input-frequency-range2" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="mobile-cx-input-frequency-range2"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>20 V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="mobile-cx-input-frequency-range3" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="mobile-cx-input-frequency-range3"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>4.2V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="mobile-cx-input-frequency-range4" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="mobile-cx-input-frequency-range4"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span> 5.1V, 12V, -15V, 15V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="mobile-cx-input-frequency-range5" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="mobile-cx-input-frequency-range5"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>6V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="mobile-cx-input-frequency-range6" type="checkbox"
                                                style="display: none;" />
                                            <label class="cbx" for="mobile-cx-input-frequency-range6"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>12V, 12V, 5V, 3.3V, 5V, -5V, -12V</span></label>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn-reset" type="reset">CLEAR</button>
                            </form>
                            <div class="slidebar-value-box">
                                <div id="slidebar-value-box7"class="slider noUi-target noUi-ltr noUi-horizontal"  ></div>
                                    <div class="value-form-bar-box"> 
                                        <span class="value-form-bar value-form-bar-min" id="slider-limit-value-min7"></span>
                                        <span class="value-form-bar value-form-bar-max"id="slider-limit-value-max7"></span>
                                    </div>
                            </div>
                        </div>
                        <div class="card-header-filter collapsed fliter_nominal-dc-input-voltage hide-box" data-toggle="collapse"
                            data-parent="#accordion" href="#collapse-fliter_nominal-dc-input-voltage_mobile">
                            <a class="card-title text-sixteen-dark">
                                    NOMINAL DC INPUT VOLTAGE
                            </a>
                        </div>
                        <div id="collapse-fliter_nominal-dc-input-voltage_mobile" class="has-nouislider card-body-filter collapse" data-parent="#accordion">
                            <form >
                                <div class="scrollbar" id="style-1">
                                    <div class="force-overflow">
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="mobile-cx-nominal-dc-input-voltage1" type="checkbox"
                                                style="display: none;" />
                                            <label class="cbx" for="mobile-cx-nominal-dc-input-voltage1"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>22 V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="mobile-cx-nominal-dc-input-voltage2" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="mobile-cx-nominal-dc-input-voltage2"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>20 V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="mobile-cx-nominal-dc-input-voltage3" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="mobile-cx-nominal-dc-input-voltage3"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>4.2V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="mobile-cx-nominal-dc-input-voltage4" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="mobile-cx-nominal-dc-input-voltage4"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span> 5.1V, 12V, -15V, 15V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="mobile-cx-nominal-dc-input-voltage5" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="mobile-cx-nominal-dc-input-voltage5"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>6V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="mobile-cx-nominal-dc-input-voltage6" type="checkbox"
                                                style="display: none;" />
                                            <label class="cbx" for="mobile-cx-nominal-dc-input-voltage6"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>12V, 12V, 5V, 3.3V, 5V, -5V, -12V</span></label>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn-reset" type="reset">CLEAR</button>
                            </form>
                            <div class="slidebar-value-box">
                                <div id="slidebar-value-box8"class="slider noUi-target noUi-ltr noUi-horizontal"  ></div>
                                    <div class="value-form-bar-box"> 
                                        <span class="value-form-bar value-form-bar-min" id="slider-limit-value-min8"></span>
                                        <span class="value-form-bar value-form-bar-max"id="slider-limit-value-max8"></span>
                                    </div>
                            </div>
                        </div>
                        <div class="card-header-filter collapsed fliter_safety certificate hide-box"
                            data-toggle="collapse" data-parent="#accordion" href="#collapse-fliter_safety-certificate_mobile">
                            <a class="card-title text-sixteen-dark">
                                    SAFETY CERTIFICATE
                            </a>
                        </div>
                        <div id="collapse-fliter_safety-certificate_mobile" class="card-body-filter collapse" data-parent="#accordion">
                            <form >
                                <div class="scrollbar" id="style-1">
                                    <div class="force-overflow">
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="mobile-cx-safety-certificate1" type="checkbox"
                                                style="display: none;" />
                                            <label class="cbx" for="mobile-cx-safety-certificate1"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>22 V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="mobile-cx-safety-certificate2" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="mobile-cx-safety-certificate2"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>20 V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="mobile-cx-safety-certificate3" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="mobile-cx-safety-certificate3"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>4.2V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="mobile-cx-safety-certificate4" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="mobile-cx-safety-certificate4"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span> 5.1V, 12V, -15V, 15V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="mobile-cx-safety-certificate5" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="mobile-cx-safety-certificate5"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>6V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="mobile-cx-safety-certificate6" type="checkbox"
                                                style="display: none;" />
                                            <label class="cbx" for="mobile-cx-safety-certificate6"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>12V, 12V, 5V, 3.3V, 5V, -5V, -12V</span></label>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn-reset" type="reset">CLEAR</button>
                            </form>
                        </div>
                        
            </div>

                    <div class="box-btn-filters btn-box-use-filer text-center">
                        <button class="btn-filters btn-use-filer">USE FILTERS</button>
                    </div>
                    <div class="box-btn-filters btn-box-addremove-filer text-center">
                        <button class="btn-filters btn-addremove-filer" data-toggle="modal"
                            data-target="#btn-addremove-filer-model">ADD / REMOVE FILTER</button>
                    </div>
                    <div class="box-btn-filters btn-box-clear-filer text-center">
                        <button class="btn-filters btn-clear-filer">CLEAR FILTERS</button>
                    </div>
             </div>
        </div>
        
    </div>
</div>

<div class="container">
    <div class="count-products">
     <span id="countproduct"></span> products
    </div>
</div>
<div class="container">
    <!-- Modal -->
    <div class="modal fade" id="btn-addremove-filer-model" tabindex="-1" role="dialog"
        aria-labelledby="ModalLongTitle" aria-hidden="true" style="padding-right:0px !important;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title-cx" id="ModalLongTitle">Add / Remove Filters</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{-- Other --}}
                    <h6 class="title-cx" style="margin-top: 10px;">Other</h6>
                    <hr>
                    {{-- type --}}
                    {{-- <input type="checkbox" data-id="fliter_type" id="fliter_type" value="fliter_type"
                        class="inp-cbx checkfilter1" style="display: none;">
                    <label class="cbx" for="fliter_type"><span>
                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                            </svg></span><span>Type</span></label> --}}
                    {{-- Series --}}
                    <input type="checkbox" data-id="fliter_series" id="fliter_series" value="fliter_series"
                        class="inp-cbx checkfilter2" style="display: none;">
                    <label class="cbx" for="fliter_series"><span>
                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                            </svg></span><span>Series</span></label>
                    {{-- Status --}}
                    <input type="checkbox" data-id="fliter_status" id="fliter_status" value="fliter_status"
                        class="inp-cbx checkfilter3" style="display: none;">
                    <label class="cbx" for="fliter_status"><span>
                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                            </svg></span><span>Status</span></label>
                    {{-- Safety --}}
                    <input type="checkbox" data-id="fliter_safety" id="fliter_safety" value="fliter_safety"
                        class="inp-cbx checkfilter4" style="display: none;">
                    <label class="cbx" for="fliter_safety"><span>
                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                            </svg></span><span>Safety</span></label>
                    {{-- Output Ratings / Characteristics --}}
                    <h6 class="title-cx">Output Ratings / Characteristics</h6>
                    <hr>
                    {{-- Nominal Output Voltage --}}
                    <input type="checkbox" data-id="fliter_nominal-output-voltage" id="fliter_nominal-output-voltage"
                        value="fliter_nominal-output-voltage" class="inp-cbx checkfilter5" style="display: none;">
                    <label class="cbx" for="fliter_nominal-output-voltage"><span>
                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                            </svg></span><span>Nominal Output Voltage</span></label>
                    {{-- Output Current --}}
                    <input type="checkbox" data-id="fliter_output-current" id="fliter_output-current"
                        value="fliter_output-current" class="inp-cbx checkfilter6" style="display: none;">
                    <label class="cbx" for="fliter_output-current"><span>
                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                            </svg></span><span>Output Current</span></label>
                    {{-- Output Power --}}
                    <input type="checkbox" data-id="fliter_output-power" id="fliter_output-power"
                        value="fliter_output-power" class="inp-cbx checkfilter7" style="display: none;">
                    <label class="cbx" for="fliter_output-power"><span>
                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                            </svg></span><span>Output Power</span></label>
                    {{-- Output Current Adjustment Range --}}
                    <input type="checkbox" data-id="fliter_output-current-adjustment-range"
                        id="fliter_output-current-adjustment-range" value="fliter_output-current-adjustment-range"
                        class="inp-cbx checkfilter8" style="display: none;">
                    <label class="cbx" for="fliter_output-current-adjustment-range"><span>
                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                            </svg></span><span>Output Current Adjustment Range</span></label>
                    {{-- Max Output Voltage --}}
                    <input type="checkbox" data-id="fliter_max-output-voltage" id="fliter_max-output-voltage"
                        value="fliter_max-output-voltage" class="inp-cbx checkfilter9" style="display: none;">
                    <label class="cbx" for="fliter_max-output-voltage"><span>
                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                            </svg></span><span>Max Output Voltage</span></label>
                    {{-- Hold-up Time --}}
                    <input type="checkbox" data-id="fliter_hold-up-time" id="fliter_hold-up-time"
                        value="fliter_hold-up-time" class="inp-cbx checkfilter10" style="display: none;">
                    <label class="cbx" for="fliter_hold-up-time"><span>
                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                            </svg></span><span>Hold-up Time</span></label>
                    {{-- Output Voltage Rang --}}
                    <input type="checkbox" data-id="fliter_output-voltage-range" id="fliter_output-voltage-range"
                        value="fliter_output-voltage-range" class="inp-cbx checkfilter11" style="display: none;">
                    <label class="cbx" for="fliter_output-voltage-range"><span>
                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                            </svg></span><span>Output Voltage Rang</span></label>
                    {{-- Input Ratings / Characteristics --}}
                    <h6 class="title-cx">Input Ratings / Characteristics</h6>
                    <hr>
                    <input type="checkbox" data-id="fliter_input-voltage-range" id="fliter_input-voltage-range"
                        value="fliter_input-voltage-range" class="inp-cbx checkfilter12" style="display: none;">
                    <label class="cbx" for="fliter_input-voltage-range"><span>
                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                            </svg></span><span>Input Voltage Range</span></label>
                    {{-- Input Frequency Range --}}
                    <input type="checkbox" data-id="fliter_input-frequency-range" id="fliter_input-frequency-range"
                        value="fliter_input-frequency-range" class="inp-cbx checkfilter13" style="display: none;">
                    <label class="cbx" for="fliter_input-frequency-range"><span>
                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                            </svg></span><span>Input Frequency Range</span></label>
                    {{-- Nominal DC Input Voltage --}}
                    <input type="checkbox" data-id="fliter_nominal-dc-input-voltage"
                        id="fliter_nominal-dc-input-voltage" value="fliter_nominal-dc-input-voltage"
                        class="inp-cbx checkfilter14" style="display: none;">
                    <label class="cbx" for="fliter_nominal-dc-input-voltage"><span>
                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                            </svg></span><span>Nominal DC Input Voltager</span></label>
                    {{-- Safety Standards / Directives --}}
                    <h6 class="title-cx">Safety Standards / Directives</h6>
                    <hr>
                    <input type="checkbox" data-id="fliter_safety-certificate" id="fliter_safety-certificate"
                        value="fliter_safety-certificate" class="inp-cbx checkfilter15" style="display: none;">
                    <label class="cbx" for="fliter_safety-certificate"><span>
                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                            </svg></span><span>Safety Certificate</span></label>

                </div>
                <div class="modal-footer">
                    <span disabled="disabled" data-dismiss="modal" class="btn btn-sm btn-primary reset">Reset</span>
                    <span data-dismiss="modal" class="btn btn-sm btn-primary btn-done">Done</span>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-xl-3 col-lg-12 col-md-12 col-xs-1 p-l-0 p-r-0 collapse in" id="sidebar">
            <div class="list-group panel">
                <div id="accordion" class="accordion visible-upper-mobile">
                    <div class="search-filter">
                        <div class="search-filter-action border-2px">
                            <p class="text-sixteen-dark">SEARCH BY MODEL NAME</p>
                            <div class="box-search-filter ">
                                <div class="box-search-filters-icon ">
                                    <img src="{{asset('frontend-asset/image/search-filters-icon.svg')}}" alt="">
                                    {{--            <i class="fa fa-search"></i> --}}
                                </div>
                                <label for="searchinput-filters" class="searchinput-filters">
                                    <input type="text" id="searchinput-filters" placeholder="SEARCH BY MODEL NAME">
                                </label>


                            </div>
                            <div class="search-filter-action-btn text-center">
                                <button class="btn-filters btn-search">SEARCH</button>
                            </div>
                            

                        </div>
                    </div>
                    <div id="sort-filter-content" class="tap-filter mb-0">
                        {{-- type --}}
                        {{-- <div class="card-header-filter collapsed fliter_type hide-box" data-toggle="collapse"
                            data-parent="#accordion" href="#collapse-fliter_type">
                            <a class="card-title text-sixteen-dark">
                                TYPE
                            </a>
                        </div> --}}
                        {{-- <div id="collapse-fliter_type" class="card-body-filter collapse" data-parent="#accordion">
                            <form >
                                <div class="scrollbar" id="style-1">
                                    <div class="force-overflow">
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cx-type1 " type="checkbox"
                                                style="display: none;" />
                                            <label class="cbx" for="cx-type1 "><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>DIN Rail Power Supply</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cx-type2 " type="checkbox"
                                                style="display: none;" />
                                            <label class="cbx" for="cx-type2 "><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>Panel Mount Power Supply</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cx-type3 " type="checkbox"
                                                style="display: none;" />
                                            <label class="cbx" for="cx-type3 "><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>Open Frame Power Supply</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cx-type4 " type="checkbox"
                                                style="display: none;" />
                                            <label class="cbx" for="cx-type4 "><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>Medical Power Solution</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cx-type5 " type="checkbox"
                                                style="display: none;" />
                                            <label class="cbx" for="cx-type5 "><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>Modules</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cx-type6 " type="checkbox"
                                                style="display: none;" />
                                            <label class="cbx" for="cx-type6 "><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>LED Driver</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cx-type7 " type="checkbox"
                                                style="display: none;" />
                                            <label class="cbx" for="cx-type7 "><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>Configurable Power Supply</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cx-type8 " type="checkbox"
                                                style="display: none;" />
                                            <label class="cbx" for="cx-type8 "><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>Adapter</span></label>
                                        </div>

                                    </div>
                                </div>
                                <button class="btn-reset" type="reset">CLEAR</button>
                            </form>
                        </div> --}}
                        
                        {{-- <div class="card-header-filter collapsed fliter_series" data-toggle="collapse"
                            href="#collapse-fliter_series">
                            <a class="card-title text-sixteen-dark">
                                SERIES
                            </a>
                        </div>
                        <div id="collapse-fliter_series" class="card-body-filter collapse" data-parent="#accordion">
                            <form >
                                <div class="scrollbar" id="style-1">
                                <div class="box-input-checkbox">
                                    <input class="inp-cbx" id="cx-series1" type="checkbox" style="display: none;" />
                                    <label class="cbx" for="cx-series1"><span>
                                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                            </svg></span><span>CliQ</span></label>
                                </div>
                                <div class="box-input-checkbox">
                                    <input class="inp-cbx" id="cx-series2" type="checkbox" style="display: none;" />
                                    <label class="cbx" for="cx-series2"><span>
                                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                            </svg></span><span>CliQ II</span></label>
                                </div>
                                <div class="box-input-checkbox">
                                    <input class="inp-cbx" id="cx-series3" type="checkbox" style="display: none;" />
                                    <label class="cbx" for="cx-series3"><span>
                                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                            </svg></span><span>CliQ III</span></label>
                                </div>
                                <div class="box-input-checkbox">
                                    <input class="inp-cbx" id="cx-series4" type="checkbox" style="display: none;" />
                                    <label class="cbx" for="cx-series4"><span>
                                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                            </svg></span><span> CliQ M</span></label>
                                </div>
                                <div class="box-input-checkbox">
                                    <input class="inp-cbx" id="cx-series5" type="checkbox" style="display: none;" />
                                    <label class="cbx" for="cx-series5"><span>
                                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                            </svg></span><span>CliQ VA</span></label>
                                </div>
                                <div class="box-input-checkbox">
                                    <input class="inp-cbx" id="cx-series6" type="checkbox" style="display: none;" />
                                    <label class="cbx" for="cx-series6"><span>
                                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                            </svg></span><span>Lyte</span></label>
                                </div>
                                <div class="box-input-checkbox">
                                    <input class="inp-cbx" id="cx-series7" type="checkbox" style="display: none;" />
                                    <label class="cbx" for="cx-series7"><span>
                                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                            </svg></span><span>Chrome</span></label>
                                </div>
                                <div class="box-input-checkbox">
                                    <input class="inp-cbx" id="cx-series8" type="checkbox" style="display: none;" />
                                    <label class="cbx" for="cx-series8"><span>
                                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                            </svg></span><span>Sync</span></label>
                                </div>
                                <div class="box-input-checkbox">
                                    <input class="inp-cbx" id="cx-series9" type="checkbox" style="display: none;" />
                                    <label class="cbx" for="cx-series9"><span>
                                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                            </svg></span><span>PMC</span></label>
                                </div>
                                <div class="box-input-checkbox">
                                    <input class="inp-cbx" id="cx-series10" type="checkbox" style="display: none;" />
                                    <label class="cbx" for="cx-series10"><span>
                                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                            </svg></span><span>PMT</span></label>
                                </div>
                                <div class="box-input-checkbox">
                                    <input class="inp-cbx" id="cx-series11" type="checkbox" style="display: none;" />
                                    <label class="cbx" for="cx-series11"><span>
                                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                            </svg></span><span>PMT2</span></label>
                                </div>
                                <div class="box-input-checkbox">
                                    <input class="inp-cbx" id="cx-series12" type="checkbox" style="display: none;" />
                                    <label class="cbx" for="cx-series12"><span>
                                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                            </svg></span><span>PMF</span></label>
                                </div>
                                <div class="box-input-checkbox">
                                    <input class="inp-cbx" id="cx-series13" type="checkbox" style="display: none;" />
                                    <label class="cbx" for="cx-series13"><span>
                                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                            </svg></span><span>PMH</span></label>
                                </div>
                                <div class="box-input-checkbox">
                                    <input class="inp-cbx" id="cx-series14" type="checkbox" style="display: none;" />
                                    <label class="cbx" for="cx-series14"><span>
                                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                            </svg></span><span>PMR</span></label>
                                </div>
                                <div class="box-input-checkbox">
                                    <input class="inp-cbx" id="cx-series15" type="checkbox" style="display: none;" />
                                    <label class="cbx" for="cx-series15"><span>
                                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                            </svg></span><span>PMU</span></label>
                                </div>
                                <div class="box-input-checkbox">
                                    <input class="inp-cbx" id="cx-series16" type="checkbox" style="display: none;" />
                                    <label class="cbx" for="cx-series16"><span>
                                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                            </svg></span><span>PJ</span></label>
                                </div>
                                <div class="box-input-checkbox">
                                    <input class="inp-cbx" id="cx-series17" type="checkbox" style="display: none;" />
                                    <label class="cbx" for="cx-series17"><span>
                                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                            </svg></span><span>PJB</span></label>
                                </div>
                                <div class="box-input-checkbox">
                                    <input class="inp-cbx" id="cx-series18" type="checkbox" style="display: none;" />
                                    <label class="cbx" for="cx-series18"><span>
                                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                            </svg></span><span>PJT</span></label>
                                </div>
                                <div class="box-input-checkbox">
                                    <input class="inp-cbx" id="cx-series19" type="checkbox" style="display: none;" />
                                    <label class="cbx" for="cx-series19"><span>
                                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                            </svg></span><span>PJU</span></label>
                                </div>
                                <div class="box-input-checkbox">
                                    <input class="inp-cbx" id="cx-series20" type="checkbox" style="display: none;" />
                                    <label class="cbx" for="cx-series20"><span>
                                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                            </svg></span><span>PJL</span></label>
                                </div>
                                <div class="box-input-checkbox">
                                    <input class="inp-cbx" id="cx-series21" type="checkbox" style="display: none;" />
                                    <label class="cbx" for="cx-series21"><span>
                                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                            </svg></span><span>PJH</span></label>
                                </div>
                                <div class="box-input-checkbox">
                                    <input class="inp-cbx" id="cx-series22" type="checkbox" style="display: none;" />
                                    <label class="cbx" for="cx-series22"><span>
                                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                            </svg></span><span>Open Frame</span></label>
                                </div>
                                <div class="box-input-checkbox">
                                    <input class="inp-cbx" id="cx-series23" type="checkbox" style="display: none;" />
                                    <label class="cbx" for="cx-series23"><span>
                                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                            </svg></span><span>Enclosed</span></label>
                                </div>
                                <div class="box-input-checkbox">
                                    <input class="inp-cbx" id="cx-series24" type="checkbox" style="display: none;" />
                                    <label class="cbx" for="cx-series24"><span>
                                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                            </svg></span><span>IMA</span></label>
                                </div>
                                <div class="box-input-checkbox">
                                    <input class="inp-cbx" id="cx-series25" type="checkbox" style="display: none;" />
                                    <label class="cbx" for="cx-series25"><span>
                                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                            </svg></span><span>MDS ATX</span></label>
                                </div>
                                <div class="box-input-checkbox">
                                    <input class="inp-cbx" id="cx-series26" type="checkbox" style="display: none;" />
                                    <label class="cbx" for="cx-series26"><span>
                                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                            </svg></span><span>MDS / MEA Adapter</span></label>
                                </div>
                                <div class="box-input-checkbox">
                                    <input class="inp-cbx" id="cx-series27" type="checkbox" style="display: none;" />
                                    <label class="cbx" for="cx-series27"><span>
                                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                            </svg></span><span>Buffer Modules</span></label>
                                </div>
                            </div>
                                <button class="btn-reset" type="reset">CLEAR</button>
                            </form>
                        </div>
                        <div class="card-header-filter collapsed fliter_status " data-toggle="collapse"
                            data-parent="#accordion" href="#collapse-fliter_status">
                            <a class="card-title text-sixteen-dark">
                                STATUS
                            </a>
                        </div>
                        <div id="collapse-fliter_status" class="card-body-filter collapse" data-parent="#accordion">
                            <form >
                                <div class="box-input-checkbox">
                                    <input class="inp-cbx" id="cx-status1" type="checkbox" style="display: none;" />
                                    <label class="cbx" for="cx-status1"><span>
                                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                            </svg></span><span>NEW</span></label>
                                </div>
                                <div class="box-input-checkbox">
                                    <input class="inp-cbx" id="cx-status2" type="checkbox" style="display: none;" />
                                    <label class="cbx" for="cx-status2"><span>
                                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                            </svg></span><span>UPDATED</span></label>
                                </div>
                                <div class="box-input-checkbox">
                                    <input class="inp-cbx" id="cx-status3" type="checkbox" style="display: none;" />
                                    <label class="cbx" for="cx-status3"><span>
                                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                            </svg></span><span>EOL</span></label>
                                </div>
                                <button class="btn-reset" type="reset">CLEAR</button>
                            </form>
                        </div>
                        <div class="card-header-filter collapsed fliter_safety " data-toggle="collapse"
                            data-parent="#accordion" href="#collapse-fliter_safety">
                            <a class="card-title text-sixteen-dark">
                                SAFETY
                            </a>
                        </div>
                        <div id="collapse-fliter_safety" class="card-body-filter collapse" data-parent="#accordion">
                            <form >
                                <div class="scrollbar" id="style-1">
                                    <div class="force-overflow">
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cx-safety1" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="cx-safety1"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>ABS</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cx-safety2" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="cx-safety2"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>ATEX</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cx-safety3" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="cx-safety3"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>BSMI</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cx-safety4" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="cx-safety4"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>CB</span></label>
                                        </div>
                                        
                                    </div>
                                    
                                </div>
                                <button class="btn-reset" type="reset">CLEAR</button>
                            </form>
                        </div>
                        <div class="card-header-filter collapsed fliter_nominal-output-voltage " data-toggle="collapse"
                            data-parent="#accordion" href="#collapse-fliter_nominal-output-voltage">
                            <a class="card-title text-sixteen-dark">
                                NOMINAL OUTPUT VOLTAGE
                            </a>
                        </div>
                        <div id="collapse-fliter_nominal-output-voltage" class="has-nouislider card-body-filter collapse" data-parent="#accordion">
                            <form >
                                <div class="scrollbar" id="style-1">
                                    <div class="force-overflow">
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cbx12" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="cbx12"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>22 V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cbx6" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="cbx6"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>20 V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cbx7" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="cbx7"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>4.2V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cbx8" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="cbx8"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span> 5.1V, 12V, -15V, 15V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cbx9" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="cbx9"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>6V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cbx10" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="cbx10"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>12V, 12V, 5V, 3.3V, 5V, -5V, -12V</span></label>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn-reset" type="reset">CLEAR</button>
                             </form>
                             <div class="slidebar-value-box">
                                 <div id="slidebar-value-box1"class="slider noUi-target noUi-ltr noUi-horizontal"  ></div>
                                    <div class="value-form-bar-box"> 
                                        <span class="value-form-bar value-form-bar-min" id="slider-limit-value-min1"></span>
                                        <span class="value-form-bar value-form-bar-max"id="slider-limit-value-max1"></span>
                                    </div>
                             </div>
                             
                        </div>
                        <div class="card-header-filter collapsed fliter_output-current " data-toggle="collapse"
                            data-parent="#accordion" href="#collapse-fliter_output-current">
                            <a class="card-title text-sixteen-dark">
                                OUTPUT CURRENT
                            </a>
                        </div>
                        <div id="collapse-fliter_output-current" class="has-nouislider card-body-filter collapse" data-parent="#accordion">
                            <form >
                                <div class="scrollbar" id="style-1">
                                    <div class="force-overflow">
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cbx12-1" type="checkbox"
                                                style="display: none;" />
                                            <label class="cbx" for="cbx12-1"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>22 V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cbx6-1" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="cbx6-1"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>20 V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cbx7-1" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="cbx7-1"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>4.2V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cbx8-1" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="cbx8-1"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span> 5.1V, 12V, -15V, 15V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cbx9-1" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="cbx9-1"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>6V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cbx10-1" type="checkbox"
                                                style="display: none;" />
                                            <label class="cbx" for="cbx10-1"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>12V, 12V, 5V, 3.3V, 5V, -5V, -12V</span></label>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn-reset" type="reset">CLEAR</button>
                            </form>
                            <div class="slidebar-value-box">
                                    <div id="slidebar-value-box2"class="slider noUi-target noUi-ltr noUi-horizontal"  ></div>
                                       <div class="value-form-bar-box"> 
                                           <span class="value-form-bar value-form-bar-min" id="slider-limit-value-min2"></span>
                                           <span class="value-form-bar value-form-bar-max"id="slider-limit-value-max2"></span>
                                       </div>
                                </div>
                        </div>
                        <div class="card-header-filter collapsed fliter_output-power " data-toggle="collapse"
                            data-parent="#accordion" href="#collapse-fliter_output-power">
                            <a class="card-title text-sixteen-dark">
                                OUTPUT POWER
                            </a>
                        </div>
                        <div id="collapse-fliter_output-power" class="has-nouislider card-body-filter collapse" data-parent="#accordion">
                            <form >
                                <div class="scrollbar" id="style-1">
                                    <div class="force-overflow">
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cbx12-2" type="checkbox"
                                                style="display: none;" />
                                            <label class="cbx" for="cbx12-2"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>22 V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cbx6-2" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="cbx6-2"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>20 V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cbx7-2" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="cbx7-2"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>4.2V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cbx8-2" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="cbx8-2"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span> 5.1V, 12V, -15V, 15V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cbx9-2" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="cbx9-2"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>6V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cbx10-2" type="checkbox"
                                                style="display: none;" />
                                            <label class="cbx" for="cbx10-2"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>12V, 12V, 5V, 3.3V, 5V, -5V, -12V</span></label>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn-reset" type="reset">CLEAR</button>
                            </form>
                            <div class="slidebar-value-box">
                                <div id="slidebar-value-box3"class="slider noUi-target noUi-ltr noUi-horizontal"  ></div>
                                    <div class="value-form-bar-box"> 
                                        <span class="value-form-bar value-form-bar-min" id="slider-limit-value-min3"></span>
                                        <span class="value-form-bar value-form-bar-max"id="slider-limit-value-max3"></span>
                                    </div>
                            </div>
                        </div>
                        <div class="card-header-filter collapsed fliter_output-current-adjustment-range hide-box" data-toggle="collapse"
                            data-parent="#accordion" href="#collapse-fliter_output-current-adjustment-range">
                            <a class="card-title text-sixteen-dark">
                                OUTPUT CURRENT ADJUSTMENT RANGE
                            </a>
                        </div>
                        <div id="collapse-fliter_output-current-adjustment-range" class="has-nouislider card-body-filter collapse" data-parent="#accordion">
                            <form >
                                <div class="scrollbar" id="style-1">
                                    <div class="force-overflow">
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cx-output-current-adjustment-range1" type="checkbox"
                                                style="display: none;" />
                                            <label class="cbx" for="cx-output-current-adjustment-range1"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>22 V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cx-output-current-adjustment-range2" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="cx-output-current-adjustment-range2"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>20 V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cx-output-current-adjustment-range3" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="cx-output-current-adjustment-range3"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>4.2V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cx-output-current-adjustment-range4" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="cx-output-current-adjustment-range4"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span> 5.1V, 12V, -15V, 15V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cx-output-current-adjustment-range5" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="cx-output-current-adjustment-range5"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>6V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cx-output-current-adjustment-range6" type="checkbox"
                                                style="display: none;" />
                                            <label class="cbx" for="cx-output-current-adjustment-range6"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>12V, 12V, 5V, 3.3V, 5V, -5V, -12V</span></label>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn-reset" type="reset">CLEAR</button>
                            </form>
                            <div class="slidebar-value-box">
                                <div id="slidebar-value-box4"class="slider noUi-target noUi-ltr noUi-horizontal"  ></div>
                                    <div class="value-form-bar-box"> 
                                        <span class="value-form-bar value-form-bar-min" id="slider-limit-value-min4"></span>
                                        <span class="value-form-bar value-form-bar-max"id="slider-limit-value-max4"></span>
                                    </div>
                            </div>
                        </div>
                        <div class="card-header-filter collapsed fliter_max-output-voltage hide-box" data-toggle="collapse"
                            data-parent="#accordion" href="#collapse-fliter_max-output-voltage">
                            <a class="card-title text-sixteen-dark">
                                    MAX OUTPUT VOLTAGE    
                            </a>
                        </div>
                        <div id="collapse-fliter_max-output-voltage" class="has-nouislider card-body-filter collapse" data-parent="#accordion">
                            <form >
                                <div class="scrollbar" id="style-1">
                                    <div class="force-overflow">
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cx-max-output-voltage1" type="checkbox"
                                                style="display: none;" />
                                            <label class="cbx" for="cx-max-output-voltage1"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>22 V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cx-max-output-voltage2" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="cx-max-output-voltage2"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>20 V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cx-max-output-voltage3" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="cx-max-output-voltage3"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>4.2V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cx-max-output-voltage4" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="cx-max-output-voltage4"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span> 5.1V, 12V, -15V, 15V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cx-max-output-voltage5" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="cx-max-output-voltage5"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>6V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cx-max-output-voltage6" type="checkbox"
                                                style="display: none;" />
                                            <label class="cbx" for="cx-max-output-voltage6"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>12V, 12V, 5V, 3.3V, 5V, -5V, -12V</span></label>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn-reset" type="reset">CLEAR</button>
                            </form>
                            <div class="slidebar-value-box">
                                <div id="slidebar-value-box5"class="slider noUi-target noUi-ltr noUi-horizontal"  ></div>
                                    <div class="value-form-bar-box"> 
                                        <span class="value-form-bar value-form-bar-min" id="slider-limit-value-min5"></span>
                                        <span class="value-form-bar value-form-bar-max"id="slider-limit-value-max5"></span>
                                    </div>
                            </div>
                        </div>
                        <div class="card-header-filter collapsed fliter_hold-up-time hide-box"
                            data-toggle="collapse" data-parent="#accordion" href="#collapse-fliter_hold-up-time">
                            <a class="card-title text-sixteen-dark">
                                HOLD-UP TIME
                            </a>
                        </div>
                        <div id="collapse-fliter_hold-up-time" class="card-body-filter collapse" data-parent="#accordion">
                            <form >
                                <div class="scrollbar" id="style-1">
                                    <div class="force-overflow">
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cx-hold-up-time1" type="checkbox"
                                                style="display: none;" />
                                            <label class="cbx" for="cx-hold-up-time1"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>22 V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cx-hold-up-time2" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="cx-hold-up-time2"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>20 V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cx-hold-up-time3" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="cx-hold-up-time3"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>4.2V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cx-hold-up-time4" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="cx-hold-up-time4"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span> 5.1V, 12V, -15V, 15V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cx-hold-up-time5" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="cx-hold-up-time5"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>6V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cx-hold-up-time6" type="checkbox"
                                                style="display: none;" />
                                            <label class="cbx" for="cx-hold-up-time6"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>12V, 12V, 5V, 3.3V, 5V, -5V, -12V</span></label>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn-reset" type="reset">CLEAR</button>
                            </form>
                        </div>
                        <div class="card-header-filter collapsed fliter_output-voltage-range hide-box" data-toggle="collapse"
                            data-parent="#accordion" href="#collapse-fliter_output-voltage-range">
                            <a class="card-title text-sixteen-dark">
                                   OUTPUT VOLTAGE RANGE   
                            </a>
                        </div>
                        <div id="collapse-fliter_output-voltage-range" class="has-nouislider card-body-filter collapse" data-parent="#accordion">
                            <form >
                                <div class="scrollbar" id="style-1">
                                    <div class="force-overflow">
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cx-output-voltage-range1" type="checkbox"
                                                style="display: none;" />
                                            <label class="cbx" for="cx-output-voltage-range1"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>22 V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cx-output-voltage-range2" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="cx-output-voltage-range2"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>20 V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cx-output-voltage-range3" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="cx-output-voltage-range3"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>4.2V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cx-output-voltage-range4" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="cx-output-voltage-range4"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span> 5.1V, 12V, -15V, 15V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cx-output-voltage-range5" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="cx-output-voltage-range5"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>6V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cx-output-voltage-range6" type="checkbox"
                                                style="display: none;" />
                                            <label class="cbx" for="cx-output-voltage-range6"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>12V, 12V, 5V, 3.3V, 5V, -5V, -12V</span></label>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn-reset" type="reset">CLEAR</button>
                            </form>
                            <div class="slidebar-value-box">
                                <div id="slidebar-value-box6"class="slider noUi-target noUi-ltr noUi-horizontal"  ></div>
                                    <div class="value-form-bar-box"> 
                                        <span class="value-form-bar value-form-bar-min" id="slider-limit-value-min6"></span>
                                        <span class="value-form-bar value-form-bar-max"id="slider-limit-value-max6"></span>
                                    </div>
                            </div>
                        </div>
                        <div class="card-header-filter collapsed fliter_input-voltage-range "
                            data-toggle="collapse" data-parent="#accordion" href="#collapse-fliter_input-voltage-range">
                            <a class="card-title text-sixteen-dark">
                                INPUT VOLTAGE RANGE
                            </a>
                        </div>
                        <div id="collapse-fliter_input-voltage-range" class="card-body-filter collapse" data-parent="#accordion">
                            <form >
                                <div class="scrollbar" id="style-1">
                                    <div class="force-overflow">
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cx-input-voltage-range1" type="checkbox"
                                                style="display: none;" />
                                            <label class="cbx" for="cx-input-voltage-range1"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>22 V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cx-input-voltage-range2" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="cx-input-voltage-range2"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>20 V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cx-input-voltage-range3" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="cx-input-voltage-range3"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>4.2V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cx-input-voltage-range4" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="cx-input-voltage-range4"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span> 5.1V, 12V, -15V, 15V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cx-input-voltage-range5" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="cx-input-voltage-range5"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>6V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cx-input-voltage-range6" type="checkbox"
                                                style="display: none;" />
                                            <label class="cbx" for="cx-input-voltage-range6"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>12V, 12V, 5V, 3.3V, 5V, -5V, -12V</span></label>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn-reset" type="reset">CLEAR</button>
                            </form>
                        </div>
                        <div class="card-header-filter collapsed fliter_input-frequency-range hide-box" data-toggle="collapse"
                            data-parent="#accordion" href="#collapse-fliter_input-frequency-range">
                            <a class="card-title text-sixteen-dark">
                                    INPUT FREQUENCY RANGE
                            </a>
                        </div>
                        <div id="collapse-fliter_input-frequency-range" class="has-nouislider card-body-filter collapse" data-parent="#accordion">
                            <form >
                                <div class="scrollbar" id="style-1">
                                    <div class="force-overflow">
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cx-input-frequency-range1" type="checkbox"
                                                style="display: none;" />
                                            <label class="cbx" for="cx-input-frequency-range1"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>22 V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cx-input-frequency-range2" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="cx-input-frequency-range2"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>20 V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cx-input-frequency-range3" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="cx-input-frequency-range3"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>4.2V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cx-input-frequency-range4" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="cx-input-frequency-range4"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span> 5.1V, 12V, -15V, 15V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cx-input-frequency-range5" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="cx-input-frequency-range5"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>6V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cx-input-frequency-range6" type="checkbox"
                                                style="display: none;" />
                                            <label class="cbx" for="cx-input-frequency-range6"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>12V, 12V, 5V, 3.3V, 5V, -5V, -12V</span></label>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn-reset" type="reset">CLEAR</button>
                            </form>
                            <div class="slidebar-value-box">
                                <div id="slidebar-value-box7"class="slider noUi-target noUi-ltr noUi-horizontal"  ></div>
                                    <div class="value-form-bar-box"> 
                                        <span class="value-form-bar value-form-bar-min" id="slider-limit-value-min7"></span>
                                        <span class="value-form-bar value-form-bar-max"id="slider-limit-value-max7"></span>
                                    </div>
                            </div>
                        </div>
                        <div class="card-header-filter collapsed fliter_nominal-dc-input-voltage hide-box" data-toggle="collapse"
                            data-parent="#accordion" href="#collapse-fliter_nominal-dc-input-voltage">
                            <a class="card-title text-sixteen-dark">
                                    NOMINAL DC INPUT VOLTAGE
                            </a>
                        </div>
                        <div id="collapse-fliter_nominal-dc-input-voltage" class="has-nouislider card-body-filter collapse" data-parent="#accordion">
                            <form >
                                <div class="scrollbar" id="style-1">
                                    <div class="force-overflow">
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cx-nominal-dc-input-voltage1" type="checkbox"
                                                style="display: none;" />
                                            <label class="cbx" for="cx-nominal-dc-input-voltage1"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>22 V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cx-nominal-dc-input-voltage2" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="cx-nominal-dc-input-voltage2"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>20 V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cx-nominal-dc-input-voltage3" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="cx-nominal-dc-input-voltage3"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>4.2V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cx-nominal-dc-input-voltage4" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="cx-nominal-dc-input-voltage4"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span> 5.1V, 12V, -15V, 15V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cx-nominal-dc-input-voltage5" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="cx-nominal-dc-input-voltage5"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>6V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cx-nominal-dc-input-voltage6" type="checkbox"
                                                style="display: none;" />
                                            <label class="cbx" for="cx-nominal-dc-input-voltage6"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>12V, 12V, 5V, 3.3V, 5V, -5V, -12V</span></label>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn-reset" type="reset">CLEAR</button>
                            </form>
                            <div class="slidebar-value-box">
                                <div id="slidebar-value-box8"class="slider noUi-target noUi-ltr noUi-horizontal"  ></div>
                                    <div class="value-form-bar-box"> 
                                        <span class="value-form-bar value-form-bar-min" id="slider-limit-value-min8"></span>
                                        <span class="value-form-bar value-form-bar-max"id="slider-limit-value-max8"></span>
                                    </div>
                            </div>
                        </div>
                        <div class="card-header-filter collapsed fliter_safety certificate hide-box"
                            data-toggle="collapse" data-parent="#accordion" href="#collapse-fliter_safety-certificate">
                            <a class="card-title text-sixteen-dark">
                                    SAFETY CERTIFICATE
                            </a>
                        </div>
                        <div id="collapse-fliter_safety-certificate" class="card-body-filter collapse" data-parent="#accordion">
                            <form >
                                <div class="scrollbar" id="style-1">
                                    <div class="force-overflow">
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cx-safety-certificate1" type="checkbox"
                                                style="display: none;" />
                                            <label class="cbx" for="cx-safety-certificate1"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>22 V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cx-safety-certificate2" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="cx-safety-certificate2"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>20 V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cx-safety-certificate3" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="cx-safety-certificate3"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>4.2V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cx-safety-certificate4" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="cx-safety-certificate4"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span> 5.1V, 12V, -15V, 15V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cx-safety-certificate5" type="checkbox" style="display: none;" />
                                            <label class="cbx" for="cx-safety-certificate5"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>6V</span></label>
                                        </div>
                                        <div class="box-input-checkbox">
                                            <input class="inp-cbx" id="cx-safety-certificate6" type="checkbox"
                                                style="display: none;" />
                                            <label class="cbx" for="cx-safety-certificate6"><span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg></span><span>12V, 12V, 5V, 3.3V, 5V, -5V, -12V</span></label>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn-reset" type="reset">CLEAR</button>
                            </form>
                        </div> --}}
                        
                    </div>

                    <div class="box-btn-filters btn-box-use-filer text-center">
                        <button class="btn-filters btn-use-filer">USE FILTERS</button>
                    </div>
                    <div class="box-btn-filters btn-box-addremove-filer text-center">
                        <button class="btn-filters btn-addremove-filer" data-toggle="modal"
                            data-target="#btn-addremove-filer-model">ADD / REMOVE FILTER</button>
                    </div>
                    <div class="box-btn-filters btn-box-clear-filer text-center">
                        <button class="btn-filters btn-clear-filer">CLEAR FILTERS</button>
                    </div>
                </div>
            </div>
        </div>
        <main class="col-md-12 p-l-2 p-t-2" id="contentProList"></main>
    </div>
</div>
<input type="hidden" id="current_list_item" value="0">



@endsection


@section('js')

<script>
    $(document).ready(function () {
       
        $("#slide-banner-products-type").owlCarousel({
            navigation: true, // Show next and prev buttons
            slideSpeed: 300,
            paginationSpeed: 400,
            singleItem: true,

            // "singleItem:true" is a shortcut for:
            items: 1,
            // itemsDesktop : false,
            // itemsDesktopSmall : false,
            // itemsTablet: false,
            // itemsMobile : false

        });
    });

</script>


<script>
   
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
    $(document).ready(function () {
        $('.hide-box').hide();
        $("#fliter_status").prop('checked', true);
        $("#fliter_safety").prop('checked', true);
        $("#fliter_nominal-output-voltage").prop('checked', true);
        $("#fliter_output-current").prop('checked', true);
        $("#fliter_output-power").prop('checked', true);
        $("#fliter_input-voltage-range").prop('checked', true);

        $('.btn-done').click(function () {
            for (i = 0; i < 15; i++) {
                checkboxaddremove(i);
            }
        });
        $('.reset').click(function () {
            $('.modal-body input[type="checkbox"]').prop('checked', false);
            $("#fliter_status").prop('checked', true);
            $("#fliter_safety").prop('checked', true);
            $("#fliter_nominal-output-voltage").prop('checked', true);
            $("#fliter_output-current").prop('checked', true);
            $("#fliter_output-power").prop('checked', true);
            $("#fliter_input-voltage-range").prop('checked', true);
            for (i = 0; i < 15; i++) {
            checkboxaddremove(i);
            }
        });
        $('.btn-clear-filer').click(function () {
            $('.inp-cbx').prop('checked', false);
        });
    });
    
    function onclickshow(id) {
        var element = document.getElementById("contentProList");
        if ($("#sidebar").hasClass("show") == true) {
            $(element).toggleClass("col-xl-9 col-lg-12 col-md-12");
        } else {
            $(element).toggleClass("col-md-12 col-xl-9 col-lg-12");
        }
        if (id == 2) {

            var html = '';
            html =
                '<a href="#sidebar" data-toggle="collapse" onclick="onclickshow(1);" ><img src="{{asset('frontend-asset/image/icon/filter-icon.svg')}}" alt=""> Hide Filters</a>';
            document.getElementById("showfiler").innerHTML = html;

        } else {

            var html = '';
            html =
                '<a href="#sidebar" data-toggle="collapse" onclick="onclickshow(2);" ><img src="{{asset('frontend-asset/image/icon/filter-icon.svg')}}" alt="">Show Filters</a>';
            document.getElementById("showfiler").innerHTML = html;
        }

    }
       
    var products = <?= json_encode($products);?>;
    var product_has_property = <?= json_encode($product_has_property);?>;
    var filter_pro = <?= json_encode($filter_pro);?>;
    var domainUrl = '{{config('app.url')}}';
    var series_id = '{{$se_id}}';
    var series =  <?= json_encode($series);?>;
    var pro_perti = [];
    var ser_arr = [];
    var productFilter = [];
   
    $(document).ready(function () {
        loadAddContent();
        filtercontent();
        FristloadData();
    });
    function loadAddContent(){
        var arr = [];
        filter_pro.forEach(element => {
             if(element['field_id'] != 'series01' && element['field_id'] != 'status02' && element['field_id'] != 'safety03' && element['field_id'] != 'certifi04'  ){
                arr.push(element['field_id']);
             }
         });
        $.ajax({
           url: "{{route('loadPropoperty')}}",
           data: {
          'data': arr
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
          productObj['dimensionL'] = value['dimensionL'];
          productObj['dimensionW'] = value['dimensionW'];
          productObj['dimensionD'] = value['dimensionD'];
          productObj['content'] = [];
            $.each(product_has_property, function(index2,value2){
            if(value['pro_id'] == value2['product_id']){
                productObj['content'].push(value2);
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
          productObj['dimensionL'] = value['dimensionL'];
          productObj['dimensionW'] = value['dimensionW'];
          productObj['dimensionD'] = value['dimensionD'];
          productObj['content'] = [];
            $.each(product_has_property, function(index2,value2){
            if(value['pro_id'] == value2['product_id']){
                productObj['content'].push(value2);
            }
         });
         productarray.push(productObj);
        }
       
      });
      productarray.sort((a, b) => (a.pro_code > b.pro_code) ? 1 : -1);
      productFilter = productarray;
      $('#countproduct').text(productarray.length);
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
    //   var arraydata = loadData(products,product_has_property);
    //   onclickGridView(arraydata);
    //   $(".moreBox").slice(0, 12).show();
    //   $(".moreBox_mobile").slice(0, 12).show();
      $('#current_list_item').val(1);
      fillerData();
    }
    function fillerData(){
       productFilter = [];
      filterAllSeries()
      filerallCer();
      filerallStatus();
      filAllType();
      filAllTypeInputText();
   
    }
    function FristloadData(){
        var arraydata =  loadData(products,product_has_property);
        onclickListView(arraydata);
        $(".moreBox").slice(0, 12).show();
        $(".moreBox_mobile").slice(0, 12).show();
        $(".row_table").slice(0, 6).show();
    }
    function onclickListViewloadData(){
        $('#current_list_item').val(0);
        fillerData();
        // var arraydata =  loadData(products,product_has_property);
        // onclickListView(arraydata);
        // $(".moreBox").slice(0, 12).show();
        // $(".moreBox_mobile").slice(0, 12).show();
        // $(".row_table").slice(0, 6).show();
    }

    function onclickGridView(productarray) {
         $('#current_list_item').val(1);
        var html = '';
        html += '<div class="GridView visible-upper-mobile" id="GridView">';
        html += '<div class="margin-top-card">';
        html += '<div id="cardGridList" class="row w-100">';
        $.each(productarray, function(index_pro,pro){
        html += '<div class=" col-xl-3 col-lg-4 col-md-4">';
        html += '<div class=" margin-p-left-card item card moreBox"  style="display: none;">';
        if(pro['status_product'] != 1){
        html += '<div style="background-color:'+set_sta_color(pro['status_product']) +';" class="new-tag">'+statuspro(pro['status_product'])+'</div>';
        }
        html += '<div class="card-body ft-products-item"><img src="'+domainUrl+'/upload/thumbs/'+pro['picture']+'" class="product-cat" style="width:70%;">';
        html += '<div class="">';
        html += '<h5 class="text-title-ft">'+pro['pro_code']+'</h5>';
        html += '<div class="d-flex flex-wrap" >';
        html += '<div class="mr-3">';
        html += '<div class="out-volt">';
        html += '<p class="text-title-ft-sub">OUTPUT VOLTAGE</p>';
        var content = onlycontent(pro['content']);
        if(content[0]['data_1'] != null){
        html += '<div class="text-ft-sub">'+content[1]['data_1']+content[1]['unit_name']+'</div>';
        }else{
            html += '<div class="text-ft-sub">-</div>';
        } 
        html += '</div>';
        html += '<div class="out-power">';
        html += '<p class="text-title-ft-sub">OUTPUT POWER</p>';
        if(content[2]['data_1'] != null){
        html += '<div class="text-ft-sub">'+content[2]['data_1']+content[2]['unit_name']+'</div>';
        }else{
            html += '<div class="text-ft-sub">-</div>'; 
        }
        html += '</div>';
        html += '</div>';
        html += '<div class="">';
        html += '<div class="out-current">';
        html += '<p class="text-title-ft-sub">OUTPUT CURRENT</p>';
        if(content[1]['data_1'] != null){
        html += '<div class="text-ft-sub">'+content[0]['data_1']+content[0]['unit_name']+'</div>';
        }else{
            html += '<div class="text-ft-sub">-</div>'; 
        }
        html += '</div>';
        html += '<div class="in-volt">';
        html += '<p class="text-title-ft-sub">INPUT VOLTAGE</p>';
        if(content[3]['value_text'] != null){
        html += '<div class="text-ft-sub">'+content[3]['value_text'].substr(0, 14)+'...</div>';
        }else{
            html += '<div class="text-ft-sub">-</div>'; 
        }
        html += '</div>';
        html += '</div>';
        html += '</div>';
        html += '<div class="dimension">';
        html += '<p class="text-title-ft-sub">DIMENSION </p>';
        if(pro['dimensionL'].length < 7 && ['dimensionW'] != '' && pro['dimensionD'] != ''){
        html += '<p class="text-ft-sub">'+pro['dimensionL']+'x'+pro['dimensionW']+'x'+pro['dimensionD']+' mm</p>';
        html += '<p class="text-ft-sub">'+mmtonich(pro['dimensionL'])+'”x'+mmtonich(pro['dimensionW'])+'”x'+mmtonich(pro['dimensionD'])+'”</p>';
        }else{
        html += '<p class="text-ft-sub">'+pro['dimensionL'].substr(0, 18)+'...</p>';
        }
        html += '</div>';
        html += '</div>';
        html += '<a href="#" class="btn btn-ft">+ ADD TO COMPARE</a>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
         });
        html += '</div>';
        html += '</div>';
        html += ' <div class="text-center mb-2" id="loadMore" style="" onclick="loadeMore(event,4)">';
        html += '<a href="#"  class="btn btn-boxen">SEE MORE</a>';
        html += '</div>';
        html += '</div>';
      

        html += '<div class="GridView visible-mobile-only mb-5" id="GridView">';
        html += '<div class="margin-top-card container">';
        html += '<div id="cardGridList" class="d-flex flex-wrap">';
            $.each(productarray, function(index_pro,pro){
        html += '<div class="margin-p-left-card col-md-6 moreBox_mobile"  style="display: none;">';
        html += '<div class="item card">';
            if(pro['status_product'] != 1){
        html += '<div style="background-color:'+set_sta_color(pro['status_product']) +';" class="new-tag">'+statuspro(pro['status_product'])+'</div>';
            }
        html += '<div class="card-body ft-products-item"><img src="'+domainUrl+'/upload/thumbs/'+pro['picture']+'" class="product-cat" style="width:70%;">';
        html += '<div class="">';
        html += '<h5 class="text-title-ft">'+pro['pro_code']+'</h5>';
        html += '<div class="d-flex flex-wrap" >';
        html += '<div class="mr-3">';
        html += '<div class="out-volt">';
            var content = onlycontent(pro['content']);
        html += '<p class="text-title-ft-sub">OUTPUT VOLTAGE</p>';
        if(content[1]['data_1'] != null){
        html += '<div class="text-ft-sub">'+content[1]['data_1']+content[1]['unit_name']+'</div>';
        }else{
        html += '<div class="text-ft-sub">-</div>';
        } 
        html += '</div>';
        html += '<div class="out-power">';
        html += '<p class="text-title-ft-sub">OUTPUT POWER</p>';
        if(content[2]['data_1'] != null){
        html += '<div class="text-ft-sub">'+content[2]['data_1']+content['unit_name']+'</div>';
        }else{
        html += '<div class="text-ft-sub">-</div>'; 
        }
        html += '</div>';
        html += '</div>';
        html += '<div class="">';
        html += '<div class="out-current">';
        html += '<p class="text-title-ft-sub">OUTPUT CURRENT</p>';
        if(content[0]['data_1'] != null){
        html += '<div class="text-ft-sub">'+content[0]['data_1']+content[0]['unit_name']+'</div>';
        }else{
        html += '<div class="text-ft-sub">-</div>'; 
        }
        html += '</div>';
        html += '<div class="in-volt">';
        html += '<p class="text-title-ft-sub">INPUT VOLTAGE</p>';
        if(content[3]['value_text'] != null){
        html += '<div class="text-ft-sub">'+content[3]['value_text'].substr(0, 18)+'</div>';
        }else{
        html += '<div class="text-ft-sub">-</div>'; 
        }
        html += '</div>';
        html += '</div>';
        html += '</div>';
        html += '<div class="dimension">';
        html += '<p class="text-title-ft-sub">DIMENSION</p>';
        if(pro['dimensionL'].length < 7 && pro['dimensionW'] != '' && pro['dimensionD'] != ''){
        html += '<p class="text-ft-sub">'+pro['dimensionL']+'x'+pro['dimensionW']+'x'+pro['dimensionD']+' mm</p>';
        html += '<p class="text-ft-sub">'+mmtonich(pro['dimensionL'])+'”x'+mmtonich(pro['dimensionW'])+'”x'+mmtonich(pro['dimensionD'])+'”</p>';
        }else{
        html += '<p class="text-ft-sub">'+pro['dimensionL'].substr(0, 12)+'...</p>';    
        }
        html += '</div>';
        html += '</div>';
        html += '</div>'; 
        html += '<a href="#" class="btn btn-ft rounded-0">+ ADD TO COMPARE</a>';
        html += '</div>';
        html += '</div>';
       });
        html += '</div>';
        html += '</div>';
        html += ' <div class="text-center mb-2" id="loadMore_mobile" style="" onclick="loadeMoreMobile(event,4)">';
        html += '<a href="#"  class="btn btn-boxen">SEE MORE</a>';
        html += '</div>';
        html += '</div>';
    
       

        $('#contentProList').html(html);
        $(document).ready(function () {
            $('.icon-grid img').addClass('bord-icon');
            $('.icon-list img').removeClass('bord-icon');
            $('#contentProList').removeClass('space-listviews');
        });
    }

    function onclickListView(productarray) {
        $('#current_list_item').val(0);
        var html1 = '';
        html1 += '<div class="ListView visible-upper-mobile" id="ListView">';
        html1 += '<table id="" class="table" cellspacing="5em" width="100%">';
        html1 += '<thead>';
        html1 += '<tr class="headder-bg-table">';
        html1 += '<th class="th-sm header-font-table" style="width:180px!important;">MODEL NAME</th>';
        html1 += '<th class="th-sm header-font-table text-center">OUTPUT VOLTAGE</th>';
        html1 += '<th class="th-sm header-font-table text-center">OUTPUT CURRENT</th>';
        html1 += '<th class="th-sm header-font-table text-center">OUTPUT POWER</th>';
        html1 += '<th class="th-sm header-font-table text-center">INPUT VOLTAGE</th>';
        html1 += '<th class="th-sm header-font-table w-25 text-center">DIMENSIONS (L X W X D)</th>';
        html1 += '</tr>';
        html1 += '</thead>';
        html1 += '<tbody id="listcardList">';
        html1 += '</tbody>';
        html1 += ' </table>';
        html1 += '</div>';
        html1 += ' <div class="text-center mb-2" id="loadlistview" style="" onclick="loadlistview(event,4)">';
        html1 += '<a href="#"  class="btn btn-boxen">SEE MORE</a>';
        html1 += '</div>';
        $('#contentProList').html(html1);
        listviewCard(productarray);
        $('#dtBasicExample').DataTable();
        $('.dataTables_length').addClass('bs-select');
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
        html1 += '<div class="cardlist-view">';
            if(pro['status_product'] != 1){
        html1 += '<div style="background-color:'+set_sta_color(pro['status_product']) +';" class="text-over-cardlist"> '+ statuspro(pro['status_product'])+'';
        html1 += '</div>';
            }
        html1 += '   <img class="img-card-list" src="'+domainUrl+'/upload/thumbs/'+pro['picture']+'">';
        html1 += '</div>';
        html1 += '<div class="cardlist-text">';
        html1 += '<h5 class="text-title-ft-listv">'+pro['pro_code']+'</h5>';
        html1 += '</div>';
        html1 += '<div class="cardlist-btn">';
        html1 += '<a class="btn-ft btn-listview" href=""> + ADD TO COMPARE</a>';
        html1 += '</div>';
        html1 += '</div>';
        html1 += '</td>';
        var content =  onlycontent(pro['content']);
       
        html1 += ' <td class="text-middle-td">'+df(content[1]['data_1'],content[1]['unit_name'])+'</td>';
        html1 += '<td class="text-middle-td">'+df(content[0]['data_1'],content[0]['unit_name'])+'</td>';
        html1 += ' <td class="text-middle-td">'+df(content[2]['data_1'],content[2]['unit_name'])+'</td>';
        html1 += ' <td class="text-middle-td">'+content[3]['value_text']+'</td>';

        if(pro['dimensionL'].length < 7 &&pro['dimensionW'] != '' && pro['dimensionD'] != ''){
        html1 += '<td class="text-middle-td">'+pro['dimensionL']+' x '+pro['dimensionW']+' x '+pro['dimensionD']+' mm ';
        html1 += '<br>'+mmtonich(pro['dimensionL'])+'” x '+mmtonich(pro['dimensionW'])+'” x '+mmtonich(pro['dimensionD'])+'”</td>';
        }else{
        html1 += '<td class="text-middle-td">'+pro['dimensionL']+'</td>';  
        }
        html1 += '</tr>';

       });
        $('#listcardList').html(html1);

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
        var arr_id = [4,3,8,30];
        $.each(arr, function(index,data){
            $.each(arr_id, function(index2,data2){
              if(data2 == data['type_id'] ){
                arrcontent.push(data);
              }
            });
        });
        return arrcontent.sort((a, b) => (a.type_id > b.type_id) ? 1 : -1);
    }
    // function loadproduct(){
    
    //     $.ajax({
    //        url: "{{route('loadProduct')}}",
    //        data: {
    //       'data': {{$cateid}}
    //        },
    //        type: 'POST',
    //        headers: {
    //            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //        },
    //        success: function (res) {
    //         pro_perti =  res['data'];
    //        
    //        },
    //        async: false,
    //        });
      
    // }

    function  filtercontent(){
       var property_load = [];
       property_load = pro_perti;
        var status = [ {id:2,name:'NEW'}, {id:3,name:'UPDATED'},{id:4,name:'EOL'}];
        var certificates = [ {id:1,name:'Industrial'}, {id:2,name:'Medical'},{id:3,name:'Residential'}];
        var data_1 = [];
        var data_text = [];
        var html3 = '';
        $.each(filter_pro, function(index_con,fil_con){
            html3 += '<div class="card-header-filter collapsed fliter_series" data-toggle="collapse"';
            html3 += 'href="#collapse-fliter_'+fil_con['field_id']+'">';
            html3 += '<a class="card-title text-sixteen-dark text-uppercase">';
            html3 += fil_con['name'];
            html3 += '</a>';
            html3 += '</div>';
            html3 += '<div id="collapse-fliter_'+fil_con['field_id']+'" class="card-body-filter collapse '+(fil_con['field_id']== 'series01'?'show':'') +'" data-parent="#accordion">';
            html3 += '<form class="'+fil_con['field_id']+'">';
            html3 += '<div class="scrollbar" id="style-1">';
            if(fil_con['field_id'] == 'series01'){
                $.each(series, function(index_serie,serie){
                   
                    html3 += '<div class="box-input-checkbox">';
                    html3 += '<input onchange="series_filter(`'+fil_con['field_id']+'`,'+serie['se_id']+');" class="inp-cbx" id="cx-'+fil_con['field_id']+serie['se_id']+'" type="checkbox" style="display: none;" >';
                    html3 += '<label class="cbx" for="cx-'+fil_con['field_id']+serie['se_id']+'"><span>';
                    html3 += '<svg width="12px" height="10px" viewbox="0 0 12 10">';
                    html3 += '<polyline points="1.5 6 4.5 9 10.5 1"></polyline>';
                    html3 += '</svg></span><span>'+serie['title']+'</span></label>';
                    html3 += '</div>' ; 
                   
                  });
                  
             }
             if(fil_con['field_id'] == 'status02'){
                $.each(status, function(index_status,sta){
                    html3 += '<div class="box-input-checkbox">';
                    html3 += '<input onchange="filterstatus(`'+fil_con['field_id']+'`,'+sta['id']+');" class="inp-cbx" id="cx-'+fil_con['field_id']+index_status+'" type="checkbox" style="display: none;" />';
                    html3 += '<label class="cbx" for="cx-'+fil_con['field_id']+index_status+'"><span>';
                    html3 += '<svg width="12px" height="10px" viewbox="0 0 12 10">';
                    html3 += '<polyline points="1.5 6 4.5 9 10.5 1"></polyline>';
                    html3 += '</svg></span><span class="text-uppercase">'+sta['name']+'</span></label>';
                    html3 += '</div>' ; 
                  });
             }
             if(fil_con['field_id'] == 'certifi04'){
                $.each(certificates, function(index_cer,certi){
                    html3 += '<div class="box-input-checkbox">';
                    html3 += '<input onchange="filterCerti(`'+fil_con['field_id']+'`,'+certi['id']+');" class="inp-cbx" id="cx-'+fil_con['field_id']+index_cer+'" type="checkbox" style="display: none;" />';
                    html3 += '<label class="cbx" for="cx-'+fil_con['field_id']+index_cer+'"><span>';
                    html3 += '<svg width="12px" height="10px" viewbox="0 0 12 10">';
                    html3 += '<polyline points="1.5 6 4.5 9 10.5 1"></polyline>';
                    html3 += '</svg></span><span>'+certi['name']+'</span></label>';
                    html3 += '</div>' ; 
                  });
             }
             if(fil_con['field_id'] != 'series01' && fil_con['field_id'] != 'status02' && fil_con['field_id'] != 'certifi04' && fil_con['field_id'] != 'safety03'  ){
               var property =  property_load.sort((a, b) => (a.data_1 > b.data_1) ? 1 : -1);
               
               
                $.each(property, function(index_per,ppt){
                
                  if(fil_con['field_id'] == ppt['type_id']){
                    var object  = {};
                    var text = null;
                    if(ppt['value_text'] != null){
                        text = ppt['value_text'].substr(0, 22);
                    }
                    object = {
                       'id':index_per,
                       'type':fil_con['field_id'],
                       'data':ppt['data_1'],
                       'text':text,
                    }
                    if(ppt['type_value'] == 'number' && ppt['data_1'] != null){
                        if(containsObject(object, data_1)){
                            data_1.push(object);
                            html3 += '<div class="box-input-checkbox">';
                            html3 += '<input onchange="fillerNumber(`'+fil_con['field_id']+'`,'+ppt['data_1']+','+ppt['data_2']+','+ppt['data_3'] +','+ppt['data_4'] +','+ppt['data_5']+');" class="inp-cbx" id="cx-'+fil_con['field_id']+index_per+'" type="checkbox" style="display: none;" />';
                            html3 += '<label class="cbx" for="cx-'+fil_con['field_id']+index_per+'"><span>';
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
                            html3 += '<input  onchange="fillerInputText(`'+fil_con['field_id']+'`,`'+ppt['value_text']+'`);" class="inp-cbx" id="cx-'+fil_con['field_id']+index_per+'" type="checkbox" style="display: none;" />';
                            html3 += '<label class="cbx" for="cx-'+fil_con['field_id']+index_per+'"><span>';
                            html3 += '<svg width="12px" height="10px" viewbox="0 0 12 10">';
                            html3 += '<polyline points="1.5 6 4.5 9 10.5 1"></polyline>';
                            html3 += '</svg></span><span>'+ppt['value_text'].substr(0, 22)+'...' +'</span></label>';
                            html3 += '</div>' ; 
                        }
                    }

                    }
                  
                });
               
             }
             
            html3 += '</div>';
            html3 += '<button onclick="resetformById(`'+fil_con['field_id']+'`);" class="btn-reset" type="button">CLEAR</button>';
            html3 +=  '</form>';
            html3 +=  '</div>';
        });
        $('#sort-filter-content').html(html3);
         popcheckSerries();
    }
    function popcheckSerries(){
        //  console.log(series_id);
        if(series_id){
            $("#cx-series01"+series_id).prop("checked" ,true);
            $("#sidebar").addClass("show");
            onclickshow(2);
            ser_arr.push({{$se_id}});
        }else{
            $.each(series, function(index,val){
            ser_arr.push(val['se_id']);
            $("#cx-series01"+val['se_id']).prop("checked" ,true);
            });
           $("#sidebar").addClass("show");
            onclickshow(2);
        }
    }

    function containsObject(obj, list) {
     var  index = list.findIndex(x => x.data === obj['data'] && x.type === obj['type'] )
         if(index == -1){
            return true;
         }else{
            return false;
         }
    }
    function containsObjectText(obj, list){
        var  index = list.findIndex(x => x.text === obj['text'] && x.type === obj['type'] )
         if(index == -1){
            return true;
         }else{
            return false;
         }
    }
    
  
    function series_filter(type ,value){
        productFilter = [];
       if(ser_arr.indexOf(value) == -1){
        ser_arr.push(value);
       }else{
        var index = ser_arr.indexOf(value);
            if (index > -1) {
                ser_arr.splice(index, 1);
            }
       }
       fillerData();
    }
    function filterAllSeries(){
        $.each(products, function(index,value){
         var productObj = {};
         $.each(ser_arr, function(index_ser,value_ser){
           if(value_ser == value['series_id']){
            productObj['pro_id'] = value['pro_id'];
          productObj['pro_code'] = value['pro_code'];
          productObj['series_id'] = value['series_id'];
          productObj['status_product'] = value['status_product'];
          productObj['certificate'] = value['certificate'];
          productObj['picture'] = value['picture'];
          productObj['dimensionL'] = value['dimensionL'];
          productObj['dimensionW'] = value['dimensionW'];
          productObj['dimensionD'] = value['dimensionD'];
          productObj['content'] = [];
          
            $.each(pro_perti, function(index2,value2){
                if(value['pro_id'] == value2['product_id']){
                    productObj['content'].push(value2);
                }
              });
            productFilter.push(productObj);
          }
         });
      });

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
       filerallStatus(); 
    }

    function filerallStatus(){
        var arr_filter = [];
        productFilter.filter(function(data) {
            arr_status.forEach(element => {
                if(data.status_product == element){
                    var  index = arr_filter.findIndex(x => x.pro_id === data.pro_id)
                        if(index == -1){
                            arr_filter.push(data);  
                        }
                    }
            });
        });

       if(arr_filter.length == 0){
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
       filerallCer();
    }
    function filerallCer(){
       var arr_filter_ser = [];
        productFilter.filter(function(data) {
            arr_cer.forEach(element => {
                if(data.certificate == element){
                    var  index = arr_filter_ser.findIndex(x => x.pro_id === data.pro_id)
                        if(index == -1){
                            arr_filter_ser.push(data);  
                        }
                    }
            });
        });
        if(arr_filter_ser.length == 0){
            arr_filter_ser = [];
            arr_filter_ser = productFilter;
        }
       listItemFiler(arr_filter_ser);
    }

 

    var arr_type_an_val = [];
    var arr_value1 = [];
    function fillerNumber(type ,value1 , value2,value3, value4 ,value5){
   
      var obj = {
          'type':type,
          'value1':value1,
          'value2':value2,
          'value3':value3,
          'value4':value4,
          'value5':value5,
      }
       var  index = arr_type_an_val.findIndex(x => x.value1 === value1)
             if(index == -1){
                arr_type_an_val.push(obj);  
             }else{
                if (index > -1) {
                    arr_type_an_val.splice(index, 1);
                 }
             }
        filAllType();
    }
   
    function filAllType(){
        var array_fil_type = [];
        $.each(productFilter, function(index,value){
        productFilter[index]['content'].filter(function(data) {
            arr_type_an_val.forEach(element => {
                    if(data.type_id == element['type']){
                        if(data.data_1 == element['value1']
                         && data.data_2 == element['value2'] 
                         && data.data_3 == element['value3']
                         && data.data_4 == element['value4']
                         && data.data_5 == element['value5'] ){
                            var  index = array_fil_type.findIndex(x => x.pro_id === value.pro_id)
                            if(index == -1){
                             array_fil_type.push(value);  
                            }
                          }
                   }
            });
        });
      });
      if(array_fil_type.length == 0){
        array_fil_type = [];
        array_fil_type = productFilter;
      }
      listItemFiler(array_fil_type);
    }
    var arr_inputtxt = [];
    function fillerInputText(type ,value){
        var obj = {
          'type':type,
          'value_text':value,
      }
       var  index = arr_inputtxt.findIndex(x => x.value_text === value)
             if(index == -1){
                arr_inputtxt.push(obj);  
             }else{
                if (index > -1) {
                    arr_inputtxt.splice(index, 1);
                 }
             }
           
             filAllTypeInputText();
    }
    function filAllTypeInputText(){
        var array_fil_type = [];
        $.each(productFilter, function(index,value){
        productFilter[index]['content'].filter(function(data) {
            arr_inputtxt.forEach(element => {
                    if(data.type_id == element['type']){
                        if(data.value_text == element['value_text'] ){
                            var  index = array_fil_type.findIndex(x => x.pro_id === value.pro_id)
                            if(index == -1){
                             array_fil_type.push(value);  
                            }
                          }
                   }
            });
        });
      });
      if(array_fil_type.length == 0){
        array_fil_type = [];
        array_fil_type = productFilter;
      }
      listItemFiler(array_fil_type);
    }
    function listItemFiler(arr ,sta = null){
        var current_list =  $('#current_list_item').val();
       var showarr =  sortModelName(arr);
      if(current_list == 0){
        onclickListView(arr);
      }else{
        onclickGridView(arr);
      }
        $(".moreBox").slice(0, 12).show();
        $(".moreBox_mobile").slice(0, 12).show();
        $(".row_table").slice(0, 6).show();
        $('#countproduct').text(showarr.length);
    }
    function resetformById(id){
        $('.'+id)[0].reset();
        if(id == 'series01'){
            ser_arr = [];
        }else if(id == 'status02'){
            arr_status = [];
        }else if(id == 'certifi04'){
            arr_cer = [];
        }
        fillerData();
    }
    function onselectSort(){
        
    }
    function sortModelName(array_value){
        var arr = [];
        arr = array_value.sort((a, b) => (a.pro_code > b.pro_code) ? 1 : -1);
        return arr;
    }



    /* slidebar */
    // for (j = 1; j < 10; j++){
    //     var id = 'slidebar-value-box'+j;
    //     var valuemin ='slider-limit-value-min'+j;
    //     var valuemax ='slider-limit-value-max'+j;
    //     var nonLinearSlider = document.getElementById(id);
        
    //     noUiSlider.create(nonLinearSlider, {
    //         connect: true,
    //         behaviour: 'tap',
    //         step: 1,
    //         start: [0, 500],
    //         range: {
    //             // Starting at 500, step the value by 500,
    //             // until 4000 is reached. From there, step by 1000.
    //             'min': [0],
    //             'max': [500]
    //         }
    //     });

    //     var limitFieldMin = document.getElementById(valuemin);
    //     var limitFieldMax = document.getElementById(valuemax);
    //     nonLinearSlider.noUiSlider.on('update', function (values, handle) {
    //     (handle ? limitFieldMax : limitFieldMin).innerHTML = values[handle];
    //     });
        
    // }

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
</script>

@endsection