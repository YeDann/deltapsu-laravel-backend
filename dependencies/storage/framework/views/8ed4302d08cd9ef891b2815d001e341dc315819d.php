<?php $__env->startSection('css'); ?>
<style>

    .faqs-list{
        color: #0087DC;
        font-size: 16px;
    }
    a.btn:hover {
        color: #ffffff;
    }
    .text-editor img{
         max-width: 100%;
     }
     .text-editor b{
        font-weight: bold;
     }
     .faqs-type .faqs-list:after {
        font-family: 'Material-Design-Iconic-Font';
        content: "";
        float: right;
        font-size: 24px;
        color: #444444;
        position: absolute;
        top: 50%;
        right: 0;
        transform: translate(-50%, -50%);
   }

.faqs-list a:hover p {
    color: #0087DC;
    text-decoration: underline;
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
                    <li class="breadcrumb-item active text-breadcrumb" aria-current="page"><a href="#"><?php echo e($staticContent['FAQs']); ?></a></li>

                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="padding-top-content-breadcrumb visible-up-922"></div>
<div class="box-faqs pb-5">
    <div class="container">
        <h2 class="text-title-delta visible-tablets-up"><?php echo e($staticContent['FAQs']); ?></h2>
        <h3 class="text-title-delta visible-mobile"><?php echo e($staticContent['FAQs']); ?></h3>
        <div class="in-div-center">
            <div class="mb-5">
                <select id="catefaqId" class="form-control" onchange="selectCategories();">
                    <option value="0"><?php echo e($staticContent['All_Categories']); ?></option>
                    <?php $__currentLoopData = $faq_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($item->cate_id); ?>"><?php echo e($item->name); ?></option> 
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>
        <div id="faqs" class="faqs-type">
          
            
        </div>
    </div>
</div>
<div class="get-support" style="background: url('<?php echo e(asset('frontend-asset/image/FAQ@2x.png')); ?>');">
    <div class="container text-center">
        <h1 class="text-white visible-upper-mobile" ><?php echo e($staticContent['Still_have_question']); ?></h1>
        <h3 class="text-white visible-mobile my-3 mb-2" ><?php echo e($staticContent['Still_have_question']); ?></h3>
        <p class="text-white visible-upper-mobile my-3"></p>
        <a href="<?php echo e(route('contactSupport')); ?>" class="btn btn-subscribe"><?php echo e($staticContent['Get_Support']); ?></a>
    </div>
</div>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('js'); ?>
<script>
    var faqs = <?= json_encode($faqs);?>;
     
    $(document).ready(function () {
        filltertabFirst();
    });
    function selectCategories(){
         var catefaqId = $('#catefaqId').val();
         if(catefaqId == 0 ){
            filltertabFirst();
         }else{
            filltertab(catefaqId);   
         }
    }

     function filltertab(id){
              var  html = '';
              $.each(faqs, function(index,faq){
                if(faq['cate_id'] == id){
                html += '<div class="box-for-collap">';
                html += '<div class="faqs-list hide-box d-flex justify-content-between hover13">';
                html += '<a href="<?php echo e(route('faq_detail')); ?>/'+faq['url_name']+'">';
                html += '<p class="text-bold  m-0 p-l-18">';
                html += faq['title'];  
                html += '</p>';
                html += '</a>';
                html += '</div>';
                html +='</div>';
                }
              });

            $('#faqs').html(html);

     }

     function filltertabFirst(){
              var  html = '';
              $.each(faqs, function(index,faq){
                html += '<div class="box-for-collap">';
                html += '<div class="faqs-list   hide-box d-flex justify-content-between hover13">';
                html += '<a href="<?php echo e(route('faq_detail')); ?>/'+faq['url_name']+'">';
                html += '<p class="text-bold  m-0 p-l-18">';
                html += faq['title'];  
                html += '</p>';
                html += '</a>';
                html += '</div>';
                html +='</div>';
              });

            $('#faqs').html(html);

     }

    
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front-end', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Deltapsu_Production\dependencies\resources\views/front-end/faqs.blade.php ENDPATH**/ ?>