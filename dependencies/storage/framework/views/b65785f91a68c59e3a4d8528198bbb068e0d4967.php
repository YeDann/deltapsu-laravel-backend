
<?php $__env->startSection('style'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Edit Static Word</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <a href="<?php echo e(route('static_word')); ?>">Static Words</a></li>
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
            <h3 class="block-title">Information</h3>
        </div>
        <div class="block-content">
            <form action="<?php echo e(route('update_staticword')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo e(csrf_field()); ?>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                        <label for="example-select">Key_word</label>
                        <?php echo e($static_word[0]->key_word); ?>

                        <input type="hidden" class="form-control" name="key_word" value="<?php echo e($static_word[0]->key_word); ?>" placeholder="Enter text..."  >
                        </div>
                        <div class="block block-rounded block-bordered">
                            <ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs" role="tablist">
                                <?php $__currentLoopData = $language; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                        foreach($static_word as $item2) { 
                            if ($item->name == $item2->local) {
                                $current = $item2;
                                break;
                            }
                        }
                      ?>
                           <input type="hidden" name="lang_loop[]" value="<?php echo e($item->name); ?>">
                             
                           <div class="tab-pane <?php echo e(($loop->iteration == 1)?"active":""); ?>" id="btabs-alt-static-<?php echo e($item->name); ?>" role="tabpanel">
                        <div class="form-group">
                            <label for="example-text-input"><span class="req-fed">*</span>Word</label>
                            <input type="text" class="form-control" name="word[<?php echo e($item->name); ?>]" value="<?php echo e(isset($current->word) ? $current->word :''); ?>" placeholder="Enter text..." required>
                        </div>
                           </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="text-center form-group mt-4">
                            <button class="btn btn-info" type="submit">Update </button>
                            <a href="<?php echo e(route('static_word')); ?>" class="btn btn-secondary">
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/deltaPSU/dependencies/resources/views/static_word/edit.blade.php ENDPATH**/ ?>