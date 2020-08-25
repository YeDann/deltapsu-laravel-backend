@extends('layouts.admin')
@section('style')

@endsection
@section('content')
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">                          
                Email Notification 
                @if($type == 1)
                By Country
                @elseif($type == 2)
                By Subject
                @elseif($type == 3)
                By Product type
                @endif
            </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
              
                    <li class="breadcrumb-item active" aria-current="page">
                        Email Notification List
                    </li>
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
                    
                    {{-- <a href="{{route('getEmailNotificationList')}}" class="btn btn-outline-primary">Import Email Notification List </a> --}}
           
                @if($type == 1)
                <a href="{{route('createEmail',$type)}}" class="btn btn-success">Create</a>
                @elseif($type == 2)
                @elseif($type == 3)
                <a href="{{route('createEmail',$type)}}" class="btn btn-success">Create</a>
                @endif
                </div>
            </div>
        </div>
       @if($type == 1)
        <div class="block-content block-content-full">
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 5%;">No.</th>
                        <th class="d-none d-sm-table-cell" style="width:10%;">Country</th>
                        <th class="d-none d-sm-table-cell" style="width: 30%;">Email (Feedback Form)*</th>
                        <th style="width: 30%;" class="text-center">Email (GUI Software Download)</th>
                        <th style="width: 10%;" class="text-center">Manage</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($emails) and !empty($emails))
                    @foreach ($emails as $item)
                    <td class="text-center">{{$loop->iteration}}</td>
                    <td class="d-none d-sm-table-cell">{{$item->country}}</td>
                    <td class="d-none d-sm-table-cell">{{$item->email}}</td>
                    <td class="d-none d-sm-table-cell">{{$item->email_gui}}</td>
                    <td class="text-center">
                            <a href="{{route('editEmail',[ $type ,$item->id ])}}" class="btn btn-primary">Edit</a>
                            <button type="button" class="btn btn-danger" onclick="ondelelete({{$item->id}});" data-toggle="modal" data-target="#modal-block-vcenter">Delete</button>
                           
                         
                    </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        @elseif($type == 2)
        <div class="block-content block-content-full">
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 5%;">No.</th>
                        <th class="d-none d-sm-table-cell" style="width: 30%;">Subject</th>
                        <th class="d-none d-sm-table-cell" style="width: 30%;">Email (Feedback Form)*</th>
                        <th style="width: 10%;" class="text-center">Manage</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($emails) and !empty($emails))
                    @foreach ($emails as $item)
                    <td class="text-center">{{$loop->iteration}}</td>
                    <td class="d-none d-sm-table-cell">
                        {{$item->subject == 0?'Sale Enquiries':''}}
                        {{$item->subject == 1?'Products and Service Support':''}}
                        {{$item->subject == 2?'General Comments':''}}
                    </td>
                    <td class="d-none d-sm-table-cell">{{$item->email}}</td>
           
                    <td class="text-center">
                            <a href="{{route('editEmail',[ $type ,$item->id ])}}" class="btn btn-primary">Edit</a>
                           
                    </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        @elseif($type == 3)
        <div class="block-content block-content-full">
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 5%;">No.</th>
                        <th class="d-none d-sm-table-cell" style="width: 30%;">Product Type</th>
                        <th class="d-none d-sm-table-cell" style="width: 30%;">Email (Feedback Form)*</th>
                        <th style="width: 10%;" class="text-center">Manage</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($emails) and !empty($emails))
                    @foreach ($emails as $item)
                    <td class="text-center">{{$loop->iteration}}</td>
                    <td class="d-none d-sm-table-cell">{{$item->catename}}</td>
                    <td class="d-none d-sm-table-cell">{{$item->email}}</td>
           
                    <td class="text-center">
                            <a href="{{route('editEmail',[ $type ,$item->id ])}}" class="btn btn-primary">Edit</a>
                            <button type="button" class="btn btn-danger" onclick="ondelelete({{$item->id}});" data-toggle="modal" data-target="#modal-block-vcenter">Delete</button>
                    </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        @endif
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
                    <form action="{{route('deleteEmailNotification')}}" method="POST" >
                        {{csrf_field()}}
                      
                    <div class="block-content">
                   <input type="hidden" name="itemId" id="itemId">
                    <input type="hidden" name="type" value="{{$type}}">
                        
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
