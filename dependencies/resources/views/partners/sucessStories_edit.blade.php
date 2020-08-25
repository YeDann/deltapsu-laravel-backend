@extends('layouts.admin')
@section('style')

@endsection
@section('content')
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Edit Success Story</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <a href="{{route('successStory')}}">Success Stories</a></li>
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
            <form action="{{route('succes_stories_update')}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
            <input type="hidden" name="story_id_main" value="{{$AllsuccessStory[0]->id}}">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                        <label for="example-select"><span class="req-fed">*</span>Model Name</label>
                           <select class="js-select2 form-control" name="model[]" data-placeholder="Choose many.." required multiple>
                            <option></option>
                            @foreach ($products as $item)
                            @if(in_array($item->pro_code, $arrModel))
                            <option value="{{$item->pro_code}}" selected>{{$item->pro_code}}</option> 
                            @else 
                            <option value="{{$item->pro_code}}" >{{$item->pro_code}}</option> 
                            @endif   
                            @endforeach
                          </select>
                        </div>
                    </div>
                   
                    <div class="col-lg-12">
                        <div class="form-group">
                        <label for="example-select"><span class="req-fed">*</span>Application</label>
                        <input type="text" class="form-control" name="application" value="{{$AllsuccessStory[0]->application}}" placeholder="Enter text..." >
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                        <label for="example-select">End Customer <span class="req-fed">*</span></label>
                        <input type="text" class="form-control" name="endCustomer"  value="{{$AllsuccessStory[0]->endCustomer}}" placeholder="Enter text..." >
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                        <label for="example-select">Country <span class="req-fed">*</span></label>
                        <select name="country"   class="form-control" id="country"  required>
                            <option value="">Please Select</option>
                            @foreach ($countries as $country)
                            @if($AllsuccessStory[0]->country == $country->name )
                            <option value="{{$country->name}}" selected>{{$country->name}}</option> 
                            @else 
                            <option value="{{$country->name}}" >{{$country->name}}</option> 
                            @endif   
                            @endforeach
                        </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                        <label for="example-select">Message</label>
                        <textarea name="message" class="jsnotenew form-control"  placeholder="MESSAGE" rows="10" >{{$AllsuccessStory[0]->message}}</textarea>
                        </div>
                    </div>
                  
                    <div class="col-lg-12">
                        <div class="text-center form-group mt-4">
                            <button class="btn btn-info" type="submit">Update </button>
                            <a href="{{route('successStory')}}" class="btn btn-secondary">
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
<script>

    var previewImage = function (input, block) {
        var fileTypes = ['jpg', 'jpeg', 'png', 'gif', 'svg'];
        var extension = input.files[0].name.split('.').pop().toLowerCase(); /*se preia extensia*/
        var isSuccess = fileTypes.indexOf(extension) > -1; /*se verifica extensia*/

        if (isSuccess) {
            var reader = new FileReader();

            reader.onload = function (e) {
                block.attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
            return false;
        } else {
            alert('File is not expept!');
         
            return true;
        }

    };




    $(document).on('change', '#icon', function () {
        // alert(this.files[0].size);
        var FileSize = this.files[0].size / 1024 / 1024; // in MB
        if (FileSize > 2) {
            alert("File size exceeds 2 MB!");
            this.value = "";
            $('#label1').text('Choose file');
        }else{
            previewImage(this, $('.imagePreview1'));
        }
    });    
</script>
@endsection
