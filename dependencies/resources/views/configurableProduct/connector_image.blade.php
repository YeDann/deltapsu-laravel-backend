@extends('layouts.admin')
@section('style')

@endsection
@section('content')
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Connector Image(s) </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <a href="{{route('configurableProduct')}}">Configurable Power</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Connector Image(s)</li>
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
                <div class="block-options-item">
                
                </div>
                <div class="block-options-item">
                    <button type="button" class="btn btn-success"  onclick="createData();" data-toggle="modal" data-target="#modal-block-create_code">Create</button>
                </div>
            </div>
        </div>
        <div class="block-content block-content-full">
            <table class="table table-bordered table-striped table-vcenter">
                <thead>
                    <tr>
                        <th class="d-none d-sm-table-cell" style="width: 20%;">Conector Code</th>
                        <th style="width: 20%;" class="text-center">Manage</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($connectors as $item)
                    <tr>
                       <td class="text-center">{{$item->code}}</td>
                        <td class="text-center">
                            <button type="button" class="btn btn-danger" onclick="ondelelete({{$item->id}});" data-toggle="modal" data-target="#modal-block-vcenter">Delete</button>
                            <button type="button" class="btn btn-primary" onclick="edit({{$item->id}});" data-toggle="modal" data-target="#modal-block-create_code">Edit</button>
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

@endsection
