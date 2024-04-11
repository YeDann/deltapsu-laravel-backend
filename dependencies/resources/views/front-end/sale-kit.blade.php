@extends('layouts.front-end')
@section('css')
<link rel="stylesheet" href="{{asset('/frontend-asset/css/vanilla-calendar-min.css')}}">
<style>
    @media (max-width: 992px) {}
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
                    <li class="breadcrumb-item active text-breadcrumb-home" aria-current="page"><a href="#">
                            {{$staticContent['Partners']}}</a></li>
                    <li class="breadcrumb-item active text-breadcrumb-home" aria-current="page"><a
                            href="{{route('marketingResources')}}">{{$staticContent['Marketing_Resources']}}</a></li>
                    <li class="breadcrumb-item active text-breadcrumb" aria-current="page"><a
                            href="#">{{$staticContent['Sales_kit']}}</a></li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="padding-top-content-breadcrumb visible-up-922"></div>
<div class="box-events mb-5">
    <div class="container">
        <h1 class="text-title-delta visible-up-922">{{$staticContent['Sales_kit']}}</h1>
        <h3 class="text-title-delta invisible-up-922">{{$staticContent['Sales_kit']}}</h3>
        <p class="text-center mb-5">{{$staticContent['Sales_Kit_will_help_technicians']}}</p>
        <div class="content-seles-kit">
            @foreach ($product_docs as $item)
            <div class="resources-download ">
                <div class="detail-download ">
                    <h5>{{$item->name}}</h5>
                    <p>{{$staticContent['Uploaded_on']}} {{$item->date_info}}</p>
                    {{-- <p>{{$staticContent['Uploaded_on']}} 13-Mar-2019 | PDF, 4.7 MB</p> --}}
                </div>
                {{-- <a href="{{route('checkpermission',$item->file)}}" target="_blank"><button
                        class="btn-downlode ">{{$staticContent['Downloads']}}</button></a> --}}

                <form method="POST" action="{{route('partnerLoginDoc_success')}}">
                    {{csrf_field()}}
                    <input type="hidden" name="section_id" value={{session('partner_id')}}>
                    <input type="hidden" name="doc" value={{$item->file}}>
                    <button class="btn-downlode" type="submit">{{$staticContent['Downloads']}}</button>
                </form>
            </div>
            @endforeach


        </div>
    </div>
</div>



@endsection


@section('js')

<script>


</script>
@endsection