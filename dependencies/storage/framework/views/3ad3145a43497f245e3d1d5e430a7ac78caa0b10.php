
<?php $__env->startSection('css'); ?>
<style>
.nav-tabs {
    border-bottom: 1px solid #E3EFF8;
}
.midle-item{
   position: absolute;
  left: 6%;
  top: 30%;
  transform: translate(-50%, -6%);
}
.midle-item-mobile{
   position: absolute;
  left: 12%;
  top: 30%;
  transform: translate(-50%, -6%);
}
.midle-item-r{
   position: absolute;
  right: 0%;
  top: 30%;
  transform: translate(-50%, 0%);
}
.midle-item-img{
  position: absolute;
  left: 50%;
  top: 50%;
  transform: translate(-50%, -50%);
}
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('meta'); ?>
<title><?php echo e(isset($metatag[0]->meta_title)? $metatag[0]->meta_title :''); ?></title>
<meta name="description" content="<?php echo e(isset($metatag[0]->meta_description)? $metatag[0]->meta_description :''); ?>">
<meta name="keywords" content="<?php echo e(isset($metatag[0]->meta_key) ? $metatag[0]->meta_key :''); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('container'); ?>
<div class="visible-up-922">
    <div class="padding-top-content ">
    </div>
    <div class="products-index-banner">
        <div class="products-index-nav">
            <div class="bg-bredcrumb">
                <div class="container">
                    <nav aria-label="breadcrumb" id="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item text-breadcrumb-home"><a
                            href="<?php echo e(route('index','home')); ?>"><?php echo e($staticContent['Home']); ?></a>
                            </li>
                            <li class="breadcrumb-item active text-breadcrumb" aria-current="page"><a
                                    href="#"><?php echo e($staticContent['Products']); ?></a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="nav-desktop-allproduct"  style="display:none;">
            <div class="nav-allproduct-desk d-flex justify-content-between " data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                <div class="my-auto midle-item">
                    <h6><?php echo e($staticContent['Products']); ?></h6>
                </div>
                <div  class="my-auto text-bold midle-item-r" id="btn-allproduct-desk">
                    <h6><?php echo e($staticContent['All_Products']); ?> <i class="zmdi zmdi-chevron-down"></i> </h6>
                </div>
            </div>
            <div class="nav-allproduct-list-desk pt-2" id="nav-allproduct-list-desk" style="display:none;">
                <div class="row my-5">
                    <?php $__currentLoopData = $mainCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mainCate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($mainCate->main_id != 3 ): ?>
                    <div class="col-4">
                        <h5 class="text-dark pb-2"><?php echo e($mainCate->name); ?></h5>
                        <?php $__currentLoopData = $subCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subCate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($subCate->main_cateid == $mainCate->main_id): ?>
                        <div onclick="scollto(<?php echo e($subCate->sub_pro_id); ?> ,<?php echo e($mainCate->main_id); ?>)">
                            <p class="text-dark-gray text-one pb-2"><?php echo e($subCate->name); ?></p>
                        </div>
                        <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div> 
                    <?php endif; ?>
                    <?php if($mainCate->main_id == 3): ?>
                    <div class="col-4">
                        <h5 class="text-dark pb-2"><?php echo e($mainCate->name); ?></h5>
                        <div onclick="scolltoLed(1 ,<?php echo e($mainCate->main_id); ?>)">
                            <p class="text-dark-gray text-one pb-2"><?php echo e($staticContent['CC_Cv_Mode']); ?></p>
                        </div>
                        <div onclick="scolltoLed(2 ,<?php echo e($mainCate->main_id); ?>)">
                            <p class="text-dark-gray text-one pb-2"><?php echo e($staticContent['CC_Mode']); ?></p>
                        </div>
                        <div onclick="scolltoLed(3,<?php echo e($mainCate->main_id); ?>)">
                            <p class="text-dark-gray text-one pb-2"><?php echo e($staticContent['CV_Mode']); ?></p>
                        </div>
                    </div> 
                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
        <div id="slide-banner-products" class="owl-carousel owl-theme">
            <?php $__currentLoopData = $last_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="banner-type-product-all-new item"
                style="background-image: url('<?php echo e(asset('frontend-asset/image/Featured-Product-BG@2x.png')); ?>');">
                
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="box-banner-pro-type-all-new">
                                <div class="text-middle">
                                    <h1 class="text-title-banner"><?php echo e($pro->pro_code); ?></h1>
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
                                <a href="<?php echo e(route('productsDetailsByType',[ preg_replace('/\s+/', '-', $pro->catename),$pro->pro_code ])); ?>">
                                    <div class="link-see-product"><?php echo e($staticContent['See_Products']); ?> <i class="zmdi zmdi-chevron-right"
                                            aria-hidden="true"></i>
                                    </div>
                                   </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 banner-products-pic-new">
                            <img class="midle-item-img" src="<?php echo e(config('app.url')); ?>/upload/thumbs/<?php echo e($pro->picture); ?>" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php $__currentLoopData = $last_products_2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pro2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="banner-type-product-all item" style="background-color:<?php echo e($pro2->bg_color); ?>;">
                
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="box-banner-pro-type-all-new">
                                <div class="text-middle">
                                    <h1 class="text-title-banner" style="color:<?php echo e($pro2->title_color); ?>">
                                        <?php
                                $str = $pro2->title;
                                $st = explode("\n", $str);
                                for ($k = 0; $k < count($st); $k++) {
                                    echo $st[$k] = '<div>'
                                            . $st[$k]
                                            . '</div>';
                                }
                                ?>
                                    </h1>
                                    <div class="text-p-banner" style="color:<?php echo e($pro2->text_color); ?>">
                                        <?php
                                    $str = $pro2->description;
                                    $st = explode("\n", $str);
                                    for ($k = 0; $k < count($st); $k++) {
                                        echo $st[$k] = '<div>'
                                                . $st[$k]
                                                . '</div>';
                                    }
                                    ?>
                                    </div>
                                    <div class="link-see-product" style="color:<?php echo e($pro2->title_color); ?>"><?php echo e($staticContent['See_More']); ?><i
                                            class="zmdi zmdi-chevron-right" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 banner-products-pic">
                            <img class="midle-item-img"  src="<?php echo e(config('app.url')); ?>/medias/categories/<?php echo e($pro2->image); ?>" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
           
        </div>
    </div>
    <div class="box-allproduct-content">
        
      
        <div class="bar-product-type bg-blue-light pt-5 pb-5">
            <div class="container">
                <nav id="bar-product-type-nav">
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <?php $__currentLoopData = $mainCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mainCate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a class="nav-item nav-link <?php echo e(($loop->iteration == 1)?"active":""); ?>"
                            id="maincate<?php echo e($mainCate->main_id); ?>" data-toggle="tab"
                            href="#tab_mainCate<?php echo e($mainCate->main_id); ?>" role="tab"
                            aria-controls="tab_mainCate<?php echo e($mainCate->main_id); ?>s"
                            aria-selected="true"><?php echo e($mainCate->name); ?></a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <?php $__currentLoopData = $mainCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mainCate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="tab-pane fade <?php echo e(($loop->iteration == 1)?"show active":""); ?> bar-product-type-list text-center"
                        id="tab_mainCate<?php echo e($mainCate->main_id); ?>" role="tabpanel"
                        aria-labelledby="nav-industrial-power-supplies-tab">
                        <?php $__currentLoopData = $subCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subCate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($subCate->main_cateid == $mainCate->main_id): ?>
                        <div class="bar-product-type-list-item">
                            <a href="#" onclick="scollto(<?php echo e($subCate->sub_pro_id); ?> ,<?php echo e($mainCate->main_id); ?>)" class="deltaItem" tabindex="0"
                                style="text-decoration:none">
                                <div class="carousel__item-thumb" >
                                    <?php if($mainCate->main_id == 1): ?>
                                    <?php if(isset($subCate->image_type1)): ?>
                                    <img src="<?php echo e(config('app.url')); ?>/medias/categories/<?php echo e($subCate->image_type1); ?>"
                                        class="" alt="">
                                    <?php else: ?>
                                    <img src="<?php echo e(config('app.url')); ?>/medias/categories/<?php echo e($subCate->image); ?>" class="" alt="">
                                    <?php endif; ?>
                                    <?php elseif($mainCate->main_id == 2): ?>
                                    <?php if(isset($subCate->image_type2)): ?>
                                    <img src="<?php echo e(config('app.url')); ?>/medias/categories/<?php echo e($subCate->image_type2); ?>"
                                        class="" alt="">
                                    <?php else: ?>
                                    <img src="<?php echo e(config('app.url')); ?>/medias/categories/<?php echo e($subCate->image); ?>" class="" alt="">
                                    <?php endif; ?>
                                    <?php elseif($mainCate->main_id == 3): ?>
                                    <?php if(isset($subCate->image_type3)): ?>
                                    <img src="<?php echo e(config('app.url')); ?>/medias/categories/<?php echo e($subCate->image_type3); ?>"
                                        class="" alt="">
                                    <?php else: ?>
                                    <img src="<?php echo e(config('app.url')); ?>/medias/categories/<?php echo e($subCate->image); ?>" class="" alt="">
                                    <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                                <div class="carousel__item-name"><?php echo e($subCate->name); ?></div>
                            </a>
                        </div>
                        <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

        </div>
        
        <?php $__currentLoopData = $mainCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mainCate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="product-type-boxitem" id="tab_cate_main<?php echo e($mainCate->main_id); ?>">
            <div class="container">
                <h1 class="text-title-delta"><?php echo e($mainCate->name); ?></h1>
                <?php $__currentLoopData = $subCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subCate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($subCate->main_cateid == $mainCate->main_id): ?>
                <div class="product-type-boxitem-sub" id="tab_cate<?php echo e($mainCate->main_id); ?><?php echo e($subCate->sub_pro_id); ?>">
                    <div class="product-type-boxitem-sub-banner"
                        style=" background-image: url('<?php echo e(asset('frontend-asset/image/Categories@2x.png')); ?>');">
                        <div class="row">
                            <div class="col-lg-6 product-type-boxitem-sub-banner-text">
                                <?php if($subCate->sub_pro_id == 7 ): ?>
                                <a class="text-more_detail" href="<?php echo e(route('configurableProductDetail')); ?>">
                                <?php else: ?>
                                <a style="color:inherit" href="<?php echo e(route('producsList',[preg_replace('/\s+/', '-', $subCate->url_item),$subCate->sub_pro_id])); ?>">
                                 <?php endif; ?>
                                <h2 class="text-dark"><?php echo e($subCate->name); ?></h2>
                                <?php if(isset($subCate->contenttype1) || isset($subCate->contenttype2) || isset($subCate->contenttype3)): ?>
                                    <?php if($subCate->main_cateid == 1): ?>
                                    <p class="text-dark"><?php echo $subCate->contenttype1; ?></p>
                                    <?php elseif($subCate->main_cateid == 2): ?>
                                    <p class="text-dark"><?php echo $subCate->contenttype2; ?></p>
                                    <?php elseif($subCate->main_cateid == 3): ?>
                                    <p class="text-dark"><?php echo $subCate->contenttype3; ?></p>
                                    <?php endif; ?>
                                <?php else: ?> 
                                <p class="text-dark"><?php echo $subCate->content; ?></p>
                                <?php endif; ?>
                                </a>
                                <?php if($subCate->sub_pro_id == 7 ): ?>
                                <a class="text-more_detail" href="<?php echo e(route('configurableProductDetail')); ?>"><?php echo e($staticContent['More_Detail']); ?> </a>
                                <?php endif; ?>
                                <?php if(isset($subCate->file)): ?>
                                <a class="text-color-delta text-link" href="<?php echo e(config('app.url')); ?>/medias/categories/<?php echo e($subCate->file); ?>" download="<?php echo e($staticContent['Download_selection_guide']); ?>_<?php echo e($subCate->name); ?>"><img
                                    class="align-middle mr-1"    src="<?php echo e(asset('frontend-asset/image/icon/download-icon.svg')); ?>" alt=""> <?php echo e($staticContent['Download_selection_guide']); ?>

                                    </a>
                                <?php else: ?>
                                
                                <?php endif; ?>
                            </div>
                            
                            <div class="col-lg-6 product-type-boxitem-sub-banner-pic ">
                                <?php if($subCate->sub_pro_id == 7): ?>
                                <a class="d-flex w-100" href="<?php echo e(route('configurableProductDetail')); ?>">
                                <?php else: ?>
                                <a class="d-flex w-100" style="color:inherit" href="<?php echo e(route('producsList',[preg_replace('/\s+/', '-', $subCate->url_item),$subCate->sub_pro_id])); ?>">
                                <?php endif; ?>
                               
                               <?php if($mainCate->main_id == 1): ?>
                                <?php if(isset($subCate->image_type1)): ?>
                                <img class="img-fluid max-h" 
                                    src="<?php echo e(config('app.url')); ?>/medias/categories/<?php echo e($subCate->image_type1); ?>" alt="">
                                <?php else: ?>
                                <img class="img-fluid max-h"
                                    src="<?php echo e(config('app.url')); ?>/medias/categories/<?php echo e($subCate->image); ?>" alt="">
                                <?php endif; ?>
                               <?php elseif($mainCate->main_id == 2): ?>
                               <?php if(isset($subCate->image_type2)): ?>
                               <img class="img-fluid max-h" 
                                   src="<?php echo e(config('app.url')); ?>/medias/categories/<?php echo e($subCate->image_type2); ?>" alt="">
                               <?php else: ?>
                               <img class="img-fluid max-h"
                                   src="<?php echo e(config('app.url')); ?>/medias/categories/<?php echo e($subCate->image); ?>" alt="">
                               <?php endif; ?>
                               <?php elseif($mainCate->main_id == 3): ?>
                               <?php if(isset($subCate->image_type3)): ?>
                               <img class="img-fluid max-h" 
                                   src="<?php echo e(config('app.url')); ?>/medias/categories/<?php echo e($subCate->image_type3); ?>" alt="">
                               <?php else: ?>
                               <img class="img-fluid max-h"
                                   src="<?php echo e(config('app.url')); ?>/medias/categories/<?php echo e($subCate->image); ?>" alt="">
                               <?php endif; ?>
                               <?php endif; ?>

                                </a>
                            </div>
                        </div>
                    </div>
                    <?php if($subCate->sub_pro_id  == 6): ?>
                    <?php $__currentLoopData = $modeSeries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mode): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="bordr-name-se" ><h3 class="text-dark" id="mode3<?php echo e($mode->id); ?>">
                   
                        <?php echo e($mode->id == 1 ? $staticContent['CC_Cv_Mode'] :''); ?>

                        <?php echo e($mode->id == 2 ? $staticContent['CC_Mode'] :''); ?>

                        <?php echo e($mode->id == 3 ? $staticContent['CV_Mode'] :''); ?>

                    </h3></div>
                    <div class="series-grid"> 
                        <?php $__currentLoopData = $series; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $serie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($serie->main_cate == $mainCate->main_id): ?>
                        <?php if($serie->pro_categories_id == $subCate->sub_pro_id): ?>
                        <?php if($serie->mode_series == $mode->id): ?>
                        <div class="series-list">
                            <div class="">
                                <div class="d-block ">
                                    <div class="m-auto series-img" >
                                        <?php if($serie->se_id == 26): ?>
                                        <a class="color:inherit;" href="<?php echo e(route('configurableProductDetail')); ?>">
                                        <?php else: ?>
                                        <a style="color:inherit;" class="" href="<?php echo e(route('producsList',[preg_replace('/\s+/', '-', $subCate->url_item),$serie->pro_categories_id,preg_replace('/\s+/', '', $serie->slug),$serie->se_id])); ?>">
                                        <?php endif; ?>
                                            <?php if(isset($serie->image)): ?>
                                            <img class="img-fluid m-auto"
                                                src="<?php echo e(config('app.url')); ?>/medias/categories/<?php echo e($serie->image); ?>" alt="">
                                            <?php else: ?>
                                            <img class="img-fluid m-auto" src="<?php echo e(asset('frontend-asset/image/blank.png')); ?>" alt="">
                                            <?php endif; ?>
                                        </a>
                                    </div>
                                </div>
                                <div class="series-text text-center">
                                    <div class="d-flex h-title">
                                        <?php if($serie->se_id == 26): ?>
                                        <a style="color:inherit;"  class="m-auto" href="<?php echo e(route('configurableProductDetail')); ?>">
                                         <?php else: ?> 
                                         <a style="color:inherit;" class="m-auto" href="<?php echo e(route('producsList',[preg_replace('/\s+/', '-', $subCate->url_item),$serie->pro_categories_id,preg_replace('/\s+/', '', $serie->slug),$serie->se_id])); ?>">
                                         <?php endif; ?>
                                            <h3 class="text-dark  m-0"><?php echo e($serie->title); ?></h3>
                                        </a>
                                    </div>
                                    <?php if($serie->se_id == 26): ?>
                                    <a style="color:inherit;"  class="m-auto" href="<?php echo e(route('configurableProductDetail')); ?>">
                                    <?php else: ?> 
                                    <a style="color:inherit;" class="m-auto" href="<?php echo e(route('producsList',[preg_replace('/\s+/', '-', $subCate->url_item),$serie->pro_categories_id,preg_replace('/\s+/', '', $serie->slug),$serie->se_id])); ?>">
                                    <?php endif; ?>
                                    <div class="series-text-detail">
                                        <?php echo $serie->overview_content; ?>

                                    </div>
                                    </a>
                                </div>
                            </div>
                            <div class="series-icon ">
                                <div class="icon-app-detail">
                                    <?php $__currentLoopData = $series_has_application; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($item->se_id == $serie->se_id): ?>
                                        <a href="<?php echo e(route('applicationDetail' ,[ 'name' => preg_replace('/\s+/', '-',$item->id.'-'.$item->name)])); ?>"  data-toggle="tooltip" data-placement="top" title="<?php echo e($item->name); ?>" class="icon btn-icon-app itemhorver<?php echo e($item->id); ?>"
                                            style="background-image: url('<?php echo e(config('app.url')); ?>/medias/categories/<?php echo e($item->icon); ?>'); "></a>
                                           <script>
                                               $(".itemhorver<?php echo e($item->id); ?>").hover(function(){
                                                    $(this).css("background-image", "url('<?php echo e(config('app.url')); ?>/medias/categories/<?php echo e($item->blue_outline_icon); ?>')");
                                                    }, function(){
                                                    $(this).css("background-image", "url('<?php echo e(config('app.url')); ?>/medias/categories/<?php echo e($item->icon); ?>')");
                                                    });
                                            </script>                             
                                   <?php endif; ?>
                                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>   
                        <?php endif; ?>
                        <?php endif; ?>
                        <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?> 
                    <div class="series-grid"> 
                        <?php $__currentLoopData = $series; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $serie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($serie->main_cate == $mainCate->main_id): ?>
                        <?php if($serie->pro_categories_id == $subCate->sub_pro_id): ?>
                        <div class="series-list">
                            <div class="">
                                <div class="d-block ">
                                    <div class="m-auto series-img" >
                                        <?php if($serie->se_id == 26): ?>
                                        <a class="color:inherit;" href="<?php echo e(route('configurableProductDetail')); ?>">
                                        <?php else: ?>
                                        <a style="color:inherit;" class="" href="<?php echo e(route('producsList',[preg_replace('/\s+/', '-', $subCate->url_item),$serie->pro_categories_id,preg_replace('/\s+/', '', $serie->slug),$serie->se_id])); ?>">
                                        <?php endif; ?>
                                            <?php if(isset($serie->image)): ?>
                                            <img class="img-fluid m-auto"
                                                src="<?php echo e(config('app.url')); ?>/medias/categories/<?php echo e($serie->image); ?>" alt="">
                                            <?php else: ?>
                                            <img class="img-fluid m-auto" src="<?php echo e(asset('frontend-asset/image/blank.png')); ?>" alt="">
                                            <?php endif; ?>
                                        </a>
                                    </div>
                                </div>
                                <div class="series-text text-center">
                                    <div class="d-flex h-title">
                                        <?php if($serie->se_id == 26): ?>
                                        <a style="color:inherit;"  class="m-auto" href="<?php echo e(route('configurableProductDetail')); ?>">
                                         <?php else: ?> 
                                         <a style="color:inherit;" class="m-auto" href="<?php echo e(route('producsList',[preg_replace('/\s+/', '-', $subCate->url_item),$serie->pro_categories_id,preg_replace('/\s+/', '', $serie->slug),$serie->se_id])); ?>">
                                         <?php endif; ?>
                                            <h3 class="text-dark  m-0"><?php echo e($serie->title); ?></h3>
                                        </a>
                                    </div>
                                    <?php if($serie->se_id == 26): ?>
                                    <a style="color:inherit;"  class="m-auto" href="<?php echo e(route('configurableProductDetail')); ?>">
                                     <?php else: ?> 
                                    <a style="color:inherit;" class="m-auto" href="<?php echo e(route('producsList',[preg_replace('/\s+/', '-', $subCate->url_item),$serie->pro_categories_id,preg_replace('/\s+/', '', $serie->slug),$serie->se_id])); ?>">
                                     <?php endif; ?>
                                    <div class="series-text-detail">
                                        <?php echo $serie->overview_content; ?>

                                    </div>
                                     </a>
                                </div>
                            </div>
                            <div class="series-icon ">
                                <div class="icon-app-detail">
                                    <?php $__currentLoopData = $series_has_application; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($item->se_id == $serie->se_id): ?>
                                        <a href="<?php echo e(route('applicationDetail' ,[ 'name' => preg_replace('/\s+/', '-',$item->id.'-'.$item->name)])); ?>"  data-toggle="tooltip" data-placement="top" title="<?php echo e($item->name); ?>" class="icon btn-icon-app itemhorver<?php echo e($item->id); ?>"
                                            style="background-image: url('<?php echo e(config('app.url')); ?>/medias/categories/<?php echo e($item->icon); ?>'); "></a>
                                           <script>
                                               $(".itemhorver<?php echo e($item->id); ?>").hover(function(){
                                                    $(this).css("background-image", "url('<?php echo e(config('app.url')); ?>/medias/categories/<?php echo e($item->blue_outline_icon); ?>')");
                                                    }, function(){
                                                    $(this).css("background-image", "url('<?php echo e(config('app.url')); ?>/medias/categories/<?php echo e($item->icon); ?>')");
                                                    });
                                            </script>                             
                                   <?php endif; ?>
                                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>   
                        <?php endif; ?>
                        <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<div class="invisible-up-922">
    <div class="nav-allproduct ">
        <div class="my-auto midle-item-mobile">
            <h6><?php echo e($staticContent['Products']); ?></h6>
        </div>
        <a href="#" class="my-auto text-bold midle-item-r" id="btn-allproduct">
            <h6><?php echo e($staticContent['All_Products']); ?> <i class="zmdi zmdi-chevron-down"></i> </h6>
        </a>
    </div>
    <div class="nav-allproduct-list p-5" id="nav-allproduct-list">
        <?php $__currentLoopData = $mainCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mainCate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($mainCate->main_id != 3): ?>
        <h6 class="text-color-delta pb-2"><?php echo e($mainCate->name); ?></h6>
        <?php $__currentLoopData = $subCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subCate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($subCate->main_cateid == $mainCate->main_id): ?>
            <h6 class="text-dark-gray pb-2" onclick="scolltoMobile(<?php echo e($subCate->sub_pro_id); ?> ,<?php echo e($mainCate->main_id); ?>)" ><?php echo e($subCate->name); ?></h6>
       
        <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <hr>
        <?php endif; ?>

        <?php if($mainCate->main_id == 3): ?>
        <h6 class="text-color-delta pb-2"><?php echo e($mainCate->name); ?></h6>
        <h6 class="text-dark-gray pb-2" onclick="scolltoMobileled(1 ,<?php echo e($mainCate->main_id); ?>)" ><?php echo e($staticContent['CC_Cv_Mode']); ?></h6>
        <h6 class="text-dark-gray pb-2" onclick="scolltoMobileled(2 ,<?php echo e($mainCate->main_id); ?>)" ><?php echo e($staticContent['CC_Mode']); ?></h6>
        <h6 class="text-dark-gray pb-2" onclick="scolltoMobileled(3 ,<?php echo e($mainCate->main_id); ?>)" ><?php echo e($staticContent['CV_Mode']); ?></h6>
       
        <hr>
        <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </div>
    <div class="box-banner">
        <div id="slide-banner-products-mobile" class="owl-carousel owl-theme">
            <?php $__currentLoopData = $last_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($pro->status == 1): ?>
            <div class="banner-type-product-all item">
                <div class="slide"
                    style="background-image: url('<?php echo e(asset('frontend-asset/image/Featured-Product-BG@2x.png')); ?>');">
                    <div class="slide-content">
                        <div class="container ">
                            <h4 class="text-delta mr-b-12px"><?php echo e($pro->pro_code); ?></h4>
                            <a href="" class="link-see-product"><?php echo e($staticContent['See_Products']); ?> <i class="zmdi zmdi-chevron-right"
                                    aria-hidden="true"></i> </a>
                            <div class="d-flex justify-content-center py-3 ">
                                <img class="img-product" src="<?php echo e(config('app.url')); ?>/upload/thumbs/<?php echo e($pro->picture); ?>"
                                    alt="">
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <?php else: ?>
            <div class="banner-type-product-all item">
                <div class="slide" style="background-color:<?php echo e($pro->bg_color); ?>;">
                    <div class="slide-content">
                        <div class="container ">
                            <h4 class="text-delta mr-b-12px" style="color:<?php echo e($pro->title_color); ?>">
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
                            <a href="" class="link-see-product" style="color:<?php echo e($pro->title_color); ?>"><?php echo e($staticContent['See_Products']); ?><i
                                    class="zmdi zmdi-chevron-right" aria-hidden="true"></i> </a>
                            <div class="d-flex justify-content-center py-5 ">
                                <img class="img-product" src="<?php echo e(config('app.url')); ?>/medias/categories/<?php echo e($pro->image); ?>"
                                    alt="">
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
    <div class="product-type-boxitem" id="delta-industrial-power-supplies">
        <?php $__currentLoopData = $mainCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mainCate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <h2 class="text-title-delta"><?php echo e($mainCate->name); ?></h2>
        <?php $__currentLoopData = $subCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subCate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($subCate->main_cateid == $mainCate->main_id): ?>
        <div class="product-type-boxitem-sub" id="tab_cate_mobile<?php echo e($mainCate->main_id); ?><?php echo e($subCate->sub_pro_id); ?>">
            <div class="product-type-boxitem-sub-banner"
                style=" background-image: url('<?php echo e(asset('frontend-asset/image/Categories@2x.png')); ?>');">
                <div class="row">
                    <div class="col-lg-6 product-type-boxitem-sub-banner-text text-center">
                        <?php if($subCate->sub_pro_id == 7 ): ?>
                        <a href="<?php echo e(route('configurableProductDetail')); ?>">
                        <?php else: ?>
                        <a href="<?php echo e(route('producsList',[preg_replace('/\s+/', '-', $subCate->url_item),$subCate->sub_pro_id])); ?>">
                         <?php endif; ?>
                        <h2 class="text-dark"><?php echo e($subCate->name); ?></h2>
                        </a>
                        <?php if(isset($subCate->file)): ?>
                        <a class="text-color-delta text-link" href="<?php echo e(config('app.url')); ?>/medias/categories/<?php echo e($subCate->file); ?>" download="<?php echo e($staticContent['Download_selection_guide']); ?>_<?php echo e($subCate->name); ?>"><img
                            class="align-middle mr-1"  src="<?php echo e(asset('frontend-asset/image/icon/download-icon.svg')); ?>" alt=""> Download selection
                            guide</a>
                        <?php else: ?>
                        
                        <?php endif; ?>
                       
                    </div>
                    <div class="col-lg-6 product-type-boxitem-sub-banner-pic">
                        <?php if($subCate->sub_pro_id == 7 ): ?>
                        <a href="<?php echo e(route('configurableProductDetail')); ?>">
                        <?php else: ?>
                        <a href="<?php echo e(route('producsList',[preg_replace('/\s+/', '-', $subCate->url_item),$subCate->sub_pro_id])); ?>">
                         <?php endif; ?>
                            
                            <?php if($mainCate->main_id == 1): ?>
                            <?php if(isset($subCate->image_type1)): ?>
                            <img class="img-fluid max-h" 
                                src="<?php echo e(config('app.url')); ?>/medias/categories/<?php echo e($subCate->image_type1); ?>" alt="">
                            <?php else: ?>
                            <img class="img-fluid max-h"
                                src="<?php echo e(config('app.url')); ?>/medias/categories/<?php echo e($subCate->image); ?>" alt="">
                            <?php endif; ?>
                           <?php elseif($mainCate->main_id == 2): ?>
                           <?php if(isset($subCate->image_type2)): ?>
                           <img class="img-fluid max-h" 
                               src="<?php echo e(config('app.url')); ?>/medias/categories/<?php echo e($subCate->image_type2); ?>" alt="">
                           <?php else: ?>
                           <img class="img-fluid max-h"
                               src="<?php echo e(config('app.url')); ?>/medias/categories/<?php echo e($subCate->image); ?>" alt="">
                           <?php endif; ?>
                           <?php elseif($mainCate->main_id == 3): ?>
                           <?php if(isset($subCate->image_type3)): ?>
                           <img class="img-fluid max-h" 
                               src="<?php echo e(config('app.url')); ?>/medias/categories/<?php echo e($subCate->image_type3); ?>" alt="">
                           <?php else: ?>
                           <img class="img-fluid max-h"
                               src="<?php echo e(config('app.url')); ?>/medias/categories/<?php echo e($subCate->image); ?>" alt="">
                           <?php endif; ?>
                           <?php endif; ?>


                        </a>
                    </div>
                </div>

            </div>
            <div class="container">
                <?php if($subCate->sub_pro_id  == 6): ?>
                <?php $__currentLoopData = $modeSeries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mode): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bordr-name-se" ><h3 class="text-dark" id="mode_mobile3<?php echo e($mode->id); ?>">
                    <?php echo e($mode->id == 1 ? $staticContent['CC_Cv_Mode'] :''); ?>

                    <?php echo e($mode->id == 2 ? $staticContent['CC_Mode'] :''); ?>

                    <?php echo e($mode->id == 3 ? $staticContent['CV_Mode'] :''); ?>

                </h3>
            </div>
                   
                <div class="series-grid "> 
                    <?php $__currentLoopData = $series; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $serie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($serie->main_cate == $mainCate->main_id): ?>
                    <?php if($serie->pro_categories_id == $subCate->sub_pro_id): ?>
                    <?php if($serie->mode_series == $mode->id): ?>
                    <div class="series-list">
                        <div class="">
                            <div class="d-block">
                                <div class="m-auto series-img" >
                                    <?php if($serie->se_id == 26): ?>
                                    <a class="color:inherit;" href="<?php echo e(route('configurableProductDetail')); ?>">
                                    <?php else: ?>
                                    <a style="color:inherit;" class="" href="<?php echo e(route('producsList',[preg_replace('/\s+/', '-', $subCate->url_item),$serie->pro_categories_id,preg_replace('/\s+/', '', $serie->slug),$serie->se_id])); ?>">
                                     <?php endif; ?>
                                        <?php if(isset($serie->image)): ?>
                                        <img class="img-fluid m-auto"
                                            src="<?php echo e(config('app.url')); ?>/medias/categories/<?php echo e($serie->image); ?>" alt="">
                                        <?php else: ?>
                                        <img class="img-fluid m-auto" src="<?php echo e(asset('frontend-asset/image/blank.png')); ?>" alt="">
                                        <?php endif; ?>
                                    </a>
                                  
                                </div>
                            </div>
                            <div class="series-text text-center">
                                <div style="min-height:64px; " class="d-flex">
                                    <a style="color:inherit; " class="m-auto" href="<?php echo e(route('producsList',[preg_replace('/\s+/', '-', $subCate->url_item),$serie->pro_categories_id,preg_replace('/\s+/', '', $serie->slug),$serie->se_id])); ?>">
                                        <h3 class="text-dark text-untransfrom  m-0"><?php echo e($serie->title); ?></h3>
                                    </a>
                                </div>
                                <?php if($serie->se_id == 26): ?>
                                <a style="color:inherit;text-decoration: none;" href="<?php echo e(route('configurableProductDetail')); ?>">
                                <?php else: ?>
                                <a style="color:inherit;text-decoration: none;" class="" href="<?php echo e(route('producsList',[preg_replace('/\s+/', '-', $subCate->url_item),$serie->pro_categories_id,preg_replace('/\s+/', '', $serie->slug),$serie->se_id])); ?>">
                                    <?php endif; ?>
                                <div class="series-text-detail" style="min-height:72px;">
                                    <?php echo $serie->overview_content; ?>

                                </div>
                                </a>
                            </div>
                        </div>
                        <div class="series-icon">
                            <div class="icon-app-detail">
                                <?php $__currentLoopData = $series_has_application; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($item->se_id == $serie->se_id): ?>
                                    <a href="<?php echo e(route('applicationDetail' ,[ 'name' => preg_replace('/\s+/', '-',$item->id.'-'.$item->name)])); ?>"  data-toggle="tooltip" data-placement="top" title="<?php echo e($item->name); ?>"
                                        class="icon btn-icon-app itemhorver<?php echo e($item->id); ?>"
                                        style="background-image: url('<?php echo e(config('app.url')); ?>/medias/categories/<?php echo e($item->icon); ?>'); "></a>
                                       <script>
                                           $(".itemhorver<?php echo e($item->id); ?>").hover(function(){
                                                $(this).css("background-image", "url('<?php echo e(config('app.url')); ?>/medias/categories/<?php echo e($item->blue_outline_icon); ?>')");
                                                }, function(){
                                                $(this).css("background-image", "url('<?php echo e(config('app.url')); ?>/medias/categories/<?php echo e($item->icon); ?>')");
                                                });
                                        </script>                             
                               <?php endif; ?>
                               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>   
                    <?php endif; ?>
                    <?php endif; ?>
                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                  
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                 
                <?php else: ?> 
                  
                <div class="series-grid "> 
                    <?php $__currentLoopData = $series; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $serie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($serie->main_cate == $mainCate->main_id): ?>
                    <?php if($serie->pro_categories_id == $subCate->sub_pro_id): ?>
                    <div class="series-list">
                        <div class="">
                            <div class="d-block">
                                <div class="m-auto series-img" >
                                    <?php if($serie->se_id == 26): ?>
                                    <a class="color:inherit;" href="<?php echo e(route('configurableProductDetail')); ?>">
                                    <?php else: ?>
                                    <a style="color:inherit;" class="" href="<?php echo e(route('producsList',[preg_replace('/\s+/', '-', $subCate->url_item),$serie->pro_categories_id,preg_replace('/\s+/', '', $serie->slug),$serie->se_id])); ?>">
                                     <?php endif; ?>
                                        <?php if(isset($serie->image)): ?>
                                        <img class="img-fluid m-auto"
                                            src="<?php echo e(config('app.url')); ?>/medias/categories/<?php echo e($serie->image); ?>" alt="">
                                        <?php else: ?>
                                        <img class="img-fluid m-auto" src="<?php echo e(asset('frontend-asset/image/blank.png')); ?>" alt="">
                                        <?php endif; ?>
                                    </a>
                                  
                                </div>
                            </div>
                            <div class="series-text text-center">
                                <div style="min-height:64px; " class="d-flex">
                                    <a style="color:inherit; " class="m-auto" href="<?php echo e(route('producsList',[preg_replace('/\s+/', '-', $subCate->url_item),$serie->pro_categories_id,preg_replace('/\s+/', '', $serie->slug),$serie->se_id])); ?>">
                                        <h3 class="text-dark text-untransfrom  m-0"><?php echo e($serie->title); ?></h3>
                                    </a>
                                </div>
                                <?php if($serie->se_id == 26): ?>
                                <a style="color:inherit;text-decoration: none;" href="<?php echo e(route('configurableProductDetail')); ?>">
                                <?php else: ?>
                                <a style="color:inherit;text-decoration: none;" class="" href="<?php echo e(route('producsList',[preg_replace('/\s+/', '-', $subCate->url_item),$serie->pro_categories_id,preg_replace('/\s+/', '-', $serie->slug),$serie->se_id])); ?>">
                                    <?php endif; ?>
                                <div class="series-text-detail" style="min-height:72px;">
                                    <?php echo $serie->overview_content; ?>

                                </div>
                                </a>
                            </div>
                        </div>
                        <div class="series-icon">
                            <div class="icon-app-detail">
                                <?php $__currentLoopData = $series_has_application; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($item->se_id == $serie->se_id): ?>
                                    <a href="<?php echo e(route('applicationDetail' ,[ 'name' => preg_replace('/\s+/', '-',$item->id.'-'.$item->name)])); ?>"  data-toggle="tooltip" data-placement="top" title="<?php echo e($item->name); ?>"
                                        class="icon btn-icon-app itemhorver<?php echo e($item->id); ?>"
                                        style="background-image: url('<?php echo e(config('app.url')); ?>/medias/categories/<?php echo e($item->icon); ?>'); "></a>
                                       <script>
                                           $(".itemhorver<?php echo e($item->id); ?>").hover(function(){
                                                $(this).css("background-image", "url('<?php echo e(config('app.url')); ?>/medias/categories/<?php echo e($item->blue_outline_icon); ?>')");
                                                }, function(){
                                                $(this).css("background-image", "url('<?php echo e(config('app.url')); ?>/medias/categories/<?php echo e($item->icon); ?>')");
                                                });
                                        </script>                             
                               <?php endif; ?>
                               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>   
                    <?php endif; ?>
                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                
                <?php endif; ?>


            </div>
        </div>
        <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script>
    $(function () {
     $('[data-toggle="tooltip"]').tooltip()
    })
    var cateid = '<?php echo e($cateid); ?>';
    var mainid = '<?php echo e($mainId); ?>';
    // console.log(cateid);
    // console.log(mainid);
   if(mainid == 3){
       console.log(3);
    if($(window).width() > 992){
       $('html, body').animate({
        scrollTop: $("#mode<?php echo e($mainId); ?><?php echo e($cateid); ?>").offset().top+200}, 1000);
    }else{
        $('html, body').animate({
        scrollTop: $("#mode_mobile<?php echo e($mainId); ?><?php echo e($cateid); ?>").offset().top+200}, 1000); 
    }
   }else{
     if($(window).width() > 992){
       $('html, body').animate({
        scrollTop: $("#tab_cate<?php echo e($mainId); ?><?php echo e($cateid); ?>").offset().top+200}, 1000);
    }else{
        $('html, body').animate({
        scrollTop: $("#tab_cate_mobile<?php echo e($mainId); ?><?php echo e($cateid); ?>").offset().top+200}, 1000); 
    }
   }
  
     function scollto(id ,mainid){
        $('html, body').animate({
        scrollTop: $("#tab_cate"+mainid+id).offset().top-200}, 1000);
        $('#nav-allproduct-list-desk').hide();
     }

     function scolltoMobile(id ,mainid){
        $('html, body').animate({
          scrollTop: $("#tab_cate_mobile"+mainid+id).offset().top-200}, 1000); 
          $('#nav-allproduct-list').hide();
     }
     function scolltoMobileled(id ,mainid){
        $('html, body').animate({
          scrollTop: $("#mode_mobile"+mainid+id).offset().top-200}, 1000); 
          $('#nav-allproduct-list').hide();
     }
     function scolltoLed(id ,mainid){
 
        $('html, body').animate({
        scrollTop: $("#mode"+mainid+id).offset().top-200}, 1000);
        $('#nav-allproduct-list-desk').hide();
     }

   

  
   
</script>

<script>
    $(document).ready(function () {
        $("#slide-banner-products").owlCarousel({
            loop: true,
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
            loop: true,
            navigation: true, // Show next and prev buttons
            slideSpeed: 300,
            paginationSpeed: 400,
            singleItem: true,
            items: 1,

        });
        $('.product-type-boxitem-sub-list-item-icon a').tooltip({
            boundary: 'window'
        });
        $('#bar-product-type-nav').removeClass('scrolled');
        $("#btn-allproduct").click(function () {
            $("#nav-allproduct-list").slideToggle("slow");
        });
        $("#btn-allproduct-desk").click(function () {
            $("#nav-allproduct-list-desk").slideToggle("slow");
        });
        /* nav show on div*/
        var offsetTop = $(".box-allproduct-content").offset().top;
        $(window).scroll(function () {
            var scrollTop = $(window).scrollTop();
            if (scrollTop >= offsetTop) {
                $(".nav-desktop-allproduct").slideDown(500);
            } else {
                $(".nav-desktop-allproduct").fadeOut();
                $("#nav-allproduct-list-desk").fadeOut();
            }
        });
    });

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.front-end', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/deltaPSU/dependencies/resources/views/front-end/allproducts.blade.php ENDPATH**/ ?>