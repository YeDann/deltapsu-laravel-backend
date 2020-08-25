@extends('layouts.front-end')
@section('css')
<link rel="stylesheet" href="{{asset('/frontend-asset/css/vanilla-calendar-min.css')}}" >
<style>
@media (max-width: 992px){
    .resources-download {
        padding: 12px;
        margin: 0 -2rem;
    }
}
.text-editor img{
    max-width: 100% !important;
}
.text-editor iframe{
    max-width: 100% !important;
}
</style>
@endsection
@section('meta')
<title>{{$static_content[0]->title}}</title>
<meta name="description" content="{{$static_content[0]->title}}">
<meta name="keywords" content="{{$static_content[0]->title}}">
@endsection
@section('container')
<div class="padding-top-content">
</div>
<div class="products-index-nav visible-up-922">
    <div class="bg-bredcrumb">
        <div class="container">
            <nav aria-label="breadcrumb" id="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item text-breadcrumb-home"><a href="{{route('index','home')}}">{{$staticContent['Home']}}</a></li>
                    <li class="breadcrumb-item active text-breadcrumb-home" aria-current="page"><a href="#"> {{$staticContent['Partners']}}</a></li>
                    <li class="breadcrumb-item active text-breadcrumb-home" aria-current="page"><a href="{{route('marketingResources')}}">{{$staticContent['Marketing_Resources']}}</a></li>
                    <li class="breadcrumb-item active text-breadcrumb" aria-current="page"><a href="#">{{$static_content[0]->title}}</a></li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="padding-top-content-breadcrumb visible-up-922"></div>
<div class="box-events mb-5">
    <div class="container">
        <h2 class="text-title-delta visible-up-922">{{$static_content[0]->title}}</h2>
        <h3 class="text-title-delta invisible-up-922">{{$static_content[0]->title}}</h3>
        {{-- <p class="text-center mb-5" >Video Guide Line will show you how to use Partner Portal.</p> --}}
        <div class="d-flex justify-content-center">
         
            <div class="text-editor"> 
                {!!$static_content[0]->content!!}
            </div>

        </div>
        
    </div> 
</div>



@endsection


@section('js')

<script>

    
</script>
@endsection
