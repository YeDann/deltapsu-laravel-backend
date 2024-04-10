@extends('layouts.front-end')
@section('css')
<style>
    .nav-tabs .nav-link {
        margin: -2px 20px;
    }

    .tab-content>.active {
        display: block;
    }

    a.btn:hover {
        color: #444444;
    }

    .btn.focus,
    .btn:focus {
        outline: 0;
        box-shadow: unset;
    }

    .select-minimize {
        width: 170px;
    }

    #select-news option {
        text-transform: capitalize;
    }

    #select-news {
        text-transform: capitalize;
    }

    .bg-new-alert {
        background-color: #76B900;
        /*padding: 4px 8px;*/
        border-radius: 50%;
        color: #fff;
        /* margin-top: -25px;
        margin-left: 20px;*/
        right: -16px;
        top: -16px;
        position: absolute;
        display: block;
        width: 24px;
        height: 24px;
        text-align: center;
        font-size: 12px;
        padding-top: 2px;
    }
</style>
@endsection
@section('meta')
<title>{{isset($metatag[0]->meta_title)? $metatag[0]->meta_title :''}}</title>
<meta name="description" content="{{isset($metatag[0]->meta_description)? $metatag[0]->meta_description :''}}">
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
                    <li class="breadcrumb-item active text-breadcrumb-home dropdown" aria-current="page"><a href="#"
                            data-toggle="dropdown" id="tools-dropdown">{{$staticContent['Updates']}}</a>
                        <ul class="dropdown-menu">
                            <li><a href="#" id="tools-dropdown" class="text-bold">{{$staticContent['Updates']}}</a></li>
                            <hr>
                            <li><a href="{{route('index','news')}}">{{$staticContent['Product_News']}}</a></li>
                            <li><a href="{{route('index','events')}}">{{$staticContent['Events']}}</a></li>
                            {{-- <li><a
                                    href="{{route('index','technical-articles')}}">{{$staticContent['Technical_Articles']}}</a>
                            </li> --}}
                        </ul>
                    </li>
                    <li class="breadcrumb-item active text-breadcrumb" aria-current="page"><a
                            href="#">{{$staticContent['Product_News']}}</a></li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="padding-top-content-breadcrumb visible-up-922"></div>
<section class="box-news ">
    <div class="container">
        <h2 class="text-title-delta ">{{$staticContent['Product_News']}}</h2>
        <select id="select-news" onchange="selectDatanews();" class="form-control invisible-up-922 mb-4 w-75 m-auto">
            <option value="0">{{$staticContent['All']}}</option>
            @foreach ($news_type as $type)
            <option value="{{$type->id}}">{{$type->typename}}</option>
            @endforeach
        </select>
        <div class="row mt-4 mt-xl-0">
            <div class="col-md-12 ">
                <div class="nav nav-tabs d-flex justify-content-center border-b-2px visible-up-922 mb-5" id="nav-tab"
                    role="tablist">
                    <a class="nav-item nav-link font-size-tab active" onclick="clicktabFist(0);" id="pop0-tab"
                        data-toggle="tab" href="#pop0" role="tab" aria-controls="pop0" aria-selected="true"
                        data-val="0">{{$staticContent['All']}}</a>

                    @if(App::getLocale() == "jp")
                    <style>
                        /*For IE And Lang JP*/
                        @media all and (-ms-high-contrast: none),
                        (-ms-high-contrast: active) {
                            .bg-new-alert {
                                padding-top: 5px;
                            }
                        }
                    </style>
                    @endif
                    @foreach ($news_type as $type)
                    <a class="nav-item nav-link font-size-tab position-relative" onclick="clicktab({{$type->id}});"
                        id="pop{{$type->id}}-tab" data-toggle="tab" href="#pop{{$type->id}}" role="tab"
                        aria-controls="pop{{$type->id}}" aria-selected="true" data-val="0">{{$type->typename}}
                        @if($type->typename == 'Lebensdauer' || $type->typename == 'EOL' ||
                        $type->typename == "下架产品" || $type->typename == "停產產品"
                        && $status_eol)<div class="bg-new-alert"><span>N</span></div>@endif
                    </a>
                    @endforeach

                </div>
                <div class="tab-content add-space-mobile mb-5" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="pop0" role="tabpanel" aria-labelledby="pop0-tab">
                        <div class="row" id="contentByType0">
                        </div>
                        <div class="text-center mt-5" id="loadMore0" style="" onclick="loadeMore(event,0)">
                            <div class="btn btn-boxen"> {{$staticContent['See_More']}}</div>
                        </div>
                    </div>
                    @foreach ($news_type as $type)
                    <div class="tab-pane fade" id="pop{{$type->id}}" role="tabpanel"
                        aria-labelledby="pop{{$type->id}}-tab">
                        <div class="row" id="contentByType{{$type->id}}">
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
          var html = '';
          $.each(news, function(index,val){
             if(val['typeId'] == id){
              html += ' <div class="col-lg-4 col-md-6 blogBox moreBox mb-3"style="display:none">';
              html += ' <div class="card">'
              html +=  '<a href="{{route('updateNewsDetail')}}/'+val['slug']+'">';
              html += ' <div class="post-image">'
              html += ' <img src="{{config('app.url')}}/uploads_delta/'+val['thumb']+'" alt=""';
              html += 'class="img-responsive">';
              html +=  ' </div>';
              html +=  ' </a>';
              html +=  ' <div class="news-content">';
              html +=  '<div class="post-meta">';
              html +=  ' <span class="sub-news company" style="color:'+val['color_type'] +'">';
              html +=  val['cateName'];
              html +=  ' </span>';
              html +=  ' <img class="line-symbol"src="{{asset('/frontend-asset/image/line-symbol.svg')}}" alt="">';
              html +=  ' <span class="date text-uppercase">';
              if(val['date_info'] == null){
                html +=  '' ;
              }else{
                html +=  formatedate(val['date_info']) ;
              }
              html +=  ' </span>';
              html +=  ' </div>';
              html +=  ' <h4 class="post-header title-new">';
             html +=  '<a href="{{route('updateNewsDetail')}}/'+val['slug']+'">';
              html +=   val['title'].substr(0, 90);  
              html +=  ' </h4>';
              html +=  '</a>';
              if(val['description']!= null && val['description'] == '' ){
              html +=  ' <p>'+ val['description'].replace(/(<([^>]+)>)/ig,"").substr(0 ,90) +'<p>';
             }else{
              html  +=  '';
             }

              html +=  ' </div>';
              html +=  ' <a href="{{route('updateNewsDetail')}}/'+val['slug']+'"class="read-more">{{$staticContent['Read_More']}}</a>';
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
              html += ' <div class="col-lg-4 col-md-6 mb-3 blogBox moreBox "style="display:none">';
              html += ' <div class="card">'
              html +=  '<a href="{{route('updateNewsDetail')}}/'+val['slug']+'">';
              html += ' <div class="post-image">'
              html += ' <img src="{{config('app.url')}}/uploads_delta/'+val['thumb']+'" alt=""';
              html += 'class="img-responsive">';
              html += ' </div>';
              html += ' </a>';
              html += ' <div class="news-content">';
              html += ' <div class="post-meta">';
              html +=  ' <span class="sub-news company" style="color:'+val['color_type'] +'">';
              html +=  val['cateName'];
              html +=  ' </span>';
              html += ' <img class="line-symbol"src="{{asset('/frontend-asset/image/line-symbol.svg')}}" alt="">';
              html += ' <span class="date text-uppercase">';
                if(val['date_info'] == null){
                html +=  '' ;
              }else{
                html +=  formatedate(val['date_info']) ;
              }
              html +=  '</span>';
              html +=  ' </div>';
              html +=  ' <h4 class="post-header title-new">';
              html +=  '<a href="{{route('updateNewsDetail')}}/'+val['slug']+'">';
              html +=   val['title'].substr(0, 90);  
              html += '</a>';
              html +=  '</h4>';
              if(val['description']!= null && val['description'] == '' ){
              html +=  ' <p>'+ val['description'].replace(/(<([^>]+)>)/ig,"").substr(0 ,90) +'<p>';
             }else{
              html += '';
             }
              html +=  '</div>';
              html +=  ' <a href="{{route('updateNewsDetail')}}/'+val['slug']+'"class="read-more">{{$staticContent['Read_More']}}</a>';
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
  
      $("#pop"+i+" .moreBox:hidden").slice(0, 6).slideDown();
      if ($("#pop"+i+" .moreBox:hidden").length == 0) {
        $("#loadMore"+i).fadeOut('hide');
      }
  }
       
</script>

@endsection