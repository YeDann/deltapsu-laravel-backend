@extends('layouts.front-end')
@section('css')
<style>
    .nav-tabs {
        border-bottom: 1px solid #E3EFF8;
    }

    .midle-item {
        position: absolute;
        left: 6%;
        top: 30%;
        transform: translate(-50%, -6%);
    }

    .midle-item-mobile {
        position: absolute;
        left: 12%;
        top: 30%;
        transform: translate(-50%, -6%);
    }

    .midle-item-r {
        position: absolute;
        right: 0%;
        top: 30%;
        transform: translate(-50%, 0%);
    }

    .midle-item-img {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
    }
</style>
@endsection
@section('meta')
<title>{{isset($metatag[0]->title)? $metatag[0]->title :''}}</title>

<meta name="description" content="{{isset($metatag[0]->description)? $metatag[0]->description :''}}">
<link rel="canonical" href="{{ config('app.url') }}/{{App::getLocale()}}/product/all-product-categories" />
<?php 
  $lang_seo = App::getLocale();
  if($lang_seo == 'cn'){
    $lang_seo = 'zh-Hans-CN';
  }else if($lang_seo == 'tw'){
    $lang_seo = 'zh-Hans-TW';
  }
?>
<link rel="alternate" href="{{ config('app.url') }}/{{App::getLocale()}}/product/all-product-categories"
    hreflang="{{$lang_seo}}" />

@endsection
@section('container')
<div class="visible-up-922">
    <div class="padding-top-content ">
    </div>
    <div class="products-index-banner">
        <div class="products-index-nav">
            <div class="bg-bredcrumb">
                <div class="container">
                    <nav aria-label="breadcrumb" id="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item text-breadcrumb-home"><a
                                    href="{{route('index','home')}}">{{$staticContent['Home']}}</a>
                            </li>
                            <li class="breadcrumb-item active text-breadcrumb" aria-current="page"><a
                                    href="#">{{$staticContent['Products']}}</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="nav-desktop-allproduct" style="display:none;">
            <div class="nav-allproduct-desk d-flex justify-content-between " data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                <div class="my-auto midle-item">
                    <h6>{{$staticContent['Products']}}</h6>
                </div>
                <div class="my-auto text-bold midle-item-r" id="btn-allproduct-desk">
                    <h6>{{$staticContent['All_Products']}} <i class="zmdi zmdi-chevron-down"></i> </h6>
                </div>
            </div>
            <div class="nav-allproduct-list-desk pt-2" id="nav-allproduct-list-desk" style="display:none;">
                <div class="row my-5">
                    @foreach ($mainCategories as $mainCate)
                    @if($mainCate->main_id != 3 )
                    <div class="col-4">
                        <h5 class="text-dark pb-2">{{$mainCate->name}}</h5>
                        @foreach ($subCategories as $subCate)
                        @if($subCate->main_cateid == $mainCate->main_id)
                        <div onclick="scollto({{$subCate->sub_pro_id}} ,{{$mainCate->main_id}})">
                            <p class="text-dark-gray text-one pb-2">{{$subCate->name}}</p>
                        </div>
                        @endif
                        @endforeach
                    </div>
                    @endif
                    @if($mainCate->main_id == 3)
                    <div class="col-4">
                        <h5 class="text-dark pb-2">{{$mainCate->name}}</h5>
                        <div onclick="scolltoLed(1 ,{{$mainCate->main_id}})">
                            <p class="text-dark-gray text-one pb-2">{{$staticContent['CC_Cv_Mode']}}</p>
                        </div>
                        <div onclick="scolltoLed(2 ,{{$mainCate->main_id}})">
                            <p class="text-dark-gray text-one pb-2">{{$staticContent['CC_Mode']}}</p>
                        </div>
                        <div onclick="scolltoLed(3,{{$mainCate->main_id}})">
                            <p class="text-dark-gray text-one pb-2">{{$staticContent['CV_Mode']}}</p>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
        <div id="slide-banner-products" class="owl-carousel owl-theme">
            @foreach($last_products as $pro)
            <div class="banner-type-product-all-new item"
                style="background-image: url('{{asset('frontend-asset/image/Featured-Product-BG@2x.png')}}');">
                {{-- style="background-color: #818181;background-image: url('');" --}}
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="box-banner-pro-type-all-new">
                                <div class="text-middle">
                                    <h1 class="text-title-banner">{{$pro->pro_code}}</h1>
                                    <div class="text-p-banner">
                                        <?php
                                    $str = $pro->description;
                                    $st = explode("\n", $str);
                                    for ($k = 0; $k < count($st); $k++) {
                                        echo $st[$k] = '<div>'
                                                . $st[$k]
                                                . '</div>';
                                    }
                                    ?>
                                    </div>
                                    <a
                                        href="{{route('productsDetailsByType',[ preg_replace('/\s+/', '-', $pro->url_item),$pro->pro_code ])}}">
                                        <div class="link-see-product">{{$staticContent['See_Products']}} <i
                                                class="zmdi zmdi-chevron-right" aria-hidden="true"></i>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 banner-products-pic-new">
                            <img class="midle-item-img" src="{{config('app.url')}}/upload/thumbs/{{$pro->picture}}"
                                alt="">
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @foreach($last_products_2 as $pro2)
            <div class="banner-type-product-all item" style="background-color:{{$pro2->bg_color}};">
                {{-- style="background-color: #818181;background-image: url('');" --}}
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="box-banner-pro-type-all-new">
                                <div class="text-middle">
                                    <h2 class="text-title-banner" style="color:{{$pro2->title_color}}">
                                        <?php
                                $str = $pro2->title;
                                $st = explode("\n", $str);
                                for ($k = 0; $k < count($st); $k++) {
                                    echo $st[$k] = '<div>'
                                            . $st[$k]
                                            . '</div>';
                                }
                                ?>
                                    </h2>
                                    <div class="text-p-banner" style="color:{{$pro2->text_color}}">
                                        <?php
                                    $str = $pro2->description;
                                    $st = explode("\n", $str);
                                    for ($k = 0; $k < count($st); $k++) {
                                        echo $st[$k] = '<div>'
                                                . $st[$k]
                                                . '</div>';
                                    }
                                    ?>
                                    </div>
                                    <div class="link-see-product" style="color:{{$pro2->title_color}}">
                                        {{$staticContent['See_More']}}<i class="zmdi zmdi-chevron-right"
                                            aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 banner-products-pic">
                            <img class="midle-item-img" src="{{config('app.url')}}/medias/categories/{{$pro2->image}}"
                                alt="">
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
    <div class="box-allproduct-content">
        {{-- product type show all --}}

        <div class="bar-product-type bg-blue-light pt-5 pb-5">
            <div class="container">
                <nav id="bar-product-type-nav">
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        @foreach ($mainCategories as $mainCate)
                        <a class="nav-item nav-link {{($loop->iteration == 1)?" active":""}}"
                            id="maincate{{$mainCate->main_id}}" data-toggle="tab"
                            href="#tab_mainCate{{$mainCate->main_id}}" role="tab"
                            aria-controls="tab_mainCate{{$mainCate->main_id}}s"
                            aria-selected="true">{{$mainCate->name}}</a>
                        @endforeach
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    @foreach ($mainCategories as $mainCate)
                    <div class="tab-pane fade {{($loop->iteration == 1)?" show active":""}} bar-product-type-list
                        text-center" id="tab_mainCate{{$mainCate->main_id}}" role="tabpanel"
                        aria-labelledby="nav-industrial-power-supplies-tab">
                        @foreach ($subCategories as $subCate)
                        @if($subCate->main_cateid == $mainCate->main_id)
                        <div class="bar-product-type-list-item">
                            <a href="#" onclick="scollto({{$subCate->sub_pro_id}} ,{{$mainCate->main_id}})"
                                class="deltaItem" tabindex="0" style="text-decoration:none">
                                <div class="carousel__item-thumb">
                                    @if($mainCate->main_id == 1)
                                    @if(isset($subCate->image_type1))
                                    <img src="{{config('app.url')}}/medias/categories/{{$subCate->image_type1}}"
                                        class="" alt="">
                                    @else
                                    <img src="{{config('app.url')}}/medias/categories/{{$subCate->image}}" class=""
                                        alt="">
                                    @endif
                                    @elseif($mainCate->main_id == 2)
                                    @if(isset($subCate->image_type2))
                                    <img src="{{config('app.url')}}/medias/categories/{{$subCate->image_type2}}"
                                        class="" alt="">
                                    @else
                                    <img src="{{config('app.url')}}/medias/categories/{{$subCate->image}}" class=""
                                        alt="">
                                    @endif
                                    @elseif($mainCate->main_id == 3)
                                    @if(isset($subCate->image_type3))
                                    <img src="{{config('app.url')}}/medias/categories/{{$subCate->image_type3}}"
                                        class="" alt="">
                                    @else
                                    <img src="{{config('app.url')}}/medias/categories/{{$subCate->image}}" class=""
                                        alt="">
                                    @endif
                                    @elseif($mainCate->main_id == 4)
                                    @if(isset($subCate->image_type4))
                                    <img src="{{config('app.url')}}/medias/categories/{{$subCate->image_type4}}"
                                        class="" alt="">
                                    @else
                                    <img src="{{config('app.url')}}/medias/categories/{{$subCate->image}}" class=""
                                        alt="">
                                    @endif
                                    @endif
                                </div>
                                <div class="carousel__item-name">{{$subCate->name}}</div>
                            </a>
                        </div>
                        @endif
                        @endforeach
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
        {{-- delta industrial power supplies --}}
        @foreach ($mainCategories as $mainCate)
        <div class="product-type-boxitem" id="tab_cate_main{{$mainCate->main_id}}">
            <div class="container">
                <h2 class="text-title-delta">{{$mainCate->name}}</h2>
                @foreach ($subCategories as $subCate)
                @if($subCate->main_cateid == $mainCate->main_id)
                <div class="product-type-boxitem-sub" id="tab_cate{{$mainCate->main_id}}{{$subCate->sub_pro_id}}">
                    <div class="product-type-boxitem-sub-banner"
                        style=" background-image: url('{{asset('frontend-asset/image/Categories@2x.png')}}');">
                        <div class="row">
                            <div class="col-lg-6 product-type-boxitem-sub-banner-text">
                                @if($subCate->sub_pro_id == 7 )
                                <a class="text-more_detail" href="{{route('configurableProductDetail')}}">
                                    @else
                                    <a style="color:inherit"
                                        href="{{ route('productList',[preg_replace('/\s+/', '-', $subCate->url_item),$subCate->sub_pro_id])}}">
                                        @endif
                                        <h2 class="text-dark">{{$subCate->name}}</h2>
                                        @if(isset($subCate->contenttype1) || isset($subCate->contenttype2) ||
                                        isset($subCate->contenttype3) || isset($subCate->contenttype4) )
                                        @if($subCate->main_cateid == 1)
                                        <p class="text-dark">{!!$subCate->contenttype1!!}</p>
                                        @elseif($subCate->main_cateid == 2)
                                        <p class="text-dark">{!!$subCate->contenttype2!!}</p>
                                        @elseif($subCate->main_cateid == 3)
                                        <p class="text-dark">{!!$subCate->contenttype3!!}</p>
                                        @elseif($subCate->main_cateid == 4)
                                        <p class="text-dark">{!!$subCate->contenttype4!!}</p>
                                        @endif
                                        @else
                                        <p class="text-dark">{!!$subCate->content!!}</p>
                                        @endif
                                    </a>
                                    @if($subCate->sub_pro_id == 7 )
                                    <a class="text-more_detail"
                                        href="{{route('configurableProductDetail')}}">{{$staticContent['More_Detail']}}
                                    </a>
                                    @endif
                                    @if(isset($subCate->file))
                                    <a class="text-color-delta text-link"
                                        href="{{config('app.url')}}/medias/categories/{{$subCate->file}}"
                                        download="{{$staticContent['Download_selection_guide']}}_{{$subCate->name}}"><img
                                            class="align-middle mr-1"
                                            src="{{asset('frontend-asset/image/icon/download-icon.svg')}}" alt="">
                                        {{$staticContent['Download_selection_guide']}}
                                    </a>
                                    @else
                                    {{-- <a class="text-color-delta text-link" href="#"><img class="align-middle mr-1"
                                            src="{{asset('frontend-asset/image/icon/download-icon.svg')}}" alt="">
                                        {{$staticContent['Download_selection_guide']}}</a> --}}
                                    @endif
                            </div>

                            <div class="col-lg-6 product-type-boxitem-sub-banner-pic ">
                                @if($subCate->sub_pro_id == 7)
                                <a class="d-flex w-100" href="{{route('configurableProductDetail')}}">
                                    @else
                                    <a class="d-flex w-100" style="color:inherit"
                                        href="{{ route('productList',[preg_replace('/\s+/', '-', $subCate->url_item),$subCate->sub_pro_id])}}">
                                        @endif

                                        @if($mainCate->main_id == 1)
                                        @if(isset($subCate->image_type1))
                                        <img class="img-fluid max-h"
                                            src="{{config('app.url')}}/medias/categories/{{$subCate->image_type1}}"
                                            alt="">
                                        @else
                                        <img class="img-fluid max-h"
                                            src="{{config('app.url')}}/medias/categories/{{$subCate->image}}" alt="">
                                        @endif
                                        @elseif($mainCate->main_id == 2)
                                        @if(isset($subCate->image_type2))
                                        <img class="img-fluid max-h"
                                            src="{{config('app.url')}}/medias/categories/{{$subCate->image_type2}}"
                                            alt="">
                                        @else
                                        <img class="img-fluid max-h"
                                            src="{{config('app.url')}}/medias/categories/{{$subCate->image}}" alt="">
                                        @endif
                                        @elseif($mainCate->main_id == 3)
                                        @if(isset($subCate->image_type3))
                                        <img class="img-fluid max-h"
                                            src="{{config('app.url')}}/medias/categories/{{$subCate->image_type3}}"
                                            alt="">
                                        @else
                                        <img class="img-fluid max-h"
                                            src="{{config('app.url')}}/medias/categories/{{$subCate->image}}" alt="">
                                        @endif
                                        @elseif($mainCate->main_id == 4)
                                        @if(isset($subCate->image_type4))
                                        <img class="img-fluid max-h"
                                            src="{{config('app.url')}}/medias/categories/{{$subCate->image_type4}}"
                                            alt="">
                                        @else
                                        <img class="img-fluid max-h"
                                            src="{{config('app.url')}}/medias/categories/{{$subCate->image}}" alt="">
                                        @endif
                                        @endif

                                    </a>
                            </div>
                        </div>
                    </div>
                    @if($subCate->sub_pro_id == 6)
                    @foreach ($modeSeries as $mode)
                    <div class="bordr-name-se">
                        <h3 class="text-dark" id="mode3{{$mode->id}}">

                            {{$mode->id == 1 ? $staticContent['CC_Cv_Mode'] :'' }}
                            {{$mode->id == 2 ? $staticContent['CC_Mode'] :'' }}
                            {{$mode->id == 3 ? $staticContent['CV_Mode'] :'' }}
                        </h3>
                    </div>
                    <div class="series-grid">
                        @foreach ($series as $serie)
                        @if($serie->main_cate == $mainCate->main_id)
                        @if($serie->pro_categories_id == $subCate->sub_pro_id)
                        @if($serie->mode_series == $mode->id)
                        <div class="series-list shadow-radius-box">
                            <div class="">
                                <div class="d-block ">
                                    <div class="m-auto series-img">
                                        @if($serie->se_id == 26)
                                        <a class="color:inherit;" href="{{route('configurableProductDetail')}}">
                                            @else
                                            <a style="color:inherit;" class=""
                                                href="{{ route('productList',[preg_replace('/\s+/', '-', $subCate->url_item),$serie->pro_categories_id,preg_replace('/\s+/', '', $serie->slug),$serie->se_id])}}">
                                                @endif
                                                @if(isset($serie->image))
                                                <img class="img-fluid m-auto"
                                                    src="{{config('app.url')}}/medias/categories/{{$serie->image}}"
                                                    alt="">
                                                @else
                                                <img class="img-fluid m-auto"
                                                    src="{{asset('frontend-asset/image/blank.png')}}" alt="">
                                                @endif
                                            </a>
                                    </div>
                                </div>
                                <div class="series-text text-center">
                                    <div class="d-flex h-title">
                                        @if($serie->se_id == 26)
                                        <a style="color:inherit;" class="m-auto"
                                            href="{{route('configurableProductDetail')}}">
                                            @else
                                            <a style="color:inherit;" class="m-auto"
                                                href="{{ route('productList',[preg_replace('/\s+/', '-', $subCate->url_item),$serie->pro_categories_id,preg_replace('/\s+/', '', $serie->slug),$serie->se_id])}}">
                                                @endif
                                                <h3 class="text-dark  m-0">{{$serie->title}}</h3>
                                            </a>
                                    </div>
                                    @if($serie->se_id == 26)
                                    <a style="color:inherit;" class="m-auto"
                                        href="{{route('configurableProductDetail')}}">
                                        @else
                                        <a style="color:inherit;" class="m-auto"
                                            href="{{ route('productList',[preg_replace('/\s+/', '-', $subCate->url_item),$serie->pro_categories_id,preg_replace('/\s+/', '', $serie->slug),$serie->se_id])}}">
                                            @endif
                                            <div class="series-text-detail">
                                                {!! $serie->overview_content !!}
                                            </div>
                                        </a>
                                </div>
                            </div>
                            <div class="series-icon ">
                                <div class="icon-app-detail">
                                    @foreach ($series_has_application as $item)
                                    @if($item->se_id == $serie->se_id)
                                    <a href="{{route('appDetail' ,[ 'name' => $item->slug_app , 'id' => $item->id])}}"
                                        data-toggle="tooltip" data-placement="top" title="{{$item->name}}"
                                        class="icon btn-icon-app itemhorver{{$item->id}}"
                                        style="background-image: url('{{config('app.url')}}/medias/categories/{{$item->icon}}'); "></a>
                                    <script>
                                        $(".itemhorver{{$item->id}}").hover(function(){
                                                    $(this).css("background-image", "url('{{config('app.url')}}/medias/categories/{{$item->blue_outline_icon}}')");
                                                    }, function(){
                                                    $(this).css("background-image", "url('{{config('app.url')}}/medias/categories/{{$item->icon}}')");
                                                    });
                                    </script>
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endif
                        @endif
                        @endif
                        @endforeach
                    </div>
                    @endforeach
                    @else
                    <div class="series-grid">
                        @foreach ($series as $serie)
                        @if($serie->main_cate == $mainCate->main_id)
                        @if($serie->pro_categories_id == $subCate->sub_pro_id)
                        <div class="series-list shadow-radius-box">
                            <div class="">
                                <div class="d-block ">
                                    <div class="m-auto series-img">
                                        @if($serie->se_id == 26)
                                        <a class="color:inherit;" href="{{route('configurableProductDetail')}}">
                                            @else
                                            <a style="color:inherit;" class=""
                                                href="{{ route('productList',[preg_replace('/\s+/', '-', $subCate->url_item),$serie->pro_categories_id,preg_replace('/\s+/', '', $serie->slug),$serie->se_id])}}">
                                                @endif
                                                @if(isset($serie->image))
                                                <img class="img-fluid m-auto"
                                                    src="{{config('app.url')}}/medias/categories/{{$serie->image}}"
                                                    alt="">
                                                @else
                                                <img class="img-fluid m-auto"
                                                    src="{{asset('frontend-asset/image/blank.png')}}" alt="">
                                                @endif
                                            </a>
                                    </div>
                                </div>
                                <div class="series-text text-center">
                                    <div class="d-flex h-title">
                                        @if($serie->se_id == 26)
                                        <a style="color:inherit;" class="m-auto"
                                            href="{{route('configurableProductDetail')}}">
                                            @else
                                            <a style="color:inherit;" class="m-auto"
                                                href="{{ route('productList',[preg_replace('/\s+/', '-', $subCate->url_item),$serie->pro_categories_id,preg_replace('/\s+/', '', $serie->slug),$serie->se_id])}}">
                                                @endif
                                                <h3 class="text-dark  m-0">{{$serie->title}}</h3>
                                            </a>
                                    </div>
                                    @if($serie->se_id == 26)
                                    <a style="color:inherit;" class="m-auto"
                                        href="{{route('configurableProductDetail')}}">
                                        @else
                                        <a style="color:inherit;" class="m-auto"
                                            href="{{ route('productList',[preg_replace('/\s+/', '-', $subCate->url_item),$serie->pro_categories_id,preg_replace('/\s+/', '', $serie->slug),$serie->se_id])}}">
                                            @endif
                                            <div class="series-text-detail">
                                                {!! $serie->overview_content !!}
                                            </div>
                                        </a>
                                </div>
                            </div>
                            <div class="series-icon ">
                                <div class="icon-app-detail">
                                    @foreach ($series_has_application as $item)
                                    @if($item->se_id == $serie->se_id)
                                    <a href="{{route('appDetail' ,[ 'name' => $item->slug_app , 'id' => $item->id])}}"
                                        data-toggle="tooltip" data-placement="top" title="{{$item->name}}"
                                        class="icon btn-icon-app itemhorver{{$item->id}}"
                                        style="background-image: url('{{config('app.url')}}/medias/categories/{{$item->icon}}'); "></a>
                                    <script>
                                        $(".itemhorver{{$item->id}}").hover(function(){
                                                    $(this).css("background-image", "url('{{config('app.url')}}/medias/categories/{{$item->blue_outline_icon}}')");
                                                    }, function(){
                                                    $(this).css("background-image", "url('{{config('app.url')}}/medias/categories/{{$item->icon}}')");
                                                    });
                                    </script>
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endif
                        @endif
                        @endforeach
                    </div>
                    @endif
                </div>
                @endif
                @endforeach
            </div>
        </div>
        @endforeach
    </div>
</div>
<div class="invisible-up-922">
    <div class="nav-allproduct ">
        <div class="my-auto midle-item-mobile">
            <h6>{{$staticContent['Products']}}</h6>
        </div>
        <a href="#" class="my-auto text-bold midle-item-r" id="btn-allproduct">
            <h6>{{$staticContent['All_Products']}} <i class="zmdi zmdi-chevron-down"></i> </h6>
        </a>
    </div>
    <div class="nav-allproduct-list p-5" id="nav-allproduct-list">
        @foreach ($mainCategories as $mainCate)
        @if($mainCate->main_id != 3)
        <h6 class="text-color-delta pb-2">{{$mainCate->name}}</h6>
        @foreach ($subCategories as $subCate)
        @if($subCate->main_cateid == $mainCate->main_id)
        <h6 class="text-dark-gray pb-2" onclick="scolltoMobile({{$subCate->sub_pro_id}} ,{{$mainCate->main_id}})">
            {{$subCate->name}}</h6>

        @endif
        @endforeach
        <hr>
        @endif

        @if($mainCate->main_id == 3)
        <h6 class="text-color-delta pb-2">{{$mainCate->name}}</h6>
        <h6 class="text-dark-gray pb-2" onclick="scolltoMobileled(1 ,{{$mainCate->main_id}})">
            {{$staticContent['CC_Cv_Mode']}}</h6>
        <h6 class="text-dark-gray pb-2" onclick="scolltoMobileled(2 ,{{$mainCate->main_id}})">
            {{$staticContent['CC_Mode']}}</h6>
        <h6 class="text-dark-gray pb-2" onclick="scolltoMobileled(3 ,{{$mainCate->main_id}})">
            {{$staticContent['CV_Mode']}}</h6>

        <hr>
        @endif
        @endforeach

    </div>
    <div class="box-banner">
        <div id="slide-banner-products-mobile" class="owl-carousel owl-theme">
            @foreach($last_products as $pro)
            @if($pro->status == 1)
            <div class="banner-type-product-all item">
                <div class="slide"
                    style="background-image: url('{{asset('frontend-asset/image/Featured-Product-BG@2x.png')}}');">
                    <div class="slide-content">
                        <div class="container ">
                            <h4 class="text-delta mr-b-12px">{{$pro->pro_code}}</h4>
                            <a href="" class="link-see-product">{{$staticContent['See_Products']}} <i
                                    class="zmdi zmdi-chevron-right" aria-hidden="true"></i> </a>
                            <div class="d-flex justify-content-center py-3 ">
                                <img class="img-product" src="{{config('app.url')}}/upload/thumbs/{{$pro->picture}}"
                                    alt="">
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="banner-type-product-all item">
                <div class="slide" style="background-color:{{$pro->bg_color}};">
                    <div class="slide-content">
                        <div class="container ">
                            <h4 class="text-delta mr-b-12px" style="color:{{$pro->title_color}}">
                                <?php
                                $str = $pro->title;
                                $st = explode("\n", $str);
                                for ($k = 0; $k < count($st); $k++) {
                                    echo $st[$k] = '<div>'
                                            . $st[$k]
                                            . '</div>';
                                }
                                ?>
                            </h4>
                            <a href="" class="link-see-product"
                                style="color:{{$pro->title_color}}">{{$staticContent['See_Products']}}<i
                                    class="zmdi zmdi-chevron-right" aria-hidden="true"></i> </a>
                            <div class="d-flex justify-content-center py-5 ">
                                <img class="img-product" src="{{config('app.url')}}/medias/categories/{{$pro->image}}"
                                    alt="">
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>
    <div class="product-type-boxitem" id="delta-industrial-power-supplies">
        @foreach ($mainCategories as $mainCate)
        <h2 class="text-title-delta">{{$mainCate->name}}</h2>
        @foreach ($subCategories as $subCate)
        @if($subCate->main_cateid == $mainCate->main_id)
        <div class="product-type-boxitem-sub" id="tab_cate_mobile{{$mainCate->main_id}}{{$subCate->sub_pro_id}}">
            <div class="product-type-boxitem-sub-banner"
                style=" background-image: url('{{asset('frontend-asset/image/Categories@2x.png')}}');">
                <div class="row">
                    <div class="col-lg-6 product-type-boxitem-sub-banner-text text-center">
                        @if($subCate->sub_pro_id == 7 )
                        <a href="{{route('configurableProductDetail')}}">
                            @else
                            <a
                                href="{{ route('productList',[preg_replace('/\s+/', '-', $subCate->url_item),$subCate->sub_pro_id])}}">
                                @endif
                                <h2 class="text-dark">{{$subCate->name}}</h2>
                            </a>
                            @if(isset($subCate->file))
                            <a class="text-color-delta text-link"
                                href="{{config('app.url')}}/medias/categories/{{$subCate->file}}"
                                download="{{$staticContent['Download_selection_guide']}}_{{$subCate->name}}"><img
                                    class="align-middle mr-1"
                                    src="{{asset('frontend-asset/image/icon/download-icon.svg')}}" alt=""> Download
                                selection
                                guide</a>
                            @else
                            {{-- <a class="text-color-delta text-link" href="" download=""><img
                                    class="align-middle mr-1"
                                    src="{{asset('frontend-asset/image/icon/download-icon.svg')}}" alt="">
                                Empty
                                selection
                                guide</a> --}}
                            @endif

                    </div>
                    <div class="col-lg-6 product-type-boxitem-sub-banner-pic">
                        @if($subCate->sub_pro_id == 7 )
                        <a href="{{route('configurableProductDetail')}}">
                        @else
                        <a
                            href="{{ route('productList',[preg_replace('/\s+/', '-', $subCate->url_item),$subCate->sub_pro_id])}}">
                            @endif
                            {{-- @if(isset($subCate->image))
                            <img class="img-fluid" style=""
                                src="{{config('app.url')}}/medias/categories/{{$subCate->image}}" alt="">
                            @else
                            <img class="img-fluid" style="" src="{{asset('frontend-asset/image/blank.png')}}"
                                alt="">
                            @endif --}}
                            @if($mainCate->main_id == 1)
                            @if(isset($subCate->image_type1))
                            <img class="img-fluid max-h"
                                src="{{config('app.url')}}/medias/categories/{{$subCate->image_type1}}" alt="">
                            @else
                            <img class="img-fluid max-h"
                                src="{{config('app.url')}}/medias/categories/{{$subCate->image}}" alt="">
                            @endif
                            @elseif($mainCate->main_id == 2)
                            @if(isset($subCate->image_type2))
                            <img class="img-fluid max-h"
                                src="{{config('app.url')}}/medias/categories/{{$subCate->image_type2}}" alt="">
                            @else
                            <img class="img-fluid max-h"
                                src="{{config('app.url')}}/medias/categories/{{$subCate->image}}" alt="">
                            @endif
                            @elseif($mainCate->main_id == 3)
                            @if(isset($subCate->image_type3))
                            <img class="img-fluid max-h"
                                src="{{config('app.url')}}/medias/categories/{{$subCate->image_type3}}" alt="">
                            @else
                            <img class="img-fluid max-h"
                                src="{{config('app.url')}}/medias/categories/{{$subCate->image}}" alt="">
                            @endif
                            @endif
                        </a>
                    </div>
                </div>
            </div>
            <div class="container">
                @if($subCate->sub_pro_id == 6)
                @foreach ($modeSeries as $mode)
                <div class="bordr-name-se">
                    <h3 class="text-dark" id="mode_mobile3{{$mode->id}}">
                        {{$mode->id == 1 ? $staticContent['CC_Cv_Mode'] :'' }}
                        {{$mode->id == 2 ? $staticContent['CC_Mode'] :'' }}
                        {{$mode->id == 3 ? $staticContent['CV_Mode'] :'' }}
                    </h3>
                </div>
                {{-- Start serise --}}
                <div class="series-grid ">
                    @foreach ($series as $serie)
                    @if($serie->main_cate == $mainCate->main_id)
                    @if($serie->pro_categories_id == $subCate->sub_pro_id)
                    @if($serie->mode_series == $mode->id)
                    <div class="series-list shadow-radius-box">
                        <div class="">
                            <div class="d-block">
                                <div class="m-auto series-img">
                                    @if($serie->se_id == 26)
                                    <a class="color:inherit;" href="{{route('configurableProductDetail')}}">
                                        @else
                                        <a style="color:inherit;" class=""
                                            href="{{ route('productList',[preg_replace('/\s+/', '-', $subCate->url_item),$serie->pro_categories_id,preg_replace('/\s+/', '', $serie->slug),$serie->se_id])}}">
                                            @endif
                                            @if(isset($serie->image))
                                            <img class="img-fluid m-auto"
                                                src="{{config('app.url')}}/medias/categories/{{$serie->image}}" alt="">
                                            @else
                                            <img class="img-fluid m-auto"
                                                src="{{asset('frontend-asset/image/blank.png')}}" alt="">
                                            @endif
                                        </a>

                                </div>
                            </div>
                            <div class="series-text text-center">
                                <div style="min-height:64px; " class="d-flex">
                                    <a style="color:inherit; " class="m-auto"
                                        href="{{ route('productList',[preg_replace('/\s+/', '-', $subCate->url_item),$serie->pro_categories_id,preg_replace('/\s+/', '', $serie->slug),$serie->se_id])}}">
                                        <h3 class="text-dark text-untransfrom  m-0">{{$serie->title}}</h3>
                                    </a>
                                </div>
                                @if($serie->se_id == 26)
                                <a style="color:inherit;text-decoration: none;"
                                    href="{{route('configurableProductDetail')}}">
                                    @else
                                    <a style="color:inherit;text-decoration: none;" class=""
                                        href="{{ route('productList',[preg_replace('/\s+/', '-', $subCate->url_item),$serie->pro_categories_id,preg_replace('/\s+/', '', $serie->slug),$serie->se_id])}}">
                                        @endif
                                        <div class="series-text-detail" style="min-height:72px;">
                                            {!! $serie->overview_content !!}
                                        </div>
                                    </a>
                            </div>
                        </div>
                        <div class="series-icon">
                            <div class="icon-app-detail">
                                @foreach ($series_has_application as $item)
                                @if($item->se_id == $serie->se_id)
                                <a href="{{route('appDetail' ,[ 'name' => $item->slug_app, 'id' => $item->id])}}"
                                    data-toggle="tooltip" data-placement="top" title="{{$item->name}}"
                                    class="icon btn-icon-app itemhorver{{$item->id}}"
                                    style="background-image: url('{{config('app.url')}}/medias/categories/{{$item->icon}}'); "></a>
                                <script>
                                    $(".itemhorver{{$item->id}}").hover(function(){
                                        $(this).css("background-image", "url('{{config('app.url')}}/medias/categories/{{$item->blue_outline_icon}}')");
                                    }, function(){
                                        $(this).css("background-image", "url('{{config('app.url')}}/medias/categories/{{$item->icon}}')");
                                    });
                                </script>
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif
                    @endif
                    @endif
                    @endforeach
                </div>
                {{-- end serise --}}
                @endforeach

                @else
                {{-- Start serise --}}
                <div class="series-grid ">
                    @foreach ($series as $serie)
                    @if($serie->main_cate == $mainCate->main_id)
                    @if($serie->pro_categories_id == $subCate->sub_pro_id)
                    <div class="series-list shadow-radius-box">
                        <div class="">
                            <div class="d-block">
                                <div class="m-auto series-img">
                                    @if($serie->se_id == 26)
                                    <a class="color:inherit;" href="{{route('configurableProductDetail')}}">
                                        @else
                                        <a style="color:inherit;" class=""
                                            href="{{ route('productList',[preg_replace('/\s+/', '-', $subCate->url_item),$serie->pro_categories_id,preg_replace('/\s+/', '', $serie->slug),$serie->se_id])}}">
                                            @endif
                                            @if(isset($serie->image))
                                            <img class="img-fluid m-auto"
                                                src="{{config('app.url')}}/medias/categories/{{$serie->image}}" alt="">
                                            @else
                                            <img class="img-fluid m-auto"
                                                src="{{asset('frontend-asset/image/blank.png')}}" alt="">
                                            @endif
                                        </a>

                                </div>
                            </div>
                            <div class="series-text text-center">
                                <div style="min-height:64px; " class="d-flex">
                                    <a style="color:inherit; " class="m-auto"
                                        href="{{ route('productList',[preg_replace('/\s+/', '-', $subCate->url_item),$serie->pro_categories_id,preg_replace('/\s+/', '', $serie->slug),$serie->se_id])}}">
                                        <h3 class="text-dark text-untransfrom  m-0">{{$serie->title}}</h3>
                                    </a>
                                </div>
                                @if($serie->se_id == 26)
                                <a style="color:inherit;text-decoration: none;"
                                    href="{{route('configurableProductDetail')}}">
                                    @else
                                    <a style="color:inherit;text-decoration: none;" class=""
                                        href="{{ route('productList',[preg_replace('/\s+/', '-', $subCate->url_item),$serie->pro_categories_id,preg_replace('/\s+/', '-', $serie->slug),$serie->se_id])}}">
                                        @endif
                                        <div class="series-text-detail" style="min-height:72px;">
                                            {!! $serie->overview_content !!}
                                        </div>
                                    </a>
                            </div>
                        </div>
                        <div class="series-icon">
                            <div class="icon-app-detail">
                                @foreach ($series_has_application as $item)
                                @if($item->se_id == $serie->se_id)
                                <a href="{{route('appDetail' ,[ 'name' => $item->slug_app , 'id' => $item->id])}}"
                                    data-toggle="tooltip" data-placement="top" title="{{$item->name}}"
                                    class="icon btn-icon-app itemhorver{{$item->id}}"
                                    style="background-image: url('{{config('app.url')}}/medias/categories/{{$item->icon}}'); "></a>
                                <script>
                                    $(".itemhorver{{$item->id}}").hover(function(){
                                                $(this).css("background-image", "url('{{config('app.url')}}/medias/categories/{{$item->blue_outline_icon}}')");
                                                }, function(){
                                                $(this).css("background-image", "url('{{config('app.url')}}/medias/categories/{{$item->icon}}')");
                                                });
                                </script>
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif
                    @endif
                    @endforeach
                </div>
                {{-- end serise --}}
                @endif
            </div>
        </div>
        @endif
        @endforeach
        @endforeach
    </div>
</div>


@endsection
@section('js')
<script>
    $(function () {
     $('[data-toggle="tooltip"]').tooltip()
    })
    var cateid = '{{$cateid}}';
    var mainid = '{{$mainId}}';
    // console.log(cateid);
    // console.log(mainid);
   if(mainid == 3){
       console.log(3);
    if($(window).width() > 992){
       $('html, body').animate({
        scrollTop: $("#mode{{$mainId}}{{$cateid}}").offset().top+200}, 1000);
    }else{
        $('html, body').animate({
        scrollTop: $("#mode_mobile{{$mainId}}{{$cateid}}").offset().top+200}, 1000); 
    }
   }else{
     if($(window).width() > 992){
       $('html, body').animate({
        scrollTop: $("#tab_cate{{$mainId}}{{$cateid}}").offset().top+200}, 1000);
    }else{
        $('html, body').animate({
        scrollTop: $("#tab_cate_mobile{{$mainId}}{{$cateid}}").offset().top+200}, 1000); 
    }
   }
  
     function scollto(id ,mainid){
        $('html, body').animate({
        scrollTop: $("#tab_cate"+mainid+id).offset().top-200}, 1000);
        $('#nav-allproduct-list-desk').hide();
     }

     function scolltoMobile(id ,mainid){
        $('html, body').animate({
          scrollTop: $("#tab_cate_mobile"+mainid+id).offset().top-200}, 1000); 
          $('#nav-allproduct-list').hide();
     }
     function scolltoMobileled(id ,mainid){
        $('html, body').animate({
          scrollTop: $("#mode_mobile"+mainid+id).offset().top-200}, 1000); 
          $('#nav-allproduct-list').hide();
     }
     function scolltoLed(id ,mainid){
 
        $('html, body').animate({
        scrollTop: $("#mode"+mainid+id).offset().top-200}, 1000);
        $('#nav-allproduct-list-desk').hide();
     }

   

  
   
</script>

<script>
    $(document).ready(function () {
        $("#slide-banner-products").owlCarousel({
            loop: true,
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
        $("#slide-banner-products-mobile").owlCarousel({
            loop: true,
            navigation: true, // Show next and prev buttons
            slideSpeed: 300,
            paginationSpeed: 400,
            singleItem: true,
            items: 1,

        });
        $('.product-type-boxitem-sub-list-item-icon a').tooltip({
            boundary: 'window'
        });
        $('#bar-product-type-nav').removeClass('scrolled');
        $("#btn-allproduct").click(function () {
            $("#nav-allproduct-list").slideToggle("slow");
        });
        $("#btn-allproduct-desk").click(function () {
            $("#nav-allproduct-list-desk").slideToggle("slow");
        });
        /* nav show on div*/
        var offsetTop = $(".box-allproduct-content").offset().top;
        $(window).scroll(function () {
            var scrollTop = $(window).scrollTop();
            if (scrollTop >= offsetTop) {
                $(".nav-desktop-allproduct").slideDown(500);
            } else {
                $(".nav-desktop-allproduct").fadeOut();
                $("#nav-allproduct-list-desk").fadeOut();
            }
        });
    });

</script>
@endsection