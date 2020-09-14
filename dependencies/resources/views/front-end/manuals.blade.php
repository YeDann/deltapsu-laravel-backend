@extends('layouts.front-end')
@section('css')
<style>
    .tab-content>.active {
        justify-content: unset !important;
        margin-top: 12px;
        display: block;
    }
    /* .tab-content{
        margin-top: 12px;
    } */
    .search-space{
        margin-bottom: 24px;
    }.nav-tabs .nav-link {
    margin: 0 29px;
    }
    .mr-b-1{
        margin-bottom: 1px;
    }

    td .select-selected::before{
        top: 10px;
    }
    /* Point the arrow upwards when the select box is open (active): */
    .select-selected .select-arrow-active:after {
        border-color: transparent transparent #fff transparent;
        top: 7px;
    }
    /* active  */
    .select-arrow-active {
        border: 1px solid #0087DC;
    }
    /* style the items (options), including the selected item: */
    .select-items div,
    .select-selected {
        padding: 4px 11px;
        height: 32px;
        cursor: pointer;
        color: #000000;
    }

    /* Style items (options): */
    .select-items div {
        color: #000000;
        padding: 6px 26px;
        height: 32px;
        
    }
    .select-items{
        cursor: pointer;
        position: absolute;
        background-color: none;
        left: 0;
        right: 0;
        z-index: 99;
        border: 1px solid #E9E9E9;
        background-color: #E9E9E9 !important;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }
    /* Hide the items when the select box is closed: */
    .select-hide {
        display: none;
    }
    .same-as-selected{
        position: relative;
    }
    .select-items div:hover {
        background-color: #ffffff;
    }
    .same-as-selected::after{
        position: absolute;
        content: "\f00c";
        top: 6px;
        left: 6px;
        width: 0;
        height: 0;
        font-family: 'FontAwesome';
    }
    .datasheet-select{
        padding: 24px 12px;
    }
  
</style>
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<style>
  .select2-container .select2-selection--single {
    height: 40px;
    border-radius: 0px;
   }
   .select2-container .select2-selection--single .select2-selection__rendered{
       padding-top: 6px;
       padding-bottom: 6px
   }
   .select2-container--default .select2-selection--single .select2-selection__arrow{
    font-size: 14px;
    -webkit-appearance: none;
    -moz-appearance: none;
    background-position: right 50%;
    background-repeat: no-repeat;
    background-image: url({{asset('frontend-asset/image/arrow-down.svg')}});
    top: 6px;
  
   }
   .select2-container--default .select2-selection--single .select2-selection__arrow b{
       display: none;
   }
   .tab-box-lang{
       padding: 10px;
       border: 2px solid #E3EFF8;
       border-left: 1px solid #E3EFF8;
       border-right: 1px solid #E3EFF8;
       border-bottom: 0px;
       cursor: pointer;
    
   }
   .tab-box-lang.active{
     background-color: #0087DC;
     color: #E9E9E9;
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
                    <li class="breadcrumb-item active text-breadcrumb" aria-current="page"><a href="#">{{$staticContent['Installation_Manual_&_Datasheet_Download']}}</a></li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="padding-top-content-breadcrumb visible-up-922"></div>
<section class="box-news ">
    <div class="container">
        <h2 class="text-title-delta visible-tablets-up">{{$staticContent['Installation_Manual_&_Datasheet_Download']}}</h2>
        <h3 class="text-title-delta visible-mobile">{{$staticContent['Installation_Manual_&_Datasheet_Download']}}</h3>
        <div class="row">
            <div class="col-xl-3 col-lg-4  col-md-12 mb-4 padding-mobile">
                        <div class="search-filter-action border-2px">
                        <p class="text-sixteen-dark">{{$staticContent['Search_By_Model_Name']}}</p>
                        <div class="box-search-input  mr-3">
                            <div class="box-search-icon">
                                <img src="{{asset('frontend-asset/image/search-filters-icon.svg')}}" alt="">
                            </div>
                            <label for="key_mobile" class="searchinput-filters-input">
                                {{-- <input type="text" id="key_model_input" placeholder="{{$staticContent['Search_By_Model_Name']}}"> --}}
                                <select id="key_model_input" class="js-example-basic-single form-control" >
                                    <option></option>
                                    @foreach ($products as $pro)
                                    <option value="{{$pro->pro_code}}" >{{$pro->pro_code}}</option> 
                                    @endforeach
                                </select>
                                <input type="hidden" id="model_id_key" >
                            </label>
                        </div>
                        <div class="search-filter-action-btn text-center">
                            <button onclick="keySearch();" class="btn-filters btn-search">{{$staticContent['Search']}}</button>
                        </div>
                    </div>
                    <h5 class="text-center pad-12px">{{$staticContent['Or']}}</h5>
                    <div class="datasheet-select border-2px">
                        <p class="text-dark text-bold mr-b-1">{{$staticContent['Type']}}</p>
                         
                            <select id="type_id" onchange="selectType();" class="form-control">
                                @foreach ($subCategories as $sub)
                                @if($loop->iteration == 1)
                                <option value="{{$sub->sub_pro_id}}" selected>{{$sub->name}}</option> 
                                 @else 
                                <option value="{{$sub->sub_pro_id}}" >{{$sub->name}}</option> 
                                 @endif 
                                @endforeach
                            </select>
                        
                        <p class="text-dark text-bold mr-b-1 mt-3">{{$staticContent['Series']}}</p>
                        
                            <select id="serie_id" onchange="onSelectSeries();" class="form-control">
                                <option value="0">{{$staticContent['Please_Select']}}*</option>
                            </select>
                       
                        <p class="text-dark text-bold mr-b-1 mt-3">{{$staticContent['Model']}}</p>
                       
                            <select id="model_id" onchange="onSelectProduct();" class="form-control">
                                <option value="0">{{$staticContent['Please_Select']}}*</option>
                            </select>
                            <input type="hidden" id="modelme1">
                        
                    </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-12">
               
                    <div class="image-datasheet" id="content_pro">
                    </div>
                    
            </div>
        
            <div class="col-xl-6 col-lg-5 col-md-12 pl-2 collapse-padding-mobile">
                <div class="invisible-up-922 text-center">
                    <h3 class="text-color-delta text-bold my-5">{{$staticContent['Downloads']}}</h3>
                </div>
                <div class="d-flex">
                    @foreach ($showlangOb as $ob)
                <div class="tab-box-lang {{$loop->iteration == 1 ?'active':''}} tab{{$ob['langName']}}" id="tabdata{{$ob['langName']}}" onclick="changeTablang('{{$ob['langName']}}');">{{$ob['langFull']}}</div>
                    @endforeach
                  
                    
               </div>
                <div id="pro_docType" class="product-document-type" id="product-document-type">
                </div>
            </div>
        </div>
    </div>
</section>


@endsection


@section('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script>
    $('.js-example-basic-single').select2({
        placeholder: '{{$staticContent['Search_By_Model_Name']}}'
});
</script>
<script>
        var series =  <?= json_encode($series);?>;
        var products =  <?= json_encode($products);?>;
        var documents_cate =  <?= json_encode($documents_cate);?>;
        var documents =  <?= json_encode($documents);?>;
        var showlang =  <?= json_encode($showlangOb);?>;
        let proImage = '' ;
        let create_pro = '00/00/0000';
        var domainUrl = '{{config('app.url')}}';
        $(document).ready(function () {
            selectType();
          
        });
        function selectType(){
            var id = $('#type_id').val();
            var html = '';
            $.each(series, function(index,serie){
                if(serie['pro_categories_id'] == id){
                    if(index == 0){
                    html += '<option value="'+serie['se_id'] +'" selected>'+serie['title']+'</option>';
                    }else{
                    html += '<option value="'+serie['se_id'] +'" >'+serie['title']+'</option>';
                    }
                }
            });
            $('#serie_id').html(html);
            onSelectSeries();
        } 
        function keySearch(){
        var key = $('#key_model_input').val();
        // console.log(key);
        var term = key; // search term (regex pattern)
        var search = new RegExp(term , 'i'); // prepare a regex object     
          products.filter(function(data){
            if(key == data.pro_code){
                $('#model_id_key').val(data.product_id); 
            }
           });
           loadContent(2);

        }   
        function changeTablang(lang){
            $('.tab-box-lang').removeClass('active');
            $('.tab'+lang).addClass('active');
            model1 = $('#modelme1').val();
            model2 = $('#model_id_key').val()
            if(model1 != null && model1 !=''){
                getContentByModel(1 ,lang);
                
            }else if(model2 != null && model2 !=''){
               
                getContentByModel(2 ,lang);
            }
        }

        function onSelectSeries(){
            var id = $('#serie_id').val();
            var html = '';
            $.each(products, function(index,pro){
                if(pro['series_id'] == id){
                    if(index == 0){
                    html += '<option value="'+pro['pro_id'] +'" selected>'+pro['pro_code']+'</option>';
                    }else{
                    html += '<option value="'+pro['pro_id'] +'">'+pro['pro_code']+'</option>';   
                    }
                }
            });
            $('#model_id').html(html);
            loadContent(1);
        }   
        function onSelectProduct(){
            loadContent(1);
        }
        function loadContent(method){
          
        var model_id;
        if(method == 1){
        model_id = $('#model_id').val();
        getContentByModel(1 ,'en');
        }else{
        model_id = $('#model_id_key').val()
        getContentByModel(2 ,'en');
        }
        checkAll(method);
            var html = '';
            products.filter(function(data) {
                if(data['pro_id'] == model_id){
                        html += '<div class="w-100">';
                        html += ' <img class="img-fluid m-auto p-3" src="'+domainUrl+'/upload/thumbs/'+data['picture']+'" alt="">';
                        html += '</div>';
                        html += ' <div class="invisible-nav-minimize">';
                        html += ' <p class="">'+data['catename']+'<br> '+data['seriesename']+'</p>';
                        html += '<h3 class="text-color-delta text-bold">'+data['pro_code'] +'</h3>';
                        html += '</div>';
                        html += '<div class="visible-nav-minimize text-center">';
                        html += '<h5 class="">'+data['catename']+' <br>'+data['seriesename']+'</h5>';
                        html += '<h3 class="text-color-delta text-bold">'+data['pro_code'] +'</h3>';
                        html += '</div>';
                }

            });
            $('#content_pro').html(html);
         
        }
        function getContentByModel(method ,lang){
       
            var model_id;
            if(method == 1){
            model_id = $('#model_id').val();
            $('#modelme1').val(model_id);
         
           
            }else{
            model_id = $('#model_id_key').val()
            $('#modelme1').val('');
            }
            products.filter(function(data) {
                if(data['pro_id'] == model_id){
                    proImage = data['picture'];
                    procode  = data['pro_code'];
                    create_pro = data['created_at'];
                }
            });
        
            var html2 = "";
       
                html2 += ' <div class="box-for-collap">'
                html2 += '<div class="product-docment-list collapsed  hide-box text-colour-delta"';
                html2 += 'data-toggle="collapse" data-parent="#product-document-type"';
                html2 += '  href="#collapse-image1">';
                html2 += '<h5 class="invisible-up-922">Manual</h5>';
                html2 += '<h4 class="visible-up-922">Manual</h4>';    
                html2 += '</div>';
                html2 += ' <div id="collapse-image1" class="product-docment-list-sub collapse" data-parent="#product-document-type">';
                html2 += '<div class="force-overflow">';
                  
            $.each(documents, function(index,doc){  
                if(doc['local'] == lang){
                    if(doc['file'] != null && doc['file'] != '' ){
                  if(doc['product_id'] == model_id){ 
                   if(doc['cate_id'] == 1 || doc['cate_id'] == 46 ){
                     html2 += ' <div class="data-sheet-downloade d-flex justify-content-between ">';
                     html2 += '<div class="detail-downlode">';
                     html2 += '<p class="text-dark text-bold">'+doc['catename']+'</p>';
                     if(doc['created_at'] != null){
                       html2 += '<p class="text-dark">{{$staticContent['Uploaded_on']}} '+setformatdate(doc['created_at']) +'</p>';
                     }else{
                      html2 += '<p class="text-dark">{{$staticContent['Uploaded_on']}} - </p>';
                     }
                     html2 += '</div>';
                     html2 += '<a href="{{route('downloadFIleManual')}}/'+lang+'/' +doc['slug']+'/'+productKey(procode)+'" target="_blank">';
                     html2 += '<button class="btn-downlode ">{{$staticContent['Downloads']}}</button>';
                     html2 += ' </a>' ;
                     html2 += ' </div>' ;
                    }
                  }
                }
               }
                });  

                
                html2 += '</div>';
                html2 += ' </div>';
                html2 += ' </div>';
         


            $.each(documents_cate, function(index,cate_doc){
             if(cate_doc['id'] == 2){
                html2 += ' <div class="box-for-collap">'
                html2 += '<div class="product-docment-list collapsed  hide-box text-colour-delta"';
                html2 += 'data-toggle="collapse" data-parent="#product-document-type"';
                html2 += '  href="#collapse-image'+cate_doc['id']+'">';
                html2 += '<h5 class="invisible-up-922">'+cate_doc['title']+'</h5>';
                html2 += '<h4 class="visible-up-922">'+cate_doc['title'] +'</h4>';    
                html2 += '</div>';
                html2 += ' <div id="collapse-image'+cate_doc['id']+'" class="product-docment-list-sub collapse" data-parent="#product-document-type">';
                html2 += '<div class="force-overflow">';
                  
            $.each(documents, function(index,doc){  
                if(doc['local'] == lang){
                    if(doc['file'] != null && doc['file'] != '' ){
                  if(doc['product_id'] == model_id){ 
                   if(doc['cate_id'] == cate_doc['id']){
                     html2 += ' <div class="data-sheet-downloade d-flex justify-content-between ">';
                     html2 += '<div class="detail-downlode">';
                     html2 += '<p class="text-dark text-bold">'+doc['catename']+'</p>';
                     if(doc['created_at'] != null){
                       html2 += '<p class="text-dark">{{$staticContent['Uploaded_on']}} '+setformatdate(doc['created_at']) +'</p>';
                     }else{
                      html2 += '<p class="text-dark">{{$staticContent['Uploaded_on']}} - </p>';
                     }
                     html2 += '</div>';
                     html2 += '<a href="{{route('downloadFIleManual')}}/'+lang+'/' +doc['slug']+'/'+productKey(procode)+'" target="_blank">';
                     html2 += '<button class="btn-downlode ">{{$staticContent['Downloads']}}</button>';
                     html2 += ' </a>' ;
                     html2 += ' </div>' ;
                    }
                  }
                }
               }
                });  

                
                html2 += '</div>';
                html2 += ' </div>';
                html2 += ' </div>';
              }
            });
           
            $('#pro_docType').html(html2);
        }


        function setformatdate(val){
            var string  = '';
            var date = new date(val);
            string = date.g
        }
        function setformatdate(val){
            var data = val.substring(0, 10)
            var d = new Date(data);
           
            const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
            "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
            ];
         return  d.getDate()+'-'+ monthNames[d.getMonth()]+'-' +d.getFullYear();
       }

       function productKey(key){
            var newkey = key.replace('/', '@');
            return newkey;
        }


       function checkAll(method){
            var model_id;
            if(method == 1){
            model_id = $('#model_id').val();
            $('#modelme1').val(model_id);
         
           
            }else{
            model_id = $('#model_id_key').val()
            $('#modelme1').val('');
            }
       
            // console.log(showlang);
            $.each(showlang, function(indexlang,lan){
                var arrlang = [];
                $.each(documents_cate, function(index,cate_doc){
                    if(cate_doc['id'] == 1 || cate_doc['id'] == 2){
                        $.each(documents, function(index,doc){  
                            if(doc['local'] == lan.langName){
                                if(doc['product_id'] == model_id){ 
                                if(doc['file'] != null && doc['file'] != '' ){
                                    arrlang.push(lan.langName);
                                }
                               
                                }
                            }
                        });
                     
                    }
               });
            //    console.log(arrlang.length);
               if(arrlang.length == 0){
                     $('#tabdata'+lan.langName).addClass('d-none');
                }else{
                    $('#tabdata'+lan.langName).removeClass('d-none');
                }
           });
    }
    
    
</script>

@endsection
