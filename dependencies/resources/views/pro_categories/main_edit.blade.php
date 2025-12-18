@extends('layouts.admin')
@section('style')

@endsection
@section('content')
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Edit Main Categories</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <a href="{{route('mainprotype.index')}}">All Main Categories</a></li>
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
            <h3 class="block-title">Main Categories</h3>
        </div>
        <div class="block-content">
            <form action="{{route('updatemainpro')}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <!-- Basic Elements -->
                <div class="row push">
                    <div class="col-lg-12">
                        <div class="block block-rounded block-bordered">
                            <ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs" role="tablist">
                                @foreach ($mainCategories as $item)
                                @if($loop->iteration == 1)
                                <li class="nav-item">
                                    <a class="nav-link active" href="#btabs-alt-static-{{$item->local}}"
                                        style="text-transform: capitalize;">{{$item->local}}</a>
                                </li>
                                @else
                                <li class="nav-item">
                                    <a class="nav-link " href="#btabs-alt-static-{{$item->local}}"
                                        style="text-transform: capitalize;">{{$item->local}}</a>
                                </li>
                                @endif
                                @endforeach
                            </ul>
                            <div class="block-content tab-content">
                               <input type="hidden" name="mainId" value="{{$mainId}}" > 
                                @foreach ($mainCategories as $item)
                                <input type="hidden" name="lang_loop[]" value="{{$item->local}}">
                                @if($loop->iteration == 1)
                                <div class="tab-pane active" id="btabs-alt-static-{{$item->local}}" role="tabpanel">
                                    <div class="form-group">
                                        <label for="example-select">Name</label>
                                        <input type="text"
                                            class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                            name="name[{{$item->local}}]" value="{{$item->name}}" placeholder="Enter name...">
                                    </div>
                                </div>
                                @else
                                <div class="tab-pane" id="btabs-alt-static-{{$item->local}}" role="tabpanel">
                                    <div class="form-group">
                                        <label for="example-select">Name</label>
                                        <input type="text"
                                            class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                            name="name[{{$item->local}}]" value="{{$item->name}}" placeholder="Enter name...">
                                    </div>
                                </div>
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12" style="margin-bottom: 20px">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-vcenter">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 10px;">
                                            File Type
                                        </th>
                                        <th class="text-center" style="width: 400px;">
                                            Old Image
                                        </th>

                                        <th style="width: 300px;">Preview</th>
                                        <th style="width: 300px;">Update File <span class="req-fed">* File Max Size 2
                                                MB</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">
                                            Banner
                                        </td>
                                        <td class="">
                                            <img src="{{ config('app.url') }}/medias/categories/{{ $mainCategory->banner }}"
                                                class="img-thumbnail res-image" alt="">
                                            <input type="hidden" name="oldfile" value="{{ $mainCategory->banner}}">
                                        </td>
                                        <td class="">
                                            <img src="https://via.placeholder.com/375x184.png"
                                                class="img-thumbnail bannerPreview res-image" alt="">
                                        </td>

                                        <td class="">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input"
                                                    data-toggle="custom-file-input" id="banner" name="banner"
                                                    value=" " accept="image/*">
                                                <label id="label1" class="custom-file-label" for="banner">Choose
                                                    file</label>
                                            </div>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="text-center form-group">
                            <button class="btn btn-info" type="submit">Update </button>
                            <a href="{{route('mainprotype.index')}}" class="btn btn-secondary">
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
    var fileTypes = ['jpg', 'jpeg', 'png', 'gif', 'svg', 'webp'];
    var extension = input.files[0].name.split('.').pop().toLowerCase();
    var isSuccess = fileTypes.indexOf(extension) > -1;
    if (isSuccess) {
        var reader = new FileReader();
        reader.onload = function (e) {
            block.attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    } else {
        alert('File type is not accepted! Please use: jpg, jpeg, png, gif, svg, webp');
    }
};

$(document).on('change', '#banner', function () {
    if (this.files[0]) {
        var FileSize = this.files[0].size / 1024 / 1024; // in MB
        if (FileSize > 2) {
            alert("File size exceeds 2 MB!");
            this.value = "";
            $(this).siblings('label').text('Choose file');
        } else {
            previewImage(this, $('.bannerPreview'));
        }
    }
});
</script>
@endsection
