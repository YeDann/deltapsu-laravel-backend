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
    /* .downloade-pdf img{
        vertical-align: text-top;
    } */
    .cd-products-columns{
        display: flex;
    }

   .cd-products-table{
    display: flex;
   }
   .clr-com{
    margin-top: 10px;
    cursor: pointer;
   }

</style>
@endsection
@section('meta')
<title>{{isset($metatag[0]->meta_title)? $metatag[0]->meta_title :''}}</title>
<meta name="description" content="{{isset($metatag[0]->meta_description)? $metatag[0]->meta_description :''}}">
<meta name="keywords" content="{{isset($metatag[0]->meta_key) ? $metatag[0]->meta_key :''}}">
@endsection
@section('container')
<div class="padding-top-content">
</div>
<div class="invisible-nav-minimize">
    <div class="products-index-nav">
        <div class="bg-bredcrumb">
            <div class="container">
                <nav aria-label="breadcrumb" id="breadcrumb">
                  
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item text-breadcrumb-home"><a href="{{route('index','home')}}">{{$staticContent['Home']}}</a></li>
                        <li class="breadcrumb-item active text-breadcrumb-home dropdown" aria-current="page"><a
                                href="#" data-toggle="dropdown" id="tools-dropdown"> {{$staticContent['Tools']}}</a>
                                <ul class="dropdown-menu">
                                    <li><a href="#" id="tools-dropdown" class="text-bold">{{$staticContent['Tools']}}</a></li>
                                    <hr>
                                    <li><a href="{{route('productFinder')}}">{{$staticContent['Product_Selector']}}</a></li>
                                <li><a href="{{route('configurableproduct')}}">{{$staticContent['configurable_power_selector']}}</a></li>
                                <li><a href="{{route('productCoparison')}}">{{$staticContent['product_comparison']}}</a></li>
                                </ul>   
                        </li>
                        <li class="breadcrumb-item active text-breadcrumb" aria-current="page"><a href="#">{{$staticContent['product_comparison']}}</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="padding-top-content-breadcrumb"></div>
    <div class="add-compare-nav">
        <div class="container">       
            <table class="table table-coparision-detail " style="border:0px">
                <thead>
                    <tr class="mr-12px">
                        <td class="col-xs-3">
                                <h3 class="">{{$staticContent['product_comparison']}}</h3>
                        </td>
                        <td class="col-xs-3 cc-box" style="padding-bottom:0px; position:relative">
                            <div >
                                <select onchange="selectprocom1('procomnav1')" id="procomnav1" class="form-control w-100 pr-4 onchagetype ">
                                    <option value="0">Please Select*</option>
                                    @foreach ($products as $item)
                                    <option value="{{$item->pro_id}}">{{$item->pro_code}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </td>
                        <td class="col-xs-3 cc-box" style="padding-bottom:0px; position:relative">
                            <div >
                                <select onchange="selectprocom2('procomnav2')" id="procomnav2" class="form-control w-100 pr-4 onchagetype">
                                    <option value="0">Please Select*</option>
                                    @foreach ($products as $item)
                                    <option  value="{{$item->pro_id}}">{{$item->pro_code}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </td>
                        <td class="col-xs-3 cc-box" style="padding-right:0px !important;  position:relative">
                            <div class="">
                                <select onchange="selectprocom3('procomnav3')" id="procomnav3" class="form-control w-100 pr-4 onchagetype">
                                    <option value="0">Please Select*</option>
                                    @foreach ($products as $item)
                                    <option  value="{{$item->pro_id}}">{{$item->pro_code}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </td>
                    </tr>
                </thead>
            </table>
        
        </div>
    </div>
    <div id="contentLodpdf" class="box-comparison mb-5">
        <div class="container">
            <h2 class="text-title-delta">{{$staticContent['product_comparison']}}</h2>
            <p class="text-center text-sixteen-dark">{{$staticContent['Type']}}</p>
            <div class="d-flex mb-3">
                <div class="mx-auto">
                    <select id="proType" class="form-control pr-4" onchange="chageProductType();">
                        <option value="0">{{$staticContent['Please_Select']}}*</option>
                        @foreach ($Categories as $item)
                    <option {{($item->sub_pro_id == $cateid ?"selected":"")}} value="{{$item->sub_pro_id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
             
            <button onclick="loadhtml();"  class="downloade-pdf btn btn-subscribe">{{$staticContent['Download_AS_PDF']}}</button>
            <form id="ContentCompare" action="{{route('loadPdffile')}}" method="POST">
                {{csrf_field()}}
                <input type="hidden" name="datacon" id="comtentcompare" >
                <input  type="hidden" name="arr_con" id="arr_con" >
                <input  type="hidden" name="type_name" id="typename" >
            </form>
            </div>
            
        
            <div class="box-product-comparison">
                <div class="_table-responsive" style="margin-top:-1px">
                    <table class="table table-coparision-detail " style="border:0px">
                    <tbody>
                        <tr >
                            <td class="col-xs-3">&nbsp;</td>

                        {{-- @foreach ($data_re as $result)
                        <td class="col-xs-3 cc-box" style="padding-bottom:0px; position:relative">
                            <img class="w-100" src="{{config('app.url')}}/upload/thumbs/{{$result->picture}}" alt="" >
                            <p class="text-center text-dark">{{$result->seName}}</p>
                            <p class="text-title-twentyfour-delta text-center">{{$result->pro_code}}</p>
                            <div class="btn-center">
                                <button class="btn-enquiry">ENQUIRY</button>
                            </div>
                        </td>
                        @endforeach --}}

                        <td id="imagepro_com1" class="col-xs-3 cc-box" style="padding-bottom:0px; position:relative">
                        
                        </td>
                        <td id="imagepro_com2" class="col-xs-3 cc-box" style="padding-bottom:0px; position:relative">
                        
                        </td>
                        <td id="imagepro_com3" class="col-xs-3 cc-box" style="padding-bottom:0px; position:relative">
                        
                        </td>
                
                        </tr>
                    </tbody>
                    <thead>
                            <tr>
                            <td class="col-xs-3 text-center"><div onclick="clearProduct();" class="clr-com">{{$staticContent['Clear_All']}}</div></td>
                            <td class="col-xs-3 cc-box" style="padding-bottom:0px; position:relative">
                            <div  >
                                <select onchange="selectprocom1('procom1')" id="procom1" class="form-control w-100 pr-4 onchagetype ">
                                    <option value="0">{{$staticContent['Please_Select']}}*</option>
                                    @foreach ($products as $item)
                                    <option  value="{{$item->pro_id}}">{{$item->pro_code}}</option>
                                    @endforeach
                                </select>
                            </div>
                            </td>
                            <td class="col-xs-3 cc-box" style="padding-bottom:0px; position:relative">
                                <div >
                                    <select onchange="selectprocom2('procom2')" id="procom2" class="form-control w-100 pr-4 onchagetype">
                                        <option value="0">{{$staticContent['Please_Select']}}*</option>
                                        @foreach ($products as $item)
                                        <option  value="{{$item->pro_id}}">{{$item->pro_code}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </td>
                            <td class="col-xs-3 cc-box" style="padding-right:0px !important;  position:relative">
                                <div >
                                    <select onchange="selectprocom3('procom3')" id="procom3" class="form-control w-100 pr-4 onchagetype">
                                        <option value="0">{{$staticContent['Please_Select']}}*</option>
                                        @foreach ($products as $item)
                                    <option  value="{{$item->pro_id}}">{{$item->pro_code}}</option>
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
                </div> 
        </div>
    </div>
    {{-- <div class="box-need-compare-product "
        style=" background: url('{{asset('frontend-asset/image/Find-Product-BG.jpg')}}');">
        <div class="container">
            <div class="box-need-compare-product-all">
                <h3 class="text-title-subscribe mb-5">{{$staticContent['Need_to_compare_other_product']}}</h3>
                <button class="btn btn-subscribe" onclick="selectNewProductByType();">{{$staticContent['Select_Product']}}</button>
            </div>
            
         <img  class="image-doc" src="{{asset('frontend-asset/image/NEEDCOMPAREOTHERPRODUCTS.png')}}" alt=""> 
        </div>
    </div> --}}
</div>
<div class="visible-nav-minimize">
    <div class="nav-enquiry-mobile">
        <div class="container">
            <div class="d-flex justify-content-between my-3">
                <div id="nav_mobilepro1" class="text-center mr-2 w-100">
            
                </div>
                <div id="nav_mobilepro2" class="text-center  ml-2 w-100">
                 
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <h3 class="text-title-delta">{{$staticContent['product_comparison']}}</h3>
        <h5 class="text-center">{{$staticContent['Type']}}</h5>
        <div class="d-flex justify-content-center mb-2">
            <select id="proType_mobile" class="form-control w-100 pr-4" onchange="chageProductTypeMobile();">
                <option value="0">{{$staticContent['Please_Select']}}*</option>
                @foreach ($Categories as $item)
            <option {{($item->sub_pro_id == $cateid ?"selected":"")}} value="{{$item->sub_pro_id}}">{{$item->name}}</option>
                @endforeach
            </select>
        </div>
        <h5 class="text-center">{{$staticContent['Model']}}</h5>
        <div class="d-flex justify-content-between mb-2" >
            <select onchange="onSelectPromobile()"  id="procom-mobile1" class="form-control w-100 pr-4 mr-2 onchagetype_mobile ">
                <option value="0">{{$staticContent['Please_Select']}}*</option>
                @foreach ($products as $item)
                <option value="{{$item->pro_id}}" >{{$item->pro_code}}</option>
                @endforeach
            </select>
            <input type="hidden" id="mobileindex" name="mobileindex" value="">
            <select onchange="onSelectPromobile2()" id="procom-mobile2" class="form-control w-100 pr-4 ml-2 onchagetype_mobile ">
                <option value="0">{{$staticContent['Please_Select']}}*</option>
                @foreach ($products as $item)
                <option value="{{$item->pro_id}}" >{{$item->pro_code}}</option>
                @endforeach
            </select>
            <input type="hidden" id="mobileindex2"  name="mobileindex2" value="">
        </div>
        <div class="product-comparison-selected-mobile">
            <div class="icon-pointer icon-prev">
                <a id="predata" onclick="BackData()" class="p-4" ><i class="zmdi zmdi-chevron-left" aria-hidden="true"></i></a>
            </div>
            <div  class="d-flex justify-content-between mb-3 ">
                {{-- <div class="text-center mr-2">
                    <img class="img-fluid w-75 mb-2" src="{{asset('frontend-asset/image/pro1.png')}}" alt="">
                    <p class="text-two">CHROME 24V 91W</p>
                    <h5 class="text-color-delta">DRC-24V100W1AZ</h5>
                    <a class="btn btn-enquiry w-100" href="">ENQUIRY</a>
                </div>
                --}}
                <div id="imagepro_com_mobile1" class="text-center mr-2"> 
                </div>
                <div id="imagepro_com_mobile2" class="text-center  ml-2"> 
                </div>
            </div>
            <div class="icon-pointer icon-next">
                <a id="nextdata" onclick="NextData()" class="p-4"><i class="zmdi zmdi-chevron-right" aria-hidden="true"></i></a>
            </div>
        </div>
        
        
    </div>
    <div class="download-pdf-mobile py-3">
        <div class="container">
            <div href="" class="btn btn-subscribe w-100 text-upercase" onclick="loadhtml();" >{{$staticContent['Download_AS_PDF']}}</div>
        </div>
    </div>
    <div id="comparison_mobile" class="comparison-collapse">
    </div>
    {{-- <div class="box-need-to-comparison" style="background-image: url('{{asset('frontend-asset/image/Find-Product-BG@2x.png')}}');">
        <h3 class="text-color-delta mb-5">{{$staticContent['Need_to_compare_other_product']}}</h3>
        <button onclick="selectNewProductByType();" class="btn btn-subscribe center">{{$staticContent['Select_Product']}}</button>
        <img class="img-fluid w-75 mb-2" src="{{asset('frontend-asset/image/NEEDCOMPAREOTHERPRODUCTS.png')}}" alt="">
    </div> --}}
</div>


@endsection


@section('js')
 

<script>
     $("#collapse-output").collapse('show');
     $("#collapse-input").collapse('show');
     $("#collapse-mechanical").collapse('show');
     /* nav show on div*/
    var offsetTop = $("#comparison").offset().top;
    $(window).scroll(function() {
        var scrollTop = $(window).scrollTop();
        if (scrollTop >= offsetTop) {
            $(".add-compare-nav").slideDown(500);
        }else{
            $(".add-compare-nav").fadeOut(); 
        }
        if (scrollTop >= 400) {
            $(".nav-enquiry-mobile").slideDown(500);
        }else{
            $(".nav-enquiry-mobile").fadeOut(); 
        }
    });
    var comArr = [];
    var sess_arr = <?= json_encode($sess_arr)?>;
    var pro1;
    var pro2;
    var pro3;
    var pd_field = <?= json_encode($pd_field);?>;
    var section = <?= json_encode($section);?>;
    var product_has_property = [];

    $(document).ready(function () {
        $.each(sess_arr, function(index,val){
            comArr.push(val);
        });
      if(comArr.length == 3){
        pro1 = comArr[0];
        pro2  = comArr[1];
        pro3  = comArr[2];
      }else if(comArr.length == 2){
        pro1 = comArr[0];
        pro2  = comArr[1];
        pro3  = 0;
        comArr[2] = 0;
        $('#nextdata').addClass('d-none');
        $('#predata').addClass('d-none');
      }else if(comArr.length == 1){
        pro1 = comArr[0];
        pro2  = 0;
        pro3  = 0;
        comArr[1]  = 0;
        comArr[2]  = 0;
        $('#nextdata').addClass('d-none');
        $('#predata').addClass('d-none');
      }else{
        pro1 = 0;
        pro2  = 0;
        pro3  = 0;
        comArr[0]  = 0;
        comArr[1]  = 0;
        comArr[2]  = 0;
        $('#nextdata').addClass('d-none');
        $('#predata').addClass('d-none');
      }
        
       
        setAllFrist(pro1 ,pro2 , pro3)
        contentLoad();
        // console.log(comArr);
     
    });
    function clearProduct(){
        pro1 = 0;
        pro2  = 0;
        pro3  = 0;
        $('#nextdata').addClass('d-none');
        $('#predata').addClass('d-none');
        setAllFrist(pro1 ,pro2 , pro3)
        $.ajax({
           url: "{{route('clearproductsection')}}",
           data: {
          'arr_pro': [ pro1 ,pro2 , pro3 ],
           },
           type: 'POST',
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
           success: function (res) {
            console.log(res);
           }
        });
        contentLoad();
       
    }
     function loadhtml(){
         var arrcon = [];
         arrcon.push(pro1);
         arrcon.push(pro2);
         arrcon.push(pro3);
         if(arrcon[0] == 0){
            alert('Please Select Model.');
         }else{
            $('#arr_con').val(arrcon);
            var typename = $( "#proType option:selected" ).text();
            $('#typename').val(typename);
            $('#comtentcompare').val($('#comparison').html());
            document.getElementById("ContentCompare").submit();
         }
     }
     function selectNewProductByType(){
        var typename = $( "#proType option:selected" ).text();
        var type_id = $('#proType').val();
        window.open('{{route('producsList')}}/'+typename+'/'+type_id);
     }

    function setAllFrist(pro1 ,pro2 , pro3){

        setproimage(pro1 ,1);
        setproimage(pro2 ,2);
        setproimage(pro3 ,3);
        loadSetImageMobile(pro1 ,1)
        loadSetImageMobile(pro2 ,2)
      $("#procom-mobile1 option[value="+pro1+"]").prop('selected', true);
      $("#procom-mobile2 option[value="+pro2+"]").prop('selected', true);
   
      $("#procom1 option[value="+pro1+"]").prop('selected', true);
      $("#procomnav1 option[value="+pro1+"]").prop('selected', true); 
      $("#procom2 option[value="+pro2+"]").prop('selected', true);
      $("#procomnav2 option[value="+pro2+"]").prop('selected', true); 
      $("#procom3 option[value="+pro3+"]").prop('selected', true);
      $("#procomnav3 option[value="+pro3+"]").prop('selected', true); 

    }
    var countItem  = 2;

    function NextData(){
       countItem  = countItem+2;
       if(countItem  >= 2 ){
        countItem  = 2;
        $('#nextdata').hide();
        $('#predata').show();
       }
       $("#procom-mobile1 option[value="+comArr[countItem-1]+"]").prop('selected', true);
       $("#procom-mobile2 option[value="+comArr[countItem]+"]").prop('selected', true);
       $('#mobileindex').val(countItem-1);
       $('#mobileindex2').val(countItem);
       loadSetImageMobile(comArr[countItem-1] ,1)
       loadSetImageMobile(comArr[countItem] ,2)
        pro1 = comArr[countItem-1];
        pro2  = comArr[countItem];
        contentloadMobile();
     
    }
    function BackData(){
        countItem  = countItem-2;
        if(countItem  <= 0 ){
            countItem  = 0;
            $('#predata').hide();
            $('#nextdata').show();
       }

       $("#procom-mobile1 option[value="+comArr[countItem]+"]").prop('selected', true);
       $("#procom-mobile2 option[value="+comArr[countItem+1]+"]").prop('selected', true);
       loadSetImageMobile(comArr[countItem] ,1)
       loadSetImageMobile(comArr[countItem+1],2)
       $('#mobileindex').val(countItem);
       $('#mobileindex2').val(countItem+1);
       pro1 = comArr[countItem];
       pro2  = comArr[countItem+1];
       contentloadMobile();
    }
    function pushtoArr(val ,pos){
        comArr[pos] = val;
      
    }
    
    function fidoldpo(val){
        var index = comArr.indexOf(val);
        return index;
    }
    function onSelectPromobile(){
      var newpro1 = $('#procom-mobile1').val();
      if(chedup(newpro1)){
        pushtoArr(newpro1 ,fidoldpo(pro1));
        pro1 = newpro1;
        $("#procom-mobile1 option[value="+pro1+"]").prop('selected', true);
        loadSetImageMobile(pro1,1);
        contentLoad();
      }else{
       alert('The selected model has been added to the Comparison list.');
       $("#procom-mobile1 option[value="+comArr[0]+"]").prop('selected', true);
      }
    }

    function onSelectPromobile2(){
      var newpro2 = $('#procom-mobile2').val();
      if(chedup(newpro2)){
        pushtoArr(newpro2 ,fidoldpo(pro2));
        pro2 = newpro2;
        $("#procom-mobile2 option[value="+newpro2+"]").prop('selected', true);
        loadSetImageMobile(newpro2,2);
        contentLoad();
      }else{
     
        alert('The selected model has been added to the Comparison list.');
        var indexset = $('#mobileindex2').val();
        if(indexset == 2){
            $("#procom-mobile2 option[value="+comArr[2]+"]").prop('selected', true);
        }else{
            $("#procom-mobile2 option[value="+comArr[1]+"]").prop('selected', true);
        }
      
        // if(fidoldpo(newpro2) == 0){
        //     $("#procom-mobile2 option[value="+comArr[0]+"]").prop('selected', true);
        // }else if(fidoldpo(newpro2) == 1){
        //     $("#procom-mobile2 option[value="+comArr[1]+"]").prop('selected', true);
        // }else if(fidoldpo(newpro2) == 2){
        //     $("#procom-mobile2 option[value="+comArr[2]+"]").prop('selected', true);
        // }
      
      }
    }

    function onloadmobileContent(){
       $("#procom-mobile1 option[value="+pro1+"]").prop('selected', true);
       $("#procom-mobile2 option[value="+pro2+"]").prop('selected', true);
       loadSetImageMobile(pro1,1);
       loadSetImageMobile(pro2,2);
       contentloadMobile();
    }
    function loadSetImageMobile(pro ,id){
              if(pro == null || ''){
                  pro = 0 ;
              }
            var arr = [pro];
            var url = '{{config('app.url')}}/upload/thumbs/';
            var html2 = '';
            var html3  = '';
  
           var t_id = $('#proType_mobile').val();
           var t_name = $('#proType_mobile option:selected').text();
           $.ajax({
           url: "{{route('loadImageProByArr')}}",
           data: {
          'arr_pro': arr,
          'typeid':t_id,
           },
           type: 'POST',
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
           success: function (res) {
            $.each(res['data'], function(index,val){
                html2 +=  '<div class="">';
                html2 +=  '<img class="img-fluid w-75 mb-2" src="'+url+val['picture']+'" alt="">';
                html2 +=  '  <p class="text-two">'+val['seName'] +'</p>';
                html2 += '<a target="_blank" href="'+link+'/'+t_name.replace(/ /g,"_")+'/'+val['pro_code']+'">';    
                html2 +=    '<h5 class="text-color-delta">'+val['pro_code']+'</h5>';
                html2 +=    '</a>';
                html2 += '   <a class="btn btn-enquiry w-100" href="{{route('LinktoEnquiry')}}/'+t_id+'/'+t_name+'/'+val['pro_code']+'">{{$staticContent['Enquiry']}}</a>';
                html2 += '</div>';     

                html3 += ' <p class="text-two">'+val['seName'] +'</p>';
                html3 += ' <h5 class="text-color-delta">'+val['pro_code']+'</h5>';
                html3 += '<a class="btn btn-enquiry w-100" href="{{route('LinktoEnquiry')}}/'+t_id+'/'+t_name+'/'+val['pro_code']+'">{{$staticContent['Enquiry']}}</a>'    
            });
               

             $('#imagepro_com_mobile'+id).html(html2);   
             $('#nav_mobilepro'+id).html(html3);   
          
           }
           });
     }
    function firstloadProductType(){
        contentLoad();
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

    function chageProductType(){
        pro1 = 0;
        pro2  = 0;
        pro3  = 0;
        contentLoad();
        setproimage(pro1 ,1);
        setproimage(pro2 ,2);
        setproimage(pro3 ,3);
        var typeId  =  $('#proType').val();
        $("#proType_mobile option[value="+typeId+"]").prop('selected', true);
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
           chageProductTypeMobile();
     
    }

    function chageProductTypeMobile(){
        pro1 = 0;
        pro2  = 0;
        pro3  = 0;
        comArr = [pro1 ,pro2, pro3 ];
        contentLoad();
        var mobileType =  $('#proType_mobile').val();
        $("#proType option[value="+mobileType+"]").prop('selected', true);
        $.ajax({
           url: "{{route('getProductByType')}}",
           data: {
          'typeId': mobileType,
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
            $('.onchagetype_mobile').html(html);
           }
           });

    }
    function chedup(proid){
         var index =  comArr.indexOf(proid);
     
        return index == -1;
    }
    
  
    function selectprocom1(clcom){
      var selectedId =  $('#'+clcom).val();
   
      if(chedup(selectedId)){
          pro1  = selectedId;
            pushtoArr(pro1 ,0);
            contentLoad();
            setproimage(pro1 ,1);
            $("#procomnav1 option[value="+selectedId+"]").prop('selected', true);
      }else{
        alert('The selected model has been added to the Comparison list.');
          $("#procom1 option[value="+comArr[0]+"]").prop('selected', true);
          $("#procomnav1 option[value="+comArr[0]+"]").prop('selected', true);
      }


    }
    function selectprocom2(clcom){
      var selectedId =  $('#'+clcom).val();
     
      if(chedup(selectedId)){
        pro2  = selectedId;
        pushtoArr(pro2 ,1);
        contentLoad();
        setproimage(pro2 ,2);
     
        $("#procom2 option[value="+selectedId+"]").prop('selected', true);
        $("#procomnav2 option[value="+selectedId+"]").prop('selected', true); 
      }else{
        alert('The selected model has been added to the Comparison list.');
        $("#procom2 option[value="+comArr[1]+"]").prop('selected', true);
        $("#procomnav2 option[value="+comArr[1]+"]").prop('selected', true); 
      }
    
    }
    function selectprocom3(clcom){
      var selectedId =  $('#'+clcom).val();
      if(chedup(selectedId)){
      pro3  = selectedId;
      pushtoArr(pro3 ,2);
      contentLoad();
      setproimage(pro3 ,3);
    
      $("#procom3 option[value="+selectedId+"]").prop('selected', true);
      $("#procomnav3 option[value="+selectedId+"]").prop('selected', true); 
      }else{
        alert('The selected model has been added to the Comparison list.');
        $("#procom3 option[value="+comArr[2]+"]").prop('selected', true);
        $("#procomnav3 option[value="+comArr[2]+"]").prop('selected', true); 
      }
    }
    function contentLoad(){
        loadnewPerti();  
    }
    function contentloadDesk(){
          var arrType3 = [];
           html = '';
           $.each(section, function(index,section){
           html += '<div class="box-for-collap">';
           html += '<div class="comparison-list   hide-box text-delta" data-toggle="collapse"  data-parent="#comparison-type"';
           html += 'href="#collapse-headCom'+section['id']+'" >';
           html += section['name']; 
           html += '</div>';
           html += ' <div id="collapse-headCom'+section['id']+'" class="comparison-list-sub collapse" aria-expanded="true" data-parent="#comparison-type">';
           html += '<div class="force-overflow">';
           html += '<table class="table table-coparision-detail">';
           html += '<tbody>';

            $.each(pd_field, function(index2,pd_val){
            if(section['id'] == pd_val['section_id']){

               if(checkdata(pd_val['id'],pro1,pd_val['type'] ,pd_val['unit_name']) && pro1 != 0
                || checkdata(pd_val['id'],pro2,pd_val['type'] ,pd_val['unit_name']) && pro2 != 0
                || checkdata(pd_val['id'],pro3,pd_val['type'] ,pd_val['unit_name']) && pro3 != 0){
                    if(section['id'] == 3){
                        arrType3.push(index2);
                        var lastindex = arrType3[arrType3.length - 1];
                      
                    }
                html += ' <tr id="addhtml'+lastindex+'">';

               }else{
                html += ' <tr class="d-none">';  
               }
       
           html += ' <td class="col-1 col-xs-3 '+index2+'">'+pd_val['field_name']+'</td>';
           html += '<td class="col-xs-3">'+search(pd_val['id'],pro1,pd_val['type'] ,pd_val['unit_name']) +'</td>';
           html += ' <td class="col-xs-3">'+search(pd_val['id'],pro2,pd_val['type'] ,pd_val['unit_name']) +'</td>';
           html += '<td class="col-xs-3">'+search(pd_val['id'],pro3,pd_val['type'] ,pd_val['unit_name']) +'</td>'
           html += '</tr>';
           }
        //    else if(section['id'] == 3){
         
        //     if( pro1 != 0
        //       || pro2 != 0
        //       || pro3 != 0){
        //      if(index2 == 0){
        //         html += '<tr id="addhtml3"></tr>'; 
        //         html += '<tr id="addhtmldi3"></tr>'; 
        //       }
        //       }
        //     }

            // if( pro1 != 0
            //     || pro2 != 0
            //     || pro3 != 0){
            //     html += ' <tr>';
            //    }else{
            //     html += ' <tr class="d-none">';  
            //    }
            // if(index2 == 0){
            //   html += ' <td class="col-1 col-xs-3">Dimensions</td>';
            //   html += '<td class="col-xs-3">'+getDimansion(pro1)+'</td>';
            //   html += ' <td class="col-xs-3">'+getDimansion(pro2) +'</td>';
            //   html += '<td class="col-xs-3">'+getDimansion(pro3)+'</td>'
            //   html += '</tr>';
            // }
         
         });
           html += '</tbody>';
           html += '</table>'; 
           html += '</div>';
           html += '</div>';
           html += '</div>';
           });
           $('#comparison').html(html);
           var lastindex = arrType3[arrType3.length - 1];
           addHtmlUnitweight(lastindex);
         addHtmlDimen(lastindex);
        //    console.log(arrType3);
           if(pro1 != 0 || pro2 != 0 || pro3 != 0){
            $.each(section, function(index,section){
                $('#collapse-headCom'+section['id']).addClass('show');
           });
           }
    }
    function getCalweight(proId){
       var data = getProduct(proId);
       return data['unitwight'];
    }
    function getDimansion(proId){
       var data = getProduct(proId);
       return data['dimension'];
    }
    function addHtmlUnitweight(index){
              html ='';
              html +='<tr>';
              html += ' <td class="col-1 col-xs-3">{{$staticContent['Unit_Weight']}}</td>';
              html += '<td class="col-xs-3">'+getCalweight(pro1)+'</td>';
              html += ' <td class="col-xs-3">'+getCalweight(pro2) +'</td>';
              html += '<td class="col-xs-3">'+getCalweight(pro3)+'</td>'
              html +='</tr>';
              $('#addhtml'+index).after(html);
    }
    function addHtmlDimen(index){
              html ='';
              html +='<tr>';
              html += ' <td class="col-1 col-xs-3">{{$staticContent['Dimensions']}}</td>';
              html += '<td class="col-xs-3">'+getDimansion(pro1)+'</td>';
              html += ' <td class="col-xs-3">'+getDimansion(pro2) +'</td>';
              html += '<td class="col-xs-3">'+getDimansion(pro3)+'</td>'
              html +='</tr>';
              $('#addhtml'+index).after(html);
    }
    function getProduct(id){
       var data =  [];
        $.ajax({
           url: "{{route('getProById')}}",
           data: {
          'proId': id,
           },
           type: 'POST',
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
           async: false,
           success: function (res) {
               data = res['data'];
           }
        });
       return data;
    }
    
    function contentloadMobile(){
        var html = '';
        $.each(section, function(index,section){
            html += '<div class="comparison-collapse-title " data-toggle="collapse" data-parent="#comparison-collapse"';
            html += 'href="#collapse-headCom_mobile'+section['id']+'">';
            html += ' <div class="container comparison-collapse-title-content">';
            html += '<h5>'+section['name']+'</h5>';
            html += '</div>';
            html += '</div>';
            html += '<div id="collapse-headCom_mobile'+section['id']+'" class="comparison-collapse-detail collapse show" >';
         $.each(pd_field, function(index2,pd_val){
            if(section['id'] == pd_val['section_id']){
                      if(checkdata(pd_val['id'],pro1,pd_val['type'] ,pd_val['unit_name']) && pro1 != 0
                || checkdata(pd_val['id'],pro2,pd_val['type'] ,pd_val['unit_name']) && pro2 != 0){
                html += ' <div>';
               }else{
                html += ' <div class="d-none">';  
               }
            html += ' <div class="comparison-heading">';
            html += ' <h6 class="text-center">'+pd_val['field_name']+'</h6>'
            html += '</div>';
            html += '<div class="comparison-detail">';
            html +=  '<div class="container comparison-detail-content">';
            html +=  ' <div class="comparison-detail-item mr-2">';
            html +=  '   <p class="text-two">'+search(pd_val['id'],pro1,pd_val['type'] ,pd_val['unit_name']) +'</p>';
            html +=  '</div>';
            html +=  ' <div class="comparison-detail-item ml-2">';
            html +=     ' <p class="text-two">'+search(pd_val['id'],pro2,pd_val['type'] ,pd_val['unit_name']) +'</p>';
            html += ' </div>';
            html +=  ' </div>';
            html +=   '</div>';
            html +=   '</div>';
            }else if(section['id'] == 3){
            if(pro1 != 0 || pro2 != 0){
             if(index2 == 0){
                html += ' <div class="comparison-heading">';
                html += ' <h6 class="text-center">{{$staticContent['Unit_Weight']}}</h6>'
                html += '</div>';
                html += '<div class="comparison-detail">';
                html +=  '<div class="container comparison-detail-content">';
                html +=  ' <div class="comparison-detail-item mr-2">';
                html +=  '   <p class="text-two">'+getCalweight(pro1) +'</p>';
                html +=  '</div>';
                html +=  ' <div class="comparison-detail-item ml-2">';
                html +=     ' <p class="text-two">'+getCalweight(pro2) +'</p>';
                html += ' </div>';
                html +=  ' </div>';
                html +=   '</div>';
             } 
             if(index2 == 0){
                html += ' <div class="comparison-heading">';
                html += ' <h6 class="text-center">{{$staticContent['Dimensions']}}</h6>'
                html += '</div>';
                html += '<div class="comparison-detail">';
                html +=  '<div class="container comparison-detail-content">';
                html +=  ' <div class="comparison-detail-item mr-2">';
                html +=  '   <p class="text-two">'+getDimansion(pro1) +'</p>';
                html +=  '</div>';
                html +=  ' <div class="comparison-detail-item ml-2">';
                html +=     ' <p class="text-two">'+getDimansion(pro2) +'</p>';
                html += ' </div>';
                html +=  ' </div>';
                html +=   '</div>';
             } 
          }
        }
         
            });

            html +=  '</div>';
        });
        $('#comparison_mobile').html(html);

    }
    var link = '{{route('productsDetailsByType')}}';
    function viewKey(key){
            var newkey = key.replace(/[/]/g,'@');
           return newkey;
    }
     function setproimage(pro ,id){
        console.log(pro ,id ,'setimage1');
             if(pro == null || ''){
                  pro = 0 ;
              }
            var arr = [pro];
            var url = '{{config('app.url')}}/upload/thumbs/';
            var html2 = '';
            var t_id = $('#proType').val();
            var t_name = $('#proType option:selected').text();
           $.ajax({
           url: "{{route('loadImageProByArr')}}",
           data: {
          'arr_pro': arr,
          'typeid': t_id,
           },
           type: 'POST',
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
           success: function (res) {
               console.log(res['data']);
            $.each(res['data'], function(index,val){
             html2 += '<img class="w-100" src="'+url+val['picture']+'" alt="" >';
             html2 += '<p class="text-center text-dark">'+val['seName'] +'</p>'; 
             html2 += '<a target="_blank" href="'+link+'/'+t_name.replace(/ /g,"_")+'/'+viewKey(val['pro_code'])+'">';      
             html2 += '<p class="text-title-twentyfour-delta text-center">'+val['pro_code']+'</p>'
             html2 += '</a>';    
             html2 += '<div class="btn-center">'; 
             html2 += '<a href="{{route('LinktoEnquiry')}}/'+t_id+'/'+t_name+'/'+viewKey(val['pro_code'])+'">';    
             html2 += '<button class="btn-enquiry">{{$staticContent['Enquiry']}}</button>';
             html2 += '</a>';    
             html2 += ' </div>';          
            });
             $('#imagepro_com'+id).html(html2);   
           }
           });
     }

    function search(fil_id ,proid ,type ,unit){
        var data_result = '-';
   
        if(type == 'number'){
            product_has_property.filter(function(data) {
               if(data['type_id'] == fil_id && data['product_id'] == proid){
                // if(data['data_5'] != null && data['data_4'] != null && data['data_3'] != null && data['data_2'] != null &&  data['data_1'] != null ){
                //   data_result = data['data_1'] +unit+ ','+data['data_2'] +unit+ ','+ data['data_3'] +unit+ ','+ data['data_4'] +unit+ ','+ data['data_5'] +unit  ;
                // }else if(data['data_4'] != null && data['data_3'] != null && data['data_2'] != null &&  data['data_1'] != null ){
                //   data_result = data['data_1'] +unit+ ','+data['data_2'] +unit+ ','+ data['data_3'] +unit+ ','+ data['data_4'] +unit ;
                // }else if(data['data_3'] != null && data['data_2'] != null &&  data['data_1'] != null ){
                //     data_result = data['data_1'] +unit+ ','+data['data_2'] +unit+ ','+ data['data_3'] +unit  ;
                // }else if( data['data_2'] != null &&  data['data_1'] != null ){
                //     data_result = data['data_1'] +unit+ ','+data['data_2'] +unit ;
                // }else if(data['data_1'] != null ){
                //     data_result = data['data_1'] +unit;
                // }else{
                   
                // }  
                var datarr = [
                     data['data_1'],
                     data['data_2'],
                     data['data_3'],
                     data['data_4'],
                     data['data_5'],
                     data['data_6'],
                     data['data_7'],
                     data['data_8'],
                     data['data_9'],
                     data['data_10'],
                     data['data_11'],
                     data['data_12']
                ];
                data_result = checkNull(datarr,unit,data['status_input']);
              }
           });
         
        }else if(type == 'text') {
            product_has_property.filter(function(data) {
            if(data['type_id'] == fil_id && data['product_id'] == proid){
                if(data['value_text'] != null && data['value_text'] != 'null' ){
                    data_result = data['value_text'];
                }
               
            }
            });
        }
       
        return data_result;
       
    }


    function checkdata(fil_id ,proid ,type ,unit){
        var data_result = false;
        if(type == 'text'){
            product_has_property.filter(function(data) {
            if(data['type_id'] == fil_id && data['product_id'] == proid){
                if(data['value_text'] != null && data['value_text'] != '' && data['value_text'] != 'null' ){
                    data_result = true;
                }else{
                    data_result = false;
                }
               
            }
        });
        }else if(type == 'number'){
            product_has_property.filter(function(data) {
               if(data['type_id'] == fil_id && data['product_id'] == proid){
                // if(data['data_5'] != null && data['data_4'] != null && data['data_3'] != null && data['data_2'] != null &&  data['data_1'] != null ){
                //     data_result = true;
                // }
                // else if(data['data_5'] != null && data['data_4'] != null && data['data_3'] != null && data['data_2'] != null &&  data['data_1'] != null ){
                //     data_result = true;
                // }
                // else if(data['data_5'] != null && data['data_4'] != null && data['data_3'] != null && data['data_2'] != null &&  data['data_1'] != null ){
                //     data_result = true;
                // }
                // else if(data['data_4'] != null && data['data_3'] != null && data['data_2'] != null &&  data['data_1'] != null ){
                //     data_result = true;
                // }else if(data['data_3'] != null && data['data_2'] != null &&  data['data_1'] != null ){
                //     data_result = true;
                // }else if( data['data_2'] != null &&  data['data_1'] != null ){
                //     data_result = true;
                // }else if(data['data_1'] != null){
                //     data_result = true;
                // }else{
                //     data_result = false;
                // }  
                var datarr = [
                     data['data_1'],
                     data['data_2'],
                     data['data_3'],
                     data['data_4'],
                     data['data_5'],
                     data['data_6'],
                     data['data_7'],
                     data['data_8'],
                     data['data_9'],
                     data['data_10'],
                     data['data_11'],
                     data['data_12']
                ];
                var areAllNotNull = datarr.some(function(i) {
                    
                     return i !== null;
                });
             
                if(areAllNotNull){
                    data_result = true;
                }else{
                    data_result = false;
                }
             


              }
           });
         
        }else{
            data_result = false;
        }
        if(data_result == ''){
            data_result = false;
        }
  
        return data_result;
       
    }
    function  loadnewPerti(){
        $.ajax({
           url: "{{route('loadnewPerti')}}",
           data: {
          'arrpro': comArr,
           },
           type: 'POST',
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
           success: function (res) {
            product_has_property = res.data;
            onloadmobileContent();
            contentloadDesk();
           }
           });

    }

    function checkNull(dataarr,unit,status){
        var string = '';
        var arrstri = [];
       if(status == 1 || status == 2){
        $.each(dataarr, function(index,data){
            if(data != null && data != ''){
              arrstri.push(data+unit);
            }
        });
        string = arrstri.join();
       }else if(status == 3){
        string = dataarr[0]+'-'+dataarr[1]+unit;
       }
         return  string;
    }
 

</script>

@endsection