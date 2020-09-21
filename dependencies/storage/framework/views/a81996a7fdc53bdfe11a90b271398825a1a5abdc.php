<?php $__env->startSection('css'); ?>

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
    .mystoriesbtn.active{
        border: 1px solid #0087DC;
        background-color: #ffffff;
        color:#000;
    }
    .bg-color-suces{
        background-color: #F0F5FA;
        padding: 20px !important;
         position: relative;
         top: -16px;
    }
    .bg-widt{
        background-color: #F0F5FA;
        position: relative;
         top: -16px;
         width: 40px;
    }
    .wid-20{
        margin-bottom: 24px;
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
                    <li class="breadcrumb-item active text-breadcrumb-home" aria-current="page"><a href="#"> <?php echo e($staticContent['Partners']); ?></a></li>
                    <li class="breadcrumb-item active text-breadcrumb-home" aria-current="page"><a href="<?php echo e(route('marketingResources')); ?>"><?php echo e($staticContent['Marketing_Resources']); ?></a></li>
                    <li class="breadcrumb-item active text-breadcrumb" aria-current="page"><a href="#"><?php echo e($staticContent['Success_Stories']); ?></a></li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="padding-top-content-breadcrumb visible-up-922"></div>
<div class="mb-5">
    <div class="container">
        <h2 class="text-title-delta visible-up-922 title_data"><?php echo e($staticContent['Success_Stories']); ?></h2>
        <h3 class="text-title-delta invisible-up-922 title_data"><?php echo e($staticContent['Success_Stories']); ?></h3>
        <div class="visible-up-922">
            <div class="my-3">
            <a class="btn btn-subscribe mr-3" href="<?php echo e(route('addSuccessStories')); ?>">+<?php echo e($staticContent['add']); ?></a>
                <div  class="btn btn-boxen mystoriesbtn" onclick="loadMystoryContent();"><?php echo e($staticContent['My_Stories']); ?></div>
                <div  class="btn btn-boxen mystoriesbtnAll d-none" onclick="loadContent();"><?php echo e($staticContent['All_Stories']); ?> </div>
            </div>
            <table id="" class="table " cellspacing="5em" width="100%">
                <thead>
                    <tr class="headder-bg-table">
                        <th class="th-sm header-font-table text-center"><?php echo e($staticContent['Created_Date']); ?></th>
                        <th class="th-sm header-font-table text-center"><?php echo e($staticContent['Model_Name']); ?></th>
                        <th class="th-sm header-font-table text-center"><?php echo e($staticContent['Applications']); ?></th>
                        <th class="th-sm header-font-table text-center"><?php echo e($staticContent['End_Customer']); ?></th>
                        <th class="th-sm header-font-table text-center"><?php echo e($staticContent['Country']); ?></th>
                        <th class="th-sm header-font-table text-center"> <?php echo e($staticContent['Submitted']); ?></th>
                        <th class="th-sm header-font-table text-center"> </th>
                    </tr>
                </thead>
                <tbody id="contentloaddes">
                </tbody>
            </table>
            <div class="text-center mt-5"  style="" >
                <div id="loadMore" class="btn btn-boxen" onclick="loadeMore(event,4)"><?php echo e($staticContent['See_More']); ?></div>
            </div>
        </div>
        <div class="invisible-up-922">
            <div class="success-storie-btn">
                <div>
                     <a class="btn btn-subscribe mr-3" href="<?php echo e(route('addSuccessStories')); ?>">+<?php echo e($staticContent['add']); ?></a>
                     <div  class="btn btn-boxen mystoriesbtn" onclick="loadMystoryContent();"><?php echo e($staticContent['My_Stories']); ?></div>
                     <div  class="btn btn-boxen mystoriesbtnAll d-none" onclick="loadContent();"><?php echo e($staticContent['All_Stories']); ?></div>
                </div>
            </div>
        <div id="contentloadmobile">
        </div>
            <div class="text-center mt-5"  style="" >
                <div  id="loadMore_mobile" onclick="loadeMoreMobile(event,4)" class="btn btn-boxen"><?php echo e($staticContent['See_More']); ?></div>
            </div>
        </div>
    </div> 
</div>

<div id="alertImage" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">
            <input type="hidden"  id="story_id">
            <h5 class="modal-title"> <?php echo e($staticContent['Are_you_sure_to_delete_image']); ?></h5>
        </div>
        <div class="modal-footer">
            <div class="btn btn-boxen" onclick="closedeleteStory();"><?php echo e($staticContent['Cancel']); ?></div>
         <div class="btn btn-subscribe" onclick="onconfirmdeleteStories();"><?php echo e($staticContent['Delete']); ?></div>
        </div>
      </div>
    </div>
  </div>


<?php $__env->stopSection(); ?>


<?php $__env->startSection('js'); ?>

<script>
      var AllsuccessStory = <?= json_encode($AllsuccessStory);?>;
      var sectionId = <?= json_encode($sectionId);?>;
      var image_story = <?= json_encode($image_story);?>;
      
    $( document ).ready(function() {
        loadContent();
         var massage = '<?php echo e(isset($flash_message)); ?>';
         console.log(massage);
    });

    function onconfirmdeleteStories(){
        var id = $('#story_id').val();
        $.ajax({
           url: "<?php echo e(route('deleteSucessStory')); ?>",
           data: {
          'story_id': id,
           },
           type: 'POST',
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
           success: function (res) {
            console.log(res);
            if(res.status == 1){
               $('#alertImage').hide();
                location.reload();
            }
           }
           });

   }
   function deletestory(id){
       $('#story_id').val(id);
       $('#alertImage').show();
       
   }
   function closedeleteStory(){
    $('#story_id').val('');
    $('#alertImage').hide();
   }

    function loadContent(){
        var html = '';
        var htmlmobile = '';
        $('.mystoriesbtn').removeClass('active');
        $('.mystoriesbtn').removeClass('d-none');
        $('.mystoriesbtnAll').addClass('d-none');
        $('.title_data').text('<?php echo e($staticContent['All']); ?> <?php echo e($staticContent['Success_Stories']); ?>');
        $.each(AllsuccessStory, function(index,story){
            if(story['status'] == 1){
             html +='<tr class="box-cardlist row_table moreBox"  style="display: none;">';
             html += '<td class="text-middle-td">'+story['created_at']+'</td>';
             html +=  '<td class="text-middle-td"><h5 class="text-color-delta  m-0">'+story['modelname']+'</h5></td>';
             html += ' <td class="text-middle-td">'+story['application']+'</td>';
             html +=  '<td class="text-middle-td">'+story['endCustomer']+'</td>';
             html += ' <td class="text-middle-td">'+story['country']+'</td>';
             html +=  '<td class="text-middle-td">';
             html += '<i class="fa fa-check-circle icon-check"></i>';
             html += '</td>';
             html += '<td class="text-middle-td"><button id="btn_view'+story['id']+'" onclick="checkcolapes('+story['id']+');"  class="btn btn-ft w-100" type="button"  data-toggle="collapse" data-target="#collapseExample'+story['id']+'" aria-expanded="false" aria-controls="collapseExample" ><?php echo e($staticContent['View']); ?></button ></td>';
             html += '</tr>';
             html +='<tr class="collapse"  id="collapseExample'+story['id']+'">';
             html +='<td class=" bg-color-suces" colspan="7">';  
             html += '<div>';
             html += story['message'];
             html += '</div>';
             html += '<div class="row">';
             $.each(image_story, function(index2,img){
             if(img['fk_story_id'] == story['id'] ){
             html += '<img class="wid-20 col-3" src="<?php echo e(config('app.url')); ?>/medias/marketing_resources/'+img['image']+'">';
             }
             });
             html += '</div>';
             html +='</tr>';
          

            htmlmobile += '<div class="success-stories-list moreBox_mobile"  style="display: none;">';
            htmlmobile += '<h4 class="text-color-delta">'+story['modelname']+' </h4>';
            htmlmobile += '<div class="row add-space-mobile">';
            htmlmobile += '<div class="col-6 zero-padding-column-mobile">';
            htmlmobile += '<h6 class="text-color-delta"><?php echo e($staticContent['Created_Date']); ?></h6>';
            htmlmobile += '<p class="text-one">'+story['created_at']+'</p>';
            htmlmobile += '<h6 class="text-color-delta"><?php echo e($staticContent['End_Customer']); ?></h6>';
            htmlmobile += '<p class="text-one">'+story['endCustomer']+'</p>';
            htmlmobile += '</div>';
            htmlmobile += '<div class="col-6">';
            htmlmobile +=   '<h6 class="text-color-delta"><?php echo e($staticContent['Applications']); ?></h6>';
            htmlmobile += ' <p class="text-one">'+story['application']+'</p>';
            htmlmobile += ' <h6 class="text-color-delta"><?php echo e($staticContent['Country']); ?></h6>';
            htmlmobile +=  '<p class="text-one">'+story['country']+'</p>';
            htmlmobile +=  ' </div>';
            htmlmobile +=  ' </div>';
            htmlmobile +=  '<div>';
            htmlmobile +=   '<h6 class="text-color-delta"><?php echo e($staticContent['Submitted']); ?> </h6>';
            htmlmobile +=   ' <p class="text-one"><i class="fa fa-check-circle icon-check"></i></p>';
            htmlmobile +=  ' </div>';
            htmlmobile += ' <div class="btn btn-subscribe mt-2 w-100"><?php echo e($staticContent['View']); ?></div>';
            htmlmobile +=   '</div>';
            }

        });

        $('#contentloaddes').html(html);
        $('#contentloadmobile').html(htmlmobile);
        $(".moreBox").slice(0, 4).show();
        $(".moreBox_mobile").slice(0, 4).show();
    }
    function checkcolapes(id){
        var check = $('#collapseExample'+id).hasClass('show');
        console.log(check);
        if(check == true){
            $('#btn_view'+id).text('<?php echo e($staticContent['View']); ?>');
        }else{
            $('#btn_view'+id).text('Collapse');
        }
        
    }

    function loadMystoryContent(){

        var html = '';
        var htmlmobile = '';
        $('.mystoriesbtn').addClass('active');
        $('.mystoriesbtn').addClass('d-none');
        $('.mystoriesbtnAll').removeClass('d-none');
        $('.title_data').text('<?php echo e($staticContent['My_Success_Stories']); ?>');
        $.each(AllsuccessStory, function(index,story){
            if(sectionId == story['user_id']){
             html +='<tr class="box-cardlist row_table moreBox"  style="display: none;">';
             html += '<td class="text-middle-td">'+story['created_at']+'</td>';
             html +=  '<td class="text-middle-td"><h5 class="text-color-delta  m-0">'+story['modelname']+'</h5></td>';
             html += ' <td class="text-middle-td">'+story['application']+'</td>';
             html +=  '<td class="text-middle-td">'+story['endCustomer']+'</td>';
             html += ' <td class="text-middle-td">'+story['country']+'</td>';
             html +=  '<td class="text-middle-td">';
             if(story['status'] == 1){
                html += '<i class="fa fa-check-circle icon-check"></i>';
             }else{
                html += '';
             }
             html += '</td>';
             html += '<td class="text-middle-td"><button id="btn_view'+story['id']+'" onclick="checkcolapes('+story['id']+');"  class="btn btn-ft w-100" type="button"  data-toggle="collapse" data-target="#collapseExample'+story['id']+'" aria-expanded="false" aria-controls="collapseExample" ><?php echo e($staticContent['View']); ?></button ></td>';
             html += '</tr>';
             html +='<tr class="collapse"  id="collapseExample'+story['id']+'">';
             html +='<td class=" bg-color-suces" colspan="6">';  
             html += '<div>';
             html += story['message'];
             html += '</div>';
             html += '<div class="row">';
             $.each(image_story, function(index2,img){
             if(img['fk_story_id'] == story['id'] ){
             html += '<img class="wid-20 col-3" src="<?php echo e(config('app.url')); ?>/medias/marketing_resources/'+img['image']+'">';
             }
             });
             html += '</div>';
             html +='</td>';
             html +='<td class="bg-widt">';  
                if(story['status'] == 1){
                html += '';
               }else{
                html += '<a href="<?php echo e(route('editSuccessStories')); ?>/'+story['id'] +'" class="btn btn-subscribe mb-2">'+'<?php echo e($staticContent['edit']); ?>'+'</a>';
                html += '<div onclick="deletestory('+story['id'] +');" class="btn btn-boxen">'+'<?php echo e($staticContent['Delete']); ?>'+'</div>';
               }
             html +='</td>';
             html +='</tr>';
       
            htmlmobile += '<div class="success-stories-list moreBox_mobile"  style="display: none;">';
            htmlmobile += '<h4 class="text-color-delta">'+story['modelname']+' </h4>';
            htmlmobile += '<div class="row add-space-mobile">';
            htmlmobile += '<div class="col-6 zero-padding-column-mobile">';
            htmlmobile += '<h6 class="text-color-delta"><?php echo e($staticContent['Created_Date']); ?></h6>';
            htmlmobile += '<p class="text-one">'+story['created_at']+'</p>';
            htmlmobile += '<h6 class="text-color-delta"><?php echo e($staticContent['End_Customer']); ?></h6>';
            htmlmobile += '<p class="text-one">'+story['endCustomer']+'</p>';
            htmlmobile += '</div>';
            htmlmobile += '<div class="col-6">';
            htmlmobile +=   '<h6 class="text-color-delta"><?php echo e($staticContent['Applications']); ?></h6>';
            htmlmobile += ' <p class="text-one">'+story['application']+'</p>';
            htmlmobile += ' <h6 class="text-color-delta"><?php echo e($staticContent['Country']); ?></h6>';
            htmlmobile +=  '<p class="text-one">'+story['country']+'</p>';
            htmlmobile +=  ' </div>';
            htmlmobile +=  ' </div>';
            htmlmobile +=  '<div>';
            htmlmobile +=   '<h6 class="text-color-delta"><?php echo e($staticContent['Submitted']); ?> </h6>';
            htmlmobile +=   ' <p class="text-one"><i class="fa fa-check-circle icon-check"></i></p>';
            htmlmobile +=  ' </div>';
            htmlmobile += ' <div class="btn btn-subscribe mt-2 w-100"><?php echo e($staticContent['View']); ?></div>';
            htmlmobile +=   '</div>';


        }

        });

        $('#contentloaddes').html(html);
        $('#contentloadmobile').html(htmlmobile);
        $(".moreBox").slice(0, 4).show();
        $(".moreBox_mobile").slice(0, 4).show();
    }

    function loadeMore(event,i){
    if ($(".moreBox:hidden").length != 0) {
      $("#loadMore").show();
    }  
      event.preventDefault();
     
      $(".moreBox:hidden").slice(0, 4).slideDown();
      if ($(".moreBox:hidden").length == 0) {
        $("#loadMore").fadeOut('hide');
      }
  }
  function loadeMoreMobile(event,i){
    if ($(".moreBox_mobile:hidden").length != 0) {
      $("#loadMore_mobile").show();
    }  
      event.preventDefault();
     
      $(".moreBox_mobile:hidden").slice(0, 4).slideDown();
      if ($(".moreBox_mobile:hidden").length == 0) {
        $("#loadMore_mobile").fadeOut('hide');
      }
  }


  

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.front-end', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Deltapsu_Production\dependencies\resources\views\front-end\success-stories.blade.php ENDPATH**/ ?>