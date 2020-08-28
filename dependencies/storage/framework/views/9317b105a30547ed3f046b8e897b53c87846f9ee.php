<?php $__env->startSection('style'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Create Series</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <?php if($pro_cate_id != 0): ?>
                    <li class="breadcrumb-item"> <a href="<?php echo e(route('series_index',$pro_cate_id)); ?>">All Series</a></li>
                    <?php else: ?> 
                    <li class="breadcrumb-item"> <a href="<?php echo e(route('series_all')); ?>">All Series</a></li>
                    <?php endif; ?>
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
            <form action="<?php echo e(route('storeSeries')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo e(csrf_field()); ?>

                <!-- Basic Elements -->
            <input  type="hidden" name="pro_cate_id" value="<?php echo e($pro_cate_id); ?>">
                <div class="row">
                    <div class="col-lg-12">
                    
                       
                            <?php $__currentLoopData = $language; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <input type="hidden" name="lang_loop[]" value="<?php echo e($item->name); ?>">
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <div class="form-group">
                                <label for="example-select"><span class="req-fed">*</span>Name</label>
                                <input type="text"
                                    class="form-control <?php echo e($errors->has('name') ? 'is-invalid' : ''); ?>"
                                    name="name" placeholder="Enter name...">
                            </div>
                            <div class="form-group">
                                <label for="example-select">Overview</label>
                                <textarea rows="4"  class="jsnotenew"
                                    name="overview"> </textarea>
                            </div>

                    </div>
                    <div class="col-lg-12">
                            <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-vcenter">
                                        <thead>
                                            <tr>
                                                <th class="text-center" style="width: 10px;">
                                                    File Type
                                                </th>
                                                <th style="width: 300px;">Preview</th>
                                                <th style="width: 300px;">Upload File <span class="req-fed">* File Max Size 2 MB</span></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center">
                                                        thumbnail
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
                                    <option value="<?php echo e($item->main_id); ?>" ><?php echo e($item->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                      </div>
                    <div class="col-lg-8 pt-2">
                            <div class="form-group">
                                    <label for="example-select">Sub Categories</label>
                                    <select class="js-select2 form-control" id="example-select2-multiple" name="productCategories[]" style="width: 100%;" data-placeholder="Choose many.." multiple>
                                        <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                        <?php $__currentLoopData = $subCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($item->sub_pro_id == $pro_cate_id ): ?>
                                        <option value="<?php echo e($item->sub_pro_id); ?>" selected><?php echo e($item->name); ?></option>
                                        <?php else: ?>
                                        <option value="<?php echo e($item->sub_pro_id); ?>" ><?php echo e($item->name); ?></option>
                                        <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="d-block">Mode </span></label>
                                    <?php $__currentLoopData = $modeSeries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mode): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                        <input type="radio" class="custom-control-input" id="status_mode<?php echo e($mode->id); ?>" name="status_mode" value="<?php echo e($mode->id); ?>" >
                                        <label class="custom-control-label" for="status_mode<?php echo e($mode->id); ?>"><?php echo e($mode->name); ?></label>
                                    </div>
                                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                                    </select>
                                    <div class="mt-2"> 
                                            <a class="btn btn-outline-primary" href="<?php echo e(route('application-view.index')); ?>">  *Add application</a>
                                    </div>     
                                </div>
                          </div>
                          <div class="col-lg-8 pt-2">
                          <div class="form-group">
                                <label class="d-block">Status</label>
                                <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                        <input type="radio" class="custom-control-input" id="status-1" name="status" value="1"  checked>
                                        <label class="custom-control-label" for="status-1">Show</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                        <input type="radio" class="custom-control-input" id="status-2" name="status" value="0" >
                                        <label class="custom-control-label" for="status-2">Hide</label>
                                    </div>
                               
                            </div>
                          </div>
                       
                    <div class="col-lg-12">
                        <div class="text-center form-group">
                            <button class="btn btn-success" type="submit">Create </button>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Deltapsu_Production\dependencies\resources\views\pro_categories\series_create.blade.php ENDPATH**/ ?>