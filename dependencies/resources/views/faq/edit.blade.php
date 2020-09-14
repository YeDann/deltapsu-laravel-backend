@extends('layouts.admin')
@section('style')

@endsection
@section('content')
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Edit Faqs</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <a href="{{route('Faq.index')}}">All Faqs</a></li>
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
            <h3 class="block-title">FAQs</h3>
        </div>
        <div class="block-content">
            <form action="{{route('updateFaq')}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
            <input type="hidden" name="faq_id" value="{{$faqs[0]->id}}">
                <!-- Basic Elements -->
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
                                foreach($faqs as $item2) { 
                                    if ($item->name == $item2->local) {
                                        $current = $item2;
                                        break;
                                    }
                                }
                           ?>
                                <input type="hidden" name="lang_loop[]" value="{{$item->name}}">
                                <div class="tab-pane {{($loop->iteration == 1)?"active":""}}" id="btabs-alt-static-{{$item->name}}" role="tabpanel">
                                        <div class="form-group">
                                            <label for="example-select">Title</label>
                                            <input type="text"
                                                class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                        name="name[{{$item->name}}]" value="{{isset($current->title)? $current->title:""}}" placeholder="Enter name...">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Content</label>
                                            <textarea name="content[{{$item->name}}]"class="js-summernote">{{isset($current->content)? $current->content:""}}</textarea>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                           
                        </div>
                        <div class="form-group">
                                <label for="example-select">Select Categories <span class="req-fed">*</span></label>
                                <select class="js-select2 form-control" name="faq_categories" data-placeholder="Choose one.." required>
                                        <option></option>
                                    @foreach ($faq_categories as $item)
                                    @if($item->cate_id == $faqs[0]->cate_id)
                                    <option value="{{$item->cate_id}}"selected>{{$item->name}}</option>
                                    @else 
                                    <option value="{{$item->cate_id}}">{{$item->name}}</option>
                                    @endif
                                    @endforeach
                                </select>
                                </div>
                        <div class="form-group">
                            <label class="d-block">Status</label>
                            <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                    <input type="radio" class="custom-control-input" id="status-1" name="status" value="1" {{$faqs[0]->status == 1 ?"checked":""}} >
                                    <label class="custom-control-label" for="status-1">Show</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                    <input type="radio" class="custom-control-input" id="status-2" name="status" value="0" {{$faqs[0]->status == 0 ?"checked":""}}>
                                    <label class="custom-control-label" for="status-2">Hide</label>
                                </div>
                           
                        </div>
                        <div class="text-center form-group">
                            <button class="btn btn-info" type="submit">Update </button>
                            <a href="{{route('Faq.index')}}" class="btn btn-secondary">
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
