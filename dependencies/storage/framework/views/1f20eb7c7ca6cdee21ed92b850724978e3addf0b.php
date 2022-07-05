<?php $__env->startSection('css'); ?>
<style>
       .btn-certi{
        height: 40px;
        width: 160px;
        border-radius: 5px;
        border: 2px solid #444444;
        background-color: #ffffff;
       
        color: #000000;
        font-weight: bold;
        cursor: pointer;

     }
     .f-btn{
        font-size: 12px;
        font-family: 'DeltaSans';
     }
     .btn-certi:hover{
         border: 1px solid #0087DC;
         background-color: #0087DC;
          color:#ffffff;
     }
     .in-volt{
         height: 73px;
     }
     .card {
      min-height: 100%;
    }
    .pro-h-box{
        height: 260px;
    }
    .product-cat {
      max-height: 100%;
  }
    .text-tag span{
        color: #0087DC;
        font-size: 13px;
        cursor: pointer;
    }
     .text-tag span:hover{
        color: #444444;
    }
    .hightlight{
        background: #ff0;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('container'); ?>
<div class="padding-top-content">
</div>

<div class="box-result-search">
    <div class="container">
        <h2 class="text-title-delta visible-tablets-up"><?php echo e($staticContent['Search_Results']); ?></h2>
        <h3 class="text-title-delta visible-mobile"><?php echo e($staticContent['Search_Results']); ?></h3>
        <select id="select-search-results" class="form-control mb-4">
            <option value="0"><?php echo e($staticContent['Products']); ?> (<?php echo e(count($pro_results)); ?>)</option>
            <option value="1"><?php echo e($staticContent['Product_News']); ?> (<?php echo e(count($news)); ?>)</option>
            <option value="2"><?php echo e($staticContent['Events']); ?> (<?php echo e(count($events)); ?>)</option>
            
            <option value="7"><?php echo e($staticContent['Applications']); ?> (<?php echo e(count($applications)); ?>)</option>
            <option value="4"><?php echo e($staticContent['FAQs']); ?> (<?php echo e(count($faqs)); ?>)</option>
            <option value="5"><?php echo e($staticContent['Marketing_Resources']); ?> (<?php echo e(count($margeting)); ?>)</option>
            <option value="6"> <?php echo e($staticContent['contact_Info']); ?> (<?php echo e(count($distributor)+count($offices)); ?>)</option>

        </select>
        <?php 
        function checkProcode($code){
          $string =  str_replace("/", "@",$code);
          return $string;
        }
       ?>
        <div class="bar-product-type">
            <nav id="bar-search-results-page-nav">
                <div class="nav nav-tabs mb-4" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-tab0" data-val="0" data-toggle="tab" href="#nav-products" role="tab" aria-controls="nav-products" aria-selected="true"><?php echo e($staticContent['Products']); ?> (<?php echo e(count($pro_results)); ?>)</a>
                    <a class="nav-item nav-link" id="nav-tab1" data-val="1" data-toggle="tab" href="#nav-news" role="tab" aria-controls="nav-news" aria-selected="false"><?php echo e($staticContent['Product_News']); ?> (<?php echo e(count($news)); ?>)</a>
                    <a class="nav-item nav-link" id="nav-tab2"  data-val="2" data-toggle="tab" href="#nav-events" role="tab" aria-controls="nav-events" aria-selected="false"><?php echo e($staticContent['Events']); ?> (<?php echo e(count($events)); ?>)</a>
                    
                    <a class="nav-item nav-link" id="nav-tab7"  data-val="7" data-toggle="tab" href="#nav-applications" role="tab" aria-controls="nav-applications" aria-selected="false"><?php echo e($staticContent['Applications']); ?> (<?php echo e(count($applications)); ?>)</a>
                    <a class="nav-item nav-link" id="nav-tab4" data-toggle="tab"  data-val="4" href="#nav-faqs" role="tab" aria-controls="nav-faqs" aria-selected="false"><?php echo e($staticContent['FAQs']); ?>  (<?php echo e(count($faqs)); ?>)</a>
                    <a class="nav-item nav-link" id="nav-tab5" data-val="5"  data-toggle="tab" href="#nav-marketing-resources" role="tab" aria-controls="nav-marketing-resources" aria-selected="false"><?php echo e($staticContent['Marketing_Resources']); ?>  (<?php echo e(count($margeting)); ?>)</a>
                    <a class="nav-item nav-link" id="nav-tab6"  data-val="6" data-toggle="tab" href="#nav-contact-info" role="tab" aria-controls="nav-contact-info" aria-selected="false"><?php echo e($staticContent['contact_Info']); ?> (<?php echo e(count($distributor)+count($offices)); ?>)</a>
                   
                </div>
            </nav>
            <div class="tab-content mb-5" id="nav-tabContent">
                <div class="tab-pane fade show active bar-product-type-list " id="nav-products" role="tabpanel" aria-labelledby="nav-products-tab">
                    <div id="result1" class="w-100">
                        <div class="visible-up-922 ">
                            <div class="row w-100">
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
                                <?php $__currentLoopData = $pro_results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class=" margin-p-left-card col-xl-3 col-lg-4 col-md-4">
                                <div class="item card">
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
                                    <div class="new-tag" style="background-color:<?php echo e($color); ?>"><?php echo e($name_sta); ?></div>
                                    <div class="card-body ft-products-item">
                                  
                                 
                                        <a href="<?php echo e(route('productsDetailsByType' ,['catename'=> $pro['url_item']  ,'pro_code' => checkProcode($pro['pro_code']) ])); ?>">
                                       <div class="pro-h-box">
                                        <?php if(isset($pro['picture'])): ?>
                                        <img src="<?php echo e(config('app.url')); ?>/upload/thumbs/<?php echo e($pro['picture']); ?>" class="product-cat mb-2" alt=""
                                            style="width:70%;">
                                        <?php else: ?>
                                         <img src="<?php echo e(asset('frontend-asset/image/blank.png')); ?>" class="product-cat mb-2" alt=""
                                        style="width:70%;">
                                        <?php endif; ?>
                                        </div>
                                        <h4 class="text-title-ft"><?php echo e($pro['pro_code']); ?></h4>
                                        </a>
                                        <div class="row m-d-t">
                                            <div class="col-6">
                                                <div class="out-volt">
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
                                                    <h6 class="text-title-ft-sub"><?php echo e($staticContent['Output_Voltage']); ?></h6>
                                                    <p class="text-ft-sub text-one">

                                                        <?php if($pro['content'][1]->status_input == 3): ?>
                                                        
                                                        <?php echo showdata($pro['content'][1]->data_1 ,$pro['content'][1]->data_2 ,$pro['content'][1]->unit_name)?>
                                                        <?php else: ?>
                                                         <?php echo join(",",retextdata($datacheck1 , $pro['content'][1]->unit_name));?>
                                                        <?php endif; ?>
                                                    </p>
                                                </div>
                                                <div class="out-power">
                                                    <h6 class="text-title-ft-sub"><?php echo e($staticContent['Output_Power']); ?></h6>
                                                    <p class="text-ft-sub text-one">
                                                        <?php if($pro['content'][2]->status_input == 3): ?>
                                                        
                                                        <?php echo showdata($pro['content'][2]->data_1 ,$pro['content'][2]->data_2 ,$pro['content'][2]->unit_name)?>
                                                        <?php else: ?>
                                                         <?php echo join(",",retextdata($datacheck2 , $pro['content'][2]->unit_name));?>
                                                        <?php endif; ?>

                                                     
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="out-current">
                                                    <h6 class="text-title-ft-sub"> <?php echo e($staticContent['Output_Current']); ?></h6>
                                                    <p class="text-ft-sub text-one">
                                                        <?php if($pro['content'][0]->status_input == 3): ?>
                                                        
                                                        <?php echo showdata($pro['content'][0]->data_1 ,$pro['content'][0]->data_2 ,$pro['content'][0]->unit_name)?>
                                                        <?php else: ?>
                                                         <?php echo join(",",retextdata($datacheck3 , $pro['content'][0]->unit_name));?>
                                                        <?php endif; ?>

                                                    </p>
                                                </div>
                                                <div class="in-volt">
                                                    <h6 class="text-title-ft-sub"> <?php echo e($staticContent['Input_Voltage']); ?></h6>
                                                    <p class="text-ft-sub text-one"> <?php echo iconv_substr(strip_tags($pro['content'][3]->value_text),0,15,'UTF-8'); ?> ...</p>
                                                   
                                                </div>
                                            </div>
                                        </div>
                
                                        <div class="dimension">
                                            <h6 class="text-title-ft-sub"> <?php echo e($staticContent['Dimensions']); ?></h6>
                                            <?php if(is_numeric($pro['dimensionL']) && is_numeric($pro['dimensionW'])  && is_numeric($pro['dimensionD']) && isset($pro['dimensionW']) && isset($pro['dimensionD'])): ?>
                                            <p class="text-ft-sub text-one"><?php echo e($pro['dimensionL']); ?> x <?php echo e($pro['dimensionW']); ?> x
                                                <?php echo e($pro['dimensionD']); ?> mm</p>
                                            <p class="text-ft-sub text-one">

                                                <?php echo e(number_format($pro['dimensionL']* 0.0393701 ,2)); ?>” x
                                                <?php echo e(number_format($pro['dimensionW']* 0.0393701 ,2)); ?>” x
                                                <?php echo e(number_format($pro['dimensionD']* 0.0393701 ,2)); ?>”</p>
                                            <?php else: ?>
                                            <p class="text-ft-sub text-one"><?php echo $pro['dimensionL']; ?></p>
                                            <?php endif; ?>
                                            <div class="tag-seach">
                                                <h6 class="text-title-ft-sub mt-2">Tags</h6>
                                                <?php $__currentLoopData = $pro['tags']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <a class="text-tag <?php echo e($pro['tag_m'] == $tag->tag ?'hightlight':''); ?>"><span  onclick="viewKey('<?php echo e($tag->tag); ?>')"><?php echo e($tag->tag); ?><?php echo e($loop->iteration != $loop->count?',':''); ?> </span></a>
                                               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                            <div  class="btn btn-ft mt-2" onclick="showNavCoparison(<?php echo e($pro['pro_id']); ?> ,<?php echo e($pro['cateid']); ?>)">+ <?php echo e($staticContent['Add_to_Compare']); ?> </div>
                                        </div>
                                    
                                        
                                    </div>
                                </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            
                        </div>
                         <div class="invisible-up-922 ">
                             <div class="d-flex flex-wrap">
                                <?php $__currentLoopData = $pro_results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class=" margin-p-left-card  col-card-product">
                                    <div class="item card">
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
                                            <a href="<?php echo e(route('productsDetailsByType' ,['catename'=> preg_replace('/\s+/', '-', $pro['url_item']) ,'pro_code' =>  checkProcode($pro['pro_code'])])); ?>">
                                                <?php if(isset($pro['picture'])): ?>
                                                <img src="<?php echo e(config('app.url')); ?>/upload/thumbs/<?php echo e($pro['picture']); ?>" class="product-cat mb-2" alt=""
                                                    style="width:70%;">
                                                <?php else: ?>
                                                 <img src="<?php echo e(asset('frontend-asset/image/blank.png')); ?>" class="product-cat mb-2" alt=""
                                                style="width:70%;">
                                                <?php endif; ?>
                                            <h6 class="text-title-ft"><?php echo e($pro['pro_code']); ?></h6>
                                            </a>
                                            <div class="flex-row">
                                                <div class="out-volt mt-1">
                                                    <p class="text-title-ft-sub text-two"><?php echo e($staticContent['Output_Voltage']); ?></p>
                                                    <p class="text-ft-sub text-two">   
                                                        

                                                        <?php if($pro['content'][1]->status_input == 3): ?>
                                                        <?php if($pro['content'][1]->data_1 != null && $pro['content'][1]->data_2 != null): ?>
                                                             <?php echo e($pro['content'][1]->data_1); ?>-<?php echo e($pro['content'][1]->data_2); ?><?php echo e($pro['content'][1]->unit_name); ?>      
                                                        <?php else: ?> 
                                                        -
                                                        <?php endif; ?>
                                                        <?php else: ?>
                                                         <?php echo join(",",retextdata($datacheck1 , $pro['content'][1]->unit_name));?>
                                                        <?php endif; ?>
                                                    </p>
                                                </div>
                                                <div class="out-power mt-2">
                                                    <p class="text-title-ft-sub text-two"><?php echo e($staticContent['Output_Power']); ?></p>
                                                    <p class="text-ft-sub text-two">
                                                          
                                                        <?php if($pro['content'][2]->status_input == 3): ?>
                                                        <?php if($pro['content'][2]->data_1 != null && $pro['content'][2]->data_2 != null): ?>
                                                             <?php echo e($pro['content'][2]->data_1); ?>-<?php echo e($pro['content'][2]->data_2); ?><?php echo e($pro['content'][2]->unit_name); ?>      
                                                        <?php else: ?> 
                                                        -
                                                        <?php endif; ?>
                                                        <?php else: ?>
                                                         <?php echo join(",",retextdata($datacheck2 , $pro['content'][2]->unit_name));?>
                                                        <?php endif; ?>
                                                    </p>
                                                </div>
                    
                                                <div class="out-current mt-2">
                                                    <p class="text-title-ft-sub text-two"><?php echo e($staticContent['Output_Current']); ?></p>
                                                    <p class="text-ft-sub text-two">
                                                        
                                                        <?php if($pro['content'][0]->status_input == 3): ?>
                                                        <?php if($pro['content'][0]->data_1 != null && $pro['content'][0]->data_2 != null): ?>
                                                             <?php echo e($pro['content'][0]->data_1); ?>-<?php echo e($pro['content'][0]->data_2); ?><?php echo e($pro['content'][0]->unit_name); ?>      
                                                        <?php else: ?> 
                                                        -
                                                        <?php endif; ?>
                                                        <?php else: ?>
                                                         <?php echo join(",",retextdata($datacheck3 , $pro['content'][0]->unit_name));?>
                                                        <?php endif; ?>
                                                    </p>
                                                </div>
                                                <div class="in-volt mt-2">
                                                    <p class="text-title-ft-sub text-two"><?php echo e($staticContent['Input_Voltage']); ?></p>          
                                                    <p class="text-ft-sub text-two"> <?php echo iconv_substr(strip_tags($pro['content'][3]->value_text),0,15,'UTF-8'); ?> ...</p>
                                                   
                                                </div>
                                                <div class="dimension mt-2">
                                                    <p class="text-title-ft-sub text-two"> <?php echo e($staticContent['Dimensions']); ?></p>
                                                    <?php if(is_numeric($pro['dimensionL']) && is_numeric($pro['dimensionW'])  && is_numeric($pro['dimensionD']) &&  isset($pro['dimensionW']) && isset($pro['dimensionD'])): ?>
                                                    <p class="text-ft-sub text-one"><?php echo e($pro['dimensionL']); ?> x <?php echo e($pro['dimensionW']); ?> x
                                                        <?php echo e($pro['dimensionD']); ?> mm</p>
                                                    <p class="text-ft-sub text-one">
                                                        <?php echo e(number_format($pro['dimensionL']* 0.0393701 ,2)); ?>” x
                                                        <?php echo e(number_format($pro['dimensionW']* 0.0393701 ,2)); ?>” x
                                                        <?php echo e(number_format($pro['dimensionD']* 0.0393701 ,2)); ?>”</p>
                                                    <?php else: ?>
                                                    <p class="text-ft-sub text-one"><?php echo $pro['dimensionL']; ?></p>
                                                    <?php endif; ?>
                                                </div>
                                                <h6 class="text-title-ft-sub mt-2">Tags</h6>
                                                <?php $__currentLoopData = $pro['tags']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <a class="text-tag <?php echo e($pro['tag_m'] == $tag->tag ?'hightlight':''); ?>"><span  onclick="viewKey('<?php echo e($tag->tag); ?>')"><?php echo e($tag->tag); ?><?php echo e($loop->iteration != $loop->count?',':''); ?> </span></a>
                                               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </div>
                                        <div class="btn btn-ft" onclick="showNavCoparison(<?php echo e($pro['pro_id']); ?>,<?php echo e($pro['cateid']); ?>)">+<?php echo e($staticContent['Add_to_Compare']); ?></div>
                                      
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                
                                
                             </div>
                            
                        </div> 
                    </div>
                </div>
                <div class="box-news tab-pane fade" id="nav-news" role="tabpanel" aria-labelledby="nav-news-tab">
                    <div id="result2" class="row">
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
                        <?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card">
                                <a href="<?php echo e(route('updateNewsDetail',['name'=> $item->slug])); ?>">
                                <div class="post-image">
                                    <img src="<?php echo e(config('app.url')); ?>/uploads_delta/<?php echo e($item->thumb); ?>" alt=""
                                        class="img-responsive">
                                </div>
                                 </a>
                                <div class="news-content">
                                    <div class="post-meta">
                                        <span class="sub-news company">
                                                <?php echo e($item->cateName); ?>

                                        </span>
                                    <img class="line-symbol"src="<?php echo e(asset('/frontend-asset/image/line-symbol.svg')); ?>" alt="">
                                        <span class="date">
                                                 <?php
                                                 if(isset($item->date_info)){
                                                   $datenew2 = getDateformat($item->date_info);
                                                   echo $datenew2['m'].' '.$datenew2['d'] .' '.$datenew2['y'];
                                                 }else{
                                                     echo '';
                                                 }
                     
                                                 ?>
                                        </span>
                                    </div>
                                    <a href="<?php echo e(route('updateNewsDetail',['name'=> $item->slug])); ?>">
                                    <h4 class="post-header title-new">
                                        <?php echo iconv_substr(strip_tags($item->title),0,90,'UTF-8'); ?> ...
                                    </h4>
                                      </a>
                                    <p><?php echo iconv_substr(strip_tags($item->content),0,50,'UTF-8'); ?> ...
                                    </p>
                                </div>
                            <a href="<?php echo e(route('updateNewsDetail',['name'=> $item->slug])); ?>" class="read-more"><?php echo e($staticContent['Read_More']); ?></a>
                            </div>
                          </div>  
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      
                    </div>
                </div>
                <div class="box-news tab-pane fade" id="nav-events" role="tabpanel" aria-labelledby="nav-events-tab">
                    <div id="result3" class="row">
                        <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-6 col-lg-4">
                            <div class="card">
                                <a href="<?php echo e(route('updateEventDetail',$item->slug)); ?>">
                                <div class="post-image">
                                    <img src="<?php echo e(config('app.url')); ?>/uploads_delta/<?php echo e($item->thumb); ?>" alt=""
                                        class="img-responsive">
                                </div>
                                </a>
                                <div class="news-content">
                                    <div class="post-meta">
                                        <span class="author">
                                          
                                                <i class="zmdi zmdi-calendar-alt"></i> 
                                                <?php
                                              if(isset($item->date_publish) && isset($item->date_end)){
                                                if($item->date_publish != null && $item->date_end != null ){
                                                  $date1 = getDateformat($item->date_publish);
                                                  $endDate2 = getDateformat($item->date_end);
                                                    echo $date1['m'].' '.$date1['d'] .''.(isset($endDate2['d'])?' - '.$endDate2['d']:'').' '.$date1['y'];
                                                }else{
                                                    echo '';
                                                }
                                              }
                                              
                                             ?>
                                        
                                        </span>
                                        <span class="locations ">
                                                <i class="zmdi zmdi-pin"></i> <?php echo e($item->location); ?>

                                        </span>
                                    </div>
                                    <a href="<?php echo e(route('updateEventDetail',$item->slug)); ?>">
                                    <h4 class="post-header title-new">
                                        <?php echo iconv_substr(strip_tags($item->title),0,90,'UTF-8'); ?> ...
                                    </h4>
                                    </a>
                                    <p> <?php echo iconv_substr(strip_tags($item->content),0,90,'UTF-8'); ?> ...
                                    </p>
                                    
                                </div>
                            <a href="<?php echo e(route('updateEventDetail',$item->slug)); ?> "class="read-more"><?php echo e($staticContent['Read_More']); ?></a>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <div class="box-news tab-pane fade" id="nav-technical-articles" role="tabpanel" aria-labelledby="nav-technical-articles-tab">
                    <div id="result4" class="row">
                        <?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-6 col-lg-4">
                            <div class="card">
                                <a href="<?php echo e(route('updateNewsDetail',$item->slug)); ?>">
                                <div class="post-image">
                                    <img src="<?php echo e(config('app.url')); ?>/uploads_delta/<?php echo e($item->thumb); ?>" alt=""
                                        class="img-responsive">
                                </div>
                                </a>
                                <div class="news-content">
                                    <div class="post-meta">
                                        <span class="sub-news company">
                                            <a href="#" class="text-uppercase">
                                                <?php echo e($item->cateName); ?>

                                            </a>
                                        </span>
                                    <img class="line-symbol"src="<?php echo e(asset('/frontend-asset/image/line-symbol.svg')); ?>" alt="">
                                        <span class="date">
                                    
                                        
                                                 <?php
                                                 if(isset($item->date_info)){
                                                   $datenew2 = getDateformat($item->date_info);
                                                   echo $datenew2['m'].' '.$datenew2['d'] .' '.$datenew2['y'];
                                                 }else{
                                                     echo '';
                                                 }
                     
                                                 ?>
                                            
                                        </span>
                                    </div>
                                    <a href="<?php echo e(route('updateNewsDetail',$item->slug)); ?>">
                                    <h2 class="post-header title-new">
                                        <?php echo e($item->title); ?>

                                    </h2>
                                    </a>
                                    <p><?php echo iconv_substr(strip_tags($item->content),0,90,'UTF-8'); ?> ...
                                    </p>
                                    
                                </div>
                                
                            <a href="<?php echo e(route('updateNewsDetail',['name'=> $item->slug])); ?>" class="read-more"><?php echo e($staticContent['Read_More']); ?></a>
                            </div>
                          </div>  
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <div class="tab-pane fade row" id="nav-faqs" role="tabpanel" aria-labelledby="nav-faqs-tab">
                    <div id="result5" class="faqs-type w-100">
                        <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="box-for-collap">
                            <div class="faqs-list hide-box collapsed" data-toggle="collapse" data-parent="#faqs-type" href="#collapse-faq<?php echo e($faq->id); ?>" aria-expanded="false">
                                   <div class="p-l-18"><?php echo e($faq->title); ?></div>

                                </div>
                                <div id="collapse-faq<?php echo e($faq->id); ?>" class="faqs-list-sub collapse" data-parent="#faqs-type" style="">
                                    <div class="force-overflow">
                                        <div class="faqs-address">
                                            <?php echo $faq->content; ?>

                                        </div>
                                    </div>
                                </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>

           
                <div class="tab-pane fade row" id="nav-marketing-resources" role="tabpanel" aria-labelledby="nav-marketing-resources-tab">
                    <div id="result6" class="ft-products-body w-100 faqs-type">
                     

                        <?php $__currentLoopData = $margeting; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php 
                            $current = null;
                            foreach($margetCate as $item) { 
                                if ($item2->cate_id == $item->cate_id) {
                                    $current = $item2;
                                    break;
                                }
                            }
                       ?>

                        <div class="resources-download ">
                            <div class="detail-download ">
                                <h5><?php echo e(isset($current->name)? $current->name:""); ?></h5>
                                <p><?php echo e($staticContent['Uploaded_on']); ?> 
                                    <?php
                                    if(isset($current->created_at)){
                                      $datenew2 = getDateformat($current->created_at);
                                      echo $datenew2['m'].'-'.$datenew2['d'] .'-'.$datenew2['y'];
                                    }else{
                                        echo '';
                                    }
        
                                    ?>
                                </p>
                            </div>
                            <a href="<?php echo e(config('app.url')); ?>/medias/marketing_resources/<?php echo e(isset($current->file)? $current->file:""); ?> ">
                                <button class="btn-downlode"><?php echo e($staticContent['Downloads']); ?></button>
                                </a>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-contact-info" role="tabpanel" aria-labelledby="nav-contact-info-tab">
                    <div id="result6" class="ft-products-body w-100">
                       <div class="sales-offices  ">
                            <h3 class="text-color-delta my-3"><?php echo e($staticContent['sales_offices']); ?></h3>
                            <div class="sales-offices-type pb-5">
                                <?php $__currentLoopData = $continents_office; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $con_f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                $set2 = false; 
                                foreach($offices as $offic){
                                   if($offic->continent_id == $con_f->id){
                                      $set2 = true;
                                      break;
                                   }
                                }
                                ?>
                                <div class="box-for-collap <?php echo e($set2?'d-block':'d-none'); ?>">
                                <div class="sales-offices-list  hide-box text-colour-delta" data-toggle="collapse" data-parent="#sales-offices-type"
                                            href="#collapse-sales<?php echo e($con_f->id); ?>" >
                                               <h5><?php echo e($con_f->name); ?></h5>
                                           
                                    </div>
                                    <div id="collapse-sales<?php echo e($con_f->id); ?>" class="sales-offices-list-sub collapse show" data-parent="#sales-offices-type">
                                        <div class="force-overflow">
                                            <?php $__currentLoopData = $offices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $offic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($offic->continent_id == $con_f->id ): ?>
                                            <div class="sales-offices-address">
                                                <p class="text-sixteen-dark mr-b-1"><?php echo e($offic->title); ?>

                                                <br><?php echo e($offic->sub_title); ?></p>
                                               <div class="text-editor"> 
                                                  <?php echo $offic->content; ?>

                                               </div>
                                               <a href="https://www.google.com/maps/?q=<?php echo e($offic->lat); ?>,<?php echo e($offic->lon); ?>&sensor=true" target="_blank">
                                                <button class="btn-subscribe"> <?php echo e($staticContent['Get Direction']); ?></button>
                                               </a>
                                            </div> 
                                            <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                        
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                         
                            </div>
                         </div>
                       <div class="find-distributor">
                            <h3 class="text-color-delta my-3"><?php echo e($staticContent['find_a_distributor']); ?></h3>
                            <div id="find-distributor" class="find-distributor-type">
                                <?php $__currentLoopData = $continents_dis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $con_dis): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                $set = false; 
                                foreach($distributor as $dis){
                                   if($dis->continent_id == $con_dis->id){
                                      $set = true;
                                      break;
                                   }
                                }
                                ?>
                                <div class="box-for-collap <?php echo e($set?'d-block':'d-none'); ?>">
                                <div class="find-distributor-list  hide-box text-colour-delta " data-toggle="collapse" data-parent="#find-distributor-type"
                                            href="#collapse-fad-offi<?php echo e($con_dis->id); ?>" >
                                     <h5><?php echo e($con_dis->name); ?></h5> 
                                    </div>
                                    <div id="collapse-fad-offi<?php echo e($con_dis->id); ?>" class="find-distributor-list-sub collapse show" data-parent="#find-distributor-type">
                                            <div class="force-overflow">
                                                <?php $__currentLoopData = $distributor; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dis): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($dis->continent_id == $con_dis->id ): ?>
                                                <div class="find-distributor-address">
                                                    <p class="text-sixteen-dark mr-b-1"><?php echo e($dis->title); ?></p>
                                                    <br><?php echo e($dis->sub_title); ?></p>
                                                    <div class="text-editor mb-2"> 
                                                        <?php echo $dis->content; ?>

                                                     </div>
                                                     <a href="https://www.google.com/maps/?q=<?php echo e($dis->lat); ?>,<?php echo e($dis->lon); ?>&sensor=true" target="_blank">
                                                    <button class="btn-subscribe"> <?php echo e($staticContent['Get Direction']); ?></button>
                                                     </a>
                                                     <?php if($dis->status_cer == 1): ?>
                                                     <a href="<?php echo e(config('app.url')); ?>/medias/distributor/<?php echo e($dis->file_cer); ?>" download="">
                                                      <button class="btn-certi"><i class="cer-icon icon-facon icon-web-certificate"></i> <span class="f-btn"><?php echo e($staticContent['Certificates']); ?></span></button>
                                                      </a>
                                                      <?php endif; ?>
                                                </div>
                                                <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade row" id="nav-applications" role="tabpanel" aria-labelledby="nav-applications">
                    <div id="result7" class="faqs-type w-100">
                        <div class="box-applications  ">
                            <div class="container">
                                <div class="grid-container">
                                    <?php $__currentLoopData = $applications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a href="<?php echo e(route('applicationDetail' ,[ 'name' => preg_replace('/\s+/', '-',$item->applica_id.'-'.$item->name)])); ?>" class="" style="">
                                        <div class="grid-item ">
                                            <div class="grid-sub-pic"
                                                style="background: url('<?php echo e(config('app.url')); ?>/medias/categories/<?php echo e($item->thumbnail); ?>');">
                                                
                                            </div>
                                            <div class="grid-sub-text">
                                                <img src="<?php echo e(config('app.url')); ?>/medias/categories/<?php echo e($item->color_icon); ?>" alt="">
                                                <p class=""><?php echo e($item->name); ?></p>
                                                
                                                <ul class="app-detail-bullet">
                                                    
                                                    <?php
                                                        $str = $item->overview;
                                                        $st = explode("\n", $str);
                                                            for ($k = 0; $k < count($st); $k++) {
                                                            if($k < 3){
                                                                echo $st[$k] = '<li>'
                                                                    . $st[$k]
                                                                    . '</li>';
                                                            }
                                                           }
                                                        ?>
                                                </ul>
                    
                                            </div>
                                        </div>
                                    </a>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    
                                </div>
                            </div>
                            
                        </div>
            
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
         $('#nav-tab a').click(function(){ 
           var id =  $(this).data('val');
           $("#select-search-results option[value="+id+"]").prop('selected', true);
        });
         $('#select-search-results').on('change', function(e) {
            var data =  $(this).val();
            // console.log(data);
           $('#nav-tab'+data).click();
        });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front-end', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/Deltapsu_Production/dependencies/resources/views/front-end/resultsearch.blade.php ENDPATH**/ ?>