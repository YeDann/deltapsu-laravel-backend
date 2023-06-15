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
                    <li class="breadcrumb-item active text-breadcrumb-home dropdown" aria-current="page"><a
                            href="#" data-toggle="dropdown" id="tools-dropdown"><?php echo e($staticContent['Supports']); ?></a>
                            <ul class="dropdown-menu">
                                <li><a href="#" id="tools-dropdown" class="text-bold"><?php echo e($staticContent['Supports']); ?></a></li>
                                <hr>
                                <li><a href="<?php echo e(route('contactSupport')); ?>"><?php echo e($staticContent['contact_us']); ?></a></li>
                                <li><a href="<?php echo e(route('contactSalesOffices')); ?>"><?php echo e($staticContent['sales_offices']); ?></a></li>
                                <li><a href="<?php echo e(route('contactFindDistributor')); ?>"><?php echo e($staticContent['find_a_distributor']); ?></a></li>
                                <li><a href="<?php echo e(route('index','faqs')); ?>"><?php echo e($staticContent['FAQs']); ?></a></li>
                              </ul>   
                    </li>
                    <li class="breadcrumb-item active text-breadcrumb" aria-current="page"><a href="#"><?php echo e($staticContent['sales_offices']); ?></a></li>

                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="padding-top-content-breadcrumb visible-up-922"></div>
<div class="box-sales-offices pb-5">
    <div class="container">
        <h2 class="text-title-delta visible-tablets-up"><?php echo e($staticContent['sales_offices']); ?></h2>
        <h3 class="text-title-delta visible-mobile"><?php echo e($staticContent['sales_offices']); ?></h3>
        <div id="sales-offices" class="sales-offices-type">
            <?php $__currentLoopData = $continents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="box-for-collap">
            <div class="sales-offices-list collapsed  hide-box text-colour-delta" data-toggle="collapse" data-parent="#sales-offices-type"
                        href="#collapse-ofictab<?php echo e($item->id); ?>" >    
                 <h5><?php echo e($item->name); ?></h5>
                </div>
                <div id="collapse-ofictab<?php echo e($item->id); ?>" class="sales-offices-list-sub collapse" data-parent="#sales-offices-type">
                        <div class="force-overflow">
                            <?php $__currentLoopData = $offices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $office): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($office->continent_id == $item->id ): ?>
                            <div class="sales-offices-address">
                                <p class="text-sixteen-dark mr-b-1">
                                   <?php echo e($office->title); ?>

                                <br><?php echo e($office->sub_title); ?></p>
                            <div class="text-editor">
                                <?php echo $office->content; ?>

                             </div>
                            <a href="https://www.google.com/maps/?q=<?php echo e($office->lat); ?>,<?php echo e($office->lon); ?>&sensor=true" target="_blank"><button class="btn-subscribe" ><?php echo e($staticContent['Get Direction']); ?></button></a>
                            </div>
                            <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                </div>
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
<?php echo $__env->make('layouts.front-end', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/Deltapsu_Production/dependencies/resources/views/front-end/sales-offices.blade.php ENDPATH**/ ?>