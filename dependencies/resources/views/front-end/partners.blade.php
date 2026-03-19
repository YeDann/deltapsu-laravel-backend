@extends('layouts.front-end')
@section('css')
<style>
    .tab-content>.active {
        justify-content: unset !important;

        display: block;
    }

    .tab-content {
        margin-top: 24px;
    }

    .search-space {
        margin-bottom: 24px;
    }

    .nav-tabs .nav-link {
        margin: -2px 32px;
    }

    .partners-grid {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }

    .partners-grid-list {
        border: 2px solid #E3EFF8;
        text-align: center;
        text-decoration: none;
        flex: 0 0 0 31.2%;
        width: 31.2%;
        padding: 12px;
        margin: 12px;

    }

    @media (max-width:992px) {
        .partners-grid-list {
            border: 2px solid #E3EFF8;
            text-align: center;
            text-decoration: none;
            flex: 0 0 0 45%;
            width: 45%;
        }
    }

    @media (max-width:500px) {
        .partners-grid-list {
            border: 2px solid #E3EFF8;
            text-align: center;
            text-decoration: none;
            flex: 0 0 0 100%;
            width: 100%;
            padding: 12px;
            margin: 12px;
        }

    }

    a:hover {
        text-decoration: unset;
    }
</style>
@endsection
@section('meta')
<title>{{isset($metatag[0]->title)? $metatag[0]->title :''}}</title>
<meta name="description" content="{{isset($metatag[0]->description)? $metatag[0]->description :''}}">
<link rel="canonical" href="{{url()->current()}}" />
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
                    {{-- <li class="breadcrumb-item active text-breadcrumb-home dropdown" aria-current="page"><a
                            href="#" data-toggle="dropdown" id="tools-dropdown">DOWNLOADS</a>
                        <ul class="dropdown-menu">
                            <li><a href="#" id="tools-dropdown" class="text-bold">DOWNLOADS</a></li>
                            <hr>
                            <li><a href="{{route('index','catalogs')}}">CATALOGS</a></li>
                            <li><a href="">PRODUCT DOCUMENTS</a></li>
                            <li><a href="{{route('index','partners')}}">PARTNERS</a></li>

                        </ul>
                    </li> --}}
                    <li class="breadcrumb-item active text-breadcrumb" aria-current="page"><a
                            href="#">{{$staticContent['Partners']}}</a></li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="padding-top-content-breadcrumb visible-up-922"></div>
<section class="box-news pb-5">
    <h1 class="text-title-delta visible-tablets-up">{{$staticContent['Partners']}}</h1>
    <h3 class="text-title-delta visible-mobile">{{$staticContent['Partners']}}</h3>
    <div class="container">
        <div class="partners-grid">
            <a href="{{route('marketingResources')}}" class="partners-grid-list border-radius-6">
                <img src="{{asset('frontend-asset/image/icon/icon-download-p.svg')}}" alt="">
                <h4 class=" text-dark"> {{$staticContent['Marketing_Resources']}}</h4>
            </a>
            <a href="{{route('productDocLogin')}}" class="partners-grid-list border-radius-6">
                <img src="{{asset('frontend-asset/image/icon/icon-product-doc.svg')}}" alt="">
                <h4 class=" text-dark">{{$staticContent['Product_Documents']}}</h4>
            </a>
        </div>
    </div>
</section>
@endsection


@section('js')

@endsection