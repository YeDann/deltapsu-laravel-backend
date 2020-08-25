@extends('layouts.admin')
@section('style')

@endsection
@section('content')
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Edit Product Launch Detail </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <a href="{{route('launch_datail' ,$headId)}}">Edit Product Launch Detail</a></li>
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
            <h3 class="block-title">information</h3>
        </div>
        <div class="block-content">
            <form action="{{route('update_launch_datail')}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
             
                <input type="hidden" name="headId" value="{{$headId}}" >
                <input type="hidden" name="pro_detail_id" value="{{$relate_pro_launch_schedule[0]->re_id}}" >
                
                <!-- Basic Elements -->
                <div class="row ">
                    <div class="col-lg-12">


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
                                foreach($relate_pro_launch_schedule as $item2) { 
                                    if ($item->name == $item2->local) {
                                        $current = $item2;
                                        break;
                                    }
                                }
                              ?>
                            
                            <div class="tab-pane {{($loop->iteration == 1)?"active":""}}" id="btabs-alt-static-{{$item->name}}" role="tabpanel">
                                <div class="">
                                    <div class="form-group">
                                        <label for="example-select">Model Name </label>
                                        <input type="text"
                                            class="form-control"
                                    name="modelname[{{$item->name}}]" placeholder="Enter text..." value="{{isset($current->modelname)?$current->modelname:''}}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-select">op_voltage </label>
                                        <input type="text"
                                            class="form-control"
                                            name="op_voltage[{{$item->name}}]" placeholder="Enter text..." value="{{isset($current->op_voltage)?$current->op_voltage:''}}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-select">op_wattage </label>
                                        <input type="text"
                                            class="form-control"
                                            name="op_wattage[{{$item->name}}]" placeholder="Enter text..." value="{{isset($current->op_wattage)?$current->op_wattage:''}}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-select">Phase </label>
                                        <input type="text"
                                            class="form-control"
                                            name="phase[{{$item->name}}]" placeholder="Enter text..." value="{{isset($current->phase)?$current->phase:''}}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-select">Remark </label>
                                        <input type="text"
                                            class="form-control"
                                            name="remark[{{$item->name}}]" placeholder="Enter text..." value="{{isset($current->remark)?$current->remark:''}}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-select"> Old File</label>
                                        <a href="{{config('app.url')}}/medias/marketing_resources/{{isset($current->file) ? $current->file :''}}">{{isset($current->file) ? $current->file :''}}</a>
                                    </div>
                                      <input type="hidden"  name="oldfile[{{$item->name}}]" value="{{isset($current->file) ? $current->file :''}}">
                                    <div class="form-group">
                                        <label for="example-select">File <span class="req-fed">* Max File Size 20 MB</span></label>
                                        <div class="custom-file " style="width:100%;">
                                            <input type="file" class="custom-file-input" name="filepro[{{$item->name}}]"
                                                data-toggle="custom-file-input">
                                            <label class="custom-file-label" for="fileImage">Choose file</label>
                                        </div>
                                    </div>
                                    </div>
                            </div>
                            @endforeach
                            </div>
                        </div>
                     
                            <div class="text-center form-group">
                                <button class="btn btn-info" type="submit">Update </button>
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
