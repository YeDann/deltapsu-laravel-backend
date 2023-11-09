@extends('layouts.admin')
@section('style')

@endsection
@section('content')
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Create Connector Image</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <a href="{{route('configurableProduct')}}">Configurable Power</a>
                    </li>
                    <li class="breadcrumb-item"> <a href="{{route('connector_image',$productId)}}">Connector
                            Image(s)</a></li>
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
            <h3 class="block-title">Connector Image</h3>
        </div>
        <div class="block-content">
            <form action="{{route('updateConnectorImage')}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <!-- Basic Elements -->
                <div class="row">
                    <div class="col-lg-12">



                        <div class="form-group">
                            <label for="example-select"><span class="req-fed">*</span>Connector Code</label>
                            <input type="text"
                                class="form-control {{ $errors->has('connect_code') ? 'is-invalid' : '' }}"
                                name="connect_code" value="{{$item->code}}" placeholder="Enter Connector Code..."
                                required>
                        </div>
                        <input type="hidden" name="old_id" value="{{$item->id}}">
                        <div class="form-group">
                            <label for="example-select"><span class="req-fed">*</span>Value</label>
                            <label for="example-select">Ex. T = 1 ,E = 2 , C = 3 </label>
                            <input type="text" class="form-control {{ $errors->has('value') ? 'is-invalid' : '' }}"
                                name="value" value="{{$item->value}}" placeholder="Enter Value..." required>
                        </div>
                        <input type="hidden" name="product_id" value="{{$productId}}">
                        <div class="form-group">
                            <img src="{{config('app.url')}}/upload/thumbs/{{$item->image}}"
                                class="img-thumbnail imagePreview2" alt="">
                            <input type="hidden" name="oldfile" value="{{$item->image}}">
                        </div>

                        <div class="form-group">
                            <img src="https://via.placeholder.com/200x200.png" class="img-thumbnail imagePreview2"
                                alt="">
                        </div>

                        <div class="form-group">
                            <label for="example-select"><span class="req-fed">*</span>Image</label>

                            <label for="example-select">Image <span class="req-fed">* Max File Size 2 MB</span></label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" data-toggle="custom-file-input"
                                    id="thumbnail" name="thumbnail" value="no image" accept="image/*">
                                <label id="label2" class="custom-file-label" for="thumbnail">Choose
                                    file</label>
                            </div>
                        </div>


                    </div>

                    <div class="col-lg-12 mt-5">
                        <div class="text-center form-group">
                            <button class="btn btn-info" type="submit">Update </button>
                            <a href="{{route('connector_image',$productId)}}" class="btn btn-secondary">
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
            alert('File is not except!');
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

</script>
@endsection