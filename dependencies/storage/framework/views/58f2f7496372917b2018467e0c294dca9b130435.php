<?php $__env->startSection('css'); ?>
<style>
   .text-editor img{
    max-width: 100%;
   }
   .text-editor b{
    font-weight: bold;
   }
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('meta'); ?>
<title><?php echo e(isset($aboutus[0]->metaTitle)? $aboutus[0]->metaTitle :''); ?></title>
<meta name="description" content="<?php echo e(isset($aboutus[0]->metaDescription)? $aboutus[0]->metaDescription :''); ?>">
<meta name="keywords" content="<?php echo e(isset($aboutus[0]->metaKeyword) ? $aboutus[0]->metaKeyword :''); ?>">
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
                            href="#" data-toggle="dropdown" id="tools-dropdown"><?php echo e($staticContent['About']); ?></a>
                            <ul class="dropdown-menu">
                                <li><a href="#" id="tools-dropdown" class="text-bold"><?php echo e($staticContent['About']); ?></a></li>
                                <hr>
                                <?php $__currentLoopData = $navaboutus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $abt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><a href="<?php echo e(route('aboutUs',$abt->stug)); ?>"><?php echo e($abt->title); ?></a></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </ul>   
                    </li>
                    <li class="breadcrumb-item active text-breadcrumb" aria-current="page"><a href="#"><?php echo e($aboutus[0]->title); ?></a></li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="padding-top-content-breadcrumb visible-up-922"></div>
<div class="box-deltapsu mb-5">
    <div class="container">
    <h2 class="text-title-delta visible-up-922"><?php echo e($aboutus[0]->title); ?></h2>
        <h3 class="text-title-delta invisible-up-922"><?php echo e($aboutus[0]->title); ?></h3>
        <div class="text-editor">
            <?php echo $aboutus[0]->content  ?>
        </div>
       
       
        
    </div>
</div>


<?php $__env->stopSection(); ?>


<?php $__env->startSection('js'); ?>
<script>

    
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front-end', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Deltapsu_Production\dependencies\resources\views/front-end/about-us.blade.php ENDPATH**/ ?>