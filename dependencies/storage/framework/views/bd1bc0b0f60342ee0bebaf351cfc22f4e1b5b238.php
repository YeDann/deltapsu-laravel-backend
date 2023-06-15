<?php $__env->startSection('style'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Edit Document Type</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <a href="<?php echo e(route('index_categories')); ?>">All Document Types</a></li>
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
            <h3 class="block-title">Document Types</h3>
        </div>
        <div class="block-content">
            <form action="<?php echo e(route('updateDocCategories')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo e(csrf_field()); ?>

                <input  type="hidden" name="docCateId" value="<?php echo e($categorie[0]->id); ?>">
                <!-- Basic Elements -->
                <div class="row">
                    <div class="col-lg-12">
                            <div class="form-group">
                                    <label for="example-select"><span class="req-fed">*</span>Title</label>
                                    <input type="text"
                                        class="form-control <?php echo e($errors->has('title') ? 'is-invalid' : ''); ?>"
                            name="title" value="<?php echo e($categorie[0]->title); ?>" placeholder="Enter title...">
                                </div>
                                <div class="form-group">
                                        <label class="d-block">Types <span class="req-fed">*</span></label>
                                       
                                        <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                                <input type="radio" class="custom-control-input" id="status-1" name="main_cate" value="1" <?php echo e(($categorie[0]->main_cate_id == 1)?"checked":""); ?>>
                                                <label class="custom-control-label" for="status-1">Document</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                                <input type="radio" class="custom-control-input" id="status-2" name="main_cate" value="2" <?php echo e(($categorie[0]->main_cate_id == 2)?"checked":""); ?>  >
                                                <label class="custom-control-label" for="status-2">Certificate</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                                    <input type="radio" class="custom-control-input" id="status-3" name="main_cate" value="3" <?php echo e(($categorie[0]->main_cate_id == 3)?"checked":""); ?> >
                                                    <label class="custom-control-label" for="status-2">GUI Software</label>
                                             </div>
                                       
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
                                   
                                <?php $__currentLoopData = $language; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php 
                                $current = null;
                                foreach($categorie as $item) { 
                                    if ($item2->name == $item->local) {
                                        $current = $item;
                                        break;
                                    }
                                }
                              ?>
                                <input type="hidden" name="lang_loop[]" value="<?php echo e($item2->name); ?>">
                                <div class="tab-pane <?php echo e(($loop->iteration == 1)? "active" :""); ?>" id="btabs-alt-static-<?php echo e($item2->name); ?>" role="tabpanel">
                                    <div class="form-group">
                                        <label for="example-select">Lable</label>
                                        <input type="text"
                                            class="form-control <?php echo e($errors->has('name') ? 'is-invalid' : ''); ?>"
                                            name="name[<?php echo e($item2->name); ?>]" value="<?php echo e(isset($current->lable) ? $current->lable :''); ?>" placeholder="Enter name...">
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
              
                    <div class="col-lg-12 mt-5">
                        <div class="text-center form-group">
                            <button class="btn btn-info" type="submit">Update </button>
                            <a href="<?php echo e(route('index_categories')); ?>" class="btn btn-secondary">
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
    $(document).on('change', '#file_input', function () {
        // alert(this.files[0].size);
        var FileSize = this.files[0].size / 1024 / 1024; // in MB
        if (FileSize > 20) {
            alert("File size exceeds 20 MB!");
            this.value = "";
        };
    });

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/Deltapsu_Production/dependencies/resources/views/product_doc/categories_edit.blade.php ENDPATH**/ ?>