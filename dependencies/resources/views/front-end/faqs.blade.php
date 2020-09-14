@extends('layouts.front-end')
@section('css')
<style>

    .faqs-list{
        color: #0087DC;
        font-size: 16px;
    }
    a.btn:hover {
        color: #ffffff;
    }
    .text-editor img{
         max-width: 100%;
     }
     .text-editor b{
        font-weight: bold;
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
                            href="#" data-toggle="dropdown" id="tools-dropdown">{{$staticContent['Supports']}}</a>
                            <ul class="dropdown-menu">
                                <li><a href="#" id="tools-dropdown" class="text-bold">{{$staticContent['Supports']}}</a></li>
                                <hr>
                                <li><a href="{{route('contactSupport')}}">{{$staticContent['contact_us']}}</a></li>
                                <li><a href="{{route('contactSalesOffices')}}">{{$staticContent['sales_offices']}}</a></li>
                                <li><a href="{{route('contactFindDistributor')}}">{{$staticContent['find_a_distributor']}}</a></li>
                                <li><a href="{{route('index','faqs')}}">{{$staticContent['FAQs']}}</a></li>
                              </ul>   
                    </li>
                    <li class="breadcrumb-item active text-breadcrumb" aria-current="page"><a href="#">{{$staticContent['FAQs']}}</a></li>

                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="padding-top-content-breadcrumb visible-up-922"></div>
<div class="box-faqs pb-5">
    <div class="container">
        <h2 class="text-title-delta visible-tablets-up">{{$staticContent['FAQs']}}</h2>
        <h3 class="text-title-delta visible-mobile">{{$staticContent['FAQs']}}</h3>
        <div class="in-div-center">
            <div class="mb-5">
                <select id="catefaqId" class="form-control" onchange="selectCategories();">
                    <option value="0">{{$staticContent['All_Categories']}}</option>
                    @foreach ($faq_categories as $item)
                    <option value="{{$item->cate_id}}">{{$item->name}}</option> 
                    @endforeach
                </select>
            </div>
        </div>
        <div id="faqs" class="faqs-type">
          
            {{-- <div class="box-for-collap">
                <div class="faqs-list collapsed  hide-box " data-toggle="collapse" data-parent="#faqs-type"
                        href="#collapse-question02" >
                        WHAT IS POWER BOOST?
                       
                </div>
                <div id="collapse-question02" class="faqs-list-sub collapse" data-parent="#faqs-type">
                        <div class="force-overflow">
                            <div>
                                <p>It is the reserve power available constantly that allows reliable startup of loads with high inrush current.</p>    
                            </div>
                        </div>
                </div>
            </div> --}}
        </div>
    </div>
</div>
<div class="get-support" style="background: url('{{asset('frontend-asset/image/FAQ@2x.png')}}');">
    <div class="container text-center">
        <h1 class="text-white visible-upper-mobile" >{{$staticContent['Still_have_question']}}</h1>
        <h3 class="text-white visible-mobile my-3 mb-2" >{{$staticContent['Still_have_question']}}</h3>
        <p class="text-white visible-upper-mobile my-3"></p>
        <a href="{{route('contactSupport')}}" class="btn btn-subscribe">{{$staticContent['Get_Support']}}</a>
    </div>
</div>

@endsection


@section('js')
<script>
    var faqs = <?= json_encode($faqs);?>;
     
    $(document).ready(function () {
        filltertabFirst();
    });
    function selectCategories(){
         var catefaqId = $('#catefaqId').val();
         if(catefaqId == 0 ){
            filltertabFirst();
         }else{
            filltertab(catefaqId);   
         }
    }

     function filltertab(id){
              var  html = '';
              $.each(faqs, function(index,faq){
                if(faq['cate_id'] == id){
                html += '<div class="box-for-collap">';
                html += '<div class="faqs-list hide-box d-flex justify-content-between">';
                html += '<a href="{{route('faq_detail')}}/'+faq['url_name']+'">';
                html += '<p class="text-bold  m-0 p-l-18">';
                html += faq['title'];  
                html += '</p>';
                html += '</a>';
                html += '</div>';
                html +='</div>';
                }
              });

            $('#faqs').html(html);

     }

     function filltertabFirst(){
              var  html = '';
              $.each(faqs, function(index,faq){
                html += '<div class="box-for-collap">';
                html += '<div class="faqs-list   hide-box d-flex justify-content-between">';
                html += '<a href="{{route('faq_detail')}}/'+faq['url_name']+'">';
                html += '<p class="text-bold  m-0 p-l-18">';
                html += faq['title'];  
                html += '</p>';
                html += '</a>';
                html += '</div>';
                html +='</div>';
              });

            $('#faqs').html(html);

     }

    
</script>
@endsection