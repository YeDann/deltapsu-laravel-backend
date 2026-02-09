@extends('layouts.front-end')
@section('css')
<style>

</style>
@endsection
@section('meta')
<title>{{isset($metatag[0]->title)? $metatag[0]->title :''}}</title>
<meta name="description" content="{{isset($metatag[0]->description)? $metatag[0]->description :''}}">
<link rel="canonical" href="{{url()->current()}}" />
<?php
  $lang_seo = App::getLocale();
  if($lang_seo == 'cn'){
    $lang_seo = 'zh-Hans-CN';
  }else if($lang_seo == 'tw'){
    $lang_seo = 'zh-Hans-TW';
  }
?>
<link rel="alternate" href="{{url()->current()}}" hreflang="{{$lang_seo}}" />
@endsection
@section('container')
<div class="padding-top-content">
</div>
<div class="products-index-nav visible-up-922">
    <div class="bg-bredcrumb">
        <div class="container">
            <nav aria-label="breadcrumb" id="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item text-breadcrumb-home"><a
                            href="{{route('index','home')}}">{{$staticContent['Home']}}</a></li>
                    {{-- <li class="breadcrumb-item active text-breadcrumb-home dropdown" aria-current="page"><a
                            href="#" data-toggle="dropdown" id="tools-dropdown">DOWNLOADS</a>
                        <ul class="dropdown-menu">
                            <li><a href="#" id="tools-dropdown" class="text-bold">DOWNLOADS</a></li>
                            <hr>
                            <li><a href="{{route('index','catalogs')}}">CATALOGS</a></li>
                            <li><a href="{{route('index','product-documents')}}">PRODUCT DOCUMENTS</a></li>

                        </ul>
                    </li> --}}
                    <li class="breadcrumb-item active text-breadcrumb" aria-current="page"><a
                            href="#">{{$staticContent['Partners_Login']}}</a></li>

                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="padding-top-content-breadcrumb visible-up-922"></div>
{{-- <div class="visible-tablets-up visible-mobile"> --}}
    <div class="box-login pb-5">
        <div class="container">
            <h1 class="text-title-delta">{{$staticContent['Partners_Login']}}</h1>
            <form id="loginform" method="POST" action="{{route('partnerLogin')}}" autocomplete="off">
                {{csrf_field()}}
                <div class="center">
                    <div id="requestemail" class="col-sm-6 w-100 mx-auto mb-3">
                        <label class="text-title-detail-dark">{{$staticContent['Email_Address']}}*</label>
                        <input type="email" class="input-login border-radius-6" name="email" id="inputEmail"
                            placeholder="{{$staticContent['Email_Address']}}" autocomplete="off" required>
                    </div>

                    <div id="requestpassword" class="col-sm-6 w-100 mx-auto mb-3">
                        <label class="text-title-detail-dark">{{$staticContent['Password']}}*</label>
                        <input type="password" class="input-login border-radius-6" name="password" id="inputPassword" pattern="{8,}"
                            title="Must at least 8 or more characters" autocomplete="off" placeholder="{{$staticContent['Password']}}"
                            required>
                    </div>
                    @if(Session::has('flash_message_eror'))
                    <h5 class="text-center" id="loginerormassage"> {!! Session('flash_message_eror') !!}</h5>
                    @endif
                    <div class="col-sm-4 text-center mx-auto my-4">
                        <button type="submit" class="btn-subscribe">{{$staticContent['Login']}}</button>
                    </div>
                </div>
            </form>

            <div class="w-100 text-center mb-3">
                <a data-toggle="modal" data-target="#confirm-email-forgot-pass"
                    class="btn-forget">{{$staticContent['Forgot_Password']}}</a>

            </div>


        </div>

    </div>
    {{--
</div> --}}
{{-- <div class="visible-mobile">
    <div class="box-login-mobile">
        <div class="container">
            <h4 class="text-title-mobile-dark text-center">PARTNERS LOGIN</h4>
            <form class="text-center">
                <div class="form-group row">
                    <div class="col-12">
                        <label for="inputEmail" class="label-input-mobile">Email</label>
                        <input type="email" class="input-login-mobile" id="inputEmail" placeholder="Email Address">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-12">
                        <label for="inputPassword" class="label-input-mobile">Password</label>
                        <input type="password" class="input-login-mobile" id="inputPassword" placeholder="Password">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-12">
                        <button type="submit" class="btn-login-mobile">LOGIN</button>

                    </div>

                </div>
                <a href="" class="btn-forget-mobile">FORGET PASSWORD?</a>
            </form>
        </div>

    </div>
</div> --}}

<div class="modal fade p-1" id="confirm-email-forgot-pass" tabindex="-1" role="dialog"
    aria-labelledby="subscribe-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content ">
            <div class="modal-header pl-4">
                <h4 class="text-color-delta mb-0" id="subscribe-modal-title">{{$staticContent['Confirm_Email']}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-4 mb-4">
                <form action="{{route('checkpartnerAccount')}}" method="POST">
                    {{csrf_field()}}

                    <div class="input-label w-100 my-4">
                        <h6 class="mb-0"><label class="text-dark">{{$staticContent['Email_Address']}}<span
                                    class="red">*</span></label></h6>
                        <input type="email" class="form-control" name="email" required="required"
                            placeholder="Email Address" required>

                    </div>

                    <p class="text-one mb-4">{{$staticContent['instructions_to_reset_your_password']}}</p>
                    <button type="submit" class="btn btn-subscribe">{{$staticContent['Send']}}</button>
            </div>
            </form>

        </div>
    </div>
</div>

@endsection


@section('js')
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/aes.js"></script>
<script src="http://crypto-js.googlecode.com/svn/tags/3.1.2/build/rollups/md5.js"></script> --}}
<script>
    //  function loginFunction(){
//      console.log();

//     var  formData = {
//                     'email': $("#inputEmail").val(),
//                     'password': ectp($("#inputPassword").val())
//                 };
//                 console.log(formData);
//                 event.preventDefault();

//            if(formData.email === ""){
//             $('#requestemail').addClass('request');
//            }else if(formData.password === ""){
//             $('#requestpassword').addClass('request');
//             console.log('Empty Password');
//            } else if(formData.email === "" && formData.password === ""){
//             $('#requestemail').addClass('request');
//             $('#requestpassword').addClass('request');
//            }else if(formData.email != "" && formData.password != "" ){
//             $.ajax({
//                 url: "",
//                 data: formData,
//                 type: 'POST',
//                 headers: {
//                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//                 },
//                 success: function (data) {
//                 if(data['status'] == 1){
//                     window.location = "{{route('index','partners')}}";
//                 }else{
//                     $('#loginerormassage').text(data['message']);
//                 }
//                 }
//             });

//            }


//     }
//     function ectp(data){
//        var hs = MD5(data);
//         return hs;
//     }
</script>


@endsection
