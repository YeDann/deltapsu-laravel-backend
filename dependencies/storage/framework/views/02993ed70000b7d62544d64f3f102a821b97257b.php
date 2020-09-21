
<?php $__env->startSection('style'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Edit Success Story</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <a href="<?php echo e(route('successStory')); ?>">Success Stories</a></li>
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
            <form action="<?php echo e(route('succes_stories_update')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo e(csrf_field()); ?>

            <input type="hidden" name="story_id_main" value="<?php echo e($AllsuccessStory[0]->id); ?>">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                        <label for="example-select"><span class="req-fed">*</span>Model Name</label>
                           <select class="js-select2 form-control" name="model[]" data-placeholder="Choose many.." required multiple>
                            <option></option>
                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(in_array($item->pro_code, $arrModel)): ?>
                            <option value="<?php echo e($item->pro_code); ?>" selected><?php echo e($item->pro_code); ?></option> 
                            <?php else: ?> 
                            <option value="<?php echo e($item->pro_code); ?>" ><?php echo e($item->pro_code); ?></option> 
                            <?php endif; ?>   
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </select>
                        </div>
                    </div>
                   
                    <div class="col-lg-12">
                        <div class="form-group">
                        <label for="example-select"><span class="req-fed">*</span>Application</label>
                        <input type="text" class="form-control" name="application" value="<?php echo e($AllsuccessStory[0]->application); ?>" placeholder="Enter text..." >
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                        <label for="example-select">End Customer <span class="req-fed">*</span></label>
                        <input type="text" class="form-control" name="endCustomer"  value="<?php echo e($AllsuccessStory[0]->endCustomer); ?>" placeholder="Enter text..." >
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                        <label for="example-select">Country <span class="req-fed">*</span></label>
                        <select name="country"   class="form-control" id="country"  required>
                            <option value="">Please Select</option>
                            <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($AllsuccessStory[0]->country == $country->name ): ?>
                            <option value="<?php echo e($country->name); ?>" selected><?php echo e($country->name); ?></option> 
                            <?php else: ?> 
                            <option value="<?php echo e($country->name); ?>" ><?php echo e($country->name); ?></option> 
                            <?php endif; ?>   
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                        <label for="example-select">Message</label>
                        <textarea name="message" class="jsnotenew form-control"  placeholder="MESSAGE" rows="10" ><?php echo e($AllsuccessStory[0]->message); ?></textarea>
                        </div>
                    </div>
                  
                    <div class="col-lg-12">
                        <div class="text-center form-group mt-4">
                            <button class="btn btn-info" type="submit">Update </button>
                            <a href="<?php echo e(route('successStory')); ?>" class="btn btn-secondary">
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/deltaPSU/dependencies/resources/views/partners/sucessStories_edit.blade.php ENDPATH**/ ?>