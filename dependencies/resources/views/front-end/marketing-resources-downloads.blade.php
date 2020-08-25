@extends('layouts.front-end')
@section('css')
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
                    <li class="breadcrumb-item active text-breadcrumb-home" aria-current="page"><a href="#">{{$staticContent['Partners']}}</a></li>
                    <li class="breadcrumb-item active text-breadcrumb-home" aria-current="page"><a href="{{route('marketingResources')}}">{{$staticContent['Marketing_Resources']}}</a></li>
                    <li class="breadcrumb-item active text-breadcrumb" aria-current="page"><a href="#">{{$staticContent['Marketing_Resources_Downloads']}}</a></li>
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
        <h2 class="text-title-delta visible-tablets-up">{{$staticContent['Marketing_Resources_Downloads']}}</h2>
        <h3 class="text-title-delta visible-mobile">{{$staticContent['Marketing_Resources_Downloads']}}</h3>
        <select id="select-catalogs" onchange="selectdocumentType();" class="form-control invisible-up-922">
            @foreach ($margetCate as $cate)
            <option value="{{$cate->cate_id}}">{{$cate->name}}</option>
            @endforeach
        </select>
        <div class="row">
            <div class="col-md-12">
                    <div class="nav nav-tabs d-flex justify-content-center border-b-2px visible-up-922 mb-4" id="nav-tab" role="tablist">
                        @foreach ($margetCate as $cate)
                            <a class="nav-item nav-link font-size-tab {{$loop->iteration == 1?'active':'' }}" onclick="setdatainput({{$cate->cate_id}});" id="pop-tab{{$cate->cate_id}}" data-toggle="tab" href="#pop{{$cate->cate_id}}"
                                role="tab" aria-controls="pop{{$cate->cate_id}}" aria-selected="true" data-val="{{$cate->cate_id}}">{{$cate->name}}
                            </a>
                        @endforeach
                   
                       
                    </div>
                <div class="tab-content" id="nav-tabContent">
                    @foreach ($margetCate as $cate)
                    <div class="tab-pane fade {{$loop->iteration == 1?'show active':'' }} " id="pop{{$cate->cate_id}}" role="tabpanel" aria-labelledby="pop{{$cate->cate_id}}-tab">
                        <form  onsubmit="searchmarketingbycate()">
                        <div class="search-space d-flex justify-content-center w-100">
                            <div class="box-search-input  mr-3">
                           
                                <div class="box-search-icon">
                                    <img src="{{asset('frontend-asset/image/search-filters-icon.svg')}}" alt="">
                                </div>
                                <label for="searchinput" class="searchinput-filters-input">
                                    <input type="hidden" name="cateid" value="1"  >
                                    <input type="text" name="modelname"  placeholder="{{$staticContent['Search_By_Name']}}">
                                </label>
                            </div>
                         
                            <button class="btn-search-border">{{$staticContent['Search']}}</button>
                            
                        </div>
                        </form>
                        <div class="contentdatasearch"> 
                      
                        @foreach ($margeting as $marget)
                        @if($marget->cate_id == $cate->cate_id )
                        <div class="resources-download">
                            <div class="detail-download ">
                              <h5>{{$marget->name}}</h5>
                                {{-- <p  >{{$staticContent['Uploaded_on']}} 13-Mar-2019   |   4.7 MB</p> --}}
                                <?php
                                $date = getDateformat($marget->created_at);
                               ?>
                                <p>{{$staticContent['Uploaded_on']}} {{$date['d'].'-'.$date['m'].'-'.$date['y']}} </p>
                            </div>
                        <a href="{{config('app.url')}}/medias/marketing_resources/{{$marget->file}}" download="{{$marget->name}}">
                            <button class="btn-downlode">{{$staticContent['Downloads']}}</button>
                            </a>
                        </div>
                        @endif
                        @endforeach
                      </div>
                       
                    </div>
                    @endforeach

                 
                </div>
            </div>
        </div>
    </div>
</section>


@endsection


@section('js')

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
            html += '<p>{{$staticContent['Uploaded_on']}} 13-Mar-2019 </p>';
            html += '</div>';
            html += '<a href="{{config('app.url')}}/medias/marketing_resources/'+value['file']+'">';
            html += '<button class="btn-downlode">DOWNLOAD</button>';
            html += '</a>';
            html += '</div>'
        });
        $('.contentdatasearch').html(html);
          
      }
</script>

@endsection
