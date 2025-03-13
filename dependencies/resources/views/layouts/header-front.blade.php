<style>
    .select-language {
        color: #444444;
        font-size: 16px;
        font-weight: bold;
        -webkit-appearance: none;
        -moz-appearance: none;
        border-radius: 0;
        border: 1px solid transparent;
        background-position: right 50%;
        background-repeat: no-repeat;
        background-size: 12px;
        background-image: url('{{asset(' frontend-asset/image/arrow.svg')}}');
        width: 50px;
        background-color: #fff;

    }

    .select-language:disabled,
    .select-language[readonly] {
        background-color: #F2F2F2;
        border: 1px solid transparent !important;
        opacity: 1;
        color: #0087DC;
        background-image: unset;
    }

    .select-language:focus {
        color: #0087DC;
        background-color: #fff;
        border-color: transparent;
        outline: unset;
        box-shadow: unset;
    }

    .navbar-searchandlang {
        margin-right: 0.2rem !important;
    }

    /* @media only screen and (max-width:768px){
    .brand-image {
        height: 30px !important;
    }

    .nav-link-list{
        padding-top: 25px !important;
    }
    .select-language{
        font-size: 22px !important;
    }
} */
    .pad-logout {
        padding: 0 5px;
        color: #444444;
    }

    .h-20 {
        height: 20px;
    }

    .img-pop-destop {
        list-style: none;
        position: fixed;
        top: 50%;
        right: 0%;
        -webkit-transform: translateY(-50%);
        transform: translateY(-50%);
        z-index: 99;
    }


    .img-pop-destop li a {
        display: block;
        margin-left: -2px;
        margin-bottom: 1em;
        -webkit-transition: all .4s ease;
        transition: all .4s ease;
        text-decoration: none;
        position: relative;
        padding: 4px;
        width: 43px;
        font-size: 16px;
        background: #E3EFF8;
        border: 2px solid #0087DC;
        color: #0087DC;
        text-align: center;
        height: 146px;
        border-radius: 10px 0 0 10px;
    }

    .img-pop-destop li a:hover {
        cursor: pointer;
        color: #fff;
        background: #0087DC;
    }

    .img-pop-destop li a span {
        display: block;
        white-space: nowrap;
        transform: rotate(90deg);
        margin-top: 10px;
    }

    .img-pop {
        list-style: none;
        position: fixed;
        top: 50%;
        right: 0%;
        -webkit-transform: translateY(-50%);
        transform: translateY(-50%);
        z-index: 99;
    }

    .img-pop li a {
        display: block;
        margin-left: 0px;
        height: 60px;
        width: 60px;
        border-radius: 25px 0 0 25px;
        border: 2px solid #000;
        background: #FFF;
        margin-bottom: 1em;
        -webkit-transition: all .4s ease;
        transition: all .4s ease;
        color: #2980b9;
        text-decoration: none;
        line-height: 42px;
        position: relative;

    }

    .img-pop li a:hover {
        cursor: pointer;
        width: 200px;
        color: #fff;
    }

    .img-pop li a:hover span {
        left: 0;
    }

    .img-pop li a span {
        padding: 0 28px 0 57px;
        position: absolute;
        right: -163px;
        -webkit-transition: left .4s ease;
        transition: left .4s ease;
    }

    .img-popli a i {
        position: absolute;
        top: 50%;
        right: 30px;
        -webkit-transform: translateY(-50%);
        transform: translateY(-50%);


    }

    .demo-icon {
        font-size: 35px;
        margin-left: 4px;
    }

    .demo-icon-destop {
        font-size: 19px;

    }

    .icon-sales-inquiry {
        height: 25px;
    }

    .icon-sales-inquiry-mobile {
        height: 26px;
        margin-left: 8px;
    }

    .icon-img-menu-top {
        height: 18px;
        margin-top: 3px;
    }

    .icon-img-menu-top-mobile {
        height: 23px;
        margin-top: 13px;
    }


    .img-pop li .skype {
        background: #E3EFF8;
        border-color: #0087DC;
        color: #0087DC;
    }

    .img-pop li .skype:hover {
        background: #0087DC;
    }


    .fs-front {
        font-size: 16px;
        text-decoration: none !important;
    }

    .fs-front:hover {
        color: #0087DC;
    }

    @media only screen and (min-width:0px) and (max-width:450px) {

        .demo-icon {
            font-size: 25px;
            margin-left: 7px;
            position: relative;
            top: -1px;
        }

        .img-pop li a {
            height: 45px;
            width: 45px;

        }

        .img-pop li a span {
            top: 0px;
            padding: 0 17px 0 56px;
            position: absolute;
            right: -163px;
            -webkit-transition: left .4s ease;
            transition: left .4s ease;
        }

        #scrollUp::before {
            content: "\f139";
            font-family: 'FontAwesome';
            font-size: 38px;
            color: #444444;
            cursor: pointer;
        }


    }

    .icon-serch {
        margin-top: 10px;
        margin-right: 10px;
        color: #444444;
    }

    .menu-buger {
        height: 39px;
        width: 42px;
        position: relative;
        border: 5px solid transparent;
        -moz-border-radius: 100%;
        -webkit-border-radius: 100%;
        border-radius: 100%;
        -moz-transition: 0.3s;
        -o-transition: 0.3s;
        -webkit-transition: 0.3s;
        transition: 0.3s;
        cursor: pointer;
    }

    .bar {
        height: 3px;
        width: 29px;
        display: block;
        margin: 5px auto;
        position: relative;
        background-color: #444444;
        -moz-border-radius: 10px;
        -webkit-border-radius: 10px;
        border-radius: 10px;
        -moz-transition: 0.4s;
        -o-transition: 0.4s;
        -webkit-transition: 0.4s;
        transition: 0.4s;
    }

    .menu-buger.active .bar:nth-of-type(1) {
        -moz-transform: translateY(10px) rotate(45deg);
        -ms-transform: translateY(10px) rotate(45deg);
        -webkit-transform: translateY(10px) rotate(45deg);
        transform: translateY(10px) rotate(45deg);
    }

    .menu-buger.active .bar:nth-of-type(2) {
        opacity: 0;
    }

    .menu-buger.active .bar:nth-of-type(3) {
        -moz-transform: translateY(-6px) rotate(-45deg);
        -ms-transform: translateY(-6px) rotate(-45deg);
        -webkit-transform: translateY(-6px) rotate(-45deg);
        transform: translateY(-6px) rotate(-45deg);
    }

    .font-size-tab {
        color: #0087DC !important;
    }

    .cur-link {
        cursor: pointer;
    }

    .img-icon-golang {
        height: 28px;
        margin-top: -2px;
    }

    .f-size-enquiry {
        font-size: 16px !important;
        margin-left: 10px;
        color: #000;
    }

    .f-size-enquiry-mobile {
        font-size: 20px !important;
        color: #000;
    }

    .vertical-text {
        writing-mode: vertical-rl;
        /* Display text vertically (right to left) */
        text-orientation: upright;
        /* Keep characters upright */
        transform: rotate(0deg) !important;
        padding: 6px 3px;
    }
</style>
<?php
function slugifyHead($text)
            {
            // replace non letter or digits by -
            $text = preg_replace('~[^\\pL\d]+~u', '-', $text);

            // trim
            $text = trim($text, '-');

            // transliterate
            // if (function_exists('iconv'))
            // {
            //     $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
            // }

            // lowercase
            $text = strtolower($text);

            // remove unwanted characters
            $text = preg_replace('~[^-\w]+~', '', $text);
            if (empty($text))
            {
                return 'n-a';
            }

            return $text;
            }

?>
<div class="invisible-nav-minimize">

    <div class="nav-firts ">
        <div class="alert-browser" id="alert-browser-check" style="display: none;">
            <div class="color-yellow">
                We recommend using the latest version of Chrome, Firefox or Safari.
            </div>
        </div>
        <div class="container">
            @if(session('partner_id') == null)
            <a class="d-flex" href="{{route('index','login')}}">
                <img class="mr-1" src="{{asset('frontend-asset/image/person-login.svg')}}" alt="">
                <div class="link-nav-first">
                    {{isset($staticContent['Login']) ? $staticContent['Login']:'' }}
                </div>
            </a> <span class="fs-front">|</span>
            @else

            <a class="pad-logout fs-front" href="{{route('index','login')}}"> <img
                    src="{{asset('frontend-asset/image/person-login.svg')}}" alt="">{{session('partner_firstname')}}</a>
            <span class="fs-front">/</span> <a href="{{route('index','logoutfrontend')}}"
                class="pad-logout fs-front">{{isset($staticContent['Logout'])?
                $staticContent['Logout'] :'Logout' }}</a>
            <span class="fs-front">|</span>

            @endif
            <a class="d-flex" onclick="subscribe()" data-toggle="modal" data-target="#subscribe-modal">
                <img class="mr-1" src="{{asset('frontend-asset/image/sub-new.svg')}}" alt="">
                <div class="link-nav-first">

                    {{isset($staticContent['Subscribe']) ? $staticContent['Subscribe']:'' }}
                </div>
            </a>
            <span class="fs-front">|</span>
            <a class="d-flex" href="{{route('contactSupport')}}">
                <img src="{{asset('frontend-asset/image/question.webp')}}" alt="" class="mr-2 icon-img-menu-top">
                <div class="link-nav-first">
                    {{isset($staticContent['Sales_Inquiry'])? $staticContent['Sales_Inquiry'] :'Sales Inquiry' }}
                </div>
            </a>

            <span class="fs-front">|</span>
            <a class="lang-space link-nav-first dropdown-toggle text-uppercase" id="dropdown06" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                @if(App::getLocale() == 'cn')
                简中
                @elseif(App::getLocale() == 'tw')
                繁中
                @else
                {{App::getLocale()}}
                @endif

                <i class="zmdi zmdi-chevron-down"></i></a>
            <div class="dropdown-menu" aria-labelledby="about-us">
                @if(isset($language))
                @foreach ($language as $item)
                <?php
                $current = null;
                foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
                    if ($item->name == $localeCode) {
                        $current = $localeCode;
                        break;
                    }
                }
               ?>
                <a onclick="setlocaltion('{{$current}}','{{ LaravelLocalization::getLocalizedURL($current, null, [], true) }}');"
                    class="dropdown-item lang-drop-down text-uppercase cur-link {{App::getLocale()== $current ? 'active' : ''}}">
                    @if($current == 'cn')
                    简中
                    @elseif($current == 'tw')
                    繁中
                    @else
                    {{$current}}
                    @endif
                </a>
                @endforeach
                @endif
            </div>
            <span class="fs-front">|</span>
            <div class="dropdown">
                <a class="dropdown-toggle cur-lang-new-g" data-toggle="dropdown">
                    <img class="img-icon-golang" src="{{asset('frontend-asset/image/icon/Global.svg')}}">
                </a>
                <ul class="dropdown-menu">
                    <li><a href="https://www.deltapsu.com">Global</a></li>
                    <li><a href="https://www.deltapsu.cn" target="_blank">China - 简体中文</a></li>
                </ul>
            </div>

        </div>

    </div>
    <div class="nav-position des-scrolled">
        <div class="container nav-here">

            <a class="navbar-brand" href="{{route('index','home')}}">
                <img class="brand-image mt-1" src="{{asset('frontend-asset/image/DeltaPSU-Logo.svg')}}">
            </a>
            <a class="nav-search nav-link" id="dropdown08">
                <div class="nav-search-btn"> {{isset($staticContent['Search'])?$staticContent['Search'] :''}} <i
                        class="fa fa-search"></i>
                </div>
            </a>

        </div>
        <div id="search-box" class="search-box" style="display:none;">
            <div class="nav-btn-search">
                <div class="border-nav-topsearch">
                    <div class="box-search">
                        <i class="fa fa-search"></i>
                    </div>
                    <label for="searchinput" class="searchinput mar-b">
                        <form id="formseachall">
                            <input type="text" name="keysearch" id="searchinput" placeholder="{{isset($staticContent['Search_by_keyword'])?
                $staticContent['Search_by_keyword'] :'Search_by_keyword' }}">
                        </form>
                    </label>
                </div>


                <div class="icon-clear">
                    <a onclick="document.getElementById('searchinput').value = ''">
                        <i class="zmdi zmdi-close icon-size-close"></i>
                    </a>
                </div>
            </div>
            <div>

            </div>
        </div>
        <nav id="nav-two" class="navbar navbar-expand-lg navbar-light bg-nav">

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar"
                aria-controls="navbars" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon">

                </span>
            </button>
            <div class="collapse navbar-collapse header-bar-line" id="navbar">
                <ul id="nav-all" class="navbar-nav mr-center-nav ul-nav-inner">

                    <li class="nav-item dropdown">
                        <a id="nav-uderline" class="nav-link" id="dropdown01" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">{{isset($staticContent['Products'])?
                            $staticContent['Products'] :'Products' }}

                            <i class="zmdi zmdi-chevron-down"></i>
                        </a>
                        <div class="dropdown-menu s-menu sp-dropdown" role="menu" aria-labelledby="dropdown01">

                            <div class="dropdown-submenu">
                                <a id="sub1" class="sub-menu dropdown-item " onclick="mainCate('sub1')" tabindex="-1"
                                    href="#">{{isset($staticContent['Industrial_Power'])?
                                    $staticContent['Industrial_Power'] :'Industrial Power' }} <i
                                        class="zmdi zmdi-chevron-right"></i></a>
                                <ul class="dropdown-menu drp-subthree">
                                    @if(isset($navcategories2))
                                    @foreach ($navcategories2 as $subCate)
                                    @if($subCate->main_cateid == 1)
                                    <li><a tabindex="-1" class="" onmouseover="bigImg('{{$subCate->image_type1}}',2)"
                                            href="{{route('allproductsByType' ,[slugifyHead($subCate->url_item),$subCate->sub_pro_id ,2])}}">{{$subCate->name}}
                                        </a>
                                    </li>
                                    @elseif($subCate->main_cateid == 2)
                                    <li><a tabindex="-1" class="" onmouseover="bigImg('{{$subCate->image_type2}}',2)"
                                            href="{{route('allproductsByType' ,[slugifyHead($subCate->url_item),$subCate->sub_pro_id ,2])}}">{{$subCate->name}}
                                        </a>
                                    </li>
                                    @elseif($subCate->main_cateid == 3)
                                    <li><a tabindex="-1" class="" onmouseover="bigImg('{{$subCate->image_type3}}',2)"
                                            href="{{route('allproductsByType' ,[slugifyHead($subCate->url_item),$subCate->sub_pro_id ,2])}}">{{$subCate->name}}
                                        </a>
                                    </li>
                                    @else
                                    <li><a tabindex="-1" class="" onmouseover="bigImg('{{$subCate->image}}',2)"
                                            href="{{route('allproductsByType' ,[slugifyHead($subCate->url_item),$subCate->sub_pro_id ,2])}}">{{$subCate->name}}
                                        </a>
                                    </li>
                                    @endif
                                    @endforeach
                                    @endif
                                    <div class="image-dropdown d-flex justify-content-center "
                                        style="background: linear-gradient(to bottom, #fff, transparent, transparent),url('{{asset('frontend-asset/image/Dropdown.jpg')}}')no-repeat;">
                                        <img class="imageNav2 img-hove-on-dropdown lazyload" loading="lazy"
                                            data-src="{{asset('frontend-asset/image/Industrial_Power_Supplies.png')}}"
                                            alt="Industrial_Power_Supplies.png">
                                    </div>
                                </ul>
                            </div>
                            <div class="dropdown-submenu">
                                <a id="sub2" class="sub-menu" onclick="mainCate('sub2')" tabindex="-1" href="#">
                                    {{isset($staticContent['Medical_Power'])?
                                    $staticContent['Medical_Power'] :'Medical Power ' }} <i
                                        class="zmdi zmdi-chevron-right"></i>
                                </a>
                                <ul class="dropdown-menu drp-subthree">
                                    @if(isset($navcategories1))
                                    @foreach ($navcategories1 as $subCate)
                                    @if($subCate->main_cateid == 1)
                                    <li><a tabindex="-1" class="" onmouseover="bigImg('{{$subCate->image_type1}}',1)"
                                            href="{{route('allproductsByType' ,[slugifyHead($subCate->url_item),$subCate->sub_pro_id ,1])}}">{{$subCate->name}}
                                        </a>
                                    </li>
                                    @elseif($subCate->main_cateid == 2)
                                    <li><a tabindex="-1" class="" onmouseover="bigImg('{{$subCate->image_type2}}',1)"
                                            href="{{route('allproductsByType' ,[slugifyHead($subCate->url_item),$subCate->sub_pro_id ,1])}}">{{$subCate->name}}
                                        </a>
                                    </li>
                                    @elseif($subCate->main_cateid == 3)
                                    <li><a tabindex="-1" class="" onmouseover="bigImg('{{$subCate->image_type3}}',1)"
                                            href="{{route('allproductsByType' ,[slugifyHead($subCate->url_item),$subCate->sub_pro_id ,1])}}">{{$subCate->name}}
                                        </a>
                                    </li>
                                    @else
                                    <li><a tabindex="-1" class="" onmouseover="bigImg('{{$subCate->image}}',1)"
                                            href="{{route('allproductsByType' ,[slugifyHead( $subCate->url_item),$subCate->sub_pro_id ,1])}}">{{$subCate->name}}
                                        </a>
                                    </li>
                                    @endif
                                    @endforeach
                                    @endif
                                    <div class="image-dropdown d-flex justify-content-center "
                                        style="background: linear-gradient(to bottom, #fff, transparent, transparent),url('{{asset('frontend-asset/image/Dropdown.jpg')}}')no-repeat;">
                                        <img class="imageNav1 img-hove-on-dropdown lazyload"
                                            data-src="{{asset('frontend-asset/image/Medical-Power-Supplies.png')}}"
                                            loading="lazy" alt="Medical-Power-Supplies.png">
                                    </div>
                                </ul>
                            </div>
                            <div class="dropdown-submenu">
                                <a id="sub3" class="sub-menu" onclick="mainCate('sub3')" tabindex="-1"
                                    href="#">{{isset($staticContent['LED_Power'])?
                                    $staticContent['LED_Power'] :'LED Power' }} <i
                                        class="zmdi zmdi-chevron-right"></i></a>
                                <ul class="dropdown-menu drp-subthree">
                                    <li><a tabindex="-1" class="text-c"
                                            href="{{route('allproductsByType',[slugifyHead('CC-Cv-Mode'),1 , 3])}}">{{isset($staticContent['CC_Cv_Mode'])?
                                            $staticContent['CC_Cv_Mode'] :'CC Cv Mode' }}</a>
                                    </li>
                                    <li><a tabindex="-1" class="text-c"
                                            href="{{route('allproductsByType',[slugifyHead('CC-Mode'),2 ,3])}}">{{isset($staticContent['CC_Mode'])?
                                            $staticContent['CC_Mode'] :'CC Mode' }}</a>
                                    </li>
                                    <li><a tabindex="-1" class="text-c"
                                            href="{{route('allproductsByType',[slugifyHead('CV_Mode'),3 ,3])}}">{{isset($staticContent['CV_Mode'])?
                                            $staticContent['CV_Mode'] :'CV Mode' }}</a>
                                    </li>
                                    <div class="image-dropdown d-flex justify-content-center "
                                        style="background: linear-gradient(to bottom, #fff, transparent, transparent),url('{{asset('frontend-asset/image/Dropdown.jpg')}}') no-repeat;">
                                        @if(isset($navcategories3))
                                        <img class="imageNav3 img-hove-on-dropdown lazyload"
                                            data-src="{{config('app.url')}}/medias/categories/{{$navcategories3[0]->image}}"
                                            loading="lazy" alt="{{$navcategories3[0]->image}}">
                                        @endif
                                    </div>
                                </ul>
                            </div>
                            <div class="dropdown-submenu">
                                @if(isset($navcategories4) && count($navcategories4) > 0 )
                                <a id="sub4" class="sub-menu dropdown-item " onclick="mainCate('sub4')" tabindex="-1"
                                    href="#">{{isset($staticContent['Battery_Charging'])?
                                    $staticContent['Battery_Charging'] :'Industrial Battery Charging' }} <i
                                        class="zmdi zmdi-chevron-right"></i></a>
                                @endif
                                <ul class="dropdown-menu drp-subthree">
                                    @if(isset($navcategories4))
                                    @foreach ($navcategories4 as $subCate)
                                    @if($subCate->main_cateid == 1)
                                    <li><a tabindex="-1" class="" onmouseover="bigImg('{{$subCate->image_type1}}',4)"
                                            href="{{route('allproductsByType' ,[preg_replace('/\s+/', '-', $subCate->url_item),$subCate->sub_pro_id ,4])}}">{{$subCate->name}}
                                        </a>
                                    </li>
                                    @elseif($subCate->main_cateid == 2)
                                    <li><a tabindex="-1" class="" onmouseover="bigImg('{{$subCate->image_type2}}',4)"
                                            href="{{route('allproductsByType' ,[preg_replace('/\s+/', '-', $subCate->url_item),$subCate->sub_pro_id ,4])}}">{{$subCate->name}}
                                        </a>
                                    </li>
                                    @elseif($subCate->main_cateid == 3)
                                    <li><a tabindex="-1" class="" onmouseover="bigImg('{{$subCate->image_type3}}',4)"
                                            href="{{route('allproductsByType' ,[preg_replace('/\s+/', '-', $subCate->url_item),$subCate->sub_pro_id ,4])}}">{{$subCate->name}}
                                        </a>
                                    </li>
                                    @elseif($subCate->main_cateid == 4)
                                    <li><a tabindex="-1" class="" onmouseover="bigImg('{{$subCate->image}}',4)"
                                            href="{{route('allproductsByType' ,[preg_replace('/\s+/', '-', $subCate->url_item),$subCate->sub_pro_id ,4])}}">{{$subCate->name}}
                                        </a>
                                    </li>
                                    @else
                                    <li><a tabindex="-1" class="" onmouseover="bigImg('{{$subCate->image}}',4)"
                                            href="{{route('allproductsByType' ,[preg_replace('/\s+/', '_', $subCate->url_item),$subCate->sub_pro_id ,4])}}">{{$subCate->name}}
                                        </a>
                                    </li>
                                    @endif
                                    @endforeach
                                    @endif
                                    <div class="image-dropdown d-flex justify-content-center "
                                        style="background: linear-gradient(to bottom, #fff, transparent, transparent),url('{{asset('frontend-asset/image/Dropdown.jpg')}}')no-repeat;">
                                        <img class="imageNav4 img-hove-on-dropdown lazyload" loading="lazy"
                                            data-src="{{asset('frontend-asset/image/battery_charging_new.webp')}}"
                                            alt="Battery Charging Image">
                                    </div>
                                </ul>
                            </div>
                        </div>
                    </li>

                    <li class="nav-item dropdown ">
                        <a id="nav-uderline" class="nav-link " href="" id="dropdown02" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false"> {{isset($staticContent['Tools'])?
                            $staticContent['Tools'] :'Tools' }} <i class="zmdi zmdi-chevron-down"></i></a>
                        <div class="dropdown-menu s-menu" role="menu" aria-labelledby="dropdown02">
                            {{--
                    <li class="dropdown-item"> --}}<a class="dropdown-item" href="{{route('productFinder')}}">
                            {{isset($staticContent['Product_Selector'])?
                            $staticContent['Product_Selector'] :'Product Selector' }} </a>{{-- </li> --}}
                    {{-- <li class="dropdown-item"> --}}<a class="dropdown-item"
                            href="{{route('configurableproduct')}}">
                            {{isset($staticContent['configurable_power_selector'])?
                            $staticContent['configurable_power_selector'] :'configurable power selector' }}</a>{{--
                    </li>
                    --}}
                    {{-- <li class="dropdown-item"> --}}<a class="dropdown-item" href="{{route('productCoparison')}}">
                            {{isset($staticContent['product_comparison'])?
                            $staticContent['product_comparison'] :'product comparison' }}</a>{{-- </li> --}}
            </div>
            </li>


            <li class="nav-item dropdown ">
                <a id="nav-uderline" class="nav-link " href="" id="dropdown03" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false"> {{isset($staticContent['Applications'])?
                    $staticContent['Applications'] :'Applications' }} <i class="zmdi zmdi-chevron-down"></i></a>
                <div class="dropdown-menu s-menu" role="menu" aria-labelledby="dropdown03">
                    @if(isset($navapplication))
                    @foreach ($navapplication as $app)
                    <a class="dropdown-item"
                        href="{{route('appDetail' ,[ 'name' => $app->slug_app , 'id' => $app->applica_id])}}">
                        {{$app->name}}</a>
                    @endforeach
                    @endif
                </div>
            </li>
            {{-- Memu About Us --}}
            {{-- <li class="nav-item dropdown ">
                <a id="nav-uderline" class="nav-link " href="" id="dropdown04" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">{{$staticContent['About']}} <i
                        class="zmdi zmdi-chevron-down"></i></a>
                <div class="dropdown-menu megamenu s-menu" aria-labelledby="dropdown04">
                    @foreach ($navaboutus as $abt)
                    <a class="dropdown-item" href="{{route('aboutUs',$abt->stug)}}">{{$abt->title}}</a>
                    @endforeach

                </div>
            </li> --}}

            <li class="nav-item dropdown ">
                <a id="nav-uderline" class="nav-link" href="" id="dropdown05" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">{{isset($staticContent['Updates'])?
                    $staticContent['Updates'] :'Updates' }} <i class="zmdi zmdi-chevron-down"></i></a>
                <div class="dropdown-menu megamenu s-menu" aria-labelledby="dropdown05">
                    <a class="dropdown-item" href="{{route('index','news')}}">
                        {{isset($staticContent['Product_News'])?
                        $staticContent['Product_News'] :'Product News' }} </a>
                    <a class="dropdown-item" href="{{route('index','events')}}">{{isset($staticContent['Events'])?
                        $staticContent['Events'] :'Events' }}</a>
                    {{--
            <li><a href="{{route('index','technical-articles')}}">TECHNICAL ARTICLE</a></li>
            <li><a href="{{route('index','product-notice')}}">PRODUCT NOTICE</a></li> --}}
    </div>
    </li>
    <li class="nav-item dropdown  ">
        <a id="nav-uderline" class="nav-link " href="" id="dropdown06" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">{{isset($staticContent['nav_dowloads'])?
            $staticContent['nav_dowloads'] :'dowloads' }}
            <i class="zmdi zmdi-chevron-down"></i></a>
        <div class="dropdown-menu megamenu sp-dropdown02 s-menu" aria-labelledby="dropdown06">
            <a class="dropdown-item" href="{{route('index','catalogs')}}">{{isset($staticContent['catalogs'])?
                $staticContent['catalogs'] :'catalogs' }}</a>
            <a class="dropdown-item"
                href="{{route('index','product-documents')}}">{{isset($staticContent['Product_Documents'])?
                $staticContent['Product_Documents'] :'Product_Documents' }}</a>
            {{-- <a class="dropdown-item" href="{{route('index','login')}}">PARTNERS</a> --}}
        </div>
    </li>
    <li class="nav-item dropdown ">
        <a id="nav-uderline" class="nav-link" href="" id="dropdown07" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">{{isset($staticContent['Supports'])?
            $staticContent['Supports'] :'Supports' }}
            <i class="zmdi zmdi-chevron-down"></i></a>
        <div class="dropdown-menu megamenu s-menu" aria-labelledby="dropdown07">
            <a class="dropdown-item" href="{{route('contactSupport')}}">{{isset($staticContent['contact_us'])?
                $staticContent['contact_us'] :'contact_us' }}</a>
            <a class="dropdown-item" href="{{route('contactSalesOffices')}}">{{isset($staticContent['sales_offices'])?
                $staticContent['sales_offices'] :'sales_offices' }}</a>
            <a class="dropdown-item"
                href="{{route('contactFindDistributor')}}">{{isset($staticContent['find_a_distributor'])?
                $staticContent['find_a_distributor'] :'find_a_distributor' }}</a>
            <a class="dropdown-item" href="{{route('index','faqs')}}">{{isset($staticContent['FAQs'])?
                $staticContent['FAQs'] :'FAQs' }}</a>
        </div>
    </li>
    </ul>
</div>
</nav>
</div>
<div class="nav-comparison " id="nav-comparison" style="display:none;">
    <div class="container d-flex justify-content-between align-items-stretch">
        <div id="listAllcomparesesion" class="d-flex align-items-stretch all-list-to-comparison">
        </div>
        <a href="{{route('productCoparison')}}" class="btn btn-subscribe to-comparison">
            {{isset($staticContent['View_compare'])?
            $staticContent['View_compare'] :'View_compare' }}
            (<span id="numberselect"></span>/3)</a>
    </div>
</div>
</div>
<div class="visible-nav-minimize">
    <div class="nav-mobile scrolled w-100">
        <div class="nav-link-list d-flex">
            <a class="col-nav navbar-brand-mobile" href="#" onclick="openNav();">
                {{-- <img class="burger-img" src="{{asset('frontend-asset/image/hamburger.svg')}}">
                --}}
                <div class="menu-buger">
                    <div class="bar"></div>
                    <div class="bar"></div>
                    <div class="bar"> </div>
                </div>
            </a>
            <a class="col-nav navbar-brand-mobile d-flex justify-content-center" href="{{route('index','home')}}">
                <img class="brand-image" src="{{asset('frontend-asset/image/DeltaPSU-Logo.svg')}}">
            </a>
            <div class="col-nav d-flex justify-content-end">
                <div class="navbar-brand-mobile navbar-searchandlang" id="btn-search-mobile" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-search icon-serch" aria-hidden="true"></i>
                </div>
                <select name="" id="select-mobile-lang" onchange="changeLangLocationmobile();"
                    class="select-language text-uppercase">
                    @if(isset($language))
                    @foreach ($language as $item)
                    <?php
                        $current = null;
                        foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
                            if ($item->name == $localeCode) {
                                $current = $localeCode;
                                break;
                            }
                        }
                        ?>
                    {{ LaravelLocalization::getLocalizedURL($current, null, [], true) }}
                    <option value="{{ LaravelLocalization::getLocalizedURL($current, null, [], true) }}"
                        {{App::getLocale()==$current?'selected':'' }}>
                        @if($current == 'cn')
                        简中
                        @elseif($current == 'tw')
                        繁中
                        @else
                        {{strtoupper($current) }}
                        @endif

                    </option>
                    @endforeach
                    @endif
                </select>
            </div>


        </div>
        <div id="search-box-mobile" class="search-box-mobile" style="display:none;">
            <div class="nav-btn-search">
                <div class="box-search">
                    <i class="fa fa-search"></i>
                </div>
                <form id="formseachall_mobile">
                    <label for="searchinput-mobile" class="searchinput_mobile">
                        <input type="text" id="searchinput-mobile" placeholder="{{isset($staticContent['Search_by_keyword'])?
            $staticContent['Search_by_keyword'] :'Search_by_keyword' }}">
                    </label>
                </form>
                <div class="icon-clear">

                    <a id="btn-close-search" href="#">
                        <i class="zmdi zmdi-close icon-size-close"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>



    <div id="Sidenav" class="sidenav d-flex">

        <div class="in-sidenav pad-ar-24px " id="in-sidenav" style="visibility:hidden">
            {{-- <div id="sidenavClose" class="" onclick="closeNav()">
                X
            </div> --}}
            <a tabindex="-1" href="#" onclick="toggle_visibility('btn-sidenav1')">{{isset($staticContent['Products'])?
                $staticContent['Products'] :'Products' }}<i class="zmdi zmdi-chevron-right"></i></a>
            <a class="" tabindex="-1" href="#"
                onclick="toggle_visibility('btn-sidenav2')">{{isset($staticContent['Tools'])?
                $staticContent['Tools'] :'Tools' }}<i class="zmdi zmdi-chevron-right"></i></a>
            <a class="" tabindex="-1" href="#"
                onclick="toggle_visibility('btn-sidenav3')">{{isset($staticContent['Applications'])?
                $staticContent['Applications'] :'Applications' }}<i class="zmdi zmdi-chevron-right"></i></a>
            {{-- <a class="" tabindex="-1" href="#"
                onclick="toggle_visibility('btn-sidenav4')">{{$staticContent['About']}}<i
                    class="zmdi zmdi-chevron-right"></i></a> --}}
            <a class="" tabindex="-1" href="#"
                onclick="toggle_visibility('btn-sidenav5')">{{isset($staticContent['Updates'])?
                $staticContent['Updates'] :'Updates' }}<i class="zmdi zmdi-chevron-right"></i></a>
            <a class="" tabindex="-1" href="#"
                onclick="toggle_visibility('btn-sidenav6')">{{isset($staticContent['nav_dowloads'])?
                $staticContent['nav_dowloads'] :'dowloads' }}<i class="zmdi zmdi-chevron-right"></i></a>
            <a class="" tabindex="-1" href="#"
                onclick="toggle_visibility('btn-sidenav7')">{{isset($staticContent['Supports'])?
                $staticContent['Supports'] :'Supports' }} <i class="zmdi zmdi-chevron-right"></i></a>
            <div class="d-flex">
                <img src="{{asset('frontend-asset/image/person-login-dark.svg')}}" alt="" class="mr-2">
                @if(session('partner_id') == null)
                <a class="a-link-hover" tabindex="-1" href="{{route('index','login')}}">Login </a>

                @else

                <a class="pad-logout fs-front" href="{{route('index','login')}}">
                    {{session('partner_firstname')}} /
                </a>

                <a href="{{route('index','logoutfrontend')}}" class="pad-logout fs-front"> &nbsp;
                    {{isset($staticContent['Logout'])?
                    $staticContent['Logout'] :'Logout' }}
                </a>

                @endif

            </div>
            <div class="d-flex">
                <img src="{{asset('frontend-asset/image/sub-new-dark.svg')}}" alt="" class="mr-2"><a
                    class="a-link-hover" tabindex="-1" onclick="subscribe()" data-toggle="modal"
                    data-target="#subscribe-modal">
                    {{isset($staticContent['Subscribe'])?
                    $staticContent['Subscribe'] :'Subscribe' }}</a>
            </div>
            <div class="d-flex">
                {{-- <i class="icon-facon mr-1 icon-find-dis-blue f-size-enquiry-mobile"></i> --}}
                <img src="{{asset('frontend-asset/image/question.webp')}}" alt="" class="mr-2 icon-img-menu-top-mobile">
                <a href="{{route('contactSupport')}}" class="a-link-hover">
                    {{isset($staticContent['Sales_Inquiry'])? $staticContent['Sales_Inquiry'] :'Sales Inquiry' }}</a>
            </div>
            <div class="d-flex">
                <div class="dropdown">
                    <a class="dropdown-toggle cur-lang-new-g" data-toggle="dropdown">
                        <img class="img-icon-golang" src="{{asset('frontend-asset/image/icon/Global.svg')}}">
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="https://www.deltapsu.com">Global</a></li>
                        <li><a href="https://www.deltapsu.cn" target="_blank">China - 简体中文</a></li>
                    </ul>
                </div>
            </div>

        </div>
        {{-- PRODUCTS --}}
        <div id="btn-sidenav1" class="btn-sidenav pad-ar-24px">
            <a class="text-color-delta" tabindex="-1" href="#" onclick="toggle_visibility('btn-sidenav1')"><i
                    class="zmdi zmdi-chevron-left mr-1"></i>{{isset($staticContent['Products']) ?
                $staticContent['Products'] :
                'Products' }}</a>

            <a class="text-normal pl-3" href="#" onclick="toggle_visibility('btn-sidenav-sub1')">{{
                isset($staticContent['Industrial_Power'])? $staticContent['Industrial_Power'] : 'Industrial Power' }}<i
                    class="zmdi zmdi-chevron-right"></i></a>
            <a class="text-normal pl-3" href="#"
                onclick="toggle_visibility('btn-sidenav-sub2')">{{isset($staticContent['Medical_Power']) ?
                $staticContent['Medical_Power'] :'' }}<i class="zmdi zmdi-chevron-right"></i></a>
            <a class="text-normal pl-3" href="#"
                onclick="toggle_visibility('btn-sidenav-sub3')">{{isset($staticContent['LED_Power'])?
                $staticContent['LED_Power'] : ' LED Power' }}<i class="zmdi zmdi-chevron-right"></i></a>

            <a class="text-normal pl-3" href="#"
                onclick="toggle_visibility('btn-sidenav-sub4')">{{isset($staticContent['Battery_Charging'])?
                $staticContent['Battery_Charging'] :'Industrial Battery Charging' }}<i
                    class="zmdi zmdi-chevron-right"></i></a>
        </div>
        <div id="btn-sidenav-sub1" class="btn-sidenav  pad-ar-24px">
            <a class="text-color-delta" tabindex="-1" href="#" onclick="toggle_visibility('btn-sidenav-sub1')"><i
                    class="zmdi zmdi-chevron-left mr-1"></i>{{isset($staticContent['Industrial_Power'])?
                $staticContent['Industrial_Power'] : 'Industrial Power'}}</a>
            @if(isset($navcategories2))
            @foreach ($navcategories2 as $subCate)
            <a class="text-normal pl-3 "
                href="{{route('allproductsByType' ,[ slugifyHead($subCate->url_item),$subCate->sub_pro_id,2])}}">{{$subCate->name}}</a>
            @endforeach
            @endif
        </div>

        <div id="btn-sidenav-sub2" class="btn-sidenav  pad-ar-24px">
            <a class="text-color-delta" tabindex="-1" href="#" onclick="toggle_visibility('btn-sidenav-sub2')"><i
                    class="zmdi zmdi-chevron-left mr-1"></i>{{isset($staticContent['Medical_Power'])?
                $staticContent['Medical_Power'] :'Medical Power' }}</a>
            @if(isset($navcategories1))
            @foreach ($navcategories1 as $subCate)
            <a class="text-normal pl-3 "
                href="{{route('allproductsByType' ,[ slugifyHead($subCate->url_item),$subCate->sub_pro_id,1])}}">{{$subCate->name}}</a>
            @endforeach
            @endif
        </div>
        <div id="btn-sidenav-sub3" class="btn-sidenav  pad-ar-24px">
            <a class="text-color-delta" tabindex="-1" href="#" onclick="toggle_visibility('btn-sidenav-sub3')"><i
                    class="zmdi zmdi-chevron-left mr-1"></i>{{isset($staticContent['LED_Power']) ?
                $staticContent['LED_Power']
                :'LED Power' }}</a>
            {{-- @foreach ($navcategories3 as $subCate)
            <a class="text-normal pl-3 "
                href="{{route('allproductsByType' ,[ preg_replace('/\s+/', '_', $subCate->url_item),$subCate->sub_pro_id,3])}}">{{$subCate->name}}</a>
            @endforeach --}}
            <a class="text-normal pl-3"
                href="{{route('allproductsByType',[slugifyHead('CC-Cv-Mode'),1 , 3])}}">{{isset($staticContent['CC_Cv_Mode'])
                ? $staticContent['CC_Cv_Mode'] : 'CC Cv Mode' }}</a>

            <a class="text-normal pl-3"
                href="{{route('allproductsByType',[slugifyHead('CC-Mode'),2 ,3])}}">{{isset($staticContent['CC_Mode'])?
                $staticContent['CC_Mode'] :'CC Mode' }}</a>

            <a class="text-normal pl-3"
                href="{{route('allproductsByType',[slugifyHead('CV-Mode'),3 ,3])}}">{{isset($staticContent['CV_Mode'])?
                $staticContent['CV_Mode']: 'CV Mode'}}</a>


        </div>
        <div id="btn-sidenav-sub4" class="btn-sidenav  pad-ar-24px">
            <a class="text-color-delta" tabindex="-1" href="#" onclick="toggle_visibility('btn-sidenav-sub4')"><i
                    class="zmdi zmdi-chevron-left mr-1"></i>{{isset($staticContent['Battery_Charging'])?
                $staticContent['Battery_Charging'] :'Industrial Battery Charging' }}</a>
            @if(isset($navcategories4))
            @foreach ($navcategories4 as $subCate)
            <a class="text-normal pl-3 "
                href="{{route('allproductsByType' ,[ slugifyHead($subCate->url_item),$subCate->sub_pro_id,4])}}">{{$subCate->name}}</a>
            @endforeach
            @endif
        </div>
        {{-- TOOLS --}}
        <div id="btn-sidenav2" class="btn-sidenav pad-ar-24px">
            <a class="text-color-delta" tabindex="-1" href="#" onclick="toggle_visibility('btn-sidenav2')"><i
                    class="zmdi zmdi-chevron-left mr-1"></i>{{isset($staticContent['Tools'])? $staticContent['Tools'] :
                'Tools'}}</a>
            <a class="text-normal pl-3" href="{{route('productFinder')}}">{{isset($staticContent['Product_Selector'])?
                $staticContent['Product_Selector'] :'Product Selector' }}</a>
            <a class="text-normal pl-3"
                href="{{route('configurableproduct')}}">{{isset($staticContent['configurable_power_selector'])?
                $staticContent['configurable_power_selector'] :'configurable power selector' }}</a>
            <a class="text-normal pl-3" href="{{route('productCoparison')}}">
                {{isset($staticContent['product_comparison'])?
                $staticContent['product_comparison'] :'Product Comparison' }}</a>
        </div>
        {{-- APPLICATION --}}
        <div id="btn-sidenav3" class="btn-sidenav pad-ar-24px">
            <a class="text-color-delta" tabindex="-1" href="#" onclick="toggle_visibility('btn-sidenav3')"><i
                    class="zmdi zmdi-chevron-left mr-1"></i> {{isset($staticContent['Tools'])?
                $staticContent['Tools'] :'Tools' }}</a>

            @if(isset($navapplication))
            @foreach ($navapplication as $app)
            <a class="text-normal pl-3"
                href="{{route('appDetail' ,[ 'name' => $app->slug_app , 'id' => $app->applica_id])}}">
                {{$app->name}}</a>
            @endforeach
            @endif
        </div>
        {{-- ABOUT --}}
        {{-- <div id="btn-sidenav4" class="btn-sidenav pad-ar-24px">
            <a class="text-color-delta" tabindex="-1" href="#" onclick="toggle_visibility('btn-sidenav4')"><i
                    class="zmdi zmdi-chevron-left mr-1"></i>{{$staticContent['About']}}</a>
            @foreach ($navaboutus as $abt)
            <a class="text-normal pl-3 " href="{{route('aboutUs',$abt->stug)}}">{{$abt->title}}</a>
            @endforeach

        </div> --}}
        {{-- UPDATES --}}
        <div id="btn-sidenav5" class="btn-sidenav pad-ar-24px">
            <a class="text-color-delta" tabindex="-1" href="#" onclick="toggle_visibility('btn-sidenav5')"><i
                    class="zmdi zmdi-chevron-left mr-1"></i> {{isset($staticContent['Updates'])?
                $staticContent['Updates'] :'updates' }}</a>
            <a class="text-normal pl-3" href="{{route('index','news')}}">
                {{isset($staticContent['Product_News'])?
                $staticContent['Product_News'] :'Product News' }}</a>
            <a class="text-normal pl-3" href="{{route('index','events')}}">{{isset($staticContent['Events'])?
                $staticContent['Events'] :'Events' }}</a>
        </div>
        {{-- DOWNLOADS --}}
        <div id="btn-sidenav6" class="btn-sidenav pad-ar-24px">
            <a class="text-color-delta" tabindex="-1" href="#" onclick="toggle_visibility('btn-sidenav6')"><i
                    class="zmdi zmdi-chevron-left mr-1"></i>{{isset($staticContent['nav_dowloads'])?
                $staticContent['nav_dowloads'] :'dowloads' }}</a>
            <a class="text-normal pl-3" href="{{route('index','catalogs')}}">{{isset($staticContent['catalogs'])?
                $staticContent['catalogs'] :'catalogs' }} </a>
            <a class="text-normal pl-3"
                href="{{route('index','product-documents')}}">{{isset($staticContent['Product_Documents'])?
                $staticContent['Product_Documents'] :'Product Documents' }}</a>
        </div>
        {{-- SUPPORT --}}
        <div id="btn-sidenav7" class="btn-sidenav pad-ar-24px">
            <a class="text-color-delta" tabindex="-1" href="#" onclick="toggle_visibility('btn-sidenav7')"><i
                    class="zmdi zmdi-chevron-left mr-1"></i>{{isset($staticContent['Supports'])?
                $staticContent['Supports'] :'Supports' }}</a>
            <a class="text-normal pl-3" href="{{route('contactSupport')}}">{{isset($staticContent['contact_us'])?
                $staticContent['contact_us'] :'contact_us' }}</a>
            <a class="text-normal pl-3"
                href="{{route('contactSalesOffices')}}">{{isset($staticContent['sales_offices'])?
                $staticContent['sales_offices'] :'sales_offices' }}</a>
            <a class="text-normal pl-3"
                href="{{route('contactFindDistributor')}}">{{isset($staticContent['find_a_distributor'])?
                $staticContent['find_a_distributor'] :'find_a_distributor' }}</a>
            <a class="text-normal pl-3" href="{{route('index','faqs')}}">{{isset($staticContent['FAQs'])?
                $staticContent['FAQs'] :'FAQs' }}</a>
        </div>
        {{-- <a href="javascript:void(0)" class="closebtn" onclick="closeNav()"><img
                src="{{asset('frontend-asset/image/close-white.svg')}}" alt=""></a> --}}
        <div class="bg-backslidenav" id="bg-backslidenav" onclick="closeNav();">
        </div>
    </div>

    <div class="nav-comparison-mobile " id="nav-comparison-mobile" style="display: none;">
        <div class="container d-flex justify-content-between align-items-stretch">
            <div class="my-auto">
                <h5>(<span id="numberselect-mobile"></span>/3) {{isset($staticContent['Item(s)_selected'])?
                    $staticContent['Item(s)_selected'] :'Item(s)_selected' }}</h5>
                <a class="text-two text-color-gray" id="editList"
                    onclick="showListCoparison()">{{isset($staticContent['Edit_List'])?
                    $staticContent['Edit_List'] :'Edit_List' }}</a>
            </div>
            <a href="{{route('productCoparison')}}"
                class="btn btn-subscribe to-comparison">{{isset($staticContent['View_compare'])?
                $staticContent['View_compare'] :'View_compare' }}</a>
        </div>
        <div class="container" id="listAllcomparesesion-mobile">
            {{--
            <div class="list-to-comparison-mobile d-flex justify-content-between ">
                <div class="list-to-comparison-text mr-5">
                    <p class="mb-0 text-to-comparison text-uppercase">AA</p>
                    <h6 class="mt-0 mb-0 text-color-delta">CCC</h6>
                </div>
                <div class="delete-to-comparison" onclick="deleteComparison('+value['pro_id']+');"> <i
                        class="zmdi zmdi-close"></i></div>
            </div> --}}
        </div>
        <div class="d-flex text-center my-3">
            <a class="btn btn-boxen" onclick="hideListCoparison()">Done</a>
        </div>
    </div>
</div>


<div class="container">
    <a id="scrollUp"></a>

    {{-- <button onclick="topFunction()" id="scrollTop" title="Go to top"></button>
    <p id="text-scrollTop">Go to Top</p> --}}
</div>

<div id="modalCompareSection" class="modal" tabindex="-1" role="dialog" style="display:none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Alert</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="alertcomparetext"></p>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
<div class="visible-tablets-up">
    <ul id="distributor" class="img-pop-destop">
        <li>
            <a href="{{route('contactSupport')}}" class="skype">
                <i class="demo-icon-destop icon-facon3 icon-question"></i>
                <?php
                $Sales_Inquiry = 'Sales Inquiry';
                 if(isset($staticContent['Sales_Inquiry'])){
                    $Sales_Inquiry = $staticContent['Sales_Inquiry'];
                 }
                ?>
                @if(
                App::getLocale() == "cn" && strtolower(str_replace(' ', '', $Sales_Inquiry)) != 'Sales Inquiry'
                || App::getLocale() == "tw" && strtolower(str_replace(' ', '', $Sales_Inquiry)) != 'Sales Inquiry')
                <span class="vertical-text">
                    {{$Sales_Inquiry}}
                </span>
                @else
                <span>
                    {{$Sales_Inquiry}}
                </span>

                @endif


            </a>
        </li>
    </ul>
</div>
<div class="visible-mobile">
    <ul id="distributor" class="img-pop">
        <li>
            <a href="{{route('contactSupport')}}" class="skype"><span>
                    {{isset($staticContent['Sales_Inquiry'])? $staticContent['Sales_Inquiry'] :'Sales Inquiry' }}</span>
                {{-- <i class="demo-icon icon-facon icon-find-dis-blue"></i> --}}
                <i class="demo-icon icon-facon3 icon-question"></i>
                {{-- <img class="icon-sales-inquiry-mobile" src="{{asset('frontend-asset/image/question.webp')}}" />
                --}}
            </a>
        </li>
    </ul>
</div>


<div class="modal fade p-1" id="downloadgui-modal" tabindex="-1" role="dialog" aria-labelledby="subscribe-modal-title"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content ">
            <div class="modal-header pl-4">
                <h4 class="text-color-delta mb-0" id="subscribe-modal-title">Download</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="submitGuiDownload" onsubmit="return validateFormGUI(this)" action="{{route('downloadGui')}}"
                method="POST">
                <div class="modal-body px-4 mb-4">

                    {{csrf_field()}}
                    <img class="brand-image my-3" src="{{asset('frontend-asset/image/DeltaPSU-Logo.svg')}}">
                    <div class="input-label w-100 my-4">
                        <h6 class="mb-0"><label class="text-dark">Firstname, Lastname<span class="red">*</span></label>
                        </h6>
                        <input type="text" class="form-control" name="name_gui" pattern="[A-Za-zก-๏\s]+"
                            placeholder="Name" required>
                    </div>
                    <div class="input-label w-100 my-4">
                        <h6 class="mb-0"><label class="text-dark">{{isset($staticContent['Company'])?
                                $staticContent['Company'] :'Company' }}<span class="red">*</span></label>
                        </h6>
                        <input type="text" class="form-control" name="company_gui" pattern="[A-Za-zก-๏\s().]+"
                            placeholder="{{isset($staticContent['Company'])?
              $staticContent['Company'] :'Company' }}" required>
                    </div>
                    <div class="input-label w-100 my-4">
                        <h6 class="mb-0"><label class="text-dark">{{isset($staticContent['Email_Address'])?
                                $staticContent['Email_Address'] :'Email Address' }}<span class="red">*</span></label>
                        </h6>
                        <input type="email" class="form-control" name="email_gui" placeholder="Email Address" required>
                        {{-- <label for="email">Email Address</label> --}}
                    </div>
                    <input type="hidden" name="fileguidownload" id="fileguidownload">
                    <input type="hidden" name="procodeGui" id="procodeGui">
                    <input type="hidden" name="procateGui" id="procateGui">
                    <div class="input-label w-100 my-4">
                        <h6 class="mb-0"><label class="text-dark">{{isset($staticContent['Phone_Number'])?
                                $staticContent['Phone_Number'] :'Phone Number' }}<span class="red">*</span></label></h6>

                        <input type="tel" class="form-control tel-not-req" name="tel" pattern="^[0-9]*$" maxlength="13"
                            title="Incorrect Format Number only" placeholder="{{isset($staticContent['Phone_Number'])?
              $staticContent['Phone_Number'] :'Phone Number' }}" required>
                    </div>
                    <div class="select input-label w-100 my-4">
                        <h6 class="mb-0"><label class="text-dark">{{isset($staticContent['Country'])?
                                $staticContent['Country'] :'Country' }}<span class="red">*</span></label>
                        </h6>
                        <select name="country" class="form-control" required>
                            <option value="">{{isset($staticContent['Select'])?
                                $staticContent['Select'] :'Select' }} {{isset($staticContent['Country'])?
                                $staticContent['Country'] :'Country' }}</option>
                            @if(isset($countryemails))
                            @foreach ($countryemails as $email)
                            <option value="{{$email->country}}">{{$email->country}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="box-input-checkbox">
                        <input class="inp-cbx" name="acceptPolicyGui" id="acceptPolicyGui" value="1" type="checkbox"
                            style="display: none;" />
                        <label class="cbx" for="acceptPolicyGui"><span>
                                <svg width="12px" height="10px" viewbox="0 0 12 10">
                                    <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                </svg></span><span style="padding-left:9px;">
                                {{isset($staticContent['By_submitting_this_form'])?
                                $staticContent['By_submitting_this_form'] :'By_submitting_this_form' }} <a
                                    target="_blank" href="{{route('privacyPolicy')}}"
                                    class=" text-underline">{{isset($staticContent['Privacy_Policy'])?
                                    $staticContent['Privacy_Policy'] :'Privacy_Policy' }}</a><text
                                    class="red">*</text></span>
                        </label>
                    </div>
                    <div class="box-input-checkbox">
                        <input class="inp-cbx" name="data_conf" id="cxguiup" value="1" type="checkbox"
                            style="display: none;" />
                        <label class="cbx" for="cxguiup"><span>
                                <svg width="12px" height="10px" viewbox="0 0 12 10">
                                    <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                </svg></span><span>{{isset($staticContent['Sign_up_for_newsletter'])?
                                $staticContent['Sign_up_for_newsletter'] :'Sign_up_for_newsletter' }}</span></label>
                    </div>
                    <form action="?" method="POST">
                        <div class="mt-4" id="recap_vertifygetGui"></div>
                        <br>
                    </form>
                    <input type="hidden" id="keyrecapgui" name="keyresponseCap">


                    <button type="submit" class="btn btn-subscribe">Download</button>
                </div>
            </form>

        </div>
    </div>
</div>

<div class="modal fade p-1" id="downloadgui-modal-success" tabindex="-1" role="dialog"
    aria-labelledby="subscribe-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content ">
            <div class="modal-header pl-4">
                <h4 class="text-color-delta mb-0" id="subscribe-modal-title1">Download</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-4 mb-4">
                <input type="hidden" name="fileguidownload" id="fileguidownload">
                <div class="text-center">
                    <h4 class="text-color-delta">Thank You</h4>
                    <p>Click the link below to download the file.</p>
                </div>
                <div class="text-center" style="word-break: break-all;" id='linkdownloadsuc'></div>
            </div>


        </div>
    </div>
</div>


<div class="modal fade p-1" id="downloadgui-modal-failures" tabindex="-1" role="dialog"
    aria-labelledby="subscribe-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content ">
            <div class="modal-header pl-4">
                <h4 class="text-color-delta mb-0" id="subscribe-modal-title2">Error Message</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-4 mb-4">
                <div class="text-center">
                    <h4 class="text-color-delta">Sorry, Can't send email</h4>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade p-1" id="downloadgui-modal-vetify-robot" tabindex="-1" role="dialog"
    aria-labelledby="subscribe-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content ">
            <div class="modal-header pl-4">
                <h4 class="text-color-delta mb-0" id="subscribe-modal-title2">Error Message</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-4 mb-4">
                <div class="text-center">
                    <h4 class="text-color-delta">Please verify you are not a robot</h4>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade p-1" id="Support_Frorm_required" tabindex="-1" role="dialog"
    aria-labelledby="subscribe-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content ">
            <div class="modal-header pl-4">
                <h4 class="text-color-delta mb-0" id="subscribe-modal-title2">Error Message</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-4 mb-4">
                <div class="text-center">
                    <h4 class="text-color-delta">Sorry, Please Fill Required Input</h4>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade p-1" id="Support_policy_required" tabindex="-1" role="dialog"
    aria-labelledby="subscribe-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content ">
            <div class="modal-header pl-4">
                <h4 class="text-color-delta mb-0" id="subscribe-modal-title2">Error Message</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-4 mb-4">
                <div class="text-center">
                    <h4 class="text-color-delta">Please accept Privacy Policy checkbox to continue</h4>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="modal fade p-1" id="downloadgui-modal-failures-Api" tabindex="-1" role="dialog"
    aria-labelledby="subscribe-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content ">
            <div class="modal-header pl-4">
                <h4 class="text-color-delta mb-0" id="subscribe-modal-title2">Error Message</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-4 mb-4">
                <div class="text-center">
                    <h5 class="text-color-delta">Sorry, Can't send email,There are something error on data</h5>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade p-1" id="success_email_send" tabindex="-1" role="dialog" aria-labelledby="subscribe-modal-title"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content ">
            <div class="modal-header pl-4">
                <h4 class="text-color-delta mb-0" id="subscribe-modal-title2">Message</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-4 mb-4">
                <div class="text-center">
                    <h5 class="text-color-delta">{{isset($staticContent['support_form_text'])?
                        $staticContent['support_form_text']:''}}</h5>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade p-1" id="success_subscribe" tabindex="-1" role="dialog" aria-labelledby="subscribe-modal-title"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content ">
            <div class="modal-header pl-4">
                <h4 class="text-color-delta mb-0" id="subscribe-modal-title2">Message</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-4 mb-4">
                <div class="text-center">
                    <h4 class="text-color-delta">Please confirm subscription in your email.</h4>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade p-1" id="success_subscribe_already" tabindex="-1" role="dialog"
    aria-labelledby="subscribe-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content ">
            <div class="modal-header pl-4">
                <h4 class="text-color-delta mb-0" id="subscribe-modal-title2">Message</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-4 mb-4">
                <div class="text-center">
                    <h4 class="text-color-delta">You are already subscribed to our newsletter</h4>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade p-1" id="sendpfdtome" tabindex="-1" role="dialog" aria-labelledby="subscribe-modal-title"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content ">
            <div class="modal-header pl-4">
                <h4 class="text-color-delta mb-0" id="subscribe-modal-title1">Configurable Power PDF Download</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-4 mb-4">
                <input type="hidden" name="fileguidownload" id="fileguidownload">
                <div class="text-center">
                    <h4 class="text-color-delta">Thank You</h4>
                    <p>Get your files as below link </p>
                    <p>Dowload link</p>

                </div>
                <div class="text-center" id='linkdownloadconfigPdf'></div>
            </div>


        </div>
    </div>
</div>


<div class="modal fade p-1" id="sendConfigpdf" tabindex="-1" role="dialog" aria-labelledby="subscribe-modal-title"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content ">
            <div class="modal-header pl-4">
                <h4 class="text-color-delta mb-0" id="subscribe-modal-title1">Message</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-4 mb-4">
                <input type="hidden" name="fileguidownload" id="fileguidownload">
                <div class="text-center">
                    <h4 class="text-color-delta">
                        Thank you for the interest in our power supplies, <br>
                        please check your email for the configuration summary.
                    </h4>
                </div>
                <div class="text-center" id='linkdownloadconfigPdf'></div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade p-1" id="downloadgui-vertifynot-robot" tabindex="-1" role="dialog"
    aria-labelledby="subscribe-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content ">
            <div class="modal-header pl-4">
                <h4 class="text-color-delta mb-0" id="subscribe-modal-title2">Error Message</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-4 mb-4">
                <div class="text-center">
                    <h4 class="text-color-delta">Please verify you are not a robot </h4>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade p-1" id="notfound_product" tabindex="-1" role="dialog" aria-labelledby="subscribe-modal-title"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content ">
            <div class="modal-header pl-4">
                <h4 class="text-color-delta mb-0" id="subscribe-modal-title2">Message</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-4 mb-4">
                <div class="text-center">
                    <h4 class="text-color-delta">Data not found.</h4>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade p-1" id="acceptCookieContent" tabindex="-1" role="dialog" aria-labelledby="subscribe-modal-title"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content ">
            <div class="modal-header pl-4">
                <h4 class="text-color-delta mb-0" id="subscribe-modal-title2">Message</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-4 mb-4">
                <div class="text-center">
                    <h4 class="text-color-delta">Please acccept Cookie Consent Policy on This website</h4>
                </div>
            </div>
        </div>
    </div>
</div>