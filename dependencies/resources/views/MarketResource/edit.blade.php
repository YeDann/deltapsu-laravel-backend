@extends('layouts.admin')
@section('style')

@endsection
@section('content')
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Edit Marketing Resource </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <a href="{{route('MarketResource.index')}}">All Marketing Resource</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
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
            <h3 class="block-title">Edit information</h3>
        </div>
        <div class="block-content">
            <form action="{{route('update_MarketResource')}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <input type="hidden" name="mr_id" value="{{$margeting[0]->id}}">
                <!-- Basic Elements -->
                <div class="row push">

                    <div class="col-lg-12">
                        <div class="block block-rounded block-bordered">
                            <ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs" role="tablist">
                                @foreach ($language as $item)
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
                                foreach($margeting as $item2) { 
                                    if ($item->name == $item2->local) {
                                        $current = $item2;
                                        break;
                                    }
                                }
                           ?>
                                <input type="hidden" name="lang_loop[]" value="{{$item->name}}">
                                <div class="tab-pane {{($loop->iteration == 1)?" active":""}}"
                                    id="btabs-alt-static-{{$item->name}}" role="tabpanel">
                                    <div class="form-group">
                                        <label for="example-select">Title</label>
                                        <input type="text"
                                            class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                            name="name[{{$item->name}}]"
                                            value="{{isset($current->name)? $current->name:""}}"
                                            placeholder="Enter name...">
                                    </div>
                                    {{-- 非 Product Images / Videos：逐語系各自的檔（Old File + 上傳）。gallery 改用下方共用檔 --}}
                                    @if(!$isGallery)
                                    <div class="form-group">
                                        <label for="example-select"> Old File</label>
                                        <a
                                            href="{{config('app.url')}}/uploads_delta/partner/marketing_resources/{{isset($current->file) ? $current->file :''}}">{{isset($current->file)
                                            ? $current->file :''}}</a>

                                        @if(isset($current->file))
                                        <a href="{{route('removefileMargeting',[$margeting[0]->id,$item->name])}}"
                                            class="btn btn btn-danger"><i class="fa fa-trash"></i> </a>
                                        @endif
                                        <input type="hidden" name="oldfile[{{$item->name}}]"
                                            value="{{isset($current->file) ? $current->file :''}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="example-select">File <span class="req-fed">* Max File Size 2 GB（分塊上傳）</span></label>
                                        <div class="custom-file " style="width:100%;">
                                            <input type="file" class="custom-file-input mr-chunk-input" id="mr_browse_{{$item->name}}"
                                                data-locale="{{$item->name}}" data-toggle="custom-file-input">
                                            <label class="custom-file-label" id="mr_lable_{{$item->name}}" for="mr_browse_{{$item->name}}">Choose file</label>
                                        </div>
                                        {{-- 分塊上傳進度條 + 狀態；完成後最終檔名存進 hidden file_uploaded[locale]，未換則沿用 oldfile --}}
                                        <div class="progress mt-2 d-none" id="mr_progress_{{$item->name}}" style="height:20px;">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width:0%">0%</div>
                                        </div>
                                        <small class="text-muted d-block mt-1" id="mr_status_{{$item->name}}"></small>
                                        <input type="hidden" name="file_uploaded[{{$item->name}}]" id="mr_uploaded_{{$item->name}}" value="">
                                    </div>
                                    @endif
                                </div>
                                @endforeach
                            </div>

                        </div>
                        {{-- Product Images / Videos：一個共用檔（換檔套用所有語系）。其他分類用上方逐語系檔 --}}
                        @if($isGallery)
                        <div class="form-group">
                            <label for="example-select"> Old File</label>
                            <a href="{{config('app.url')}}/uploads_delta/partner/marketing_resources/{{$margeting[0]->file ?? ''}}">{{$margeting[0]->file ?? ''}}</a>
                            @if(!empty($margeting[0]->file))
                            <a href="{{route('removefileMargeting',[$margeting[0]->id, $margeting[0]->local])}}" class="btn btn btn-danger"><i class="fa fa-trash"></i> </a>
                            @endif
                            <input type="hidden" name="oldfile" value="{{$margeting[0]->file ?? ''}}">
                        </div>
                        <div class="form-group">
                            <label for="example-select">File <span class="req-fed">* Max File Size 2 GB（分塊上傳，套用所有語系）</span></label>
                            <div class="custom-file " style="width:100%;">
                                <input type="file" class="custom-file-input" id="mr_browse_shared" data-toggle="custom-file-input">
                                <label class="custom-file-label" id="mr_lable_shared" for="mr_browse_shared">Choose file</label>
                            </div>
                            <div class="progress mt-2 d-none" id="mr_progress_shared" style="height:20px;">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width:0%">0%</div>
                            </div>
                            <small class="text-muted d-block mt-1" id="mr_status_shared"></small>
                            <input type="hidden" name="file_uploaded" id="mr_uploaded_shared" value="">
                        </div>
                        @endif
                        <div class="form-group">
                            <label for="example-select">Select Categories <span class="req-fed">*</span></label>
                            <select class="js-select2 form-control" name="mr_categories" data-placeholder="Choose one.."
                                required>
                                <option></option>
                                @foreach ($margetCates as $item)
                                @if($item->cate_id == $margeting[0]->cate_id)
                                <option value="{{$item->cate_id}}" selected>{{$item->name}}</option>
                                @else
                                <option value="{{$item->cate_id}}">{{$item->name}}</option>
                                @endif
                                @endforeach

                            </select>
                        </div>
                        <div class="form-group">
                            <label class="d-block">Status</label>
                            <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                <input type="radio" class="custom-control-input" id="status-1" name="status" value="1"
                                    {{$margeting[0]->status == 1 ?"checked":""}} >
                                <label class="custom-control-label" for="status-1">Show</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                <input type="radio" class="custom-control-input" id="status-2" name="status" value="0"
                                    {{$margeting[0]->status == 0 ?"checked":""}}>
                                <label class="custom-control-label" for="status-2">Hide</label>
                            </div>

                        </div>
                        <div class="text-center form-group">
                            <button class="btn btn-info" type="submit">Update </button>
                            <a href="{{route('MarketResource.index')}}" class="btn btn-secondary">
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
<script src="{{ asset('backend-asset/js/resumable.js') }}"></script>
<script src="{{ asset('backend-asset/js/mr-chunk-upload.js') }}"></script>
<script>
    $(function () {
@if($isGallery)
        // Product Images / Videos：一個共用檔上傳器，送出時套用所有語系
        MRChunkUpload.init({
            input: document.getElementById('mr_browse_shared'),
            chunkUrl: '{{ route('MarketResource.chunk') }}',
            posterUrl: '{{ route('MarketResource.poster') }}',
            csrf: '{{ csrf_token() }}',
            label: $('#mr_lable_shared'),
            progress: $('#mr_progress_shared'),
            bar: $('#mr_progress_shared .progress-bar'),
            status: $('#mr_status_shared'),
            hidden: $('#mr_uploaded_shared')
        });
@else
        // 其他分類：每個語系一個 file input，各自分塊上傳到 file_uploaded[locale]
        document.querySelectorAll('.mr-chunk-input').forEach(function (input) {
            var loc = input.dataset.locale;
            MRChunkUpload.init({
                input: input,
                chunkUrl: '{{ route('MarketResource.chunk') }}',
                posterUrl: '{{ route('MarketResource.poster') }}',
                csrf: '{{ csrf_token() }}',
                label: $('#mr_lable_' + loc),
                progress: $('#mr_progress_' + loc),
                bar: $('#mr_progress_' + loc + ' .progress-bar'),
                status: $('#mr_status_' + loc),
                hidden: $('#mr_uploaded_' + loc)
            });
        });
@endif
        MRChunkUpload.guardSubmit($('form'));
    });
</script>
@endsection