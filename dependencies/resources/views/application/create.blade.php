@extends('layouts.admin')
@section('style')
<style>
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
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Application View</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <a href="{{route('application-view.index')}}">Application View</a>
                    </li>
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
            <h3 class="block-title">Create Application View</h3>
        </div>
        <div class="block-content">
            <form action="{{route('application-view.store')}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <!-- Basic Elements -->
                <div class="row">
                    <div class="col-md-12">

                        <div class="">

                            <div class="form-group">
                                <label for="example-select">Name</label>
                                <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                    name="name" placeholder="Enter name..." required>
                            </div>

                            <div class="form-group">
                                <label for="">Overview</label>
                                <textarea name="overview_text" rows="2" class=" form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Application Example</label>
                                <textarea name="content" class="jsnotenew"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="">Content</label>
                                <textarea name="content_2" class="jsnotenew"></textarea>
                            </div>
                            <p style="color:#0087DC">Can use "Enter" to Begin new bullet or new row</p>
                            <div class="form-group">
                                <label for="">Typical Application</label>
                                <textarea name="overview" rows="4" class=" form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">H1</label>
                                <span>Recommended 20-70 characters</span>
                                <div id="item-wrap">
                                    <input id="input-h1-en" onkeyup="countCharacter('h1-en')" type="text"
                                        class="form-control" name="h1_title" maxlength="70" value="">
                                    <div class="text-count">Count Character :
                                        <span id="count-h1-en">
                                            0</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Meta - Description</label>
                                <span>Recommended 70-155 Character</span>
                                <div id="item-wrap">
                                    <textarea rows="4" id="input-metaDescription-en"
                                        onkeyup="countCharacter('metaDescription-en')" maxlength="155"
                                        name="metaDescription" class="form-control"></textarea>
                                    <div class="text-count">Count Character :
                                        <span id="count-metaDescription-en">
                                            0</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="d-block">Show Application</label>


                            <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                <input type="radio" class="custom-control-input" id="status-1" name="status" value="1"
                                    checked>
                                <label class="custom-control-label" for="status-1">Show</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                <input type="radio" class="custom-control-input" id="status-2" name="status" value="0">
                                <label class="custom-control-label" for="status-2">Hide</label>
                            </div>

                        </div>


                    </div>
                    @foreach ($language as $item)
                    <input type="hidden" name="lang_loop[]" value="{{$item->name}}">
                    @endforeach
                    <div class="col-md-12">
                        <input type="hidden" name="filename[icon]" value="icon">
                        <input type="hidden" name="filename[color_icon]" value="color_icon">
                        <input type="hidden" name="filename[thumbnail]" value="thumbnail">
                        <input type="hidden" name="filename[banner]" value="banner">
                        <input type="hidden" name="filename[blue_outline_icon]" value="blue_outline_icon">

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-vcenter">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 10px;">
                                            File Type
                                        </th>

                                        <th style="width: 300px;">Preview</th>
                                        <th>Upload File</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr>
                                        <td class="text-center">
                                            Color icon
                                        </td>

                                        <td class="font-w600">
                                            <img src="https://via.placeholder.com/72x72.png"
                                                class="img-thumbnail imagePreview2 res-image" alt="">
                                        </td>

                                        <td class="">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input"
                                                    data-toggle="custom-file-input" id="color_icon"
                                                    name="fileimage[color_icon]" value=" " accept="image/*">
                                                <label id="label2" class="custom-file-label" for="color_icon">Choose
                                                    file</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <td class="text-center">
                                            Color Border icon
                                        </td>

                                        <td class="font-w600">
                                            <img src="https://via.placeholder.com/72x72.png"
                                                class="img-thumbnail imagePreview3 res-image" alt="">
                                        </td>

                                        <td class="">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input"
                                                    data-toggle="custom-file-input" id="blue_outline_icon"
                                                    name="fileimage[blue_outline_icon]" value=" " accept="image/*">
                                                <label id="label3" class="custom-file-label"
                                                    for="blue_outline_icon">Choose file</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">
                                            Gray Border icon
                                        </td>

                                        <td class="font-w600">
                                            <img src="https://via.placeholder.com/72x72.png"
                                                class="img-thumbnail imagePreview1 res-image" alt="">
                                        </td>

                                        <td class="">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input"
                                                    data-toggle="custom-file-input" id="icon" name="fileimage[icon]"
                                                    value=" " accept="image/*">
                                                <label id="label1" class="custom-file-label" for="icon">Choose
                                                    file</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">
                                            Thumbnail
                                        </td>

                                        <td class="font-w600">
                                            <img src="https://via.placeholder.com/500x500.png"
                                                class="img-thumbnail imagePreview4" alt="">
                                        </td>

                                        <td class="">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input"
                                                    data-toggle="custom-file-input" id="thumbnail"
                                                    name="fileimage[thumbnail]" value="no image" accept="image/*">
                                                <label id="label4" class="custom-file-label" for="thumbnail">Choose
                                                    file</label>
                                            </div>
                                        </td>
                                    <tr>
                                        <td class="text-center">
                                            Banner
                                        </td>

                                        <td class="font-w600">
                                            <img src="https://via.placeholder.com/3840x800.png"
                                                class="img-thumbnail imagePreview5" alt="">
                                        </td>

                                        <td class="">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input"
                                                    data-toggle="custom-file-input" id="banner" name="fileimage[banner]"
                                                    value=" " accept="image/*">
                                                <label id="label5" class="custom-file-label" for="banner">Choose
                                                    file</label>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="form-group text-center">
                            <button class="btn btn-success" type="submit">Create
                            </button>
                            <a href="{{route('application-view.index')}}" class="btn btn-secondary">
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




    $(document).on('change', '#icon', function () {
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
    $(document).on('change', '#color_icon', function () {
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
    $(document).on('change', '#blue_outline_icon', function () {
        // alert(this.files[0].size);
        var FileSize = this.files[0].size / 1024 / 1024; // in MB
        if (FileSize > 2) {
            alert("File size exceeds 2 MB!");
            this.value = "";
            $('#label3').text('Choose file');
        }else{
            previewImage(this, $('.imagePreview3'));
        }
    });


        $(document).on('change', '#thumbnail', function () {

        var FileSize = this.files[0].size / 1024 / 1024; // in MB
        if (FileSize > 2) {
            alert("File size exceeds 2 MB!");
            this.value = "";
            $('#label4').text('Choose file');
        }else{
            previewImage(this, $('.imagePreview4'));
        }

        });
        $(document).on('change', '#banner', function () {
        var FileSize = this.files[0].size / 1024 / 1024; // in MB
        if (FileSize > 2) {
            alert("File size exceeds 2 MB!");
            this.value = "";
            $('#label5').text('Choose file');
        }else{
            previewImage(this, $('.imagePreview5'));
        }

        });
        function countCharacter(id){
           var str = $('#input-'+id).val();
          $('#count-'+id).text(str.length);
      }
    
</script>
@endsection