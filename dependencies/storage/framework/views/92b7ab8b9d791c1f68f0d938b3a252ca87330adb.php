
<?php $__env->startSection('style'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Backend Users</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <a href="<?php echo e(route('backendUser.index')); ?>" >Backend Users</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- Content -->
<div class="content mb-5">
    <div class="block block-rounded block-bordered">
        <div class="block-header block-header-default">
            <h3 class="block-title">Create Backend Users</h3>
        </div>
        <div class="block-content mb-5">
            <form id="submitformbkuser" method="POST" action="<?php echo e(route('backendUser.store')); ?>">
                <?php echo csrf_field(); ?>
                <!-- Basic Elements -->
               
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-xl-8">
                      
                        <div class="form-group row">
                            <label for="firstname" class="col-md-4 col-form-label text-md-right"><?php echo e(__('First Name')); ?>*</label>

                            <div class="col-md-6">
                                <input id="firstname" type="text" class="form-control<?php echo e($errors->has('firstname') ? ' is-invalid' : ''); ?>" name="firstname" value="<?php echo e(old('firstname')); ?>" required >

                                <?php if($errors->has('firstname')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('firstname')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="lastname" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Last Name')); ?>*</label>

                            <div class="col-md-6">
                                <input id="lastname" type="text" class="form-control<?php echo e($errors->has('lastname') ? ' is-invalid' : ''); ?>" name="lastname" value="<?php echo e(old('lastname')); ?>" required >

                                <?php if($errors->has('lastname')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('lastname')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="position" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Position')); ?>*</label>

                            <div class="col-md-6">
                                <input id="position" type="text" class="form-control<?php echo e($errors->has('position') ? ' is-invalid' : ''); ?>" name="position" value="<?php echo e(old('position')); ?>" required >

                                <?php if($errors->has('position')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('position')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="companyName" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Company Name (Distributor)')); ?>*</label>

                            <div class="col-md-6">
                                <input id="companyName" type="text" class="form-control<?php echo e($errors->has('companyName') ? ' is-invalid' : ''); ?>" name="companyName" value="<?php echo e(old('companyName')); ?>" required >

                                <?php if($errors->has('companyName')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('companyName')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Phone')); ?>*</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control<?php echo e($errors->has('phone') ? ' is-invalid' : ''); ?>" name="phone" value="<?php echo e(old('phone')); ?>" required >

                                <?php if($errors->has('phone')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('phone')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fax" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Fax')); ?>*</label>

                            <div class="col-md-6">
                                <input id="fax" type="text" class="form-control<?php echo e($errors->has('fax') ? ' is-invalid' : ''); ?>" name="fax" value="<?php echo e(old('fax')); ?>" required >

                                <?php if($errors->has('fax')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('fax')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="country" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Country')); ?> *</label>
                            <div class="col-md-6">
                             <select class="form-control" name="country">
                                 <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                 <option value="<?php echo e($item->name); ?>"><?php echo e($item->name); ?></option> 
                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                             </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right"><?php echo e(__('E-mail')); ?> *</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" name="email" value="<?php echo e(old('email')); ?>" required>

                                <?php if($errors->has('email')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        *The password must be at least 8 characters.
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Password')); ?> *</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" name="password" required>

                                <?php if($errors->has('password')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

           

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Confirm Password')); ?> *</label>
                          
                            <div class="col-md-6">
                                <input  id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                <strong style="color:green;" id="passwordmatch"></strong>
                                <strong style="color:red;" id="passwordmatcherror"></strong>
                            </div>
                           
                        </div>
                
                        <div class="form-group row">
                            <label class="d-block col-md-4 col-form-label text-md-right">Language Role *</label>
                            <div class="col-md-6">
                            <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                    <input type="radio" class="custom-control-input" id="status-1" name="role" value="All" checked >
                                    <label class="custom-control-label" for="status-1">admin</label>
                                </div>
                                <?php $__currentLoopData = $language; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                    <input type="radio" class="custom-control-input" id="status-<?php echo e($lang->name); ?>" name="role" value="<?php echo e($lang->name); ?>" >
                                <label class="custom-control-label" for="status-<?php echo e($lang->name); ?>">admin_<?php echo e($lang->name); ?></label>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                           
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button onclick="validateInput();" type="button" class="btn btn-primary">
                                       Save
                                </button>
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
  function validateInput(){
      var pass = $('#password').val();
      var confipass = $('#password-confirm').val();
    //   console.log(confipass);
      if(pass == confipass){
         $('#passwordmatch').text('Password is matched  !!')
         document.getElementById("submitformbkuser").submit();
      }else{
        $('#password-confirm').val('');
        $('#passwordmatcherror').text('Password is not matched  !!')
      }
  }

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/deltaPSU/dependencies/resources/views/user/createUser.blade.php ENDPATH**/ ?>