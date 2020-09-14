<?php $__env->startSection('style'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Create Product Field</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                   <li class="breadcrumb-item"> <a href="<?php echo e(route('product-field.index')); ?>">All Product Field</a></li>
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
            <h3 class="block-title">Product Field Information</h3>
        </div>
        <div class="block-content">
            <form action="<?php echo e(route('product-field.store')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo e(csrf_field()); ?>

                <!-- Basic Elements -->
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-xl-8">
                            <div class="form-group">
                                <?php $__currentLoopData = $language; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <input type="hidden" name="lang_loop[]" value="<?php echo e($item->name); ?>">
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="text" class="form-control col-md-6" name="title"
                                        value="">
                                </div>
                  
                            </div>
                        <div class="form-group">
                            <label for="">Section</label>
                            <select name="section" id="" class="form-control">
                                <?php $__currentLoopData = $section; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($item->section_id); ?>"><?php echo e($item->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="d-block">Type</label>
                            <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                <input type="radio" class="custom-control-input" id="status-line-1" name="type" value="text" checked onchange="selectnumber(1);">
                                <label class="custom-control-label" for="status-line-1">Text</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                <input type="radio" class="custom-control-input" id="status-line-2" name="type" value="number" onchange="selectnumber(0);">
                                <label class="custom-control-label" for="status-line-2">Number</label>
                            </div>
                        </div>
                        <div id="unitinput" class="form-group d-none">
                                <label for="example-select">Unit</label>
                                <input type="text" class="form-control <?php echo e($errors->has('unit') ? 'is-invalid' : ''); ?>" name="unit">
                            </div>
                            <div class="form-group">
                                    <label class="d-block">Show filter</label>
                                   

                                    <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                            <input type="radio" class="custom-control-input" id="status-1" name="status" value="1" >
                                            <label class="custom-control-label" for="status-1">Show</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                            <input type="radio" class="custom-control-input" id="status-2" name="status" value="0" checked>
                                            <label class="custom-control-label" for="status-2">Hide</label>
                                        </div>
                                   
                                </div>
                           
                        <div class="form-group pb-5">
                            <button class="btn btn-success" type="submit">Create </button>
                            <a href="<?php echo e(route('product-field.index')); ?>" class="btn btn-secondary">
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
<script>
      function selectnumber(id){
           if(id == 1){
            $('#unitinput').addClass('d-none');
           }else{
            $('#unitinput').removeClass('d-none');
           }
         
      }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Deltapsu_Production\dependencies\resources\views\product-field\create.blade.php ENDPATH**/ ?>