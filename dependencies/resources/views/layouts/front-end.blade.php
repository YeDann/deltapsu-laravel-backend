<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1, minimum-scale=1.0,maximum-scale=1,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge;chrome=1" />
    <link rel="shortcut icon" href="{{asset('/frontend-asset/image/icon/delta_favicon.ico')}}" type="image/x-icon">
    <link rel="icon" href="{{asset('/frontend-asset/image/icon/delta_favicon.ico')}}" type="image/x-icon">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('meta')
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" media="screen"/>
    <link rel="stylesheet" href="{{asset('/frontend-asset/css/header-front.css')}}" media="screen"/>
    <link rel="stylesheet" href="{{asset('/frontend-asset/css/container.css')}}" media="screen"/>
    <link rel="stylesheet" href="{{asset('/frontend-asset/css/home.css')}}" media="screen"/>
    <link rel="stylesheet" href="{{asset('/frontend-asset/css/news.css')}}" media="screen"/>
    <link rel="stylesheet" href="{{asset('/frontend-asset/css/login.css')}}" media="screen"/>
    <link rel="stylesheet" href="{{asset('/frontend-asset/css/details.css')}}" media="screen"/>
    <link rel="stylesheet" href="{{asset('/frontend-asset/css/result-page.css')}}">
    <link rel="stylesheet" href="{{asset('/frontend-asset/css/product-comparison.css')}}" media="screen"/>
    <link rel="stylesheet" href="{{asset('/frontend-asset/css/vanilla-calendar-min.css')}}" media="screen"/>
    <link href="{{asset('/frontend-asset/css/fontello.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{asset('/frontend-asset/material-design-iconic-font/css/material-design-iconic-font.min.css')}}" media="screen"/>
    <link rel="stylesheet" href="{{asset('/frontend-asset/css/font.css')}}" media="screen"/>
    <link rel="stylesheet" href="{{asset('/frontend-asset/css/owl.theme.default.css')}}" media="screen"/>
    <link rel="stylesheet" href="{{asset('/frontend-asset/css/owl.carousel.min.css')}}" media="screen"/>
    <link rel="stylesheet" href="{{asset('/frontend-asset/css/product.css')}}" media="screen"/>
    <link rel="stylesheet" href="{{asset('/frontend-asset/css/font-awesome.css')}}" media="screen"/>
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" media="screen"/> --}}
    <link rel="stylesheet" href="{{asset('/frontend-asset/css/datatables.css')}}" media="screen"/>
    
    <link rel="stylesheet" href="{{asset('/backend-asset/js/plugins/dropzone/dist/min/dropzone.min.css')}}">
    {{-- <script src="https://kit.fontawesome.com/480db7c8b0.js" crossorigin="anonymous"></script> --}}
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" media="screen"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.0.3/nouislider.min.css" rel="stylesheet" media="screen"/>
    <link href="{{asset('/frontend-asset/css/jquery.datepicker.css')}}" rel="stylesheet" type="text/css" />
    {{-- <link href="{{asset('/frontend-asset/css/dncalendar-skin.css')}}" rel="stylesheet" type="text/css" /> --}}
    <link href="{{asset('/frontend-asset/css/zabuto_calendar.css')}}" rel="stylesheet" type="text/css" />
    {{-- <script src="https://www.google.com/recaptcha/api.js" async defer></script> --}}
   


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
 
      
      body{
          font-family: 'ArialUnicodeMS', Helvetica, sans-serif  !important;
      }
      html[lang="cn"] body,
      html[lang="cn"] h1,
      html[lang="cn"] h2,
      html[lang="cn"] h3,
      html[lang="cn"] h4,
      html[lang="cn"] h5,
      html[lang="cn"] a,
      html[lang="cn"] button,
      html[lang="cn"] span,
      html[lang="cn"] .link-nav-first,
      html[lang="cn"] label{  
        font-family:'ArialUnicodeMS',Helvetica, sans-serif  !important;
      }

  

      html[lang="tw"] body,
      html[lang="tw"] h1,
      html[lang="tw"] h2,
      html[lang="tw"] h3,
      html[lang="tw"] h4,
      html[lang="tw"] h5,
      html[lang="tw"] a,
      html[lang="tw"] button,
      html[lang="tw"] div,
      html[lang="tw"] span ,
      html[lang="tw"] .link-nav-first,
      html[lang="tw"] label {  
        font-family:'ArialUnicodeMS', Helvetica, sans-serif !important ;
      }

      
      html[lang="jp"] body,
      html[lang="jp"] h1,
      html[lang="jp"] h2,
      html[lang="jp"] h3,
      html[lang="jp"] h4,
      html[lang="jp"] h5,
      html[lang="jp"] a,
      html[lang="jp"] button,
      html[lang="jp"] div,
      html[lang="jp"] span ,
      html[lang="jp"] .link-nav-first,
      html[lang="jp"] label {  
        font-family:'Tazugane Gothic StdN','ArialUnicodeMS', Helvetica, sans-serif !important ;
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
    
</head>
<body>
    @include('layouts.header-front')
    @yield('container')
    @include('layouts.footer')
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.7.5/js/bootstrap-select.min.js"></script>
<script src="{{asset('/frontend-asset/js/map.js')}}"></script>
<script src="{{asset('/frontend-asset/js/product.js')}}"></script>
<script src="{{asset('/frontend-asset/js/owl.carousel.js')}}"></script>
<script src="{{asset('/frontend-asset/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('/frontend-asset/js/datatables.min.js')}}"></script>
<script src="{{asset('/frontend-asset/js/dropzone.js')}}"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.0.3/nouislider.min.js"></script>
<script src="{{asset('/frontend-asset/js/jspdf.debug.js')}}"></script>
<script src="{{asset('/frontend-asset/js/zabuto_calendar.min.js')}}"></script>
<script src="{{asset('/frontend-asset/js/mb5.js')}}"></script>
<script src="https://www.recaptcha.net/recaptcha/api.js?onload=onloadCallback&render=explicit&hl=en"
async defer>
</script>
<script type="text/javascript">
  var verifyCallback = function(response) {
    $('#keyrecapGui').val(response);
  };
  var onloadCallback = function() {
    grecaptcha.render('recap_vertifygetGui', {
     //'sitekey' : '6LdshPcUAAAAACIioRg3pa05GCUYQ9S0hVLv-4zv',
       'sitekey' : '6LeFKfYUAAAAAL-q5mHlmjUTPQ-LvlDjNtev9QhA',
      'callback' : verifyCallback,
      'theme' : 'light'
    });
  };
  $("#submitGuiDownload").submit(function( event ) {
    if($('#keyrecapGui').val() == ''){
       alert('Please Vertify I am not a robot?');
    }else{
      $('#submitGuiDownload').submit();
    }
    event.preventDefault();
 });

</script>
    @yield('js')
    <script>
       $(document).ready(function() {
        msieversion();
       });
      function msieversion() 
            {
                var ua = window.navigator.userAgent;
                var msie = ua.indexOf("MSIE");

                if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)) // If Internet Explorer, return version number
                {
                  var script = document.createElement('script');
                    script.type = 'text/javascript';
                    script.src = '{{asset('/frontend-asset/js/html2canvasie.js')}}';    

                    document.getElementsByTagName('head')[0].appendChild(script);
              
                }
                else  // If another browser, return 0
                {
                  var script = document.createElement('script');
                    script.type = 'text/javascript';
                    script.src = '{{asset('/frontend-asset/js/html2canvas.js')}}';    

                    document.getElementsByTagName('head')[0].appendChild(script);
                  
                }

                return false;
            }
      </script>
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
          var nameArr = link.split(',');
          console.log(nameArr ,link );
          setlocaltion(nameArr[1] , nameArr[0]);
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
              var newkey = key.replace('/', '@');
            //  console.log();
              event.preventDefault();
              window.location = '{{route('searchAll')}}/'+newkey;
         });
         $( "#formseachall_mobile" ).submit(function( event ) {
              var key = $('#searchinput-mobile').val();
              var newkey = key.replace('/', '@');
              event.preventDefault();
              window.location = '{{route('searchAll')}}/'+newkey;
         });


        </script>
        <script>
          $(document).ready(function() {
             checkCookie();
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
        function downloadGUI(file , procode){
          $('#procodeGui').val(procode);
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
          if(document.frmMr.accept.value == 0 || document.frmMr.accept.value == null) {
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