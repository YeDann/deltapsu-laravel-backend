
<?php $__env->startSection('style'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Create <?php echo e($type_name); ?></h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"> <a href="<?php echo e(route('partner_doc_index' ,[$type_id ,$type_name])); ?>"><?php echo e($type_name); ?></a></li>
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
            <form action="<?php echo e(route('storeSaleKit')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo e(csrf_field()); ?>

                <div class="row">
                    <input type="hidden" name="typeId" id="typeId" value="<?php echo e($type_id); ?>">
                    <input type="hidden" name="typeName" id="typeName" value="<?php echo e($type_name); ?>">
                    <?php $__currentLoopData = $language; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <input type="hidden" name="langloop[]" value="<?php echo e($item->name); ?>">
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg-12">
                        <div class="form-group">
                        <label for="example-select"><span class="req-fed">*</span>Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter Text..." required>
                        </div>
                        <div class="form-group">
                            <label for="example-select">File <span class="req-fed">* Max File Size 20 MB</span></label>
                            <div class="custom-file " style="width:100%;">
                                <input type="file" class="custom-file-input" name="filesale"
                                    data-toggle="custom-file-input">
                                <label class="custom-file-label" for="fileImage">Choose file</label>
                            </div>
                        </div>
                            <label for="example-text-input"><span class="req-fed">*</span>Public Date</label>
                            <input type="text" class="js-datepicker form-control <?php echo e($errors->has('date') ? 'is-invalid' : ''); ?>"  data-week-start="1" data-autoclose="true"
                                data-today-highlight="true" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" name="date" required>
                    </div>
                    <div class="col-lg-12">
                        <div class="text-center form-group mt-4">
                            <button class="btn btn-update" type="submit">Create </button>
                            <a href="<?php echo e(route('partner_doc_index' ,[$type_id ,$type_name])); ?>" class="btn btn-secondary">
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/deltaPSU/dependencies/resources/views/partners/sale_kits_create.blade.php ENDPATH**/ ?>