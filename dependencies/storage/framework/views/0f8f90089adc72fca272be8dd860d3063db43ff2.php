<?php $__env->startSection('css'); ?>
<style>
  .sub-intext > li{
    list-style: none
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
<div class="box-privacy mb-5">
    <h2 class="text-title-delta visible-tablets-up"> <?php echo $static_content->title; ?></h2>
    <h3 class="text-title-delta visible-mobile"> <?php echo $static_content->title; ?></h3>
    <div class="container">
         <?php echo $static_content->content; ?>

        
    
    </div>
</div>


<?php $__env->stopSection(); ?>


<?php $__env->startSection('js'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front-end', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/Deltapsu_Production/dependencies/resources/views/front-end/terms-of-use.blade.php ENDPATH**/ ?>