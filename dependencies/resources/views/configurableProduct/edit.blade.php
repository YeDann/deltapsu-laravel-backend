@extends('layouts.admin')
@section('style')

@endsection
@section('content')
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Edit Configurable Power</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <a href="{{route('configurableProduct')}}">Configurable Power</a> </li>
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
            <h3 class="block-title">Infomation</h3>
        </div>
        <div class="block-content">
            <form action="{{route('updateConfigProduct')}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <!-- Basic Elements -->
                <input type="hidden" name="tran_id" value="{{$transid}}">
                <div class="row">
                    <div class="col-md-12">

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
                                        foreach($cproducts as $item) { 
                                            if ($item2->name == $item->language) {
                                                $current = $item;
                                                break;
                                            }
                                          }
                                       ?>
                                <input type="hidden" name="langloop[]" value="{{$item2->name}}">

                                <div class="tab-pane {{($loop->iteration == 1)?'active':''}}"
                                    id="btabs-alt-static-{{$item2->name}}" role="tabpanel">
                                    <div class="form-group">
                                        <label for="example-select">Product Code <span class="req-fed">*</span></label>
                                        <input type="text"
                                            class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                            name="productCode[{{$item2->name}}]"
                                            value="{{ isset($current->product_code)? $current->product_code :''}}"
                                            placeholder="Enter name...">
                                    </div>

                                    <div class="form-group">
                                        <label for="">Content</label>
                                        <textarea name="content[{{$item2->name}}]"
                                            class="jsnotenew">{{ isset($current->description)? $current->description :''}}</textarea>
                                    </div>
                                </div>

                                @endforeach
                            </div>
                        </div>



                    </div>
                    <div class="col-md-12">
                        <input type="hidden" name="filename[thumbnail]" value="thumbnail">
                        <input type="hidden" name="filename[certificate]" value="certificate">
                        <input type="hidden" name="filename[preview]" value="preview">

                        <div class="form-group">
                            <label for="example-select">Dimension L (mm.)</label>
                            <p class="req-fed">( Choice A: Use numeric value for simple display L x W x D. Choice B: Use
                                HTML to display any free text and ignore dimensionW and dimensionD )</p>
                            <input type="text" class="form-control {{ $errors->has('dimensionL') ? 'is-invalid' : '' }}"
                                name="dimensionL" placeholder="" value="{{$cproducts[0]->dimensions}}">
                        </div>
                        <div class="form-group">
                            <label for="example-select">Dimension W (mm.)</label>

                            <input type="text" class="form-control {{ $errors->has('dimensionW') ? 'is-invalid' : '' }}"
                                name="dimensionW" placeholder="" value="{{$cproducts[0]->dimen_w}}">
                        </div>
                        <div class="form-group">
                            <label for="example-select">Dimension D (mm.)</label>

                            <input type="text" class="form-control {{ $errors->has('dimensionD') ? 'is-invalid' : '' }}"
                                name="dimensionD" placeholder="" value="{{$cproducts[0]->dimen_d}}">
                        </div>
                        <div class="form-group">
                            <label for="example-select">Unit Weight</label>

                            <input type="text"
                                class="form-control {{ $errors->has('unitwWeight') ? 'is-invalid' : '' }}"
                                name="unitwWeight" placeholder="" value="{{$cproducts[0]->weight}}">
                        </div>
                        <div class="form-group">
                            <label for="example-select">Panel</label>

                            <input type="text" class="form-control {{ $errors->has('panel') ? 'is-invalid' : '' }}"
                                name="panel" placeholder="" value="{{$cproducts[0]->panel}}">
                        </div>
                        <div class="form-group">
                            <label for="example-select">Frame</label>

                            <input type="text" class="form-control {{ $errors->has('frame') ? 'is-invalid' : '' }}"
                                name="frame" placeholder="" value="{{$cproducts[0]->frame}}">
                        </div>
                        <div class="form-group">
                            <label for="example-select">MaxPower <span class="req-fed">*( Numeric only )</span></label>

                            <input type="number" class="form-control {{ $errors->has('maxPower') ? 'is-invalid' : '' }}"
                                name="maxPower" placeholder="" value="{{$cproducts[0]->max_power}}" required>
                        </div>

                        <div class="form-group">
                            <label for="example-select">Max Slot <span class="req-fed">*</span></label>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                <input type="radio" class="custom-control-input" id="status-1" name="max_slot" value="1"
                                    required {{($cproducts[0]->max_slot == 1) ? 'checked':''}}>
                                <label class="custom-control-label" for="status-1">1</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                <input type="radio" class="custom-control-input" id="status-2" name="max_slot" value="2"
                                    required {{($cproducts[0]->max_slot == 2) ? 'checked':''}}>
                                <label class="custom-control-label" for="status-2">2</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                <input type="radio" class="custom-control-input" id="status-3" name="max_slot" value="3"
                                    required {{($cproducts[0]->max_slot == 3) ? 'checked':''}}>
                                <label class="custom-control-label" for="status-3">3</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                <input type="radio" class="custom-control-input" id="status-4" name="max_slot" value="4"
                                    required {{($cproducts[0]->max_slot == 4) ? 'checked':''}}>
                                <label class="custom-control-label" for="status-4">4</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                <input type="radio" class="custom-control-input" id="status-5" name="max_slot" value="5"
                                    required {{($cproducts[0]->max_slot == 5) ? 'checked':''}}>
                                <label class="custom-control-label" for="status-5">5</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                <input type="radio" class="custom-control-input" id="status-6" name="max_slot" value="6"
                                    required {{($cproducts[0]->max_slot == 6) ? 'checked':''}}>
                                <label class="custom-control-label" for="status-6">6</label>
                            </div>

                            <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                <input type="radio" class="custom-control-input" id="status-7" name="max_slot" value="7"
                                    required {{($cproducts[0]->max_slot == 7) ? 'checked':''}}>
                                <label class="custom-control-label" for="status-7">7</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                <input type="radio" class="custom-control-input" id="status-8" name="max_slot" value="8"
                                    required {{($cproducts[0]->max_slot == 8) ? 'checked':''}}>
                                <label class="custom-control-label" for="status-8">8</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                <input type="radio" class="custom-control-input" id="status-9" name="max_slot" value="9"
                                    required {{($cproducts[0]->max_slot == 9) ? 'checked':''}}>
                                <label class="custom-control-label" for="status-9">9</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                <input type="radio" class="custom-control-input" id="status-10" name="max_slot"
                                    value="10" required {{($cproducts[0]->max_slot == 10) ? 'checked':''}}>
                                <label class="custom-control-label" for="status-10">10</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                <input type="radio" class="custom-control-input" id="status-11" name="max_slot"
                                    value="11" required {{($cproducts[0]->max_slot == 11) ? 'checked':''}}>
                                <label class="custom-control-label" for="status-11">11</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                <input type="radio" class="custom-control-input" id="status-12" name="max_slot"
                                    value="12" required {{($cproducts[0]->max_slot == 12) ? 'checked':''}}>
                                <label class="custom-control-label" for="status-12">12</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                <input type="radio" class="custom-control-input" id="status-13" name="max_slot"
                                    value="13" required {{($cproducts[0]->max_slot == 13) ? 'checked':''}}>
                                <label class="custom-control-label" for="status-13">13</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                <input type="radio" class="custom-control-input" id="status-14" name="max_slot"
                                    value="14" required {{($cproducts[0]->max_slot == 14) ? 'checked':''}}>
                                <label class="custom-control-label" for="status-14">14</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                <input type="radio" class="custom-control-input" id="status-15" name="max_slot"
                                    value="15" required {{($cproducts[0]->max_slot == 15) ? 'checked':''}}>
                                <label class="custom-control-label" for="status-15">15</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="example-select">Status</label>
                            <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                <input type="radio" class="custom-control-input" id="status_1" name="status" value="1"
                                    {{($cproducts[0]->status == 1) ? 'checked':''}}>
                                <label class="custom-control-label" for="status_1">Show</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                <input type="radio" class="custom-control-input" id="status_2" name="status" value="0"
                                    {{($cproducts[0]->status == 0) ? 'checked':''}}>
                                <label class="custom-control-label" for="status_2">Hide</label>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-vcenter">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 10px;">
                                            File Type
                                        </th>
                                        <th style="width: 300px;">Old File</th>

                                        <th style="width: 350px;">Preview</th>
                                        <th>Upload File</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">
                                            Thumbnail
                                        </td>
                                        <td class="">

                                            <img src="{{config('app.url')}}/media/model/{{$cproducts[0]->thumb_img}}"
                                                class="img-thumbnail res-image" alt="">

                                            <input type="hidden" name="oldfile[thumbnail]"
                                                value="{{$cproducts[0]->thumb_img}}">
                                        </td>
                                        <td class="font-w600">
                                            <img src="https://via.placeholder.com/225x270.png"
                                                class="img-thumbnail imagePreview1 res-image" alt="">
                                        </td>

                                        <td class="">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input"
                                                    data-toggle="custom-file-input" id="thumbnail"
                                                    name="fileimage[thumbnail]" value=" " accept="image/*">
                                                <label id="label1" class="custom-file-label" for="thumbnail">Choose
                                                    file</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">
                                            Certificate
                                        </td>
                                        <td class="">
                                            <img src="{{config('app.url')}}/media/model/{{$cproducts[0]->certificate_img}}"
                                                class="img-thumbnail res-image" alt="">
                                            <input type="hidden" name="oldfile[certificate]"
                                                value="{{$cproducts[0]->certificate_img}}">
                                        </td>
                                        <td class="font-w600">
                                            <img src="https://via.placeholder.com/245x105.png"
                                                class="img-thumbnail imagePreview2 res-image" alt="">
                                        </td>

                                        <td class="">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input"
                                                    data-toggle="custom-file-input" id="certificate"
                                                    name="fileimage[certificate]" value=" " accept="image/*">
                                                <label id="label1" class="custom-file-label" for="certificate">Choose
                                                    file</label>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="text-center">
                                            Product Preview
                                        </td>
                                        <td class="">
                                            <img src="{{config('app.url')}}/media/model/{{$cproducts[0]->preview_img}}"
                                                class="img-thumbnail res-image" alt="">
                                            <input type="hidden" name="oldfile[preview]"
                                                value="{{$cproducts[0]->preview_img}}">
                                        </td>
                                        <td class="font-w600">
                                            <img src="https://via.placeholder.com/590x200.png"
                                                class="img-thumbnail imagePreview4" alt="">
                                        </td>

                                        <td class="">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input"
                                                    data-toggle="custom-file-input" id="preview"
                                                    name="fileimage[preview]" value="no image" accept="image/*">
                                                <label id="label2" class="custom-file-label" for="preview">Choose
                                                    file</label>
                                            </div>
                                        </td>

                                </tbody>
                            </table>
                        </div>
                        <div class="form-group text-center">
                            <button class="btn btn-primary" type="submit">Update
                            </button>
                            <a href="{{route('configurableProduct')}}" class="btn btn-secondary">
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
            return false;
        } else {
            alert('File is not expept!');
         
            return true;
        }

    };


    $(document).on('change', '#thumbnail', function () {

        var FileSize = this.files[0].size / 1024 / 1024; // in MB
        if (FileSize > 2) {
            alert("File size exceeds 2 MB!");
            this.value = "";
            $('#label2').text('Choose file');
        }else{
            previewImage(this, $('.imagePreview1'));
        }
   
    });
   

    $(document).on('change', '#certificate', function () {
        // alert(this.files[0].size);
        var FileSize = this.files[0].size / 1024 / 1024; // in MB
        if (FileSize > 2) {
            alert("File size exceeds 2 MB!");
            this.value = "";
            $('#label1').text('Choose file');
        }else{
            previewImage(this, $('.imagePreview2'));
        }
    });
    $(document).on('change', '#preview', function () {
        // alert(this.files[0].size);
        var FileSize = this.files[0].size / 1024 / 1024; // in MB
        if (FileSize > 2) {
            alert("File size exceeds 2 MB!");
            this.value = "";
            $('#label1').text('Choose file');
        }else{
            previewImage(this, $('.imagePreview4'));
        }
    });

    
</script>
@endsection