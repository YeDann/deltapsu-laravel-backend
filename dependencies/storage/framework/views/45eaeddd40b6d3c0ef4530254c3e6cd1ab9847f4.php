
<?php $__env->startSection('css'); ?>
<style>
    .box-news .container{
        padding: 80px 0;
    }

</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('container'); ?>
<div class="padding-top-content">
</div>
<div class="products-index-nav">
    <div class="bg-bredcrumb">
        <div class="container">
            <nav aria-label="breadcrumb" id="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item text-breadcrumb-home"><a href="<?php echo e(route('index','home')); ?>">HOME</a></li>
                    <li class="breadcrumb-item active text-breadcrumb-home dropdown" aria-current="page"><a
                            href="#" data-toggle="dropdown" id="tools-dropdown">UPDATES</a>
                            <ul class="dropdown-menu">
                                <li><a href="#" id="tools-dropdown" class="text-bold">UPDATES</a></li>
                                <hr>
                                <li><a href="<?php echo e(route('index','news')); ?>">NEWS</a></li>
                                <li><a href="<?php echo e(route('index','events')); ?>">EVENTS & CALENDAR</a></li>
                                <li><a href="<?php echo e(route('index','technical-articles')); ?>">TECHNICAL ARTICLES</a></li>
                                <li><a href="<?php echo e(route('index','product-notice')); ?>">PRODUCT NOTICE</a></li>
                              </ul>   
                    </li>
                    <li class="breadcrumb-item active text-breadcrumb" aria-current="page"><a href="#">PRODUCT NOTICE</a></li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<section class="box-news ">
    <div class="container">
        <p class="text-title text-center">PRODUCT NOTICE</p>
        <div class="row">
            <div class="col-md-12">
                <nav class="nav-justified">
                    <div class="nav nav-tabs " id="nav-tab" role="tablist">
                        <a class="nav-item nav-link font-size-tab active" id="pop1-tab" data-toggle="tab" href="#pop1"
                            role="tab" aria-controls="pop1" aria-selected="true">ALL</a>
                        <a class="nav-item nav-link font-size-tab" id="pop2-tab" data-toggle="tab" href="#pop2"
                            role="tab" aria-controls="pop2" aria-selected="false">PRODUCT UPDATE</a>
                        <a class="nav-item nav-link font-size-tab" id="pop3-tab" data-toggle="tab" href="#pop3"
                            role="tab" aria-controls="pop3" aria-selected="false">EOL</a>
                        <a class="nav-item nav-link font-size-tab" id="pop4-tab" data-toggle="tab" href="#pop4"
                            role="tab" aria-controls="pop4" aria-selected="false">OTHERS</a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="pop1" role="tabpanel" aria-labelledby="pop1-tab">
                        <div class="pt-3"></div>
                        <div class="grid-news">
                            <div class="grid-list-news">
                                <div class="card">
                                    <div class="post-image">
                                        <img src="<?php echo e(asset('/frontend-asset/image/latest-news-img.png')); ?>" alt=""
                                            class="img-responsive">
                                    </div>
                                    <div class="news-content">
                                        <div class="post-meta">
                                            <span class="sub-news company">
                                                <a href="#">
                                                    COMPANY
                                                </a>
                                            </span>
                                        <img class="line-symbol"src="<?php echo e(asset('/frontend-asset/image/line-symbol.svg')); ?>" alt="">
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
                                        <img src="<?php echo e(asset('/frontend-asset/image/new product.png')); ?>" alt=""
                                            class="img-responsive">
                                    </div>
                                    <div class="news-content">
                                        <div class="post-meta">
                                            <span class="sub-news new">
                                                <a href="#">
                                                    NEW PRODUCTS
                                                </a>
                                            </span>
                                        <img class="line-symbol"src="<?php echo e(asset('/frontend-asset/image/line-symbol.svg')); ?>" alt="">
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
                                        <img src="<?php echo e(asset('/frontend-asset/image/other.png')); ?>" alt=""
                                            class="img-responsive">
                                    </div>
                                    <div class="news-content">
                                        <div class="post-meta">
                                            <span class="sub-news other">
                                                <a href="#">
                                                   OTHER
                                                </a>
                                            </span>
                                        <img class="line-symbol"src="<?php echo e(asset('/frontend-asset/image/line-symbol.svg')); ?>" alt="">
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
                                        <img src="<?php echo e(asset('/frontend-asset/image/latest-news-img.png')); ?>" alt=""
                                            class="img-responsive">
                                    </div>
                                    <div class="news-content">
                                        <div class="post-meta">
                                            <span class="sub-news company">
                                                <a href="#">
                                                    COMPANY
                                                </a>
                                            </span>
                                        <img class="line-symbol"src="<?php echo e(asset('/frontend-asset/image/line-symbol.svg')); ?>" alt="">
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
                                        <img src="<?php echo e(asset('/frontend-asset/image/latest-news-img.png')); ?>" alt=""
                                            class="img-responsive">
                                    </div>
                                    <div class="news-content">
                                        <div class="post-meta">
                                            <span class="sub-news company">
                                                <a href="#">
                                                    COMPANY
                                                </a>
                                            </span>
                                        <img class="line-symbol"src="<?php echo e(asset('/frontend-asset/image/line-symbol.svg')); ?>" alt="">
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
                                        <img src="<?php echo e(asset('/frontend-asset/image/latest-news-img.png')); ?>" alt=""
                                            class="img-responsive">
                                    </div>
                                    <div class="news-content">
                                        <div class="post-meta">
                                            <span class="sub-news company">
                                                <a href="#">
                                                    COMPANY
                                                </a>
                                            </span>
                                        <img class="line-symbol"src="<?php echo e(asset('/frontend-asset/image/line-symbol.svg')); ?>" alt="">
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
                                        <img src="<?php echo e(asset('/frontend-asset/image/latest-news-img.png')); ?>" alt=""
                                            class="img-responsive">
                                    </div>
                                    <div class="news-content">
                                        <div class="post-meta">
                                            <span class="sub-news company">
                                                <a href="#">
                                                    COMPANY
                                                </a>
                                            </span>
                                        <img class="line-symbol"src="<?php echo e(asset('/frontend-asset/image/line-symbol.svg')); ?>" alt="">
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
                                        <img src="<?php echo e(asset('/frontend-asset/image/latest-news-img.png')); ?>" alt=""
                                            class="img-responsive">
                                    </div>
                                    <div class="news-content">
                                        <div class="post-meta">
                                            <span class="sub-news company">
                                                <a href="#">
                                                    COMPANY
                                                </a>
                                            </span>
                                        <img class="line-symbol"src="<?php echo e(asset('/frontend-asset/image/line-symbol.svg')); ?>" alt="">
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
                                        <img src="<?php echo e(asset('/frontend-asset/image/latest-news-img.png')); ?>" alt=""
                                            class="img-responsive">
                                    </div>
                                    <div class="news-content">
                                        <div class="post-meta">
                                            <span class="sub-news company">
                                                <a href="#">
                                                    COMPANY
                                                </a>
                                            </span>
                                        <img class="line-symbol"src="<?php echo e(asset('/frontend-asset/image/line-symbol.svg')); ?>" alt="">
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
                                        <img src="<?php echo e(asset('/frontend-asset/image/latest-news-img.png')); ?>" alt=""
                                            class="img-responsive">
                                    </div>
                                    <div class="news-content">
                                        <div class="post-meta">
                                            <span class="sub-news company">
                                                <a href="#">
                                                    COMPANY
                                                </a>
                                            </span>
                                        <img class="line-symbol"src="<?php echo e(asset('/frontend-asset/image/line-symbol.svg')); ?>" alt="">
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
                                        <img src="<?php echo e(asset('/frontend-asset/image/latest-news-img.png')); ?>" alt=""
                                            class="img-responsive">
                                    </div>
                                    <div class="news-content">
                                        <div class="post-meta">
                                            <span class="sub-news company">
                                                <a href="#">
                                                    COMPANY
                                                </a>
                                            </span>
                                        <img class="line-symbol"src="<?php echo e(asset('/frontend-asset/image/line-symbol.svg')); ?>" alt="">
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
                                        <img src="<?php echo e(asset('/frontend-asset/image/latest-news-img.png')); ?>" alt=""
                                            class="img-responsive">
                                    </div>
                                    <div class="news-content">
                                        <div class="post-meta">
                                            <span class="sub-news company">
                                                <a href="#">
                                                    COMPANY
                                                </a>
                                            </span>
                                        <img class="line-symbol"src="<?php echo e(asset('/frontend-asset/image/line-symbol.svg')); ?>" alt="">
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
                                        <img src="<?php echo e(asset('/frontend-asset/image/latest-news-img.png')); ?>" alt=""
                                            class="img-responsive">
                                    </div>
                                    <div class="news-content">
                                        <div class="post-meta">
                                            <span class="sub-news company">
                                                <a href="#">
                                                    COMPANY
                                                </a>
                                            </span>
                                        <img class="line-symbol"src="<?php echo e(asset('/frontend-asset/image/line-symbol.svg')); ?>" alt="">
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
                                        <img src="<?php echo e(asset('/frontend-asset/image/latest-news-img.png')); ?>" alt=""
                                            class="img-responsive">
                                    </div>
                                    <div class="news-content">
                                        <div class="post-meta">
                                            <span class="sub-news company">
                                                <a href="#">
                                                    COMPANY
                                                </a>
                                            </span>
                                        <img class="line-symbol"src="<?php echo e(asset('/frontend-asset/image/line-symbol.svg')); ?>" alt="">
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
                                        <img src="<?php echo e(asset('/frontend-asset/image/latest-news-img.png')); ?>" alt=""
                                            class="img-responsive">
                                    </div>
                                    <div class="news-content">
                                        <div class="post-meta">
                                            <span class="sub-news company">
                                                <a href="#">
                                                    COMPANY
                                                </a>
                                            </span>
                                        <img class="line-symbol"src="<?php echo e(asset('/frontend-asset/image/line-symbol.svg')); ?>" alt="">
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
                                        <img src="<?php echo e(asset('/frontend-asset/image/latest-news-img.png')); ?>" alt=""
                                            class="img-responsive">
                                    </div>
                                    <div class="news-content">
                                        <div class="post-meta">
                                            <span class="sub-news company">
                                                <a href="#">
                                                    COMPANY
                                                </a>
                                            </span>
                                        <img class="line-symbol"src="<?php echo e(asset('/frontend-asset/image/line-symbol.svg')); ?>" alt="">
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
                                        <img src="<?php echo e(asset('/frontend-asset/image/latest-news-img.png')); ?>" alt=""
                                            class="img-responsive">
                                    </div>
                                    <div class="news-content">
                                        <div class="post-meta">
                                            <span class="sub-news company">
                                                <a href="#">
                                                    COMPANY
                                                </a>
                                            </span>
                                        <img class="line-symbol"src="<?php echo e(asset('/frontend-asset/image/line-symbol.svg')); ?>" alt="">
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
                                        <img src="<?php echo e(asset('/frontend-asset/image/latest-news-img.png')); ?>" alt=""
                                            class="img-responsive">
                                    </div>
                                    <div class="news-content">
                                        <div class="post-meta">
                                            <span class="sub-news company">
                                                <a href="#">
                                                    COMPANY
                                                </a>
                                            </span>
                                        <img class="line-symbol"src="<?php echo e(asset('/frontend-asset/image/line-symbol.svg')); ?>" alt="">
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
                                        <img src="<?php echo e(asset('/frontend-asset/image/new product.png')); ?>" alt=""
                                            class="img-responsive">
                                    </div>
                                    <div class="news-content">
                                        <div class="post-meta">
                                            <span class="sub-news new">
                                                <a href="#">
                                                    NEW PRODUCTS
                                                </a>
                                            </span>
                                        <img class="line-symbol"src="<?php echo e(asset('/frontend-asset/image/line-symbol.svg')); ?>" alt="">
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
                                            <img src="<?php echo e(asset('/frontend-asset/image/new product.png')); ?>" alt=""
                                            class="img-responsive">
                                    </div>
                                    <div class="news-content">
                                        <div class="post-meta">
                                            <span class="sub-news new">
                                                <a href="#">
                                                    NEW PRODUCTS
                                                </a>
                                            </span>
                                        <img class="line-symbol"src="<?php echo e(asset('/frontend-asset/image/line-symbol.svg')); ?>" alt="">
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
                                            <img src="<?php echo e(asset('/frontend-asset/image/new product.png')); ?>" alt=""
                                            class="img-responsive">
                                    </div>
                                    <div class="news-content">
                                        <div class="post-meta">
                                            <span class="sub-news new">
                                                <a href="#">
                                                    NEW PRODUCTS
                                                </a>
                                            </span>
                                        <img class="line-symbol"src="<?php echo e(asset('/frontend-asset/image/line-symbol.svg')); ?>" alt="">
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
                                            <img src="<?php echo e(asset('/frontend-asset/image/new product.png')); ?>" alt=""
                                            class="img-responsive">
                                    </div>
                                    <div class="news-content">
                                        <div class="post-meta">
                                            <span class="sub-news new">
                                                <a href="#">
                                                    NEW PRODUCTS
                                                </a>
                                            </span>
                                        <img class="line-symbol"src="<?php echo e(asset('/frontend-asset/image/line-symbol.svg')); ?>" alt="">
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
                                            <img src="<?php echo e(asset('/frontend-asset/image/new product.png')); ?>" alt=""
                                            class="img-responsive">
                                    </div>
                                    <div class="news-content">
                                        <div class="post-meta">
                                            <span class="sub-news new">
                                                <a href="#">
                                                    NEW PRODUCTS
                                                </a>
                                            </span>
                                        <img class="line-symbol"src="<?php echo e(asset('/frontend-asset/image/line-symbol.svg')); ?>" alt="">
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
                                            <img src="<?php echo e(asset('/frontend-asset/image/new product.png')); ?>" alt=""
                                            class="img-responsive">
                                    </div>
                                    <div class="news-content">
                                        <div class="post-meta">
                                           <span class="sub-news new">
                                                <a href="#">
                                                    NEW PRODUCTS
                                                </a>
                                            </span>
                                        <img class="line-symbol"src="<?php echo e(asset('/frontend-asset/image/line-symbol.svg')); ?>" alt="">
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
                                            <img src="<?php echo e(asset('/frontend-asset/image/new product.png')); ?>" alt=""
                                            class="img-responsive">
                                    </div>
                                    <div class="news-content">
                                        <div class="post-meta">
                                            <span class="sub-news new">
                                                <a href="#">
                                                    NEW PRODUCTS
                                                </a>
                                            </span>
                                        <img class="line-symbol"src="<?php echo e(asset('/frontend-asset/image/line-symbol.svg')); ?>" alt="">
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
                                            <img src="<?php echo e(asset('/frontend-asset/image/new product.png')); ?>" alt=""
                                            class="img-responsive">
                                    </div>
                                    <div class="news-content">
                                        <div class="post-meta">
                                            <span class="sub-news new">
                                                <a href="#">
                                                    NEW PRODUCTS
                                                </a>
                                            </span>
                                        <img class="line-symbol"src="<?php echo e(asset('/frontend-asset/image/line-symbol.svg')); ?>" alt="">
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
                                        <img src="<?php echo e(asset('/frontend-asset/image/new product.png')); ?>" alt=""
                                            class="img-responsive">
                                    </div>
                                    <div class="news-content">
                                        <div class="post-meta">
                                            <span class="sub-news new">
                                                <a href="#">
                                                    NEW PRODUCTS
                                                </a>
                                            </span>
                                        <img class="line-symbol"src="<?php echo e(asset('/frontend-asset/image/line-symbol.svg')); ?>" alt="">
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
                                            <img src="<?php echo e(asset('/frontend-asset/image/other.png')); ?>" alt=""
                                                class="img-responsive">
                                        </div>
                                        <div class="news-content">
                                            <div class="post-meta">
                                                <span class="sub-news other">
                                                    <a href="#">
                                                        OTHERS
                                                    </a>
                                                </span>
                                            <img class="line-symbol"src="<?php echo e(asset('/frontend-asset/image/line-symbol.svg')); ?>" alt="">
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
                                            <img src="<?php echo e(asset('/frontend-asset/image/other.png')); ?>" alt=""
                                                class="img-responsive">
                                        </div>
                                        <div class="news-content">
                                            <div class="post-meta">
                                                <span class="sub-news other">
                                                    <a href="#">
                                                        OTHERS
                                                    </a>
                                                </span>
                                            <img class="line-symbol"src="<?php echo e(asset('/frontend-asset/image/line-symbol.svg')); ?>" alt="">
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
                                            <img src="<?php echo e(asset('/frontend-asset/image/other.png')); ?>" alt=""
                                                class="img-responsive">
                                        </div>
                                        <div class="news-content">
                                            <div class="post-meta">
                                                <span class="sub-news other">
                                                    <a href="#">
                                                        OTHERS
                                                    </a>
                                                </span>
                                            <img class="line-symbol"src="<?php echo e(asset('/frontend-asset/image/line-symbol.svg')); ?>" alt="">
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
                                            <img src="<?php echo e(asset('/frontend-asset/image/other.png')); ?>" alt=""
                                                class="img-responsive">
                                        </div>
                                        <div class="news-content">
                                            <div class="post-meta">
                                                <span class="sub-news other">
                                                    <a href="#">
                                                        OTHERS
                                                    </a>
                                                </span>
                                            <img class="line-symbol"src="<?php echo e(asset('/frontend-asset/image/line-symbol.svg')); ?>" alt="">
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
                                            <img src="<?php echo e(asset('/frontend-asset/image/other.png')); ?>" alt=""
                                                class="img-responsive">
                                        </div>
                                        <div class="news-content">
                                            <div class="post-meta">
                                                <span class="sub-news other">
                                                    <a href="#">
                                                        OTHERS
                                                    </a>
                                                </span>
                                            <img class="line-symbol"src="<?php echo e(asset('/frontend-asset/image/line-symbol.svg')); ?>" alt="">
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
                                            <img src="<?php echo e(asset('/frontend-asset/image/other.png')); ?>" alt=""
                                                class="img-responsive">
                                        </div>
                                        <div class="news-content">
                                            <div class="post-meta">
                                                <span class="sub-news other">
                                                    <a href="#">
                                                        OTHERS
                                                    </a>
                                                </span>
                                            <img class="line-symbol"src="<?php echo e(asset('/frontend-asset/image/line-symbol.svg')); ?>" alt="">
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


<?php $__env->stopSection(); ?>


<?php $__env->startSection('js'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.front-end', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/deltaPSU/dependencies/resources/views/front-end/product-notice.blade.php ENDPATH**/ ?>