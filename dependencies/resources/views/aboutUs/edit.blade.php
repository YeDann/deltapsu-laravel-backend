@extends('layouts.admin')
@section('style')

@endsection
@section('content')
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">AboutUs</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <a href="{{route('AboutUs.index')}}">All AboutUs</a></li>
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
            <form action="{{route('AboutUsUpdate')}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <!-- Basic Elements -->
            <input  type="hidden" name="abt_id" value="{{$contents[0]->abt_id}}">
                <div class="row">
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
                                foreach($contents as $item2) { 
                                    if ($item->name == $item2->local) {
                                        $current = $item2;
                                        break;
                                    }
                                }
                              ?>
                            
                                <input type="hidden" name="lang_loop[]" value="{{$item->name}}">
                             
                               <div class="tab-pane {{($loop->iteration == 1)?"active":""}}" id="btabs-alt-static-{{$item->name}}" role="tabpanel">
                                    <div class="form-group">
                                        <label for="example-select"><span class="req-fed">*</span>Title</label>
                                        <input type="text"
                                            class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                            name="title[{{$item->name}}]" value="{{isset($current->title) ? $current->title :''}}" placeholder="Enter title..." >
                                    </div>
                                    <div class="form-group">
                                        <label for="example-select">Content</label>
                                        <textarea rows="4"  class="jsnotenew"
                                            name="content[{{$item->name}}]">{{isset($current->content) ? $current->content :''}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Meta - Title</label>
                                        <input type="text" class="form-control" name="metaTitle[{{$item->name}}]" value="{{isset($current->metaTitle) ? $current->metaTitle :''}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Meta - Description</label>
                                        <textarea name="metaDescription[{{$item->name}}]" class="form-control">{{isset($current->metaDescription) ? $current->metaDescription :''}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Meta - Keywords</label>
                                        <textarea name="metaKeyword[{{$item->name}}]" class="form-control ">{{isset($current->metaKeyword) ? $current->metaKeyword :''}}</textarea>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
              
                    <div class="col-lg-12 ">
                            {{-- <div class="form-group">
                                    <label for="example-select">Content Type</label>
                                    <select class="js-select2 form-control" id="example-select2-multiple" name="type_content" style="width: 100%;" data-placeholder="Choose one.." >
                                        <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                        <option value="1" {{($contents[0]->type_id == 1) ? "selected" :''}}>DeltaPSU (Power Supply Unit)</option>
                                        <option value="2" {{($contents[0]->type_id == 2) ? "selected" :''}}>Delta Group</option>
                                        <option value="3" {{($contents[0]->type_id == 3) ? "selected" :''}}>Delta R&D</option>
                                        <option value="3" {{($contents[0]->type_id == 4) ? "selected" :''}}>Global Operations</option>
                                    </select>
                                </div> --}}

                          </div>
                    <div class="col-lg-12 mt-5 mb-5">
                        <div class="text-center form-group">
                            <button class="btn btn-info" type="submit">Update </button>
                            <a href="{{route('AboutUs.index')}}" class="btn btn-secondary">
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
