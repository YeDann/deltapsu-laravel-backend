@extends('layouts.front-end')
@section('css')
<style>
    .cbx span:last-child {
    padding-left: 8px;
    font-size: 14px;
     width: auto !important;
}
</style>
@endsection
@section('meta')
<title>{{isset($metatag[0]->meta_title)? $metatag[0]->meta_title :''}}</title>
<meta name="description" content="{{isset($metatag[0]->meta_description)? $metatag[0]->meta_description :''}}">
<meta name="keywords" content="{{isset($metatag[0]->meta_key) ? $metatag[0]->meta_key :''}}">
@endsection
@section('container')
<div class="padding-top-content">
</div>
<div class="products-index-banner" id="products-index-banner-type">
    <div class="products-index-nav">
        <div class="bg-bredcrumb">
            <div class="container">
                <nav aria-label="breadcrumb" id="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item text-breadcrumb-home">
                            <a href="{{route('index','home')}}">{{$staticContent['Home']}}</a>
                        </li>
                        <li class="breadcrumb-item active text-breadcrumb" aria-current="page">
                            <a  href="#">{{$staticContent['Subscribe']}}</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="padding-top-content-breadcrumb"></div>
    <div class="container">
        <h2 class="text-title-delta visible-up-922">{{$staticContent['Subscribe']}}</h2>
        <h3 class="text-title-delta invisible-up-922">{{$staticContent['Subscribe']}}</h3>
        <div class="col-12 mt-4 text-center">
            Subscribe to DeltaPSU newsletter and be the first to know about our new product releases and industry knowledge.
        </div>
        <form   action="{{route('subscribe')}}" name="formsub" onsubmit="return submitsubscribeFrompage()" method="POST" >
            {{csrf_field()}}
            <div class="container">
                <div class="row mt-3 mb-3 justify-content-center">
                    <div class="col-lg-6">
                        <div class="select input-label w-100 my-4">
                            <h6 class="mb-0" ><label class="text-dark">{{$staticContent['Country']}}<span class="red">*</span></label></h6>
                            <select name="country" class="form-control" id="countryId" required>
                                <option value="">{{$staticContent['Select']}} {{$staticContent['Country']}}</option>
                                @foreach ($mail_chimp_country as $email)
                                <option value="{{$email->name}}">{{$email->name}}</option>
                                @endforeach
                            </select>
                        </div> 
                        <div class="input-label w-100 my-4">
                            <h6 class="mb-0" ><label class="text-dark">{{$staticContent['Email_Address']}}<span class="red">*</span></label></h6>
                            <input type="email" class="form-control" name="email" required="required" placeholder="Email Address">
                            {{-- <label for="email">Email Address</label> --}}
                        </div>
                        <div class="input-label w-100 my-4">
                            <h6 class="mb-0" ><label class="text-dark">{{$staticContent['Name']}}<span class="red">*</span></label></h6>
                            <input type="text" class="form-control" pattern="[A-Za-zก-๏\s]+" name="name" required="required" placeholder="Name">
                           {{--  <label for="email">Name</label> --}}
                        </div>
                     
                        <div class="col-lg-12 text-center">
                            <div> You understand and agree to our <a href="{{route('privacyPolicy')}}" class="text-underline text-bold"> {{$staticContent['Privacy_Policy']}}</a>.</div>
                            <div class="box-input-checkbox mb-4">
                                <input class="inp-cbx" name="accept" id="cx-sign-up-sub" onclick="chagedata()" value="0" type="checkbox"
                                    style="display: none;" />
                                <label class="cbx" for="cx-sign-up-sub"><span>
                                        <svg width="12px" height="10px" viewbox="0 0 12 10">
                                            <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                        </svg></span><span>{{$staticContent['I_have_read_and_accept']}}</span></label>
                            </div>
                        
                        </div>
                        {{-- <p class="text-one mb-4">{{$staticContent['To_unsubscribe']}}</p> --}}
                        <div class="text-center">
                            <button type="submit" class="btn btn-subscribe mt-lg-0 mt-3">{{$staticContent['Subscribe']}}</button>
                        </div>
                     
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('js')
<script>
function submitsubscribeFrompage(){
    //  alert(document.formsub.accept.value );
    if(document.formsub.accept.value == 0 || document.formsub.accept.value == null) {
      alert("Please accept the privacy policy.");
      return false;
    } else {
        document.formsub.submit();
    }
   

  }
  function chagedata(){
      $('#cx-sign-up-sub').val(1);
  }
</script>
@endsection