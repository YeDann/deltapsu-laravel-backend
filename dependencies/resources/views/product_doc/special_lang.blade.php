@extends('layouts.admin')
@section('style')

@endsection
@section('content')
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Special Languages</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Special Languages</li>
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
                <button type="button" class="btn btn-success"  data-toggle="modal" data-target="#modal-block-create">Create</button>
                </div>
            </div>
        </div>
        <div class="block-content block-content-full">
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 5%;">No.</th>
                        <th class="d-none d-sm-table-cell" style="width: 10%;">Short Name</th>
                        <th class="d-none d-sm-table-cell" style="width: 10%;">Full Name</th>
                        <th style="width: 20%;" class="text-center">Manage</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($secial_langs) and !empty($secial_langs))
                    @foreach ($secial_langs as $item)
                    <td class="text-center">{{$loop->iteration}}</td>
                    <td class="d-none d-sm-table-cell">{{$item->name}}</td>
                    <td class="d-none d-sm-table-cell">{{$item->full_name}}</td>
                    <td class="text-center">
                        <button type="button" class="btn btn-primary" onclick="edit({{$item->id}} ,'{{$item->name}}','{{$item->full_name}}' );" data-toggle="modal" data-target="#modal-block-edit">Edit</button>
                        <button type="button" class="btn btn-danger" onclick="ondelelete({{$item->id}},'{{$item->name}}');" data-toggle="modal" data-target="#modal-block-vcenter">Delete</button>
                       
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
                    <form action="{{route('deleteSpecailLang')}}" method="POST" >
                        {{csrf_field()}}
                      
                    <div class="block-content">
                        <input type="hidden" name="itemId" id="itemId">
                        <input type="hidden" name="itemName" id="itemName">
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

     <!-- Vertically Centered Block Modal -->
 <div class="modal" id="modal-block-edit" tabindex="-1" role="dialog" aria-labelledby="modal-block-edit" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Update Language </h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <form action="{{route('Update_spelang')}}" method="POST" >
                    {{csrf_field()}}
                  
                <div class="block-content">
                    <div class="form-group">
                        <label for="example-select">Language</label>
                        <input type="hidden" id="langId"  name="langId">
                        <input type="text" class="form-control"  id="langName"   name="langName" placeholder="Enter text...">
                    </div>
                  
                    <div class="form-group">
                        <label for="example-select">Language (full Name )</label>
                        <input type="text" class="form-control" id="fulname"  name="full_name" placeholder="Enter text...">
                    </div>
                 
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
     <!-- Vertically Centered Block Modal -->
     <div class="modal" id="modal-block-create" tabindex="-1" role="dialog" aria-labelledby="modal-block-create" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary">
                        <h3 class="block-title">Create Special Language</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <form action="{{route('store_spelang')}}" method="POST" >
                        {{csrf_field()}}
                      
                    <div class="block-content">
                        <div class="form-group">
                            <label for="example-select">Language (Short Name Ex. en ,th ,jw ...)</label>
                            <input type="text" class="form-control"   name="langName" placeholder="Enter text...">
                        </div>
                        <div class="form-group">
                            <label for="example-select">Language (full Name )</label>
                            <input type="text" class="form-control"  name="full_name" placeholder="Enter text...">
                        </div>
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
    function edit(id ,name, fulname){
        //  console.log(id);
         $('#langId').val(id);
         $('#langName').val(name);
         $('#fulname').val(fulname);
    }  

    function ondelelete(id ,name){
         $('#itemId').val(id);
         $('#itemName').val(name);
         

    }
 

</script>
@endsection
