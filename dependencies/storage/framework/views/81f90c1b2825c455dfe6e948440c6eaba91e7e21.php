<?php $__env->startSection('style'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Update Page Information</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <a href="<?php echo e(route('partner_page')); ?>">Pages Information</a></li>
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
            <form action="<?php echo e(route('part_page_update')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo e(csrf_field()); ?>

                 <input type="hidden" name="page_id" value="<?php echo e($static_content[0]->id); ?>">
                <div class="row">
                    <div class="col-lg-12">
                    <div class="block block-rounded block-bordered">
                        <ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs" role="tablist">
                            <?php $__currentLoopData = $language; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <input type="hidden" name="lang_loop[]" value="<?php echo e($item->name); ?>" >
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
                            foreach($static_content as $item2) { 
                                if ($item->name == $item2->local) {
                                    $current = $item2;
                                    break;
                                }
                            }
                          ?>
                        
                        <div class="tab-pane <?php echo e(($loop->iteration == 1)?"active":""); ?>" id="btabs-alt-static-<?php echo e($item->name); ?>" role="tabpanel">
                         
                                <div class="form-group">
                                <label for="example-select"><span class="req-fed">*</span>Title</label>
                                <input type="text" class="form-control" name="title[<?php echo e($item->name); ?>]" value="<?php echo e(isset($current->title)? $current->title:''); ?>"  placeholder="Enter text..." >
                                </div>
                           
        
                           
                                <div class="form-group">
                                <label for="example-select"><span class="req-fed">*</span>Content</label>
                                <textarea rows="4" name="content[<?php echo e($item->name); ?>]"
                                class="jsnotenew form-control"><?php echo e(isset($current->content)? $current->content:''); ?></textarea>
                                </div>
                          
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                        <label for="example-select">Meta-title</label>
                        <input type="text" class="form-control" name="meta_title" value=" <?php echo e($static_content[0]->meta_title); ?>" placeholder="Enter text..." >
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                        <label for="example-select">Meta-description</label>
                        <input type="text" class="form-control" name="meta_desc" value=" <?php echo e($static_content[0]->meta_description); ?>" placeholder="Enter text..." >
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                        <label for="example-select">Meta-keyword</label>
                        <input type="text" class="form-control" name="meta_key" value=" <?php echo e($static_content[0]->meta_keyword); ?>"  placeholder="Enter text..." >
                        </div>
                    </div>
                    <div class="col-lg-12">
                    <div class="form-group">
                        <label class="d-block">Status</label>
                        <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                            <input type="radio" class="custom-control-input" id="status-line-1" name="status"
                                value="1" <?php echo e($static_content[0]->status == 1 ? 'checked':''); ?>>
                            <label class="custom-control-label" for="status-line-1">Show</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                            <input type="radio" class="custom-control-input" id="status-line-2" name="status"
                                value="0"  <?php echo e($static_content[0]->status == 2 ? 'checked':''); ?>>
                            <label class="custom-control-label" for="status-line-2">Hide</label>
                        </div>
                    </div>
                    <input type="hidden" name="filename[icon]" value="icon" >
                    <div class="table-responsive">
                     <table class="table table-bordered table-striped table-vcenter">
                         <thead>
                             <tr>
                                 <th class="text-center" style="width: 10px;">
                                     File Type
                                 </th>
                               
                                 <th style="width:30%;">Preview</th>
                                 <th style="width:30%;">Old Image</th>
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
                                         <img src="<?php echo e(config('app.url')); ?>/medias/static_content/<?php echo e(isset($static_content[0]->icon)? $static_content[0]->icon:''); ?>"
                                             class="img-thumbnail res-image" alt="">
                                             <input type="hidden" name="oldfile[icon]" value="<?php echo e(isset($static_content[0]->icon)? $static_content[0]->icon:''); ?>" >
                                     </td>
                              
                                 <td class="">
                                     <div class="custom-file">
                                         <input type="file" class="custom-file-input"
                                             data-toggle="custom-file-input" id="icon" name="fileimage[icon]"
                                             value=" " accept="image/*">
                                         <label id="label1" class="custom-file-label" for="icon">Choose file</label>
                                     </div>
                                 </td>
                             </tr>
                         </tbody>
                     </table>
                 </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="text-center form-group mt-4">
                            <button class="btn btn-info" type="submit">Update </button>
                            <a href="<?php echo e(route('partner_page')); ?>" class="btn btn-secondary">
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




    $(document).on('change', '#icon', function () {
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
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Deltapsu_Production\dependencies\resources\views\partners\page_info_edit.blade.php ENDPATH**/ ?>