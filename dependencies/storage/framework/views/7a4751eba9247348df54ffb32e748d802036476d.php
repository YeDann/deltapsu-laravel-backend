<?php $__env->startSection('css'); ?>
<style>


    #slide-application .owl-item div{
        height: 360px;
        background-size: cover;
        background-repeat: no-repeat;

    }
    
   
    #slide-application-mobile .owl-item div {
        height: 250px;
        background-size: cover;
        background-repeat: no-repeat;
    }

    #slide-application .owl-dots,#slide-application-mobile .owl-dots {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
    }
    .image-slide{
        padding-right: 18px;
    }
    .app-text-detail{
        padding-left: 18px;
    }
    #related-product .item-related ,#related-product-mobile .item-related {
        width: 100%;
        height: 200px;
        border: 2px solid #E3EFF8;
        background-size: cover;
        background: no-repeat;
        text-align: center;
     
    }
    #related-product .item-related:hover,#related-product-mobile .item-related:hover{
        border: 2px solid #0087DC;
    }

    #related-product .item-related img,#related-product-mobile .item-related img{
        padding-top: 10px;
        max-width:100%;
        margin-left: auto;
        margin-right: auto;
        margin-bottom: 20px;
    }
 
    .item-related:hover .text-title-twenty-dark{
        color: #0087DC;
    }
    .item-related:hover .text-hover {
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        visibility: visible;
    }
    .text-hover {
        visibility: hidden;
        line-height: 1;
        color:#5F5F5F;
        font-size: 14px;
        
    }
    .other-applications-grid{
        display: flex;
        flex-wrap: wrap;
    }
    .other-applications-list{
        height: 100px;
        padding: 24px;
        border: 2px solid #E3EFF8;
        margin-bottom: 20px;
    }
    .other-applications-list img{
        width: 64px;
    }
    .other-applications-grid-mobile{
        display: flex;
        flex-wrap: wrap;
    }
    .other-applications-grid-mobile-list{
        min-height: 150px;
        max-height: 250px;
        padding: 24px;
        border: 2px solid #E3EFF8;
    }
    @media  only screen and (max-width:1365px) {
    
    .other-applications-list{
        flex: 0 0 0 30%;
        width:30%;
        margin: 12px;
    }
    
}
    @media  only screen and (max-width:1200px) {
    
        .other-applications-list{
            flex: 0 0 0 30%;
            width:30%;
            margin: 12px;
        }
        
    }
    @media  only screen and (max-width:992px) {
    
    .other-applications-grid-mobile-list{
        flex: 0 0 0 29%;
        width:29%;
        margin: 12px;
    }
    
 }
 @media  only screen and (max-width:769px) {
    
    .other-applications-grid-mobile-list{
        flex: 0 0 0 45%;
        width:45%;
        margin: 12px;
    }
    
 }
    @media (max-width:560px){
        .other-applications-grid-mobile{
            grid-template-columns: 1fr;
        }
        .other-applications-grid-mobile-list{
            flex: 0 0 0 100%;
            width:100%;
            margin: 12px 0px;
        }
        #related-product-mobile{
            padding-left: 10px;
            padding-right: 10px;
        }
     #product-selector-carousel-mobile .owl-prev ,#related-product-mobile .owl-prev{
        left: -20px;
    }
    #product-selector-carousel-mobile .owl-next,#related-product-mobile .owl-next{
        right: -20px;
    }
    }
    p b{
        font-weight: bold;
    }
    .text-title-twenty-dark{
        line-height: 1;
    }
    .h-text-app{
        height: 50px;
       margin-top: 33px;
    }
    .app-middle-box{
 
        display: flex;
    }
    .other-applications-grid-mobile-list img{
        height: 70px;
    }
    
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('meta'); ?>
<title><?php echo e(isset($application->name)? $application->name :''); ?> | DeltaPSU</title>
<meta name="description" content="<?php echo e(isset($application->overview_text)? $application->overview_text:''); ?>">
<meta name="keywords" content="<?php echo e(isset($application->name) ? $application->name :''); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('container'); ?>
<div class="padding-top-content">
</div>
<div class="products-index-nav visible-up-922">
    <div class="bg-bredcrumb">
        <div class="container">
            <nav aria-label="breadcrumb" id="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item text-breadcrumb-home"><a href="<?php echo e(route('index','home')); ?>"><?php echo e($staticContent['Home']); ?></a></li>
                            <li class="breadcrumb-item active text-breadcrumb-home dropdown" aria-current="page"><a
                                href="#" data-toggle="dropdown" id="tools-dropdown"> <?php echo e($staticContent['Applications']); ?></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#" id="tools-dropdown" class="text-bold"><?php echo e($staticContent['Applications']); ?></a></li>
                                    <hr>
                                <?php $__currentLoopData = $navapplication; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $app): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><a href="<?php echo e(route('applicationDetail' ,[ 'name' => preg_replace('/\s+/', '-',$app->applica_id.'-'.$app->name)])); ?>"><?php echo e($app->name); ?></a></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                                </ul>   
                        </li>
                    <li class="breadcrumb-item active text-breadcrumb" aria-current="page"><a href="#"><?php echo e($application->name); ?></a></li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="visible-up-922">
    <div class="banner-type-product-all-new item "
        style="background:linear-gradient(90deg, rgba(68,68,68,0.45702030812324934) 0%, rgba(255,255,255,0) 50%),url('<?php echo e(config('app.url')); ?>/medias/categories/<?php echo e($application->banner); ?>') center no-repeat; background-size: cover;">
            
        <div class="container">
            <div class="box-banner-pro-type-all-new ">
                <div class="text-middle ">
                    <h1 class="text-title-white"><?php echo e($application->name); ?></h1>
                    <div class="text-white">   <?php
                        $str = $application->overview_text;
                        $st = explode("\n", $str);
                        for ($k = 0; $k < count($st); $k++) {
                            echo $st[$k] = '<div>'
                                    . $st[$k]
                                    . '</div>';
                        }
                        ?></div>
                </div>
            </div>
        </div>
    </div>
    <div class="box-application-detail pt-5 ">
        <div class="container">
            <div class="row">
                <div class="col-6 image-slide">
                <div id="slide-application" class="owl-carousel owl-theme">
                    <?php $__currentLoopData = $image; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="item <?php echo e(($loop->iteration == 1)?"active":""); ?>" style="background-image: url('<?php echo e(config('app.url')); ?>/medias/categories/<?php echo e($item->image_name); ?>');'"></div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <div class="col-6 app-text-detail">
                     
                    <?php echo $application->content ?>

                    <h3 class="text-color-delta mt-3"><?php echo e($staticContent['Typical_Applications']); ?></h3>
                    <div class="row type-applications">
                        <?php
                        $str = $application->overview;
                        $st = explode("\n", $str);

                          echo '<ul class="col-6 order-2">';
                            for ($k = 0; $k < count($st); $k++) {
                                if($k % 2 > 0){
                                    echo $st[$k] = '<li>'
                                        . $st[$k]
                                        . '</li>';
                                    }
                                
                                
                            }
                            echo '</ul>';
                            echo '<ul class="col-6 order-1">';
                            for ($k = 0; $k < count($st); $k++) {
                                if($k % 2 == 0){
                                    echo $st[$k] = '<li>'
                                        . $st[$k]
                                        . '</li>';
                                    }
                                
                                
                            }
                            echo '</ul>';

                        ?>
             
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    <div class="box-relate-product ">
        <div class="container">
            <h2 class="text-title-delta"><?php echo e($staticContent['Related_Product_Series']); ?></h2>
            <div id="related-product" class="owl-carousel owl-theme ft-products-body owl-loaded owl-drag mr-b-12px">
                <?php $__currentLoopData = $relatedApp; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $serie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="item-related d-flex">
                    <a style="color:inherit;" class="" href="<?php echo e(route('productBySeries',[$serie->title,$serie->se_id])); ?>">
                    <div class="m-auto">
                        
                        <?php if(isset($serie->image)): ?>
                        <img 
                            src="<?php echo e(config('app.url')); ?>/medias/categories/<?php echo e($serie->image); ?>" alt="">
                        <?php else: ?>
                        <img  src="<?php echo e(asset('frontend-asset/image/blank.png')); ?>" alt="">
                        <?php endif; ?>
                      <p class="text-title-twenty-dark"><?php echo e($serie->title); ?></p>
                     
                        
                    </div>
                   </a>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              
            </div>
            
            <p style="color:#9098a9;" class="text-center"><?php echo e($staticContent['This_is_general_information']); ?></p>
            <div class="in-div-center mt-4 mb-5">
                    <a href="<?php echo e(route('contactSupport')); ?>"class="btn btn-border-delta"><?php echo e($staticContent['contact_us']); ?></a>
            </div>
            
        </div>
    </div>
    <div class="box-other-applications pb-5 ">
        <div class="container">
            <h2 class="text-title-delta"><?php echo e($staticContent['Other_Application']); ?></h2>
            <div class="row">
                <?php $__currentLoopData = $otherapp; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $app): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-3">
                    <a href="<?php echo e(route('applicationDetail' ,[ 'name' => preg_replace('/\s+/', '-',$app->applica_id.'-'.$app->name)])); ?>" class="other-applications-list media">
                    
                        <div class="app-middle-box align-self-center">
                        <img class="mr-3" src="<?php echo e(config('app.url')); ?>/medias/categories/<?php echo e($app->color_icon); ?>" >
                        <div class="h-text-app">
                            <h5 class="text-title-dark"><?php echo e($app->name); ?> </h5>
                        </div>
                        </div>
                     
                      
                    </a>
                </div>
              
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</div>
<div class="invisible-up-922 mb-4">
    <div class="banner-type-product-all"
        style="background-image: url('<?php echo e(config('app.url')); ?>/medias/categories/<?php echo e($application->banner); ?>'); height:250px !important;">
    </div>
    <div class="container">
        <h3 class="text-center text-color-delta mt-4"><?php echo e($application->name); ?></h3>
        <p class="text-center ">  
            <?php
            $str = $application->overview_text;
            $st = explode("\n", $str);
            for ($k = 0; $k < count($st); $k++) {
                echo $st[$k] = '<div>'
                        . $st[$k]
                        . '</div>';
            }
            ?></p>
   
 
        
        <div class="text-editor">
        <?php echo $application->content ?>
        </div>
        <h4 class="text-color-delta mt-4"><?php echo e($staticContent['Typical_Applications']); ?></h4>
        <div class="row type-applications">
            <?php
            $str = $application->overview;
            $st = explode("\n", $str);

              echo '<ul class="col-6 order-2">';
                for ($k = 0; $k < count($st); $k++) {
                    if($k % 2 > 0){
                        echo $st[$k] = '<li>'
                            . $st[$k]
                            . '</li>';
                        }
                    
                    
                }
                echo '</ul>';
                echo '<ul class="col-6 order-1">';
                for ($k = 0; $k < count($st); $k++) {
                    if($k % 2 == 0){
                        echo $st[$k] = '<li>'
                            . $st[$k]
                            . '</li>';
                        }
                    
                    
                }
                echo '</ul>';

            ?>
        </div>
        <div class="d-flex">
            <div id="slide-application-mobile" class="owl-carousel owl-theme mx-auto my-4">
                <?php $__currentLoopData = $image; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="item <?php echo e(($loop->iteration == 1)?"active":""); ?>" style="background-image: url('<?php echo e(config('app.url')); ?>/medias/categories/<?php echo e($item->image_name); ?>');'"></div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <h3 class="text-title-delta"><?php echo e($staticContent['Related_Product_Series']); ?></h3>
        <div>
            
        </div>
        <div id="related-product-mobile" class="owl-carousel owl-theme ft-products-body owl-loaded owl-drag mr-b-12px">
            <?php $__currentLoopData = $relatedApp; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $serie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="item-related d-flex">
                <a style="color:inherit;" class="" href="<?php echo e(route('productBySeries',[$serie->title,$serie->se_id])); ?>">
                <div class="m-auto">
                    <?php if(isset($serie->image)): ?>
                    <img 
                        src="<?php echo e(config('app.url')); ?>/medias/categories/<?php echo e($serie->image); ?>" alt="">
                    <?php else: ?>
                    <img  src="<?php echo e(asset('frontend-asset/image/blank.png')); ?>" alt="">
                    <?php endif; ?>
                  <p class="text-title-twenty-dark"><?php echo e($serie->title); ?></p>
                    
                </div>
                <div class="d-"></div>
                </a>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <p style="color:#9098a9;" class="text-center mt-4"><?php echo e($staticContent['This_is_general_information']); ?></p>
        <div class="in-div-center my-3">
        <a href="<?php echo e(route('contactSupport')); ?>"class="btn btn-border-delta mb-3"><?php echo e($staticContent['contact_us']); ?></a>
        </div>
        <h3 class="text-title-delta"><?php echo e($staticContent['Other_Application']); ?></h3>
        <div class="other-applications-grid-mobile">
            <?php $__currentLoopData = $otherapp; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $app): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('applicationDetail' ,[ 'name' => preg_replace('/\s+/', '-',$app->applica_id.'-'.$app->name)])); ?>" class="other-applications-grid-mobile-list">
           
                <img class="center my-2" src="<?php echo e(config('app.url')); ?>/medias/categories/<?php echo e($app->color_icon); ?>" >
                <h5 class="text-title-dark text-center"><?php echo e($app->name); ?></h5>
              
               
            </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div> 
    
</div>


<?php $__env->stopSection(); ?>


<?php $__env->startSection('js'); ?>
<script>
    $(document).ready(function() {
        $("#slide-application").owlCarousel({
            loop: true,
            navigation: true, // Show next and prev buttons
            paginationSpeed: 400,
            singleItem: true,
            items: 1,
            dotsEach: 1,
            autoplay:true,
            autoplaySpeed: 1000,
            autoplayHoverPause:true

            });
        $("#slide-application-mobile").owlCarousel({
            loop: true,
            navigation: true, // Show next and prev button
            paginationSpeed: 400,
            singleItem: true,
            items: 1,
            dotsEach: 1,
            autoplay:true,
            autoplaySpeed: 1000,
            autoplayHoverPause:true

        });
        $("#related-product").owlCarousel({
                loop: false,
                margin: 24,
                /* autoWidth:true, */
                nav: true,
                responsive: {
                    0: {
                       items: 1
                       },
                    1000: {
                       items: 4
                       },
                    1200: {
                       items: 6
                       }
                },
                navText: ['<i class="zmdi zmdi-chevron-left" aria-hidden="true"></i>',
                            '<i class="zmdi zmdi-chevron-right" aria-hidden="true"></i>',
                ]
            
        });
          
        $("#related-product-mobile").owlCarousel({
                loop: false,
                margin: 24,
                /* autoWidth:true, */
                dotsEach: 3,
                nav: true,
                responsive: {
                    0: {
                       items: 1
                       },
                    400: {
                       items: 2
                    },
                    550: {
                       items: 3
                       }
                },
                navText: ['<i class="zmdi zmdi-chevron-left" aria-hidden="true"></i>',
                            '<i class="zmdi zmdi-chevron-right" aria-hidden="true"></i>',
                ]
            
        });
    });
    
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front-end', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Deltapsu_Production\dependencies\resources\views\front-end\applicationdetail.blade.php ENDPATH**/ ?>