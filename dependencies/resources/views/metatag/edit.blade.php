@extends('layouts.admin')
@section('style')
<link rel="stylesheet" href="{{asset('backend-asset/js/plugins/summernote/summernote-bs4.css')}}">
<link rel="stylesheet" href="{{asset('backend-asset/js/plugins/simplemde/simplemde.min.css')}}">
<link rel="stylesheet"
    href="{{asset('backend-asset/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}">

<style>
    #test-label {
        height: 100px !important;
    }

    .btn-outline-secondary {
        border-color: #dcdcdc!important;
    }

</style>
@endsection
@section('content')
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Meta tags</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('metaTags')}}">Meta tags</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- Content -->
<div class="content mb-5">
    <div class="block block-rounded block-bordered">
        <div class="block-header block-header-default">
            <h3 class="block-title">Edit Meta tags</h3>
        </div>
        <div class="block-content mb-5">
            <form action="{{route('update_metaTag')}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
     
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-xl-8">
                    <input type="hidden" name="oldId" value="{{$oldid}}">
                        <div class="form-group">
                            <label for="example-select">Page Name<span class="req-fed">*</span></label>
                            <input type="text" class="form-control"
                        name="page" placeholder="Enter Text." value="{{$metatags[0]->page}}" disabled >
                        </div>
               
               
                        <div class="form-group">
                            <label for="">Meta - Title</label>
                            <input type="text" class="form-control" name="metaTitle" value="{{$metatags[0]->meta_title}}">
                        </div>
                        <div class="form-group">
                            <label for="">Meta - Description</label>
                            <textarea name="metaDescription" class="form-control">{{$metatags[0]->meta_description}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Meta - Keywords</label>
                            <textarea name="metaKeyword" class="form-control">{{$metatags[0]->meta_key}}</textarea>
                        </div>
                        
                        <div class="form-group text-center">
                            <button class="btn btn-primary" type="submit">Update 
                            </button>
                            <a href="{{route('metaTags')}}" class="btn btn-secondary">
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

@endsection
