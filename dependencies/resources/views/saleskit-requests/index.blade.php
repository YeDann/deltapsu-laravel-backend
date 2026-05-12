@extends('layouts.admin')
@section('content')
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Sales Kit Downloads</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Sales Kit Downloads</li>
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
            <h3 class="block-title"></h3>
            <div class="block-options">
                <a href="{{ route('saleskit_requests_export') }}" class="btn btn-primary">Export Data</a>
            </div>
        </div>
        <div class="block-content block-content-full">
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                <thead>
                    <tr>
                        <th style="width:4%;" class="text-center">No.</th>
                        <th style="width:12%;">Name</th>
                        <th style="width:16%;">Email</th>
                        <th style="width:14%;">Company</th>
                        <th style="width:10%;">Phone</th>
                        <th style="width:6%;" class="text-center">Locale</th>
                        <th style="width:14%;" class="text-center">Application</th>
                        <th style="width:14%;" class="text-center">Created At</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($records as $item)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->company }}</td>
                        <td>{{ $item->phone ?? '-' }}</td>
                        <td class="text-center">{{ $item->locale }}</td>
                        <td class="text-center"><span class="badge badge-info">{{ $item->application }}</span></td>
                        <td class="text-center">{{ $item->created_at }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="8" class="text-center">No records found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
