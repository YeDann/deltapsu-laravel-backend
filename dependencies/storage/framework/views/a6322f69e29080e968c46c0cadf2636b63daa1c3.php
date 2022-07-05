<?php $__env->startSection('css'); ?>
<style>
.slick-vertical .slick-slide {
    position: relative;
    border: 1px solid rgba(0, 0, 0, 0.2);
    width: 100% !important;
    margin-bottom: 1.5rem;
}
#preview-mobile .slick-slide {
    cursor: pointer;
    border: 1px solid rgba(0, 0, 0, 0.2);
    margin-right: 1.5rem;
}
.slick-prev.slick-arrow,.slick-next.slick-arrow{
    display: flex;
    justify-content: center;
    width: 100%;
    font-size: 50px;
}

#bar-tech-specs-nav .nav-tabs .nav-link.active{
    color: #0087DC;
}
#bar-tech-specs-nav .nav-tabs .nav-link{
    color: #b2b2b2;
}
#preview .slick-list{
    height: 260px !important;
}
#preview .slick-slide img{
    display: block;
    height: 70px;
    margin: auto;
    max-width: 100%;
}
#preview .slick-slide{
    height: 70px;
    cursor: pointer;
}

#preview-mobile .slick-prev.slick-arrow,#preview-mobile .slick-next.slick-arrow{
    display: flex;
    justify-content: center;
    font-size: 50px;
    width: unset;
}
#preview-mobile .slick-list{
    margin-bottom: 1rem;
    width: 100%;
}
#preview-mobile .slick-slide {
    height: 80px;
    cursor: pointer;
    
}
#preview-mobile .slick-slider{
    z-index: 0;
}
#preview-mobile .slick-slide img{
    width: 80px !important;
    height: 80px;
    margin: auto;
}
#preview-mobile .slick-slide .play-button{
    width: unset !important;
    height: unset !important;
}

.invisible-up-922 .product-show-box{
    margin-bottom: 1rem;
    z-index: 1;
    position: relative;
    display: flex;
    height: 250px;
    width: 100%;
}
.invisible-up-922 .product-show-box img {
    width: auto;
    margin: auto;
    height: 250px;
}
.grid-column-card{
    display: grid;
    grid-template-columns: 1fr 1fr;
    grid-gap: 8px;
    padding-left: 1rem;
    padding-right: 1rem;
}
.slick-track{
    width: 100%;
}
@media (max-width:992px){
    .select-minimize {
        font-size: 12px;
        width: 120px;
    }
}

@media (max-width:320px){
    #preview-mobile .slick-prev.slick-arrow, #preview-mobile .slick-next.slick-arrow{
        font-size: 55px;
        width: 60;
    }
    .grid-column-card{
        display: grid;
        grid-template-columns: 1fr;
        grid-gap: 1rem;
    }
}
@media (max-width:500px){
  #producttype{
      padding-left: 15px;
      padding-right: 15px;
  }

}
.text-editor img{
    max-width: 100%!important;
    width:initial !important  ;
}
#select-tech{
    text-transform: capitalize;
}
.icon-app-detail-new {
    width: 190px;
    justify-content: center;
}
.icon-app-detail-new a{
    margin: 2px;
}
#select-tech{
    font-weight: bold;
}
select{
font-size: 50px;
}
.text-tag{
    color: #444444;
    cursor: pointer;
}
.text-tag:hover{
  color: #0087DC;
}
.box-doc-list{
    cursor: pointer;
}
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('meta'); ?>
<title><?php echo e(isset($product[0]['pro_code'])? $product[0]['pro_code'] :''); ?></title>
<meta name="description" content="<?php echo e($product[0]['serie_name']); ?> <?php echo e($staticContent['Series']); ?> , <?php echo e($product[0]['cate_name']); ?>">
<meta name="keywords" content="<?php echo e(isset($contents[0]->title) ? $contents[0]->title :''); ?>">
<meta property="og:title" content="<?php echo e(isset($product[0]['pro_code'])? $product[0]['pro_code'] :''); ?>" />
<meta property="og:description" content="<?php echo e($product[0]['serie_name']); ?> <?php echo e($staticContent['Series']); ?> , <?php echo e($product[0]['cate_name']); ?>" />
<meta property="og:image" content="<?php echo e(config('app.url')); ?>/upload/thumbs/<?php echo e($product[0]['picture']); ?>" />
<?php $__env->stopSection(); ?>
<?php 
    function setTextpro($pro){
                $strmodel =  str_replace("/", "@", $pro);
                return  $strmodel;
            }

?>
<?php $__env->startSection('container'); ?>
<div class="padding-top-content">
</div>
<div class="products-index-nav visible-up-922">
    <div class="bg-bredcrumb">
        <div class="container">
            <nav aria-label="breadcrumb" id="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item text-breadcrumb-home">
                        <a href="<?php echo e(route('index','home')); ?>"><?php echo e($staticContent['Home']); ?></a>
                    </li>
                    <li class="breadcrumb-item active text-breadcrumb-home" aria-current="page">
                        <a href="#"><?php echo e($staticContent['Products']); ?></a>
                    </li>
                    <li class="breadcrumb-item active text-breadcrumb-home" aria-current="page">
                        <a href="<?php echo e(route('producsList',[preg_replace('/\s+/', '-',  $product[0]['cate_name']),$product[0]['cate_id']])); ?>"><?php echo e($product[0]['cate_name']); ?></a>
                    </li>
                    <li class="breadcrumb-item active text-breadcrumb-home" aria-current="page">
                    <a href="<?php echo e(route('producsList',[preg_replace('/\s+/', '-', $product[0]['cate_name']),$product[0]['cate_id'],$product[0]['serie_name'],$product[0]['serie_id']])); ?>"><?php echo e($product[0]['serie_name']); ?> <?php echo e($staticContent['Series']); ?></a>
                    </li>
                    <li class="breadcrumb-item active text-breadcrumb-ative" aria-current="page">
                        <a href="#"><?php echo e($product[0]['pro_code']); ?></a>
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="padding-top-content-breadcrumb visible-up-922"></div>
<div class="visible-up-922">
    <div class="invisible-nav-minimize">
        <div class="add-compare-nav ">
            <div class="container">
                <div class="code-name-product">
                    <h3><?php echo e($product[0]['pro_code']); ?></h3>
                </div>
                <div class="btn-add-compare-nav">
                  <a href="<?php echo e(route('LinktoEnquiry',[$product[0]['cate_id'] , $product[0]['cate_name'],setTextpro($product[0]['pro_code']) ])); ?>">
                    <button class="btn-enquiry"><?php echo e($staticContent['Enquiry']); ?></button>
                   </a>  
                    <button class="btn-addcompare" onclick="showNavCoparison(<?php echo e($product[0]['pro_id']); ?> ,<?php echo e($product[0]['cate_id']); ?>)">+ <?php echo e($staticContent['Add_to_Compare']); ?></button>
                </div>
            </div>
        </div>
    </div>
    
    <div class="box-detail my-5">
        <div class="container">
            <div class="row">
                <div class="col-4">
                    <div class="row d-none" id="add_delayshow">
                        <div class="col-3  product-show-list" id="preview">
                        
                            <div>
                                <a onclick="clickImage('<?php echo e(config('app.url')); ?>/upload/thumbs/<?php echo e($product[0]['picture']); ?>')"
                                src="<?php echo e(config('app.url')); ?>/upload/thumbs/<?php echo e($product[0]['picture']); ?>">
                                    <img class="py-1" src="<?php echo e(config('app.url')); ?>/upload/thumbs/<?php echo e($product[0]['picture']); ?>"alt="">
                                </a>
                            </div>
                          
                             <?php $__currentLoopData = $vieo_img; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                             <?php if($item->type == 2): ?>
                             <?php 
                             $data = $item->content;    
                             $whatIWant = substr($data, strpos($data, "embed/") + 1);    
                               ?>
                             <div>
                                <a onclick="clickYoutube('<?php echo e($item->content); ?>');">
                                <img class="img-video w-100"src="https://img.youtube.com/vi/<?php echo e($whatIWant); ?>/0.jpg" alt="">
                                    <img class="play-button" src="<?php echo e(asset('frontend-asset/image/product-detail/play-button.png')); ?>" alt="">
                                </a>
                            </div>
                            <?php else: ?> 
                            <div>
                            <a onclick="clickImage('<?php echo e(config('app.url')); ?>/uploads_delta/<?php echo e($item->content); ?>')"
                            src="<?php echo e(config('app.url')); ?>/uploads_delta/<?php echo e($item->content); ?>">
                                <img class="py-1" src="<?php echo e(config('app.url')); ?>/uploads_delta/<?php echo e($item->content); ?>"alt="">
                            </a>
                           </div>
                            <?php endif; ?>
                             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          
                     
                        </div>
                        <div class="col-9 product-show-box">
                        </div>
                    </div>
                </div>
                <?php 
                  function retextdata($arr ,$unit){
                                        $arr_data = [];
                                     foreach ($arr as $dch){
                                        if($dch != null && $dch != '' && $dch != 'null'){
                                            array_push($arr_data,$dch.$unit);
                                        }
                                       
                                     }
                         return $arr_data;
                  }

                ?>
                <div class="col-8">
                    <h4 class="my-1"> <?php echo e($product[0]['cate_name']); ?></h4>
                    <h4 class="my-1"><?php echo e($product[0]['serie_name']); ?> <?php echo e($staticContent['Series']); ?></h4>
                    <h1 class="text-color-delta my-1">
                    <?php echo e($product[0]['pro_code']); ?></h1>
                    <div class="btn-detail-describe my-3">
                        <a href="<?php echo e(route('LinktoEnquiry',[$product[0]['cate_id'] , $product[0]['cate_name'],setTextpro($product[0]['pro_code']) ])); ?>">
                        <button class="btn btn-enquiry"><?php echo e($staticContent['Enquiry']); ?></button>
                        </a>
                        <button class="btn btn-addcompare" onclick="showNavCoparison(<?php echo e($product[0]['pro_id']); ?>, <?php echo e($product[0]['cate_id']); ?>)">+ <?php echo e($staticContent['Add_to_Compare']); ?></button>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 box-product-detail">
                            <h5 class="text-color-delta mb-2"><?php echo e($staticContent['Output_Voltage']); ?></h5>
                            
                          
                            <?php 
                               $datacheck1 = [
                                $product[0]['content'][1]->data_1,
                                $product[0]['content'][1]->data_2,
                                $product[0]['content'][1]->data_3,
                                $product[0]['content'][1]->data_4,
                                $product[0]['content'][1]->data_5,
                                $product[0]['content'][1]->data_6,
                                $product[0]['content'][1]->data_7,
                                $product[0]['content'][1]->data_8,
                                $product[0]['content'][1]->data_9,
                                $product[0]['content'][1]->data_10,
                                $product[0]['content'][1]->data_11,
                                $product[0]['content'][1]->data_12,
                                       ];
                        
                                $datacheck2 = [
                                 $product[0]['content'][2]->data_1,
                                 $product[0]['content'][2]->data_2,
                                 $product[0]['content'][2]->data_3,
                                 $product[0]['content'][2]->data_4,
                                 $product[0]['content'][2]->data_5,
                                 $product[0]['content'][2]->data_6,
                                 $product[0]['content'][2]->data_7,
                                 $product[0]['content'][2]->data_8,
                                 $product[0]['content'][2]->data_9,
                                 $product[0]['content'][2]->data_10,
                                 $product[0]['content'][2]->data_11,
                                 $product[0]['content'][2]->data_12,
                                        ];

                                $datacheck3 = [
                                 $product[0]['content'][0]->data_1,
                                 $product[0]['content'][0]->data_2,
                                 $product[0]['content'][0]->data_3,
                                 $product[0]['content'][0]->data_4,
                                 $product[0]['content'][0]->data_5,
                                 $product[0]['content'][0]->data_6,
                                 $product[0]['content'][0]->data_7,
                                 $product[0]['content'][0]->data_8,
                                 $product[0]['content'][0]->data_9,
                                 $product[0]['content'][0]->data_10,
                                 $product[0]['content'][0]->data_11,
                                 $product[0]['content'][0]->data_12,
                                        ];
                                        
                             ?>
                          <?php 
                              function showdata($pro , $pro2 ,$unit){
                                  $data = '';
                                  $prod_1 = 0;
                                  $prod_2 = 0;
                                      $chekc = false;
                                      if(isset($pro) && !is_null($pro) ){
                                        $prod_1 = $pro;
                                        $chekc = true;
                                      }
                                      if(isset($pro2) && !is_null($pro2) ){
                                        $prod_2 = $pro2;
                                        $chekc = true;
                                      }
                                    if($chekc == true){
                                        $data =  $prod_1.'-'.$prod_2.$unit;
                                    }
                                   
                                    return  $data;
                               } 
                      
                            ?>
                            <p class="text-one"> 
                               
                                <?php if($product[0]['content'][1]->status_input == 3): ?>
                               
                                <?php echo showdata($product[0]['content'][1]->data_1 ,$product[0]['content'][1]->data_2 ,$product[0]['content'][1]->unit_name)?>
                                <?php else: ?>
                                 <?php echo join(",",retextdata($datacheck1 , $product[0]['content'][1]->unit_name));?>
                                <?php endif; ?>
                              
                            </p>
                        
                        
                        </div>
                        <div class="col-sm-4 box-product-detail">
                        
                            <h5 class="text-color-delta mb-2"><?php echo e($staticContent['Output_Power']); ?></h5>
                            <p class="text-one"> 
                                <?php if($product[0]['content'][2]->status_input == 3): ?>
                                <?php echo $product[0]['content'][2]->data_1.'-'.$product[0]['content'][2]->data_2.$product[0]['content'][2]->unit_name?>
                                <?php else: ?>
                                 <?php echo join(",",retextdata($datacheck2 , $product[0]['content'][2]->unit_name));?>
                                <?php endif; ?>
                            </p>
                        </div>
                        <div class="col-sm-4 box-product-detail">
                            <h5 class="text-color-delta mb-2"><?php echo e($staticContent['Output_Current']); ?></h5>
                            
                       
                            <p class="text-one"> 
                           
                                <?php if($product[0]['content'][0]->status_input == 3): ?>
                             
                                <?php echo showdata($product[0]['content'][0]->data_1 ,$product[0]['content'][0]->data_2 ,$product[0]['content'][0]->unit_name)?>
                                <?php else: ?>
                                 <?php echo join(",",retextdata($datacheck3 , $product[0]['content'][0]->unit_name));?>
                                <?php endif; ?>
                            </p>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 box-product-detail">
                            <h5 class="text-color-delta mb-2"><?php echo e($staticContent['Input_Voltage']); ?></h5>
                            <p class="text-one"><?php echo $product[0]['content'][3]->value_text; ?></p>
                        </div>
                        <div class="col-sm-4 box-product-detail">
                            <h5 class="text-color-delta mb-2"> <?php echo e($staticContent['Dimensions']); ?> (<?php echo e($product[0]['unit_dimension_1']); ?> x W x <?php echo e($product[0]['unit_dimension']); ?>) </h5>
                          
                            <?php if(isset($product[0]['dimensionL']) && is_numeric($product[0]['dimensionL'])  && is_numeric($product[0]['dimensionD'])  && is_numeric($product[0]['dimensionW']) && isset($product[0]['dimensionW']) && isset($product[0]['dimensionD'])): ?>
                          <p class="text-one"><?php echo e($product[0]['dimensionL']); ?> x <?php echo e($product[0]['dimensionW']); ?> x
                              <?php echo e($product[0]['dimensionD']); ?> mm</p>
                          <p class=" text-one">
                              <?php echo e(number_format($product[0]['dimensionL']* 0.0393701 ,2)); ?>” x
                              <?php echo e(number_format($product[0]['dimensionW']* 0.0393701 ,2)); ?>” x
                              <?php echo e(number_format($product[0]['dimensionD']* 0.0393701 ,2)); ?>”</p>
                          <?php else: ?>
                          <p class="text-one"><?php echo $product[0]['dimensionL']; ?></p>
                          <?php endif; ?>
                     
                        </div>
                        <div class="col-sm-4 box-product-detail">
                            <h5 class="text-color-delta mb-2"><?php echo e($staticContent['Unit_Weight']); ?></h5>
                            <?php 
                              $sum  = 0;
                            if(isset($product[0]['unit_weight'])){
                              
                                $number = substr($product[0]['unit_weight'] , 0, -2);
                                $float = (float)$number;
                                $sum = ($float*2.2046244202);       
                                
                            }
                            ?>
                            <p class="text-one"><?php echo $product[0]['unit_weight']; ?> (<?php echo e(number_format($sum,2)); ?> lb)</p>
                          
                        </div>
                    </div>
                    <div class="row  mt-3">
                        <div class="col-8">
                            <h5 class="text-color-delta mb-2"><?php echo e($staticContent['Highlights_Features']); ?></h5>
                            <div class="text-editor">
                             <?php echo str_replace("/uploads_delta",config('app.url')."/uploads_delta",$product[0]['content_1']); ?>

                            </div>

                            <h5 class="text-color-delta mt-2">Tags </h5>
                         
                            <?php $__currentLoopData = $tags_pro; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <span onclick="viewKey('<?php echo e($tag->tag); ?>')" class="text-tag"><?php echo e($tag->tag); ?><?php echo e($loop->iteration != $loop->count?',':''); ?></span>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          
                            
                        
                        </div>
                        <div class="col-4">
                            <h5 class="text-color-delta mb-2"><?php echo e($staticContent['Applications']); ?></h5>
                             <div class="icon-app-detail-new">
                                <?php $__currentLoopData = $series_has_application; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              
                                    <a href="<?php echo e(route('applicationDetail' ,[ 'name' => preg_replace('/\s+/', '-',$item->id.'-'.$item->name)])); ?>"  data-toggle="tooltip" data-placement="top" title="<?php echo e($item->name); ?>"
                                        class="icon btn-icon-app itemhorver<?php echo e($item->id); ?>"
                                        style="background-image: url('<?php echo e(config('app.url')); ?>/medias/categories/<?php echo e($item->icon); ?>'); "></a>
                                    <script>
                                        $(".itemhorver<?php echo e($item->id); ?>").hover(function(){
                                                $(this).css("background-image", "url('<?php echo e(config('app.url')); ?>/medias/categories/<?php echo e($item->blue_outline_icon); ?>')");
                                                }, function(){
                                                $(this).css("background-image", "url('<?php echo e(config('app.url')); ?>/medias/categories/<?php echo e($item->icon); ?>')");
                                                });
                                        </script>     
                                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>   
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            
                            <div class="text-editor">
                            <?php echo $product[0]['content_2']; ?>

                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="visible-nav-minimize">
    <div class="add-compare-nav-mobile px-3">
        <div class="d-flex justify-content-between h-100">
             <div class="w-100 my-auto">
                <h6 class="m-0">
                 
                </h6>
                <h5 class="text-color-delta m-0 visible-up-320"> <?php echo e($product[0]['pro_code']); ?></h5>
                <h6 class="text-color-delta m-0 invisible-up-320"> <?php echo e($product[0]['pro_code']); ?></h6>
            </div>
            <div class="my-auto w-100 d-flex justify-content-end">
                <a class="btn btn-enquiry w-50 mr-2" href="<?php echo e(route('LinktoEnquiry',[$product[0]['cate_id'] , $product[0]['cate_name'],setTextpro($product[0]['pro_code']) ])); ?>">
                    <?php echo e($staticContent['Enquiry']); ?>

                </a>
                <button class="btn btn-addcompare w-50 " onclick="showNavCoparison(<?php echo e($product[0]['pro_id']); ?>,<?php echo e($product[0]['cate_id']); ?>)"><?php echo e($staticContent['compare']); ?></button>
            </div>
        </div>
           
        
    </div>
</div>
<div class="invisible-up-922">
    
    <div class="box-detail my-5">
        <div class="container">
            <div class="product-show-box w-100">
                
            </div>
            
            <div class="col-12 product-show-list" id="preview-mobile">
                <div>
                    <a onclick="clickImage('<?php echo e(config('app.url')); ?>/upload/thumbs/<?php echo e($product[0]['picture']); ?>')"
                    src="<?php echo e(config('app.url')); ?>/upload/thumbs/<?php echo e($product[0]['picture']); ?>">
                        <img class="p-1" src="<?php echo e(config('app.url')); ?>/upload/thumbs/<?php echo e($product[0]['picture']); ?>"alt="">
                    </a>
                </div>
               
                <?php $__currentLoopData = $vieo_img; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($item->type == 2): ?>
                <?php 
                $data = $item->content;    
                $whatIWant = substr($data, strpos($data, "embed/") + 1);    
                  ?>
                <div>
                   <a onclick="clickYoutube('<?php echo e($item->content); ?>');">
                   <img class="img-video w-100"src="https://img.youtube.com/vi/<?php echo e($whatIWant); ?>/0.jpg" alt="">
                       <img class="play-button" src="<?php echo e(asset('frontend-asset/image/product-detail/play-button.png')); ?>" alt="">
                   </a>
               </div>
               <?php else: ?> 
               <div>
               <a onclick="clickImage('<?php echo e(config('app.url')); ?>/uploads_delta/<?php echo e($item->content); ?>')"
               src="<?php echo e(config('app.url')); ?>/uploads_delta/<?php echo e($item->content); ?>">
                   <img class="p-1" src="<?php echo e(config('app.url')); ?>/uploads_delta/<?php echo e($item->content); ?>"alt="">
               </a>
              </div>
               <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                
            </div>
            <div class="my-4">
       
                <h4 class="my-1 text-center"> <?php echo e($product[0]['cate_name']); ?></h4>
                <h4 class="my-1 text-center"><?php echo e($product[0]['serie_name']); ?> <?php echo e($staticContent['Series']); ?></h4>
                <h3 class="text-color-delta my-1 text-center">   
               <?php echo e($product[0]['pro_code']); ?></h3>
            </div>
            <div class="my-4">
                <button class="btn btn-enquiry w-100 my-2"><?php echo e($staticContent['Enquiry']); ?></button>
                <button class="btn btn-addcompare w-100 my-2" onclick="showNavCoparison(<?php echo e($product[0]['pro_id']); ?> ,<?php echo e($product[0]['cate_id']); ?>)">+ <?php echo e($staticContent['Add_to_Compare']); ?></button>
            </div>
            
            <div class="box-detail">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h5 class="text-color-delta mb-2"> <?php echo e($staticContent['Highlights_Features']); ?></h5>
                            <div class="text-editor">
                            <?php echo str_replace("/uploads_delta",config('app.url')."/uploads_delta",$product[0]['content_1']); ?>

                            </div>
                            
                        </div>
                        
                    </div>
                    
                    <div class="row mt-3">
                        <div class="col-6 box-product-detail">
                            <h5 class="text-color-delta mb-2"> <?php echo e($staticContent['Output_Voltage']); ?></h5>
                            <p class="text-one">
                                <?php if($product[0]['content'][1]->status_input == 3): ?>
                            
                                <?php echo showdata($product[0]['content'][1]->data_1 ,$product[0]['content'][1]->data_2 ,$product[0]['content'][1]->unit_name)?>
                                <?php else: ?>
                                 <?php echo join(",",retextdata($datacheck1 , $product[0]['content'][1]->unit_name));?>
                                <?php endif; ?>
                            </p>
                            
                        </div>
                        <div class="col-6 box-product-detail">
                            <h5 class="text-color-delta mb-2"> <?php echo e($staticContent['Output_Power']); ?></h5>
                            

                            <p class="text-one"> 
                                <?php if($product[0]['content'][2]->status_input == 3): ?>
                                <?php echo showdata($product[0]['content'][2]->data_1 ,$product[0]['content'][2]->data_2 ,$product[0]['content'][2]->unit_name)?>
                              
                                <?php else: ?>
                                 <?php echo join(",",retextdata($datacheck2 , $product[0]['content'][2]->unit_name));?>
                                <?php endif; ?>
                            </p>
                        </div>
                        <div class="col-6 box-product-detail">
                            <h5 class="text-color-delta mb-2"> <?php echo e($staticContent['Output_Current']); ?></h5>
                            
                               
                            <p class="text-one"> 
                                <?php if($product[0]['content'][0]->status_input == 3): ?>
                                <?php echo showdata($product[0]['content'][0]->data_1 ,$product[0]['content'][0]->data_2 ,$product[0]['content'][0]->unit_name)?>
                                <?php else: ?>
                                 <?php echo join(",",retextdata($datacheck3 , $product[0]['content'][0]->unit_name));?>
                                <?php endif; ?>
                            </p>
                         
                        </div>
                        <div class="col-6 box-product-detail">
                            <h5 class="text-color-delta mb-2"><?php echo e($staticContent['Input_Voltage']); ?></h5>
                            <p class="text-one"><?php echo $product[0]['content'][3]->value_text; ?></p>
                        </div>
                        <div class="col-6 box-product-detail">
                            <h5 class="text-color-delta mb-2"> <?php echo e($staticContent['Dimensions']); ?></h5>
                            <?php if(isset($product[0]['dimensionL']) && is_numeric($product[0]['dimensionL'])  && is_numeric($product[0]['dimensionD'])  && is_numeric($product[0]['dimensionW']) && isset($product[0]['dimensionW']) && isset($product[0]['dimensionD'])): ?>
                            <p class="text-one"><?php echo e($product[0]['dimensionL']); ?> x <?php echo e($product[0]['dimensionW']); ?> x
                                <?php echo e($product[0]['dimensionD']); ?> mm</p>
                            <p class=" text-one">
                                <?php echo e(number_format($product[0]['dimensionL']* 0.0393701 ,2)); ?>” x
                                <?php echo e(number_format($product[0]['dimensionW']* 0.0393701 ,2)); ?>” x
                                <?php echo e(number_format($product[0]['dimensionD']* 0.0393701 ,2)); ?>”</p>
                            <?php else: ?>
                            <p class="text-one"><?php echo $product[0]['dimensionL']; ?></p>
                            <?php endif; ?>
                           
                        </div>
                        <div class="col-6 box-product-detail">
                            <h5 class="text-color-delta mb-2"><?php echo e($staticContent['Unit_Weight']); ?></h5>
                            <p class="text-one"><?php echo $product[0]['unit_weight']; ?> (<?php echo e(number_format($sum,2)); ?> lb)</p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center mt-3">
                        <div class="">
                            <h5 class="text-color-delta text-center"><?php echo e($staticContent['Applications']); ?></h5>
                            <div class="icon-app-detail">
                                <?php $__currentLoopData = $series_has_application; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              
                                    <a href="<?php echo e(route('applicationDetail' ,[ 'name' => preg_replace('/\s+/', '-',$item->id.'-'.$item->name)])); ?>"  data-toggle="tooltip" data-placement="top" title="<?php echo e($item->name); ?>"
                                        class="icon btn-icon-app itemhorver<?php echo e($item->id); ?>"
                                        style="background-image: url('<?php echo e(config('app.url')); ?>/medias/categories/<?php echo e($item->icon); ?>'); "></a>
                                    <script>
                                        $(".itemhorver<?php echo e($item->id); ?>").hover(function(){
                                                $(this).css("background-image", "url('<?php echo e(config('app.url')); ?>/medias/categories/<?php echo e($item->blue_outline_icon); ?>')");
                                                }, function(){
                                                $(this).css("background-image", "url('<?php echo e(config('app.url')); ?>/medias/categories/<?php echo e($item->icon); ?>')");
                                                });
                                        </script>     
                                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>   
                            </div>
                        </div>   
                    </div>
                    <div class="w-100 mb-2 mt-4">
                        <h5 class="text-color-delta mt-2"><?php echo e($staticContent['Tags']); ?></h5>
                         
                        <?php $__currentLoopData = $tags_pro; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                         <span onclick="viewKey('<?php echo e($tag->tag); ?>')" class="text-tag"><?php echo e($tag->tag); ?><?php echo e($loop->iteration != $loop->count?',':''); ?></span>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="box-doc">
    <div class="container">
        <h4 class="text-color-delta visible-up-922"><?php echo e($staticContent['Downloads']); ?></h4>
        <h3 class="text-color-delta text-center invisible-up-922"><?php echo e($staticContent['Downloads']); ?></h3>
        <div id="box-doc-type" class="box-doc-type">
            <div class="box-doc-list collapsed fliter_type hide-box" data-toggle="collapse" data-parent="#box-doc-type"
                href="#collapse-box-doc-documents">
                <a class="card-title text-sixteen-dark">
                    <?php echo e($staticContent['Downloads']); ?>

                </a>
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

            <div id="collapse-box-doc-documents" class="box-doc-list-sub collapse" data-parent="#box-doc-type">
                <div>
                    <div >
                        <?php $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($item->main_cate_id == 1): ?>
                        <?php if($item->cate_id  == 1 || $item->cate_id  == 2 ): ?>
                        <div class="data-sheet-downloade d-flex justify-content-between ">
                            <div class="detail-downlode ">
                            <p class="text-dark text-bold"><?php echo e($item->catename); ?></p>
                            <?php
                                 $date = getDateformat($item->created_at);
                             ?>
                             <p class="text-dark"><?php echo e($staticContent['Uploaded_on']); ?>   <?php echo e($date['d'] .'-'.$date['m'].'-'.$date['y']); ?>  </p>
                                
                            </div>
                            <a href="<?php echo e(route('downloadFIle',[$item->slug,setTextpro($product[0]['pro_code'])])); ?>" target="_blank">
                            <button class="btn-downlode"><?php echo e($staticContent['Downloads']); ?></button>
                            </a>
                        </div>
                        <?php endif; ?>
                        <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <div class="data-sheet-downloade d-flex justify-content-between ">
                            <div class="detail-downlode ">
                            <p class="text-dark text-bold">Image</p>
                            <?php
                                 $date2 = getDateformat($product[0]['updated_at']);
                             ?>
                             <p class="text-dark"><?php echo e($staticContent['Uploaded_on']); ?>   <?php echo e($date2['d'] .'-'.$date2['m'].'-'.$date2['y']); ?>  </p>
                            </div>

                            <a href="<?php echo e(config('app.url')); ?>/upload/thumbs/<?php echo e($product[0]['picture']); ?>" download="<?php echo e($product[0]['pro_code']); ?>">
                            <button class="btn-downlode"><?php echo e($staticContent['Downloads']); ?></button>
                            </a>
                        </div>

                        <?php $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($item->main_cate_id == 1): ?>
                        <?php if($item->cate_id  == 5 ): ?>
                        <div class="data-sheet-downloade d-flex justify-content-between ">
                            <div class="detail-downlode ">
                            <p class="text-dark text-bold"><?php echo e($item->catename); ?></p>
                            <?php
                                 $date = getDateformat($item->created_at);
                             ?>
                             <p class="text-dark"><?php echo e($staticContent['Uploaded_on']); ?>   <?php echo e($date['d'] .'-'.$date['m'].'-'.$date['y']); ?>  </p>
                                
                            </div>
                            <a href="<?php echo e(route('downloadFIle',[$item->slug,setTextpro($product[0]['pro_code'])])); ?>" target="_blank">
                            <button class="btn-downlode"><?php echo e($staticContent['Downloads']); ?></button>
                            </a>
                        </div>
                        <?php endif; ?>
                        <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <?php $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($item->main_cate_id == 1): ?>
                        <?php if($item->cate_id  != 1 && $item->cate_id  != 2 && $item->cate_id != 5 ): ?>
                        <div class="data-sheet-downloade d-flex justify-content-between ">
                            <div class="detail-downlode ">
                            <p class="text-dark text-bold"><?php echo e($item->catename); ?></p>
                            <?php
                                 $date = getDateformat($item->created_at);
                             ?>
                             <p class="text-dark"><?php echo e($staticContent['Uploaded_on']); ?>   <?php echo e($date['d'] .'-'.$date['m'].'-'.$date['y']); ?>  </p>
                                
                            </div>
                            <a href="<?php echo e(route('downloadFIle',[$item->slug,setTextpro($product[0]['pro_code'])])); ?>" target="_blank">
                            <button class="btn-downlode"><?php echo e($staticContent['Downloads']); ?></button>
                            </a>
                        </div>
                        <?php endif; ?>
                        <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
            <div class="box-doc-list collapsed fliter_type hide-box" data-toggle="collapse" data-parent="#box-doc-type"
                href="#collapse-box-doc-certificates">
                <a class="card-title text-sixteen-dark">
                    
                    <?php echo e($staticContent['Certificates']); ?>

                </a>
            </div>
            <div id="collapse-box-doc-certificates" class="box-doc-list-sub collapse" data-parent="#box-doc-type">
                <div>
                    <div>
                        <?php $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($item->main_cate_id == 2): ?>
                        <?php
                        $date2 = getDateformat($item->created_at);
                    ?>

                        <div class="data-sheet-downloade d-flex justify-content-between ">
                            <div class="detail-downlode ">
                            <p class="text-dark text-bold"><?php echo e($item->catename); ?></p>
                                <p class="text-dark"><?php echo e($staticContent['Uploaded_on']); ?>  <?php echo e($date2['d'] .'-'.$date2['m'].'-'.$date2['y']); ?>  </p>
                            </div>
                            <a href="<?php echo e(route('downloadFIle',[$item->slug,setTextpro($product[0]['pro_code'])])); ?>" target="_blank">
                            <button class="btn-downlode"><?php echo e($staticContent['Downloads']); ?></button>
                            </a>
                        </div>
                        <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                       
                    </div>
                </div>
            </div>

            <div class="box-doc-list collapsed fliter_type hide-box" data-toggle="collapse" data-parent="#box-doc-type"
            href="#collapse-box-doc-gui">
            <a class="card-title text-sixteen-dark">
                <?php echo e($staticContent['GUI_Software']); ?>

            </a>
           </div>
           <div id="collapse-box-doc-gui" class="box-doc-list-sub collapse" data-parent="#box-doc-type">
            <div>
                <div>
                    <?php $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($item->main_cate_id == 3): ?>
                    <?php
                    $date2 = getDateformat($item->created_at);
                ?>

                    <div class="data-sheet-downloade d-flex justify-content-between ">
                        <div class="detail-downlode ">
                        <p class="text-dark text-bold"><?php echo e($item->catename); ?></p>
                            <p class="text-dark"><?php echo e($staticContent['Uploaded_on']); ?>  <?php echo e($date2['d'] .'-'.$date2['m'].'-'.$date2['y']); ?>  </p>
                        </div>
                        <a data-toggle="modal" data-target="#downloadgui-modal" onclick="downloadGUI('<?php echo e($item->file); ?>','<?php echo e(setTextpro($product[0]['pro_code'])); ?>','<?php echo e($product[0]['cate_name']); ?>')" href="<?php echo e(route('downloadFIle',[$item->slug,setTextpro($product[0]['pro_code'])])); ?>" target="_blank">
                        <button class="btn-downlode"><?php echo e($staticContent['Downloads']); ?></button>
                        </a>
                    </div>
                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                   
                </div>
            </div>
        </div>



        </div>
    </div>
</div>
<div class="box-tech-specs" >
    <div class="container">
        <h4 class="text-color-delta visible-up-922"><?php echo e($staticContent['Tech_Specs']); ?></h4>
        <h3 class="text-color-delta text-center invisible-up-922"><?php echo e($staticContent['Tech_Specs']); ?></h3>
        <select id="select-tech" onchange="selectproduct();" class="form-control invisible-up-922">
            <?php $__currentLoopData = $section; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($sec->id); ?>"><?php echo e($sec->sortname); ?></option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <nav id="bar-tech-specs-nav" class="visible-up-922">
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
               <?php $__currentLoopData = $section; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a class="nav-item nav-link <?php echo e(($loop->iteration == 1) ?'active':''); ?>" onclick="popSection(<?php echo e($sec->id); ?>);" id="nav-output-tab<?php echo e($sec->id); ?>" data-toggle="tab" href="#nav-tabspec<?php echo e($sec->id); ?>" role="tab"
               aria-controls="nav-output-tab<?php echo e($sec->id); ?>" aria-selected="true" data-val="<?php echo e($sec->id); ?>"><?php echo e($sec->sortname); ?>

               </a>
               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
              
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <?php $__currentLoopData = $section; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="tab-pane fade <?php echo e($loop->iteration == 1 ?'show active':''); ?> bar-product-type-list " id="nav-tabspec<?php echo e($sec->id); ?>" role="tabpanel"
                aria-labelledby="nav-output-tab<?php echo e($sec->id); ?>">
                <a class="box-spc " data-toggle="collapse"  href="#collapse-box-spce<?php echo e($sec->id); ?>">
               
                </a>
                <div id="collapse-box-spce<?php echo e($sec->id); ?>" class="collapse show">
                <table class="table">
                    <tbody>
                        <?php $__currentLoopData = $product_has_property; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prh): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($prh->section_id == $sec->id): ?>
                        <?php 
                           $strig = '-';
                           $numberText = '' ;
                           $numberarr = [];
                           $check = false;
                           if($prh->type_value == 'number'){
                               if($prh->status_input == 3){
                                 if(!is_null($prh->data_1)  ){
                                    $numberText = $prh->data_1.'-'.$prh->data_2.$prh->unit_name;
                                    $check = true;
                                 }else{
                                    $numberText = 'test';
                                 }
                                 
                               }else{
                                   $arr_data = [];
                                      $datacheck = [
                                        $prh->data_1,
                                        $prh->data_2,
                                        $prh->data_3,
                                        $prh->data_4,
                                        $prh->data_5,
                                        $prh->data_6,
                                        $prh->data_7,
                                        $prh->data_8,
                                        $prh->data_10,
                                        $prh->data_11,
                                        $prh->data_12,
                                       ];
                                     foreach ($datacheck as $dch){
                                        if(!is_null($dch)){
                                            array_push($arr_data,$dch.$prh->unit_name);
                                        }
                                     }
                                     if(isset($arr_data) && count($arr_data) > 0){
                                        $check = true;
                                        $numberarr = $arr_data;
                                     }
                                    
                                     
                               }
                            
                           }else{
                            if($prh->value_text != null && $prh->value_text != 'null'){
                                $check = true;
                                $strig = $prh->value_text;
                            }
                           }

                        ?>
                        <tr class="<?php echo e($check?'d-block':'d-none'); ?>">
                            <td >
                                <div class="col-md-3 subject-detail "><b><?php echo e($prh->fieldCate); ?></b></div>
                                <div class="col-md-9 explain-detail ">
                                    <?php if($prh->type_value == 'number'): ?>
                                     <?php if($prh->status_input == 3): ?>
                                     <?php echo $numberText?>
                                     <?php else: ?> 
                                     <?php echo join(",",$numberarr);?>
                                     <?php endif; ?>
                                    <?php else: ?> 
                                    <?php echo $strig?>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                        <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php if($sec->id == 3): ?>
                        <tr class="">
                            <td >
                                <div class="col-md-3 subject-detail "><b><?php echo e($staticContent['Unit_Weight']); ?></b></div>
                                <div class="col-md-9 explain-detail ">
                                    <?php echo $product[0]['unit_weight']; ?> (<?php echo e(number_format($sum,2)); ?> lb)
                                </div>
                            </td>
                            <td >
                                <div class="col-md-3 subject-detail "><b><?php echo e($staticContent['Dimensions']); ?></b></div>
                                <div class="col-md-9 explain-detail ">
                                    <?php if(isset($product[0]['dimensionL']) && is_numeric($product[0]['dimensionL'])  && is_numeric($product[0]['dimensionD'])  && is_numeric($product[0]['dimensionW']) && isset($product[0]['dimensionW']) && isset($product[0]['dimensionD'])): ?>
                                    <?php echo e($product[0]['dimensionL']); ?> x <?php echo e($product[0]['dimensionW']); ?> x
                                        <?php echo e($product[0]['dimensionD']); ?> mm <br>
                              
                                        <?php echo e(number_format($product[0]['dimensionL']* 0.0393701 ,2)); ?>” x
                                        <?php echo e(number_format($product[0]['dimensionW']* 0.0393701 ,2)); ?>” x
                                        <?php echo e(number_format($product[0]['dimensionD']* 0.0393701 ,2)); ?>”
                                        <?php else: ?>
                                       <?php echo $product[0]['dimensionL']; ?>

                                        <?php endif; ?>
                                  
                                </div>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
        

        </div>
    </div>
</div>
<div class="box-lookingfor py-5" style="background: url('<?php echo e(asset('frontend-asset/image/product-detail/Help.jpg')); ?>') no-repeat; background-position: top center; background-size: cover; ">
    <div class="d-flex">
        <div class="box-lookingfor-content text-center">
            <h1 class="text-white visible-up-922"><?php echo e($staticContent['Looking_for_support_for_this']); ?></h1>
            <h2 class="text-white invisible-up-922"><?php echo e($staticContent['Looking_for_support_for_this']); ?></h2>
            
        <a href="<?php echo e(route('contactSupport')); ?>"><button class="btn-addcompare mt-3"><?php echo e($staticContent['Get_Support']); ?></button></a>
        </div>
    </div>
</div>
<div class="">
    <div class="box-related-products">
        <div class="container">
                <h2 class="text-center"><?php echo e($staticContent['Related_Products']); ?></h2>
                <div class="product-random">
                    <div class="">
                        <div id="producttype" class="owl-carousel owl-theme  ft-products-body">
                        <?php $__currentLoopData = $Otherpros; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                     
                        <div class="">
                            <div class="card">
                                <?php 
                                $color = '';
                                $name_sta = '';
                               $stat = $pro['status_product'];
                                 if($stat == 2){
                                     $color = '#76B900';
                                     $name_sta = 'NEW';
                                 }else if($stat == 3){
                                     $color = '#337ab7';
                                     $name_sta = 'UPDATED';
                                 }else if($stat == 4){
                                     $color = '#f0ad4e';
                                     $name_sta = 'EOL';
                                 }
                                 ?>
                                       <?php 
                                       $datacheck1 = [
                                        $pro['content'][1]->data_1,
                                        $pro['content'][1]->data_2,
                                        $pro['content'][1]->data_3,
                                        $pro['content'][1]->data_4,
                                        $pro['content'][1]->data_5,
                                        $pro['content'][1]->data_6,
                                        $pro['content'][1]->data_7,
                                        $pro['content'][1]->data_8,
                                        $pro['content'][1]->data_9,
                                        $pro['content'][1]->data_10,
                                        $pro['content'][1]->data_11,
                                        $pro['content'][1]->data_12,
                                               ];
                                
                                        $datacheck2 = [
                                         $pro['content'][2]->data_1,
                                         $pro['content'][2]->data_2,
                                         $pro['content'][2]->data_3,
                                         $pro['content'][2]->data_4,
                                         $pro['content'][2]->data_5,
                                         $pro['content'][2]->data_6,
                                         $pro['content'][2]->data_7,
                                         $pro['content'][2]->data_8,
                                         $pro['content'][2]->data_9,
                                         $pro['content'][2]->data_10,
                                         $pro['content'][2]->data_11,
                                         $pro['content'][2]->data_12,
                                                ];
        
                                        $datacheck3 = [
                                         $pro['content'][0]->data_1,
                                         $pro['content'][0]->data_2,
                                         $pro['content'][0]->data_3,
                                         $pro['content'][0]->data_4,
                                         $pro['content'][0]->data_5,
                                         $pro['content'][0]->data_6,
                                         $pro['content'][0]->data_7,
                                         $pro['content'][0]->data_8,
                                         $pro['content'][0]->data_9,
                                         $pro['content'][0]->data_10,
                                         $pro['content'][0]->data_11,
                                         $pro['content'][0]->data_12,
                                                ];
                                                
                                     ?>
                             <div class="new-tag" style="background-color:<?php echo e($color); ?>"><?php echo e($name_sta); ?></div>
                                    <div class="card-body ft-products-item">
                                        <a href="<?php echo e(route('productsDetailsByType' ,['catename'=> preg_replace('/\s+/', '-', $pro['catename']) ,'pro_code' => setTextpro($pro['pro_code']) ])); ?>">
                                            <?php if(isset($pro['picture'])): ?>
                                            <img src="<?php echo e(config('app.url')); ?>/upload/thumbs/<?php echo e($pro['picture']); ?>" class="product-cat" alt=""
                                                style="width:70%;">
                                            <?php else: ?>
                                             <img src="<?php echo e(asset('frontend-asset/image/blank.png')); ?>" class="product-cat" alt=""
                                            style="width:70%;">
                                            <?php endif; ?>
                                        
                                            <h5 class="text-title-ft"><?php echo e($pro['pro_code']); ?></h5>
                                        </a>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="out-volt">
                                                        <h6 class="text-title-ft-sub"><?php echo e($staticContent['Output_Voltage']); ?></h6>
                                                        <p class="text-ft-sub text-one">
                                                            
                                                        <?php if($pro['content'][1]->status_input == 3): ?>
                                                        <?php if($pro['content'][1]->data_1 != null && $pro['content'][1]->data_2 != null): ?>
                                                             <?php echo e($pro['content'][1]->data_1); ?>-<?php echo e($pro['content'][1]->data_2); ?><?php echo e($pro['content'][1]->unit_name); ?>      
                                                        <?php else: ?> 
                                                        -
                                                        <?php endif; ?>
                                                        <?php else: ?>
                                                          <?php if($pro['content'][1]->data_1 != null): ?>
                                                         <?php echo join(",",retextdata($datacheck1 , $pro['content'][1]->unit_name));?>
                                                          <?php else: ?> 
                                                          -
                                                         <?php endif; ?>
                                                        <?php endif; ?>
                                                        </p>
                                                    </div>
                                                    <div class="out-power">
                                                        <h6 class="text-title-ft-sub"><?php echo e($staticContent['Output_Power']); ?></h6>
                                                        <p class="text-ft-sub text-one">
                                                            
                                                            <?php if($pro['content'][2]->status_input == 3): ?>
                                                            <?php if($pro['content'][2]->data_1 != null && $pro['content'][2]->data_2 != null): ?>
                                                                 <?php echo e($pro['content'][2]->data_1); ?>-<?php echo e($pro['content'][2]->data_2); ?><?php echo e($pro['content'][2]->unit_name); ?>      
                                                            <?php else: ?> 
                                                            -
                                                            <?php endif; ?>
                                                            <?php else: ?>
                                                               <?php if($pro['content'][2]->data_1 != null): ?>
                                                             <?php echo join(",",retextdata($datacheck2 , $pro['content'][2]->unit_name));?>
                                                                 <?php else: ?> 
                                                                 -
                                                                 <?php endif; ?>
                                                            <?php endif; ?>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="out-current">
                                                        <h6 class="text-title-ft-sub"><?php echo e($staticContent['Output_Current']); ?></h6>
                                                        <p class="text-ft-sub text-one">
                                                            <?php if($pro['content'][0]->status_input == 3): ?>
                                                            <?php if($pro['content'][0]->data_1 != null && $pro['content'][0]->data_2 != null): ?>
                                                                 <?php echo e($pro['content'][0]->data_1); ?>-<?php echo e($pro['content'][0]->data_2); ?><?php echo e($pro['content'][0]->unit_name); ?>      
                                                            <?php else: ?> 
                                                            -
                                                            <?php endif; ?>
                                                            <?php else: ?>
                                                              <?php if($pro['content'][0]->data_1 != null): ?>
                                                             <?php echo join(",",retextdata($datacheck3 , $pro['content'][0]->unit_name));?>
                                                             <?php else: ?> 
                                                             -
                                                             <?php endif; ?>
                                                            <?php endif; ?>
                                                        </p>
                                                    </div>
                                                    <div class="in-volt h-rvolt">
                                                        <h6 class="text-title-ft-sub"><?php echo e($staticContent['Input_Voltage']); ?></h6>
                                                        <p class="text-ft-sub text-one"><?php echo iconv_substr(strip_tags($pro['content'][3]->value_text),0,15,'UTF-8'); ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="dimension">
                                                <h6 class="text-title-ft-sub"> <?php echo e($staticContent['Dimensions']); ?> (<?php echo e($product[0]['unit_dimension_1']); ?> x W x <?php echo e($pro['unit_dimension']); ?>)</h6>
                                                <?php if(isset($product[0]['dimensionL']) && is_numeric($pro['dimensionL'])  && isset($pro['dimensionW']) && isset($pro['dimensionD'])): ?>
                                                <h6 class="text-ft-sub"><?php echo e($pro['dimensionL']); ?> x <?php echo e($pro['dimensionW']); ?> x
                                                    <?php echo e($pro['dimensionD']); ?> mm</h6>
                                                <h6 class="text-ft-sub">
                                                    <?php echo e(number_format($pro['dimensionL']* 0.0393701 ,2)); ?>” x
                                                    <?php echo e(number_format($pro['dimensionW']* 0.0393701 ,2)); ?>” x
                                                    <?php echo e(number_format($pro['dimensionD']* 0.0393701 ,2)); ?>”</h6>
                                                <?php else: ?>
                                                <h6 class="text-ft-sub"><?php echo iconv_substr(strip_tags($pro['dimensionL']),0,20,'UTF-8'); ?></h6>
                                                <?php endif; ?>
                                                <div class="btn btn-ft mt-2" onclick="showNavCoparison(<?php echo e($pro['pro_id']); ?> ,<?php echo e($pro['cate_id']); ?>)">+ <?php echo e($staticContent['Add_to_Compare']); ?></div>
                                            </div>
                                    </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    </div>
                </div>
            </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('js'); ?>
<script>
    function viewKey(key){
            var newkey = key.replace(/[/]/g,'@');
              event.preventDefault();
              window.location = '<?php echo e(route('searchByTag')); ?>/'+newkey;
    }
</script>
<script>
    $(function () {
     $('[data-toggle="tooltip"]').tooltip()
    })
    function popSection(id){
        $("#select-tech option[value="+id+"]").prop('selected', true);
    }
    function selectproduct(){
       var id =  $('#select-tech').val();
       $('#nav-output-tab'+id).click();
       
    }
    var offsetTop = $(".box-tech-specs").offset().top;
    $(window).scroll(function() {
        var scrollTop = $(window).scrollTop();
        if(scrollTop >= 600) {
            $(".add-compare-nav").slideDown(500);
            
        }else{
            $(".add-compare-nav").fadeOut();
            
        }
        if(scrollTop >= 1500){
            $(".add-compare-nav-mobile").slideDown(500);  
        }else{
            $(".add-compare-nav-mobile").fadeOut(); 
        }
    });

    
    /* firt image product */
    $('<img src="" alt="" >').appendTo('.product-show-box');
    $('.product-show-box img').attr("src", $('.product-show-list div:first-child a').find('img').attr("src"));
    /* onclick image product */
    function clickYoutube(id) {
        $('.product-show-box iframe').hide();
        $('<iframe width="100%" style="max-height: 500px; min-height: 50%;"  src="" controls=0 allowfullscreen></iframe>').appendTo('.product-show-box');
        $('.product-show-box iframe').attr("src", id);
        $('.product-show-box img').hide();
    }
    function clickImage(id) {
        $('.product-show-box img').hide();
        $('<img src="" alt="">').appendTo('.product-show-box');
        $('.product-show-box img').attr("src", id);
        $('.product-show-box iframe').hide();
    }
    $(document).ready(function() {
        setTimeout(function() {
           $('#add_delayshow').removeClass('d-none');
      }, 10);
        
        $('#preview').slick({
            vertical:true,
            verticalSwiping:true,
            slidesToShow: 3,
            slidesToScroll: 1,
            prevArrow:'<i class="zmdi zmdi-chevron-up a-left control-c prev slick-prev" aria-hidden="true"></i>',
            nextArrow:'<i class="zmdi zmdi-chevron-down a-right control-c next slick-next" aria-hidden="true"></i>'
        });
        $('#preview-mobile').slick({
            infinite:false,
            slidesToShow: 3,
            variableWidth: true,
            prevArrow: false,
            nextArrow: false
        });
    });
    $("#producttype").owlCarousel({
            loop: false,
            margin: 24,
            dotsEach: 4,
            nav: false,
            responsive: {
                0: {
                    items: 1

                },
                600: {
                    items: 2
                },
                1000: {
                    items: 3
                },
                1200: {
                    items: 4
                }
            },
            navText: ['<i class="zmdi zmdi-chevron-left" aria-hidden="true"></i>',
                '<i class="zmdi zmdi-chevron-right" aria-hidden="true"></i>',
            ]
        });
</script>

<script>
          <?php if(Session::has('messageGUI')): ?>
        $(document).ready(function() {
          var file =  '<?php echo e(Session::get('messageGUI')); ?>';
          var html = '';
              html += '<a href="<?php echo e(config('app.url')); ?>/upload/product_files/'+file +'" target="_blank">';
              html += '<?php echo e(config('app.url')); ?>/upload/product_files/'+file+'';
              html += '</a>';
             $('#linkdownloadsuc').html(html);
             $("#downloadgui-modal-success").modal();
             
          });
        <?php endif; ?>

        <?php if(Session::has('errorSendMail')): ?>
        $(document).ready(function() {
             $("#downloadgui-modal-failures").modal();
             
          });
        <?php endif; ?>
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front-end', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/Deltapsu_Production/dependencies/resources/views/front-end/productdetails.blade.php ENDPATH**/ ?>