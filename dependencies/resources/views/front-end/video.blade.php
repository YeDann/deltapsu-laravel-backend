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

    #select-videos option {
        text-transform: capitalize;
    }

    #select-videos {
        text-transform: capitalize;
    }

    .bg-new-alert {
        background-color: #76B900;
        border-radius: 50%;
        color: #fff;
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

    /* ===== Responsive Classes ===== */
    .visible-up-922 {
        display: block;
    }

    .invisible-up-922 {
        display: none;
    }

    @media (max-width: 921px) {
        .visible-up-922 {
            display: none !important;
        }

        .invisible-up-922 {
            display: block !important;
        }
    }

    /* ===== Modern Pagination Style ===== */
    .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
        margin: 30px 0;
        flex-wrap: wrap;
        padding-left: 0;
        list-style: none;
    }

    .pagination .page-item {
        margin: 0;
    }

    .pagination .page-link {
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        color: #374151;
        padding: 10px 16px;
        font-weight: 500;
        transition: all 0.3s ease;
        text-decoration: none;
        min-width: 44px;
        text-align: center;
        display: block;
    }

    .pagination .page-link:hover {
        background-color: #f3f4f6;
        border-color: #3b82f6;
        color: #3b82f6;
        transform: translateY(-2px);
        box-shadow: 0 4px 6px rgba(59, 130, 246, 0.1);
    }

    .pagination .page-item.active .page-link {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        border-color: #3b82f6;
        color: white;
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
    }

    .pagination .page-item.disabled .page-link {
        color: #9ca3af;
        background-color: #f9fafb;
        border-color: #e5e7eb;
        cursor: not-allowed;
        opacity: 0.6;
        pointer-events: none;
    }

    /* Arrow Styles */
    .pagination .page-link[rel="prev"],
    .pagination .page-link[rel="next"] {
        font-size: 18px;
        padding: 10px 14px;
    }

    /* ===== Mobile Responsive ===== */
    @media (max-width: 576px) {
        .pagination {
            gap: 5px;
        }

        .pagination .page-link {
            padding: 8px 12px;
            font-size: 14px;
            min-width: 38px;
        }

        /* ซ่อนตัวเลขบางส่วนบนมือถือ - แสดงเฉพาะ active และหน้าข้างๆ */
        .pagination .page-item {
            display: none;
        }

        /* แสดง Previous */
        .pagination .page-item:first-child,
        /* แสดง 2 หน้าแรก */
        .pagination .page-item:nth-child(2),
        .pagination .page-item:nth-child(3),
        /* แสดงหน้า active */
        .pagination .page-item.active,
        /* แสดง 2 หน้าสุดท้าย */
        .pagination .page-item:nth-last-child(2),
        .pagination .page-item:nth-last-child(3),
        /* แสดง Next */
        .pagination .page-item:last-child {
            display: block;
        }

        /* แสดง disabled (Previous/Next ที่ไม่สามารถกดได้) */
        .pagination .page-item.disabled {
            display: block;
        }
    }

    @media (max-width: 400px) {
        .pagination .page-link {
            padding: 6px 10px;
            font-size: 13px;
            min-width: 34px;
        }
    }
   .text-muted{
     padding: 0 1rem;
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
                    <li class="breadcrumb-item active text-breadcrumb-home dropdown" aria-current="page"><a href="#"
                            data-toggle="dropdown" id="tools-dropdown">{{$staticContent['Technical_Support']}}</a>
                        <ul class="dropdown-menu">
                            <li><a href="#" id="tools-dropdown" class="text-bold">{{$staticContent['Technical_Support']}}</a></li>
                            <hr>
                            <li><a href="{{route('index', ['page' => 'catalogs'])}}">{{$staticContent['catalogs'] ?? 'Catalogs'}}</a></li>
                            <li><a href="{{route('index', ['page' => 'product-documents'])}}">{{$staticContent['Product_Documents'] ?? 'Product Documents'}}</a></li>
                            <li><a href="{{route('productCoparison')}}">{{$staticContent['product_comparison'] ?? 'Product Comparison'}}</a></li>
                            <li><a href="{{route('index', ['page' => 'industry-know-how'])}}">{{$staticContent['Industry_Know_How'] ?? 'Industry Know-How'}}</a></li>
                            <li><a href="{{route('index', ['page' => 'videos'])}}">{{$staticContent['Videos'] ?? 'Videos'}}</a></li>
                            <li><a href="{{route('index', ['page' => 'product-notice'])}}">{{$staticContent['Product_Notice'] ?? 'Product Notice'}}</a></li>
                            <li><a href="{{route('index', ['page' => 'eol'])}}">{{$staticContent['EOL'] ?? 'EOL'}}</a></li>
                            <li><a href="{{route('index', ['page' => 'faqs'])}}">{{$staticContent['FAQs'] ?? 'FAQs'}}</a></li>
                            <li><a href="{{route('contactSupport')}}">{{$staticContent['Technical_Service'] ?? 'Technical Service'}}</a></li>
                        </ul>
                    </li>
                    <li class="breadcrumb-item active text-breadcrumb" aria-current="page"><a
                            href="#">{{$staticContent['Videos']}}</a></li>
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
        <h1 class="text-title-delta ">{{$staticContent['Videos']}}</h1>
        <select id="select-videos" onchange="selectDatavideos();" class="form-control invisible-up-922 mb-4 w-75 m-auto border-radius-6">
            <option value="0" {{$type_id==0 ? 'selected' :''}}>{{$staticContent['All']}}</option>
            @foreach ($video_type as $type)
            <option value="{{$type->id}}" {{$type_id==$type->id ? 'selected' :''}} >{{$type->typename}}</option>
            @endforeach
        </select>
        <div class="row mt-4 mt-xl-0">
            <div class="col-md-12 ">
                <div class="nav nav-tabs d-flex justify-content-center border-b-2px visible-up-922 mb-5" id="nav-tab"
                    role="tablist">
                    <a class="nav-item nav-link font-size-tab  {{$type_id == 0 ? 'active' :''}}"
                        href="{{route('index', ['page' => 'videos'])}}?type=all&type-id=0">{{$staticContent['All']}}</a>

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
                    @foreach ($video_type as $type)
                    <a class="nav-item nav-link font-size-tab position-relative {{$type_id == $type->id ? 'active' :''}}"
                        href="{{route('index', ['page' => 'videos'])}}?type={{preg_replace('/\s+/', '-',strtolower($type->typename))}}&type-id={{$type->id}}">{{$type->typename}}
                        @if(
                            $type->typename == 'Lebensdauer' 
                            || $type->typename == "下架产品" 
                            || $type->typename == "停產產品"
                            && $status_eol
                        )
                            <div class="bg-new-alert"><span>N</span></div>
                        @endif
                    </a>
                    @endforeach

                </div>
                <div class="tab-content add-space-mobile mb-5">
                    <div class="tab-pane fade show active">
                        <div class="row">
                            @foreach ($videos as $item)
                            <div class="col-lg-4 col-sm-6">
                                <div class="card border-radius-6">
                                    <a href="{{route('updateVideoDetail',['name'=> $item->slug])}}">
                                        <div class="post-image">
                                            <img src="{{config('app.url')}}/uploads_delta/{{$item->thumb}}" alt=""
                                                class="img-responsive">
                                        </div>
                                    </a>
                                    <div class="news-content">

                                        <div class="post-meta">
                                            <a href="{{route('updateVideoDetail',['name'=> $item->slug])}}">
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
                                            <a href="{{route('updateVideoDetail',['name'=> $item->slug])}}">
                                                {{$item->title}}
                                            </a>
                                        </h4>
                                        <p>{!! iconv_substr(strip_tags($item->content),0,90,'UTF-8') !!} ...
                                        </p>

                                    </div>

                                    <a href="{{route('updateVideoDetail',['name'=> $item->slug])}}"
                                        class="read-more">{{$staticContent['Read_More']}}</a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="text-center mt-5 d-flex justify-content-center visible-up-922">
                             {{ $videos->appends(request()->input())->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                    <div class="text-center mt-5 w-paing invisible-up-922">
                             {{ $videos->appends(request()->input())->links('pagination::bootstrap-5') }}

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection


@section('js')
<script>
    var video_type =  <?= json_encode($video_type);?>;
    function selectDatavideos(){
        var value_tab = document.getElementById("select-videos").value;
        var type_name = '';
        if(value_tab != 0){
            var find = video_type.find(val => val.id == value_tab);
            if(find){
             type_name =  find.typename.toLowerCase().replace(/\s+/g, '-');
             type_id =  value_tab;
             window.location = '{{route('index', ['page' => 'videos'])}}?type='+type_name +'&type-id='+type_id ;
            }
        }else{
            window.location = "{{route('index', ['page' => 'videos'])}}?type=all&type-id=0";
        }
     }
</script>

@endsection
