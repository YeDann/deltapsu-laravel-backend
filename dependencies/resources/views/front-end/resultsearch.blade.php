@extends('layouts.front-end')
@section('css')
<style>
    .btn-certi {
        height: 40px;
        width: 160px;
        border-radius: 5px;
        border: 2px solid #444444;
        background-color: #ffffff;

        color: #000000;
        font-weight: bold;
        cursor: pointer;

    }

    .f-btn {
        font-size: 12px;
        font-family: 'DeltaSans';
    }

    .btn-certi:hover {
        border: 1px solid #0087DC;
        background-color: #0087DC;
        color: #ffffff;
    }

    .in-volt {
        height: 73px;
    }

    .card {
        min-height: 100%;
    }

    .pro-h-box {
        height: 260px;
    }

    .product-cat {
        max-height: 100%;
    }

    .text-tag span {
        color: #0087DC;
        font-size: 13px;
        cursor: pointer;
    }

    .text-tag span:hover {
        color: #444444;
    }

    .hightlight {
        background: #ff0;
    }
</style>
@endsection

@section('container')
<div class="padding-top-content">
</div>

<div class="box-result-search">
    <div class="container">
        <h2 class="text-title-delta visible-tablets-up">{{$staticContent['Search_Results']}}</h2>
        <h3 class="text-title-delta visible-mobile">{{$staticContent['Search_Results']}}</h3>
        <select id="select-search-results" class="form-control mb-4">
            <option value="0">{{$staticContent['Products']}} ({{count($pro_results)}})</option>
            <option value="1">{{$staticContent['Product_News']}} ({{count($news)}})</option>
            <option value="2">{{$staticContent['Events']}} ({{count($events)}})</option>
            {{-- <option value="3">{{$staticContent['Technical_Articles']}}({{count($articles)}})</option> --}}
            <option value="7">{{$staticContent['Applications']}} ({{count($applications)}})</option>
            <option value="4">{{$staticContent['FAQs']}} ({{count($faqs)}})</option>
            <option value="5">{{$staticContent['Marketing_Resources']}} ({{count($margeting)}})</option>
            <option value="6"> {{$staticContent['contact_Info']}} ({{count($distributor)+count($offices)}})</option>

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
                    <a class="nav-item nav-link active" id="nav-tab0" data-val="0" data-toggle="tab"
                        href="#nav-products" role="tab" aria-controls="nav-products"
                        aria-selected="true">{{$staticContent['Products']}} ({{count($pro_results)}})</a>
                    <a class="nav-item nav-link" id="nav-tab1" data-val="1" data-toggle="tab" href="#nav-news"
                        role="tab" aria-controls="nav-news" aria-selected="false">{{$staticContent['Product_News']}}
                        ({{count($news)}})</a>
                    <a class="nav-item nav-link" id="nav-tab2" data-val="2" data-toggle="tab" href="#nav-events"
                        role="tab" aria-controls="nav-events" aria-selected="false">{{$staticContent['Events']}}
                        ({{count($events)}})</a>
                    {{-- <a class="nav-item nav-link" id="nav-tab3" data-val="3" data-toggle="tab"
                        href="#nav-technical-articles" role="tab" aria-controls="nav-technical-articles"
                        aria-selected="false">{{$staticContent['Technical_Articles']}} ({{count($articles)}})</a> --}}
                    <a class="nav-item nav-link" id="nav-tab7" data-val="7" data-toggle="tab" href="#nav-applications"
                        role="tab" aria-controls="nav-applications"
                        aria-selected="false">{{$staticContent['Applications']}} ({{count($applications)}})</a>
                    <a class="nav-item nav-link" id="nav-tab4" data-toggle="tab" data-val="4" href="#nav-faqs"
                        role="tab" aria-controls="nav-faqs" aria-selected="false">{{$staticContent['FAQs']}}
                        ({{count($faqs)}})</a>
                    <a class="nav-item nav-link" id="nav-tab5" data-val="5" data-toggle="tab"
                        href="#nav-marketing-resources" role="tab" aria-controls="nav-marketing-resources"
                        aria-selected="false">{{$staticContent['Marketing_Resources']}} ({{count($margeting)}})</a>
                    <a class="nav-item nav-link" id="nav-tab6" data-val="6" data-toggle="tab" href="#nav-contact-info"
                        role="tab" aria-controls="nav-contact-info"
                        aria-selected="false">{{$staticContent['contact_Info']}}
                        ({{count($distributor)+count($offices)}})</a>

                </div>
            </nav>
            <div class="tab-content mb-5" id="nav-tabContent">
                <div class="tab-pane fade show active bar-product-type-list " id="nav-products" role="tabpanel"
                    aria-labelledby="nav-products-tab">
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
                                @foreach ($pro_results as $pro)
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
                                        <div class="new-tag" style="background-color:{{$color}}">{{$name_sta}}</div>
                                        <div class="card-body ft-products-item">


                                            <a
                                                href="{{route('productsDetailsByType' ,['catename'=> $pro['url_item']  ,'pro_code' => checkProcode($pro['pro_code']) ])}}">
                                                <div class="pro-h-box">
                                                    @if(isset($pro['picture']))
                                                    <img src="{{config('app.url')}}/upload/thumbs/{{$pro['picture']}}"
                                                        class="product-cat mb-2" alt="" style="width:70%;">
                                                    @else
                                                    <img src="{{asset('frontend-asset/image/blank.png')}}"
                                                        class="product-cat mb-2" alt="" style="width:70%;">
                                                    @endif
                                                </div>
                                                <h4 class="text-title-ft">{{$pro['pro_code']}}</h4>
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
                                                        <h6 class="text-title-ft-sub">
                                                            {{$staticContent['Output_Voltage']}}</h6>
                                                        <p class="text-ft-sub text-one">

                                                            @if($pro['content'][1]->status_input == 3)
                                                            {{-- @if($pro['content'][1]->data_1 != null &&
                                                            $pro['content'][1]->data_2 != null)
                                                            {{$pro['content'][1]->data_1}}-{{$pro['content'][1]->data_2}}{{$pro['content'][1]->unit_name}}
                                                            @else
                                                            -
                                                            @endif --}}
                                                            <?php echo showdata($pro['content'][1]->data_1 ,$pro['content'][1]->data_2 ,$pro['content'][1]->unit_name)?>
                                                            @else
                                                            <?php echo join(",",retextdata($datacheck1 , $pro['content'][1]->unit_name));?>
                                                            @endif
                                                        </p>
                                                    </div>
                                                    <div class="out-power">
                                                        <h6 class="text-title-ft-sub">{{$staticContent['Output_Power']}}
                                                        </h6>
                                                        <p class="text-ft-sub text-one">
                                                            @if($pro['content'][2]->status_input == 3)
                                                            {{-- @if($pro['content'][2]->data_1 != null &&
                                                            $pro['content'][2]->data_2 != null)
                                                            {{$pro['content'][2]->data_1}}-{{$pro['content'][2]->data_2}}{{$pro['content'][2]->unit_name}}
                                                            @else
                                                            -
                                                            @endif --}}
                                                            <?php echo showdata($pro['content'][2]->data_1 ,$pro['content'][2]->data_2 ,$pro['content'][2]->unit_name)?>
                                                            @else
                                                            <?php echo join(",",retextdata($datacheck2 , $pro['content'][2]->unit_name));?>
                                                            @endif


                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="out-current">
                                                        <h6 class="text-title-ft-sub">
                                                            {{$staticContent['Output_Current']}}</h6>
                                                        <p class="text-ft-sub text-one">
                                                            @if($pro['content'][0]->status_input == 3)
                                                            {{-- @if($pro['content'][0]->data_1 != null &&
                                                            $pro['content'][0]->data_2 != null)
                                                            {{$pro['content'][0]->data_1}}-{{$pro['content'][0]->data_2}}{{$pro['content'][0]->unit_name}}
                                                            @else
                                                            -
                                                            @endif --}}
                                                            <?php echo showdata($pro['content'][0]->data_1 ,$pro['content'][0]->data_2 ,$pro['content'][0]->unit_name)?>
                                                            @else
                                                            <?php echo join(",",retextdata($datacheck3 , $pro['content'][0]->unit_name));?>
                                                            @endif

                                                        </p>
                                                    </div>
                                                    <div class="in-volt">
                                                        <h6 class="text-title-ft-sub">
                                                            {{$staticContent['Input_Voltage']}}</h6>
                                                        <p class="text-ft-sub text-one"> {!!
                                                            iconv_substr(strip_tags($pro['content'][3]->value_text),0,15,'UTF-8')
                                                            !!} ...</p>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="dimension">
                                                <h6 class="text-title-ft-sub"> {{$staticContent['Dimensions']}}</h6>
                                                @if(is_numeric($pro['dimensionL']) && is_numeric($pro['dimensionW']) &&
                                                is_numeric($pro['dimensionD']) && isset($pro['dimensionW']) &&
                                                isset($pro['dimensionD']))
                                                <p class="text-ft-sub text-one">{{$pro['dimensionL']}} x
                                                    {{$pro['dimensionW']}} x
                                                    {{$pro['dimensionD']}} mm</p>
                                                <p class="text-ft-sub text-one">

                                                    {{number_format($pro['dimensionL']* 0.0393701 ,2)}}” x
                                                    {{number_format($pro['dimensionW']* 0.0393701 ,2)}}” x
                                                    {{number_format($pro['dimensionD']* 0.0393701 ,2)}}”</p>
                                                @else
                                                <p class="text-ft-sub text-one">{!!$pro['dimensionL']!!}</p>
                                                @endif
                                                <div class="tag-seach">
                                                    <h6 class="text-title-ft-sub mt-2">Tags</h6>
                                                    @foreach ($pro['tags'] as $tag)
                                                    <a
                                                        class="text-tag {{$pro['tag_m'] == $tag->tag ?'hightlight':'' }}"><span
                                                            onclick="viewKey('{{$tag->tag}}')">{{$tag->tag}}{{$loop->iteration
                                                            != $loop->count?',':'' }} </span></a>
                                                    @endforeach
                                                </div>
                                                <div class="btn btn-ft mt-2"
                                                    onclick="showNavCoparison({{$pro['pro_id']}} ,{{$pro['cateid']}})">
                                                    {{$staticContent['Add_to_Compare']}} </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                        </div>
                        <div class="invisible-up-922 ">
                            <div class="d-flex flex-wrap">
                                @foreach ($pro_results as $pro)
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
                                        <div class="new-tag" style="background-color:{{$color}}">{{$name_sta}}</div>
                                        <div class="card-body ft-products-item">
                                            <a
                                                href="{{route('productsDetailsByType' ,['catename'=> preg_replace('/\s+/', '-', $pro['url_item']) ,'pro_code' =>  checkProcode($pro['pro_code'])])}}">
                                                @if(isset($pro['picture']))
                                                <img src="{{config('app.url')}}/upload/thumbs/{{$pro['picture']}}"
                                                    class="product-cat mb-2" alt="" style="width:70%;">
                                                @else
                                                <img src="{{asset('frontend-asset/image/blank.png')}}"
                                                    class="product-cat mb-2" alt="" style="width:70%;">
                                                @endif
                                                <h6 class="text-title-ft">{{$pro['pro_code']}}</h6>
                                            </a>
                                            <div class="flex-row">
                                                <div class="out-volt mt-1">
                                                    <p class="text-title-ft-sub text-two">
                                                        {{$staticContent['Output_Voltage']}}</p>
                                                    <p class="text-ft-sub text-two">
                                                        {{-- @if($pro['content'][1]->data_1 != null)
                                                        {{$pro['content'][1]->data_1}}
                                                        {{$pro['content'][1]->unit_name}}
                                                        @else
                                                        -
                                                        @endif --}}

                                                        @if($pro['content'][1]->status_input == 3)
                                                        @if($pro['content'][1]->data_1 != null &&
                                                        $pro['content'][1]->data_2 != null)
                                                        {{$pro['content'][1]->data_1}}-{{$pro['content'][1]->data_2}}{{$pro['content'][1]->unit_name}}
                                                        @else
                                                        -
                                                        @endif
                                                        @else
                                                        <?php echo join(",",retextdata($datacheck1 , $pro['content'][1]->unit_name));?>
                                                        @endif
                                                    </p>
                                                </div>
                                                <div class="out-power mt-2">
                                                    <p class="text-title-ft-sub text-two">
                                                        {{$staticContent['Output_Power']}}</p>
                                                    <p class="text-ft-sub text-two">
                                                        {{-- @if($pro['content'][2]->data_1 != null)
                                                        {{$pro['content'][2]->data_1}}
                                                        {{$pro['content'][2]->unit_name}}
                                                        @else
                                                        -
                                                        @endif --}}
                                                        @if($pro['content'][2]->status_input == 3)
                                                        @if($pro['content'][2]->data_1 != null &&
                                                        $pro['content'][2]->data_2 != null)
                                                        {{$pro['content'][2]->data_1}}-{{$pro['content'][2]->data_2}}{{$pro['content'][2]->unit_name}}
                                                        @else
                                                        -
                                                        @endif
                                                        @else
                                                        <?php echo join(",",retextdata($datacheck2 , $pro['content'][2]->unit_name));?>
                                                        @endif
                                                    </p>
                                                </div>

                                                <div class="out-current mt-2">
                                                    <p class="text-title-ft-sub text-two">
                                                        {{$staticContent['Output_Current']}}</p>
                                                    <p class="text-ft-sub text-two">
                                                        {{-- @if($pro['content'][0]->data_1 != null)
                                                        {{$pro['content'][0]->data_1}}
                                                        {{$pro['content'][0]->unit_name}}
                                                        @else
                                                        -
                                                        @endif --}}
                                                        @if($pro['content'][0]->status_input == 3)
                                                        @if($pro['content'][0]->data_1 != null &&
                                                        $pro['content'][0]->data_2 != null)
                                                        {{$pro['content'][0]->data_1}}-{{$pro['content'][0]->data_2}}{{$pro['content'][0]->unit_name}}
                                                        @else
                                                        -
                                                        @endif
                                                        @else
                                                        <?php echo join(",",retextdata($datacheck3 , $pro['content'][0]->unit_name));?>
                                                        @endif
                                                    </p>
                                                </div>
                                                <div class="in-volt mt-2">
                                                    <p class="text-title-ft-sub text-two">
                                                        {{$staticContent['Input_Voltage']}}</p>
                                                    <p class="text-ft-sub text-two"> {!!
                                                        iconv_substr(strip_tags($pro['content'][3]->value_text),0,15,'UTF-8')
                                                        !!} ...</p>

                                                </div>
                                                <div class="dimension mt-2">
                                                    <p class="text-title-ft-sub text-two">
                                                        {{$staticContent['Dimensions']}}</p>
                                                    @if(is_numeric($pro['dimensionL']) && is_numeric($pro['dimensionW'])
                                                    && is_numeric($pro['dimensionD']) && isset($pro['dimensionW']) &&
                                                    isset($pro['dimensionD']))
                                                    <p class="text-ft-sub text-one">{{$pro['dimensionL']}} x
                                                        {{$pro['dimensionW']}} x
                                                        {{$pro['dimensionD']}} mm</p>
                                                    <p class="text-ft-sub text-one">
                                                        {{number_format($pro['dimensionL']* 0.0393701 ,2)}}” x
                                                        {{number_format($pro['dimensionW']* 0.0393701 ,2)}}” x
                                                        {{number_format($pro['dimensionD']* 0.0393701 ,2)}}”</p>
                                                    @else
                                                    <p class="text-ft-sub text-one">{!!$pro['dimensionL']!!}</p>
                                                    @endif
                                                </div>
                                                <h6 class="text-title-ft-sub mt-2">Tags</h6>
                                                @foreach ($pro['tags'] as $tag)
                                                <a class="text-tag {{$pro['tag_m'] == $tag->tag ?'hightlight':'' }}"><span
                                                        onclick="viewKey('{{$tag->tag}}')">{{$tag->tag}}{{$loop->iteration
                                                        != $loop->count?',':'' }} </span></a>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="btn btn-ft"
                                            onclick="showNavCoparison({{$pro['pro_id']}},{{$pro['cateid']}})">
                                            {{$staticContent['Add_to_Compare']}}</div>

                                    </div>
                                </div>
                                @endforeach


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
                        @foreach ($news as $item)
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card">
                                <a href="{{route('updateNewsDetail',['name'=> $item->slug])}}">
                                    <div class="post-image">
                                        <img src="{{config('app.url')}}/uploads_delta/{{$item->thumb}}" alt=""
                                            class="img-responsive">
                                    </div>
                                </a>
                                <div class="news-content">
                                    <div class="post-meta">
                                        <span class="sub-news company">
                                            {{$item->cateName}}
                                        </span>
                                        <img class="line-symbol"
                                            src="{{asset('/frontend-asset/image/line-symbol.svg')}}" alt="">
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
                                    <a href="{{route('updateNewsDetail',['name'=> $item->slug])}}">
                                        <h4 class="post-header title-new">
                                            {!! iconv_substr(strip_tags($item->title),0,90,'UTF-8') !!} ...
                                        </h4>
                                    </a>
                                    <p>{!! iconv_substr(strip_tags($item->content),0,50,'UTF-8') !!} ...
                                    </p>
                                </div>
                                <a href="{{route('updateNewsDetail',['name'=> $item->slug])}}"
                                    class="read-more">{{$staticContent['Read_More']}}</a>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
                <div class="box-news tab-pane fade" id="nav-events" role="tabpanel" aria-labelledby="nav-events-tab">
                    <div id="result3" class="row">
                        @foreach ($events as $item)
                        <div class="col-md-6 col-lg-4">
                            <div class="card">
                                <a href="{{route('updateEventDetail',$item->slug)}}">
                                    <div class="post-image">
                                        <img src="{{config('app.url')}}/uploads_delta/{{$item->thumb}}" alt=""
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
                                            <i class="zmdi zmdi-pin"></i> {{$item->location}}
                                        </span>
                                    </div>
                                    <a href="{{route('updateEventDetail',$item->slug)}}">
                                        <h4 class="post-header title-new">
                                            {!! iconv_substr(strip_tags($item->title),0,90,'UTF-8') !!} ...
                                        </h4>
                                    </a>
                                    <p> {!! iconv_substr(strip_tags($item->content),0,90,'UTF-8') !!} ...
                                    </p>

                                </div>
                                <a href="{{route('updateEventDetail',$item->slug)}} "
                                    class="read-more">{{$staticContent['Read_More']}}</a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="box-news tab-pane fade" id="nav-technical-articles" role="tabpanel"
                    aria-labelledby="nav-technical-articles-tab">
                    <div id="result4" class="row">
                        @foreach ($articles as $item)
                        <div class="col-md-6 col-lg-4">
                            <div class="card">
                                <a href="{{route('updateNewsDetail',$item->slug)}}">
                                    <div class="post-image">
                                        <img src="{{config('app.url')}}/uploads_delta/{{$item->thumb}}" alt=""
                                            class="img-responsive">
                                    </div>
                                </a>
                                <div class="news-content">
                                    <div class="post-meta">
                                        <span class="sub-news company">
                                            <a href="#" class="text-uppercase">
                                                {{$item->cateName}}
                                            </a>
                                        </span>
                                        <img class="line-symbol"
                                            src="{{asset('/frontend-asset/image/line-symbol.svg')}}" alt="">
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
                                    <a href="{{route('updateNewsDetail',$item->slug)}}">
                                        <h2 class="post-header title-new">
                                            {{$item->title}}
                                        </h2>
                                    </a>
                                    <p>{!! iconv_substr(strip_tags($item->content),0,90,'UTF-8') !!} ...
                                    </p>

                                </div>

                                <a href="{{route('updateNewsDetail',['name'=> $item->slug])}}"
                                    class="read-more">{{$staticContent['Read_More']}}</a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="tab-pane fade row" id="nav-faqs" role="tabpanel" aria-labelledby="nav-faqs-tab">
                    <div id="result5" class="faqs-type w-100">
                        @foreach ($faqs as $faq)
                        <div class="box-for-collap">
                            <div class="faqs-list hide-box collapsed" data-toggle="collapse" data-parent="#faqs-type"
                                href="#collapse-faq{{$faq->id}}" aria-expanded="false">
                                <div class="p-l-18">{{$faq->title}}</div>

                            </div>
                            <div id="collapse-faq{{$faq->id}}" class="faqs-list-sub collapse" data-parent="#faqs-type"
                                style="">
                                <div class="force-overflow">
                                    <div class="faqs-address">
                                        {!!$faq->content!!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>


                <div class="tab-pane fade row" id="nav-marketing-resources" role="tabpanel"
                    aria-labelledby="nav-marketing-resources-tab">
                    <div id="result6" class="ft-products-body w-100 faqs-type">


                        @foreach ($margeting as $item2)
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
                                <h5>{{isset($current->name)? $current->name:""}}</h5>
                                <p>{{$staticContent['Uploaded_on']}}
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
                            <a
                                href="{{config('app.url')}}/file_doc_2/marketing_resources/{{isset($current->file)? $current->file:""}} ">
                                <button class="btn-downlode">{{$staticContent['Downloads']}}</button>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-contact-info" role="tabpanel" aria-labelledby="nav-contact-info-tab">
                    <div id="result6" class="ft-products-body w-100">
                        <div class="sales-offices  ">
                            <h3 class="text-color-delta my-3">{{$staticContent['sales_offices']}}</h3>
                            <div class="sales-offices-type pb-5">
                                @foreach ($continents_office as $con_f)
                                <?php
                                $set2 = false; 
                                foreach($offices as $offic){
                                   if($offic->continent_id == $con_f->id){
                                      $set2 = true;
                                      break;
                                   }
                                }
                                ?>
                                <div class="box-for-collap {{$set2?'d-block':'d-none'}}">
                                    <div class="sales-offices-list  hide-box text-colour-delta" data-toggle="collapse"
                                        data-parent="#sales-offices-type" href="#collapse-sales{{$con_f->id}}">
                                        <h5>{{$con_f->name}}</h5>

                                    </div>
                                    <div id="collapse-sales{{$con_f->id}}" class="sales-offices-list-sub collapse show"
                                        data-parent="#sales-offices-type">
                                        <div class="force-overflow">
                                            @foreach ($offices as $offic)
                                            @if($offic->continent_id == $con_f->id )
                                            <div class="sales-offices-address">
                                                <p class="text-sixteen-dark mr-b-1">{{$offic->title}}
                                                    <br>{{$offic->sub_title}}
                                                </p>
                                                <div class="text-editor">
                                                    {!!$offic->content!!}
                                                </div>
                                                <a href="https://www.google.com/maps/?q={{$offic->lat}},{{$offic->lon}}&sensor=true"
                                                    target="_blank">
                                                    <button class="btn-subscribe"> {{$staticContent['Get
                                                        Direction']}}</button>
                                                </a>
                                            </div>
                                            @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="find-distributor">
                            <h3 class="text-color-delta my-3">{{$staticContent['find_a_distributor']}}</h3>
                            <div id="find-distributor" class="find-distributor-type">
                                @foreach ($continents_dis as $con_dis)
                                <?php
                                $set = false; 
                                foreach($distributor as $dis){
                                   if($dis->continent_id == $con_dis->id){
                                      $set = true;
                                      break;
                                   }
                                }
                                ?>
                                <div class="box-for-collap {{$set?'d-block':'d-none'}}">
                                    <div class="find-distributor-list  hide-box text-colour-delta "
                                        data-toggle="collapse" data-parent="#find-distributor-type"
                                        href="#collapse-fad-offi{{$con_dis->id}}">
                                        <h5>{{$con_dis->name}}</h5>
                                    </div>
                                    <div id="collapse-fad-offi{{$con_dis->id}}"
                                        class="find-distributor-list-sub collapse show"
                                        data-parent="#find-distributor-type">
                                        <div class="force-overflow">
                                            @foreach ($distributor as $dis)
                                            @if($dis->continent_id == $con_dis->id )
                                            <div class="find-distributor-address">
                                                <p class="text-sixteen-dark mr-b-1">{{$dis->title}}</p>
                                                <br>{{$dis->sub_title}}</p>
                                                <div class="text-editor mb-2">
                                                    {!!$dis->content!!}
                                                </div>
                                                <a href="https://www.google.com/maps/?q={{$dis->lat}},{{$dis->lon}}&sensor=true"
                                                    target="_blank">
                                                    <button class="btn-subscribe"> {{$staticContent['Get
                                                        Direction']}}</button>
                                                </a>
                                                @if($dis->status_cer == 1)
                                                <a href="{{config('app.url')}}/medias/distributor/{{$dis->file_cer}}"
                                                    download="">
                                                    <button class="btn-certi"><i
                                                            class="cer-icon icon-facon icon-web-certificate"></i> <span
                                                            class="f-btn">{{$staticContent['Certificates']}}</span></button>
                                                </a>
                                                @endif
                                            </div>
                                            @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade row" id="nav-applications" role="tabpanel" aria-labelledby="nav-applications">
                    <div id="result7" class="faqs-type w-100">
                        <div class="box-applications  ">
                            <div class="container">
                                <div class="grid-container">
                                    @foreach ($applications as $item)
                                    <a href="{{route('applicationDetail' ,[ 'name' => preg_replace('/\s+/', '-',$item->applica_id.'-'.$item->name)])}}"
                                        class="" style="">
                                        <div class="grid-item ">
                                            <div class="grid-sub-pic"
                                                style="background: url('{{config('app.url')}}/medias/categories/{{$item->thumbnail}}');">
                                                {{-- <img
                                                    src="{{config('app.url')}}/medias/categories/{{$item->thumbnail}}"
                                                    alt=""> --}}
                                            </div>
                                            <div class="grid-sub-text">
                                                <img src="{{config('app.url')}}/medias/categories/{{$item->color_icon}}"
                                                    alt="">
                                                <p class="">{{$item->name}}</p>

                                                <ul class="app-detail-bullet">
                                                    {{-- <li>Escalator & Elvator</li>
                                                    <li>CCTV Surveilance</li>
                                                    <li>HVAC Control</li> --}}
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
                                    @endforeach

                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


@section('js')
<script>
    function viewKey(key){
            var newkey = key.replace(/[/]/g,'@');
              event.preventDefault();
              window.location = '{{route('searchByTag')}}/'+newkey;
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
@endsection