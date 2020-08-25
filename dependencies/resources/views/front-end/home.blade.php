@extends('layouts.front-end')
@section('css')
<style>
    .box-product-selector .container {
        text-align: center;

    }

    /* .visible-mobile .box-product-selector .container{
        padding: 16px;
    } */
    .text-hover {
        /* display: none; */
        opacity: 0;
        line-height: 1;
        color: #5F5F5F;
        font-size: 14px;

    }

    .product-selector-list:hover .text-hover,
    .product-selector-mobile:hover .text-hover {
        opacity: 1;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

  

    .product-selector-list:hover .text-title-dark,
    .product-selector-mobile:hover .text-title-dark {
        color: #0087DC !important;
      
    }

    .product-selector-list:hover,
    .product-selector-mobile:hover {
        border-color: #0087DC;
    }
    .product-selector-list:hover a {
        text-decoration: none;
    }
    .product-selector-list {
        margin-left: auto;
        margin-right: auto;
        height: 220px;
    }

    .product-selector-list img {
        margin-left: auto;
        margin-right: auto;
        margin-bottom: 1rem;
    }

  

    .btn.focus,
    .btn:focus {
        outline: 0;
        box-shadow: unset;
    }

    .ttt {
        transform: scaleX(0);
    }
    #producttype.owl-carousel .owl-stage-outer{
    
    }
    .midle-item{
      margin: 0;
      position: absolute;             
      top: 50%;                       
      transform: translate(0, -50%)
   }
   .in-volt{
    height: 73px;
    overflow: hidden;
   }
   .mr-lr-feture{
       padding-left: 30px;
       padding-right: 30px;
   }
   .posit-btn-mobile{
    position: absolute;
    bottom: 70px;
    transform: translate(-50%, 50%);
   }

</style>
@endsection
@section('meta')
<title>{{isset($metatag[0]->meta_title)? $metatag[0]->meta_title :''}}</title>
<meta name="description" content="{{isset($metatag[0]->meta_description)? $metatag[0]->meta_description :''}}">
<meta name="keywords" content="{{isset($metatag[0]->meta_key) ? $metatag[0]->meta_key :''}}">
@endsection
<?php 
    function setTextpro($pro){
                $strmodel =  str_replace("/", "&", $pro);
                return  $strmodel;
            }

?>
@section('container')
<?php $style = 2; ?>
<!-- banner -->
<div class="show-more-769">
    <div class="box-banner">
        <div id="slide-banner" class="owl-carousel owl-theme">
            @foreach ($banners as $banner)
            <div class="item banner-item">
                <a href="{{$banner->btn_link}}">
                <div class="slide"
                    style="background: url('{{config('app.url')}}/medias/banners/{{$banner->image_destop}}');">
                    <div class="slide-content">
                        @if($banner->title2 != null ||  $banner->content != null)
                        <div class="container">
                            <div class="bg-w-banner">
                                <h1 class="text-title-banner" style="color:{{ $banner->title_color}}">
                                    <?php
                                    $str = $banner->title2;
                                    $st = explode("\n", $str);
                                    for ($k = 0; $k < count($st); $k++) {
                                        echo $st[$k] = '<div>'
                                                . $st[$k]
                                                . '</div>';
                                    }
                                    ?>
                                </h1>
                            <div class="text-p-banner my-2" style="color:{{ $banner->content_color}}">
                                    {!!$banner->content!!}
                                </div>
                                @if($banner->btn_status == 1)
                                <button class="btn btn-subscribe">{{$banner->btn_name}}</button>
                             
                                @endif
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </a>
            </div>
            @endforeach
        </div>
    </div>
</div>
<div class="show-768-only">
    <div class="padding-top-content">
    </div>
    <div class="box-banner">
        <div id="slide-banner-mobile" class="owl-carousel owl-theme ">
            @foreach ($banners as $banner)
            <div class="item banner-item ">
                <a href="{{$banner->btn_link}}">
                <div class="slide" style="background:url('{{config('app.url')}}/medias/banners/{{$banner->image}}');">
                    <div class="slide-content">
                        @if($banner->title2 != null)
                        <div class="container ">
                            <div class="">
                            <h2 class="text-title-banner" style="color:{{ $banner->title_color}}">
                                <?php
                                $str = $banner->title;
                                $st = explode("\n", $str);
                                for ($k = 0; $k < count($st); $k++) {
                                    echo $st[$k] = '<div>'
                                            . $st[$k]
                                            . '</div>';
                                }
                                ?>
                            </h2>
                            @if($banner->btn_status == 1)
                            <button class="btn btn-subscribe mt-3 posit-btn-mobile">{{$banner->btn_name}}</button>
                            @endif
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </a>
            </div>
            @endforeach
        </div>

    </div>
</div>
<!-- selecter -->
<div class="visible-tablets-up">
    <div class="box-product-selector container ">
        <h2 class="text-title-delta-home"> {{$staticContent['Product_Selector']}}</h2>
        <div id="product-selector-carousel" class="owl-carousel owl-theme product-selector text-center">
            @foreach($subCategories as $sub)
            <div class="product-selector-list border-2px d-flex align-items-center">
                <div class="m-auto">
                    <a href="{{ route('producsList',[preg_replace('/\s+/', '_', $sub->name),$sub->sub_pro_id])}}">
                     @if($sub->image != null)
                    <img class="" src="{{config('app.url')}}/medias/categories/{{$sub->image}}" alt="">
                    @else
                    <img class="" src="{{asset('frontend-asset/image/blank.png')}}" alt="">
                    @endif
                    <div style="height: 50px; " class="d-flex">
                        <h4 class="text-title-dark mx-auto fix-text-width-product-selector">{{$sub->name}}</h4>
                    </div>
                    </a>
                    {{-- <div class="text-hover">
                        {!! iconv_substr(strip_tags($sub->content),0,90,'UTF-8') !!}...
                    </div> --}}
                </div>
                
            </div>
            @endforeach
        </div>
        {{--  <div class="row">
            <div class="product-selector d-flex justify-content-between text-center">
                @foreach($subCategories as $sub)
                <div class="product-selector-list border-2px ">
                    @if($sub->image != null)
                    <img class="img-fluid-80" src="{{config('app.url')}}/medias/categories/{{$sub->image}}" alt="">
        @else
        <img class="img-fluid-80" src="{{asset('frontend-asset/image/CliQ VA@2x.png')}}" alt="">
        @endif
        <h4 class="text-title-dark">{{$sub->name}}</h4>
        <div class="text-hover">

            {!! iconv_substr(strip_tags($sub->content),0,90,'UTF-8') !!}...
        </div>
    </div>
    @endforeach --}}
    {{-- <div class="product-selector-list border-2px ">
                    <img class="img-fluid-80" src="{{asset('frontend-asset/image/Lyte@2x.png')}}" alt="">
    <h4 class="text-title-dark">Panel Mount</h4>
    <p class="text-hover">Delta offers many series
        of panel mount power supplies for different needs.</p>
</div>
<div class="product-selector-list border-2px ">
    <img class="img-fluid-80" src="{{asset('frontend-asset/image/Chrome@2x.png')}}" alt="">
    <h4 class="text-title-dark">Open Frame</h4>
    <p class="text-hover">Delta offers many series
        of panel mount power supplies for different needs.</p>
</div>
<div class="product-selector-list border-2px ">
    <img class="img-fluid-80" src="{{asset('frontend-asset/image/Sync@2x.png')}}" alt="">
    <h4 class="text-title-dark">Adapter</h4>
    <p class="text-hover">Delta offers many series
        of panel mount power supplies for different needs.</p>
</div>
<div class="product-selector-list border-2px ">
    <img class="img-fluid-80" src="{{asset('frontend-asset/image/CliQ VA@2x.png')}}" alt="">
    <h4 class="text-title-dark">Configurable Power</h4>
    <p class="text-hover">Duis rhoncus dui venenatis consequat porttitor. Etiam aliquet
        congue consequat. In posuere, nunc sit amet laoreet blan..</p>
</div>
<div class="product-selector-list border-2px ">
    <img class="img-fluid-80" src="{{asset('frontend-asset/image/CliQ VA@2x.png')}}" alt="">
    <h4 class="text-title-dark">LED Driver</h4>
    <p class="text-hover">Duis rhoncus dui venenatis consequat porttitor. Etiam aliquet
        congue consequat. In posuere, nunc sit amet laoreet blan..</p>
</div> --}}
{{-- </div>
        </div> --}}
</div>
</div>
<div class="visible-mobile">
    <div class="box-product-selector padd-left-rbox">
        <h2 class="text-title-delta-home ">{{$staticContent['Product_Selector']}}</h2>
        <div id="product-selector-carousel-mobile" class="owl-carousel owl-theme product-selector text-center">
            @foreach($subCategories as $sub)
            <div class="product-selector-list ">
                <div class="border-2px d-flex h-100 p-1 align-items-center" style="    box-shadow: 0px 4px 5px 2px rgba(0, 0, 0, 0.09);">
                    <div class="m-auto">
                        <a href="{{ route('producsList',[preg_replace('/\s+/', '_', $sub->name),$sub->sub_pro_id])}}">
                        @if($sub->image != null)
                        <img class="" src="{{config('app.url')}}/medias/categories/{{$sub->image}}" alt="">
                        @else
                        <img class="" src="{{asset('frontend-asset/image/blank.png')}}" alt="">
                        @endif
                        <div style="height: 50px; " class="d-flex">
                            <h4 class="text-title-dark mx-auto fix-text-width-product-selector">{{$sub->name}}</h4>
                        </div>
                        </a>
                        {{-- <div class="text-hover">

                            {!! iconv_substr(strip_tags($sub->content),0,90,'UTF-8') !!}...
                        </div> --}}
                    </div>
                </div>
                
                
            </div>
            @endforeach
        </div>
        {{-- <div class="box-product-selector  ">
        <div class="container ">
            <h2 class="text-title-delta-home ">PRODUCT SELECTOR</h2>
            <div class="d-flex justify-content-between mr-b-24px">
                <div class="product-selector-mobile border-2px pad-ar-12px  mr-r-12px">
                    <img class="img-fluid-80" src="{{asset('frontend-asset/image/CliQ VA@2x.png')}}" alt="">
        <h6 class="text-title-dark">DIN Rail</h6>
        <p class="text-hover">Duis rhoncus dui venenatis consequat porttitor. Etiam aliquet
            congue consequat. In posuere, nunc sit amet laoreet blan..</p>
    </div>
    <div class="product-selector-mobile border-2px pad-ar-12px mr-l-12px">
        <img class="img-fluid-80" src="{{asset('frontend-asset/image/Lyte@2x.png')}}" alt="">
        <h6 class="text-title-dark">Panel Mount</h6>
        <p class="text-hover">Delta offers many series
            of panel mount power supplies for different needs.</p>
    </div>
</div>
<div class="d-flex justify-content-between mr-b-24px">
    <div class="product-selector-mobile border-2px pad-ar-12px mr-r-12px">
        <img class="img-fluid-80" src="{{asset('frontend-asset/image/Chrome@2x.png')}}" alt="">
        <h6 class="text-title-dark">Open Frame</h6>
        <p class="text-hover">Delta offers many series
            of panel mount power supplies for different needs.</p>
    </div>
    <div class="product-selector-mobile border-2px pad-ar-12px mr-l-12px">
        <img class="img-fluid-80" src="{{asset('frontend-asset/image/Sync@2x.png')}}" alt="">
        <h6 class="text-title-dark">Adapter</h6>
        <p class="text-hover">Delta offers many series
            of panel mount power supplies for different needs.</p>
    </div>
</div>
<div class="d-flex justify-content-between mr-b-24px">
    <div class="product-selector-mobile border-2px pad-ar-12px mr-r-12px">
        <img class="img-fluid-80" src="{{asset('frontend-asset/image/CliQ VA@2x.png')}}" alt="">
        <h6 class="text-title-dark">Configurable Power</h6>
        <p class="text-hover">Duis rhoncus dui venenatis consequat porttitor. Etiam aliquet
            congue consequat. In posuere, nunc sit amet laoreet blan..</p>
    </div>
    <div class="product-selector-mobile border-2px pad-ar-12px mr-l-12px">
        <img class="img-fluid-80" src="{{asset('frontend-asset/image/CliQ VA@2x.png')}}" alt="">
        <h6 class="text-title-dark">LED Driver</h6>
        <p class="text-hover">Duis rhoncus dui venenatis consequat porttitor. Etiam aliquet
            congue consequat. In posuere, nunc sit amet laoreet blan..</p>
    </div>
</div>



</div>--}}
</div>
</div>
<!-- application -->
<div class="visible-tablets-up">
    <div class="box-applications">
        <div class="container">
            <h2 class="text-title-delta-home ">{{$staticContent['Applications']}}</h2>
            <div class="grid-container">
                @foreach ($applications as $item)
                <a href="{{route('applicationDetail' ,[ 'name' => preg_replace('/\s+/', '-',$item->applica_id.'-'.$item->name)])}}" class="" style="">
                    <div class="grid-item ">
                        <div class="grid-sub-pic"
                            style="background: url('{{config('app.url')}}/medias/categories/{{$item->thumbnail}}');">
                            {{--  <img src="{{config('app.url')}}/medias/categories/{{$item->thumbnail}}" alt=""> --}}
                        </div>
                        <div class="grid-sub-text">
                            <img src="{{config('app.url')}}/medias/categories/{{$item->color_icon}}" alt="">
                            <p class="">{{$item->name}}</p>
                            
                            <ul class="app-detail-bullet">
                                {{-- <li>Escalator & Elvator</li>
                                    <li>CCTV Surveilance</li>
                                    <li>HVAC Control</li> --}}
                                <?php
                                    $str = $item->overview;
                                    $st = explode("\n", $str);
                                        for ($k = 0; $k < count($st); $k++) {
                                        if($k < 3){
                                            echo $st[$k] = '<li>'
                                                . $st[$k]
                                                . '</li>';
                                        }
                                       }
                                    ?>
                            </ul>

                        </div>
                    </div>
                </a>
                @endforeach

            </div>
        </div>
        <div class="text-center mr-24px" id="loadMore-application" style="">
            <a href="#" class="btn btn-boxen">{{$staticContent['See_More']}}</a>
        </div>
    </div>
</div>
<div class="visible-mobile">
    <div class="box-applications-mobile  ">
        <div class="container">
            <h2 class="text-title-delta-home">{{$staticContent['Applications']}}</h2>
            <div class="grid-container">
                @foreach ($applications as $item)
                <a href="{{route('applicationDetail' ,[ 'name' => preg_replace('/\s+/', '-',$item->applica_id.'-'.$item->name)])}}" class="blogBox-mb moreBox-mb" style="display: none;">
                    <div class="grid-item ">
                        <div class="grid-sub-pic"
                            style="background: url('{{config('app.url')}}/medias/categories/{{$item->thumbnail}}');">
                            {{--  <img src="{{config('app.url')}}/medias/categories/{{$item->thumbnail}}" alt=""> --}}
                        </div>
                        <div class="grid-sub-text">
                            <img src="{{config('app.url')}}/medias/categories/{{$item->color_icon}}" alt="">
                            <p class="">{{$item->name}}</p>
                            <ul class="app-detail-bullet">

                                <?php
                                $str = $item->overview;
                                $st = explode("\n", $str);
                                    for ($k = 0; $k < count($st); $k++) {
                                    if($k < 3){
                                        echo $st[$k] = '<li>'
                                            . $st[$k]
                                            . '</li>';
                                    }
                                   }
                                ?>
                            </ul>

                        </div>
                    </div>
                </a>
                @endforeach

            </div>
        </div>
        <div class="text-center mr-24px" id="loadMore-application-mobile" style="">
            <a href="#" class="btn btn-boxen">{{$staticContent['See_More']}}</a>
        </div>
    </div>
</div>
<!-- feature -->
<?php 
function retextdata($arr ,$unit){
                      $arr_data = [];
                   foreach ($arr as $dch){
                      if($dch != null && $dch != '' && $dch != 'null'){
                          array_push($arr_data,$dch.$unit);
                      }
                     
                   }
       return $arr_data;
}

?>
<div class="visible-tablets-up">
    <div class="box-pp">
        <div class="container">
            <div class="text-center">
                <h2 class="text-title-delta-home">{{$staticContent['Featured_Products']}}</h2>
            </div>
            <div id="producttype" class="owl-carousel owl-theme  ft-products-body">
                @foreach ($featePros as $pro)
                <div class="item card">
                    <?php 
                       $color = '';
                       $name_sta = '';
                      $stat = $pro['status_product'];
                        if($stat == 2){
                            $color = '#76B900';
                            $name_sta = 'NEW';
                        }else if($stat == 3){
                            $color = '#337ab7';
                            $name_sta = 'UPDATED';
                        }else if($stat == 4){
                            $color = '#f0ad4e';
                            $name_sta = 'EOL';
                        }
                        ?>
                          <?php 
                          $datacheck1 = [
                           $pro['content'][1]->data_1,
                           $pro['content'][1]->data_2,
                           $pro['content'][1]->data_3,
                           $pro['content'][1]->data_4,
                           $pro['content'][1]->data_5,
                           $pro['content'][1]->data_6,
                           $pro['content'][1]->data_7,
                           $pro['content'][1]->data_8,
                           $pro['content'][1]->data_9,
                           $pro['content'][1]->data_10,
                           $pro['content'][1]->data_11,
                           $pro['content'][1]->data_12,
                                  ];
                   
                           $datacheck2 = [
                            $pro['content'][2]->data_1,
                            $pro['content'][2]->data_2,
                            $pro['content'][2]->data_3,
                            $pro['content'][2]->data_4,
                            $pro['content'][2]->data_5,
                            $pro['content'][2]->data_6,
                            $pro['content'][2]->data_7,
                            $pro['content'][2]->data_8,
                            $pro['content'][2]->data_9,
                            $pro['content'][2]->data_10,
                            $pro['content'][2]->data_11,
                            $pro['content'][2]->data_12,
                                   ];

                           $datacheck3 = [
                            $pro['content'][0]->data_1,
                            $pro['content'][0]->data_2,
                            $pro['content'][0]->data_3,
                            $pro['content'][0]->data_4,
                            $pro['content'][0]->data_5,
                            $pro['content'][0]->data_6,
                            $pro['content'][0]->data_7,
                            $pro['content'][0]->data_8,
                            $pro['content'][0]->data_9,
                            $pro['content'][0]->data_10,
                            $pro['content'][0]->data_11,
                            $pro['content'][0]->data_12,
                                   ];
                                   ?>
                    <div class="new-tag" style="background-color:{{$color}}">{{$name_sta}}</div>
                    <div class="card-body ft-products-item">
                        <a href="{{route('productsDetailsByType' ,['catename'=> preg_replace('/\s+/', '-', $pro['catename']) ,'pro_code' => setTextpro($pro['pro_code']) ])}}">
                        @if(isset($pro['picture']))
                        <img src="{{config('app.url')}}/upload/thumbs/{{$pro['picture']}}" class="product-cat mb-2" alt=""
                            style="width:70%;">
                        @else
                         <img src="{{asset('frontend-asset/image/blank.png')}}" class="product-cat mb-2" alt=""
                        style="width:70%;">
                        @endif
                        <h4 class="text-title-ft">{{$pro['pro_code']}}</h4>
                        </a>
                        <div class="row m-d-t">
                            <div class="col-6">
                                <div class="out-volt">
                                    <h6 class="text-title-ft-sub">{{$staticContent['Output_Voltage']}}</h6>
                                    <p class="text-ft-sub text-one">
                                       
                                        @if($pro['content'][1]->status_input == 3)
                                        @if($pro['content'][1]->data_1 != null && $pro['content'][1]->data_2 != null)
                                        {{$pro['content'][1]->data_1}}-{{$pro['content'][1]->data_2}}{{$pro['content'][1]->unit_name}}      
                                         @else 
                                        -
                                        @endif
                                         @else
                                         @if($pro['content'][1]->data_1 != null)
                                        <?php echo join(",",retextdata($datacheck1 , $pro['content'][1]->unit_name));?>
                                        @else 
                                        -
                                        @endif
                                        @endif
                                    </p>
                                </div>
                                <div class="out-power">
                                    <h6 class="text-title-ft-sub">{{$staticContent['Output_Power']}}</h6>
                                    <p class="text-ft-sub text-one">
                                        {{-- @if($pro['content'][2]->data_1 != null)
                                        {{$pro['content'][2]->data_1}}{{$pro['content'][2]->unit_name}}
                                        @else 
                                        -
                                        @endif --}}
                                        @if($pro['content'][2]->status_input == 3)
                                        @if($pro['content'][2]->data_1 != null && $pro['content'][2]->data_2 != null)
                                             {{$pro['content'][2]->data_1}}-{{$pro['content'][2]->data_2}}{{$pro['content'][2]->unit_name}}      
                                        @else 
                                        -
                                        @endif
                                        @else
                                            @if($pro['content'][2]->data_1 != null)
                                         <?php echo join(",",retextdata($datacheck2 , $pro['content'][2]->unit_name));?>
                                             @else 
                                             -
                                             @endif
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="out-current">
                                    <h6 class="text-title-ft-sub">{{$staticContent['Output_Current']}}</h6>
                                    <p class="text-ft-sub text-one">
                                        {{-- @if($pro['content'][0]->data_1 != null)
                                        {{$pro['content'][0]->data_1}}{{$pro['content'][0]->unit_name}}
                                        @else 
                                        -
                                        @endif --}}

                                        @if($pro['content'][0]->status_input == 3)
                                        @if($pro['content'][0]->data_1 != null && $pro['content'][0]->data_2 != null)
                                             {{$pro['content'][0]->data_1}}-{{$pro['content'][0]->data_2}}{{$pro['content'][0]->unit_name}}      
                                        @else 
                                        -
                                        @endif
                                        @else
                                          @if($pro['content'][0]->data_1 != null)
                                         <?php echo join(",",retextdata($datacheck3 , $pro['content'][0]->unit_name));?>
                                         @else 
                                         -
                                         @endif
                                        @endif
                                    </p>
                                </div>
                                <div class="in-volt">
                                    <h6 class="text-title-ft-sub">{{$staticContent['Input_Voltage']}}</h6>
                                    <p class="text-ft-sub text-one"> {!! iconv_substr(strip_tags($pro['content'][3]->value_text),0,60,'UTF-8') !!}</p>
                                   
                                </div>
                            </div>
                        </div>

                        <div class="dimension">
                            <h6 class="text-title-ft-sub">{{$staticContent['Dimensions']}} (L x W x {{$pro['unit_dimension']}}) </h6>
                            @if(isset($pro['dimensionD']))
                            <p class="text-ft-sub text-one">{{$pro['dimensionL']}} x {{$pro['dimensionW']}} x
                                {{$pro['dimensionD']}} mm</p>
                            <p class="text-ft-sub text-one">
                                {{number_format($pro['dimensionL']* 0.0393701 ,2)}}” x
                                {{number_format($pro['dimensionW']* 0.0393701 ,2)}}” x
                                {{number_format($pro['dimensionD']* 0.0393701 ,2)}}”</p>
                            @else
                            <p class="text-ft-sub text-one">{{$pro['dimensionL']}}</p>
                            @endif
                            <div  class="btn btn-ft mt-2" onclick="showNavCoparison({{$pro['pro_id']}} ,{{$pro['cateid']}})">+ {{$staticContent['Add_to_Compare']}}</div>
                        </div>
                        
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<div class="visible-mobile">
    <div class="box-pp  ">
        <div class="container mr-lr-feture">
            <div class="text-center">
                <h2 class="text-title-delta-home ">{{$staticContent['Featured_Products']}}</h2>
            </div>
            <div id="producttype-mobile" class="owl-carousel owl-theme  ft-products-body">

                @foreach ($featePros as $pro)
                <div class="item card">
                    <?php 
                    $color = '';
                    $name_sta = '';
                   $stat = $pro['status_product'];
                     if($stat == 2){
                         $color = '#76B900';
                         $name_sta = 'NEW';
                     }else if($stat == 3){
                         $color = '#337ab7';
                         $name_sta = 'UPDATED';
                     }else if($stat == 4){
                         $color = '#f0ad4e';
                         $name_sta = 'EOL';
                     }
                     ?>
                 <div class="new-tag" style="background-color:{{$color}}">{{$name_sta}}</div>
                    <div class="card-body ft-products-item">
                        <a href="{{route('productsDetailsByType' ,['catename'=> preg_replace('/\s+/', '-', $pro['catename']) ,'pro_code' => setTextpro($pro['pro_code']) ])}}">
                            @if(isset($pro['picture']))
                            <img src="{{config('app.url')}}/upload/thumbs/{{$pro['picture']}}" class="product-cat mb-2" alt=""
                                style="width:70%;">
                            @else
                             <img src="{{asset('frontend-asset/image/blank.png')}}" class="product-cat mb-2" alt=""
                            style="width:70%;">
                            @endif
                        <h6 class="text-title-ft">{{$pro['pro_code']}}</h6>
                        </a>
                        <div class="flex-row">
                            <div class="out-volt mt-1">
                                <p class="text-title-ft-sub text-two">{{$staticContent['Output_Voltage']}}</p>
                                <p class="text-ft-sub text-two">
                                    @if($pro['content'][1]->data_1 != null)
                                    {{$pro['content'][1]->data_1}}{{$pro['content'][1]->unit_name}} 
                                    @else 
                                    -
                                    @endif
                                </p>
                            </div>
                            <div class="out-power mt-2">
                                <p class="text-title-ft-sub text-two">{{$staticContent['Output_Power']}}</p>
                                <p class="text-ft-sub text-two">
                                    @if($pro['content'][2]->data_1 != null)
                                    {{$pro['content'][2]->data_1}}{{$pro['content'][2]->unit_name}}
                                    @else 
                                    -
                                    @endif
                                </p>
                            </div>

                            <div class="out-current mt-2">
                                <p class="text-title-ft-sub text-two">{{$staticContent['Output_Current']}}</p>
                                <p class="text-ft-sub text-two">
                                    @if($pro['content'][0]->data_1 != null)
                                    {{$pro['content'][0]->data_1}}{{$pro['content'][0]->unit_name}}
                                    @else 
                                    -
                                    @endif
                                </p>
                            </div>
                            <div class="in-volt mt-2">
                                <p class="text-title-ft-sub text-two">{{$staticContent['Input_Voltage']}}</p>
                                <p class="text-ft-sub text-one"> {!! iconv_substr(strip_tags($pro['content'][3]->value_text),0,60,'UTF-8') !!} ...</p>
                            </div>
                            <div class="dimension mt-2">
                                <p class="text-title-ft-sub text-two">{{$staticContent['Dimensions']}}  (L x W x {{$pro['unit_dimension']}})  </p>
                                @if(isset($pro['dimensionD']))
                                <p class="text-ft-sub text-two">{{$pro['dimensionL']}} x {{$pro['dimensionW']}} x
                                    {{$pro['dimensionD']}} mm</p>
                                <p class="text-ft-sub text-two">
                                    {{number_format($pro['dimensionL']* 0.0393701 ,2)}}” x
                                    {{number_format($pro['dimensionW']* 0.0393701 ,2)}}” x
                                    {{number_format($pro['dimensionD']* 0.0393701 ,2)}}”</p>
                                @else
                                <p class="text-ft-sub text-two">{!! iconv_substr(strip_tags($pro['dimensionL']),0,60,'UTF-8') !!} ...</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div  class="btn btn-ft " onclick="showNavCoparison({{$pro['pro_id']}} ,{{$pro['cateid']}})">+ {{$staticContent['Add_to_Compare']}}</div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- event -->
<div class="visible-desk-up">
    <div class="box-events  ">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <h2 class="text-title-delta-home">{{$staticContent['Upcoming_Event']}}</h2>
                    @if(isset($events[0]))
                    <div class="card">
                        <a href="{{route('updateEventDetail',$events[0]->slug)}}">
                        <div class="post-image">
                            <img src="{{config('app.url')}}/uploads_delta/{{$events[0]->thumb}}" alt=""
                                class="img-responsive">
                        </div>
                        </a>
                        <div class="news-content w-100">
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
                               
                                     $date = getDateformat($events[0]->date_publish);
                                     $endDate = getDateformat($events[0]->date_end);
                                ?>

                            <div class="post-meta">
                                <span class="author text-uppercase">
                                        <i class="zmdi zmdi-calendar-alt"></i>
                                        {{ $date['m'].' '.$date['d'] .''.(isset($endDate['d'])?' - '.$endDate['d']:'').' '.$date['y']}}
                                </span>
                                <span class="locations">
                                    &nbsp; <i class="zmdi zmdi-pin"></i> {{$events[0]->location}}
                                </span>
                            </div>
                         
                            <h4 class="post-header title-new">
                                <a href="{{route('updateEventDetail',$events[0]->slug)}}">
                                {{$events[0]->title}}
                               </a>
                            </h4>
                          
                            <p>
                                {!! iconv_substr(strip_tags($events[0]->content),0,90,'UTF-8') !!} ...
                            </p>
                        </div>
                        <a href="{{route('updateEventDetail',$events[0]->slug)}}" class="read-more">{{$staticContent['Read_More']}}</a>
                    </div>
                    @endif
                    <div class="box-btn-boxen">
                        <a class="btn btn-boxen" href="{{route('index','events')}}">{{$staticContent['See_All']}}</a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <h2 class="text-title-delta-home">{{$staticContent['Latest_News']}}</h2>
                    @if(isset($news[0]))
                    <div class="card">
                        <a href="{{route('updateNewsDetail',$news[0]->slug)}}">
                        <div class="post-image">
                            <img src="{{config('app.url')}}/uploads_delta/{{$news[0]->thumb}}" alt=""
                                class="img-responsive">
                        </div>
                        </a>
                        <div class="news-content w-100">
                            <?php
                                 $datenew = [];
                                if(isset($news[0]->date_info)){
                                    $datenew = getDateformat($news[0]->date_info);
                                }
                              
                                ?>
                            <div class="post-meta">
                                <a href="{{route('updateNewsDetail',['name'=> $news[0]->slug])}}" >
                                    <span class="sub-news" style="color:{{$news[0]->color_type}}">
                                            {{$news[0]->cateName}}
                                    </span>
                                    </a>
                                    <img class="line-symbol"src="{{asset('/frontend-asset/image/line-symbol.svg')}}" alt="">
                                <span class="author text-uppercase">
                                        <i class="zmdi zmdi-calendar-alt"></i>
                                        @if(isset($datenew) && count($datenew) > 0)
                                            {{ $datenew['m'].' '.$datenew['d'] .' '.$datenew['y']}}
                                        @endif
                                      
                                   
                                </span>
                                @if(isset($news[0]->location))
                                <span class="locations">
                                    &nbsp;    <i class="zmdi zmdi-pin"></i> {{$news[0]->location}}
                                </span>
                                @endif
                            </div>
                            <h4 class="post-header title-new">
                                <a href="{{route('updateNewsDetail',$news[0]->slug)}}">
                                {{$news[0]->title}}
                                </a>
                            </h4>
                            <p> {!! iconv_substr(strip_tags($news[0]->content),0,90,'UTF-8') !!} ...
                            </p>
                        </div>
                        <a href="{{route('updateNewsDetail',$news[0]->slug)}}" class="read-more">{{$staticContent['Read_More']}}</a>
                    </div>
                    @endif
                    <div class="box-btn-boxen">
                        <a class="btn btn-boxen" href="{{route('index','news')}}">{{$staticContent['See_All']}}</a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <h2 class="text-title-delta-home">{{$staticContent['FAQs']}}</h2>
                    {{-- @if(isset($teachni[0]))
                    <div class="card">
                        <a href="{{route('updateTechnicalDetail',$teachni[0]->slug)}}" >
                        <div class="post-image">
                            @if(isset($teachni[0]->thumb))
                            <img src="{{config('app.url')}}/uploads_delta/{{$teachni[0]->thumb}}" alt=""
                                class="img-responsive">
                             @else 
                             <img src="{{config('app.url')}}/frontend-asset/image/upcoming-img.png" alt=""
                             class="img-responsive">
                             @endif
                        </div>
                        </a>
                        <div class="news-content w-100">
                            <div class="post-meta">
                                @if(isset($teachni[0]->date_info))
                              
                                <span class="author text-uppercase">
                                        <i class="zmdi zmdi-calendar-alt"></i>
                                        {{$teachnidate['m'].' '.$teachnidate['d'].' '.$teachnidate['y']}}
                                </span>
                                @endif
                                @if(isset($teachni[0]->location))
                                <span class="locations">
                                        <i class="zmdi zmdi-pin"></i>{{$teachni[0]->location}}
                                </span>
                                @endif
                            </div>
                            <h4 class="post-header title-new">
                                <a href="{{route('updateTechnicalDetail',$teachni[0]->slug)}}" >
                                {{$teachni[0]->title}}
                                </a>
                            </h4>
                            <p> {!! iconv_substr(strip_tags($teachni[0]->content),0,90,'UTF-8') !!} ...
                            </p>

                        </div>
                        <a href="{{route('updateTechnicalDetail',$teachni[0]->slug)}}" class="read-more">{{$staticContent['Read_More']}}</a>
                    </div>
                    @endif --}}
                    <div class="card">
                    <a href="{{route('index','faqs')}}" >
                        <div class="post-image w-100" >
                       
                        <img src="{{config('app.url')}}/medias/static_content/{{$faqbanner->destop_image}}" alt=""
                             class="img-responsive">
                        </div>
                        </a>
                        <div class="news-content w-100">
                            <div class="post-meta">
                               
                               
                            </div>
                            <a href="{{route('index','faqs')}}" >
                            <h4 class="post-header title-new">
                                 FAQs
                            </h4>
                            </a>
                            <p>  
                            </p>

                        </div>
                        <a href="{{route('index','faqs')}}" class="read-more">{{$staticContent['Read_More']}}</a>
                    </div>
                    <div class="box-btn-boxen">
                        <a class="btn btn-boxen" href="{{route('index','faqs')}}">{{$staticContent['See_All']}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="visible-nav-minimize">
    <div class="box-events  ">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-md-6">
                    <h2 class="text-title-delta-home">{{$staticContent['Upcoming_Event']}}</h2>
                    @if(isset($events[0]))
                    <div class="card">
                        <a href="{{route('updateEventDetail',$events[0]->slug)}}">
                        <div class="post-image">
                            @if(isset($events[0]->thumb))
                            <img src="{{config('app.url')}}/uploads_delta/{{$events[0]->thumb}}" alt=""
                                class="img-responsive">
                             @else 
                             <img src="{{config('app.url')}}/frontend-asset/image/upcoming-img.png" alt=""
                             class="img-responsive">
                            @endif
                        </div>
                        </a>
                        <div class="news-content w-100">
                            <?php
                            $date = getDateformat($events[0]->date_publish);
                            $endDate = getDateformat($events[0]->date_end);
                             ?> 
                          
                            <div class="post-meta">
                                <span class="author text-uppercase">
                                        <i class="zmdi zmdi-calendar-alt"></i>    {{ $date['m'].' '.$date['d'] .''.(isset($endDate['d'])?' - '.$endDate['d']:'').' '.$date['y']}}
                                </span>
                           
                                @if(isset($events[0]->location))
                                <span class="locations">
                                        <i class="zmdi zmdi-pin"></i> {{$events[0]->location}}
                                </span>
                                @endif
                            </div>
                            <h4 class="post-header title-new">
                                <a href="{{route('updateEventDetail',$events[0]->slug)}}">
                                {{$events[0]->title}}
                                </a>
                            </h4>
                            {{-- <p> {!! iconv_substr(strip_tags($events[0]->content),0,90,'UTF-8') !!} ...
                            </p> --}}

                        </div>
                        <a href="{{route('updateEventDetail',$events[0]->slug)}}" class="read-more">{{$staticContent['Read_More']}}</a>
                    </div>
                    @endif
                    <div class="box-btn-boxen">
                        <a class="btn btn-boxen" href="{{route('index','events')}}">{{$staticContent['See_All']}}</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <h2 class="text-title-delta-home">{{$staticContent['Latest_News']}}</h2>
                    @if(isset($news[0]))
                    <div class="card">
                        <a href="{{route('updateNewsDetail',$news[0]->slug)}}">
                        <div class="post-image">
                            @if(isset($news[0]->thumb))
                            <img src="{{config('app.url')}}/uploads_delta/{{$news[0]->thumb}}" alt=""
                                class="img-responsive">
                            @else 
                            <img src="{{config('app.url')}}/frontend-asset/image/upcoming-img.png" alt=""
                            class="img-responsive">
                            @endif
                        </div>
                        </a>
                        <div class="news-content w-100">
                            <div class="post-meta">
                                <a href="{{route('updateNewsDetail',['name'=> $news[0]->slug])}}" >
                                    <span class="sub-news" style="color:{{$news[0]->color_type}}">
                                            {{$news[0]->cateName}}
                                    </span>
                                    </a>
                                    <img class="line-symbol"src="{{asset('/frontend-asset/image/line-symbol.svg')}}" alt="">
                                <span class="author text-uppercase">
                                        <i class="zmdi zmdi-calendar-alt"></i> 
                                        @if(count($datenew) > 0)
                                         {{ $datenew['m'].' '.$datenew['d'] .' '.$datenew['y']}}
                                         @endif
                                </span>
                                @if(isset($news[0]->location))
                                <span class="locations">
                                        <i class="zmdi zmdi-pin"></i>{{$news[0]->location}}
                                </span>
                                @endif
                            </div>
                           
                            <h4 class="post-header title-new">
                                <a href="{{route('updateNewsDetail',$news[0]->slug)}}">
                                {{$news[0]->title}}
                                </a>
                            </h4>
                            {{-- <p> {!! iconv_substr(strip_tags($news[0]->content),0,90,'UTF-8') !!} ...
                            </p> --}}

                        </div>
                        <a href="{{route('updateNewsDetail',$news[0]->slug)}}" class="read-more">{{$staticContent['Read_More']}}</a>
                    </div>
                    @endif
                    <div class="box-btn-boxen">
                        <a class="btn btn-boxen" href="{{route('index','news')}}">{{$staticContent['See_All']}}</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <h2 class="text-title-delta-home">{{$staticContent['FAQs']}}</h2>
                    <div class="card">
                        <a href="{{route('index','faqs')}}" >
                            <div class="post-image w-100" >
                                <img src="{{config('app.url')}}/medias/static_content/{{$faqbanner->destop_image}}" alt=""
                                class="img-responsive">
                                 {{-- <img src="{{config('app.url')}}/frontend-asset/image/faqs.jpg" alt=""
                                 class="img-responsive"> --}}
                            </div>
                            </a>
                            <div class="news-content w-100">
                                <div class="post-meta">
                                   
                                   
                                </div>
                                <a href="{{route('index','faqs')}}" >
                                <h4 class="post-header title-new">
                                     FAQs
                                </h4>
                                </a>
                                <p>  
                                </p>
    
                            </div>
                            <a href="{{route('index','faqs')}}" class="read-more">{{$staticContent['Read_More']}}</a>
                        </div>
                        <div class="box-btn-boxen">
                            <a class="btn btn-boxen" href="{{route('index','faqs')}}">{{$staticContent['See_All']}}</a>
                        </div>
                    </div>
                   
            </div>
            {{-- <h2 class="text-title-delta-home">{{$staticContent['Latest_Article']}}</h2>
            <div class="row">
                @foreach ($teachni as $tech)
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <a href="{{route('updateTechnicalDetail',$tech->slug)}}">
                        <div class="post-image">
                                @if(isset($tech->thumb))
                                <img src="{{config('app.url')}}/uploads_delta/{{$tech->thumb}}" alt=""
                                    class="img-responsive">
                                 @else 
                                 <img src="{{config('app.url')}}/frontend-asset/image/upcoming-img.png" alt=""
                                 class="img-responsive">
                                 @endif
                        </div>
                        </a>
                        <div class="news-content w-100">
                            <div class="post-meta">
                                @if(isset($tech->date_info))
                              
                                <span class="author text-uppercase">
                                        <i class="zmdi zmdi-calendar-alt"></i>
                                        {{$teachdate['m'].' '.$teachdate['d'].' '.$teachdate['y']}}
                                </span>
                                @endif
                                @if(isset($tech->location))
                                <span class="locations">
                                        <i class="zmdi zmdi-pin"></i>{{$tech->location}}
                                </span>
                                @endif
                            </div>
                            <h4 class="post-header title-new">
                                <a href="{{route('updateTechnicalDetail',$tech->slug)}}">
                                {{$tech->title}}
                                </a>
                            </h4>
                            <p> {!! iconv_substr(strip_tags($tech->content),0,90,'UTF-8') !!} ...
                            </p>

                        </div>
                        <a href="{{route('updateTechnicalDetail',$tech->slug)}}" class="read-more">{{$staticContent['Read_More']}}</a>
                    </div>
                </div>
                @endforeach
               
            </div>
            <div class="box-btn-boxen text-center">
                <a class="btn btn-boxen" href="{{route('index','technical-articles')}}">{{$staticContent['See_All']}}</a>
            </div> --}}
        </div>

    </div>

</div>
<!-- box-product-document -->
<div class="visible-desk-up">
    <div class="box-product-document">
        <div class="container">
            <div class="box-product-document-all midle-item">
                <h3 class="text-title-banner">{{$static_content->title}}</h3>
                <div class="text-be-first">
                    {!! $static_content->content !!}
                </div>
                <a href="{{route('index','product-documents')}}" >
                <button class="btn btn-subscribe" href="">{{$staticContent['Learn_More']}}</button>
                </a>
            </div>

            <img class="image-doc" src="{{config('app.url')}}/medias/static_content/{{$static_content->destop_image}}"
                alt="">
        </div>
    </div>
</div>
<div class="visible-nav-minimize">
    <div class="box-product-document-mobile"
        style=" background: url('{{asset('frontend-asset/image/Docdownload-BG.jpg')}}');">
        <img class="image-doc" src="{{config('app.url')}}/medias/static_content/{{$static_content->destop_image}}"
            alt="">
        <div class="container">
            <div class="box-product-document-all">
                <h2 class="text-title-banner">{{$static_content->title}}</h2>
                <div class="text-be-first">
                    {!! $static_content->content !!}
                </div>
                <a href="{{route('index','product-documents')}}" >
                <button class="btn btn-subscribe" href="">{{$staticContent['Learn_More']}}</button>
                </a>
            </div>
        </div>
    </div>
</div>


@endsection
@section('js')

<script>
    $(document).ready(function () {
        $('#nav-two').removeClass('scrolled');
        
    });

    function seeMore() {

        if ($(".blogBox-mb:hidden").length === 8) {
            $("#loadMore-application-mobile").hide();
        } else if ($(".blogBox-mb:hidden").length != 0) {
            $("#loadMore-application-mobile").show();
        }
        if ($(".blogBox:hidden").length === 8) {
            $("#loadMore-application").hide();
        } else if ($(".blogBox:hidden").length != 0) {
            $("#loadMore-application").show();
        }
        $("#loadMore-application").on('click', function (e) {
            e.preventDefault();
            $(".moreBox:hidden").slice(0, 2).slideDown();
            if ($(".moreBox:hidden").length == 0) {
                $("#loadMore-application").fadeOut('slow');
            }
        });
        $("#loadMore-application-mobile").on('click', function (e) {
            e.preventDefault();
            $(".moreBox-mb:hidden").slice(0, 2).slideDown();
            if ($(".moreBox-mb:hidden").length == 0) {
                $("#loadMore-application-mobile").fadeOut('slow');
            }
        });
    }

    function showBtnSeeMore(w) {
        if (w <= 1205) {
            $('#loadMore-application').show();
            $(".moreBox").slice(0, 4).show();
            $(".moreBox").slice(4, 9).hide();
            $(".moreBox-mb").slice(0, 4).show();
            $(".moreBox-mb").slice(4, 9).hide();
            seeMore();
        } else {
            $('#loadMore-application').hide();
            $(".moreBox").slice(0, 9).show();
            seeMore();
        }
    }
    $('#loadMore-application').hide();
    $('#loadMore-application-mobile').hide();
    $(document).ready(function () {
        var w = $(window).width();
        showBtnSeeMore(w);
    });
    $(window).resize(function () {
        var w = $(window).width(); // New width
        console.log(w)
        showBtnSeeMore(w);

    });

</script>
<script>
    $.fn.moveIt = function () {
        var $window = $(window);
        var instances = [];

        $(this).each(function () {
            instances.push(new moveItItem($(this)));
        });

        window.onscroll = function () {
            var scrollTop = $window.scrollTop();
            instances.forEach(function (inst) {
                inst.update(scrollTop);
            });

        }
    }

    var moveItItem = function (el) {
        this.el = $(el);
        this.speed = parseInt(this.el.attr('data-scroll-speed'));
    };

    moveItItem.prototype.update = function (scrollTop) {
        var pos = scrollTop / this.speed;
        this.el.css('transform', 'translateY(' + -pos + 'px)');
    };

    $(function () {
        $('[data-scroll-speed]').moveIt();
    });

</script>
<script>
    $(document).ready(function () {
        $("#producttype").owlCarousel({
            loop: false,
            margin: 24,
            dotsEach: 3,
            nav: true,
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

        $("#producttype-mobile").owlCarousel({
            loop: false,
            margin: 1,
            dotsEach: 3,
            /* autoWidth:true, */
            nav: true,
            responsive: {
                0: {
                    items: 1

                },
                500:{
                    items: 2
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
        $("#slide-banner").owlCarousel({
            loop: true,
            navigation: true,
            slideSpeed: 500,
            paginationSpeed: 500,
            singleItem: true,
            items: 1,
            autoplay:true,
            autoplaySpeed: 2000,
            autoplayHoverPause:true
        });

        $("#slide-banner-mobile").owlCarousel({
            loop: true,
            navigation: true,
            slideSpeed: 300,
            paginationSpeed: 400,
            singleItem: true,
            items: 1,
            autoplay:true,
            autoplaySpeed: 2000,
            autoplayHoverPause:true

        });
        $("#product-selector-carousel").owlCarousel({
            loop: true,
            margin: 10,
            dotsEach: 3,
            nav: true,
            responsive: {
                0: {
                    items: 2

                },
                600: {
                    items: 3
                },
                992: {
                    items: 4
                },
                1200: {
                    items: 6
                },
                1400: {
                    items: 6
                }
            },
            navText: ['<i class="zmdi zmdi-chevron-left" aria-hidden="true"></i>',
                '<i class="zmdi zmdi-chevron-right" aria-hidden="true"></i>',
            ]
        });
        $("#product-selector-carousel-mobile").owlCarousel({
            loop: true,
            margin: 10,
            dotsEach: 3,
            nav: true,
            responsive: {
                0: {
                    items: 1

                },
                375: {
                    items: 2

                },
                700: {
                    items: 3
                }
            },
            navText: ['<i class="zmdi zmdi-chevron-left" aria-hidden="true"></i>',
                '<i class="zmdi zmdi-chevron-right" aria-hidden="true"></i>',
            ]
        });

    });
    /* navbar */
    /* var w = document.documentElement.clientWidth;
    var h = document.documentElement.clientHeight;
    var scrollTopBtn = document.getElementById("scrollTop");
    var textscrollTopBtn = document.getElementById("text-scrollTop"); */
   /*  $(window).scroll(function () {
        $('#nav-two').toggleClass('scrolled', $(this).scrollTop() > 50);

        $('#bar-search-results-nav').removeClass('scrolled');
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            scrollTopBtn.style.display = "block";
            textscrollTopBtn.style.display = "block";
        } else {
            scrollTopBtn.style.display = "none";
            textscrollTopBtn.style.display = "none";
        }

    }); */

</script>

@endsection
