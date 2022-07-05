<?php $__env->startSection('css'); ?>
<style>

    .box-news-detail{
        border: 2px solid #E3EFF8;
        padding: 24px;
    }
    hr{
        border-top: 2px solid #E3EFF8;
    }
    /* html, body {
        margin: 0;
        padding: 0;
        font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
        font-size: 14px;
    } */

    #calendar {
        max-width: 900px;
        margin: 40px auto;
    }

    .gmap_canvas {
        overflow: hidden;
        background: none !important;
        height: 320px;
        width: 100%;
        margin-top: 24px;
    }
    .text-editor{
        font-family: Arial, Helvetica, sans-serif !important;
    }
    .text-editor iframe{
        max-width: 100% ;
    }
    .text-editor img{
        max-width: 100% ;
    }
    .text-editor span{
        font-family: Arial, Helvetica, sans-serif !important;
    }
    .text-editor label{
        font-family: Arial, Helvetica, sans-serif !important;
    }
    .text-editor p{
        font-family: Arial, Helvetica, sans-serif !important;
    }
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('meta'); ?>
<title><?php echo e(isset($contents[0]->title)? $contents[0]->title :''); ?></title>
<meta name="description" content="<?php echo iconv_substr(strip_tags(isset($contents[0]->content)? $contents[0]->content:''),0,90,'UTF-8'); ?>">
<meta name="keywords" content="<?php echo e(isset($contents[0]->title) ? $contents[0]->title :''); ?>">
<meta property="og:title" content="<?php echo e(isset($contents[0]->title)? $contents[0]->title :''); ?>" />
<meta property="og:description" content="<?php echo iconv_substr(strip_tags(isset($contents[0]->content)? $contents[0]->content:''),0,90,'UTF-8'); ?>" />
<meta property="og:image" content="<?php echo e(config('app.url')); ?>/uploads_delta/<?php echo e(isset($contents[0]->thumb) ? $contents[0]->thumb :''); ?>" />
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
                            href="#" data-toggle="dropdown" id="tools-dropdown"><?php echo e($staticContent['Updates']); ?></a>
                            <ul class="dropdown-menu">
                                <li><a href="#" id="tools-dropdown" class="text-bold"><?php echo e($staticContent['Updates']); ?></a></li>
                                <hr>
                                <li><a href="<?php echo e(route('index','news')); ?>"><?php echo e($staticContent['Product_News']); ?></a></li>
                                <li><a href="<?php echo e(route('index','events')); ?>"><?php echo e($staticContent['Events']); ?></a></li>
                                
                              </ul>   
                    </li>
                    <li class="breadcrumb-item active text-breadcrumb-home" aria-current="page"><a href="<?php echo e(route('index','events')); ?>"><?php echo e($staticContent['Events&Calendar']); ?></a></li>
                    <li class="breadcrumb-item active text-breadcrumb" aria-current="page"><a href="#"><?php echo e($staticContent['Event']); ?> <?php echo e($staticContent['Details']); ?></a></li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="padding-top-content-breadcrumb visible-up-922"></div>
<div class="box-events my-5 ">
    <div class="container">
       <div class="box-news-detail">
            <h2 class="text-dark">
                <?php echo e(isset($contents[0]->title)? $contents[0]->title:''); ?>

            </h2>
            <hr size="2">
            <?php
            function getDateformat($date){
                   
                   $eng_month_arr = array(
                       "0" => "",
                       "1" => "Jan",
                       "2" => "Feb",
                       "3" => "Mar",
                       "4" => "Apr",
                       "5" => "May",
                       "6" => "Jun",
                       "7" => "Jul",
                       "8" => "Aug",
                       "9" => "Sep",
                       "10" => "Oct",
                       "11" => "Nov",
                       "12" => "Dec"
                   );
                   $publicDate = date_create($date);
                   $pDate = explode("-", $publicDate->format('Y-n-d'));
                   $datearray = [
                       'm' =>  $eng_month_arr[$pDate[1]],
                       'd'=>  $pDate[2],
                       'y' => $pDate[0]

                   ];
                   return  $datearray;
            }
           
            
            ?>
            <div class="content row">
                <div class="col-lg-6 image-event  order-lg-1">
                        <img class="w-100" src="<?php echo e(config('app.url')); ?>/uploads_delta/<?php echo e(isset($contents[0]->thumb)?$contents[0]->thumb:''); ?>" alt="">
                        
                       
                </div>
                <div class="col-lg-6 text-event mt-2 order-1 order-lg-2">
                    <div class="media">
                        <img src="<?php echo e(asset('/frontend-asset/image/calendar-icon.svg')); ?>" class="mr-3" alt="...">
                        <div class="media-body">
                            <h5 class="mt-0 text-sixteen-delta">
                                <?php
                                       if($contents[0]->date_publish != null && $contents[0]->date_end != null ){
                                         $date = getDateformat($contents[0]->date_publish);
                                         $endDate = getDateformat($contents[0]->date_end);
                                           echo $date['m'].' '.$date['d'].' - '.($date['m']!=$endDate['m']?$endDate['m']:"").' '.(isset($endDate['d'])?''.$endDate['d']:'').' '.$date['y'];
                                       }else{
                                           echo '';
                                       }
                                    ?>
                              
                            </h5>
                        </div>
                    </div>
                    <div class="media">
                        <img src="<?php echo e(asset('/frontend-asset/image/location-icon.svg')); ?>" class="mr-3" alt="...">
                        <div class="media-body">
                        <h5 class="mt-0 text-sixteen-location"><?php echo e($contents[0]->location); ?></h5>
                        </div>
                    </div>
                    <div class="media">
                        <img src="<?php echo e(asset('/frontend-asset/image/clock-icon.svg')); ?>" class="mr-3" alt="...">
                        <div class="media-body">
                            <h5 class="mt-0 text-sixteen-delta"><?php echo e($contents[0]->time_start); ?> – <?php echo e($contents[0]->time_end); ?></h5>
                        </div>
                    </div>
                    <div class="text-editor">
                        <?php if(isset($contents[0]->content)): ?>
                        <?php echo $contents[0]->content; ?>

                        <?php endif; ?>
                    </div>
                    
                </div>
            </div>
        </div>
        <h3 class="text-center text-drak margin-title"><?php echo e($staticContent['Upcoming_Event']); ?></h3>
        <div class="row">
            <?php $__currentLoopData = $otherNews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-4 col-sm-6">
                <div class="card">
                    <a href="<?php echo e(route('updateEventDetail',$item->slug)); ?>">
                    <div class="post-image">
                        <img src="<?php echo e(config('app.url')); ?>/uploads_delta/<?php echo e($item->thumb); ?>" alt=""
                            class="img-responsive">
                    </div>
                    </a>
                    <div class="news-content">
                        <div class="post-meta">
                            <span class="author">
                                    <i class="zmdi zmdi-calendar-alt"></i> 
                                    <?php
                                    if($item->date_publish != null && $item->date_end != null ){
                                      $date1 = getDateformat($item->date_publish);
                                      $endDate2 = getDateformat($item->date_end);
                                        echo $date1['m'].' '.$date1['d'].' - '.($date1['m'] != $endDate2['m']?$endDate2['m']:"" ).' '.(isset($endDate2['d'])?''.$endDate2['d']:'').' '.$date1['y'];
                                    }else{
                                        echo '';
                                    }
                                 ?>
                             
                            </span>
                            <span class="locations ">
                                    <i class="zmdi zmdi-pin"></i> <?php echo e($item->location); ?>

                            </span>
                        </div>
                        <a href="<?php echo e(route('updateEventDetail',$item->slug)); ?>">
                        <h3 class="post-header title-new">
                            <?php echo e($item->title); ?>

                        </h3>
                        </a>
                        <p> <?php echo iconv_substr(strip_tags($item->content),0,90,'UTF-8'); ?> ...
                        </p>
                        
                    </div>
                <a href="<?php echo e(route('updateEventDetail',$item->slug)); ?> "class="read-more"><?php echo e($staticContent['Read_More']); ?></a>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
         
        </div>

    </div>
</div>



<?php $__env->stopSection(); ?>


<?php $__env->startSection('js'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.front-end', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/Deltapsu_Production/dependencies/resources/views/front-end/event-detail.blade.php ENDPATH**/ ?>