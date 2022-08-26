<?php $__env->startSection('css'); ?>
<style>

    .banner-type-product-all{
        height: 432px;
    }
    @media (max-width:768px){
        .banner-type-product-all{
            height: 250px;
        }   
    }
   
    /* select */
	.form-control{
		-webkit-appearance: none;
		-moz-appearance: none;
		border-radius: 0;
		border: 1px solid #444444; background-position: right 50%;
		background-repeat: no-repeat;
		background-image: url('<?php echo e(asset('frontend-asset/image/arrow-down.svg')); ?>');
        font-size:16px;
    }
    
	.form-control:disabled, .form-control[readonly] {
		background-color: #F2F2F2;
		border: 1px solid #C1C1C1 !important;
		opacity: 1;
		color: #C1C1C1;
		background-image:unset;
	}
	.form-control:focus {
		color: #495057;
		background-color: #fff;
		border-color: #80bdff;
		outline: unset;
		box-shadow: unset;
    }
    input[type=text],input[type=email]{
		background-image:unset;
		
    }
    .input-label{
        position: relative;
    }
    .box-support-detail input[required] + label {
        color: #707070;
        font-family: Arial;
        font-size: 14px;
        position: absolute;
        bottom: 0;
        left: 18px ;  /* the negative of the input width */
    }
    textarea[required] + label {
        color: #707070;
        font-family: Arial;
        font-size: 14px;
        position: absolute;
        top: 12px;
        left: 12px;  /* the negative of the input width */
    }
    input[required=required] + label:after {
        content:'*';
       /*  color: red; */
    }

    /* show the placeholder when input has no content (no content = invalid) */
    input[required=required]:invalid + label{
        display: inline-block;
        padding-left: .375rem;
    }
    textarea[required=required]:invalid + label{
        display: inline-block;
    }
    /* hide the placeholder when input has some text typed in */
    input[required]:valid + label,input[required]:focus+label,textarea[required]:valid + label{
        display: none;
    }
    .d-flex.mr-b-12px .input-label:first-child {
        margin-right: 12px;
    }
    .d-flex.mr-b-12px .input-label:last-child {
        margin-left: 12px;
    }
    textarea {
        height: 15%;
    }
   
textarea{
    padding-left: 12px;
}
.tel-not-req{
    background-color: #F2F2F2 !important;
    border: 1px solid #C1C1C1 !important;
    opacity: 1;
    color: #C1C1C1;
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
<div class="products-index-nav visible-up-922">
    <div class="bg-bredcrumb">
        <div class="container">
            <nav aria-label="breadcrumb" id="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item text-breadcrumb-home"><a href="<?php echo e(route('index','home')); ?>"><?php echo e($staticContent['Home']); ?></a></li>
                    <li class="breadcrumb-item active text-breadcrumb-home dropdown" aria-current="page"><a
                            href="#" data-toggle="dropdown" id="tools-dropdown"><?php echo e($staticContent['Supports']); ?></a>
                            <ul class="dropdown-menu">
                                <li><a href="#" id="tools-dropdown" class="text-bold"><?php echo e($staticContent['Supports']); ?></a></li>
                                <hr>
                                <li><a href="<?php echo e(route('contactSupport')); ?>"><?php echo e($staticContent['contact_us']); ?></a></li>
                                <li><a href="<?php echo e(route('contactSalesOffices')); ?>"><?php echo e($staticContent['sales_offices']); ?></a></li>
                                <li><a href="<?php echo e(route('contactFindDistributor')); ?>"><?php echo e($staticContent['find_a_distributor']); ?></a></li>
                                <li><a href="<?php echo e(route('index','faqs')); ?>"><?php echo e($staticContent['FAQs']); ?></a></li>
                              </ul>   
                    </li>
                    <li class="breadcrumb-item active text-breadcrumb" aria-current="page"><a href="#"><?php echo e($staticContent['contact_us']); ?></a></li>

                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="banner-type-product-all item"
    style="background-image: url('<?php echo e(asset('frontend-asset/image/Group 1834@2x.png')); ?>');">
</div>
<div class="box-support-detail mb-5">
    <div class="container">
        <h2 class="text-title-delta visible-tablets-up"><?php echo e($staticContent['what_type_of_support']); ?></h2>
        <h3 class="text-title-delta visible-mobile"><?php echo e($staticContent['what_type_of_support']); ?></h3>
    <form id="submitSupport"  onsubmit="return validateForm(this)"  action="<?php echo e(route('SubmitContact')); ?>" method="POST">
        <?php echo e(csrf_field()); ?>

        <p><?php echo e($staticContent['support_from_up_text']); ?></p>
     
        <div class="add-space-mobile">
            <div class="row">
                <label class="col-12 text-title-detail-dark"><?php echo e($staticContent['Subject']); ?><span class="red">*</span></label>
                <div class="col-12 w-100 mb-4">  
                        <select id="subjectType" name="subject" class="form-control" required>
                            <option value=""><?php echo e($staticContent['Select']); ?> <?php echo e($staticContent['Subject']); ?></option>
                            <option value="0" <?php echo e(isset($contactlink) && $contactlink =='Sale-Enquiries'?'selected':''); ?> >Sales Enquiry</option>
                            <option value="Products and Service Support" <?php echo e(isset($contactlink) && $contactlink =='Products-and-Service-Support'?'selected':''); ?>>Products and Service Support</option>
                            <option value="General Comments">General Comments</option>
                            
                        </select>
                </div>
            </div>
            <div class="row  ">
                <div class="col-lg-6 col-md-12 input-label w-100 mb-4">
                    <label class="text-title-detail-dark"><?php echo e($staticContent['Name']); ?><span class="red">*</span></label>
                    <input type="text" class="form-control" name="name" pattern="[A-Za-zก-๏\s]+"  required="required" placeholder="Name">
                </div>
                <div class="col-lg-6 col-md-12 input-label w-100 mb-4">
                    <label class="text-title-detail-dark"><?php echo e($staticContent['Email_Address']); ?><span class="red">*</span></label>
                    <input type="email" class="form-control" name="email"  title="Incorrect Format Email"  placeholder="Email Address" required>
                </div>
           
             
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-12 input-label w-100 mb-4">
                    <label class="text-title-detail-dark"><?php echo e($staticContent['Company']); ?><span class="red">*</span></label>
                    <input type="text" class="form-control" name="company" pattern="[A-Za-zก-๏\s().]+" required="required" placeholder="Company"> 
                </div>
                <div class="col-lg-6 col-md-12 input-label w-100 mb-4">
                    <label class="text-title-detail-dark"><?php echo e($staticContent['Product_Type']); ?><span class="red">*</span></label> 
                        <select  id="type_id" name="type_id"  class="form-control" onchange="selectType();" required >
                            <option value=""><?php echo e($staticContent['Select']); ?> <?php echo e($staticContent['Type']); ?></option>
                            <?php $__currentLoopData = $subCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(in_array($sub->sub_pro_id, $arr_settype)): ?>
                            <option value="<?php echo e($sub->sub_pro_id); ?>" ><?php echo e($sub->name); ?></option> 
                            <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <input type="hidden" name="type_name" id="type_name">
                        <input type="hidden" name="config_id" id="config_id">
                        <input type="hidden" name="enquireStatus" id="enquireStatus">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-12  select input-label w-100 mb-4">
                    <label class="text-title-detail-dark"><?php echo e($staticContent['Country']); ?><span class="red">*</span></label>
                    <select name="country"  class="form-control required" onchange="selectCountry();" id="countryemailId"  required>
                        <option value=""><?php echo e($staticContent['Select']); ?> <?php echo e($staticContent['Country']); ?></option>
                        <?php $__currentLoopData = $countryemails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $email): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($email->country); ?>"><?php echo e($email->country); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div> 
                <div class="col-lg-6 col-md-12 input-label w-100 mb-4">
                    <label class="text-title-detail-dark"><?php echo e($staticContent['Model']); ?><span class="red">*</span></label>
                        <select id="model_id"  name="model_name"  class="form-control"  disabled required>
                            <option value=""><?php echo e($staticContent['Select']); ?> <?php echo e($staticContent['Model']); ?></option>
                        </select>
                </div>
            
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-12 select02 input-label w-100 mb-4" id="box_state_con">
                    <label class="text-title-detail-dark"><?php echo e($staticContent['City_State']); ?> <span id="r_q_contry" class="red"></span></label>
                    <select name="state" class="form-control" id="stateId" >
                        <option value="" data-color="red"><?php echo e($staticContent['Select']); ?> <?php echo e($staticContent['City_State']); ?></option>
                    </select>
                </div>
                <div class="col-lg-6 col-md-12 input-label w-100 mb-4">
                    <label class="text-title-detail-dark"><?php echo e($staticContent['Phone_Number']); ?></label>
                    <input type="tel" class="form-control tel-not-req" name="tel" pattern="^[0-9-+\s()]*$" maxlength="13" title="Incorrect Format Number only and Special Charecter +,-" placeholder="<?php echo e($staticContent['Phone_Number']); ?>"  >
                </div>
            </div>
            <div class="row ">
                <div class="col-12">
                    <label class="text-title-detail-dark mt-4"><?php echo e($staticContent['Message']); ?><span class="red">*</span></label>
                    <div class="input-label">
                        <textarea name="message" id="message" class="w-100" required="required" rows="10"></textarea>
                        <label for="message"><?php echo e($staticContent['Message']); ?></label>
                    </div>
                   
                    <div class="box-input-checkbox">
                        <input class="inp-cbx" name="prichk" id="privacycheck" value="1" onclick="onacceptionPolicy()"  type="checkbox"
                            style="display: none;" />
                        <label class="cbx" for="privacycheck"><span>
                                <svg width="12px" height="10px" viewbox="0 0 12 10">
                                    <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                </svg></span><span> <?php echo e($staticContent['By_submitting_this_form']); ?> <text class="red">*</text> <a target="_blank" href="<?php echo e(route('privacyPolicy')); ?>" class="font-size-tab text-underline text-bold"><?php echo e($staticContent['Privacy_Policy']); ?></a></span></label>
                    </div>
 
                    <div class="box-input-checkbox">
                        <input class="inp-cbx" name="checkData" id="cx-sign-up"  value="1" type="checkbox"
                            style="display: none;" />
                        <label class="cbx" for="cx-sign-up"><span>
                                <svg width="12px" height="10px" viewbox="0 0 12 10">
                                    <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                </svg></span><span><?php echo e($staticContent['Sign_up_for_newsletter']); ?></span></label>
                    </div>
                       
                        <form action="?" method="POST" >
                            <div class="mt-4" id="recap_vertify"></div>
                            <br>
                          </form>
              <input type="hidden" id="keyrecap" name="keyrecap" >
                    <button class="btn-subscribe" type="submit"><?php echo e($staticContent['Send']); ?></button>
                </div>
                
            </div>
        </div>
    </form>
  
   
        
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>


<script type="text/javascript">

        var verifyCallbackSuport = function(response) {
                $('#keyrecap').val(response);
            };
            var onloadCallbackSuport = function() {
                grecaptcha.render('recap_vertify', {
                'sitekey' : '6LdshPcUAAAAACIioRg3pa05GCUYQ9S0hVLv-4zv',
                //'sitekey' : '6LeFKfYUAAAAAL-q5mHlmjUTPQ-LvlDjNtev9QhA',
                'callback' : verifyCallbackSuport,
                'theme' : 'light'
                });
        };

        $( document ).ready(function() {
            onloadCallbackSuport();
       });
     
      function onacceptionPolicy(){
        $('#acceptcookiebot').click();
      }
  
      function validateForm(form){
        
                if(!form.prichk.checked){
                    $("#Support_policy_required").modal();
                    return false;
                }else{
                    return true;
                }
      }
  </script>

<script>
        $('select').change(function(){
             $(this).parent().attr('style','--color:'+$(this).find(':selected').data('color'));
        })
        var modelId =  <?= json_encode(session('enquireModel'));?>;
        var modeltype =  <?= json_encode(session('enquireModelType'));?>;
        var enqurieType =  <?= json_encode(session('enquireType'));?>;
        var enquireStatus =  <?= json_encode(session('enquireStatus'));?>;
        var enquireData =  <?= json_encode(session('enquireData'));?>;
       function selectType(){

            var id = $('#type_id').val();
            var t_name = $('#type_id option:selected').text();
            $('#type_name').val(t_name);
      
            $.ajax({
            url: "<?php echo e((route('searhProductByType'))); ?>",
            data: {
            'type_id': id,
           },
           type: 'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                var options = '';
                for (var i = 0; i < data['results'].length; i++) {
                    options += '<option value="' + data['results'][i].pro_code + '">' + data['results'][i].pro_code + '</option>';
                }
                // console.log(modelId);
                $("select#model_id").html(options);
                if(modelId != null &&  modelId != ''){
                    $("#model_id option[value="+"'"+modelId+"'"+"]").prop('selected', true);
                }
                $('#model_id').removeAttr("disabled");
            }

        });
            // $.each(products, function(index,pro){
               
            //     if(pro['pro_categories_id'] == id){
            //         if(index == 0){
            //         html += '<option value="'+pro['pro_code'] +'" selected>'+pro['pro_code']+'</option>';
            //         }else{
            //         html += '<option value="'+pro['pro_code'] +'">'+pro['pro_code']+'</option>';   
            //         }
            //     }
            // });
            // html += '<option value="0">Select Model</option>';
          
            // $('#model_id').html(html);
            // $('#model_id').removeAttr("disabled");
           
        } 

  

  $( document ).ready(function() {
    $('#config_id').val(enquireData);
   
    if(enqurieType != null && enqurieType == 0 && enquireStatus == 0 ){
       $('#enquireStatus').val(enquireStatus);
       $("#subjectType option[value="+enqurieType+"]").prop('selected', true);
       $("#type_id option[value="+modeltype+"]").prop('selected', true);
       selectType();
    }else if(enquireStatus == 1){
        $("#subjectType option[value="+enqurieType+"]").prop('selected', true);
        $('#enquireStatus').val(enquireStatus);
        $("#type_id option[value="+modeltype+"]").prop('selected', true);
        selectType();
    
    }
});
   function selectCountry(){
       var countryname = $('#countryemailId').val();
    //    console.log(countryname);
    if(countryname == 'United States of America' || countryname == 'Canada'){
        $.ajax({
            url: "<?php echo e((route('searhstate'))); ?>",
            data: {
            'countryname': countryname,
           },
           type: 'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                var options = '';
                options += '<option value=""><?php echo e($staticContent['Select']); ?> <?php echo e($staticContent['City_State']); ?></option>';
                for (var i = 0; i < data['results'].length; i++) {
                    options += '<option value="' + data['results'][i].name + '">' + data['results'][i].name + '</option>';
                }
                $('#box_state_con').css('display','block');
                $("select#stateId").html(options);
                $("select#stateId").attr("required", "true");
                $('#r_q_contry').text('*');
               
           
            }
        });
    }else{
      $('#box_state_con').css('display','none');
     }
 
  
   }

       <?php if(Session::has('message')): ?>
        $(document).ready(function() {
             $("#success_email_send").modal();
          });
        <?php endif; ?>
        <?php if(Session::has('messageSendPDF')): ?>
        $(document).ready(function() {
          var file =  '<?php echo e(Session::get('messageSendPDF')); ?>';
          var html = '';
              html += '<a href="<?php echo e(config('app.url')); ?>/config_history/'+file +'" target="_blank">';
              html += '<?php echo e(config('app.url')); ?>/config_history/'+file+'';
              html += '</a>';
             $('#linkdownloadconfigPdf').html(html);
             $("#sendpfdtome").modal();
             
          });
        <?php endif; ?>

        <?php if(Session::has('message_eror')): ?>
        $(document).ready(function() {
             $("#downloadgui-modal-failures").modal();
          });
        <?php endif; ?>
        <?php if(Session::has('message_eror_notvertify')): ?>
        $(document).ready(function() {
             $("#downloadgui-modal-vetify-robot").modal();
          });
        <?php endif; ?>

        <?php if(Session::has('message_eror_notValid')): ?>
        $(document).ready(function() {
             $("#Support_Frorm_required").modal();
          });
        <?php endif; ?>

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front-end', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/Deltapsu_Production/dependencies/resources/views/front-end/support.blade.php ENDPATH**/ ?>