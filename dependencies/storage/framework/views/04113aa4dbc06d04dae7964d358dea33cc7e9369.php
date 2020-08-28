<?php $__env->startSection('style'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Edit </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo e(route('emailnotification' ,$type)); ?>">  Email Notification List</a></li>
                       
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
            <form action="<?php echo e(route('UpdateEmail')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo e(csrf_field()); ?>

                <input type="hidden" class="form-control" name="type" value="<?php echo e($type); ?>">
                <input type="hidden" class="form-control" name="old_id" value="<?php echo e($data[0]->id); ?>">
                <!-- Basic Elements -->
     
                <div class="row">
                    <div class="col-lg-12">
                            <?php if($type == 1): ?>
                                <div class="form-group">
                                    <label for="example-select">Country* </label>
                                <input type="text" class="form-control" name="country" placeholder="" value="<?php echo e($data[0]->country); ?>" >
                                </div>
                                <div class="form-group">
                                    <label for="example-select">Email (GUI Software Download)*</label>
                                    <input type="text" class="form-control " name="email_gui" placeholder="" value="<?php echo e($data[0]->email_gui); ?>"  >
                                    <span>Example : mail1@gmail.com,mail2@gmail.com</span>
                                </div>
                            <?php elseif($type == 2): ?>
                            <div class="form-group">
                                <label for="example-select">Subject*</label>
                                <select class="js-select2 form-control" id="subject" name="subject"  data-placeholder="Choose one.." >
                                        <option></option>
                                        <option value="0" <?php echo e($data[0]->subject == 0 ?'selected':''); ?>>Sale Enquiries</option>
                                        <option value="1" <?php echo e($data[0]->subject == 1 ?'selected':''); ?>>Products and Service Support</option>
                                        <option value="2" <?php echo e($data[0]->subject == 2 ?'selected':''); ?>>General Comments</option>
                                </select>
                            </div>
                            <?php elseif($type == 3): ?>
                            <div class="form-group">
                                    <label for="example-select">Product type*</label>
                                    <select class="js-select2 form-control" id="pro_categories" name="pro_categories"  data-placeholder="Choose one.." required>
                                        <option></option>
                                        <?php $__currentLoopData = $subCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option <?php echo e($data[0]->product_type == $sub->sub_pro_id ?'selected':''); ?> value="<?php echo e($sub->sub_pro_id); ?>"><?php echo e($sub->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                            </div>
                            <?php endif; ?>
                        <div class="form-group">
                            <label for="example-select">Email (Feedback Form)* </label>
                            <input type="text" class="form-control" name="email" placeholder="" value="<?php echo e($data[0]->email); ?>" >
                            <span>Example : mail1@gmail.com,mail2@gmail.com</span>
                        </div>
                        <div class="text-center mb-3">
                            <button class="btn btn-primary" type="submit" >Update </button>
                            <a href="<?php echo e(route('emailnotification',$type)); ?>"  class="btn btn-secondary">
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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Deltapsu_Production\dependencies\resources\views\feedbackEmail\edit.blade.php ENDPATH**/ ?>