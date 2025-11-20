@extends('layouts.admin')
@section('style')

@endsection
@section('content')
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Edit EC Link</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <a href="{{route('eclinklist')}}">All EC Links</a></li>
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
            <h3 class="block-title">EC Link</h3>
        </div>
        <div class="block-content">
            <form action="{{route('updateEcLink')}}" method="POST">
                {{csrf_field()}}
                <!-- Basic Elements -->
                <div class="row">
                    <div class="col-lg-12">
                        <input type="hidden" name="old_id" value="{{$item->id}}">
                        
                        <div class="block block-rounded block-bordered">
                            <ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs" role="tablist">
                                @foreach ($translations->sortBy('local') as $trans)
                                @if($trans->local == 'en')
                                <li class="nav-item">
                                    <a class="nav-link active" href="#btabs-alt-static-{{$trans->local}}" style="text-transform: capitalize;">{{$trans->local}}</a>
                                </li>
                                @else
                                <li class="nav-item">
                                    <a class="nav-link" href="#btabs-alt-static-{{$trans->local}}" style="text-transform: capitalize;">{{$trans->local}}</a>
                                </li>
                                @endif
                                @endforeach
                            </ul>
                            <div class="block-content tab-content">
                                @foreach ($translations->sortBy('local') as $trans)
                                @if($trans->local == 'en')
                                <div class="tab-pane active" id="btabs-alt-static-{{$trans->local}}" role="tabpanel">
                                    <div class="form-group">
                                        <label for="name_{{$trans->local}}"><span class="req-fed">*</span>Button Name</label>
                                        <input type="text" class="form-control {{ $errors->has('name_'.$trans->local) ? 'is-invalid' : '' }}"
                                            name="name_{{$trans->local}}" value="{{$trans->name}}" placeholder="Enter button display text..." required>
                                    </div>
                                </div>
                                @else
                                <div class="tab-pane" id="btabs-alt-static-{{$trans->local}}" role="tabpanel">
                                    <div class="form-group">
                                        <label for="name_{{$trans->local}}"><span class="req-fed">*</span>Button Name</label>
                                        <input type="text" class="form-control {{ $errors->has('name_'.$trans->local) ? 'is-invalid' : '' }}"
                                            name="name_{{$trans->local}}" value="{{$trans->name}}" placeholder="Enter button display text..." required>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label>Related Products</label>
                            <select id="relatePro" class="js-select2 form-control" name="relatePro[]"
                                data-placeholder="Choose products.." multiple>
                                <option></option>
                                @foreach ($products as $pro)
                                <option value="{{$pro->pro_id}}" {{in_array($pro->pro_id,$arrProduct )?'selected':'' }}
                                    >{{$pro->pro_code}}</option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">Select products where this button should appear</small>
                        </div>

                        <div class="form-group">
                            <label for="link"><span class="req-fed">*</span>Button Link</label>
                            <input type="url" class="form-control {{ $errors->has('link') ? 'is-invalid' : '' }}"
                                name="link" value="{{$item->link}}" placeholder="https://example.com" required>
                            <small class="form-text text-muted">Enter the URL that the button should link to</small>
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" class="form-control">
                                <option value="1" {{$item->status == 1 ? 'selected' : ''}}>Active</option>
                                <option value="0" {{$item->status == 0 ? 'selected' : ''}}>Inactive</option>
                            </select>
                            <small class="form-text text-muted">Set whether this EC Link is active or inactive</small>
                        </div>
                    </div>

                    <div class="col-lg-12 mt-5">
                        <div class="text-center form-group">
                            <button class="btn btn-primary" type="submit">Update</button>
                            <a href="{{route('eclinklist')}}" class="btn btn-secondary">
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
<script>
$(document).ready(function() {
    $('.js-select2').select2({
        placeholder: "Choose products..",
        allowClear: true
    });
});
</script>
@endsection