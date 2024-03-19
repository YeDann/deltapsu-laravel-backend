@extends('layouts.front-end')
@section('css')
<style>

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
    <h1 class="text-title-delta visible-tablets-up"> {!!$static_content->title !!}</h1>
    <h3 class="text-title-delta visible-mobile"> {!!$static_content->title !!}</h3>
    <div class="container">
        {!!$static_content->content !!}
        {{-- <h4 class="mt-5">Cookies</h4> --}}
        {{-- <script id="CookieDeclaration"
            src="https://consent.cookiebot.com/0b87f4dd-13cf-473e-b5c7-019f4154d02a/cd.js" type="text/javascript" async>
        </script> --}}
        {{-- <p class="text-title-detail mr-b-1">Policy Overview</p>
        Personal information is information that can be used to uniquely identify or contact a single person. DeltaPSU
        may obtain personal information about individuals when such individuals specifically provide such information to
        DeltaPSU.com, such as by registering Delta Power Supply products, purchasing a Delta power Supply product,
        contacting sales, creating a web account, requesting support, participating in a marketing/sales promotion or
        online survey, requesting marketing materials, and through other means.
        <br><br>
        DeltaPSU respects your right to privacy. This Privacy Policy applies to our Websites (www.deltapsu.com). This
        Privacy Policy governs our data collection, processing and usage practices. It also describes your choices
        regarding use, access and correction of your personal information. If you do not agree with the data practices
        described in this Privacy Policy, you should not use the Websites or the Subscription Service.
        <br><br>
        <p class="text-title-detail mr-b-1">Security</p>
        DeltaPSU maintains appropriate safeguards, consistent with the standards of the industry, to ensure the
        security, integrity and privacy of personal information collected from individuals.
        <br><br>
        <p class="text-title-detail mr-b-1">Amendments to The Privacy Policy</p>
        We may modify the Privacy Policy at any time, so please review this page frequently. If the changes are
        significant, we will provide a more prominent notice by sending you an email notification.
        <br><br>
        <p class="text-title-detail mr-b-1">Information We Collect and How We Use</p>
        <p class="text-bold mr-b-1"> Feedback Form</p>
        We keep feedback form submissions for a certain period for customer service purposes and marketing purposes.
        <br><br>
        <p class="text-bold mr-b-1">Our Representative</p>
        We collect information, mostly the information on your business card, and information you provide to our
        representative, in order to provide newsletters, technical supports, promotion activities, events, and product
        information to you.
        <br><br>
        <p class="text-bold mr-b-1">Embedded Content From Other Websites</p>
        Articles on this site may include embedded content (e.g. videos, images, articles, etc.). Embedded content from
        other websites behaves in the exact same way as if the visitor has visited the other website. These websites may
        collect data about you, use cookies, embed additional third-party tracking, and monitor your interaction with
        that embedded content, including tracing your interaction with the embedded content if you have an account and
        are logged in to that website.
        <br><br>
        <p class="text-bold mr-b-1">Analytics</p>
        Our entire website uses Google Analytics. If you would like to know what information they collect, please review
        their <a href="https://policies.google.com/privacy?hl=en" target="_blank">policy</a>.
        <br><br>
        <p class="text-title-detail mr-b-1">How Long We Retain Your Data</p>
        In general, DeltaPSU will retain your personal data as long as it is needed for the respective purpose of data
        processing. Where we process personal data for marketing purposes or with your consent, we process the data
        until you ask us to stop and for a short period after this (to allow us to implement your requests). We also
        keep a record of the fact that you have asked us not to send you direct marketing or to process your data so
        that we can respect your request in future.
        <br><br>
        <p class="text-title-detail mr-b-1">What Rights You Have</p>
        You can request access, correction, updates or deletion of your personal information. You may unsubscribe our
        e-newsletter by clicking on the "unsubscribe" link located on the bottom of our e-mails, updating your
        communication preferences. When you are under GDPR regulation, to exercise any of these rights you can get in
        touch with us using the details set out below. If you have unresolved concerns, you have the right to complain
        to an EU data protection authority where you live, work or where you believe a breach may have occurred.
        <br><br>
        <p class="text-title-detail mr-b-1">Contact</p>
        If you have any questions about this Privacy Policy or our treatment of the information you provide us, please
        write to us by email at <a href="mailto:info@deltapsu.com">info@deltapsu.com</a>. --}}

    </div>
</div>
@endsection
@section('js')
@endsection