<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('/frontend-asset/css/vanilla-calendar-min.css')); ?>" >
<style>
@media (max-width: 992px){
    .resources-download {
        padding: 12px;
        margin: 0 -2rem;
    }
}
.text-editor img{
    max-width: 100% !important;
}
.text-editor iframe{
    max-width: 100% !important;
}
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('meta'); ?>
<title><?php echo e($static_content[0]->title); ?></title>
<meta name="description" content="<?php echo e($static_content[0]->title); ?>">
<meta name="keywords" content="<?php echo e($static_content[0]->title); ?>">
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
                    <li class="breadcrumb-item active text-breadcrumb" aria-current="page"><a href="#"><?php echo e($static_content[0]->title); ?></a></li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="padding-top-content-breadcrumb visible-up-922"></div>
<div class="box-events mb-5">
    <div class="container">
        <h2 class="text-title-delta visible-up-922"><?php echo e($static_content[0]->title); ?></h2>
        <h3 class="text-title-delta invisible-up-922"><?php echo e($static_content[0]->title); ?></h3>
        
        <div class="d-flex justify-content-center">
         
            <div class="text-editor"> 
                <?php echo $static_content[0]->content; ?>

            </div>

        </div>
        
    </div> 
</div>



<?php $__env->stopSection(); ?>


<?php $__env->startSection('js'); ?>

<script>

    
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.front-end', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/Deltapsu_Production/dependencies/resources/views/front-end/video-guideline.blade.php ENDPATH**/ ?>