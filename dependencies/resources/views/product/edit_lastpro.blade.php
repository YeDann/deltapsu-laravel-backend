@extends('layouts.admin')
@section('style')

@endsection
@section('content')
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Update Latest Product</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <a href="{{route('lastetproducts')}}">All Latest</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Update</li>
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
            <form action="{{route('UpdateLastProduct')}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <!-- Basic Elements -->
                <input type="hidden" value="{{$last_products[0]->id}}" name="lastproId">
                <div class="row">
                    <div class="col-lg-12">
                        <span class="req-fed">*Plase select option</span>
                        <div class="form-group">
                            <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                <input type="radio" class="custom-control-input" onchange="selectdataOption(1);"
                                    id="status-1" name="status" value="1" {{ ($last_products[0]->status == 1) ?
                                "checked" :'' }} required>
                                <label class="custom-control-label" for="status-1">1. Auto System push Product to Banner
                                    Option</label>
                            </div>

                        </div>
                        <div class="form-group">
                            <select class="js-select2 form-control" id="js_product_id" name="productId"
                                style="width: 100%;" data-placeholder="Choose Product..">
                                <option></option>
                                <!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                @foreach ($product as $item)
                                @if($last_products[0]->product_id == $item->pro_id )
                                <option value="{{$item->pro_id}}" selected>{{$item->pro_code}}</option>
                                @else
                                <option value="{{$item->pro_id}}">{{$item->pro_code}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                <input type="radio" class="custom-control-input" onchange="selectdataOption(2);"
                                    id="status-2" name="status" value="2" {{ ($last_products[0]->status == 2) ?
                                "checked" :'' }} required>
                                <label class="custom-control-label" for="status-2">2. Customize Option</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="example-colorpicker2">Background Color</label>
                            <div class="js-colorpicker input-group" data-format="hex">
                                <input type="text" class="form-control" id="example-colorpicker2" name="bg_color"
                                    value="{{$last_products[0]->bg_color}}">
                                <div class="input-group-append">
                                    <span class="input-group-text colorpicker-input-addon">
                                        <i></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="example-colorpicker2">Title Text Color</label>
                            <div class="js-colorpicker input-group" data-format="hex">
                                <input type="text" class="form-control" id="example-colorpicker2" name="title_color"
                                    value="{{$last_products[0]->title_color}}">
                                <div class="input-group-append">
                                    <span class="input-group-text colorpicker-input-addon">
                                        <i></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="example-colorpicker3">Description Text Color</label>
                            <div class="js-colorpicker input-group" data-format="hex">
                                <input type="text" class="form-control" id="example-colorpicker3" name="text_color"
                                    value="{{$last_products[0]->text_color}}">
                                <div class="input-group-append">
                                    <span class="input-group-text colorpicker-input-addon">
                                        <i></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                        foreach($last_products as $item) { 
                                            if ($item2->name == $item->local) {
                                                $current = $item;
                                                break;
                                            }
                                        }
                                    ?>
                                <input type="hidden" name="lang_loop[]" value="{{$item2->name}}">
                                <div class="tab-pane  {{$item2->name == $language[0]->name ? 'active show' : ''}}"
                                    id="btabs-alt-static-{{$item2->name}}" role="tabpanel">
                                    {{-- {{
                                    json_encode($current) }}
                                    <div>{{isset($current->local) ? $current->local : 'no local'}}</div> --}}
                                    <p>*Use "Enter" to Begin a new row</p>
                                    <div class="form-group">
                                        <label for="example-select">Title</label>
                                        <textarea name="title[{{$item2->name}}]"
                                            class="form-control">{{isset($current->title) ? $current->title : ''}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-select">Description</label>
                                        <textarea name="content[{{$item2->name}}]" rows="4"
                                            class="form-control">{{isset($current->description) ? $current->description : ''}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-select">Link</label>
                                        <input type="text" name="link[{{$item2->name}}]"
                                            value="{{isset($current->link) ? $current->link : ''}}"
                                            class="form-control">
                                    </div>
                                </div>

                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-vcenter">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 10px;">
                                            File Type
                                        </th>
                                        <th style="width: 300px;">Old Image</th>
                                        <th style="width: 300px;">Preview</th>
                                        <th style="width: 300px;">Upload File <span class="req-fed">* File Max Size 2
                                                MB</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">
                                            thumbnail
                                        </td>
                                        <td class="">
                                            <img src="{{config('app.url')}}/medias/categories/{{$last_products[0]->image}}"
                                                class="img-thumbnail res-image" alt="">
                                            <input type="hidden" name="oldfile" value="{{$last_products[0]->image}}">
                                        </td>
                                        <td class="">
                                            <img src="https://via.placeholder.com/314x314.png"
                                                class="img-thumbnail imagePreview2" alt="">
                                        </td>
                                        <td class="">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input"
                                                    data-toggle="custom-file-input" id="thumbnail" name="thumbnail"
                                                    value=" " accept="image/*">
                                                <label id="label2" class="custom-file-label" for="thumbnail">Choose
                                                    file</label>
                                            </div>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-lg-12 mt-5">
                        <div class="text-center form-group">
                            <button class="btn btn-info" type="submit">Update </button>
                            <a href="{{route('lastetproducts')}}" class="btn btn-secondary">
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
        var fileTypes = ['jpg', 'jpeg', 'png', 'gif', 'svg','webp'];
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
    
    function selectdataOption(id){
         if(id == 1){
          $('#js_product_id').prop('required', true);
         }else{
            $('#js_product_id').removeAttr('required');
         }
    }

</script>
@endsection