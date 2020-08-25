@extends('layouts.front-end')
@section('css')
<style>

</style>
@endsection
@section('container')
<div class="visible-up-922">
    <div class="padding-top-content ">
    </div>
    <div class="products-index-banner">
        <div class="products-index-nav">
            <div class="bg-bredcrumb">
                <div class="container">
                    <nav aria-label="breadcrumb" id="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item text-breadcrumb-home"><a href="{{route('index','home')}}">HOME</a>
                            </li>
                            <li class="breadcrumb-item active text-breadcrumb" aria-current="page"><a
                                    href="{{route('index','product/index')}}">PRODUCTS</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="nav-desktop-allproduct">
             <div class="nav-allproduct-desk d-flex justify-content-between " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="my-auto ">
                   <h6>PRODUCTS</h6> 
                </div>
                <a href="#"class="my-auto text-bold" id="btn-allproduct-desk">
               <h6>ALL PRODUCTS <i class="zmdi zmdi-chevron-down"></i> </h6> 
                </a>   
            </div> 
            <div class="nav-allproduct-list-desk pt-2"  id="nav-allproduct-list-desk">
                <div class="row my-5">
                    @foreach ($mainCategories as $mainCate)
                    <div class="col-4">
                    <h5 class="text-dark pb-2">{{$mainCate->name}}</h5>
                    @foreach ($subCategories as $subCate)
                        @if($subCate->main_cateid == $mainCate->main_id)
                        <a href=""><p class="text-dark-gray text-one pb-2">{{$subCate->name}}</p></a>
                        @endif
                    @endforeach
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div id="slide-banner-products" class="owl-carousel owl-theme">
            @foreach($last_products as $pro)
            @if($pro->status == 1)
            <div class="banner-type-product-all item"
                style="background-image: url('{{asset('frontend-asset/image/Featured-Product-BG@2x.png')}}');">
                {{-- style="background-color: #818181;background-image: url('');" --}}
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="box-banner-pro-type-all">
                                <div class="text-middle">
                                <h1 class="text-title-banner">{{$pro->pro_code}}</h1>
                                <div class="text-p-banner">
                                    <?php
                                    $str = $pro->description;
                                    $st = explode("\n", $str);
                                    for ($k = 0; $k < count($st); $k++) {
                                        echo $st[$k] = '<div>'
                                                . $st[$k]
                                                . '</div>';
                                    }
                                    ?>
                                </div>
                                    <div class="link-see-product">SEE PRODUCTS <i class="zmdi zmdi-chevron-right"
                                            aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 banner-products-pic">
                            <img src="{{config('app.url')}}/upload/thumbs/{{$pro->picture}}" alt="">
                        </div>
                    </div>
                </div>
            </div>
            @else 
            <div class="banner-type-product-all item"
            style="background-color:{{$pro->bg_color}};">
            {{-- style="background-color: #818181;background-image: url('');" --}}
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="box-banner-pro-type-all">
                            <div class="text-middle">
                            <h1 class="text-title-banner" style="color:{{$pro->title_color}}"> 
                                <?php
                                $str = $pro->title;
                                $st = explode("\n", $str);
                                for ($k = 0; $k < count($st); $k++) {
                                    echo $st[$k] = '<div>'
                                            . $st[$k]
                                            . '</div>';
                                }
                                ?>
                            </h1>
                                <div class="text-p-banner" style="color:{{$pro->text_color}}">
                                    <?php
                                    $str = $pro->description;
                                    $st = explode("\n", $str);
                                    for ($k = 0; $k < count($st); $k++) {
                                        echo $st[$k] = '<div>'
                                                . $st[$k]
                                                . '</div>';
                                    }
                                    ?>
                                </div>
                                <div class="link-see-product" style="color:{{$pro->title_color}}">SEE MORE <i class="zmdi zmdi-chevron-right"
                                        aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 banner-products-pic">
                        <img src="{{config('app.url')}}/medias/categories/{{$pro->image}}" alt="">
                    </div>
                </div>
            </div>
           </div>
            @endif
            @endforeach   
    </div>
    <div class="box-allproduct-content">
        {{-- product type show all --}}
        <div class="bar-product-type py-5">
            <div class="container">
                <nav id="bar-product-type-nav">
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        @foreach ($mainCategories as $mainCate)
                    <a class="nav-item nav-link {{($loop->iteration == 1)?"active":""}}" id="maincate{{$mainCate->main_id}}" data-toggle="tab"
                            href="#tab_mainCate{{$mainCate->main_id}}" role="tab" aria-controls="tab_mainCate{{$mainCate->main_id}}s"
                           aria-selected="true">{{$mainCate->name}}</a>
                        @endforeach
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    @foreach ($mainCategories as $mainCate)
                    <div class="tab-pane fade {{($loop->iteration == 1)?"show active":""}} bar-product-type-list text-center" id="tab_mainCate{{$mainCate->main_id}}"
                        role="tabpanel" aria-labelledby="nav-industrial-power-supplies-tab" >
                        @foreach ($subCategories as $subCate)
                        @if($subCate->main_cateid == $mainCate->main_id)
                            <div class="bar-product-type-list-item">
                                <a href="#din-rail-power-supply" class="deltaItem" tabindex="0" style="text-decoration:none">
                                    <div class="carousel__item-thumb">
                                        @if(isset($subCate->image))
                                        <img src="{{config('app.url')}}/medias/categories/{{$subCate->image}}"
                                            class="product-cat" alt="">
                                        @else
                                        <img src="{{asset('frontend-asset/image/blank.png')}}"
                                        class="product-cat" alt="">
                                        @endif
                                    </div>
                                    <div class="carousel__item-name">{{$subCate->name}}</div>
                                </a>
                            </div>
                        @endif
                        @endforeach
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
        {{-- delta industrial power supplies --}}
        @foreach ($mainCategories as $mainCate)
        <div class="product-type-boxitem" id="delta-industrial-power-supplies">
            <div class="container">
            <h1 class="text-title-delta">{{$mainCate->name}}</h1>
                @foreach ($subCategories as $subCate)
                @if($subCate->main_cateid == $mainCate->main_id)
                <div class="product-type-boxitem-sub" id="din-rail-power-supply">
                    <div class="product-type-boxitem-sub-banner"
                        style=" background-image: url('{{asset('frontend-asset/image/Categories@2x.png')}}');">
                        <div class="row">
                            <div class="col-lg-6 product-type-boxitem-sub-banner-text">
                            <h2 class="text-dark">{{$subCate->name}}</h2>
                                <div class="text-detail">{!!$subCate->content!!}</div>
                                    @if(isset($subCate->file))
                                    <a href="{{config('app.url')}}/medias/categories/{{$subCate->file}}" download=""><img src="{{asset('frontend-asset/image/downlode.svg')}}" alt=""> Download selection
                                        guide</a>
                                    @else 
                                    <a href="#" ><img src="{{asset('frontend-asset/image/downlode.svg')}}" alt=""> Empty selection
                                        guide</a>
                                    @endif
                            </div>
                            <div class="col-lg-6 product-type-boxitem-sub-banner-pic">
                                @if(isset($subCate->image))
                                <img  class="img-fluid" style="width:50%"  src="{{config('app.url')}}/medias/categories/{{$subCate[0]->image}}" alt="">
                                @else
                                <img  class="img-fluid" style="width:50%"  src="{{asset('frontend-asset/image/blank.png')}}" alt="">
                                @endif
                            </div>
                        </div>

                    </div>
                    <div class="product-type-boxitem-sub-list">
                        @foreach ($series as $serie)
                        @if($serie->pro_categories_id == $subCate->sub_pro_id)
                        <div class="product-type-boxitem-sub-list-item text-center">
                            <div class="product-type-boxitem-sub-list-item-pic">
                                @if(isset($subCate->image))
                                <img style="max-width:60%" src="{{config('app.url')}}/medias/categories/{{$subCate->image}}" alt="">
                                @else
                                <img style="max-width:60%" src="{{asset('frontend-asset/image/blank.png')}}" alt="">
                                @endif
                            </div>
                            <div class="product-type-boxitem-sub-list-item-text">
                            <h3 class="text-dark">{{$serie->title}}</h3>
                                <div class="text-hoverthis">
                                    <div id="text-hover">{!! iconv_substr(strip_tags($serie->overview_content),0,300,'UTF-8') !!} ...</div>
                                </div>

                            </div>
                            <div class="product-type-boxitem-sub-list-item-icon ">
                                <div class="icon-app-line1">
                                    <a href="" data-toggle="tooltip" data-placement="top" title="BUILDING AUTOMATION"
                                        class="icon btn-icon-app"  style="--icon-app-var: url('{{asset('frontend-asset/image/icon-application/building-btn-icon.svg')}}'); --icon-appb-var:url('{{asset('frontend-asset/image/icon-application/blue/building-btn-icon.svg')}}'); "></a>
                                    <a href="" data-toggle="tooltip" data-placement="top" title="MACHINE AUTOMATION"
                                        class="icon btn-icon-app" style="--icon-app-var: url('{{asset('frontend-asset/image/icon-application/machine-btn-icon.svg')}}'); --icon-appb-var:url('{{asset('frontend-asset/image/icon-application/blue/machine-btn-icon.svg')}}'); "></a>
                                    <a href="" data-toggle="tooltip" data-placement="top" title="RENEWABLE ENERGY"
                                        class="icon btn-icon-app" style="--icon-app-var: url('{{asset('frontend-asset/image/icon-application/renewable-btn-icon.svg')}}'); --icon-appb-var:url('{{asset('frontend-asset/image/icon-application/blue/renewable-btn-icon.svg')}}'); "></a>
                                    <a href="" data-toggle="tooltip" data-placement="top" title="PROCESS AUTOMATION"
                                        class="icon btn-icon-app" style="--icon-app-var: url('{{asset('frontend-asset/image/icon-application/process-btn-icon.svg')}}'); --icon-appb-var:url('{{asset('frontend-asset/image/icon-application/blue/process-btn-icon.svg')}}'); "></a>
                                    <a href="" data-toggle="tooltip" data-placement="top" title="TEST & MEASUREMENT"
                                        class="icon btn-icon-app" style="--icon-app-var: url('{{asset('frontend-asset/image/icon-application/testing-btn-icon.svg')}}'); --icon-appb-var:url('{{asset('frontend-asset/image/icon-application/blue/testing-btn-icon.svg')}}'); "></a>
                                </div>
                                <div class="icon-app-line1">
                                    <a href="" data-toggle="tooltip" data-placement="top" title="MEDICAL EQUIPMENT"
                                        class="icon btn-icon-app" style="--icon-app-var: url('{{asset('frontend-asset/image/icon-application/medical-btn-icon.svg')}}'); --icon-appb-var:url('{{asset('frontend-asset/image/icon-application/blue/medical-btn-icon.svg')}}'); "></a>
                                    <a href="" data-toggle="tooltip" data-placement="top" title="FACTORY AUTOMATION"
                                        class="icon btn-icon-app" style="--icon-app-var: url('{{asset('frontend-asset/image/icon-application/factory-btn-icon.svg')}}'); --icon-appb-var:url('{{asset('frontend-asset/image/icon-application/blue/factory-btn-icon.svg')}}'); "></a>
                                    <a href="" data-toggle="tooltip" data-placement="top" title="LED LIGHTING"
                                        class="icon btn-icon-app" style="--icon-app-var: url('{{asset('frontend-asset/image/icon-application/led-btn-icon.svg')}}'); --icon-appb-var:url('{{asset('frontend-asset/image/icon-application/blue/led-btn-icon.svg')}}'); "></a>
                                    <a href="" data-toggle="tooltip" data-placement="top" title="FOOD & BEVERAGE"
                                        class="icon btn-icon-app" style="--icon-app-var: url('{{asset('frontend-asset/image/icon-application/food-btn-icon.svg')}}'); --icon-appb-var:url('{{asset('frontend-asset/image/icon-application/blue/food-btn-icon.svg')}}'); "></a>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
                @endif
         @endforeach
        </div>
    </div>
      @endforeach
    </div>
    </div>
</div>
<div class="invisible-up-922">
    <div class="nav-allproduct ">
        <div class="my-auto ">
               <h6>PRODUCTS</h6> 
        </div>
        <a href="#"class="my-auto text-bold" id="btn-allproduct">
           <h6>ALL PRODUCTS <i class="zmdi zmdi-chevron-down"></i> </h6> 
        </a>   
    </div>
    <div class="nav-allproduct-list p-5" id="nav-allproduct-list">
        @foreach ($mainCategories as $mainCate)
        <h6 class="text-color-delta pb-2">{{$mainCate->name}}</h6>
        @foreach ($subCategories as $subCate)
        @if($subCate->main_cateid == $mainCate->main_id)
        <a href=""><h6 class="text-dark-gray pb-2">{{$subCate->name}}</h6></a>
        @endif
        @endforeach
        <hr>
        @endforeach
      
    </div>
    <div class="box-banner" >
        <div id="slide-banner-products-mobile" class="owl-carousel owl-theme">
            @foreach($last_products as $pro)
            @if($pro->status == 1)
            <div class="banner-type-product-all item">
                <div class="slide" style="background-image: url('{{asset('frontend-asset/image/Featured-Product-BG@2x.png')}}');">
                    <div class="slide-content">
                        <div class="container ">
                        <h4 class="text-delta mr-b-12px">{{$pro->pro_code}}</h4>
                            <a href="" class="link-see-product">SEE PRODUCTS > </a>
                            <div class="d-flex justify-content-center py-5 ">
                                <img class="img-product" src="{{config('app.url')}}/upload/thumbs/{{$pro->picture}}" alt="">
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            @else 
            <div class="banner-type-product-all item">
                <div class="slide" style="background-color:{{$pro->bg_color}};">
                    <div class="slide-content">
                        <div class="container ">
                            <h4 class="text-delta mr-b-12px" style="color:{{$pro->title_color}}">
                                <?php
                                $str = $pro->title;
                                $st = explode("\n", $str);
                                for ($k = 0; $k < count($st); $k++) {
                                    echo $st[$k] = '<div>'
                                            . $st[$k]
                                            . '</div>';
                                }
                                ?>
                            </h4>
                            <a href="" class="link-see-product">SEE PRODUCTS > </a>
                            <div class="d-flex justify-content-center py-5 ">
                                <img class="img-product" src="{{config('app.url')}}/medias/categories/{{$pro->image}}" alt="">
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>
    <div class="product-type-boxitem" id="delta-industrial-power-supplies">
        @foreach ($mainCategories as $mainCate)
            <h2 class="text-title-delta">{{$mainCate->name}}</h2>
            @foreach ($subCategories as $subCate)
            @if($subCate->main_cateid == $mainCate->main_id)
                <div class="product-type-boxitem-sub" id="dalta_cate_mobile{{$subCate->main_cateid}}">
                <div class="product-type-boxitem-sub-banner"
                    style=" background-image: url('{{asset('frontend-asset/image/Categories@2x.png')}}');">
                    <div class="row">
                        <div class="col-lg-6 product-type-boxitem-sub-banner-text text-center">
                            <h2 class="text-dark">{{$subCate->name}}</h2>
                            @if(isset($subCate->file))
                            <a href="{{config('app.url')}}/medias/categories/{{$subCate->file}}" download=""><img src="{{asset('frontend-asset/image/downlode.svg')}}" alt=""> Download selection
                                guide</a>
                            @else 
                            <a href="" download=""><img src="{{asset('frontend-asset/image/downlode.svg')}}" alt="">Empty selection guide</a>
                            @endif
                        </div>
                        <div class="col-lg-6 product-type-boxitem-sub-banner-pic">
                            <img class="img-fluid" src="{{asset('frontend-asset/image/DIN RAIL POWER SUPPLY@2x.png')}}" alt="">
                        </div>
                    </div>
                </div>
                <div class="product-type-boxitem-sub-list container">
                    @foreach ($series as $serie)
                    @if($serie->pro_categories_id == $subCate->sub_pro_id)
                    <div class="product-type-boxitem-sub-list-item text-center">
                        <div class="product-type-boxitem-sub-list-item-pic">
                            <img src="{{asset('frontend-asset/image/CilQ ll@2x.png')}}" alt="">
                        </div>
                        <div class="product-type-boxitem-sub-list-item-text">
                            <h3 class="text-dark">{{$subCate->name}}</h3>
                            <div class="text-hoverthis">
                                <div id="text-hover">{!! iconv_substr(strip_tags($serie->overview_content),0,300,'UTF-8') !!} ...</div>
                        </div>
                        <div class="product-type-boxitem-sub-list-item-icon ">
                            <div class="icon-app-line1">
                                <a href="" data-toggle="tooltip" data-placement="top" title="BUILDING AUTOMATION"
                                    class="icon btn-icon-app"  style="--icon-app-var: url('{{asset('frontend-asset/image/icon-application/building-btn-icon.svg')}}'); --icon-appb-var:url('{{asset('frontend-asset/image/icon-application/blue/building-btn-icon.svg')}}'); "></a>
                                <a href="" data-toggle="tooltip" data-placement="top" title="MACHINE AUTOMATION"
                                    class="icon btn-icon-app" style="--icon-app-var: url('{{asset('frontend-asset/image/icon-application/machine-btn-icon.svg')}}'); --icon-appb-var:url('{{asset('frontend-asset/image/icon-application/blue/machine-btn-icon.svg')}}'); "></a>
                                <a href="" data-toggle="tooltip" data-placement="top" title="RENEWABLE ENERGY"
                                    class="icon btn-icon-app" style="--icon-app-var: url('{{asset('frontend-asset/image/icon-application/renewable-btn-icon.svg')}}'); --icon-appb-var:url('{{asset('frontend-asset/image/icon-application/blue/renewable-btn-icon.svg')}}'); "></a>
                                <a href="" data-toggle="tooltip" data-placement="top" title="PROCESS AUTOMATION"
                                    class="icon btn-icon-app" style="--icon-app-var: url('{{asset('frontend-asset/image/icon-application/process-btn-icon.svg')}}'); --icon-appb-var:url('{{asset('frontend-asset/image/icon-application/blue/process-btn-icon.svg')}}'); "></a>
                                <a href="" data-toggle="tooltip" data-placement="top" title="TEST & MEASUREMENT"
                                    class="icon btn-icon-app" style="--icon-app-var: url('{{asset('frontend-asset/image/icon-application/testing-btn-icon.svg')}}'); --icon-appb-var:url('{{asset('frontend-asset/image/icon-application/blue/testing-btn-icon.svg')}}'); "></a>
                            </div>
                            <div class="icon-app-line1">
                                <a href="" data-toggle="tooltip" data-placement="top" title="MEDICAL EQUIPMENT"
                                    class="icon btn-icon-app" style="--icon-app-var: url('{{asset('frontend-asset/image/icon-application/medical-btn-icon.svg')}}'); --icon-appb-var:url('{{asset('frontend-asset/image/icon-application/blue/medical-btn-icon.svg')}}'); "></a>
                                <a href="" data-toggle="tooltip" data-placement="top" title="FACTORY AUTOMATION"
                                    class="icon btn-icon-app" style="--icon-app-var: url('{{asset('frontend-asset/image/icon-application/factory-btn-icon.svg')}}'); --icon-appb-var:url('{{asset('frontend-asset/image/icon-application/blue/factory-btn-icon.svg')}}'); "></a>
                                <a href="" data-toggle="tooltip" data-placement="top" title="LED LIGHTING"
                                    class="icon btn-icon-app" style="--icon-app-var: url('{{asset('frontend-asset/image/icon-application/led-btn-icon.svg')}}'); --icon-appb-var:url('{{asset('frontend-asset/image/icon-application/blue/led-btn-icon.svg')}}'); "></a>
                                <a href="" data-toggle="tooltip" data-placement="top" title="FOOD & BEVERAGE"
                                    class="icon btn-icon-app" style="--icon-app-var: url('{{asset('frontend-asset/image/icon-application/food-btn-icon.svg')}}'); --icon-appb-var:url('{{asset('frontend-asset/image/icon-application/blue/food-btn-icon.svg')}}'); "></a>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
            @endif
            @endforeach
         @endforeach
    </div>
</div>


@endsection


@section('js')
<script>
    $(document).ready(function () {
        $("#slide-banner-products").owlCarousel({
            loop:true,
            navigation: true, // Show next and prev buttons
            slideSpeed: 300,
            paginationSpeed: 400,
            singleItem: true,

            // "singleItem:true" is a shortcut for:
            items: 1,
            // itemsDesktop : false,
            // itemsDesktopSmall : false,
            // itemsTablet: false,
            // itemsMobile : false

        });
        $("#slide-banner-products-mobile").owlCarousel({
            loop:true,
            navigation: true, // Show next and prev buttons
            slideSpeed: 300,
            paginationSpeed: 400,
            singleItem: true,

            // "singleItem:true" is a shortcut for:
            items: 1,
            // itemsDesktop : false,
            // itemsDesktopSmall : false,
            // itemsTablet: false,
            // itemsMobile : false

        });
        $('.product-type-boxitem-sub-list-item-icon a').tooltip({ boundary: 'window' });
        $('#bar-product-type-nav').removeClass('scrolled');
        $("#btn-allproduct").click(function(){
            $("#nav-allproduct-list").slideToggle("slow");
        });
        
        $("#nav-allproduct-list-desk").hide();
        $(".nav-desktop-allproduct").hide();
        
        $("#btn-allproduct-desk").click(function(){
            $("#nav-allproduct-list-desk").slideToggle("slow");
        });
        /* nav show on div*/
        var offsetTop = $(".box-allproduct-content").offset().top;
        $(window).scroll(function() {
            var scrollTop = $(window).scrollTop();
            if (scrollTop >= offsetTop) {
                $(".nav-desktop-allproduct").slideDown(500);
            }else{
                $(".nav-desktop-allproduct").fadeOut();
                $("#nav-allproduct-list-desk").fadeOut();
            }
        });
    });
</script>
@endsection