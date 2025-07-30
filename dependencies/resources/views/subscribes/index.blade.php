@extends('layouts.admin')
@section('style')
<style>
/* Pagination custom styling */
.pagination {
    margin: 0px 5px;
}
.pagination .page-link {
    color: #007bff;
    border: 1px solid #dee2e6;
    padding: 0.5rem 0.75rem;
}
.pagination .page-item.active .page-link {
    background-color: #007bff;
    border-color: #007bff;
    color: white;
}
.pagination .page-item.disabled .page-link {
    color: #6c757d;
    pointer-events: none;
    background-color: #fff;
    border-color: #dee2e6;
}

</style>
@endsection
@section('content')
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Subscribes</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Subscribes</li>
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
            <h3 class="block-title">

            </h3>
            <div class="block-options">
                {{-- <a href="{{route('getpageSubscriber')}}" class="btn btn-primary">Import Data ( not Support changePHPv8)</a> --}}
                {{--<a href="{{route('getpageSubscriber')}}" class="btn btn-primary">Import data country mail ( not Support changePHPv8) </a>--}}
                <a href="{{route('exportSubscribes')}}" class="btn btn-primary">Export Data</a>


            </div>
        </div>
        <div class="block-content block-content-full">
            <table class="table table-bordered table-striped table-vcenter">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 5%;">No.</th>
                        <th class="d-none d-sm-table-cell text-center" style="width: 10%;">Email</th>
                        <th class="d-none d-sm-table-cell" style="width: 10%;">CountryName</th>
                        <th class="d-none d-sm-table-cell text-center" style="width: 10%;">Name</th>
                        <th class="d-none d-sm-table-cell text-center" style="width: 10%;">Accept Privacy Policy</th>
                        <th class="d-none d-sm-table-cell text-center" style="width: 10%;">Created At</th>
                        {{-- <th style="width: 10%;" class="text-center">Manage</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @if(isset($subscribes) and !empty($subscribes))
                    @foreach ($subscribes as $item)
                    <td class="text-center">{{$loop->iteration}}</td>
                    <td class="d-none d-sm-table-cell">{{$item->email}}</td>
                    <td class="d-none d-sm-table-cell">{{$item->country_name}}</td>
                    <td class="d-none d-sm-table-cell">{{$item->name}}</td>


                    <td class="font-w600 text-center">
                        @if($item->accept == 1)
                        <span class="badge badge-success text-uppercase">Accepted</span>
                        @else
                        <span class="badge badge-secondary text-uppercase">Not accept</span>
                        @endif
                    </td>
                    <td class="font-w600 text-center">{{$item->created_at}}</td>
                    {{-- <td class="text-center">
                        <div class="">

                            <button type="button" class="btn btn-danger" onclick="ondelelete({{$item->id}});"
                                data-toggle="modal" data-target="#modal-block-vcenter">Delete</button>
                        </div>
                    </td> --}}
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        <div class="d-flex justify-content-center">
                {{ $subscribes->links('pagination.custom') }}
            </div>
        </div>
    </div>
</div>
{{--
<!-- Vertically Centered Block Modal -->
<div class="modal" id="modal-block-vcenter" tabindex="-1" role="dialog" aria-labelledby="modal-block-vcenter"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-danger">
                    <h3 class="block-title">!! Warning </h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <form action="{{route('destroySubscribes')}}" method="POST">
                    {{csrf_field()}}

                    <div class="block-content">
                        <input type="hidden" name="itemId" id="itemId">
                        <p>Data will be lost?</p>
                    </div>
                    <div class="block-content block-content-full text-right bg-light">
                        <button type="button" class="btn  btn-light" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">OK</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- END Vertically Centered Block Modal --> --}}

@endsection
@section('js')

@endsection
