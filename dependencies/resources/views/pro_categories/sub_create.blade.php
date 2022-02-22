@extends('layouts.admin')
@section('style')

@endsection
@section('content')
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Create Product Categories</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <a href="{{route('subCategories')}}">All Product Categories</a></li>
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
            <h3 class="block-title">Product Categories</h3>
        </div>
        <div class="block-content">
            <form action="{{route('storeSubCategories')}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <!-- Basic Elements -->
                @foreach ($language as $item)
                <input type="hidden" name="lang_loop[]" value="{{$item->name}}">
                @endforeach
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="example-select"><span class="req-fed">*</span>Name</label>
                            <input type="text"
                                class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                name="name" placeholder="Enter name...">
                        </div>
                        <div class="form-group">
                            <label for="example-select">Overview</label>
                            <textarea rows="4" class="form-control"
                                name="content"> </textarea>
                        </div>

                        <div class="form-group">
                            <label for="example-select">Overview (Medical Power)</label>
                            <textarea rows="4" class="form-control"
                                name="contentAddType1"> </textarea>
                        </div>

                        <div class="form-group">
                            <label for="example-select">Overview(Industrial Power)</label>
                            <textarea rows="4" class="form-control"
                                name="contentAddType2"> </textarea>
                        </div>

                        <div class="form-group">
                            <label for="example-select">Overview (LED Driver)</label>
                            <textarea rows="4" class="form-control"
                                name="contentAddType3"> </textarea>
                        </div>
                        
                        <div class="form-group">
                            <label for="example-select">Selection Guide <span class="req-fed">* Max File Size 20 MB</span></label>
                            <div class="custom-file " style="width:100%;">
                                <input type="file" class="custom-file-input" name="fileGU"
                                    data-toggle="custom-file-input">
                                <label class="custom-file-label" for="fileImage">Choose file</label>
                            </div>
                        </div>
                    </div>
                
                    <div class="col-lg-12">
                            <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-vcenter">
                                        <thead>
                                            <tr>
                                                <th class="text-center" style="width: 10px;">
                                                    File Type
                                                </th>
                                                <th style="width: 300px;">Preview</th>
                                                <th style="width: 300px;">Upload File <span class="req-fed">* File Max Size 2 MB</span></th>
                                            </tr>
                                        </thead>
                                        <tbody id='addImage'>
                                            <tr>
                                                <td class="text-center">
                                                        thumbnail (Default)
                                                </td>
                                                <td class="">
                                                        <img src="https://via.placeholder.com/375x184.png" class="img-thumbnail imagePreview2"
                                                        alt="">
                                                </td>
                                                <td class="">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input"
                                                            data-toggle="custom-file-input" id="thumbnail" name="thumbnail"
                                                            value=" " accept="image/*">
                                                        <label id="label1" class="custom-file-label" for="thumbnail">Choose file</label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <input type="hidden" name="typeImage[type1]"   value="type1">
                                            <input type="hidden" name="typeImage[type2]"  value="type2" >
                                            <input type="hidden" name="typeImage[type3]"  value="type3" >

                                            <tr>
                                                <td class="text-center">
                                                        thumbnail (Medical Power)
                                                </td>
                                                <td class="">
                                                        <img src="https://via.placeholder.com/375x184.png" class="img-thumbnail imagePreviewType1"
                                                        alt="">
                                                </td>
                                                <td class="">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input"
                                                            data-toggle="custom-file-input" id="thumbnail1" name="thumbnailOpt[type1]"
                                                            value=" " accept="image/*">
                                                        <label id="labelType1 class="custom-file-label" for="thumbnail3">Choose file</label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">
                                                        thumbnail (Industrial Power)
                                                </td>
                                                <td class="">
                                                        <img src="https://via.placeholder.com/375x184.png" class="img-thumbnail imagePreviewType2"
                                                        alt="">
                                                </td>
                                                <td class="">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input"
                                                            data-toggle="custom-file-input" id="thumbnail2" name="thumbnailOpt[type2]"
                                                            value=" " accept="image/*">
                                                        <label id="labelType2" class="custom-file-label" for="thumbnail2">Choose file</label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">
                                                        thumbnail (LED Driver)
                                                </td>
                                                <td class="">
                                                        <img src="https://via.placeholder.com/375x184.png" class="img-thumbnail imagePreviewType3"
                                                        alt="">
                                                </td>
                                            
                                                <td class="">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input"
                                                            data-toggle="custom-file-input" id="thumbnail1" name="thumbnailOpt[type3]"
                                                            value=" " accept="image/*">
                                                        <label id="labelType3" class="custom-file-label" for="thumbnail1">Choose file</label>
                                                    </div>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                    </div>
                    <div class="col-lg-8">
                            <label for="example-select"><span class="req-fed">*</span> Main Categories</label>
                            <select onchange="selectdata()" id="maincateId" class="js-select2 form-control" name="main_categories[]" data-placeholder="Choose many.." required multiple>
                                    <option></option>
                                @foreach ($mainCategories as $main)
                                <option value="{{$main->main_id}}">{{$main->name}}</option>
                                @endforeach
                                   
                            </select>

                            <div class="form-group mt-2">
                                <label for="example-select">Unit dimension</label>
                                <div style="color:red;">*Only H or D</div>
                                <input type="text"
                                    class="form-control "
                                    name="unit_dimension" value="D" maxlength="2" placeholder="Enter text...">
                            </div>
                            <div class="form-group">
                            <label for="example-select"> Warranty Policy<span class="req-fed">* Max File
                                    Size 20 MB</span></label>
                            <div class="custom-file " style="width:100%;">
                                <input type="file" class="custom-file-input file_input"
                                    name="warranty_file" data-toggle="custom-file-input">
                                <label class="custom-file-label" for="warranty_file">Choose file</label>
                            </div>
                            </div>
                             
                    </div>
                    {{-- <div class="col-lg-8 pt-2">
                           
                            <div class="form-group">
                                    <label for="example-select">Filter_Content</label>
                                    <select class="js-select2 form-control" id="example-select2-multiple" name="productfield[]" style="width: 100%;" data-placeholder="Choose many.." multiple>
                                        <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                        @foreach ($pd_fields as $item)
                                        <option value="{{$item->pd_field_id}}">{{$item->field_name}}</option>
                                        @endforeach
                                        <option value="0">Status</option>
                                    </select>
                                </div>
                          </div> --}}

                          
                       
                    <div class="col-lg-12 mt-5">
                        <div class="text-center form-group">
                            <button class="btn btn-success" type="submit">Create </button>
                            <a href="{{route('subCategories')}}" class="btn btn-secondary">
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
        } else {
            alert('file is not accept!');
        }

    };

    $(document).on('change', '#thumbnail', function () {

    var FileSize = this.files[0].size / 1024 / 1024; // in MB
    if (FileSize > 2) {
        alert("File size exceeds 2 MB!");
        this.value = "";
        $('#label2').text('Choose file');
    }else{
        previewImage(this, $('.imagePreview2'));
    }
    });

      $(document).on('change', '#thumbnail1', function () {

        var FileSize = this.files[0].size / 1024 / 1024; // in MB
        if (FileSize > 2) {
            alert("File size exceeds 2 MB!");
            this.value = "";
            $('#labelType1').text('Choose file');
        }else{
            previewImage(this, $('.imagePreviewType1'));
        }
        });

        $(document).on('change', '#thumbnail2', function () {

        var FileSize = this.files[0].size / 1024 / 1024; // in MB
        if (FileSize > 2) {
            alert("File size exceeds 2 MB!");
            this.value = "";
            $('#labelType2').text('Choose file');
        }else{
            previewImage(this, $('.imagePreviewType2'));
        }
        });
        $(document).on('change', '#thumbnail3', function () {

        var FileSize = this.files[0].size / 1024 / 1024; // in MB
        if (FileSize > 2) {
            alert("File size exceeds 2 MB!");
            this.value = "";
            $('#labelType3').text('Choose file');
        }else{
            previewImage(this, $('.imagePreviewType3'));
        }
        });
    
    $(document).on('change', '#file_input', function () {
        // alert(this.files[0].size);
        var FileSize = this.files[0].size / 1024 / 1024; // in MB
        if (FileSize > 20) {
            alert("File size exceeds 20 MB!");
            this.value = "";
        };
    });
    function selectdata(){
    var maincateId = $('#maincateId').val();
        // console.log(maincateId);
        console.log(maincateId)
    //    var html = '';
    //        html += '<tr>';
    //        html += '<td class="text-center">';
    //        html += 'thumbnail type-3';
    //        html += '</td>';
    //        html += '<td class="">';
    //        html += '<img src="https://via.placeholder.com/375x184.png" class="img-thumbnail imagePreview2" alt="">';
    //        html += '</td>';
    //        html += '<td class="">';
    //        html += '<div class="custom-file">';
    //        html += '<input type="file" class="custom-file-input"  data-toggle="custom-file-input" id="thumbnail" name="thumbnail" value=" " accept="image/*">';
    //        html += '<label id="label1" class="custom-file-label" for="thumbnail">Choose file</label>';
    //        html += '</div>';
    //        html += '</td>';
    //        html += '</tr>';
    //     $('#addImage').append(html);
    }

</script>
@endsection
