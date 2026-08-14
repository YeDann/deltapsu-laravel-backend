@extends('layouts.admin')
@section('style')

@endsection
@section('content')
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Create Marketing Resources</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <a href="{{route('MarketResource.index')}}">Marketing Resources</a></li>
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
            <form action="{{route('MarketResource.store')}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                @foreach ($language as $item)
                <input type="hidden" name="lang_loop[]" value="{{$item->name}}">
                @endforeach
                <!-- Basic Elements -->
                <div class="row push">
                
                    <div class="col-lg-12">
                        <div class="">
                            <div class="form-group">
                                <label for="example-select">Title  <span class="req-fed">*</span></label>
                                <input type="text"
                                    class="form-control"
                                    name="name" placeholder="Enter name..." required>
                            </div>
                            <div class="form-group">
                                <label for="example-select">File <span class="req-fed">* Max File Size 2 GB（分塊上傳）</span></label>
                                <div class="custom-file " style="width:100%;">
                                    <input type="file" class="custom-file-input" id="mr_file_browse"
                                        data-toggle="custom-file-input">
                                    <label class="custom-file-label" id="file_lable" for="mr_file_browse">Choose file</label>
                                </div>
                                {{-- 分塊上傳進度條 + 狀態；上傳完成後最終檔名存進 hidden file_uploaded 隨表單送出 --}}
                                <div class="progress mt-2 d-none" id="mr_upload_progress" style="height:20px;">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width:0%">0%</div>
                                </div>
                                <small class="text-muted d-block mt-1" id="mr_upload_status"></small>
                                <input type="hidden" name="file_uploaded" id="mr_file_uploaded" value="">
                            </div>
                            {{-- 壓縮檔（ZIP/7z）縮圖：選填。上傳後存成主檔同名 .jpg，前台當縮圖用；圖片/影片/PDF 免填 --}}
                            <div class="form-group">
                                <label for="mr_thumb_browse">Thumbnail <span class="text-muted">（壓縮檔等非圖片/影片/PDF 檔用，選填；隨表單一起上傳）</span></label>
                                <div class="custom-file" style="width:100%;">
                                    <input type="file" name="thumbnail" class="custom-file-input" id="mr_thumb_browse" accept="image/*" data-toggle="custom-file-input">
                                    <label class="custom-file-label" id="mr_thumb_label" for="mr_thumb_browse">Choose thumbnail</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="example-select">Select Categories <span class="req-fed">*</span></label>
                                <select class="js-select2 form-control" name="mr_categories" data-placeholder="Choose one.." required>
                                        <option></option>
                                    @foreach ($margetCates as $item)
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
                                <a href="{{route('MarketResource.index')}}" class="btn btn-secondary">
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
<script src="{{ asset('backend-asset/js/resumable.js') }}"></script>
<script src="{{ asset('backend-asset/js/mr-chunk-upload.js') }}"></script>
<script>
    $(function () {
        MRChunkUpload.init({
            input: document.getElementById('mr_file_browse'),
            chunkUrl: '{{ route('MarketResource.chunk') }}',
            posterUrl: '{{ route('MarketResource.poster') }}',
            csrf: '{{ csrf_token() }}',
            label: $('#file_lable'),
            progress: $('#mr_upload_progress'),
            bar: $('#mr_upload_progress .progress-bar'),
            status: $('#mr_upload_status'),
            hidden: $('#mr_file_uploaded')
        });
        MRChunkUpload.guardSubmit($('form'));
    });
</script>
@endsection
