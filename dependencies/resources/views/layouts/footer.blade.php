{{-- Footer Style --}}
<style>
    .box-newsletter .text-title-banner {
        font-size: 24px;
    }
    
    .box-newsletter .text-be-first {
        font-size: 18px;
    }

    .box-newsletter .btn-subscribe {
        font-size: 18px;
        height: 48px;
    }
</style>
<div class="visible-desk-up visible-tablets-large">
    <div class="box-newsletter">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="padding-new-sub text-center">
                        <h2 class="text-title-banner text-center">
                            {{ isset($staticContent['Subscribe_to_our_newsletter']) ?
                                $staticContent['Subscribe_to_our_newsletter'] : "Subscribe to our newsletter" }}
                        </h2>
                        <div class="text-be-first">
                            {{ isset($staticContent['Be_the_first_to_hear']) ? $staticContent['Be_the_first_to_hear'] : 
                                "Be the first to hear about new events, news and products!" }}
                        </div>
                        <div class="box-input-sub">
                            <label for="inp" class="inp">
                                <input type="text" id="inp3" placeholder="&nbsp;" data-toggle="modal"
                                    data-target="#subscribe-modal">
                                <span class="label">
                                    {{ isset($staticContent['Enter_email_address']) ? $staticContent['Enter_email_address']
                                        : "Enter email address" }}
                                </span>
                                <span class="border"></span>
                            </label>
                            <button class="btn btn-subscribe shadow-radius-box" onclick="resetfield();" data-toggle="modal"
                                data-target="#subscribe-modal">{{isset($staticContent['Subscribe'])?$staticContent['Subscribe']:"Subscribe"}}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-footer">
        <div class="container">
            <div class="padding-top-bottom">
                <div class="row">
                    {{-- Products Start --}}
                    <div class="col-xl-2 col-lg-2">
                        <div class="text-footer-main ">
                            <h6>{{isset($staticContent['Products'])?$staticContent['Products']:"Products"}}</h6>
                        </div>
                        
                        <a href="{{ route('allproduct') }}">
                            <p class="text-pro-link">
                                {{ isset($staticContent['Products_Overview']) ? $staticContent['Products_Overview'] : 'Products Overview' }}
                            </p>
                        </a>

                        @if(isset($navcategories2) && count($navcategories2) > 0)
                        <a href="{{ route('productList', [$navcategories2->first()->main_cateid]) }}">
                            <p class="text-pro-link">
                                {{isset($staticContent['Industrial_Power'])?$staticContent['Industrial_Power']:"Industrial Power"}}
                            </p>
                        </a>
                        @endif

                        @if(isset($navcategories1) && count($navcategories1) > 0)
                        <a href="{{ route('productList', [$navcategories1->first()->main_cateid]) }}">
                            <p class="text-pro-link">
                                {{isset($staticContent['Medical_Power'])?$staticContent['Medical_Power']:"Medical Power"}}
                            </p>
                        </a>
                        @endif

                        <a href="{{ route('configurableproduct') }}">
                            <p class="text-pro-link">
                                {{ isset($staticContent['Configurable_Power']) ? $staticContent['Configurable_Power'] : 'Configurable Power' }}
                            </p>
                        </a>

                        @if(isset($navcategories4) && count($navcategories4) > 0)
                        <a href="{{ route('productList', [$navcategories4->first()->main_cateid]) }}">
                            <p class="text-pro-link">
                                {{isset($staticContent['wireless_charging'])? $staticContent['wireless_charging'] :'Industrial Battery Charging' }}
                            </p>
                        </a>
                        @endif

                        @if(isset($navcategories3) && count($navcategories3) > 0)
                        <a href="{{ route('productList', [$navcategories3->first()->main_cateid]) }}">
                            <p class="text-pro-link">
                                {{isset($staticContent['LED_Power'])?$staticContent['LED_Power']:"LED Power"}}
                            </p>
                        </a>
                        @endif

                    </div>

                    {{-- Application Start --}}
                    <div class="col-xl-2 col-lg-2">
                        <div class="text-footer-main ">
                            <h6>{{isset($staticContent['Applications'])?$staticContent['Applications']:"Applications"}}
                            </h6>
                        </div>
                        @if(isset($navapplication))
                        @foreach ($navapplication as $app)
                        <div class=" ">
                            <a href="{{route('appDetail' ,[ 'name' =>  $app->slug_app , 'id' => $app->applica_id])}}">
                                <p class="text-pro-link">{{$app->name}}</p>
                            </a>
                        </div>
                        @endforeach
                        @endif
                    </div>
                    {{-- Application End --}}

                    {{-- Selector --}}
                    {{-- <div class="col-xl-2 col-lg-2">
                        <div class="text-footer-main">
                            <h6>{{isset($staticContent['Tools'])?$staticContent['Tools']:"Tools"}}</h6>
                        </div>
                        <div class=" ">
                            <a href="{{route('productFinder')}}">
                                <p class="text-pro-link">
                                    {{isset($staticContent['Product_Selector'])?$staticContent['Product_Selector']:"Product
                                    Selector"}}</p>

                            </a>
                        </div>
                        <div class=" ">
                            <a href="{{route('configurableproduct')}}">
                                <p class="text-pro-link">{{isset($staticContent['configurable_power_selector'])
                                    ?$staticContent['configurable_power_selector']:"Configurable Power Selector" }}</p>

                            </a>
                        </div>

                        <br><br>
                        <div class="footer-one text-footer-main">
                            <h6>{{isset($staticContent['Updates'])?$staticContent['Updates']:"Updates"}}</h6>
                        </div>
                        <div class=" ">
                            <a href="{{route('index','news')}}">
                                <p class="text-pro-link">{{isset($staticContent['Product_News'])?
                                    $staticContent['Product_News']:"Product News"}}</p>

                            </a>
                        </div>
                        <div class=" ">
                            <a href="{{route('index','events')}}">
                                <p class="text-pro-link">
                                    {{isset($staticContent['Events'])?$staticContent['Events']:"Events" }}</p>
                            </a>
                        </div>
                        <div class=" ">
                            <a href="{{route('index','technical-articles')}}">
                                <p class="text-pro-link">
                                    {{isset($staticContent['Technical_Articles'])?$staticContent['Technical_Articles']:"Technical
                                    Articles"}}</p>

                            </a>
                        </div>
                    </div> --}}
                    {{-- Tools, Selector --}}

                    {{-- Technical Support --}}
                    <div class="col-xl-2 col-lg-2">
                        {{-- <div class="text-footer-main ">
                            <h6>{{isset($staticContent['About'])?$staticContent['About']:"About"}}</h6>
                        </div>
                        @foreach ($navaboutus as $abt)
                        <div class=" ">
                            <a href="{{route('aboutUs',$abt->stug)}}">
                                <p class="text-pro-link">{{$abt->title}}</p>

                            </a>
                        </div>
                        @endforeach
                        <br> --}}
                        <div class="text-footer-main footer-two">
                            <h6>{{isset($staticContent['Technical_Support'])?$staticContent['Technical_Support']:"Tech Support"}}</h6>
                        </div>
                        <div class=" ">
                            <a href="{{route('index', 'catalogs')}}">
                                <p class="text-pro-link">
                                    {{isset($staticContent['catalogs'])?$staticContent['catalogs']:"Catalogs"}}</p>
                            </a>
                        </div>
                        <div class=" ">
                            <a href="{{route('index', 'product-documents')}}">
                                <p class="text-pro-link">
                                    {{isset($staticContent['Product_Documents'])
                                    ? $staticContent['Product_Documents']
                                    : "Product Documents"}}</p>
                            </a>
                        </div>
                        <div class=" ">
                            <a href="{{route('productCoparison')}}">
                                <p class="text-pro-link">
                                    {{isset($staticContent['product_comparison']) 
                                    ? $staticContent['product_comparison'] 
                                    : "Product Comparison" }}</p>
                            </a>
                        </div>
                        <div class=" ">
                            <a href="{{route('index', ['page' => 'industry-know-how'])}}">
                                <p class="text-pro-link">
                                    {{isset($staticContent['Industry_Know_How']) 
                                    ? $staticContent['Industry_Know_How']
                                    : "Industry Know-How" }}</p>
                            </a>
                        </div>
                        <div class=" ">
                            <a href="{{route('index', ['page' => 'videos'])}}">
                                <p class="text-pro-link">
                                    {{isset($staticContent['Videos']) 
                                    ? $staticContent['Videos'] 
                                    : "Videos" }}</p>
                            </a>
                        </div>
                        <div class=" ">
                            <a href="{{route('index', ['page' => 'product-notice'])}}">
                                <p class="text-pro-link">
                                    {{isset($staticContent['Product_Notice'])
                                    ? $staticContent['Product_Notice']
                                    : 'Product Notice' }} </p>
                            </a>
                        </div>
                        <div class=" ">
                            <a href="{{route('index', ['page' => 'eol'])}}">
                                <p class="text-pro-link">
                                    {{isset($staticContent['EOL'])
                                    ? $staticContent['EOL']
                                    : 'EOL' }} </p>
                            </a>
                        </div>
                        <div class=" ">
                            <a href="{{route('index', 'faqs')}}">
                                <p class="text-pro-link">
                                    {{isset($staticContent['FAQs']) 
                                    ? $staticContent['FAQs'] 
                                    : "FAQs"}}</p>
                            </a>
                        </div>
                        <div class=" ">
                            <a href="{{route('contactSupport')}}">
                                <p class="text-pro-link">
                                    {{isset($staticContent['Technical_Service']) 
                                    ? $staticContent['Technical_Service'] 
                                    : "Technical Service" }}</p>
                            </a>
                        </div>
                    </div>
                    {{-- Technical Support End --}}

                    {{-- News --}}
                    <div class="col-xl-2 col-lg-2">
                        <div class="text-footer-main footer-two">
                            <h6>{{isset($staticContent['Updates'])?$staticContent['Updates']:"News"}}</h6>
                        </div>
                        <div class=" ">
                            <a href="{{route('index','news')}}">
                                <p class="text-pro-link">
                                    {{isset($staticContent['Product_News'])?$staticContent['Product_News']:"News"}}</p>
                            </a>
                        </div>
                        <div class=" ">
                            <a href="{{route('index','events')}}">
                                <p class="text-pro-link">
                                    {{isset($staticContent['Events'])?$staticContent['Events']:"Events"}}</p>
                            </a>
                        </div>
                    </div>
                    {{-- News End --}}
                    
                    {{-- Where to buy --}}
                    <div class="col-xl-2 col-lg-2">
                        <div class="text-footer-main ">
                            <h6>{{isset($staticContent['Where_to_Buy']) 
                                ? $staticContent['Where_to_Buy'] 
                                : "Where to Buy"}}</h6>
                        </div>
                        <div class=" ">
                            <a href="{{route('contactSupport')}}">
                                <p class="text-pro-link">
                                    {{isset($staticContent['contact_us']) 
                                    ? $staticContent['contact_us'] 
                                    : "Contact Us"}}
                                </p>
                            </a>
                        </div>
                        <div class=" ">
                            <a href="{{route('contactFindDistributor')}}">
                                <p class="text-pro-link">
                                    {{isset($staticContent['find_a_distributor']) 
                                    ? $staticContent['find_a_distributor'] 
                                    : "find a distributor"}}</p>
                            </a>
                        </div>
                        <div class=" ">
                            <a href="{{route('contactSalesOffices')}}">
                                <p class="text-pro-link">
                                    {{isset($staticContent['sales_offices']) 
                                    ? $staticContent['sales_offices'] 
                                    : "Sales Offices"}}</p>
                            </a>
                        </div>

                    </div>{{-- contact&PARTNER--}}
                    <div class="col-xl-2 col-lg-2">
                        <div class="text-footer-main ">
                            <h6>{{isset($staticContent['Information'])? $staticContent['Information']:Information}}</h6>
                        </div>
                        <div class=" ">
                            <a href="{{route('termsOfUse')}}">
                                <p class="text-pro-link">
                                    {{isset($staticContent['Terms_of_Use']) 
                                    ? $staticContent['Terms_of_Use']
                                    : "Terms of Use"}}</p>
                            </a>
                        </div>
                        <div class=" ">
                            <a href="{{route('privacyPolicy')}}">
                                <p class="text-pro-link">
                                    {{isset($staticContent['Privacy_Policy']) 
                                    ? $staticContent['Privacy_Policy']
                                    : "Privacy Policy" }}</p>
                            </a>
                        </div>
                        {{-- <div class=" ">
                            <a href="">
                                <p class="text-pro-link">MANUAL</p>

                            </a>
                        </div> --}}
                        <br><br><br>
                        <div class="text-footer-main footer-four">
                            <h6>{{isset($staticContent['Follow_us_on_social']) 
                                ? $staticContent['Follow_us_on_social']
                                : "Follow us on social"}}</h6>
                        </div>

                        <div class="d-flex icon-social">
                            <a href="https://www.facebook.com/DeltaPSU/" target="_blank">
                                <div class="icon-link-footer">
                                    <i class="zmdi zmdi-facebook icon-footer-center"></i>
                                </div>
                            </a>
                            <a href="https://www.linkedin.com/company/deltapsu/" target="_blank">
                                <div class="icon-link-footer">
                                    <i class="zmdi zmdi-linkedin icon-footer-center"></i>
                                </div>
                            </a>

                        </div>
                    </div>{{-- info --}}
                </div>

            </div>
        </div>

    </div>
    <div class="footer-nav">
        <div class="container">
            <ul>Copyright © {{ date('Y') }} Delta. All Rights Reserved.</ul>
            {{-- <ul>Designed by Degito</ul> --}}
        </div>
    </div>
</div>
<div class="visible-touch">
    <div class="subscribe-moblie pad-24px">

        <div class="container text-center">
            <div class="text-title-subscribe">
                <h4>{{$staticContent['Subscribe_to_our_newsletter']}} </h4>
            </div>
            <div class="text-be-first">
                {{$staticContent['Be_the_first_to_hear']}}
            </div>

            <div class="box-input-sub">
                <label for="inp" class="inp">
                    <input type="text" id="inp" placeholder="&nbsp;" data-toggle="modal"
                        data-target="#subscribe-modal">
                    <span class="label text-center">{{$staticContent['Enter_email_address']}}</span>
                    <span class="border"></span>
                </label>

            </div>
            <button class="btn btn-subscribe" onclick="resetfield();" data-toggle="modal"
                data-target="#subscribe-modal"> {{$staticContent['Subscribe']}}</button>
        </div>
    </div>
    <div class="bg-footer-mobile">
        <div class="footer-nav-mobile " id="footer-nav-mobile">
            <div class="w-100 pt-5">
                {{-- Products --}}
                <div class="border-b-2px">
                    <a tabindex="-1" href="#foot-nav-link-list1" data-toggle="collapse"
                        data-target="#foot-nav-link-list1">{{$staticContent['Products']}}<i
                            class="zmdi zmdi-chevron-down"></i></a>
                    <div class="collapse pl-4" id="foot-nav-link-list1" data-parent="#footer-nav-mobile">

                        <a class="text-normal" href="{{ route('allproduct') }}">
                            {{ isset($staticContent['Products_Overview']) ? $staticContent['Products_Overview'] : 'Products Overview' }}
                        </a>

                        @if(isset($navcategories2) && count($navcategories2) > 0)
                        <a class="text-normal" href="{{ route('productList', [$navcategories2->first()->main_cateid]) }}">
                            {{isset($staticContent['Industrial_Power'])?$staticContent['Industrial_Power']:"Industrial Power"}}
                        </a>
                        @endif

                        @if(isset($navcategories1) && count($navcategories1) > 0)
                        <a class="text-normal" href="{{ route('productList', [$navcategories1->first()->main_cateid]) }}">
                            {{isset($staticContent['Medical_Power'])?$staticContent['Medical_Power']:"Medical Power"}}
                        </a>
                        @endif

                        <a class="text-normal" href="{{ route('configurableproduct') }}">
                            {{ isset($staticContent['Configurable_Power']) ? $staticContent['Configurable_Power'] : 'Configurable Power' }}
                        </a>

                        @if(isset($navcategories4) && count($navcategories4) > 0)
                        <a class="text-normal" href="{{ route('productList', [$navcategories4->first()->main_cateid]) }}">
                            {{isset($staticContent['wireless_charging'])? $staticContent['wireless_charging'] :'Industrial Battery Charging' }}
                        </a>
                        @endif

                        @if(isset($navcategories3) && count($navcategories3) > 0)
                        <a class="text-normal" href="{{ route('productList', [$navcategories3->first()->main_cateid]) }}">
                            {{isset($staticContent['LED_Power'])?$staticContent['LED_Power']:"LED Power"}}
                        </a>
                        @endif

                    </div>
                </div>

                {{-- <div class="border-b-2px">
                    <a class="" tabindex="-1" href="#foot-nav-link-list2" data-toggle="collapse"
                        data-target="#foot-nav-link-list2">{{$staticContent['Tools']}}<i
                            class="zmdi zmdi-chevron-down"></i></a>
                    <div class="collapse pl-4" id="foot-nav-link-list2"
                        data-parent="#footer-nav-mobile">
                        <a class="text-normal "
                            href="{{route('productFinder')}}">{{$staticContent['Product_Selector']}}</a>
                        <a class="text-normal "
                            href="{{route('configurableproduct')}}">{{$staticContent['configurable_power_selector']}}</a>
                        <a class="text-normal "
                            href="{{route('productCoparison')}}">{{$staticContent['product_comparison']}}</a>
                    </div>
                </div> --}}

                {{-- Applications --}}
                <div class="border-b-2px">
                    <a class="" tabindex="-1" href="#foot-nav-link-list3" data-toggle="collapse"
                        data-target="#foot-nav-link-list3">{{$staticContent['Applications']}}<i
                            class="zmdi zmdi-chevron-down"></i></a>
                    <div class="collapse pl-4" id="foot-nav-link-list3"
                        data-parent="#footer-nav-mobile">
                        @if(isset($navapplication))
                        @foreach ($navapplication as $app)
                        <a class=" text-normal"
                            href="{{route('appDetail', [ 'name' => $app->slug_app, 'id' => $app->applica_id])}}">{{$app->name}}</a>
                        @endforeach
                        @endif
                    </div>
                </div>

                {{-- Technical Support --}}
                <div class="border-b-2px">
                    <a class="" tabindex="-1" href="#foot-nav-link-list5" data-toggle="collapse"
                        data-target="#foot-nav-link-list5">{{$staticContent['Technical_Support']}}<i
                            class="zmdi zmdi-chevron-down"></i></a>
                    <div class="collapse pl-4" id="foot-nav-link-list5"
                        data-parent="#footer-nav-mobile">
                        <a class="text-normal " href="{{route('index','catalogs')}}">{{$staticContent['catalogs']}}</a>
                        <a class="text-normal " href="{{route('index','product-documents')}}">{{$staticContent['Product_Documents']}}</a>
                        <a class="text-normal " href="{{route('productCoparison')}}">{{$staticContent['product_comparison']}}</a>
                        <a class="text-normal " href="{{route('index', ['page' => 'industry-know-how'])}}">{{isset($staticContent['Industry_Know_How'])
                                ? $staticContent['Industry_Know_How']
                                : 'Industry Know-How' }} </a>
                        <a class="text-normal " href="{{route('index', ['page' => 'videos'])}}">{{$staticContent['Videos']}}</a>
                        <a class="text-normal " href="{{route('index', ['page' => 'product-notice'])}}">{{isset($staticContent['Product_Notice'])
                                ? $staticContent['Product_Notice']
                                : 'Product Notice' }} </a>
                        <a class="text-normal " href="{{route('index', ['page' => 'eol'])}}">{{isset($staticContent['EOL'])
                                ? $staticContent['EOL']
                                : 'EOL' }} </a>
                        <a class="text-normal " href="{{route('index','faqs')}}">{{$staticContent['FAQs']}}</a>
                        <a class="text-normal " href="{{route('contactSupport')}}">{{$staticContent['Technical_Service']}}</a>
                    </div>
                </div>

                {{-- <div class="border-b-2px">
                    <a class="" tabindex="-1" href="#foot-nav-link-list4" data-toggle="collapse"
                        data-target="#foot-nav-link-list4">{{$staticContent['About']}}<i
                            class="zmdi zmdi-chevron-down"></i></a>
                    <div class="collapse pl-4" id="foot-nav-link-list4" data-parent="#footer-nav-mobile">
                        @foreach ($navaboutus as $abt)
                        <a class="text-normal " href="{{route('aboutUs',$abt->stug)}}">{{$abt->title}}</a>
                        @endforeach
                    </div>
                </div> --}}

                {{-- News and Events --}}
                <div class="border-b-2px">
                    <a class="" tabindex="-1" href="#foot-nav-link-list6" data-toggle="collapse"
                        data-target="#foot-nav-link-list6">{{$staticContent['Updates']}}<i
                            class="zmdi zmdi-chevron-down"></i></a>
                    <div class="collapse pl-4" id="foot-nav-link-list6"
                        data-parent="#footer-nav-mobile">
                        <a class="text-normal " href="{{route('index', 'news')}}">{{$staticContent['Product_News']}}</a>
                        <a class="text-normal " href="{{route('index', 'events')}}">{{$staticContent['Events']}}</a>
                    </div>
                </div>

                {{-- <div class="border-b-2px">
                    <a class="" tabindex="-1" href="#foot-nav-link-list6" data-toggle="collapse"
                        data-target="#foot-nav-link-list6">{{$staticContent['Downloads']}}<i
                            class="zmdi zmdi-chevron-down"></i></a>
                    <div class="collapse pl-4" id="foot-nav-link-list6"
                        data-parent="#footer-nav-mobile">
                        <a class="text-normal " href="{{route('index','catalogs')}}">{{$staticContent['catalogs']}}</a>
                        <a class="text-normal "
                            href="{{route('index','product-documents')}}">{{$staticContent['Product_Documents']}}</a>
                    </div>
                </div> --}}

                {{-- Where_to_Buy --}}
                <div class="border-b-2px">
                    <a class="" tabindex="-1" href="#foot-nav-link-list7" data-toggle="collapse"
                        data-target="#foot-nav-link-list7">{{isset($staticContent['Where_to_Buy']) 
                                ? $staticContent['Where_to_Buy'] 
                                : "Where to Buy"}} <i
                            class="zmdi zmdi-chevron-down"></i></a>
                    <div class="collapse pl-4" id="foot-nav-link-list7"
                        data-parent="#footer-nav-mobile">
                        <a class="text-normal " href="{{route('contactSupport')}}">{{$staticContent['contact_us']}}</a>
                        <a class="text-normal "
                            href="{{route('contactFindDistributor')}}">{{$staticContent['find_a_distributor']}}</a>
                        <a class="text-normal "
                            href="{{route('contactSalesOffices')}}">{{$staticContent['sales_offices']}}</a>
                    </div>
                </div>

                {{-- Information --}}
                <div class="border-b-2px">
                    <a class="" tabindex="-1" href="#foot-nav-link-list8" data-toggle="collapse"
                        data-target="#foot-nav-link-list8">{{$staticContent['Information']}} <i
                            class="zmdi zmdi-chevron-down"></i></a>
                    <div class="collapse pl-4" id="foot-nav-link-list8"
                        data-parent="#footer-nav-mobile">
                        <a class="text-normal " href="{{route('termsOfUse')}}">{{$staticContent['Terms_of_Use']}}</a>
                        <a class="text-normal "
                            href="{{route('privacyPolicy')}}">{{$staticContent['Privacy_Policy']}}</a>
                    </div>
                </div>

                <p class="text-center text-bold  mr-t-24px mr-b-1">{{$staticContent['Follow_us_on_social']}}</p>
                <div class="icon-social justify-content-center pad-b-24px w-100 d-flex">
                    <a href="https://www.facebook.com/DeltaPSU/" target="_blank">
                        <div class="icon-link-footer">
                            <i class="zmdi zmdi-facebook icon-footer-center"></i>
                        </div>
                    </a>
                    <a href="https://www.linkedin.com/company/deltapsu/" target="_blank">
                        <div class="icon-link-footer">
                            <i class="zmdi zmdi-linkedin icon-footer-center"></i>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="footer-mobile">
            <div class="container text-center">
                Copyright © {{ date('Y') }} Delta. All Rights Reserved.
            </div>
        </div>
    </div>
</div>


<div class="modal fade p-1" id="subscribe-modal" tabindex="-1" role="dialog" aria-labelledby="subscribe-modal-title"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content ">
            <div class="modal-header pl-4">
                <h4 class="text-color-delta mb-0" id="subscribe-modal-title">
                    {{isset($staticContent['Subscribe']) 
                    ? $staticContent['Subscribe'] 
                    : "Subscribe"}}
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-4 mb-4">
                <form name="frmMr" id="subscribeform" action="{{route('subscribe')}}"
                    onsubmit="return submitsubscribe()" method="POST">
                    {{csrf_field()}}
                    <img class="brand-image my-3" src="{{asset('frontend-asset/image/DeltaPSU-Logo.svg')}}">
                    <p class="text-one">
                        {{isset($staticContent['alert_text_for_read_privacy'])?$staticContent['alert_text_for_read_privacy']:"Subscribe
                        to DeltaPSU newsletter and be the first to know about our new product releases and industry
                        knowledge. Read our"}}<a href="{{route('privacyPolicy')}}" class="text-underline text-bold">
                            {{isset($staticContent['Privacy_Policy'])?$staticContent['Privacy_Policy']:"Privacy
                            Policy"}}</a>.</p>
                    <div class="select input-label w-100 my-4">
                        <h6 class="mb-0"><label class="text-dark">{{$staticContent['Country']}}<span
                                    class="red">*</span></label></h6>
                        <select name="country" class="form-control border-radius-6" id="countryId" required>
                            <option value="">{{isset($staticContent['Select'])? $staticContent['Select'] :"Select"}}
                                {{isset($staticContent['Country'])?$staticContent['Country']:"Country"}}</option>
                            @foreach ($mail_chimp_country as $email)
                            <option value="{{$email->name}}">{{$email->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-label w-100 my-4">
                        <h6 class="mb-0"><label
                                class="text-dark">{{isset($staticContent['Email_Address'])?$staticContent['Email_Address']:"Email
                                Address"}}<span class="red">*</span></label></h6>
                        <input type="email" class="form-control border-radius-6" name="email" required="required"
                            placeholder="Email Address">
                        {{-- <label for="email">Email Address</label> --}}
                    </div>
                    <div class="input-label w-100 my-4">
                        <h6 class="mb-0"><label
                                class="text-dark">{{isset($staticContent['Name'])?$staticContent['Name']:"Name"}}<span
                                    class="red">*</span></label></h6>
                        <input type="text" class="form-control border-radius-6" pattern="[A-Za-zก-๏\s]+" name="name" required="required"
                            placeholder="Name">
                        {{-- <label for="email">Name</label> --}}
                    </div>

                    <h6> {{isset($staticContent['Marketing_Permissions'])?$staticContent['Marketing_Permissions']:"Marketing
                        Permissions"}}<span class="red">*</span></h6>
                    <p class="text-one">{{isset($staticContent['DeltaPSU_will_use_the
                        information_you'])?$staticContent['DeltaPSU_will_use_the information_you']:"DeltaPSU will use
                        the information you provide on this form to be in touch with you."}}</p>
                    <div class="box-input-checkbox my-3 p-3 bg-light-blue">
                        <input name="accept" value="0" class="inp-cbx" id="cxacceptPrivacy_data"
                            onclick="checkacceptPolicy();" type="checkbox" style="display: none;" />
                        <label class="cbx w-100" for="cxacceptPrivacy_data">
                            <span class="">
                                <svg width="12px" height="10px" viewbox="0 0 12 10">
                                    <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                </svg>
                            </span>
                            <span
                                class="col-10 w-100">{{isset($staticContent['I_have_read_and_accept'])?$staticContent['I_have_read_and_accept']:"I
                                have read and accept the Privacy Policy."}} </span></label>
                    </div>

                    <p class="text-one mb-4">
                        {{isset($staticContent['To_unsubscribe'])?$staticContent['To_unsubscribe']:"To unsubscribe,
                        click the link in our newsletter. We will treat your data with respect."}}</p>
                    <div class="mt-3 mb-3" id="recap_vertify_subscribe"></div>
                        <input type="hidden" id="key_input_subscribe" name="keyrecap">
                        <button type="submit"
                            class="btn btn-subscribe">{{isset($staticContent['Subscribe'])?$staticContent['Subscribe']:"Subscribe"}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="accept_Cookie" class="accept-checkCookie">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 p-3 text-center">
                {{isset($staticContent['We_use_cookies_to_provide'])?$staticContent['We_use_cookies_to_provide']:" We
                use cookies to provide the best user experience for those who visit our website. By using this website
                you agree to the placement of cookies and our"}}
                <a href="{{route('privacyPolicy')}}" class="text-underline text-bold">
                    {{isset($staticContent['Privacy_Policy'])?$staticContent['Privacy_Policy']:"Privacy Policy"}}</a>.
                </p>
                <a class="btn btn-subscribe" onclick="setcokie();"
                    href="#">{{isset($staticContent['Accept'])?$staticContent['Accept']:"Accept"}}</a>
            </div>
        </div>
    </div>
</div>
