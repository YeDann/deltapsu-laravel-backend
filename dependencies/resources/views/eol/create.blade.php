@extends('layouts.admin')
@section('style')

@endsection

@section('content')
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">EOL</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('eol.index')}}">EOL</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<!-- Content -->
<div class="content">

    @if(Session::has('flash_message'))
    <div class="alert alert-success" role="alert">
        <button class="close" data-dismiss="alert"></button>
        {!! Session('flash_message') !!}
    </div>
    @endif
    @if(Session::has('error_message'))
    <div class="alert alert-danger" role="alert">
        <button class="close" data-dismiss="alert"></button>
        {!! Session('error_message') !!}
    </div>
    @endif
    <div class="block block-rounded block-bordered">
        <div class="block-header block-header-default">
            Create EOL 
            <div class="block-options">
            </div>
        </div>
        <form action="{{route('eol.store')}}" method="post" enctype="multipart/form-data">
        <div class="block-content block-content-full">
                {{csrf_field()}}
                
                 {{-- Main --}}
                 <div class="row">
                    <div class="col-md-9 mb-4">
                        <div class="form-group">
                            <label>Status</label>
                            <div class="custom-control custom-switch custom-control-success mb-1">
                                <input type="checkbox" class="custom-control-input" id="status" name="status" value="1" >
                                <label class="custom-control-label" for="status">Show / Hide</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Publish</label>
                            <input type="text" class="js-flatpickr form-control bg-white" id="date_publish" name="date_publish" placeholder="Please select a date" data-enable-time="true" data-time_24hr="true" value="{{date('Y-m-d H:i')}}">
                        </div>

                      
                        <div class="block block-bordered block-rounded">
                            <ul class="nav nav-tabs nav-tabs-block" data-toggle="tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#btabs-en">English</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#btabs-cn">Simple Chinese</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#btabs-tw">Traditional Chinese</a>
                                </li>
                            </ul>
                            <div class="block-content tab-content overflow-hidden">
                                {{-- EN --}}
                                <div class="tab-pane fade fade-left show active" id="btabs-en" role="tabpanel">
                                    <div class="form-group">
                                        <label>Title </label>
                                        <input type="text" class="form-control" name="title_en" placeholder="Please fill in" >
                                    </div>
                                    <div class="form-group">
                                        <label>Keywords</label>
                                        <input type="text" class="form-control" name="keywords_en" placeholder="Please fill in" >
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <input type="text" class="form-control" name="description_en" placeholder="Please fill in" >
                                    </div>
                                    <div class="form-group">
                                        <label>Content</label>
                                        <textarea class="js-summernote" name="content_en"></textarea>
                                    </div>
                                </div>
                                {{-- CN --}}
                                <div class="tab-pane fade fade-left" id="btabs-cn" role="tabpanel">
                                    <div class="form-group">
                                        <label>Title </label>
                                        <input type="text" class="form-control" name="title_cn" placeholder="Please fill in" >
                                    </div>
                                    <div class="form-group">
                                        <label>Keywords</label>
                                        <input type="text" class="form-control" name="keywords_cn" placeholder="Please fill in" >
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <input type="text" class="form-control" name="description_cn" placeholder="Please fill in" >
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea class="js-summernote" name="content_cn"></textarea>
                                    </div>
                                </div>
                                {{-- TW --}}
                                <div class="tab-pane fade fade-left" id="btabs-tw" role="tabpanel">
                                    <div class="form-group">
                                        <label>Title </label>
                                        <input type="text" class="form-control" name="title_tw" placeholder="Please fill in" >
                                    </div>
                                    <div class="form-group">
                                        <label>Keywords</label>
                                        <input type="text" class="form-control" name="keywords_tw" placeholder="Please fill in" >
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <input type="text" class="form-control" name="description_tw" placeholder="Please fill in" >
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea class="js-summernote" name="content_tw"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Cover Image</label>
                           <br>
                            <img id="img1" src="{{asset('backend-asset/image/default_img.png')}}" style="width: 100%;height: auto;background: #ccc;margin-bottom: 20px;">
                            <br>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input js-custom-file-input-enabled" id="image" name="image" data-toggle="custom-file-input" accept="image/*" onchange="readURL1(this);">
                                <label class="custom-file-label" for="image">Choose file</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>File Upload </label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input js-custom-file-input-enabled" id="file" name="file" data-toggle="custom-file-input" >
                                <label class="custom-file-label" for="file">Choose file</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Categories </label>
                            <select class="js-select2 form-control" id="type" name="type[]" style="width: 100%;" data-placeholder="Choose one.." multiple>
                                <option></option>
                                @foreach ($eolType as $item)
                                    <option value="{{$item->id}}">{{$item->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                {{-- <div class="row">
                    <div class="col-md-12 text-center">
                    </div>
                </div> --}}
                
        </div>
        <div class="block-content block-content-full text-right border-top">
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="{{route('eol.index')}}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
    </div>
</div>
@endsection
@section('js')
<script>
    function readURL1(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#img1').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
