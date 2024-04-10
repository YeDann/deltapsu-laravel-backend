@extends('layouts.admin')
@section('style')

@endsection
@section('content')
<!-- Nav -->
<div class="bg-body-light">
  <div class="content content-full">
    <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
      <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Optional Models</h1>
      <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item active" aria-current="page">Optional Models</li>
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
        {{$products[0]->pro_code}}
      </h3>
      <div class="block-options">
        <div class="block-options-item">

        </div>
        <div class="block-options-item">
          {{-- <button data-toggle="modal" data-target="#modal-block-create_video" class="btn btn-success">Create
            Video</button>
          <button data-toggle="modal" data-target="#modal-block-create_Image" class="btn btn-success">Create
            Image</button> --}}
        </div>
      </div>
    </div>
    <div class="block-content block-content-full">
      <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
        <thead>
          <tr>
            <th class="text-center" style="width: 5%;">No.</th>
            <th class="d-none d-sm-table-cell" style="width: 20%;">Optional Models</th>
            <th class="d-none d-sm-table-cell" style="width: 20%;">Description</th>
            <th style="width: 20%;" class="text-center">Manage</th>
          </tr>
        </thead>
        <tbody>
          @if(isset($optional_models) and !empty($optional_models))
          @foreach ($optional_models as $item)
          <td class="text-center">{{$loop->iteration}}</td>
          <td class="d-none d-sm-table-cell">
            {{$item->optional_model}}
          </td>
          <td class="d-none d-sm-table-cell">
            {{$item->remark}}
          </td>
          <td class="text-center">

            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-block-update-optional"
              onclick="editContent({{$item->id}} ,'{{$item->optional_model}}','{{$item->remark}}')">Edit</button>
            <button type="button" class="btn btn-danger" onclick="ondelelete({{$item->id}});" data-toggle="modal"
              data-target="#modal-block-delete-file">Delete</button>

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
<div class="modal" id="modal-block-update-optional" tabindex="-1" role="dialog" aria-labelledby="modal-block-vcenter"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="block block-themed block-transparent mb-0">
        <div class="block-header bg-primary">
          <h3 class="block-title">Optional Models </h3>
          <div class="block-options">
            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
              <i class="fa fa-fw fa-times"></i>
            </button>
          </div>
        </div>
        <form action="{{route('saveOptionalModel')}}" method="POST">
          {{csrf_field()}}

          <div class="block-content">
            <input type="hidden" name="id" id="itemId">
            <input type="hidden" name="pro_id" value="{{$pro_id}}">

            <div class="form-group">
              <label>Optional Models</label>
              <input type="text" class="form-control" id="modelName" name="modelName" placeholder="Enter ...">
            </div>
            <div class="form-group">
              <label>Description</label>
              <input type="text" class="form-control" id="remark" name="remark" placeholder="Enter ...">
            </div>


          </div>
          <div class="block-content block-content-full text-right bg-light">
            <button type="button" class="btn  btn-light" data-dismiss="modal">Close</button>
            <button type="submit" id="savedata" class="btn btn-success ">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- END Vertically Centered Block Modal -->


<!-- Vertically Centered Block Modal -->
<div class="modal" id="modal-block-delete-file" tabindex="-1" role="dialog" aria-labelledby="modal-block-delete-file"
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
        <form action="{{route('deleteOptionalModel')}}" method="POST">
          {{csrf_field()}}

          <div class="block-content">
            <input type="hidden" name="itemId" id="itemIdDelete">
            <input type="hidden" name="pro_id" value="{{$pro_id}}">
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
  function editContent(id , model ,remark){
     $('#itemId').val(id);
     $('#modelName').val(model);
     $('#remark').val(remark);
     
      
    }
    function ondelelete(id){
         $('#itemIdDelete').val(id);

    }

</script>
@endsection