@extends('layouts.admin')
@section('style')

@endsection
@section('content')
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">
                @if($typeid == 7)
              FAQs banner
                @else 
                Edit Information
                @endif
            </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
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
            <h3 class="block-title">Information </h3>
        </div>
        <div class="block-content">
            <form action="{{route('storeContent')}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <!-- Basic Elements -->
                <div class="row">
                <input type="hidden" name="type_id" value="{{$typeid}}" >
                <input type="hidden" name="con_id" value="{{isset($static_content[0]->sta_id)? $static_content[0]->sta_id:''}}" >
                @foreach ($language as $item)
                <input type="hidden" name="lang_loop[]" value="{{$item->name}}">
                @endforeach
                    <div class="col-lg-12">
                        <div class="block block-rounded block-bordered">
                            @if($typeid != 7)
                            <ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs" role="tablist">
                                @foreach ($language as $item)
                                <li class="nav-item">
                                    <a class="nav-link {{($loop->iteration == 1)?'active':''}}" href="#btabs-alt-static-{{$item->name}}"
                                        style="text-transform: capitalize;">{{$item->name}}</a>
                                </li>
                                @endforeach
                           
                            </ul>
                            <div class="block-content tab-content">
                                @foreach ($language as $item)
                                <?php 
                                $current = null;
                                foreach($static_content as $item2) { 
                                    if ($item->name == $item2->local) {
                                        $current = $item2;
                                        break;
                                    }
                                }
                              ?>
                             
                                <div class="tab-pane {{($loop->iteration == 1)?'active':''}}"
                                    id="btabs-alt-static-{{$item->name}}" role="tabpanel">
                                    <div class="form-group">
                                        <label for="example-select">Title</label>
                                        <input type="text"
                                            class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                            name="name[{{$item->name}}]" value="{{isset($current->title)? $current->title:''}}" placeholder=" Enter text...">
                                    </div>
                                    <div class="form-group">
                                            <label for="">Content</label>
                                            <textarea name="content[{{$item->name}}]" class="jsnotenew">{{isset($current->content)? $current->content:''}}</textarea>
                                        </div>
                                </div>
                                @endforeach
                            </div>
                            @endif
                            <input type="hidden" name="filename[destop]" value="destop" >
                            @if($typeid != 5 &&  $typeid != 6)
                               <div class="table-responsive">
                                <table class="table table-bordered table-striped table-vcenter">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 10px;">
                                                File Type
                                            </th>
                                          
                                            <th style="width:30%;">Preview</th>
                                            <th style="width:30%;">Old Image</th>
                                            <th>Upload File <span style="color:red">*Max file 2 MB</span></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center">
                                               Image
                                            </td>
                                          
                                            <td class="font-w600">
                                                @if($typeid == 7)
                                                <img src="https://via.placeholder.com/450x185.png"
                                                    class="img-thumbnail imagePreview1 res-image" alt="">
                                               @else 
                                               <img src="https://via.placeholder.com/1350x750.png"
                                               class="img-thumbnail imagePreview1 res-image" alt="">
                                               @endif
                                                
                                            </td>
                                            <td class="text-center">
                                                    <img src="{{config('app.url')}}/medias/static_content/{{isset($static_content[0]->destop_image)? $static_content[0]->destop_image:''}}"
                                                        class="img-thumbnail res-image" alt="">
                                                        <input type="hidden" name="oldfile[destop]" value="{{isset($static_content[0]->destop_image)? $static_content[0]->destop_image:''}}" >
                                                </td>
                                         
                                            <td class="">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input"
                                                        data-toggle="custom-file-input" id="destop" name="fileimage[destop]"
                                                        value=" " accept="image/*">
                                                    <label id="label1" class="custom-file-label" for="destop">Choose file</label>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            @endif
                            <div class="text-center form-group">
                                <button class="btn btn-info" type="submit">Update </button>
                               
                            </div>
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




    $(document).on('change', '#destop', function () {
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

    $('.jssummernote1').summernote({
        tabsize: 2,
        height: 300
    });
</script>
@endsection
