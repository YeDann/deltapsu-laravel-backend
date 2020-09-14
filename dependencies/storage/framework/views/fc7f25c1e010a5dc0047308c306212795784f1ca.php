<?php $__env->startSection('style'); ?>
 <style>
     .select2-container .select2-selection--single {
        height: 44px;
     }
     </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Language</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Language</li>
                    <li class="breadcrumb-item active" aria-current="page">Create</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- Content -->
<div class="content">
    <div class="block block-rounded block-bordered">
        <div class="block-header block-header-default">
            <h3 class="block-title">Create Language</h3>
        </div>
        <div class="block-content">
            <form action="<?php echo e(route('language.store')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo e(csrf_field()); ?>

                <!-- Basic Elements -->
                <div class="row push">
                    <div class="col-lg-4">
                        <p class="text-muted">
                            
                        </p>
                    </div>
                    <div class="col-lg-8 col-xl-5">
                        <div class="form-group">
                            <label for="example-select">Language</label>
                            
                            <select class="js-select2 form-control" id="example-select2" name="language" style="width: 100%;" data-placeholder="Please select language..">
                                    <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                    <?php $__currentLoopData = LaravelLocalization::getSupportedLocales(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $localeCode => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($localeCode); ?>|<?php echo e($item['name']); ?>" style="text-transform: capitalize;" ><?php echo e($item['name']); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success col-md-3" type="submit" >Create <i class="fa fa-plus"></i> </button>
                            <a href="<?php echo e(route('language.index')); ?>"  class="btn btn-secondary col-md-3">
                                Cancel <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Deltapsu_Production\dependencies\resources\views\language\create.blade.php ENDPATH**/ ?>