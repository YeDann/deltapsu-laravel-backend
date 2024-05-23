@extends('layouts.front-end')
@section('css')
<style>
    .box-product-finder-grid {
        /* display: grid;
        grid-gap: 24px;
        grid-template-columns: 1fr 1fr 1fr;
        text-align: center; */
        display: flex;
        flex-wrap: wrap;



    }

    .box-product-finder-grid a {
        text-decoration: none;
        flex: 0 0 0 31.2%;
        width: 31.2%;
        padding: 12px;
        margin: 12px 0 0 12px;

    }

    .box-product-finder-item {
        position: relative;
        padding: 30px 10px;
        border: 2px solid #E3EFF8;
        height: 280px;

    }

    .box-product-finder-item img {
        width: 100%;
        margin-bottom: 12px;
        margin-left: auto;
        margin-right: auto;
        display: block;
        margin-bottom: 20px;
    }

    .middle-ab {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
    }


    .box-product-finder-item:hover h4,
    .box-product-finder-item:hover h5 {
        color: #0087DC;
    }

    .box-product-finder-item:hover .text-hover {
        display: -webkit-box;
        -webkit-line-clamp: 2;
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

    .text-title-twentyfour {
        text-transform: uppercase;
    }

    @media only screen and (min-width:1001px) and (max-width:1344px) {
        .box-product-finder-grid a {
            text-decoration: none;
            flex: 0 0 0 30.7%;
            width: 30.7%;
        }
    }

    @media only screen and (min-width:768px) and (max-width:1000px) {
        .box-product-finder-grid a {
            text-decoration: none;
            flex: 0 0 0 29.7%;
            width: 29.7%;
        }

        .box-product-finder-item {
            height: 200px;
        }
    }

    @media only screen and (min-width:620px) and (max-width:768px) {

        .box-product-finder-grid a {
            text-decoration: none;
            flex: 0 0 0 46%;
            margin: 12px 0 0 12px;
            width: 46%;
        }

        .box-product-finder-item img {
            width: 100%;

        }

        .box-product-finder-item {
            box-shadow: 0px 4px 5px 2px rgba(0, 0, 0, 0.09);
        }

        .box-product-finder-item {
            height: 280px;
        }

    }

    @media only screen and (max-width:620px) {
        .box-product-finder-grid {
            grid-gap: 24px;
            grid-template-columns: 1fr;
        }

        .box-product-finder-grid a {
            text-decoration: none;
            flex: 0 0 0 100%;
            margin: 12px 0px;
            width: 100%;
        }

        .box-product-finder-item {
            height: 316px;
        }


    }

    @media only screen and (max-width:420px) {
        .box-product-finder-item {
            height: 280px;
        }
    }

    .border-r {
        border: 2px solid #E3EFF8;
    }
</style>
@endsection
@section('meta')
<title>{{isset($metatag[0]->meta_title)? $metatag[0]->meta_title :''}}</title>
<meta name="description" content="{{isset($metatag[0]->meta_description)? $metatag[0]->meta_description :''}}">
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
<div class="visible-tablets-up">
    <div class="padding-top-content">
    </div>
    <div class="products-index-nav">
        <div class="bg-bredcrumb">
            <div class="container">
                <nav aria-label="breadcrumb" id="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item text-breadcrumb-home"><a
                                href="{{route('index','home')}}">{{$staticContent['Home']}}</a></li>
                        <li class="breadcrumb-item active text-breadcrumb-home dropdown" aria-current="page"><a href="#"
                                data-toggle="dropdown" id="tools-dropdown"> {{$staticContent['Tools']}}</a>
                            <ul class="dropdown-menu">
                                <li><a href="#" id="tools-dropdown" class="text-bold">{{$staticContent['Tools']}}</a>
                                </li>
                                <hr>
                                <li><a href="{{route('productFinder')}}">{{$staticContent['Product_Selector']}}</a></li>
                                <li><a
                                        href="{{route('configurableproduct')}}">{{$staticContent['configurable_power_selector']}}</a>
                                </li>
                                <li><a href="{{route('productCoparison')}}">{{$staticContent['product_comparison']}}</a>
                                </li>
                            </ul>
                        </li>
                        <li class="breadcrumb-item active text-breadcrumb" aria-current="page"><a
                                href="#">{{$staticContent['Product_Selector']}}</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="padding-top-content-breadcrumb"></div>
    <div class="box-product-finder mb-5">
        <div class="container">
            <h1 class="text-title-delta">{{$staticContent['Product_Selector']}}</h1>
            <div class="row">
                @foreach($subCategories as $sub)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="border-r">
                        <a class=""
                            href="{{ route('productList',[preg_replace('/\s+/', '-', $sub->url_item),$sub->sub_pro_id])}}">
                            @if($sub->image != null)
                            <img class="w-100 mt-2" src="{{config('app.url')}}/medias/categories/{{$sub->image}}"
                                alt="">
                            @else
                            <img class="w-100 mt-2" src="{{asset('frontend-asset/image/pro1.png')}}" alt="">
                            @endif
                            <div class="d-block m-auto pt-2 pb-2">
                                <h4 class="text-title-dark text-center">{{$sub->name}} </h4>
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<div class="visible-mobile">
    <div class="padding-top-content-breadcrumb"></div>
    <div class="box-product-finder container mb-5">
        <h3 class="text-title-delta">{{$staticContent['Product_Selector']}}</h3>
        <div class="box-product-finder-grid">
            @foreach($subCategories as $sub)
            <a href="{{ route('productList',[preg_replace('/\s+/', '_', $sub->name),$sub->sub_pro_id])}}"
                class="box-product-finder-item d-flex">
                <div class="m-auto">
                    @if($sub->image != null)
                    <img src="{{config('app.url')}}/medias/categories/{{$sub->image}}" alt="">
                    @else
                    <img src="{{asset('frontend-asset/image/pro1.png')}}" alt="">
                    @endif
                    <h5 class="text-title-dark text-center">{{$sub->name}} </h5>
                    {{-- <div class="text-hover text-center">{!! iconv_substr(strip_tags($sub->content),0,90,'UTF-8')
                        !!}...</div> --}}
                </div>
            </a>
            @endforeach
        </div>

    </div>
</div>
@endsection
@section('js')
<script>

</script>
@endsection