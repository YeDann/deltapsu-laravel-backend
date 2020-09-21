
<?php $__env->startSection('style'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Create Marketing Resource Categories</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <a href="<?php echo e(route('MarketResourceCategories.index')); ?>">Marketing Resource Categories</a></li>
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
            <form action="<?php echo e(route('MarketResourceCategories.store')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo e(csrf_field()); ?>

                <?php $__currentLoopData = $language; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <input type="hidden" name="lang_loop[]" value="<?php echo e($item->name); ?>" >
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <!-- Basic Elements -->
                <div class="row push">
                   
                    <div class="col-lg-12">
                        <div class="">
                            <div class="form-group">
                                <label for="example-select">Name  <span class="req-fed">*</span></label>
                                <input type="text"
                                    class="form-control"
                                    name="name" placeholder="Enter name..." required>
                            </div>
                            <div class="form-group">
                                <label class="d-block">Status</label>
                                <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                        <input type="radio" class="custom-control-input" id="status-1" name="status" value="1" checked >
                                        <label class="custom-control-label" for="status-1">Show</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                        <input type="radio" class="custom-control-input" id="status-2" name="status" value="0" >
                                        <label class="custom-control-label" for="status-2">Hide</label>
                                    </div>
                               
                            </div>
                            <div class="form-group">
                                <label class="d-block">Permission</label>
                            <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                <input type="checkbox" class="custom-control-input" id="status-role1" name="role[]" value="1"    >
                                <label class="custom-control-label" for="status-role1">Distributor</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                <input type="checkbox" class="custom-control-input" id="status-role2" name="role[]" value="2"   >
                                <label class="custom-control-label" for="status-role2">FES</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                <input type="checkbox" class="custom-control-input" id="status-role3" name="role[]" value="3"   >
                                <label class="custom-control-label" for="status-role3">End-User</label>
                            </div>
                            </div>
                            
                            </div>
                            <div class="text-center form-group">
                                <button class="btn btn-success" type="submit">Create </button>
                                <a href="<?php echo e(route('MarketResourceCategories.index')); ?>" class="btn btn-secondary">
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/deltaPSU/dependencies/resources/views/MarketResource/market_cate_create.blade.php ENDPATH**/ ?>