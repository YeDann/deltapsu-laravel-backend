@extends('layouts.admin')
@section('style')

@endsection
@section('content')
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">AboutUs</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <a href="{{route('AboutUs.index')}}">All AboutUs</a></li>
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
            <form action="{{route('AboutUs.store')}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <!-- Basic Elements -->
                @foreach ($language as $item)
                <input type="hidden" name="langloop[]" value="{{$item->name}}" >
                @endforeach
                
                <div class="row">
                        {{-- <div class="col-lg-12">
                                <div class="form-group">
                                        <label for="example-select">Content Type</label>
                                        <select class="js-select2 form-control" id="example-select2-multiple" name="type_content" style="width: 100%;" data-placeholder="Choose one.." >
                                            <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                            <option value="1" >DeltaPSU (Power Supply Unit)</option>
                                            <option value="2" >Delta Group</option>
                                            <option value="3" >Delta R&D</option>
                                            <option value="4" >Global Operations</option>
                                        </select>
                                    </div>
                              </div> --}}
                    <div class="col-lg-12">
                            <div class="form-group">
                                    <label for="example-select"><span class="req-fed">*</span>Title</label>
                                    <input type="text"
                                        class="form-control"
                                        name="title" placeholder="Enter name..." required>
                                </div>
                                <div class="form-group">
                                    <label for="example-select">Content</label>
                                    <textarea rows="4" class="jsnotenew" 
                                        name="content"> </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Meta - Title</label>
                                    <input type="text" class="form-control" name="metaTitle" value="">
                                </div>
                                <div class="form-group">
                                    <label for="">Meta - Description</label>
                                    <textarea name="metaDescription" class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Meta - Keywords</label>
                                    <textarea name="metaKeyword" class="form-control "></textarea>
                                </div>
                    </div>
              
                    
                    <div class="col-lg-12 mt-5">
                        <div class="text-center form-group">
                            <button class="btn btn-success" type="submit">Create </button>
                            <a href="{{route('AboutUs.index')}}" class="btn btn-secondary">
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
