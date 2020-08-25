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
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Event</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('event.index')}}">Events</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- Content -->
<div class="content mb-5">
    <div class="block block-rounded block-bordered">
        <div class="block-header block-header-default">
            <h3 class="block-title">Create Event</h3>
        </div>
        <div class="block-content mb-5">
            <form action="{{route('event.store')}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <!-- Basic Elements -->
                @foreach($language as $item)
                <input type="hidden" name="langloop[]" value="{{$item->name}}" >
                @endforeach
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-xl-8">
                        <div class="form-group">
                            <label for="example-select">Title<span class="req-fed">*</span></label>
                            <input type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                                name="title" placeholder="Title." required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="example-text-input">Image thumbnail</label>
                            <div id="imagePreview">
                                <img src="https://via.placeholder.com/415x250.png" class="img-thumbnail imagePreview"
                                    alt="">
                            </div><br>
                           
                            <div class="custom-file " style="width: 50%;">
                                    <input type="file"
                                        class="custom-file-input {{ $errors->has('thumbnail') ? 'is-invalid' : '' }}"
                                        data-toggle="custom-file-input" id="thumbnail" name="file[thumbnail]" accept="image/*">
                                    <label class="custom-file-label" id="label2" for="fileImage">Choose file</label>
                                    <input type="hidden" name="namefile[thumbnail]" value="thumbnail" >
                                </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="example-text-input">Date Start</label>
                                    <input type="text" class="js-datepicker form-control {{ $errors->has('date_start') ? 'is-invalid' : '' }}"  data-week-start="1" data-autoclose="true"
                                    data-today-highlight="true" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" name="date_start">
                                </div>
                                <div class="col-md-4">
                                    <label for="example-text-input">Date End</label>
                                    <input type="text" class="js-datepicker form-control {{ $errors->has('date_start') ? 'is-invalid' : '' }}"  data-week-start="1" data-autoclose="true"
                                    data-today-highlight="true" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" name="date_end">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="">Time Start</label>
                                    <input id="timeStart" class="form-control {{ $errors->has('time_start') ? 'is-invalid' : '' }}" placeholder="00:00" name="time_start" />
                                </div>
                                <div class="col-md-4">
                                    <label for="">Time End</label>
                                    <input id="timeEnd" class="form-control {{ $errors->has('time_end') ? 'is-invalid' : '' }}"  placeholder="00:00" name="time_end" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="d-block">Status</label>
                            <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                <input type="radio" class="custom-control-input" id="status-line-1" name="status"
                                    value="1" checked>
                                <label class="custom-control-label" for="status-line-1">Show</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                <input type="radio" class="custom-control-input" id="status-line-2" name="status"
                                    value="0">
                                <label class="custom-control-label" for="status-line-2">Hide</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">location</label>
                            <input type="text" class="form-control" name="location" >
                        </div>
                        
                        <div class="form-group">
                                <label for="">Excerpt</label>
                                <textarea rows="4" name="description"
                                    class="jsnotenew form-control"></textarea>
                            </div>
                        <div class="form-group">
                            <label for="">Content</label>
                            <textarea name="content" class="jsnotenew form-control"></textarea>
                        </div>
                        <hr>
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
                        
                        <div class="form-group text-center">
                            <button class="btn btn-success col-md-2" type="submit">Create 
                            </button>
                            <a href="{{route('event.index')}}" class="btn btn-secondary col-md-2">
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

<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

<script src="{{asset('backend-asset/js/plugins/summernote/summernote-bs4.min.js')}}"></script>
<script src="{{asset('backend-asset/js/plugins/simplemde/simplemde.min.js')}}"></script>
<script src="{{asset('backend-asset/js/plugins/ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('backend-asset/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
<script>
    jQuery(function () {
        Dashmix.helpers(['datepicker', 'summernote', 'simplemde', 'ckeditor']);
    });
   
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
        } else {
            alert('Fisierul selectat nu este acceptat!');
        }

    };

    $(document).on('change', '#thumbnail', function () {
        var FileSize = this.files[0].size / 1024 / 1024; // in MB
        if (FileSize > 2) {
            alert("File size exceeds 2 MB!");
            this.value = "";
            $('#label2').text('Choose file');
        }else{
            previewImage(this, $('.imagePreview'));
        }

});

$(document).on('change', '#file_input', function () {
        // alert(this.files[0].size);
        var FileSize = this.files[0].size / 1024 / 1024; // in MB
        if (FileSize > 20) {
            alert("File size exceeds 20 MB!");
            this.value = "";
        };
    });

    $('#timeStart').timepicker({
        uiLibrary: 'bootstrap4'
    });
    $('#timeEnd').timepicker({
            uiLibrary: 'bootstrap4'
    });

</script>
@endsection
