<?php $__env->startSection('style'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2"> Edit Product Field</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(route('product-field.index')); ?>">All Product Field</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
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
        <div class="row p-3 justify-content-center">
        <div class="col-md-8">
            <form action="<?php echo e(route('productfieldUpdate')); ?>" method="post" enctype="multipart/form-data">
                <?php echo e(csrf_field()); ?>

                <input type="hidden" name="product_field_id" value="<?php echo e($pd_field[0]->product_field_id); ?>">
                <div class="block block-rounded block-bordered col-md-12">
                    <ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs" role="tablist">
                        <?php $__currentLoopData = $pd_field; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        
                        <?php if($loop->iteration == 1): ?>
                        <li class="nav-item">
                            <a class="nav-link active" href="#btabs-alt-static-<?php echo e($item->local); ?>"
                                style="text-transform: capitalize;"><?php echo e($item->local); ?></a>
                        </li>
                        <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link " href="#btabs-alt-static-<?php echo e($item->local); ?>"
                                style="text-transform: capitalize;"><?php echo e($item->local); ?></a>
                        </li>
                        <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                    <div class="block-content tab-content">
                        <?php $__currentLoopData = $pd_field; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <input type="hidden" name="section_loop" value="<?php echo e($item->local); ?>">
                        <?php if($loop->iteration == 1): ?>
                        <div class="tab-pane active" id="btabs-alt-static-<?php echo e($item->local); ?>" role="tabpanel">
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" class="form-control col-md-6" name="title_<?php echo e($item->local); ?>"
                                    value="<?php echo e($item->field_name); ?>">
                            </div>
                        </div>
                        <?php else: ?>
                        <div class="tab-pane" id="btabs-alt-static-<?php echo e($item->local); ?>" role="tabpanel">
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" class="form-control col-md-6" name="title_<?php echo e($item->local); ?>"
                                    value="<?php echo e($item->field_name); ?>">
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <div class="form-group">
                        <label for="">Section</label>
                        <select name="section" id="" class="form-control">
                            <?php $__currentLoopData = $section; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($pd_field[0]->section_id == $sec->section_id): ?>
                            <option value="<?php echo e($sec->section_id); ?>" selected><?php echo e($sec->name); ?></option>
                            <?php else: ?>
                            <option value="<?php echo e($sec->section_id); ?>"><?php echo e($sec->name); ?></option>
                            <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="d-block">Type</label>
                        <?php if($item->type == "text"): ?>
                        <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                            <input type="radio" class="custom-control-input" id="status-line-1" name="type" value="text" checked onchange="selectnumber(1);">
                            <label class="custom-control-label" for="status-line-1">Text</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                            <input type="radio" class="custom-control-input" id="status-line-2" name="type" value="number" onchange="selectnumber(0);">
                            <label class="custom-control-label" for="status-line-2">Number</label>
                        </div>
                        <?php elseif($item->type == "number"): ?>
                        <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                            <input type="radio" class="custom-control-input" id="status-line-1" name="type" value="text" onchange="selectnumber(1);">
                            <label class="custom-control-label" for="status-line-1">Text</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                            <input type="radio" class="custom-control-input" id="status-line-2" name="type" value="number" checked onchange="selectnumber(0);">
                            <label class="custom-control-label" for="status-line-2">Number</label>
                        </div>
                        <?php endif; ?>
                    </div>
                    <?php if($pd_field[0]->unit_name != null): ?>
                    <div id="unitinput" class="form-group">
                        <label for="example-select">Unit</label>
                        <input type="text" class="form-control <?php echo e($errors->has('unit') ? 'is-invalid' : ''); ?>" name="unit" value="<?php echo e($pd_field[0]->unit_name); ?>">
                    </div>
                    <?php endif; ?>
                    <div class="form-group">
                            <label class="d-block">Show filter</label>
                           
                              
                            <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                    <input type="radio" class="custom-control-input" id="status-1" name="status" value="1" <?php echo e(($pd_field[0]->status == 1 ) ? 'checked' : ''); ?>>
                                    <label class="custom-control-label" for="status-1">Show</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                    <input type="radio" class="custom-control-input" id="status-2" name="status" value="0" <?php echo e(($pd_field[0]->status == 0 ) ? 'checked' : ''); ?>>
                                    <label class="custom-control-label" for="status-2">Hide</label>
                                </div>
                           
                        </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success text-uppercase">Update 
                        </button>
                        <a href="<?php echo e(route('product-field.index')); ?>" class="btn btn-secondary text-uppercase">Cancel
                        </a>
                    </div>
        </div>
    
        </form>
    </div>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Deltapsu_Production\dependencies\resources\views\product-field\edit.blade.php ENDPATH**/ ?>