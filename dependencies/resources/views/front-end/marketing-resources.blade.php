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

    .marketing-grid {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }

    .marketing-grid-list {
        border: 2px solid #E3EFF8;
        text-align: center;
        text-decoration: none;
        flex: 0 0 0 23%;
        width: 23%;
        padding: 12px;
        margin: 12px;
    }

    @media (max-width:992px) {
        .marketing-grid-list {
            border: 2px solid #E3EFF8;
            text-align: center;
            text-decoration: none;
            flex: 0 0 0 33.30%;
            width: 33.3%;
            padding: 12px;
            margin: 12px;
        }
    }

    @media (max-width:500px) {
        .marketing-grid-list {
            border: 2px solid #E3EFF8;
            text-align: center;
            text-decoration: none;
            flex: 0 0 100%;
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
                    {{-- <li class="breadcrumb-item active text-breadcrumb-home dropdown" aria-current="page"><a
                            href="#" data-toggle="dropdown" id="tools-dropdown">DOWNLOADS</a>
                        <ul class="dropdown-menu">
                            <li><a href="#" id="tools-dropdown" class="text-bold">DOWNLOADS</a></li>
                            <hr>
                            <li><a href="{{route('index','catalogs')}}">CATALOGS</a></li>
                            <li><a href="">PRODUCT DOCUMENTS</a></li>


                        </ul>
                    </li> --}}
                    <li class="breadcrumb-item text-breadcrumb-home"><a
                            href="{{route('index','partners')}}">{{$staticContent['Partners']}}</a></li>
                    <li class="breadcrumb-item active text-breadcrumb" aria-current="page"><a
                            href="#">{{$staticContent['Marketing_Resources']}}</a></li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="padding-top-content-breadcrumb visible-up-922"></div>
<section class="box-news pb-5">
    <h2 class="text-title-delta visible-tablets-up">{{$staticContent['Marketing_Resources']}}</h2>
    <h3 class="text-title-delta visible-mobile">{{$staticContent['Marketing_Resources']}}</h3>
    <div class="container">
        <div class="marketing-grid">
            @if(session('partner_role') == 1)
            <a href="{{route('marketingResourcesDownloads')}}" class="marketing-grid-list">
                <img src="{{asset('frontend-asset/image/icon/icon-download.svg')}}" alt="">
                <h4 class=" text-dark">{{$staticContent['Marketing_Resources_Downloads']}}</h4>
            </a>
            @endif
            @if(session('partner_role') == 2)
            <a href="{{route('marketingResourcesDownloads')}}" class="marketing-grid-list">
                <img src="{{asset('frontend-asset/image/icon/icon-download.svg')}}" alt="">
                <h4 class=" text-dark">{{$staticContent['Marketing_Resources_Downloads']}}</h4>
            </a>
            <a href="{{route('productLaunchSchedule')}}" class="marketing-grid-list">
                <img src="{{asset('frontend-asset/image/icon/icon-schedule.svg')}}" alt="">
                <h4 class=" text-dark"> {{$staticContent['Product_launch_Schedule']}}</h4>
            </a>
            <a href="{{route('successStories')}}" class="marketing-grid-list">
                <img src="{{asset('frontend-asset/image/icon/icon-stories.svg')}}" alt="">
                <h4 class=" text-dark">{{$staticContent['Success_Stories']}}</h4>
            </a>
            <a href="{{route('saleKit')}}" class="marketing-grid-list">
                <img src="{{asset('frontend-asset/image/icon/icon-kit.svg')}}" alt="">
                <h4 class=" text-dark">{{$staticContent['Sales_kit']}}</h4>
            </a>
            <a href="{{route('productCrossReference')}}" class="marketing-grid-list">
                <img src="{{asset('frontend-asset/image/icon/icon-reference.svg')}}" alt="">
                <h4 class=" text-dark">{{$staticContent['Product_Cross_Reference']}}</h4>
            </a>

            <a href="{{route('confighistory')}}" class="marketing-grid-list">
                <img src="{{asset('frontend-asset/image/icon/icon-config.svg')}}" alt="">
                <h4 class=" text-dark">{{$staticContent['Configurable_History']}}</h4>
            </a>
            @endif
            @foreach ($static_content as $item)
            @if(session('partner_role') == 2)
            @if($item->id == 1)
            <a href="{{route('partnerinfo' ,[$item->id , preg_replace('/[^A-Za-z0-9\-]/', '-',$item->title)])}}"
                class="marketing-grid-list">
                <img src="{{config('app.url')}}/medias/static_content/{{$item->icon}}" alt="">
                <h4 class=" text-dark">{{$item->title}}</h4>
            </a>
            @endif
            @endif
            @endforeach
        </div>
    </div>
</section>
@endsection


@section('js')

@endsection