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
        /* Your specific styles for images within tables */
        /* If you want to ignore images inside tables, you can leave this empty */
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
                    <li class="breadcrumb-item active text-breadcrumb-home dropdown" aria-current="page"><a href="#"
                            data-toggle="dropdown" id="tools-dropdown">{{$staticContent['Updates']}}</a>
                        <ul class="dropdown-menu">
                            <li><a href="#" id="tools-dropdown" class="text-bold">{{$staticContent['Updates']}}</a></li>
                            <hr>
                            <li><a href="{{route('index','news')}}">{{$staticContent['Product_News']}}</a></li>
                            <li><a href="{{route('index','events')}}">{{$staticContent['Events']}}</a></li>
                            {{-- <li><a
                                    href="{{route('index','technical-articles')}}">{{$staticContent['Technical_Articles']}}</a>
                            </li> --}}
                        </ul>
                    </li>
                    <li class="breadcrumb-item active text-breadcrumb-home" aria-current="page"><a
                            href="{{route('index','news')}}">{{$staticContent['Product_News']}}</a></li>
                    <li class="breadcrumb-item active text-breadcrumb" aria-current="page"><a
                            href="#">{{isset($contents[0]->title)? $contents[0]->title:'' }}</a></li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="padding-top-content-breadcrumb visible-up-922"></div>
<section class="box-news  my-5 {{-- visible-up-922 --}}">
    <div class="container">
        <div class="box-news-detail border-radius-6">
            <h1 class="text-dark">
                {{isset($contents[0]->title)? $contents[0]->title:'' }}

            </h1>
            <hr size="2">
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
                @if(isset($contents[0]->content))
                {{-- {!!$contents[0]->content!!} --}}
                {!! str_replace("/uploads_delta",config('app.url')."/uploads_delta",$contents[0]->content) !!}
                @endif
            </div>
            <div class="">
                @if(isset($contents[0]->file) && $contents[0]->file != '')
                <a target="_blank" href="{{config('app.url')}}/uploads_delta/{{$contents[0]->file}}">
                    <button class="btn btn-subscribe">Download PDF</button>
                </a>
                @endif
            </div>

        </div>
        @if(count($otherNews) > 0)
        <h3 class="text-center text-drak margin-title"> {{$staticContent['Related_News']}}</h3>
        @endif
        <div class="row">
            @foreach ($otherNews as $item)
            <div class="col-lg-4 col-sm-6">
                <div class="card border-radius-6">
                    <a href="{{route('updateNewsDetail',['name'=> $item->slug])}}">
                        <div class="post-image">
                            <img src="{{config('app.url')}}/uploads_delta/{{$item->thumb}}" alt=""
                                class="img-responsive">
                        </div>
                    </a>
                    <div class="news-content">

                        <div class="post-meta">
                            <a href="{{route('updateNewsDetail',['name'=> $item->slug])}}">
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
                            <a href="{{route('updateNewsDetail',['name'=> $item->slug])}}">
                                {{$item->title}}
                            </a>
                        </h4>
                        <p>{!! iconv_substr(strip_tags($item->content),0,90,'UTF-8') !!} ...
                        </p>

                    </div>

                    <a href="{{route('updateNewsDetail',['name'=> $item->slug])}}"
                        class="read-more">{{$staticContent['Read_More']}}</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
{{-- <div class="invisible-up-922 my-5 box-news">
    <div class="container">
        <h3 class="text-dark">DELTA NEWEST ADT SERIES 60W AC/DC IT ADAPTER</h3>
        <hr size="2">
        <div class="post-meta">
            <span class="sub-news new">
                <a href="#">
                    NEW PRODUCTS
                </a>
            </span>
            <img class="line-symbol" src="{{asset('/frontend-asset/image/line-symbol.svg')}}" alt="">
            <span class="date">
                <a href="#">
                    Oct 19, 2019
                </a>
            </span>
        </div>
        <div class="content">
            <div class="img-content">
                <img src="{{asset('/frontend-asset/image/adult-data-database-1181316@2x.png')}}" alt=""
                    class="img-fluid w-100">
            </div>
            <p class="my-4">Beijing, China, October 17-19, 2018 – Delta joined China Wind Power 2018 (CWP 2018), one of
                China’s most influential trade events in the wind industry.</p>
            <p class="mb-4">At CWP 2018, Delta showcased its industrial power supplies suitable for wind turbine
                systems. The highlighted products included the CliQ M series of DIN Rail Power Supply which Delta
                presented alongside its industrial automation products as a total system solution for wind turbines. In
                addition, Delta displayed its wide range of industrial power supplies for other applications that
                include its panel mount power supplies and LED drivers. </p>
            <p class="mb-4">To find out about our next event, please visit. http://www.deltapsu.com/events</p>
            <div class="img-content my-4">

                <img src="{{asset('/frontend-asset/image/jason-blackeye-nyL-rzwP-Mk-unsplash@2x.png')}}" alt=""
                    class="img-fluid w-100">
            </div>
            <div class="img-content mb-4">
                <img src="{{asset('/frontend-asset/image/Group 2133@2x.png')}}" alt="" class="img-fluid w-100">
            </div>
            <p class="mb-4">Ligula dapibus </p>
            <p class="mb-4">Beijing, China, October 17-19, 2018 – Delta joined China Wind Power 2018 (CWP 2018), one of
                China’s most influential trade events in the wind industry.</p>
            <p class="mb-4">At CWP 2018, Delta showcased its industrial power supplies suitable for wind turbine
                systems. The highlighted products included the CliQ M series of DIN Rail Power Supply which Delta
                presented alongside its industrial automation products as a total system solution for wind turbines. In
                addition, Delta displayed its wide range of industrial power supplies for other applications that
                include its panel mount power supplies and LED drivers.</p>
            <p class="mb-4">To find out about our next event, please visit. http://www.deltapsu.com/events</p>
            <p class="mb-4">Etiam convallis elementum sapien, a aliquam turpis aliquam vitae. Praesent sollicitudin
                felis vel mi facilisis posuere. Nulla ultrices facilisis justo, non varius nisl semper vel. Interdum et
                malesuada fames ac ante ipsum primis in faucibus. Phasellus at ante mattis, condimentum velit et,
                dignissim nunc. Integer quis tincidunt purus. Duis dignissim mauris vel elit commodo, eu hendrerit leo
                ultrices.</p>
            <p class="mb-4">Nulla vehicula vestibulum purus at rutrum. Pellentesque habitant morbi tristique senectus et
                netus et malesuada fames ac turpis egestas. Curabitur dignissim massa nec libero scelerisque rutrum.
                Curabitur ac purus id elit hendrerit lacinia. Nullam sit amet sem efficitur, porta diam in, convallis
                tortor.</p>
        </div>
        <h4 class="text-center text-drak pad-title">RELATED NEWS</h4>
        <div class="grid-news">
            <div class="grid-list-news">
                <div class="card">
                    <div class="post-image">
                        <img src="{{asset('/frontend-asset/image/latest-news-img.png')}}" alt="" class="img-responsive">
                    </div>
                    <div class="news-content">
                        <div class="post-meta">
                            <span class="sub-news company">
                                <a href="#">
                                    COMPANY
                                </a>
                            </span>
                            <img class="line-symbol" src="{{asset('/frontend-asset/image/line-symbol.svg')}}" alt="">
                            <span class="date">
                                <a href="#">
                                    Oct 19, 2019
                                </a>
                            </span>
                        </div>
                        <h2 class="post-header title-new">
                            The New PJL Open Frame
                            Power Supply for Lighting
                            Applications
                        </h2>
                        <p>Delta provides compact size and cost effective adapter. The wide operating temperature
                            range allows it for Industrial applications requiring high reliability and performance
                        </p>

                    </div>
                    <a href="#" class="read-more">READ MORE</a>
                </div>
            </div>
            <div class="grid-list-news">
                <div class="card">
                    <div class="post-image">
                        <img src="{{asset('/frontend-asset/image/new product.png')}}" alt="" class="img-responsive">
                    </div>
                    <div class="news-content">
                        <div class="post-meta">
                            <span class="sub-news new">
                                <a href="#">
                                    NEW PRODUCTS
                                </a>
                            </span>
                            <img class="line-symbol" src="{{asset('/frontend-asset/image/line-symbol.svg')}}" alt="">
                            <span class="date">
                                <a href="#">
                                    Oct 19, 2019
                                </a>
                            </span>
                        </div>
                        <h2 class="post-header title-new">
                            The New PJL Open Frame
                            Power Supply for Lighting
                            Applications
                        </h2>
                        <p>Delta provides compact size and cost effective adapter. The wide operating temperature
                            range allows it for Industrial applications requiring high reliability and performance
                        </p>

                    </div>
                    <a href="#" class="read-more">READ MORE</a>
                </div>
            </div>
            <div class="grid-list-news">
                <div class="card">
                    <div class="post-image">
                        <img src="{{asset('/frontend-asset/image/other.png')}}" alt="" class="img-responsive">
                    </div>
                    <div class="news-content">
                        <div class="post-meta">
                            <span class="sub-news other">
                                <a href="#">
                                    OTHER
                                </a>
                            </span>
                            <img class="line-symbol" src="{{asset('/frontend-asset/image/line-symbol.svg')}}" alt="">
                            <span class="date">
                                <a href="#">
                                    Oct 19, 2019
                                </a>
                            </span>
                        </div>
                        <h2 class="post-header title-new">
                            The New PJL Open Frame
                            Power Supply for Lighting
                            Applications
                        </h2>
                        <p>Delta provides compact size and cost effective adapter. The wide operating temperature
                            range allows it for Industrial applications requiring high reliability and performance
                        </p>

                    </div>
                    <a href="#" class="read-more">READ MORE</a>
                </div>
            </div>
        </div>

    </div>

</div> --}}


@endsection


@section('js')

@endsection