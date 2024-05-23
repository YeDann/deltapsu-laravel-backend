@extends('layouts.front-end')
@section('css')
<style>
    .nav-tabs .nav-link {
        margin: -2px 20px;
    }

    .tab-content>.active {
        display: block;
    }

    a.btn:hover {
        color: #444444;
    }

    .btn.focus,
    .btn:focus {
        outline: 0;
        box-shadow: unset;
    }

    .select-minimize {
        width: 170px;
    }

    #select-news option {
        text-transform: capitalize;
    }

    #select-news {
        text-transform: capitalize;
    }

    .bg-new-alert {
        background-color: #76B900;
        /*padding: 4px 8px;*/
        border-radius: 50%;
        color: #fff;
        /* margin-top: -25px;
        margin-left: 20px;*/
        right: -16px;
        top: -16px;
        position: absolute;
        display: block;
        width: 24px;
        height: 24px;
        text-align: center;
        font-size: 12px;
        padding-top: 2px;
    }

    .d-ply-flex {
        display: flex;
    }

    @media screen and (max-width: 500px) {

        li.page-item {

            display: none;
        }

        .page-item:first-child,
        .page-item:nth-child(2),
        .page-item:nth-child(3),
        .page-item:nth-child(4),
        .page-item:nth-child(5),
        .page-item:nth-last-child(2),
        .page-item:nth-last-child(3),
        .page-item:nth-last-child(4),
        .page-item:nth-last-child(5) .page-item:last-child,
        .page-item.active,
        .page-item.disabled {
            display: block;
        }
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
                    <li class="breadcrumb-item active text-breadcrumb" aria-current="page"><a
                            href="#">{{$staticContent['Product_News']}}</a></li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="padding-top-content-breadcrumb visible-up-922"></div>
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
<section class="box-news">
    <div class="container">
        <h1 class="text-title-delta ">{{$staticContent['Product_News']}}</h1>
        <select id="select-news" onchange="selectDatanews();" class="form-control invisible-up-922 mb-4 w-75 m-auto">
            <option value="0" {{$type_id==0 ? 'selected' :''}}>{{$staticContent['All']}}</option>
            @foreach ($news_type as $type)
            <option value="{{$type->id}}" {{$type_id==$type->id ? 'selected' :''}} >{{$type->typename}}</option>
            @endforeach
        </select>
        <div class="row mt-4 mt-xl-0">
            <div class="col-md-12 ">
                <div class="nav nav-tabs d-flex justify-content-center border-b-2px visible-up-922 mb-5" id="nav-tab"
                    role="tablist">
                    <a class="nav-item nav-link font-size-tab  {{$type_id == 0 ? 'active' :''}}"
                        href="{{route('index','news')}}?type=all&type-id=0">{{$staticContent['All']}}</a>

                    @if(App::getLocale() == "jp")
                    <style>
                        /*For IE And Lang JP*/
                        @media all and (-ms-high-contrast: none),
                        (-ms-high-contrast: active) {
                            .bg-new-alert {
                                padding-top: 5px;
                            }
                        }
                    </style>
                    @endif
                    @foreach ($news_type as $type)
                    <a class="nav-item nav-link font-size-tab position-relative {{$type_id == $type->id ? 'active' :''}}"
                        href="{{route('index','news')}}?type={{preg_replace('/\s+/', '-',strtolower($type->typename))}}&type-id={{$type->id}}">{{$type->typename}}
                        @if($type->typename == 'Lebensdauer' || $type->typename == 'EOL' ||
                        $type->typename == "下架产品" || $type->typename == "停產產品"
                        && $status_eol)<div class="bg-new-alert"><span>N</span></div>@endif
                    </a>
                    @endforeach

                </div>
                <div class="tab-content add-space-mobile mb-5">
                    <div class="tab-pane fade show active">
                        <div class="row">
                            @foreach ($news as $item)
                            <div class="col-lg-4 col-sm-6">
                                <div class="card">
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
                                            <img class="line-symbol"
                                                src="{{asset('/frontend-asset/image/line-symbol.svg')}}" alt="">
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
                        <div class="text-center mt-5 d-ply-flex justify-content-center visible-up-922">
                            {{ $news->appends(request()->input())->links() }}
                        </div>
                    </div>
                    <div class="text-center mt-5 w-paing invisible-up-922">
                        {{ $news->appends(request()->input())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection


@section('js')
<script>
    var news_type =  <?= json_encode($news_type);?>;
    function selectDatanews(){
        var value_tab = document.getElementById("select-news").value;
        var type_name = '';
        if(value_tab != 0){
            var find = news_type.find(val => val.id == value_tab);
            if(find){
             type_name =  find.typename.toLowerCase().replace(/\s+/g, '-');
             type_id =  value_tab;
             window.location = '{{route('index','news')}}?type='+type_name +'&type-id='+type_id ;
            }
        }else{
            window.location = "{{route('index','news')}}?type=all&type-id=0";
        }
     }
</script>

@endsection