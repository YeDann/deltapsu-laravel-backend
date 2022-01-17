@extends('layouts.front-end')
@section('css')
<style>
   
   .select-minimize {
    width: 60px !important;
   }
    .box-news-detail{
        border: 2px solid #E3EFF8;
        padding: 24px;
    }
    /* tab */
    .calendar-month-tab input { 
        display: none; 
    }   /* hide radio buttons */
    input + label { 
       /*  display: inline-block ; */
       margin-bottom: -2px;
       cursor: pointer;
    }   /* show labels in line */
    .calendar-month-tab{
        border-bottom: 2px solid #E3EFF8;
        margin-bottom: 1em;
        display: flex;
        justify-content: space-around;
    }
    input:checked+label {
        border-bottom: 2px solid #0087DC;
    }
    #next-year::before,#last-year::before{
        position: absolute;
        bottom: -8px;
        font-family: 'FontAwesome';
        color: #0087DC;
        font-size: 24px;
        cursor: pointer;
    }
    #next-year::before{
        left: 0;
        content: "\f054";
        margin-left: 24px;
    }
    #last-year::before{
        right: 0;
        content: "\f053";
        margin-right: 24px;
    }
    .calendar-year-tab a{
        height: 24px;
        position: relative;
    }
    .calendar-year-tab a:hover{
        text-decoration: none;
    }
    .scrollbar {
        overflow-y: scroll;
        height: 278px;
    }
    .img-event-slide{
        height: 160px;
    }
    .event-content-text  .post-meta{
        font-size: 12px;
    }
    .read-more-slide{
        font-size: 12px;
        font-weight: bold;
        color: #5F5F5F;
    }
    .read-more-slide:hover {
    text-decoration: none !important;
    }
   
    div.zabuto_calendar .table tr.calendar-dow-header th{
        background-color:#0087DC;
        color: #ffffff;
    }
 
    .grey-done {
    background-color: #d2d2d2;

    }
    .blue-on{
    background-color: #0087DC;
    color: #ffffff;
    }
    .calendar-month-header{
        display: none;
        visibility: hidden;
    }
   
    div.zabuto_calendar .table tr td[title]:hover:after {
        content: attr(title);
        background-color: #0087DC;
        color: #ffffff;
        position: absolute;
        margin: -58px;
        padding: 7px;
        margin-top: -83px;
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
<div class="products-index-nav visible-up-922">
    <div class="bg-bredcrumb">
        <div class="container">
            <nav aria-label="breadcrumb" id="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item text-breadcrumb-home"><a href="{{route('index','home')}}">{{$staticContent['Home']}}</a></li>
                    <li class="breadcrumb-item active text-breadcrumb-home dropdown" aria-current="page"><a
                            href="#" data-toggle="dropdown" id="tools-dropdown">{{$staticContent['Updates']}}</a>
                            <ul class="dropdown-menu">
                                <li><a href="#" id="tools-dropdown" class="text-bold">{{$staticContent['Updates']}}</a></li>
                                <hr>
                                <li><a href="{{route('index','news')}}">{{$staticContent['Product_News']}}</a></li>
                                <li><a href="{{route('index','events')}}">{{$staticContent['Events']}}</a></li>
                                {{-- <li><a href="{{route('index','technical-articles')}}">{{$staticContent['Technical_Articles']}}</a></li> --}}
                              </ul>   
                    </li>
                    <li class="breadcrumb-item active text-breadcrumb" aria-current="page"><a href="#">{{$staticContent['Events&Calendar']}}</a></li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="padding-top-content-breadcrumb visible-up-922"></div>
<div class="box-events mb-5">
    <div class="container">
        <h2 class="text-title-delta visible-up-922">{{$staticContent['Events&Calendar']}}</h2>
        <h3 class="text-title-delta invisible-up-922">{{$staticContent['Events&Calendar']}}</h3>
        <div class="calendar-year-tab d-flex justify-content-center mr-24px">
            <a  id="last-year" onclick="Years(-1)"></a>
            <h3 id="count-year"></h3>
            <a  id="next-year" onclick="Years(1)"></a>
        </div>
        <select id="select-events" onchange="selectMonthPicker();" class="form-control invisible-up-922 mb-4">
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
            <input type="radio" name="tabs" id="tab00"  onchange=" addCalendar(00)" />
            <label for="tab00" class="text-bold">JAN</label>
            <input type="radio" name="tabs" id="tab01" onchange="  addCalendar(01)" />
            <label for="tab01" class="text-bold">FEB</label>
            <input type="radio" name="tabs" id="tab02" onchange=" addCalendar(02)"  />
            <label for="tab02" class="text-bold">MAR</label>
            <input type="radio" name="tabs" id="tab03" onchange="  addCalendar(03)" />
            <label for="tab03" class="text-bold">APR</label>
            <input type="radio" name="tabs" id="tab04" onchange=" addCalendar(04)"  />
            <label for="tab04" class="text-bold">MAY</label>
            <input type="radio" name="tabs" id="tab05" onchange="  addCalendar(05)"/>
            <label for="tab05" class="text-bold">JUN</label>
            <input type="radio" name="tabs" id="tab06" onchange="addCalendar(06)"   />
            <label for="tab06" class="text-bold">JUL</label>
            <input type="radio" name="tabs" id="tab07" onchange=" addCalendar(07)"  />
            <label for="tab07" class="text-bold">AUG</label>
            <input type="radio" name="tabs" id="tab08" onchange=" addCalendar(08)" />
            <label for="tab08" class="text-bold">SEP</label>
            <input type="radio" name="tabs" id="tab09" onchange="  addCalendar(09)" />
            <label for="tab09" class="text-bold">OCT</label>
            <input type="radio" name="tabs" id="tab10" onchange="  addCalendar(10)"/>
            <label for="tab10" class="text-bold">NOV</label>
            <input type="radio" name="tabs" id="tab11" onchange=" addCalendar(11)" />
            <label for="tab11" class="text-bold">DEC</label>

        </div>
        
        <div class="tab content1 mt-4">
            <div class=" visible-up-922">
                <div class="row mr-b-12px">
                    <div class="col-8  pad-ar-24px">
                        <div class="border-2px p-3">
                        <div class="scrollbar " id="style-1">
                            <div class="force-overflow" id="content_event">

                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div id="my-calendar"></div>
                        {{-- <div id="dncalendar-container">
                        </div> --}}
                        {{-- <p>Date: <input type="text" id="datepicker2" disabled></p> --}}


                    </div>
                </div>
            </div>
            <div  class="invisible-up-922"> 
                <div id="content_event_mobile" class="row">
                </div>
            </div>
            <div  class="invisible-up-922"> 
                <br>
                <br>
                <hr>
               
            </div>
            <h2 class="text-title-delta">{{$staticContent['Upcoming_Event']}}</h2>
            <div class="row">
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
                @foreach (array_slice($events->toArray(), 0, 3)  as $item)
                <div class="col-lg-4 col-sm-6 col-md-6 mb-3">
                    <div class="card">
                        <a href="{{route('updateEventDetail',$item->slug )}}">
                        <div class="post-image">
                        <img src="{{config('app.url')}}/uploads_delta/{{$item->thumb}}" alt=""
                                class="img-responsive">
                        </div>
                        </a>
                        <?php
                       
                             $date = getDateformat($item->date_publish);
                             $endDate = getDateformat($item->date_end);
                        ?>
                        <div class="news-content">
                            <div class="post-meta">
                                <span class="author text-uppercase">
                                        <i class="zmdi zmdi-calendar-alt"></i> {{ $date['m'].' '.$date['d'].' - '.($date['m'] != $endDate['m'] ?$endDate['m']:"" ).' '.(isset($endDate['d'])?''.$endDate['d']:'').' '.$date['y']}}
                                </span>
                                <span class="locations ">
                                    &nbsp; <i class="zmdi zmdi-pin"></i> {{$item->location}}
                                </span>
                            </div>
                            <a href="{{route('updateEventDetail',$item->slug )}}">
                            <h3 class="post-header title-new">
                                {{$item->title}}
                            </h3>
                            </a>
                            <p>  {!! iconv_substr(strip_tags($item->content),0,90,'UTF-8') !!} ...
                            </p>
                            
                        </div>
                    <a href="{{route('updateEventDetail',$item->slug )}}"class="read-more">{{$staticContent['Read_More']}}</a>
                    </div>
                </div>
                @endforeach
              
                                        
            </div>
        </div>
    </div> 
</div>



@endsection


@section('js')
<script>
    // var eventData = [
    //   {"date":"2019-01-01","badge":true,"title":"Example 1"},
    //   {"date":"2019-03-02","badge":true,"title":"Example 2"}
    // ];
  
    </script>

<script>

    var events =  <?= json_encode($events2);?>;
    var total;
    var years;

    const picker = ["00", "01", "02", "03", "04", "05",
       "06", "07", "08", "09", "10", "11"
         ];
    // Returns an array of dates between the two dates
    var getDatesBett = function(startDate, endDate) {
        var dates = [],
            currentDate = startDate,
            addDays = function(days) {
                var date = new Date(this.valueOf());
                date.setDate(date.getDate() + days);
                return date;
            };
        while (currentDate <= endDate) {
            dates.push(currentDate);
            currentDate = addDays.call(currentDate, 1);
        }
        return dates;
        };

        const month = ["01", "02", "03", "04", "05", "06",
       "07", "08", "09", "10", "11", "12"
         ];
    var nowdate = new Date();     
    var eventarry = [];
    $.each(events, function(index,event){
    
     var dates = getDatesBett(new Date(event['date_publish']), new Date(event['date_end']));                                                                                                           
        dates.forEach(function(MyDate) {
        
        var newfor = MyDate.getFullYear()+'-'+month[MyDate.getMonth()]+'-'+('0' + MyDate.getDate()).slice(-2);
        // var obj = { "date":newfor, "note": ["<span>Event Iitle</span>"]}  ;
        if(MyDate >= nowdate){
            var obj  = {"date":newfor,"badge":false,"title":event['title'] ,classname: "blue-on"};
        }else{
            var obj  = {"date":newfor,"badge":false,"title":event['title'] , classname: "grey-done"};
        }
   
        // console.log(newfor);
        eventarry.push(obj);
        });

 
    });

   

    $( document).ready(function () {
             
            var today = new Date();
           var isYears = today.getFullYear()
           document.getElementById("count-year").innerHTML = isYears;
        //   console.log(month[today.getMonth()]);
             years = parseInt($("#count-year").text());
            //  addCalendar(month[today.getMonth()]);
            setloadEventBy(today);
            $("#my-calendar").zabuto_calendar({
                data: eventarry,
                action: function () {
                return myDateFunction(this.id);
            },
            });
            $('#tab'+picker[today.getMonth()]).prop( "checked", true );
        
           
    });
    function  myDateFunction(id){
        var date = $("#"+id).data("date");
        var toset = new Date(date);
        // console.log(toset ,'ede',month[toset.getMonth()] );
        $('#tab'+picker[toset.getMonth()]).prop("checked", true );
        setloadEventByDay(date);
    }
  
    function formatedate(datastart ,enddate){
        var d = new Date(datastart);
        var de = new Date(enddate);
        const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
       "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
         ];
        return monthNames[d.getMonth()]+ ' '+d.getDate()+' - '+checkShowMonth(monthNames[d.getMonth()],monthNames[de.getMonth()])+' ' +de.getDate() + ', ' +d.getFullYear();
      }
    function checkShowMonth(startM,endM){
       if(startM != endM){
           return endM
       }else{
          return "";
       }
    }
   
    function Years(num){
        var sum = years;
        if(num === 1){
            sum = sum +1;
        }else if(num===-1){
            sum = sum-1;
        }
      
       $("#count-year").text(sum);
       years = sum;
       addCalendar(00);
       $('.calendar-month-tab input').removeAttr('checked');
       $('#tab00').prop( "checked", true );
    }

     
    function addCalendar(i){ 
        $("#select-events option[value="+i+"]").prop("selected", true);
        var date = new Date(years ,i,01);
        $("#my-calendar").empty();
         $("#my-calendar").zabuto_calendar({
               data: eventarry,
                year: years,
                month: i+1,
                action: function () {
                return myDateFunction(this.id);
            },
            });
  
        setloadEventBy(date); 
        console.log(i);     
        $('#tab'+i).prop( "checked", true );

    }

    
    function selectMonthPicker(){
       var i =  $('#select-events').val();
       $("#select-events option[value="+i+"]").attr('selected', 'selected'); 
        addCalendar(i);
       $('#tab'+i).prop( "checked", true );

    }
   
 
    function setloadEventBy(date){
        var html ='';
        var html2 = '';
        var fildata = [];
    
        $.each(events, function(index,event){
        if(checkEventDate(event['date_publish'] , event['date_end'] ,date)){          
            fildata.push(event['date_publish']);
        html += '<div class="event-content-slide d-flex justify-content-lg-start border-b-2px pad-12px">';
        html += '<a href="{{route('updateEventDetail')}}/'+event['slug']+ '">';
        html += '<img class="mr-3 img-event-slide" src="{{config('app.url')}}/uploads_delta/'+event['thumb']+'" alt="">';              
        html += '</a>';
        html +=  '<div class="event-content-text ">';                          
        html += '<div class="post-meta">';                          
        html += ' <span class="author">';
        html += ' <i class="zmdi zmdi-calendar-alt"></i> '+ formatedate(event['date_publish'] , event['date_end']);
        html +=' </span>';
        html += '<span class="locations ">';
        html += ' <i class="zmdi zmdi-pin"> </i> '+event['location'];
        html += '</span>';
        html += ' </div>';
        html += '<a href="{{route('updateEventDetail')}}/'+event['slug']+ '">';
        html += ' <h3 class="post-header title-new">';
        html += event['title'];
        html += '</h3>';
        html += '</a>';
        html += '<a href="{{route('updateEventDetail')}}/'+event['slug'] +'"class="read-more-slide">{{$staticContent['Read_More']}}</a>';
        html +=  '</div>';
        html +=  ' </div>';

        html2 += '<div class="col-lg-4 col-sm-6 col-md-6 mb-3">';
        html2 += '<div class="card">';
        html2 += '<a href="{{route('updateEventDetail')}}/'+event['slug']+ '">';    
        html2 += '<div class="post-image">';
        html2 += '<img src="{{config('app.url')}}/uploads_delta/'+event['thumb']+'" alt=""';
        html2 += 'class="img-responsive">';
        html2 +=  '</div>';
        html2 +=  '</a>';
        html2 += ' <div class="news-content">';
        html2 += ' <div class="post-meta">';
        html2 += ' <span class="author">';
        html2 += '<i class="zmdi zmdi-calendar-alt"></i> '+ formatedate(event['date_publish'] , event['date_end']);
        html2 += '</span>';
        html2 += '<span class="locations ">';
        html2 +=' <a href="#">';
        html2 +='<i class="zmdi zmdi-pin"></i> ' +event['location'];
        html2 +='</a>';
        html2 += '</span>'
        html2 += '</div>';
        html += '<a href="{{route('updateEventDetail')}}/'+event['slug']+ '">';
        html2 += '<h3 class="post-header title-new">';
        html2 += event['title'].substr(0, 45)+'...';
        html2 += '</h3>';
        html2 += '</a>';
        html2 += '<p>'+event['content'].replace(/<\/?[^>]+>/gi, '').substr(0, 90);
        html2 += '</p> ' ;              
        html2 += '</div>';
        html2 += ' <a href="{{route('updateEventDetail')}}/'+event['slug'] +'"class="read-more">{{$staticContent['Read_More']}}</a>';
        html2 += '</div>';
        html2 += '</div>';
         }
        });
     
      if(fildata.length == 0){
        html += '<div class="text-center">{{$staticContent['No_Event']}}</div>';
        html2 += '<div class="text-center  m-auto" >{{$staticContent['No_Event']}}</div>';
      }
         $('#content_event').html(html);
        $('#content_event_mobile').html(html2);

    }


    function setloadEventByDay(date){
        var html ='';
        $.each(events, function(index,event){
        if(checkEventByDay(event['date_publish'] , event['date_end'] ,date)){           
        html += '<div class="event-content-slide d-flex justify-content-lg-start border-b-2px pad-12px">';
        html += '<a href="{{route('updateEventDetail')}}/'+event['slug']+ '">';
        html +=  '<img class="mr-3 img-event-slide" src="{{config('app.url')}}/uploads_delta/'+event['thumb']+'" alt="">'; 
        html += '</a>';             
        html +=  '<div class="event-content-text ">';                          
        html += '<div class="post-meta">';                          
        html += ' <span class="author">';
        html += ' <i class="zmdi zmdi-calendar-alt"></i> '+ formatedate(event['date_publish'] , event['date_end']);
        html +=' </span>';
        html += '<span class="locations ">';
        html += ' <i class="zmdi zmdi-pin"></i> '+event['location'];
        html += '</span>';
        html += ' </div>';
        html += ' <h3 class="post-header title-new">';
        html += event['title'].substr(0, 45);
        html += '</h3>';
        html += '<a href="{{route('updateEventDetail')}}/'+event['slug'] +'"class="read-more-slide">{{$staticContent['Read_More']}}</a>';
        html +=  '</div>';
        html +=  ' </div>';
            }
        });
        $('#content_event').html(html);
    }

     function checkEventDate(start ,end ,date){
         console.log(start ,end ,date);
        var dateFrom = start;
        var dateTo = end;
        var dateCheck = date;
        var from = new Date(dateFrom);  
        var to   = new Date(dateTo);
        var check   = new Date(date);
        var check = new Date(dateCheck);
          if(from.getFullYear() == check.getFullYear() && to.getFullYear() == check.getFullYear()  ){
              if(from.getMonth() == check.getMonth() || to.getMonth() == check.getMonth()){
                return true;
              }
              return false;
          }

     }

     function checkEventByDay(start ,end ,date){
        
        var dateFrom = start;
        var dateTo = end;
        var dateCheck = date;
        var from = new Date(dateFrom);  
        var to   = new Date(dateTo);
        var check   = new Date(date);
        var check = new Date(dateCheck);
   
          if(check.getFullYear() == from.getFullYear()  && check.getFullYear() == to.getFullYear() ){
              if(check.getMonth() == from.getMonth() || check.getMonth() == to.getMonth() ){
                console.log((from.getDate() >= check.getDate()) , from.getDate() ,check.getDate());
                 if( check.getDate() >= from.getDate() &&  check.getDate() <= to.getDate()){
                   
                    return true;

                 }
                 return false;
              }
              return false;
          }

     }

  
  

</script>

@endsection
