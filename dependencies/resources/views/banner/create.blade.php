@extends('layouts.admin')
@section('style')

@endsection
@section('content')
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Create Banner</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <a href="{{route('bannerSlide.index')}}">Banner Slide</a></li>
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
            <h3 class="block-title">Information</h3>
        </div>
        <div class="block-content">
            <form action="{{route('bannerSlide.store')}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                @foreach ($language as $item)
                <input type="hidden" name="lang_loop[]" value="{{$item->name}}">
                @endforeach
                <!-- Basic Elements -->
                <div class="row push">
                    <div class="col-lg-12">
                        <p>*Use "Enter" to Begin a new row</p>
                        <div class="form-group">
                            <label for="example-select">Mobile Title </label>
                            <textarea  name="title_1" rows="3" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                        
                            <label for="example-select">Desktop Title</label>
                            <textarea  name="title_2" rows="3" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="example-select">Content </label>
                            <textarea name="content"  class="jsnotenew"></textarea>
                        </div>
                        <div class="form-group">
                                <label for="example-select">Link to</label>
                                <span style="color:red;"> Link ex. https://www.delta.com"</span>
                                <input type="text" class="form-control" name="btn_link" placeholder="Enter Link ex. https://www.delta.com">
                            </div>
                        <div class="form-group">
                            <label for="example-select">Button Name </label>
                            <input type="text" class="form-control" name="btn_name" placeholder="Enter Text">
                        </div>
                        <div class="form-group">
                                <label class="d-block">Button Show</label>
                                <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                        <input type="radio" class="custom-control-input" id="status-1" name="btn_status" value="1" checked>
                                        <label class="custom-control-label" for="status-1">Show</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                        <input type="radio" class="custom-control-input" id="status-2" name="btn_status" value="0" >
                                        <label class="custom-control-label" for="status-2">Hide</label>
                                    </div>
                               
                            </div>

                       
                        <div class="form-group">
                            <label for="example-colorpicker2">Title Color</label>
                            <div class="js-colorpicker input-group" data-format="hex">
                                <input type="text" class="form-control" id="example-colorpicker2" name="title_color"
                                    value="#0087DC">
                                <div class="input-group-append">
                                    <span class="input-group-text colorpicker-input-addon">
                                        <i></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="example-colorpicker2">Content Color</label>
                            <div class="js-colorpicker input-group" data-format="hex">
                                <input type="text" class="form-control" id="example-colorpicker2" name="content_color"
                                    value="#000000">
                                <div class="input-group-append">
                                    <span class="input-group-text colorpicker-input-addon">
                                        <i></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="filename[mobile_image]" value="mobile_image" >
                        <input type="hidden" name="filename[destop_image]" value="destop_image">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-vcenter">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 20px;">
                                            File Type
                                        </th>
                                        <th style="width:50%;">Preview</th>
                                        <th>Upload File</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">
                                            Mobile Image
                                        </td>
                                        <td class="font-w600">
                                            <img src="https://via.placeholder.com/750x700.png"
                                                class="img-thumbnail imagePreview1 res-image" alt="">
                                        </td>
                                        <td class="">
                                            <span style="color:red">* Maximum 2mb </span>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input"
                                                    data-toggle="custom-file-input" id="mobile_image" name="fileimage[mobile_image]"
                                                    value=" " accept="image/*">
                                                <label id="label1" class="custom-file-label" for="mobile_image">Choose
                                                    file</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">
                                             Desktop Image
                                        </td>
                                        <td class="font-w600">
                                            <img src="https://via.placeholder.com/3840x800.png"
                                                class="img-thumbnail imagePreview2 res-image" alt="">
                                        </td>
                                        <td class="">
                                            <span style="color:red">* Maximum 2mb </span>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input"
                                                    data-toggle="custom-file-input" id="destop_image" name="fileimage[destop_image]"
                                                    value=" " accept="image/*">
                                                <label id="label2" class="custom-file-label" for="destop_image">Choose
                                                    file</label>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="text-center form-group">
                            <button class="btn btn-success" type="submit">Create </button>
                            <a href="{{route('bannerSlide.index')}}" class="btn btn-secondary">
                                Cancel
                            </a>
                        </div>
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
            return false;
        } else {
            alert('File is not expept!');
         
            return true;
        }

    };
        $(document).on('change', '#mobile_image', function () {
        // alert(this.files[0].size);
        var FileSize = this.files[0].size / 1024 / 1024; // in MB
        if (FileSize > 2) {
            alert("File size exceeds 2 MB!");
            this.value = "";
            $('#label1').text('Choose file');
        }else{
            previewImage(this, $('.imagePreview1'));
        }
    });
    $(document).on('change', '#destop_image', function () {
        // alert(this.files[0].size);
        var FileSize = this.files[0].size / 1024 / 1024; // in MB
        if (FileSize > 2) {
            alert("File size exceeds 2 MB!");
            this.value = "";
            $('#label2').text('Choose file');
        }else{
            previewImage(this, $('.imagePreview2'));
        }
    });
</script>
@endsection
