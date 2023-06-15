<?php $__env->startSection('style'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Edit Marketing Resource </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <a href="<?php echo e(route('MarketResource.index')); ?>">All Marketing Resource</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- Content -->
<div class="content">
    <?php if(Session::has('flash_message')): ?>
    <div class="alert alert-success" role="alert">
        <button class="close" data-dismiss="alert"></button>
        <?php echo Session('flash_message'); ?>

    </div>
    <?php endif; ?>
    <?php if(Session::has('error_message')): ?>
    <div class="alert alert-danger" role="alert">
        <button class="close" data-dismiss="alert"></button>
        <?php echo Session('error_message'); ?>

    </div>
    <?php endif; ?>
    <div class="block block-rounded block-bordered">
        <div class="block-header block-header-default">
            <h3 class="block-title">Edit information</h3>
        </div>
        <div class="block-content">
            <form action="<?php echo e(route('update_MarketResource')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo e(csrf_field()); ?>

            <input type="hidden" name="mr_id" value="<?php echo e($margeting[0]->id); ?>">
                <!-- Basic Elements -->
                <div class="row push">
                  
                    <div class="col-lg-12">
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
                                foreach($margeting as $item2) { 
                                    if ($item->name == $item2->local) {
                                        $current = $item2;
                                        break;
                                    }
                                }
                           ?>
                                <input type="hidden" name="lang_loop[]" value="<?php echo e($item->name); ?>">
                                <div class="tab-pane <?php echo e(($loop->iteration == 1)?"active":""); ?>" id="btabs-alt-static-<?php echo e($item->name); ?>" role="tabpanel">
                                        <div class="form-group">
                                            <label for="example-select">Title</label>
                                            <input type="text"
                                                class="form-control <?php echo e($errors->has('name') ? 'is-invalid' : ''); ?>"
                                        name="name[<?php echo e($item->name); ?>]" value="<?php echo e(isset($current->name)? $current->name:""); ?>" placeholder="Enter name...">
                                        </div>
                                        <div class="form-group">
                                                <label for="example-select"> Old File</label>
                                                <a href="<?php echo e(config('app.url')); ?>/medias/marketing_resources/<?php echo e(isset($current->file) ? $current->file :''); ?>"><?php echo e(isset($current->file) ? $current->file :''); ?></a>
                                                
                                                <?php if(isset($current->file)): ?>
                                                <a href="<?php echo e(route('removefileMargeting',[$margeting[0]->id,$item->name])); ?>"  class="btn btn btn-danger"><i class="fa fa-trash"></i> </a>
                                                    <?php endif; ?>
                                                <input type="hidden" name="oldfile[<?php echo e($item->name); ?>]" value="<?php echo e(isset($current->file) ? $current->file :''); ?>">
                                            </div>
                                        <div class="form-group">
                                                <label for="example-select">File <span class="req-fed">* Max File Size 80 MB</span></label>
                                                <div class="custom-file " style="width:100%;">
                                                    <input type="file" class="custom-file-input" id="file_input<?php echo e($item->name); ?>" onchange="checkmaxsize(`file_input<?php echo e($item->name); ?>` ,'file_lable<?php echo e($item->name); ?>')"  name="file[<?php echo e($item->name); ?>]"
                                                        data-toggle="custom-file-input">
                                                    <label class="custom-file-label file_lable<?php echo e($item->name); ?>"  for="file">Choose file</label>
                                                </div>
                                               
                                            </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                           
                        </div>
                        <div class="form-group">
                                <label for="example-select">Select Categories <span class="req-fed">*</span></label>
                                <select class="js-select2 form-control" name="mr_categories" data-placeholder="Choose one.." required>
                                        <option></option>
                                    <?php $__currentLoopData = $margetCates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($item->cate_id == $margeting[0]->cate_id): ?>
                                    <option value="<?php echo e($item->cate_id); ?>" selected><?php echo e($item->name); ?></option>
                                    <?php else: ?> 
                                    <option value="<?php echo e($item->cate_id); ?>"><?php echo e($item->name); ?></option>
                                    <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                       
                                </select>
                                </div>
                        <div class="form-group">
                            <label class="d-block">Status</label>
                            <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                    <input type="radio" class="custom-control-input" id="status-1" name="status" value="1" <?php echo e($margeting[0]->status == 1 ?"checked":""); ?> >
                                    <label class="custom-control-label" for="status-1">Show</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                    <input type="radio" class="custom-control-input" id="status-2" name="status" value="0" <?php echo e($margeting[0]->status == 0 ?"checked":""); ?>>
                                    <label class="custom-control-label" for="status-2">Hide</label>
                                </div>
                           
                        </div>
                        <div class="text-center form-group">
                            <button class="btn btn-info" type="submit">Update </button>
                            <a href="<?php echo e(route('MarketResource.index')); ?>" class="btn btn-secondary">
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
      function checkmaxsize(id ,lableid){
          console.log(lableid);
         var file =  $('#'+id)[0].files[0];
         var FileSize = file.size / 1024 / 1024; // in MB
         
          if (FileSize > 80) {
            alert("File size exceeds 80 MB!");
           
           
            $('#'+id).val('');
            $('.'+lableid).text('Choose file');
          };

      }
      </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/Deltapsu_Production/dependencies/resources/views/MarketResource/edit.blade.php ENDPATH**/ ?>