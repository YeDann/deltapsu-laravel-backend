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
                    
                    <li class="breadcrumb-item active text-breadcrumb" aria-current="page"><a href="#">Change Password</a></li>

                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="padding-top-content-breadcrumb visible-up-922"></div>

    <div class="box-login pb-5">
        <div class="container">
            <h2 class="text-title-delta">Change Your Password</h2>
              <form id="loginform" onsubmit="resetPassFunction()">
                <div class="center">
                    <div id="requestpin" class="col-sm-6 w-100 mx-auto mb-3">
                        <label class="text-title-detail-dark">Pin*</label>
                        <input type="text" class="input-login" name="pin" id="pin" placeholder="Confirm Pin" required>
                    </div>
                
                    <div id="requestpassword" class="col-sm-6 w-100 mx-auto mb-3">
                        <label class="text-title-detail-dark"><?php echo e($staticContent['Password']); ?>*</label>
                        <input type="password" class="input-login" name="password" id="inputPassword" placeholder="<?php echo e($staticContent['Password']); ?>"  minlength="8" pattern="{8,}" title="Must contain at least 8 or more characters" required>
                    </div>
                    <div id="requestpasswordConfrim" class="col-sm-6 w-100 mx-auto mb-3">
                        <label class="text-title-detail-dark">*Confirm Password</label>
                        <input type="password" class="input-login" on name="confrimpassword" id="confrimpassword" placeholder="Confirm Password" minlength="8" pattern="{8,}" title="Must contain at least 8 or more characters" required onkeyup="comfirmNewPass(); return false;">
                        <div id="confirmMessage3"></div>
                    </div>
                    <h5 class="text-center" id="loginerormassage"></h5>
                    <h5 class="text-center" id="loginsuccessmassage"></h5>
                  
                    <div class="col-sm-4 text-center mx-auto my-4">
                        <button type="submit"  class="btn-subscribe">Change</button>
                    </div> 
                </div>
              </form>
           
                
           
        </div>
        
    </div>



<?php $__env->stopSection(); ?>


<?php $__env->startSection('js'); ?>
<script>
    function comfirmNewPass()
    {
        //Store the password field objects into variables ...
        var pass1 = document.getElementById('inputPassword');
        
        var pass2 = document.getElementById('confrimpassword');

          console.log(pass2.value);
        var message = document.getElementById('confirmMessage3');
    
        var goodColor = "#66cc66";
        var badColor = "#ff6666";
    
        if(pass1.value == pass2.value){
            // pass2.style.backgroundColor = goodColor;
            message.style.color = goodColor;
            message.innerHTML = "Passwords Match!"
        }else{
            // pass2.style.backgroundColor = badColor;
            message.style.color = badColor;
            message.innerHTML = "Passwords Do Not Match!"
        }
    }  
    
   
</script>
<script>
    
 function resetPassFunction(){
    var  formData = {
                    'pin': $("#pin").val(),
                    'confrimpassword': $("#confrimpassword").val(),
                    'password': $("#inputPassword").val()
                };
                // console.log(formData);
                event.preventDefault();
      
           if(formData.confrimpassword === ""){
            $('#requestemail').addClass('request');
           }else if(formData.password === ""){
            $('#requestpassword').addClass('request');
            // console.log('Empty Password');
            }else if(formData.pin === ""){
            $('#pin').addClass('request');
           
           } else if(formData.confrimpassword === "" && formData.password === ""){
            $('#requestpasswordConfrim').addClass('request');
            $('#requestpassword').addClass('request');
           }else if(formData.confrimpassword != "" && formData.password != "" && formData.pin ){
            $.ajax({
                url: "<?php echo e(route('resetPassword')); ?>",
                data: formData,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                if(data['status'] == 1){
                    window.location = "<?php echo e(route('index','login')); ?>";
                }else{
                    $('#loginerormassage').text(data['message']);
                }
                }
            });

           }
       
         
    }
</script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front-end', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/Deltapsu_Production/dependencies/resources/views/front-end/resetPassword.blade.php ENDPATH**/ ?>