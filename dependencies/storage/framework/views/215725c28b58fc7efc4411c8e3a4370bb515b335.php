<?php $__env->startSection('css'); ?>
<style>
    .cbx span:last-child {
    padding-left: 8px;
    font-size: 14px;
     width: auto !important;
}
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('meta'); ?>
<title><?php echo e(isset($metatag[0]->meta_title)? $metatag[0]->meta_title :''); ?></title>
<meta name="description" content="<?php echo e(isset($metatag[0]->meta_description)? $metatag[0]->meta_description :''); ?>">
<meta name="keywords" content="<?php echo e(isset($metatag[0]->meta_key) ? $metatag[0]->meta_key :''); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('container'); ?>
<div class="padding-top-content">
</div>
<div class="products-index-banner" id="products-index-banner-type">
    <div class="products-index-nav">
        <div class="bg-bredcrumb">
            <div class="container">
                <nav aria-label="breadcrumb" id="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item text-breadcrumb-home">
                            <a href="<?php echo e(route('index','home')); ?>"><?php echo e($staticContent['Home']); ?></a>
                        </li>
                        <li class="breadcrumb-item active text-breadcrumb" aria-current="page">
                            <a  href="#"><?php echo e($staticContent['Subscribe']); ?></a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="padding-top-content-breadcrumb"></div>
    <div class="container">
        <h2 class="text-title-delta visible-up-922"><?php echo e($staticContent['Subscribe']); ?></h2>
        <h3 class="text-title-delta invisible-up-922"><?php echo e($staticContent['Subscribe']); ?></h3>
        <div class="col-12 mt-4 text-center">
            Subscribe to DeltaPSU newsletter and be the first to know about our new product releases and industry knowledge.
        </div>
        <form   action="<?php echo e(route('subscribe')); ?>" name="formsub" onsubmit="return submitsubscribeFrompage()" method="POST" >
            <?php echo e(csrf_field()); ?>

            <div class="container">
                <div class="row mt-3 mb-3 justify-content-center">
                    <div class="col-lg-6">
                        <div class="select input-label w-100 my-4">
                            <h6 class="mb-0" ><label class="text-dark"><?php echo e($staticContent['Country']); ?><span class="red">*</span></label></h6>
                            <select name="country" class="form-control" id="countryId" required>
                                <option value=""><?php echo e($staticContent['Select']); ?> <?php echo e($staticContent['Country']); ?></option>
                                <?php $__currentLoopData = $mail_chimp_country; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $email): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($email->name); ?>"><?php echo e($email->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div> 
                        <div class="input-label w-100 my-4">
                            <h6 class="mb-0" ><label class="text-dark"><?php echo e($staticContent['Email_Address']); ?><span class="red">*</span></label></h6>
                            <input type="email" class="form-control" name="email" required="required" placeholder="Email Address">
                            
                        </div>
                        <div class="input-label w-100 my-4">
                            <h6 class="mb-0" ><label class="text-dark"><?php echo e($staticContent['Name']); ?><span class="red">*</span></label></h6>
                            <input type="text" class="form-control" pattern="[A-Za-zก-๏\s]+" name="name" required="required" placeholder="Name">
                           
                        </div>
                     
                        <div class="col-lg-12 text-center">
                            <div> You understand and agree to our <a href="<?php echo e(route('privacyPolicy')); ?>" class="text-underline text-bold"> <?php echo e($staticContent['Privacy_Policy']); ?></a>.</div>
                            <div class="box-input-checkbox mb-4">
                                <input class="inp-cbx" name="accept" id="cx-sign-up-sub" onclick="chagedata()" value="0" type="checkbox"
                                    style="display: none;" />
                                <label class="cbx" for="cx-sign-up-sub"><span>
                                        <svg width="12px" height="10px" viewbox="0 0 12 10">
                                            <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                        </svg></span><span><?php echo e($staticContent['I_have_read_and_accept']); ?></span></label>
                            </div>
                        
                        </div>
                        
                        <div class="text-center">
                            <button type="submit" class="btn btn-subscribe mt-lg-0 mt-3"><?php echo e($staticContent['Subscribe']); ?></button>
                        </div>
                     
                    </div>
                </div>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script>
function submitsubscribeFrompage(){
    //  alert(document.formsub.accept.value );
    if(document.formsub.accept.value == 0 || document.formsub.accept.value == null) {
      alert("Please accept the privacy policy.");
      return false;
    } else {
        document.formsub.submit();
    }
   

  }
  function chagedata(){
      $('#cx-sign-up-sub').val(1);
  }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front-end', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/Deltapsu_Production/dependencies/resources/views/front-end/subscribe.blade.php ENDPATH**/ ?>