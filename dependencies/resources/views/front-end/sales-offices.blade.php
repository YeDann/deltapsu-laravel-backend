@extends('layouts.front-end')
@section('css')
<style>
     .text-editor img{
         max-width: 100%;
     }
     .text-editor b{
        font-weight: bold;
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
                    <li class="breadcrumb-item text-breadcrumb-home"><a href="{{route('index','home')}}">{{$staticContent['Home']}}</a></li>
                    <li class="breadcrumb-item active text-breadcrumb-home dropdown" aria-current="page"><a
                            href="#" data-toggle="dropdown" id="tools-dropdown">{{$staticContent['Supports']}}</a>
                            <ul class="dropdown-menu">
                                <li><a href="#" id="tools-dropdown" class="text-bold">{{$staticContent['Supports']}}</a></li>
                                <hr>
                                <li><a href="{{route('contactSupport')}}">{{$staticContent['contact_us']}}</a></li>
                                <li><a href="{{route('contactSalesOffices')}}">{{$staticContent['sales_offices']}}</a></li>
                                <li><a href="{{route('contactFindDistributor')}}">{{$staticContent['find_a_distributor']}}</a></li>
                                <li><a href="{{route('index','faqs')}}">{{$staticContent['FAQs']}}</a></li>
                              </ul>   
                    </li>
                    <li class="breadcrumb-item active text-breadcrumb" aria-current="page"><a href="#">{{$staticContent['sales_offices']}}</a></li>

                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="padding-top-content-breadcrumb visible-up-922"></div>
<div class="box-sales-offices pb-5">
    <div class="container">
        <h2 class="text-title-delta visible-tablets-up">{{$staticContent['sales_offices']}}</h2>
        <h3 class="text-title-delta visible-mobile">{{$staticContent['sales_offices']}}</h3>
        <div id="sales-offices" class="sales-offices-type">
            @foreach ($continents as $item)
            <div class="box-for-collap">
            <div class="sales-offices-list collapsed  hide-box text-colour-delta" data-toggle="collapse" data-parent="#sales-offices-type"
                        href="#collapse-ofictab{{$item->id}}" >    
                 <h5>{{$item->name}}</h5>
                </div>
                <div id="collapse-ofictab{{$item->id}}" class="sales-offices-list-sub collapse" data-parent="#sales-offices-type">
                        <div class="force-overflow">
                            @foreach ($offices as $office)
                            @if($office->continent_id == $item->id )
                            <div class="sales-offices-address">
                                <p class="text-sixteen-dark mr-b-1">
                                   {{$office->title}}
                                <br>{{$office->sub_title}}</p>
                            <div class="text-editor">
                                {!!$office->content!!}
                             </div>
                            <a href="https://www.google.com/maps/?q={{$office->lat}},{{$office->lon}}&sensor=true" target="_blank"><button class="btn-subscribe" >{{$staticContent['Get Direction']}}</button></a>
                            </div>
                            @endif
                            @endforeach
                        </div>
                </div>
            </div>
            @endforeach
            {{-- <div class="box-for-collap">
                <div class="sales-offices-list collapsed  hide-box text-colour-delta" data-toggle="collapse" data-parent="#sales-offices-type"
                    href="#collapse-india">
                  
                   <h5>INDIA</h5>     
                </div>
                <div id="collapse-india" class="sales-offices-list-sub collapse" data-parent="#sales-offices-type">
                    <div class="force-overflow">
                        <div class="sales-offices-address">
                            <p class="text-sixteen-dark mr-b-1">North | Head Office </p>
                            <p class="text-sixteen-dark mr-b-1">Delta Electronics India Pvt. Ltd.</p>
                            <p>Plot No 43, Sector - 35 (HSIIDC) <br> Gurgaon - 122001, Haryana
                            <br>    Tel: +91 124 4169040
                            <br>    Fax: +91 124 4036045</p>
                            <button class="btn-subscribe">GET DIRECTION</button>
                        </div>
                        <div class="sales-offices-address">
                            <p class="text-sixteen-dark mr-b-1">North | Chandigarh</p>
                            <p class="text-sixteen-dark mr-b-1">Delta Electronics India Pvt. Ltd.</p>
                            <p>1st Floor, SCO-407, Sector-35-C Chandigarh (UT) 160035
                            <br>  Tel: +91 172 - 4803233</p>
                            <button class="btn-subscribe">GET DIRECTION</button>
                        </div>
                        <div class="sales-offices-address">
                            <p class="text-sixteen-dark mr-b-1">East | Kolkata</p>
                            <p class="text-sixteen-dark mr-b-1">Delta Electronics India Pvt. Ltd.</p>
                            <p>Victoira Park Building, Plot No - 37/2,
                            <br>Block - GN, 9th Floor, ODC No - 9A Salt Lake City,
                            <br>Sector - V, Kolkata - 700091, West Bengal
                            <br>Tel: +91 33 - 40083849-60
                            <br>Fax: +91 33 - 40083850</p>
                            <button class="btn-subscribe">GET DIRECTION</button>
                        </div>
                        <div class="sales-offices-address">
                            <p class="text-sixteen-dark mr-b-1">West | Mumbai</p>
                            <p class="text-sixteen-dark mr-b-1">Delta Electronics India Pvt. Ltd.</p>
                            <p>Office A-1619,Rupa Solitaire,IT park Building,
                            <br>Plot No. MPB 2 , Sector -1, MIDC ,Mahape,
                            <br>Navi Mumbai-400710, Maharashtra
                            <br>Tel: +91 22 - 61845200
                            <br>Fax: +91 22 - 61845333</p>
                            <button class="btn-subscribe">GET DIRECTION</button>
                        </div>
                        <div class="sales-offices-address">
                            <p class="text-sixteen-dark mr-b-1">West | Pune</p>
                            <p class="text-sixteen-dark mr-b-1">Delta Electronics India Pvt. Ltd.</p>
                            <p>Office No. 805 & 806, 8th Floor, Amar Business Park, Opp.to Sadanand Hotel,
                            <br>Veerbhadra Nagar, Baner, Pune, Maharashtra 411045
                            <br>Tel: +91 9763408163</p>
                            <button class="btn-subscribe">GET DIRECTION</button>
                        </div>
                        <div class="sales-offices-address">
                            <p class="text-sixteen-dark mr-b-1">South | Bangalore</p>
                            <p class="text-sixteen-dark mr-b-1">Delta Electronics India Pvt. Ltd.</p>
                            <p>Ozone Manay Tech Park, 'A' Block, 3rd Floor,
                            <br>Survey No. 56/18 & 55/9, Hosur Road,
                            <br>Hongasandra Village, Bangalore-560068
                            <br>Tel: +91 80 - 67164777
                            <br>Fax: +91 80 - 67164784</p>
                            <button class="btn-subscribe">GET DIRECTION</button>
                        </div>
                        <div class="sales-offices-address">
                            <p class="text-sixteen-dark mr-b-1">South | Hyderabad</p>
                            <p class="text-sixteen-dark mr-b-1">Delta Electronics India Pvt. Ltd.</p>
                            <p>Shree Prashanti Sai Towers, Plot No68,
                            <br>Nagarjuna Hills, Road No-1, Banjara Hills,
                            <br>Hyderabad - 500082
                            <br>Tel: +91 40 67274500
                            <br>Fax: +91 40 67274545</p>
                            <button class="btn-subscribe">GET DIRECTION</button>
                        </div>
                        <div class="sales-offices-address">
                            <p class="text-sixteen-dark mr-b-1">South | Visakhapatnam</p> 
                            <p class="text-sixteen-dark mr-b-1">Delta Electronics India Pvt. Ltd.</p>
                            <p>10-3-2, second floor, Waltair upland,
                            <br>Opp Sampath vinayaka temple,
                            <br>Visakhapatnam-530003
                            <br>Tel: +91 891 - 6666867</p>
                            <button class="btn-subscribe">GET DIRECTION</button> 
                        </div>
                        <div class="sales-offices-address">
                            <p class="text-sixteen-dark mr-b-1">South | Chennai</p> 
                            <p class="text-sixteen-dark mr-b-1">Delta Electronics India Pvt. Ltd.</p>
                            <p>1st Floor, ASV Chamiers Square, New Door
                            <br>No. 87, Old No. 48, Chamiers Road,
                            <br>Raja Annamalaipuram, Chennai, Tamil Nadu, 600028
                            <br>Tel: +91 44 - 43408800</p>
                            <button class="btn-subscribe">GET DIRECTION</button> 
                        </div>
                        <div class="sales-offices-address">
                            <p class="text-sixteen-dark mr-b-1">South | Coimbatore</p> 
                            <p class="text-sixteen-dark mr-b-1">Delta Electronics India Pvt. Ltd.</p>
                            <p>No. 123, Ramaswamy Gounder Street,
                            <br>Opp Sampath vinayaka temple,
                            <br>Saibaba Colony, Coimbatore - 641032
                            <br>Tel: +91 422 - 4202404
                            <br>Fax: +91 422 - 4202302</p>
                            <button class="btn-subscribe">GET DIRECTION</button>  
                        </div>
                        <div class="sales-offices-address">
                            <p class="text-sixteen-dark mr-b-1">Gujarat | Ahmedabad</p>
                            <p class="text-sixteen-dark mr-b-1">Delta Electronics India Pvt. Ltd.</p>
                            <p>412, 4th Floor, Ashirwad Paras Complex, Corporate Road
                            <br>Prahalad Nagar(Near Prahalad Nagar Garden)
                            <br>Ahmedabad - 380015
                            <br>Tel: +91 79 - 40047333</p>
                            <button class="btn-subscribe">GET DIRECTION</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-for-collap">
                <div class="sales-offices-list collapsed  hide-box text-colour-delta" data-toggle="collapse" data-parent="#sales-offices-type"
                    href="#collapse-europe">
                    
                    <h5>EUROPE</h5>    
                </div>
                <div id="collapse-europe" class="sales-offices-list-sub collapse" data-parent="#sales-offices-type">
                    <div class="force-overflow">
                        <div class="sales-offices-address">
                            <p class="text-sixteen-dark mr-b-1">Delta Electronics (Netherlands) B.V.</p>
                            <p>Zandsteen 15, 2132 MZ Hoofddorp, The Netherlands
                            <br>Tel: +31 20 655 0975
                            <br>Fax: +31 20 655 0999</p>
                            <button class="btn-subscribe">GET DIRECTION</button>
                        </div>
                        <div class="sales-offices-address">
                            <p class="text-sixteen-dark mr-b-1">Delta Electronics (Netherlands) B.V.</p>
                            <p>De Witbogt 20 5652 AG Eindhoven, The Netherlands
                            <br>Tel: +31 40 800 3800
                            <br>Fax: +31 40 800 3898</p>
                            <button class="btn-subscribe">GET DIRECTION</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-for-collap">
                <div class="sales-offices-list collapsed  hide-box text-colour-delta" data-toggle="collapse" data-parent="#sales-offices-type"
                    href="#collapse-america">
                    
                    <h5>NORTH AMERICA</h5>    
                </div>
                <div id="collapse-america" class="sales-offices-list-sub collapse" data-parent="#sales-offices-type">
                    <div class="force-overflow">
                        <div class="sales-offices-address">
                            <p class="text-sixteen-dark mr-b-1">Delta Electronics (Americas) Ltd. <br>North America Headquarters </p>
                            <p>46101 Fremont Blvd. Fremont, CA 94538, U.S.A
                            <br>Tel: +1 510 668 5100</p>
                            <button class="btn-subscribe">GET DIRECTION</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-for-collap">
                <div class="sales-offices-list collapsed  hide-box text-colour-delta" data-toggle="collapse" data-parent="#sales-offices-type"
                    href="#collapse-central">
                   
                    <h5>CENTRAL AND SOUTH AMERICA</h5>    
                </div>
                <div id="collapse-central" class="sales-offices-list-sub collapse" data-parent="#sales-offices-type">
                    <div class="force-overflow">
                        <div class="sales-offices-address">
                            <p class="text-sixteen-dark mr-b-1">Delta Greentech (Brasil) S.A.</p>
                            <p>Rua Itapeva, 26 -3° andar - Bela Vista 01332-000 São Paulo/SP - Brasil
                            <br>Tel: +55 11 3568 3850
                            <br>Fax: +55 11 3568 3865</p>
                            <button class="btn-subscribe">GET DIRECTION</button>
                        </div>
                        <div class="sales-offices-address">
                            <p class="text-sixteen-dark mr-b-1">Delta Electronics International Mexico, S.A. de C.V.</p>
                            <p>Centrum Park, Av. Gustavo Baz Prada 309, Edificio E Planta Baja Col. La Loma, C.P. 54030 Tlalnepantla,
                            <br>Estado de México
                            <br>Tel: +52 55 3603 9200</p>
                            <button class="btn-subscribe">GET DIRECTION</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-for-collap">
                <div class="sales-offices-list collapsed  hide-box text-colour-delta" data-toggle="collapse" data-parent="#sales-offices-type"
                    href="#collapse-australia">
                  
                    <h5>AUSTRALIA</h5>   
                </div>
                <div id="collapse-australia" class="sales-offices-list-sub collapse" data-parent="#sales-offices-type">
                    <div class="force-overflow">
                        <div class="sales-offices-address">
                            <p class="text-sixteen-dark mr-b-1">Delta Electronics Australia Pty Ltd.</p>
                            <p>20-21, 45 Normanby Rd. Nothing Hill, VIC 3168, Australia
                            <br>Tel: +61 9543 3720
                            <br>Fax: +61 9544 0606</p>
                            <button class="btn-subscribe">GET DIRECTION</button>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
</div>


@endsection


@section('js')
<script>

    
</script>
@endsection