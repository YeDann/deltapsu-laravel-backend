
<?php $__env->startSection('css'); ?>
<style>

    .tab-content>.active {
        justify-content: unset !important;
        
        display: block;
    }
    .tab-content{
        margin-top: 24px;
    }
    .search-space{
        margin-bottom: 24px;
    }
    .nav-tabs .nav-link {
        margin: -2px 32px;
    }
    .box-search-input{
        width: 270px;
    }

    @media (max-width:375px){
        .box-search-filter{
            width: 70%;
        }
        .btn-search-border{
            width: 25%;
        }
    }
    .tab-content>.active{
        margin: 0;
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
                    
                    <li class="breadcrumb-item active text-breadcrumb-home" aria-current="page"><a href="#"><?php echo e($staticContent['Partners']); ?></a></li>
                    <li class="breadcrumb-item active text-breadcrumb-home" aria-current="page"><a href="<?php echo e(route('marketingResources')); ?>"><?php echo e($staticContent['Marketing_Resources']); ?></a></li>
                    <li class="breadcrumb-item active text-breadcrumb" aria-current="page"><a href="#"><?php echo e($staticContent['Marketing_Resources_Downloads']); ?></a></li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<?php 
function getDateformat($date){
       
       $eng_month_arr = array(
           "0" => "",
           "1" => "Jan",
           "2" => "Feb",
           "3" => "Mar",
           "4" => "Apr",
           "5" => "May",
           "6" => "Jun",
           "7" => "Jul",
           "8" => "Aug",
           "9" => "Sep",
           "10" => "Oct",
           "11" => "Nov",
           "12" => "Dec"
       );
       $publicDate = date_create($date);
       $pDate = explode("-", $publicDate->format('Y-n-d'));
       $datearray = [
           'm' =>  $eng_month_arr[$pDate[1]],
           'd'=>  $pDate[2],
           'y' => $pDate[0]

       ];
       return  $datearray;
}
?>
<div class="padding-top-content-breadcrumb visible-up-922"></div>
<section class="box-news pb-5">
    <div class="container">
        <h2 class="text-title-delta visible-tablets-up"><?php echo e($staticContent['Marketing_Resources_Downloads']); ?></h2>
        <h3 class="text-title-delta visible-mobile"><?php echo e($staticContent['Marketing_Resources_Downloads']); ?></h3>
        <select id="select-catalogs" onchange="selectdocumentType();" class="form-control invisible-up-922">
            <?php $__currentLoopData = $margetCate; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($cate->cate_id); ?>"><?php echo e($cate->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <div class="row">
            <div class="col-md-12">
                    <div class="nav nav-tabs d-flex justify-content-center border-b-2px visible-up-922 mb-4" id="nav-tab" role="tablist">
                        <?php $__currentLoopData = $margetCate; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a class="nav-item nav-link font-size-tab <?php echo e($loop->iteration == 1?'active':''); ?>" onclick="setdatainput(<?php echo e($cate->cate_id); ?>);" id="pop-tab<?php echo e($cate->cate_id); ?>" data-toggle="tab" href="#pop<?php echo e($cate->cate_id); ?>"
                                role="tab" aria-controls="pop<?php echo e($cate->cate_id); ?>" aria-selected="true" data-val="<?php echo e($cate->cate_id); ?>"><?php echo e($cate->name); ?>

                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                   
                       
                    </div>
                <div class="tab-content" id="nav-tabContent">
                    <?php $__currentLoopData = $margetCate; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="tab-pane fade <?php echo e($loop->iteration == 1?'show active':''); ?> " id="pop<?php echo e($cate->cate_id); ?>" role="tabpanel" aria-labelledby="pop<?php echo e($cate->cate_id); ?>-tab">
                        <form  onsubmit="searchmarketingbycate()">
                        <div class="search-space d-flex justify-content-center w-100">
                            <div class="box-search-input  mr-3">
                           
                                <div class="box-search-icon">
                                    <img src="<?php echo e(asset('frontend-asset/image/search-filters-icon.svg')); ?>" alt="">
                                </div>
                                <label for="searchinput" class="searchinput-filters-input">
                                    <input type="hidden" name="cateid" value="1"  >
                                    <input type="text" name="modelname"  placeholder="<?php echo e($staticContent['Search_By_Name']); ?>">
                                </label>
                            </div>
                         
                            <button class="btn-search-border"><?php echo e($staticContent['Search']); ?></button>
                            
                        </div>
                        </form>
                        <div class="contentdatasearch"> 
                      
                        <?php $__currentLoopData = $margeting; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $marget): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($marget->cate_id == $cate->cate_id ): ?>
                        <div class="resources-download">
                            <div class="detail-download ">
                              <h5><?php echo e($marget->name); ?></h5>
                                
                                <?php
                                $date = getDateformat($marget->created_at);
                               ?>
                                <p><?php echo e($staticContent['Uploaded_on']); ?> <?php echo e($date['d'].'-'.$date['m'].'-'.$date['y']); ?> </p>
                            </div>
                        <a href="<?php echo e(config('app.url')); ?>/medias/marketing_resources/<?php echo e($marget->file); ?>" download="<?php echo e($marget->name); ?>">
                            <button class="btn-downlode"><?php echo e($staticContent['Downloads']); ?></button>
                            </a>
                        </div>
                        <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </div>
                       
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                 
                </div>
            </div>
        </div>
    </div>
</section>


<?php $__env->stopSection(); ?>


<?php $__env->startSection('js'); ?>

<script>
      function selectdocumentType(){
        var typetab =  $('#select-catalogs').val();
        $('#pop-tab'+typetab).click();
       
      }
      function setdatainput(cateid){
        $("input[name=cateid]").val(cateid);
      }
      var margeting = <?= json_encode($margeting);?>;
      function searchmarketingbycate(){
        var modelname = $("input[name=modelname]").val();
        var cateid = $("input[name=cateid]").val();

        event.preventDefault();
        console.log(cateid);
        var resultsearch  = [];
        var term = modelname; // search term (regex pattern)
        var search = new RegExp(term , 'i'); // prepare a regex object     
            margeting.filter(function(data){
            if(search.test(data.name)){
                var index = resultsearch.findIndex(function(x){
                  return  x.id === data.id;
                })
                if(data.cate_id == cateid ){
                    if(index == -1){
                        resultsearch.push(data);  
                    }
                }
                  
            }
           });


        var html = '';
        $.each(resultsearch, function(index,value){
            html += '<div class="resources-download">';
            html += '<div class="detail-download ">';
            html +=  '<h5>'+value['name']+'</h5>';
            html += '<p><?php echo e($staticContent['Uploaded_on']); ?> 13-Mar-2019 </p>';
            html += '</div>';
            html += '<a href="<?php echo e(config('app.url')); ?>/medias/marketing_resources/'+value['file']+'">';
            html += '<button class="btn-downlode">DOWNLOAD</button>';
            html += '</a>';
            html += '</div>'
        });
        $('.contentdatasearch').html(html);
          
      }
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.front-end', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/deltaPSU/dependencies/resources/views/front-end/marketing-resources-downloads.blade.php ENDPATH**/ ?>