@extends('layouts.admin')
@section('style')

@endsection
@section('content')
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Create {{$type_name}}</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"> <a href="{{route('partner_doc_index' ,[$type_id ,$type_name])}}">{{$type_name}}</a></li>
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
            <form action="{{route('storeSaleKit')}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="row">
                    <input type="hidden" name="typeId" id="typeId" value="{{$type_id}}">
                    <input type="hidden" name="typeName" id="typeName" value="{{$type_name}}">
                    @foreach ($language as $item)
                    <input type="hidden" name="langloop[]" value="{{$item->name}}">
                    @endforeach
                    <div class="col-lg-12">
                        <div class="form-group">
                        <label for="example-select"><span class="req-fed">*</span>Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter Text..." required>
                        </div>
                        <div class="form-group">
                            <label for="example-select">File <span class="req-fed">* Max File Size 20 MB</span></label>
                            <div class="custom-file " style="width:100%;">
                                <input type="file" class="custom-file-input" name="filesale"
                                    data-toggle="custom-file-input">
                                <label class="custom-file-label" for="fileImage">Choose file</label>
                            </div>
                        </div>
                            <label for="example-text-input"><span class="req-fed">*</span>Public Date</label>
                            <input type="text" class="js-datepicker form-control {{ $errors->has('date') ? 'is-invalid' : '' }}"  data-week-start="1" data-autoclose="true"
                                data-today-highlight="true" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" name="date" required>
                    </div>
                    <div class="col-lg-12">
                        <div class="text-center form-group mt-4">
                            <button class="btn btn-update" type="submit">Create </button>
                            <a href="{{route('partner_doc_index' ,[$type_id ,$type_name])}}" class="btn btn-secondary">
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
