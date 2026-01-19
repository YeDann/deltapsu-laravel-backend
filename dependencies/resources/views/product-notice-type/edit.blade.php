@extends('layouts.admin')
@section('style')

@endsection
@section('content')
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Product Notice Type</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Product Notice Type</li>
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
            <h3 class="block-title"><a href="{{route('product-notice-type.index')}}" class="btn btn-info" > <i class="fa fa-chevron-left"></i> Product Notice Type</a></h3>
        </div>
        <div class="block-content">
            <form action="{{route('productNoticeTypeUpdate')}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <!-- Basic Elements -->
                <input type="hidden" name="typeId" value="{{$contents[0]->id}}" > 
                <div class="row push">
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
                                foreach($contents as $item2) { 
                                    if ($item->name == $item2->local) {
                                        $current = $item2;
                                        break;
                                    }
                                }
                              ?>
                                <div class="tab-pane {{($loop->iteration == 1)?"active":""}}" id="btabs-alt-static-{{$item->name}}" role="tabpanel">
                                    <div class="form-group">
                                        <label for="example-select">Name</label>
                                    <input type="text" class="form-control" name="title[{{$item->name}}]" value="{{isset($current->name) ? $current->name :''}}" >
                                    </div>
                                </div>
                                @endforeach
                            </div>
                           
                        <div class="form-group">
                            <button class="btn btn-success" type="submit" >Update</button>
                            <a href="{{route('product-notice-type.index')}}"  class="btn btn-secondary">
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
