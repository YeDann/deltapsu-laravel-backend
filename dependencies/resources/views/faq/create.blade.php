@extends('layouts.admin')
@section('style')

@endsection
@section('content')
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Create FAQ</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <a href="{{route('Faq.index')}}">All FAQ</a></li>
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
            <h3 class="block-title">information</h3>
        </div>
        <div class="block-content">
            <form action="{{route('Faq.store')}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                @foreach ($language as $item)
                <input type="hidden" name="lang_loop[]" value="{{$item->name}}">
                @endforeach
                <!-- Basic Elements -->
                <div class="row ">
                    <div class="col-lg-12">
                        <div class="">
                            <div class="form-group">
                                <label for="example-select">Title <span class="req-fed">*</span></label>
                                <input type="text"
                                    class="form-control"
                                    name="name" placeholder="Enter title..." required>
                            </div>
                            <div class="form-group">
                                <label for="">Content</label>
                                <textarea name="content"class="js-summernote"></textarea>
                            </div>
                            <div class="form-group">
                            <label for="example-select">Select Categories <span class="req-fed">*</span></label>
                            <select class="js-select2 form-control" name="faq_categories" data-placeholder="Choose one.." required>
                                    <option></option>
                                @foreach ($faq_categories as $item)
                                <option value="{{$item->cate_id}}">{{$item->name}}</option>
                                @endforeach
                                   
                            </select>
                            </div>
                            <div class="form-group">
                                <label class="d-block">Status</label>
                                <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                        <input type="radio" class="custom-control-input" id="status-1" name="status" value="1" checked >
                                        <label class="custom-control-label" for="status-1">Show</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                        <input type="radio" class="custom-control-input" id="status-2" name="status" value="0" >
                                        <label class="custom-control-label" for="status-2">Hide</label>
                                    </div>
                               
                            </div>
                            </div>
                            <div class="text-center form-group">
                                <button class="btn btn-success" type="submit">Create </button>
                                <a href="{{route('Faq.index')}}" class="btn btn-secondary">
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

@endsection
