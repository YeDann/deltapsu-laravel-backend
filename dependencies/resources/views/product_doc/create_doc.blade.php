@extends('layouts.admin')
@section('style')

@endsection
@section('content')
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Create Document</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <a href="{{route('docFilerBy' ,1)}}">Documents</a></li>
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
            <form action="{{route('storeProdoc')}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <!-- Basic Elements -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="example-select"><span class="req-fed">*</span> Select Document Types</label>
                            <select class="js-select2 form-control" id="catedocId" onchange="selectDocCate();"
                                name="doc_categories" data-placeholder="Choose one.." required>
                                <option></option>
                                @foreach ($categories as $main)
                                <option value="{{$main->id}}">{{$main->title}}</option>
                                @endforeach

                            </select>
                        </div>
                        @foreach ($language as $item)
                        <input type="hidden" name="lang_loop[]" value="{{$item->name}}">
                        @endforeach
                        @foreach ($other_lang as $spelang)
                        <input type="hidden" name="lang_loop[]" value="{{$spelang->name}}">
                        @endforeach
                        <div class="form-group">
                            <label for="example-select">Name</label>
                            <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                name="name" placeholder="Enter name...">
                        </div>
                        <div class="form-group">
                            <label for="example-select">File <span class="req-fed">* Max File Size 80 MB</span></label>
                            <div class="custom-file " style="width:100%;">
                                <input type="file" class="custom-file-input" id="file_input{{$item->name}}"
                                    onchange="checkmaxsize(`file_inputen` ,'file_lableen')" name="fileGU[en]"
                                    data-toggle="custom-file-input">
                                <label class="custom-file-label file_lableen" for="fileImage">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 pt-2">

                        <div class="form-group">
                            <label for="example-select"><span class="req-fed">*</span> Multiple Select Products</label>
                            <select class="js-select2 form-control" id="ModelIdNotSelectIncate" name="product[]"
                                style="width: 100%;" data-placeholder="waiting.." multiple disabled>
                                <option></option>
                                <!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                {{-- @foreach ($products as $item)
                                <option value="{{$item->pro_id}}">{{$item->pro_code}}</option>
                                @endforeach --}}

                            </select>
                        </div>
                    </div>

                    <div class="col-lg-12 mt-5">
                        <div class="text-center form-group">
                            <button class="btn btn-success" type="submit">Create </button>
                            <a href="{{route('docFilerBy' ,1)}}" class="btn btn-secondary">
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
    function checkmaxsize(id ,lableid){
        console.log(lableid);
       var file =  $('#'+id)[0].files[0];
       var FileSize = file.size / 1024 / 1024; // in MB

        if (FileSize > 80) {
          alert("File size exceeds 80 MB!");


          $('#'+id).val('');
          $('.'+lableid).text('Choose file');
        };

    }
</script>
<script>
    function selectDocCate() {
      var cateid = $("#catedocId").val();
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
                console.log(data);
                var options = '';

                for (var i = 0; i < data.data.length; i++) {
                    options += '<option value="' + data.data[i].pro_id + '">' + data.data[i]
                        .pro_code + '</option>';
                }
                $("select#ModelIdNotSelectIncate").html(options);
                $("select#ModelIdNotSelectIncate").html(options)
                .prop('disabled', false)
                .attr('data-placeholder', 'Choose many..');
            }

        });

    }

</script>
@endsection
