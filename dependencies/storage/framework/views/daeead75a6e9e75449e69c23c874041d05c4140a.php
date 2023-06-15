<?php $__env->startSection('css'); ?>
<style>

    
    hr{
        border-top: 2px solid #E3EFF8;
    }
    .content img{
        max-width: 100%;
    }
    .content b{
      font-weight: bold;
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
                    <li class="breadcrumb-item active text-breadcrumb-home" aria-current="page"><a href="<?php echo e(route('index','news')); ?>"><?php echo e($staticContent['Product_News']); ?></a></li>
                    <li class="breadcrumb-item active text-breadcrumb" aria-current="page"><a href="#"><?php echo e(isset($contents[0]->title)? $contents[0]->title:''); ?></a></li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="padding-top-content-breadcrumb visible-up-922"></div>
<section class="box-news  my-5 ">
    <div class="container">
        <div class="box-news-detail">
            <h2 class="text-dark">
                <?php echo e(isset($contents[0]->title)? $contents[0]->title:''); ?>

              
            </h2>
            <hr size="2">
            <div class="post-meta">
            <span class="sub-news new" style="color:<?php echo e(isset($contents[0]->color_type)? $contents[0]->color_type:''); ?>">
               
                        <?php echo e(isset($contents[0]->cateName)? $contents[0]->cateName:''); ?>

                   
                </span>
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
                 
                     <img class="line-symbol "src="<?php echo e(asset('/frontend-asset/image/line-symbol.svg')); ?>" alt="">
                    <span class="date">
                  
                            <?php
                            if(isset($contents[0]->date_info)){
                              $datenew = getDateformat($contents[0]->date_info);
                              echo $datenew['m'].' '.$datenew['d'] .' '.$datenew['y'];
                            }else{
                                echo '';
                            }

                            ?>
                     
                        </span>
            </div>
            <div class="content">
                <?php if(isset($contents[0]->content)): ?>
                 
                 <?php echo str_replace("/uploads_delta",config('app.url')."/uploads_delta",$contents[0]->content); ?>

                <?php endif; ?>      
            </div>
             <div class="">
            <?php if(isset($contents[0]->file) &&  $contents[0]->file != ''): ?>
             <a target="_blank" href="<?php echo e(config('app.url')); ?>/uploads_delta/<?php echo e($contents[0]->file); ?>">
                  <button class="btn btn-subscribe">Download PDF</button>
                </a>
                <?php endif; ?>
             </div>
            
        </div>
        <?php if(count($otherNews) > 0): ?>
        <h3 class="text-center text-drak margin-title"> <?php echo e($staticContent['Related_News']); ?></h3>
        <?php endif; ?>
        <div class="row">
            <?php $__currentLoopData = $otherNews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-4 col-sm-6">
                <div class="card">
                    <a href="<?php echo e(route('updateNewsDetail',['name'=> $item->slug])); ?>">
                    <div class="post-image">
                        <img src="<?php echo e(config('app.url')); ?>/uploads_delta/<?php echo e($item->thumb); ?>" alt=""
                            class="img-responsive">
                    </div>
                   </a>
                    <div class="news-content">
                        
                        <div class="post-meta">
                            <a href="<?php echo e(route('updateNewsDetail',['name'=> $item->slug])); ?>" >
                            <span class="sub-news" style="color:<?php echo e($item->color_type); ?>">
                                    <?php echo e($item->cateName); ?>

                            </span>
                            </a>
                        <img class="line-symbol"src="<?php echo e(asset('/frontend-asset/image/line-symbol.svg')); ?>" alt="">
                            <span class="date text-uppercase">
                                     <?php
                                     if(isset($item->date_info)){
                                       $datenew2 = getDateformat($item->date_info);
                                       echo $datenew2['m'].' '.$datenew2['d'] .' '.$datenew2['y'];
                                     }else{
                                         echo '';
                                     }
         
                                     ?>
                            </span>
                        </div>
                        <h4 class="post-header title-new">
                            <a href="<?php echo e(route('updateNewsDetail',['name'=> $item->slug])); ?>">
                            <?php echo e($item->title); ?>

                            </a>
                        </h4>
                        <p><?php echo iconv_substr(strip_tags($item->content),0,90,'UTF-8'); ?> ...
                        </p>
                        
                    </div>
                    
                <a href="<?php echo e(route('updateNewsDetail',['name'=> $item->slug])); ?>" class="read-more"><?php echo e($staticContent['Read_More']); ?></a>
                </div>
              </div>  
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>



<?php $__env->stopSection(); ?>


<?php $__env->startSection('js'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.front-end', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/Deltapsu_Production/dependencies/resources/views/front-end/news-detail.blade.php ENDPATH**/ ?>