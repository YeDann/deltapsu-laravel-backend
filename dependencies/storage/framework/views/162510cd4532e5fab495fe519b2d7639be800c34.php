<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('/frontend-asset/css/vanilla-calendar-min.css')); ?>" >
<style>
@media (max-width: 992px){
    .resources-download {
        padding: 12px;
        margin: 0 -2rem;
    }
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
                    <li class="breadcrumb-item active text-breadcrumb" aria-current="page"><a href="#"><?php echo e($staticContent['Product_Cross_Reference']); ?></a></li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="padding-top-content-breadcrumb visible-up-922"></div>
<div class="box-events mb-5">
    <div class="container">
        <h2 class="text-title-delta visible-up-922"><?php echo e($staticContent['Product_Cross_Reference']); ?></h2>
        <h3 class="text-title-delta invisible-up-922"><?php echo e($staticContent['Product_Cross_Reference']); ?></h3>
        <p class="text-center mb-5" ><?php echo e($staticContent['Product_Cross_Reference_des']); ?></p>
        <div class="content-seles-kit">
            

            <?php $__currentLoopData = $product_docs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="resources-download ">
                <div class="detail-download ">
                <h5><?php echo e($item->name); ?></h5>
                    <p><?php echo e($staticContent['Uploaded_on']); ?> <?php echo e($item->date_info); ?></p>
                </div>
            <a href="<?php echo e(config('app.url')); ?>/medias/marketing_resources/<?php echo e($item->file); ?>" download=""><button class="btn-downlode "><?php echo e($staticContent['Downloads']); ?></button></a>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            
        </div>
    </div> 
</div>



<?php $__env->stopSection(); ?>


<?php $__env->startSection('js'); ?>

<script>

    
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.front-end', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Deltapsu_Production\dependencies\resources\views\front-end\product-cross-reference.blade.php ENDPATH**/ ?>