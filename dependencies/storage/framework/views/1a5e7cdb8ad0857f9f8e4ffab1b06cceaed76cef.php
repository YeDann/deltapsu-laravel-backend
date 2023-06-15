<?php $__env->startSection('css'); ?>
<style>

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
<div class="products-index-nav visible-up-922">
    <div class="bg-bredcrumb">
        <div class="container">
            <nav aria-label="breadcrumb" id="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item text-breadcrumb-home"><a href="<?php echo e(route('index','home')); ?>"><?php echo e($staticContent['Home']); ?></a></li>
                    
                    <li class="breadcrumb-item active text-breadcrumb" aria-current="page"><a href="#"><?php echo e($staticContent['Partners_Login']); ?></a></li>

                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="padding-top-content-breadcrumb visible-up-922"></div>

    <div class="box-login pb-5">
        <div class="container">
            <h2 class="text-title-delta"><?php echo e($staticContent['Partners_Login']); ?></h2>
           <form id="loginform" method="POST" action="<?php echo e(route('partnerLogin')); ?>" >
            <?php echo e(csrf_field()); ?>

                <div class="center">
                    <div id="requestemail" class="col-sm-6 w-100 mx-auto mb-3">
                        <label class="text-title-detail-dark"><?php echo e($staticContent['Email_Address']); ?>*</label>
                        <input type="email" class="input-login" name="email" id="inputEmail" placeholder="<?php echo e($staticContent['Email_Address']); ?>" required>
                    </div>
                    
                    <div id="requestpassword" class="col-sm-6 w-100 mx-auto mb-3">
                        <label class="text-title-detail-dark"><?php echo e($staticContent['Password']); ?>*</label>
                        <input type="password" class="input-login" name="password" id="inputPassword" pattern="{8,}" title="Must at least 8 or more characters" placeholder="<?php echo e($staticContent['Password']); ?>" required>
                    </div>
                    <?php if(Session::has('flash_message_eror')): ?>
                    <h5 class="text-center" id="loginerormassage">  <?php echo Session('flash_message_eror'); ?></h5>
                    <?php endif; ?>
                    <div class="col-sm-4 text-center mx-auto my-4">
                        <button type="submit"  class="btn-subscribe"><?php echo e($staticContent['Login']); ?></button>
                    </div> 
                </div>
              </form>
                
                <div class="w-100 text-center mb-3">
                    <a data-toggle="modal" data-target="#confirm-email-forgot-pass" class="btn-forget"><?php echo e($staticContent['Forgot_Password']); ?></a>
                    
                </div>
                
           
        </div>
        
    </div>



<div class="modal fade p-1" id="confirm-email-forgot-pass" tabindex="-1" role="dialog" aria-labelledby="subscribe-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content ">
        <div class="modal-header pl-4">
          <h4 class="text-color-delta mb-0" id="subscribe-modal-title"><?php echo e($staticContent['Confirm_Email']); ?></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body px-4 mb-4">
        <form action="<?php echo e(route('checkpartnerAccount')); ?>" method="POST" >
                <?php echo e(csrf_field()); ?>

            
          <div class="input-label w-100 my-4">
              <h6 class="mb-0" ><label class="text-dark"><?php echo e($staticContent['Email_Address']); ?><span class="red">*</span></label></h6>
              <input type="email" class="form-control" name="email" required="required" placeholder="Email Address" required>
         
          </div>
      
          <p class="text-one mb-4"><?php echo e($staticContent['instructions_to_reset_your_password']); ?></p>
        <button type="submit" class="btn btn-subscribe"><?php echo e($staticContent['Send']); ?></button>
      </div>
    </form>
      
      </div>
    </div>
  </div>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('js'); ?>

<script>
    
//  function loginFunction(){
//      console.log();
 
//     var  formData = {
//                     'email': $("#inputEmail").val(),
//                     'password': ectp($("#inputPassword").val())
//                 };
//                 console.log(formData);
//                 event.preventDefault();
      
//            if(formData.email === ""){
//             $('#requestemail').addClass('request');
//            }else if(formData.password === ""){
//             $('#requestpassword').addClass('request');
//             console.log('Empty Password');
//            } else if(formData.email === "" && formData.password === ""){
//             $('#requestemail').addClass('request');
//             $('#requestpassword').addClass('request');
//            }else if(formData.email != "" && formData.password != "" ){
//             $.ajax({
//                 url: "",
//                 data: formData,
//                 type: 'POST',
//                 headers: {
//                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//                 },
//                 success: function (data) {
//                 if(data['status'] == 1){
//                     window.location = "<?php echo e(route('index','partners')); ?>";
//                 }else{
//                     $('#loginerormassage').text(data['message']);
//                 }
//                 }
//             });

//            }
       
         
//     }
//     function ectp(data){
//        var hs = MD5(data);
//         return hs;
//     }
</script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front-end', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/Deltapsu_Production/dependencies/resources/views/front-end/login.blade.php ENDPATH**/ ?>