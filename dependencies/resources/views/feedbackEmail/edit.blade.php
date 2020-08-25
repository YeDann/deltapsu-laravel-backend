@extends('layouts.admin')
@section('style')

@endsection
@section('content')
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Edit </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page"><a href="{{route('emailnotification' ,$type)}}">  Email Notification List</a></li>
                       
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
            <h3 class="block-title">Information</h3>
        </div>
        <div class="block-content">
            <form action="{{route('UpdateEmail')}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <input type="hidden" class="form-control" name="type" value="{{$type}}">
                <input type="hidden" class="form-control" name="old_id" value="{{$data[0]->id}}">
                <!-- Basic Elements -->
     
                <div class="row">
                    <div class="col-lg-12">
                            @if($type == 1)
                                <div class="form-group">
                                    <label for="example-select">Country* </label>
                                <input type="text" class="form-control" name="country" placeholder="" value="{{$data[0]->country}}" >
                                </div>
                                <div class="form-group">
                                    <label for="example-select">Email (GUI Software Download)*</label>
                                    <input type="text" class="form-control " name="email_gui" placeholder="" value="{{$data[0]->email_gui}}"  >
                                    <span>Example : mail1@gmail.com,mail2@gmail.com</span>
                                </div>
                            @elseif($type == 2)
                            <div class="form-group">
                                <label for="example-select">Subject*</label>
                                <select class="js-select2 form-control" id="subject" name="subject"  data-placeholder="Choose one.." >
                                        <option></option>
                                        <option value="0" {{$data[0]->subject == 0 ?'selected':''}}>Sale Enquiries</option>
                                        <option value="1" {{$data[0]->subject == 1 ?'selected':''}}>Products and Service Support</option>
                                        <option value="2" {{$data[0]->subject == 2 ?'selected':''}}>General Comments</option>
                                </select>
                            </div>
                            @elseif($type == 3)
                            <div class="form-group">
                                    <label for="example-select">Product type*</label>
                                    <select class="js-select2 form-control" id="pro_categories" name="pro_categories"  data-placeholder="Choose one.." required>
                                        <option></option>
                                        @foreach($subCategories as $sub)
                                        <option {{$data[0]->product_type == $sub->sub_pro_id ?'selected':''}} value="{{$sub->sub_pro_id}}">{{$sub->name}}</option>
                                        @endforeach
                                    </select>
                            </div>
                            @endif
                        <div class="form-group">
                            <label for="example-select">Email (Feedback Form)* </label>
                            <input type="text" class="form-control" name="email" placeholder="" value="{{$data[0]->email}}" >
                            <span>Example : mail1@gmail.com,mail2@gmail.com</span>
                        </div>
                        <div class="text-center mb-3">
                            <button class="btn btn-primary" type="submit" >Update </button>
                            <a href="{{route('emailnotification',$type)}}"  class="btn btn-secondary">
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

@endsection
