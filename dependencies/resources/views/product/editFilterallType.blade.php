@extends('layouts.admin')
@section('style')

@endsection
@section('content')
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Edit Filter Section</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <a href="{{route('default_filer')}}" >Edit Filter Section</a></li>
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
            <h3 class="block-title">Edit Filter Section</h3>
        </div>
        <div class="block-content">
            <form action="{{route('updateFilterSection')}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <!-- Basic Elements -->
                <input type="hidden" name="Filter_id" value="{{$arrLang_datas[0]->field_id}}">
                <div class="row justify-content-center ">
                    <div class="block block-rounded block-bordered col-md-8">
                        <ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs" role="tablist">
                            @foreach ($arrLang_datas as $item)
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
                            @foreach ($arrLang_datas as $item)
                            <input type="hidden" name="lang_loop[]" value="{{$item->local}}" >
                         <div class="tab-pane {{($loop->iteration == 1)?'active':''}}" id="btabs-alt-static-{{$item->local}}" role="tabpanel">
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="text" class="form-control" name="name[{{$item->local}}]"
                                        value="{{isset($item->title) ? $item->title :''}}">
                                </div>
                            
                            </div>
                            @endforeach
                        </div>
                        <div class="block-content tab-content">
                            <button type="submit" class="btn btn-success text-uppercase mb-4">Update 
                            </button>
                            <a href="{{route('default_filer')}}"
                                class="btn btn-secondary text-uppercase mb-4">Cancel
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
