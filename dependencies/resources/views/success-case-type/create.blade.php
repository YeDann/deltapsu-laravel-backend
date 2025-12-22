@extends('layouts.admin')
@section('style')

@endsection
@section('content')
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Success Case Type</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Success Case Type</li>
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
            <h3 class="block-title">Create Success Case Type</h3>
        </div>
        <div class="block-content">
            <form action="{{route('success-case-type.store')}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <!-- Basic Elements -->
                <div class="row push">
                    <div class="col-lg-4">
                        <p class="text-muted">
                            {{-- The most often used inputs you know and love --}}
                        </p>
                    </div>
                    <div class="col-lg-8 col-xl-5">
                        <div class="form-group">
                            <label for="example-colorpicker2">Type Color</label>
                            <div class="js-colorpicker input-group" data-format="hex">
                                <input type="text" class="form-control" id="example-colorpicker2" name="color_type">
                                <div class="input-group-append">
                                    <span class="input-group-text colorpicker-input-addon">
                                        <i></i>
                                    </span>
                                </div>
                            </div>
                         </div>
                        <div class="form-group">
                            <label for="example-select">Name</label>
                            <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name" placeholder="Type name..." >
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success" type="submit" >Create </button>
                            <a href="{{route('success-case-type.index')}}"  class="btn btn-secondary ">
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
