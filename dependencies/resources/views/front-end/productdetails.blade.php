@extends('layouts.front-end')
@section('css')
<style>
    .slick-vertical .slick-slide {
        position: relative;
        border: 1px solid rgba(0, 0, 0, 0.2);
        width: 100% !important;
        margin-bottom: 1.5rem;
    }

    #preview-mobile .slick-slide {
        cursor: pointer;
        border: 1px solid rgba(0, 0, 0, 0.2);
        margin-right: 1.5rem;
    }

    .slick-prev.slick-arrow,
    .slick-next.slick-arrow {
        display: flex;
        justify-content: center;
        width: 100%;
        font-size: 50px;
    }

    #bar-tech-specs-nav .nav-tabs .nav-link.active {
        color: #0087DC;
    }

    #bar-tech-specs-nav .nav-tabs .nav-link {
        color: #b2b2b2;
    }

    #preview .slick-list {
        height: 260px !important;
    }

    #preview .slick-slide img {
        display: block;
        height: 70px;
        margin: auto;
        max-width: 100%;
    }

    #preview .slick-slide {
        height: 70px;
        cursor: pointer;
    }

    #preview-mobile .slick-prev.slick-arrow,
    #preview-mobile .slick-next.slick-arrow {
        display: flex;
        justify-content: center;
        font-size: 50px;
        width: unset;
    }

    #preview-mobile .slick-list {
        margin-bottom: 1rem;
        width: 100%;
    }

    #preview-mobile .slick-slide {
        height: 80px;
        cursor: pointer;

    }

    #preview-mobile .slick-slider {
        z-index: 0;
    }

    #preview-mobile .slick-slide img {
        width: 80px !important;
        height: 80px;
        margin: auto;
    }

    #preview-mobile .slick-slide .play-button {
        width: unset !important;
        height: unset !important;
    }

    .invisible-up-922 .product-show-box {
        margin-bottom: 1rem;
        z-index: 1;
        position: relative;
        display: flex;
        height: 250px;
        width: 100%;
    }

    .invisible-up-922 .product-show-box img {
        width: auto;
        margin: auto;
        height: 250px;
    }

    .grid-column-card {
        display: grid;
        grid-template-columns: 1fr 1fr;
        grid-gap: 8px;
        padding-left: 1rem;
        padding-right: 1rem;
    }

    .slick-track {
        width: 100%;
    }

    @media (max-width:992px) {
        .select-minimize {
            font-size: 12px;
            width: 120px;
        }
    }

    @media (max-width:320px) {

        #preview-mobile .slick-prev.slick-arrow,
        #preview-mobile .slick-next.slick-arrow {
            font-size: 55px;
            width: 60;
        }

        .grid-column-card {
            display: grid;
            grid-template-columns: 1fr;
            grid-gap: 1rem;
        }
    }

    @media (max-width:500px) {
        #producttype {
            padding-left: 15px;
            padding-right: 15px;
        }

    }

    .text-editor img {
        max-width: 100% !important;
        width: initial !important;
    }

    #select-tech {
        text-transform: capitalize;
    }

    .icon-app-detail-new {
        width: 190px;
        justify-content: center;
    }

    .icon-app-detail-new a {
        margin: 2px;
    }

    #select-tech {
        font-weight: bold;
    }

    select {
        font-size: 50px;
    }

    .text-tag {
        color: #444444;
        cursor: pointer;
    }

    .text-tag:hover {
        color: #0087DC;
    }

    .box-doc-list {
        cursor: pointer;
    }

    .box-imgexternal img {
        width: 80px;
    }

    .btn-middle {
        position: relative;
        top: 50%;
        left: 50%;
        -webkit-transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        vertical-align: middle;
    }

    @media (max-width:720px) {
        .box-imgexternal img {
            width: 80px;
            margin-right: 90px;
            margin-bottom: 10px;
        }
    }

    .box-optional-model .box-optional-model-list:after {
        font-family: 'Material-Design-Iconic-Font';
        content: "\f273";
        float: right;
        font-size: 24px;
        color: #444444;
    }

    .box-optional-model .box-optional-model-list.collapsed:after {
        /* symbol for "collapsed" panels */
        content: "\f278";
    }

    .box-optional-model-mobile .box-optional-model-list:after {
        font-family: 'Material-Design-Iconic-Font';
        content: "\f273";
        float: right;
        font-size: 24px;
        color: #444444;
    }

    .box-optional-model-mobile .box-optional-model-list.collapsed:after {
        /* symbol for "collapsed" panels */
        content: "\f278";
    }

    .box-optional-model-list {
        font-size: 18px;
        line-height: 30px;
        font-family: 'DeltaSans';
        font-weight: bolder;
        margin-bottom: -2px;
        border-top: 2px solid #E3EFF8;
        border-bottom: 2px solid #E3EFF8;
        margin-top: 20px;
        padding: 10px 0px;
        color: #0087dc !important;
    }

    .table-optional-model .thead-gray th {
        color: #000;
        background-color: #dee2e6;
        border: 1px solid white;

    }
</style>



<style>
    /* 整個 widget 區塊在頁面底部看起來要有呼吸感 */
.widget-section {
  margin-top: 0px;
}

/* 背景圖：全寬、置中、cover */
.widget-bg {
  position: relative;
  background-image: url('/path/to/your/abstract-image.jpg'); /* 換成你的圖 */
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  padding: 20px 20px; /* 上下留空間 */
}

/* 如果想要一層淡霧感，可以開啟這段 */
/*
.widget-bg::before {
  content: "";
  position: absolute;
  inset: 0;
  background: rgba(255, 255, 255, 0.35);
  backdrop-filter: blur(2px);
}
*/

/* 中央對齊卡片容器 */
.widget-inner {
  position: relative;      /* 抵銷 ::before 的 absolute */
  max-width: 1100px;
  margin: 0 auto;
  display: flex;
  gap: 32px;
}

/* 單一 Widget：置中一張卡片 */
.widget-inner--single {
  justify-content: center;
}

/* 雙 Widget：兩張卡片橫排 */
.widget-inner--double {
  justify-content: center;
}

/* 白色卡片本體 */
.widget-card {
  background-color: #ffffff;
  border-radius: 12px;
  padding: 32px 40px;
  box-shadow: 0px 2px 7px 2px rgba(0,0,0,0.16)!important;
  max-width: 360px;
}

/* 上方那條漸層小 bar */
.widget-bar {
  width: 80px;
  height: 5px;            /* ⭐ 這裡也要高度 */
  overflow: hidden !important;
  display: block;
  background-color: rgb(0 135 220 / var(--tw-bg-opacity, 1)) !important;
  border: 0 solid #e5e7eb;
}

/* lg 版本高度放大 */
@media (min-width: 1024px) {
  .widget-bar {
    height: 5px;
  }
}

.widget-bar::before {
  content: "";
  display: block;
  width: 100% !important;
  height: 5px !important;
  background-image: linear-gradient(
    to right,
    #0087dc 60%,
    #64d7d7 60%,
    #64d7d7 80%,
    #b9eb5f 80%
  );
  animation: brand-animation 6s linear infinite;
  background-color: rgb(0 135 220 / var(--tw-bg-opacity, 1)) !important;
}

@keyframes brand-animation {
  0%   { transform: translateX(-100%); }
  20%   { transform: translateX(0%); }
  80%   { transform: translateX(0%); }
  100% { transform: translateX(100%); }
}

/* 標題 */
.widget-title {
  font-size: 28px;
  margin: 12px 0 12px 0;
  color: #111827;
}

/* 描述文字 */
.widget-text {
  margin: 0 0 24px;
  font-size: 14px;
  line-height: 1.6;
  color: #4b5563;
}

/* CTA 按鈕 */
.widget-btn {
  display: inline-block;
  padding: 10px 24px;
  border-radius: 4px;
  background-color: #0087DC;
  color: #ffffff;
  text-decoration: none;
  font-size: 14px;
  font-weight: 600;
  transition: box-shadow 0.15s ease, transform 0.15s ease,
              background-color 0.15s ease;
}

.widget-btn:hover {
  background-color: #1E50C8;
  box-shadow: 0 10px 24px rgba(0, 0, 0, 0.22);
  transform: translateY(-1px);
}

/* RWD：手機直向時把兩張卡片疊起來 */
@media (max-width: 768px) {
  .widget-bg {
    padding: 48px 16px;
  }

  .widget-inner {
    flex-direction: column;
    align-items: center;
  }

  .widget-card {
    width: 100%;
    max-width: 420px;
  }

  .widget-title {
    font-size: 24px;
  }
}

</style>
@endsection
@section('meta')
<?php
 $datacheck1 = [
  $product[0]['content'][1]->data_1,
  $product[0]['content'][1]->data_2,
  $product[0]['content'][1]->data_3,
  $product[0]['content'][1]->data_4,
  $product[0]['content'][1]->data_5,
  $product[0]['content'][1]->data_6,
  $product[0]['content'][1]->data_7,
  $product[0]['content'][1]->data_8,
  $product[0]['content'][1]->data_9,
  $product[0]['content'][1]->data_10,
  $product[0]['content'][1]->data_11,
  $product[0]['content'][1]->data_12,
   ];
  $datacheck2 = [
   $product[0]['content'][2]->data_1,
   $product[0]['content'][2]->data_2,
   $product[0]['content'][2]->data_3,
   $product[0]['content'][2]->data_4,
   $product[0]['content'][2]->data_5,
   $product[0]['content'][2]->data_6,
   $product[0]['content'][2]->data_7,
   $product[0]['content'][2]->data_8,
   $product[0]['content'][2]->data_9,
   $product[0]['content'][2]->data_10,
   $product[0]['content'][2]->data_11,
   $product[0]['content'][2]->data_12,
  ];
  $datacheck3 = [
     $product[0]['content'][0]->data_1,
     $product[0]['content'][0]->data_2,
     $product[0]['content'][0]->data_3,
     $product[0]['content'][0]->data_4,
     $product[0]['content'][0]->data_5,
     $product[0]['content'][0]->data_6,
     $product[0]['content'][0]->data_7,
     $product[0]['content'][0]->data_8,
     $product[0]['content'][0]->data_9,
     $product[0]['content'][0]->data_10,
     $product[0]['content'][0]->data_11,
     $product[0]['content'][0]->data_12,
    ];
    function setTextpro($pro){
      $strmodel =  str_replace("/", "@", $pro);
      return  $strmodel;
    }
    function showdata($pro , $pro2 ,$unit){
        $data = '';
        $prod_1 = 0;
        $prod_2 = 0;
            $chekc = false;
            if(isset($pro) && !is_null($pro) ){
            $prod_1 = $pro;
            $chekc = true;
            }
            if(isset($pro2) && !is_null($pro2) ){
            $prod_2 = $pro2;
            $chekc = true;
            }
        if($chekc == true){
            $data =  $prod_1.'-'.$prod_2.$unit;
        }

        return  $data;
    }
    function retextdata($arr ,$unit){
      $arr_data = [];
      foreach ($arr as $dch){
        if($dch != null && $dch != '' && $dch != 'null'){
            array_push($arr_data,$dch.$unit);
        }
       }
      return $arr_data;
    }
        $output_v = '';
        $output_p = '';
        $output_c = '';
        $model_code = '';
        $series = '';
        $cate_name = '';
        if(isset($optional_model)){
            $model_code = $optional_model;
        }else{
            $model_code = $product[0]['pro_code'] ?  $product[0]['pro_code'] :'' ;
        }

        $cate_name = $product[0]['cate_name'] ?  $product[0]['cate_name'] :'' ;
        $series = $product[0]['serie_name'] ?  $product[0]['serie_name'] .' Series' :'' ;

        if($product[0]['content'][1]->status_input == 3){
            $output_v = showdata($product[0]['content'][1]->data_1 ,$product[0]['content'][1]->data_2 ,$product[0]['content'][1]->unit_name);
        }else{
            $output_v = join(",",retextdata($datacheck1 , $product[0]['content'][1]->unit_name));
        }
        if($product[0]['content'][2]->status_input == 3){
            $output_p = showdata($product[0]['content'][2]->data_1 ,$product[0]['content'][2]->data_2 ,$product[0]['content'][2]->unit_name);
        }else{
            $output_p = join(",",retextdata($datacheck2 , $product[0]['content'][2]->unit_name));
        }
        if($product[0]['content'][0]->status_input == 3){
            $output_c = showdata($product[0]['content'][0]->data_1 ,$product[0]['content'][0]->data_2 ,$product[0]['content'][0]->unit_name);
        }else{
            $output_c = join(",",retextdata($datacheck3 , $product[0]['content'][0]->unit_name));
        }

       $meta_title = 'Delta '.$model_code.' '.$output_v.' '.$output_p.' '.$output_c.' '.$cate_name.' '.$series;
       $m_desc = $model_code.' '.$cate_name.' Offers output '.$output_v.' '.$output_p.' '.$output_c.' Features';
       $features  = trim(iconv_substr(strip_tags(str_replace("/uploads_delta",config('app.url')."/uploads_delta",$product[0]['content_1'])),0,122,'UTF-8'));
       $meta_description =  $product[0]['meta_description'] ? $product[0]['meta_description'] : $m_desc.' '.$features ;
?>
<title>{{$meta_title}}</title>
<meta name="description" content="{{$meta_description}}">
<meta property="og:title" content="{{$meta_title}}" />
<meta property="og:description" content="{{$meta_description}}" />
<meta property="og:image" content="{{config('app.url')}}/upload/thumbs/{{$product[0]['picture']}}" />
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
                    <li class="breadcrumb-item text-breadcrumb-home">
                        <a href="{{route('index','home')}}">{{$staticContent['Home']}}</a>
                    </li>
                    <li class="breadcrumb-item active text-breadcrumb-home" aria-current="page">
                        <a href="#">{{$staticContent['Products']}}</a>
                    </li>
                    <li class="breadcrumb-item active text-breadcrumb-home" aria-current="page">
                        <a
                            href="{{ route('productList',[$current_main_cate_id, preg_replace('/\s+/', '-',  $product[0]['url_item']),$product[0]['cate_id']])}}">{{$product[0]['cate_name']}}</a>
                    </li>
                    <li class="breadcrumb-item active text-breadcrumb-home" aria-current="page">
                        <a
                            href="{{ route('productList',[$current_main_cate_id, preg_replace('/\s+/', '-', $product[0]['url_item']),$product[0]['cate_id'],$product[0]['serie_name'],$product[0]['serie_id']])}}">{{$product[0]['serie_name']}}
                            {{$staticContent['Series']}}</a>
                    </li>
                    <li class="breadcrumb-item active text-breadcrumb-ative" aria-current="page">
                        <a
                            href="{{route('productsDetailsByType' ,['cateid'=> preg_replace('/\s+/', '-', $product[0]['url_item']) ,'pro_code' => setTextpro($product[0]['pro_code']) ])}}">{{$product[0]['pro_code']}}</a>
                    </li>
                    @if($optional_model)
                    <li class="breadcrumb-item active text-breadcrumb-ative" aria-current="page">
                        <a
                            href="{{route('productsDetailsByType' ,['cateid'=> preg_replace('/\s+/', '-', $product[0]['url_item']) ,'pro_code' => setTextpro($product[0]['pro_code'])])}}?optional_model={{setTextpro($optional_model)}}">{{$optional_model}}</a>
                    </li>
                    @endif
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="products-index-nav invisible-up-922">
    <div class="bg-bredcrumb">
        <div class="container">
            <nav aria-label="breadcrumb" id="breadcrumb">
                <ol class="breadcrumb">
                    {{-- <li class="breadcrumb-item text-breadcrumb-home">
                        <a href="{{route('index','home')}}">{{$staticContent['Home']}}</a>
                    </li>
                    <li class="breadcrumb-item active text-breadcrumb-home" aria-current="page">
                        <a href="#">{{$staticContent['Products']}}</a>
                    </li> --}}
                    {{-- <li class="breadcrumb-item active text-breadcrumb-home" aria-current="page">
                        <a
                            href="{{ route('productList',[preg_replace('/\s+/', '-',  $product[0]['url_item']),$product[0]['cate_id']])}}">{{$product[0]['cate_name']}}</a>
                    </li> --}}
                    <li class="breadcrumb-item active text-breadcrumb-home" aria-current="page">
                        <a
                            href="{{ route('productList',[$current_main_cate_id, preg_replace('/\s+/', '-', $product[0]['url_item']),$product[0]['cate_id'],$product[0]['serie_name'],$product[0]['serie_id']])}}">{{$product[0]['serie_name']}}
                            {{$staticContent['Series']}}</a>
                    </li>
                    <li class="breadcrumb-item active text-breadcrumb-ative" aria-current="page">
                        <a
                            href="{{route('productsDetailsByType' ,['cateid'=> preg_replace('/\s+/', '-', $product[0]['url_item']) ,'pro_code' => setTextpro($product[0]['pro_code'])])}}">{{$product[0]['pro_code']}}</a>
                    </li>
                    @if($optional_model)
                    <li class="breadcrumb-item active text-breadcrumb-ative" aria-current="page">
                        <a
                            href="{{route('productsDetailsByType' ,['cateid'=> preg_replace('/\s+/', '-', $product[0]['url_item']) ,'pro_code' => setTextpro($product[0]['pro_code'])])}}?optional_model={{$optional_model}}">{{$optional_model}}</a>
                    </li>
                    @endif
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="padding-top-content-breadcrumb visible-up-922"></div>
<div class="visible-up-922">
    <div class="invisible-nav-minimize">
        <div class="add-compare-nav ">
            <div class="container">
                <div class="code-name-product">
                    @if(isset($optional_model))
                    <h3>{{$optional_model}}</h3>
                    @else
                    <h3>{{$product[0]['pro_code'] }} </h3>
                    @endif
                </div>
                <div class="btn-add-compare-nav">
                    {{-- <a
                        href="{{route('LinktoEnquiry',[$product[0]['cate_id'] , $product[0]['cate_name'],setTextpro($product[0]['pro_code']) ])}}">
                        <button class="btn-enquiry">{{$staticContent['Enquiry']}}</button>
                    </a>
                    <button class="btn-addcompare"
                        onclick="showNavCoparison({{$product[0]['pro_id']}} ,{{$product[0]['cate_id']}})">{{$staticContent['Add_to_Compare']}}</button>
                    --}}

                    <div class="w-100">
                        <div class="boxlist-icon-img pd-mobile">
                            <a href="{{route('LinktoEnquiry',[$product[0]['cate_id'] , $product[0]['cate_name'],setTextpro($product[0]['pro_code']) ])}}"><button
                                    class="btn img-btn-icon-pro tooltip2"><span>{{$staticContent['Enquiry']}}</span><img
                                        src="{{asset('/frontend-asset/image/Enquiry.svg')}}"></button>
                            </a>
                            <button onclick="showNavCoparison({{$product[0]['pro_id']}} ,{{$product[0]['cate_id']}})"
                                class="btn img-btn-icon-pro tooltip2"><span>{{$staticContent['Add_to_Compare']}}</span><img
                                    src="{{asset('/frontend-asset/image/Compare.svg')}}"></button>
                            <a href="{{route('downloadFIle')}}/Datasheet/{{setTextpro($product[0]['pro_code'])}}" target="_blank"><button
                                    class="btn img-btn-icon-pro tooltip2"><span>{{$staticContent['data_sheet']}}</span><img
                                        src="{{asset('/frontend-asset/image/Datasheet.svg')}}"></button>
                            </a>

                            @foreach ($ec_link as $item)
                            <a href="{{$item->link}}" target="_blank"><button
                                    class="btn img-btn-icon-pro tooltip2"><span>{{$item->name}}</span><img
                                        src="{{asset('/frontend-asset/image/Buy.svg')}}"></button>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="box-detail my-5">
        <div class="container">
            <div class="row">
                <div class="col-4">
                    <div class="row d-none" id="add_delayshow">
                        <div class="col-3  product-show-list" id="preview">

                            <div>
                                <a onclick="clickImage('{{config('app.url')}}/upload/thumbs/{{$product[0]['picture']}}')"
                                    src="{{config('app.url')}}/upload/thumbs/{{$product[0]['picture']}}">
                                    <img class="py-1"
                                        src="{{config('app.url')}}/upload/thumbs/{{$product[0]['picture']}}" alt="">
                                </a>
                            </div>

                            @foreach ($vieo_img as $item)
                            @if($item->type == 2)
                            <?php
                             $data = $item->content;
                             $whatIWant = substr($data, strpos($data, "embed/") + 1);
                               ?>
                            <div>
                                <a onclick="clickYoutube('{{$item->content}}');">
                                    <img class="img-video w-100" src="https://img.youtube.com/vi/{{$whatIWant}}/0.jpg"
                                        alt="">
                                    <img class="play-button"
                                        src="{{asset('frontend-asset/image/product-detail/play-button.png')}}" alt="">
                                </a>
                            </div>
                            @else
                            <div>
                                <a onclick="clickImage('{{config('app.url')}}/uploads_delta/{{$item->content}}')"
                                    src="{{config('app.url')}}/uploads_delta/{{$item->content}}">
                                    <img class="py-1" src="{{config('app.url')}}/uploads_delta/{{$item->content}}"
                                        alt="">
                                </a>
                            </div>
                            @endif
                            @endforeach


                        </div>
                        <div class="col-9 product-show-box">
                        </div>
                    </div>
                </div>

                <div class="col-8">
                    <h4 class="my-1"> {{$product[0]['cate_name']}}</h4>
                    <h4 class="my-1">{{$product[0]['serie_name']}} {{$staticContent['Series']}}</h4>

                    @if($optional_model)
                    <h1 class="text-color-delta my-1">
                        {{$optional_model}}</h1>
                    @else
                    <h1 class="text-color-delta my-1">
                        {{$product[0]['pro_code']}}</h1>
                    @endif
                    <div class="btn-detail-describe my-3">
                        <a href="{{route('LinktoEnquiry',[$product[0]['cate_id'] , $product[0]['cate_name'],setTextpro($product[0]['pro_code']) ])}}">
                            <button class="btn btn-enquiry">{{$staticContent['Enquiry']}}</button>
                        </a>
                        <button class="btn btn-addcompare"
                            onclick="showNavCoparison({{$product[0]['pro_id']}}, {{$product[0]['cate_id']}})">{{$staticContent['Add_to_Compare']}}</button>
                        <a href="{{route('downloadFIle')}}/Datasheet/{{setTextpro($product[0]['pro_code'])}}"
                            target="_blank">
                            <button class="btn btn-datasheet">{{$staticContent['data_sheet']}}</button>
                        </a>
                        @foreach ($ec_link as $item)
                        <a href="{{$item->link}}" target="_blank">
                            <button class="btn btn-buynow mr-2">{{$item->name}}</button>
                        </a>
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="col-sm-4 box-product-detail">
                            <h5 class="text-color-delta mb-2">{{$staticContent['Output_Voltage']}}</h5>
                            {{-- <p class="text-one">
                                {{$product[0]['content'][1]->data_1}}{{$product[0]['content'][1]->unit_name}} </p> --}}

                            <p class="text-one">

                                @if($product[0]['content'][1]->status_input == 3)

                                <?php echo showdata($product[0]['content'][1]->data_1 ,$product[0]['content'][1]->data_2 ,$product[0]['content'][1]->unit_name)?>
                                @else
                                <?php echo join(",",retextdata($datacheck1 , $product[0]['content'][1]->unit_name));?>
                                @endif

                            </p>


                        </div>
                        <div class="col-sm-4 box-product-detail">

                            <h5 class="text-color-delta mb-2">{{$staticContent['Output_Power']}}</h5>
                            <p class="text-one">
                                @if($product[0]['content'][2]->status_input == 3)
                                <?php echo $product[0]['content'][2]->data_1.'-'.$product[0]['content'][2]->data_2.$product[0]['content'][2]->unit_name?>
                                @else
                                <?php echo join(",",retextdata($datacheck2 , $product[0]['content'][2]->unit_name));?>
                                @endif
                            </p>
                        </div>
                        <div class="col-sm-4 box-product-detail">
                            <h5 class="text-color-delta mb-2">{{$staticContent['Output_Current']}}</h5>
                            {{-- @if(isset($product[0]['content'][0]->data_1) && $product[0]['content'][0]->data_1 !=
                            null)
                            <p class="text-one">
                                {{$product[0]['content'][0]->data_1}}{{$product[0]['content'][0]->unit_name}}</p>
                            @else
                            <p class="text-one">-</p>
                            @endif --}}

                            <p class="text-one">

                                @if($product[0]['content'][0]->status_input == 3)

                                <?php echo showdata($product[0]['content'][0]->data_1 ,$product[0]['content'][0]->data_2 ,$product[0]['content'][0]->unit_name)?>
                                @else
                                <?php echo join(",",retextdata($datacheck3 , $product[0]['content'][0]->unit_name));?>
                                @endif
                            </p>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 box-product-detail">
                            <h5 class="text-color-delta mb-2">{{$staticContent['Input_Voltage']}}</h5>
                            <p class="text-one">{!!$product[0]['content'][3]->value_text!!}</p>
                        </div>
                        <div class="col-sm-4 box-product-detail">
                            <h5 class="text-color-delta mb-2"> {{$staticContent['Dimensions']}}
                                ({{$product[0]['unit_dimension_1']}} x W x {{$product[0]['unit_dimension']}}) </h5>

                            @if(isset($product[0]['dimensionL']) && is_numeric($product[0]['dimensionL']) &&
                            is_numeric($product[0]['dimensionD']) && is_numeric($product[0]['dimensionW']) &&
                            isset($product[0]['dimensionW']) && isset($product[0]['dimensionD']))
                            <p class="text-one">{{$product[0]['dimensionL']}} x {{$product[0]['dimensionW']}} x
                                {{$product[0]['dimensionD']}} mm</p>
                            <p class=" text-one">
                                {{number_format($product[0]['dimensionL']* 0.0393701 ,2)}}” x
                                {{number_format($product[0]['dimensionW']* 0.0393701 ,2)}}” x
                                {{number_format($product[0]['dimensionD']* 0.0393701 ,2)}}”</p>
                            @else
                            <p class="text-one">{!!$product[0]['dimensionL']!!}</p>
                            @endif

                        </div>
                        <div class="col-sm-4 box-product-detail">
                            <h5 class="text-color-delta mb-2">{{$staticContent['Unit_Weight']}}</h5>
                            <?php
                              $sum  = 0;
                            if(isset($product[0]['unit_weight'])){

                                $number = substr($product[0]['unit_weight'] , 0, -2);
                                $float = (float)$number;
                                $sum = ($float*2.2046244202);

                            }
                            ?>
                            <p class="text-one">{!!$product[0]['unit_weight']!!} ({{number_format($sum,2)}} lb)</p>

                        </div>
                    </div>
                    <div class="row  mt-3">
                        <div class="col-8">
                            <h5 class="text-color-delta mb-2">{{$staticContent['Highlights_Features']}}</h5>
                            <div class="text-editor">
                                {!!
                                str_replace("/uploads_delta",config('app.url')."/uploads_delta",$product[0]['content_1'])
                                !!}
                            </div>

                            @if(count($optional_pro) > 0)
                            <div id="box-optional-model" class="box-optional-model">
                                <div class="box-optional-model-list collapsed" data-toggle="collapse"
                                    data-target="#collapse-box-optional-model" aria-expanded="true"
                                    aria-controls="collapse-box-optional-model" href="#collapse-box-optional-model">
                                    <a class="card-title text-sixteen-dark">
                                        {{ isset($staticContent['optional_models']) ? $staticContent['optional_models'] : 'Optional Models' }}
                                    </a>
                                </div>
                                <div id="collapse-box-optional-model" aria-labelledby="collapse-box-optional-model"
                                    class="box-doc-list-sub collapse" data-parent="#box-optional-model">
                                    @if(count($optional_pro) > 0)
                                    <table class="table table-bordered table-optional-model">
                                        <thead class="thead-gray">
                                            <tr>
                                                <th class="text-center" style="width: 40%">{{$staticContent['Model']}}</th>
                                                <th class="text-center">
                                                    {{ isset($staticContent['description']) ? $staticContent['description'] : 'Description' }}
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($optional_pro as $optional)
                                            <tr>
                                                <td class="text-center">
                                                    <span class="text-tag"
                                                        onclick="viewOptionalModel('{{$optional->optional_model}}')">{{$optional->optional_model}}</span>
                                                </td>
                                                <td class="text-center">{!!$optional->remark!!}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    @endif
                                </div>
                            </div>
                            @endif

                            @if(count($tags_pro) > 0)
                            <h5 class="text-color-delta mt-4">{{$staticContent['Tags']}} </h5>

                            @foreach ($tags_pro as $tag)
                            <span onclick="viewKey('{{$tag->tag}}')" class="text-tag">{{$tag->tag}}{{
                                $loop->last ? '' : ',' }}</span>
                            @endforeach
                            @endif


                            {{-- @foreach ($optional_pro as $optional) --}}
                            {{-- <span onclick="viewOptionalModel('{{$optional->optional_model}}')"
                                class="text-tag">{{$optional->optional_model}}{{$loop->iteration !=
                                $loop->count?',':'' }}</span> --}}
                            {{-- @endforeach --}}

                            {{-- <a href="{{route('searchByTag')}}/{{$tag->tag}}"></a> --}}

                        </div>
                        <div class="col-4">
                            <h5 class="text-color-delta mb-2">{{$staticContent['Applications']}}</h5>
                            <div class="icon-app-detail-new">
                                @foreach ($series_has_application as $item)

                                <a href="{{route('appDetail' ,[ 'name' => $item->slug_app, 'id' => $item->id])}}"
                                    data-toggle="tooltip" data-placement="top" title="{{$item->name}}"
                                    class="icon btn-icon-app itemhorver{{$item->id}}"
                                    style="background-image: url('{{config('app.url')}}/medias/categories/{{$item->icon}}'); "></a>
                                <script>
                                    $(".itemhorver{{$item->id}}").hover(function(){
                                                $(this).css("background-image", "url('{{config('app.url')}}/medias/categories/{{$item->blue_outline_icon}}')");
                                                }, function(){
                                                $(this).css("background-image", "url('{{config('app.url')}}/medias/categories/{{$item->icon}}')");
                                                });
                                </script>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            {{-- <h5 class="text-color-delta mb-2">MODEL NUMBERING</h5> --}}
                            <div class="text-editor">
                                {!!$product[0]['content_2'] !!}
                            </div>
                            {{-- <table class="model-num">
                                <thead>
                                    <tr>
                                        <th>DR</th>
                                        <th>B-</th>
                                        <th>24V</th>
                                        <th>020A</th>
                                        <th>B</th>
                                        <th><i class="zmdi zmdi-square-o"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr valign="top">
                                        <td>DIN RAIL </td>
                                        <td>Buffer Module</td>
                                        <td>Output Voltage</td>
                                        <td>Output Current</td>
                                        <td>CliQ II Series</td>
                                        <td>A - Metal Case,with Class I, Div 2 <br> N - Metal Case, without Class I,Div
                                            2
                                        </td>
                                    </tr>
                                </tbody>

                            </table> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="visible-nav-minimize">
    <div class="add-compare-nav-mobile px-3">
        <div class="d-flex justify-content-between h-100">
            <div class="w-100 my-auto">
                <h6 class="m-0">

                </h6>
                <h5 class="text-color-delta m-0 visible-up-320"> {{$product[0]['pro_code']}}</h5>
                <h6 class="text-color-delta m-0 invisible-up-320"> {{$product[0]['pro_code']}}</h6>
            </div>
            <div class="my-auto w-100 d-flex justify-content-end">
                {{-- <a class="btn btn-enquiry w-50 mr-2"
                    href="{{route('LinktoEnquiry',[$product[0]['cate_id'] , $product[0]['cate_name'],setTextpro($product[0]['pro_code']) ])}}">
                    {{$staticContent['Enquiry']}}
                </a>
                <button class="btn btn-addcompare w-50 "
                    onclick="showNavCoparison({{$product[0]['pro_id']}},{{$product[0]['cate_id']}})">{{$staticContent['compare']}}</button>
                --}}

                <div class="w-100">
                    <div class="boxlist-icon-img pd-mobile">
                        <a
                            href="{{route('LinktoEnquiry',[$product[0]['cate_id'] , $product[0]['cate_name'],setTextpro($product[0]['pro_code']) ])}}"><button
                                class="btn img-btn-icon-pro tooltip2"><span>{{$staticContent['Enquiry']}}</span><img
                                    src="{{asset('/frontend-asset/image/Enquiry.svg')}}"></button></a>
                        <button onclick="showNavCoparison({{$product[0]['pro_id']}} ,{{$product[0]['cate_id']}})"
                            class="btn img-btn-icon-pro tooltip2"><span>{{$staticContent['Add_to_Compare']}}</span><img
                                src="{{asset('/frontend-asset/image/Compare.svg')}}"></button>
                        <a href="{{route('downloadFIle')}}/Datasheet/{{setTextpro($product[0]['pro_code'])}}"
                            target="_blank"><button
                                class="btn img-btn-icon-pro tooltip2"><span>{{$staticContent['data_sheet']}}</span><img
                                    src="{{asset('/frontend-asset/image/Datasheet.svg')}}"></button></a>
                        @foreach ($ec_link as $item)
                        <a href="{{ $item->link }}" target="_blank"><button
                                class="btn img-btn-icon-pro tooltip2"><span>{{ $item->name }}</span><img
                                    src="{{asset('/frontend-asset/image/Buy.svg')}}"></button>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
<div class="invisible-up-922">
    <div class="box-detail my-5">
        <div class="container">
            <div class="product-show-box w-100">

            </div>

            <div class="col-12 product-show-list" id="preview-mobile">
                <div>
                    <a onclick="clickImage('{{config('app.url')}}/upload/thumbs/{{$product[0]['picture']}}')"
                        src="{{config('app.url')}}/upload/thumbs/{{$product[0]['picture']}}">
                        <img class="p-1" src="{{config('app.url')}}/upload/thumbs/{{$product[0]['picture']}}" alt="">
                    </a>
                </div>

                @foreach ($vieo_img as $item)
                @if($item->type == 2)
                <?php
                $data = $item->content;
                $whatIWant = substr($data, strpos($data, "embed/") + 1);
                  ?>
                <div>
                    <a onclick="clickYoutube('{{$item->content}}');">
                        <img class="img-video w-100" src="https://img.youtube.com/vi/{{$whatIWant}}/0.jpg" alt="">
                        <img class="play-button" src="{{asset('frontend-asset/image/product-detail/play-button.png')}}"
                            alt="">
                    </a>
                </div>
                @else
                <div>
                    <a onclick="clickImage('{{config('app.url')}}/uploads_delta/{{$item->content}}')"
                        src="{{config('app.url')}}/uploads_delta/{{$item->content}}">
                        <img class="p-1" src="{{config('app.url')}}/uploads_delta/{{$item->content}}" alt="">
                    </a>
                </div>
                @endif
                @endforeach

            </div>
            <div class="my-4">

                <h4 class="my-1 text-center"> {{$product[0]['cate_name']}}</h4>
                <h4 class="my-1 text-center">{{$product[0]['serie_name']}} {{$staticContent['Series']}}</h4>
                <h3 class="text-color-delta my-1 text-center">
                    @if($optional_model)
                    {{$optional_model}}</h3>
                @else
                {{$product[0]['pro_code']}}</h3>
                @endif

            </div>
            <div class="my-4">
                <a
                    href="{{route('LinktoEnquiry',[$product[0]['cate_id'] , $product[0]['cate_name'],setTextpro($product[0]['pro_code']) ])}}">
                    <button class="btn btn-enquiry w-100 my-2">{{$staticContent['Enquiry']}}</button>
                </a>

                <button class="btn btn-addcompare w-100 my-2"
                    onclick="showNavCoparison({{$product[0]['pro_id']}} ,{{$product[0]['cate_id']}})">{{$staticContent['Add_to_Compare']}}</button>
                <a href="{{route('downloadFIle')}}/Datasheet/{{setTextpro($product[0]['pro_code'])}}" target="_blank">
                    <button class="btn btn-datasheet w-100 mr-2">{{$staticContent['data_sheet']}}</button>
                </a>

                @foreach ($ec_link as $item)
                <a href="{{$item->link}}" target="_blank">
                    <button class="btn btn-buynow w-100 my-2">{{$item->name}}</button>
                </a>
                @endforeach
            </div>

            <div class="box-detail">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h5 class="text-color-delta mb-2"> {{$staticContent['Highlights_Features']}}</h5>
                            <div class="text-editor">
                                {!!
                                str_replace("/uploads_delta",config('app.url')."/uploads_delta",$product[0]['content_1'])
                                !!}
                            </div>
                            {{-- <ul style="padding: 0 18px;" class="text-one">
                                <li>Full corrosion resistant Aluminium chassis</li>
                                <li>Long minimum buffering time of 250ms @ 24V/20A</li>
                                <li>Can connect in parallel to increase buffering time</li>
                                <li>Charging time of < 30 seconds</li>
                                <li>Conformal coating on PCBA to protect against
                                    chemical and dust pollutants</li>
                                <li>Designed for Class I Div. 2 Hazardous Locations environments (DRB-24V020ABA)</li>
                            </ul> --}}
                        </div>

                    </div>

                    <div class="row mt-3">
                        <div class="col-6 box-product-detail">
                            <h5 class="text-color-delta mb-2"> {{$staticContent['Output_Voltage']}}</h5>
                            <p class="text-one">
                                @if($product[0]['content'][1]->status_input == 3)

                                <?php echo showdata($product[0]['content'][1]->data_1 ,$product[0]['content'][1]->data_2 ,$product[0]['content'][1]->unit_name)?>
                                @else
                                <?php echo join(",",retextdata($datacheck1 , $product[0]['content'][1]->unit_name));?>
                                @endif
                            </p>

                        </div>
                        <div class="col-6 box-product-detail">
                            <h5 class="text-color-delta mb-2"> {{$staticContent['Output_Power']}}</h5>
                            {{-- @if(isset($product[0]['content'][2]->data_1) && $product[0]['content'][2]->data_1 !=
                            null)
                            <p class="text-one">
                                {{$product[0]['content'][2]->data_1}}{{$product[0]['content'][2]->unit_name}}</p>
                            @else
                            <p class="text-one">-</p>
                            @endif --}}

                            <p class="text-one">
                                @if($product[0]['content'][2]->status_input == 3)
                                <?php echo showdata($product[0]['content'][2]->data_1 ,$product[0]['content'][2]->data_2 ,$product[0]['content'][2]->unit_name)?>

                                @else
                                <?php echo join(",",retextdata($datacheck2 , $product[0]['content'][2]->unit_name));?>
                                @endif
                            </p>
                        </div>
                        <div class="col-6 box-product-detail">
                            <h5 class="text-color-delta mb-2"> {{$staticContent['Output_Current']}}</h5>
                            {{-- @if(isset($product[0]['content'][0]->data_1) && $product[0]['content'][0]->data_1 !=
                            null )
                            <p class="text-one">
                                {{$product[0]['content'][0]->data_1}}{{$product[0]['content'][0]->unit_name}}</p>
                            @else
                            <p class="text-one">-</p>
                            @endif --}}

                            <p class="text-one">
                                @if($product[0]['content'][0]->status_input == 3)
                                <?php echo showdata($product[0]['content'][0]->data_1 ,$product[0]['content'][0]->data_2 ,$product[0]['content'][0]->unit_name)?>
                                @else
                                <?php echo join(",",retextdata($datacheck3 , $product[0]['content'][0]->unit_name));?>
                                @endif
                            </p>

                        </div>
                        <div class="col-6 box-product-detail">
                            <h5 class="text-color-delta mb-2">{{$staticContent['Input_Voltage']}}</h5>
                            <p class="text-one">{!!$product[0]['content'][3]->value_text!!}</p>
                        </div>
                        <div class="col-6 box-product-detail">
                            <h5 class="text-color-delta mb-2"> {{$staticContent['Dimensions']}}</h5>
                            @if(isset($product[0]['dimensionL']) && is_numeric($product[0]['dimensionL']) &&
                            is_numeric($product[0]['dimensionD']) && is_numeric($product[0]['dimensionW']) &&
                            isset($product[0]['dimensionW']) && isset($product[0]['dimensionD']))
                            <p class="text-one">{{$product[0]['dimensionL']}} x {{$product[0]['dimensionW']}} x
                                {{$product[0]['dimensionD']}} mm</p>
                            <p class=" text-one">
                                {{number_format($product[0]['dimensionL']* 0.0393701 ,2)}}” x
                                {{number_format($product[0]['dimensionW']* 0.0393701 ,2)}}” x
                                {{number_format($product[0]['dimensionD']* 0.0393701 ,2)}}”</p>
                            @else
                            <p class="text-one">{!!$product[0]['dimensionL']!!}</p>
                            @endif

                        </div>
                        <div class="col-6 box-product-detail">
                            <h5 class="text-color-delta mb-2">{{$staticContent['Unit_Weight']}}</h5>
                            <p class="text-one">{!!$product[0]['unit_weight']!!} ({{number_format($sum,2)}} lb)</p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center mt-3">
                        <div class="">
                            <h5 class="text-color-delta text-center">{{$staticContent['Applications']}}</h5>
                            <div class="icon-app-detail">
                                @foreach ($series_has_application as $item)

                                <a href="{{route('appDetail' ,[ 'name' => $item->slug_app , 'id' => $item->id])}}"
                                    data-toggle="tooltip" data-placement="top" title="{{$item->name}}"
                                    class="icon btn-icon-app itemhorver{{$item->id}}"
                                    style="background-image: url('{{config('app.url')}}/medias/categories/{{$item->icon}}'); "></a>
                                <script>
                                    $(".itemhorver{{$item->id}}").hover(function(){
                                                $(this).css("background-image", "url('{{config('app.url')}}/medias/categories/{{$item->blue_outline_icon}}')");
                                                }, function(){
                                                $(this).css("background-image", "url('{{config('app.url')}}/medias/categories/{{$item->icon}}')");
                                                });
                                </script>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="w-100 mb-2 mt-4">

                        @if(count($optional_pro) > 0)
                        <div id="box-optional-model" class="box-optional-model-mobile">
                            <div class="box-optional-model-list collapsed" data-toggle="collapse"
                                data-target="#collapse-box-optional-model-mobile" aria-expanded="true"
                                aria-controls="collapse-box-optional-model" href="#collapse-box-optional-model-mobile">
                                <a class="card-title text-sixteen-dark">
                                    {{ isset($staticContent['optional_models']) ? $staticContent['optional_models'] : 'Optional Models' }}
                                </a>
                            </div>
                            <div id="collapse-box-optional-model-mobile" aria-labelledby="collapse-box-optional-model"
                                class="collapse" data-parent="#box-optional-model-mobile">
                                @if(count($optional_pro) > 0)
                                <table class="table table-bordered table-optional-model">
                                    <thead class="thead-gray">
                                        <tr>
                                            <th class="text-center" style="width: 40%">  {{$staticContent['Model']}}</th>
                                            <th class="text-center">  
                                                {{ isset($staticContent['description']) ? $staticContent['description'] : 'Description' }}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($optional_pro as $optional)
                                        <tr>
                                            <td class="text-center">
                                                <span class="text-tag"
                                                    onclick="viewOptionalModel('{{$optional->optional_model}}')">{{$optional->optional_model}}</span>
                                            </td>
                                            <td class="text-center">{!!$optional->remark!!}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @endif
                            </div>
                        </div>
                        @endif
                        @if(count($tags_pro) > 0)
                        <h5 class="text-color-delta mt-4">{{$staticContent['Tags']}}</h5>

                        @foreach ($tags_pro as $tag)
                        <span onclick="viewKey('{{$tag->tag}}')" class="text-tag">{{$tag->tag}}{{
                            $loop->last ? '' : ',' }}</span>
                        @endforeach
                        @endif


                        {{-- <h5 class="text-color-delta  text-center">MODEL NUMBERING</h5>
                        <div class="d-flex justify-content-center">
                            <img class="img-fluid " src="{{asset('frontend-asset/image/Mask Group 11.png')}}" alt="">
                        </div>

                        <div class="d-flex justify-content-center my-2">
                            <a href="" class="text-link text-dark text-underline "><img class="mr-1"
                                    src="{{asset('frontend-asset/image/icon/maximize.svg')}}" alt="">VIEW FULL IMAGE</a>
                        </div> --}}

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="box-doc">
    <div class="container">
        <h4 class="text-color-delta visible-up-922">{{$staticContent['Downloads']}}</h4>
        <h3 class="text-color-delta text-center invisible-up-922">{{$staticContent['Downloads']}}</h3>
        <div id="box-doc-type" class="box-doc-type">
            <div class="box-doc-list collapsed fliter_type hide-box" data-toggle="collapse" data-parent="#box-doc-type"
                href="#collapse-box-doc-documents">
                <a class="card-title text-sixteen-dark">
                    {{$staticContent['Downloads']}}
                </a>
            </div>
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

            <div id="collapse-box-doc-documents" class="box-doc-list-sub collapse" data-parent="#box-doc-type">
                <div>
                    <div>
                        @foreach ($documents as $item)
                        @if($item->main_cate_id == 1)
                        @if($item->cate_id == 1 || $item->cate_id == 2 )
                        <div class="data-sheet-downloade d-flex justify-content-between ">
                            <div class="detail-downlode ">
                                <p class="text-dark text-bold">{{$item->catename}}</p>
                                <?php
                                 $date = getDateformat($item->created_at);
                             ?>
                                <p class="text-dark">{{$staticContent['Uploaded_on']}} {{ $date['d']
                                    .'-'.$date['m'].'-'.$date['y']}} </p>
                                {{-- <p class="text-dark">{{$staticContent['Uploaded_on']}} {{ $date['d']
                                    .''.$date['m'].' '.$date['y']}} | 4.7 MB</p> --}}
                            </div>
                            <a href="{{route('downloadFIle',[$item->slug,setTextpro($product[0]['pro_code'])])}}"
                                target="_blank">
                                <button class="btn-downlode">{{$staticContent['Downloads']}}</button>
                            </a>
                        </div>
                        @endif
                        @endif
                        @endforeach
                        <div class="data-sheet-downloade d-flex justify-content-between ">
                            <div class="detail-downlode ">
                                <p class="text-dark text-bold">Image</p>
                                <?php
                                 $date2 = getDateformat($product[0]['updated_at']);
                             ?>
                                <p class="text-dark">{{$staticContent['Uploaded_on']}} {{ $date2['d']
                                    .'-'.$date2['m'].'-'.$date2['y']}} </p>
                            </div>

                            <a href="{{config('app.url')}}/upload/thumbs/{{$product[0]['picture']}}"
                                download="{{$product[0]['pro_code']}}">
                                <button class="btn-downlode">{{$staticContent['Downloads']}}</button>
                            </a>
                        </div>

                        @foreach ($documents as $item)
                        @if($item->main_cate_id == 1)
                        @if($item->cate_id == 5 )
                        <div class="data-sheet-downloade d-flex justify-content-between ">
                            <div class="detail-downlode ">
                                <p class="text-dark text-bold">{{$item->catename}}</p>
                                <?php
                                 $date = getDateformat($item->created_at);
                             ?>
                                <p class="text-dark">{{$staticContent['Uploaded_on']}} {{ $date['d']
                                    .'-'.$date['m'].'-'.$date['y']}} </p>
                                {{-- <p class="text-dark">{{$staticContent['Uploaded_on']}} {{ $date['d']
                                    .''.$date['m'].' '.$date['y']}} | 4.7 MB</p> --}}
                            </div>
                            <a href="{{route('downloadFIle',[$item->slug,setTextpro($product[0]['pro_code'])])}}"
                                target="_blank">
                                <button class="btn-downlode">{{$staticContent['Downloads']}}</button>
                            </a>
                        </div>
                        @endif
                        @endif
                        @endforeach

                        @foreach ($documents as $item)
                        @if($item->main_cate_id == 1)
                        @if($item->cate_id != 1 && $item->cate_id != 2 && $item->cate_id != 5 )
                        <div class="data-sheet-downloade d-flex justify-content-between ">
                            <div class="detail-downlode ">
                                <p class="text-dark text-bold">{{$item->catename}}</p>
                                <?php
                                 $date = getDateformat($item->created_at);
                             ?>
                                <p class="text-dark">{{$staticContent['Uploaded_on']}} {{ $date['d']
                                    .'-'.$date['m'].'-'.$date['y']}} </p>
                                {{-- <p class="text-dark">{{$staticContent['Uploaded_on']}} {{ $date['d']
                                    .''.$date['m'].' '.$date['y']}} | 4.7 MB</p> --}}
                            </div>
                            <a href="{{route('downloadFIle',[$item->slug,setTextpro($product[0]['pro_code'])])}}"
                                target="_blank">
                                <button class="btn-downlode">{{$staticContent['Downloads']}}</button>
                            </a>
                        </div>
                        @endif
                        @endif
                        @endforeach

                        @foreach ($external_link as $item)
                        <div class="data-sheet-downloade d-flex justify-content-between ">
                            <div class="detail-downlode ">
                                <a href="{{$item->link}}" target="_blank">
                                    <div class="box-imgexternal">
                                        <img src="{{config('app.url')}}/upload/thumbs/{{$item->logo}}">
                                    </div>
                                </a>
                            </div>
                            <a href="{{$item->link}}" target="_blank">
                                <button class="btn-downlode btn-middle">{{$staticContent['Downloads']}}</button>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="box-doc-list collapsed fliter_type hide-box" data-toggle="collapse" data-parent="#box-doc-type"
                href="#collapse-box-doc-certificates">
                <a class="card-title text-sixteen-dark">

                    {{$staticContent['Certificates']}}
                </a>
            </div>
            <div id="collapse-box-doc-certificates" class="box-doc-list-sub collapse" data-parent="#box-doc-type">
                <div>
                    <div>
                        @foreach ($documents as $item)
                        @if($item->main_cate_id == 2)
                        <?php
                        $date2 = getDateformat($item->created_at);
                    ?>

                        <div class="data-sheet-downloade d-flex justify-content-between ">
                            <div class="detail-downlode ">
                                <p class="text-dark text-bold">{{$item->catename}}</p>
                                <p class="text-dark">{{$staticContent['Uploaded_on']}} {{ $date2['d']
                                    .'-'.$date2['m'].'-'.$date2['y']}} </p>
                            </div>
                            <a href="{{route('downloadFIle',[$item->slug,setTextpro($product[0]['pro_code'])])}}"
                                target="_blank">
                                <button class="btn-downlode">{{$staticContent['Downloads']}}</button>
                            </a>
                        </div>
                        @endif
                        @endforeach

                    </div>
                </div>
            </div>

            <div class="box-doc-list collapsed fliter_type hide-box" data-toggle="collapse" data-parent="#box-doc-type"
                href="#collapse-box-doc-gui">
                <a class="card-title text-sixteen-dark">
                    {{$staticContent['GUI_Software']}}
                </a>
            </div>
            <div id="collapse-box-doc-gui" class="box-doc-list-sub collapse" data-parent="#box-doc-type">
                <div>
                    <div>
                        @foreach ($documents as $item)
                        @if($item->main_cate_id == 3)
                        <?php
                            $date2 = getDateformat($item->created_at);
                        ?>

                        <div class="data-sheet-downloade d-flex justify-content-between ">
                            <div class="detail-downlode ">
                                <p class="text-dark text-bold">{{$item->catename}}</p>
                                <p class="text-dark">{{$staticContent['Uploaded_on']}} {{$date2['d'] . '-' . $date2['m'] . '-'.$date2['y']}}</p>
                            </div>
                            <a data-toggle="modal" data-target="#downloadgui-modal"
                                onclick="downloadGUI('{{$item->file}}', '{{setTextpro($product[0]['pro_code'])}}', '{{$product[0]['cate_name']}}')"
                                {{-- href="{{route('downloadFIle',[$item->slug, setTextpro($product[0]['pro_code'])])}}" --}}
                                target="_blank">
                                <button class="btn-downlode">{{$staticContent['Downloads']}}</button>
                            </a>
                        </div>
                        @endif
                        @endforeach

                    </div>
                </div>
            </div>



        </div>
    </div>
</div>
<div class="box-tech-specs">
    <div class="container">
        <h4 class="text-color-delta visible-up-922">{{$staticContent['Tech_Specs']}}</h4>
        <h3 class="text-color-delta text-center invisible-up-922">{{$staticContent['Tech_Specs']}}</h3>
        <select id="select-tech" onchange="selectproduct();" class="form-control invisible-up-922">
            @foreach ($section as $sec)
            <option value="{{$sec->id}}">{{$sec->sortname}}</option>
            @endforeach
        </select>
        <nav id="bar-tech-specs-nav" class="visible-up-922">
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                @foreach ($section as $sec)
                <a class="nav-item nav-link {{($loop->iteration == 1) ?'active':''}}"
                    onclick="popSection({{$sec->id}});" id="nav-output-tab{{$sec->id}}" data-toggle="tab"
                    href="#nav-tabspec{{$sec->id}}" role="tab" aria-controls="nav-output-tab{{$sec->id}}"
                    aria-selected="true" data-val="{{$sec->id}}">{{$sec->sortname}}
                </a>
                @endforeach

            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            @foreach ($section as $sec)
            <div class="tab-pane fade {{$loop->iteration == 1 ?'show active':''}} bar-product-type-list "
                id="nav-tabspec{{{$sec->id}}}" role="tabpanel" aria-labelledby="nav-output-tab{{$sec->id}}">
                <a class="box-spc " data-toggle="collapse" href="#collapse-box-spce{{$sec->id}}">

                </a>
                <div id="collapse-box-spce{{$sec->id}}" class="collapse show">
                    <table class="table">
                        <tbody>
                            @foreach ($product_has_property as $prh)
                            @if($prh->section_id == $sec->id)
                            <?php
                           $strig = '-';
                           $numberText = '' ;
                           $numberarr = [];
                           $check = false;
                           if($prh->type_value == 'number'){
                               if($prh->status_input == 3){
                                 if(!is_null($prh->data_1)  ){
                                    $numberText = $prh->data_1.'-'.$prh->data_2.$prh->unit_name;
                                    $check = true;
                                 }else{
                                    $numberText = 'test';
                                 }

                               }else{
                                   $arr_data = [];
                                      $datacheck = [
                                        $prh->data_1,
                                        $prh->data_2,
                                        $prh->data_3,
                                        $prh->data_4,
                                        $prh->data_5,
                                        $prh->data_6,
                                        $prh->data_7,
                                        $prh->data_8,
                                        $prh->data_10,
                                        $prh->data_11,
                                        $prh->data_12,
                                       ];
                                     foreach ($datacheck as $dch){
                                        if(!is_null($dch)){
                                            array_push($arr_data,$dch.$prh->unit_name);
                                        }
                                     }
                                     if(isset($arr_data) && count($arr_data) > 0){
                                        $check = true;
                                        $numberarr = $arr_data;
                                     }


                               }

                           }else{
                            if($prh->value_text != null && $prh->value_text != 'null'){
                                $check = true;
                                $strig = $prh->value_text;
                            }
                           }

                        ?>
                            <tr class="{{$check?'d-block':'d-none'}}">
                                <td>
                                    <div class="col-md-3 subject-detail "><b>{{$prh->fieldCate}}</b></div>
                                    <div class="col-md-9 explain-detail ">
                                        @if($prh->type_value == 'number')
                                        @if($prh->status_input == 3)
                                        <?php echo $numberText?>
                                        @else
                                        <?php echo join(",",$numberarr);?>
                                        @endif
                                        @else
                                        <?php echo $strig?>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                            @if($sec->id == 3)
                            <tr class="">
                                <td>
                                    <div class="col-md-3 subject-detail "><b>{{$staticContent['Unit_Weight']}}</b></div>
                                    <div class="col-md-9 explain-detail ">
                                        {!!$product[0]['unit_weight']!!} ({{number_format($sum,2)}} lb)
                                    </div>
                                </td>
                                <td>
                                    <div class="col-md-3 subject-detail "><b>{{$staticContent['Dimensions']}}</b></div>
                                    <div class="col-md-9 explain-detail ">
                                        @if(isset($product[0]['dimensionL']) && is_numeric($product[0]['dimensionL']) &&
                                        is_numeric($product[0]['dimensionD']) && is_numeric($product[0]['dimensionW'])
                                        && isset($product[0]['dimensionW']) && isset($product[0]['dimensionD']))
                                        {{$product[0]['dimensionL']}} x {{$product[0]['dimensionW']}} x
                                        {{$product[0]['dimensionD']}} mm <br>

                                        {{number_format($product[0]['dimensionL']* 0.0393701 ,2)}}” x
                                        {{number_format($product[0]['dimensionW']* 0.0393701 ,2)}}” x
                                        {{number_format($product[0]['dimensionD']* 0.0393701 ,2)}}”
                                        @else
                                        {!!$product[0]['dimensionL']!!}
                                        @endif

                                    </div>
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            @endforeach


        </div>
    </div>
</div>
<div class="box-lookingfor py-5"
    style="background: url('{{asset('frontend-asset/image/product-detail/Help.jpg')}}') no-repeat; background-position: top center; background-size: cover; ">

    <!-- 單一 Widget -->
    {{-- <section class="widget-section">
        <div class="widget-bg">
            <div class="widget-inner widget-inner--single">
                <article class="widget-card">
                    <span class="widget-bar"></span>
                    <h1 class="widget-title">Contact Us</h1>
                    <p class="widget-text">
                        Submit your inquiry and we will reach out to you.
                    </p>
                    <a href="/contact" class="widget-btn">Inquire</a>
                </article>
            </div>
        </div>
    </section> --}}

    <!-- 雙 Widget -->
    <section class="widget-section">
        <div class="widget-bg">
            <div class="widget-inner widget-inner--double">
                <article class="widget-card">
                    <div class="widget-bar"></div>
                    <h1 class="widget-title">{{ $staticContent['Looking_for_support_for_this'] }}</h1>
                    <p class="widget-text"></p> 
                    <a href="{{ route('contactSupport') }}">
                        <button class="btn btn-subscribe">
                            {{isset($staticContent['Get_Support'])?$staticContent['Get_Support']:"Get Support"}}
                        </button>
                    </a>
                </article>

                <article class="widget-card">
                    <div class="widget-bar"></div>
                    <h1 class="widget-title">{{ isset($staticContent['Subscribe_to_our_newsletter']) ?
                            $staticContent['Subscribe_to_our_newsletter'] : "Subscribe to our newsletter" }}</h1>
                    <p class="widget-text"></p>

                    <a href="javascript:void(0);">
                        <button class="btn btn-subscribe" onclick="resetfield();" data-toggle="modal" data-target="#subscribe-modal">
                            {{isset($staticContent['Subscribe'])?$staticContent['Subscribe']:"Subscribe"}}
                        </button>
                    </a>
                </article>
            </div>
        </div>
    </section>

    {{-- <div class="d-flex">
        <div class="box-lookingfor-content text-center">
            <h2 class="text-white visible-up-922">{{$staticContent['Looking_for_support_for_this']}}</h2>
            <h3 class="text-white invisible-up-922">{{$staticContent['Looking_for_support_for_this']}}</h3>
            <a href="{{route('contactSupport')}}"><button
                    class="btn-addcompare mt-3">{{$staticContent['Get_Support']}}</button></a>
        </div>
    </div> --}}
</div>
<div class="">
    <div class="box-related-products">
        <div class="container">
            <h2 class="text-center">{{$staticContent['Related_Products']}}</h2>
            <div class="product-random">
                <div class="">
                    <div id="producttype" class="owl-carousel owl-theme  ft-products-body">
                        @foreach ($Otherpros as $proRelate)

                        <div class="">
                            <div class="card">
                                <?php
                                $color = '';
                                $name_sta = '';
                               $stat = $proRelate['status_product'];
                                 if($stat == 2){
                                     $color = '#76B900';
                                     $name_sta = 'NEW';
                                 }else if($stat == 3){
                                     $color = '#337ab7';
                                     $name_sta = 'NRND';
                                 }else if($stat == 4){
                                     $color = '#f0ad4e';
                                     $name_sta = 'EOL';
                                 }
                                 ?>
                                <div class="new-tag" style="background-color:{{$color}}">{{$name_sta}}</div>
                                <div class="card-body ft-products-item">
                                    <a
                                        href="{{route('productsDetailsByType' ,['cateid'=> preg_replace('/\s+/', '-', $proRelate['url_item']) ,'pro_code' => setTextpro($proRelate['pro_code']) ])}}">
                                        @if(isset($proRelate['picture']))
                                        <img src="{{config('app.url')}}/upload/thumbs/{{$proRelate['picture']}}"
                                            class="product-cat" alt="" style="width:70%;">
                                        @else
                                        <img src="{{asset('frontend-asset/image/blank.png')}}" class="product-cat"
                                            alt="" style="width:70%;">
                                        @endif

                                        <h5 class="text-title-ft">{{$proRelate['pro_code']}}</h5>
                                    </a>
                                    <div class="row">
                                        <div class="col">
                                            <?php
                                             $datacheck1 = [
                                                    $proRelate['content'][1]->data_1,
                                                    $proRelate['content'][1]->data_2,
                                                    $proRelate['content'][1]->data_3,
                                                    $proRelate['content'][1]->data_4,
                                                    $proRelate['content'][1]->data_5,
                                                    $proRelate['content'][1]->data_6,
                                                    $proRelate['content'][1]->data_7,
                                                    $proRelate['content'][1]->data_8,
                                                    $proRelate['content'][1]->data_9,
                                                    $proRelate['content'][1]->data_10,
                                                    $proRelate['content'][1]->data_11,
                                                    $proRelate['content'][1]->data_12,
                                                    ];
                                                    $datacheck2 = [
                                                        $proRelate['content'][2]->data_1,
                                                        $proRelate['content'][2]->data_2,
                                                        $proRelate['content'][2]->data_3,
                                                        $proRelate['content'][2]->data_4,
                                                        $proRelate['content'][2]->data_5,
                                                        $proRelate['content'][2]->data_6,
                                                        $proRelate['content'][2]->data_7,
                                                        $proRelate['content'][2]->data_8,
                                                        $proRelate['content'][2]->data_9,
                                                        $proRelate['content'][2]->data_10,
                                                        $proRelate['content'][2]->data_11,
                                                        $proRelate['content'][2]->data_12,
                                                    ];
                                                $datacheck3 = [
                                                    $proRelate['content'][0]->data_1,
                                                    $proRelate['content'][0]->data_2,
                                                    $proRelate['content'][0]->data_3,
                                                    $proRelate['content'][0]->data_4,
                                                    $proRelate['content'][0]->data_5,
                                                    $proRelate['content'][0]->data_6,
                                                    $proRelate['content'][0]->data_7,
                                                    $proRelate['content'][0]->data_8,
                                                    $proRelate['content'][0]->data_9,
                                                    $proRelate['content'][0]->data_10,
                                                    $proRelate['content'][0]->data_11,
                                                    $proRelate['content'][0]->data_12,
                                                    ];
                                                ?>
                                            <div class="out-volt">
                                                <h6 class="text-title-ft-sub">{{$staticContent['Output_Voltage']}}</h6>
                                                <p class="text-ft-sub text-one">
                                                    {{-- {{$pro['content'][1]->data_1}}{{$pro['content'][1]->unit_name}}
                                                    --}}
                                                    @if($proRelate['content'][1]->status_input == 3)
                                                    @if($proRelate['content'][1]->data_1 != null &&
                                                    $proRelate['content'][1]->data_2
                                                    != null)
                                                    {{$proRelate['content'][1]->data_1}}-{{$proRelate['content'][1]->data_2}}{{$proRelate['content'][1]->unit_name}}
                                                    @else
                                                    -
                                                    @endif
                                                    @else
                                                    @if($proRelate['content'][1]->data_1 != null)
                                                    <?php echo join(",",retextdata($datacheck1 , $proRelate['content'][1]->unit_name));?>
                                                    @else
                                                    -
                                                    @endif
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="out-power">
                                                <h6 class="text-title-ft-sub">{{$staticContent['Output_Power']}}</h6>
                                                <p class="text-ft-sub text-one">
                                                    {{-- {{$pro['content'][2]->data_1}}{{$pro['content'][2]->unit_name}}
                                                    --}}
                                                    @if($proRelate['content'][2]->status_input == 3)
                                                    @if($proRelate['content'][2]->data_1 != null &&
                                                    $proRelate['content'][2]->data_2
                                                    != null)
                                                    {{$proRelate['content'][2]->data_1}}-{{$proRelate['content'][2]->data_2}}{{$proRelate['content'][2]->unit_name}}
                                                    @else
                                                    -
                                                    @endif
                                                    @else
                                                    @if($proRelate['content'][2]->data_1 != null)
                                                    <?php echo join(",",retextdata($datacheck2 , $proRelate['content'][2]->unit_name));?>
                                                    @else
                                                    -
                                                    @endif
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="out-current">
                                                <h6 class="text-title-ft-sub">{{$staticContent['Output_Current']}}</h6>
                                                <p class="text-ft-sub text-one">
                                                    @if($proRelate['content'][0]->status_input == 3)
                                                    @if($proRelate['content'][0]->data_1 != null &&
                                                    $proRelate['content'][0]->data_2
                                                    != null)
                                                    {{$proRelate['content'][0]->data_1}}-{{$proRelate['content'][0]->data_2}}{{$proRelate['content'][0]->unit_name}}
                                                    @else
                                                    -
                                                    @endif
                                                    @else
                                                    @if($proRelate['content'][0]->data_1 != null)
                                                    <?php echo join(",",retextdata($datacheck3 , $proRelate['content'][0]->unit_name));?>
                                                    @else
                                                    -
                                                    @endif
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="in-volt h-rvolt">
                                                <h6 class="text-title-ft-sub">{{$staticContent['Input_Voltage']}}</h6>
                                                <p class="text-ft-sub text-one">{!!
                                                    iconv_substr(strip_tags($proRelate['content'][3]->value_text),0,15,'UTF-8')
                                                    !!}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="dimension">
                                        <h6 class="text-title-ft-sub"> {{$staticContent['Dimensions']}}
                                            ({{$proRelate['unit_dimension_1']}} x W x {{$proRelate['unit_dimension']}})
                                        </h6>
                                        @if(isset($proRelate['dimensionL']) && is_numeric($proRelate['dimensionL']) &&
                                        isset($proRelate['dimensionW']) && isset($proRelate['dimensionD']))
                                        <h6 class="text-ft-sub">{{$proRelate['dimensionL']}} x
                                            {{$proRelate['dimensionW']}} x
                                            {{$proRelate['dimensionD']}} mm</h6>
                                        <h6 class="text-ft-sub">
                                            {{number_format($proRelate['dimensionL']* 0.0393701 ,2)}}” x
                                            {{number_format($proRelate['dimensionW']* 0.0393701 ,2)}}” x
                                            {{number_format($proRelate['dimensionD']* 0.0393701 ,2)}}”</h6>
                                        @else
                                        <h6 class="text-ft-sub">{!!
                                            iconv_substr(strip_tags($proRelate['dimensionL']),0,20,'UTF-8') !!}</h6>
                                        @endif
                                        <div class="btn btn-ft mt-2"
                                            onclick="showNavCoparison({{$proRelate['pro_id']}} ,{{$proRelate['cate_id']}})">
                                            {{$staticContent['Add_to_Compare']}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('js')
<script>
    function viewKey(key){
            var newkey = key.replace(/[/]/g,'@');
              event.preventDefault();
              window.location = '{{route('searchByTag')}}/'+newkey;
    }
    function viewOptionalModel(key){
            var newkey = key.replace(/[/]/g,'@');
              event.preventDefault();
              window.location = '{{route('productsDetailsByType' ,['cateid'=> preg_replace('/\s+/', '-', $product[0]['url_item']) ,'pro_code' => setTextpro($product[0]['pro_code']) ])}}?optional_model='+newkey;
    }
</script>
<script>
    $(function () {
     $('[data-toggle="tooltip"]').tooltip()
    })
    function popSection(id){
        $("#select-tech option[value="+id+"]").prop('selected', true);
    }
    function selectproduct(){
       var id =  $('#select-tech').val();
       $('#nav-output-tab'+id).click();

    }
    var offsetTop = $(".box-tech-specs").offset().top;
    $(window).scroll(function() {
        var scrollTop = $(window).scrollTop();
        if(scrollTop >= 600) {
            $(".add-compare-nav").slideDown(500);

        }else{
            $(".add-compare-nav").fadeOut();

        }
        if(scrollTop >= 1500){
            $(".add-compare-nav-mobile").slideDown(500);
        }else{
            $(".add-compare-nav-mobile").fadeOut();
        }
    });


    /* firt image product */
    $('<img src="" alt="" >').appendTo('.product-show-box');
    $('.product-show-box img').attr("src", $('.product-show-list div:first-child a').find('img').attr("src"));
    /* onclick image product */
    function clickYoutube(id) {
        $('.product-show-box iframe').hide();
        $('<iframe width="100%" style="max-height: 500px; min-height: 50%;"  src="" controls=0 allowfullscreen allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin"></iframe>').appendTo('.product-show-box');
        $('.product-show-box iframe').attr("src", id);
        $('.product-show-box img').hide();
    }
    function clickImage(id) {
        $('.product-show-box img').hide();
        $('<img src="" alt="">').appendTo('.product-show-box');
        $('.product-show-box img').attr("src", id);
        $('.product-show-box iframe').hide();
    }
    $(document).ready(function() {
        setTimeout(function() {
           $('#add_delayshow').removeClass('d-none');
      }, 10);

        $('#preview').slick({
            vertical:true,
            verticalSwiping:true,
            slidesToShow: 3,
            slidesToScroll: 1,
            prevArrow:'<i class="zmdi zmdi-chevron-up a-left control-c prev slick-prev" aria-hidden="true"></i>',
            nextArrow:'<i class="zmdi zmdi-chevron-down a-right control-c next slick-next" aria-hidden="true"></i>'
        });
        $('#preview-mobile').slick({
            infinite:false,
            slidesToShow: 3,
            variableWidth: true,
            prevArrow: false,
            nextArrow: false
        });
    });
    $("#producttype").owlCarousel({
            loop: false,
            margin: 24,
            dotsEach: 4,
            nav: false,
            responsive: {
                0: {
                    items: 1

                },
                600: {
                    items: 2
                },
                1000: {
                    items: 3
                },
                1200: {
                    items: 4
                }
            },
            navText: ['<i class="zmdi zmdi-chevron-left" aria-hidden="true"></i>',
                '<i class="zmdi zmdi-chevron-right" aria-hidden="true"></i>',
            ]
        });
</script>

<script>
    @if(Session::has('messageGUI'))
        $(document).ready(function() {
            var file =  '{{Session::get('messageGUI')}}';
            var html = '';
                html += '<a href="{{config('app.url')}}/upload/product_files/'+file +'" target="_blank">';
                html += '{{config('app.url')}}/upload/product_files/'+file+'';
                html += '</a>';
            $('#linkdownloadsuc').html(html);
            $("#downloadgui-modal-success").modal();
        });
    @endif

    @if(Session::has('errorSendMail'))
        $(document).ready(function() {
            $("#downloadgui-modal-failures").modal();
        });
    @endif
</script>
@endsection
