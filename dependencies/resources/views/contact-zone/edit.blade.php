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
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Office Zone</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Office Zone</li>
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
            <h3 class="block-title"></h3>
        </div>
        <br>
        <form id="form-work" class="form-horizontal" role="form" autocomplete="off"
            action="{{route('officezoneUpdate')}}" method="post" novalidate="novalidate" enctype="multipart/form-data">
            {{csrf_field()}}
            <input type="hidden" name="zoneId" value="{{$contents[0]->contact_zone_id}}">
            <input type="hidden" name="type" value="{{$type}}">
            <div class="row pl-4 pr-4 justify-content-center">
                <div class="col-md-6">
                    <div class="block block-rounded block-bordered">
                        <ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs" role="tablist">
                            @foreach ($contents as $item)
                            @if($loop->iteration == 1)
                            <li class="nav-item">
                                <a class="nav-link active" href="#btabs-alt-static-{{$item->local}}"
                                    style="text-transform: capitalize;">{{$item->local}}</a>
                            </li>
                            @else
                            <li class="nav-item">
                                <a class="nav-link " href="#btabs-alt-static-{{$item->local}}"
                                    style="text-transform: capitalize;">{{$item->local}}</a>
                            </li>
                            @endif
                            @endforeach
                        </ul>
                        <div class="block-content tab-content">
                            @foreach ($contents as $item)
                            @if($loop->iteration == 1)
                            <div class="tab-pane active" id="btabs-alt-static-{{$item->local}}" role="tabpanel">
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="text" class="form-control" name="name_{{$item->local}}"
                                        value="{{$item->name}}">
                                </div>
                            </div>
                            @else
                            <div class="tab-pane" id="btabs-alt-static-{{$item->local}}" role="tabpanel">
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="text" class="form-control" name="name_{{$item->local}}"
                                        value="{{$item->name}}">
                                </div>
                            </div>
                            @endif
                            @endforeach

                           <div class="form-group">
                                <button class="btn btn-success col-md-3" type="submit" >Update <i class="fa fa-pencil-alt"></i> </button>
                                <a href="{{route('contact-zone.show',$type)}}"  class="btn btn-secondary col-md-3">
                                    Cancel <i class="fa fa-times"></i>
                                </a>
                            </div>
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
