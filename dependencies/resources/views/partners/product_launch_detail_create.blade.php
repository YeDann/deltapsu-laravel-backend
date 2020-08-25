@extends('layouts.admin')
@section('style')

@endsection
@section('content')
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Create Product Launch Detail </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <a href="{{route('launch_datail' ,$headId)}}">Product Launch Detail</a></li>
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
            <form action="{{route('store_launch_datail')}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                @foreach ($language as $item)
                <input type="hidden" name="langloop[]" value="{{$item->name}}">
                @endforeach
                <input type="hidden" name="headId" value="{{$headId}}" >
                <!-- Basic Elements -->
                <div class="row ">
                    <div class="col-lg-12">
                        <div class="">
                            <div class="form-group">
                                <label for="example-select">Model Name <span class="req-fed">*</span></label>
                                <input type="text"
                                    class="form-control"
                                    name="modelname" placeholder="Enter text..." required>
                            </div>
                            <div class="form-group">
                                <label for="example-select">op_voltage <span class="req-fed">*</span></label>
                                <input type="text"
                                    class="form-control"
                                    name="op_voltage" placeholder="Enter text..." required>
                            </div>
                            <div class="form-group">
                                <label for="example-select">op_wattage <span class="req-fed">*</span></label>
                                <input type="text"
                                    class="form-control"
                                    name="op_wattage" placeholder="Enter text..." required>
                            </div>
                            <div class="form-group">
                                <label for="example-select">Phase <span class="req-fed">*</span></label>
                                <input type="text"
                                    class="form-control"
                                    name="phase" placeholder="Enter text..." required>
                            </div>
                            <div class="form-group">
                                <label for="example-select">Remark <span class="req-fed">*</span></label>
                                <input type="text"
                                    class="form-control"
                                    name="remark" placeholder="Enter text..." required>
                            </div>
                            <div class="form-group">
                                <label for="example-select">File <span class="req-fed">* Max File Size 20 MB</span></label>
                                <div class="custom-file " style="width:100%;">
                                    <input type="file" class="custom-file-input" name="file"
                                        data-toggle="custom-file-input">
                                    <label class="custom-file-label" for="fileImage">Choose file</label>
                                </div>
                            </div>
                         
                        
                            </div>
                            <div class="text-center form-group">
                                <button class="btn btn-success" type="submit">Create </button>
                                <a href="{{route('launch_datail' ,$headId)}}" class="btn btn-secondary">
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
