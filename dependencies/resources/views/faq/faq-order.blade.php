@extends('layouts.admin')
@section('style')

@endsection
@section('content')
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Order FAQs</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <a href="{{route('Faq.index')}}">All FAQs </a></li>
                    <li class="breadcrumb-item active" aria-current="page">Order FAQs</li>
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
            <div class="block-options">
                <div class="block-options-item">
                
                </div>
                <div class="block-options-item">

                </div>
            </div>
        </div>
        <div class="block-content block-content-full">
            <table class="table table-bordered table-striped table-vcenter">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 5%;">Order.</th>
                        <th class="d-none d-sm-table-cell" style="width: 30%;">Title</th>
                        <th class="d-none d-sm-table-cell" style="width: 30%;">Faq Categories</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($faqs) and !empty($faqs))
                    @foreach ($faqs as $item)
                    <tr class="odd order-list" data-id="{{$item->id}}">
                    <td class="text-center">{{$loop->iteration}}</td>
                    <td class="d-none d-sm-table-cell">{{$item->title}}</td>
                    <td class="d-none d-sm-table-cell">{{$item->cateName}}</td>
 
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
                    url: "{{route('update_order_Faqs')}}",
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