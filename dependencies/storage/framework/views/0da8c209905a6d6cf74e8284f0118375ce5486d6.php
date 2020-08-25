
<?php $__env->startSection('css'); ?>
<style>
    .text-editor b{
        font-weight:bold;
        color: #000000;
        font-size: 22px;
    }
</style>
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
                    <li class="breadcrumb-item active text-breadcrumb-home" aria-current="page"><a
                            href="#"><?php echo e($staticContent['Products']); ?></a></li>
                    <li class="breadcrumb-item active text-breadcrumb-home" aria-current="page"><a href="#"><?php echo e($staticContent['Configurable_Power']); ?></a></li>
                    <li class="breadcrumb-item active text-breadcrumb-ative" aria-current="page"><a
                            href="#"> <?php echo e($staticContent['Details']); ?></a></li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="padding-top-content-breadcrumb visible-up-922"></div>
<div class="box-configurable-detail mb-5">
    <div class="container">
        <h2 class="text-title-delta visible-up-922"><?php echo e($staticContent['Configurable_Power']); ?></h2>
        <h3 class="text-title-delta invisible-up-922"><?php echo e($staticContent['Configurable_Power']); ?></h3>
        
           <div class="text-editor mb-4"> 
               <?php echo $subCategories[0]->content1; ?>

           </div>

        <div class="row add-space-mobile">
            <div class="col-xl-4  col-md-12">
                <div class="d-flex mb-4">
                    <img class="img-fluid m-auto" src="<?php echo e(asset('frontend-asset/image/Configurable-Power.png')); ?>" alt="">
                </div>
                <div class="d-flex justify-content-center mb-4">
               
                    <a class="btn btn-enquiry mr-12px" href="<?php echo e(route('LinktoEnquiry',[$subCategories[0]->sub_pro_id , $subCategories[0]->name,'MEG-1K2A4' ])); ?>"><?php echo e($staticContent['Enquiry']); ?></a>
                <a class="btn btn-subscribe ml-12px" href="<?php echo e(route('producsList',[preg_replace('/\s+/', '-', 'Configurable Power'),7])); ?>"><?php echo e($staticContent['Product_lists']); ?></a>
                </div>
            </div>
            <div class="col-xl-8 col-md-12">
                 <div class="text-editor mb-4"> 
                    <?php echo $subCategories[0]->content2; ?>

                </div>
                <div class="row add-space-mobile">
                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <h5 class="text-color-delta"><?php echo e($staticContent['Safety_Certificates']); ?></h5>
                     
                        <div class="text-editor mb-4"> 
                            <?php echo $subCategories[0]->safety_cer; ?>

                        </div>
                        <h5 class="text-color-delta"><?php echo e($staticContent['Dimensions']); ?>(L x W x H)</h5>
                  
                        <div class="text-editor mb-4"> 
                            <?php echo $subCategories[0]->dimension; ?>

                        </div>
                        <h5 class="text-color-delta"><?php echo e($staticContent['Unit_Weight']); ?></h5>
                        <div class="text-editor mb-4"> 
                            <?php echo $subCategories[0]->unit_wight; ?>

                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <h5 class="text-color-delta"><?php echo e($staticContent['Highlights_Features']); ?></h5>
                        <div class="text-editor mb-4"> 
                            <?php echo $subCategories[0]->highlight; ?>

                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script>
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front-end', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/deltaPSU/dependencies/resources/views/front-end/Configure-detail.blade.php ENDPATH**/ ?>