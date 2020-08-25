@extends('layouts.front-end')
@section('css')
<style>

    .box-news-detail{
        border: 2px solid #E3EFF8;
        padding: 24px;
    }
    hr{
        border-top: 2px solid #E3EFF8;
    }
    /* html, body {
        margin: 0;
        padding: 0;
        font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
        font-size: 14px;
    } */

    #calendar {
        max-width: 900px;
        margin: 40px auto;
    }

    .gmap_canvas {
        overflow: hidden;
        background: none !important;
        height: 320px;
        width: 100%;
        margin-top: 24px;
    }
    .text-editor{
        font-family: Arial, Helvetica, sans-serif !important;
    }
    .text-editor iframe{
        max-width: 100% ;
    }
    .text-editor img{
        max-width: 100% ;
    }
    .text-editor span{
        font-family: Arial, Helvetica, sans-serif !important;
    }
    .text-editor label{
        font-family: Arial, Helvetica, sans-serif !important;
    }
    .text-editor p{
        font-family: Arial, Helvetica, sans-serif !important;
    }
</style>
@endsection
@section('meta')
<title>{{isset($contents[0]->title)? $contents[0]->title :''}}</title>
<meta name="description" content="{!! iconv_substr(strip_tags(isset($contents[0]->content)? $contents[0]->content:''),0,90,'UTF-8') !!}">
<meta name="keywords" content="{{isset($contents[0]->title) ? $contents[0]->title :''}}">
<meta property="og:title" content="{{isset($contents[0]->title)? $contents[0]->title :''}}" />
<meta property="og:description" content="{!! iconv_substr(strip_tags(isset($contents[0]->content)? $contents[0]->content:''),0,90,'UTF-8') !!}" />
<meta property="og:image" content="{{config('app.url')}}/uploads_delta/{{isset($contents[0]->thumb) ? $contents[0]->thumb :''}}" />
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
                    <li class="breadcrumb-item active text-breadcrumb-home dropdown" aria-current="page"><a
                            href="#" data-toggle="dropdown" id="tools-dropdown">{{$staticContent['Updates']}}</a>
                            <ul class="dropdown-menu">
                                <li><a href="#" id="tools-dropdown" class="text-bold">{{$staticContent['Updates']}}</a></li>
                                <hr>
                                <li><a href="{{route('index','news')}}">{{$staticContent['Product_News']}}</a></li>
                                <li><a href="{{route('index','events')}}">{{$staticContent['Events']}}</a></li>
                                {{-- <li><a href="{{route('index','technical-articles')}}">{{$staticContent['Technical_Articles']}}</a></li> --}}
                              </ul>   
                    </li>
                    <li class="breadcrumb-item active text-breadcrumb-home" aria-current="page"><a href="{{route('index','events')}}">{{$staticContent['Events&Calendar']}}</a></li>
                    <li class="breadcrumb-item active text-breadcrumb" aria-current="page"><a href="#">{{$staticContent['Event']}} {{$staticContent['Details']}}</a></li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="padding-top-content-breadcrumb visible-up-922"></div>
<div class="box-events my-5 ">
    <div class="container">
       <div class="box-news-detail">
            <h2 class="text-dark">
                {{isset($contents[0]->title)? $contents[0]->title:'' }}
            </h2>
            <hr size="2">
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
            <div class="content row">
                <div class="col-lg-6 image-event order-2 order-lg-1">
                        <img class="w-100" src="{{config('app.url')}}/uploads_delta/{{isset($contents[0]->thumb)?$contents[0]->thumb:'' }}" alt="">
                        {{-- <div class="gmap_canvas">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3242.2171281810674!2d140.03250051555025!3d35.64702173945416!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6022821fd52ebfdf%3a0xcec0c09c4bed45e0!2smakuhari%20messe%20event%20hall!5e0!3m2!1sen!2sth!4v1573466921112!5m2!1sen!2sth" width="100%" height="100%" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
                        </div> --}}
                       
                </div>
                <div class="col-lg-6 text-event order-1 order-lg-2">
                    <div class="media">
                        <img src="{{asset('/frontend-asset/image/calendar-icon.svg')}}" class="mr-3" alt="...">
                        <div class="media-body">
                            <h5 class="mt-0 text-sixteen-delta">
                                <?php
                                       if($contents[0]->date_publish != null && $contents[0]->date_end != null ){
                                         $date = getDateformat($contents[0]->date_publish);
                                         $endDate = getDateformat($contents[0]->date_end);
                                           echo $date['m'].' '.$date['d'] .''.(isset($endDate['d'])?' - '.$endDate['d']:'').' '.$date['y'];
                                       }else{
                                           echo '';
                                       }
                                    ?>
                              
                            </h5>
                        </div>
                    </div>
                    <div class="media">
                        <img src="{{asset('/frontend-asset/image/location-icon.svg')}}" class="mr-3" alt="...">
                        <div class="media-body">
                        <h5 class="mt-0 text-sixteen-location">{{$contents[0]->location}}</h5>
                        </div>
                    </div>
                    <div class="media">
                        <img src="{{asset('/frontend-asset/image/clock-icon.svg')}}" class="mr-3" alt="...">
                        <div class="media-body">
                            <h5 class="mt-0 text-sixteen-delta">{{$contents[0]->time_start}} – {{$contents[0]->time_end}}</h5>
                        </div>
                    </div>
                    <div class="text-editor">
                        @if(isset($contents[0]->content))
                        {!!$contents[0]->content!!}
                        @endif
                    </div>
                    {{-- <p class="mb-4">TECHNO-FRONTIER is an ideal place where visitors can get information about the latest technologies & products in Electronics and Mechatronics gather here. Each clearly-focused exhibition enables the professionals to locate what they need, and the wide range of the products sparks ideas on possibilities of technical coordination.</p>
                    <p class="mb-4">Booth Number : 5C-18</p>    
                    <p class="mb-4">Website: http://www.jma.or.jp/tf/en</p>        --}}
                </div>
            </div>
        </div>
        <h3 class="text-center text-drak margin-title">{{$staticContent['Upcoming_Event']}}</h3>
        <div class="row">
            @foreach ($otherNews as $item)
            <div class="col-lg-4 col-sm-6">
                <div class="card">
                    <a href="{{route('updateEventDetail',$item->slug)}}">
                    <div class="post-image">
                        <img src="{{config('app.url')}}/uploads_delta/{{$item->thumb}}" alt=""
                            class="img-responsive">
                    </div>
                    </a>
                    <div class="news-content">
                        <div class="post-meta">
                            <span class="author">
                                    <i class="zmdi zmdi-calendar-alt"></i> 
                                    <?php
                                    if($item->date_publish != null && $item->date_end != null ){
                                      $date1 = getDateformat($item->date_publish);
                                      $endDate2 = getDateformat($item->date_end);
                                        echo $date1['m'].' '.$date1['d'] .''.(isset($endDate2['d'])?' - '.$endDate2['d']:'').' '.$date1['y'];
                                    }else{
                                        echo '';
                                    }
                                 ?>
                             
                            </span>
                            <span class="locations ">
                                    <i class="zmdi zmdi-pin"></i> {{$item->location}}
                            </span>
                        </div>
                        <a href="{{route('updateEventDetail',$item->slug)}}">
                        <h3 class="post-header title-new">
                            {{$item->title}}
                        </h3>
                        </a>
                        <p> {!! iconv_substr(strip_tags($item->content),0,90,'UTF-8') !!} ...
                        </p>
                        
                    </div>
                <a href="{{route('updateEventDetail',$item->slug)}} "class="read-more">{{$staticContent['Read_More']}}</a>
                </div>
            </div>
            @endforeach
         
        </div>

    </div>
</div>
{{-- <div class="invisible-up-922 my-5 box-events">
    <div class="container">
        <h3 class="text-dark">INDUSTRIAL TRANSFORMATION ASIA-PACIFIC 2019</h3>
        <hr size="2">
        <div class="content">
           <div class="image-event my-4">
                <img class="w-100" src="{{asset('/frontend-asset/image/Group 866@2x.png')}}" alt="">
           </div>
           <div class="my-3">
                <div class="media mb-3">
                    <img src="{{asset('/frontend-asset/image/calendar-icon.svg')}}" class="mr-3" alt="...">
                    <div class="media-body">
                        <h5 class="mt-0 text-sixteen-delta">OCT 19 - 22, 2019</h5>
                    </div>
                </div>
                <div class="media mb-3">
                    <img src="{{asset('/frontend-asset/image/location-icon.svg')}}" class="mr-3" alt="...">
                    <div class="media-body">
                        <h5 class="mt-0 text-sixteen-location">MAKUHARI MESSE, JAPAN</h5>
                    </div>
                </div>
                <div class="media mb-3">
                    <img src="{{asset('/frontend-asset/image/clock-icon.svg')}}" class="mr-3" alt="...">
                    <div class="media-body">
                        <h5 class="mt-0 text-sixteen-delta">10.00 A.M. – 5.00 P.M.</h5>
                    </div>
                </div>
                <p class="mb-4">TECHNO-FRONTIER is an ideal place where visitors can get information about the latest technologies & products in Electronics and Mechatronics gather here. Each clearly-focused exhibition enables the professionals to locate what they need, and the wide range of the products sparks ideas on possibilities of technical coordination.</p>
                <p class="mb-4">Booth Number : 5C-18</p>    
                <p class="mb-4">Website: http://www.jma.or.jp/tf/en</p>       
           </div>
            <div class="gmap_canvas">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3242.2171281810674!2d140.03250051555025!3d35.64702173945416!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6022821fd52ebfdf%3a0xcec0c09c4bed45e0!2smakuhari%20messe%20event%20hall!5e0!3m2!1sen!2sth!4v1573466921112!5m2!1sen!2sth" width="100%" height="100%" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
            </div>

        </div>
        
        <h4 class="text-center text-drak margin-title">UPCOMING EVENTS</h4>
        <div class="grid-news">
            <div class="grid-list-news">
                <div class="card">
                    <div class="post-image">
                        <img src="{{asset('/frontend-asset/image/editor_201909241569309752576979@2x.png')}}" alt=""
                            class="img-responsive">
                    </div>
                    <div class="news-content">
                        <div class="post-meta">
                            <span class="author">
                                <a href="#">
                                    <i class="zmdi zmdi-calendar-alt"></i> Oct 19 - 22, 2019
                                </a>
                            </span>
                            <span class="locations ">
                                <a href="#">
                                    <i class="zmdi zmdi-pin"></i> SINGAPORE
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
                    <a href="#"class="read-more">READ MORE</a>
                </div>
            </div>
            <div class="grid-list-news">
                <div class="card">
                    <div class="post-image">
                        <img src="{{asset('/frontend-asset/image/editor_201909241569309752576979@2x.png')}}" alt=""
                            class="img-responsive">
                    </div>
                    <div class="news-content">
                        <div class="post-meta">
                            <span class="author">
                                <a href="#">
                                    <i class="zmdi zmdi-calendar-alt"></i> Oct 19 - 22, 2019
                                </a>
                            </span>
                            <span class="locations ">
                                <a href="#">
                                    <i class="zmdi zmdi-pin"></i> SINGAPORE
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
                    <a href="#"class="read-more">READ MORE</a>
                </div>
            </div> 
            <div class="grid-list-news">
                <div class="card">
                    <div class="post-image">
                        <img src="{{asset('/frontend-asset/image/editor_201909241569309752576979@2x.png')}}" alt=""
                            class="img-responsive">
                    </div>
                    <div class="news-content">
                        <div class="post-meta">
                            <span class="author">
                                <a href="#">
                                    <i class="zmdi zmdi-calendar-alt"></i> Oct 19 - 22, 2019
                                </a>
                            </span>
                            <span class="locations ">
                                <a href="#">
                                    <i class="zmdi zmdi-pin"></i> SINGAPORE
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
                    <a href="#"class="read-more">READ MORE</a>
                </div>
            </div> 
        </div>
    </div>
    
</div> --}}


@endsection


@section('js')

@endsection
