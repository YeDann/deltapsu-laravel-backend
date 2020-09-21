<?php $__env->startSection('css'); ?>
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
<?php $__env->stopSection(); ?>
<?php $__env->startSection('meta'); ?>
<title><?php echo e(isset($metatag[0]->meta_title)? $metatag[0]->meta_title :''); ?></title>
<meta name="description" content="<?php echo e(isset($metatag[0]->meta_description)? $metatag[0]->meta_description :''); ?>">
<meta name="keywords" content="<?php echo e(isset($metatag[0]->meta_key) ? $metatag[0]->meta_key :''); ?>">
<?php $__env->stopSection(); ?>
<?php 
    function setTextpro($pro){
                $strmodel =  str_replace("/", "&", $pro);
                return  $strmodel;
            }

?>
<?php $__env->startSection('container'); ?>
<?php $style = 2; ?>
<!-- banner -->


<div class="show-more-769">
    <div class="box-banner">
        <div id="slide-banner" class="owl-carousel owl-theme">
            <?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="item banner-item">
                <a href="<?php echo e($banner->btn_link); ?>">
                <div class="slide"
                    style="background: url('<?php echo e(config('app.url')); ?>/medias/banners/<?php echo e($banner->image_destop); ?>');">
                    <div class="slide-content">
                        <?php if($banner->title2 != null ||  $banner->content != null): ?>
                        <div class="container">
                            <div class="bg-w-banner">
                                <h1 class="text-title-banner" style="color:<?php echo e($banner->title_color); ?>">
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
                            <div class="text-p-banner my-2" style="color:<?php echo e($banner->content_color); ?>">
                                    <?php echo $banner->content; ?>

                                </div>
                                <?php if($banner->btn_status == 1): ?>
                                <button class="btn btn-subscribe"><?php echo e($banner->btn_name); ?></button>
                             
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </a>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<div class="show-768-only">
    <div class="padding-top-content">
    </div>
    <div class="box-banner">
        <div id="slide-banner-mobile" class="owl-carousel owl-theme ">
            <?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="item banner-item ">
                <a href="<?php echo e($banner->btn_link); ?>">
                <div class="slide" style="background:url('<?php echo e(config('app.url')); ?>/medias/banners/<?php echo e($banner->image); ?>');">
                    <div class="slide-content">
                        <?php if($banner->title2 != null): ?>
                        <div class="container ">
                            <div class="">
                            <h2 class="text-title-banner" style="color:<?php echo e($banner->title_color); ?>">
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
                            <?php if($banner->btn_status == 1): ?>
                            <button class="btn btn-subscribe mt-3 posit-btn-mobile"><?php echo e($banner->btn_name); ?></button>
                            <?php endif; ?>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </a>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

    </div>
</div>
<!-- selecter -->
<div class="visible-tablets-up">
    <div class="box-product-selector container ">
        <h2 class="text-title-delta-home"> <?php echo e($staticContent['Product_Selector']); ?></h2>
        <div id="product-selector-carousel" class="owl-carousel owl-theme product-selector text-center">
            <?php $__currentLoopData = $subCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="product-selector-list border-2px d-flex align-items-center">
                <div class="m-auto">
                    <a href="<?php echo e(route('producsList',[preg_replace('/\s+/', '_', $sub->name),$sub->sub_pro_id])); ?>">
                     <?php if($sub->image != null): ?>
                    <img class="" src="<?php echo e(config('app.url')); ?>/medias/categories/<?php echo e($sub->image); ?>" alt="">
                    <?php else: ?>
                    <img class="" src="<?php echo e(asset('frontend-asset/image/blank.png')); ?>" alt="">
                    <?php endif; ?>
                    <div style="height: 50px; " class="d-flex">
                        <h4 class="text-title-dark mx-auto fix-text-width-product-selector"><?php echo e($sub->name); ?></h4>
                    </div>
                    </a>
                    
                </div>
                
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        
    

</div>
</div>
<div class="visible-mobile">
    <div class="box-product-selector padd-left-rbox">
        <h2 class="text-title-delta-home "><?php echo e($staticContent['Product_Selector']); ?></h2>
        <div id="product-selector-carousel-mobile" class="owl-carousel owl-theme product-selector text-center">
            <?php $__currentLoopData = $subCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="product-selector-list ">
                <div class="border-2px d-flex h-100 p-1 align-items-center" style="    box-shadow: 0px 4px 5px 2px rgba(0, 0, 0, 0.09);">
                    <div class="m-auto">
                        <a href="<?php echo e(route('producsList',[preg_replace('/\s+/', '_', $sub->name),$sub->sub_pro_id])); ?>">
                        <?php if($sub->image != null): ?>
                        <img class="" src="<?php echo e(config('app.url')); ?>/medias/categories/<?php echo e($sub->image); ?>" alt="">
                        <?php else: ?>
                        <img class="" src="<?php echo e(asset('frontend-asset/image/blank.png')); ?>" alt="">
                        <?php endif; ?>
                        <div style="height: 50px; " class="d-flex">
                            <h4 class="text-title-dark mx-auto fix-text-width-product-selector"><?php echo e($sub->name); ?></h4>
                        </div>
                        </a>
                        
                    </div>
                </div>
                
                
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        
</div>
</div>
<!-- application -->
<div class="visible-tablets-up">
    <div class="box-applications">
        <div class="container">
            <h2 class="text-title-delta-home "><?php echo e($staticContent['Applications']); ?></h2>
            <div class="grid-container">
                <?php $__currentLoopData = $applications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('applicationDetail' ,[ 'name' => preg_replace('/\s+/', '-',$item->applica_id.'-'.$item->name)])); ?>" class="" style="">
                    <div class="grid-item ">
                        <div class="grid-sub-pic"
                            style="background: url('<?php echo e(config('app.url')); ?>/medias/categories/<?php echo e($item->thumbnail); ?>');">
                            
                        </div>
                        <div class="grid-sub-text">
                            <img src="<?php echo e(config('app.url')); ?>/medias/categories/<?php echo e($item->color_icon); ?>" alt="">
                            <p class=""><?php echo e($item->name); ?></p>
                            
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
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>
        </div>
        <div class="text-center mr-24px" id="loadMore-application" style="">
            <a href="#" class="btn btn-boxen"><?php echo e($staticContent['See_More']); ?></a>
        </div>
    </div>
</div>
<div class="visible-mobile">
    <div class="box-applications-mobile  ">
        <div class="container">
            <h2 class="text-title-delta-home"><?php echo e($staticContent['Applications']); ?></h2>
            <div class="grid-container">
                <?php $__currentLoopData = $applications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('applicationDetail' ,[ 'name' => preg_replace('/\s+/', '-',$item->applica_id.'-'.$item->name)])); ?>" class="blogBox-mb moreBox-mb" style="display: none;">
                    <div class="grid-item ">
                        <div class="grid-sub-pic"
                            style="background: url('<?php echo e(config('app.url')); ?>/medias/categories/<?php echo e($item->thumbnail); ?>');">
                            
                        </div>
                        <div class="grid-sub-text">
                            <img src="<?php echo e(config('app.url')); ?>/medias/categories/<?php echo e($item->color_icon); ?>" alt="">
                            <p class=""><?php echo e($item->name); ?></p>
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
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>
        </div>
        <div class="text-center mr-24px" id="loadMore-application-mobile" style="">
            <a href="#" class="btn btn-boxen"><?php echo e($staticContent['See_More']); ?></a>
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
                <h2 class="text-title-delta-home"><?php echo e($staticContent['Featured_Products']); ?></h2>
            </div>
            <div id="producttype" class="owl-carousel owl-theme  ft-products-body">
                <?php $__currentLoopData = $featePros; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                    <div class="new-tag" style="background-color:<?php echo e($color); ?>"><?php echo e($name_sta); ?></div>
                    <div class="card-body ft-products-item">
                        <a href="<?php echo e(route('productsDetailsByType' ,['catename'=> preg_replace('/\s+/', '-', $pro['catename']) ,'pro_code' => setTextpro($pro['pro_code']) ])); ?>">
                        <?php if(isset($pro['picture'])): ?>
                        <img src="<?php echo e(config('app.url')); ?>/upload/thumbs/<?php echo e($pro['picture']); ?>" class="product-cat mb-2" alt=""
                            style="width:70%;">
                        <?php else: ?>
                         <img src="<?php echo e(asset('frontend-asset/image/blank.png')); ?>" class="product-cat mb-2" alt=""
                        style="width:70%;">
                        <?php endif; ?>
                        <h4 class="text-title-ft"><?php echo e($pro['pro_code']); ?></h4>
                        </a>
                        <div class="row m-d-t">
                            <div class="col-6">
                                <div class="out-volt">
                                    <h6 class="text-title-ft-sub"><?php echo e($staticContent['Output_Voltage']); ?></h6>
                                    <p class="text-ft-sub text-one">
                                       
                                        <?php if($pro['content'][1]->status_input == 3): ?>
                                        <?php if($pro['content'][1]->data_1 != null && $pro['content'][1]->data_2 != null): ?>
                                        <?php echo e($pro['content'][1]->data_1); ?>-<?php echo e($pro['content'][1]->data_2); ?><?php echo e($pro['content'][1]->unit_name); ?>      
                                         <?php else: ?> 
                                        -
                                        <?php endif; ?>
                                         <?php else: ?>
                                         <?php if($pro['content'][1]->data_1 != null): ?>
                                        <?php echo join(",",retextdata($datacheck1 , $pro['content'][1]->unit_name));?>
                                        <?php else: ?> 
                                        -
                                        <?php endif; ?>
                                        <?php endif; ?>
                                    </p>
                                </div>
                                <div class="out-power">
                                    <h6 class="text-title-ft-sub"><?php echo e($staticContent['Output_Power']); ?></h6>
                                    <p class="text-ft-sub text-one">
                                        
                                        <?php if($pro['content'][2]->status_input == 3): ?>
                                        <?php if($pro['content'][2]->data_1 != null && $pro['content'][2]->data_2 != null): ?>
                                             <?php echo e($pro['content'][2]->data_1); ?>-<?php echo e($pro['content'][2]->data_2); ?><?php echo e($pro['content'][2]->unit_name); ?>      
                                        <?php else: ?> 
                                        -
                                        <?php endif; ?>
                                        <?php else: ?>
                                            <?php if($pro['content'][2]->data_1 != null): ?>
                                         <?php echo join(",",retextdata($datacheck2 , $pro['content'][2]->unit_name));?>
                                             <?php else: ?> 
                                             -
                                             <?php endif; ?>
                                        <?php endif; ?>
                                    </p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="out-current">
                                    <h6 class="text-title-ft-sub"><?php echo e($staticContent['Output_Current']); ?></h6>
                                    <p class="text-ft-sub text-one">
                                        

                                        <?php if($pro['content'][0]->status_input == 3): ?>
                                        <?php if($pro['content'][0]->data_1 != null && $pro['content'][0]->data_2 != null): ?>
                                             <?php echo e($pro['content'][0]->data_1); ?>-<?php echo e($pro['content'][0]->data_2); ?><?php echo e($pro['content'][0]->unit_name); ?>      
                                        <?php else: ?> 
                                        -
                                        <?php endif; ?>
                                        <?php else: ?>
                                          <?php if($pro['content'][0]->data_1 != null): ?>
                                         <?php echo join(",",retextdata($datacheck3 , $pro['content'][0]->unit_name));?>
                                         <?php else: ?> 
                                         -
                                         <?php endif; ?>
                                        <?php endif; ?>
                                    </p>
                                </div>
                                <div class="in-volt">
                                    <h6 class="text-title-ft-sub"><?php echo e($staticContent['Input_Voltage']); ?></h6>
                                    <p class="text-ft-sub text-one"> <?php echo iconv_substr(strip_tags($pro['content'][3]->value_text),0,60,'UTF-8'); ?></p>
                                   
                                </div>
                            </div>
                        </div>

                        <div class="dimension">
                            <h6 class="text-title-ft-sub"><?php echo e($staticContent['Dimensions']); ?> (L x W x <?php echo e($pro['unit_dimension']); ?>) </h6>
                            <?php if(isset($pro['dimensionD'])): ?>
                            <p class="text-ft-sub text-one"><?php echo e($pro['dimensionL']); ?> x <?php echo e($pro['dimensionW']); ?> x
                                <?php echo e($pro['dimensionD']); ?> mm</p>
                            <p class="text-ft-sub text-one">
                                <?php echo e(number_format($pro['dimensionL']* 0.0393701 ,2)); ?>” x
                                <?php echo e(number_format($pro['dimensionW']* 0.0393701 ,2)); ?>” x
                                <?php echo e(number_format($pro['dimensionD']* 0.0393701 ,2)); ?>”</p>
                            <?php else: ?>
                            <p class="text-ft-sub text-one"><?php echo e($pro['dimensionL']); ?></p>
                            <?php endif; ?>
                            <div  class="btn btn-ft mt-2" onclick="showNavCoparison(<?php echo e($pro['pro_id']); ?> ,<?php echo e($pro['cateid']); ?>)">+ <?php echo e($staticContent['Add_to_Compare']); ?></div>
                        </div>
                        
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</div>
<div class="visible-mobile">
    <div class="box-pp  ">
        <div class="container mr-lr-feture">
            <div class="text-center">
                <h2 class="text-title-delta-home "><?php echo e($staticContent['Featured_Products']); ?></h2>
            </div>
            <div id="producttype-mobile" class="owl-carousel owl-theme  ft-products-body">

                <?php $__currentLoopData = $featePros; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                 <div class="new-tag" style="background-color:<?php echo e($color); ?>"><?php echo e($name_sta); ?></div>
                    <div class="card-body ft-products-item">
                        <a href="<?php echo e(route('productsDetailsByType' ,['catename'=> preg_replace('/\s+/', '-', $pro['catename']) ,'pro_code' => setTextpro($pro['pro_code']) ])); ?>">
                            <?php if(isset($pro['picture'])): ?>
                            <img src="<?php echo e(config('app.url')); ?>/upload/thumbs/<?php echo e($pro['picture']); ?>" class="product-cat mb-2" alt=""
                                style="width:70%;">
                            <?php else: ?>
                             <img src="<?php echo e(asset('frontend-asset/image/blank.png')); ?>" class="product-cat mb-2" alt=""
                            style="width:70%;">
                            <?php endif; ?>
                        <h6 class="text-title-ft"><?php echo e($pro['pro_code']); ?></h6>
                        </a>
                        <div class="flex-row">
                            <div class="out-volt mt-1">
                                <p class="text-title-ft-sub text-two"><?php echo e($staticContent['Output_Voltage']); ?></p>
                                <p class="text-ft-sub text-two">
                                    <?php if($pro['content'][1]->data_1 != null): ?>
                                    <?php echo e($pro['content'][1]->data_1); ?><?php echo e($pro['content'][1]->unit_name); ?> 
                                    <?php else: ?> 
                                    -
                                    <?php endif; ?>
                                </p>
                            </div>
                            <div class="out-power mt-2">
                                <p class="text-title-ft-sub text-two"><?php echo e($staticContent['Output_Power']); ?></p>
                                <p class="text-ft-sub text-two">
                                    <?php if($pro['content'][2]->data_1 != null): ?>
                                    <?php echo e($pro['content'][2]->data_1); ?><?php echo e($pro['content'][2]->unit_name); ?>

                                    <?php else: ?> 
                                    -
                                    <?php endif; ?>
                                </p>
                            </div>

                            <div class="out-current mt-2">
                                <p class="text-title-ft-sub text-two"><?php echo e($staticContent['Output_Current']); ?></p>
                                <p class="text-ft-sub text-two">
                                    <?php if($pro['content'][0]->data_1 != null): ?>
                                    <?php echo e($pro['content'][0]->data_1); ?><?php echo e($pro['content'][0]->unit_name); ?>

                                    <?php else: ?> 
                                    -
                                    <?php endif; ?>
                                </p>
                            </div>
                            <div class="in-volt mt-2">
                                <p class="text-title-ft-sub text-two"><?php echo e($staticContent['Input_Voltage']); ?></p>
                                <p class="text-ft-sub text-one"> <?php echo iconv_substr(strip_tags($pro['content'][3]->value_text),0,60,'UTF-8'); ?> ...</p>
                            </div>
                            <div class="dimension mt-2">
                                <p class="text-title-ft-sub text-two"><?php echo e($staticContent['Dimensions']); ?>  (L x W x <?php echo e($pro['unit_dimension']); ?>)  </p>
                                <?php if(isset($pro['dimensionD'])): ?>
                                <p class="text-ft-sub text-two"><?php echo e($pro['dimensionL']); ?> x <?php echo e($pro['dimensionW']); ?> x
                                    <?php echo e($pro['dimensionD']); ?> mm</p>
                                <p class="text-ft-sub text-two">
                                    <?php echo e(number_format($pro['dimensionL']* 0.0393701 ,2)); ?>” x
                                    <?php echo e(number_format($pro['dimensionW']* 0.0393701 ,2)); ?>” x
                                    <?php echo e(number_format($pro['dimensionD']* 0.0393701 ,2)); ?>”</p>
                                <?php else: ?>
                                <p class="text-ft-sub text-two"><?php echo iconv_substr(strip_tags($pro['dimensionL']),0,60,'UTF-8'); ?> ...</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div  class="btn btn-ft " onclick="showNavCoparison(<?php echo e($pro['pro_id']); ?> ,<?php echo e($pro['cateid']); ?>)">+ <?php echo e($staticContent['Add_to_Compare']); ?></div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                    <h2 class="text-title-delta-home"><?php echo e($staticContent['Upcoming_Event']); ?></h2>
                    <?php if(isset($events[0])): ?>
                    <div class="card">
                        <a href="<?php echo e(route('updateEventDetail',$events[0]['slug'])); ?>">
                        <div class="post-image">
                            <img src="<?php echo e(config('app.url')); ?>/uploads_delta/<?php echo e($events[0]['thumb']); ?>" alt=""
                                class="img-responsive">
                        </div>
                        </a>
                        <div class="news-content w-100">


                            <div class="post-meta">
                                <span class="author text-uppercase">
                                        <i class="zmdi zmdi-calendar-alt"></i>
                                        <?php echo e($events[0]['date']); ?> 
                                </span>
                                <span class="locations">
                                    &nbsp; <i class="zmdi zmdi-pin"></i> <?php echo e($events[0]['location']); ?>

                                </span>
                            </div>
                         
                            <h4 class="post-header title-new">
                                <a href="<?php echo e(route('updateEventDetail',$events[0]['slug'])); ?>">
                                <?php echo e($events[0]['title']); ?>

                               </a>
                            </h4>
                          
                            <p>
                                <?php echo iconv_substr(strip_tags($events[0]['content']),0,90,'UTF-8'); ?> ...
                            </p>
                        </div>
                        <a href="<?php echo e(route('updateEventDetail',$events[0]['slug'])); ?>" class="read-more"><?php echo e($staticContent['Read_More']); ?></a>
                    </div>
                    <?php endif; ?>
                    <div class="box-btn-boxen">
                        <a class="btn btn-boxen" href="<?php echo e(route('index','events')); ?>"><?php echo e($staticContent['See_All']); ?></a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <h2 class="text-title-delta-home"><?php echo e($staticContent['Latest_News']); ?></h2>
                    <?php if(isset($news[0])): ?>
                    <div class="card">
                        <a href="<?php echo e(route('updateNewsDetail',$news[0]['slug'])); ?>">
                        <div class="post-image">
                            <img src="<?php echo e(config('app.url')); ?>/uploads_delta/<?php echo e($news[0]['thumb']); ?>" alt=""
                                class="img-responsive">
                        </div>
                        </a>
                        <div class="news-content w-100">
                   
                            <div class="post-meta">
                                <a href="<?php echo e(route('updateNewsDetail',['name'=> $news[0]['slug']])); ?>" >
                                    <span class="sub-news" style="color:<?php echo e($news[0]['color_type']); ?>">
                                            <?php echo e($news[0]['cateName']); ?>

                                    </span>
                                    </a>
                                 
                                    <img class="line-symbol"src="<?php echo e(asset('/frontend-asset/image/line-symbol.svg')); ?>" alt="">
                                <span class="author text-uppercase">
                                    <?php echo e($news[0]['date']); ?>  <i class="zmdi zmdi-calendar-alt"></i>
                                
                                     
                                   
                                </span>
                                <?php if(isset($news[0]['location'])): ?>
                                <span class="locations">
                                    &nbsp;    <i class="zmdi zmdi-pin"></i> <?php echo e($news[0]['location']); ?>

                                </span>
                                <?php endif; ?>
                            </div>
                            <h4 class="post-header title-new">
                                <a href="<?php echo e(route('updateNewsDetail',$news[0]['slug'])); ?>">
                                <?php echo e($news[0]['title']); ?>

                                </a>
                            </h4>
                            <p> <?php echo iconv_substr(strip_tags($news[0]['content']),0,90,'UTF-8'); ?> ...
                            </p>
                        </div>
                        <a href="<?php echo e(route('updateNewsDetail',$news[0]['slug'])); ?>" class="read-more"><?php echo e($staticContent['Read_More']); ?></a>
                    </div>
                    <?php endif; ?>
                    <div class="box-btn-boxen">
                        <a class="btn btn-boxen" href="<?php echo e(route('index','news')); ?>"><?php echo e($staticContent['See_All']); ?></a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <h2 class="text-title-delta-home"><?php echo e($staticContent['FAQs']); ?></h2>
                    
                    <div class="card">
                    <a href="<?php echo e(route('index','faqs')); ?>" >
                        <div class="post-image w-100" >
                       
                        <img src="<?php echo e(config('app.url')); ?>/medias/static_content/<?php echo e($faqbanner->destop_image); ?>" alt=""
                             class="img-responsive">
                        </div>
                        </a>
                        <div class="news-content w-100">
                            <div class="post-meta">
                               
                               
                            </div>
                            <a href="<?php echo e(route('index','faqs')); ?>" >
                            <h4 class="post-header title-new">
                                 FAQs
                            </h4>
                            </a>
                            <p>  
                            </p>

                        </div>
                        <a href="<?php echo e(route('index','faqs')); ?>" class="read-more"><?php echo e($staticContent['Read_More']); ?></a>
                    </div>
                    <div class="box-btn-boxen">
                        <a class="btn btn-boxen" href="<?php echo e(route('index','faqs')); ?>"><?php echo e($staticContent['See_All']); ?></a>
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
                    <h2 class="text-title-delta-home"><?php echo e($staticContent['Upcoming_Event']); ?></h2>
                    <?php if(isset($events[0])): ?>
                    <div class="card">
                        <a href="<?php echo e(route('updateEventDetail',$events[0]['slug'])); ?>">
                        <div class="post-image">
                            <?php if(isset($events[0]['thumb'])): ?>
                            <img src="<?php echo e(config('app.url')); ?>/uploads_delta/<?php echo e($events[0]['thumb']); ?>" alt=""
                                class="img-responsive">
                             <?php else: ?> 
                             <img src="<?php echo e(config('app.url')); ?>/frontend-asset/image/upcoming-img.png" alt=""
                             class="img-responsive">
                            <?php endif; ?>
                        </div>
                        </a>
                        <div class="news-content w-100">
                            <?php
                            // $date = getDateformat(isset($events[0]->date_publish)? $events[0]->date_publish:'00:00:00');
                            //  $endDate = getDateformat(isset($events[0]->date_end)? $events[0]->date_end:'00:00:00');
                             ?> 
                          
                            <div class="post-meta">
                                <span class="author text-uppercase">
                                        
                                </span>
                           
                                <?php if(isset($events[0]['location'])): ?>
                                <span class="locations">
                                        <i class="zmdi zmdi-pin"></i> <?php echo e($events[0]['location']); ?>

                                </span>
                                <?php endif; ?>
                            </div>
                            <h4 class="post-header title-new">
                                <a href="<?php echo e(route('updateEventDetail',$events[0]['slug'])); ?>">
                                <?php echo e($events[0]['title']); ?>

                                </a>
                            </h4>
                            

                        </div>
                        <a href="<?php echo e(route('updateEventDetail',$events[0]['slug'])); ?>" class="read-more"><?php echo e($staticContent['Read_More']); ?></a>
                    </div>
                    <?php endif; ?>
                    <div class="box-btn-boxen">
                        <a class="btn btn-boxen" href="<?php echo e(route('index','events')); ?>"><?php echo e($staticContent['See_All']); ?></a>
                    </div>
                </div>
                <div class="col-md-6">
                    <h2 class="text-title-delta-home"><?php echo e($staticContent['Latest_News']); ?></h2>
                    <?php if(isset($news[0])): ?>
                    <div class="card">
                        <a href="<?php echo e(route('updateNewsDetail',$news[0]['slug'])); ?>">
                        <div class="post-image">
                            <?php if(isset($news[0]['thumb'])): ?>
                            <img src="<?php echo e(config('app.url')); ?>/uploads_delta/<?php echo e($news[0]['thumb']); ?>" alt=""
                                class="img-responsive">
                            <?php else: ?> 
                            <img src="<?php echo e(config('app.url')); ?>/frontend-asset/image/upcoming-img.png" alt=""
                            class="img-responsive">
                            <?php endif; ?>
                        </div>
                        </a>
                        <div class="news-content w-100">
                            <div class="post-meta">
                                <a href="<?php echo e(route('updateNewsDetail',['name'=> $news[0]['slug']])); ?>" >
                                    <span class="sub-news" style="color:<?php echo e($news[0]['color_type']); ?>">
                                            <?php echo e($news[0]['cateName']); ?>

                                    </span>
                                    </a>
                                    <img class="line-symbol"src="<?php echo e(asset('/frontend-asset/image/line-symbol.svg')); ?>" alt="">
                                <span class="author text-uppercase">
                                        <i class="zmdi zmdi-calendar-alt"></i> 
                                    
                                         <?php echo e($news[0]['date']); ?>

                                </span>
                                <?php if(isset($news[0]['location'])): ?>
                                <span class="locations">
                                        <i class="zmdi zmdi-pin"></i><?php echo e($news[0]['location']); ?>

                                </span>
                                <?php endif; ?>
                            </div>
                           
                            <h4 class="post-header title-new">
                                <a href="<?php echo e(route('updateNewsDetail',$news[0]['slug'])); ?>">
                                <?php echo e($news[0]['title']); ?>

                                </a>
                            </h4>
                       

                        </div>
                        <a href="<?php echo e(route('updateNewsDetail',$news[0]['slug'])); ?>" class="read-more"><?php echo e($staticContent['Read_More']); ?></a>
                    </div>
                    <?php endif; ?>
                    <div class="box-btn-boxen">
                        <a class="btn btn-boxen" href="<?php echo e(route('index','news')); ?>"><?php echo e($staticContent['See_All']); ?></a>
                    </div>
                </div>
                <div class="col-md-6">
                    <h2 class="text-title-delta-home"><?php echo e($staticContent['FAQs']); ?></h2>
                    <div class="card">
                        <a href="<?php echo e(route('index','faqs')); ?>" >
                            <div class="post-image w-100" >
                                <img src="<?php echo e(config('app.url')); ?>/medias/static_content/<?php echo e($faqbanner->destop_image); ?>" alt=""
                                class="img-responsive">
                                 
                            </div>
                            </a>
                            <div class="news-content w-100">
                                <div class="post-meta">
                                   
                                   
                                </div>
                                <a href="<?php echo e(route('index','faqs')); ?>" >
                                <h4 class="post-header title-new">
                                     FAQs
                                </h4>
                                </a>
                                <p>  
                                </p>
    
                            </div>
                            <a href="<?php echo e(route('index','faqs')); ?>" class="read-more"><?php echo e($staticContent['Read_More']); ?></a>
                        </div>
                        <div class="box-btn-boxen">
                            <a class="btn btn-boxen" href="<?php echo e(route('index','faqs')); ?>"><?php echo e($staticContent['See_All']); ?></a>
                        </div>
                    </div>
                   
            </div>
            
        </div>

    </div>

</div>
<!-- box-product-document -->
<div class="visible-desk-up">
    <div class="box-product-document">
        <div class="container">
            <div class="box-product-document-all midle-item">
                <h3 class="text-title-banner"><?php echo e($static_content->title); ?></h3>
                <div class="text-be-first">
                    <?php echo $static_content->content; ?>

                </div>
                <a href="<?php echo e(route('index','product-documents')); ?>" >
                <button class="btn btn-subscribe" href=""><?php echo e($staticContent['Learn_More']); ?></button>
                </a>
            </div>

            <img class="image-doc" src="<?php echo e(config('app.url')); ?>/medias/static_content/<?php echo e($static_content->destop_image); ?>"
                alt="">
        </div>
    </div>
</div>
<div class="visible-nav-minimize">
    <div class="box-product-document-mobile"
        style=" background: url('<?php echo e(asset('frontend-asset/image/Docdownload-BG.jpg')); ?>');">
        <img class="image-doc" src="<?php echo e(config('app.url')); ?>/medias/static_content/<?php echo e($static_content->destop_image); ?>"
            alt="">
        <div class="container">
            <div class="box-product-document-all">
                <h2 class="text-title-banner"><?php echo e($static_content->title); ?></h2>
                <div class="text-be-first">
                    <?php echo $static_content->content; ?>

                </div>
                <a href="<?php echo e(route('index','product-documents')); ?>" >
                <button class="btn btn-subscribe" href=""><?php echo e($staticContent['Learn_More']); ?></button>
                </a>
            </div>
        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>

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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.front-end', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Deltapsu_Production\dependencies\resources\views/front-end/home.blade.php ENDPATH**/ ?>