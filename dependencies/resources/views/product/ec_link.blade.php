@extends('layouts.admin')
@section('style')
    
@endsection
@section('content')
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">EC Link</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">EC Link</li>
                    <li class="breadcrumb-item active" aria-current="page">All Links</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- Content -->
<div class="content">
    <div class="block block-rounded block-bordered">
        <div class="block-header block-header-default d-flex justify-content-between">
            <h3 class="block-title">All EC Links</h3>
            <a href="{{route('createEcLink')}}" class="btn btn-success">Create</a>
        </div>
        <div class="block-content">
            <table class="table table-bordered table-striped table-vcenter" id="dataTables">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 80px;">#</th>
                        <th>Button Name</th>
                        <th>Language</th>
                        <th>Model Name</th>
                        <th>Link</th>
                        <th>Note</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th class="text-center" style="width: 100px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($list as $index => $item)
                    <tr>
                        <td class="text-center">{{$index + 1}}</td>
                        <td class="font-w600">{{$item->name}}</td>
                        <td>
                            <span class="badge badge-info">{{strtoupper($item->local)}}</span>
                        </td>
                        <td>
                            @if($item->product_names)
                                <span class="text-muted">{{$item->product_names}}</span>
                            @else
                                <span class="text-muted">No products</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{$item->link}}" target="_blank" class="text-primary">
                                {{Str::limit($item->link, 50)}}
                            </a>
                        </td>
                        <td>{{Str::limit($item->note ?? 'No note', 30)}}</td>
                        <td>
                            @if($item->status == 1)
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-secondary">Inactive</span>
                            @endif
                        </td>
                        <td>{{\Carbon\Carbon::parse($item->created_at)->format('Y-m-d H:i')}}</td>
                        <td class="text-center">
                            <a href="{{route('editEcLink', $item->id)}}" class="btn btn-primary" title="Edit">
                                Edit
                            </a>
                            <button type="button" class="btn btn-danger" data-toggle="tooltip" title="Delete" onclick="deleteEcLink({{$item->id}})">
                                Delete
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
@section('js')
<script>
$(document).ready(function () {
    $('#dataTables').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false
    });
});

function deleteEcLink(id) {
    swal({
        title: "Confirm Delete",
        text: "Are you sure you want to delete this EC Link?",
        icon: "warning",
        buttons: [
            'Cancel',
            'Delete'
        ],
        dangerMode: true,
    }).then(function (isConfirm) {
        if (isConfirm) {
            swal({
                title: 'Deleted!',
                text: 'EC Link has been successfully deleted!',
                icon: 'success'
            }).then(function () {
                window.location = "{{ route('deleteEcLink', '') }}/" + id;
            });
        }
    });
}
</script>
@endsection