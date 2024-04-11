@extends('layouts.front-end')
@section('css')
<link rel="stylesheet" href="{{asset('/frontend-asset/css/vanilla-calendar-min.css')}}">
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

    .table thead th {
        vertical-align: middle !important;
    }


    tbody td {
        border-top: 2px solid #E3EFF8 !important;
        border-bottom: 2px solid #E3EFF8;
    }

    tbody td:first-child {
        border-left: 2px solid #E3EFF8;
    }

    tbody td:last-child {
        border-right: 2px solid #E3EFF8;
    }

    .text-middle-td {
        padding: 1rem !important;
    }

    .table td,
    .table th {
        padding: unset;
    }

    .table th {
        padding: 3px 10px !important;
    }

    .list-group {
        margin-top: 20px;
    }

    .select-minimize {
        width: 60px !important;
    }

    .box-news-detail {
        border: 2px solid #E3EFF8;
        padding: 24px;
    }

    /* tab */
    .calendar-month-tab input {
        display: none;
    }

    /* hide radio buttons */
    input+label {
        /*  display: inline-block ; */
        margin-bottom: -2px;
        cursor: pointer;
    }

    /* show labels in line */
    .calendar-month-tab {
        border-bottom: 2px solid #E3EFF8;
        margin-bottom: 1em;
        display: flex;
        justify-content: space-around;
    }

    input:checked+label {
        border-bottom: 2px solid #0087DC;
    }

    #next-year::before,
    #last-year::before {
        position: absolute;
        bottom: -8px;
        font-family: 'FontAwesome';
        color: #0087DC;
        font-size: 24px;
        cursor: pointer;
    }

    #next-year::before {
        left: 0;
        content: "\f054";
        margin-left: 24px;
    }

    #last-year::before {
        right: 0;
        content: "\f053";
        margin-right: 24px;
    }

    .calendar-year-tab a {
        height: 24px;
        position: relative;
    }

    .calendar-year-tab a:hover {
        text-decoration: none;
    }

    .scrollbar {
        overflow-y: scroll;
        height: 278px;
    }

    .img-event-slide {
        height: 160px;
    }

    .event-content-text .post-meta {
        font-size: 12px;
    }

    .read-more-slide {
        font-size: 12px;
        font-weight: bold;
        color: #5F5F5F;
    }

    .read-more-slide:hover {
        text-decoration: none !important;
    }

    .product-launch-list {
        padding-right: 2rem;
        padding-left: 2rem;
        padding-bottom: 1.5rem;
        padding-top: 1.5rem;
        border-bottom: 2px solid#E3EFF8;

    }

    .text-h-table {
        color: #0087DC;
        font-weight: bold;
        margin-top: 2rem;
    }
</style>
@endsection
@section('meta')
<title>{{isset($metatag[0]->title)? $metatag[0]->title :''}}</title>
<meta name="description" content="{{isset($metatag[0]->description)? $metatag[0]->description :''}}">
<link rel="canonical" href="{{url()->current()}}" />
<?php 
  $lang_seo = App::getLocale();
  if($lang_seo == 'cn'){
    $lang_seo = 'zh-Hans-CN';
  }else if($lang_seo == 'tw'){
    $lang_seo = 'zh-Hans-TW';
  }
?>
<link rel="alternate" href="{{url()->current()}}" hreflang="{{$lang_seo}}" />
@endsection
@section('container')
<div class="padding-top-content">
</div>
<div class="products-index-nav visible-up-922">
    <div class="bg-bredcrumb">
        <div class="container">
            <nav aria-label="breadcrumb" id="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item text-breadcrumb-home"><a
                            href="{{route('index','home')}}">{{$staticContent['Home']}}</a></li>
                    {{-- <li class="breadcrumb-item active text-breadcrumb-home dropdown" aria-current="page"><a
                            href="#" data-toggle="dropdown" id="tools-dropdown">RESOURCES</a>
                        <ul class="dropdown-menu">
                            <li><a href="#" id="tools-dropdown" class="text-bold">RESOURCES</a></li>
                            <hr>
                            <li><a href="{{route('index','catalogs')}}">CATALOGS</a></li>
                            <li><a href="{{route('index','product-documents')}}">PRODUCT DOCUMENTS</a></li>
                            <li><a href="{{route('index','login')}}">PARTNERS</a></li>
                        </ul>
                    </li> --}}
                    <li class="breadcrumb-item active text-breadcrumb-home" aria-current="page"><a
                            href="#">{{$staticContent['Partners']}}</a></li>
                    <li class="breadcrumb-item active text-breadcrumb-home" aria-current="page"><a
                            href="{{route('marketingResources')}}">{{$staticContent['Marketing_Resources']}}</a></li>
                    <li class="breadcrumb-item active text-breadcrumb" aria-current="page"><a href="#">
                            {{$staticContent['Product_launch_Schedule']}}</a></li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="padding-top-content-breadcrumb visible-up-922"></div>
<div class="box-events mb-5">
    <div class="container">
        <h1 class="text-title-delta visible-up-922">{{$staticContent['Product_launch_Schedule']}}</h1>
        <h3 class="text-title-delta invisible-up-922">{{$staticContent['Product_launch_Schedule']}}</h3>
        <div class="calendar-year-tab d-flex justify-content-center mr-24px">
            <a id="last-year" onclick="Years(-1)"></a>
            <h3 id="count-year">2019</h3>
            <a id="next-year" onclick="Years(1)"></a>
        </div>
        <select id="select-events" onchange="selectMonthPicker();" class="select-minimize invisible-up-922 mb-4">
            <option value="00">JAN</option>
            <option value="01">FEB</option>
            <option value="02">MAR</option>
            <option value="03">APR</option>
            <option value="04">MAY</option>
            <option value="05">JUN</option>
            <option value="06">JUL</option>
            <option value="07">AUG</option>
            <option value="08">SEP</option>
            <option value="09">OCT</option>
            <option value="10">NOV</option>
            <option value="11">DEC</option>
        </select>
        <div class="calendar-month-tab visible-up-922">
            <input type="radio" name="tabs" id="tab00" value="00" onchange=" addCalendar(00)" />
            <label for="tab00" class="text-bold">JAN</label>
            <input type="radio" name="tabs" id="tab01" value="01" onchange="  addCalendar(01)" />
            <label for="tab01" class="text-bold">FEB</label>
            <input type="radio" name="tabs" id="tab02" value="02" onchange=" addCalendar(02)" />
            <label for="tab02" class="text-bold">MAR</label>
            <input type="radio" name="tabs" id="tab03" value="03" onchange="  addCalendar(03)" />
            <label for="tab03" class="text-bold">APR</label>
            <input type="radio" name="tabs" id="tab04" value="04" onchange=" addCalendar(04)" />
            <label for="tab04" class="text-bold">MAY</label>
            <input type="radio" name="tabs" id="tab05" value="05" onchange="  addCalendar(05)" />
            <label for="tab05" class="text-bold">JUN</label>
            <input type="radio" name="tabs" id="tab06" value="06" onchange="addCalendar(06)" />
            <label for="tab06" class="text-bold">JUL</label>
            <input type="radio" name="tabs" id="tab07" value="07" onchange=" addCalendar(07)" />
            <label for="tab07" class="text-bold">AUG</label>
            <input type="radio" name="tabs" id="tab08" value="08" onchange=" addCalendar(08)" />
            <label for="tab08" class="text-bold">SEP</label>
            <input type="radio" name="tabs" id="tab09" value="09" onchange="  addCalendar(09)" />
            <label for="tab09" class="text-bold">OCT</label>
            <input type="radio" name="tabs" id="tab10" value="10" onchange="  addCalendar(10)" />
            <label for="tab10" class="text-bold">NOV</label>
            <input type="radio" name="tabs" id="tab11" value="11" onchange=" addCalendar(11)" />
            <label for="tab11" class="text-bold">DEC</label>

        </div>
        <h4 class="text-left text-h-table">New Product Schedule <span id="dateforiq"></span></h4>
        <div class="tab content1 mt-4 ">
            <div class="visible-up-922 p-4 border-2px">
                <table id="" class="table " cellspacing="5em" width="100%">
                    <thead>
                        <tr class="headder-bg-table">
                            <th class="th-sm header-font-table text-center">{{$staticContent['Model_Name']}}</th>
                            <th class="th-sm header-font-table text-center">{{$staticContent['Launch_Date']}}</th>
                            <th class="th-sm header-font-table text-center">{{$staticContent['Op_Voltage']}}</th>
                            <th class="th-sm header-font-table text-center">{{$staticContent['Op_Power']}}</th>
                            <th class="th-sm header-font-table text-center">{{$staticContent['Phase']}}</th>
                            <th class="th-sm header-font-table text-center">{{$staticContent['Remarks']}} </th>
                            <th class="th-sm header-font-table text-center">{{$staticContent['Prelim_DS']}}</th>
                        </tr>
                    </thead>
                    <tbody id="dataproLaunch_des">

                        {{-- <tr class="box-cardlist row_table" style="">
                            <td class="text-middle-td">
                                <h5 class="text-color-delta  m-0">MEB-500A24F AA</h5>
                            </td>
                            <td class="text-middle-td">13-Mar-2019</td>
                            <td class="text-middle-td">24V</td>
                            <td class="text-middle-td">500W</td>
                            <td class="text-middle-td">1</td>
                            <td class="text-middle-td">Medical Enclosed Power Supply, 1 phase</td>
                            <td class="text-middle-td">
                                <div class="btn btn-ft w-100"> DOWNLOAD</div>
                            </td>
                        </tr> --}}
                    </tbody>
                </table>
            </div>
            <div class="invisible-up-922 row" id="dataproMobile">


            </div>
        </div>
    </div>
</div>



@endsection


@section('js')

<script>
    var today = new Date();
    var isYears = today.getFullYear();
    document.getElementById("count-year").innerHTML = isYears;
    var total = parseInt($("#count-year").text());
    var years=parseInt($("#count-year").text());
    /* calender-tab */
    var pro_launch_schedules =  <?= json_encode($relate_pro_launch_schedule);?>;
    $(document).ready(function() {
          console.log(today.getMonth()); 
          var mont =  ('0' + today.getMonth()).slice(-2);
            addCalendar(mont);
         
    });

    function Years(num){
        if(num===1){
            total = total +1;
        }else if(num===-1){
            total = total-1;
        }
       $("#count-year").text(total);
       years = total;
       var radioValue = $("input[name='tabs']:checked").val();
       addCalendar(radioValue);
       $('#tab'+radioValue).prop("checked", true );
    }


    function addCalendar(i){ 
         var date = new Date(years ,i,01);
         loadproductLaunch(date);
         $('#tab'+i).prop( "checked", true );
        $("#select-events option[value="+i+"]").prop("selected", true);
        $('#dateforiq').text(getmonthfull(date));
    }
    function selectMonthPicker(){
        var i =  $('#select-events').val();
      $("#select-events option[value="+i+"]").attr('selected', 'selected'); 
       addCalendar(i);
      $('#tab'+i).prop("checked", true );

    }
    function formatedate(datastart){
     
     var d = new Date(datastart);
     const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
    "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
      ];
     return monthNames[d.getMonth()]+'-'+d.getFullYear();
   }
   function getmonthfull(date){
      var month = ["January","February","March","April","May","June","July",
            "August","September","October","November","December"];
     return month[date.getMonth()]+' '+date.getFullYear();
   }

    function loadproductLaunch(date){
        var html = '';
        var mobilehtml = '';
        $.each(pro_launch_schedules, function(index,pro_launch){
         if(checkDateDate(pro_launch['monthdate'] ,date)){
            html += '<tr class="box-cardlist row_table" style="">';
            html += '<td class="text-middle-td"><h5 class="text-color-delta  m-0">'+pro_launch['modelname'] +'</h5></td>';
            html += '<td class="text-middle-td">'+formatedate(pro_launch['monthdate']) +'</td>';
            html +=  '<td class="text-middle-td">'+pro_launch['op_voltage'] +'</td>';
            html += '<td class="text-middle-td">'+pro_launch['op_wattage'] +'</td>';
            html += '<td class="text-middle-td">'+pro_launch['phase'] +'</td>';
            html += '<td class="text-middle-td">'+pro_launch['remark'] +'</td>';
            html += '<td class="text-middle-td"> <a href="{{config('app.url')}}/file_doc_2/marketing_resources/'+pro_launch['file']+'" download > <div class="btn btn-ft w-100"> {{$staticContent['Downloads']}}</div></td>';
            html += '</tr>';

            mobilehtml += '<div class="product-launch-list">';
            mobilehtml += '<h4 class="text-color-delta">'+pro_launch['modelname']+'</h4>';
            mobilehtml += '<div class="row">';
            mobilehtml += '<div class="col-6">';
            mobilehtml += '<h6 class="text-color-delta">{{$staticContent['Launch_Date']}}</h6>';
            mobilehtml += '<p class="text-one">'+formatedate(pro_launch['monthdate']) +'</p>';
            mobilehtml += '<h6 class="text-color-delta">{{$staticContent['Op_Power']}}</h6>';
            mobilehtml += '<p class="text-one">'+pro_launch['op_wattage'] +'</p>';
            mobilehtml += '</div>';
            mobilehtml += '<div class="col-6">';
            mobilehtml += '<h6 class="text-color-delta">{{$staticContent['Op_Voltage']}}</h6>';
            mobilehtml += '<p class="text-one">'+pro_launch['op_voltage'] +'</p>';
            mobilehtml += '<h6 class="text-color-delta">PHASE</h6>';
            mobilehtml += '<p class="text-one">'+pro_launch['phase'] +'</p>';
            mobilehtml += '</div>';
            mobilehtml += '</div>';
            mobilehtml += '<div>';
            mobilehtml += '<h6 class="text-color-delta">REMARKs</h6>';
            mobilehtml += '<p class="text-one">'+pro_launch['remark'] +'</p>';
            mobilehtml += '</div>';
            mobilehtml +=  '<a href="{{config('app.url')}}/file_doc_2/marketing_resources/'+pro_launch['file']+'" download >';
            mobilehtml += '<div class="btn btn-subscribe mt-2">PRE-LIM DS</div>';
            mobilehtml += ' </a>';
            mobilehtml += ' </div>';
         
         
         
         }
        });

       $('#dataproLaunch_des').html(html);
       $('#dataproMobile').html(mobilehtml);
    }

    function checkDateDate(date ,curdate){
 
        var datedata = date;
        var dateCheck = curdate;
      
        var data_date = new Date(datedata);  
        var check   = new Date(dateCheck);
        // console.log(data_date);
    
        console.log(curdate);
          if(data_date.getFullYear() == check.getFullYear()  ){
              if(data_date.getMonth() == check.getMonth()){
                return true;
              }
              return false;
          }

     }
  

</script>

@endsection