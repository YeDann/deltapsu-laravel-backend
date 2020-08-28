<?php $__env->startSection('style'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Edit Main Categories</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <a href="<?php echo e(route('mainprotype.index')); ?>">All Main Categories</a></li>
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
            <h3 class="block-title">Main Categories</h3>
        </div>
        <div class="block-content">
            <form action="<?php echo e(route('updatemainpro')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo e(csrf_field()); ?>

                <!-- Basic Elements -->
                <div class="row push">
                    <div class="col-lg-4">
                        <p class="text-muted">
                            
                        </p>
                    </div>
                    <div class="col-lg-8 col-xl-5">
                        <div class="block block-rounded block-bordered">
                            <ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs" role="tablist">
                                <?php $__currentLoopData = $mainCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                               <input type="hidden" name="mainId" value="<?php echo e($mainId); ?>" > 
                                <?php $__currentLoopData = $mainCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <input type="hidden" name="lang_loop[]" value="<?php echo e($item->local); ?>">
                                <?php if($loop->iteration == 1): ?>
                                <div class="tab-pane active" id="btabs-alt-static-<?php echo e($item->local); ?>" role="tabpanel">
                                    <div class="form-group">
                                        <label for="example-select">Name</label>
                                        <input type="text"
                                            class="form-control <?php echo e($errors->has('name') ? 'is-invalid' : ''); ?>"
                                            name="name[<?php echo e($item->local); ?>]" value="<?php echo e($item->name); ?>" placeholder="Enter name...">
                                    </div>
                                </div>
                                <?php else: ?>
                                <div class="tab-pane" id="btabs-alt-static-<?php echo e($item->local); ?>" role="tabpanel">
                                    <div class="form-group">
                                        <label for="example-select">Name</label>
                                        <input type="text"
                                            class="form-control <?php echo e($errors->has('name') ? 'is-invalid' : ''); ?>"
                                            name="name[<?php echo e($item->local); ?>]" value="<?php echo e($item->name); ?>" placeholder="Enter name...">
                                    </div>
                                </div>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>

                            <div class="text-center form-group">
                                <button class="btn btn-info" type="submit">Update </button>
                                <a href="<?php echo e(route('mainprotype.index')); ?>" class="btn btn-secondary">
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Deltapsu_Production\dependencies\resources\views\pro_categories\main_edit.blade.php ENDPATH**/ ?>