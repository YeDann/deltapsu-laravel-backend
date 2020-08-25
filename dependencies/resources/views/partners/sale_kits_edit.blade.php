@extends('layouts.admin')
@section('style')

@endsection
@section('content')
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Edit  {{$type_name}}</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"> <a href="{{route('partner_doc_index' ,[$type_id ,$type_name])}}">Edit {{$type_name}}</a></li>
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
            <h3 class="block-title">Information</h3>
        </div>
        <div class="block-content">
            <form action="{{route('updatesaleKit')}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-lg-12">
                    <input type="hidden" name="update_id"  value="{{$sales_kits[0]->id}}">
                    <input type="hidden" name="typeId" id="typeId" value="{{$type_id}}">
                    <input type="hidden" name="typeName" id="typeName" value="{{$type_name}}">
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
                                foreach($sales_kits as $item2) { 
                                    if ($item->name == $item2->local) {
                                        $current = $item2;
                                        break;
                                    }
                                }
                              ?>
                            
                            <div class="tab-pane {{($loop->iteration == 1)?"active":""}}" id="btabs-alt-static-{{$item->name}}" role="tabpanel">
                                    <div class="form-group">
                                     <label for="example-select"><span class="req-fed">*</span>Name</label>
                                        <input type="text" class="form-control" name="name[{{$item->name}}]" placeholder="Enter Text..." value="{{isset($current->name)?$current->name :''  }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-select"> Old File</label>
                                        <a href="{{config('app.url')}}/medias/marketing_resources/{{isset($current->file) ? $current->file :''}}">{{isset($current->file) ? $current->file :''}}</a>
                                    </div>
                                      <input type="hidden"  name="oldfile[{{$item->name}}]" value="{{isset($current->file) ? $current->file :''}}">
                                    <div class="form-group">
                                        <label for="example-select">File <span class="req-fed">* Max File Size 20 MB</span></label>
                                        <div class="custom-file " style="width:100%;">
                                            <input type="file" class="custom-file-input" name="filesale[{{$item->name}}]"
                                                data-toggle="custom-file-input">
                                            <label class="custom-file-label" for="fileImage">Choose file</label>
                                        </div>
                                    </div>
                                   
                            </div> 
                            @endforeach
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="example-text-input"><span class="req-fed">*</span>Public Date</label>
                            <input type="text" class="js-datepicker form-control {{ $errors->has('date') ? 'is-invalid' : '' }}"  data-week-start="1" data-autoclose="true"
                                data-today-highlight="true" data-date-format="yyyy-mm-dd" value="{{$sales_kits[0]->date_info}}" placeholder="yyyy-mm-dd" name="date" required>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="text-center form-group mt-4">
                            <button class="btn btn-info" type="submit">Update </button>
                            <a href="{{route('partner_doc_index' ,[$type_id ,$type_name])}}" class="btn btn-secondary">
                                Cancel
                            </a>
                        </div>
                    </div>
                
            </form>
        </div>
    </div>
</div>
@endsection
@section('js')

@endsection
