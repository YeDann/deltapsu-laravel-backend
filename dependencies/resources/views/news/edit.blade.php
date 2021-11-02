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

</style>
@endsection
@section('content')
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Product News</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('news.index')}}">Product News</a></li>
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
            <h3 class="block-title">Edit Content</h3>
        </div>
        <br>
        <form id="form-work" class="form-horizontal" role="form" autocomplete="off" action="{{route('newsUpdate')}}"
            method="post" novalidate="novalidate" enctype="multipart/form-data">
            {{csrf_field()}}
            <input type="hidden" name="newsId" value="{{$contents[0]->id}}">
            <div class="row pl-4 pr-4">
                <div class="col-md-12">
                    <div class="block block-rounded block-bordered">
                        <ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs" role="tablist">
                            @foreach ($language as $item)
                            <input type="hidden" name="langloop[]" value="{{$item->name}}" >
                            @if($loop->iteration == 1)
                            <li class="nav-item">
                                <a class="nav-link active" href="#btabs-alt-static-{{$item->name}}"
                                    style="text-transform: capitalize;">{{$item->name}}</a>
                            </li>
                            @else
                            <li class="nav-item">
                                <a class="nav-link " href="#btabs-alt-static-{{$item->name}}"
                                    style="text-transform: capitalize;">{{$item->name}}</a>
                            </li>
                            @endif
                            @endforeach
                        </ul>
                        <div class="block-content tab-content">
                            @foreach ($language as $item)
                            <?php 
                            $current = null;
                            foreach($contents as $item2) { 
                                if ($item->name == $item2->local) {
                                    $current = $item2;
                                    break;
                                }
                            }
                          ?>
                        
                        <div class="tab-pane {{($loop->iteration == 1)?"active":""}}" id="btabs-alt-static-{{$item->name}}" role="tabpanel">
                                <div class="form-group">
                                    <label for="">Title</label>
                                    <input type="text" class="form-control" name="title[{{$item->name}}]"
                                        value="{{isset($current->title) ? $current->title :''}}" required>
                                </div>
                                <div class="form-group">
                                        <label for="">Excerpt</label>
                                        <textarea rows="4" name="description[{{$item->name}}]"
                                            class="jsnotenew form-control">{{isset($current->description) ? $current->description :''}}</textarea>
                                    </div>
                                <div class="form-group">
                                    <label for="">Content</label>
                                    <textarea name="content[{{$item->name}}]"
                                        class="jsnotenew form-control">{{isset($current->content) ? $current->content :''}}</textarea>
                                </div>
                               
                                <div class="form-group w-50">
                                    <label>Old File</label>
                                    <a target="_blank" href="{{config('app.url')}}/uploads_delta/{{isset($current->file) ? $current->file :''}}">{{isset($current->file) ? $current->file :''}}</a>
                                       <input type="hidden" name="oldFile[{{$item->name}}]" value="{{isset($current->file) ? $current->file :''}}" >
                                       @if(isset($current->file))
                                                    <a href="{{route('removeFileNewsDoc',[$item->name,$item->id])}}" target="_blank" class="btn btn btn-danger"><i class="fa fa-trash"></i> </a>
                                                        @endif
                                </div>
                                <div class="form-group w-50">
                                    <label>File <span class="req-fed">* Max File Size 20 MB</span></label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="Filelang[{{$item->name}}]" data-toggle="custom-file-input" id="file_input" >
                                        <label class="custom-file-label" for="file_input">Choose file</label>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label for="">Meta - Title</label>
                                    <input type="meta_title[{{$item->name}}]" class="form-control"
                                        name="meta_title[{{$item->name}}]" value="{{isset($current->meta_title) ? $current->meta_title :''}}">
                                </div>
                                <div class="form-group">
                                    <label for="">Meta - Description</label>
                                    <textarea name="meta_des[{{$item->name}}]"
                                        class="form-control ">{{isset($current->meta_description) ? $current->meta_description :''}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Meta - Keywords</label>
                                    <textarea name="meta_key[{{$item->name}}]"
                                        class="form-control ">{{isset($current->meta_keywords) ? $current->meta_keywords :''}}</textarea>
                                </div>
                            </div>
                      
                    @endforeach
                </div>
            </div>
    </div>
    <div class="col-md-12">
            <div class="form-group">
                    <label for="">News Type</label>
                    <select name="newsType" class="form-control" id="">
                        @foreach ($newsType as $type)
                        @if($contents[0]->categories_id == $type->id)
                        <option value="{{$type->id}}" selected>{{$type->name}}</option>
                        @else
                        <option value="{{$type->id}}">{{$type->name}}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="example-text-input">Date info*</label>
                    <input type="text" class="js-datepicker form-control" id="example-datepicker1"
                        name="dateinfo" data-week-start="1" data-autoclose="true"
                        data-today-highlight="true" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd"
                        value="{{$contents[0]->date_info}}">
                </div>
                <div class="form-group">
                    <label for="example-text-input">Date Publish*</label>
                    <input type="text" class="js-datepicker form-control" id="example-datepicker1"
                        name="datePublish" data-week-start="1" data-autoclose="true"
                        data-today-highlight="true" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd"
                        value="{{$contents[0]->date_publish}}">
                </div>
                <div class="form-group">
                    <label class="d-block">News Status</label>
                    <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                        <input type="radio" class="custom-control-input" id="status-line-1"
                            name="newsStatus" value="1"  {{($contents[0]->status == 1) ?"checked":""}}>
                        <label class="custom-control-label" for="status-line-1">Show</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                        <input type="radio" class="custom-control-input" id="status-line-2"
                            name="newsStatus" value="0" {{($contents[0]->status == 0 ) ?"checked":""}}>
                        <label class="custom-control-label" for="status-line-2">Hide</label>
                    </div>
                </div>
        <div class="form-group">
            <label for="example-text-input">Image-thumbnail</label>
            <div id="imagePreview">
                <img src="{{asset('/uploads_delta/'.$contents[0]->thumb)}}"
                    class="img-thumbnail imagePreview" alt="">
            <input type="hidden" name="oldfilethumb" value="{{$contents[0]->thumb}}" >
            </div><br>
            <div class="custom-file">
                <input type="file" class="custom-file-input"
                    data-toggle="custom-file-input" id="image" name="thumb">
                <label class="custom-file-label" for="fileImage">Choose file</label>
            </div>
        </div>

        <div class="form-group text-center">
                <button type="submit" class="btn btn-success text-uppercase col-2">Update 
                </button>
            <a href="{{route('news.index')}}" class="btn btn-secondary text-uppercase col-2">Cancel
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
            alert('File Type is not accepted!');
        }
    };

   
    $(document).on('change', '#image', function () {
        var FileSize = this.files[0].size / 1024 / 1024; // in MB
        if (FileSize > 2) {
            alert("File size exceeds 2 MB!");
            this.value = "";
            $('#label2').text('Choose file');
        }else{
            previewImage(this, $('.imagePreview'));
        }

});


$(document).on('change', '.custom-file-input', function () {
        // alert(this.files[0].size);
        var FileSize = this.files[0].size / 1024 / 1024; // in MB
        if (FileSize > 20) {
            alert("File size exceeds 20 MB!");
            this.value = "";
        };
    });

</script>
@endsection
