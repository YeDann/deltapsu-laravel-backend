<?php $__env->startSection('style'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Update Latest Product</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <a href="<?php echo e(route('lastetproducts')); ?>">All Latest</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Update</li>
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
            <form action="<?php echo e(route('UpdateLastProduct')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo e(csrf_field()); ?>

                <!-- Basic Elements -->
            <input type="hidden" value="<?php echo e($last_products[0]->id); ?>" name="lastproId">
                <div class="row">
                        <div class="col-lg-12">
                                <span class="req-fed">*Plase select option</span>
                                <div class="form-group">
                                <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                        <input type="radio" class="custom-control-input" onchange="selectdataOption(1);" id="status-1" name="status" value="1" <?php echo e(($last_products[0]->status == 1) ? "checked" :''); ?> required>
                                        <label class="custom-control-label" for="status-1">1. Auto System push Product to Banner Option</label>
                                    </div>
                                  
                                </div>
                                <div class="form-group">
                                        <select class="js-select2 form-control" id="js_product_id"  name="productId" style="width: 100%;" data-placeholder="Choose Product.." >
                                                <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                                <?php $__currentLoopData = $product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($last_products[0]->product_id == $item->pro_id ): ?>
                                                <option value="<?php echo e($item->pro_id); ?>" selected><?php echo e($item->pro_code); ?></option>
                                                <?php else: ?> 
                                                <option value="<?php echo e($item->pro_id); ?>" ><?php echo e($item->pro_code); ?></option>
                                                <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                </div>
                            </div>
                        <div class="col-lg-12">
                                <div class="form-group">
                            <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                    <input type="radio" class="custom-control-input" onchange="selectdataOption(2);"  id="status-2" name="status" value="2"  <?php echo e(($last_products[0]->status == 2) ? "checked" :''); ?> required>
                                    <label class="custom-control-label" for="status-2">2. Customize Option</label>
                                </div>
                                </div>
                        </div>
                        <div class="col-lg-12">
                                <div class="form-group">
                                        <label for="example-colorpicker2">Background Color</label>
                                        <div class="js-colorpicker input-group" data-format="hex">
                                        <input type="text" class="form-control" id="example-colorpicker2" name="bg_color" value="<?php echo e($last_products[0]->bg_color); ?>">
                                            <div class="input-group-append">
                                                <span class="input-group-text colorpicker-input-addon">
                                                    <i></i>
                                                </span>
                                            </div>
                                        </div>
                                </div>
                        </div>
                        <div class="col-lg-12">
                                <div class="form-group">
                                        <label for="example-colorpicker2">Title Text Color</label>
                                        <div class="js-colorpicker input-group" data-format="hex">
                                            <input type="text" class="form-control" id="example-colorpicker2" name="title_color" value="<?php echo e($last_products[0]->title_color); ?>">
                                            <div class="input-group-append">
                                                <span class="input-group-text colorpicker-input-addon">
                                                    <i></i>
                                                </span>
                                            </div>
                                        </div>
                                </div>
                        </div>
                        <div class="col-lg-12">
                                <div class="form-group">
                                        <label for="example-colorpicker3">Description Text Color</label>
                                        <div class="js-colorpicker input-group" data-format="hex">
                                            <input type="text" class="form-control" id="example-colorpicker3" name="text_color"  value="<?php echo e($last_products[0]->text_color); ?>" >
                                            <div class="input-group-append">
                                                <span class="input-group-text colorpicker-input-addon">
                                                    <i></i>
                                                </span>
                                            </div>
                                        </div>
                                </div>
                        </div>
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
                                        foreach($last_products as $item) { 
                                            if ($item2->name == $item->local) {
                                                $current = $item;
                                                break;
                                            }
                                        }
                                    ?>
                                    <input type="hidden" name="lang_loop[]" value="<?php echo e($item2->name); ?>">
                                        <div class="tab-pane  <?php echo e($item2->name == $language[0]->name ? 'active show' : ''); ?>" id="btabs-alt-static-<?php echo e($item2->name); ?>" role="tabpanel">
                                            
                                    <p>*Use "Enter" to Begin a new row</p>
                                            <div class="form-group">
                                                <label for="example-select">Title</label>
                                            <textarea name="title[<?php echo e($item2->name); ?>]" class="form-control"><?php echo e(isset($current->title) ? $current->title : ''); ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                    <label for="example-select">Description</label>
                                                    <textarea name="content[<?php echo e($item2->name); ?>]"  rows="4" class="form-control" ><?php echo e(isset($current->description) ? $current->description : ''); ?></textarea>
                                                </div>
                                                <div class="form-group">
                                                        <label for="example-select">Link</label>
                                                        <input type="text" name="link[<?php echo e($item2->name); ?>]" value="<?php echo e(isset($current->link) ? $current->link : ''); ?>"  class="form-control" >
                                                    </div>
                                        </div>
                                    
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
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
                                                <th style="width: 300px;">Old Image</th>
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
                                                        <img src="<?php echo e(config('app.url')); ?>/medias/categories/<?php echo e($last_products[0]->image); ?>"
                                                            class="img-thumbnail res-image" alt="">
                                                            <input type="hidden" name="oldfile" value="<?php echo e($last_products[0]->image); ?>">
                                                    </td>
                                                <td class="">
                                                        <img src="https://via.placeholder.com/314x314.png" class="img-thumbnail imagePreview2"
                                                        alt="">
                                                </td>
                                                <td class="">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input"
                                                            data-toggle="custom-file-input" id="thumbnail" name="thumbnail"
                                                            value=" " accept="image/*">
                                                        <label id="label2" class="custom-file-label" for="thumbnail">Choose file</label>
                                                    </div>
                                                </td>
                                            </tr>
                                         
                                        </tbody>
                                    </table>
                                </div>
                    </div>
              
                    <div class="col-lg-12 mt-5">
                        <div class="text-center form-group">
                            <button class="btn btn-info" type="submit">Update </button>
                            <a href="<?php echo e(route('lastetproducts')); ?>" class="btn btn-secondary">
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
    
    function selectdataOption(id){
         if(id == 1){
          $('#js_product_id').prop('required', true);
         }else{
            $('#js_product_id').removeAttr('required');
         }
    }

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Deltapsu_Production\dependencies\resources\views\product\edit_lastpro.blade.php ENDPATH**/ ?>