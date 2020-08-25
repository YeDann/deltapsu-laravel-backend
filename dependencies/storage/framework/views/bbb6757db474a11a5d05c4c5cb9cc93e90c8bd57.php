
<?php $__env->startSection('style'); ?>
  
    <style>
     
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Edit Series</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <?php if($pro_cate_id != 0): ?>
                    <li class="breadcrumb-item"> <a href="<?php echo e(route('series_index',$pro_cate_id)); ?>">All Series</a></li>
                    <?php else: ?> 
                    <li class="breadcrumb-item"> <a href="<?php echo e(route('series_all')); ?>">All Series</a></li>
                    <?php endif; ?>
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
            <form action="<?php echo e(route('updateSeries')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo e(csrf_field()); ?>

                <!-- Basic Elements -->
              <input type="hidden" name="seriesId" value="<?php echo e($seriesId); ?>" >
              <input type="hidden" name="pro_cate_id" value="<?php echo e($pro_cate_id); ?>">
                <div class="row">
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
                                   
                                <?php $__currentLoopData = $language; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php 
                                $current = null;
                                foreach($series as $item) { 
                                    if ($item2->name == $item->local) {
                                        $current = $item;
                                        break;
                                    }
                                }
                               ?>
                                <input type="hidden" name="lang_loop[]" value="<?php echo e($item2->name); ?>">
                                <div class="tab-pane <?php echo e(($loop->iteration == 1) ?"active" :""); ?>" id="btabs-alt-static-<?php echo e($item2->name); ?>" role="tabpanel">
                                    <div class="form-group">
                                        <label for="example-select"><span class="req-fed">*</span>Name</label>
                                        <input type="text"
                                            class="form-control <?php echo e($errors->has('name') ? 'is-invalid' : ''); ?>"
                                            name="name[<?php echo e($item2->name); ?>]" value="<?php echo e(isset($current->title)? $current->title:""); ?>" placeholder="Enter name...">
                                    </div>
                                    <div class="form-group">
                                        <label for="example-select">Overview</label>
                                        <textarea rows="4" class="jsnotenew"
                                            name="overview[<?php echo e($item2->name); ?>]"><?php echo e(isset($current->overview_content)? $current->overview_content:""); ?></textarea>
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12" style="margin-bottom: 20px">
                            <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-vcenter">
                                        <thead>
                                            <tr>
                                                <th class="text-center" style="width: 10px;">
                                                    File Type
                                                </th>
                                                <th class="text-center" style="width:400px;">
                                                     Old Image
                                                    </th>
                                              
                                                <th style="width: 300px;">Preview</th>
                                                <th style="width: 300px;">Update File <span class="req-fed">* File Max Size 2 MB</span></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center">
                                                        thumbnail
                                                </td>
                                                <td class="">
                                                        <img src="<?php echo e(config('app.url')); ?>/medias/categories/<?php echo e($series[0]->image); ?>"
                                                            class="img-thumbnail res-image" alt="">
                                                            <input type="hidden" name="oldfile" value="<?php echo e($series[0]->image); ?>">
                                                    </td>
                                                <td class="">
                                                    <img src="https://via.placeholder.com/375x184.png"
                                                        class="img-thumbnail imagePreview2 res-image" alt="">
                                                </td>
        
                                                <td class="">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input"
                                                            data-toggle="custom-file-input" id="thumbnail" name="thumbnail"
                                                            value=" " accept="image/*">
                                                        <label id="label1" class="custom-file-label" for="thumbnail">Choose file</label>
                                                    </div>
                                                </td>
                                            </tr>
                                         
                                        </tbody>
                                    </table>
                                </div>
                    </div>
                    <div class="col-lg-8 pt-2">
                        <div class="form-group">
                                <label for="example-select">Main Categories</label>
                                <select class="js-select2 form-control" id="example-select2-multiple" name="mainCategories[]" style="width: 100%;" data-placeholder="Choose many.." multiple>
                                    <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                    <?php $__currentLoopData = $mainCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($item->main_id); ?>"  ><?php echo e($item->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    <?php $__currentLoopData = $mainCateInSection; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                   <option value="<?php echo e($item->main_id); ?>"  selected><?php echo e($item->name); ?></option>
                                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="d-block">Mode </span></label>
                                <?php $__currentLoopData = $modeSeries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mode): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                    <input type="radio" class="custom-control-input" id="status_mode<?php echo e($mode->id); ?>" name="status_mode" value="<?php echo e($mode->id); ?>"  <?php echo e(($series[0]->mode_series == $mode->id ) ? 'checked' : ''); ?> >
                                    <label class="custom-control-label" for="status_mode<?php echo e($mode->id); ?>"><?php echo e($mode->name); ?></label>
                                </div>
                               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                      </div>
                    <div class="col-lg-8 pt-2">
                            <div class="form-group">
                                    <label for="example-select">Product Categories</label>
                                    <select class="js-select2 form-control" id="example-select2-multiple" name="productCategories[]" style="width: 100%;" data-placeholder="Choose many.." multiple>
                                        <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                        <?php $__currentLoopData = $subCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($item->sub_pro_id); ?>" ><?php echo e($item->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php $__currentLoopData = $series_has_pro_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($cate->pro_categories_id); ?>"  selected><?php echo e($cate->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                          </div>
                  
                    <div class="col-lg-8 pt-2">
                            <div class="form-group">
                                    <label for="example-select">Select Application Icon</label>
                                    <select class="js-select2 form-control" id="example-select2-multiple" name="aplication[]" style="width: 100%;" data-placeholder="Choose many.." multiple>
                                        <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                        <?php $__currentLoopData = $applications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($item->appId); ?>"><?php echo e($item->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php $__currentLoopData = $series_has_application; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $app): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($app->app_id); ?>"  selected><?php echo e($app->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                          </div>
                          <div class="col-lg-8 pt-2">
                          <div class="form-group">
                                <label class="d-block">Status</label>
                                <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                        <input type="radio" class="custom-control-input" id="status-1" name="status" value="1"  <?php echo e(($series[0]->status == 1 ) ? 'checked' : ''); ?>>
                                        <label class="custom-control-label" for="status-1">Show</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                        <input type="radio" class="custom-control-input" id="status-2" name="status" value="0" <?php echo e(($series[0]->status == 0 ) ? 'checked' : ''); ?> >
                                        <label class="custom-control-label" for="status-2">Hide</label>
                                    </div>
                               
                            </div>
                          </div>
                       
                    <div class="col-lg-12">
                        <div class="text-center form-group">
                            <button class="btn btn-info" type="submit">Update </button>
                            <?php if($pro_cate_id != 0): ?>
                            <a href="<?php echo e(route('series_index',$pro_cate_id)); ?>" class="btn btn-secondary">
                                Cancel
                            </a>
                            <?php else: ?> 
                            <a href="<?php echo e(route('series_all')); ?>" class="btn btn-secondary">
                                Cancel
                            </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div style="padding-bottom: 155px"></div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script>
        $('.jssummernote').summernote({
          tabsize: 2,
          height: 200
        });
      </script>
<script>
    var previewImage = function (input, block) {
        var fileTypes = ['jpg', 'jpeg', 'png', 'gif', 'svg'];
        var extension = input.files[0].name.split('.').pop().toLowerCase(); /*se preia extensia*/
        var isSuccess = fileTypes.indexOf(extension) > -1; /*se verifica extensia*/

        if (isSuccess) {
            var reader = new FileReader();

            reader.onload = function (e) {
                block.attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        } else {
            alert('file is not accept!');
        }

    };

    $(document).on('change', '#thumbnail', function () {

        var FileSize = this.files[0].size / 1024 / 1024; // in MB
        if (FileSize > 2) {
            alert("File size exceeds 2 MB!");
            this.value = "";
            $('#label2').text('Choose file');
        }else{
            previewImage(this, $('.imagePreview2'));
        }

});

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/deltaPSU/dependencies/resources/views/pro_categories/series_edit.blade.php ENDPATH**/ ?>