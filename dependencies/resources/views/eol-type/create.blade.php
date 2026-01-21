@extends('layouts.admin')
@section('style')

@endsection

@section('content')
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">EOL Type</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('eol.index')}}">EOL</a></li>
                    <li class="breadcrumb-item"><a href="{{route('eol-type.index')}}">EOL Type</a></li>
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
            Create EOL Type
            <div class="block-options">
            </div>
        </div>
        <form action="{{route('eol-type.store')}}" method="post" enctype="multipart/form-data">
        <div class="block-content block-content-full">
                {{csrf_field()}}
                
                 {{-- Main --}}
                 <div class="row">
                    <div class="col-md-12 mb-4">
                        
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
                                     <input type="hidden" name="langloop[]" value="en">
                                    <div class="form-group">
                                        <label>Title </label>
                                        <input type="text" class="form-control" name="name[en]" placeholder="Please fill in" >
                                    </div>
                                    {{-- <div class="form-group">
                                        <label>Description</label>
                                        <input type="text" class="form-control" name="description[en]" placeholder="Please fill in" >
                                    </div> --}}
                                </div>
                                {{-- CN --}}
                                <div class="tab-pane fade fade-left" id="btabs-cn" role="tabpanel">
                                    <input type="hidden" name="langloop[]" value="zh-CN">
                                    <div class="form-group">
                                        <label>Title </label>
                                        <input type="text" class="form-control" name="name[zh-CN]" placeholder="Please fill in" >
                                    </div>
                                    {{-- <div class="form-group">
                                        <label>Description</label>
                                        <input type="text" class="form-control" name="description[zh-CN]" placeholder="Please fill in" >
                                    </div> --}}
                                </div>
                                {{-- TW --}}
                                <div class="tab-pane fade fade-left" id="btabs-tw" role="tabpanel">
                                    <input type="hidden" name="langloop[]" value="zh-TW">
                                    <div class="form-group">
                                        <label>Title </label>
                                        <input type="text" class="form-control" name="name[zh-TW]" placeholder="Please fill in" >
                                    </div>
                                    {{-- <div class="form-group">
                                        <label>Description</label>
                                        <input type="text" class="form-control" name="description[zh-TW]" placeholder="Please fill in" >
                                    </div> --}}
                                </div>
                            </div>
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
            <a href="{{route('eol-type.index')}}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
    </div>
</div>
@endsection
@section('js')

@endsection
