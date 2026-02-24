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
        background-image: url('{{asset('frontend-asset/image/arrow.svg')}}');
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
        margin-top: 6px;
        margin-right: 5px;
        color: #444444;
        font-size: 22px;
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
        width: 25px;
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
        -moz-transform: translateY(9px) rotate(45deg);
        -ms-transform: translateY(9px) rotate(45deg);
        -webkit-transform: translateY(9px) rotate(45deg);
        transform: translateY(9px) rotate(45deg);
    }

    .menu-buger.active .bar:nth-of-type(2) {
        opacity: 0;
    }

    .menu-buger.active .bar:nth-of-type(3) {
        -moz-transform: translateY(-7px) rotate(-45deg);
        -ms-transform: translateY(-7px) rotate(-45deg);
        -webkit-transform: translateY(-7px) rotate(-45deg);
        transform: translateY(-7px) rotate(-45deg);
    }

    /* Power Supplies link - aligned with navbar-brand bottom */
    .power-supplies-link {
        position: absolute;
        left: 226px; /* logo位置 + logo寬度 + 26px間距 */
        /* top: 16px; */
        color: #000000;
        text-decoration: none;
        font-weight: bold;
        font-size: 18px;
        z-index: 5;
        line-height: 1;
        padding-top: 30px;
    }

    .power-supplies-link:hover {
        color: #6c757d;
        text-decoration: none;
    }

    .power-supplies-link:has(br) {
        padding-top: 16px;
    }

    html[html_lang="de"] .power-supplies-link {
        padding-top: 35px;
    }

    html[lang="zh"] .power-supplies-link {
        padding-top: 31px;
    }

    html[html_lang="jp"] .power-supplies-link {
        padding-top: 32px;
    }

    html[lang="zh"] .navbar-expand-lg .navbar-nav .nav-link {
        padding:11px 12px 0px 12px;
    }

    html[html_lang="jp"] .navbar-expand-lg .navbar-nav .nav-link {
        padding:11px 7px 0px 7px;
    }
    
    /* Override original mr-center-nav - keep it centered with constraints */
    .mr-center-nav {
        margin: 0 auto !important; /* 保持置中 */
        width: fit-content !important; /* 只佔用需要的寬度 */
        position: relative !important;
        left: 200px; /* 稍微向右偏移，平衡logo和Power Supplies的空間 */
    }

    /* Make search icon larger and align automatically */
    .nav-search {
        top: auto !important; /* 讓它自動對齊 */
    }
    
    .nav-search .fa-search {
        font-size: 22px;
    }

    /* Ensure nav-link-list is the positioning context */
    .nav-link-list {
        position: relative !important;
    }

    /* Power Supplies link for mobile/tablet - align to bottom of nav-link-list */
    .power-supplies-link-mobile {
        color: #444444;
        text-decoration: none;
        font-weight: bold;
        font-size: 12px;
        white-space: nowrap;
        position: absolute;
        /* left: calc(50% + 75px); logo 中心 + logo 寬度一半 + 一點距離 */
        bottom: 0; /* 貼齊 nav-link-list 底部 */
        padding-left: 12px;
        line-height: 12px;
    }

    .power-supplies-link-mobile:hover {
        color: #6c757d;
        text-decoration: none;
    }

    @media (max-width: 1366px) {
        .mr-center-nav {
            left: 150px; /* 調整偏移量以適應較小螢幕 */
        }
    }

    @media (max-width: 1024px) {
        .power-supplies-link-mobile {
            margin-left: -80px;
            bottom: 1px;
        }

        /* .justify-content-left-1024 {
            justify-content: left !important;
        } */
        .nav-div-header {
            max-width: 960px;
            margin-left: auto;
            margin-right: auto;
        }

        /* .visible-nav-minimize .brand-image{
            width: auto;
        } */
    }

    @media (max-width: 1000px) {
        .power-supplies-link-mobile {
            margin-left: -50px;
            bottom: 1px;
        }

        /* .visible-nav-minimize .brand-image{
            width: 100%;
        } */

        /* .justify-content-left-1024 {
            justify-content: left !important;
        } */
    }

    @media (min-width: 768px) and (max-width: 992px) {
        .nav-div-header {
            max-width: 720px;
        }
    }

    @media (max-width: 768px) {
        .power-supplies-link-mobile {
            margin-left: -35px;
            bottom: 5px;
        }
    }

    @media (max-width: 650px) {
        .power-supplies-link-mobile {
            padding-left: 0px;
            margin-left: -5px;
            bottom: 5px;
        }
    }

    /* Responsive font size for small screens */
    @media (max-width: 455px) {
        .power-supplies-link-mobile {
            font-size: 14px;
        }
        .power-supplies-link-mobile {
            padding-left: 12px;
            margin-left: 0px;
            bottom: 6px;
        }

        html[lang="ja"] .power-supplies-link-mobile,
        html[lang="zh"] .power-supplies-link-mobile {
            bottom: 8px;
        }
    }

    /* Responsive font size for small screens */
    @media (max-width: 375px) {
        .power-supplies-link-mobile {
            font-size: 12px;
            bottom: 5px;
        }
    }

    @media (max-width: 320px) {
        .power-supplies-link-mobile {
            font-size: 12px;
            bottom: 6px;
        }
    }

    /* Remove original header bar line */
    .header-bar-line {
        border-bottom: none !important;
    }

    .header-bar-line::before,
    .header-bar-line::after {
        display: none !important;
    }

    /* New header color bar */
    .header-color-bar {
        height: 7px;
        background-color: #64d7d7;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        width: 100%;
        z-index: 1032; /* 比 nav-firts 的 1031 高 */
    }

    /* Push nav-firts down */
    .nav-firts {
        top: 5px !important; /* 往下推 7px */
    }

    /* Header color bar for both desktop and mobile */
    .header-color-bar,
    .header-color-bar-mobile {
        height: 5px;
        background-color: #64d7d7;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        width: 100%;
        z-index: 1032;
    }

    .header-color-bar-mobile {
        height: 3px;
    }
    .header-color-bar::before,
    .header-color-bar-mobile::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        width: 60%;
        height: 100%;
        background-color: #0087dc;
    }

    .header-color-bar::after,
    .header-color-bar-mobile::after {
        content: '';
        position: absolute;
        right: 0;
        top: 0;
        width: 20%;
        height: 100%;
        background-color: #b9eb5f;
    }

    .header-shadow{
        box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow) !important;
        --tw-shadow: 0px 4px 8px 0px rgba(0, 0, 0, 0.10) !important;
    }

    /* Push nav-mobile down and remove original color bar */
    .nav-mobile {
        margin-top: 3px !important;
        border-bottom: none !important;
    }

    .nav-mobile::before,
    .nav-mobile::after {
        display: none !important;
    }


    .font-size-tab {
        color: #0087DC !important;
    }

    .cur-link {
        cursor: pointer;
    }

    .img-icon-golang {
        height: 22px;
        margin-top: -2px;
    }

    html[lang="zh"] .img-icon-golang,
    html[lang="ja"] .img-icon-golang {
        margin-top: -4px;
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
    .dropdown-submenu > .dropdown-menu {
        display: block;
        visibility: hidden;
        opacity: 0;
        transition: all 0.1s ease;
        transition-delay: 0.4s;
    }
    .dropdown-submenu:not(.news-submenu):hover > .dropdown-menu {
        visibility: visible;
        opacity: 1;
        transition-delay: 0s;
    }
    .dropdown-submenu.show > .dropdown-menu {
        visibility: visible;
        opacity: 1;
        transition-delay: 0s;
    }
</style>

<div class="invisible-nav-minimize">
    <div class="header-color-bar"></div>
    
    <div class="nav-firts ">
        <div class="alert-browser" id="alert-browser-check" style="display: none;">
            <div class="color-yellow">
                We recommend using the latest version of Chrome, Firefox or Safari.
            </div>
        </div>
        <div class="container container-gap-nav">
            @if(session('partner_id') == null)
            <a class="d-flex" href="{{route('index','login')}}">
                {{-- <img class="mr-1" src="{{asset('frontend-asset/image/person-login.svg')}}" alt=""> --}}
                <div class="link-nav-first">
                    {{isset($staticContent['Login']) ? $staticContent['Login'] : ''}}
                </div>
            </a> 
            {{-- <span class="fs-front">|</span> --}}
            @else
            <a class="pad-logout fs-front" href="{{route('index','login')}}">
                <img src="{{asset('frontend-asset/image/person-login.svg')}}" alt="" style="height: 22px;padding-bottom: 3px;">{{session('partner_firstname')}}
            </a>
            <span class="fs-front">/</span> 
            <a href="{{route('index','logoutfrontend')}}" class="pad-logout fs-front">
                {{isset($staticContent['Logout']) ? $staticContent['Logout'] : 'Logout'}}
            </a>
            {{-- <span class="fs-front">|</span> --}}
            @endif
            <a class="d-flex" onclick="subscribe()" data-toggle="modal" data-target="#subscribe-modal">
                {{-- <img class="mr-1" src="{{asset('frontend-asset/image/sub-new.svg')}}" alt=""> --}}
                <div class="link-nav-first">
                    {{isset($staticContent['Subscribe']) ? $staticContent['Subscribe']:'' }}
                </div>
            </a>
            {{-- <span class="fs-front">|</span> --}}
            <a class="d-flex" href="{{route('contactSupport')}}">
                {{-- <img src="{{asset('frontend-asset/image/question.webp')}}" alt="" class="mr-2 icon-img-menu-top"> --}}
                <div class="link-nav-first">
                    {{isset($staticContent['Sales_Inquiry'])? $staticContent['Sales_Inquiry'] :'Sales Inquiry' }}
                </div>
            </a>
            {{-- <span class="fs-front">|</span> --}}
            
            

        </div>

    </div>

    <div class="nav-position des-scrolled nav-underline">
        <div class="container nav-here">
            <a class="navbar-brand" href="{{ $logoUrl }}">
                <img class="brand-image mt-1" src="{{asset('frontend-asset/image/DeltaPSU-Logo.svg')}}">
            </a>
            {{-- <a href="/" class="power-supplies-link">{{ $staticContent['Standard_Power_Supplies'] }}</a> --}}
            <a href="/" class="power-supplies-link">
                {!! preg_replace('/\s+/', '<br>', (isset($staticContent['Standard_Power_Supplies']) ? $staticContent['Standard_Power_Supplies'] : 'Standard Power Supplies'), 1) !!}
            </a>

            <div class="nav-search" style="display: flex;gap: 16px;">
                <a class="nav-link" id="dropdown08" style="padding-top: 1px;">
                    <div class="nav-search-btn"> 
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M21 21L16.1667 16.1667M18.7778 9.88889C18.7778 14.7981 14.7981 18.7778 9.88889 18.7778C4.97969 18.7778 1 14.7981 1 9.88889C1 4.97969 4.97969 1 9.88889 1C14.7981 1 18.7778 4.97969 18.7778 9.88889Z" stroke="#646464" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                        {{-- {{isset($staticContent['Search'])?$staticContent['Search'] :''}} --}}
                        {{-- <i class="fa fa-search"></i> --}}
                    </div>
                </a>
                <div class="dropdown" style="cursor: pointer;">
                    <a class="dropdown-toggle cur-lang-new-g" data-toggle="dropdown">
                        {{-- <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M21 11C21 16.5228 16.5228 21 11 21M21 11C21 5.47715 16.5228 1 11 1M21 11H1M11 21C5.47715 21 1 16.5228 1 11M11 21C13.5013 18.2616 14.9228 14.708 15 11C14.9228 7.29203 13.5013 3.73835 11 1M11 21C8.49872 18.2616 7.07725 14.708 7 11C7.07725 7.29203 8.49872 3.73835 11 1M1 11C1 5.47715 5.47715 1 11 1" stroke="#646464" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg> --}}
                        <img class="img-icon-golang" src="{{asset('frontend-asset/image/icon/Global.svg')}}">
                    </a>
                    <ul class="dropdown-menu">
                        {{-- <li><a href="https://www.deltapsu.com">Global</a></li>
                        <li><a href="https://www.deltapsu.cn" target="_blank">China - 简体中文</a></li> --}}
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

                            <li>
                                <a href="javascript:void(0);" onclick="clickLangLocationmobile('{{ LaravelLocalization::getLocalizedURL($current, null, [], true) }}');">
                                    @if($current == 'cn')
                                        简中
                                    @elseif($current == 'tw')
                                        繁中
                                    @else
                                        {{strtoupper($current) }}
                                    @endif
                                </a>
                            </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
            
        </div>
        <div id="search-box" class="search-box" style="display:none;">
            <div class="nav-btn-search">
                <div class="border-nav-topsearch">
                    <div class="box-search">
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M21 21L16.1667 16.1667M18.7778 9.88889C18.7778 14.7981 14.7981 18.7778 9.88889 18.7778C4.97969 18.7778 1 14.7981 1 9.88889C1 4.97969 4.97969 1 9.88889 1C14.7981 1 18.7778 4.97969 18.7778 9.88889Z" stroke="#646464" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                        {{-- <i class="fa fa-search"></i> --}}
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
                <span class="navbar-toggler-icon"></span>
            </button>

            {{-- 桌機版header --}}
            <div class="collapse navbar-collapse header-bar-line" id="navbar">
                <ul id="nav-all" class="navbar-nav mr-center-nav ul-nav-inner">
                    {{-- Products --}}
                    <li class="nav-item dropdown">
                        <a id="nav-uderline" class="nav-link" id="dropdown01" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            {{ isset($staticContent['Products']) ? $staticContent['Products'] : 'Products' }}
                            {{-- <i class="zmdi zmdi-chevron-down"></i> --}}
                        </a>
                        <div class="dropdown-menu s-menu sp-dropdown" role="menu" aria-labelledby="dropdown01">
                            {{-- 全部商品列表（Products_Overview）--}}
                            <div class="dropdown-submenu">
                                <a class="" href="{{ route('allproduct') }}">
                                    {{ isset($staticContent['Products_Overview']) ? $staticContent['Products_Overview'] : 'Products Overview' }}
                                </a>
                            </div>
                            {{-- Sub1 工業電源及模組（Industrial_Power）--}}
                            <div class="dropdown-submenu">
                                <a id="sub1" class="sub-menu dropdown-item" onmouseover="mainCate('sub1')" tabindex="-1" href="{{ (isset($navcategories2) && count($navcategories2) > 0) ? route('productList', [$navcategories2->first()->main_cateid]) : '#' }}">
                                    {{ isset($staticContent['Industrial_Power']) ? $staticContent['Industrial_Power'] : 'Industrial Power' }}
                                    <i class="zmdi zmdi-chevron-right"></i>
                                </a>
                                <ul class="dropdown-menu drp-subthree">
                                    {{-- 檢查是否有 Industrial Power 的子分類資料 ($navcategories2) --}}
                                    @if(isset($navcategories2))
                                    @foreach ($navcategories2 as $subCate)
                                        {{-- 根據 main_cateid 判斷要顯示哪種類型的圖片 (image_type1, image_type2, image_type3 或 image) --}}
                                        {{-- onmouseover="bigImg(...)" 用於滑鼠懸停時切換右側預覽圖 --}}
                                        @php($navcategories2Href = route('productList' ,[$subCate->main_cateid, slugifyHead($subCate->url_item), $subCate->sub_pro_id]))
                                        @if($subCate->main_cateid == 1)
                                        <li>
                                            <a tabindex="-1" class="" onmouseover="bigImg('{{$subCate->image_type1}}', 2)"
                                                href="{{$navcategories2Href}}">{{$subCate->name}}
                                            </a>
                                        </li>
                                        @elseif($subCate->main_cateid == 2)
                                        <li>
                                            <a tabindex="-1" class="" onmouseover="bigImg('{{$subCate->image_type2}}', 2)"
                                                href="{{$navcategories2Href}}">{{$subCate->name}}
                                            </a>
                                        </li>
                                        @elseif($subCate->main_cateid == 3)
                                        <li>
                                            <a tabindex="-1" class="" onmouseover="bigImg('{{$subCate->image_type3}}', 2)"
                                                href="{{$navcategories2Href}}">{{$subCate->name}}
                                            </a>
                                        </li>
                                        @else
                                        <li>
                                            <a tabindex="-1" class="" onmouseover="bigImg('{{$subCate->image}}', 2)"
                                                href="{{$navcategories2Href}}">{{$subCate->name}}
                                            </a>
                                        </li>
                                        @endif
                                    @endforeach
                                    @endif
                                    
                                    {{-- 下拉選單底部的預設圖片區塊 --}}
                                    <div class="image-dropdown d-flex justify-content-center "
                                        style="background: linear-gradient(to bottom, #fff, transparent, transparent),url('{{asset('frontend-asset/image/Dropdown.jpg')}}')no-repeat;">
                                        {{-- 預設顯示 Industrial Power Supplies 的圖片 --}}
                                        <img class="imageNav2 img-hove-on-dropdown lazyload" loading="lazy"
                                            data-src="{{asset('frontend-asset/image/Industrial_Power_Supplies.png')}}"
                                            alt="Industrial_Power_Supplies.png">
                                    </div>
                                </ul>
                            </div>

                            {{-- Sub2 醫療電源（Medical Power Supplies）--}}
                            <div class="dropdown-submenu">
                                <a id="sub2" class="sub-menu" onmouseover="mainCate('sub2')" tabindex="-1" href="{{ (isset($navcategories1) && count($navcategories1) > 0) ? route('productList', [$navcategories1->first()->main_cateid]) : '#' }}">
                                    {{ isset($staticContent['Medical_Power']) ? $staticContent['Medical_Power'] :'Medical Power' }} 
                                    <i class="zmdi zmdi-chevron-right"></i>
                                </a>
                                <ul class="dropdown-menu drp-subthree">
                                    @if(isset($navcategories1))
                                    @foreach ($navcategories1 as $subCate)
                                    @php($navcategories1Href = route('productList' ,[$subCate->main_cateid, slugifyHead($subCate->url_item),$subCate->sub_pro_id]))
                                    @if($subCate->main_cateid == 1)
                                    <li><a tabindex="-1" class="" onmouseover="bigImg('{{$subCate->image_type1}}',1)"
                                            href="{{$navcategories1Href}}">{{$subCate->name}}
                                        </a>
                                    </li>
                                    @elseif($subCate->main_cateid == 2)
                                    <li><a tabindex="-1" class="" onmouseover="bigImg('{{$subCate->image_type2}}',1)"
                                            href="{{$navcategories1Href}}">{{$subCate->name}}
                                        </a>
                                    </li>
                                    @elseif($subCate->main_cateid == 3)
                                    <li><a tabindex="-1" class="" onmouseover="bigImg('{{$subCate->image_type3}}',1)"
                                            href="{{$navcategories1Href}}">{{$subCate->name}}
                                        </a>
                                    </li>
                                    @else
                                    <li><a tabindex="-1" class="" onmouseover="bigImg('{{$subCate->image}}',1)"
                                            href="{{$navcategories1Href}}">{{$subCate->name}}
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

                            {{-- 可配置式電源（Configurable Power--}}
                            <div class="dropdown-submenu">
                                <a class="" href="{{ route('configurableproduct') }}">
                                    {{ isset($staticContent['Configurable_Power']) ? $staticContent['Configurable_Power'] : 'Configurable Power' }}
                                </a>
                            </div>

                            {{-- Sub4 工業電池充電器（Industrial_Battery_Charging）--}}
                            <div class="dropdown-submenu">
                                @if(isset($navcategories4) && count($navcategories4) > 0 )
                                <a id="sub4" class="sub-menu dropdown-item " onmouseover="mainCate('sub4')" tabindex="-1"
                                    href="{{ route('productList', [$navcategories4->first()->main_cateid]) }}">{{ isset($staticContent['wireless_charging'])?
                                    $staticContent['wireless_charging'] :'Industrial Battery Charging' }} <i
                                        class="zmdi zmdi-chevron-right"></i></a>
                                @endif
                                <ul class="dropdown-menu drp-subthree">
                                    @if(isset($navcategories4))
                                    @foreach ($navcategories4 as $subCate)
                                    @php($navcategories4Href = route('productList' ,[$subCate->main_cateid, preg_replace('/\s+/', '-', $subCate->url_item),$subCate->sub_pro_id]))
                                    @if($subCate->main_cateid == 1)
                                    <li><a tabindex="-1" class="" onmouseover="bigImg('{{$subCate->image_type1}}',4)"
                                            href="{{$navcategories4Href}}">{{$subCate->name}}
                                        </a>
                                    </li>
                                    @elseif($subCate->main_cateid == 2)
                                    <li><a tabindex="-1" class="" onmouseover="bigImg('{{$subCate->image_type2}}',4)"
                                            href="{{$navcategories4Href}}">{{$subCate->name}}
                                        </a>
                                    </li>
                                    @elseif($subCate->main_cateid == 3)
                                    <li><a tabindex="-1" class="" onmouseover="bigImg('{{$subCate->image_type3}}',4)"
                                            href="{{$navcategories4Href}}">{{$subCate->name}}
                                        </a>
                                    </li>
                                    @elseif($subCate->main_cateid == 4)
                                    <li><a tabindex="-1" class="" onmouseover="bigImg('{{$subCate->image}}',4)"
                                            href="{{$navcategories4Href}}">{{$subCate->name}}
                                        </a>
                                    </li>
                                    @else
                                    <li><a tabindex="-1" class="" onmouseover="bigImg('{{$subCate->image}}',4)"
                                            href="{{$navcategories4Href}}">{{$subCate->name}}
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

                            {{-- Sub3 LED電源（LED Driver）--}}
                            <div class="dropdown-submenu">
                                <a id="sub3" class="sub-menu" onmouseover="mainCate('sub3')" tabindex="-1"
                                    href="{{ (isset($navcategories3) && count($navcategories3) > 0) ? route('productList', [$navcategories3->first()->main_cateid]) : '#' }}">{{isset($staticContent['LED_Power'])?
                                    $staticContent['LED_Power'] :'LED Driver' }} <i
                                        class="zmdi zmdi-chevron-right"></i></a>
                                <ul class="dropdown-menu drp-subthree">
                                    <li><a tabindex="-1" class="text-c"
                                            href="{{route('productList',[3, slugifyHead('CC-Cv-Mode'),1])}}">{{isset($staticContent['CC_Cv_Mode'])?
                                            $staticContent['CC_Cv_Mode'] :'CC + CV Mode' }}</a>
                                    </li>
                                    <li><a tabindex="-1" class="text-c"
                                            href="{{route('productList',[3, slugifyHead('CC-Mode'),2])}}">{{isset($staticContent['CC_Mode'])?
                                            $staticContent['CC_Mode'] :'CC Mode' }}</a>
                                    </li>
                                    <li><a tabindex="-1" class="text-c"
                                            href="{{route('productList',[3, slugifyHead('CV_Mode'),3])}}">{{isset($staticContent['CV_Mode'])?
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
                        </div>
                    </li>

                    {{-- Applications (應用領域選單) --}}
                    <li class="nav-item dropdown ">
                        {{-- Applications 主連結 --}}
                        <a id="nav-uderline" class="nav-link " href="" id="dropdown03" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            {{ isset($staticContent['Applications']) ? $staticContent['Applications'] : 'Applications' }} 
                            {{-- <i class="zmdi zmdi-chevron-down"></i> --}}
                        </a>
                        <div class="dropdown-menu s-menu" role="menu" aria-labelledby="dropdown03">
                            {{-- 迴圈顯示所有應用領域 --}}
                            @if(isset($navapplication))
                            @foreach ($navapplication as $app)
                            <a class="dropdown-item"
                                href="{{route('appDetail' ,[ 'name' => $app->slug_app , 'id' => $app->applica_id])}}">
                                {{$app->name}}</a>
                            @endforeach
                            @endif
                        </div>
                    </li>

                    {{-- Technical Support --}}
                    <li class="nav-item dropdown">
                        <a id="nav-uderline" class="nav-link " href="" id="dropdown06" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            {{ isset($staticContent['Technical_Support']) ? $staticContent['Technical_Support'] : 'Tech Support' }}
                            {{-- <i class="zmdi zmdi-chevron-down"></i> --}}
                        </a>
                        <div class="dropdown-menu megamenu sp-dropdown02 s-menu" aria-labelledby="dropdown06">
                            <a class="dropdown-item" href="{{route('index','catalogs')}}">
                                {{isset($staticContent['catalogs'])
                                ? $staticContent['catalogs'] 
                                : 'catalogs' }}
                            </a>
                            <a class="dropdown-item" href="{{route('index','product-documents')}}">
                                {{isset($staticContent['Product_Documents']) 
                                ? $staticContent['Product_Documents'] 
                                : 'Product Documents' }}
                            </a>
                            <a class="dropdown-item" href="{{route('productCoparison')}}">
                                {{isset($staticContent['product_comparison']) 
                                ? $staticContent['product_comparison']
                                : 'product comparison' }}
                            </a>
                            <a class="dropdown-item" href="{{route('index', ['page' => 'industry-know-how'])}}">
                                {{isset($staticContent['Industry_Know_How'])
                                ? $staticContent['Industry_Know_How']
                                : 'Industry Know-How' }} 
                            </a>
                            <a class="dropdown-item" href="{{route('index', ['page' => 'videos'])}}">
                                {{isset($staticContent['Videos'])
                                ? $staticContent['Videos']
                                : 'Videos' }}
                            </a>
                            <a class="dropdown-item" href="{{route('index', ['page' => 'product-notice'])}}">
                                {{isset($staticContent['Product_Notice'])
                                ? $staticContent['Product_Notice']
                                : 'Product Notice' }} 
                            </a>
                            <a class="dropdown-item" href="{{route('index', ['page' => 'eol'])}}">
                                {{isset($staticContent['EOL'])
                                ? $staticContent['EOL']
                                : 'EOL' }} 
                            </a>
                            <a class="dropdown-item" href="{{route('index','faqs')}}">
                                {{isset($staticContent['FAQs']) ? $staticContent['FAQs'] : 'FAQs' }}
                            </a>
                            <a class="dropdown-item" href="{{route('contactSupport')}}">
                                {{isset($staticContent['Technical_Service']) ? $staticContent['Technical_Service'] : 'Technical Service' }}
                            </a>
                        </div>
                    </li>

                    {{-- News and Events --}}
                    <li class="nav-item dropdown ">
                        <a id="nav-uderline" class="nav-link" id="dropdown01" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            {{ isset($staticContent['Updates']) ? $staticContent['Updates'] : 'News' }}
                            {{-- <i class="zmdi zmdi-chevron-down"></i> --}}
                        </a>
                        <div class="dropdown-menu s-menu sp-dropdown" role="menu" aria-labelledby="dropdown01">
                            <div class="dropdown-submenu">
                                <a id="sub1" class="sub-menu dropdown-item " tabindex="-1" href="#">
                                    {{ isset($staticContent['Product_News']) ? $staticContent['Product_News'] : 'Product_News' }}
                                    <i class="zmdi zmdi-chevron-right"></i>
                                </a>
                                <ul class="dropdown-menu drp-subthree">
                                    <li>
                                        <a tabindex="-1" href="{{route('index', ['page' => 'news'])}}">
                                            {{isset($staticContent['All'])
                                            ? $staticContent['All']
                                            : 'All' }} 
                                        </a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="{{route('index', ['page' => 'news', 'type' => slugifyHead(isset($newsTypes['Event News']) ? $newsTypes['Event News']->typename : 'Event News'), 'type-id' => $newsTypes['Event News'] ? $newsTypes['Event News']->id : '' ])}}">
                                            {{isset($newsTypes['Event News'])
                                            ? $newsTypes['Event News']->typename
                                            : 'Event News' }} 
                                        </a>
                                    </li>
                                    <li>
                                         <a tabindex="-1" href="{{route('index', ['page' => 'news', 'type' => slugifyHead(isset($newsTypes['Product News']) ? $newsTypes['Product News']->typename : 'Product News'), 'type-id' => $newsTypes['Product News'] ? $newsTypes['Product News']->id : '' ])}}">
                                            {{isset($newsTypes['Product News'])
                                            ? $newsTypes['Product News']->typename
                                            : 'Product News' }} 
                                        </a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="{{route('index', ['page' => 'news', 'type' => slugifyHead(isset($newsTypes['Success Case']) ? $newsTypes['Success Case']->typename : 'Success Case'), 'type-id' => $newsTypes['Success Case'] ? $newsTypes['Success Case']->id : '' ])}}">
                                            {{ isset($staticContent['Success_Case']) ? $staticContent['Success_Case']  : 'Success Case' }}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="dropdown-submenu">
                                <a class="" href="{{ route('index','events') }}">
                                    {{ isset($staticContent['Events']) ? $staticContent['Events'] : 'Events' }}
                                </a>
                            </div>
                        </div>
                    </li>

                    {{-- Where_to_Buy --}}
                    <li class="nav-item dropdown ">
                        <a id="nav-uderline" class="nav-link" href="" id="dropdown07" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            {{ isset($staticContent['Where_to_Buy'])
                                ? $staticContent['Where_to_Buy'] 
                                : 'Where_to_Buy' 
                            }}
                            {{-- <i class="zmdi zmdi-chevron-down"></i> --}}
                        </a>
                        <div class="dropdown-menu megamenu s-menu" aria-labelledby="dropdown07">
                            <a class="dropdown-item" href="{{route('contactSupport')}}">
                                {{isset($staticContent['contact_us']) ? $staticContent['contact_us'] : 'Contact Us' }}
                            </a>
                            <a class="dropdown-item"
                                href="{{route('contactFindDistributor')}}">{{isset($staticContent['find_a_distributor']) ?
                                $staticContent['find_a_distributor'] : 'Find a Distributor' }}</a>
                            <a class="dropdown-item" href="{{route('contactSalesOffices')}}">{{isset($staticContent['sales_offices']) ?
                                $staticContent['sales_offices'] : 'Sales Offices' }}</a>
                        </div>
                    </li>
                 </ul>
            </div>
        </nav>
    </div>
<div class="nav-comparison" id="nav-comparison" style="display:none;">
    <div class="container d-flex justify-content-between align-items-stretch">
        <div id="listAllcomparesesion" class="d-flex align-items-stretch all-list-to-comparison">
        </div>
        <a href="{{route('productCoparison')}}" class="btn btn-subscribe to-comparison">
            {{isset($staticContent['View_compare']) ?
            $staticContent['View_compare'] : 'View_compare' }}
            (<span id="numberselect"></span>/3)</a>
    </div>
</div>
</div>
<div class="visible-nav-minimize">
    <div class="header-color-bar-mobile"></div>
    <div class="nav-mobile scrolled w-100 header-shadow">
        <div class="nav-link-list d-flex nav-div-header">
            
            <a class="col-nav navbar-brand-mobile d-flex justify-content-center justify-content-left-1024" href="{{ $logoUrl }}">
                <img class="brand-image" src="{{asset('frontend-asset/image/DeltaPSU-Logo.svg')}}">
            </a>

            <div class="col-nav d-flex">
                <a href="/" class="power-supplies-link-mobile">
                    {!! preg_replace('/\s+/', '<br>', (isset($staticContent['Standard_Power_Supplies']) ? $staticContent['Standard_Power_Supplies'] : 'Standard Power Supplies'), 1) !!}
                </a>
            </div>
            <div class="col-nav d-flex justify-content-end" style="gap: 8px;">
                <div class="navbar-brand-mobile navbar-searchandlang icon-serch" id="btn-search-mobile" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M21 21L16.1667 16.1667M18.7778 9.88889C18.7778 14.7981 14.7981 18.7778 9.88889 18.7778C4.97969 18.7778 1 14.7981 1 9.88889C1 4.97969 4.97969 1 9.88889 1C14.7981 1 18.7778 4.97969 18.7778 9.88889Z" stroke="#646464" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                    {{-- <i class="fa fa-search icon-serch" aria-hidden="true"></i> --}}
                </div>

                <a class="navbar-brand-mobile" href="#" onclick="openNav();">
                    <div class="menu-buger">
                        <div class="bar"></div>
                        <div class="bar"></div>
                        <div class="bar"></div>
                    </div>
                </a>
                {{-- <select name="" id="select-mobile-lang" onchange="changeLangLocationmobile();"
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
                </select> --}}
            </div>
            
        </div>

        <div id="search-box-mobile" class="search-box-mobile" style="display:none;">
            <div class="nav-btn-search">
                <div class="box-search">
                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M21 21L16.1667 16.1667M18.7778 9.88889C18.7778 14.7981 14.7981 18.7778 9.88889 18.7778C4.97969 18.7778 1 14.7981 1 9.88889C1 4.97969 4.97969 1 9.88889 1C14.7981 1 18.7778 4.97969 18.7778 9.88889Z" stroke="#646464" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                    {{-- <i class="fa fa-search"></i> --}}
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
                onclick="toggle_visibility('btn-sidenav3')">{{isset($staticContent['Applications'])?
                $staticContent['Applications'] :'Applications' }}<i class="zmdi zmdi-chevron-right"></i></a>
            <a class="" tabindex="-1" href="#"
                onclick="toggle_visibility('btn-sidenav2')">{{isset($staticContent['Technical_Support'])?
                $staticContent['Technical_Support'] :'Technical Support' }}<i class="zmdi zmdi-chevron-right"></i></a>
            <a class="" tabindex="-1" href="#"
                onclick="toggle_visibility('btn-sidenav5')">{{isset($staticContent['Updates'])?
                $staticContent['Updates'] :'Updates' }}<i class="zmdi zmdi-chevron-right"></i></a>
            <a class="" tabindex="-1" href="#"
                onclick="toggle_visibility('btn-sidenav7')">{{isset($staticContent['Where_to_Buy'])?
                $staticContent['Where_to_Buy'] :'Where_to_Buy' }} <i class="zmdi zmdi-chevron-right"></i></a>
            <div class="d-flex">
                {{-- <img src="{{asset('frontend-asset/image/person-login-dark.svg')}}" alt="" class="mr-2"> --}}
                @if(session('partner_id') == null)
                <a class="a-link-hover" tabindex="-1" href="{{route('index','login')}}">Login </a>
                @else
                <a class="pad-logout fs-front" href="{{route('index','login')}}">
                    {{session('partner_firstname')}} /
                </a>
                <a href="{{route('index','logoutfrontend')}}" class="pad-logout fs-front"> &nbsp;
                    {{isset($staticContent['Logout']) ? $staticContent['Logout'] : 'Logout' }}
                </a>
                @endif

            </div>
            <div class="d-flex">
                {{-- <img src="{{asset('frontend-asset/image/sub-new-dark.svg')}}" alt="" class="mr-2"> --}}
                <a class="a-link-hover" tabindex="-1" onclick="subscribe()" data-toggle="modal"
                    data-target="#subscribe-modal">
                    {{isset($staticContent['Subscribe']) ? $staticContent['Subscribe'] : 'Subscribe' }}
                </a>
            </div>
            <div class="d-flex">
                {{-- <i class="icon-facon mr-1 icon-find-dis-blue f-size-enquiry-mobile"></i> --}}
                {{-- <img src="{{asset('frontend-asset/image/question.webp')}}" alt="" class="mr-2 icon-img-menu-top-mobile"> --}}
                <a href="{{route('contactSupport')}}" class="a-link-hover">
                    {{isset($staticContent['Sales_Inquiry']) ? $staticContent['Sales_Inquiry'] : 'Sales Inquiry' }}</a>
            </div>

            {{-- 多語系 --}}
            <div class="d-flex">
                <div class="dropdown">
                    <a class="dropdown-toggle cur-lang-new-g" data-toggle="dropdown">
                        <img class="img-icon-golang" src="{{asset('frontend-asset/image/icon/Global.svg')}}">
                    </a>
                    <ul class="dropdown-menu 123">
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

                            <li>
                                <a href="javascript:void(0);" onclick="clickLangLocationmobile('{{ LaravelLocalization::getLocalizedURL($current, null, [], true) }}');">
                                    @if($current == 'cn')
                                        简中
                                    @elseif($current == 'tw')
                                        繁中
                                    @else
                                        {{ strtoupper($current) }}
                                    @endif
                                </a>
                            </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>

        </div>
        {{-- PRODUCTS --}}
        <div id="btn-sidenav1" class="btn-sidenav pad-ar-24px">
            <a class="text-color-delta" tabindex="-1" href="#" onclick="toggle_visibility('btn-sidenav1')"><i
                    class="zmdi zmdi-chevron-left mr-1"></i>{{isset($staticContent['Products']) ?
                $staticContent['Products'] : 'Products' }}</a>

            <a class="text-normal pl-3" href="{{ route('allproduct') }}">
                {{ isset($staticContent['Products_Overview']) ? $staticContent['Products_Overview'] : 'Products Overview' }}
            </a>

            <a class="text-normal pl-3" href="{{ (isset($navcategories2) && count($navcategories2) > 0) ? route('productList', [$navcategories2->first()->main_cateid]) : '#' }}">
                {{ isset($staticContent['Industrial_Power']) ? $staticContent['Industrial_Power'] : 'Industrial Power' }}
                <span class="sidenav-toggle"
                        onclick="toggle_only(event, 'btn-sidenav-sub1')">
                    <i class="zmdi zmdi-chevron-right"></i>
                </span>
            </a>

            <a class="text-normal pl-3" href="{{ (isset($navcategories1) && count($navcategories1) > 0) ? route('productList', [$navcategories1->first()->main_cateid]) : '#' }}">
                {{ isset($staticContent['Medical_Power']) ? $staticContent['Medical_Power'] : 'Medical Power' }}
                <span class="sidenav-toggle"
                        onclick="toggle_only(event, 'btn-sidenav-sub2')">
                    <i class="zmdi zmdi-chevron-right"></i>
                </span>
            </a>
            
            {{-- <a class="text-normal pl-3" href="#"
                onclick="toggle_visibility('btn-sidenav-sub2')">{{isset($staticContent['Medical_Power']) ?
                $staticContent['Medical_Power'] : 'Medical Power' }}<i class="zmdi zmdi-chevron-right"></i></a> --}}
            <a class="text-normal pl-3"
                href="{{route('configurableproduct')}}">{{isset($staticContent['Configurable_Power']) ?
                $staticContent['Configurable_Power'] : 'Configurable Power' }}</a>

            @if(isset($navcategories4) && count($navcategories4) > 0 )
            <a class="text-normal pl-3" href="{{ route('productList', [$navcategories4->first()->main_cateid]) }}">
                {{ isset($staticContent['wireless_charging']) ? $staticContent['wireless_charging'] : 'Industrial Battery Charging' }}
                <span class="sidenav-toggle"
                        onclick="toggle_only(event, 'btn-sidenav-sub4')">
                    <i class="zmdi zmdi-chevron-right"></i>
                </span>
            </a>
            {{-- <a class="text-normal pl-3" href="#"
                onclick="toggle_visibility('btn-sidenav-sub4')">{{isset($staticContent['wireless_charging']) ?
                $staticContent['wireless_charging'] : 'Industrial Battery Charging' }}
                <i class="zmdi zmdi-chevron-right"></i></a> --}}
            @endif

            <a class="text-normal pl-3" href="{{ (isset($navcategories3) && count($navcategories3) > 0) ? route('productList', [$navcategories3->first()->main_cateid]) : '#' }}">
                {{ isset($staticContent['LED_Power']) ? $staticContent['LED_Power'] : 'LED Driver' }}
                <span class="sidenav-toggle"
                        onclick="toggle_only(event, 'btn-sidenav-sub3')">
                    <i class="zmdi zmdi-chevron-right"></i>
                </span>
            </a>

            {{-- <a class="text-normal pl-3" href="#"
                onclick="toggle_visibility('btn-sidenav-sub3')">{{isset($staticContent['LED_Power']) ?
                $staticContent['LED_Power'] : 'LED Driver' }}<i class="zmdi zmdi-chevron-right"></i></a> --}}
        </div>
        <div id="btn-sidenav-sub1" class="btn-sidenav  pad-ar-24px">
            <a class="text-color-delta" tabindex="-1" href="#" onclick="toggle_visibility('btn-sidenav-sub1')">
                <i class="zmdi zmdi-chevron-left mr-1"></i>{{isset($staticContent['Industrial_Power']) ?
                $staticContent['Industrial_Power'] : 'Industrial Power'}}</a>
            @if(isset($navcategories2))
            @foreach ($navcategories2 as $subCate)
            <a class="text-normal pl-3 "
                href="{{ route('productList' ,[$subCate->main_cateid, slugifyHead($subCate->url_item),$subCate->sub_pro_id]) }}">{{$subCate->name}}</a>
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
                href="{{ route('productList' ,[$subCate->main_cateid, slugifyHead($subCate->url_item),$subCate->sub_pro_id]) }}">{{$subCate->name}}</a>
            @endforeach
            @endif
        </div>
        <div id="btn-sidenav-sub3" class="btn-sidenav  pad-ar-24px">
            <a class="text-color-delta" tabindex="-1" href="#" onclick="toggle_visibility('btn-sidenav-sub3')"><i
                    class="zmdi zmdi-chevron-left mr-1"></i>{{isset($staticContent['LED_Power']) ?
                $staticContent['LED_Power']
                :'LED Driver' }}</a>
            <a class="text-normal pl-3"
                href="{{route('productList',[3, slugifyHead('CC-Cv-Mode'),1])}}">{{isset($staticContent['CC_Cv_Mode'])
                ? $staticContent['CC_Cv_Mode'] : 'CC + CV Mode' }}</a>

            <a class="text-normal pl-3"
                href="{{route('productList',[3, slugifyHead('CC-Mode'),2])}}">{{isset($staticContent['CC_Mode'])?
                $staticContent['CC_Mode'] :'CC Mode' }}</a>

            <a class="text-normal pl-3"
                href="{{route('productList',[3, slugifyHead('CV_Mode'),3])}}">{{isset($staticContent['CV_Mode'])?
                $staticContent['CV_Mode']: 'CV Mode'}}</a>

        </div>
        <div id="btn-sidenav-sub4" class="btn-sidenav  pad-ar-24px">
            <a class="text-color-delta" tabindex="-1" href="#" onclick="toggle_visibility('btn-sidenav-sub4')"><i
                    class="zmdi zmdi-chevron-left mr-1"></i>{{isset($staticContent['wireless_charging'])?
                $staticContent['wireless_charging'] :'Industrial Battery Charging' }}</a>
            @if(isset($navcategories4))
            @foreach ($navcategories4 as $subCate)
            <a class="text-normal pl-3 "
                href="{{ route('productList' ,[$subCate->main_cateid, preg_replace('/\s+/', '-', $subCate->url_item),$subCate->sub_pro_id]) }}">{{$subCate->name}}</a>
            @endforeach
            @endif
        </div>

        {{-- TECHNICAL SUPPORT --}}
        <div id="btn-sidenav2" class="btn-sidenav pad-ar-24px">
            <a class="text-color-delta" tabindex="-1" href="#" onclick="toggle_visibility('btn-sidenav2')"><i
                    class="zmdi zmdi-chevron-left mr-1"></i>{{isset($staticContent['Technical_Support'])? $staticContent['Technical_Support'] :
                'Technical Support'}}</a>
            
            <a class="text-normal pl-3" href="{{route('index','catalogs')}}">{{isset($staticContent['catalogs'])?
                $staticContent['catalogs'] :'catalogs' }} </a>
            
            <a class="text-normal pl-3" href="{{route('index','product-documents')}}">
                {{  isset($staticContent['Product_Documents'])
                    ? $staticContent['Product_Documents'] 
                    : 'Product_Documents' 
                }}
            </a>

            <a class="text-normal pl-3" href="{{route('productCoparison')}}">
                {{isset($staticContent['product_comparison'])?
                $staticContent['product_comparison'] :'product comparison' }}</a>

            <a class="text-normal pl-3" href="{{route('index', ['page' => 'industry-know-how'])}}">
                {{isset($staticContent['Industry_Know_How']) ? $staticContent['Industry_Know_How'] : 'Industry Know-How' }}
            </a>
            <a class="text-normal pl-3" href="{{route('index', ['page' => 'videos'])}}">
                {{isset($staticContent['Videos']) ? $staticContent['Videos'] : 'Videos' }}
            </a>
            <a class="text-normal pl-3" href="{{route('index', ['page' => 'product-notice'])}}">
                {{isset($staticContent['Product_Notice']) ? $staticContent['Product_Notice'] : 'Product Notice' }}
            </a>
            <a class="text-normal pl-3" href="{{route('index', ['page' => 'eol'])}}">
                {{isset($staticContent['EOL']) ? $staticContent['EOL'] : 'EOL' }}
            </a>

            <a class="text-normal pl-3" href="{{route('index','faqs')}}">{{isset($staticContent['FAQs'])?
                $staticContent['FAQs'] :'FAQs' }}</a>

            <a class="text-normal pl-3" href="{{route('contactSupport')}}">{{isset($staticContent['Technical_Service'])?
                $staticContent['Technical_Service'] :'Technical Service' }}</a>
        </div>
        {{-- APPLICATION --}}
        <div id="btn-sidenav3" class="btn-sidenav pad-ar-24px">
            <a class="text-color-delta" tabindex="-1" href="#" onclick="toggle_visibility('btn-sidenav3')"><i
                    class="zmdi zmdi-chevron-left mr-1"></i> {{isset($staticContent['Applications'])?
                $staticContent['Applications'] :'Applications' }}</a>

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
                $staticContent['Updates'] :'Updates' }}</a>
            
            <a class="text-normal pl-3" href="#" onclick="toggle_visibility('btn-sidenav-sub5')">
                {{isset($staticContent['Product_News']) ? $staticContent['Product_News'] : 'Product_News' }}
                <i class="zmdi zmdi-chevron-right"></i>
            </a>


            <a class="text-normal pl-3" href="{{route('index','events')}}">{{isset($staticContent['Events'])?
                $staticContent['Events'] :'Events' }}</a>
        </div>
        <div id="btn-sidenav-sub5" class="btn-sidenav pad-ar-24px">
             <a class="text-color-delta" tabindex="-1" href="#" onclick="toggle_visibility('btn-sidenav-sub5')"><i
                    class="zmdi zmdi-chevron-left mr-1"></i>{{isset($staticContent['Product_News']) ? $staticContent['Product_News'] : 'Product_News' }}</a>
            
            <a class="text-normal pl-3" href="{{route('index', ['page' => 'news'])}}">
                {{isset($staticContent['All']) ? $staticContent['All'] : 'All' }} 
            </a>
            <a class="text-normal pl-3" href="{{route('index', ['page' => 'news', 'type' => slugifyHead(isset($newsTypes['Event News']) ? $newsTypes['Event News']->typename : 'Event News'), 'type-id' => $newsTypes['Event News'] ? $newsTypes['Event News']->id : '' ])}}">
                {{isset($newsTypes['Event News']) ? $newsTypes['Event News']->typename : 'Event News' }} 
            </a>
            <a class="text-normal pl-3" href="{{route('index', ['page' => 'news', 'type' => slugifyHead(isset($newsTypes['Product News']) ? $newsTypes['Product News']->typename : 'Product News'), 'type-id' => $newsTypes['Product News'] ? $newsTypes['Product News']->id : '' ])}}">
                {{isset($newsTypes['Product News']) ? $newsTypes['Product News']->typename : 'Product News' }} 
            </a>
            <a class="text-normal pl-3" href="{{route('index', ['page' => 'news', 'type' => slugifyHead(isset($newsTypes['Success Case']) ? $newsTypes['Success Case']->typename : 'Success Case'), 'type-id' => $newsTypes['Success Case'] ? $newsTypes['Success Case']->id : '' ])}}">{{isset($staticContent['Success_Case'])?
                $staticContent['Success_Case'] :'Success Case' }}</a>
        </div>

        {{-- WHERE TO BUY --}}
        <div id="btn-sidenav7" class="btn-sidenav pad-ar-24px">
            <a class="text-color-delta" tabindex="-1" href="#" onclick="toggle_visibility('btn-sidenav7')"><i
                    class="zmdi zmdi-chevron-left mr-1"></i>{{isset($staticContent['Where_to_Buy'])?
                $staticContent['Where_to_Buy'] :'Where_to_Buy' }}</a>
            <a class="text-normal pl-3" href="{{route('contactSupport')}}">{{isset($staticContent['contact_us'])?
                $staticContent['contact_us'] :'Contact Us' }}</a>
            <a class="text-normal pl-3"
                href="{{route('contactFindDistributor')}}">{{isset($staticContent['find_a_distributor'])?
                $staticContent['find_a_distributor'] :'Find a Distributor' }}</a>
            <a class="text-normal pl-3"
                href="{{route('contactSalesOffices')}}">{{isset($staticContent['sales_offices'])?
                $staticContent['sales_offices'] :'Sales Offices' }}</a>
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

                @if((App::getLocale() == "cn" || App::getLocale() == "tw") && strtolower(str_replace(' ', '',
                $Sales_Inquiry)) !== 'salesinquiry')
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
@include('layouts.header-front-script')
