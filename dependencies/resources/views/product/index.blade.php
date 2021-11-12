@extends('layouts.admin')
@section('style')

@endsection
@section('content')
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Products</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Products</li>
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
                    <a href="{{route('products.create')}}" class="btn btn-success">Create</a>
                    {{-- <a href="{{route('getExcelProduct')}}" class="btn btn-primary">Import Product Feild</a>
                 
                  <a href="{{route('getExcelProductCerti')}}" class="btn btn-primary">Import Certificate By Product</a> 
  
                  <a href="{{route('getExcelProCategories')}}" class="btn btn-outline-primary">Import Product Categories</a> --}}
                  {{-- <a href="{{route('getExcelProCategories')}}" class="btn btn-outline-primary">Import Product status</a> --}}

                       {{-- <a href="{{route('getExcelProTag')}}" class="btn btn-outline-primary">Import Product Tags</a> --}}

                    <a href="{{route('getExportProduct')}}" class="btn btn-outline-primary">Export Products</a>
                    <!-- <a href="{{route('getExportOldProduct')}}" class="btn btn-outline-primary">Export Old Products</a> -->
                    
                </div>
            </div>
        </div>
        <div class="block-content block-content-full">
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 5%;">No.</th>
                        <th class="d-none d-sm-table-cell" style="width: 10%;">Product Code</th>
                        <th class="d-none d-sm-table-cell" style="width: 5%;">Create</th>
                        <th class="d-none d-sm-table-cell" style="width: 5%;">Update</th>
                        <th style="width:20%;" class="text-center">Manage</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($products) and !empty($products))
                    @foreach ($products as $item)
                    <td class="text-center">{{$loop->iteration}}</td>
                    <td class="d-none d-sm-table-cell">{{$item->pro_code}}</td>
                    <td class="d-none d-sm-table-cell">{{$item->created_at}}</td>
                    <td class="d-none d-sm-table-cell">{{$item->updated_at}}</td>
                    <td class="text-center">
                            <a href="{{route('getDocument' ,$item->pro_id)}}" class="btn btn-outline-info">Documents</a>
                            <a href="{{route('duplicateProduct' ,$item->pro_id)}}" class="btn btn-outline-info">Duplicate</a>
                            <a href="{{route('videos_images' ,$item->pro_id)}}" class="btn btn-outline-info">Videos & Images</a>
                          
                                <a href="{{route('editproduct' ,$item->pro_id)}}" class="btn btn-primary">Edit</a>
                            <button type="button" class="btn btn-danger" onclick="ondelelete({{$item->pro_id}});" data-toggle="modal" data-target="#modal-block-vcenter">Delete</button>
                       
                    </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
 <!-- Vertically Centered Block Modal -->
 <div class="modal" id="modal-block-vcenter" tabindex="-1" role="dialog" aria-labelledby="modal-block-vcenter" aria-hidden="true">
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
                    <form action="{{route('deleteProduct')}}" method="POST" >
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
    <!-- END Vertically Centered Block Modal -->


@endsection
@section('js')
<script>


    function ondelelete(id){
         $('#itemId').val(id);

    }

</script>
@endsection
