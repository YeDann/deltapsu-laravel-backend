
<div class="visible-desk-up visible-tablets-large"> 
    <div class="box-newsletter">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="padding-new-sub text-center">
                            <h2 class="text-title-banner text-center"> 
                                    {{$staticContent['Subscribe_to_our_newsletter']}}
                            </h2>
                            <div class="text-be-first">
                                    {{$staticContent['Be_the_first_to_hear']}}
                            </div>
                            <div class="box-input-sub">
                                    <label for="inp" class="inp">
                                            <input type="text" id="inp3" placeholder="&nbsp;" data-toggle="modal" data-target="#subscribe-modal" >
                                            <span class="label">
                                                {{$staticContent['Enter_email_address']}}
                                            </span>
                                            <span class="border"></span>
                                        </label>
                                        <button class="btn btn-subscribe"  onclick="resetfield();" data-toggle="modal" data-target="#subscribe-modal" >{{$staticContent['Subscribe']}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div> 
    <div class="bg-footer">
        <div class="container">
            <div class="padding-top-bottom">
                <div class="row">
                    <div class="col-xl-2 col-lg-2">
                        <div class="text-footer-main ">
                            <h6>{{$staticContent['Products']}}</h6>
                        </div>
                        <div class=" ">
                           
                            <?php 
                            $current1 = null;
                            foreach($navcategories as $item1) { 
                                if ($item1->main_cateid == 2) {
                                    $current1 = $item1;
                                    break;
                                }
                            }
                          ?>
                            <a href="{{route('allproductsByType' ,[preg_replace('/\s+/', '_', $current1->name),$current1->sub_pro_id ,$current1->main_cateid ])}}" ><p class="text-pro-link">{{$staticContent['Industrial_Power']}}</p>
                            </a>
                           
                        </div>
                        <div class=" ">
                            <?php 
                            $current2 = null;
                            foreach($navcategories as $item2) { 
                                if ($item2->main_cateid == 1) {
                                    $current2 = $item2;
                                    break;
                                }
                            }
                          ?>
                            <a href="{{route('allproductsByType' ,[preg_replace('/\s+/', '_', $current2->name),$current2->sub_pro_id ,$current2->main_cateid ])}}" ><p class="text-pro-link">{{$staticContent['Medical_Power']}}</p>
                            </a>
                        </div>
                        <div class=" ">
     
                            <a href="{{route('allproductsByType',[preg_replace('/\s+/', '_', 'CC+Cv_Mode'),1 , 3])}}" ><p class="text-pro-link">{{$staticContent['LED_Power']}}</p>
                            </a>
                           
                        </div>

                    </div>{{-- product --}}
                    <div class="col-xl-2 col-lg-2">
                            <div class="text-footer-main ">
                                <h6>{{$staticContent['Applications']}}</h6>
                            </div>
                            @foreach ($navapplication as $app)
                            <div class=" ">
                                <a href="{{route('applicationDetail' ,[ 'name' => preg_replace('/\s+/', '-',$app->applica_id.'-'.$app->name)])}}"><p class="text-pro-link">{{$app->name}}</p></a>
                            </div>
                            @endforeach
                            
                            
                    </div>{{-- appli --}}
                    <div class="col-xl-2 col-lg-2">
                            <div class="text-footer-main">
                                <h6>{{$staticContent['Tools']}}</h6>
                            </div>
                            <div class=" ">
                                <a href="{{route('productFinder')}}">
                                    <p class="text-pro-link">{{$staticContent['Product_Selector']}}</p>
                                    
                                </a>
                            </div>
                            <div class=" ">
                                <a href="{{route('configurableproduct')}}" >
                                    <p class="text-pro-link">{{$staticContent['configurable_power_selector']}}</p>
                                    
                                </a>
                            </div>
                            <div class=" ">
                                <a href="{{route('productCoparison')}}" >
                                    <p class="text-pro-link">{{$staticContent['product_comparison']}}</p>
                                
                                </a>
                            </div>
        
                            <br><br>
                            <div class="footer-one text-footer-main">
                                <h6>{{$staticContent['Updates']}}</h6>
                            </div>
                            <div class=" ">
                                <a href="{{route('index','news')}}" >
                                    <p class="text-pro-link">{{$staticContent['Product_News']}}</p>
                                    
                                </a>
                            </div>
                            <div class=" ">
                                <a href="{{route('index','events')}}" >
                                    <p class="text-pro-link">{{$staticContent['Events']}}</p>
                                </a>
                            </div>
                            {{-- <div class=" ">
                                <a href="{{route('index','technical-articles')}}" >
                                    <p class="text-pro-link">{{$staticContent['Technical_Articles']}}</p>
                                    
                                </a>
                            </div> --}}
                    </div>{{-- TOOL&UPDATE --}}
                    <div class="col-xl-2 col-lg-2">
                        <div class="text-footer-main ">
                            <h6>{{$staticContent['About']}}</h6>
                        </div>
                        @foreach ($navaboutus as $abt)
                        <div class=" ">
                            <a href="{{route('aboutUs',$abt->stug)}}" >
                                <p class="text-pro-link">{{$abt->title}}</p>
                                
                            </a>
                        </div>
                         @endforeach
                        <br>
                        <div class="text-footer-main  footer-two">
                            <h6>{{$staticContent['Downloads']}}</h6>
                            </div>
                            <div class=" ">
                                <a href="{{route('index','catalogs')}}">
                                    <p class="text-pro-link">{{$staticContent['catalogs']}}</p>
                                  
                                </a>
                            </div>
                            <div class=" ">
                                <a href="{{route('index','product-documents')}}">
                                    <p class="text-pro-link">{{$staticContent['Product_Documents']}}</p>
                                    
                                </a>
                            </div>
                       
                    </div>{{-- about&RESOURCE --}}
                    <div class="col-xl-2 col-lg-2">
                        <div class="text-footer-main ">
                            <h6>{{$staticContent['Supports']}}</h6>
                        </div>
                        <div class=" ">
                            <a href="{{route('contactSupport')}}">
                                <p class="text-pro-link">{{$staticContent['contact_us']}}</p>
                                
                            </a>
                        </div>
                        <div class=" ">
                            <a href="{{route('contactSalesOffices')}}">
                                <p class="text-pro-link">{{$staticContent['sales_offices']}}</p>
                                
                            </a>
                        </div>
                        <div class=" ">
                            <a href="{{route('contactFindDistributor')}}">
                                <p class="text-pro-link"> {{$staticContent['find_a_distributor']}}</p>
                               
                            </a>
                        </div>
                        <div class=" ">
                            <a href="{{route('index','faqs')}}">
                                <p class="text-pro-link">{{$staticContent['FAQs']}}</p>
                               
                            </a>
                        </div>
                       
                       
                    </div>{{-- contact&PARTNER--}}
                    <div class="col-xl-2 col-lg-2">
                        <div class="text-footer-main ">
                            <h6>{{$staticContent['Information']}}</h6>
                        </div>
                        <div class=" ">
                        <a href="{{route('termsOfUse')}}">
                                <p class="text-pro-link">{{$staticContent['Terms_of_Use']}}</p>
                                
                            </a>
                        </div>
                        <div class=" ">
                            <a href="{{route('privacyPolicy')}}">
                                <p class="text-pro-link">{{$staticContent['Privacy_Policy']}}</p>
                                
                            </a>
                        </div>
                        {{-- <div class=" ">
                            <a href="">
                                <p class="text-pro-link">MANUAL</p>
                                
                            </a>
                        </div> --}}
                        <br><br><br>
                        <div class="text-footer-main footer-four">
                            <h6>{{$staticContent['Follow_us_on_social']}}</h6>
                            
                        </div>

                        <div class="d-flex icon-social">
                            <a href="https://www.facebook.com/DeltaPSU/" target="_blank">
                            <div class="icon-link-footer">
                                <i class="zmdi zmdi-facebook icon-footer-center"></i>
                            </div>
                            </a>
                            <a href="https://www.linkedin.com/company/deltapsu/" target="_blank">
                            <div class="icon-link-footer">
                                <i class="zmdi zmdi-linkedin icon-footer-center"></i>
                            </div>
                            </a>

                        </div>
                    </div>{{-- info --}}
                </div>

            </div>
        </div>
        
    </div>
    <div class="footer-nav">
        <div class="container">
            <ul>Copyright © 2020 DeltaPSU. All Rights Reserved.</ul>
            {{-- <ul>Designed by Degito</ul> --}}
        </div>
    </div>
</div>
<div class="visible-touch" >
    <div class="subscribe-moblie pad-24px">
            
        <div class="container text-center">
            <div class="text-title-subscribe">
                <h4>{{$staticContent['Subscribe_to_our_newsletter']}} </h4> 
            </div>
            <div class="text-be-first">
                {{$staticContent['Be_the_first_to_hear']}}
            </div>

            <div class="box-input-sub">
                <label for="inp" class="inp">
                    <input type="text" id="inp4" placeholder="&nbsp;" data-toggle="modal" data-target="#subscribe-modal" >
                    <span class="label text-center">{{$staticContent['Enter_email_address']}}</span>
                     <span class="border"></span>
                </label>  
               
            </div>
             <button class="btn btn-subscribe" onclick="resetfield();" data-toggle="modal" data-target="#subscribe-modal" >  {{$staticContent['Subscribe']}}</button>   
        </div>
    </div>
    <div class="bg-footer-mobile">
        <div class="footer-nav-mobile " id="footer-nav-mobile">
            <div class="w-100 pt-5">
                <div class="border-b-2px">
                     <a  tabindex="-1" href="#foot-nav-link-list1" data-toggle="collapse" data-target="#foot-nav-link-list1" >{{$staticContent['Products']}}<i class="zmdi zmdi-chevron-down"></i></a>
                    <div class="collapse pl-4" id="foot-nav-link-list1" data-parent="#footer-nav-mobile" {{-- aria-expanded="false" --}}>
                        <a  class="text-normal" tabindex="-1" href="#foot-nav-link-list-sub1" data-toggle="collapse" data-target="#foot-nav-link-list-sub1" >{{$staticContent['Industrial_Power']}}<i class="zmdi zmdi-chevron-down"></i></a>
                        <div class="collapse pl-4" id="foot-nav-link-list-sub1" aria-expanded="false">
                            @foreach ($navcategories2 as $subCate)
                            <a  class="text-normal " href="{{route('allproductsByType' ,[preg_replace('/\s+/', '_', $subCate->name),$subCate->sub_pro_id ,2])}}">{{$subCate->name}} </a> 
                            @endforeach
                          
                        </div>
                        <a class="text-normal" tabindex="-1" href="#foot-nav-link-list-sub2" data-toggle="collapse" data-target="#foot-nav-link-list-sub2" >{{$staticContent['Medical_Power']}}<i class="zmdi zmdi-chevron-down"></i></a>
                        <div class="collapse pl-4" id="foot-nav-link-list-sub2" aria-expanded="false">
                            @foreach ($navcategories1 as $subCate)
                            <a  class="text-normal " href="{{route('allproductsByType' ,[preg_replace('/\s+/', '_', $subCate->name),$subCate->sub_pro_id ,1])}}">{{$subCate->name}}</a> 
                           @endforeach
                        </div>
                        <a class="text-normal" tabindex="-1" href="#foot-nav-link-list-sub3" data-toggle="collapse" data-target="#foot-nav-link-list-sub3" >{{$staticContent['LED_Power']}} <i class="zmdi zmdi-chevron-down"></i></a>
                        <div class="collapse pl-4" id="foot-nav-link-list-sub3" aria-expanded="false">
                            @foreach ($navcategories3 as $subCate)
                        <a  class="text-normal " href="{{route('allproductsByType',[preg_replace('/\s+/', '_', 'CC+Cv_Mode'),1 , 3])}}" >{{$subCate->name}}</a> 
                            @endforeach
                            
                        </div>
                    </div>
                </div>
                <div class="border-b-2px">
                    <a class="" tabindex="-1" href="#foot-nav-link-list2" data-toggle="collapse" data-target="#foot-nav-link-list2" >{{$staticContent['Tools']}}<i class="zmdi zmdi-chevron-down"></i></a>
                    <div class="collapse pl-4" id="foot-nav-link-list2" {{-- aria-expanded="false" --}} data-parent="#footer-nav-mobile">
                        <a class="text-normal " href="{{route('productFinder')}}">{{$staticContent['Product_Selector']}}</a>
                        <a class="text-normal " href="{{route('configurableproduct')}}">{{$staticContent['configurable_power_selector']}}</a>
                        <a class="text-normal " href="{{route('productCoparison')}}">{{$staticContent['product_comparison']}}</a>
                    </div>
                </div>   
                    
                <div class="border-b-2px">
                    <a class="" tabindex="-1" href="#foot-nav-link-list3" data-toggle="collapse" data-target="#foot-nav-link-list3" >{{$staticContent['Applications']}}<i class="zmdi zmdi-chevron-down"></i></a>
                    <div class="collapse pl-4" id="foot-nav-link-list3" {{-- aria-expanded="false" --}} data-parent="#footer-nav-mobile">
                        @foreach ($navapplication as $app)
                        <a class=" text-normal" href="{{route('applicationDetail' ,[ 'name' => preg_replace('/\s+/', '-',$app->applica_id.'-'.$app->name)])}}">{{$app->name}}</a>
                        @endforeach
                       
                    </div>
                </div>
                    
                <div class="border-b-2px">
                    <a class="" tabindex="-1" href="#foot-nav-link-list4" data-toggle="collapse" data-target="#foot-nav-link-list4" >{{$staticContent['About']}}<i class="zmdi zmdi-chevron-down"></i></a>
                    <div class="collapse pl-4" id="foot-nav-link-list4" {{-- aria-expanded="false" --}} data-parent="#footer-nav-mobile">
                        @foreach ($navaboutus as $abt)
                        <a class="text-normal " href="{{route('aboutUs',$abt->stug)}}">{{$abt->title}}</a>
                        @endforeach
                    </div>
                </div>
                    
                <div class="border-b-2px">
                    <a class="" tabindex="-1" href="#foot-nav-link-list5" data-toggle="collapse" data-target="#foot-nav-link-list5" >{{$staticContent['Updates']}}<i class="zmdi zmdi-chevron-down"></i></a>
                    <div class="collapse pl-4" id="foot-nav-link-list5" {{-- aria-expanded="false" --}} data-parent="#footer-nav-mobile">
                        <a  class="text-normal " href="{{route('index','news')}}"  >{{$staticContent['Product_News']}}</a> 
                        <a  class="text-normal " href="{{route('index','events')}}"  >{{$staticContent['Events']}}</a>
                    </div>
                </div>
                    
                <div class="border-b-2px">
                     <a class="" tabindex="-1" href="#foot-nav-link-list6" data-toggle="collapse" data-target="#foot-nav-link-list6" >{{$staticContent['Downloads']}}<i class="zmdi zmdi-chevron-down"></i></a>
                    <div class="collapse pl-4" id="foot-nav-link-list6" {{-- aria-expanded="false" --}} data-parent="#footer-nav-mobile">
                        <a class="text-normal " href="{{route('index','catalogs')}}">{{$staticContent['catalogs']}}</a>
                        <a class="text-normal " href="{{route('index','product-documents')}}">{{$staticContent['Product_Documents']}}</a>
                       
                    </div>
                </div>
                   
                <div class="border-b-2px">
                    <a class="" tabindex="-1" href="#foot-nav-link-list7" data-toggle="collapse" data-target="#foot-nav-link-list7" >{{$staticContent['Supports']}} <i class="zmdi zmdi-chevron-down"></i></a>
                    <div class="collapse pl-4" id="foot-nav-link-list7" {{-- aria-expanded="false" --}} data-parent="#footer-nav-mobile">
                        <a  class="text-normal " href="{{route('contactSupport')}}">{{$staticContent['contact_us']}}</a>
                        <a  class="text-normal " href="{{route('contactSalesOffices')}}">{{$staticContent['sales_offices']}}</a> 
                        <a  class="text-normal " href="{{route('contactFindDistributor')}}">{{$staticContent['find_a_distributor']}}</a>
                        <a  class="text-normal " href="{{route('index','faqs')}}">{{$staticContent['FAQs']}}</a>   
                    </div>
                </div>
                <div class="border-b-2px">
                    <a class="" tabindex="-1" href="#foot-nav-link-list8" data-toggle="collapse" data-target="#foot-nav-link-list8" >{{$staticContent['Information']}} <i class="zmdi zmdi-chevron-down"></i></a>
                    <div class="collapse pl-4" id="foot-nav-link-list8" {{-- aria-expanded="false" --}} data-parent="#footer-nav-mobile">
                        <a class="text-normal " href="{{route('termsOfUse')}}">{{$staticContent['Terms_of_Use']}}</a>
                        <a class="text-normal " href="{{route('privacyPolicy')}}">{{$staticContent['Privacy_Policy']}}</a>
                        {{-- <a class="text-normal " href="">MANUAL</a> --}}
                    </div>
                </div>    
                  
                    <p class="text-center text-bold  mr-t-24px mr-b-1">{{$staticContent['Follow_us_on_social']}}</p>
                    <div class="icon-social justify-content-center pad-b-24px w-100 d-flex">
                           <a href="https://www.facebook.com/DeltaPSU/" target="_blank">
                            <div class="icon-link-footer">
                                <i class="zmdi zmdi-facebook icon-footer-center" ></i>
                            </div>
                           </a>
                           <a href="https://www.linkedin.com/company/deltapsu/" target="_blank">
                            <div class="icon-link-footer">
                                <i class="zmdi zmdi-linkedin icon-footer-center"></i>
                            </div>
                          </a>

                    </div>
                  
            </div>
        </div>
        <div class="footer-mobile">
            <div class="container text-center">
                Copyright © 2020 DeltaPSU. All Rights Reserved.
                {{-- <br>Designed by Degito --}}
            </div>
        </div>
    </div>
</div>


<div class="modal fade p-1" id="subscribe-modal" tabindex="-1" role="dialog" aria-labelledby="subscribe-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content ">
        <div class="modal-header pl-4">
          <h4 class="text-color-delta mb-0" id="subscribe-modal-title">{{$staticContent['Subscribe']}}</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body px-4 mb-4">
        <form name="frmMr" id="subscribeform" action="{{route('subscribe')}}" onsubmit="return submitsubscribe()"  method="POST" >
                {{csrf_field()}}
          <img class="brand-image my-3" src="{{asset('frontend-asset/image/DeltaPSU-Logo.svg')}}">
         <p class="text-one">{{$staticContent['alert_text_for_read_privacy']}}<a href="{{route('privacyPolicy')}}" class="text-underline text-bold"> {{$staticContent['Privacy_Policy']}}</a>.</p> 
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
              <input type="text" class="form-control" pattern="[A-Za-zก-๏\s]+" name="name" required="required" placeholder="Name" >
             {{--  <label for="email">Name</label> --}}
          </div>
          <h6> {{$staticContent['Marketing_Permissions']}}<span class="red">*</span></h6>
          <p class="text-one">{{$staticContent['DeltaPSU_will_use_the information_you']}}</p>
          <div class="box-input-checkbox my-3 p-3 bg-light-blue">
              <input name="accept" value="1"  class="inp-cbx" id="cxacceptPrivacy_data" type="checkbox" 
                  style="display: none;" />
              <label class="cbx w-100" for="cxacceptPrivacy_data">
                  <span class="">
                      <svg width="12px" height="10px" viewbox="0 0 12 10">
                          <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                      </svg>
                  </span>
                  <span class="col-10 w-100">{{$staticContent['I_have_read_and_accept']}} </span></label>
          </div> 
          <p class="text-one mb-4">{{$staticContent['To_unsubscribe']}}</p>
        <button type="submit" class="btn btn-subscribe">{{$staticContent['Subscribe']}}</button>
      </div>
    </form>
      
      </div>
    </div>
  </div>
  <div id="accept_Cookie" class="accept-checkCookie">
    <div class="container">
       <div class="row">
           <div class="col-lg-12 p-3 text-center">
            {{$staticContent['We_use_cookies_to_provide']}}
            <a href="{{route('privacyPolicy')}}" class="text-underline text-bold"> {{$staticContent['Privacy_Policy']}}</a>.</p>
              <button class="btn btn-subscribe" onclick="setcokie();" href="#">{{$staticContent['Accept']}}</button>
           </div>
       </div>
    </div>
</div>
