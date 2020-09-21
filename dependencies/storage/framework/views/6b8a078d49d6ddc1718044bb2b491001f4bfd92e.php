
<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('/frontend-asset/css/vanilla-calendar-min.css')); ?>" >
<style>
    table {
        border-collapse: unset;
        border-spacing: 0px 16px;
    }
    .table {
        margin-top: -1rem;
        margin-bottom: 0;
    }
    .space-listviews {
        margin-top: 4px;
    }
    .table thead th{
        vertical-align: middle !important;
    }


    tbody td {
        border-top: 2px solid transparent !important;
        border-bottom: 2px solid #E3EFF8;
    }
    

    .text-middle-td{
        padding: 1rem !important;
    }
    .table td, .table th {
        padding: unset;
    }
    .table th{
        padding: 3px 10px !important;
    }
    .list-group{
        margin-top: 20px;
    }
   .select-minimize {
    width: 60px !important;
   }
    .box-news-detail{
        border: 2px solid #E3EFF8;
        padding: 24px;
    }
    /* tab */
    .calendar-month-tab input { 
        display: none; 
    }   /* hide radio buttons */
    input + label { 
       /*  display: inline-block ; */
       margin-bottom: -2px;
       cursor: pointer;
    }   /* show labels in line */
    .calendar-month-tab{
        border-bottom: 2px solid #E3EFF8;
        margin-bottom: 1em;
        display: flex;
        justify-content: space-around;
    }
    input:checked+label {
        border-bottom: 2px solid #0087DC;
    }
    #next-year::before,#last-year::before{
        position: absolute;
        bottom: -8px;
        font-family: 'FontAwesome';
        color: #0087DC;
        font-size: 24px;
        cursor: pointer;
    }
    #next-year::before{
        left: 0;
        content: "\f054";
        margin-left: 24px;
    }
    #last-year::before{
        right: 0;
        content: "\f053";
        margin-right: 24px;
    }
    .calendar-year-tab a{
        height: 24px;
        position: relative;
    }
    .calendar-year-tab a:hover{
        text-decoration: none;
    }
    .scrollbar {
        overflow-y: scroll;
        height: 278px;
    }
    .img-event-slide{
        height: 160px;
    }
    .event-content-text  .post-meta{
        font-size: 12px;
    }
    .read-more-slide{
        font-size: 12px;
        font-weight: bold;
        color: #5F5F5F;
    }
    .read-more-slide:hover {
    text-decoration: none !important;
    }
    .success-stories-list{
        padding-right: 2rem;
        padding-left: 2rem;
        padding-bottom: 1.5rem;
        padding-top: 1.5rem;
        border-bottom: 2px solid#E3EFF8;

    }
    .btn-upload-image{
        color: #0087DC;
        border: 2px solid #0087DC;
        border-radius: 5px;
        height: 40;
        width: 160;
        padding: 0.5rem .75rem;
        text-align: center;
        cursor: pointer;
        margin: 0;
    }
    .img-input{
        height: 80px;

    }
    .box-list-input{
        width: 100%;
        display: flex;
        justify-content: space-between;
        background: #F0F5FA;
        padding: 1rem;
        margin-bottom: 1rem;
       /*  height: 250px; */

    }
    .box-image-input{
        width: 50%;
        padding: 0.5rem .75rem;
        border: 1px solid #D6E9F6;
        display: flex;
        justify-content: space-between;
    }
    #text-no{
        width: 250px;
    }
    .form-control.error{
    border: 1px solid red;
    }
    .text-area.error{
        border: 1px solid red;
    } 
    .form-control.green{
        border: 1px solid green;
    }
    .text-area.green{
        border: 1px solid green;
    } 
    .text-a-link{
        color: #0087DC;
        font-weight: bold;
    }
    .btn-ft{
        cursor: pointer;
    }
    .select2-selection__choice{
        font-size: 14px;
    }
    .select2-container--default .select2-search--inline .select2-search__field {   
    font-size: 14px !important;
   }
   .select2-container {
    width: 100% !important;
   }
   .select2-container--default .select2-selection--multiple {
    border-radius: 0px!important;
   }
</style>
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('container'); ?>
<?php $__env->startSection('meta'); ?>
<title>deltaPSU</title>
<meta name="description" content="deltaPSU ,edit Success Stories">
<meta name="keywords" content="deltaPSU">
<?php $__env->stopSection(); ?>
<div class="padding-top-content">
</div>
<div class="products-index-nav visible-up-922">
    <div class="bg-bredcrumb">
        <div class="container">
            <nav aria-label="breadcrumb" id="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item text-breadcrumb-home"><a href="<?php echo e(route('index','home')); ?>"><?php echo e($staticContent['Home']); ?></a></li>
                    <li class="breadcrumb-item active text-breadcrumb-home" aria-current="page"><a href="#"> <?php echo e($staticContent['Partners']); ?></a></li>
                    <li class="breadcrumb-item active text-breadcrumb-home" aria-current="page"><a href="<?php echo e(route('marketingResources')); ?>"><?php echo e($staticContent['Marketing_Resources']); ?></a></li>
                    <li class="breadcrumb-item active text-breadcrumb-home" aria-current="page"><a href="<?php echo e(route('successStories')); ?>"><?php echo e($staticContent['Success_Stories']); ?></a></li>
                    <li class="breadcrumb-item active text-breadcrumb" aria-current="page"><a href="#"><?php echo e($staticContent['add']); ?></a></li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="padding-top-content-breadcrumb visible-up-922"></div>
<div class="mb-5">
  
    <div class="container">
        <form id="form-success-story" action="<?php echo e(route('SaveSuccesStories')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo e(csrf_field()); ?>

        <h2 class="text-title-delta visible-up-922"><?php echo e($staticContent['add']); ?> <?php echo e($staticContent['Success_Stories']); ?></h2>
        <h3 class="text-title-delta invisible-up-922"><?php echo e($staticContent['add']); ?><?php echo e($staticContent['Success_Stories']); ?></h3>
        <div class="row">
            <input type="hidden" id="story_id_top" name="story_id_main">
            <input type="hidden" name="status" id="status_save">
            <div class="col-lg-6 col-md-12 input-label w-100 mb-4">
                <label class="text-title-detail-dark"> <?php echo e($staticContent['Model']); ?> <span class="red">*</span></label>
                
                <select class="js-example-basic-multiple form-control" name="model[]" onchange="selectModel();" id="model" multiple="multiple"  required>
                    <option></option>
                   <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                   <option value="<?php echo e($item->pro_code); ?>"><?php echo e($item->pro_code); ?></option>    
                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>

                
            </div>
            
            <div class="col-lg-6 col-md-12 input-label w-100 mb-4">
                <label class="text-title-detail-dark"><?php echo e($staticContent['Applications']); ?><span class="red">*</span></label>
              
                <input type="text" onkeyup="keycheck();" class="form-control" name="application"  id="application" placeholder="Enter application "  required>
            </div>
        </div>
        <div class="row  ">
            <div class="col-lg-6 col-md-12 input-label w-100 mb-4">
                <label class="text-title-detail-dark"><?php echo e($staticContent['End_Customer']); ?><span class="red">*</span></label>
                <input type="text" onkeyup="keycheck();" class="form-control" name="endCustomer"   id="endCustomer" placeholder="<?php echo e($staticContent['End_Customer']); ?>" required> 
                
            </div>
          
            <div class="col-lg-6 col-md-12 input-label w-100 mb-4">
                <label class="text-title-detail-dark"><?php echo e($staticContent['Country']); ?><span class="red">*</span></label>
                    <select name="country" onchange="keycontry()"   class="form-control" id="country" required >
                          <?php $__currentLoopData = $countryemails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $email): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($email->country); ?>"><?php echo e($email->country); ?></option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>

            </div>
        </div>
        <div class="row ">
            <div class="col-12">
                <label class="text-title-detail-dark"><?php echo e($staticContent['Message']); ?><span class="red">*</span></label>
                <div class="input-label">
                    <textarea name="message" onkeyup="keycheck();" id="message" class="w-100 text-area"  placeholder="<?php echo e($staticContent['Message']); ?>" rows="10" style="padding: .75rem;" required></textarea>
                </div>
         
              
                  
            </div>
        
        </div>
    </form>
        <div class="row">
            <div class="col-lg-2">
                <h5 class="mt-4"><?php echo e($staticContent['Picture']); ?></h5>
                <p class="text-muted">
                    Drag and drop sections for your file uploads
                </p>
                <p style="color:red"> *.png .jpeg<p>
                        <p style="color:red">  *max size file 2 MB<p>
            </div>
            <div class="col-lg-10">
                <!-- DropzoneJS Container -->
            <form class="dropzone " id="my-awesome-dropzone"   method="post" enctype="multipart/form-data">
                <?php echo e(csrf_field()); ?>

                <input type="hidden" name="story_id"  id="story_id">
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 text-center">
                <p>By submitting this form, You understand and agree to our <a target="_blank" class="text-a-link" href="<?php echo e(route('privacyPolicy')); ?>">Privacy Policy</a>.</p>
                <button type="button" onclick="onclickSubmitform()" class="btn-subscribe mt-4"><?php echo e($staticContent['Submit']); ?></button>
            </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <button type="button" onclick="onclickSaveDraft()" class="btn btn-boxen mt-4"><?php echo e($staticContent['Save Draft']); ?></button>
                </div>
                </div>
    </div> 
</div>


<div id="modalConfirmsubmit" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><?php echo e($staticContent['Are_your_sure_to_submit']); ?></h5>
          
        </div>
        <div class="modal-body">
          <p>Clicking submit will add this to the DeltaPSU website and cannot be edited/deleted at a later time. Do you want to continue?
        </p>
        </div>
        <div class="modal-footer">
            <div class="btn btn-boxen" onclick="calcel();"><?php echo e($staticContent['Cancel']); ?></div>
         <div class="btn btn-subscribe mb-2" onclick="onsubmitContent();"><?php echo e($staticContent['Submit']); ?></div>

        </div>
      </div>
    </div>
  </div>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('js'); ?>

<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
    $('.js-example-basic-multiple').select2({
        placeholder: "Select Models",
    });
});
</script>
<script>
    var image = [];
    Dropzone.autoDiscover = false;
    var myDropzone = new Dropzone("#my-awesome-dropzone", { 
        url: "<?php echo e(route('uploadmulImagestory')); ?>"}
        );
        myDropzone.on('success', function(file, response) {
         $('#story_id').val(response.story_id);
         $('#story_id_top').val(response.story_id);
        
    
     });

   function onclickSaveDraft(){
       if($('#message').val() != '' && 
       $('#model').val() != 0 && 
       $('#application').val() != '' && 
       $('#endCustomer').val() != '' && 
       $('#country').val() != '' ){
        $('#status_save').val(0);
        $('#form-success-story').submit();
       }else{
    
          if($('#message').val() == ''){
            $('#message').addClass('error');
            }
           if($('#application').val() == ''){
            $('#application').addClass('error');
            }
            if($('#model').val() == 0){
                $('#model').addClass('error');
            }
            if($('#endCustomer').val() == ''){
                $('#endCustomer').addClass('error');
            }
            if($('#country').val() == ''){
                $('#country').addClass('error');
            }
       }
   }
   function keycheck(){
           if($('#message').val() != ''){
            $('#message').addClass('green');
            }
           if($('#application').val() != ''){
            $('#application').addClass('green');
            }
            if($('#model').val() != 0){
                $('#model').addClass('green');
            }
            if($('#endCustomer').val() != ''){
                $('#endCustomer').addClass('green');
            }
           
   }
   function calcel(){
    $('#modalConfirmsubmit').hide();
   }
   function onsubmitContent(){
        $('#status_save').val(1);
        $('#form-success-story').submit();
   }
   function onclickSubmitform(){
       if($('#message').val() != '' && 
       $('#model').val() != 0 && 
       $('#application').val() != '' && 
       $('#endCustomer').val() != '' && 
       $('#country').val() != '' ){
         $('#modalConfirmsubmit').show();
       }else{
    
          if($('#message').val() == ''){
            $('#message').addClass('error');
            }
           if($('#application').val() == ''){
            $('#application').addClass('error');
            }
            if($('#model').val() == 0){
                $('#model').addClass('error');
            }
            if($('#endCustomer').val() == ''){
                $('#endCustomer').addClass('error');
            }
            if($('#country').val() == ''){
                $('#country').addClass('error');
            }
       }
    
   }
   function keycontry(){
             if($('#country').val() == ''){
                $('#country').addClass('green');
            }
   }

   function selectModel(){
        if($('#model').val() != 0){
        $('#model').addClass('green');
        }
   }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.front-end', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/deltaPSU/dependencies/resources/views/front-end/add-success-stories.blade.php ENDPATH**/ ?>