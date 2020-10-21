@extends('layouts.admin')
@section('style')

@endsection
@section('content')
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Language</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Language</li>
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
                <div class="block-options-item">
                    <a href="{{route('language.create')}}" class="btn btn-success">Create Language </a>
                </div>
            </div>
        </div>
        <div class="block-content block-content-full">
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 5%;">No.</th>
                        <th class="d-none d-sm-table-cell" style="width: 30%;">Abbreviation</th>
                        <th class="d-none d-sm-table-cell" style="width: 10%;">Name</th>
                        <th class="d-none d-sm-table-cell" style="width: 10%;">Create At</th>
                    
                        <th style="width: 10%;" class="text-center">Hide/Show</th>
                        <th style="width: 10%;" class="text-center">Manage</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($language) and !empty($language))
                    @foreach ($language as $item)
                    <td class="text-center">{{$loop->iteration}}</td>
                    <td class="font-w600">{{$item->abbreviation}}</td>
                    <td class="d-none d-sm-table-cell">{{$item->name}}</td>
                    <td class="font-w600">{{$item->created_at}}</td>
                    <td class="text-center">
                        {{-- <a href="{{route('set' ,$item->sub_pro_id)}}" class="btn btn-primary">Show</a> --}}
                        <div class="custom-control custom-switch custom-control-lg mb-2">
                                <input type="checkbox" class="custom-control-input" id="statusCate{{$item->id}}" onchange="checkdata({{$item->id}});"  {{($item->status== 1)?'checked':''}}  {{($item->name == 'en')?'disabled':''}}>
                        <label class="custom-control-label" id="lablestatusCate{{$item->id}}" for="statusCate{{$item->id}}">{{$item->status == 1?'Show':'Hide'}}</label>
                            </div>
                    </td>
                    <td class="text-center">
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-danger"  onclick="deleteLanguage({{$item->id}})" {{$item->name == 'en'?'disabled':''}} >
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
@endsection
@section('js')
<script>
    function deleteLanguage(id) {
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
                    title: 'Alert!',
                    text: 'Are you sure to delete this item?',
                    icon: 'warning'
                }).then(function () {
                    window.location = "{{ (route('languageDestroy')) }}/" + id;
                });
            }
        });
    }

    function checkdata(id){
        $.ajax({
                url: "{{ (route('updateLangStatus')) }}/" + id,
                type: 'get',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                   console.log(data.data);
                   $('#lablestatusCate'+id).text(data.data);
                }
    
            });
    }

</script>
@endsection
