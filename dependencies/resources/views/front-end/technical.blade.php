@extends('layouts.front-end')
@section('css')
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
                    <li class="breadcrumb-item active text-breadcrumb-home dropdown" aria-current="page"><a href="#"
                            data-toggle="dropdown" id="tools-dropdown">{{$staticContent['Updates']}}</a>
                        <ul class="dropdown-menu">
                            <li><a href="#" id="tools-dropdown" class="text-bold">{{$staticContent['Updates']}}</a></li>
                            <hr>
                            <li><a href="{{route('index','news')}}">{{$staticContent['Product_News']}}</a></li>
                            <li><a href="{{route('index','events')}}">{{$staticContent['Events']}}</a></li>
                            <li><a
                                    href="{{route('index','technical-articles')}}">{{$staticContent['Technical_Articles']}}</a>
                            </li>
                        </ul>
                    </li>
                    <li class="breadcrumb-item active text-breadcrumb" aria-current="page"><a
                            href="#">{{$staticContent['Technical_Articles']}}</a></li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="padding-top-content-breadcrumb visible-up-922"></div>
<section class="box-news ">
    <div class="container">
        <h1 class="text-title-delta ">{{$staticContent['Technical_Articles']}}</h1>
        <select id="select-news" onchange="selectDatanews();" class="form-control invisible-up-922 mb-4 border-radius-6">
            <option value="0">{{$staticContent['All']}}</option>
            @foreach ($news_type as $type)
            <option value="{{$type->id}}">{{$type->name}}</option>
            @endforeach
        </select>
        <div class="row">
            <div class="col-md-12 ">
                <div class=" nav nav-tabs d-flex justify-content-between border-b-2px visible-up-922 mb-5" id="nav-tab"
                    role="tablist">
                    <a class="nav-item nav-link font-size-tab active" onclick="clicktabFist(0);" id="pop0-tab"
                        data-toggle="tab" href="#pop0" role="tab" aria-controls="pop0" aria-selected="true"
                        data-val="0">{{$staticContent['All']}}</a>
                    @foreach ($news_type as $type)
                    <a class="nav-item nav-link font-size-tab" onclick="clicktab({{$type->id}});"
                        id="pop{{$type->id}}-tab" data-toggle="tab" href="#pop{{$type->id}}" role="tab"
                        aria-controls="pop{{$type->id}}" aria-selected="true" data-val="0">{{$type->name}}</a>
                    @endforeach

                </div>
                <div class="tab-content add-space-mobile mb-5" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="pop0" role="tabpanel" aria-labelledby="pop0-tab">
                        <div class="grid-news" id="contentByType0">
                        </div>
                        <div class="text-center mt-5" id="loadMore0" style="" onclick="loadeMore(event,0)">
                            <div class="btn btn-boxen">{{$staticContent['See_More']}}</div>
                        </div>
                    </div>
                    @foreach ($news_type as $type)
                    <div class="tab-pane fade" id="pop{{$type->id}}" role="tabpanel"
                        aria-labelledby="pop{{$type->id}}-tab">
                        <div class="grid-news" id="contentByType{{$type->id}}">
                        </div>
                        <div class="text-center mt-5" id="loadMore{{$type->id}}" style=""
                            onclick="loadeMore(event,{{$type->id}})">
                            <div class="btn btn-boxen">{{$staticContent['See_More']}}</div>
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
              html +=  ' <img src="{{config('app.url')}}/uploads_delta/'+val['thumb']+'" alt=""';
              html +=   'class="img-responsive">';
              html +=   ' </div>';
              html +=    '<div class="news-content">';
              html +=    '<div class="post-meta">';
              html +=    '<span class="sub-news company text-uppercase">';
              html +=   '  <a href="#">';
              html +=  val['cateName'];
              html +=  '</a>';
              html +=  '</span>';
              html += ' <img class="line-symbol"src="{{asset('/frontend-asset/image/line-symbol.svg')}}" alt="">';
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
              html +=  '<a href="{{route('updateTechnicalDetail')}}/'+val['slug']+'"class="read-more">{{$staticContent['Read_More']}}</a>';
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
              html +=  ' <img src="{{config('app.url')}}/uploads_delta/'+val['thumb']+'" alt=""';
              html +=   'class="img-responsive">';
              html +=   ' </div>';
              html +=    '<div class="news-content">';
              html +=    '<div class="post-meta">';
              html +=    '<span class="sub-news company text-uppercase">';
              html +=   '  <a href="#">';
              html +=  val['cateName'];
              html +=  '</a>';
              html +=  '</span>';
              html += ' <img class="line-symbol"src="{{asset('/frontend-asset/image/line-symbol.svg')}}" alt="">';
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
              html +=  '<a href="{{route('updateTechnicalDetail')}}/'+val['slug']+'"class="read-more">{{$staticContent['Read_More']}}</a>';
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

@endsection