<?php $__env->startSection('style'); ?>
<link rel="stylesheet" href="<?php echo e(asset('backend-asset/js/plugins/summernote/summernote-bs4.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('backend-asset/js/plugins/simplemde/simplemde.min.css')); ?>">
<link rel="stylesheet"
    href="<?php echo e(asset('backend-asset/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')); ?>">

<style>
    #test-label {
        height: 100px !important;
    }

    .btn-outline-secondary {
        border-color: #dcdcdc!important;
    }

</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Meta tags</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(route('metaTags')); ?>">Meta tags</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- Content -->
<div class="content mb-5">
    <div class="block block-rounded block-bordered">
        <div class="block-header block-header-default">
            <h3 class="block-title">Create Meta tags</h3>
        </div>
        <div class="block-content mb-5">
            <form action="<?php echo e(route('store_metaTag')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo e(csrf_field()); ?>

     
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-xl-8">
                        <div class="form-group">
                            <label for="example-select">Page Name<span class="req-fed">*</span></label>
                            <input type="text" class="form-control"
                                name="page" placeholder="Enter Text." required>
                        </div>
               
               
                        <div class="form-group">
                            <label for="">Meta - Title</label>
                            <input type="text" class="form-control" name="metaTitle" value="">
                        </div>
                        <div class="form-group">
                            <label for="">Meta - Description</label>
                            <textarea name="metaDescription" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Meta - Keywords</label>
                            <textarea name="metaKeyword" class="form-control"></textarea>
                        </div>
                        
                        <div class="form-group text-center">
                            <button class="btn btn-success" type="submit">Create 
                            </button>
                            <a href="<?php echo e(route('metaTags')); ?>" class="btn btn-secondary">
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/Deltapsu_Production/dependencies/resources/views/metatag/create.blade.php ENDPATH**/ ?>