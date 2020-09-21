
<?php $__env->startSection('style'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Edit Configurable Power</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <a href="<?php echo e(route('configurableProduct')); ?>">Configurable Power</a> </li>
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
            <h3 class="block-title">Infomation</h3>
        </div>
        <div class="block-content">
            <form action="<?php echo e(route('updateConfigProduct')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo e(csrf_field()); ?>

                <!-- Basic Elements -->
            <input type="hidden" name="tran_id" value="<?php echo e($transid); ?>">
                <div class="row">
                    <div class="col-md-12">

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
                                        foreach($cproducts as $item) { 
                                            if ($item2->name == $item->language) {
                                                $current = $item;
                                                break;
                                            }
                                          }
                                       ?>
                                        <input type="hidden" name="langloop[]" value="<?php echo e($item2->name); ?>">
                                       
                                    <div class="tab-pane <?php echo e(($loop->iteration == 1)?'active':''); ?>" id="btabs-alt-static-<?php echo e($item2->name); ?>" role="tabpanel">
                                            <div class="form-group">
                                                <label for="example-select">Product Code <span class="req-fed">*</span></label>
                                                <input type="text"
                                                    class="form-control <?php echo e($errors->has('name') ? 'is-invalid' : ''); ?>"
                                            name="productCode[<?php echo e($item2->name); ?>]" value="<?php echo e(isset($current->product_code)? $current->product_code :''); ?>" placeholder="Enter name..." >
                                            </div>
                                         
                                                <div class="form-group">
                                                        <label for="">Content</label>
                                                        <textarea name="content[<?php echo e($item2->name); ?>]" class="jsnotenew"><?php echo e(isset($current->description)? $current->description :''); ?></textarea>
                                                    </div>
                                        </div>
                                    
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                  
                               

                    </div>
                    <div class="col-md-12">
                        <input type="hidden" name="filename[thumbnail]" value="thumbnail">
                        <input type="hidden" name="filename[certificate]" value="certificate">
                        <input type="hidden" name="filename[preview]" value="preview">
                   
                        <div class="form-group">
                            <label for="example-select">Dimension L (mm.)</label>
                            <p class="req-fed">( Choice A: Use numeric value for simple display L x W x D. Choice B: Use
                                HTML to display any free text and ignore dimensionW and dimensionD )</p>
                            <input type="text" class="form-control <?php echo e($errors->has('dimensionL') ? 'is-invalid' : ''); ?>"
                            name="dimensionL" placeholder="" value="<?php echo e($cproducts[0]->dimensions); ?>" >
                        </div>
                        <div class="form-group">
                            <label for="example-select">Dimension W (mm.)</label>

                            <input type="text" class="form-control <?php echo e($errors->has('dimensionW') ? 'is-invalid' : ''); ?>"
                                name="dimensionW" placeholder=""  value="<?php echo e($cproducts[0]->dimen_w); ?>">
                        </div>
                        <div class="form-group">
                            <label for="example-select">Dimension D (mm.)</label>

                            <input type="text" class="form-control <?php echo e($errors->has('dimensionD') ? 'is-invalid' : ''); ?>"
                                name="dimensionD" placeholder=""  value="<?php echo e($cproducts[0]->dimen_d); ?>" >
                        </div>
                        <div class="form-group">
                            <label for="example-select">Unit Weight</label>

                            <input type="text" class="form-control <?php echo e($errors->has('unitwWeight') ? 'is-invalid' : ''); ?>"
                                name="unitwWeight" placeholder=""  value="<?php echo e($cproducts[0]->weight); ?>">
                        </div>
                        <div class="form-group">
                                <label for="example-select">Panel</label>
    
                                <input type="text" class="form-control <?php echo e($errors->has('panel') ? 'is-invalid' : ''); ?>"
                                    name="panel" placeholder="" value="<?php echo e($cproducts[0]->panel); ?>" >
                            </div>
                            <div class="form-group">
                                    <label for="example-select">Frame</label>
        
                                    <input type="text" class="form-control <?php echo e($errors->has('frame') ? 'is-invalid' : ''); ?>"
                                        name="frame" placeholder="" value="<?php echo e($cproducts[0]->frame); ?>">
                                </div>
                                <div class="form-group">
                                        <label for="example-select">MaxPower <span class="req-fed">*( Numeric only )</span></label>
            
                                        <input type="number" class="form-control <?php echo e($errors->has('maxPower') ? 'is-invalid' : ''); ?>"
                                            name="maxPower" placeholder="" value="<?php echo e($cproducts[0]->max_power); ?>" required>
                                    </div>

                                    <div class="form-group">
                                            <label for="example-select">Max Slot <span class="req-fed">*</span></label>
                                    </div>
                                    <div class="form-group">
                                            <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                                    <input type="radio" class="custom-control-input" id="status-1" name="max_slot" value="1" required <?php echo e(($cproducts[0]->max_slot == 1) ? 'checked':''); ?>>
                                                    <label class="custom-control-label" for="status-1">1</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                                    <input type="radio" class="custom-control-input" id="status-2" name="max_slot" value="2" required <?php echo e(($cproducts[0]->max_slot == 2) ? 'checked':''); ?>>
                                                    <label class="custom-control-label" for="status-2">2</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                                        <input type="radio" class="custom-control-input" id="status-3" name="max_slot" value="3" required <?php echo e(($cproducts[0]->max_slot == 3) ? 'checked':''); ?>>
                                                        <label class="custom-control-label" for="status-3">3</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                                            <input type="radio" class="custom-control-input" id="status-4" name="max_slot" value="4"  required <?php echo e(($cproducts[0]->max_slot == 4) ? 'checked':''); ?>>
                                                            <label class="custom-control-label" for="status-4">4</label>
                                                        </div>
                                                        <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                                                <input type="radio" class="custom-control-input" id="status-5" name="max_slot" value="5" required <?php echo e(($cproducts[0]->max_slot == 5) ? 'checked':''); ?>>
                                                                <label class="custom-control-label" for="status-5">5</label>
                                                            </div>
                                                            <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                                                    <input type="radio" class="custom-control-input" id="status-6" name="max_slot" value="6" required <?php echo e(($cproducts[0]->max_slot == 6) ? 'checked':''); ?>>
                                                                    <label class="custom-control-label" for="status-6">6</label>
                                                                </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="example-select">Status</label>
                                            <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                                 <input type="radio" class="custom-control-input" id="status_1" name="status" value="1" <?php echo e(($cproducts[0]->status == 1) ? 'checked':''); ?>>
                                             <label class="custom-control-label" for="status_1">Show</label>
                                                </div>
                                            <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                              <input type="radio" class="custom-control-input" id="status_2" name="status" value="0" <?php echo e(($cproducts[0]->status == 2) ? 'checked':''); ?>>
                                                <label class="custom-control-label" for="status_2">Hide</label>
                                                </div>
                                        </div>
                        <div class="table-responsive">
                                <table class="table table-bordered table-striped table-vcenter">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 10px;">
                                                File Type
                                            </th>
                                            <th style="width: 300px;">Old File</th>
                                          
                                            <th style="width: 350px;">Preview</th>
                                            <th>Upload File</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center">
                                               Thumbnail
                                            </td>
                                            <td class="">
                                               
                                                <img src="<?php echo e(config('app.url')); ?>/media/model/<?php echo e($cproducts[0]->thumb_img); ?>"
                                                    class="img-thumbnail res-image" alt="">
                                                    
                                                    <input type="hidden" name="oldfile[thumbnail]" value="<?php echo e($cproducts[0]->thumb_img); ?>" >
                                            </td>
                                            <td class="font-w600">
                                                <img src="https://via.placeholder.com/225x270.png"
                                                    class="img-thumbnail imagePreview1 res-image" alt="">
                                            </td>
    
                                            <td class="">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input"
                                                        data-toggle="custom-file-input" id="thumbnail" name="fileimage[thumbnail]"
                                                        value=" " accept="image/*">
                                                    <label id="label1" class="custom-file-label" for="thumbnail">Choose file</label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">
                                                    Certificate
                                            </td>
                                            <td class="">
                                                <img src="<?php echo e(config('app.url')); ?>/media/model/<?php echo e($cproducts[0]->certificate_img); ?>"
                                                    class="img-thumbnail res-image" alt="">
                                                    <input type="hidden" name="oldfile[certificate]" value="<?php echo e($cproducts[0]->certificate_img); ?>" >
                                            </td>
                                            <td class="font-w600">
                                                <img src="https://via.placeholder.com/245x105.png"
                                                    class="img-thumbnail imagePreview2 res-image" alt="">
                                            </td>
    
                                            <td class="">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input"
                                                        data-toggle="custom-file-input" id="certificate" name="fileimage[certificate]"
                                                        value=" " accept="image/*">
                                                    <label id="label1" class="custom-file-label" for="certificate">Choose file</label>
                                                </div>
                                            </td>
                                        </tr>
    
                                        <tr>
                                            <td class="text-center">
                                                 Product  Preview
                                            </td>
                                            <td class="">
                                                <img src="<?php echo e(config('app.url')); ?>/media/model/<?php echo e($cproducts[0]->preview_img); ?>"
                                                    class="img-thumbnail res-image" alt="">
                                                    <input type="hidden" name="oldfile[preview]" value="<?php echo e($cproducts[0]->preview_img); ?>" >
                                            </td>
                                            <td class="font-w600">
                                                    <img src="https://via.placeholder.com/590x200.png" class="img-thumbnail imagePreview4" alt="">
                                            </td>
    
                                            <td class="">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input"
                                                        data-toggle="custom-file-input" id="preview"
                                                        name="fileimage[preview]" value="no image" accept="image/*">
                                                    <label id="label2" class="custom-file-label" for="preview">Choose file</label>
                                                </div>
                                            </td>
                                    
                                    </tbody>
                                </table>
                            </div>
                            <div class="form-group text-center">
                                    <button class="btn btn-primary" type="submit">Update 
                                    </button>
                                    <a href="<?php echo e(route('configurableProduct')); ?>" class="btn btn-secondary">
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
            return false;
        } else {
            alert('File is not expept!');
         
            return true;
        }

    };


    $(document).on('change', '#thumbnail', function () {

        var FileSize = this.files[0].size / 1024 / 1024; // in MB
        if (FileSize > 2) {
            alert("File size exceeds 2 MB!");
            this.value = "";
            $('#label2').text('Choose file');
        }else{
            previewImage(this, $('.imagePreview1'));
        }
   
    });
   

    $(document).on('change', '#certificate', function () {
        // alert(this.files[0].size);
        var FileSize = this.files[0].size / 1024 / 1024; // in MB
        if (FileSize > 2) {
            alert("File size exceeds 2 MB!");
            this.value = "";
            $('#label1').text('Choose file');
        }else{
            previewImage(this, $('.imagePreview2'));
        }
    });
    $(document).on('change', '#preview', function () {
        // alert(this.files[0].size);
        var FileSize = this.files[0].size / 1024 / 1024; // in MB
        if (FileSize > 2) {
            alert("File size exceeds 2 MB!");
            this.value = "";
            $('#label1').text('Choose file');
        }else{
            previewImage(this, $('.imagePreview4'));
        }
    });

    
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/deltaPSU/dependencies/resources/views/configurableProduct/edit.blade.php ENDPATH**/ ?>