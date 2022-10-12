<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1, minimum-scale=1.0,maximum-scale=1,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge;chrome=1" />
    <link rel="shortcut icon" href="{{asset('/frontend-asset/image/icon/delta_favicon.ico')}}" type="image/x-icon">
    <link rel="icon" href="{{asset('/frontend-asset/image/icon/delta_favicon.ico')}}" type="image/x-icon">
    <!-- CSRF Token -->
    <meta name="robots" content="index, follow">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('meta')
    <!-- Bootstrap CSS -->
    <link rel="stylesheet"  rel="preload" type="text/css" href="{{asset('/frontend-asset/css/font.css')}}" media="screen"/>
    <link rel="stylesheet" type="text/css" href="{{asset('/frontend-asset/css/bootstrap.min.css')}}"  media="screen"/>
    <link rel="stylesheet" type="text/css" href="{{asset('/frontend-asset/css/header-front.css')}}" media="screen"/>
    <link rel="stylesheet" type="text/css" href="{{asset('/frontend-asset/css/container.css')}}" media="screen"/>
    <link rel="stylesheet" type="text/css" href="{{asset('/frontend-asset/css/home.css')}}" media="screen"/>
    <link rel="stylesheet" type="text/css" href="{{asset('/frontend-asset/css/news.css')}}" media="screen"/>
    <link rel="stylesheet" type="text/css" href="{{asset('/frontend-asset/css/login.css')}}" media="screen"/>
    <link rel="stylesheet" type="text/css" href="{{asset('/frontend-asset/css/details.css')}}" media="screen"/>
    <link rel="stylesheet" type="text/css" href="{{asset('/frontend-asset/css/result-page.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/frontend-asset/css/product-comparison.css')}}" media="screen"/>
    <link rel="stylesheet" type="text/css" href="{{asset('/frontend-asset/css/vanilla-calendar-min.css')}}" media="screen"/>
    <link rel="stylesheet" type="text/css" href="{{asset('/frontend-asset/css/fontello.css')}}" media="screen"/>
    <link rel="stylesheet" type="text/css" href="{{asset('/frontend-asset/material-design-iconic-font/css/material-design-iconic-font.min.css')}}" media="screen"/>
    <link rel="stylesheet" type="text/css" href="{{asset('/frontend-asset/css/owl.theme.default.css')}}" media="screen"/>
    <link rel="stylesheet" type="text/css" href="{{asset('/frontend-asset/css/owl.carousel.min.css')}}" media="screen"/>
    <link rel="stylesheet" type="text/css" href="{{asset('/frontend-asset/css/product.css')}}" media="screen"/>
    <link rel="stylesheet" type="text/css" href="{{asset('/frontend-asset/css/font-awesome.css')}}" media="screen"/>
    <link rel="stylesheet" type="text/css" href="{{asset('/frontend-asset/css/datatables.css')}}" media="screen"/>
    <link rel="stylesheet" type="text/css" href="{{asset('/backend-asset/js/plugins/dropzone/dist/min/dropzone.min.css')}}" media="screen">
    <link rel="stylesheet" type="text/css" href="{{asset('/frontend-asset/css/slick.css')}}" media="screen"/>
    <link rel="stylesheet" type="text/css" href="{{asset('/frontend-asset/css/nouislider.min.css')}}"  media="screen"/>
    <link rel="stylesheet" type="text/css" href="{{asset('/frontend-asset/css/jquery.datepicker.css')}}" media="screen"/>
    <link rel="stylesheet" type="text/css" href="{{asset('/frontend-asset/css/zabuto_calendar.css')}}" media="screen" />
    <link rel="stylesheet" type="text/css" href="{{asset('/frontend-asset/css/fontello2.css')}}" media="screen"/>
    @yield('css')
    <style>
      /* select */
    .form-control{
        font-size: 14px;
      -webkit-appearance: none;
      -moz-appearance: none;
      border-radius: 0;
      border: 1px solid #444444; background-position: right 50%;
      background-repeat: no-repeat;
      background-image: url('{{asset('frontend-asset/image/arrow-down.svg')}}');
      padding: .375rem 1.5rem;
  
    }
    .form-control:disabled, .form-control[readonly] {
      background-color: #F2F2F2;
      border: 1px solid #C1C1C1 !important;
      opacity: 1;
      color: #C1C1C1;
      background-image:none;
    }
    .form-control:focus {
      color: #495057;
      background-color: #fff;
      border-color: #80bdff;
      outline: none;
      box-shadow: none;
      }
      input[type=text],input[type=email]{
      background-image:none;
      
      }
      .input-label{
          position: relative;
      }
      input[required] + label {
          color: #707070;
          font-family: Arial;
          font-size: 14px;
          position: absolute;
          bottom: 0;
          left: 12px;  /* the negative of the input width */
      }
      
      .form-control:focus {
      color: #495057;
      background-color: #fff;
      border-color: #80bdff;
      outline: none;
      box-shadow: none;
      }
 
      
      .color-yellow{
        background-color: #252A2C;
        color: #fff;
        text-align: center;
        position: relative;
        bottom: 0;
        left: 0;
        right: 0;
        z-index: 99;
      }
   
      html[lang="de"] .navbar-expand-lg .navbar-nav .nav-link {
        padding: 20px 9px;
      }
      html[lang="ru"] .navbar-expand-lg .navbar-nav .nav-link {
        padding: 20px 9px;
      }
      a#CybotCookiebotDialogPoweredbyCybot,
      div#CybotCookiebotDialogPoweredByText {
        display: none !important;
      }
      #CookiebotWidget .CookiebotWidget-body .CookiebotWidget-main-logo {
         display: none !important;
      }
   
      #CybotCookiebotDialogHeader {
         width: 0px !important;
     }
     #CybotCookiebotDialog.CybotEdge {
      padding:12px !important;
     }
     
     #CybotCookiebotDialog.CybotEdge .CybotCookiebotDialogBodyBottomWrapper {
       margin-top: 0 !important;
    }
    /* #CybotCookiebotDialog.CybotEdge.CybotMultilevel .CybotCookiebotDialogBodyBottomWrapper {
    border-top: none !important;
    } */

    @media screen and (min-width: 1280px){
      #CybotCookiebotDialog.CybotEdge.CybotMultilevel .CybotCookiebotDialogBodyBottomWrapper {
    border-top: 1px solid #fff !important;

      }
    }
    #CookiebotWidget .CookiebotWidget-body .CookiebotWidget-consents-list li.CookiebotWidget-approved svg {
    fill: #0087DC !important;
    }
    #CookiebotWidget .CookiebotWidget-consent-details button {
    color: #0087DC !important;
   }
    #CookiebotWidget #CookiebotWidget-buttons #CookiebotWidget-btn-change{
      background-color: #0087DC !important;
       border-color:#0087DC !important;
    }
    #CookiebotWidget #CookiebotWidget-buttons #CookiebotWidget-btn-withdraw{
      border-color:#0087DC !important;
    }
      
    @media only screen and (max-width: 1366px) {
          html[lang="ru"] .navbar-expand-lg .navbar-nav .nav-link {
          padding: 20px 4px !important;
      }
      html[lang="de"] .navbar-expand-lg .navbar-nav .nav-link {
        padding: 20px 4px !important;
        font-size: 14px !important;
      }
    }
  
  </style>
    <!-- Fonts -->
    <!-- Styles -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    
     <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-67607418-1"></script>
      <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'UA-67607418-1');
      </script>

      <!-- Google Tag Manager -->
        <script>
          (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':

            new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
            
            })(window,document,'script','dataLayer','GTM-PBXMMSN');
        </script>
      <!-- End Google Tag Manager -->
    
</head>
<body>
    @include('layouts.header-front')
    @yield('container')
    @include('layouts.footer')

<script type="text/javascript" src="{{asset('/frontend-asset/js/popper.min.js')}}" ></script>
<script type="text/javascript" src="{{asset('/frontend-asset/js/bootstrap.min.js')}}" ></script>
<script type="text/javascript" src="{{asset('/frontend-asset/js/bootstrap-select.min.js')}}"></script>
<script type="text/javascript" src="{{asset('/frontend-asset/js/map.js')}}"></script>
<script type="text/javascript" src="{{asset('/frontend-asset/js/product.js')}}"></script>
<script type="text/javascript" src="{{asset('/frontend-asset/js/owl.carousel.js')}}"></script>
<script type="text/javascript" src="{{asset('/frontend-asset/js/owl.carousel.min.js')}}"></script>
<script type="text/javascript" src="{{asset('/frontend-asset/js/datatables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('/frontend-asset/js/slick.min.js')}}"></script>
<script type="text/javascript" src="{{asset('/frontend-asset/js/nouislider.min.js')}}"></script>

<script type="text/javascript" src="{{asset('/frontend-asset/js/zabuto_calendar.min.js')}}"></script>
<script type="text/javascript" src="{{asset('/frontend-asset/js/mb5.js')}}"></script>
{{-- <script type="text/javascript" src="https://www.recaptcha.net/recaptcha/api.js?onload=onloadCallback&render=explicit&hl=en"
async defer>
</script> --}}


<?php
$lanngCookie = "EN";
$langch = str_replace('_', '-', app()->getLocale());

 if($langch == 'cn'){
  $lanngCookie = "ZH";
 }else if($langch == 'tw'){
  $lanngCookie = "ZH-HANT";
 }else if($langch == 'de'){
  $lanngCookie = "DE";
 }else if($langch == 'ru'){
  $lanngCookie = "RU";
 }else if($langch == 'jp'){
  $lanngCookie = "JA";
 }

?>


<script id="Cookiebot"  data-culture="{{$lanngCookie}}" src="https://consent.cookiebot.com/uc.js" data-cbid="0b87f4dd-13cf-473e-b5c7-019f4154d02a" data-blockingmode="auto" type="text/javascript"></script> 

<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
    async defer>
</script>
<script>
  if ('loading' in HTMLImageElement.prototype) {
    const images = document.querySelectorAll('img[loading="lazy"]');
    images.forEach(img => {
      img.src = img.dataset.src;
    });
  
    const imageDiv = document.querySelectorAll('div[loading="lazy"]');
     imageDiv.forEach(imgD => {
       imgD.style.backgroundImage = "url('"+imgD.dataset.src+"')";
    });
  } else {
    const imageDiv = document.querySelectorAll('div[loading="lazy"]');
     imageDiv.forEach(imgD => {
       imgD.style.backgroundImage = "url('"+imgD.dataset.src+"')";
    });
    // Dynamically import the LazySizes library
    const script = document.createElement('script');
    script.src =
      'https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.1.2/lazysizes.min.js';
    document.body.appendChild(script);
  }
</script>
<script type="text/javascript">
  var verifyCallbackData = function(response) {
    $('#keyrecapgui').val(response);
  };
  var onloadCallback = function() {
    grecaptcha.render('recap_vertifygetGui', {
    //  'sitekey' : '6LdshPcUAAAAACIioRg3pa05GCUYQ9S0hVLv-4zv',
       'sitekey' : '6LeFKfYUAAAAAL-q5mHlmjUTPQ-LvlDjNtev9QhA',
      'callback' : verifyCallbackData,
      'theme' : 'light'
    });
  };
  

  function validateFormGUI(form){
               
                if(!form.acceptPolicyGui.checked){
                    $("#Support_policy_required").modal();
                    return false;
                }else if(form.keyresponseCap.value == ''){
                    $("#downloadgui-modal-vetify-robot").modal();
                    return false;
                } else{
                    return true;
                }
      }
</script>

 <!-- Google Tag Manager (noscript) -->
 <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PBXMMSN"

  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  
  <!-- End Google Tag Manager (noscript) -->
  
    @yield('js')
   
    <script>
      // https://tc39.github.io/ecma262/#sec-array.prototype.findIndex
if (!Array.prototype.findIndex) {
  Object.defineProperty(Array.prototype, 'findIndex', {
    value: function(predicate) {
     // 1. Let O be ? ToObject(this value).
      if (this == null) {
        throw new TypeError('"this" is null or not defined');
      }

      var o = Object(this);

      // 2. Let len be ? ToLength(? Get(O, "length")).
      var len = o.length >>> 0;

      // 3. If IsCallable(predicate) is false, throw a TypeError exception.
      if (typeof predicate !== 'function') {
        throw new TypeError('predicate must be a function');
      }

      // 4. If thisArg was supplied, let T be thisArg; else let T be undefined.
      var thisArg = arguments[1];

      // 5. Let k be 0.
      var k = 0;

      // 6. Repeat, while k < len
      while (k < len) {
        // a. Let Pk be ! ToString(k).
        // b. Let kValue be ? Get(O, Pk).
        // c. Let testResult be ToBoolean(? Call(predicate, T, « kValue, k, O »)).
        // d. If testResult is true, return k.
        var kValue = o[k];
        if (predicate.call(thisArg, kValue, k, o)) {
          return k;
        }
        // e. Increase k by 1.
        k++;
      }

      // 7. Return -1.
      return -1;
    }
  });
}
      </script>
    <script>
        var w = document.documentElement.clientWidth;
        var h = document.documentElement.clientHeight;

       $(window).scroll(function() {
          if ($(window).scrollTop() > 300) {
            $('#scrollUp').fadeIn();
            $('#distributor').fadeIn();
          } else {
            $('#scrollUp').fadeOut();
            $('#distributor').fadeOut();
          }
        });
       $('#scrollUp').click(function () {
         $('body,html').animate({
           scrollTop: 0
         }, 1000);
         return false;
       });
</script>
        <script>
          function subscribe() {
              document.getElementById("inp3").focus();
              $('#cxacceptPrivacy_data').val(0);
              $("#cxacceptPrivacy_data").prop("checked",false);
          }
            $(document).ready(function() {
                $(".megamenu").on("click", function(e) {
                    e.stopPropagation();
                });   
            });

             $(document).ready(function() {
                $('.sp-dropdown a.sub-menu').on("click", function(e) {
              
                  $('ul.drp-subthree').css( "display","none" )
                  $(this).next('ul').toggle();
                  e.stopPropagation();
                  e.preventDefault();

                });  
            });
        </script>
      
           <script>
            /* navbar */
              $('#nav-two').addClass('scrolled');
            $(document).ready(function() {
              $('#nav-two li a').on("click", function() {
                $('#nav-two').removeClass('bg-nav');
                $('#nav-two').addClass('scrolled');
                $('#nav-underline').show('underline');
              }); 
            });

            $(document).ready(function() {
              $('ul.navbar-nav > li > a').click(function (e) {
                  e.preventDefault();
                  $('ul.navbar-nav > li > a').removeClass('active');
                  $(this).addClass('active');
              });       
            });
            $('#search-box').hide();
            $('#search-box-mobile').hide();
            $(document).ready(function(){
              $("#dropdown08").click(function(){
                $("#search-box").toggle();
                $('#nav-two').addClass('scrolled');
                $('#breadcrumb').removeClass('scrolled');
                $('#bar-search-results-nav').removeClass('scrolled');
                document.getElementById("searchinput").focus();
                
              });
              $('#breadcrumb').removeClass('scrolled');
              $("#btn-search-mobile").click(function(){
                // $("#search-box-mobile").css("");
                $("#search-box-mobile").toggle();
         
                closeNav();

                document.getElementById("fgrgr-mobile").focus();
              });
              $("#btn-close-search").click(function(){
                document.getElementById('searchinput-mobile').value = '';
                $("#search-box-mobile").toggle();
                closeNav();
              });
            });

    
            
        </script>
      <script>
       $('.btn-sidenav').css('visibility','hidden');
     
         function toggle_visibility(id) {
            var e = document.getElementById(id);
      
            if(e.style.visibility == 'visible'){

                //  e.style.display = 'none';
                $('#in-sidenav').css('visibility','visible');
                e.style.visibility = 'hidden';
           
           } else{
                e.style.visibility = 'visible';
                $('#in-sidenav').css('visibility','hidden');
          }
         }
         /*  function openNav(e){
              e.toggle(function(){document.getElementById("Sidenav").style.width = "100%";
            document.getElementById('bg-backslidenav').style.display="block";},function(){document.getElementById("Sidenav").style.width = "0";
            document.getElementById('bg-backslidenav').style.display="none";})
          } */
          // (function($) {
          //       $.fn.clickToggle = function(func1, func2) {
          //           var funcs = [func1, func2];
          //           this.data('toggleclicked', 0);
          //           this.click(function() {
          //               var data = $(this).data();
          //               var tc = data.toggleclicked;
          //               $.proxy(funcs[tc], this)();
          //               data.toggleclicked = (tc + 1) % 2;
          //           });
          //           return this;
          //       };
          //   }(jQuery));
          // $(document).ready(function () {
          //   $('#opennav').clickToggle(function() {
          //     // openNav();
          //   }, function() {
          //     if(document.getElementById("Sidenav").style.width === "0" || document.getElementById('bg-backslidenav').style.display === "none" ){
          //       openNav();
          //     }else{
          //       closeNav();
          //     }
                
          //   });
          //   $('#filterMobile-btn').click(function() {
          //       document.getElementById("filterMobileClose").style.display ="block";
          //       document.getElementById("filterMobile").style.width = "100%";
          //       document.getElementById("filterMobileLdist").style.width = "80%";
          //   });
          // });
          // $(document).ready(function () {
          //   $('#in-sidenav').css('visibility','hidden');
          // });
          function openNav(){
            // console.log('ded');
           /*  document.getElementById("sidenavClose").style.width ="100%" */

           var e = document.getElementById('in-sidenav');
           if(e.style.visibility == 'hidden'){
           $('#in-sidenav').css('visibility','visible');
            document.getElementById("Sidenav").classList.add("show");
            document.getElementById('bg-backslidenav').style.display="block";
            $('.menu-buger').addClass('active');
           }else{
            $('#in-sidenav').css('visibility','hidden');

            document.getElementById("Sidenav").classList.remove("show");
            document.getElementById('bg-backslidenav').style.display="none";
            $('.menu-buger').removeClass('active');
           }

          }
            
          function OpenFiiter(){
                document.getElementById("filterMobileClose").style.display = 'block';
                document.getElementById("filterMobile").style.width = "100%";
                document.getElementById("filterMobileLdist").style.width = "80%";
          }

          function closeNav() {
            $('#in-sidenav').css('visibility','hidden');
           
            $('.menu-buger').removeClass('active');
            document.getElementById("Sidenav").classList.remove("show");
            document.getElementById('bg-backslidenav').style.display="none";
          
            
          } 
          function closeNavFilter(){
            document.getElementById("filterMobile").style.width ="0";
            document.getElementById("filterMobileLdist").style.width = "0";
            document.getElementById("filterMobileClose").style.display ="none";
          }
      </script>
      <script>
         $('select[name*="state"]').prop('disabled', true);
        $('select[name*="country"]').on('change', function() {
          $('select[name*="state"]').prop('disabled', false);
        });
       </script>
      <script>
        $("#nav-comparison").hide();
        $("#nav-comparison-mobile").hide();
        
        function showNavCoparison(id ,cateid){
       
          $.ajax({
           url: "{{route('checkProductSection')}}",
           data: {
          'data': id,
          'cateid':cateid,
           },
           type: 'POST',
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
           success: function (res) {
            //  console.log(res);
             $('#numberselect').text(res['data'].length);
             $('#numberselect-mobile').text(res['data'].length);
             loadcompareProduct(res['data']);
             $('#alertcomparetext').text(res['message']);
             $('#modalCompareSection').modal('show');
           }
           });

           $("#nav-comparison").show();
           $("#nav-comparison-mobile").show();
        }

        function deleteComparison(id){
          $.ajax({
           url: "{{route('RemovedataInSection')}}",
           data: {
          'data': id,
           },
           type: 'POST',
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
           success: function (res) {
           
            $('#numberselect').text(res['data'].length);
            $('#numberselect-mobile').text(res['data'].length);
            loadcompareProduct(res['data']);
            $('#alertcomparetext').text(res['message']);
             $('#modalCompareSection').modal('show');
           }
           });

        }
        
        function loadcompareProduct(data){
          var html = '';
          var text = '';
          var domainUrl = '{{config('app.url')}}';
          $.each(data, function(index,value){
              html += '<div class="media list-to-comparison " id="list-to-comparison-1">';
              html += ' <img class="mr-3" src="'+domainUrl+'/upload/thumbs/'+value['picture']+'" alt="Product Image">';
              html += '<div class="list-to-comparison-text mr-5">';
              html += '<p class="mb-0 text-to-comparison text-uppercase">'+value['catename']+'</p> ';
              html += '<p class="mb-0 text-to-comparison">'+value['seName']+' SERIES</p>';
              html += ' <h6 class="mt-0 mb-0 text-number-to-comparison">'+value['pro_code']+'</h6>';
              html += '</div>';
              html += '<div class="delete-to-comparison" onclick="deleteComparison('+value['pro_id']+');"> <i class="zmdi zmdi-close"></i></div>';
              html += '</div>';
              html += '<div class="line-coparispon"></div>';
          });
          $.each(data, function(index,value){
            text += '<div class="list-to-comparison-mobile d-flex justify-content-between " >';
            text += '<div class="list-to-comparison-text mr-5">';
            text += '<p class="mb-0 text-to-comparison text-uppercase">'+value['catename']+'</p> ';
            text += '<p class="mb-0 text-to-comparison">'+value['seName']+' SERIES</p>';
            text += '<h6 class="mt-0 mb-0 text-color-delta">'+value['pro_code']+'</h6>';
            text += '</div>';
            text += '<div class="delete-to-comparison" onclick="deleteComparison('+value['pro_id']+');"> <i class="zmdi zmdi-close"></i></div>';
            text += '</div>';
          });

          $('#listAllcomparesesion').html(html);
          $('#listAllcomparesesion-mobile').html(text);
          
        }

              /* function deleteCoparison(i){
        $('#list-to-comparison-'+i).addClass('d-none');
        $('#list-to-comparison-none-'+i).removeClass('d-none');
        
      } */
        function bigImg(image ,id){
          // console.log(image);
           if(image != ''){
            $('.imageNav'+id).attr('src' ,'{{config('app.url')}}/medias/categories/'+image);
           }else {
            $('.imageNav'+id).attr('src' ,'{{asset('frontend-asset/image/blank.png')}}');
         
           }
        }
        function mainCate(id){
          // console.log(id);
          if(id == 'sub1'){
            $('.imageNav2').attr('src' ,"{{asset('frontend-asset/image/Industrial_Power_Supplies.png')}}");
          }else if(id == 'sub2'){
            $('.imageNav1').attr('src' ,"{{asset('frontend-asset/image/Medical-Power-Supplies.png')}}");
          }
        
        
          $('.sub-menu').removeClass('active')
          $('#'+id).addClass('active');
        }
        function showListCoparison(){
          document.getElementById("nav-comparison-mobile").style.height ="fit-content";
          document.getElementById("editList").style.display ="none";
        }
        function hideListCoparison(){
          document.getElementById("nav-comparison-mobile").style.height ="80px";
          document.getElementById("editList").style.display ="block";
        }
        function changeLangLocationmobile(){
          var link =  $('#select-mobile-lang').val();
          // var nameArr = link.split(',');
          window.location = link;
          // console.log(nameArr ,link );
          // setlocaltion(nameArr[1] , nameArr[0]);
        }
        function setlocaltion(lang ,link){
          // console.log(lang);
          $.ajax({
           url: "{{route('setlocaltion')}}",
           data: {
          'lang': lang,
           },
           type: 'POST',
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
           success: function (res) {
            //  console.log(res);
             window.location = link;
           }
          });

        }

      </script>
       <script>
         $( "#formseachall" ).submit(function( event ) {
              var key = $('#searchinput').val();
              var newkey = key.replace(/[/]/g,'@');
            //  console.log();
              event.preventDefault();
              window.location = '{{route('searchAll')}}/'+newkey;
         });
         $( "#formseachall_mobile" ).submit(function( event ) {
              var key = $('#searchinput-mobile').val();
              var newkey = key.replace(/[/]/g,'@');
              event.preventDefault();
              window.location = '{{route('searchAll')}}/'+newkey;
         });


        </script>
        <script>
          $(document).ready(function() {
            //  checkCookie();
          });
          function resetTime(){
             var hours = 24; // Reset when storage is more than 24hours
             var now = new Date().getTime();
             var setupTime = localStorage.getItem('setupTime');
             if (setupTime == null) {
                 localStorage.setItem('setupTime', now)
             } else {
                 if((now-setupTime) > hours*60*60*1000) {
                     localStorage.clear()
                     localStorage.setItem('setupTime', now);
                 }
             }
          }

          function setCookie(cname,cvalue,exdays) {
              var d = new Date();
              d.setTime(d.getTime() + (exdays*24*60*60*1000));
              var expires = "expires=" + d.toGMTString();
              document.cookie = cname + "=" + cvalue + ";samesite=strict;" + expires + ";path=/";
         }

        function getCookie(cname) {
          var name = cname + "=";
         var decodedCookie = decodeURIComponent(document.cookie);
         var ca = decodedCookie.split(';');
          for(var i = 0; i < ca.length; i++) {
           var c = ca[i];
            while (c.charAt(0) == ' ') {
            c = c.substring(1);
            }
           if (c.indexOf(name) == 0) {
         return c.substring(name.length, c.length);
           }
        }
        return "";
        }
        function setcokie(){
          // console.log('setCokie')
          setCookie("cgPolicy_psu", 1, 60);
          checkCookie();
        }
        function deleteCokie(){
          document.cookie = "cgPolicy_psu=1;expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        }

        function checkCookie() {
          // deleteCokie();
         var status = getCookie("cgPolicy_psu");
        if (status == "") {
         $('#accept_Cookie').addClass('active');
         }else {
          if (status != "" && status != null) {
          $('#accept_Cookie').removeClass('active');
          }
       }
     } 


          function removeCookie(){
             localStorage.setItem('isshow', 1);
           
          }
     </script>
      <script>
        $("div.sp-dropdown" ).on("mouseleave", function() {
             $('#nav-uderline').removeClass('active');
              $('.sp-dropdown').removeClass('show');
              $('.sub-menu').removeClass('active');
              $('#sub1').removeClass('show');
              $('.drp-subthree').css('display','none');
        })
     
      </script>
      <script>
        function downloadGUI(file , procode ,proCate){
          $('#procodeGui').val(procode);
          $('#procateGui').val(proCate);
          $('#fileguidownload').val(file);
        }
        function checkacceptPolicy(){
            if($('#cxacceptPrivacy_data').val() == 0){
              $('#cxacceptPrivacy_data').val(1);
            }else{
              $('#cxacceptPrivacy_data').val(0);
            }
        }
        function  checkGuiSub(){
          if($('#cxguiup').val() == 0){
              $('#cxguiup').val(1);
            }else{
              $('#cxguiup').val(0);
            }
        }
        function submitsubscribe(){
          if(document.frmMr.accept.value == 0 || document.frmMr.accept.value == null || document.frmMr.accept.value == "") {
            alert("Please accept the privacy policy.");
            return false;
          } else {
              document.frmMr.submit();
          }
        }
        function resetfield(){
          $('#cxacceptPrivacy_data').val(0);
          $("#cxacceptPrivacy_data").prop("checked" ,false);
        }
        @if(Session::has('subscribes_already'))
        $(document).ready(function() {
             $("#success_subscribe_already").modal();
          });
        @endif

        @if(Session::has('subscribes_new'))
        $(document).ready(function() {
             $("#success_subscribe").modal();
          });
        @endif

        @if(Session::has('vertifynotrobot_gui'))
        $(document).ready(function() {
             $("#downloadgui-vertifynot-robot").modal();
             
          });
        @endif

      </script>
      <script>
        navigator.sayswho= (function(){
            var ua= navigator.userAgent, tem, 
            M= ua.match(/(opera|chrome|safari|firefox|msie|trident(?=\/))\/?\s*(\d+)/i) || [];
            if(/trident/i.test(M[1])){
                tem=  /\brv[ :]+(\d+)/g.exec(ua) || [];
                return 'IE '+(tem[1] || '');
            }
            if(M[1]=== 'Chrome'){
                tem= ua.match(/\b(OPR|Edge)\/(\d+)/);
                if(tem!= null) return tem.slice(1).join(' ').replace('OPR', 'Opera');
            }
            M= M[2]? [M[1], M[2]]: [navigator.appName, navigator.appVersion, '-?'];
            if((tem= ua.match(/version\/(\d+)/i))!= null) M.splice(1, 1, tem[1]);
            return M.join(' ');
        })();
            var browVersion = navigator.sayswho.split(" ");
              
           var browVer = parseInt(browVersion[1])
                //  console.log(browVersion[0]);
               if(browVersion[0] != 'Chrome' && browVersion[0] != 'Firefox' && browVersion[0] != 'Safari'){
                document.getElementById("alert-browser-check").style.display ="block";
               }

      </script>

     

      </body>
</html>