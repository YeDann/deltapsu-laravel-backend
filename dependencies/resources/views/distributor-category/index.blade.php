@extends('layouts.admin')
@section('content')
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">{{ $typeLabel }}</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">{{ $typeLabel }}</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="content">
    @if(Session::has('flash_message'))
    <div class="alert alert-success" role="alert">
        <button class="close" data-dismiss="alert"></button>
        {!! Session('flash_message') !!}
    </div>
    @endif
    <div class="block block-rounded block-bordered">
        <div class="block-header block-header-default">
            <h3 class="block-title">{{ $typeLabel }}</h3>
            <div class="block-options">
                <div class="block-options-item">
                    <a href="{{route('distributorCategory.create', $type)}}" class="btn btn-success">Create</a>
                </div>
            </div>
        </div>
        <div class="block-content block-content-full">
            <table class="table table-bordered table-striped table-vcenter">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 5%;">No.</th>
                        <th style="width: 30%;">Name (EN)</th>
                        @if($type === 'sales_territory')<th style="width: 15%;">Region</th>@endif
                        <th style="width: 10%;">Order</th>
                        <th style="width: 10%;">Status</th>
                        <th style="width: 15%;" class="text-center">Manage</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($contents))
                    @foreach ($contents as $item)
                    <tr>
                        <td class="text-center">{{$loop->iteration}}</td>
                        <td>{{$item->name}}</td>
                        @if($type === 'sales_territory')<td>{{ isset($continents[$item->continent_id]) ? $continents[$item->continent_id]->name : '-' }}</td>@endif
                        <td>{{$item->order_seq}}</td>
                        <td>{{ $item->status ? 'Show' : 'Hide' }}</td>
                        <td class="text-center">
                            <a href="{{route('distributorCategory.edit', [$type, $item->id])}}" class="btn btn-primary">Edit</a>
                            <button type="button" class="btn btn-danger" onclick="deleteDistCat({{$item->id}})">Delete</button>
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
    function deleteDistCat(id) {
        swal({
            title: "Confirm Delete",
            text: "刪除此選項會同時移除所有經銷商對它的勾選，確定？",
            icon: "warning",
            buttons: ['Cancel', 'Delete'],
            dangerMode: true,
        }).then(function (isConfirm) {
            if (isConfirm) {
                window.location = "{{ url('backend/distributorCategoryDestroy/'.$type) }}/" + id;
            }
        });
    }
</script>
@endsection
