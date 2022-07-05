<?php $__env->startSection('css'); ?>
<style>

.select-minimize {
        width: 350px;
    }
    #nav-tab a {
        
    
        width: 15%;
    }
    .nav-tabs .nav-link {
        margin: 0;
    }
    .font-size-tab {
    font-size: 14px !important;
    color: #000;
    }
    .tab-content>.active {
    display: block;
}
</style>
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
                                <li><a href="<?php echo e(route('index','technical-articles')); ?>"><?php echo e($staticContent['Technical_Articles']); ?></a></li>
                              </ul>   
                    </li>
                    <li class="breadcrumb-item active text-breadcrumb" aria-current="page"><a href="#"><?php echo e($staticContent['Technical_Articles']); ?></a></li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="padding-top-content-breadcrumb visible-up-922"></div>
<section class="box-news ">
    <div class="container">
        <h2 class="text-title-delta "><?php echo e($staticContent['Technical_Articles']); ?></h2>
        <select id="select-news" onchange="selectDatanews();" class="form-control invisible-up-922 mb-4">
            <option value="0"><?php echo e($staticContent['All']); ?></option>
            <?php $__currentLoopData = $news_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($type->id); ?>"><?php echo e($type->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
        </select>
        <div class="row">
            <div class="col-md-12 ">
                <div class=" nav nav-tabs d-flex justify-content-between border-b-2px visible-up-922 mb-5" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link font-size-tab active" onclick="clicktabFist(0);" id="pop0-tab" data-toggle="tab" href="#pop0"
                            role="tab" aria-controls="pop0" aria-selected="true" data-val="0"><?php echo e($staticContent['All']); ?></a>
                        <?php $__currentLoopData = $news_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a class="nav-item nav-link font-size-tab" onclick="clicktab(<?php echo e($type->id); ?>);" id="pop<?php echo e($type->id); ?>-tab" data-toggle="tab" href="#pop<?php echo e($type->id); ?>"
                        role="tab" aria-controls="pop<?php echo e($type->id); ?>"  aria-selected="true" data-val="0"><?php echo e($type->name); ?></a>  
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>
                <div class="tab-content add-space-mobile mb-5" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="pop0" role="tabpanel" aria-labelledby="pop0-tab">
                        <div class="grid-news" id="contentByType0">
                        </div>
                        <div class="text-center mt-5"id="loadMore0" style="" onclick="loadeMore(event,0)">
                            <div class="btn btn-boxen"><?php echo e($staticContent['See_More']); ?></div>
                            </div>
                    </div>
                    <?php $__currentLoopData = $news_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="tab-pane fade" id="pop<?php echo e($type->id); ?>" role="tabpanel" aria-labelledby="pop<?php echo e($type->id); ?>-tab">
                        <div class="grid-news" id="contentByType<?php echo e($type->id); ?>">
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
        //   console.log(id);
        console.log(id);
          var html = '';
          $.each(news, function(index,val){
             if(val['typeId'] == id){
              html += ' <div class="grid-list-news blogBox moreBox "style="display:none">';
              html += ' <div class="card">'
              html += ' <div class="post-image">'
              html +=  ' <img src="<?php echo e(config('app.url')); ?>/uploads_delta/'+val['thumb']+'" alt=""';
              html +=   'class="img-responsive">';
              html +=   ' </div>';
              html +=    '<div class="news-content">';
              html +=    '<div class="post-meta">';
              html +=    '<span class="sub-news company text-uppercase">';
              html +=   '  <a href="#">';
              html +=  val['cateName'];
              html +=  '</a>';
              html +=  '</span>';
              html += ' <img class="line-symbol"src="<?php echo e(asset('/frontend-asset/image/line-symbol.svg')); ?>" alt="">';
              html +=  '<span class="date">';
              html +=  '<div>';
              if(val['date_info'] == null){
                html +=  '' ;
              }else{
                html +=  formatedate(val['date_info']) ;
              }
              html +=  '</div>';
              html +=  '</span>';
              html +=  ' </div>';
              html +=  '<h3 class="post-header title-new">';
              html +=   val['title'];  
              html +=  '</h3>'
              html +=  '<p>'+ val['description'].replace(/(<([^>]+)>)/ig,"").substr(0 ,90) +'<p>';
              html +=  '</div>';
              html +=  '<a href="<?php echo e(route('updateTechnicalDetail')); ?>/'+val['slug']+'"class="read-more"><?php echo e($staticContent['Read_More']); ?></a>';
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
              html += ' <div class="grid-list-news blogBox moreBox "style="display:none">';
              html += ' <div class="card">'
              html += ' <div class="post-image">'
              html +=  ' <img src="<?php echo e(config('app.url')); ?>/uploads_delta/'+val['thumb']+'" alt=""';
              html +=   'class="img-responsive">';
              html +=   ' </div>';
              html +=    '<div class="news-content">';
              html +=    '<div class="post-meta">';
              html +=    '<span class="sub-news company text-uppercase">';
              html +=   '  <a href="#">';
              html +=  val['cateName'];
              html +=  '</a>';
              html +=  '</span>';
              html += ' <img class="line-symbol"src="<?php echo e(asset('/frontend-asset/image/line-symbol.svg')); ?>" alt="">';
              html +=  '<span class="date">';
              html +=  '<div>';
                if(val['date_info'] == null){
                html +=  '' ;
              }else{
                html +=  formatedate(val['date_info']) ;
              }
              html +=  '</div>';
              html +=  '</span>';
              html +=  ' </div>';
              html +=  '<h3 class="post-header title-new">';
              html +=   val['title'];  
              html +=  '</h3>'
              html +=  '<p>'+ val['description'].replace(/(<([^>]+)>)/ig,"").substr(0 ,90) +'<p>';
              html +=  '</div>';
              html +=  '<a href="<?php echo e(route('updateTechnicalDetail')); ?>/'+val['slug']+'"class="read-more"><?php echo e($staticContent['Read_More']); ?></a>';
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
  
      $("#pop"+i+" .moreBox:hidden").slice(0, 3).slideDown();
      if ($("#pop"+i+" .moreBox:hidden").length == 0) {
        $("#loadMore"+i).fadeOut('hide');
      }
  }
       
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.front-end', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/Deltapsu_Production/dependencies/resources/views/front-end/technical.blade.php ENDPATH**/ ?>