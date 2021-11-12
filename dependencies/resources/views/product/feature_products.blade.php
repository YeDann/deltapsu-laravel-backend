@extends('layouts.admin')
@section('style')
<style>
     .btn-pos{
        position: absolute;
        bottom: 0;
     }
    </style>
@endsection
@section('content')
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">The latest Series</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">The latest Series</li>
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
              
            </h3>
           
            {{-- <a class="mr-2" href="{{route('getfeatureProduct')}}">
                    <button type="button" class="btn btn-success">Get featureProduct </button>
                </a>
         
            <a class="mr-2" href="{{route('getCreateDataFilter')}}">
                <button type="button" class="btn btn-success">Set Default filter</button>
            </a>
            <!-- <a class="mr-2" href="{{route('getAllSeries')}}">
                    <button type="button" class="btn btn-success">Get Series</button>
                </a> -->
             
                    <a class="mr-2" href="{{route('getProductFildData')}}">
                        <button type="button" class="btn btn-success">Get ProductFild</button>
                    </a> --}}

                    {{-- <a class="mr-2" href="{{route('getAllSubCategories')}}">
                        <button type="button" class="btn btn-success">Update series slug</button>
                    </a> --}}
                    {{-- <a class="mr-2" href="{{route('getAllSubCategories')}}">
                        <button type="button" class="btn btn-success">Update App</button>
                    </a> --}}
                    {{-- <a class="mr-2" href="{{route('getAllSubCategories')}}">
                        <button type="button" class="btn btn-success">Update Faq</button>
                    </a> --}}

               

                    
                
        </div>
        <div class="block-content block-content-full">
                <div class="mb-3"> 
                        <form action="{{route('setFeatureproducts')}}" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="col-lg-3">
                                    <label for="example-select">Select Categories <span class="req-fed">*</span></label>
                                    <select onchange="selectProductcategories();" class="js-select2 form-control" id="cateId" name="cateId"
                                        data-placeholder="Choose one.." required >
                                        <option></option>
                                        @foreach($subCategories as $cate)
                                        <option value="{{$cate->sub_pro_id}}">{{$cate->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-lg-3">
                                    <label for="example-select">Select Series <span class="req-fed">*</span></label>
                                    <select class="js-select2 form-control" id="SeriesId" name="se_id"
                                        data-placeholder="Choose one.." required>
                                        <option></option>
                                       
                                    </select>
                                </div>

                                <div class="col-lg-2">
                                    <button type="submit" class="btn btn-success btn-pos">ADD</button>
                                </div>
                            </div>
                        </form>
                </div>
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full ">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 5%;">Order.</th>
                            <th class="d-none d-sm-table-cell" style="width: 20%;">Title</th>
                            <th class="d-none d-sm-table-cell" style="width: 20%;">Categories</th>
                            <th style="width: 20%;" class="text-center">Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($series) and !empty($series))
                        @foreach ($series as $item)
                        <tr class="odd order-list" data-id="{{$item->id}}">
                        <td class="text-center">{{$loop->iteration}}</td>
                        <td class="d-none d-sm-table-cell">{{$item->title}}</td>
                        <td class="d-none d-sm-table-cell">{{$item->cateName}}</td>

                        <td class="text-center">
                                {{-- <a href="{{route('editproduct' ,$item->pro_id)}}" class="btn btn-primary">Edit</a> --}}
                                <a href="{{route('unSetting' ,$item->id)}}" class="btn btn-primary">Unpin</a>
                        </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
        </div>
    </div>
</div>

    <!-- END Vertically Centered Block Modal -->
    <div id="order-input" style="display: none;"></div>
    <div id="order-index" style="display: none;"></div>


@endsection
@section('js')
<script>
      
    function selectProductcategories() {

     var id = $('#cateId').val();
        var categorie = [];
            categorie.push(id);

        $.ajax({
            url: "{{ (route('searhSeries')) }}",
            data: {
            'data': categorie,
           },
           type: 'get',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                var options = '';

                for (var i = 0; i < data.modalContent.length; i++) {
                    options += '<option value="' + data.modalContent[i].se_id + '">' + data.modalContent[i]
                        .title + '</option>';
                }
                $("select#SeriesId").html(options);
            }

        });

    }
</script>

@section('js')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
        $( function() {
          $( "#sortable" ).sortable();
          $( "#sortable" ).disableSelection();
        } );
        var orderdata;
        $('tbody').sortable({

            stop: function (event, ui) {
                $('.order-list').each(function (index) {
                    var term = $(this).data('id');
                    $("#order-index").append(parseInt(index) + 1 + ",");
                    $("#order-input").append(term + ",");
                });
                var formData = {
                    'home_id': $("#order-input").html(),
                    'home_order': $("#order-index").html()
                };
                $.ajax({
                    url: "{{route('update_order_seriesLeast')}}",
                    type: 'post',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (res) {
                        location.reload();
                    }
                })
            }
        });

    </script>
@endsection
