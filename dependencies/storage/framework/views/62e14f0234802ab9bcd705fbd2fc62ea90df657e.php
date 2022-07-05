<?php $__env->startSection('css'); ?>
<style>

    .tab-content>.active {
        justify-content: unset !important;
        
        display: block;
    }
    .tab-content{
        margin-top: 24px;
    }
    .search-space{
        margin-bottom: 24px;
    }
    .nav-tabs .nav-link {
        margin: -2px 32px;
    }
    .partners-grid{
        display: flex;
       flex-wrap: wrap;
       justify-content: center;
    }
    .partners-grid-list{
        border: 2px solid #E3EFF8;
        text-align: center;
        text-decoration: none;
        flex: 0 0 0 31.2%;
        width: 31.2%;
        padding: 12px;
        margin: 12px;
        
    }

    @media (max-width:992px){
     .partners-grid-list{
        border: 2px solid #E3EFF8;
        text-align: center;
        text-decoration: none;
        flex: 0 0 0 45%;
        width: 45%;
    }
    }
    @media (max-width:500px){
    .partners-grid-list{
        border: 2px solid #E3EFF8;
        text-align: center;
        text-decoration: none;
        flex: 0 0 0 100%;
        width: 100%;
        padding: 12px;
        margin: 12px;
    }

    }
    a:hover {
        text-decoration: unset;
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
                    
                    <li class="breadcrumb-item active text-breadcrumb" aria-current="page"><a href="#"><?php echo e($staticContent['Partners']); ?></a></li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="padding-top-content-breadcrumb visible-up-922"></div>
<section class="box-news pb-5">
    <h2 class="text-title-delta visible-tablets-up"><?php echo e($staticContent['Partners']); ?></h2>
    <h3 class="text-title-delta visible-mobile"><?php echo e($staticContent['Partners']); ?></h3>
    <div class="container">
        <div class="partners-grid">
            <a href="<?php echo e(route('marketingResources')); ?>" class="partners-grid-list">
                <img src="<?php echo e(asset('frontend-asset/image/icon/icon-download-p.svg')); ?>" alt="">
                <h4 class=" text-dark"> <?php echo e($staticContent['Marketing_Resources']); ?></h4>
            </a>
            <a href="<?php echo e(route('productDocLogin')); ?>" class="partners-grid-list">
                <img src="<?php echo e(asset('frontend-asset/image/icon/icon-product-doc.svg')); ?>" alt="">
                <h4 class=" text-dark"><?php echo e($staticContent['Product_Documents']); ?></h4>
            </a>
            
        </div>
        
    </div>
</section>


<?php $__env->stopSection(); ?>


<?php $__env->startSection('js'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.front-end', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/Deltapsu_Production/dependencies/resources/views/front-end/partners.blade.php ENDPATH**/ ?>