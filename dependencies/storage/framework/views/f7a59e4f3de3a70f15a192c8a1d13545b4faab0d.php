<?php $__env->startSection('css'); ?>
<style>

    .nav-tabs .nav-link {
        margin: -2px 20px;
    }
    .tab-content>.active {
        display: block;
    }
    a.btn:hover{
        color: #444444;
    }
    .btn.focus, .btn:focus {
    outline: 0;
    box-shadow: unset;
    }
    .select-minimize {
        width: 170px;
    }
    #select-news option{
        text-transform: capitalize;
    }
    #select-news{
        text-transform: capitalize;
    }
    .bg-new-alert{
        background-color: #76B900;
        /*padding: 4px 8px;*/
        border-radius: 50%;
        color: #fff;
       /* margin-top: -25px;
        margin-left: 20px;*/
        right: -16px;
        top: -16px;
        position: absolute;
        display: block;
        width: 24px;
        height: 24px;
        text-align: center;
        font-size: 12px;
        padding-top: 2px;
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
                            href="#" data-toggle="dropdown" id="tools-dropdown"><?php echo e($staticContent['Updates']); ?></a>
                            <ul class="dropdown-menu">
                                <li><a href="#" id="tools-dropdown" class="text-bold"><?php echo e($staticContent['Updates']); ?></a></li>
                                <hr>
                                <li><a href="<?php echo e(route('index','news')); ?>"><?php echo e($staticContent['Product_News']); ?></a></li>
                                <li><a href="<?php echo e(route('index','events')); ?>"><?php echo e($staticContent['Events']); ?></a></li>
                                
                              </ul>   
                    </li>
                    <li class="breadcrumb-item active text-breadcrumb" aria-current="page"><a href="#"><?php echo e($staticContent['Product_News']); ?></a></li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="padding-top-content-breadcrumb visible-up-922"></div>
<section class="box-news ">
    <div class="container">
        <h2 class="text-title-delta "><?php echo e($staticContent['Product_News']); ?></h2>
        <select id="select-news" onchange="selectDatanews();" class="form-control invisible-up-922 mb-4 w-75 m-auto">
            <option value="0"><?php echo e($staticContent['All']); ?></option>
            <?php $__currentLoopData = $news_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($type->id); ?>"><?php echo e($type->typename); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
        </select>
        <div class="row mt-4 mt-xl-0">
            <div class="col-md-12 ">
                <div class="nav nav-tabs d-flex justify-content-center border-b-2px visible-up-922 mb-5" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link font-size-tab active" onclick="clicktabFist(0);" id="pop0-tab" data-toggle="tab" href="#pop0"
                            role="tab" aria-controls="pop0" aria-selected="true" data-val="0"><?php echo e($staticContent['All']); ?></a>

                        <?php if(App::getLocale() == "jp"): ?>
                        <style>
                          /*For IE And Lang JP*/
                          @media  all and (-ms-high-contrast: none), (-ms-high-contrast: active) {
                            .bg-new-alert{
                              padding-top: 5px;
                            }
                          }
                        </style>
                        <?php endif; ?>
                        <?php $__currentLoopData = $news_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a class="nav-item nav-link font-size-tab position-relative" onclick="clicktab(<?php echo e($type->id); ?>);" id="pop<?php echo e($type->id); ?>-tab" data-toggle="tab" href="#pop<?php echo e($type->id); ?>"
                        role="tab" aria-controls="pop<?php echo e($type->id); ?>"  aria-selected="true" data-val="0"><?php echo e($type->typename); ?>

                        <?php if($type->typename == 'Lebensdauer' || $type->typename == 'EOL' || 
                        $type->typename == "下架产品" || $type->typename == "停產產品"
                        && $status_eol): ?><div class="bg-new-alert"><span>N</span></div><?php endif; ?>
                        </a>  
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>
                <div class="tab-content add-space-mobile mb-5" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="pop0" role="tabpanel" aria-labelledby="pop0-tab">
                        <div class="row" id="contentByType0">
                        </div>
                        <div class="text-center mt-5"id="loadMore0" style="" onclick="loadeMore(event,0)">
                            <div class="btn btn-boxen"> <?php echo e($staticContent['See_More']); ?></div>
                            </div>
                    </div>
                    <?php $__currentLoopData = $news_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="tab-pane fade" id="pop<?php echo e($type->id); ?>" role="tabpanel" aria-labelledby="pop<?php echo e($type->id); ?>-tab">
                        <div class="row" id="contentByType<?php echo e($type->id); ?>">
                        </div>
                        <div class="text-center mt-5"id="loadMore<?php echo e($type->id); ?>" style="" onclick="loadeMore(event,<?php echo e($type->id); ?>)">
                            <div class="btn btn-boxen"><?php echo e($staticContent['See_More']); ?></div>
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
        var news =  <?= json_encode($news);?>;
        $( document).ready(function () {
            clicktabFist(0);
        });
      function clicktab(id){
          var html = '';
          $.each(news, function(index,val){
             if(val['typeId'] == id){
              html += ' <div class="col-lg-4 col-md-6 blogBox moreBox mb-3"style="display:none">';
              html += ' <div class="card">'
              html +=  '<a href="<?php echo e(route('updateNewsDetail')); ?>/'+val['slug']+'">';
              html += ' <div class="post-image">'
              html += ' <img src="<?php echo e(config('app.url')); ?>/uploads_delta/'+val['thumb']+'" alt=""';
              html += 'class="img-responsive">';
              html +=  ' </div>';
              html +=  ' </a>';
              html +=  ' <div class="news-content">';
              html +=  '<div class="post-meta">';
              html +=  ' <span class="sub-news company" style="color:'+val['color_type'] +'">';
              html +=  val['cateName'];
              html +=  ' </span>';
              html +=  ' <img class="line-symbol"src="<?php echo e(asset('/frontend-asset/image/line-symbol.svg')); ?>" alt="">';
              html +=  ' <span class="date text-uppercase">';
              if(val['date_info'] == null){
                html +=  '' ;
              }else{
                html +=  formatedate(val['date_info']) ;
              }
              html +=  ' </span>';
              html +=  ' </div>';
              html +=  ' <h4 class="post-header title-new">';
             html +=  '<a href="<?php echo e(route('updateNewsDetail')); ?>/'+val['slug']+'">';
              html +=   val['title'].substr(0, 90);  
              html +=  ' </h4>';
              html +=  '</a>';
              if(val['description']!= null && val['description'] == '' ){
              html +=  ' <p>'+ val['description'].replace(/(<([^>]+)>)/ig,"").substr(0 ,90) +'<p>';
             }else{
              html  +=  '';
             }

              html +=  ' </div>';
              html +=  ' <a href="<?php echo e(route('updateNewsDetail')); ?>/'+val['slug']+'"class="read-more"><?php echo e($staticContent['Read_More']); ?></a>';
              html +=  '</div>';
              html +=  '</div> ';                       
             }
          });
          $('#contentByType'+id).html(html);
    
          $("#pop"+id+" .moreBox").slice(0, 9).show();
          loadeMore(event,id);

      }
      function formatedate(date){
        var d = new Date(date);
        const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
       "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
    ];
        return monthNames[d.getMonth()]+' '+d.getDate()+', '+d.getFullYear();
      }
      function selectDatanews(){
          var id = $('#select-news').val();
          $('#pop'+id+'-tab').click();
      }
      function clicktabFist(id){
        //   console.log(id);
          var html = '';
          $.each(news, function(index,val){
              html += ' <div class="col-lg-4 col-md-6 mb-3 blogBox moreBox "style="display:none">';
              html += ' <div class="card">'
              html +=  '<a href="<?php echo e(route('updateNewsDetail')); ?>/'+val['slug']+'">';
              html += ' <div class="post-image">'
              html += ' <img src="<?php echo e(config('app.url')); ?>/uploads_delta/'+val['thumb']+'" alt=""';
              html += 'class="img-responsive">';
              html += ' </div>';
              html += ' </a>';
              html += ' <div class="news-content">';
              html += ' <div class="post-meta">';
              html +=  ' <span class="sub-news company" style="color:'+val['color_type'] +'">';
              html +=  val['cateName'];
              html +=  ' </span>';
              html += ' <img class="line-symbol"src="<?php echo e(asset('/frontend-asset/image/line-symbol.svg')); ?>" alt="">';
              html += ' <span class="date text-uppercase">';
                if(val['date_info'] == null){
                html +=  '' ;
              }else{
                html +=  formatedate(val['date_info']) ;
              }
              html +=  '</span>';
              html +=  ' </div>';
              html +=  ' <h4 class="post-header title-new">';
              html +=  '<a href="<?php echo e(route('updateNewsDetail')); ?>/'+val['slug']+'">';
              html +=   val['title'].substr(0, 90);  
              html += '</a>';
              html +=  '</h4>';
              if(val['description']!= null && val['description'] == '' ){
              html +=  ' <p>'+ val['description'].replace(/(<([^>]+)>)/ig,"").substr(0 ,90) +'<p>';
             }else{
              html += '';
             }
              html +=  '</div>';
              html +=  ' <a href="<?php echo e(route('updateNewsDetail')); ?>/'+val['slug']+'"class="read-more"><?php echo e($staticContent['Read_More']); ?></a>';
              html +=  '</div>';
              html +=  '</div> ';                       
             
          });
          $('#contentByType0').html(html);
          $("#pop0 .moreBox").slice(0, 9).show();
          loadeMore(event,0);

      }

   function loadeMore(event,i){
    if ($("#pop"+i+" .blogBox:hidden").length != 0) {
      $("#loadMore"+i).show();
    }  
  
      $("#pop"+i+" .moreBox:hidden").slice(0, 6).slideDown();
      if ($("#pop"+i+" .moreBox:hidden").length == 0) {
        $("#loadMore"+i).fadeOut('hide');
      }
  }
       
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.front-end', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/Deltapsu_Production/dependencies/resources/views/front-end/new.blade.php ENDPATH**/ ?>