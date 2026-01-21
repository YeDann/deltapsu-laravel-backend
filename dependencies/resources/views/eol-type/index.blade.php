@extends('layouts.admin')
@section('style')

@endsection
@section('content')
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">EOL Type</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">EOL Type</li>
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
            <h3 class="block-title"><a href="{{route('eol.index')}}" class="btn btn-info" > <i class="fa fa-chevron-left"></i> EOL</a></h3>
            <div class="block-options">
                <div class="block-options-item">
                    <a href="{{route('eol-type.create')}}" class="btn btn-success">Create </a>
                    
                </div>
            </div>
        </div>
        <div class="block-content block-content-full">
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 5%;">No.</th>
                        <th class="d-none d-sm-table-cell" style="width: 30%;">Name</th>
                        <th class="d-none d-sm-table-cell" style="width: 10%;">Create At</th>
                        <th style="width: 10%;" class="text-center">Manage</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($contents) and !empty($contents))
                    @foreach ($contents as $item)
                    <tr>
                        <td class="text-center">{{$loop->iteration}}</td>
                        <td class="d-none d-sm-table-cell">{{$item->name}}</td>
                        <td class="font-w600">{{$item->created_at}}</td>
                        <td class="text-center">
                            <div class="">
                                <a href="{{route('eol-type.edit',$item->id)}}" class="btn btn-primary">Edit </a>
                                <button type="button" class="btn btn-danger" data-toggle="tooltip" id="delbutton"
                                    title="Delete" onclick="deleteEolType({{$item->id}})">
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
@endsection
@section('js')
<script>
    function deleteEolType(id) {
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
                    window.location = "{{ (route('destroyEolType')) }}/" + id;
                });
            }
        });
    }

</script>
@endsection
