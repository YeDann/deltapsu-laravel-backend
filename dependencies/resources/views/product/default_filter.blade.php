@extends('layouts.admin')
@section('style')

@endsection
@section('content')
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Default Filters</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <a href="{{route('subCategories')}}">All Product Categories</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Default Filters</li>
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
            <div class="block-title">
                    <form action="{{route('storeDefaultfiler')}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                <div class="row"> 
                        <div class="col-lg-5"> 
                      
                                <select class="form-control js-select2"  name="filername" >
                                       <option value="null">Select Filter </option>
                                        @foreach($section as $se)
                                     <option value="" disabled>{{$se->name}}</option>
                                        @foreach($pd_fields as $fields)
                                        @if($se->sectionId == $fields->section_id)
                                        <option value="{{$fields->pd_field_id}}|{{$fields->field_name}}" > &nbsp;&nbsp;{{$fields->field_name}}</option>
                                        @endif
                                        @endforeach
                                        @endforeach
                                        <option value=""disabled>Other</option>
                                        <option value="series01|Series" > &nbsp;&nbsp;Series</option>
                                        <option value="status02|Status" > &nbsp;&nbsp;Status</option>
                                        <option value="safety03|Safety" > &nbsp;&nbsp;Safety</option>
                                        <option value="certifi04|Certificate" > &nbsp;&nbsp;Certificate</option>
                                   </select>
                        </div>
                        <div class="col-lg-2"> 
                            <button type="submit" class="btn btn-success">ADD</button>
                        </div>
                </div>
                </form>
                
            </div>
            <div class="block-options">
                <div class="block-options-item ">
                  
                </div>
                
            </div>
        </div>
        <div class="block-content block-content-full">
 
            <table class="table table-bordered table-striped table-vcenter">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 5%;">No.</th>
                        <th class="d-none d-sm-table-cell" style="width: 20%;">Name</th>
                        <th style="width: 20%;" class="text-center">Manage</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($filter_pro) and !empty($filter_pro))
                    @foreach ($filter_pro as $item)
                   <tr class="odd order-list" data-id="{{$item->id}}">
                    <td class="text-center">{{$loop->iteration}}</td>
                    <td class="d-none d-sm-table-cell">{{$item->name}}</td>
                    <td class="text-center">
                        <a href="{{route('editFilterSelector' ,$item->id)}}" class="btn btn-outline-info">Edit</a>
                            <button type="button" class="btn btn-danger" onclick="ondelelete({{$item->id}});" data-toggle="modal" data-target="#modal-block-vcenter">Delete</button>
                    </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        {{-- <ul id="sortable">
                <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 1</li>
                <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 2</li>
                <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 3</li>
                <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 4</li>
                <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 5</li>
                <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 6</li>
                <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 7</li>
              </ul> --}}
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
                    <form action="{{route('deleteDefaultfilter')}}" method="POST" >
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
@endsection
@section('js')
<script>

    function ondelelete(id){
         $('#itemId').val(id);

    }

</script>
@endsection
