@extends('layouts.front-end')
@section('css')
<style>
    #slide-application .owl-item div {
        height: 360px;
        background-size: cover;
        background-repeat: no-repeat;

    }


    #slide-application-mobile .owl-item div {
        height: 250px;
        background-size: cover;
        background-repeat: no-repeat;
    }

    #slide-application .owl-dots,
    #slide-application-mobile .owl-dots {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
    }

    .image-slide {
        padding-right: 18px;
    }

    .app-text-detail {
        padding-left: 18px;
    }

    #related-product .item-related,
    #related-product-mobile .item-related {
        width: 100%;
        height: 200px;
        border: 2px solid #E3EFF8;
        background-size: cover;
        background: no-repeat;
        text-align: center;

    }

    #related-product .item-related:hover,
    #related-product-mobile .item-related:hover {
        border: 2px solid #0087DC;
    }

    #related-product .item-related img,
    #related-product-mobile .item-related img {
        padding-top: 10px;
        max-width: 100%;
        margin-left: auto;
        margin-right: auto;
        margin-bottom: 20px;
    }

    .item-related:hover .text-title-twenty-dark {
        color: #0087DC;
    }

    .item-related:hover .text-hover {
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        visibility: visible;
    }

    .text-hover {
        visibility: hidden;
        line-height: 1;
        color: #5F5F5F;
        font-size: 14px;

    }

    .other-applications-grid {
        display: flex;
        flex-wrap: wrap;
    }

    .other-applications-list {
        height: auto;
        padding: 24px;
        border: 2px solid #E3EFF8;
        margin-bottom: 20px;

    }

    .other-applications-list img {
        width: 64px;
    }

    .other-applications-grid-mobile {
        display: flex;
        flex-wrap: wrap;
    }

    .other-applications-grid-mobile-list {
        border: 2px solid #E3EFF8;
        display: block;
        margin: 12px 0;
    }

    @media only screen and (max-width:1365px) {

        .other-applications-list {
            flex: 0 0 0 30%;
            margin: 12px;
            padding: 10px;
        }

    }

    @media only screen and (max-width:1200px) {

        .other-applications-list {
            flex: 0 0 0 30%;
            margin: 12px;
            padding: 10px;
        }

    }

    @media only screen and (max-width:992px) {

        .other-applications-grid-mobile-list {}

    }

    @media (max-width:560px) {
        .other-applications-grid-mobile {
            grid-template-columns: 1fr;
        }

        #related-product-mobile {
            padding-left: 10px;
            padding-right: 10px;
        }

        #product-selector-carousel-mobile .owl-prev,
        #related-product-mobile .owl-prev {
            left: -20px;
        }

        #product-selector-carousel-mobile .owl-next,
        #related-product-mobile .owl-next {
            right: -20px;
        }
    }

    p b {
        font-weight: bold;
    }

    .text-title-twenty-dark {
        line-height: 1;
    }

    .h-text-app {
        /* height: 50px; */
        width: 163px;
        top: 50%;
        left: 30%;
        -webkit-transform: translate(30%, -50%);
        -ms-transform: translate(30%, -50%);
        transform: translate(30%, -50%);
        text-align: left;
        vertical-align: middle;
        position: absolute;
        word-break: break-all;
    }

    .app-middle-box {
        display: flex;
        height: 90px;
        position: relative;
    }

    .other-applications-grid-mobile-list img {
        height: 70px;
    }

    .content img {
        max-width: 100%;
    }

    .content b {
        font-weight: bold;
    }

    .content table img {
        /* Your specific styles for images within tables */
        /* If you want to ignore images inside tables, you can leave this empty */
        max-width: none;
    }

    .sr-only {
        position: absolute;
        width: 1px;
        height: 1px;
        padding: 0;
        margin: -1px;
        overflow: hidden;
        clip: rect(0, 0, 0, 0);
        border: 0;
    }
</style>
@endsection
@section('meta')
<title>{{isset($application->meta_title)? $application->meta_title : $application->name .' | DeltaPSU'}}</title>
<meta name="description" content="{{isset($application->meta_description)? $application->meta_description :''}}" />
<meta property="og:title"
    content="{{isset($application->meta_title)? $application->meta_title : $application->name .' | DeltaPSU'}}" />
<meta property="og:description"
    content="{{isset($application->meta_description)? $application->meta_description :''}}" />
<meta property="og:image"
    content="{{config('app.url')}}/medias/categories/{{isset($application->banner)  ? $application->banner : '' }}" />
<link rel="canonical" href="{{url()->current()}}" />
<?php 
  $lang_seo = App::getLocale();
  if($lang_seo == 'cn'){
    $lang_seo = 'zh-Hans-CN';
  }else if($lang_seo == 'tw'){
    $lang_seo = 'zh-Hans-TW';
  }
?>
<link rel="alternate" href="{{url()->current()}}" hreflang="{{$lang_seo}}" />

@endsection
@section('container')
<div class="padding-top-content">
</div>
<div class="products-index-nav visible-up-922">
    <div class="bg-bredcrumb">
        <div class="container">
            <nav aria-label="breadcrumb" id="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item text-breadcrumb-home"><a
                            href="{{route('index','home')}}">{{$staticContent['Home']}}</a></li>
                    <li class="breadcrumb-item active text-breadcrumb-home dropdown" aria-current="page"><a href="#"
                            data-toggle="dropdown" id="tools-dropdown"> {{$staticContent['Applications']}}</a>
                        <ul class="dropdown-menu">
                            <li><a href="#" id="tools-dropdown" class="text-bold">{{$staticContent['Applications']}}</a>
                            </li>
                            <hr>
                            @foreach ($navapplication as $app)
                            <li><a
                                    href="{{route('appDetail' ,[ 'name' => $app->slug_app , 'id' => $app->applica_id])}}">{{$app->name}}</a>
                            </li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="breadcrumb-item active text-breadcrumb" aria-current="page"><a
                            href="#">{{$application->name}}</a></li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="visible-up-922">
    @if($application->id == 7)
    <div role="img" alt="Delta provides AC-DC power supplies for medical applications"
        class="banner-type-product-all-new item " style="background:linear-gradient(90deg, rgba(68,68,68,0.45702030812324934) 0%, rgba(255,255,255,0)
        50%),url('{{config('app.url')}}/medias/categories/{{$application->banner}}') center no-repeat; background-size:
        cover;">
        <span class="sr-only">Delta provides AC-DC power supplies for medical applications</span>
        @elseif($application->id == 8)
        <div role="img" alt="Delta industrial switching power supplies" class="banner-type-product-all-new item " style="background:linear-gradient(90deg, rgba(68,68,68,0.45702030812324934) 0%, rgba(255,255,255,0)
            50%),url('{{config('app.url')}}/medias/categories/{{$application->banner}}') center no-repeat; background-size:
            cover;">
            @elseif($application->id == 1)
            <div role="img" alt="Delta’s switching power supply for building automation"
                class="banner-type-product-all-new item " style="background:linear-gradient(90deg, rgba(68,68,68,0.45702030812324934) 0%, rgba(255,255,255,0)
            50%),url('{{config('app.url')}}/medias/categories/{{$application->banner}}') center no-repeat; background-size:
            cover;">
                @elseif($application->id == 9)
                <div role="img" alt="Delta’s outdoor LED driver for street lighting"
                    class="banner-type-product-all-new item " style="background:linear-gradient(90deg, rgba(68,68,68,0.45702030812324934) 0%, rgba(255,255,255,0)
            50%),url('{{config('app.url')}}/medias/categories/{{$application->banner}}') center no-repeat; background-size:
            cover;">
                    @elseif($application->id == 10)
                    <div role="img" alt="Delta power supplies for household appliances"
                        class="banner-type-product-all-new item " style="background:linear-gradient(90deg, rgba(68,68,68,0.45702030812324934) 0%, rgba(255,255,255,0)
                50%),url('{{config('app.url')}}/medias/categories/{{$application->banner}}') center no-repeat; background-size:
                cover;">
                        @else
                        <div {{$application->id}} class="banner-type-product-all-new item "
                            style="background:linear-gradient(90deg, rgba(68,68,68,0.45702030812324934) 0%,
                            rgba(255,255,255,0)
                            50%),url('{{config('app.url')}}/medias/categories/{{$application->banner}}') center
                            no-repeat;
                            background-size:
                            cover;">
                            @endif
                            {{-- style="background-color: #818181;background-image: url('');" --}}
                            <div class="container">
                                <div class="box-banner-pro-type-all-new ">
                                    <div class="text-middle ">
                                        <h1 class="text-title-white">{{$application->name}}</h1>
                                        <div style="width: 440px">
                                            <p class="text-title-white">{{isset($application->h1) ? $application->h1 :
                                                ''}}
                                            </p>
                                        </div>
                                        <div class="text-white">
                                            <?php
                        $str = $application->overview_text;
                        $st = explode("\n", $str);
                        for ($k = 0; $k < count($st); $k++) {
                            echo $st[$k] = '<div>'
                                    . $st[$k]
                                    . '</div>';
                        }
                        ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-application-detail pt-5 ">
                            <div class="container">
                                <div class="row">
                                    <div class="col-6 image-slide">
                                        <div id="slide-application" class="owl-carousel owl-theme">
                                            @if($application->id == 7)
                                            @foreach ($image as $item)
                                            @if($loop->iteration == 1)
                                            <div role="img" alt="Find IEC 60601-1 power supply for medical equipment"
                                                class="item {{($loop->iteration == 1)?" active":""}}"
                                                style="background-image: url('{{config('app.url')}}/medias/categories/{{$item->image_name}}');'">
                                                <span class="sr-only">Find IEC 60601-1 power supply for medical
                                                    equipment
                                                </span>
                                            </div>
                                            @elseif($loop->iteration == 2)
                                            <div role="img" alt="Delta offers medically approved power supply solutions"
                                                class="item {{($loop->iteration == 1)?" active":""}}"
                                                style="background-image: url('{{config('app.url')}}/medias/categories/{{$item->image_name}}');'">
                                                <span class="sr-only">Delta offers medically approved power supply
                                                    solutions</span>
                                            </div>
                                            @else
                                            <div class="item {{($loop->iteration == 1)?" active":""}}"
                                                style="background-image: url('{{config('app.url')}}/medias/categories/{{$item->image_name}}');'">
                                            </div>
                                            @endif
                                            @endforeach

                                            @elseif($application->id == 8)
                                            @foreach ($image as $item)
                                            @if($loop->iteration == 1)
                                            <div role="img"
                                                alt="Delta provides power supplies for industrial automation"
                                                class="item {{($loop->iteration == 1)?" active":""}}"
                                                style="background-image: url('{{config('app.url')}}/medias/categories/{{$item->image_name}}');'">
                                                <span class="sr-only">Delta provides power supplies for industrial
                                                    automation</span>
                                            </div>
                                            @elseif($loop->iteration == 2)
                                            <div role="img" alt="Delta power supplies for industrial automation"
                                                class="item {{($loop->iteration == 1)?" active":""}}"
                                                style="background-image: url('{{config('app.url')}}/medias/categories/{{$item->image_name}}');'">
                                                <span class="sr-only">Delta power supplies for industrial
                                                    automation</span>
                                            </div>
                                            @else
                                            <div class="item {{($loop->iteration == 1)?" active":""}}"
                                                style="background-image: url('{{config('app.url')}}/medias/categories/{{$item->image_name}}');'">
                                            </div>
                                            @endif
                                            @endforeach

                                            @elseif($application->id == 1)
                                            @foreach ($image as $item)
                                            @if($loop->iteration == 1)
                                            <div role="img" alt="Delta power supplies for security systems"
                                                class="item {{($loop->iteration == 1)?" active":""}}"
                                                style="background-image: url('{{config('app.url')}}/medias/categories/{{$item->image_name}}');'">
                                                <span class="sr-only">Delta power supplies for security systems</span>
                                            </div>
                                            @elseif($loop->iteration == 2)
                                            <div role="img" alt="Delta installs power supplies for security systems"
                                                class="item {{($loop->iteration == 1)?" active":""}}"
                                                style="background-image: url('{{config('app.url')}}/medias/categories/{{$item->image_name}}');'">
                                                <span class="sr-only">Delta installs power supplies for security
                                                    systems</span>
                                            </div>
                                            @else
                                            <div alt="Delta’s building automation systems power supplies"
                                                class="item {{($loop->iteration == 1)?" active":""}}"
                                                style="background-image: url('{{config('app.url')}}/medias/categories/{{$item->image_name}}');'">
                                            </div>
                                            @endif
                                            @endforeach

                                            @elseif($application->id == 9)
                                            @foreach ($image as $item)
                                            @if($loop->iteration == 1)
                                            <div role="img"
                                                alt="Delta’s dimmable constant current LED driver for various light uses"
                                                class="item {{($loop->iteration == 1)?" active":""}}"
                                                style="background-image: url('{{config('app.url')}}/medias/categories/{{$item->image_name}}');'">
                                                <span class="sr-only">Delta’s dimmable constant current LED driver for
                                                    various light uses</span>
                                            </div>
                                            @elseif($loop->iteration == 2)
                                            <div role="img" alt="Find a reliable D4i LED driver for IoT smart lighting"
                                                class="item {{($loop->iteration == 1)?" active":""}}"
                                                style="background-image: url('{{config('app.url')}}/medias/categories/{{$item->image_name}}');'">
                                                <span class="sr-only">Find a reliable D4i LED driver for IoT smart
                                                    lighting</span>
                                            </div>
                                            @else
                                            <div alt="Programmable LED driver for sports arena lighting"
                                                class="item {{($loop->iteration == 1)?" active":""}}"
                                                style="background-image: url('{{config('app.url')}}/medias/categories/{{$item->image_name}}');'">
                                            </div>
                                            @endif
                                            @endforeach
                                            @elseif($application->id == 10)
                                            @foreach ($image as $item)
                                            @if($loop->iteration == 1)
                                            <div role="img" alt="Coffee machine with a power supply by Delta"
                                                class="item {{($loop->iteration == 1)?" active":""}}"
                                                style="background-image: url('{{config('app.url')}}/medias/categories/{{$item->image_name}}');'">
                                                <span class="sr-only">Coffee machine with a power supply by Delta</span>
                                            </div>
                                            @elseif($loop->iteration == 2)
                                            <div role="img" alt="Modern office vending machine"
                                                class="item {{($loop->iteration == 1)?" active":""}}"
                                                style="background-image: url('{{config('app.url')}}/medias/categories/{{$item->image_name}}');'">
                                                <span class="sr-only">Modern office vending machine</span>
                                            </div>
                                            <div class="item {{($loop->iteration == 1)?" active":""}}"
                                                style="background-image: url('{{config('app.url')}}/medias/categories/{{$item->image_name}}');'">
                                            </div>
                                            @endif
                                            @endforeach

                                            @else
                                            @foreach ($image as $item)
                                            <div class="item {{($loop->iteration == 1)?" active":""}}"
                                                style="background-image: url('{{config('app.url')}}/medias/categories/{{$item->image_name}}');'">
                                            </div>
                                            @endforeach
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-6 app-text-detail">
                                        {{-- <h3 class="text-color-delta">{{$staticContent['Application_Description']}}
                                        </h3>
                                        --}}
                                        <?php echo $application->content ?>

                                        <h3 class="text-color-delta mt-3">{{$staticContent['Typical_Applications']}}
                                        </h3>
                                        <div class="row type-applications">
                                            <?php
                        $str = $application->overview;
                        $st = explode("\n", $str);

                          echo '<ul class="col-6 order-2">';
                            for ($k = 0; $k < count($st); $k++) {
                                if($k % 2 > 0){
                                    echo $st[$k] = '<li>'
                                        . $st[$k]
                                        . '</li>';
                                    }
                                
                                
                            }
                            echo '</ul>';
                            echo '<ul class="col-6 order-1">';
                            for ($k = 0; $k < count($st); $k++) {
                                if($k % 2 == 0){
                                    echo $st[$k] = '<li>'
                                        . $st[$k]
                                        . '</li>';
                                    }
                                
                                
                            }
                            echo '</ul>';

                        ?>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="content">
                                            <?php echo $application->content_2 ?>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="box-relate-product ">
                            <div class="container">
                                <h2 class="text-title-delta">{{$staticContent['Related_Product_Series']}}</h2>
                                <div id="related-product"
                                    class="owl-carousel owl-theme ft-products-body owl-loaded owl-drag mr-b-12px">
                                    @foreach ($relatedApp as $serie)
                                    <div class="item-related d-flex">
                                        <a style="color:inherit;" class=""
                                            href="{{ route('productBySeries',[$serie->title,$serie->se_id])}}">
                                            <div class="m-auto">
                                                {{-- <img src="{{asset('frontend-asset/image/CliQ VA@2x.png')}}" alt="">
                                                --}}
                                                @if(isset($serie->image))
                                                <img src="{{config('app.url')}}/medias/categories/{{$serie->image}}"
                                                    alt="">
                                                @else
                                                <img src="{{asset('frontend-asset/image/blank.png')}}" alt="">
                                                @endif
                                                <p class="text-title-twenty-dark">{{$serie->title}}</p>

                                                {{-- <p class="text-hover">{!!
                                                    iconv_substr(strip_tags($serie->overview_content),0,90,'UTF-8') !!}
                                                    ...
                                                </p> --}}
                                            </div>
                                        </a>
                                    </div>
                                    @endforeach

                                </div>

                                <p style="color:#9098a9;" class="text-center">
                                    {{$staticContent['This_is_general_information']}}</p>
                                <div class="in-div-center mt-4 mb-5">
                                    <a href="{{route('contactSupport')}}"
                                        class="btn btn-border-delta">{{$staticContent['contact_us']}}</a>
                                </div>

                            </div>
                        </div>
                        <div class="box-other-applications pb-5 ">
                            <div class="container">
                                <h2 class="text-title-delta">{{$staticContent['Other_Application']}}</h2>
                                <div class="row">
                                    @foreach ($otherapp as $app)
                                    <div class="col-lg-3">
                                        <a href="{{route('appDetail' ,[ 'name' => $app->slug_app , 'id' => $app->applica_id])}}"
                                            class="other-applications-list media">

                                            <div class="app-middle-box align-self-center">
                                                <img class="mr-3"
                                                    src="{{config('app.url')}}/medias/categories/{{$app->color_icon}}">
                                                <div class="h-text-app">
                                                    <h6 class="text-title-dark">{{$app->name}} </h6>
                                                </div>
                                            </div>


                                        </a>
                                    </div>

                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="invisible-up-922 mb-4">
                        <div class="banner-type-product-all"
                            style="background-image: url('{{config('app.url')}}/medias/categories/{{$application->banner}}'); height:250px !important;">
                        </div>
                        <div class="container">
                            <h3 class="text-center text-color-delta mt-4">{{$application->name}}</h3>
                            <p class="text-center ">
                                <?php
            $str = $application->overview_text;
            $st = explode("\n", $str);
            for ($k = 0; $k < count($st); $k++) {
                echo $st[$k] = '<div>'
                        . $st[$k]
                        . '</div>';
            }
            ?>
                            </p>


                            {{-- <h4 class="text-color-delta">{{$staticContent['Application_Description']}}</h4> --}}
                            <div class="text-editor">
                                <?php echo $application->content ?>
                            </div>
                            <h4 class="text-color-delta mt-4">{{$staticContent['Typical_Applications']}}</h4>
                            <div class="row type-applications">
                                <?php
            $str = $application->overview;
            $st = explode("\n", $str);

              echo '<ul class="col-6 order-2">';
                for ($k = 0; $k < count($st); $k++) {
                    if($k % 2 > 0){
                        echo $st[$k] = '<li>'
                            . $st[$k]
                            . '</li>';
                        }
                    
                    
                }
                echo '</ul>';
                echo '<ul class="col-6 order-1">';
                for ($k = 0; $k < count($st); $k++) {
                    if($k % 2 == 0){
                        echo $st[$k] = '<li>'
                            . $st[$k]
                            . '</li>';
                        }
                    
                    
                }
                echo '</ul>';

            ?>
                            </div>

                            <div class="text-editor">
                                <?php echo $application->content_2 ?>
                            </div>
                            <div class="d-flex">
                                <div id="slide-application-mobile" class="owl-carousel owl-theme mx-auto my-4">
                                    @foreach ($image as $item)
                                    <div class="item {{($loop->iteration == 1)?" active":""}}"
                                        style="background-image: url('{{config('app.url')}}/medias/categories/{{$item->image_name}}');'">
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <h3 class="text-title-delta">{{$staticContent['Related_Product_Series']}}</h3>
                            <div>

                            </div>
                            <div id="related-product-mobile"
                                class="owl-carousel owl-theme ft-products-body owl-loaded owl-drag mr-b-12px">
                                @foreach ($relatedApp as $serie)
                                <div class="item-related d-flex">
                                    <a style="color:inherit;" class=""
                                        href="{{ route('productBySeries',[$serie->title,$serie->se_id])}}">
                                        <div class="m-auto">
                                            @if(isset($serie->image))
                                            <img src="{{config('app.url')}}/medias/categories/{{$serie->image}}" alt="">
                                            @else
                                            <img src="{{asset('frontend-asset/image/blank.png')}}" alt="">
                                            @endif
                                            <p class="text-title-twenty-dark">{{$serie->title}}</p>
                                            {{-- <p class="text-hover">{!!
                                                iconv_substr(strip_tags($serie->overview_content),0,90,'UTF-8')
                                                !!} ...</p> --}}
                                        </div>
                                        <div class="d-"></div>
                                    </a>
                                </div>
                                @endforeach
                            </div>
                            <p style="color:#9098a9;" class="text-center mt-4">
                                {{$staticContent['This_is_general_information']}}</p>
                            <div class="in-div-center my-3">
                                <a href="{{route('contactSupport')}}"
                                    class="btn btn-border-delta mb-3">{{$staticContent['contact_us']}}</a>
                            </div>
                            <h3 class="text-title-delta">{{$staticContent['Other_Application']}}</h3>
                            <div class="container">
                                <div class="row">
                                    @foreach ($otherapp as $app)

                                    <div class="col-md-6">
                                        <a href="{{route('appDetail' ,[ 'name' => $app->slug_app , 'id' => $app->applica_id])}}"
                                            class="other-applications-grid-mobile-list">
                                            <img class="center my-2"
                                                src="{{config('app.url')}}/medias/categories/{{$app->color_icon}}">
                                            <h6 class="text-title-dark text-center">{{$app->name}}</h6>
                                        </a>
                                    </div>

                                    @endforeach
                                </div>
                            </div>

                        </div>

                    </div>


                    @endsection


                    @section('js')
                    <script>
                        $(document).ready(function() {
        $("#slide-application").owlCarousel({
            loop: true,
            navigation: true, // Show next and prev buttons
            paginationSpeed: 400,
            singleItem: true,
            items: 1,
            dotsEach: 1,
            autoplay:true,
            autoplaySpeed: 1000,
            autoplayHoverPause:true

            });
        $("#slide-application-mobile").owlCarousel({
            loop: true,
            navigation: true, // Show next and prev button
            paginationSpeed: 400,
            singleItem: true,
            items: 1,
            dotsEach: 1,
            autoplay:true,
            autoplaySpeed: 1000,
            autoplayHoverPause:true

        });
        $("#related-product").owlCarousel({
                loop: false,
                margin: 24,
                /* autoWidth:true, */
                nav: true,
                responsive: {
                    0: {
                       items: 1
                       },
                    1000: {
                       items: 4
                       },
                    1200: {
                       items: 6
                       }
                },
                navText: ['<i class="zmdi zmdi-chevron-left" aria-hidden="true"></i>',
                            '<i class="zmdi zmdi-chevron-right" aria-hidden="true"></i>',
                ]
            
        });
          
        $("#related-product-mobile").owlCarousel({
                loop: false,
                margin: 24,
                /* autoWidth:true, */
                dotsEach: 3,
                nav: true,
                responsive: {
                    0: {
                       items: 1
                       },
                    400: {
                       items: 2
                    },
                    550: {
                       items: 3
                       }
                },
                navText: ['<i class="zmdi zmdi-chevron-left" aria-hidden="true"></i>',
                            '<i class="zmdi zmdi-chevron-right" aria-hidden="true"></i>',
                ]
            
        });
    });
    
                    </script>
                    @endsection