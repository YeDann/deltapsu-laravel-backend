@extends('layouts.front-end')
@section('css')
<style>
 
    td .select-selected{
        padding: 8px 11px;
    }
    
    td .select-items div{
        padding: 8px 26px;
    }
    td .select-selected,td .select-items div{
        text-transform: none;
    }
    .box-comparison-list.collapsed{
        color: #444444 ;
    }
    /* test */
    .comparison-type .comparison-list:after {
    font-family: 'Material-Design-Iconic-Font';
    content: "\f273";
    float: right;
    font-size: 24px;
    color: #444444;
    }

    .comparison-type .comparison-list.collapsed:after {
        /* symbol for "collapsed" panels */
        content: "\f278";
    }

    .comparison-list {
        font-size: 20px;
        line-height: 30px;
        font-family: 'ArialUnicodeMS';
        font-weight: bolder;
        padding: 1rem 5px;
        margin-bottom: -2px;
        
    }
    
    .comparison-list-sub {
        padding: 12px;
    }
    .force-overflow {
    min-height: 200px;
    }
  
    .comparison-list.collapsed{
        color: #444444 ;
    }
    .col-xs-3 {
        width: 25%;
    }
    .add-compare-nav .container {
        display: flex;
        justify-content: space-between;
        height: 100%;
        padding: 14px 0;
    }
    .box-comparison .container{
        position: relative;
    }
    .downloade-pdf{
        position: absolute;
        right: 16px;
    }
    .downloade-pdf img{
        vertical-align: text-top;
    }
    .cd-products-columns{
        display: flex;
    }

   .cd-products-table{
    display: flex;
   }

</style>
@endsection

@section('container')
<div class="padding-top-content">
</div>
<div class="products-index-nav">
    <div class="bg-bredcrumb">
        <div class="container">
            <nav aria-label="breadcrumb" id="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item text-breadcrumb-home"><a href="{{route('index','home')}}">HOME</a></li>
                    <li class="breadcrumb-item active text-breadcrumb-home dropdown" aria-current="page"><a
                            href="#" data-toggle="dropdown" id="tools-dropdown">TOOLS</a>
                            <ul class="dropdown-menu">
                                <li><a href="#" id="tools-dropdown" class="text-bold">TOOLS</a></li>
                                <hr>
                                <li><a href="{{route('productFinder')}}">PRODUCT SELECTOR</a></li>
                            <li><a href="{{route('configurableproduct')}}">CONFIGURABLE POWER SELECTOR</a></li>
                            <li><a href="{{route('productCoparison')}}">PRODUCT COMPARISION</a></li>
                              </ul>   
                    </li>
                    <li class="breadcrumb-item active text-breadcrumb" aria-current="page"><a href="#">PRODUCT COMPARISON</a></li>

                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="add-compare-nav">
    <div class="container">       
        <table class="table table-coparision-detail " style="border:0px">
            <thead>
                <tr class="mr-12px">
                    <td class="col-xs-3">
                            <p class="text-title-twentyfour">PRODUCT COPARISON</p>
                    </td>
                    <td class="col-xs-3 cc-box" style="padding-bottom:0px; position:relative">
                        <div >
                            <select onchange="selectprocom1('procomnav1')" id="procomnav1" class="form-control w-100 pr-4 onchagetype ">
                                <option value="0">Please Select*</option>
                                @foreach ($products as $item)
                                <option {{(isset($sess_arr[0]) && $item->pro_id == $sess_arr[0] ?"selected":"")}} value="{{$item->pro_id}}">{{$item->pro_code}}</option>
                                 @endforeach
                            </select>
                        </div>
                    </td>
                    <td class="col-xs-3 cc-box" style="padding-bottom:0px; position:relative">
                        <div >
                            <select onchange="selectprocom2('procomnav2')" id="procomnav2" class="form-control w-100 pr-4 onchagetype">
                                <option value="0">Please Select*</option>
                                @foreach ($products as $item)
                                <option {{(isset($sess_arr[1]) && $item->pro_id == $sess_arr[1] ?"selected":"")}} value="{{$item->pro_id}}">{{$item->pro_code}}</option>
                                 @endforeach
                            </select>
                        </div>
                    </td>
                    <td class="col-xs-3 cc-box" style="padding-right:0px !important;  position:relative">
                        <div class="">
                            <select onchange="selectprocom3('procomnav3')" id="procomnav3" class="form-control w-100 pr-4 onchagetype">
                                <option value="0">Please Select*</option>
                                @foreach ($products as $item)
                                <option {{(isset($sess_arr[2]) && $item->pro_id == $sess_arr[2] ?"selected":"")}} value="{{$item->pro_id}}">{{$item->pro_code}}</option>
                                 @endforeach
                            </select>
                        </div>
                    </td>
                </tr>
            </thead>
        </table>
    
    </div>
</div>
<div class="box-comparison">
    <div class="container">
        <p class="text-title text-center">PRODUCT COMPARISON</p>
        <p class="text-center text-sixteen-dark">TYPE</p>
        <div class="d-flex">
            <div class="mx-auto">
                <select id="proType" class="form-control pr-4" onchange="chageProductType();">
                    <option value="0">Please Select*</option>
                    @foreach ($Categories as $item)
                   <option {{($item->sub_pro_id == $cateid ?"selected":"")}} value="{{$item->sub_pro_id}}">{{$item->name}}</option>
                    @endforeach
                </select>
            </div>
            <a href="" class="downloade-pdf text-bold"><img src="{{asset('frontend-asset/image/downlode.svg')}}" alt=""> DOWNLOAD PDF</a>
        </div>
        
      
        <div class="box-product-coparison">
            <div class="_table-responsive" style="margin-top:-1px">
                <table class="table table-coparision-detail " style="border:0px">
                <tbody>
                    <tr>
                    <td class="col-xs-3">Clear All</td>
                    <td class="col-xs-3 cc-box" style="padding-bottom:0px; position:relative">
                        <img class="w-100" src="{{asset('frontend-asset/image/pro1.png')}}" alt="" >
                        <p class="text-center text-dark">CHROME 24V 91W</p>
                        <p class="text-title-twentyfour-delta text-center">DRC-24V100W1AZ</p>
                        <div class="btn-center">
                            <button class="btn-enquiry">ENQUIRY</button>
                        </div>
                    </td>
                    <td class="col-xs-3 cc-box" style="padding-bottom:0px; position:relative">
                        <img class="w-100" src="{{asset('frontend-asset/image/pro1.png')}}" alt="">
                        <p class="text-center text-dark">CHROME 24V 91W</p>
                        <p class="text-title-twentyfour-delta text-center">DRC-24V100W1AZ</p>
                        <div class="btn-center">
                            <button class="btn-enquiry">ENQUIRY</button>
                        </div>
                    </td>
                    <td class="col-xs-3 cc-box" style="padding-bottom:0px !important;  position:relative">
                        <img class="w-100" src="{{asset('frontend-asset/image/pro1.png')}}" alt="">
                        <p class="text-center text-dark">CHROME 24V 91W</p>
                        <p class="text-title-twentyfour-delta text-center">DRC-24V100W1AZ</p>
                        <div class="btn-center">
                            <button class="btn-enquiry">ENQUIRY</button>
                        </div>
                              
                    </td>
                    </tr>
                </tbody>
                <thead>
                        <tr>
                        <td class="col-xs-3">&nbsp;</td>
                        <td class="col-xs-3 cc-box" style="padding-bottom:0px; position:relative">
                        <div  >
                            <select onchange="selectprocom1('procom1')" id="procom1" class="form-control w-100 pr-4 onchagetype ">
                                <option value="0">Please Select*</option>
                                 @foreach ($products as $item)
                                <option {{(isset($sess_arr[0]) && $item->pro_id == $sess_arr[0] ?"selected":"")}} value="{{$item->pro_id}}">{{$item->pro_code}}</option>
                                 @endforeach
                            </select>
                         </div>
                        </td>
                        <td class="col-xs-3 cc-box" style="padding-bottom:0px; position:relative">
                            <div >
                                <select onchange="selectprocom2('procom2')" id="procom2" class="form-control w-100 pr-4 onchagetype">
                                    <option value="0">Please Select*</option>
                                    @foreach ($products as $item)
                                    <option {{(isset($sess_arr[1]) && $item->pro_id == $sess_arr[1] ?"selected":"")}} value="{{$item->pro_id}}">{{$item->pro_code}}</option>
                                     @endforeach
                                </select>
                            </div>
                        </td>
                        <td class="col-xs-3 cc-box" style="padding-right:0px !important;  position:relative">
                            <div >
                                <select onchange="selectprocom3('procom3')" id="procom3" class="form-control w-100 pr-4 onchagetype">
                                    <option value="0">Please Select*</option>
                                    @foreach ($products as $item)
                                   <option {{(isset($sess_arr[2]) && $item->pro_id == $sess_arr[2] ?"selected":"")}} value="{{$item->pro_id}}">{{$item->pro_code}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </td>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
       
       <div id="comparison" class="comparison-type">
                <div class="box-for-collap">
                    <div class="comparison-list collapsed  hide-box text-delta" data-toggle="collapse" data-parent="#comparison-type"
                            href="#collapse-output" >
                            OUTPUT
                           
                    </div>
                    <div id="collapse-output" class="comparison-list-sub collapse" data-parent="#comparison-type">
                        <div class="force-overflow">
                             <table class="table table-coparision-detail">
                                <tbody>
                                    <tr>
                                        <td class="col-1 col-xs-3">Nominal Output Voltage</td>
                                        <td class="col-xs-3">12V</td>
                                        <td class="col-xs-3">12V</td>
                                        <td class="col-xs-3">19V</td>
                                    </tr>
                                    <tr>
                                        <td class="col-1 col-xs-3">Output Current</td>
                                        <td class="col-xs-3">5A </td>
                                        <td class="col-xs-3">5A </td>
                                        <td class="col-xs-3">3.2A </td>
                                    </tr>
                                    <tr>
                                        <td class="col-1 col-xs-3">Output Power</td>
                                        <td class="col-xs-3">60W</td>
                                        <td class="col-xs-3">60W</td>
                                        <td class="col-xs-3">60.8W</td>
                                    </tr>
                                    <tr>
                                        <td class="col-1 col-xs-3">Line Regulation</td>
                                        <td class="col-xs-3">± 1%</td>
                                        <td class="col-xs-3">± 1%</td>
                                        <td class="col-xs-3">± 1%</td>
                                    </tr>
                                    <tr>
                                        <td class="col-1 col-xs-3">Load Regulation</td>
                                        <td class="col-xs-3">± 5.0%</td>
                                        <td class="col-xs-3">± 5.0%</td>
                                        <td class="col-xs-3">± 3.0%</td>
                                    </tr>
                                    <tr>
                                        <td class="col-1 col-xs-3">PARD</td>
                                        <td class="col-xs-3">0°C to 40°C: &lt; 240mVpp<br>-10°C to 0°C: &lt; 480mVpp</td>
                                        <td class="col-xs-3">0°C to 40°C: &lt; 240mVpp<br>-10°C to 0°C: &lt; 480mVpp</td>
                                        <td class="col-xs-3">0°C to 40°C: &lt; 380mVpp<br>-10°C to 0°C: &lt; 760mVpp</td>
                                    </tr>
                                    <tr>
                                        <td class="col-1 col-xs-3">Start-up Time</td>
                                        <td class="col-xs-3">1000ms (typ.) at 115Vac, 500ms (typ.) at 230Vac</td>
                                        <td class="col-xs-3">1000ms (typ.) at 115Vac, 500ms (typ.) at 230Vac</td>
                                        <td class="col-xs-3">1000ms (typ.) at 115Vac, 500ms (typ.) at 230Vac</td>
                                    </tr>
                                    <tr>
                                        <td class="col-1 col-xs-3">Hold-up Time</td>
                                        <td class="col-xs-3">12ms (typ.) at 115Vac, 60ms (typ.) at 230Vac</td>
                                        <td class="col-xs-3">12ms (typ.) at 115Vac, 60ms (typ.) at 230Vac</td>
                                        <td class="col-xs-3">12ms (typ.) at 115Vac, 60ms (typ.) at 230Vac</td>
                                    </tr>
                                    <tr>
                                        <td class="col-1 col-xs-3">Parallel Connection</td>
                                        <td class="col-xs-3">No</td>
                                        <td class="col-xs-3">No</td>
                                        <td class="col-xs-3">No</td>
                                    </tr>
                                    <tr>
                                        <td class="col-1 col-xs-3">Series Connection</td>
                                        <td class="col-xs-3">No</td>
                                        <td class="col-xs-3">No</td>
                                        <td class="col-xs-3">No</td>
                                    </tr>
                                    <tr>
                                        <td class="col-1 col-xs-3">Nominal Output Voltage</td>
                                        <td class="col-xs-3">12V</td>
                                        <td class="col-xs-3">12V</td>
                                        <td class="col-xs-3">19V</td>
                                    </tr>
                                </tbody>
                            </table>   
                        </div>
                    </div>
                </div>
                <div class="box-for-collap">
                    <div class="comparison-list collapsed  hide-box text-delta" data-toggle="collapse" data-parent="#comparison-type"
                        href="#collapse-input">
                       INPUT
                    </div>
                    <div id="collapse-input" class="comparison-list-sub collapse" data-parent="#comparison-type">
                        <div class="force-overflow">
                            <table class="table table-coparision-detail">
                                <tbody>

                                    <tr>
                                        <td class="col-1 col-xs-3">Nominal Input Voltage</td>
                                        <td class="col-xs-3">100-240Vac</td>
                                        <td class="col-xs-3">100-240Vac</td>
                                        <td class="col-xs-3">100-240Vac</td>
                                    </tr>
                                    <tr>
                                        <td class="col-1 col-xs-3">Input Voltage Range</td>
                                        <td class="col-xs-3">85-264Vac</td>
                                        <td class="col-xs-3">85-264Vac</td>
                                        <td class="col-xs-3">85-264Vac</td>
                                    </tr>
                                    <tr>
                                        <td class="col-1 col-xs-3">Nominal Input Frequency</td>
                                        <td class="col-xs-3">50-60Hz</td>
                                        <td class="col-xs-3">50-60Hz</td>
                                        <td class="col-xs-3">50-60Hz</td>
                                    </tr>
                                    <tr>
                                        <td class="col-1 col-xs-3">Input Frequency Range</td>
                                        <td class="col-xs-3">47-63Hz</td>
                                        <td class="col-xs-3">47-63Hz</td>
                                        <td class="col-xs-3">47-63Hz</td>
                                    </tr>
                                    <tr>
                                        <td class="col-1 col-xs-3">Input Current</td>
                                        <td class="col-xs-3">1.4A max. at 115Vac, 1.0A max. at 230Vac</td>
                                        <td class="col-xs-3">1.4A max. at 115Vac, 1.0A max. at 230Vac</td>
                                        <td class="col-xs-3">1.4A max. at 115Vac, 1.0A max. at 230Vac</td>
                                    </tr>
                                    <tr>
                                        <td class="col-1 col-xs-3">Efficiency at 100% load</td>
                                        <td class="col-xs-3">87.6% typ. at 115Vac, 90.2% typ. at 230Vac</td>
                                        <td class="col-xs-3">87.6% typ. at 115Vac, 90.2% typ. at 230Vac</td>
                                        <td class="col-xs-3">88.1% typ. at 115Vac, 90.3% typ. at 230Vac</td>
                                    </tr>
                                    <tr>
                                        <td class="col-1 col-xs-3">Leakage Current</td>
                                        <td class="col-xs-3">0.1mA @ 240Vac/50Hz (max.)</td>
                                        <td class="col-xs-3">0.1mA @ 240Vac/50Hz (max.)</td>
                                        <td class="col-xs-3">0.1mA @ 240Vac/50Hz (max.)</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="box-for-collap">
                    <div class="comparison-list collapsed  hide-box text-delta" data-toggle="collapse" data-parent="#comparison-type"
                        href="#collapse-mechanical">
                        MECHANICAL
                    </div>
                    <div id="collapse-mechanical" class="comparison-list-sub collapse" data-parent="#comparison-type">
                        <div class="force-overflow">
                            <table class="table table-coparision-detail">
                                        <tbody>
                                    
                                            <tr>
                                                <td class="col-1 col-xs-3">Case Chassis / Cover</td>
                                                <td class="col-xs-3">PC</td>
                                                <td class="col-xs-3">PC</td>
                                                <td class="col-xs-3">PC</td>
                                            </tr>
                                            <tr>
                                                <td class="col-1 col-xs-3">Dimensions</td>
                                                <td class="col-xs-3">108 x 46 x 29.5 mm<br>4.25" x 1.81" x 1.16"</td>
                                                <td class="col-xs-3">108 x 46 x 29.5 mm<br>4.25" x 1.81" x 1.16"</td>
                                                <td class="col-xs-3">108 x 46 x 29.5 mm<br>4.25" x 1.81" x 1.16"</td>
                                            </tr>
                                            <tr>
                                                <td class="col-1 col-xs-3">Unit Weight</td>
                                                <td class="col-xs-3">0.18 kg</td>
                                                <td class="col-xs-3">0.18 kg</td>
                                                <td class="col-xs-3">0.18 kg</td>
                                            </tr>
                                            <tr style="display: none;">
                                                <td class="col-1 col-xs-3">Indicator</td>
                                                <td class="col-xs-3"></td>
                                                <td class="col-xs-3"></td>
                                                <td class="col-xs-3"></td>
                                            </tr>
                                            <tr>
                                                <td class="col-1 col-xs-3">Cooling System</td>
                                                <td class="col-xs-3">Convection</td>
                                                <td class="col-xs-3">Convection</td>
                                                <td class="col-xs-3">Convection</td>
                                            </tr>
                                        </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> 
    </div>
</div>
<!-- <div class="box-need-compare-product "
    style=" background: url('{{asset('frontend-asset/image/Find-Product-BG.jpg')}}');">
    <div class="container">
        <div class="box-need-compare-product-all">
            <p class="text-title-subscribe">NEED TO COMPARE OTHER PRODUCTS?</p>
           
            <button class="btn btn-subscribe" href="">SELECT PRODUCT</button>
        </div>
    </div>
</div> -->

@endsection


@section('js')
<script>
     $("#collapse-output").collapse('show');
     $("#collapse-input").collapse('show');
     $("#collapse-mechanical").collapse('show');
     /* nav show on div*/
    var offsetTop = $(".box-comparison").offset().top;
    $(window).scroll(function() {
        var scrollTop = $(window).scrollTop();
        if (scrollTop >= offsetTop) {
            $(".add-compare-nav").slideDown(500);
        }else{
            $(".add-compare-nav").fadeOut(); 
        }
    });

    function chageProductType(){
        var typeId  =  $('#proType').val();
        $.ajax({
           url: "{{route('getProductByType')}}",
           data: {
          'typeId': typeId,
           },
           type: 'POST',
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
           success: function (res) {
            var html = '';
            html += '<option value="0">Please Select*</option>';
            $.each(res['data'], function(index,val){
            html += ' <option  value="'+val['pro_id']+'">'+val['pro_code']+'</option>';
            });
            $('.onchagetype').html(html);
           }
           });
    }
    function selectprocom1(clcom){
      var selectedId =  $('#'+clcom).val();
`      $("#procom1 option[value="+selectedId+"]").prop('selected', true);`
      $("#procomnav1 option[value="+selectedId+"]").prop('selected', true); 
    }
    function selectprocom2(clcom){
      var selectedId =  $('#'+clcom).val();
      $("#procom2 option[value="+selectedId+"]").prop('selected', true);
      $("#procomnav2 option[value="+selectedId+"]").prop('selected', true); 
    }
    function selectprocom3(clcom){
      var selectedId =  $('#'+clcom).val();
      $("#procom3 option[value="+selectedId+"]").prop('selected', true);
      $("#procomnav3 option[value="+selectedId+"]").prop('selected', true); 
    }

</script>
@endsection