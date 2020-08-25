@extends('layouts.admin')
@section('style')

@endsection
@section('content')
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2"> Edit Product Field</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('product-field.index')}}">All Product Field</a></li>
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
            <h3 class="block-title">Product Field Information</h3>
        </div>
        <div class="row p-3 justify-content-center">
        <div class="col-md-8">
            <form action="{{route('productfieldUpdate')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <input type="hidden" name="product_field_id" value="{{$pd_field[0]->product_field_id}}">
                <div class="block block-rounded block-bordered col-md-12">
                    <ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs" role="tablist">
                        @foreach ($pd_field as $item)
                        
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
                        @foreach ($pd_field as $item)
                        <input type="hidden" name="section_loop" value="{{$item->local}}">
                        @if($loop->iteration == 1)
                        <div class="tab-pane active" id="btabs-alt-static-{{$item->local}}" role="tabpanel">
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" class="form-control col-md-6" name="title_{{$item->local}}"
                                    value="{{$item->field_name}}">
                            </div>
                        </div>
                        @else
                        <div class="tab-pane" id="btabs-alt-static-{{$item->local}}" role="tabpanel">
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" class="form-control col-md-6" name="title_{{$item->local}}"
                                    value="{{$item->field_name}}">
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
                <div class="form-group">
                        <label for="">Section</label>
                        <select name="section" id="" class="form-control">
                            @foreach ($section as $sec)
                            @if($pd_field[0]->section_id == $sec->section_id)
                            <option value="{{$sec->section_id}}" selected>{{$sec->name}}</option>
                            @else
                            <option value="{{$sec->section_id}}">{{$sec->name}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="d-block">Type</label>
                        @if($item->type == "text")
                        <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                            <input type="radio" class="custom-control-input" id="status-line-1" name="type" value="text" checked onchange="selectnumber(1);">
                            <label class="custom-control-label" for="status-line-1">Text</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                            <input type="radio" class="custom-control-input" id="status-line-2" name="type" value="number" onchange="selectnumber(0);">
                            <label class="custom-control-label" for="status-line-2">Number</label>
                        </div>
                        @elseif($item->type == "number")
                        <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                            <input type="radio" class="custom-control-input" id="status-line-1" name="type" value="text" onchange="selectnumber(1);">
                            <label class="custom-control-label" for="status-line-1">Text</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                            <input type="radio" class="custom-control-input" id="status-line-2" name="type" value="number" checked onchange="selectnumber(0);">
                            <label class="custom-control-label" for="status-line-2">Number</label>
                        </div>
                        @endif
                    </div>
                    @if($pd_field[0]->unit_name != null)
                    <div id="unitinput" class="form-group">
                        <label for="example-select">Unit</label>
                        <input type="text" class="form-control {{ $errors->has('unit') ? 'is-invalid' : '' }}" name="unit" value="{{$pd_field[0]->unit_name}}">
                    </div>
                    @endif
                    <div class="form-group">
                            <label class="d-block">Show filter</label>
                           
                              
                            <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                    <input type="radio" class="custom-control-input" id="status-1" name="status" value="1" {{ ($pd_field[0]->status == 1 ) ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="status-1">Show</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                    <input type="radio" class="custom-control-input" id="status-2" name="status" value="0" {{ ($pd_field[0]->status == 0 ) ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="status-2">Hide</label>
                                </div>
                           
                        </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success text-uppercase">Update 
                        </button>
                        <a href="{{route('product-field.index')}}" class="btn btn-secondary text-uppercase">Cancel
                        </a>
                    </div>
        </div>
    
        </form>
    </div>
</div>
</div>
</div>
@endsection
@section('js')
<script>
        function selectnumber(id){
             if(id == 1){
              $('#unitinput').addClass('d-none');
             }else{
              $('#unitinput').removeClass('d-none');
             }
           
        }
      </script>

@endsection
