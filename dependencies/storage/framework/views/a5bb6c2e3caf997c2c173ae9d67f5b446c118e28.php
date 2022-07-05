<?php $__env->startSection('style'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Edit Banner</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <a href="<?php echo e(route('bannerSlide.index')); ?>">Banner Slides</a></li>
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
            <form action="<?php echo e(route('updateBanner')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo e(csrf_field()); ?>



                <input type="hidden" name="id" value="<?php echo e($bannerslide[0]->id); ?>">
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
                                foreach($bannerslide as $item2) { 
                                    if ($item->name == $item2->local) {
                                        $current = $item2;
                                        break;
                                    }
                                }
                           ?>
                                <input type="hidden" name="lang_loop[]" value="<?php echo e($item->name); ?>">
                                <div class="tab-pane <?php echo e(($loop->iteration == 1)?"active":""); ?>" id="btabs-alt-static-<?php echo e($item->name); ?>" role="tabpanel">
                                    <p>*Use "Enter" to Begin a new row</p>
                                        <div class="form-group">
                                            <label for="example-select">Mobile Title </label>
                                            <textarea  name="title_1[<?php echo e($item->name); ?>]" rows="3" class="form-control"><?php echo e(isset($current->title)? $current->title:""); ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="example-select">Desktop Title</label>
                                            <textarea  name="title_2[<?php echo e($item->name); ?>]" rows="3" class="form-control"><?php echo e(isset($current->title2)? $current->title2:""); ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="example-select">Content </label>
                                            <textarea name="content[<?php echo e($item->name); ?>]"  class="jsnotenew"><?php echo e(isset($current->content)? $current->content:""); ?></textarea>
                                        </div>
                                        <div class="form-group">
                                                <label for="example-select">Link  </label>
                                                <span style="color:red;">  ( Example. https://www.delta.com" )</span>
                                                <input type="text" class="form-control" name="btn_link[<?php echo e($item->name); ?>]" value="<?php echo e(isset($current->btn_link)? $current->btn_link:""); ?>" placeholder="Enter Link ex. https://www.delta.com">
                                            </div>
                                        <div class="form-group">
                                            <label for="example-select">Button Name </label>
                                            <input type="text" class="form-control" name="btn_name[<?php echo e($item->name); ?>]" value="<?php echo e(isset($current->btn_name)? $current->btn_name:""); ?>" placeholder="Enter Text">
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                
                        <div class="form-group">
                                <label class="d-block">Button Show</label>
                                <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                        <input type="radio" class="custom-control-input" id="status-1" name="btn_status" value="1"  <?php echo e($bannerslide[0]->btn_status == 1 ?'checked':''); ?>>
                                        <label class="custom-control-label" for="status-1">Show</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                        <input type="radio" class="custom-control-input" id="status-2" name="btn_status" value="0"  <?php echo e($bannerslide[0]->btn_status == 0 ?'checked':''); ?> >
                                        <label class="custom-control-label" for="status-2">Hide</label>
                                    </div>
                               
                            </div>

                       
                        <div class="form-group">
                            <label for="example-colorpicker2">Title Color</label>
                            <div class="js-colorpicker input-group" data-format="hex">
                                <input type="text" class="form-control" id="example-colorpicker2" name="title_color"
                                    value="#0087DC">
                                <div class="input-group-append">
                                    <span class="input-group-text colorpicker-input-addon">
                                        <i></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="example-colorpicker2">Content Color</label>
                            <div class="js-colorpicker input-group" data-format="hex">
                                <input type="text" class="form-control" id="example-colorpicker2" name="content_color"
                                    value="#000000">
                                <div class="input-group-append">
                                    <span class="input-group-text colorpicker-input-addon">
                                        <i></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="filename[mobile_image]" value="mobile_image" >
                        <input type="hidden" name="filename[destop_image]" value="destop_image">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-vcenter">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 20px;">
                                            File Type
                                        </th>
                                        <th style="width:20%;">Old Image</th>
                                        <th style="width:20%;">Preview</th>
                                        <th>Upload File</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">
                                            Mobile Image
                                        </td>
                                        <td class="text-center">
                                                <img src="<?php echo e(config('app.url')); ?>/medias/banners/<?php echo e($bannerslide[0]->image); ?>"
                                                    class="img-thumbnail res-image" alt="">
                                            </td>
                                        <td class="font-w600">
                                            <img src="https://via.placeholder.com/750x700.png"
                                                class="img-thumbnail imagePreview1 res-image" alt="">
                                        </td>
                                        <td class="">
                                            <div class="custom-file">
                                                <span style="color:red">* Maximum 2mb </span>
                                                <input type="file" class="custom-file-input"
                                                    data-toggle="custom-file-input" id="mobile_image" name="fileimage[mobile_image]"
                                                    value=" " accept="image/*">
                                                <label id="label1" class="custom-file-label" for="mobile_image">Choose
                                                    file</label>
                                                    <input type="hidden" name="oldfile[mobile_image]" value="<?php echo e($bannerslide[0]->image); ?>" >
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">
                                             Desktop Image
                                        </td>
                                        <td class="text-center">
                                                <img src="<?php echo e(config('app.url')); ?>/medias/banners/<?php echo e($bannerslide[0]->image_destop); ?>"
                                                    class="img-thumbnail res-image" alt="">
                                            </td>
                                        <td class="font-w600">
                                            <img src="https://via.placeholder.com/3840x800.png"
                                                class="img-thumbnail imagePreview2 res-image" alt="">
                                                <input type="hidden" name="oldfile[destop_image]" value="<?php echo e($bannerslide[0]->image_destop); ?>" >
                                        </td>
                                        <td class="">
                                            <div class="custom-file">
                                                <span style="color:red">* Maximum 2mb </span>
                                                <input type="file" class="custom-file-input"
                                                    data-toggle="custom-file-input" id="destop_image" name="fileimage[destop_image]"
                                                    value=" " accept="image/*">
                                                <label id="label2" class="custom-file-label" for="destop_image">Choose
                                                    file</label>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="text-center form-group">
                            <button class="btn btn-info" type="submit">Update </button>
                            <a href="<?php echo e(route('bannerSlide.index')); ?>" class="btn btn-secondary">
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
        $(document).on('change', '#mobile_image', function () {
        // alert(this.files[0].size);
        var FileSize = this.files[0].size / 1024 / 1024; // in MB
        if (FileSize > 2) {
            alert("File size exceeds 2 MB!");
            this.value = "";
            $('#label1').text('Choose file');
        }else{
            previewImage(this, $('.imagePreview1'));
        }
    });
    $(document).on('change', '#destop_image', function () {
        // alert(this.files[0].size);
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/Deltapsu_Production/dependencies/resources/views/banner/edit.blade.php ENDPATH**/ ?>