
<?php $__env->startSection('style'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">PopUp</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">PopUp</li>
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
            <h3 class="block-title">Information</h3>
        </div>
        <div class="block-content">
            <form action="<?php echo e(route('storeContent')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo e(csrf_field()); ?>

                <!-- Basic Elements -->
                <div class="row">
                <input type="hidden" name="type_id" value="<?php echo e($typeid); ?>" >
                <input type="hidden" name="con_id" value="<?php echo e(isset($static_content[0]->sta_id)? $static_content[0]->sta_id:''); ?>" >
               
                    <div class="col-lg-12">
                        <div class="block block-rounded block-bordered">
                            <ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs" role="tablist">
                                <?php $__currentLoopData = $language; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="nav-item">
                                    <a class="nav-link <?php echo e(($loop->iteration == 1)?'active':''); ?>" href="#btabs-alt-static-<?php echo e($item->name); ?>"
                                        style="text-transform: capitalize;"><?php echo e($item->name); ?></a>
                                </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                           
                            </ul>
                            <div class="block-content tab-content">
                                <?php $__currentLoopData = $language; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php 
                                $current = null;
                                foreach($static_content as $item2) { 
                                    if ($item->name == $item2->local) {
                                        $current = $item2;
                                        break;
                                    }
                                }
                              ?>
                                <input type="hidden" name="lang_loop[]" value="<?php echo e($item->name); ?>">
                                <div class="tab-pane <?php echo e(($loop->iteration == 1)?'active':''); ?>"
                                    id="btabs-alt-static-<?php echo e($item->name); ?>" role="tabpanel">
                                    <div class="form-group">
                                        <label for="example-select">Title</label>
                                        <input type="text"
                                            class="form-control <?php echo e($errors->has('name') ? 'is-invalid' : ''); ?>"
                                            name="name[<?php echo e($item->name); ?>]" value="<?php echo e(isset($current->title)? $current->title:''); ?>" placeholder=" Enter text...">
                                    </div>
                                    <div class="form-group">
                                            <label for="">Content</label>
                                            <textarea name="content[<?php echo e($item->name); ?>]" class="jssummernote1"><?php echo e(isset($current->content)? $current->content:''); ?></textarea>
                                        </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                         

                            <input type="hidden" name="filename[destop]" value="destop" >
                               <div class="table-responsive d-none">
                                <table class="table table-bordered table-striped table-vcenter">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 10px;">
                                                File Type
                                            </th>
                                          
                                            <th style="width:500px;">Preview</th>
                                            <th style="width:500px;">Old Image</th>
                                            <th>Upload File</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center">
                                               Image
                                            </td>
                                          
                                            <td class="font-w600">
                                                <img src="https://via.placeholder.com/1350x750.png"
                                                    class="img-thumbnail imagePreview1 res-image" alt="">
                                            </td>
                                            <td class="text-center">
                                                    <img src="<?php echo e(config('app.url')); ?>/medias/static_content/<?php echo e(isset($static_content[0]->destop_image)? $static_content[0]->destop_image:''); ?>"
                                                        class="img-thumbnail res-image" alt="">
                                                        <input type="hidden" name="oldfile[destop]" value="<?php echo e(isset($static_content[0]->destop_image)? $static_content[0]->destop_image:''); ?>" >
                                                </td>
                                         
                                            <td class="">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input"
                                                        data-toggle="custom-file-input" id="destop" name="fileimage[destop]"
                                                        value=" " accept="image/*">
                                                    <label id="label1" class="custom-file-label" for="destop">Choose file</label>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                           
                        </div>
                        <div class="form-group">
                            <label class="d-block">Show</label>
                            <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                    <input type="radio" class="custom-control-input" id="status-1" name="status" value="1" <?php echo e(isset($static_content[0]->status)&& $static_content[0]->status == 1 ? 'checked':''); ?>>
                                    <label class="custom-control-label" for="status-1">Show</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                    <input type="radio" class="custom-control-input" id="status-2" name="status" value="0"  <?php echo e(isset($static_content[0]->status)&& $static_content[0]->status == 0 ? 'checked':''); ?>>
                                    <label class="custom-control-label" for="status-2">Hide</label>
                                </div>
                           
                        </div>
                        <div class="text-center form-group">
                            <button class="btn btn-info" type="submit">Update </button>
                          
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




    $(document).on('change', '#destop', function () {
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

    $('.jssummernote1').summernote({
        tabsize: 2,
        height: 300
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/deltaPSU/dependencies/resources/views/popup/index.blade.php ENDPATH**/ ?>