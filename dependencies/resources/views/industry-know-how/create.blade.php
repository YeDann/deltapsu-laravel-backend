@extends('layouts.admin')
@section('style')
{{--
<link rel="stylesheet" href="{{asset('backend-asset/js/plugins/summernote/summernote-bs4.css')}}">
<link rel="stylesheet" href="{{asset('backend-asset/js/plugins/simplemde/simplemde.min.css')}}">
<link rel="stylesheet"
    href="{{asset('backend-asset/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}"> --}}

<style>
    #test-label {
        height: 100px !important;
    }

    .img-thumbnail {
        width: 50%;
    }

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
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Industry Know-How</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('industry-know-how.index')}}">Industry Know-How</a></li>
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
            <h3 class="block-title">Create Content</h3>
        </div>
        <div class="block-content mb-5">
            <form action="{{route('industry-know-how.store')}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <!-- Basic Elements -->
            
            @foreach($language as $item)
                <input type="hidden" name="langloop[]" value="{{$item->name}}">
                @endforeach
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-xl-8">
                        <div class="form-group ">
                            <label for="example-select">Title<span class="req-fed">*</span></label>
                            <input type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                                name="title" placeholder="Title..." required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="example-text-input">Image thumbnail <span class="req-fed">* Max File Size 2
                                    MB</span></label>
                            <div id="imagePreview">
                                <img src="https://via.placeholder.com/415x250.png" class="img-thumbnail imagePreview"
                                    alt="">
                            </div><br>
                            <div class="custom-file " style="width: 50%;">
                                <input type="file"
                                    class="custom-file-input {{ $errors->has('thumbnail') ? 'is-invalid' : '' }}"
                                    data-toggle="custom-file-input" id="thumbnail" name="file[thumbnail]"
                                    accept="image/*">
                                <label class="custom-file-label" id="label2" for="fileImage">Choose file</label>
                                <input type="hidden" name="namefile[thumbnail]" value="thumbnail">
                            </div>
                        </div>
                        <hr>
                        
                        <div class="form-group w-50">
                            <label for="">Industry Know-How Type</label>
                            <select name="industryKnowHowType" class="form-control" id="" required>
                                @foreach ($industryKnowHowType as $type)
                                <option value="{{$type->id}}">{{$type->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group w-50">
                            <label for="example-text-input">Date info<span class="req-fed">*</span></label>
                            <input type="text" class="js-datepicker form-control" id="example-datepicker1" name="dateinfo"
                                data-week-start="1" data-autoclose="true" data-today-highlight="true"
                                data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" value="" required>
                        </div>
                        <div class="form-group w-50">
                            <label for="example-text-input">Date Publish<span class="req-fed">*</span></label>
                            <input type="text"
                                class="js-datepicker form-control {{ $errors->has('datePublish') ? 'is-invalid' : '' }}"
                                name="datePublish" data-week-start="1" data-autoclose="true" data-today-highlight="true"
                                data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" name="datePublish" required>
                        </div>
                        <div class="form-group">
                            <label class="d-block">Industry Know-How Status</label>
                            <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                <input type="radio" class="custom-control-input" id="status-line-1" name="industryKnowHowStatus"
                                    value="1" checked>
                                <label class="custom-control-label" for="status-line-1">Show</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                <input type="radio" class="custom-control-input" id="status-line-2" name="industryKnowHowStatus"
                                    value="0">
                                <label class="custom-control-label" for="status-line-2">Hide</label>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="">Excerpt</label>
                            <textarea rows="4" name="description" class="jsnotenew form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Content</label>
                            <textarea name="content" class="jsnotenew form-control"></textarea>
                        </div>
                        <div class="form-group w-50">
                            <label>File <span class="req-fed">* Max File Size 20 MB</span></label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="file[industryknowhowfile]"
                                    data-toggle="custom-file-input" id="file_input">
                                <label class="custom-file-label" for="file_input">Choose file</label>
                                <input type="hidden" name="namefile[industryknowhowfile]" value="industryknowhowfile">
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="">Meta - Title</label>
                            <span>Recommended 30-60 Character</span>
                            <div id="item-wrap">
                                <input id="input-metaTitle-en" onkeyup="countCharacter('metaTitle-en')" type="text"
                                    class="form-control" name="metaTitle" value="">
                                <div class="text-count">Count Character :
                                    <span id="count-metaTitle-en">0</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Meta - Description</label>
                            <span>Recommended 70-155 Character</span>
                            <div id="item-wrap">
                                <textarea rows="4" id="input-metaDescription-en"
                                    onkeyup="countCharacter('metaDescription-en')" name="metaDescription"
                                    class="form-control"></textarea>
                                <div class="text-count">Count Character :
                                    <span id="count-metaDescription-en">
                                        0</span>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="form-group">
                            <label for="">Meta - Keywords</label>
                            <textarea name="metaKeyword" class="form-control "></textarea>
                        </div> --}}
                        <div class="form-group">
                            <label for="">Head (Custom HTML)</label>
                            <small class="text-muted d-block mb-1">輸入自訂 &lt;meta&gt;、&lt;link&gt;、&lt;script&gt; 等 HTML，將插入前台該頁面的 &lt;head&gt; 區塊。</small>
                            <textarea name="head" rows="6" class="form-control" style="font-family:monospace;"></textarea>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success col-md-2" type="submit">Create
                            </button>
                            <a href="{{route('industry-know-how.index')}}" class="btn btn-secondary col-md-2">
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
{{-- <script src="{{asset('backend-asset/js/plugins/summernote/summernote-bs4.min.js')}}"></script>
<script src="{{asset('backend-asset/js/plugins/simplemde/simplemde.min.js')}}"></script>
<script src="{{asset('backend-asset/js/plugins/ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('backend-asset/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script> --}}
<script>
    // jQuery(function () {
    //     Dashmix.helpers(['datepicker', 'summernote', 'simplemde', 'ckeditor']);
    // });

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
        } else {
            alert('File Type is not accepted!');
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

</script>
<script type="text/javascript">
    function countCharacter(id){
           var str = $('#input-'+id).val();
          $('#count-'+id).text(str.length);
      }
</script>
@endsection
