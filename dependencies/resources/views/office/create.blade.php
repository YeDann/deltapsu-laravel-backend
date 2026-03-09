@extends('layouts.admin')
@section('style')

@endsection
@section('content')
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Create </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page"><a href="{{route('getContinent' ,$type_id)}}">Continents</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="{{route('getOffices',['contentId'=>$conid , 'type_id'=>$type_id])}}">
                            @if($type_id == 1)
                            Sales Offices
                            @else 
                            Distributors
                            @endif
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Create</li>
                    </ol>
                    
             
            </nav>
        </div>
    </div>
</div>
<!-- Content -->
<div class="content">
    <div class="block block-rounded block-bordered">
        <div class="block-header block-header-default">
            <h3 class="block-title">Information</h3>
        </div>
        <div class="block-content">
            <form action="{{route('storeOffices')}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <input type="hidden" class="form-control" name="type_id" value="{{$type_id}}">
               <input type="hidden" class="form-control" name="con_id" value="{{$conid}}">
                <!-- Basic Elements -->
                @foreach ($language as $item)
                <input type="hidden" name="lang_loop[]" value="{{$item->name}}">
                @endforeach
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="example-select">Title </label>
                            <input type="text" class="form-control" name="title" placeholder="Enter Text" >
                        </div>
                        <div class="form-group">
                                <label for="example-select">Sub Title</label>
                                <input type="text" class="form-control " name="sub_title" placeholder="Enter Text" >
                        </div>
                        <div class="form-group">
                                <label for="example-select">Content</label>
                                <textarea name="content"class="jsnotenew"></textarea>
                        </div>
                        @if($type_id == 2)
                        <div class="form-group">
                            <label for="example-select">File Certificate</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="filecer" data-toggle="custom-file-input" id="file_input" >
                                <label class="custom-file-label" for="file_input">Choose file</label>
                              
                            </div>
                       </div>
                       <div class="form-group">
                        <label class="d-block">Certificate Status</label>
                        <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                <input type="radio" class="custom-control-input" id="status-cer1" name="status_cer" value="1" checked>
                                <label class="custom-control-label" for="status-cer1">Show Certificate</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                <input type="radio" class="custom-control-input" id="status-cer2" name="status_cer" value="0" >
                                <label class="custom-control-label" for="status-cer2">Hide Certificate</label>
                            </div>
                    </div>
                       @endif
                        <div class="form-group">
                                <label class="d-block">Show</label>
                                <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                        <input type="radio" class="custom-control-input" id="status-1" name="status" value="1" checked>
                                        <label class="custom-control-label" for="status-1">Show</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                        <input type="radio" class="custom-control-input" id="status-2" name="status" value="0" >
                                        <label class="custom-control-label" for="status-2">Hide</label>
                                    </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-10 col-md-offset-1">
                                    <label for="titleen" class="control-label">Location *</label>
                                    <input type="text" id="us2-address" class="form-control" />
                                    <div id="us2" style="width: 100%; height: 500px;"></div>
                                </div>
                            </div>
                
                            <div class="form-group">
                                <label for="titleen" class="col-md-2 control-label">Latitude *</label>
                                <div class="col-md-6">
                                    <input type="text" id="us2-lat" name="lat" class="form-control" />
                                </div>
                            </div>
                
                            <div class="form-group">
                                    <label for="titleen" class="col-md-2 control-label">Longitude *</label>
                                    <div class="col-md-6">
                                        <input type="text" id="us2-lon" name="lon" class="form-control" />
                                    </div>
                            </div>
                        <div class="text-center mb-3">
                            <button class="btn btn-success col-md-1" type="submit" >Create  </button>
                            <a href="{{route('getOffices',['contentId'=>$conid , 'type_id'=>$type_id])}}"  class="btn btn-secondary col-md-1">
                                Cancel 
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('js')
<script type="text/javascript" src='https://maps.google.com/maps/api/js?key=AIzaSyCPBj3pIdKpOMbIL4cChrzX_OJZSkaxIvM
&sensor=false&libraries=places'></script>
    <script src="https://cdn.jsdelivr.net/gh/Logicify/jquery-locationpicker-plugin@master/dist/locationpicker.jquery.min.js"></script>
<script>
    $('#us2').locationpicker({
        location:{
            latitude: 13.76761,
            longitude: 100.57118600000001
        },
        enableAutocomplete: true,
        enableReverseGeocode: true,
        radius: 0,
        inputBinding: {
            latitudeInput: $('#us2-lat'),
            longitudeInput: $('#us2-lon'),
            radiusInput: $('#us2-radius'),
            locationNameInput: $('#us2-address')
        },
        onchanged: function (currentLocation, radius, isMarkerDropped) {
            var addressComponents = $(this).locationpicker('map').location.addressComponents;
            console.log(currentLocation);  //latlon
            updateControls(addressComponents); //Data
        }
    });

    function updateControls(addressComponents) {
        console.log(addressComponents);
    }
</script>
@endsection
