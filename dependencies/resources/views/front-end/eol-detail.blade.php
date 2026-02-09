@extends('layouts.front-end')
@section('css')
<style>
    hr {
        border-top: 2px solid #E3EFF8;
    }

    .content img {
        max-width: 100%;
    }

    .content b {
        font-weight: bold;
    }

    .content table img {
        max-width: none;
    }
</style>
@endsection
@section('meta')
<title>{{isset($contents[0]->meta_title)? $contents[0]->meta_title :''}}</title>
<meta name="description"
    content="{!! trim(iconv_substr(strip_tags(isset($contents[0]->meta_description)? $contents[0]->meta_description:''),0,155,'UTF-8')) !!}">

<meta property="og:title" content="{{isset($contents[0]->meta_title)? $contents[0]->meta_title :''}}" />
<meta property="og:description"
    content="{!! trim(iconv_substr(strip_tags(isset($contents[0]->meta_description)? $contents[0]->meta_description:''),0,155,'UTF-8')) !!}" />
<meta property="og:image"
    content="{{config('app.url')}}/uploads_delta/{{isset($contents[0]->thumb) ? $contents[0]->thumb :''}}" />
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
                    <li class="breadcrumb-item text-breadcrumb-home dropdown"><a href="#"
                            data-toggle="dropdown" id="tools-dropdown">{{$staticContent['Technical_Support']}}</a>
                        <ul class="dropdown-menu">
                            <li><a href="#" id="tools-dropdown" class="text-bold">{{$staticContent['Technical_Support']}}</a></li>
                            <hr>
                            <li><a href="{{route('index', ['page' => 'videos'])}}">{{$staticContent['Videos'] ?? 'Videos'}}</a></li>
                             <li><a href="{{route('index', ['page' => 'eol'])}}">{{$staticContent['EOL'] ?? 'EOL'}}</a></li>
                        </ul>
                    </li>
                    <li class="breadcrumb-item text-breadcrumb-home"><a
                            href="{{route('index', ['page' => 'eol'])}}">{{$staticContent['EOL'] ?? 'EOL'}}</a></li>
                    <li class="breadcrumb-item active text-breadcrumb" aria-current="page"><a
                            href="#">{{isset($contents[0]->title)? $contents[0]->title :''}}</a></li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="padding-top-content-breadcrumb visible-up-922"></div>
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="box-news-detail border-radius-6">
                    <h1 class="text-dark">{{isset($contents[0]->title)? $contents[0]->title :''}}</h1>
                
                    <hr>

                    <div class="post-meta">
                        <span class="sub-news new"
                            style="color:{{isset($contents[0]->color_type)? $contents[0]->color_type:'' }}">
                            {{isset($contents[0]->cateName)? $contents[0]->cateName:'' }}
                        </span>
                        <?php
                        function getDateformat($date){
                            $eng_month_arr = array(
                                "0" => "",
                                "1" => "Jan",
                                "2" => "Feb",
                                "3" => "Mar",
                                "4" => "Apr",
                                "5" => "May",
                                "6" => "Jun",
                                "7" => "Jul",
                                "8" => "Aug",
                                "9" => "Sep",
                                "10" => "Oct",
                                "11" => "Nov",
                                "12" => "Dec"
                            );
                            $publicDate = date_create($date);
                            $pDate = explode("-", $publicDate->format('Y-n-d'));
                            $datearray = [
                                'm' =>  $eng_month_arr[$pDate[1]],
                                'd'=>  $pDate[2],
                                'y' => $pDate[0]
                            ];
                            return  $datearray;
                        }
                        ?>
                        <img class="line-symbol " src="{{asset('/frontend-asset/image/line-symbol.svg')}}" alt="">
                        <span class="date">
                            <?php
                                    if(isset($contents[0]->date_info)){
                                    $datenew = getDateformat($contents[0]->date_info);
                                    echo $datenew['m'].' '.$datenew['d'] .' '.$datenew['y'];
                                    }else{
                                        echo '';
                                    }
                                    ?>
                        </span>
                    </div>

                    <div class="content">
                        {!! isset($contents[0]->content)? $contents[0]->content :'' !!}
                    </div>
                    
                    <div class="">
                        @if(isset($contents[0]->file) && $contents[0]->file != '')
                        <a target="_blank" href="{{config('app.url')}}/uploads_delta/{{$contents[0]->file}}">
                            <button class="btn btn-subscribe">Download PDF</button>
                        </a>
                        @endif
                    </div>
                
                </div>
            </div>
        </div>
    </div>
</section>

<section class="box-news my-5">
    <div class="container">
        @if(count($otherNews) > 0)
        <h3 class="text-center text-drak margin-title"> {{isset($staticContent['Related_EOL']) ? $staticContent['Related_EOL'] : 'Related EOL'}}</h3>
        @endif
        <div class="row">
            @foreach ($otherNews as $item)
            <div class="col-lg-4 col-sm-6">
                <div class="card border-radius-6">
                    <a href="{{route('updateEOLDetail',['name'=> $item->slug])}}">
                        <div class="post-image">
                            <img src="{{config('app.url')}}/uploads_delta/{{$item->thumb}}" alt=""
                                class="img-responsive">
                        </div>
                    </a>
                    <div class="news-content">

                        <div class="post-meta">
                            <a href="{{route('updateEOLDetail',['name'=> $item->slug])}}">
                                <span class="sub-news" style="color:{{$item->color_type}}">
                                    {{$item->cateName}}
                                </span>
                            </a>
                            <img class="line-symbol" src="{{asset('/frontend-asset/image/line-symbol.svg')}}" alt="">
                            <span class="date text-uppercase">
                                <?php
                                     if(isset($item->date_info)){
                                       $datenew2 = getDateformat($item->date_info);
                                       echo $datenew2['m'].' '.$datenew2['d'] .' '.$datenew2['y'];
                                     }else{
                                         echo '';
                                     }
         
                                     ?>
                            </span>
                        </div>
                        <h4 class="post-header title-new">
                            <a href="{{route('updateEOLDetail',['name'=> $item->slug])}}">
                                {{$item->title}}
                            </a>
                        </h4>
                        <p>{!! iconv_substr(strip_tags($item->content),0,90,'UTF-8') !!} ...
                        </p>

                    </div>

                    <a href="{{route('updateEOLDetail',['name'=> $item->slug])}}"
                        class="read-more">{{$staticContent['Read_More']}}</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
