@extends('layouts.admin')
@section('style')

@endsection
@section('content')
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Order Product Categories</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                        <li class="breadcrumb-item" aria-current="page"><a href="{{route('subCategories')}}">All Product Categories</a></li>
                   
                    <li class="breadcrumb-item active" aria-current="page">Order </li>
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
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      @if($cate_id == 2)
                      INDUSTRIAL POWER
                      @elseif($cate_id == 1)
                      MEDICAL POWER
                      @elseif($cate_id == 3)
                      LED POWER
                      @endif
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="{{route('order_pro_categoriesBymain' ,1)}}">MEDICAL POWER</a>
                      <a class="dropdown-item" href="{{route('order_pro_categoriesBymain' ,2)}}">INDUSTRIAL POWER</a>
                      <a class="dropdown-item" href="{{route('order_pro_categoriesBymain' ,3)}}">LED POWER</a>
                    </div>
                  </div>
            </h3>
            <div class="block-options">
                <div class="block-options-item">
                 
                </div>
                <div class="block-options-item">

                </div>
            </div>
        </div>
 
        <div class="block-content block-content-full">
                <p class="warrning-text">*Can draggable order Item </p>
            <table class="table table-bordered table-striped table-vcenter">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 5%;">Order.</th>
                        <th class="d-none d-sm-table-cell" style="width: 30%;">Name</th>
                      
                    </tr>
                </thead>
                <tbody>
                    @if(isset($subCategories) and !empty($subCategories))
                    @foreach ($subCategories as $item)
                    <tr class="odd order-list" data-id="{{$item->pk_id}}">
                    <td class="text-center">{{$loop->iteration}}</td>
                    <td class="d-none d-sm-table-cell">{{$item->name}}</td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="order-input" style="display: none;"></div>
<div id="order-index" style="display: none;"></div>
@endsection
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
                    url: "{{route('update_order_procate')}}",
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
