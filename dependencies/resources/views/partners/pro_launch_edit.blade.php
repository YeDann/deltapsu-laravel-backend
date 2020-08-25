@extends('layouts.admin')
@section('style')

@endsection
@section('content')
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Update Product Launch Schedule</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <a href="{{route('pro_lauch')}}">Product Launch Schedules</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Update</li>
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
            <form action="{{route('pro_lauch_update')}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <!-- Basic Elements -->
               <input type="hidden" name="pl_id" value="{{$pro_launch_sche[0]->pl_id}}" >
             
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                        <label for="example-select"><span class="req-fed">*</span>Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Enter name..." value="{{$pro_launch_sche[0]->title}}">
                        </div>
                      
                            <label for="example-text-input"><span class="req-fed">*</span>Date</label>
                            <input type="text" class="js-datepicker form-control {{ $errors->has('date') ? 'is-invalid' : '' }}"  data-week-start="1" data-autoclose="true"
                                data-today-highlight="true" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" name="date" value="{{$pro_launch_sche[0]->date}}">
                    </div>
                    <div class="col-lg-12">
                        <div class="text-center form-group mt-4">
                            <button class="btn btn-success" type="submit">Update </button>
                            <a href="{{route('pro_lauch')}}" class="btn btn-secondary">
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
<script src="{{asset('backend-asset/js/plugins/summernote/summernote-bs4.min.js')}}"></script>
<script src="{{asset('backend-asset/js/plugins/simplemde/simplemde.min.js')}}"></script>
<script src="{{asset('backend-asset/js/plugins/ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('backend-asset/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
<script>
    jQuery(function () {
        Dashmix.helpers(['datepicker', 'summernote', 'simplemde', 'ckeditor']);
    });
</script>
@endsection
