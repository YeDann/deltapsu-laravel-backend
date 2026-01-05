@extends('layouts.front-end')
@section('css')
<style>
    .box-product-selector .container {
        text-align: center;
    }

    /* .visible-mobile .box-product-selector .container{
        padding: 16px;
    } */

    .text-hover {
        /* display: none; */
        opacity: 0;
        line-height: 1;
        color: #5F5F5F;
        font-size: 14px;

    }

    .product-selector-list:hover .text-hover,
    .product-selector-mobile:hover .text-hover {
        opacity: 1;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }



    .product-selector-list:hover .text-title-dark,
    .product-selector-mobile:hover .text-title-dark {
        color: #0087DC !important;

    }

    .product-selector-list:hover,
    .product-selector-mobile:hover {
        border-color: #0087DC;
    }

    .product-selector-list:hover a {
        text-decoration: none;
    }

    .product-selector-list {
        margin-left: auto;
        margin-right: auto;
        height: 220px;
    }

    .product-selector-list img {
        margin-left: auto;
        margin-right: auto;
        margin-bottom: 1rem;
        max-height: 85px;
        object-fit: contain;
    }

    .btn.focus,
    .btn:focus {
        outline: 0;
        box-shadow: unset;
    }

    .ttt {
        transform: scaleX(0);
    }

    #producttype.owl-carousel .owl-stage-outer {}

    .midle-item {
        margin: 0;
        position: absolute;
        top: 50%;
        transform: translate(0, -50%)
    }

    .in-volt {
        height: 73px;
        overflow: hidden;
    }

    .mr-lr-feture {
        padding-left: 30px;
        padding-right: 30px;
    }

    .posit-btn-mobile {
        position: absolute;
        bottom: 70px;
        transform: translate(-50%, 50%);
    }

    .padd-mobile-slide {
        background: linear-gradient(to bottom, #fff, transparent, transparent);
        background-size: cover;
        background-position: top center, bottom center;
        background-size: 100% 100%;
        padding-bottom: 2%;
        padding-left: 20px;
        padding-right: 20px;
    }

    .btn-subscribe {
        z-index: 999;
    }

    @media only screen and (min-width:921px) {
        .text-app-arrow {
            font-size: 0.75em;
            color: #0087dc;
            display: flex;
            position: absolute;
            bottom: 20px;
        }

        .text-app-arrow i {
            font-size: 14px !important;
            margin-left: 8px;
            margin-top: 2px;
        }
    }

    @media only screen and (max-width:920px) {
        .text-app-arrow {
            font-size: 14px;
            color: #0087dc;
            display: flex;
            position: absolute;
            bottom: 10px;
        }

        .text-app-arrow i {
            font-size: 14px !important;
            margin-left: 8px;
            margin-top: 4px;
        }
    }
</style>
@endsection
@section('meta')
<title>{{isset($metatag[0]->title)? $metatag[0]->title :''}}</title>
<meta name="description" content="{{isset($metatag[0]->description)? $metatag[0]->description :''}}">
<link rel="canonical" href="{{ config('app.url') }}/{{App::getLocale()}}" />
<?php
  $lang_seo = App::getLocale();
  if($lang_seo == 'cn'){
    $lang_seo = 'zh-Hans-CN';
  }else if($lang_seo == 'tw'){
    $lang_seo = 'zh-Hans-TW';
  }
?>
<link rel="alternate" href="{{ config('app.url') }}/{{App::getLocale()}}" hreflang="{{$lang_seo}}" />
@endsection
<?php
    function setTextpro($pro){
                $strmodel =  str_replace("/", "&", $pro);
                return  $strmodel;
            }

?>
@section('container')
<?php $style = 2; ?>
<!-- banner -->


<div class="show-more-769">
    <div class="box-banner">
        <div id="slide-banner" class="owl-carousel owl-theme">
            @foreach ($banners as $index => $banner)
            <div class="item banner-item">
                <a href="{{$banner->btn_link}}">
                    <div loading="lazy" data-src="{{config('app.url')}}/medias/banners/{{$banner->image_destop}}"
                        class="slide">
                        <div class="slide-content">
                            @if($banner->title2 != null || $banner->content != null)
                            <div class="container">
                                <div class="bg-w-banner">
                                    @if($index == 0)
                                    <h1 class="text-title-banner" style="color:{{ $banner->title_color}}">
                                        <?php
                                    $str = $banner->title2;
                                    $st = explode("\n", $str);
                                    for ($k = 0; $k < count($st); $k++) {
                                        echo $st[$k] = '<div>'
                                                . $st[$k]
                                                . '</div>';
                                    }
                                    ?>
                                    </h1>
                                    @else
                                    <h2 class="text-title-banner" style="color:{{ $banner->title_color}}">
                                        <?php
                                    $str = $banner->title2;
                                    $st = explode("\n", $str);
                                    for ($k = 0; $k < count($st); $k++) {
                                        echo $st[$k] = '<div>'
                                                . $st[$k]
                                                . '</div>';
                                    }
                                    ?>
                                    </h2>
                                    @endif
                                    <div class="text-p-banner my-2" style="color:{{ $banner->content_color}}">
                                        {!!$banner->content!!}
                                    </div>
                                    @if($banner->btn_status == 1)
                                    <button class="btn btn-subscribe">{{$banner->btn_name}}</button>

                                    @endif
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
    <div class="d-flex justify-content-center" style="margin-top: 2rem">
        <h4 class="text-center">{{isset($metatag[0]->h1)? $metatag[0]->h1 :''}}</h4>
    </div>
</div>

<div class="show-768-only">
    <div class="padding-top-content">
    </div>
    <div class="box-banner">
        <div id="slide-banner-mobile" class="owl-carousel owl-theme ">
            @foreach ($banners as $index => $banner)
            <div class="item banner-item ">
                <a href="{{$banner->btn_link}}">
                    <div loading="lazy" data-src="{{config('app.url')}}/medias/banners/{{$banner->image}}"
                        class="slide">
                        <div class="slide-content">
                            @if($banner->title2 != null)
                            <div class="container ">
                                <div class="">
                                    <h2 class="text-title-banner" style="color:{{ $banner->title_color}}">
                                        <?php
                                        $str = $banner->title;
                                        $st = explode("\n", $str);
                                        for ($k = 0; $k < count($st); $k++) {
                                            echo $st[$k] = '<div>'
                                                    . $st[$k]
                                                    . '</div>';
                                        }
                                      ?>
                                    </h2>
                                    @if($banner->btn_status == 1)
                                    <button
                                        class="btn btn-subscribe mt-3 posit-btn-mobile">{{$banner->btn_name}}</button>
                                    @endif
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
    <div class="d-flex justify-content-center mt-4">
        <h4 class="text-center">{{isset($metatag[0]->h1)? $metatag[0]->h1 :''}}</h4>
    </div>
</div>
<!-- selecter -->

<div class="visible-tablets-up">
    <div class="box-product-selector container">
        <h2 class="text-title-delta-home"> {{$staticContent['Product_Selector']}}</h2>
        <div id="product-selector-carousel" class="owl-carousel owl-theme product-selector text-center">
            @foreach($mainCategories as $mainCate)
            <div class="product-selector-list border-2px d-flex align-items-center border-radius-6">
                <div class="m-auto">
                    <a href="{{ route('productList',[$mainCate->main_id])}}">
                        @if($mainCate->banner != null)
                        <img data-src="{{config('app.url')}}/medias/categories/{{$mainCate->banner}}" loading="lazy"
                            class="lazyload" alt="{{$mainCate->banner}}">
                        @else
                        <img data-src="{{asset('frontend-asset/image/blank.png')}}" loading="lazy" class="lazyload"
                            alt="blank.png">
                        @endif
                        <div style="height: 50px; " class="d-flex">
                            <h4 class="text-title-dark mx-auto fix-text-width-product-selector">{{$mainCate->name}}</h4>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<div class="visible-mobile">
    <div class="box-product-selector padd-left-rbox">
        <h2 class="text-title-delta-home ">{{$staticContent['Product_Selector']}}</h2>
        <div id="product-selector-carousel-mobile" class="owl-carousel owl-theme product-selector text-center">
            @foreach($mainCategories as $mainCate)
            <div class="product-selector-list">
                <div class="border-2px d-flex h-100 p-1 align-items-center border-radius-6">
                    <div class="m-auto">
                        <a href="{{ route('productList',[$mainCate->main_id])}}">
                            @if($mainCate->banner != null)
                            <img data-src="{{config('app.url')}}/medias/categories/{{$mainCate->banner}}" loading="lazy"
                                class="lazyload" alt="{{$mainCate->banner}}">
                            @else
                            <img data-src="{{asset('frontend-asset/image/blank.png')}}" loading="lazy" class="lazyload"
                                alt="blank.png">
                            @endif
                            <div style="height: 50px;" class="d-flex">
                                <h4 class="text-title-dark mx-auto fix-text-width-product-selector">{{$mainCate->name}}</h4>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- application -->
<div class="visible-tablets-up">
    <div class="box-applications">
        <div class="container">
            <h2 class="text-title-delta-home ">{{$staticContent['Applications']}}</h2>
            <div class="grid-container">
                @foreach ($applications as $item)
                <a href="{{ route('appDetail', ['name' => $item->slug_app, 'id' => $item->applica_id]) }}" class="hover-border-blue"
                    style="">
                    <div class="grid-item">
                        <div data-src="{{config('app.url')}}/medias/categories/{{$item->thumbnail}}" loading="lazy" 
                            class="grid-sub-pic" style="border-radius: 6px 0 0 6px">
                        </div>
                        <div class="grid-sub-text">
                            <img src="{{config('app.url')}}/medias/categories/{{$item->color_icon}}" alt="">
                            <p class="">{{$item->name}}</p>

                            <ul class="app-detail-bullet">
                                {{-- <li>Escalator & Elvator</li>
                                <li>CCTV Surveilance</li>
                                <li>HVAC Control</li> --}}
                                <?php
                                    $str = $item->overview;
                                    $st = explode("\n", $str);
                                        for ($k = 0; $k < count($st); $k++) {
                                        if($k < 3){
                                            echo $st[$k] = '<li>'
                                                . $st[$k]
                                                . '</li>';
                                        }
                                       }
                                    ?>
                            </ul>
                            <div class="text-app-arrow">
                                {{ isset($staticContent['read_more_application'])
                                ?$staticContent['read_more_application'] : 'Read More' }} <i
                                    class="zmdi zmdi-chevron-right"></i>
                            </div>

                        </div>
                    </div>
                </a>
                @endforeach

            </div>
        </div>
        <div class="text-center mr-24px" id="loadMore-application" style="">
            <a href="#" class="btn btn-boxen">{{$staticContent['See_More']}}</a>
        </div>
    </div>
</div>
<div class="visible-mobile">
    <div class="box-applications-mobile  ">
        <div class="container">
            <h2 class="text-title-delta-home">{{$staticContent['Applications']}}</h2>
            <div class="grid-container">
                @foreach ($applications as $item)
                <a href="{{route('appDetail' ,[ 'name' => $item->slug_app, 'id' => $item->applica_id])}}"
                    class="blogBox-mb moreBox-mb" style="display: none;">
                    <div class="grid-item">
                        <div data-src="{{config('app.url')}}/medias/categories/{{$item->thumbnail}}" loading="lazy"
                            class="grid-sub-pic" style="border-radius: 6px 0 0 6px">
                        </div>
                        <div class="grid-sub-text">
                            <img class="lazyload"
                                data-src="{{config('app.url')}}/medias/categories/{{$item->color_icon}}" loading="lazy"
                                alt="">
                            <p class="">{{$item->name}}</p>
                            <ul class="app-detail-bullet">

                                <?php
                                $str = $item->overview;
                                $st = explode("\n", $str);
                                    for ($k = 0; $k < count($st); $k++) {
                                    if($k < 3){
                                        echo $st[$k] = '<li>'
                                            . $st[$k]
                                            . '</li>';
                                    }
                                   }
                                ?>
                            </ul>
                            <div class="text-app-arrow">
                                {{ isset($staticContent['read_more_application'])
                                ?$staticContent['read_more_application'] : 'Read More' }} <i
                                    class="zmdi zmdi-chevron-right"></i>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach

            </div>
        </div>
        <div class="text-center mr-24px" id="loadMore-application-mobile" style="">
            <a href="#" class="btn btn-boxen">{{$staticContent['See_More']}}</a>
        </div>
    </div>
</div>
<!-- feature -->
<?php
function retextdata($arr ,$unit){
                      $arr_data = [];
                   foreach ($arr as $dch){
                      if($dch != null && $dch != '' && $dch != 'null'){
                          array_push($arr_data,$dch.$unit);
                      }

                   }
       return $arr_data;
}

?>
<div class="visible-tablets-up">
    <div class="box-pp">
        <div class="container">
            <div class="text-center">
                <h2 class="text-title-delta-home">{{$staticContent['The_Latest_Series']}}</h2>
            </div>
            <div id="producttype" class="owl-carousel owl-theme  ft-products-body">
                @foreach ($series as $serie)
                @php
                    $urlParams = [];
                    if($serie->main_cateid == 3){
                        $modeId = $serie->mode_series;
                        $urlText = 'cc-cv-mode';
                        if($modeId == 2){
                            $urlText = 'cc-mode';
                        }elseif($modeId == 3){
                            $urlText = 'cv-mode';
                        }
                        $urlParams = [$serie->main_cateid, $urlText, $modeId, preg_replace('/\s+/', '', $serie->slug), $serie->se_id];
                    } else {
                        $urlParams = [$serie->main_cateid, preg_replace('/\s+/', '-', $serie->url_item), $serie->cate_id, preg_replace('/\s+/', '', $serie->slug), $serie->se_id];
                    }
                @endphp
                <div class="series-list-home">
                    <div class="">
                        <div class="d-block ">
                            <div class="m-auto series-img">
                                @if($serie->se_id == 26)
                                <a class="color:inherit;" href="{{route('configurableProductDetail')}}">
                                    @else
                                    <a style="color:inherit;" class=""
                                        href="{{ route('productList',$urlParams)}}">
                                        @endif
                                        @if(isset($serie->image))
                                        <img data-src="{{config('app.url')}}/medias/categories/{{$serie->image}}"
                                            loading="lazy" class="img-fluid m-auto lazyload" src="" alt="">
                                        @else
                                        <img data-src="{{asset('frontend-asset/image/blank.png')}}" loading="lazy"
                                            class="img-fluid m-auto lazyload" alt="">
                                        @endif
                                    </a>
                            </div>
                        </div>
                        <div class="series-text text-center">
                            <div class="d-flex h-title">
                                @if($serie->se_id == 26)
                                <a style="color:inherit;" class="m-auto" href="{{route('configurableProductDetail')}}">
                                    @else
                                    <a style="color:inherit;" class="m-auto"
                                        href="{{ route('productList',$urlParams)}}">
                                        @endif
                                        <h3 class="text-dark  m-0">{{$serie->title}}</h3>
                                    </a>
                            </div>
                            @if($serie->se_id == 26)
                            <a style="color:inherit;" class="m-auto" href="{{route('configurableProductDetail')}}">
                                @else
                                <a style="color:inherit;" class="m-auto"
                                    href="{{ route('productList',$urlParams)}}">
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
                            <a href="{{route('appDetail' ,[ 'name' =>$item->slug_app, 'id' => $item->id])}}"
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
                @endforeach
            </div>
        </div>
    </div>
</div>
<div class="visible-mobile">
    <div class="padd-mobile-slide">
        <div class="">
            <div class="text-center">
                <h2 class="text-title-delta-home">{{$staticContent['The_Latest_Series']}}</h2>
            </div>
            <div id="producttype-mobile" class="owl-carousel owl-theme  ft-products-body">
                @foreach ($series as $serie)
                @php
                    $urlParams = [];
                    if($serie->main_cateid == 3){
                        $modeId = $serie->mode_series;
                        $urlText = 'cc-cv-mode';
                        if($modeId == 2){
                            $urlText = 'cc-mode';
                        }elseif($modeId == 3){
                            $urlText = 'cv-mode';
                        }
                        $urlParams = [$serie->main_cateid, $urlText, $modeId, preg_replace('/\s+/', '', $serie->slug), $serie->se_id];
                    } else {
                        $urlParams = [$serie->main_cateid, preg_replace('/\s+/', '-', $serie->url_item), $serie->cate_id, preg_replace('/\s+/', '', $serie->slug), $serie->se_id];
                    }
                @endphp
                <div class="series-list-home">
                    <div class="">
                        <div class="d-block ">
                            <div class="m-auto series-img">
                                @if($serie->se_id == 26)
                                <a class="color:inherit;" href="{{route('configurableProductDetail')}}">
                                    @else
                                    <a style="color:inherit;" class=""
                                        href="{{ route('productList',$urlParams)}}">
                                        @endif
                                        @if(isset($serie->image))
                                        <img data-src="{{config('app.url')}}/medias/categories/{{$serie->image}}"
                                            loading="lazy" class="img-fluid m-auto lazyload" src="" alt="">
                                        @else
                                        <img data-src="{{asset('frontend-asset/image/blank.png')}}" loading="lazy"
                                            class="img-fluid m-auto lazyload" alt="">
                                        @endif
                                    </a>
                            </div>
                        </div>
                        <div class="series-text text-center">
                            <div class="d-flex h-title">
                                @if($serie->se_id == 26)
                                <a style="color:inherit;" class="m-auto" href="{{route('configurableProductDetail')}}">
                                    @else
                                    <a style="color:inherit;" class="m-auto"
                                        href="{{ route('productList',$urlParams)}}">
                                        @endif
                                        <h3 class="text-dark  m-0">{{$serie->title}}</h3>
                                    </a>
                            </div>
                            @if($serie->se_id == 26)
                            <a style="color:inherit;" class="m-auto" href="{{route('configurableProductDetail')}}">
                                @else
                                <a style="color:inherit;" class="m-auto"
                                    href="{{ route('productList',$urlParams)}}">
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
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- event -->
<div class="visible-desk-up">
    <div class="box-events  ">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <h2 class="text-title-delta-home">{{$staticContent['Upcoming_Event']}}</h2>
                    @if(isset($events[0]))
                    <div class="card border-radius-6">
                        <a href="{{route('updateEventDetail',$events[0]['slug'])}}">
                            <div class="post-image">
                                <img data-src="{{config('app.url')}}/uploads_delta/{{$events[0]['thumb']}}"
                                    loading="lazy" alt="" class="img-responsive lazyload">
                            </div>
                        </a>
                        <div class="news-content w-100">
                            <div class="post-meta">
                                <span class="author text-uppercase">
                                    <i class="zmdi zmdi-calendar-alt"></i>
                                    {{$events[0]['date']}}
                                </span>
                                <span class="locations">
                                    &nbsp; <i class="zmdi zmdi-pin"></i> {{$events[0]['location']}}
                                </span>
                            </div>

                            <h4 class="post-header title-new">
                                <a href="{{route('updateEventDetail',$events[0]['slug'])}}">
                                    {{$events[0]['title']}}
                                </a>
                            </h4>

                            <p>
                                {!! iconv_substr(strip_tags($events[0]['content']),0,90,'UTF-8') !!} ...
                            </p>
                        </div>
                        <a href="{{route('updateEventDetail',$events[0]['slug'])}}"
                            class="read-more">{{$staticContent['Read_More']}}</a>
                    </div>
                    @endif
                    <div class="box-btn-boxen">
                        <a class="btn btn-boxen" href="{{route('index','events')}}">{{$staticContent['See_All']}}</a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <h2 class="text-title-delta-home">{{$staticContent['Latest_News']}}</h2>
                    @if(isset($news[0]))
                    <div class="card border-radius-6">
                        <a href="{{route('updateNewsDetail',$news[0]['slug'])}}">
                            <div class="post-image">
                                <img data-src="{{config('app.url')}}/uploads_delta/{{$news[0]['thumb']}}" loading="lazy"
                                    alt="" class="img-responsive lazyload">
                            </div>
                        </a>
                        <div class="news-content w-100">

                            <div class="post-meta">
                                <a href="{{route('updateNewsDetail',['name'=> $news[0]['slug']])}}">
                                    <span class="sub-news" style="color:{{$news[0]['color_type']}}">
                                        {{$news[0]['cateName']}}
                                    </span>
                                </a>

                                <img class="line-symbol" src="{{asset('/frontend-asset/image/line-symbol.svg')}}"
                                    alt="">
                                <span class="author text-uppercase">
                                    {{$news[0]['date']}} <i class="zmdi zmdi-calendar-alt"></i>



                                </span>
                                @if(isset($news[0]['location']))
                                <span class="locations">
                                    &nbsp; <i class="zmdi zmdi-pin"></i> {{$news[0]['location']}}
                                </span>
                                @endif
                            </div>
                            <h4 class="post-header title-new">
                                <a href="{{route('updateNewsDetail',$news[0]['slug'])}}">
                                    {{$news[0]['title']}}
                                </a>
                            </h4>
                            <p> {!! iconv_substr(strip_tags($news[0]['content']),0,90,'UTF-8') !!} ...
                            </p>
                        </div>
                        <a href="{{route('updateNewsDetail',$news[0]['slug'])}}"
                            class="read-more">{{$staticContent['Read_More']}}</a>
                    </div>
                    @endif
                    <div class="box-btn-boxen">
                        <a class="btn btn-boxen" href="{{route('index','news')}}">{{$staticContent['See_All']}}</a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <h2 class="text-title-delta-home">{{$staticContent['FAQs']}}</h2>
                    <div class="card border-radius-6">
                        <a href="{{route('index','faqs')}}">
                            <div class="post-image w-100">

                                <img data-src="{{config('app.url')}}/medias/static_content/{{$faqbanner->destop_image}}"
                                    loading="lazy" alt="" class="img-responsive lazyload">
                            </div>
                        </a>
                        <div class="news-content w-100">
                            <div class="post-meta">


                            </div>
                            <a href="{{route('index','faqs')}}">
                                <h4 class="post-header title-new">
                                    FAQs
                                </h4>
                            </a>
                            <p>
                            </p>

                        </div>
                        <a href="{{route('index','faqs')}}" class="read-more">{{$staticContent['Read_More']}}</a>
                    </div>
                    <div class="box-btn-boxen">
                        <a class="btn btn-boxen" href="{{route('index','faqs')}}">{{$staticContent['See_All']}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="visible-nav-minimize">
    <div class="box-events  ">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-md-6">
                    <h2 class="text-title-delta-home">{{$staticContent['Upcoming_Event']}}</h2>
                    @if(isset($events[0]))
                    <div class="card border-radius-6">
                        <a href="{{route('updateEventDetail',$events[0]['slug'])}}">
                            <div class="post-image">
                                @if(isset($events[0]['thumb']))
                                <img src="{{config('app.url')}}/uploads_delta/{{$events[0]['thumb']}}" alt=""
                                    class="img-responsive">
                                @else
                                <img src="{{config('app.url')}}/frontend-asset/image/upcoming-img.png" alt=""
                                    class="img-responsive">
                                @endif
                            </div>
                        </a>
                        <div class="news-content w-100">
                            <?php
                            // $date = getDateformat(isset($events[0]->date_publish)? $events[0]->date_publish:'00:00:00');
                            //  $endDate = getDateformat(isset($events[0]->date_end)? $events[0]->date_end:'00:00:00');
                             ?>

                            <div class="post-meta">
                                <span class="author text-uppercase">
                                    {{-- <i class="zmdi zmdi-calendar-alt"></i> {{ $date['m'].' '.$date['d']
                                    .''.(isset($endDate['d'])?' - '.$endDate['d']:'').' '.$date['y']}} --}}
                                </span>

                                @if(isset($events[0]['location']))
                                <span class="locations">
                                    <i class="zmdi zmdi-pin"></i> {{$events[0]['location']}}
                                </span>
                                @endif
                            </div>
                            <h4 class="post-header title-new">
                                <a href="{{route('updateEventDetail',$events[0]['slug'])}}">
                                    {{$events[0]['title']}}
                                </a>
                            </h4>
                            {{-- <p> {!! iconv_substr(strip_tags($events[0]->content),0,90,'UTF-8') !!} ...
                            </p> --}}

                        </div>
                        <a href="{{route('updateEventDetail',$events[0]['slug'])}}"
                            class="read-more">{{$staticContent['Read_More']}}</a>
                    </div>
                    @endif
                    <div class="box-btn-boxen">
                        <a class="btn btn-boxen" href="{{route('index','events')}}">{{$staticContent['See_All']}}</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <h2 class="text-title-delta-home">{{$staticContent['Latest_News']}}</h2>
                    @if(isset($news[0]))
                    <div class="card border-radius-6">
                        <a href="{{route('updateNewsDetail',$news[0]['slug'])}}">
                            <div class="post-image">
                                @if(isset($news[0]['thumb']))
                                <img data-src="{{config('app.url')}}/uploads_delta/{{$news[0]['thumb']}}" loading="lazy"
                                    alt="" class="img-responsive lazyload">
                                @else
                                <img data-src="{{config('app.url')}}/frontend-asset/image/upcoming-img.png"
                                    loading="lazy" alt="" class="img-responsive lazyload">
                                @endif
                            </div>
                        </a>
                        <div class="news-content w-100">
                            <div class="post-meta">
                                <a href="{{route('updateNewsDetail',['name'=> $news[0]['slug']])}}">
                                    <span class="sub-news" style="color:{{$news[0]['color_type']}}">
                                        {{$news[0]['cateName']}}
                                    </span>
                                </a>
                                <img class="line-symbol" src="{{asset('/frontend-asset/image/line-symbol.svg')}}"
                                    alt="">
                                <span class="author text-uppercase">
                                    <i class="zmdi zmdi-calendar-alt"></i>

                                    {{$news[0]['date']}}
                                </span>
                                @if(isset($news[0]['location']))
                                <span class="locations">
                                    <i class="zmdi zmdi-pin"></i>{{$news[0]['location']}}
                                </span>
                                @endif
                            </div>

                            <h4 class="post-header title-new">
                                <a href="{{route('updateNewsDetail',$news[0]['slug'])}}">
                                    {{$news[0]['title']}}
                                </a>
                            </h4>


                        </div>
                        <a href="{{route('updateNewsDetail',$news[0]['slug'])}}"
                            class="read-more">{{$staticContent['Read_More']}}</a>
                    </div>
                    @endif
                    <div class="box-btn-boxen">
                        <a class="btn btn-boxen" href="{{route('index','news')}}">{{$staticContent['See_All']}}</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <h2 class="text-title-delta-home">{{$staticContent['FAQs']}}</h2>
                    <div class="card border-radius-6">
                        <a href="{{route('index','faqs')}}">
                            <div class="post-image w-100">
                                <img src="{{config('app.url')}}/medias/static_content/{{$faqbanner->destop_image}}"
                                    alt="" class="img-responsive">
                                {{-- <img src="{{config('app.url')}}/frontend-asset/image/faqs.jpg" alt=""
                                    class="img-responsive"> --}}
                            </div>
                        </a>
                        <div class="news-content w-100">
                            <div class="post-meta">


                            </div>
                            <a href="{{route('index','faqs')}}">
                                <h4 class="post-header title-new">
                                    FAQs
                                </h4>
                            </a>
                            <p>
                            </p>

                        </div>
                        <a href="{{route('index','faqs')}}" class="read-more">{{$staticContent['Read_More']}}</a>
                    </div>
                    <div class="box-btn-boxen">
                        <a class="btn btn-boxen" href="{{route('index','faqs')}}">{{$staticContent['See_All']}}</a>
                    </div>
                </div>

            </div>
            {{-- <h2 class="text-title-delta-home">{{$staticContent['Latest_Article']}}</h2>
            <div class="row">
                @foreach ($teachni as $tech)
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <a href="{{route('updateTechnicalDetail',$tech->slug)}}">
                            <div class="post-image">
                                @if(isset($tech->thumb))
                                <img src="{{config('app.url')}}/uploads_delta/{{$tech->thumb}}" alt=""
                                    class="img-responsive">
                                @else
                                <img src="{{config('app.url')}}/frontend-asset/image/upcoming-img.png" alt=""
                                    class="img-responsive">
                                @endif
                            </div>
                        </a>
                        <div class="news-content w-100">
                            <div class="post-meta">
                                @if(isset($tech->date_info))

                                <span class="author text-uppercase">
                                    <i class="zmdi zmdi-calendar-alt"></i>
                                    {{$teachdate['m'].' '.$teachdate['d'].' '.$teachdate['y']}}
                                </span>
                                @endif
                                @if(isset($tech->location))
                                <span class="locations">
                                    <i class="zmdi zmdi-pin"></i>{{$tech->location}}
                                </span>
                                @endif
                            </div>
                            <h4 class="post-header title-new">
                                <a href="{{route('updateTechnicalDetail',$tech->slug)}}">
                                    {{$tech->title}}
                                </a>
                            </h4>
                            <p> {!! iconv_substr(strip_tags($tech->content),0,90,'UTF-8') !!} ...
                            </p>

                        </div>
                        <a href="{{route('updateTechnicalDetail',$tech->slug)}}"
                            class="read-more">{{$staticContent['Read_More']}}</a>
                    </div>
                </div>
                @endforeach

            </div>
            <div class="box-btn-boxen text-center">
                <a class="btn btn-boxen"
                    href="{{route('index','technical-articles')}}">{{$staticContent['See_All']}}</a>
            </div> --}}
        </div>

    </div>

</div>
<!-- box-product-document -->
<div class="visible-desk-up">
    <div class="box-product-document">
        <div class="container">
            <div class="box-product-document-all midle-item">
                <h3 class="text-title-banner">{{$static_content->title}}</h3>
                <div class="text-be-first">
                    {!! $static_content->content !!}
                </div>
                <a href="{{route('index','product-documents')}}">
                    <button class="btn btn-subscribe" href="">{{$staticContent['Learn_More']}}</button>
                </a>
            </div>

            <img loading="lazy" data-src="{{config('app.url')}}/medias/static_content/{{$static_content->destop_image}}"
                class="image-doc lazyload" alt="">
        </div>
    </div>
</div>
<div class="visible-nav-minimize">
    <div class="box-product-document-mobile"
        style=" background: url('{{asset('frontend-asset/image/Docdownload-BG.webp')}}');">
        <img class="image-doc lazyload" loading="lazy"
            data-src="{{config('app.url')}}/medias/static_content/{{$static_content->destop_image}}" alt="">
        <div class="container">
            <div class="box-product-document-all">
                <h2 class="text-title-banner">{{$static_content->title}}</h2>
                <div class="text-be-first">
                    {!! $static_content->content !!}
                </div>
                <a href="{{route('index','product-documents')}}">
                    <button class="btn btn-subscribe" href="">{{$staticContent['Learn_More']}}</button>
                </a>
            </div>
        </div>
    </div>
</div>


@endsection
@section('js')

<script>
    $(document).ready(function () {
        $('#nav-two').removeClass('scrolled');

    });

    function seeMore() {

        if ($(".blogBox-mb:hidden").length === 8) {
            $("#loadMore-application-mobile").hide();
        } else if ($(".blogBox-mb:hidden").length != 0) {
            $("#loadMore-application-mobile").show();
        }
        if ($(".blogBox:hidden").length === 8) {
            $("#loadMore-application").hide();
        } else if ($(".blogBox:hidden").length != 0) {
            $("#loadMore-application").show();
        }
        $("#loadMore-application").on('click', function (e) {
            e.preventDefault();
            $(".moreBox:hidden").slice(0, 2).slideDown();
            if ($(".moreBox:hidden").length == 0) {
                $("#loadMore-application").fadeOut('slow');
            }
        });
        $("#loadMore-application-mobile").on('click', function (e) {
            e.preventDefault();
            $(".moreBox-mb:hidden").slice(0, 2).slideDown();
            if ($(".moreBox-mb:hidden").length == 0) {
                $("#loadMore-application-mobile").fadeOut('slow');
            }
        });
    }

    function showBtnSeeMore(w) {
        if (w <= 1205) {
            $('#loadMore-application').show();
            $(".moreBox").slice(0, 4).show();
            $(".moreBox").slice(4, 9).hide();
            $(".moreBox-mb").slice(0, 4).show();
            $(".moreBox-mb").slice(4, 9).hide();
            seeMore();
        } else {
            $('#loadMore-application').hide();
            $(".moreBox").slice(0, 9).show();
            seeMore();
        }
    }
    $('#loadMore-application').hide();
    $('#loadMore-application-mobile').hide();
    $(document).ready(function () {
        var w = $(window).width();
        showBtnSeeMore(w);
    });
    $(window).resize(function () {
        var w = $(window).width(); // New width
        showBtnSeeMore(w);

    });

</script>
<script>
    $.fn.moveIt = function () {
        var $window = $(window);
        var instances = [];

        $(this).each(function () {
            instances.push(new moveItItem($(this)));
        });

        window.onscroll = function () {
            var scrollTop = $window.scrollTop();
            instances.forEach(function (inst) {
                inst.update(scrollTop);
            });

        }
    }

    var moveItItem = function (el) {
        this.el = $(el);
        this.speed = parseInt(this.el.attr('data-scroll-speed'));
    };

    moveItItem.prototype.update = function (scrollTop) {
        var pos = scrollTop / this.speed;
        this.el.css('transform', 'translateY(' + -pos + 'px)');
    };

    $(function () {
        $('[data-scroll-speed]').moveIt();
    });

</script>
<script>
    $(document).ready(function () {
        $("#producttype").owlCarousel({
            loop: false,
            margin: 24,
            dotsEach: 3,
            nav: true,
            responsive: {
                0: {
                    items: 1

                },
                600: {
                    items: 2
                },
                1000: {
                    items: 3
                },
                1200: {
                    items: 4
                }
            },
            navText: ['<i class="zmdi zmdi-chevron-left" aria-hidden="true"></i>',
                '<i class="zmdi zmdi-chevron-right" aria-hidden="true"></i>',
            ]
        });

        $("#producttype-mobile").owlCarousel({
            loop: false,
            margin: 24,
            dotsEach: 3,
            nav: true,
            responsive: {
                0: {
                    items: 1

                },
                600: {
                    items: 2
                },
                1000: {
                    items: 3
                },
                1200: {
                    items: 4
                }
            },
            navText: ['<i class="zmdi zmdi-chevron-left" aria-hidden="true"></i>',
                '<i class="zmdi zmdi-chevron-right" aria-hidden="true"></i>',
            ]
        });
        $("#slide-banner").owlCarousel({
            loop: true,
            navigation: true,
            slideSpeed: 500,
            paginationSpeed: 500,
            singleItem: true,
            items: 1,
            autoplay:true,
            autoplaySpeed: 2000,
            autoplayHoverPause:true
        });

        $("#slide-banner-mobile").owlCarousel({
            loop: true,
            navigation: true,
            slideSpeed: 300,
            paginationSpeed: 400,
            singleItem: true,
            items: 1,
            autoplay:true,
            autoplaySpeed: 2000,
            autoplayHoverPause:true

        });
        const mainCateCount = {{ count($mainCategories) }};
        $("#product-selector-carousel").owlCarousel({
            loop: false,
            margin: 10,
            dotsEach: 3,
            nav: true,
            center: mainCateCount == 1,
            responsive: {
                0: {
                    items: 2,
                },
                600: {
                    items: 3,
                },
                992: {
                    items: 4,
                },
                1200: {
                    items: 5,
                },
                1400: {
                    items: 5,
                }
            },
            navText: ['<i class="zmdi zmdi-chevron-left" aria-hidden="true"></i>',
                '<i class="zmdi zmdi-chevron-right" aria-hidden="true"></i>',
            ]
        });
        $("#product-selector-carousel-mobile").owlCarousel({
            loop: true,
            margin: 10,
            dotsEach: 3,
            nav: true,
            responsive: {
                0: {
                    items: 1

                },
                375: {
                    items: 2

                },
                700: {
                    items: 3
                }
            },
            navText: ['<i class="zmdi zmdi-chevron-left" aria-hidden="true"></i>',
                '<i class="zmdi zmdi-chevron-right" aria-hidden="true"></i>',
            ]
        });

    });
    /* navbar */
    /* var w = document.documentElement.clientWidth;
    var h = document.documentElement.clientHeight;
    var scrollTopBtn = document.getElementById("scrollTop");
    var textscrollTopBtn = document.getElementById("text-scrollTop"); */
   /*  $(window).scroll(function () {
        $('#nav-two').toggleClass('scrolled', $(this).scrollTop() > 50);

        $('#bar-search-results-nav').removeClass('scrolled');
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            scrollTopBtn.style.display = "block";
            textscrollTopBtn.style.display = "block";
        } else {
            scrollTopBtn.style.display = "none";
            textscrollTopBtn.style.display = "none";
        }

    }); */

</script>

@endsection