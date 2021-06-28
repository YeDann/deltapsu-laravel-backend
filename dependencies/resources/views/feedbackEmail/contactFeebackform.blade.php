@extends('layouts.admin')
@section('style')
<style>

    .Absolute-Center {
        position: relative;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -10%);
   }
}
</style>
@endsection
@section('content')
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Feedback Form </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Feedback Form</li>
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
            <div class="Absolute-Center">
                <select onchange="getFiler()" class="js-select2 form-control" id="pro_categories" name="categories_doc" data-placeholder="Filter By.." required>
                    <option></option>
                    <option value="0" {{isset($selecValue) &&  $selecValue == 'All' ? 'selected':'' }} >All</option>
                    <option value="Sale Enquiries" {{isset($selecValue) &&  $selecValue == 'Sale Enquiries' ? 'selected':'' }} >Sale Enquiries</option>
                    <option value="Products and Service Support" {{isset($selecValue) &&  $selecValue == 'Products and Service Support' ? 'selected':'' }}>Products and Service Support</option>
                    <option value="General Comments" {{isset($selecValue) &&  $selecValue == 'General Comments' ? 'selected':'' }} >General Comments</option> 
                </select>
            </div>
            <h3 class="block-title">
            </h3>
            <div class="block-options">
                <div class="block-options-item">
                
                </div>
                <div class="block-options-item">
                  <a href="{{route('exportfeedbackFrom',$selecValue)}}" class="btn btn-outline-primary">Export Data</a> 
                </div>
            </div>
        </div>
        <div class="block-content block-content-full">
            <table id="dtBasicExample" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th class="text-center">No.</th>
                        <th class="d-none d-sm-table-cell" >Subject</th>
                        <th class="d-none d-sm-table-cell">Email</th>
                        <th class="d-none d-sm-table-cell" >Name</th>
                        <th class="d-none d-sm-table-cell" >Country</th>
                        <th class="d-none d-sm-table-cell" >Type</th>
                        <th class="d-none d-sm-table-cell" >Model</th>
                        <th class="d-none d-sm-table-cell" >Created_at</th>
                        <th class="text-center">Config file</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($contactemail) and !empty($contactemail))
                    @foreach ($contactemail as $item)
                    <td class="text-center">{{$loop->iteration}}</td>
                    <td class="d-none d-sm-table-cell">{{$item->subject}}</td>
                    <td class="d-none d-sm-table-cell">{{$item->email}}</td>
                    <td class="d-none d-sm-table-cell">{{$item->name}}</td>
                    <td class="d-none d-sm-table-cell">{{$item->country}}</td>
                    <td class="d-none d-sm-table-cell">{{$item->type_name}}</td>
                    <td class="d-none d-sm-table-cell">{{$item->model_name}}</td>
                    <td class="d-none d-sm-table-cell">{{$item->created_at}}</td>
                    <td class="text-center">
                     @if(isset($item->file))
                    <a href="{{config('app.url')}}/config_history/{{$item->file}}"   target="_blank" class="btn btn-outline-primary">View</a>
                    @else 
                     No file
                      @endif
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
                    <form action="{{route('deleteConfigProduct')}}" method="POST" >
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
   function getFiler(){
        var value =  $('#pro_categories').val();
        if(value == 0){
            window.location = '{{route('feedbackform')}}/All';
        }else{
            window.location = '{{route('feedbackform')}}'+'/'+value;
        }
     
    }

    function ondelelete(id){
         $('#itemId').val(id);

    }

    $(document).ready(function () {
            $('#dtBasicExample').DataTable();
        });

</script>
@endsection
