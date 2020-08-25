@extends('layouts.admin')
@section('style')
  
    <style>
     
    </style>
@endsection
@section('content')
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Edit Series</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    @if($pro_cate_id != 0)
                    <li class="breadcrumb-item"> <a href="{{route('series_index',$pro_cate_id)}}">All Series</a></li>
                    @else 
                    <li class="breadcrumb-item"> <a href="{{route('series_all')}}">All Series</a></li>
                    @endif
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
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
            <form action="{{route('updateSeries')}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <!-- Basic Elements -->
              <input type="hidden" name="seriesId" value="{{$seriesId}}" >
              <input type="hidden" name="pro_cate_id" value="{{$pro_cate_id}}">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="block block-rounded block-bordered">
                            <ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs" role="tablist">
                                @foreach ($language as $item)
                                @if($loop->iteration == 1)
                                <li class="nav-item">
                                    <a class="nav-link active" href="#btabs-alt-static-{{$item->name}}"
                                        style="text-transform: capitalize;">{{$item->name}}</a>
                                </li>
                                @else
                                <li class="nav-item">
                                    <a class="nav-link " href="#btabs-alt-static-{{$item->name}}"
                                        style="text-transform: capitalize;">{{$item->name}}</a>
                                </li>
                                @endif
                                @endforeach
                            </ul>
                            <div class="block-content tab-content">
                                   
                                @foreach ($language as $item2)
                                <?php 
                                $current = null;
                                foreach($series as $item) { 
                                    if ($item2->name == $item->local) {
                                        $current = $item;
                                        break;
                                    }
                                }
                               ?>
                                <input type="hidden" name="lang_loop[]" value="{{$item2->name}}">
                                <div class="tab-pane {{($loop->iteration == 1) ?"active" :""}}" id="btabs-alt-static-{{$item2->name}}" role="tabpanel">
                                    <div class="form-group">
                                        <label for="example-select"><span class="req-fed">*</span>Name</label>
                                        <input type="text"
                                            class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                            name="name[{{$item2->name}}]" value="{{isset($current->title)? $current->title:""}}" placeholder="Enter name...">
                                    </div>
                                    <div class="form-group">
                                        <label for="example-select">Overview</label>
                                        <textarea rows="4" class="jsnotenew"
                                            name="overview[{{$item2->name}}]">{{isset($current->overview_content)? $current->overview_content:""}}</textarea>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12" style="margin-bottom: 20px">
                            <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-vcenter">
                                        <thead>
                                            <tr>
                                                <th class="text-center" style="width: 10px;">
                                                    File Type
                                                </th>
                                                <th class="text-center" style="width:400px;">
                                                     Old Image
                                                    </th>
                                              
                                                <th style="width: 300px;">Preview</th>
                                                <th style="width: 300px;">Update File <span class="req-fed">* File Max Size 2 MB</span></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center">
                                                        thumbnail
                                                </td>
                                                <td class="">
                                                        <img src="{{config('app.url')}}/medias/categories/{{$series[0]->image}}"
                                                            class="img-thumbnail res-image" alt="">
                                                            <input type="hidden" name="oldfile" value="{{$series[0]->image}}">
                                                    </td>
                                                <td class="">
                                                    <img src="https://via.placeholder.com/375x184.png"
                                                        class="img-thumbnail imagePreview2 res-image" alt="">
                                                </td>
        
                                                <td class="">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input"
                                                            data-toggle="custom-file-input" id="thumbnail" name="thumbnail"
                                                            value=" " accept="image/*">
                                                        <label id="label1" class="custom-file-label" for="thumbnail">Choose file</label>
                                                    </div>
                                                </td>
                                            </tr>
                                         
                                        </tbody>
                                    </table>
                                </div>
                    </div>
                    <div class="col-lg-8 pt-2">
                        <div class="form-group">
                                <label for="example-select">Main Categories</label>
                                <select class="js-select2 form-control" id="example-select2-multiple" name="mainCategories[]" style="width: 100%;" data-placeholder="Choose many.." multiple>
                                    <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                    @foreach ($mainCategories as $item)
                                    <option value="{{$item->main_id}}"  >{{$item->name}}</option>
                                    @endforeach

                                    @foreach ($mainCateInSection as $item)
                                   <option value="{{$item->main_id}}"  selected>{{$item->name}}</option>
                                   @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="d-block">Mode </span></label>
                                @foreach ($modeSeries as $mode)
                                <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                    <input type="radio" class="custom-control-input" id="status_mode{{$mode->id}}" name="status_mode" value="{{$mode->id}}"  {{ ($series[0]->mode_series == $mode->id ) ? 'checked' : '' }} >
                                    <label class="custom-control-label" for="status_mode{{$mode->id}}">{{$mode->name}}</label>
                                </div>
                               @endforeach
                            </div>
                      </div>
                    <div class="col-lg-8 pt-2">
                            <div class="form-group">
                                    <label for="example-select">Product Categories</label>
                                    <select class="js-select2 form-control" id="example-select2-multiple" name="productCategories[]" style="width: 100%;" data-placeholder="Choose many.." multiple>
                                        <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                        @foreach ($subCategories as $item)
                                        <option value="{{$item->sub_pro_id}}" >{{$item->name}}</option>
                                        @endforeach
                                        @foreach ($series_has_pro_categories as $cate)
                                        <option value="{{$cate->pro_categories_id}}"  selected>{{$cate->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                          </div>
                  
                    <div class="col-lg-8 pt-2">
                            <div class="form-group">
                                    <label for="example-select">Select Application Icon</label>
                                    <select class="js-select2 form-control" id="example-select2-multiple" name="aplication[]" style="width: 100%;" data-placeholder="Choose many.." multiple>
                                        <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                        @foreach ($applications as $item)
                                        <option value="{{$item->appId}}">{{$item->name}}</option>
                                        @endforeach
                                        @foreach ($series_has_application as $app)
                                        <option value="{{$app->app_id}}"  selected>{{$app->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                          </div>
                          <div class="col-lg-8 pt-2">
                          <div class="form-group">
                                <label class="d-block">Status</label>
                                <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                        <input type="radio" class="custom-control-input" id="status-1" name="status" value="1"  {{ ($series[0]->status == 1 ) ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="status-1">Show</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                        <input type="radio" class="custom-control-input" id="status-2" name="status" value="0" {{ ($series[0]->status == 0 ) ? 'checked' : '' }} >
                                        <label class="custom-control-label" for="status-2">Hide</label>
                                    </div>
                               
                            </div>
                          </div>
                       
                    <div class="col-lg-12">
                        <div class="text-center form-group">
                            <button class="btn btn-info" type="submit">Update </button>
                            @if($pro_cate_id != 0)
                            <a href="{{route('series_index',$pro_cate_id)}}" class="btn btn-secondary">
                                Cancel
                            </a>
                            @else 
                            <a href="{{route('series_all')}}" class="btn btn-secondary">
                                Cancel
                            </a>
                            @endif
                        </div>
                    </div>
                    <div style="padding-bottom: 155px"></div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
        $('.jssummernote').summernote({
          tabsize: 2,
          height: 200
        });
      </script>
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
        } else {
            alert('file is not accept!');
        }

    };

    $(document).on('change', '#thumbnail', function () {

        var FileSize = this.files[0].size / 1024 / 1024; // in MB
        if (FileSize > 2) {
            alert("File size exceeds 2 MB!");
            this.value = "";
            $('#label2').text('Choose file');
        }else{
            previewImage(this, $('.imagePreview2'));
        }

});

</script>
@endsection
