
<?php $__env->startSection('style'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Edit Product Launch Detail </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <a href="<?php echo e(route('launch_datail' ,$headId)); ?>">Edit Product Launch Detail</a></li>
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
            <h3 class="block-title">information</h3>
        </div>
        <div class="block-content">
            <form action="<?php echo e(route('update_launch_datail')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo e(csrf_field()); ?>

             
                <input type="hidden" name="headId" value="<?php echo e($headId); ?>" >
                <input type="hidden" name="pro_detail_id" value="<?php echo e($relate_pro_launch_schedule[0]->re_id); ?>" >
                
                <!-- Basic Elements -->
                <div class="row ">
                    <div class="col-lg-12">


                        <div class="block block-rounded block-bordered">
                            <ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs" role="tablist">
                                <?php $__currentLoopData = $language; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <input type="hidden" name="langloop[]" value="<?php echo e($item->name); ?>" >
                                <?php if($loop->iteration == 1): ?>
                                <li class="nav-item">
                                    <a class="nav-link active" href="#btabs-alt-static-<?php echo e($item->name); ?>"
                                        style="text-transform: capitalize;"><?php echo e($item->name); ?></a>
                                </li>
                                <?php else: ?>
                                <li class="nav-item">
                                    <a class="nav-link " href="#btabs-alt-static-<?php echo e($item->name); ?>"
                                        style="text-transform: capitalize;"><?php echo e($item->name); ?></a>
                                </li>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                            <div class="block-content tab-content">
                                <?php $__currentLoopData = $language; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php 
                                $current = null;
                                foreach($relate_pro_launch_schedule as $item2) { 
                                    if ($item->name == $item2->local) {
                                        $current = $item2;
                                        break;
                                    }
                                }
                              ?>
                            
                            <div class="tab-pane <?php echo e(($loop->iteration == 1)?"active":""); ?>" id="btabs-alt-static-<?php echo e($item->name); ?>" role="tabpanel">
                                <div class="">
                                    <div class="form-group">
                                        <label for="example-select">Model Name </label>
                                        <input type="text"
                                            class="form-control"
                                    name="modelname[<?php echo e($item->name); ?>]" placeholder="Enter text..." value="<?php echo e(isset($current->modelname)?$current->modelname:''); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-select">op_voltage </label>
                                        <input type="text"
                                            class="form-control"
                                            name="op_voltage[<?php echo e($item->name); ?>]" placeholder="Enter text..." value="<?php echo e(isset($current->op_voltage)?$current->op_voltage:''); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-select">op_wattage </label>
                                        <input type="text"
                                            class="form-control"
                                            name="op_wattage[<?php echo e($item->name); ?>]" placeholder="Enter text..." value="<?php echo e(isset($current->op_wattage)?$current->op_wattage:''); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-select">Phase </label>
                                        <input type="text"
                                            class="form-control"
                                            name="phase[<?php echo e($item->name); ?>]" placeholder="Enter text..." value="<?php echo e(isset($current->phase)?$current->phase:''); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-select">Remark </label>
                                        <input type="text"
                                            class="form-control"
                                            name="remark[<?php echo e($item->name); ?>]" placeholder="Enter text..." value="<?php echo e(isset($current->remark)?$current->remark:''); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-select"> Old File</label>
                                        <a href="<?php echo e(config('app.url')); ?>/medias/marketing_resources/<?php echo e(isset($current->file) ? $current->file :''); ?>"><?php echo e(isset($current->file) ? $current->file :''); ?></a>
                                    </div>
                                      <input type="hidden"  name="oldfile[<?php echo e($item->name); ?>]" value="<?php echo e(isset($current->file) ? $current->file :''); ?>">
                                    <div class="form-group">
                                        <label for="example-select">File <span class="req-fed">* Max File Size 20 MB</span></label>
                                        <div class="custom-file " style="width:100%;">
                                            <input type="file" class="custom-file-input" name="filepro[<?php echo e($item->name); ?>]"
                                                data-toggle="custom-file-input">
                                            <label class="custom-file-label" for="fileImage">Choose file</label>
                                        </div>
                                    </div>
                                    </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                     
                            <div class="text-center form-group">
                                <button class="btn btn-info" type="submit">Update </button>
                                <a href="<?php echo e(route('launch_datail' ,$headId)); ?>" class="btn btn-secondary">
                                    Cancel
                                </a>
                            </div>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/deltaPSU/dependencies/resources/views/partners/product_launch_detail_edit.blade.php ENDPATH**/ ?>