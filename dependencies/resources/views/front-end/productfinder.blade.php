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
<title>{{isset($metatag[0]->title)? $metatag[0]->title :''}}</title>
<meta name="description" content="{{isset($metatag[0]->description)? $metatag[0]->description :''}}">
<link rel="canonical" href="{{url()->current()}}" />
@endsection
@section('container')
<div class="visible-tablets-up">
    <div class="padding-top-content">
    </div>
    <div class="box-product-finder mb-5">
        <div class="container">
            <h1 class="text-title-delta">{{$staticContent['Product_Selector']}}</h1>
            <h4 class="d-flex justify-content-center mb-4 text-center" style="margin-top: -1rem">{{isset($metatag[0]->h1)? $metatag[0]->h1 :''}}</h4>    
            <div class="row">
                @foreach($mainCategories as $mainCate)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="border-r shadow-radius-box hover-border-blue">
                        
                        @if($mainCate->main_id == 5)
                            <a href="{{ route('configurableproduct')}}">
                                @if($mainCate->banner != null)
                                <img class="w-100 mt-2" src="{{config('app.url')}}/medias/categories/{{$mainCate->banner}}"
                                    alt="">
                                @else
                                <img class="w-100 mt-2" src="{{asset('frontend-asset/image/pro1.png')}}" alt="">
                                @endif
                                <div class="d-block m-auto pt-2 pb-2">
                                    <h4 class="text-title-dark text-center">{{$mainCate->name}} </h4>
                                </div>
                            </a>
                        @else
                            <a href="{{ route('productList',[$mainCate->main_id])}}">
                                @if($mainCate->banner != null)
                                <img class="w-100 mt-2" src="{{config('app.url')}}/medias/categories/{{$mainCate->banner}}"
                                    alt="">
                                @else
                                <img class="w-100 mt-2" src="{{asset('frontend-asset/image/pro1.png')}}" alt="">
                                @endif
                                <div class="d-block m-auto pt-2 pb-2">
                                    <h4 class="text-title-dark text-center">{{$mainCate->name}} </h4>
                                </div>
                            </a>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<div class="visible-mobile">
    <div class="box-product-finder container mb-5">
        <h3 class="text-title-delta">{{$staticContent['Product_Selector']}}</h3>
        <h4 class="d-flex justify-content-center mb-4 text-center" style="margin-top: -1rem">{{isset($metatag[0]->h1)? $metatag[0]->h1 :''}}</h4>  
        <div class="box-product-finder-grid">
            @foreach($mainCategories as $mainCate)
            @if ($mainCate->main_id == 5)
                <a href="{{ route('configurableproduct')}}"
                    class="box-product-finder-item d-flex shadow-radius-box">
                    <div class="m-auto">
                        @if($mainCate->banner != null)
                        <img src="{{config('app.url')}}/medias/categories/{{$mainCate->banner}}" alt="">
                        @else
                        <img src="{{asset('frontend-asset/image/pro1.png')}}" alt="">
                        @endif
                        <h5 class="text-title-dark text-center">{{$mainCate->name}} </h5>
                    </div>
                </a>
            @else
                <a href="{{ route('productList',[$mainCate->main_id])}}"
                class="box-product-finder-item d-flex shadow-radius-box">
                <div class="m-auto">
                    @if($mainCate->banner != null)
                    <img src="{{config('app.url')}}/medias/categories/{{$mainCate->banner}}" alt="">
                    @else
                    <img src="{{asset('frontend-asset/image/pro1.png')}}" alt="">
                    @endif
                    <h5 class="text-title-dark text-center">{{$mainCate->name}} </h5>
                </div>
            </a>
            @endif
            
            @endforeach
        </div>

    </div>
</div>
@endsection
@section('js')
<script>

</script>
@endsection