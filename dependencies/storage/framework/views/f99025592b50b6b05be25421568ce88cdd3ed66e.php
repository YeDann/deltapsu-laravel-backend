<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('/frontend-asset/css/vanilla-calendar-min.css')); ?>" >
<style>
@media (max-width: 992px){
    .resources-download {
        padding: 12px;
        margin: 0 -2rem;
    }
}
.bg-back{
    background-color: #444444;
    color:#fff;
    font-weight: bold;
     border: 1px solid  #E3EFF8;
    font-size: 14px;
   
}
.bg-bule{
    background-color: #F0F5FA;
    color:#444444;
    font-weight: 400;
    border: 1px solid  #E3EFF8;
    font-size: 14px;
   
}
.bg-bule.active{
    color:#76B900;
    font-weight: bold;
}
.bg-bule.no-active{
    color:#F08200;
    font-weight: bold;
    
}


</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('meta'); ?>
<title><?php echo e(isset($metatag[0]->meta_title)? $metatag[0]->meta_title :''); ?></title>
<meta name="description" content="<?php echo e(isset($metatag[0]->meta_description)? $metatag[0]->meta_description :''); ?>">
<meta name="keywords" content="<?php echo e(isset($metatag[0]->meta_key) ? $metatag[0]->meta_key :''); ?>">
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
                    <li class="breadcrumb-item active text-breadcrumb-home" aria-current="page"><a href="#"> <?php echo e($staticContent['Partners']); ?></a></li>
                    <li class="breadcrumb-item active text-breadcrumb-home" aria-current="page"><a href="<?php echo e(route('marketingResources')); ?>"><?php echo e($staticContent['Marketing_Resources']); ?></a></li>
                    <li class="breadcrumb-item active text-breadcrumb" aria-current="page"><a href="#"><?php echo e($staticContent['Configurable_History']); ?></a></li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="padding-top-content-breadcrumb visible-up-922"></div>
<div class="box-events mb-5">
    <div class="container">
        <h2 class="text-title-delta visible-up-922"><?php echo e($staticContent['Configurable_History']); ?> </h2>
        <h3 class="text-title-delta invisible-up-922"><?php echo e($staticContent['Configurable_History']); ?> </h3>
        <?php $__currentLoopData = $con_his; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="row mb-4 m-0 moreBox"  style="display: none;">
            <div class="col-md-3 p-0 bg-back"> 
                    <div class="p-2">Enquiry Date</div>
            </div>
            <div class="col-md-3 p-0 bg-bule"> 
                <div class="p-2"><?php echo e($item->created_at); ?></div>
            </div>
            <div class="col-md-3 p-0  bg-back"> 
                <div class="p-2"> Country</div>
            </div>
            <div class="col-md-3 p-0 bg-bule"> 
                <div class="p-2"><?php echo e(isset($item->country)?$item->country:'-'); ?></div>
            </div>
            <div class="col-md-3 p-0 bg-back"> 
                <div class="p-2">
                    Factory Model Name
                </div>
            </div>
            <div class="col-md-3 p-0 bg-bule"> 
                <div class="p-2">
                    <?php echo e(isset($item->factory_model)?$item->factory_model:'-'); ?>

                </div>
            </div>
            <div class="col-md-3 p-0 bg-back"> 
                <div class="p-2">
                    Email
                </div>
            </div>
            <div class="col-md-3 p-0 bg-bule"> 
                <div class="p-2">
                    <?php echo e(isset($item->email)?$item->email:'-'); ?>

                </div>
            </div>
            <div class="col-md-3 p-0 bg-back"> 
                <div class="p-2">
                    Customer Model Name
                </div>
            </div>
            <div class="col-md-3 p-0 bg-bule"> 
                <div class="p-2">
                    <?php echo e($item->customer_model); ?>

                </div>
            </div>
            <div class="col-md-3 p-0 bg-back"> 
                <div class="p-2">
                    Enquiry Status
                </div>
            </div>
            <div class="col-md-3 p-0 bg-bule  <?php echo e($item->type_his == 0?'no-active':'active'); ?>"> 
                <div class="p-2">
                    <?php echo e($item->type_his == 0?'NO':''); ?>

                    <?php echo e($item->type_his == 3?'Send PDF':''); ?>

                    <?php echo e($item->type_his == 1?'YES':''); ?>

                </div>
            </div>
            <div class="col-md-3 p-0 bg-back"> 
                <div class="p-2">
                    Message
                </div>
            </div>
            <div class="col-md-3 p-0 bg-bule"> 
                <div class="p-2">
                    <?php echo e(isset($item->Message)?$item->Message:'-'); ?>

                </div>
            </div>
            <div class="col-md-3 p-0 bg-back"> 
                <div class="p-2">
                    Configurable Detail
                </div>
            </div>
            <div class="col-md-3 p-0 bg-bule"> 
                <div class="p-2">
                <a href="<?php echo e(config('app.url')); ?>/config_history/<?php echo e($item->file); ?>" target="_blank">
                    <button class="btn-downlode ">View</button>
                </a>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
           <div class="row">
               <div class="col-lg-12 text-center">
                <div id="loadMore" class="btn btn-boxen" onclick="loadeMore(event,4)"><?php echo e($staticContent['See_More']); ?></div>
                   </div> 
           </div>
            
            
      
    </div> 
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script>
     $( document ).ready(function() {
        $(".moreBox").slice(0, 8).show();
    });
    function loadeMore(event,i){
    if ($(".moreBox:hidden").length != 0) {
      $("#loadMore").show();
    }  
      event.preventDefault();
     
      $(".moreBox:hidden").slice(0, 4).slideDown();
      if ($(".moreBox:hidden").length == 0) {
        $("#loadMore").fadeOut('hide');
      }
  }
    
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.front-end', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Deltapsu_Production\dependencies\resources\views\front-end\config-history.blade.php ENDPATH**/ ?>