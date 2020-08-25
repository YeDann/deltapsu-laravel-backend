@extends('layouts.front-end')
@section('css')
<style>

    .select-minimize {
        width: 350px;
    }
    #nav-tab a {
        
        align-self: flex-end;
    }
    .nav-tabs .nav-link {
        margin: unset;
    }
    .font-size-tab {
    font-size: 14px !important;
    color: #000;
    }
</style>
@endsection

@section('container')
<div class="padding-top-content">
</div>
<div class="products-index-nav visible-up-922">
    <div class="bg-bredcrumb">
        <div class="container">
            <nav aria-label="breadcrumb" id="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item text-breadcrumb-home"><a href="{{route('index','home')}}">HOME</a></li>
                    <li class="breadcrumb-item active text-breadcrumb-home dropdown" aria-current="page"><a
                            href="#" data-toggle="dropdown" id="tools-dropdown">UPDATES</a>
                            <ul class="dropdown-menu">
                                <li><a href="#" id="tools-dropdown" class="text-bold">UPDATES</a></li>
                                <hr>
                                <li><a href="{{route('index','news')}}">PRODUCT NEWS</a></li>
                                <li><a href="{{route('index','events')}}">EVENTS</a></li>
                                <li><a href="{{route('index','technical-articles')}}">TECHNICAL ARTICLES</a></li>
                              </ul>   
                    </li>
                    <li class="breadcrumb-item active text-breadcrumb" aria-current="page"><a href="#">TECHNICAL ARTICLES</a></li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="padding-top-content-breadcrumb visible-up-922"></div>
<section class="box-news ">
    <div class="container">
        <h2 class="text-title-delta">TECHNICAL  ARTICLES</h2>
        <select id="select-ta" class="select-minimize invisible-up-922 mb-4">
            <option value="0">ALL ARTICLE</option>
            <option value="1">POPULAR ARTICLE</option>
            <option value="2">POWER SUPPLY SAFETY STANDARD</option>
            <option value="3">POWER SUPPLY FUNCTION</option>
            <option value="4">SELECTION GUIDE</option>
            <option value="5">RELIABILITY</option>
            <option value="6">POWER SUPPLY CONFIGURATION GUIDE</option>
        </select>
        <div class="row add-space-mobile mb-5">
            <div class="col-md-12">
                    <div class="nav nav-tabs d-flex justify-content-between border-b-2px visible-up-922 mb-4" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link font-size-tab active align-text-bottom" id="pop1-tab" data-toggle="tab" href="#pop1"
                            role="tab" aria-controls="pop1" aria-selected="true" data-val="0">ALL ARTICLE</a>
                        <a class="nav-item nav-link font-size-tab" id="pop2-tab" data-toggle="tab" href="#pop2"
                            role="tab" aria-controls="pop2" aria-selected="false" data-val="1">POPULAR <br>
                            ARTICLE</a>
                        <a class="nav-item nav-link font-size-tab" id="pop3-tab" data-toggle="tab" href="#pop3"
                            role="tab" aria-controls="pop3" aria-selected="false" data-val="2">POWER SUPPLY<br>
                            SAFETY STANDARD</a>
                        <a class="nav-item nav-link font-size-tab" id="pop4-tab" data-toggle="tab" href="#pop4"
                            role="tab" aria-controls="pop4" aria-selected="false" data-val="3">POWER SUPPLY<br>
                            FUNCTION</a>
                        <a class="nav-item nav-link font-size-tab" id="pop5-tab" data-toggle="tab" href="#pop5"
                            role="tab" aria-controls="pop5" aria-selected="false" data-val="4">SELECTION GUIDE</a>
                        <a class="nav-item nav-link font-size-tab" id="pop6-tab" data-toggle="tab" href="#pop6"
                            role="tab" aria-controls="pop6" aria-selected="false" data-val="5">RELIABILITY</a>
                        <a class="nav-item nav-link font-size-tab" id="pop7-tab" data-toggle="tab" href="#pop7"
                            role="tab" aria-controls="pop7" aria-selected="false"  data-val="6">POWER SUPPLY <br>
                            CONFIGURATION GUIDE</a>
                    </div>
               
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="pop1" role="tabpanel" aria-labelledby="pop1-tab">
                        <div class="pt-3"></div>
                        <div class="grid-news">
                            <div class="grid-list-news">
                                <div class="card">
                                    <div class="post-image">
                                        <img src="{{asset('/frontend-asset/image/latest-news-img.png')}}" alt=""
                                            class="img-responsive">
                                    </div>
                                    <div class="news-content">
                                        <div class="post-meta">
                                            <span class="sub-news company">
                                                <a href="#">
                                                    COMPANY
                                                </a>
                                            </span>
                                        <img class="line-symbol"src="{{asset('/frontend-asset/image/line-symbol.svg')}}" alt="">
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
                                    <a href="#"class="read-more">READ MORE</a>
                                </div>
                            </div>                          
                            <div class="grid-list-news">
                                <div class="card">
                                    <div class="post-image">
                                        <img src="{{asset('/frontend-asset/image/new product.png')}}" alt=""
                                            class="img-responsive">
                                    </div>
                                    <div class="news-content">
                                        <div class="post-meta">
                                            <span class="sub-news new">
                                                <a href="#">
                                                    NEW PRODUCTS
                                                </a>
                                            </span>
                                        <img class="line-symbol"src="{{asset('/frontend-asset/image/line-symbol.svg')}}" alt="">
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
                                    <a href="#"class="read-more">READ MORE</a>
                                </div>
                            </div>
                            <div class="grid-list-news">
                                <div class="card">
                                    <div class="post-image">
                                        <img src="{{asset('/frontend-asset/image/other.png')}}" alt=""
                                            class="img-responsive">
                                    </div>
                                    <div class="news-content">
                                        <div class="post-meta">
                                            <span class="sub-news other">
                                                <a href="#">
                                                   OTHER
                                                </a>
                                            </span>
                                        <img class="line-symbol"src="{{asset('/frontend-asset/image/line-symbol.svg')}}" alt="">
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
                                    <a href="#"class="read-more">READ MORE</a>
                                </div>
                            </div>
                            <div class="grid-list-news">
                                <div class="card">
                                    <div class="post-image">
                                        <img src="{{asset('/frontend-asset/image/latest-news-img.png')}}" alt=""
                                            class="img-responsive">
                                    </div>
                                    <div class="news-content">
                                        <div class="post-meta">
                                            <span class="sub-news company">
                                                <a href="#">
                                                    COMPANY
                                                </a>
                                            </span>
                                        <img class="line-symbol"src="{{asset('/frontend-asset/image/line-symbol.svg')}}" alt="">
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
                                    <a href="#"class="read-more">READ MORE</a>
                                </div>
                            </div>
                            <div class="grid-list-news">
                                <div class="card">
                                    <div class="post-image">
                                        <img src="{{asset('/frontend-asset/image/latest-news-img.png')}}" alt=""
                                            class="img-responsive">
                                    </div>
                                    <div class="news-content">
                                        <div class="post-meta">
                                            <span class="sub-news company">
                                                <a href="#">
                                                    COMPANY
                                                </a>
                                            </span>
                                        <img class="line-symbol"src="{{asset('/frontend-asset/image/line-symbol.svg')}}" alt="">
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
                                    <a href="#"class="read-more">READ MORE</a>
                                </div>
                            </div>
                            <div class="grid-list-news">
                                <div class="card">
                                    <div class="post-image">
                                        <img src="{{asset('/frontend-asset/image/latest-news-img.png')}}" alt=""
                                            class="img-responsive">
                                    </div>
                                    <div class="news-content">
                                        <div class="post-meta">
                                            <span class="sub-news company">
                                                <a href="#">
                                                    COMPANY
                                                </a>
                                            </span>
                                        <img class="line-symbol"src="{{asset('/frontend-asset/image/line-symbol.svg')}}" alt="">
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
                                    <a href="#"class="read-more">READ MORE</a>
                                </div>
                            </div>
                            <div class="grid-list-news">
                                <div class="card">
                                    <div class="post-image">
                                        <img src="{{asset('/frontend-asset/image/latest-news-img.png')}}" alt=""
                                            class="img-responsive">
                                    </div>
                                    <div class="news-content">
                                        <div class="post-meta">
                                            <span class="sub-news company">
                                                <a href="#">
                                                    COMPANY
                                                </a>
                                            </span>
                                        <img class="line-symbol"src="{{asset('/frontend-asset/image/line-symbol.svg')}}" alt="">
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
                                    <a href="#"class="read-more">READ MORE</a>
                                </div>
                            </div>
                            <div class="grid-list-news">
                                <div class="card">
                                    <div class="post-image">
                                        <img src="{{asset('/frontend-asset/image/latest-news-img.png')}}" alt=""
                                            class="img-responsive">
                                    </div>
                                    <div class="news-content">
                                        <div class="post-meta">
                                            <span class="sub-news company">
                                                <a href="#">
                                                    COMPANY
                                                </a>
                                            </span>
                                        <img class="line-symbol"src="{{asset('/frontend-asset/image/line-symbol.svg')}}" alt="">
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
                                    <a href="#"class="read-more">READ MORE</a>
                                </div>
                            </div>
                            <div class="grid-list-news">
                                <div class="card">
                                    <div class="post-image">
                                        <img src="{{asset('/frontend-asset/image/latest-news-img.png')}}" alt=""
                                            class="img-responsive">
                                    </div>
                                    <div class="news-content">
                                        <div class="post-meta">
                                            <span class="sub-news company">
                                                <a href="#">
                                                    COMPANY
                                                </a>
                                            </span>
                                        <img class="line-symbol"src="{{asset('/frontend-asset/image/line-symbol.svg')}}" alt="">
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
                                    <a href="#"class="read-more">READ MORE</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pop2" role="tabpanel" aria-labelledby="pop2-tab">
                        <div class="pt-3"></div>
                        <div class="grid-news">
                            <div class="grid-list-news">
                                <div class="card">
                                    <div class="post-image">
                                        <img src="{{asset('/frontend-asset/image/latest-news-img.png')}}" alt=""
                                            class="img-responsive">
                                    </div>
                                    <div class="news-content">
                                        <div class="post-meta">
                                            <span class="sub-news company">
                                                <a href="#">
                                                    COMPANY
                                                </a>
                                            </span>
                                        <img class="line-symbol"src="{{asset('/frontend-asset/image/line-symbol.svg')}}" alt="">
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
                                    <a href="#"class="read-more">READ MORE</a>
                                </div>
                            </div>
                            <div class="grid-list-news">
                                <div class="card">
                                    <div class="post-image">
                                        <img src="{{asset('/frontend-asset/image/latest-news-img.png')}}" alt=""
                                            class="img-responsive">
                                    </div>
                                    <div class="news-content">
                                        <div class="post-meta">
                                            <span class="sub-news company">
                                                <a href="#">
                                                    COMPANY
                                                </a>
                                            </span>
                                        <img class="line-symbol"src="{{asset('/frontend-asset/image/line-symbol.svg')}}" alt="">
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
                                    <a href="#"class="read-more">READ MORE</a>
                                </div>
                            </div>
                            <div class="grid-list-news">
                                <div class="card">
                                    <div class="post-image">
                                        <img src="{{asset('/frontend-asset/image/latest-news-img.png')}}" alt=""
                                            class="img-responsive">
                                    </div>
                                    <div class="news-content">
                                        <div class="post-meta">
                                            <span class="sub-news company">
                                                <a href="#">
                                                    COMPANY
                                                </a>
                                            </span>
                                        <img class="line-symbol"src="{{asset('/frontend-asset/image/line-symbol.svg')}}" alt="">
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
                                    <a href="#"class="read-more">READ MORE</a>
                                </div>
                            </div>
                            <div class="grid-list-news">
                                <div class="card">
                                    <div class="post-image">
                                        <img src="{{asset('/frontend-asset/image/latest-news-img.png')}}" alt=""
                                            class="img-responsive">
                                    </div>
                                    <div class="news-content">
                                        <div class="post-meta">
                                            <span class="sub-news company">
                                                <a href="#">
                                                    COMPANY
                                                </a>
                                            </span>
                                        <img class="line-symbol"src="{{asset('/frontend-asset/image/line-symbol.svg')}}" alt="">
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
                                    <a href="#"class="read-more">READ MORE</a>
                                </div>
                            </div>
                            <div class="grid-list-news">
                                <div class="card">
                                    <div class="post-image">
                                        <img src="{{asset('/frontend-asset/image/latest-news-img.png')}}" alt=""
                                            class="img-responsive">
                                    </div>
                                    <div class="news-content">
                                        <div class="post-meta">
                                            <span class="sub-news company">
                                                <a href="#">
                                                    COMPANY
                                                </a>
                                            </span>
                                        <img class="line-symbol"src="{{asset('/frontend-asset/image/line-symbol.svg')}}" alt="">
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
                                    <a href="#"class="read-more">READ MORE</a>
                                </div>
                            </div>
                            <div class="grid-list-news">
                                <div class="card">
                                    <div class="post-image">
                                        <img src="{{asset('/frontend-asset/image/latest-news-img.png')}}" alt=""
                                            class="img-responsive">
                                    </div>
                                    <div class="news-content">
                                        <div class="post-meta">
                                            <span class="sub-news company">
                                                <a href="#">
                                                    COMPANY
                                                </a>
                                            </span>
                                        <img class="line-symbol"src="{{asset('/frontend-asset/image/line-symbol.svg')}}" alt="">
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
                                    <a href="#"class="read-more">READ MORE</a>
                                </div>
                            </div>
                            <div class="grid-list-news">
                                <div class="card">
                                    <div class="post-image">
                                        <img src="{{asset('/frontend-asset/image/latest-news-img.png')}}" alt=""
                                            class="img-responsive">
                                    </div>
                                    <div class="news-content">
                                        <div class="post-meta">
                                            <span class="sub-news company">
                                                <a href="#">
                                                    COMPANY
                                                </a>
                                            </span>
                                        <img class="line-symbol"src="{{asset('/frontend-asset/image/line-symbol.svg')}}" alt="">
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
                                    <a href="#"class="read-more">READ MORE</a>
                                </div>
                            </div>
                            <div class="grid-list-news">
                                <div class="card">
                                    <div class="post-image">
                                        <img src="{{asset('/frontend-asset/image/latest-news-img.png')}}" alt=""
                                            class="img-responsive">
                                    </div>
                                    <div class="news-content">
                                        <div class="post-meta">
                                            <span class="sub-news company">
                                                <a href="#">
                                                    COMPANY
                                                </a>
                                            </span>
                                        <img class="line-symbol"src="{{asset('/frontend-asset/image/line-symbol.svg')}}" alt="">
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
                                    <a href="#"class="read-more">READ MORE</a>
                                </div>
                            </div>
                            <div class="grid-list-news">
                                <div class="card">
                                    <div class="post-image">
                                        <img src="{{asset('/frontend-asset/image/latest-news-img.png')}}" alt=""
                                            class="img-responsive">
                                    </div>
                                    <div class="news-content">
                                        <div class="post-meta">
                                            <span class="sub-news company">
                                                <a href="#">
                                                    COMPANY
                                                </a>
                                            </span>
                                        <img class="line-symbol"src="{{asset('/frontend-asset/image/line-symbol.svg')}}" alt="">
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
                                    <a href="#"class="read-more">READ MORE</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pop3" role="tabpanel" aria-labelledby="pop3-tab">
                        <div class="pt-3"></div>
                        <div class="grid-news">
                            <div class="grid-list-news">
                                <div class="card">
                                    <div class="post-image">
                                        <img src="{{asset('/frontend-asset/image/new product.png')}}" alt=""
                                            class="img-responsive">
                                    </div>
                                    <div class="news-content">
                                        <div class="post-meta">
                                            <span class="sub-news new">
                                                <a href="#">
                                                    NEW PRODUCTS
                                                </a>
                                            </span>
                                        <img class="line-symbol"src="{{asset('/frontend-asset/image/line-symbol.svg')}}" alt="">
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
                                    <a href="#"class="read-more">READ MORE</a>
                                </div>
                            </div>
                            <div class="grid-list-news">
                                <div class="card">
                                    <div class="post-image">
                                            <img src="{{asset('/frontend-asset/image/new product.png')}}" alt=""
                                            class="img-responsive">
                                    </div>
                                    <div class="news-content">
                                        <div class="post-meta">
                                            <span class="sub-news new">
                                                <a href="#">
                                                    NEW PRODUCTS
                                                </a>
                                            </span>
                                        <img class="line-symbol"src="{{asset('/frontend-asset/image/line-symbol.svg')}}" alt="">
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
                                    <a href="#"class="read-more">READ MORE</a>
                                </div>
                            </div>
                            <div class="grid-list-news">
                                <div class="card">
                                    <div class="post-image">
                                            <img src="{{asset('/frontend-asset/image/new product.png')}}" alt=""
                                            class="img-responsive">
                                    </div>
                                    <div class="news-content">
                                        <div class="post-meta">
                                            <span class="sub-news new">
                                                <a href="#">
                                                    NEW PRODUCTS
                                                </a>
                                            </span>
                                        <img class="line-symbol"src="{{asset('/frontend-asset/image/line-symbol.svg')}}" alt="">
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
                                    <a href="#"class="read-more">READ MORE</a>
                                </div>
                            </div>
                            <div class="grid-list-news">
                                <div class="card">
                                    <div class="post-image">
                                            <img src="{{asset('/frontend-asset/image/new product.png')}}" alt=""
                                            class="img-responsive">
                                    </div>
                                    <div class="news-content">
                                        <div class="post-meta">
                                            <span class="sub-news new">
                                                <a href="#">
                                                    NEW PRODUCTS
                                                </a>
                                            </span>
                                        <img class="line-symbol"src="{{asset('/frontend-asset/image/line-symbol.svg')}}" alt="">
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
                                    <a href="#"class="read-more">READ MORE</a>
                                </div>
                            </div>
                            <div class="grid-list-news">
                                <div class="card">
                                    <div class="post-image">
                                            <img src="{{asset('/frontend-asset/image/new product.png')}}" alt=""
                                            class="img-responsive">
                                    </div>
                                    <div class="news-content">
                                        <div class="post-meta">
                                            <span class="sub-news new">
                                                <a href="#">
                                                    NEW PRODUCTS
                                                </a>
                                            </span>
                                        <img class="line-symbol"src="{{asset('/frontend-asset/image/line-symbol.svg')}}" alt="">
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
                                    <a href="#"class="read-more">READ MORE</a>
                                </div>
                            </div>
                            <div class="grid-list-news">
                                <div class="card">
                                    <div class="post-image">
                                            <img src="{{asset('/frontend-asset/image/new product.png')}}" alt=""
                                            class="img-responsive">
                                    </div>
                                    <div class="news-content">
                                        <div class="post-meta">
                                           <span class="sub-news new">
                                                <a href="#">
                                                    NEW PRODUCTS
                                                </a>
                                            </span>
                                        <img class="line-symbol"src="{{asset('/frontend-asset/image/line-symbol.svg')}}" alt="">
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
                                    <a href="#"class="read-more">READ MORE</a>
                                </div>
                            </div>
                            <div class="grid-list-news">
                                <div class="card">
                                    <div class="post-image">
                                            <img src="{{asset('/frontend-asset/image/new product.png')}}" alt=""
                                            class="img-responsive">
                                    </div>
                                    <div class="news-content">
                                        <div class="post-meta">
                                            <span class="sub-news new">
                                                <a href="#">
                                                    NEW PRODUCTS
                                                </a>
                                            </span>
                                        <img class="line-symbol"src="{{asset('/frontend-asset/image/line-symbol.svg')}}" alt="">
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
                                    <a href="#"class="read-more">READ MORE</a>
                                </div>
                            </div>
                            <div class="grid-list-news">
                                <div class="card">
                                    <div class="post-image">
                                            <img src="{{asset('/frontend-asset/image/new product.png')}}" alt=""
                                            class="img-responsive">
                                    </div>
                                    <div class="news-content">
                                        <div class="post-meta">
                                            <span class="sub-news new">
                                                <a href="#">
                                                    NEW PRODUCTS
                                                </a>
                                            </span>
                                        <img class="line-symbol"src="{{asset('/frontend-asset/image/line-symbol.svg')}}" alt="">
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
                                    <a href="#"class="read-more">READ MORE</a>
                                </div>
                            </div>
                            <div class="grid-list-news">
                                <div class="card">
                                    <div class="post-image">
                                        <img src="{{asset('/frontend-asset/image/new product.png')}}" alt=""
                                            class="img-responsive">
                                    </div>
                                    <div class="news-content">
                                        <div class="post-meta">
                                            <span class="sub-news new">
                                                <a href="#">
                                                    NEW PRODUCTS
                                                </a>
                                            </span>
                                        <img class="line-symbol"src="{{asset('/frontend-asset/image/line-symbol.svg')}}" alt="">
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
                                    <a href="#"class="read-more">READ MORE</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pop4" role="tabpanel" aria-labelledby="pop4-tab">
                        <div class="pt-"></div>
                        <div class="grid-news">
                                <div class="grid-list-news">
                                    <div class="card">
                                        <div class="post-image">
                                            <img src="{{asset('/frontend-asset/image/other.png')}}" alt=""
                                                class="img-responsive">
                                        </div>
                                        <div class="news-content">
                                            <div class="post-meta">
                                                <span class="sub-news other">
                                                    <a href="#">
                                                        OTHERS
                                                    </a>
                                                </span>
                                            <img class="line-symbol"src="{{asset('/frontend-asset/image/line-symbol.svg')}}" alt="">
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
                                        <a href="#"class="read-more">READ MORE</a>
                                    </div>
                                </div>
                                <div class="grid-list-news">
                                    <div class="card">
                                        <div class="post-image">
                                            <img src="{{asset('/frontend-asset/image/other.png')}}" alt=""
                                                class="img-responsive">
                                        </div>
                                        <div class="news-content">
                                            <div class="post-meta">
                                                <span class="sub-news other">
                                                    <a href="#">
                                                        OTHERS
                                                    </a>
                                                </span>
                                            <img class="line-symbol"src="{{asset('/frontend-asset/image/line-symbol.svg')}}" alt="">
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
                                        <a href="#"class="read-more">READ MORE</a>
                                    </div>
                                </div>
                                <div class="grid-list-news">
                                    <div class="card">
                                        <div class="post-image">
                                            <img src="{{asset('/frontend-asset/image/other.png')}}" alt=""
                                                class="img-responsive">
                                        </div>
                                        <div class="news-content">
                                            <div class="post-meta">
                                                <span class="sub-news other">
                                                    <a href="#">
                                                        OTHERS
                                                    </a>
                                                </span>
                                            <img class="line-symbol"src="{{asset('/frontend-asset/image/line-symbol.svg')}}" alt="">
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
                                        <a href="#"class="read-more">READ MORE</a>
                                    </div>
                                </div>
                                <div class="grid-list-news">
                                    <div class="card">
                                        <div class="post-image">
                                            <img src="{{asset('/frontend-asset/image/other.png')}}" alt=""
                                                class="img-responsive">
                                        </div>
                                        <div class="news-content">
                                            <div class="post-meta">
                                                <span class="sub-news other">
                                                    <a href="#">
                                                        OTHERS
                                                    </a>
                                                </span>
                                            <img class="line-symbol"src="{{asset('/frontend-asset/image/line-symbol.svg')}}" alt="">
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
                                        <a href="#"class="read-more">READ MORE</a>
                                    </div>
                                </div>
                                <div class="grid-list-news">
                                    <div class="card">
                                        <div class="post-image">
                                            <img src="{{asset('/frontend-asset/image/other.png')}}" alt=""
                                                class="img-responsive">
                                        </div>
                                        <div class="news-content">
                                            <div class="post-meta">
                                                <span class="sub-news other">
                                                    <a href="#">
                                                        OTHERS
                                                    </a>
                                                </span>
                                            <img class="line-symbol"src="{{asset('/frontend-asset/image/line-symbol.svg')}}" alt="">
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
                                        <a href="#"class="read-more">READ MORE</a>
                                    </div>
                                </div>
                                <div class="grid-list-news">
                                    <div class="card">
                                        <div class="post-image">
                                            <img src="{{asset('/frontend-asset/image/other.png')}}" alt=""
                                                class="img-responsive">
                                        </div>
                                        <div class="news-content">
                                            <div class="post-meta">
                                                <span class="sub-news other">
                                                    <a href="#">
                                                        OTHERS
                                                    </a>
                                                </span>
                                            <img class="line-symbol"src="{{asset('/frontend-asset/image/line-symbol.svg')}}" alt="">
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
                                        <a href="#"class="read-more">READ MORE</a>
                                    </div>
                                </div>
                            </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>


@endsection


@section('js')
<script>
     $(document).ready(function() {
        /* select to tab */
        $('#select-ta').on('change', function(e) {
           $(this).find(":selected").data('toggle');
            $('#nav-tab a').eq($(this).val()).tab('show');
            
        });
        /* tab to select */
        $('#nav-tab a').click(function(){ 
            $('#select-ta').val($(this).data('val')).trigger('change');
        })
    });
</script>
@endsection
