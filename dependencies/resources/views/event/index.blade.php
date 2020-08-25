@extends('layouts.admin')
@section('style')

@endsection
@section('content')
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Event</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Event</li>
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
            <h3 class="block-title"></h3>
            <div class="block-options">
                {{-- <div class="block-options-item">
                    <button type="button" class="btn btn-secondary" data-toggle="modal"  data-target="#modal-block-popin">Duplicate All <i class="far fa-clone"></i></button>
                </div> --}}
                <div class="block-options-item">
                    <a href="{{route('event.create')}}" class="btn btn-success"><i class="fa fa-plus"></i> Create </a>
                    {{-- <a href="{{route('ImportEvent','event')}}" class="btn btn-info" > GET Data </a> --}}
                </div>
            </div>
        </div>
        <div class="block-content block-content-full">
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 5%;">No.</th>
                        <th class="d-none d-sm-table-cell" style="width: 30%;">Title</th>
                        <th class="d-none d-sm-table-cell text-center" style="width: 10%;">Status</th>
                        <th class="d-none d-sm-table-cell text-center" style="width: 10%;">Publish</th>
                        <th style="width: 10%;" class="text-center">Manage</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($contents) and !empty($contents))
                    @foreach ($contents as $item)
                    <td class="text-center">{{$loop->iteration}}</td>
                    <td class="d-none d-sm-table-cell">{{$item->title}}</td>
                    <td class="font-w600 text-center">
                            @if($item->status == "1")
                            <span class="badge badge-success text-uppercase">Show</span>
                            @elseif($item->status == "0")
                            <span class="badge badge-secondary text-uppercase">Hide</span>
                            @endif
                    </td>
                    <td class="font-w600 text-center">{{$item->date_publish}}</td>
                    <td class="text-center">
                        <div class="">
                            {{-- <button class="btn btn-secondary btn-sm"  
                                data-target="#modal-block-popin-2"  data-toggle="modal" onclick="sendId({{$item->id}})" >Duplicate <i class="far fa-clone"></i> </button> --}}
                                    <a href="{{route('event.edit',$item->id)}}" class="btn btn-primary btn-sm">Edit </a>
                            <button type="button" class="btn btn-sm btn-danger" data-toggle="tooltip" id="delbutton"
                                title="Delete" onclick="deleteIndex({{$item->id}})">
                                Delete
                            </button>
                        </div>
                    </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>


<!--Modal Language Single-->
<div class="modal fade" id="modal-block-popin" tabindex="-1" role="dialog" aria-labelledby="modal-block-popin"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-popin" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mt-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Select language</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <form action="{{route('copyEvent')}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="block-content">
                        <div class="block-options-item form-group">
                            <label for="">Select language for Duplicate</label>
                            <select name="language" id="" class="form-control">
                                @foreach ($language as $item)
                                <option value="{{$item->name}}">{{$item->abbreviation}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="block-content block-content-full text-right bg-light">
                        <button type="button" class="btn  btn-light" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn  btn-primary">Duplicate</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--End Modal Language-->

<!--Modal Language Single-->
<div class="modal fade" id="modal-block-popin-2" tabindex="-1" role="dialog" aria-labelledby="modal-block-popin"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-popin" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mt-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Select language</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <form action="{{route('copyEventsingle')}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="block-content">
                        <div class="block-options-item form-group">
                            <label for="">Select language for Duplicate</label>
                            <select name="language" id="" class="form-control">
                                @foreach ($language as $item)
                                <option value="{{$item->name}}">{{$item->abbreviation}}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" name="eventId" id="eventId" value="">
                    </div>
                    <div class="block-content block-content-full text-right bg-light">
                        <button type="button" class="btn  btn-light" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn  btn-primary">Duplicate</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--End Modal Language-->

@endsection
@section('js')
<script>
    function deleteIndex(id) {
        swal({
            title: "Confirm Delete",
            text: "You Are Delete this Data?",
            icon: "warning",
            buttons: [
                'Cancel',
                'Delete'
            ],
            dangerMode: true,
        }).then(function (isConfirm) {
            if (isConfirm) {
                swal({
                    title: 'Shortlisted!',
                    text: 'Candidates are successfully shortlisted!',
                    icon: 'success'
                }).then(function () {
                    window.location = "{{ (route('destroyEvent')) }}/" + id;
                });
            }
        });
    }


    function sendId(id){
        $("#eventId").val(id)
    }

</script>
@endsection
