@extends('layouts.admin')
@section('style')

@endsection
@section('content')
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Edit Document</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <a href="{{route('docFilerBy' , $docs[0]->cate_id)}}">Documents</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create</li>
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
            <h3 class="block-title">Document</h3>
        </div>
        <div class="block-content">
            <form action="{{route('updateProdoc')}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
            <input type="hidden" name="doc_id" value="{{$docs[0]->doc_id}}">
                <!-- Basic Elements -->
                <div class="row">
                    <div class="col-lg-12">
                            <div class="form-group">
                                    <label for="example-select"><span class="req-fed">*</span> Select Document Types</label>
                            <select class="js-select2 form-control" id="catedocId" onchange="selectDocCate();" name="doc_categories" data-placeholder="Choose one.." required>
                                <option></option>
                                @foreach ($categories as $main)
                                @if($main->id == $docs[0]->cate_id)
                                <option value="{{$main->id}}" selected>{{$main->title}}</option>
                                @else 
                                <option value="{{$main->id}}">{{$main->title}}</option>
                                @endif
                                @endforeach
                                   
                            </select>
                                </div>
                        <div class="block block-rounded block-bordered">
                            <ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs" role="tablist">
                                @foreach ($language as $item)
                                <li class="nav-item">
                                <a class="nav-link {{$loop->iteration == 1 ?'active':''}}" href="#btabs-alt-static-{{$item->name}}"
                                        style="text-transform: capitalize;">{{$item->name}}</a>
                                </li>
                                @endforeach
                            </ul>
                            <div class="block-content tab-content">
                                @foreach ($language as $item2)
                                <?php 
                                $current = null;
                                foreach($docs as $item) { 
                                    if ($item2->name == $item->local) {
                                        $current = $item;
                                        break;
                                    }
                                }
                               ?>
                                <input type="hidden" name="lang_loop[]" value="{{$item2->name}}">
                                <div class="tab-pane {{($loop->iteration == 1)? 'active':''}}" id="btabs-alt-static-{{$item2->name}}" role="tabpanel">
                                        <div class="form-group">
                                            <label for="example-select">Name</label>
                                            <input type="text"
                                                class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                name="name[{{$item2->name}}]" value="{{isset($current->name)? $current->name :'' }}" placeholder="Enter name...">
                                        </div>
                                        <div class="form-group">
                                                <label for="example-select"> Old File</label>
                                                <a href="{{config('app.url')}}/upload/product_files/{{isset($current->file)? $current->file :'' }}"
                                                    target="_blank">{{isset($current->file)? $current->file :'' }}</a>
                                                    <input type="hidden" name="oldfile[{{$item2->name}}]"  value="{{isset($current->file)? $current->file :'' }}" >
                                                    @if(isset($current->file))
                                                    <a href="{{route('removefileDoc',[$item2->name,$docs[0]->doc_fk_id])}}" target="_blank" class="btn btn btn-danger"><i class="fa fa-trash"></i> </a>
                                                        @endif
                                            </div>
                                        <div class="form-group">
                                            <label for="example-select">New File <span class="req-fed">* Max File Size 20 MB</span></label>
                                            <div class="custom-file " style="width:100%;">
                                                <input type="file" class="custom-file-input" name="fileGU[{{$item2->name}}]"
                                                    data-toggle="custom-file-input">
                                                <label class="custom-file-label" for="fileImage">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div  class="block block-rounded block-bordered">
                            <ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs" role="tablist">
                                @foreach ($other_lang as $item)
                                <li class="nav-item">
                                <a class="nav-link {{$loop->iteration == 1 ?'active':''}}" href="#btabs-alt-static-{{$item->name}}"
                                        style="text-transform: capitalize;">{{$item->name}}</a>
                                </li>
                                @endforeach
                            </ul>
                            <div class="block-content tab-content">
                                @foreach ($other_lang as $item3)
                                <?php 
                                $current2 = null;
                                foreach($docs as $item) { 
                                    if ($item3->name == $item->local) {
                                        $current2 = $item;
                                        break;
                                    }
                                }
                               ?>
                             
                                <input type="hidden" name="lang_loop[]" value="{{$item3->name}}">
                                <div class="tab-pane {{($loop->iteration == 1)? 'active':''}}" id="btabs-alt-static-{{$item3->name}}" role="tabpanel">
                                        <div class="form-group">
                                            <label for="example-select">Name</label>
                                            <input type="text"
                                                class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                name="name[{{$item3->name}}]" value="{{isset($current2->name)? $current2->name :'' }}" placeholder="Enter name...">
                                        </div>
                                        <div class="form-group">
                                                <label for="example-select"> Old File</label>
                                                <a href="{{config('app.url')}}/upload/product_files/{{isset($current2->file)? $current2->file :'' }}"
                                                    target="_blank">{{isset($current2->file)? $current2->file :'' }}</a>
                                                    <input type="hidden" name="oldfile[{{$item3->name}}]"  value="{{isset($current2->file)? $current2->file :'' }}" >
                                                    @if(isset($current2->file))
                                                    <a href="{{route('removefileDoc',[$item3->name,$docs[0]->doc_fk_id])}}" target="_blank" class="btn btn btn-danger"><i class="fa fa-trash"></i> </a>
                                                        @endif
                                                </div>
                                                
                                        <div class="form-group">
                                            <label for="example-select">New File <span class="req-fed">* Max File Size 20 MB</span></label>
                                            <div class="custom-file " style="width:100%;">
                                                <input type="file" class="custom-file-input" name="fileGU[{{$item3->name}}]"
                                                    data-toggle="custom-file-input">
                                                <label class="custom-file-label" for="fileImage">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                      <div class="col-lg-8 pt-2">
                           
                            <div class="form-group">
                                    <label for="example-select">Multiple  Select Products</label>
                                    <select class="js-select2 form-control" id="ModelIdNotSelectIncate" name="product[]" style="width: 100%;" data-placeholder="Choose many.." multiple>
                                        <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                      
                                        {{-- @foreach ($doc_has_pros as $item)
                                        <option value="{{$item->pro_id}}" selected>{{$item->pro_code}}</option>
                                        @endforeach --}}
                                       
                                    </select>
                                </div>
                          </div>
              
                    <div class="col-lg-12 mt-5">
                        <div class="text-center form-group">
                            <button class="btn btn-info" type="submit">Update </button>
                            <a href="{{route('docFilerBy' , $docs[0]->cate_id)}}" class="btn btn-secondary">
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
    $(document).on('change', '.custom-file-input', function () {
        // alert(this.files[0].size);
        var FileSize = this.files[0].size / 1024 / 1024; // in MB
        if (FileSize > 20) {
            alert("File size exceeds 20 MB!");
            $('.custom-file-label').text('Choose file');
            this.value = "";
        };
    });
    var doc_has_pros = <?= json_encode($doc_has_pros);?>;
    $(document).ready(function() {
           selectDocCate();
        });
    
    function selectDocCate() {
      var cateid = $("#catedocId").val();
      console.log(cateid);
        $.ajax({
            url: "{{ (route('searhModelProductByCatedoc'))}}",
            data: {
            'cateid': cateid,
           },
           type: 'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                // console.log(doc_has_pros[0]['pro_id'], doc_has_pros[0]['pro_code']);
                var options = '';

                for (var i = 0; i < data.data.length; i++) {
                    options += '<option value="' + data.data[i].pro_id + '">' + data.data[i]
                        .pro_code + '</option>';
                }

                for (var j = 0; j < doc_has_pros.length; j++) {
                    options += '<option value="' + doc_has_pros[j]['pro_id'] + '" selected>' + doc_has_pros[j]['pro_code']+ '</option>';
                }

                $("select#ModelIdNotSelectIncate").html(options);
            }

        });

    }

</script>
@endsection
