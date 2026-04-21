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

    #item-wrap {
        margin: 8px 8px 8px 8px;
        background: #eee;
        padding: 5px 10px 30px 5px;
        -webkit-border-radius: 8px;
        -moz-border-radius: 8px;
        position: relative;
    }

    .text-count {
        right: 7px;
        bottom: 4px;
        position: absolute;
        font-size: 14px;
    }
</style>
@endsection
@section('content')
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Create Product</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <a href="{{route('products.index')}}">Products</a> </li>
                    <li class="breadcrumb-item active" aria-current="page">Create</li>
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
            <form action="{{route('storeProduct')}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <!-- Basic Elements -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">

                            <label for="example-select">Product Code <span class="req-fed">*</span></label>
                            <input type="text"
                                class="form-control {{ $errors->has('productCode') ? 'is-invalid' : '' }}"
                                name="productCode" value="{{old('productCode')}}" placeholder="Enter name..." required>
                            <span class="req-fed">Remark* Don't use ( & ) in product code</span>
                        </div>
                        {{-- <div class="form-group">
                            <label for="example-select"> <span class="req-fed">*</span></label>
                            <select class="js-select2 form-control" id="pro_categories" name="pro_categories"
                                onchange="selectProductcategories()" data-placeholder="Choose one.." required>
                                <option></option>
                                @foreach($subCategories as $sub)
                                <option value="{{$sub->sub_pro_id}}">{{$sub->name}}</option>
                                @endforeach
                            </select>
                            <input type="hidden" name="categorie" id="categories">
                        </div> --}}

                        <div class="form-group">
                            <label class="d-block">Select Product Category <span class="req-fed">*</span></label>
                            @foreach($subCategories as $sub)
                            <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                <input type="checkbox"
                                    onclick="selectProductcategories({{$sub->sub_pro_id}} , '{{$sub->url_item}}')"
                                    class=" custom-control-input" id="dataCate{{$sub->sub_pro_id}}"
                                    name="pro_categories[]" value="{{$sub->sub_pro_id}}">
                                <label class="custom-control-label"
                                    for="dataCate{{$sub->sub_pro_id}}">{{$sub->name}}</label>
                            </div>
                            @endforeach
                            <input type="hidden" name="categorie" id="categories">
                        </div>
                        <div class="form-group">
                            <label for="example-select">Select Series <span class="req-fed">*</span></label>
                            <select class="js-select2 form-control" id="SeriesId" name="Series"
                                data-placeholder="Choose one.." required>
                                <option></option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="d-block">Segment <span class="req-fed">*</span></label>
                            <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                <input type="checkbox" class="custom-control-input" id="status_induc"
                                    name="status_certificate[]" value="1" checked>
                                <label class="custom-control-label" for="status_induc">Industrial</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                <input type="checkbox" class="custom-control-input" id="status_medical"
                                    name="status_certificate[]" value="2">
                                <label class="custom-control-label" for="status_medical">Medical</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                <input type="checkbox" class="custom-control-input" id="status_residen"
                                    name="status_certificate[]" value="3">
                                <label class="custom-control-label" for="status_residen">Lighting & Signage</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                <input type="checkbox" class="custom-control-input" id="status_wireless"
                                    name="status_certificate[]" value="4">
                                <label class="custom-control-label" for="status_wireless">Industrial Battery
                                    Charging</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Dimension L</label>
                            <label><span class="req-fed">Choice A: Use numeric value for simple display L x W x D.
                                    Choice B: Use HTML to display any free text and ignore dimensionW and dimensionD
                                </span></label>
                            <input type="text" class="form-control" value="{{old('dimensionL')}}" name="dimensionL"
                                placeholder="Enter ...">
                        </div>
                        <div class="form-group">
                            <label>Dimension W</label>
                            <input type="text" class="form-control" name="dimensionw" placeholder="Enter ...">
                        </div>
                        <div class="form-group">
                            <label>Dimension D</label>
                            <input type="text" class="form-control" name="dimensionD" placeholder="Enter ...">
                        </div>
                        <div class="form-group">
                            <label>Unit Weight <span style="color:red;">(kg only)</span></label>
                            <input type="text" class="form-control" name="unitWeight" placeholder="Enter ...">
                        </div>
                        <div class="form-group">
                            <label class="d-block">Part Number</label>
                            <div id="part-number-list">
                                <div class="part-number-row d-flex mb-2" data-index="0">
                                    <input type="text" class="form-control mr-2" name="partNumber[no][0]" placeholder="No">
                                    <input type="text" class="form-control mr-2" name="partNumber[text][0]" placeholder="Text">
                                    <button type="button" class="btn btn-danger btn-sm" onclick="removePartNumber(this)">-</button>
                                </div>
                            </div>
                            <button type="button" class="btn btn-secondary btn-sm mt-2" onclick="addPartNumber()">+ Add</button>
                        </div>
                        <div class="form-group">
                            <label class="d-block">Status <span class="req-fed">*</span></label>
                            <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                <input type="radio" class="custom-control-input" id="status_none" name="status_pro"
                                    value="1" checked>
                                <label class="custom-control-label" for="status_none">None</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                <input type="radio" class="custom-control-input" id="status_new" name="status_pro"
                                    value="2">
                                <label class="custom-control-label" for="status_new">NEW</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                <input type="radio" class="custom-control-input" id="status_update" name="status_pro"
                                    value="3">
                                <label class="custom-control-label" for="status_update">NRND</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                <input type="radio" class="custom-control-input" id="status_eol" name="status_pro"
                                    value="4">
                                <label class="custom-control-label" for="status_eol">EOL</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Tag</label>
                            <select name="tag[]" class="form-control js-example-tags" data-placeholder="Enter tag.."
                                multiple="multiple">
                                <option></option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Optional Model</label>
                            <select name="optional_models[]" class="form-control js-example-tags"
                                data-placeholder="Enter Optional Model" multiple="multiple">
                                <option></option>
                                @foreach ($products as $pro)
                                <option value="{{$pro->pro_code}}">{{$pro->pro_code}}</option>
                                @endforeach
                            </select>
                        </div>



                        <div class="form-group">
                            <label>Related Products</label>
                            <select id="relatePro" class="js-select2 form-control" name="relatePro[]"
                                data-placeholder="Choose many.." multiple>
                                <option></option>
                                @foreach ($products as $pro)
                                <option value="{{$pro->pro_id}}">{{$pro->pro_code}}</option>
                                @endforeach
                            </select>
                        </div>




                        <div class="block block-rounded block-bordered">

                            <div class="block-content tab-content">
                                @foreach ($language as $item)
                                <input type="hidden" name="lang_loop[]" value="{{$item->name}}">
                                @endforeach

                                <div class="form-group">
                                    <label for="">Highlights & Features</label>
                                    <textarea name="overview" class="jsnotenew"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Content</label>
                                    <textarea name="content" class="jsnotenew"></textarea>
                                </div>
                                <div id="box_cate_cate_battery" class="form-group mt-5">
                                    <label for="">Short Features</label>
                                    <textarea name="short_features" class="jsnotenew_2"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Meta - Description</label>
                                    <span>Recommended 70-155 Character</span>
                                    <div id="item-wrap">
                                        <textarea rows="4" id="input-metaDescription-en"
                                            onkeyup="countCharacter('metaDescription-en')" name="metaDescription"
                                            class="form-control"></textarea>
                                        <div class="text-count">Count Character :
                                            <span id="count-metaDescription-en">
                                                0</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="d-block">show/hide language</label>
                                    <div
                                        class="custom-control custom-radio custom-control-inline custom-control-primary">
                                        <input type="radio" class="custom-control-input" id="status-1en" name="status"
                                            value="1" checked>
                                        <label class="custom-control-label" for="status-1en">Show</label>
                                    </div>
                                    <div
                                        class="custom-control custom-radio custom-control-inline custom-control-primary">
                                        <input type="radio" class="custom-control-input" id="status-2en" name="status"
                                            value="0">
                                        <label class="custom-control-label" for="status-2en">Hide</label>
                                    </div>

                                </div>

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
                                        <th style="width: 300px;">Preview</th>
                                        <th>Upload File</th>
                                        {{-- <th>Alt</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">
                                            Thumbnail
                                        </td>
                                        <td class="font-w600">
                                            <img src="https://via.placeholder.com/200x200.png"
                                                class="img-thumbnail imagePreview2" alt="">
                                        </td>
                                        <td class="">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input"
                                                    data-toggle="custom-file-input" id="thumbnail" name="thumbnail"
                                                    value="no image" accept="image/*">
                                                <label id="label2" class="custom-file-label" for="thumbnail">Choose
                                                    file</label>
                                            </div>
                                        </td>
                                        {{-- <td class="">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="alt_img"
                                                    placeholder="Enter ...">
                                            </div>
                                        </td> --}}
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div id="accordion_input">
                            @foreach ($section as $sect)
                            <div class="card">
                                <div class="card-header card-header-collapes" data-toggle="collapse"
                                    href="#collapseheader{{$sect->sectid}}">
                                    <a class="card-link">
                                        {{$sect->name}}
                                    </a>
                                </div>
                                <div id="collapseheader{{$sect->sectid}}"
                                    class="collapse {{ ($loop->iteration == 1 ) ? 'show' : '' }}"
                                    data-parent="#accordion_input">
                                    <div class="card-body">
                                        @foreach ($pd_fields as $field)
                                        @if($sect->sectid == $field->section_id)
                                        @if($field->type == "text")
                                        <input type="hidden" class="form-control" name="productfieldText[]"
                                            value="{{$field->pd_field_id}}">
                                        <div class="data-text">
                                            <div class="form-group">
                                                <label class="d-block">{{$field->field_name}}</label>
                                                <input type="text" class="form-control"
                                                    name="inputText[{{$field->pd_field_id}}][en]">
                                            </div>
                                        </div>
                                        @else
                                        <div class="data-number">
                                            <input type="hidden" class="form-control" name="productfieldNumbers[]"
                                                value="{{$field->pd_field_id}}">
                                            <div class="form-group">
                                                <label class="d-block">{{$field->field_name}}</label>
                                                <div
                                                    class="custom-control custom-radio custom-control-inline custom-control-primary">
                                                    <input type="radio" class="custom-control-input"
                                                        onchange="selectinputtype({{$field->pd_field_id}} ,1);"
                                                        id="status_input_sig{{$field->pd_field_id}}"
                                                        name="status_input[{{$field->pd_field_id}}]" value="1" checked>
                                                    <label class="custom-control-label"
                                                        for="status_input_sig{{$field->pd_field_id}}">Single</label>
                                                </div>
                                                <div
                                                    class="custom-control custom-radio custom-control-inline custom-control-primary">
                                                    <input type="radio" class="custom-control-input"
                                                        onchange="selectinputtype({{$field->pd_field_id}} ,2);"
                                                        id="status_input_Mutl{{$field->pd_field_id}}"
                                                        name="status_input[{{$field->pd_field_id}}]" value="2">
                                                    <label class="custom-control-label"
                                                        for="status_input_Mutl{{$field->pd_field_id}}">Multiple</label>
                                                </div>
                                                <div
                                                    class="custom-control custom-radio custom-control-inline custom-control-primary">
                                                    <input type="radio" class="custom-control-input"
                                                        onchange="selectinputtype({{$field->pd_field_id}} ,3);"
                                                        id="status_input_Rang{{$field->pd_field_id}}"
                                                        name="status_input[{{$field->pd_field_id}}]" value="3">
                                                    <label class="custom-control-label"
                                                        for="status_input_Rang{{$field->pd_field_id}}">Range</label>
                                                </div>
                                            </div>

                                            <div class="mulltiple-box{{$field->pd_field_id}} d-none">
                                                <div class="product-custom-field addfield1">
                                                    <div class="form-group input-group">
                                                        <span class="input-group-addon p-l">1</span>
                                                        <input name="inputNumber[{{$field->pd_field_id}}][m][1]"
                                                            type="number" class="form-control">
                                                        <span class="input-group-addon number_type_remove p-r"
                                                            onclick="deletemutifield({{$field->pd_field_id}} , 1);">-</span>
                                                    </div>
                                                </div>
                                                <div class="product-custom-field addfield2">
                                                    <div class="form-group input-group">
                                                        <span class="input-group-addon p-l">2</span>
                                                        <input name="inputNumber[{{$field->pd_field_id}}][m][2]"
                                                            type="number" step="any" class="form-control">
                                                        <span class="input-group-addon number_type_remove p-r"
                                                            onclick="deletemutifield({{$field->pd_field_id}} , 2);">-</span>
                                                    </div>
                                                </div>
                                                <div class="product-custom-field addfield3">
                                                    <div class="form-group input-group">
                                                        <span class="input-group-addon p-l">3</span>
                                                        <input name="inputNumber[{{$field->pd_field_id}}][m][3]"
                                                            type="number" step="any" class="form-control">
                                                        <span class="input-group-addon number_type_remove p-r"
                                                            onclick="deletemutifield({{$field->pd_field_id}} , 3);">-</span>
                                                    </div>
                                                </div>
                                                <div class="btn-add-input">
                                                    <div class="form-group input-group">
                                                        <button type="button" class="btn"
                                                            onclick="addMutlple({{$field->pd_field_id}});">
                                                            Add
                                                        </button>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="range-box{{$field->pd_field_id}} d-none">
                                                <div class="product-custom-field-min">
                                                    <div class="form-group input-group">
                                                        <span class="input-group-addon p-l">Min</span>
                                                        <input name="inputNumber[{{$field->pd_field_id}}][r][1]"
                                                            type="number" step="any" class="form-control">

                                                    </div>
                                                </div>
                                                <div class="product-custom-field-min">
                                                    <div class="form-group input-group">
                                                        <span class="input-group-addon p-l">Max</span>
                                                        <input name="inputNumber[{{$field->pd_field_id}}][r][2]"
                                                            type="number" step="any" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="single-box{{$field->pd_field_id}}">
                                                <div class="product-custom-field-min">
                                                    <div class="form-group input-group ">
                                                        <input name="inputNumber[{{$field->pd_field_id}}][s][1]"
                                                            type="number" step="any" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <div class="form-group">
                            <label class="d-block">Enable/ Disable</label>
                            <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                <input type="radio" class="custom-control-input" id="status-cl1en" name="enable_pro"
                                    value="1" checked>
                                <label class="custom-control-label" for="status-cl1en">Enable</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                <input type="radio" class="custom-control-input" id="status-cl2en" name="enable_pro"
                                    value="0">
                                <label class="custom-control-label" for="status-cl2en">Disable</label>
                            </div>
                        </div>
                        <div class="form-group mt-5">
                            <label class="d-block">Is manaul page show?</label>
                            <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                <input type="radio" class="custom-control-input" id="status-manaul" name="manaul_status"
                                    value="1" checked>
                                <label class="custom-control-label" for="status-cl1en">Show</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                <input type="radio" class="custom-control-input" id="status-manaul2"
                                    name="manaul_status" value="0">
                                <label class="custom-control-label" for="status-manaul2">Hide</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Head (Custom HTML)</label>
                            <small class="text-muted d-block mb-1">輸入自訂 &lt;meta&gt;、&lt;link&gt;、&lt;script&gt; 等 HTML，將插入前台該頁面的 &lt;head&gt; 區塊。</small>
                            <textarea name="head" rows="6" class="form-control" style="font-family:monospace;"></textarea>
                        </div>
                        <div class="form-group text-center mt-5">
                            <button class="btn btn-success" type="submit">Create
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
<script type="text/javascript">
    $(document).ready(function () {
           document.getElementById("box_cate_cate_battery").style.display =  "none";
    });
</script>
<script>
    $('.jssummernote').summernote({
        tabsize: 2,
        height: 200
    });
    $('.jssummernote1').summernote({
        tabsize: 2,
        height: 300
    });
    $(".js-example-tags").select2({
     tags: true
});
     function selectinputtype(id ,type){

             $('.single-box'+id+' input[type="number"]').val('');
             $('.mulltiple-box'+id+' input[type="number"]').val('');
             $('.range-box'+id+' input[type="number"]').val('');

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
        if(numItems < 12){
            var html = '';
            html += '<div class="product-custom-field addfield'+(numItems+1)+'">';
            html += '<div class="form-group input-group">';
            html += ' <span class="input-group-addon p-l">'+(numItems+1)+'</span>';
            html += '<input name="inputNumber['+id+'][m]['+(numItems+1)+']" type="number"  step="any" class="form-control">';
            html += '<span class="input-group-addon number_type_remove p-r" onclick="deletemutifield('+id+','+(numItems+1)+');">-</span></div>';
            html += '</div>';
            $('.mulltiple-box'+id).append(html)
            $('.mulltiple-box'+id +' .btn-add-input').insertAfter('.mulltiple-box'+id+' .product-custom-field:last-child')

        }else{
           alert('Max Multiple is 12');
        }

     }
     function deletemutifield(id,numItems){
       $('.mulltiple-box'+id + ' .addfield'+numItems).remove();
       $('.mulltiple-box'+id+ ' .product-custom-field').attr('class', 'product-custom-field');
       $.each($('.mulltiple-box'+id+ ' .product-custom-field'),function(index,val){
            $(val).addClass('addfield'+(index+1))
           $(val).children('.input-group').children('.input-group-addon.p-l').text(index+1);
           $(val).children('.input-group').children('input').attr('name','inputNumber['+id+'][m]['+(index+1)+']')
           $(val).children('.input-group').children('.input-group-addon.number_type_remove.p-r').attr('onclick','deletemutifield('+id+','+(index+1)+');')
       })
     }
</script>
<script>
    var previewImage = function (input, block) {
        var fileTypes = ['jpg', 'jpeg', 'png', 'gif', 'svg','webp'];
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
     var categorie = [];
    function selectProductcategories(id ,slug) {
        console.log(slug,'slug')
        if(categorie.indexOf(id) == -1){
            categorie.push(id);
        }else{
        var index = categorie.indexOf(id);
            if (index > -1) {
                categorie.splice(index, 1);
            }
        }
        let check = false;
         if(slug == 'wireless-charging-system'){
            check = true;
         }else{
            check = false;
         }
        document.getElementById("box_cate_cate_battery").style.display = check ? "block" : "none";
        $.ajax({
            url: "{{ (route('searhSeries')) }}",
            data: {
            'data': categorie,
           },
           type: 'get',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                var options = '';

                for (var i = 0; i < data.modalContent.length; i++) {
                    options += '<option value="' + data.modalContent[i].se_id + '">' + data.modalContent[i]
                        .title + '</option>';
                }
                $("select#SeriesId").html(options);
            }

        });

    }
    function countCharacter(id){
           var str = $('#input-'+id).val();
          $('#count-'+id).text(str.length);
      }

    function addPartNumber() {
        var list = $('#part-number-list');
        var index = list.find('.part-number-row').length;
        var html = '<div class="part-number-row d-flex mb-2" data-index="' + index + '">'
            + '<input type="text" class="form-control mr-2" name="partNumber[no][' + index + ']" placeholder="No">'
            + '<input type="text" class="form-control mr-2" name="partNumber[text][' + index + ']" placeholder="Text">'
            + '<button type="button" class="btn btn-danger btn-sm" onclick="removePartNumber(this)">-</button>'
            + '</div>';
        list.append(html);
    }

    function removePartNumber(btn) {
        $(btn).closest('.part-number-row').remove();
        // Re-index
        $('#part-number-list .part-number-row').each(function(i) {
            $(this).attr('data-index', i);
            $(this).find('input[placeholder="No"]').attr('name', 'partNumber[no][' + i + ']');
            $(this).find('input[placeholder="Text"]').attr('name', 'partNumber[text][' + i + ']');
        });
    }
</script>
@endsection