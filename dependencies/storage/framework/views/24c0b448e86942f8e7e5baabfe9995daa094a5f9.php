<style>
.select-language{
    color: #444444;
    font-size: 16px;
    font-weight: bold;
    -webkit-appearance: none;
    -moz-appearance: none;
    border-radius: 0;
    border: 1px solid transparent; background-position: right 50%;
    background-repeat: no-repeat;
    background-size: 12px;
    background-image: url('<?php echo e(asset('frontend-asset/image/arrow.svg')); ?>');
    width: 50px;
    background-color:#fff;

}
.select-language:disabled, .select-language[readonly] {
    background-color: #F2F2F2;
    border: 1px solid transparent !important;
    opacity: 1;
    color: #0087DC;
    background-image:unset;
}
.select-language:focus {
    color: #0087DC;
    background-color: #fff;
    border-color: transparent;
    outline: unset;
    box-shadow: unset;
}
.navbar-searchandlang{
        margin-right: 0.2rem !important;
    }
/* @media  only screen and (max-width:768px){
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
.pad-logout{
    padding:0 5px;
    color: #444444;
}
.h-20{
    height: 20px;
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
  margin-left: -2px;
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
  line-height: 60px;
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
  padding: 0 28px  0 57px;
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
.demo-icon{
    font-size: 35px;
    margin-left: 4px;
}
.img-pop li .spotify {
  background: rgba(39, 174, 96, 0.1);
  border-color: #27ae60;
  color: #27ae60;
}
.img-pop li .spotify:hover {
  background: #27ae60;
}
.img-pop li .soundcloud {
  background: rgba(230, 126, 34, 0.1);
  border-color: #e67e22;
  color: #e67e22;
}
.img-pop li .soundcloud:hover {
  background: #e67e22;
}
.img-pop li .skype {
    background: #E3EFF8;
    border-color: #0087DC;
    color: #0087DC;
}
.img-pop li .skype:hover {
    background: #0087DC;
}
.img-pop li .dribbble {
  background: rgba(210, 82, 127, 0.1);
  border-color: #D2527F;
  color: #D2527F;
}
.img-pop li .dribbble:hover {
  background: #d2527f;
}
.fs-front{
    font-size: 16px;
    text-decoration: none !important;
}
.fs-front:hover{
    color: #0087DC;
}
@media  only screen and (min-width:0px) and (max-width:450px){

.demo-icon {
font-size: 25px;
margin-left: 7px;
position: relative;
top: -9px;
}

.img-pop li a {
    height: 45px;
    width: 45px;

}
.img-pop li a span {
    top: -11px;
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
.icon-serch{
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
.font-size-tab{
    color: #0087DC !important;
}

.cur-link{
  cursor: pointer;
}

</style>

<div class="invisible-nav-minimize">
  
    <div class="nav-firts ">
      <div class="alert-browser" id="alert-browser-check" style="display: none;">
        <div class="color-yellow" >
            You seem to be using an unsupported browser. We recommend using the latest version of Chrome, Firefox or Safari.
        </div>
      </div>
        <div class="container">
            <?php if(session('partner_id') == null): ?>
            <a class="d-flex" href="<?php echo e(route('index','login')); ?>">
            <img class="mr-1" src="<?php echo e(asset('frontend-asset/image/person-login.svg')); ?>" alt="">
            <div class="link-nav-first" >
                <?php echo e(isset($staticContent['Login']) ? $staticContent['Login']:''); ?>

            </div> 
            </a> <span class="fs-front">|</span>
            <?php else: ?> 
          
            <a class="pad-logout fs-front" href="<?php echo e(route('index','login')); ?>"> <img  src="<?php echo e(asset('frontend-asset/image/person-login.svg')); ?>" alt=""><?php echo e(session('partner_firstname')); ?></a> <span class="fs-front">/</span> <a href="<?php echo e(route('index','logoutfrontend')); ?>" class="pad-logout fs-front"><?php echo e($staticContent['Logout']); ?></a> 
            <span class="fs-front">|</span>
            <?php endif; ?>
            <a class="d-flex" onclick="subscribe()" data-toggle="modal" data-target="#subscribe-modal">
            <img class="mr-1" src="<?php echo e(asset('frontend-asset/image/sub-new.svg')); ?>" alt="">
            <div class="link-nav-first">
      
             <?php echo e(isset($staticContent['Subscribe']) ? $staticContent['Subscribe']:''); ?>

            </div>
            </a> 
            <span class="fs-front">|</span>
            <a class="lang-space link-nav-first dropdown-toggle text-uppercase" id="dropdown06"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <?php echo e(App::getLocale()); ?>

                <i class="zmdi zmdi-chevron-down"></i></a>
            <div class="dropdown-menu" aria-labelledby="about-us">
              
                <?php $__currentLoopData = $language; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php 
                $current = null;
                foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties) { 
                    if ($item->name == $localeCode) {
                        $current = $localeCode;
                        break;
                    }
                }
               ?>
             <a onclick="setlocaltion('<?php echo e($current); ?>','<?php echo e(LaravelLocalization::getLocalizedURL($current, null, [], true)); ?>');" class="dropdown-item lang-drop-down text-uppercase cur-link <?php echo e(App::getLocale()== $current ? 'active' : ''); ?>"  ><?php echo e($current); ?></a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

        </div>

    </div>
    <div class="nav-position scrolled">
        <div class="container nav-here">

            <a class="navbar-brand" href="<?php echo e(route('index','home')); ?>">
                <img class="brand-image mt-1" src="<?php echo e(asset('frontend-asset/image/DeltaPSU-Logo.svg')); ?>">
            </a>
            <a class="nav-search nav-link" 
                id="dropdown08" >
                <div class="nav-search-btn"> <?php echo e($staticContent['Search']); ?> <i class="fa fa-search"></i>
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
                        <input type="text" name="keysearch"  id="searchinput" placeholder="<?php echo e($staticContent['Search_by_keyword']); ?>">
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
            <div class="collapse navbar-collapse" id="navbar">
                <ul id="nav-all" class="navbar-nav mr-center-nav">

                    <li class="nav-item dropdown">
                        <a id="nav-uderline" class="nav-link dropdown-toggle"  id="dropdown01"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo e($staticContent['Products']); ?>

                            <i class="zmdi zmdi-chevron-down"></i>
                        </a>
                        <div class="dropdown-menu sp-dropdown" role="menu" aria-labelledby="dropdown01">
                            <div class="dropdown-submenu">
                                <a id="sub1" class="sub-menu dropdown-item " onclick="mainCate('sub1')" tabindex="-1" href="#"><?php echo e($staticContent['Industrial_Power']); ?> <i
                                        class="zmdi zmdi-chevron-right"></i></a>
                                <ul class="dropdown-menu drp-subthree">
                                    <?php $__currentLoopData = $navcategories2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subCate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($subCate->main_cateid == 1): ?>
                                    <li><a tabindex="-1" class="" onmouseover="bigImg('<?php echo e($subCate->image_type1); ?>',2)" href="<?php echo e(route('allproductsByType' ,[preg_replace('/\s+/', '_', $subCate->name),$subCate->sub_pro_id ,2])); ?>"><?php echo e($subCate->name); ?> </a>
                                    </li>
                                    <?php elseif($subCate->main_cateid == 2): ?>
                                    <li><a tabindex="-1" class="" onmouseover="bigImg('<?php echo e($subCate->image_type2); ?>',2)" href="<?php echo e(route('allproductsByType' ,[preg_replace('/\s+/', '_', $subCate->name),$subCate->sub_pro_id ,2])); ?>"><?php echo e($subCate->name); ?> </a>
                                    </li>
                                    <?php elseif($subCate->main_cateid == 3): ?>
                                    <li><a tabindex="-1" class="" onmouseover="bigImg('<?php echo e($subCate->image_type3); ?>',2)" href="<?php echo e(route('allproductsByType' ,[preg_replace('/\s+/', '_', $subCate->name),$subCate->sub_pro_id ,2])); ?>"><?php echo e($subCate->name); ?> </a>
                                    </li>
                                    <?php else: ?> 
                                    <li><a tabindex="-1" class="" onmouseover="bigImg('<?php echo e($subCate->image); ?>',2)" href="<?php echo e(route('allproductsByType' ,[preg_replace('/\s+/', '_', $subCate->name),$subCate->sub_pro_id ,2])); ?>"><?php echo e($subCate->name); ?> </a>
                                    </li>
                                    <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <div class="image-dropdown d-flex justify-content-center " style="background: linear-gradient(to bottom, #fff, transparent, transparent),url('<?php echo e(asset('frontend-asset/image/Dropdown.jpg')); ?>')no-repeat;">
                                        <img class="imageNav2 img-hove-on-dropdown" src="<?php echo e(asset('frontend-asset/image/Industrial_Power_Supplies.png')); ?>" alt="">
                                    </div>
                                </ul>
                            </div>
                            <div class="dropdown-submenu">
                                <a id="sub2" class="sub-menu" onclick="mainCate('sub2')" tabindex="-1" href="#"><?php echo e($staticContent['Medical_Power']); ?> <i
                                        class="zmdi zmdi-chevron-right"></i></a>
                                <ul class="dropdown-menu drp-subthree">
                             
                                    <?php $__currentLoopData = $navcategories1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subCate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($subCate->main_cateid == 1): ?>
                                    <li><a tabindex="-1" class="" onmouseover="bigImg('<?php echo e($subCate->image_type1); ?>',1)" href="<?php echo e(route('allproductsByType' ,[preg_replace('/\s+/', '_', $subCate->name),$subCate->sub_pro_id ,1])); ?>"><?php echo e($subCate->name); ?> </a>
                                    </li>
                                    <?php elseif($subCate->main_cateid == 2): ?>
                                    <li><a tabindex="-1" class="" onmouseover="bigImg('<?php echo e($subCate->image_type2); ?>',1)" href="<?php echo e(route('allproductsByType' ,[preg_replace('/\s+/', '_', $subCate->name),$subCate->sub_pro_id ,1])); ?>"><?php echo e($subCate->name); ?> </a>
                                    </li>
                                    <?php elseif($subCate->main_cateid == 3): ?>
                                    <li><a tabindex="-1" class="" onmouseover="bigImg('<?php echo e($subCate->image_type3); ?>',1)" href="<?php echo e(route('allproductsByType' ,[preg_replace('/\s+/', '_', $subCate->name),$subCate->sub_pro_id ,1])); ?>"><?php echo e($subCate->name); ?> </a>
                                    </li>
                                    <?php else: ?> 
                                    <li><a tabindex="-1" class="" onmouseover="bigImg('<?php echo e($subCate->image); ?>',1)" href="<?php echo e(route('allproductsByType' ,[preg_replace('/\s+/', '_', $subCate->name),$subCate->sub_pro_id ,1])); ?>"><?php echo e($subCate->name); ?> </a>
                                    </li>
                                    <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <div class="image-dropdown d-flex justify-content-center " style="background: linear-gradient(to bottom, #fff, transparent, transparent),url('<?php echo e(asset('frontend-asset/image/Dropdown.jpg')); ?>')no-repeat;">
                                        <img class="imageNav1 img-hove-on-dropdown" src="<?php echo e(asset('frontend-asset/image/Medical-Power-Supplies.png')); ?>" alt="">
                                    </div>
                                </ul>
                            </div>
                            <div class="dropdown-submenu">
                                <a id="sub3" class="sub-menu" onclick="mainCate('sub3')" tabindex="-1" href="#"><?php echo e($staticContent['LED_Power']); ?> <i
                                        class="zmdi zmdi-chevron-right"></i></a>
                                <ul class="dropdown-menu drp-subthree">
                                    
                                    
                                    <li><a tabindex="-1"  class="text-c"   href="<?php echo e(route('allproductsByType',[preg_replace('/\s+/', '_', 'CC+Cv_Mode'),1 , 3])); ?>"><?php echo e($staticContent['CC_Cv_Mode']); ?></a>
                                    </li>
                                    <li><a tabindex="-1"  class="text-c"   href="<?php echo e(route('allproductsByType',[preg_replace('/\s+/', '_', 'CC_Mode'),2 ,3])); ?>"><?php echo e($staticContent['CC_Mode']); ?></a>
                                    </li>
                                    <li><a tabindex="-1"  class="text-c"   href="<?php echo e(route('allproductsByType',[preg_replace('/\s+/', '_', 'CV_Mode'),3 ,3])); ?>"><?php echo e($staticContent['CV_Mode']); ?></a>
                                    </li>
                                      <div class="image-dropdown d-flex justify-content-center " style="background: linear-gradient(to bottom, #fff, transparent, transparent),url('<?php echo e(asset('frontend-asset/image/Dropdown.jpg')); ?>') no-repeat;">
                                        <img class="imageNav3 img-hove-on-dropdown" src="<?php echo e(config('app.url')); ?>/medias/categories/<?php echo e($navcategories3[0]->image); ?>" alt="">
                                    </div>
                                </ul>
                            </div>
                        </div>
                    </li>
                    
                    <li class="nav-item dropdown ">
                        <a id="nav-uderline" class="nav-link dropdown-toggle" href="" id="dropdown02"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo e($staticContent['Tools']); ?> <i  class="zmdi zmdi-chevron-down"></i></a>
                        <div class="dropdown-menu" role="menu" aria-labelledby="dropdown02">
                           <a class="dropdown-item" href="<?php echo e(route('productFinder')); ?>"><?php echo e($staticContent['Product_Selector']); ?></a>
                           <a class="dropdown-item" href="<?php echo e(route('configurableproduct')); ?>"><?php echo e($staticContent['configurable_power_selector']); ?></a>
                           <a class="dropdown-item" href="<?php echo e(route('productCoparison')); ?>"><?php echo e($staticContent['product_comparison']); ?></a>
                        </div> 
                    </li>
                   

                    <li class="nav-item dropdown ">
                        <a id="nav-uderline" class="nav-link dropdown-toggle" href="" id="dropdown03"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo e($staticContent['Applications']); ?> <i
                                class="zmdi zmdi-chevron-down"></i></a>
                        <div class="dropdown-menu" role="menu" aria-labelledby="dropdown03">
                            <?php $__currentLoopData = $navapplication; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $app): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a class="dropdown-item " href="<?php echo e(route('applicationDetail' ,[ 'name' => preg_replace('/\s+/', '-',$app->applica_id.'-'.$app->name)])); ?>"><?php echo e($app->name); ?></a> 
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </li>
                    <li class="nav-item dropdown ">
                        <a id="nav-uderline" class="nav-link dropdown-toggle" href="" id="dropdown04"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo e($staticContent['About']); ?> <i
                                class="zmdi zmdi-chevron-down"></i></a>
                        <div class="dropdown-menu megamenu" aria-labelledby="dropdown04">
                            <?php $__currentLoopData = $navaboutus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $abt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a class="dropdown-item" href="<?php echo e(route('aboutUs',$abt->stug)); ?>"><?php echo e($abt->title); ?></a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          
                        </div>
                    </li>
               
                    <li class="nav-item dropdown ">
                        <a id="nav-uderline" class="nav-link dropdown-toggle" href="" id="dropdown05" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false"><?php echo e($staticContent['Updates']); ?> <i class="zmdi zmdi-chevron-down"></i></a>
                        <div class="dropdown-menu megamenu" aria-labelledby="dropdown05">
                           <a class="dropdown-item" href="<?php echo e(route('index','news')); ?>"> <?php echo e($staticContent['Product_News']); ?> </a>
                           <a class="dropdown-item" href="<?php echo e(route('index','events')); ?>"><?php echo e($staticContent['Events']); ?></a>
                            
                        </div>
                    </li>
                    <li class="nav-item dropdown  ">
                        <a id="nav-uderline" class="nav-link dropdown-toggle" href="" id="dropdown06" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false"><?php echo e($staticContent['nav_dowloads']); ?>

                            <i class="zmdi zmdi-chevron-down"></i></a>
                        <div class="dropdown-menu megamenu sp-dropdown02" aria-labelledby="dropdown06">
                            <a class="dropdown-item" href="<?php echo e(route('index','catalogs')); ?>"><?php echo e($staticContent['catalogs']); ?></a>
                            <a class="dropdown-item" href="<?php echo e(route('index','product-documents')); ?>"><?php echo e($staticContent['Product_Documents']); ?></a>
                            
                        </div>
                    </li>
                    <li class="nav-item dropdown ">
                        <a id="nav-uderline" class="nav-link dropdown-toggle" href="" id="dropdown07" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false"><?php echo e($staticContent['Supports']); ?>

                            <i class="zmdi zmdi-chevron-down"></i></a>
                        <div class="dropdown-menu megamenu" aria-labelledby="dropdown07">
                            <a class="dropdown-item" href="<?php echo e(route('contactSupport')); ?>"><?php echo e($staticContent['contact_us']); ?></a>
                            <a class="dropdown-item" href="<?php echo e(route('contactSalesOffices')); ?>"><?php echo e($staticContent['sales_offices']); ?></a>
                            <a class="dropdown-item" href="<?php echo e(route('contactFindDistributor')); ?>"><?php echo e($staticContent['find_a_distributor']); ?></a>
                            <a class="dropdown-item" href="<?php echo e(route('index','faqs')); ?>"><?php echo e($staticContent['FAQs']); ?></a>
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
        <a href="<?php echo e(route('productCoparison')); ?>" class="btn btn-subscribe to-comparison"><?php echo e($staticContent['View_compare']); ?> (<span id="numberselect"></span>/3)</a> 
        </div>
    </div>
</div>
<div class="visible-nav-minimize">
        <div class="nav-mobile scrolled w-100">
            <div class="nav-link-list d-flex">
                <a class="col-nav navbar-brand-mobile" href="#" onclick="openNav();">
                    
                    <div class="menu-buger">
                        <div class="bar"></div>
                        <div class="bar"></div>
                        <div class="bar"> </div>
                      </div>
                </a>
                <a class="col-nav navbar-brand-mobile d-flex justify-content-center" href="<?php echo e(route('index','home')); ?>">
                    <img class="brand-image" src="<?php echo e(asset('frontend-asset/image/DeltaPSU-Logo.svg')); ?>">
                </a>
                <div class="col-nav d-flex justify-content-end">
                    <div class="navbar-brand-mobile navbar-searchandlang"  id="btn-search-mobile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-search icon-serch" aria-hidden="true"></i>
                    </div>
                    <select name="" id="select-mobile-lang" onchange="changeLangLocationmobile();" class="select-language text-uppercase">
                        <?php $__currentLoopData = $language; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php 
                        $current = null;
                        foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties) { 
                            if ($item->name == $localeCode) {
                                $current = $localeCode;
                                break;
                            }
                        }
                        ?>
                      <?php echo e(LaravelLocalization::getLocalizedURL($current, null, [], true)); ?>

                      <option  value="<?php echo e(LaravelLocalization::getLocalizedURL($current, null, [], true)); ?>,<?php echo e($current); ?>" <?php echo e(App::getLocale() == $current?'selected':''); ?>><?php echo e(strtoupper($current)); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>                
            
                        
        </div> 
        <div id="search-box-mobile" class="search-box-mobile" >
            <div class="nav-btn-search">
                <div class="box-search">
                    <i class="fa fa-search"></i>
                </div>
                <form id="formseachall_mobile">
                <label for="searchinput-mobile" class="searchinput_mobile">
                    <input type="text" id="searchinput-mobile" placeholder="<?php echo e($staticContent['Search_by_keyword']); ?>">
                </label>
                </form>
                <div class="icon-clear">
                    <a onclick="document.getElementById('searchinput').value = ''">
                        <i class="zmdi zmdi-close icon-size-close"></i>
                    </a>
                </div>
            </div>
    </div>       
    </div>
   
    
  
    <div id="Sidenav" class="sidenav d-flex">
     
        <div class="in-sidenav pad-ar-24px " id="in-sidenav" style="visibility:hidden" >
            
        <a  tabindex="-1" href="#" onclick="toggle_visibility('btn-sidenav1')" ><?php echo e($staticContent['Products']); ?><i class="zmdi zmdi-chevron-right"></i></a>
            <a class="" tabindex="-1" href="#" onclick="toggle_visibility('btn-sidenav2')"><?php echo e($staticContent['Tools']); ?><i class="zmdi zmdi-chevron-right"></i></a>
            <a class="" tabindex="-1" href="#" onclick="toggle_visibility('btn-sidenav3')"><?php echo e($staticContent['Applications']); ?><i class="zmdi zmdi-chevron-right"></i></a>
            <a class="" tabindex="-1" href="#" onclick="toggle_visibility('btn-sidenav4')"><?php echo e($staticContent['About']); ?><i class="zmdi zmdi-chevron-right"></i></a>
            <a class="" tabindex="-1" href="#" onclick="toggle_visibility('btn-sidenav5')"><?php echo e($staticContent['Updates']); ?><i class="zmdi zmdi-chevron-right"></i></a>
            <a class="" tabindex="-1" href="#" onclick="toggle_visibility('btn-sidenav6')"><?php echo e($staticContent['nav_dowloads']); ?><i class="zmdi zmdi-chevron-right"></i></a>
            <a class="" tabindex="-1" href="#" onclick="toggle_visibility('btn-sidenav7')"><?php echo e($staticContent['Supports']); ?> <i class="zmdi zmdi-chevron-right"></i></a>
            <div class="d-flex">
                <img src="<?php echo e(asset('frontend-asset/image/person-login-dark.svg')); ?>" alt="" class="mr-2">
                <?php if(session('partner_id') == null): ?>
                <a class="a-link-hover" tabindex="-1" href="<?php echo e(route('index','login')); ?>" >Login </a>
             
                <?php else: ?> 
             
                <a class="pad-logout fs-front" href="<?php echo e(route('index','login')); ?>">
                    <?php echo e(session('partner_firstname')); ?>  / 
                </a> 
                
                <a href="<?php echo e(route('index','logoutfrontend')); ?>" class="pad-logout fs-front"> &nbsp; <?php echo e($staticContent['Logout']); ?>

                </a> 
          
                <?php endif; ?>
             
            </div>
            <div class="d-flex">
                <img src="<?php echo e(asset('frontend-asset/image/sub-new-dark.svg')); ?>" alt=""  class="mr-2"><a class="a-link-hover" tabindex="-1" onclick="subscribe()" data-toggle="modal" data-target="#subscribe-modal" > <?php echo e($staticContent['Subscribe']); ?></a>
            </div>
            
        </div>
        
        <div id="btn-sidenav1" class="btn-sidenav pad-ar-24px">
            <a  class="text-color-delta" tabindex="-1" href="#" onclick="toggle_visibility('btn-sidenav1')"><i class="zmdi zmdi-chevron-left mr-1"></i><?php echo e($staticContent['Products']); ?></a>

            <a  class="text-normal pl-3" href="#" onclick="toggle_visibility('btn-sidenav-sub1')" ><?php echo e($staticContent['Industrial_Power']); ?><i class="zmdi zmdi-chevron-right"></i></a> 
            <a  class="text-normal pl-3" href="#" onclick="toggle_visibility('btn-sidenav-sub2')" ><?php echo e($staticContent['Medical_Power']); ?><i class="zmdi zmdi-chevron-right"></i></a> 
            <a  class="text-normal pl-3" href="#" onclick="toggle_visibility('btn-sidenav-sub3')" ><?php echo e($staticContent['LED_Power']); ?><i class="zmdi zmdi-chevron-right"></i></a>   
        </div>
        <div id="btn-sidenav-sub1" class="btn-sidenav  pad-ar-24px">
            <a  class="text-color-delta" tabindex="-1" href="#" onclick="toggle_visibility('btn-sidenav-sub1')"><i class="zmdi zmdi-chevron-left mr-1"></i><?php echo e($staticContent['Industrial_Power']); ?></a>
            <?php $__currentLoopData = $navcategories2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subCate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a  class="text-normal pl-3 " href="<?php echo e(route('allproductsByType' ,[ preg_replace('/\s+/', '_', $subCate->name),$subCate->sub_pro_id,2])); ?>" ><?php echo e($subCate->name); ?></a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div id="btn-sidenav-sub2" class="btn-sidenav  pad-ar-24px">
            <a  class="text-color-delta" tabindex="-1" href="#" onclick="toggle_visibility('btn-sidenav-sub2')"><i class="zmdi zmdi-chevron-left mr-1"></i><?php echo e($staticContent['Medical_Power']); ?></a>
            <?php $__currentLoopData = $navcategories1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subCate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a  class="text-normal pl-3 " href="<?php echo e(route('allproductsByType' ,[ preg_replace('/\s+/', '_', $subCate->name),$subCate->sub_pro_id,1])); ?>" ><?php echo e($subCate->name); ?></a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
        </div>
        <div id="btn-sidenav-sub3" class="btn-sidenav  pad-ar-24px">
            <a  class="text-color-delta" tabindex="-1" href="#" onclick="toggle_visibility('btn-sidenav-sub3')"><i class="zmdi zmdi-chevron-left mr-1"></i><?php echo e($staticContent['LED_Power']); ?></a>
            
           <a  class="text-normal pl-3"   href="<?php echo e(route('allproductsByType',[preg_replace('/\s+/', '_', 'CC+Cv_Mode'),1 , 3])); ?>"><?php echo e($staticContent['CC_Cv_Mode']); ?></a>
           
            <a   class="text-normal pl-3"  href="<?php echo e(route('allproductsByType',[preg_replace('/\s+/', '_', 'CC_Mode'),2 ,3])); ?>"><?php echo e($staticContent['CC_Mode']); ?></a>
           
            <a   class="text-normal pl-3"   href="<?php echo e(route('allproductsByType',[preg_replace('/\s+/', '_', 'CV_Mode'),3 ,3])); ?>"><?php echo e($staticContent['CV_Mode']); ?></a>
            
           
        </div>
        
        <div id="btn-sidenav2" class="btn-sidenav pad-ar-24px">
            <a  class="text-color-delta" tabindex="-1" href="#" onclick="toggle_visibility('btn-sidenav2')"><i class="zmdi zmdi-chevron-left mr-1"></i><?php echo e($staticContent['Tools']); ?></a>
            <a  class="text-normal pl-3" href="<?php echo e(route('productFinder')); ?>"  ><?php echo e($staticContent['Product_Selector']); ?></a> 
            <a  class="text-normal pl-3" href="<?php echo e(route('configurableproduct')); ?>"  ><?php echo e($staticContent['configurable_power_selector']); ?></a> 
            <a  class="text-normal pl-3" href="<?php echo e(route('productCoparison')); ?>" ><?php echo e($staticContent['product_comparison']); ?></a>   
        </div>
        
        <div id="btn-sidenav3" class="btn-sidenav pad-ar-24px">
            <a  class="text-color-delta" tabindex="-1" href="#" onclick="toggle_visibility('btn-sidenav3')"><i class="zmdi zmdi-chevron-left mr-1"></i><?php echo e($staticContent['Tools']); ?></a>
            <?php $__currentLoopData = $navapplication; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $app): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a  class="text-normal pl-3" href="<?php echo e(route('applicationDetail' ,[ 'name' => preg_replace('/\s+/', '-',$app->applica_id.'-'.$app->name)])); ?>"><?php echo e($app->name); ?></a>  
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                
        </div>
        
        <div id="btn-sidenav4" class="btn-sidenav pad-ar-24px">
            <a  class="text-color-delta" tabindex="-1" href="#" onclick="toggle_visibility('btn-sidenav4')"><i class="zmdi zmdi-chevron-left mr-1"></i><?php echo e($staticContent['About']); ?></a>
            <?php $__currentLoopData = $navaboutus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $abt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a  class="text-normal pl-3 " href="<?php echo e(route('aboutUs',$abt->stug)); ?>"><?php echo e($abt->title); ?></a> 
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            
        </div>
        
        <div id="btn-sidenav5" class="btn-sidenav pad-ar-24px">
            <a  class="text-color-delta" tabindex="-1" href="#" onclick="toggle_visibility('btn-sidenav5')"><i class="zmdi zmdi-chevron-left mr-1"></i><?php echo e($staticContent['Updates']); ?></a>
            <a  class="text-normal pl-3" href="<?php echo e(route('index','news')); ?>" > <?php echo e($staticContent['Product_News']); ?></a> 
            <a  class="text-normal pl-3" href="<?php echo e(route('index','events')); ?>" ><?php echo e($staticContent['Events']); ?></a>     
        </div>
        
        <div id="btn-sidenav6" class="btn-sidenav pad-ar-24px">
            <a  class="text-color-delta" tabindex="-1" href="#" onclick="toggle_visibility('btn-sidenav6')"><i class="zmdi zmdi-chevron-left mr-1"></i><?php echo e($staticContent['nav_dowloads']); ?></a>
            <a  class="text-normal pl-3" href="<?php echo e(route('index','catalogs')); ?>"><?php echo e($staticContent['catalogs']); ?> </a>
            <a  class="text-normal pl-3" href="<?php echo e(route('index','product-documents')); ?>"><?php echo e($staticContent['Product_Documents']); ?></a>     
        </div>
        
        <div id="btn-sidenav7" class="btn-sidenav pad-ar-24px">
            <a  class="text-color-delta" tabindex="-1" href="#" onclick="toggle_visibility('btn-sidenav7')"><i class="zmdi zmdi-chevron-left mr-1"></i><?php echo e($staticContent['Supports']); ?></a>
            <a  class="text-normal pl-3" href="<?php echo e(route('contactSupport')); ?>"><?php echo e($staticContent['contact_us']); ?></a>
            <a  class="text-normal pl-3" href="<?php echo e(route('contactSalesOffices')); ?>"><?php echo e($staticContent['sales_offices']); ?></a> 
            <a  class="text-normal pl-3" href="<?php echo e(route('contactFindDistributor')); ?>"><?php echo e($staticContent['find_a_distributor']); ?></a>
            <a  class="text-normal pl-3" href="<?php echo e(route('index','faqs')); ?>"><?php echo e($staticContent['FAQs']); ?></a>
        </div>
        
        <div class="bg-backslidenav" id="bg-backslidenav" onclick="closeNav();">
        </div>
    </div>
   
    <div class="nav-comparison-mobile " id="nav-comparison-mobile" style="display: none;">
        <div class="container d-flex justify-content-between align-items-stretch">
            <div class="my-auto">
                <h5>(<span id="numberselect-mobile"></span>/3) <?php echo e($staticContent['Item(s)_selected']); ?></h5>
                <a class="text-two text-color-gray" id="editList" onclick="showListCoparison()"><?php echo e($staticContent['Edit_List']); ?></a>
            </div>
            <a href="<?php echo e(route('productCoparison')); ?>" class="btn btn-subscribe to-comparison"><?php echo e($staticContent['View_compare']); ?></a> 
        </div>
        <div class="container" id="listAllcomparesesion-mobile">
            
        </div>
        <div class="d-flex text-center my-3">
            <a class="btn btn-boxen" onclick="hideListCoparison()">Done</a>
        </div>
    </div>
</div>


<div class="container">
    <a id="scrollUp"></a>
    
        
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
  <ul id="distributor" class="img-pop">
    <li>
    <a href="<?php echo e(route('contactSupport')); ?>" class="skype"><span><?php echo e($staticContent['contact_us']); ?></span><i class="demo-icon icon-facon icon-find-dis-blue"></i></a>
    </li>
  </ul>


  <div class="modal fade p-1" id="downloadgui-modal" tabindex="-1" role="dialog" aria-labelledby="subscribe-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content ">
        <div class="modal-header pl-4">
          <h4 class="text-color-delta mb-0" id="subscribe-modal-title">Download</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="submitGuiDownload" action="<?php echo e(route('downloadGui')); ?>" method="POST" >
        <div class="modal-body px-4 mb-4">
    
                <?php echo e(csrf_field()); ?>

          <img class="brand-image my-3" src="<?php echo e(asset('frontend-asset/image/DeltaPSU-Logo.svg')); ?>">
          <div class="input-label w-100 my-4">
            <h6 class="mb-0" ><label class="text-dark">Firstname, Lastname<span class="red">*</span></label></h6>
            <input type="text" class="form-control" name="name"  pattern="[A-Za-zก-๏\s]+"  placeholder="Name" required>
          </div>
          <div class="input-label w-100 my-4">
            <h6 class="mb-0" ><label class="text-dark"><?php echo e($staticContent['Company']); ?><span class="red">*</span></label></h6>
            <input type="text" class="form-control" name="company"  pattern="[A-Za-zก-๏\s]+"  placeholder="<?php echo e($staticContent['Company']); ?>" required>
          </div>
          <div class="input-label w-100 my-4">
            <h6 class="mb-0" ><label class="text-dark"><?php echo e($staticContent['Email_Address']); ?><span class="red">*</span></label></h6>
            <input type="email" class="form-control" name="email"  placeholder="Email Address" required>
            
        </div>
        <input type="hidden" name="fileguidownload" id="fileguidownload">
        <input type="hidden" name="procodeGui"  id="procodeGui">
          <div class="input-label w-100 my-4">
            <h6 class="mb-0" ><label class="text-dark"><?php echo e($staticContent['Phone_Number']); ?><span class="red">*</span></label></h6>
        
                    <input type="tel" class="form-control tel-not-req" name="tel" pattern="^[0-9]*$" maxlength="13" title="Incorrect Format Number only" placeholder="<?php echo e($staticContent['Phone_Number']); ?>" required >
          </div>
          <div class="select input-label w-100 my-4">
              <h6 class="mb-0" ><label class="text-dark"><?php echo e($staticContent['Country']); ?><span class="red">*</span></label></h6>
              <select name="country" class="form-control"  required>
                <option value=""><?php echo e($staticContent['Select']); ?> <?php echo e($staticContent['Country']); ?></option>
                <?php $__currentLoopData = $countryemails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $email): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($email->country); ?>"><?php echo e($email->country); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
          </div> 
          <p class="mr-24px"> <?php echo e($staticContent['By_submitting_this_form']); ?> <a href="<?php echo e(route('privacyPolicy')); ?>" class="font-size-tab text-underline text-bold"><?php echo e($staticContent['Privacy_Policy']); ?></a></p>
          <div class="box-input-checkbox">
              <input class="inp-cbx" name="data_conf"  id="cxguiup" value="1" type="checkbox"
                  style="display: none;" />
              <label class="cbx" for="cxguiup"><span>
                      <svg width="12px" height="10px" viewbox="0 0 12 10">
                          <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                      </svg></span><span><?php echo e($staticContent['Sign_up_for_newsletter']); ?></span></label>
          </div>
          <input type="hidden" id="keyrecapGui" name="keyresponseCap" >
          <form action="?" method="POST" >
            <div class="mt-4" id="recap_vertifygetGui"></div>
            <br>
          </form>
       
        <button type="submit" class="btn btn-subscribe">Download</button>
      </div>
    </form>
      
      </div>
    </div>
  </div>

  <div class="modal fade p-1" id="downloadgui-modal-success" tabindex="-1" role="dialog" aria-labelledby="subscribe-modal-title" aria-hidden="true">
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
                <p>Get your files as below link </p>
                <p>Dowload link</p>
             
            </div>
            <div class="text-center" style="word-break: break-all;" id='linkdownloadsuc'></div>
        </div>

      
      </div>
    </div>
  </div>


  <div class="modal fade p-1" id="downloadgui-modal-failures" tabindex="-1" role="dialog" aria-labelledby="subscribe-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content ">
        <div class="modal-header pl-4">
          <h4 class="text-color-delta mb-0" id="subscribe-modal-title2">Eror Message</h4>
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

  
  <div class="modal fade p-1" id="success_email_send" tabindex="-1" role="dialog" aria-labelledby="subscribe-modal-title" aria-hidden="true">
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
                <h4 class="text-color-delta"><?php echo e(isset($staticContent['support_form_text'])? $staticContent['support_form_text']:''); ?></h4>
            </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade p-1" id="success_subscribe" tabindex="-1" role="dialog" aria-labelledby="subscribe-modal-title" aria-hidden="true">
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


  <div class="modal fade p-1" id="success_subscribe_already" tabindex="-1" role="dialog" aria-labelledby="subscribe-modal-title" aria-hidden="true">
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

  <div class="modal fade p-1" id="sendpfdtome" tabindex="-1" role="dialog" aria-labelledby="subscribe-modal-title" aria-hidden="true">
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


  <div class="modal fade p-1" id="sendConfigpdf" tabindex="-1" role="dialog" aria-labelledby="subscribe-modal-title" aria-hidden="true">
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

 
  

<?php /**PATH /var/www/html/deltaPSU/dependencies/resources/views/layouts/header-front.blade.php ENDPATH**/ ?>