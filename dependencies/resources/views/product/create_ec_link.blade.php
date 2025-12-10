@extends('layouts.admin')
@section('style')

@endsection
@section('content')
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Create EC Link</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <a href="{{route('eclinklist')}}">All EC Links</a></li>
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
            <h3 class="block-title">EC Link</h3>
        </div>
        <div class="block-content">
            <form action="{{route('storeEcLink')}}" method="POST">
                {{csrf_field()}}
                <!-- Basic Elements -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="language"><span class="req-fed">*</span>Language</label>
                            <select name="language" class="form-control" required>
                                <option value="">Select Language</option>
                                @foreach ($language as $lang)
                                <option value="{{$lang->name}}">{{strtoupper($lang->name)}}</option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">Select the language for this EC Link button</small>
                        </div>
                        
                        <div class="form-group">
                            <label for="name"><span class="req-fed">*</span>Button Name</label>
                            <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                name="name" placeholder="Enter button display text..." required>
                            <small class="form-text text-muted">Enter the button text for the selected language</small>
                        </div>
                        
                        <div class="form-group">
                            <label for="note">Note</label>
                            <textarea class="form-control" name="note" rows="3" placeholder="Enter additional notes or description..."></textarea>
                            <small class="form-text text-muted">Optional notes for internal reference</small>
                        </div>
                        
                        <div class="form-group">
                            <label>Related Products</label>
                            <select id="relatePro" class="js-select2 form-control" name="relatePro[]"
                                data-placeholder="Choose products.." multiple>
                                <option></option>
                                @foreach ($products as $pro)
                                <option value="{{$pro->pro_id}}">{{$pro->pro_code}}</option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">Select products where this button should appear</small>
                        </div>

                        <div class="form-group">
                            <label for="link"><span class="req-fed">*</span>Button Link</label>
                            <input type="url" class="form-control {{ $errors->has('link') ? 'is-invalid' : '' }}"
                                name="link" placeholder="https://example.com" required>
                            <small class="form-text text-muted">Enter the URL that the button should link to</small>
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" class="form-control">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                            <small class="form-text text-muted">Set whether this EC Link is active or inactive</small>
                        </div>
                    </div>

                    <div class="col-lg-12 mt-5">
                        <div class="text-center form-group">
                            <button class="btn btn-success" type="submit">Create</button>
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