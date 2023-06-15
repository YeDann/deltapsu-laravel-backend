<?php $__env->startSection('style'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Edit Filter Section</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <a href="<?php echo e(route('default_filer')); ?>" >Edit Filter Section</a></li>
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
            <h3 class="block-title">Edit Filter Section</h3>
        </div>
        <div class="block-content">
            <form action="<?php echo e(route('updateFilterSection')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo e(csrf_field()); ?>

                <!-- Basic Elements -->
                <input type="hidden" name="Filter_id" value="<?php echo e($arrLang_datas[0]->field_id); ?>">
                <div class="row justify-content-center ">
                    <div class="block block-rounded block-bordered col-md-8">
                        <ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs" role="tablist">
                            <?php $__currentLoopData = $arrLang_datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                            <?php $__currentLoopData = $arrLang_datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <input type="hidden" name="lang_loop[]" value="<?php echo e($item->local); ?>" >
                         <div class="tab-pane <?php echo e(($loop->iteration == 1)?'active':''); ?>" id="btabs-alt-static-<?php echo e($item->local); ?>" role="tabpanel">
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="text" class="form-control" name="name[<?php echo e($item->local); ?>]"
                                        value="<?php echo e(isset($item->title) ? $item->title :''); ?>">
                                </div>
                            
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div class="block-content tab-content">
                            <button type="submit" class="btn btn-success text-uppercase mb-4">Update 
                            </button>
                            <a href="<?php echo e(route('default_filer')); ?>"
                                class="btn btn-secondary text-uppercase mb-4">Cancel
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/Deltapsu_Production/dependencies/resources/views/product/editFilterallType.blade.php ENDPATH**/ ?>