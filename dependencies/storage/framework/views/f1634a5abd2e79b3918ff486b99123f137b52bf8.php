
<?php $__env->startSection('css'); ?>
<style>
    .res-img{
        max-width: 100%;
        height: auto;
    }
    .mg-50{
       padding-top: 100px;
       margin-bottom: 50px;
    }
    .btn-page-eror {
    font-family: 'ArialUnicodeMS';
    font-size: 14px;
    color: #ffffff !important;
    font-weight: bold;
    background-color: #0087DC;
    height: 40px;
    min-width: 180px;
    border: 2px solid transparent;
    border-radius: 5px;
    letter-spacing: 1px;
}
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('container'); ?>
<div class="padding-top-content">
</div>

<div class="container">
<div class="row">
<div class="col-lg-12">
 <div class="text-center mg-50">
      <img class="res-img mb-2" src="<?php echo e(asset('/frontend-asset/image/404imag.svg')); ?>">
      <h1>Sorry, page not found</h1>
      <a href="<?php echo e(route('index','home')); ?>" class="btn btn-page-eror mt-5">Go back to Homepage</a>
 </div>
</div>
</div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script>

    
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front-end', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/deltaPSU/dependencies/resources/views/errors/404.blade.php ENDPATH**/ ?>