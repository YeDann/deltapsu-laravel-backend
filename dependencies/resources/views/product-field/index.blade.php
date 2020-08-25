@extends('layouts.admin')
@section('style')

@endsection
@section('content')
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Product Field</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Product Field</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<!-- Content -->
<div class="content">
    @if(Session::has('flash_message'))
    <div class="alert alert-success" role="alert">
        <button class="close" data-dismiss="alert"></button>
        {!! Session('flash_message') !!}
    </div>
    @endif
    @if(Session::has('error_message'))
    <div class="alert alert-danger" role="alert">
        <button class="close" data-dismiss="alert"></button>
        {!! Session('error_message') !!}
    </div>
    @endif
    <div class="block block-rounded block-bordered">
        <div class="block-header block-header-default">
            <h3 class="block-title"></h3>
            <div class="block-options">
                <div class="block-options-item">
                    {{-- <button type="button" class="btn btn-secondary" data-toggle="modal"
                        data-target="#modal-block-popin">Duplicate All
                        <i class="far fa-clone"></i></button> --}}
                </div>
                <div class="block-options-item">
                    <a href="{{route('product-field.create')}}" class="btn btn-success">Create</a>
                </div>
            </div>
        </div>
        <div class="block-content block-content-full">
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 5%;">No.</th>
                        <th class="d-none d-sm-table-cell" style="width: 30%;">Title</th>
                        <th class="d-none d-sm-table-cell" style="width: 10%;">Type</th>
                        <th class="d-none d-sm-table-cell" style="width: 10%;">Section</th>
                        <th class="d-none d-sm-table-cell" style="width: 10%;">Create At</th>
                        <th style="width: 10%;" class="text-center">Manage</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($pd_field) and !empty($pd_field))
                    @foreach ($pd_field as $item)
                    <td class="text-center">{{$loop->iteration}}</td>
                    <td class="d-none d-sm-table-cell">{{$item->field_name}}</td>
                    <td class="d-none d-sm-table-cell">{{$item->type}}</td>
                    <td class="d-none d-sm-table-cell">{{$item->section_name}}</td>
                    <td class="font-w600">{{$item->created_at}}</td>
                    <td class="text-center">
                        <div class="">
                            {{-- <button class="btn btn-secondary " data-target="#modal-block-popin-2"
                                data-toggle="modal" onclick="sendId({{$item->pd_field_id}})">Duplicate  </button> --}}
                            <a href="{{route('product-field.edit',$item->pd_field_id)}}"
                                class="btn btn-primary">Edit </a>
                            <button type="button" class="btn btn-danger" data-toggle="tooltip" id="delbutton"
                                title="Delete" onclick="deleteProductfield({{$item->pd_field_id}})">
                                Delete 
                            </button>
                        </div>
                    </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

<!--Modal Language Multi-->
<div class="modal fade" id="modal-block-popin" tabindex="-1" role="dialog" aria-labelledby="modal-block-popin"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-popin" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Select language</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <form action="{{route('copyProductField')}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="block-content">
                        <div class="block-options-item form-group">
                            <label for="">Select language</label>
                            <select name="language" id="" class="form-control">
                                @foreach ($language as $item)
                                <option value="{{$item->name}}">{{$item->abbreviation}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="block-content block-content-full text-right bg-light">
                        <button type="button" class="btn  btn-light" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn  btn-primary">Duplicate</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--End Modal Language-->

<!--Modal Language Multi-->
<div class="modal fade" id="modal-block-popin-2" tabindex="-1" role="dialog" aria-labelledby="modal-block-popin"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-popin" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Select language</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <form action="{{route('copyProductFieldsingle')}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="block-content">
                        <div class="block-options-item form-group">
                            <label for="">Select language</label>
                            <select name="language" id="" class="form-control">
                                @foreach ($language as $item)
                                <option value="{{$item->name}}">{{$item->abbreviation}}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" id="pd_field_id" name="pd_field_id" value="">
                    </div>
                    <div class="block-content block-content-full text-right bg-light">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Duplicate</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--End Modal Language-->
@endsection
@section('js')
<script>
    function deleteProductfield(id) {
        swal({
            title: "Confirm Delete",
            text: "You Are Delete this Data?",
            icon: "warning",
            buttons: [
                'Cancel',
                'Delete'
            ],
            dangerMode: true,
        }).then(function (isConfirm) {
            if (isConfirm) {
                swal({
                    title: 'Shortlisted!',
                    text: 'Candidates are successfully shortlisted!',
                    icon: 'success'
                }).then(function () {
                    window.location = "{{ (route('productfieldDestroy')) }}/" + id;
                });
            }
        });
    }

    function sendId(id){
        $("#pd_field_id").val(id)
    }

</script>
@endsection
