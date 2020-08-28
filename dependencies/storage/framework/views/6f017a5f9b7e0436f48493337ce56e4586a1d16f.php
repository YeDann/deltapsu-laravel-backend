<?php $__env->startSection('style'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Create Product Launch Schedule</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <a href="<?php echo e(route('pro_lauch')); ?>">Product Launch Schedules</a></li>
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
            <h3 class="block-title">Information</h3>
        </div>
        <div class="block-content">
            <form action="<?php echo e(route('pro_lauch_store')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo e(csrf_field()); ?>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                        <label for="example-select"><span class="req-fed">*</span>Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Enter name..." required>
                        </div>
                      
                            <label for="example-text-input"><span class="req-fed">*</span>Date</label>
                            <input type="text" class="js-datepicker form-control <?php echo e($errors->has('date') ? 'is-invalid' : ''); ?>"  data-week-start="1" data-autoclose="true"
                                data-today-highlight="true" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" name="date" required>
                    </div>
                    <div class="col-lg-12">
                        <div class="text-center form-group mt-4">
                            <button class="btn btn-success" type="submit">Create </button>
                            <a href="<?php echo e(route('pro_lauch')); ?>" class="btn btn-secondary">
                                Cancel
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Deltapsu_Production\dependencies\resources\views\partners\pro_launch_create.blade.php ENDPATH**/ ?>