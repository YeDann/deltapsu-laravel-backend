@extends('layouts.admin')
@section('style')
<style>
     .btn-pos{
        position: absolute;
        bottom: 0;
     }
    </style>
@endsection
@section('content')
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Feature Products</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Feature Products</li>
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
            {{-- <a class="mr-2" href="{{route('getAllProducts')}}">
                <button type="button" class="btn btn-success">Get Products</button>
            </a> --}}
            {{-- <a class="mr-2" href="{{route('getfeatureProduct')}}">
                    <button type="button" class="btn btn-success">Get featureProduct </button>
                </a>
         
            <a class="mr-2" href="{{route('getCreateDataFilter')}}">
                <button type="button" class="btn btn-success">Set Default filter</button>
            </a>
            <a class="mr-2" href="{{route('getAllSeries')}}">
                    <button type="button" class="btn btn-success">Get Series</button>
                </a>
             
                    <a class="mr-2" href="{{route('getProductFildData')}}">
                        <button type="button" class="btn btn-success">Get ProductFild</button>
                    </a> --}}

                    {{-- <a class="mr-2" href="{{route('getAllSubCategories')}}">
                        <button type="button" class="btn btn-success">Update series slug</button>
                    </a> --}}
                    {{-- <a class="mr-2" href="{{route('getAllSubCategories')}}">
                        <button type="button" class="btn btn-success">Update App</button>
                    </a> --}}
                    {{-- <a class="mr-2" href="{{route('getAllSubCategories')}}">
                        <button type="button" class="btn btn-success">Update Faq</button>
                    </a> --}}

               

                    
                
        </div>
        <div class="block-content block-content-full">
                <div class="mb-3"> 
                        <form action="{{route('setFeatureproducts')}}" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="col-lg-5">
                                    <label for="example-select">Select Feature Products <span class="req-fed">*</span></label>
                                    <select class="js-select2 form-control" id="pro_id" name="pro_id"
                                        data-placeholder="Choose one.." required>
                                        <option></option>
                                        @foreach($Allproducts as $pro)
                                        <option value="{{$pro->pro_id}}">{{$pro->pro_code}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-2">
                                    <button type="submit" class="btn btn-success btn-pos">ADD</button>
                                </div>
                            </div>
                        </form>
                </div>
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full ">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 5%;">No.</th>
                            <th class="d-none d-sm-table-cell" style="width: 20%;">Product Code</th>
                            <th class="d-none d-sm-table-cell" style="width: 10%;">create</th>
                            <th style="width: 20%;" class="text-center">Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($products) and !empty($products))
                        @foreach ($products as $item)
                        <td class="text-center">{{$loop->iteration}}</td>
                        <td class="d-none d-sm-table-cell">{{$item->pro_code}}</td>
                
                        <td class="d-none d-sm-table-cell">{{$item->created_at}}</td>
                        <td class="text-center">
                                {{-- <a href="{{route('editproduct' ,$item->pro_id)}}" class="btn btn-primary">Edit</a> --}}
                                <a href="{{route('unSetting' ,$item->pro_id)}}" class="btn btn-primary">Unpin</a>
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

@endsection
