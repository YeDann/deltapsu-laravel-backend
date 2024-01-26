@extends('layouts.front-end')
@section('css')
<style>
    .banner-type-product-all {
        height: 432px;
    }

    @media (max-width:768px) {
        .banner-type-product-all {
            height: 250px;
        }
    }

    /* select */
    .form-control {
        -webkit-appearance: none;
        -moz-appearance: none;
        border-radius: 0;
        border: 1px solid #444444;
        background-position: right 50%;
        background-repeat: no-repeat;
        background-image: url('{{asset(' frontend-asset/image/arrow-down.svg')}}');
        font-size: 16px;
    }

    .form-control:disabled,
    .form-control[readonly] {
        background-color: #F2F2F2;
        border: 1px solid #C1C1C1 !important;
        opacity: 1;
        color: #C1C1C1;
        background-image: unset;
    }

    .form-control:focus {
        color: #495057;
        background-color: #fff;
        border-color: #80bdff;
        outline: unset;
        box-shadow: unset;
    }

    input[type=text],
    input[type=email] {
        background-image: unset;

    }

    .input-label {
        position: relative;
    }

    .box-support-detail input[required]+label {
        color: #707070;
        font-family: Arial;
        font-size: 14px;
        position: absolute;
        bottom: 0;
        left: 18px;
        /* the negative of the input width */
    }

    textarea[required]+label {
        color: #707070;
        font-family: Arial;
        font-size: 14px;
        position: absolute;
        top: 12px;
        left: 12px;
        /* the negative of the input width */
    }

    input[required=required]+label:after {
        content: '*';
        /*  color: red; */
    }

    /* show the placeholder when input has no content (no content = invalid) */
    input[required=required]:invalid+label {
        display: inline-block;
        padding-left: .375rem;
    }

    textarea[required=required]:invalid+label {
        display: inline-block;
    }

    /* hide the placeholder when input has some text typed in */
    input[required]:valid+label,
    input[required]:focus+label,
    textarea[required]:valid+label {
        display: none;
    }

    .d-flex.mr-b-12px .input-label:first-child {
        margin-right: 12px;
    }

    .d-flex.mr-b-12px .input-label:last-child {
        margin-left: 12px;
    }

    textarea {
        height: 15%;
    }

    textarea {
        padding-left: 12px;
    }

    .tel-not-req {
        background-color: #F2F2F2 !important;
        border: 1px solid #C1C1C1 !important;
        opacity: 1;
        color: #C1C1C1;
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
<div class="products-index-nav visible-up-922">
    <div class="bg-bredcrumb">
        <div class="container">
            <nav aria-label="breadcrumb" id="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item text-breadcrumb-home"><a
                            href="{{route('index','home')}}">{{$staticContent['Home']}}</a></li>
                    <li class="breadcrumb-item active text-breadcrumb-home dropdown" aria-current="page"><a href="#"
                            data-toggle="dropdown" id="tools-dropdown">{{$staticContent['Supports']}}</a>
                        <ul class="dropdown-menu">
                            <li><a href="#" id="tools-dropdown" class="text-bold">{{$staticContent['Supports']}}</a>
                            </li>
                            <hr>
                            <li><a href="{{route('contactSupport')}}">{{$staticContent['contact_us']}}</a></li>
                            <li><a href="{{route('contactSalesOffices')}}">{{$staticContent['sales_offices']}}</a></li>
                            <li><a
                                    href="{{route('contactFindDistributor')}}">{{$staticContent['find_a_distributor']}}</a>
                            </li>
                            <li><a href="{{route('index','faqs')}}">{{$staticContent['FAQs']}}</a></li>
                        </ul>
                    </li>
                    <li class="breadcrumb-item active text-breadcrumb" aria-current="page"><a
                            href="#">{{$staticContent['contact_us']}}</a></li>

                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="banner-type-product-all item"
    style="background-image: url('{{asset('frontend-asset/image/Group 1834@2x.png')}}');">
</div>
<div class="box-support-detail mb-5">
    <div class="container">
        <h2 class="text-title-delta visible-tablets-up">{{$staticContent['what_type_of_support']}}</h2>
        <h3 class="text-title-delta visible-mobile">{{$staticContent['what_type_of_support']}}</h3>
        <form id="submitSupport" onsubmit="return validateForm(this)" action="{{route('SubmitContact')}}" method="POST">
            {{csrf_field()}}
            <p>{{$staticContent['support_from_up_text']}}</p>

            <div class="add-space-mobile">
                <div class="row">
                    <label class="col-12 text-title-detail-dark">{{$staticContent['Subject']}}<span
                            class="red">*</span></label>
                    <div class="col-12 w-100 mb-4">
                        <select id="subjectType" name="subject" class="form-control" required>
                            <option value="">{{$staticContent['Select']}} {{$staticContent['Subject']}}</option>
                            <option value="0" {{isset($contactlink) && $contactlink=='Sale-Enquiries' ?'selected':'' }}>
                                Sales Enquiry</option>
                            <option value="Products and Service Support" {{ isset($contactlink) &&
                                $contactlink=='Products-and-Service-Support' ?'selected':'' }}>Products and Service
                                Support</option>
                            <option value="General Comments">General Comments</option>
                            {{-- <option value="Problems and Bugs">Problems and Bugs</option> --}}
                        </select>
                    </div>
                </div>
                <div class="row  ">
                    <div class="col-lg-6 col-md-12 input-label w-100 mb-4">
                        <label class="text-title-detail-dark">{{$staticContent['Name']}}<span
                                class="red">*</span></label>
                        <input type="text" class="form-control" name="name" pattern="[A-Za-zก-๏\s]+" required="required"
                            placeholder="Name">
                    </div>
                    <div class="col-lg-6 col-md-12 input-label w-100 mb-4">
                        <label class="text-title-detail-dark">{{$staticContent['Email_Address']}}<span
                                class="red">*</span></label>
                        <input type="email" class="form-control" name="email" title="Incorrect Format Email"
                            placeholder="Email Address" required>
                    </div>


                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-12 input-label w-100 mb-4">
                        <label class="text-title-detail-dark">{{$staticContent['Company']}}<span
                                class="red">*</span></label>
                        <input type="text" class="form-control" name="company" pattern="[A-Za-zก-๏\s().]+"
                            required="required" placeholder="Company">
                    </div>
                    <div class="col-lg-6 col-md-12 input-label w-100 mb-4">
                        <label class="text-title-detail-dark">{{$staticContent['Product_Type']}}<span
                                class="red">*</span></label>
                        <select id="type_id" name="type_id" class="form-control" onchange="selectType();" required>
                            <option value="">{{$staticContent['Select']}} {{$staticContent['Type']}}</option>
                            @foreach ($subCategories as $sub)
                            @if(in_array($sub->sub_pro_id, $arr_settype))
                            <option value="{{$sub->sub_pro_id}}">{{$sub->name}}</option>
                            @endif
                            @endforeach
                        </select>
                        <input type="hidden" name="type_name" id="type_name">
                        <input type="hidden" name="config_id" id="config_id">
                        <input type="hidden" name="enquireStatus" id="enquireStatus">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-12  select input-label w-100 mb-4">
                        <label class="text-title-detail-dark">{{$staticContent['Country']}}<span
                                class="red">*</span></label>
                        <select name="country" class="form-control required" onchange="selectCountry();"
                            id="countryemailId" required>
                            <option value="">{{$staticContent['Select']}} {{$staticContent['Country']}}</option>
                            @foreach ($countryemails as $email)
                            <option value="{{$email->country}}">{{$email->country}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-6 col-md-12 input-label w-100 mb-4">
                        <label class="text-title-detail-dark">{{$staticContent['Model']}}<span
                                class="red">*</span></label>
                        <select id="model_id" name="model_name" class="form-control" disabled required>
                            <option value="">{{$staticContent['Select']}} {{$staticContent['Model']}}</option>
                        </select>
                    </div>

                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-12 select02 input-label w-100 mb-4" id="box_state_con">
                        <label class="text-title-detail-dark">{{$staticContent['City_State']}} <span id="r_q_contry"
                                class="red"></span></label>
                        <select name="state" class="form-control" id="stateId">
                            <option value="" data-color="red">{{$staticContent['Select']}}
                                {{$staticContent['City_State']}}</option>
                        </select>
                    </div>
                    <div class="col-lg-6 col-md-12 input-label w-100 mb-4">
                        <label class="text-title-detail-dark">{{$staticContent['Phone_Number']}}</label>
                        <input type="tel" class="form-control tel-not-req" name="tel" pattern="^[0-9-+\s()]*$"
                            maxlength="13" title="Incorrect Format Number only and Special Charecter +,-"
                            placeholder="{{$staticContent['Phone_Number']}}">
                    </div>
                </div>
                <div class="row ">
                    <div class="col-12">
                        <label class="text-title-detail-dark mt-4">{{$staticContent['Message']}}<span
                                class="red">*</span></label>
                        <div class="input-label">
                            <textarea name="message" id="message" class="w-100" required="required"
                                rows="10"></textarea>
                            <label for="message">{{$staticContent['Message']}}</label>
                        </div>

                        <div class="box-input-checkbox">
                            <input class="inp-cbx" name="prichk" id="privacycheck" value="1"
                                onclick="onacceptionPolicy()" type="checkbox" style="display: none;" />
                            <label class="cbx" for="privacycheck"><span>
                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                    </svg></span><span style="padding-left:9px;">
                                    {{$staticContent['By_submitting_this_form']}} <a target="_blank"
                                        href="{{route('privacyPolicy')}}"
                                        class=" text-underline">{{$staticContent['Privacy_Policy']}}</a><text
                                        class="red">*</text></span> </label>
                        </div>

                        <div class="box-input-checkbox">
                            <input class="inp-cbx" name="checkData" id="cx-sign-up" value="1" type="checkbox"
                                style="display: none;" />
                            <label class="cbx" for="cx-sign-up"><span>
                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                    </svg></span><span>{{$staticContent['Sign_up_for_newsletter']}}</span></label>
                        </div>

                        <form action="?" method="POST">
                            <div class="mt-4" id="recap_vertify"></div>
                            <br>
                        </form>
                        <input type="hidden" id="keyrecap" name="keyrecap">
                        <button class="btn-subscribe" type="submit">{{$staticContent['Send']}}</button>
                    </div>

                </div>
            </div>
        </form>



    </div>
</div>
@endsection
@section('js')


<script type="text/javascript">
    var verifyCallback = function(response) {
                $('#keyrecap').val(response);
            };
            var onloadCallback = function() {
                grecaptcha.render('recap_vertify', {
                // 'sitekey' : '6LdshPcUAAAAACIioRg3pa05GCUYQ9S0hVLv-4zv',
                'sitekey' : '6LfGGV0pAAAAAKeEC0S7wzsPbAM1fvB3Tp2wtSYJ',
                'callback' : verifyCallback,
                'theme' : 'light'
                });
        };

        $( document ).ready(function() {
            onloadCallback();
       });
     
      function onacceptionPolicy(){
        $('#acceptcookiebot').click();
      }
  
      function validateForm(form){
        
                if(!form.prichk.checked){
                    $("#Support_policy_required").modal();
                    return false;
                }else if(form.keyrecap.value == ''){
                    $("#downloadgui-modal-vetify-robot").modal();
                    return false;
                } else{
                    return true;
                }
      }
</script>

<script>
    $('select').change(function(){
             $(this).parent().attr('style','--color:'+$(this).find(':selected').data('color'));
        })
        var modelId =  <?= json_encode(session('enquireModel'));?>;
        var modeltype =  <?= json_encode(session('enquireModelType'));?>;
        var enqurieType =  <?= json_encode(session('enquireType'));?>;
        var enquireStatus =  <?= json_encode(session('enquireStatus'));?>;
        var enquireData =  <?= json_encode(session('enquireData'));?>;
       function selectType(){

            var id = $('#type_id').val();
            var t_name = $('#type_id option:selected').text();
            $('#type_name').val(t_name);
      
            $.ajax({
            url: "{{(route('searhProductByType'))}}",
            data: {
            'type_id': id,
           },
           type: 'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                var options = '';
                for (var i = 0; i < data['results'].length; i++) {
                    options += '<option value="' + data['results'][i].pro_code + '">' + data['results'][i].pro_code + '</option>';
                }
                // console.log(modelId);
                $("select#model_id").html(options);
                if(modelId != null &&  modelId != ''){
                    $("#model_id option[value="+"'"+modelId+"'"+"]").prop('selected', true);
                }
                $('#model_id').removeAttr("disabled");
            }

        });
            // $.each(products, function(index,pro){
               
            //     if(pro['pro_categories_id'] == id){
            //         if(index == 0){
            //         html += '<option value="'+pro['pro_code'] +'" selected>'+pro['pro_code']+'</option>';
            //         }else{
            //         html += '<option value="'+pro['pro_code'] +'">'+pro['pro_code']+'</option>';   
            //         }
            //     }
            // });
            // html += '<option value="0">Select Model</option>';
          
            // $('#model_id').html(html);
            // $('#model_id').removeAttr("disabled");
           
        } 

  

  $( document ).ready(function() {
    $('#config_id').val(enquireData);
   
    if(enqurieType != null && enqurieType == 0 && enquireStatus == 0 ){
       $('#enquireStatus').val(enquireStatus);
       $("#subjectType option[value="+enqurieType+"]").prop('selected', true);
       $("#type_id option[value="+modeltype+"]").prop('selected', true);
       selectType();
    }else if(enquireStatus == 1){
        $("#subjectType option[value="+enqurieType+"]").prop('selected', true);
        $('#enquireStatus').val(enquireStatus);
        $("#type_id option[value="+modeltype+"]").prop('selected', true);
        selectType();
    
    }
});
   function selectCountry(){
       var countryname = $('#countryemailId').val();
    //    console.log(countryname);
    if(countryname == 'United States of America' || countryname == 'Canada'){
        $.ajax({
            url: "{{(route('searhstate'))}}",
            data: {
            'countryname': countryname,
           },
           type: 'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                var options = '';
                options += '<option value="">{{$staticContent['Select']}} {{$staticContent['City_State']}}</option>';
                for (var i = 0; i < data['results'].length; i++) {
                    options += '<option value="' + data['results'][i].name + '">' + data['results'][i].name + '</option>';
                }
                $('#box_state_con').css('display','block');
                $("select#stateId").html(options);
                $("select#stateId").attr("required", "true");
                $('#r_q_contry').text('*');
               
           
            }
        });
    }else{
      $('#box_state_con').css('display','none');
     }
 
  
   }

       @if(Session::has('message'))
        $(document).ready(function() {
             $("#success_email_send").modal();
          });
        @endif
        @if(Session::has('messageSendPDF'))
        $(document).ready(function() {
          var file =  '{{Session::get('messageSendPDF')}}';
          var html = '';
              html += '<a href="{{config('app.url')}}/config_history/'+file +'" target="_blank">';
              html += '{{config('app.url')}}/config_history/'+file+'';
              html += '</a>';
             $('#linkdownloadconfigPdf').html(html);
             $("#sendpfdtome").modal();
             
          });
        @endif

        @if(Session::has('message_eror'))
        $(document).ready(function() {
             $("#downloadgui-modal-failures").modal();
          });
        @endif
        @if(Session::has('message_eror_notvertify'))
        $(document).ready(function() {
             $("#downloadgui-modal-vetify-robot").modal();
          });
        @endif

        @if(Session::has('message_eror_notValid'))
        $(document).ready(function() {
             $("#Support_Frorm_required").modal();
          });
        @endif

</script>
@endsection