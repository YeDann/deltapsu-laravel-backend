@extends('layouts.front-end')
@section('css')
<style>

</style>
@endsection
@section('meta')
<title>{{isset($metatag[0]->title)? $metatag[0]->title :''}}</title>
<meta name="description" content="{{isset($metatag[0]->description)? $metatag[0]->description :''}}">
<link rel="canonical" href="{{url()->current()}}" />
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
                    <li class="breadcrumb-item active text-breadcrumb" aria-current="page"><a href="#">Change
                            Password</a></li>

                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="padding-top-content-breadcrumb visible-up-922"></div>
{{-- <div class="visible-tablets-up visible-mobile"> --}}
    <div class="box-login pb-5">
        <div class="container">
            <h1 class="text-title-delta">Change Your Password</h1>
            <form id="loginform" onsubmit="resetPassFunction()">
                <div class="center">
                    <div id="requestpin" class="col-sm-6 w-100 mx-auto mb-3">
                        <label class="text-title-detail-dark">Pin*</label>
                        <input type="text" class="input-login" name="pin" id="pin" placeholder="Confirm Pin" required>
                    </div>

                    <div id="requestpassword" class="col-sm-6 w-100 mx-auto mb-3">
                        <label class="text-title-detail-dark">{{$staticContent['Password']}}*</label>
                        <input type="password" class="input-login" name="password" id="inputPassword"
                            placeholder="{{$staticContent['Password']}}" minlength="8" pattern="{8,}"
                            title="Must contain at least 8 or more characters" required>
                    </div>
                    <div id="requestpasswordConfrim" class="col-sm-6 w-100 mx-auto mb-3">
                        <label class="text-title-detail-dark">*Confirm Password</label>
                        <input type="password" class="input-login" on name="confrimpassword" id="confrimpassword"
                            placeholder="Confirm Password" minlength="8" pattern="{8,}"
                            title="Must contain at least 8 or more characters" required
                            onkeyup="comfirmNewPass(); return false;">
                        <div id="confirmMessage3"></div>
                    </div>
                    <h5 class="text-center" id="loginerormassage"></h5>
                    <h5 class="text-center" id="loginsuccessmassage"></h5>

                    <div class="col-sm-4 text-center mx-auto my-4">
                        <button type="submit" class="btn-subscribe">Change</button>
                    </div>
                </div>
            </form>



        </div>

    </div>



    @endsection


    @section('js')
    <script>
        function comfirmNewPass()
    {
        //Store the password field objects into variables ...
        var pass1 = document.getElementById('inputPassword');
        
        var pass2 = document.getElementById('confrimpassword');

          console.log(pass2.value);
        var message = document.getElementById('confirmMessage3');
    
        var goodColor = "#66cc66";
        var badColor = "#ff6666";
    
        if(pass1.value == pass2.value){
            // pass2.style.backgroundColor = goodColor;
            message.style.color = goodColor;
            message.innerHTML = "Passwords Match!"
        }else{
            // pass2.style.backgroundColor = badColor;
            message.style.color = badColor;
            message.innerHTML = "Passwords Do Not Match!"
        }
    }  
    
   
    </script>
    <script>
        function resetPassFunction(){
    var  formData = {
                    'pin': $("#pin").val(),
                    'confrimpassword': $("#confrimpassword").val(),
                    'password': $("#inputPassword").val()
                };
                // console.log(formData);
                event.preventDefault();
      
           if(formData.confrimpassword === ""){
            $('#requestemail').addClass('request');
           }else if(formData.password === ""){
            $('#requestpassword').addClass('request');
            // console.log('Empty Password');
            }else if(formData.pin === ""){
            $('#pin').addClass('request');
           
           } else if(formData.confrimpassword === "" && formData.password === ""){
            $('#requestpasswordConfrim').addClass('request');
            $('#requestpassword').addClass('request');
           }else if(formData.confrimpassword != "" && formData.password != "" && formData.pin ){
            $.ajax({
                url: "{{route('resetPassword')}}",
                data: formData,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                if(data['status'] == 1){
                    window.location = "{{route('index','login')}}";
                }else{
                    $('#loginerormassage').text(data['message']);
                }
                }
            });

           }
       
         
    }
    </script>


    @endsection