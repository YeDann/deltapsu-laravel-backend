@extends('layouts.front-end')
@section('css')
<style>
  .sub-intext>li {
    list-style: none
  }
</style>
@endsection
@section('meta')
<title>{{isset($metatag[0]->meta_title)? $metatag[0]->meta_title :''}}</title>
<meta name="description" content="{{isset($metatag[0]->meta_description)? $metatag[0]->meta_description :''}}">
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
<div class="box-privacy mb-5">
  <h2 class="text-title-delta visible-tablets-up"> {!!$static_content->title !!}</h2>
  <h3 class="text-title-delta visible-mobile"> {!!$static_content->title !!}</h3>
  <div class="container">
    {!!$static_content->content !!}
    {{-- <h4 class="text-color-delta visible-tablets-up">Website Terms Of Use Agreement</h2>
      <h5 class="text-color-delta visible-mobile">Website Terms Of Use Agreement</h3>
        <p class="mb-3">By using this website, you agree to comply with and be bound by the following terms of use.
          Please carefully review the following terms.</p>
        <p>These terms apply to the website of the Delta Group companies.</p>
        <ul>
          <li>
            <h6 class="text-color-delta">ACCEPTANCE</h6>
            <p>You agree to the terms and conditions in this Terms of Use Agreement ("Agreement") with respect to our
              website (the "Website"). This Agreement may be amended at any time without specific notice to you.</p>
          </li>
          <li>
            <h6 class="text-color-delta">COPYRIGHT</h6>
            <p>All of the Website's content, text and images, are protected by copyright and are owned or controlled by
              © Delta Electronics, Inc., or the party credited as provider of such content, and may not be reproduced or
              modified without permission.</p>
          </li>
          <li>
            <h6 class="text-color-delta">TRADEMARKS</h6>
            <p>Delta Electronics trademarks of Delta Electronics, Inc. Other product and company names mentioned on the
              Website are trademarks of their respective owners.</p>
          </li>
          <li>
            <h6 class="text-color-delta">PERMITTED USES</h6>
            <p>You are permitted to use the content of the Website on one single website only, unless prior written
              permission from Delta is obtained. You may use Delta's Website content on a website, provided that:</p>

            <p> a) You do not imply that you created the content—text and images; </p>
            <p> b) You do not imply or claim that the content is a unique work; and</p>
            <p> c) You do not claim any ownership of copyright over any of the content from Delta's website.</p>
          </li>
          <li>
            <h6 class="text-color-delta">RESTRICTIONS</h6>
            <p>You are restricted from using content of the Website in the following manner:</p>
            <p> a) You may not use Delta's logo, wording, graphics, trademarks (whether registered or un-registered) or
              any other element or elements that comprise Delta's brand or the Websites' general "look and feel", to
              produce a Website or any other work.</p>
            <p> b) You may not use the Website's content to produce material that is obscene, racist, pornographic, or
              otherwise of an offensive or adult nature.</p>
          </li>
        </ul> --}}

  </div>
</div>


@endsection


@section('js')

@endsection