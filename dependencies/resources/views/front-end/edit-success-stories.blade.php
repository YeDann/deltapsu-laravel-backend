@extends('layouts.front-end')
@section('css')

<style>
    table {
        border-collapse: unset;
        border-spacing: 0px 16px;
    }
    .table {
        margin-top: -1rem;
        margin-bottom: 0;
    }
    .space-listviews {
        margin-top: 4px;
    }
    .table thead th{
        vertical-align: middle !important;
    }


    tbody td {
        border-top: 2px solid transparent !important;
        border-bottom: 2px solid #E3EFF8;
    }
    

    .text-middle-td{
        padding: 1rem !important;
    }
    .table td, .table th {
        padding: unset;
    }
    .table th{
        padding: 3px 10px !important;
    }
    .list-group{
        margin-top: 20px;
    }
   .select-minimize {
    width: 60px !important;
   }
    .box-news-detail{
        border: 2px solid #E3EFF8;
        padding: 24px;
    }
    /* tab */
    .calendar-month-tab input { 
        display: none; 
    }   /* hide radio buttons */
    input + label { 
       /*  display: inline-block ; */
       margin-bottom: -2px;
       cursor: pointer;
    }   /* show labels in line */
    .calendar-month-tab{
        border-bottom: 2px solid #E3EFF8;
        margin-bottom: 1em;
        display: flex;
        justify-content: space-around;
    }
    input:checked+label {
        border-bottom: 2px solid #0087DC;
    }
    #next-year::before,#last-year::before{
        position: absolute;
        bottom: -8px;
        font-family: 'FontAwesome';
        color: #0087DC;
        font-size: 24px;
        cursor: pointer;
    }
    #next-year::before{
        left: 0;
        content: "\f054";
        margin-left: 24px;
    }
    #last-year::before{
        right: 0;
        content: "\f053";
        margin-right: 24px;
    }
    .calendar-year-tab a{
        height: 24px;
        position: relative;
    }
    .calendar-year-tab a:hover{
        text-decoration: none;
    }
    .scrollbar {
        overflow-y: scroll;
        height: 278px;
    }
    .img-event-slide{
        height: 160px;
    }
    .event-content-text  .post-meta{
        font-size: 12px;
    }
    .read-more-slide{
        font-size: 12px;
        font-weight: bold;
        color: #5F5F5F;
    }
    .read-more-slide:hover {
    text-decoration: none !important;
    }
    .success-stories-list{
        padding-right: 2rem;
        padding-left: 2rem;
        padding-bottom: 1.5rem;
        padding-top: 1.5rem;
        border-bottom: 2px solid#E3EFF8;

    }
    .btn-upload-image{
        color: #0087DC;
        border: 2px solid #0087DC;
        border-radius: 5px;
        height: 40;
        width: 160;
        padding: 0.5rem .75rem;
        text-align: center;
        cursor: pointer;
        margin: 0;
    }
    .img-input{
        height: 80px;

    }
    .box-list-input{
        width: 100%;
        display: flex;
        justify-content: space-between;
        background: #F0F5FA;
        padding: 1rem;
        margin-bottom: 1rem;
       /*  height: 250px; */

    }
    .box-image-input{
        width: 50%;
        padding: 0.5rem .75rem;
        border: 1px solid #D6E9F6;
        display: flex;
        justify-content: space-between;
    }
    #text-no{
        width: 250px;
    }
    .form-control.error{
    border: 1px solid red;
    }
    .text-area.error{
        border: 1px solid red;
    } 
    .form-control.green{
        border: 1px solid green;
    }
    .text-area.green{
        border: 1px solid green;
    } 
    .text-a-link{
        color: #0087DC;
        font-weight: bold;
    }
    .btn-ft{
        cursor: pointer;
    }
    .delete_img{
        position: absolute;
        top: 0;
        background-color: red;
        border: 1px solid red;
        color: #fff;
    }
    .select2-selection__choice{
        font-size: 14px;
    }
    .select2-container--default .select2-search--inline .select2-search__field {   
    font-size: 14px !important;
   }
   .select2-container {
    width: 100% !important;
   }
   .select2-container--default .select2-selection--multiple {
    border-radius: 0px!important;
   }
</style>
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('meta')
<title>deltaPSU</title>
<meta name="description" content="deltaPSU ,edit Success Stories">
<meta name="keywords" content="deltaPSU">
@endsection
@section('container')
<div class="padding-top-content">
</div>
<div class="products-index-nav visible-up-922">
    <div class="bg-bredcrumb">
        <div class="container">
            <nav aria-label="breadcrumb" id="breadcrumb">
                <ol class="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item text-breadcrumb-home"><a href="{{route('index','home')}}">{{$staticContent['Home']}}</a></li>
                        <li class="breadcrumb-item active text-breadcrumb-home" aria-current="page"><a href="#"> {{$staticContent['Partners']}}</a></li>
                        <li class="breadcrumb-item active text-breadcrumb-home" aria-current="page"><a href="{{route('marketingResources')}}">{{$staticContent['Marketing_Resources']}}</a></li>
                        <li class="breadcrumb-item active text-breadcrumb-home" aria-current="page"><a href="{{route('successStories')}}">{{$staticContent['Success_Stories']}}</a></li>
                        <li class="breadcrumb-item active text-breadcrumb" aria-current="page"><a href="#">{{$staticContent['edit']}}</a></li>
                    </ol>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="padding-top-content-breadcrumb visible-up-922"></div>
<div class="mb-5">
  
    <div class="container">
        <form id="form-success-story" action="{{route('updateSuccessStories')}}" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
        <h2 class="text-title-delta visible-up-922">{{$staticContent['edit']}} {{$staticContent['Success_Stories']}}</h2>
        <h3 class="text-title-delta invisible-up-922">{{$staticContent['edit']}} {{$staticContent['Success_Stories']}}</h3>
        <div class="row">
            <input type="hidden" id="story_id_top" name="story_id_main" value="{{$AllsuccessStory[0]->id}}">
            <input type="hidden" name="status" id="status_save">
            <div class="col-lg-6 col-md-12 input-label w-100 mb-4">
                <label class="text-title-detail-dark">{{$staticContent['Model']}}  <span class="red">*</span></label>
                {{-- <input type="text" class="form-control" name="model" placeholder="{{$staticContent['Model']}}" required> --}}
                <select class="js-example-basic-multiple form-control" name="model[]" multiple="multiple"  id="model" required>
                    <option></option>
                   @foreach ($products as $item)
                   @if(in_array($item->pro_code, $arrModel))
                   <option value="{{$item->pro_code}}" selected>{{$item->pro_code}}</option> 
                   @else 
                   <option value="{{$item->pro_code}}" >{{$item->pro_code}}</option> 
                   @endif   
                   @endforeach
                </select>
            </div>
            
            <div class="col-lg-6 col-md-12 input-label w-100 mb-4">
                <label class="text-title-detail-dark">{{$staticContent['Applications']}}<span class="red">*</span></label>
              
            <input type="text" onkeyup="keycheck();" class="form-control" name="application"  id="application" placeholder="Enter application "  value="{{$AllsuccessStory[0]->application}}">
            </div>
        </div>
        <div class="row  ">
            <div class="col-lg-6 col-md-12 input-label w-100 mb-4">
                <label class="text-title-detail-dark">{{$staticContent['End_Customer']}}<span class="red">*</span></label>
                <input type="text" onkeyup="keycheck();" class="form-control" name="endCustomer"   id="endCustomer" placeholder="{{$staticContent['End_Customer']}}"  value="{{$AllsuccessStory[0]->endCustomer}}"> 
                {{-- <label for="email">Email Address</label> --}}
            </div>
          
            <div class="col-lg-6 col-md-12 input-label w-100 mb-4">
                <label class="text-title-detail-dark">{{$staticContent['Country']}}<span class="red">*</span></label>
                    <select name="country" onchange="keycontry()"   class="form-control" id="country" >
                        <option value="">Please Select</option>
                        @foreach ($countries as $country)
                        @if($AllsuccessStory[0]->country == $country->name )
                        <option value="{{$country->name}}" selected>{{$country->name}}</option> 
                        @else 
                        <option value="{{$country->name}}" >{{$country->name}}</option> 
                        @endif   
                        @endforeach
                    </select>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <label class="text-title-detail-dark">{{$staticContent['Message']}}<span class="red">*</span></label>
                <div class="input-label">
                    <textarea name="message" onkeyup="keycheck();" id="message" class="w-100 text-area"  placeholder="{{$staticContent['Message']}}" rows="10" style="padding: .75rem;" >{{$AllsuccessStory[0]->message}}</textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <label class="text-title-detail-dark">{{$staticContent['Old_Image']}}<span class="red">*</span></label>
            </div>
        </div>
        <div class="row mb-4">
            @foreach ($image_story as $item)
            <div class="col-2"  id="oldimg{{$item->id}}">
               <img  class="w-100"   src="{{config('app.url')}}/medias/marketing_resources/{{$item->image}}">
               <button class="delete_img" type="button" onclick="deleteImage({{$item->id}})">X</button>
            </div>

            @endforeach
            
        </div>

    </form>
        <div class="row">
            <div class="col-lg-2">
                <h5 class="mt-4">{{$staticContent['Picture']}}</h5>
                <p class="text-muted">
                    Drag and drop sections for your file uploads
                </p>
                <p style="color:red"> *.png .jpeg<p>
                        <p style="color:red">  *max size file 2 MB<p>
            </div>
            <div class="col-lg-10">
                <!-- DropzoneJS Container -->
            <form class="dropzone " id="my-awesome-dropzone"   method="post" enctype="multipart/form-data">
                {{csrf_field()}}
            <input type="hidden" name="story_id"  id="story_id" value="{{$AllsuccessStory[0]->id}}">
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 text-center">
            <p>{{$staticContent['By_submitting_this_form']}} <a target="_blank" class="text-a-link" href="{{route('privacyPolicy')}}">{{$staticContent['Privacy_Policy']}}</a>.</p>
                <button type="button" onclick="onclickSubmitform()" class="btn-subscribe mt-4">{{$staticContent['Submit']}}</button>
            </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <button type="button" onclick="onclickSaveDraft()" class="btn btn-boxen mt-4">{{$staticContent['Save Draft']}}</button>
                </div>
                </div>
    </div> 
</div>

<div id="alertImage" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        
        <div class="modal-body">
            <input type="hidden"  id="imgid">
            <h5 class="modal-title">{{$staticContent['Are_you_sure_to_delete_image']}}</h5>
        </div>
        <div class="modal-footer">
            <div class="btn btn-boxen" onclick="closedeleteImage();">{{$staticContent['Cancel']}}</div>
         <div class="btn btn-subscribe" onclick="onconfirmdeleteImage();">{{$staticContent['Delete']}}</div>

        </div>
      </div>
    </div>
  </div>

<div id="modalConfirmsubmit" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">{{$staticContent['Are_your_sure_to_submit']}}</h5>
          
        </div>
        <div class="modal-body">
          <p>Clicking submit will add this to the DeltaPSU website and cannot be edited/deleted at a later time. Do you want to continue?</p>
        </div>
        <div class="modal-footer">
            <div class="btn btn-boxen" onclick="calcel();">{{$staticContent['Cancel']}}</div>
         <div class="btn btn-subscribe" onclick="onsubmitContent();">{{$staticContent['Submit']}}</div>

        </div>
      </div>
    </div>
  </div>

@endsection


@section('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
    $('.js-example-basic-multiple').select2({
        placeholder: "Select Models",
    });
});
</script>
<script>
    var image = [];
    Dropzone.autoDiscover = false;
    var myDropzone = new Dropzone("#my-awesome-dropzone", { 
        url: "{{route('uploadmulImagestory')}}"}
        );
        myDropzone.on('success', function(file, response) {
         $('#story_id').val(response.story_id);
         $('#story_id_top').val(response.story_id);
        
    
     });
   function onconfirmdeleteImage(){
        var id = $('#imgid').val();
        $.ajax({
           url: "{{route('deleteImageSucess')}}",
           data: {
          'img_id': id,
           },
           type: 'POST',
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
           success: function (res) {
            console.log(res);
            if(res.status == 1){
               $('#oldimg'+id).empty();
               $('#alertImage').hide();
            }
           }
           });

   }
   function deleteImage(id){
       $('#imgid').val(id);
       $('#alertImage').show();
       
   }
   function closedeleteImage(){
    $('#imgid').val('');
    $('#alertImage').hide();
   }

   function onclickSaveDraft(){
       if($('#message').val() != '' && 
       $('#model').val() != 0 && 
       $('#application').val() != '' && 
       $('#endCustomer').val() != '' && 
       $('#country').val() != '' ){
        $('#status_save').val(0);
        $('#form-success-story').submit();
       }else{
    
          if($('#message').val() == ''){
            $('#message').addClass('error');
            }
           if($('#application').val() == ''){
            $('#application').addClass('error');
            }
            if($('#model').val() == 0){
                $('#model').addClass('error');
            }
            if($('#endCustomer').val() == ''){
                $('#endCustomer').addClass('error');
            }
            if($('#country').val() == ''){
                $('#country').addClass('error');
            }
       }
   }
   function keycheck(){
           if($('#message').val() != ''){
            $('#message').addClass('green');
            }
           if($('#application').val() != ''){
            $('#application').addClass('green');
            }
            if($('#model').val() != 0){
                $('#model').addClass('green');
            }
            if($('#endCustomer').val() != ''){
                $('#endCustomer').addClass('green');
            }
           
   }
   function calcel(){
    $('#modalConfirmsubmit').hide();
   }
   function onsubmitContent(){
        $('#status_save').val(1);
        $('#form-success-story').submit();
   }
   function onclickSubmitform(){
       if($('#message').val() != '' && 
       $('#model').val() != 0 && 
       $('#application').val() != '' && 
       $('#endCustomer').val() != '' && 
       $('#country').val() != '' ){
         $('#modalConfirmsubmit').show();
       }else{
    
          if($('#message').val() == ''){
            $('#message').addClass('error');
            }
           if($('#application').val() == ''){
            $('#application').addClass('error');
            }
            if($('#model').val() == 0){
                $('#model').addClass('error');
            }
            if($('#endCustomer').val() == ''){
                $('#endCustomer').addClass('error');
            }
            if($('#country').val() == ''){
                $('#country').addClass('error');
            }
       }
    
   }
   function keycontry(){
             if($('#country').val() == ''){
                $('#country').addClass('green');
            }
   }

   function selectModel(){
        if($('#model').val() != 0){
        $('#model').addClass('green');
        }
   }
</script>
@endsection
