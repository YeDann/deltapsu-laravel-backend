
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
    .marketing-grid{
       display: flex;
       flex-wrap: wrap;
       justify-content: center;
    }
    .marketing-grid-list{
        border: 2px solid #E3EFF8;
        text-align: center;
        text-decoration: none;
        flex: 0 0 0 23%;
        width: 23%;
        padding: 12px;
        margin: 12px;
    }
    @media (max-width:992px){
        .marketing-grid-list{
        border: 2px solid #E3EFF8;
        text-align: center;
        text-decoration: none;
        flex: 0 0 0 33.30%;
        width: 33.3%;
        padding: 12px;
        margin: 12px;
        }
    }
    @media (max-width:500px){
        .marketing-grid-list{
        border: 2px solid #E3EFF8;
        text-align: center;
        text-decoration: none;
        flex: 0 0 100%;
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
                    
                    <li class="breadcrumb-item text-breadcrumb-home"><a href="<?php echo e(route('index','partners')); ?>"><?php echo e($staticContent['Partners']); ?></a></li>
                    <li class="breadcrumb-item active text-breadcrumb" aria-current="page"><a href="#"><?php echo e($staticContent['Marketing_Resources']); ?></a></li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="padding-top-content-breadcrumb visible-up-922"></div>
<section class="box-news pb-5">
    <h2 class="text-title-delta visible-tablets-up"><?php echo e($staticContent['Marketing_Resources']); ?></h2>
    <h3 class="text-title-delta visible-mobile"><?php echo e($staticContent['Marketing_Resources']); ?></h3>
    <div class="container">
        <div class="marketing-grid">
            <?php if(session('partner_role') == 1): ?>
            <a href="<?php echo e(route('marketingResourcesDownloads')); ?>" class="marketing-grid-list">
                <img src="<?php echo e(asset('frontend-asset/image/icon/icon-download.svg')); ?>" alt="">
                <h4 class=" text-dark"><?php echo e($staticContent['Marketing_Resources_Downloads']); ?></h4>
            </a>
            <?php endif; ?>
            <?php if(session('partner_role') == 2): ?>
            <a href="<?php echo e(route('marketingResourcesDownloads')); ?>" class="marketing-grid-list">
                <img src="<?php echo e(asset('frontend-asset/image/icon/icon-download.svg')); ?>" alt="">
                <h4 class=" text-dark"><?php echo e($staticContent['Marketing_Resources_Downloads']); ?></h4>
            </a>
            <a href="<?php echo e(route('productLaunchSchedule')); ?>" class="marketing-grid-list">
                <img src="<?php echo e(asset('frontend-asset/image/icon/icon-schedule.svg')); ?>" alt="">
                <h4 class=" text-dark"> <?php echo e($staticContent['Product_launch_Schedule']); ?></h4>
            </a>
            <a href="<?php echo e(route('successStories')); ?>" class="marketing-grid-list">
                <img src="<?php echo e(asset('frontend-asset/image/icon/icon-stories.svg')); ?>" alt="">
                <h4 class=" text-dark"><?php echo e($staticContent['Success_Stories']); ?></h4>
            </a>
            <a href="<?php echo e(route('saleKit')); ?>" class="marketing-grid-list">
                <img src="<?php echo e(asset('frontend-asset/image/icon/icon-kit.svg')); ?>" alt="">
                <h4 class=" text-dark"><?php echo e($staticContent['Sales_kit']); ?></h4>
            </a>
            <a href="<?php echo e(route('productCrossReference')); ?>" class="marketing-grid-list">
                <img src="<?php echo e(asset('frontend-asset/image/icon/icon-reference.svg')); ?>" alt="">
                <h4 class=" text-dark"><?php echo e($staticContent['Product_Cross_Reference']); ?></h4>
            </a>
            
            <a href="<?php echo e(route('confighistory')); ?>" class="marketing-grid-list">
                <img src="<?php echo e(asset('frontend-asset/image/icon/icon-config.svg')); ?>" alt="">
                <h4 class=" text-dark"><?php echo e($staticContent['Configurable_History']); ?></h4>
            </a>
            <?php endif; ?>
            <?php $__currentLoopData = $static_content; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               <?php if(session('partner_role') == 2): ?>
               <?php if($item->id  == 1): ?>
                <a href="<?php echo e(route('partnerinfo' ,[$item->id , preg_replace('/[^A-Za-z0-9\-]/', '-',$item->title)])); ?>" class="marketing-grid-list">
                <img src="<?php echo e(config('app.url')); ?>/medias/static_content/<?php echo e($item->icon); ?>" alt="">
                <h4 class=" text-dark"><?php echo e($item->title); ?></h4>
                </a>
                <?php endif; ?>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('js'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.front-end', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/deltaPSU/dependencies/resources/views/front-end/marketing-resources.blade.php ENDPATH**/ ?>