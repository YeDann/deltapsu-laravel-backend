<nav id="sidebar" aria-label="Main Navigation">
    <!-- Side Header -->
    <div class="bg-header-dark">
        <div class="content-header">
            <!-- Logo -->
            <img src="<?php echo e(asset('frontend-asset/image/Group959.svg')); ?>" style="width:60%;" alt="">
            <!-- END Logo -->
        </div>
    </div>
    <!-- END Side Header -->

    <!-- Side Navigation -->
    <div class="content-side content-side-full">
        <ul class="nav-main">
            <li class="nav-main-item <?php echo e((isset($name) && $name == 'Home')?"open":""); ?>">
                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                    aria-expanded="false" href="#">
                    <span class="nav-main-link-name">HOME</span>
                </a>
                <ul class="nav-main-submenu">
                    <li class="nav-main-item">
                    <a class="nav-main-link <?php echo e((isset($menu) && $menu == 'bannerslide')?"active":""); ?>" href="<?php echo e(route('bannerSlide.index')); ?>">
                            <span class="nav-main-link-name">Banner Slide</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link <?php echo e((isset($menu) && $menu == 'ProductSection')?"active":""); ?>" href="<?php echo e(route('ProductSelection')); ?>" >
                            <span class="nav-main-link-name">Product Selector</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link <?php echo e((isset($menu) && $menu == 'static_content')?"active":""); ?>" href="<?php echo e(route('static_content' ,1)); ?>" href="#">
                            <span class="nav-main-link-name">Edit information</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                            <a class="nav-main-link <?php echo e((isset($menu) && $menu == 'featureProduct')?"active":""); ?>" href="<?php echo e(route('featureProduct')); ?>">
                                <span class="nav-main-link-name">The latest Series</span>
                            </a>
                        </li>
                        
                </ul>
            </li>

            <li class="nav-main-item">
                <?php if($name == "aboutUs"): ?>
                <a class="nav-main-link active" href="<?php echo e(route('AboutUs.index')); ?>">
                    <?php else: ?>
                    <a class="nav-main-link" href="<?php echo e(route('AboutUs.index')); ?>">
                        <?php endif; ?>
                        <span class="nav-main-link-name text-uppercase">About US</span>
                    </a>
            </li>


            <?php if($name == "product"): ?>
            <li class="nav-main-item open">
                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                    aria-expanded="false" href="#">

                    <span class="nav-main-link-name text-uppercase">Product</span>
                </a>
                <ul class="nav-main-submenu">
                    <li class="nav-main-item">
                        <?php if($menu == "products"): ?>
                        <a class="nav-main-link active" href="<?php echo e(route('products.index')); ?>">
                            <span class="nav-main-link-name ">Products</span>
                        </a>
                        <?php else: ?>
                        <a class="nav-main-link" href="<?php echo e(route('products.index')); ?>">
                            <span class="nav-main-link-name ">Products</span>
                        </a>
                        <?php endif; ?>
                    </li>
                    <li class="nav-main-item">
                        <?php if($menu == "leatest_pro"): ?>
                        <a class="nav-main-link active" href="<?php echo e(route('lastetproducts')); ?>">
                            <span class="nav-main-link-name ">Latest Product</span>
                        </a>
                        <?php else: ?>
                        <a class="nav-main-link" href="<?php echo e(route('lastetproducts')); ?>">
                            <span class="nav-main-link-name ">Latest Product</span>
                        </a>
                        <?php endif; ?>
                    </li>

                    <li class="nav-main-item">
                        <?php if($menu == "mainCategories"): ?>
                        <a class="nav-main-link active" href="<?php echo e(route('mainprotype.index')); ?>">
                    <span class="nav-main-link-name">Main Categories</span>
                    </a>
                    <?php else: ?>
                    <a class="nav-main-link" href="<?php echo e(route('mainprotype.index')); ?>">
                        <span class="nav-main-link-name">Main Categories</span>
                    </a>
                    <?php endif; ?>
            </li>
            <li class="nav-main-item">
                <?php if($menu == "subCategories"): ?>
                <a class="nav-main-link active" href="<?php echo e(route('subCategories')); ?>">
                    <span class="nav-main-link-name">Product Categories</span>
                </a>
                <?php else: ?>
                <a class="nav-main-link" href="<?php echo e(route('subCategories')); ?>">
                    <span class="nav-main-link-name">Product Categories</span>
                </a>
                <?php endif; ?>
            </li>

            <li class="nav-main-item">
                <?php if($menu == "series"): ?>
                <a class="nav-main-link active" href="<?php echo e(route('series_all')); ?>">
                    <span class="nav-main-link-name">Series</span>
                </a>
                <?php else: ?>
                <a class="nav-main-link" href="<?php echo e(route('series_all')); ?>">
                    <span class="nav-main-link-name">Series</span>
                </a>
                <?php endif; ?>
            </li>

            <li class="nav-main-item">
                <?php if($menu == "product_field"): ?>
                <a class="nav-main-link active" href="<?php echo e(route('product-field.index')); ?>">
                    <span class="nav-main-link-name ">Product Field</span>
                </a>
                <?php else: ?>
                <a class="nav-main-link" href="<?php echo e(route('product-field.index')); ?>">
                    <span class="nav-main-link-name ">Product Field</span>
                </a>
                <?php endif; ?>
            </li>
            <li class="nav-main-item">
            <?php if($menu == "section"): ?>
          <a class="nav-main-link active" href="<?php echo e(route('section.index')); ?>">
            <span class="nav-main-link-name">Section</span>
            </a>
            <?php else: ?>
            <a class="nav-main-link" href="<?php echo e(route('section.index')); ?>">
                <span class="nav-main-link-name">Section</span>
            </a>
            <?php endif; ?>
            </li>

        </ul>
        </li>
        <?php else: ?>
        <li class="nav-main-item ">
            <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                aria-expanded="false" href="#">
                <span class="nav-main-link-name text-uppercase">Product</span>
            </a>
            <ul class="nav-main-submenu">
                <li class="nav-main-item">
                    <a class="nav-main-link" href="<?php echo e(route('products.index')); ?>">
                        <span class="nav-main-link-name ">Products</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="<?php echo e(route('lastetproducts')); ?>">
                        <span class="nav-main-link-name ">Latest Product</span>
                    </a>
                </li>
                <li class="nav-main-item">
                        <a class="nav-main-link" href="<?php echo e(route('mainprotype.index')); ?>">
                <span class="nav-main-link-name">Main Categories</span>
                </a>
        </li>
        <li class="nav-main-item">
            <a class="nav-main-link" href="<?php echo e(route('subCategories')); ?>">
                <span class="nav-main-link-name">Product Categories</span>
            </a>
        </li>
        <li class="nav-main-item">
        <a class="nav-main-link" href="<?php echo e(route('series_all')); ?>">
            <span class="nav-main-link-name ">Series</span>
        </a>
        </li>
        <li class="nav-main-item">
            <a class="nav-main-link" href="<?php echo e(route('product-field.index')); ?>">
                <span class="nav-main-link-name ">Product Field</span>
            </a>
        </li>
        <li class="nav-main-item">
                        <a class="nav-main-link" href="<?php echo e(route('section.index')); ?>">
        <span class="nav-main-link-name">Section</span>
        </a>
        </li>

        </ul>
        </li>
        <?php endif; ?>
        <?php if($name == "product_doc"): ?>
        <li class="nav-main-item open">
            <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                aria-expanded="false" href="#">
                <span class="nav-main-link-name">PRODUCT DOCUMENTS</span>
            </a>
            <ul class="nav-main-submenu">
                <li class="nav-main-item">
                    <?php if($menu == "secial_lang"): ?>
                    <a class="nav-main-link active" href="<?php echo e(route('SpecialLang')); ?>">
                        <span class="nav-main-link-name">Special language</span>
                    </a>
                    <?php else: ?>
                    <a class="nav-main-link" href="<?php echo e(route('SpecialLang')); ?>">
                        <span class="nav-main-link-name">Special language</span>
                    </a>
                    <?php endif; ?>
                </li>
                <li class="nav-main-item">
                    <?php if($menu == "muti_doc"): ?>
                    <a class="nav-main-link active" href="<?php echo e(route('docFilerBy' ,1)); ?>">
                        <span class="nav-main-link-name">Multi Doc Upload</span>
                    </a>
                    <?php else: ?>
                    <a class="nav-main-link" href="<?php echo e(route('docFilerBy' ,1)); ?>">
                        <span class="nav-main-link-name">Multi Doc Upload</span>
                    </a>
                    <?php endif; ?>
                </li>
                <li class="nav-main-item">
                    <?php if($menu == "categories_doc"): ?>
                    <a class="nav-main-link active" href="<?php echo e(route('index_categories')); ?>">
                        <span class="nav-main-link-name">Document Types</span>
                    </a>
                    <?php else: ?>
                    <a class="nav-main-link" href="<?php echo e(route('index_categories')); ?>">
                        <span class="nav-main-link-name">Document Types</span>
                    </a>
                    <?php endif; ?>

                </li>


            </ul>
        </li>
        <?php else: ?>
        <li class="nav-main-item">
            <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                aria-expanded="false" href="#">
                <span class="nav-main-link-name">PRODUCT DOCUMENTS</span>
            </a>
            <ul class="nav-main-submenu">
                <li class="nav-main-item">
                    <a class="nav-main-link" href="<?php echo e(route('SpecialLang')); ?>">
                        <span class="nav-main-link-name">Special language</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="<?php echo e(route('docFilerBy' ,1)); ?>">
                        <span class="nav-main-link-name">Multi Doc Upload</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="<?php echo e(route('index_categories')); ?>">
                        <span class="nav-main-link-name">Document Types</span>
                    </a>
                </li>


            </ul>
        </li>

        <?php endif; ?>

        <?php if($name == "config_products"): ?>
        <li class="nav-main-item open">
            <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                aria-expanded="false" href="#">

                <span class="nav-main-link-name text-uppercase">Configurable Power</span>
            </a>
            <ul class="nav-main-submenu">
                <li class="nav-main-item">
                   <a class="nav-main-link <?php echo e(($menu == 'config_products_model') ? 'active':''); ?>" href="<?php echo e(route('configurableProduct')); ?>">
                        <span class="nav-main-link-name ">Configurable Model</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link <?php echo e(($menu == 'config_products_history') ? 'active':''); ?>"  href="<?php echo e(route('getHistoryConfig')); ?>">
                        <span class="nav-main-link-name ">Configuration History</span>
                    </a>
                </li>
                <li class="nav-main-item"> 
                    <a class="nav-main-link <?php echo e(($menu == 'enquiryContact') ? 'active':''); ?>" href="<?php echo e(route('getEnquiryContact')); ?>">
                        <span class="nav-main-link-name ">Enquiry Contact</span>
                    </a>
                </li>
            </ul>
        </li>
        <?php else: ?>
        <li class="nav-main-item">
            <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                aria-expanded="false" href="#">

                <span class="nav-main-link-name text-uppercase">Configurable Power</span>
            </a>
            <ul class="nav-main-submenu">

                <li class="nav-main-item">
                <a class="nav-main-link" href="<?php echo e(route('configurableProduct')); ?>">
                        <span class="nav-main-link-name ">Configurable Model</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="<?php echo e(route('getHistoryConfig')); ?>">
                        <span class="nav-main-link-name ">Configuration History</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="<?php echo e(route('getEnquiryContact')); ?>">
                        <span class="nav-main-link-name ">Enquiry Contact</span>
                    </a>
                </li>
            </ul>
        </li>
        <?php endif; ?>


        <?php if($name == "update"): ?>
        <li class="nav-main-item open">
            <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                aria-expanded="false" href="#">

                <span class="nav-main-link-name text-uppercase">Updates</span>
            </a>
            <ul class="nav-main-submenu">
                <li class="nav-main-item">
                    <?php if($menu == "news"): ?>
                    <a class="nav-main-link active" href="<?php echo e(route('news.index')); ?>">
                        <span class="nav-main-link-name ">Product News</span>
                    </a>
                    <?php else: ?>
                    <a class="nav-main-link" href="<?php echo e(route('news.index')); ?>">
                        <span class="nav-main-link-name ">Product News</span>
                    </a>
                    <?php endif; ?>
                </li>
                <li class="nav-main-item">
                    <?php if($menu == "event"): ?>
                    <a class="nav-main-link active" href="<?php echo e(route('event.index')); ?>">
                        <span class="nav-main-link-name ">Events</span>
                    </a>
                    <?php else: ?>
                    <a class="nav-main-link" href="<?php echo e(route('event.index')); ?>">
                        <span class="nav-main-link-name ">Events</span>
                    </a>
                    <?php endif; ?>
                </li>
                <li class="nav-main-item">
                    <?php if($menu == "technical"): ?>
                    <a class="nav-main-link active" href="<?php echo e(route('technical.index')); ?>">
                        <span class="nav-main-link-name ">Technical Articles</span>
                    </a>
                    <?php else: ?>
                    <a class="nav-main-link" href="<?php echo e(route('technical.index')); ?>">
                        <span class="nav-main-link-name ">Technical Articles</span>
                    </a>
                    <?php endif; ?>
                </li>
            </ul>
        </li>
        <?php else: ?>
        <li class="nav-main-item">
            <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                aria-expanded="false" href="#">

                <span class="nav-main-link-name text-uppercase">Updates</span>
            </a>
            <ul class="nav-main-submenu">
                <li class="nav-main-item">
                    <a class="nav-main-link" href="<?php echo e(route('news.index')); ?>">
                        <span class="nav-main-link-name ">Product News</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="<?php echo e(route('event.index')); ?>">
                        <span class="nav-main-link-name ">Events</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="<?php echo e(route('technical.index')); ?>">
                        <span class="nav-main-link-name ">Technical Articles</span>
                    </a>
                </li>
            </ul>
        </li>
        <?php endif; ?>

        <li class="nav-main-item">
            <?php if($name == "application"): ?>
            <a class="nav-main-link active" href="<?php echo e(route('application-view.index')); ?>">
                <?php else: ?>
                <a class="nav-main-link" href="<?php echo e(route('application-view.index')); ?>">
                    <?php endif; ?>

                    <span class="nav-main-link-name text-uppercase">Application View</span>
                </a>
        </li>
        <li class="nav-main-item">
                <?php if($name == "subscribe"): ?>
                <a class="nav-main-link active" href="<?php echo e(route('subscribers_index')); ?>">
                <?php else: ?>
                <a class="nav-main-link" href="<?php echo e(route('subscribers_index')); ?>">
                <?php endif; ?>
                <span class="nav-main-link-name text-uppercase">Subscribe</span>
                </a>
        </li>
        <li class="nav-main-item">
            <?php if($name == "gui_dowload"): ?>
            <a class="nav-main-link active" href="<?php echo e(route('gui_dowload_index')); ?>">
            <?php else: ?>
            <a class="nav-main-link" href="<?php echo e(route('gui_dowload_index')); ?>">
            <?php endif; ?>
            <span class="nav-main-link-name text-uppercase">GUI Downloads</span>
            </a>
    </li>
        

    <li class="nav-main-item <?php echo e($name == "feedbackEmail"?'open':''); ?>">
            <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                aria-expanded="false" href="#">

                <span class="nav-main-link-name text-uppercase">Email Notification</span>
            </a>
            <ul class="nav-main-submenu">
                <li class="nav-main-item">
                    <a class="nav-main-link" href="<?php echo e(route('emailnotification',1)); ?>">
                        <span class="nav-main-link-name ">By Country</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="<?php echo e(route('emailnotification',2)); ?>">
                        <span class="nav-main-link-name ">By Subject</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="<?php echo e(route('emailnotification',3)); ?>">
                        <span class="nav-main-link-name ">By Product</span>
                    </a>
                </li>
            </ul>
        </li>
     
        <li class="nav-main-item <?php echo e((isset($name) && $name == 'Resource')?"open":""); ?>">
            <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                <span class="nav-main-link-name">RESOURCES</span>
            </a>
            <ul class="nav-main-submenu">
                <li class="nav-main-item <?php echo e((isset($menu) && $menu == 'faq')?"open":""); ?>">
                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                        <span class="nav-main-link-name">FAQs</span>
                       
                    </a>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item ">
                           <a class="nav-main-link <?php echo e((isset($submenu) && $submenu =='faq_categories')?"active":""); ?>" href="<?php echo e(route('FaqCategories.index')); ?>">
                                <span class="nav-main-link-name">Categories</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link <?php echo e((isset($submenu) && $submenu =='faq_list')?"active":""); ?>" href="<?php echo e(route('Faq.index')); ?>">
                                <span class="nav-main-link-name">FAQs</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link <?php echo e((isset($submenu) && $submenu == 'faqbanner')?"active":""); ?>" href="<?php echo e(route('static_content',7)); ?>" href="#">
                                <span class="nav-main-link-name">FAQs Banner</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-main-item <?php echo e((isset($menu) && $menu == 'marketing_resource')?"open":""); ?>">
                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                        <span class="nav-main-link-name">Marketing Resources</span>
                       
                    </a>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item ">
                        <a class="nav-main-link <?php echo e((isset($submenu) && $submenu =='marketing_categories')?"active":""); ?>" href="<?php echo e(route('MarketResourceCategories.index')); ?>">
                                <span class="nav-main-link-name">Categories</span>
                               
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link <?php echo e((isset($submenu) && $submenu =='market_resource')?"active":""); ?>" href="<?php echo e(route('MarketResource.index')); ?>">
                                <span class="nav-main-link-name">Marketing Resources</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
        <li class="nav-main-item">
            <?php if($name == "feedbackform"): ?>
            <a class="nav-main-link active" href="<?php echo e(route('feedbackform','All')); ?>">
            <?php else: ?>
            <a class="nav-main-link" href="<?php echo e(route('feedbackform','All')); ?>">
            <?php endif; ?>
            <span class="nav-main-link-name text-uppercase">Feedback Form</span>
            </a>
       </li>

        <li class="nav-main-item <?php echo e((isset($name) && $name == 'contact_us')?"open":""); ?>">
                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                    <span class="nav-main-link-name">CONTACT US</span>
                </a>
                <ul class="nav-main-submenu">
                    <li class="nav-main-item <?php echo e((isset($menu) && $menu == 'sales_offices')?"open":""); ?>">
                        <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                            <span class="nav-main-link-name">Sales Offices</span>
                           
                        </a>
                        <ul class="nav-main-submenu">
                        <li class="nav-main-item ">
                               <a class="nav-main-link <?php echo e((isset($submenu) && $submenu =='continents_type1')?"active":""); ?>"  href="<?php echo e(route('getContinent' ,1)); ?>">
                                    <span class="nav-main-link-name">Continents</span>
                                </a>
                            </li>
                           
                        </ul>
                    </li>
                    <li class="nav-main-item <?php echo e((isset($menu) && $menu == 'distributors')?"open":""); ?>">
                            <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                                <span class="nav-main-link-name">Distributors</span>
                               
                            </a>
                            <ul class="nav-main-submenu">
                            <li class="nav-main-item">
                                   <a class="nav-main-link <?php echo e((isset($submenu) && $submenu =='continents_type2')?"active":""); ?>" href="<?php echo e(route('getContinent' ,2)); ?>">
                                        <span class="nav-main-link-name">Continents</span>
                                    </a>
                                </li>
                               
                            </ul>
                        </li>
                 
                </ul>
            </li>
       
    
        <?php if($name == "setting"): ?>
        <li class="nav-main-item open">
            <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                aria-expanded="false" href="#">

                <span class="nav-main-link-name text-uppercase">Setting</span>
            </a>
            <ul class="nav-main-submenu">
                <li class="nav-main-item">
                        <a class="nav-main-link <?php echo e((isset($menu) && $menu == 'User')?"active":""); ?>" href="<?php echo e(route('language.index')); ?>">
                            <span class="nav-main-link-name ">Language</span>
                        </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link <?php echo e((isset($menu) && $menu == 'staticword')?"active":""); ?>"" href="<?php echo e(route('static_word')); ?>">
                        <span class="nav-main-link-name ">Static Word</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link <?php echo e((isset($menu) && $menu == 'metatags')?"active":""); ?>"" href="<?php echo e(route('metaTags')); ?>">
                        <span class="nav-main-link-name ">Meta Tags</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link <?php echo e((isset($menu) && $menu == 'privacyPoli')?"active":""); ?>" href="<?php echo e(route('static_content' ,5)); ?>" href="#">
                        <span class="nav-main-link-name">Privacy Policy</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link <?php echo e((isset($menu) && $menu == 'termsofuse')?"active":""); ?>" href="<?php echo e(route('static_content' ,6)); ?>" href="#">
                        <span class="nav-main-link-name">Terms of Use</span>
                    </a>
                </li>
            </ul>
        </li>
        <?php else: ?>
        <li class="nav-main-item">
            <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                aria-expanded="false" href="#">

                <span class="nav-main-link-name text-uppercase">Setting</span>
            </a>
            <ul class="nav-main-submenu">
                <li class="nav-main-item">
                    <a class="nav-main-link" href="<?php echo e(route('language.index')); ?>">
                        <span class="nav-main-link-name ">Language</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="<?php echo e(route('static_word')); ?>">
                        <span class="nav-main-link-name ">Static Word</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="<?php echo e(route('metaTags')); ?>">
                        <span class="nav-main-link-name ">Meta Tags</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link <?php echo e((isset($menu) && $menu == 'static_content')?"active":""); ?>" href="<?php echo e(route('static_content' ,5)); ?>" href="#">
                        <span class="nav-main-link-name">Privacy Policy</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link <?php echo e((isset($menu) && $menu == 'static_content')?"active":""); ?>" href="<?php echo e(route('static_content' ,6)); ?>" href="#">
                        <span class="nav-main-link-name">Terms of Use</span>
                    </a>
                </li>
              
            </ul>
        </li>
        <?php endif; ?>

        <li class="nav-main-item  <?php echo e((isset($name) && $name == 'User')?"open":""); ?>">
            <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                aria-expanded="false" href="#">

                <span class="nav-main-link-name text-uppercase">User</span>
            </a>
            <ul class="nav-main-submenu">
                <li class="nav-main-item">
                       <a class="nav-main-link  <?php echo e((isset($menu) && $menu == 'backenduser')?"active":""); ?>" href="<?php echo e(route('backendUser.index')); ?>">
                        <span class="nav-main-link-name ">BackEnd User</span>
                       </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link  <?php echo e((isset($menu) && $menu == 'partner')?"active":""); ?>" href="<?php echo e(route('partner.index')); ?>">
                     <span class="nav-main-link-name ">Partner User</span>
                    </a>
             </li>
            </ul>
        </li>
        <li class="nav-main-item  <?php echo e((isset($name) && $name == 'partnersAuthenicate')?"open":""); ?>">
            <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                aria-expanded="false" href="#">
                <span class="nav-main-link-name text-uppercase">Partners</span>
            </a>
            <ul class="nav-main-submenu">
                <li class="nav-main-item">
                       <a class="nav-main-link  <?php echo e((isset($menu) && $menu == 'proLaunchSchedule')?"active":""); ?>" href="<?php echo e(route('pro_lauch')); ?>">
                        <span class="nav-main-link-name ">Product Launch Schedule</span>
                       </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link  <?php echo e((isset($menu) && $menu == 'succesStory')?"active":""); ?>" href="<?php echo e(route('successStory')); ?>">
                     <span class="nav-main-link-name ">Success Stories</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link  <?php echo e((isset($menu) && $menu == 'Sales_Kits')?"active":""); ?>" href="<?php echo e(route('partner_doc_index',[1 ,'Sales_Kit'])); ?>">
                     <span class="nav-main-link-name ">Sales Kit</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link  <?php echo e((isset($menu) && $menu == 'Product_Cross_Reference')?"active":""); ?>" href="<?php echo e(route('partner_doc_index' ,[2 ,'Product_Cross_Reference'])); ?>">
                     <span class="nav-main-link-name ">Product Cross Reference</span>
                    </a>
                </li>
                <li class="nav-main-item">
                <a class="nav-main-link  <?php echo e((isset($menu) && $menu == 'page_info')?"active":""); ?>" href="<?php echo e(route('partner_page')); ?>">
                     <span class="nav-main-link-name ">Pages information</span>
                    </a>
                </li>
              
                
            </ul>
        </li>
        </ul>
    </div>
    <!-- END Side Navigation -->
</nav>
<?php /**PATH C:\xampp\htdocs\Deltapsu_Production\dependencies\resources\views/partials/sidenav.blade.php ENDPATH**/ ?>