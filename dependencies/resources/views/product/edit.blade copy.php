@extends('layouts.admin')
@section('style')
<style>
        .card-header-collapes {
            border: 1px solid gray;
            padding: 10px;
            border-radius: 4px;
        }
    
        #accordion_input {
            width: 100%;
        }
    
        .card-body {
            padding: 10px;
        }
    
    
    
        .inline-box {
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
        }
    
        .input-group-addon {
            padding: 6px 12px;
            font-size: 14px;
            font-weight: 400;
            line-height: 1;
            color: #555;
            text-align: center;
            background-color: #eee;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
    
        .product-custom-field {
            max-width: 150px;
            display: inline-block;
            margin-top: 5px;
            margin-right: 5px;
        }
    
        .product-custom-field-min {
            max-width: 150px;
            display: inline-block;
            margin-top: 5px;
            margin-right: 5px;
        }
    
        .input-group-addon,
        .input-group-btn {
            width: 1%;
            white-space: nowrap;
            vertical-align: middle;
        }
    
        .input-group {
            position: relative;
            display: table;
            border-collapse: separate;
        }
    
        .input-group input {
            width: 100% !important;
        }
    
        .input-group .form-control,
        .input-group-addon,
        .input-group-btn {
            display: table-cell;
        }
    
        .btn-add-input {
            display: inline-block;
        }
    
        .p-l {
            border-top-right-radius: 0px;
            border-bottom-right-radius: 0px;
        }
    
        .p-r {
            border-top-left-radius: 0px;
            border-bottom-left-radius: 0px;
        }
    
    </style>
@endsection
@section('content')
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Edit Product</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <a href="{{route('products.index')}}">Products</a> </li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- Content -->
<div class="content">
    <div class="block block-rounded block-bordered">
        <div class="block-header block-header-default">
            <h3 class="block-title">Product Information</h3>
        </div>
        <div class="block-content">
            <form action="{{route('updateProduct')}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <!-- Basic Elements -->
                <div class="row">
                    <div class="col-md-12">
                    <input type="hidden" name="pro_id"  value="{{$products[0]->pro_id}}">
                            <div class="form-group">
                                    <label for="example-select">Product Code <span class="req-fed">*</span></label>
                                    <input type="text"
                                        class="form-control {{ $errors->has('productCode') ? 'is-invalid' : '' }}"
                                        name="productCode" value="{{$products[0]->pro_code}}" placeholder="Enter name..."  required>
                                </div>
                                <div class="form-group">
                                    <label for="example-select">Select Product Categorie <span class="req-fed">*</span></label>
                                    <select class="js-select2 form-control" id="pro_categories" name="pro_categories" onchange="selectProductcategories()" data-placeholder="Choose one.." required>
                                            <option></option>
                                           @foreach($subCategories as $sub) 
                                           @if($products[0]->pro_categories_id == $sub->sub_pro_id)
                                            <option value="{{$sub->sub_pro_id}}" selected>{{$sub->name}}</option>
                                            @else 
                                            <option value="{{$sub->sub_pro_id}}" >{{$sub->name}}</option>
                                            @endif
                                            @endforeach
                                        </select>    
                                </div>
                                <div class="form-group">
                                        <label for="example-select">Select Serie <span class="req-fed">*</span></label>
                                        <select class="js-select2 form-control" id="SeriesId" name="Series" data-placeholder="Choose one.." required>
                                                <option></option>
                                            </select>    
                                </div>
                                <div class="form-group">
                                        <label>Dimension L</label>
                                        <label><span class="req-fed">Choice A: Use numeric value for simple display L x W x D. Choice B: Use HTML to display any free text and ignore dimensionW and dimensionD  </span></label>
                                        <input type="text" class="form-control" value="{{$products[0]->dimensionL}}"  name="dimensionL" placeholder="Enter ..." >
                                </div>
                                <div class="form-group">
                                        <label>Dimension W</label>
                                        <input type="text" class="form-control" value="{{$products[0]->dimensionW}}"  name="dimensionw" placeholder="Enter ..." >
                                </div>
                                <div class="form-group">
                                        <label>Dimension D</label>
                                        <input type="text" class="form-control"  value="{{$products[0]->dimensionD}}" name="dimensionD" placeholder="Enter ..." >
                                </div>
                                <div class="form-group">
                                        <label>Unit Weight</label>
                                        <input type="text" class="form-control" value="{{$products[0]->unit_weight}}"  name="unitWeight" placeholder="Enter ..." >
                                </div>
                                <div class="form-group">
                                        <label class="d-block">Status <span class="req-fed">*</span></label>
                                        <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                                <input type="radio" class="custom-control-input" id="status_none" name="status_pro" value="1" {{ ($products[0]->status_product == 1 ) ? 'checked' : '' }}  >
                                                <label class="custom-control-label" for="status_none">None</label>
                                            </div>
                                        <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                                <input type="radio" class="custom-control-input" id="status_new" name="status_pro" value="2" {{ ($products[0]->status_product == 2) ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="status_new">NEW</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                                <input type="radio" class="custom-control-input" id="status_update" name="status_pro" value="3"  {{ ($products[0]->status_product == 3 ) ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="status_update">UPDATED</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                                    <input type="radio" class="custom-control-input" id="status_eol" name="status_pro" value="4" {{ ($products[0]->status_product == 4 ) ? 'checked' : '' }} >
                                                    <label class="custom-control-label" for="status_eol">EOL</label>
                                                </div>
                                       
                                    </div>
                                  
                             
                        <div class="block block-rounded block-bordered">
                            <ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs" role="tablist">
                                @foreach ($products as $item)
                                @if($loop->iteration == 1)
                                <li class="nav-item">
                                    <a class="nav-link active" onclick="selectlang('{{$item->local}}')" href="#btabs-alt-static-{{$item->local}}"
                                        style="text-transform: capitalize;">{{$item->local}}</a>
                                </li>
                                @else
                                <li class="nav-item">
                                    <a class="nav-link " onclick="selectlang('{{$item->local}}')" href="#btabs-alt-static-{{$item->local}}"
                                        style="text-transform: capitalize;">{{$item->local}}</a>
                                </li>
                                @endif
                                @endforeach
                            </ul>
                            <div class="block-content tab-content">
                                @foreach ($products as $item)
                                <input type="hidden" name="lang_loop[]" value="{{$item->local}}">
                                @if($loop->iteration == 1)
                                <div class="tab-pane active" id="btabs-alt-static-{{$item->local}}" role="tabpanel">
                                  
                                    <div class="form-group">
                                        <label for="">Highlights & Features</label>
                                    <textarea name="overview[{{$item->local}}]" class="jssummernote">{{$item->content_1}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Content</label>
                                        <textarea name="content[{{$item->local}}]" class="jssummernote1">{{$item->content_2}}</textarea>
                                    </div>
                                    <div class="form-group">
                                            <label class="d-block">Show Status</label>
                                            <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                                    <input type="radio" class="custom-control-input" id="status-0{{$item->local}}" name="status[{{$item->local}}]" value="1" {{ ($item->showstatus == 1 ) ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="status-0{{$item->local}}">Show</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                                    <input type="radio" class="custom-control-input" id="status-3{{$item->local}}" name="status[{{$item->local}}]" value="0" {{ ($item->showstatus == 0 ) ? 'checked' : '' }} >
                                                    <label class="custom-control-label" for="status-3{{$item->local}}">Hide</label>
                                                </div>
                                           
                                        </div>
                                </div>
                                @else
                                <div class="tab-pane" id="btabs-alt-static-{{$item->local}}" role="tabpanel">
                                    <div class="form-group">
                                        <label for="">Highlights & Features</label>
                                        <textarea name="overview[{{$item->local}}]" class="jssummernote">{{$item->content_1}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Content</label>
                                        <textarea name="content[{{$item->local}}]" class="jssummernote1">{{$item->content_2}}</textarea>
                                    </div>
                                    <div class="form-group">
                                            <label class="d-block">Show Status</label>
                                            <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                                    <input type="radio" class="custom-control-input" id="status-1{{$item->local}}" name="status[{{$item->local}}]" value="1" {{ ($item->showstatus == 1 ) ? 'checked' : '' }}  >
                                                    <label class="custom-control-label" for="status-1{{$item->local}}">Show</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                                    <input type="radio" class="custom-control-input" id="status-2{{$item->local}}" name="status[{{$item->local}}]" value="0" {{ ($item->showstatus == 0 ) ? 'checked' : '' }} >
                                                    <label class="custom-control-label" for="status-2{{$item->local}}">Hide</label>
                                                </div>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-vcenter">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 10px;">
                                            File Type
                                        </th>
                                        <th style="width: 300px;">Old Image</th>
                                        <th style="width: 300px;">Preview</th>
                                        <th>Upload File</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">
                                            Thumbnail
                                        </td>
                                        <td class="font-w600">
                                            <img src="{{config('app.url')}}/medias/categories/{{$products[0]->picture}}"
                                                class="img-thumbnail" alt="">
                                        </td>
                                        <td class="font-w600">
                                            <img src="https://via.placeholder.com/200x200.png"
                                                class="img-thumbnail imagePreview2" alt="">
                                        </td>
                                        <td class="">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input"
                                                    data-toggle="custom-file-input" id="thumbnail"
                                                    name="thumbnail" value="no image" accept="image/*">
                                                <label id="label2" class="custom-file-label" for="thumbnail">Choose
                                                    file</label>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div id="contenttdata"> 
                        </div>
                        <div class="form-group text-center mt-5">
                            <button class="btn btn-info" type="submit">Update
                            </button>
                            <a href="{{route('products.index')}}" class="btn btn-secondary">
                                Cancel
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
      
        
        $('.jssummernote').summernote({
          tabsize: 2,
          height: 200
        });
        $('.jssummernote1').summernote({
          tabsize: 2,
          height: 300
        });
       
        var section = <?= json_encode($section);?>;
        var property = <?= json_encode($propertys);?>;
        var feilds = <?= json_encode($pd_fields);?>;  
        var alllangs  = <?= json_encode($language);?>;           
         function getHtmlContent(lang){
          
            var html2 = '';
                  html2 += '<div id="accordion_input">';
                 $.each(section, function(index_section,sect){
                    html2 += '<div class="card">';
                    html2 += '<div class="card-header card-header-collapes" data-toggle="collapse"';
                    html2 += 'href="#collapseheader'+index_section +'">';
                    html2 +=  '<a class="card-link">';
                    html2 +=  sect['name'];
                    html2 += '</a></div>';
                    html2 += ' <div id="collapseheader'+index_section +'"';
                    html2 += 'class="collapse'+ ((index_section == 0)  ? "show" : " ") + '"';
                    html2 += ' data-parent="#accordion_input">';
                    html2 += '  <div class="card-body">';
                     $.each(property, function(index_property,proper){
                       if(sect['sectid'] == proper['section_id']){
                          if(proper['type'] == "text"){
                            html2 +=  '<input type="hidden" class="form-control" name="productfieldText[]" value="'+proper['pd_field_id']+'">';
                            html2 +=  '<div class="data-text '+((proper['local'] == lang)  ? "d-block" : "d-none")+ '">';
                            html2 += '<div class="form-group">';
                            html2 += '<label class="d-block">'+proper['field_name']+'</label>';
                            html2 += ' <input type="text" class="form-control" name="inputText['+proper['pd_field_id']+']['+proper['local']+']" value="'+proper['value_text']+'"> </div>';
                            html2 += ' </div>';
                         }else{
                      if(proper['local'] == lang ){
                        html2 +=  '<div class="data-number">';
                        html2 +=  ' <input type="hidden" class="form-control"';
                        html2 +=  ' name="productfieldNumbers[]" value="'+proper['pd_field_id']+'">'
                        html2 +=  '<div class="form-group">';
                        html2 +=  '<label class="d-block">'+proper['field_name']+'</label>';
                        html2 +=  '<div class="custom-control custom-radio custom-control-inline custom-control-primary">';
                        html2 +=  '<input type="radio" class="custom-control-input" onchange="selectinputtype('+proper['pd_field_id']+',1);"';
                        html2 +=  'id="status_input_sig'+proper['pd_field_id']+'" name="status_input['+proper['pd_field_id']+']"';
                        html2 +=  'value="1"  '+ ((proper['status_input'] == 1)  ? "checked" : " ") + '>';
                        html2 +=  '<label class="custom-control-label"for="status_input_sig'+proper['pd_field_id']+'">Single</label>';
                        html2 +=  '</div>';
                        html2 +=  '<div class="custom-control custom-radio custom-control-inline custom-control-primary">'
                        html2 +=  '<input type="radio" class="custom-control-input"  onchange="selectinputtype('+proper['pd_field_id']+',2);"';
                        html2 +=  'id="status_input_Mutl'+proper['pd_field_id']+'"  name="status_input['+proper['pd_field_id']+']"';
                        html2 +=  'value="2" '+ ((proper['status_input'] == 2)  ? "checked" : " ") + '>';
                        html2 +=  '<label class="custom-control-label"';
                        html2 +=  'for="status_input_Mutl'+proper['pd_field_id']+'">Multiple</label>';
                        html2 +=  '</div>';
                        html2 +=  '<div class="custom-control custom-radio custom-control-inline custom-control-primary">';
                        html2 +=  ' <input type="radio" class="custom-control-input"  onchange="selectinputtype('+proper['pd_field_id']+' ,3);"';                                             
                        html2 +=  ' id="status_input_Rang'+proper['pd_field_id']+'" name="status_input['+proper['pd_field_id']+']" value="3" '+ ((proper['status_input'] == 3)  ? "checked" : " ") + '>';
                        html2 +=  ' <label class="custom-control-label"  for="status_input_Rang'+proper['pd_field_id']+'">Range</label></div>';
                        html2 +=  ' </div>';
                        html2 +=  ' <div class="mulltiple-box'+proper['pd_field_id']+' '+ ((proper['status_input'] == 2)  ? "d-block" : "d-none") + '">';
                        html2 += ' <div class="product-custom-field addfield1">';
                        html2 += ' <div class="form-group input-group">';
                        html2 += ' <span class="input-group-addon p-l">1</span>';
                        html2 += ' <input name="inputNumber['+proper['pd_field_id']+'][1]" value="'+proper['data_1']+'" type="number" min="0" class="form-control">';
                        html2 += ' <span  class="input-group-addon number_type_remove p-r" onclick="deletemutifield('+proper['pd_field_id']+' , 1);">-</span>';
                        html2 += '</div>';
                        html2 += ' </div>';
                        html2 += ' <div class="product-custom-field addfield2">';
                        html2 += '<div class="form-group input-group">';
                        html2 += '<span class="input-group-addon p-l">2</span>';
                        html2 += ' <input name="inputNumber['+proper['pd_field_id']+'][2]" value="'+proper['data_2']+'" type="number" min="0" class="form-control">';
                        html2 += '<span';
                        html2 += ' class="input-group-addon number_type_remove p-r" onclick="deletemutifield('+proper['pd_field_id']+' , 2);">-</span>';
                        html2 += '</div>';
                        html2 += '</div>';
                        html2 += '<div class="product-custom-field addfield3">';
                        html2 += '<div class="form-group input-group">';
                        html2 += '<span class="input-group-addon p-l">3</span>'
                        html2 += '<input name="inputNumber['+proper['pd_field_id']+'][3]" value="'+proper['data_3']+'" type="number"';
                        html2 += 'min="0" class="form-control">';
                        html2 += '<span';
                        html2 += ' class="input-group-addon number_type_remove p-r" onclick="deletemutifield('+proper['pd_field_id']+', 1);">-</span>';
                        html2 += '</div>';
                        html2 += '</div>';
                        html2 += '<div class="btn-add-input">'
                        html2 += '<div class="form-group input-group">';
                        html2 += '<button type="button" class="btn" onclick="addMutlple('+proper['pd_field_id']+');">';
                        html2 += ' Add </button>';
                        html2 += '</div></div></div>';
                        html2 += '<div class="range-box'+proper['pd_field_id']+' '+ ((proper['status_input'] == 3)  ? "d-block" : "d-none") + '">';
                        html2 += '<div class="product-custom-field-min">';
                        html2 += '<div class="form-group input-group">';
                        html2 += '<span class="input-group-addon p-l">Min</span>';
                        html2 += '<input name="inputNumber['+proper['pd_field_id']+'][1]" type="number" value="'+proper['data_1']+'" min="0"';
                        html2 += 'class="form-control">';
                        html2 += '</div>';
                        html2 += ' </div>';
                        html2 +='<div class="product-custom-field-min">';
                        html2 += '<div class="form-group input-group">';
                        html2 += '<span class="input-group-addon p-l">Max</span>';
                        html2 += '<input name="inputNumber['+proper['pd_field_id']+'][2]" type="number" value="'+proper['data_2']+'" min="0"';
                        html2 += 'class="form-control">';
                        html2 += '</div>';
                        html2 += ' </div>';
                        html2 += ' </div>';
                        html2 += ' <div class="single-box'+proper['pd_field_id']+' '+ ((proper['status_input'] == 1)  ? "d-block" : "d-none") + '">';
                        html2 += '<div class="product-custom-field-min">';
                        html2 +=  '<div class="form-group input-group ">';
                        html2 +=  '<input name="inputNumber['+proper['pd_field_id']+'][1]" type="number"  value="'+proper['data_1']+'" min="0"';
                        html2 +=  'class="form-control">';
                        html2 +=   '</div>';
                        html2 += '</div>';
                        html2 += '</div>';
                        html2 +=' </div>';
                         }
                        }
                       }
                     });
                     
                     $.each(feilds, function(index_feild,feild){
                        if(sect['sectid'] == feild['section_id']){
                          if(feild['type'] == "text"){
                         html2 +=  '<input type="hidden" class="form-control" name="productfieldText[]" value="'+feild['pd_field_id']+'">';
                         html2 +=  '<div class="data-text">';
                         html2 += '<div class="form-group">';
                         html2 += '<label class="d-block">'+feild['field_name']+'</label>';
                         html2 += ' <input type="text" class="form-control" name="inputText['+feild['pd_field_id']+'][en]" value=""> </div>';
                         html2 += ' </div>';
                         }else{
                    
                        html2 +=  '<div class="data-number">';
                        html2 +=  ' <input type="hidden" class="form-control"';
                        html2 +=  ' name="productfieldNumbers[]" value="'+feild['pd_field_id']+'">'
                        html2 +=  '<div class="form-group">';
                        html2 +=  '<label class="d-block">'+feild['field_name']+'</label>';
                        html2 +=  '<div class="custom-control custom-radio custom-control-inline custom-control-primary">';
                        html2 +=  '<input type="radio" class="custom-control-input" onchange="selectinputtype('+feild['pd_field_id']+',1);"';
                        html2 +=  'id="status_input_sig'+feild['pd_field_id']+'" name="status_input['+feild['pd_field_id']+']"';
                        html2 +=  'value="1"  checked >';
                        html2 +=  '<label class="custom-control-label"for="status_input_sig'+feild['pd_field_id']+'">Single</label>';
                        html2 +=  '</div>';
                        html2 +=  '<div class="custom-control custom-radio custom-control-inline custom-control-primary">'
                        html2 +=  '<input type="radio" class="custom-control-input"  onchange="selectinputtype('+feild['pd_field_id']+',2);"';
                        html2 +=  'id="status_input_Mutl'+feild['pd_field_id']+'"  name="status_input['+feild['pd_field_id']+']"';
                        html2 +=  'value="2" >';
                        html2 +=  '<label class="custom-control-label"';
                        html2 +=  'for="status_input_Mutl'+feild['pd_field_id']+'">Multiple</label>';
                        html2 +=  '</div>';
                        html2 +=  '<div class="custom-control custom-radio custom-control-inline custom-control-primary">';
                        html2 +=  ' <input type="radio" class="custom-control-input"  onchange="selectinputtype('+feild['pd_field_id']+' ,3);"';                                             
                        html2 +=  ' id="status_input_Rang'+feild['pd_field_id']+'" name="status_input['+feild['pd_field_id']+']" value="3" >';
                        html2 +=  ' <label class="custom-control-label"  for="status_input_Rang'+feild['pd_field_id']+'">Range</label></div>';
                        html2 +=  ' </div>';
                        html2 +=  ' <div class="mulltiple-box'+feild['pd_field_id']+' d-none">';
                        html2 += ' <div class="product-custom-field addfield1">';
                        html2 += ' <div class="form-group input-group">';
                        html2 += ' <span class="input-group-addon p-l">1</span>';
                        html2 += ' <input name="inputNumber['+feild['pd_field_id']+'][1]"  type="number" min="0" class="form-control">';
                        html2 += ' <span  class="input-group-addon number_type_remove p-r" onclick="deletemutifield('+feild['pd_field_id']+' , 1);">-</span>';
                        html2 += '</div>';
                        html2 += ' </div>';
                        html2 += ' <div class="product-custom-field addfield2">';
                        html2 += '<div class="form-group input-group">';
                        html2 += '<span class="input-group-addon p-l">2</span>';
                        html2 += ' <input name="inputNumber['+feild['pd_field_id']+'][2]" type="number" min="0" class="form-control">';
                        html2 += '<span';
                        html2 += ' class="input-group-addon number_type_remove p-r" onclick="deletemutifield('+feild['pd_field_id']+' , 2);">-</span>';
                        html2 += '</div>';
                        html2 += '</div>';
                        html2 += '<div class="product-custom-field addfield3">';
                        html2 += '<div class="form-group input-group">';
                        html2 += '<span class="input-group-addon p-l">3</span>'
                        html2 += '<input name="inputNumber['+feild['pd_field_id']+'][3]"  type="number"';
                        html2 += 'min="0" class="form-control">';
                        html2 += '<span';
                        html2 += ' class="input-group-addon number_type_remove p-r" onclick="deletemutifield('+feild['pd_field_id']+', 1);">-</span>';
                        html2 += '</div>';
                        html2 += '</div>';
                        html2 += '<div class="btn-add-input">'
                        html2 += '<div class="form-group input-group">';
                        html2 += '<button type="button" class="btn" onclick="addMutlple('+feild['pd_field_id']+');">';
                        html2 += ' Add </button>';
                        html2 += '</div></div></div>';
                        html2 += '<div class="range-box'+feild['pd_field_id']+' d-none">';
                        html2 += '<div class="product-custom-field-min">';
                        html2 += '<div class="form-group input-group">';
                        html2 += '<span class="input-group-addon p-l">Min</span>';
                        html2 += '<input name="inputNumber['+feild['pd_field_id']+'][1]" type="number"  min="0"';
                        html2 += 'class="form-control">';
                        html2 += '</div>';
                        html2 += ' </div>';
                        html2 +='<div class="product-custom-field-min">';
                        html2 += '<div class="form-group input-group">';
                        html2 += '<span class="input-group-addon p-l">Max</span>';
                        html2 += '<input name="inputNumber['+feild['pd_field_id']+'][2]" type="number"  min="0"';
                        html2 += 'class="form-control">';
                        html2 += '</div>';
                        html2 += ' </div>';
                        html2 += ' </div>';
                        html2 += ' <div class="single-box'+feild['pd_field_id']+' ">';
                        html2 += '<div class="product-custom-field-min">';
                        html2 +=  '<div class="form-group input-group ">';
                        html2 +=  '<input name="inputNumber['+feild['pd_field_id']+'][1]" type="number"   min="0"';
                        html2 +=  'class="form-control">';
                        html2 +=   '</div>';
                        html2 += '</div>';
                        html2 += '</div>';
                        html2 +=' </div>';
                         }
                        }
                       
                    });
                            html2 +=  '</div>';
                            html2 +=    '</div>';
                            html2 +=    ' </div>';
                 });
                      html2 +=  '</div>';
                      $('#contenttdata').html(html2);

         }
        function selectinputtype(id ,type){
        
                // $('.single-box'+id+' input[type="number"]').val('');
                // $('.mulltiple-box'+id+' input[type="number"]').val('');
                // $('.range-box'+id+' input[type="number"]').val('');

                $('.single-box'+id).removeClass('d-block');
                $('.mulltiple-box'+id).removeClass('d-block');
                $('.range-box'+id).removeClass('d-block');
            if(type == 1){
                $('.single-box'+id).addClass('d-block');
                $('.mulltiple-box'+id).addClass('d-none');
                $('.range-box'+id).addClass('d-none');
            }else if(type == 2){
                $('.single-box'+id).addClass('d-none');
                $('.mulltiple-box'+id).addClass('d-block');
                $('.range-box'+id).addClass('d-none');
            }else if(type == 3){
                $('.single-box'+id).addClass('d-none');
                $('.mulltiple-box'+id).addClass('d-none');
                $('.range-box'+id).addClass('d-block');

              
            }

     }
    function addMutlple(id){
        var numItems = $('.mulltiple-box'+id).find('.product-custom-field').length;
        if(numItems < 5){
            var html = '';
            html += '<div class="product-custom-field addfield'+(numItems+1)+'">';
            html += '<div class="form-group input-group">';
            html += ' <span class="input-group-addon p-l">'+(numItems+1)+'</span>';
            html += '<input name="inputNumber['+id+']['+(numItems+1)+']" type="number" min="0" class="form-control">';
            html += '<span class="input-group-addon number_type_remove p-r" onclick="deletemutifield('+id+','+(numItems+1)+');">-</span></div>';
            html += '</div>';
            $('.mulltiple-box'+id).append(html)
            $('.mulltiple-box'+id +' .btn-add-input').insertAfter('.mulltiple-box'+id+' .product-custom-field:last-child')

        }else{
            alert('Max Multiple is 5');
        }
        
        }

    function deletemutifield(id,numItems){
        $('.mulltiple-box'+id + ' .addfield'+numItems).remove();
        $('.mulltiple-box'+id+ ' .product-custom-field').attr('class', 'product-custom-field');
        $.each($('.mulltiple-box'+id+ ' .product-custom-field'),function(index,val){
            $(val).addClass('addfield'+(index+1))
            $(val).children('.input-group').children('.input-group-addon.p-l').text(index+1);
            $(val).children('.input-group').children('input').attr('name','inputNumber['+id+']['+(index+1)+']')
            $(val).children('.input-group').children('.input-group-addon.number_type_remove.p-r').attr('onclick','deletemutifield('+id+','+(index+1)+');')
        })
    }

    function selectlang(lang){
        getHtmlContent(lang);
    }

        $( document ).ready(function() {
            selectProductcategories();
            getHtmlContent('en');
        });
      </script>
<script>
    var previewImage = function (input, block) {
        var fileTypes = ['jpg', 'jpeg', 'png', 'gif', 'svg'];
        var extension = input.files[0].name.split('.').pop().toLowerCase(); /*se preia extensia*/
        var isSuccess = fileTypes.indexOf(extension) > -1; /*se verifica extensia*/

        if (isSuccess) {
            var reader = new FileReader();
            reader.onload = function (e) {
                block.attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
            return false;
        } else {
            alert('File is not expept!');
            return true;
        }

    };


    $(document).on('change', '#thumbnail', function () {
        var FileSize = this.files[0].size / 1024 / 1024; // in MB
        if (FileSize > 2) {
            alert("File size exceeds 2 MB!");
            this.value = "";
            $('#label2').text('Choose file');
        } else {
            previewImage(this, $('.imagePreview2'));
        }

    });
    function selectProductcategories(){
        var  serieId = "{{$products[0]->series_id}}";
        var cateid = $('#pro_categories').val();
        $.ajax({
            url: "{{ (route('searhSeries')) }}/" + cateid,
            type: 'get',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                var options = '';

                for (var i = 0; i < data.modalContent.length; i++) {
                    if(serieId == data.modalContent[i].se_id ){
                        options += '<option value="' + data.modalContent[i].se_id + '" selected>' + data.modalContent[i].title + '</option>';
                    }else{
                        options += '<option value="' + data.modalContent[i].se_id + '" >' + data.modalContent[i].title + '</option>';
                    }
                   
                }
                $("select#SeriesId").html(options);
            }

        });
       
    }
</script>
@endsection
