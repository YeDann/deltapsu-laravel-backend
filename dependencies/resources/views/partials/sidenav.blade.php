<nav id="sidebar" aria-label="Main Navigation">
    <!-- Side Header -->
    <div class="bg-header-dark">
        <div class="content-header">
            <!-- Logo -->
            <img src="{{asset('frontend-asset/image/Group959.svg')}}" style="width:60%;" alt="">
            <!-- END Logo -->
        </div>
    </div>
    <!-- END Side Header -->

    <!-- Side Navigation -->
    <div class="content-side content-side-full">
        <ul class="nav-main">
            <li class="nav-main-item {{(isset($name) && $name == 'Home')?" open":""}}">
                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                    aria-expanded="false" href="#">
                    <span class="nav-main-link-name">HOME</span>
                </a>
                <ul class="nav-main-submenu">
                    <li class="nav-main-item">
                        <a class="nav-main-link {{(isset($menu) && $menu == 'bannerslide')?" active":""}}"
                            href="{{route('bannerSlide.index')}}">
                            <span class="nav-main-link-name">Banner Slide</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link {{(isset($menu) && $menu == 'ProductSection')?" active":""}}"
                            href="{{route('ProductSelection')}}">
                            <span class="nav-main-link-name">Product Selector</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link {{(isset($menu) && $menu == 'static_content')?" active":""}}"
                            href="{{route('static_content' ,1)}}" href="#">
                            <span class="nav-main-link-name">Edit information</span>
                        </a>
                    </li>

                    <li class="nav-main-item">
                        <a class="nav-main-link {{(isset($menu) && $menu == 'featureProduct')?" active":""}}"
                            href="{{route('featureProduct')}}">
                            <span class="nav-main-link-name">The latest Series</span>
                        </a>
                    </li>
                    {{-- <li class="nav-main-item">
                        <a class="nav-main-link {{(isset($menu) && $menu == 'popUp')?" active":""}}"
                            href="{{route('popUp' ,2)}}">
                            <span class="nav-main-link-name">PopUp</span>
                        </a>
                    </li> --}}
                </ul>
            </li>

            <li class="nav-main-item">
                @if($name == "aboutUs")
                <a class="nav-main-link active" href="{{route('AboutUs.index')}}">
                    @else
                    <a class="nav-main-link" href="{{route('AboutUs.index')}}">
                        @endif
                        <span class="nav-main-link-name text-uppercase">About US</span>
                    </a>
            </li>


            @if($name == "product")
            <li class="nav-main-item open">
                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                    aria-expanded="false" href="#">

                    <span class="nav-main-link-name text-uppercase">Product</span>
                </a>
                <ul class="nav-main-submenu">
                    <li class="nav-main-item">
                        @if($menu == "products")
                        <a class="nav-main-link active" href="{{route('products.index')}}">
                            <span class="nav-main-link-name ">Products</span>
                        </a>
                        @else
                        <a class="nav-main-link" href="{{route('products.index')}}">
                            <span class="nav-main-link-name ">Products</span>
                        </a>
                        @endif
                    </li>
                    <li class="nav-main-item">
                        @if($menu == "leatest_pro")
                        <a class="nav-main-link active" href="{{route('lastetproducts')}}">
                            <span class="nav-main-link-name ">Latest Product</span>
                        </a>
                        @else
                        <a class="nav-main-link" href="{{route('lastetproducts')}}">
                            <span class="nav-main-link-name ">Latest Product</span>
                        </a>
                        @endif
                    </li>

                    <li class="nav-main-item">
                        @if($menu == "mainCategories")
                        <a class="nav-main-link active" href="{{route('mainprotype.index')}}">
                            <span class="nav-main-link-name">Main Categories</span>
                        </a>
                        @else
                        <a class="nav-main-link" href="{{route('mainprotype.index')}}">
                            <span class="nav-main-link-name">Main Categories</span>
                        </a>
                        @endif
                    </li>
                    <li class="nav-main-item">
                        @if($menu == "subCategories")
                        <a class="nav-main-link active" href="{{route('subCategories')}}">
                            <span class="nav-main-link-name">Product Categories</span>
                        </a>
                        @else
                        <a class="nav-main-link" href="{{route('subCategories')}}">
                            <span class="nav-main-link-name">Product Categories</span>
                        </a>
                        @endif
                    </li>

                    <li class="nav-main-item">
                        @if($menu == "series")
                        <a class="nav-main-link active" href="{{route('series_all')}}">
                            <span class="nav-main-link-name">Series</span>
                        </a>
                        @else
                        <a class="nav-main-link" href="{{route('series_all')}}">
                            <span class="nav-main-link-name">Series</span>
                        </a>
                        @endif
                    </li>

                    <li class="nav-main-item">
                        @if($menu == "product_field")
                        <a class="nav-main-link active" href="{{route('product-field.index')}}">
                            <span class="nav-main-link-name ">Product Field</span>
                        </a>
                        @else
                        <a class="nav-main-link" href="{{route('product-field.index')}}">
                            <span class="nav-main-link-name ">Product Field</span>
                        </a>
                        @endif
                    </li>
                    <li class="nav-main-item">
                        @if($menu == "section")
                        <a class="nav-main-link active" href="{{route('section.index')}}">
                            <span class="nav-main-link-name">Section</span>
                        </a>
                        @else
                        <a class="nav-main-link" href="{{route('section.index')}}">
                            <span class="nav-main-link-name">Section</span>
                        </a>
                        @endif
                    </li>

                    @if($menu == "external_link")
                    <a class="nav-main-link active" href="{{route('externallist')}}">
                        <span class="nav-main-link-name">External Link </span>
                    </a>
                    @else
                    <a class="nav-main-link" href="{{route('externallist')}}">
                        <span class="nav-main-link-name">External Link</span>
                    </a>
                    @endif
            </li>



        </ul>
        </li>
        @else
        <li class="nav-main-item ">
            <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                aria-expanded="false" href="#">
                <span class="nav-main-link-name text-uppercase">Product</span>
            </a>
            <ul class="nav-main-submenu">
                <li class="nav-main-item">
                    <a class="nav-main-link" href="{{route('products.index')}}">
                        <span class="nav-main-link-name ">Products</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="{{route('lastetproducts')}}">
                        <span class="nav-main-link-name ">Latest Product</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="{{route('mainprotype.index')}}">
                        <span class="nav-main-link-name">Main Categories</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="{{route('subCategories')}}">
                        <span class="nav-main-link-name">Product Categories</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="{{route('series_all')}}">
                        <span class="nav-main-link-name ">Series</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="{{route('product-field.index')}}">
                        <span class="nav-main-link-name ">Product Field</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="{{route('section.index')}}">
                        <span class="nav-main-link-name">Section</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="{{route('externallist')}}">
                        <span class="nav-main-link-name">External Link</span>
                    </a>
                </li>

            </ul>
        </li>
        @endif
        @if($name == "product_doc")
        <li class="nav-main-item open">
            <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                aria-expanded="false" href="#">
                <span class="nav-main-link-name">PRODUCT DOCUMENTS</span>
            </a>
            <ul class="nav-main-submenu">
                <li class="nav-main-item">
                    @if($menu == "secial_lang")
                    <a class="nav-main-link active" href="{{route('SpecialLang')}}">
                        <span class="nav-main-link-name">Special language</span>
                    </a>
                    @else
                    <a class="nav-main-link" href="{{route('SpecialLang')}}">
                        <span class="nav-main-link-name">Special language</span>
                    </a>
                    @endif
                </li>
                <li class="nav-main-item">
                    @if($menu == "muti_doc")
                    <a class="nav-main-link active" href="{{route('docFilerBy' ,1)}}">
                        <span class="nav-main-link-name">Multi Doc Upload</span>
                    </a>
                    @else
                    <a class="nav-main-link" href="{{route('docFilerBy' ,1)}}">
                        <span class="nav-main-link-name">Multi Doc Upload</span>
                    </a>
                    @endif
                </li>
                <li class="nav-main-item">
                    @if($menu == "categories_doc")
                    <a class="nav-main-link active" href="{{route('index_categories')}}">
                        <span class="nav-main-link-name">Document Types</span>
                    </a>
                    @else
                    <a class="nav-main-link" href="{{route('index_categories')}}">
                        <span class="nav-main-link-name">Document Types</span>
                    </a>
                    @endif

                </li>


            </ul>
        </li>
        @else
        <li class="nav-main-item">
            <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                aria-expanded="false" href="#">
                <span class="nav-main-link-name">PRODUCT DOCUMENTS</span>
            </a>
            <ul class="nav-main-submenu">
                <li class="nav-main-item">
                    <a class="nav-main-link" href="{{route('SpecialLang')}}">
                        <span class="nav-main-link-name">Special language</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="{{route('docFilerBy' ,1)}}">
                        <span class="nav-main-link-name">Multi Doc Upload</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="{{route('index_categories')}}">
                        <span class="nav-main-link-name">Document Types</span>
                    </a>
                </li>


            </ul>
        </li>

        @endif

        @if($name == "config_products")
        <li class="nav-main-item open">
            <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                aria-expanded="false" href="#">

                <span class="nav-main-link-name text-uppercase">Configurable Power</span>
            </a>
            <ul class="nav-main-submenu">
                <li class="nav-main-item">
                    <a class="nav-main-link {{($menu == 'config_products_model') ? 'active':''}}"
                        href="{{route('configurableProduct')}}">
                        <span class="nav-main-link-name ">Configurable Model</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link {{($menu == 'config_products_history') ? 'active':''}}"
                        href="{{route('getHistoryConfig')}}">
                        <span class="nav-main-link-name ">Configuration History</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link {{($menu == 'enquiryContact') ? 'active':''}}"
                        href="{{route('getEnquiryContact')}}">
                        <span class="nav-main-link-name ">Enquiry Contact</span>
                    </a>
                </li>

            </ul>
        </li>
        @else
        <li class="nav-main-item">
            <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                aria-expanded="false" href="#">

                <span class="nav-main-link-name text-uppercase">Configurable Power</span>
            </a>
            <ul class="nav-main-submenu">

                <li class="nav-main-item">
                    <a class="nav-main-link" href="{{route('configurableProduct')}}">
                        <span class="nav-main-link-name ">Configurable Model</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="{{route('getHistoryConfig')}}">
                        <span class="nav-main-link-name ">Configuration History</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="{{route('getEnquiryContact')}}">
                        <span class="nav-main-link-name ">Enquiry Contact</span>
                    </a>
                </li>

            </ul>
        </li>
        @endif


        @if($name == "update")
        <li class="nav-main-item open">
            <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                aria-expanded="false" href="#">

                <span class="nav-main-link-name text-uppercase">Updates</span>
            </a>
            <ul class="nav-main-submenu">
                <li class="nav-main-item">
                    @if($menu == "news")
                    <a class="nav-main-link active" href="{{route('news.index')}}">
                        <span class="nav-main-link-name ">Product News</span>
                    </a>
                    @else
                    <a class="nav-main-link" href="{{route('news.index')}}">
                        <span class="nav-main-link-name ">Product News</span>
                    </a>
                    @endif
                </li>
                <li class="nav-main-item">
                    @if($menu == "event")
                    <a class="nav-main-link active" href="{{route('event.index')}}">
                        <span class="nav-main-link-name ">Events</span>
                    </a>
                    @else
                    <a class="nav-main-link" href="{{route('event.index')}}">
                        <span class="nav-main-link-name ">Events</span>
                    </a>
                    @endif
                </li>
                {{-- <li class="nav-main-item">
                    @if($menu == "technical")
                    <a class="nav-main-link active" href="{{route('technical.index')}}">
                        <span class="nav-main-link-name ">Technical Articles</span>
                    </a>
                    @else
                    <a class="nav-main-link" href="{{route('technical.index')}}">
                        <span class="nav-main-link-name ">Technical Articles</span>
                    </a>
                    @endif
                </li> --}}
            </ul>
        </li>
        @else
        <li class="nav-main-item">
            <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                aria-expanded="false" href="#">

                <span class="nav-main-link-name text-uppercase">Updates</span>
            </a>
            <ul class="nav-main-submenu">
                <li class="nav-main-item">
                    <a class="nav-main-link" href="{{route('news.index')}}">
                        <span class="nav-main-link-name ">Product News</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="{{route('event.index')}}">
                        <span class="nav-main-link-name ">Events</span>
                    </a>
                </li>
                {{-- <li class="nav-main-item">
                    <a class="nav-main-link" href="{{route('technical.index')}}">
                        <span class="nav-main-link-name ">Technical Articles</span>
                    </a>
                </li> --}}
            </ul>
        </li>
        @endif

        <li class="nav-main-item">
            @if($name == "application")
            <a class="nav-main-link active" href="{{route('application-view.index')}}">
                @else
                <a class="nav-main-link" href="{{route('application-view.index')}}">
                    @endif

                    <span class="nav-main-link-name text-uppercase">Application View</span>
                </a>
        </li>
        <li class="nav-main-item">
            @if($name == "subscribe")
            <a class="nav-main-link active" href="{{route('subscribers_index')}}">
                @else
                <a class="nav-main-link" href="{{route('subscribers_index')}}">
                    @endif
                    <span class="nav-main-link-name text-uppercase">Subscribe</span>
                </a>
        </li>
        <li class="nav-main-item">
            @if($name == "gui_dowload")
            <a class="nav-main-link active" href="{{route('gui_dowload_index')}}">
                @else
                <a class="nav-main-link" href="{{route('gui_dowload_index')}}">
                    @endif
                    <span class="nav-main-link-name text-uppercase">GUI Downloads</span>
                </a>
        </li>
        {{-- <li class="nav-main-item">
            @if($name == "feedbackEmail")
            <a class="nav-main-link active" href="{{route('emailnotification',1)}}">
                @else
                <a class="nav-main-link" href="{{route('emailnotification',1)}}">
                    @endif
                    <span class="nav-main-link-name text-uppercase">Email Notification</span>
                </a>
        </li> --}}

        <li class="nav-main-item {{$name == " feedbackEmail"?'open':''}}">
            <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                aria-expanded="false" href="#">

                <span class="nav-main-link-name text-uppercase">Email Notification</span>
            </a>
            <ul class="nav-main-submenu">
                <li class="nav-main-item">
                    <a class="nav-main-link" href="{{route('emailnotification',1)}}">
                        <span class="nav-main-link-name ">By Country</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="{{route('emailnotification',2)}}">
                        <span class="nav-main-link-name ">By Subject</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="{{route('emailnotification',3)}}">
                        <span class="nav-main-link-name ">By Product</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-main-item {{(isset($name) && $name == 'Resource')?" open":""}}">
            <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                aria-expanded="false" href="#">
                <span class="nav-main-link-name">RESOURCES</span>
            </a>
            <ul class="nav-main-submenu">
                <li class="nav-main-item {{(isset($menu) && $menu == 'faq')?" open":""}}">
                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                        aria-expanded="false" href="#">
                        <span class="nav-main-link-name">FAQs</span>

                    </a>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item ">
                            <a class="nav-main-link {{(isset($submenu) && $submenu =='faq_categories')?" active":""}}"
                                href="{{route('FaqCategories.index')}}">
                                <span class="nav-main-link-name">Categories</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link {{(isset($submenu) && $submenu =='faq_list')?" active":""}}"
                                href="{{route('Faq.index')}}">
                                <span class="nav-main-link-name">FAQs</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link {{(isset($submenu) && $submenu == 'faqbanner')?" active":""}}"
                                href="{{route('static_content',7)}}" href="#">
                                <span class="nav-main-link-name">FAQs Banner</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-main-item {{(isset($menu) && $menu == 'marketing_resource')?" open":""}}">
                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                        aria-expanded="false" href="#">
                        <span class="nav-main-link-name">Marketing Resources</span>

                    </a>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item ">
                            <a class="nav-main-link {{(isset($submenu) && $submenu =='marketing_categories')?"
                                active":""}}" href="{{route('MarketResourceCategories.index')}}">
                                <span class="nav-main-link-name">Categories</span>

                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link {{(isset($submenu) && $submenu =='market_resource')?" active":""}}"
                                href="{{route('MarketResource.index')}}">
                                <span class="nav-main-link-name">Marketing Resources</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
        <li class="nav-main-item">
            @if($name == "feedbackform")
            <a class="nav-main-link active" href="{{route('feedbackform','All')}}">
                @else
                <a class="nav-main-link" href="{{route('feedbackform','All')}}">
                    @endif
                    <span class="nav-main-link-name text-uppercase">Feedback Form</span>
                </a>
        </li>

        <li class="nav-main-item {{(isset($name) && $name == 'contact_us')?" open":""}}">
            <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                aria-expanded="false" href="#">
                <span class="nav-main-link-name">CONTACT US</span>
            </a>
            <ul class="nav-main-submenu">
                <li class="nav-main-item">
                    <a class="nav-main-link {{(isset($menu) && $menu == 'static_content_8')?" active":""}}"
                        href="{{route('static_content' ,8)}}" href="#">
                        <span class="nav-main-link-name">Edit information</span>
                    </a>
                </li>
                <li class="nav-main-item {{(isset($menu) && $menu == 'sales_offices')?" open":""}}">
                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                        aria-expanded="false" href="#">
                        <span class="nav-main-link-name">Sales Offices</span>

                    </a>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item ">
                            <a class="nav-main-link {{(isset($submenu) && $submenu =='continents_type1')?" active":""}}"
                                href="{{route('getContinent' ,1)}}">
                                <span class="nav-main-link-name">Continents</span>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-main-item {{(isset($menu) && $menu == 'distributors')?" open":""}}">

                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                        aria-expanded="false" href="#">
                        <span class="nav-main-link-name">Distributors</span>

                    </a>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link {{(isset($submenu) && $submenu =='continents_type2')?" active":""}}"
                                href="{{route('getContinent' ,2)}}">
                                <span class="nav-main-link-name">Continents</span>
                            </a>
                        </li>

                    </ul>
                </li>

            </ul>
        </li>


        @if($name == "setting")
        <li class="nav-main-item open">
            <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                aria-expanded="false" href="#">

                <span class="nav-main-link-name text-uppercase">Setting</span>
            </a>
            <ul class="nav-main-submenu">
                <li class="nav-main-item">
                    <a class="nav-main-link {{(isset($menu) && $menu == 'User')?" active":""}}"
                        href="{{route('language.index')}}">
                        <span class="nav-main-link-name ">Language</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link {{(isset($menu) && $menu == 'staticword')?" active":""}}""
                        href="{{route('static_word')}}">
                        <span class="nav-main-link-name ">Static Word</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link {{(isset($menu) && $menu == 'metatags')?" active":""}}""
                        href="{{route('metaTags')}}">
                        <span class="nav-main-link-name ">Meta Tags</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link {{(isset($menu) && $menu == 'privacyPoli')?" active":""}}"
                        href="{{route('static_content' ,5)}}" href="#">
                        <span class="nav-main-link-name">Privacy Policy</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link {{(isset($menu) && $menu == 'termsofuse')?" active":""}}"
                        href="{{route('static_content' ,6)}}" href="#">
                        <span class="nav-main-link-name">Terms of Use</span>
                    </a>
                </li>

            </ul>
        </li>
        @else
        <li class="nav-main-item">
            <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                aria-expanded="false" href="#">

                <span class="nav-main-link-name text-uppercase">Setting</span>
            </a>
            <ul class="nav-main-submenu">
                <li class="nav-main-item">
                    <a class="nav-main-link" href="{{route('language.index')}}">
                        <span class="nav-main-link-name ">Language</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="{{route('static_word')}}">
                        <span class="nav-main-link-name ">Static Word</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="{{route('metaTags')}}">
                        <span class="nav-main-link-name ">Meta Tags</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link {{(isset($menu) && $menu == 'static_content')?" active":""}}"
                        href="{{route('static_content' ,5)}}" href="#">
                        <span class="nav-main-link-name">Privacy Policy</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link {{(isset($menu) && $menu == 'static_content')?" active":""}}"
                        href="{{route('static_content' ,6)}}" href="#">
                        <span class="nav-main-link-name">Terms of Use</span>
                    </a>
                </li>

            </ul>
        </li>
        @endif

        <li class="nav-main-item  {{(isset($name) && $name == 'User')?" open":""}}">
            <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                aria-expanded="false" href="#">

                <span class="nav-main-link-name text-uppercase">User</span>
            </a>
            <ul class="nav-main-submenu">
                <li class="nav-main-item">
                    <a class="nav-main-link  {{(isset($menu) && $menu == 'backenduser')?" active":""}}"
                        href="{{route('backendUser.index')}}">
                        <span class="nav-main-link-name ">BackEnd User</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link  {{(isset($menu) && $menu == 'partner')?" active":""}}"
                        href="{{route('partner.index')}}">
                        <span class="nav-main-link-name ">Partner User</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-main-item  {{(isset($name) && $name == 'partnersAuthenicate')?" open":""}}">
            <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                aria-expanded="false" href="#">
                <span class="nav-main-link-name text-uppercase">Partners</span>
            </a>
            <ul class="nav-main-submenu">
                <li class="nav-main-item">
                    <a class="nav-main-link  {{(isset($menu) && $menu == 'proLaunchSchedule')?" active":""}}"
                        href="{{route('pro_lauch')}}">
                        <span class="nav-main-link-name ">Product Launch Schedule</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link  {{(isset($menu) && $menu == 'succesStory')?" active":""}}"
                        href="{{route('successStory')}}">
                        <span class="nav-main-link-name ">Success Stories</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link  {{(isset($menu) && $menu == 'Sales_Kits')?" active":""}}"
                        href="{{route('partner_doc_index',[1 ,'Sales_Kit'])}}">
                        <span class="nav-main-link-name ">Sales Kit</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link  {{(isset($menu) && $menu == 'Product_Cross_Reference')?" active":""}}"
                        href="{{route('partner_doc_index' ,[2 ,'Product_Cross_Reference'])}}">
                        <span class="nav-main-link-name ">Product Cross Reference</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link  {{(isset($menu) && $menu == 'page_info')?" active":""}}"
                        href="{{route('partner_page')}}">
                        <span class="nav-main-link-name ">Pages information</span>
                    </a>
                </li>


            </ul>
        </li>
        </ul>
    </div>
    <!-- END Side Navigation -->
</nav>