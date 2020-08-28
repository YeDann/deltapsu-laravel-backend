<?php $__env->startSection('style'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Create Page Information</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <a href="<?php echo e(route('partner_page')); ?>">Pages Information</a></li>
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
            <form action="<?php echo e(route('part_page_store')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo e(csrf_field()); ?>

                <?php $__currentLoopData = $language; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <input type="hidden" name="lang_loop[]" value="<?php echo e($item->name); ?>">
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                        <label for="example-select"><span class="req-fed">*</span>Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Enter text..." required>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                        <label for="example-select"><span class="req-fed">*</span>Content</label>
                        <textarea rows="4" name="content"
                        class="jsnotenew form-control"></textarea>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                        <label for="example-select">Meta-title</label>
                        <input type="text" class="form-control" name="meta_title" placeholder="Enter text..." >
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                        <label for="example-select">Meta-description</label>
                        <input type="text" class="form-control" name="meta_desc" placeholder="Enter text..." >
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                        <label for="example-select">Meta-keyword</label>
                        <input type="text" class="form-control" name="meta_key" placeholder="Enter text..." >
                        </div>
                    </div>
                    <div class="col-lg-12">
                    <div class="form-group">
                        <label class="d-block">Status</label>
                        <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                            <input type="radio" class="custom-control-input" id="status-line-1" name="status"
                                value="1" checked>
                            <label class="custom-control-label" for="status-line-1">Show</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                            <input type="radio" class="custom-control-input" id="status-line-2" name="status"
                                value="0">
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
                            <button class="btn btn-success" type="submit">Create </button>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Deltapsu_Production\dependencies\resources\views\partners\page_info_create.blade.php ENDPATH**/ ?>