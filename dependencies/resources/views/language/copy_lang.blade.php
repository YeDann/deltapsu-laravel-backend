@extends('layouts.admin')
@section('style')
<style>
    .select2-container .select2-selection--single {
        height: 44px;
    }

    .tick_ok {
        content: " - OK";
    }

    .tick_ok-downloading {
        content: "loading ... ";
    }

    .tick_ok-downloading::before {
        content: "loading ... ";
        font-weight: bold;
        color: #0665d0;
    }

    .tick_ok-downloading_eror {}

    .tick_ok-downloading_eror::before {
        content: "Eror ... ";
        font-weight: bold;
        color: red;
    }

    .tick_ok::before {
        content: "OK  ";
        font-weight: bold;
        color: green;
    }

    /* .hiding_btn{
         visibility: hidden;
         display:none;
     } */
</style>
@endsection
@section('content')
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Language</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Language</li>
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
            <h3 class="block-title">Create Data</h3>
        </div>
        <div class="block-content">
            <h2>Please add every data for copy English data to new language </h2>
            <ul>
                <?php $i = 1?>
                @foreach ($taskarr as $item)
                <li id="td_{{$i}}" class="mb-5">{{$i}}.{{$item}} <button id="btn_add_otg{{$i}}"
                        class="ml-5 btn btn-success" onclick="taskRequest({{$i}})">Add English language</button></li>
                <?php $i++?>
                @endforeach
            </ul>


        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    function taskRequest(task){
        console.log(task,'task')
      $('#td_'+task).addClass('tick_ok-downloading');
      $('#btn_add_otg'+task).addClass('d-none');
        $.ajax({
            url: "{{ (route('copyDataActionReq')) }}" ,
            data: {
            'task': task,
            'newlang': '{{$newlang}}',
           },
           type: 'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                console.log(data);
                $('#td_'+task).removeClass('tick_ok-downloading');
                $('#td_'+task).addClass('tick_ok');
         
            },
            error: function(xhr, status, error){
                $('#td_'+task).removeClass('tick_ok-downloading_eror');
                $('#td_'+task).addClass('tick_ok-downloading');
            }
        });
  }
 
</script>
@endsection