@extends('layouts.front-end')
@section('css')
<style>
    .text-editor img {
        max-width: 100%;
    }

    .text-editor b {
        font-weight: bold;
    }

    .btn-certi {
        height: 40px;
        width: 160px;
        border-radius: 5px;
        border: 2px solid #444444;
        background-color: #ffffff;

        color: #000000;
        font-weight: bold;
        cursor: pointer;

    }

    .f-btn {
        font-size: 12px;
        font-family: 'DeltaSans';
    }

    .btn-certi:hover {
        border: 1px solid #0087DC;
        background-color: #0087DC;
        color: #ffffff;
    }
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
                            href="#">{{$staticContent['find_a_distributor']}}</a></li>

                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="padding-top-content-breadcrumb visible-up-922"></div>
<div class="box-find-distributor pb-5">
    <div class="container">
        <h2 class="text-title-delta visible-tablets-up">{{$staticContent['find_a_distributor']}}</h2>
        <h3 class="text-title-delta visible-mobile">{{$staticContent['find_a_distributor']}}</h3>
        <div id="find-distributor" class="find-distributor-type">

            @foreach ($continents as $item)
            <div class="box-for-collap">
                <div class="find-distributor-list collapsed  hide-box text-colour-delta" data-toggle="collapse"
                    data-parent="#find-distributor-type" href="#collapse-ofictab{{$item->id}}">
                    <h5>{{$item->name}}</h5>
                </div>
                <div id="collapse-ofictab{{$item->id}}" class="find-distributor-list-sub collapse"
                    data-parent="#find-distributor-type">
                    <div class="force-overflow">
                        @foreach ($offices as $office)
                        @if($office->continent_id == $item->id )
                        <div class="sales-offices-address">
                            <p class="text-sixteen-dark mr-b-1">
                                {{$office->title}}
                                <br>{{$office->sub_title}}
                            </p>
                            <div class="text-editor">
                                {!!$office->content!!}
                            </div>

                            <a href="https://www.google.com/maps/?q={{$office->lat}},{{$office->lon}}&sensor=true"
                                target="_blank"><button
                                    class="btn-subscribe mt-2">{{isset($staticContent['GetDirection'])?
                                    $staticContent['GetDirection'] : 'Get Direction'}}</button></a>
                            @if($office->status_cer == 1)
                            <a href="{{config('app.url')}}/medias/distributor/{{$office->file_cer}}" target="_blank">
                                <button class="btn-certi"><i class="cer-icon icon-facon icon-web-certificate"></i> <span
                                        class="f-btn">Certificate</span></button>
                            </a>
                            @endif
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach
            {{-- <div class="box-for-collap">
                <div class="find-distributor-list collapsed  hide-box text-delta" data-toggle="collapse"
                    data-parent="#find-distributor-type" href="#collapse-fad-americas">

                    <h5>AMERICAS</h5>

                </div>
                <div id="collapse-fad-americas" class="find-distributor-list-sub collapse"
                    data-parent="#find-distributor-type">
                    <div class="force-overflow">
                        <div class="find-distributor-address">
                            <p class="text-sixteen-dark mr-b-1">Arrow Electronics</p>
                            <p>9201 East Dry Creek Road
                                <br>Centennial, CO 80112
                                <br>Tel: +1 800-833-3557
                                <br>Email: advantagesales@arrow.com
                                <br>Web: https://www.arrow.com
                                <br>Link: https://www.arrow.com/en/products/manufacturers/d/delta-electronics
                            </p>
                            <button class="btn-subscribe">GET DIRECTION</button>
                        </div>
                        <div class="find-distributor-address">
                            <p class="text-sixteen-dark mr-b-1">Avnet Inc</p>
                            <p>2211 South 47th St
                                <br>Phoenix, AZ 85034
                                <br>Tel: +1-800-409-1483
                                <br>Web: http://www.avnet.com
                                <br>Link:
                                http://avnetexpress.avnet.com/store/em/EMController/Delta-Corp/_/N-4280354008?action=products&storeId=500201&langId=-1&sel=M
                            </p>
                            <button class="btn-subscribe">GET DIRECTION</button>
                        </div>
                        <div class="find-distributor-address">
                            <p class="text-sixteen-dark mr-b-1">Digi-Key Corporation</p>
                            <p>701 Brooks Avenue South Thief River Falls, MN 56701
                                <br>Tel: +1 800-344-4539
                                <br>Email: sales@digikey.com
                                <br>Web: http://www.digikey.com
                                <br>Link: http://www.digikey.com/Suppliers/us/Delta-Product-Groups-Power.page
                            </p>
                            <button class="btn-subscribe">GET DIRECTION</button>
                        </div>
                        <div class="find-distributor-address">
                            <p class="text-sixteen-dark mr-b-1">Master Electronics</p>
                            <p>Tel: +1 888-473-5297
                                <br>Email: powersolutions@masterelectronics.com
                                <br>Web: http://www.masterelectronics.com
                                <br>Link: http://www.masterelectronics.com/suppliers/delta-psu-1378/
                            </p>
                            <button class="btn-subscribe">GET DIRECTION</button>
                        </div>
                        <div class="find-distributor-address">
                            <p class="text-sixteen-dark mr-b-1">Mouser Electronics,</p>
                            <p>1000 North Main Street Mansfield, TX 76063
                                <br>Tel: +1 800-346-6873
                                <br>Email: sales@mouser.com
                                <br>Web: http://www.mouser.com
                                <br>Link: http://www.mouser.com/delta-electronics/
                            </p>
                            <button class="btn-subscribe">GET DIRECTION</button>
                        </div>
                        <div class="find-distributor-address">
                            <p class="text-sixteen-dark mr-b-1">NRC Electronics, Inc.,</p>
                            <p>6600 Park of Commerce Blvd , Boca Raton, FL 33487
                                <br>Tel: +1 561-241-8600
                                <br>Email: d.eisen@nrcelectronics.com
                                <br>Web: http://www.nrcelectronics.com
                            </p>
                            <button class="btn-subscribe">GET DIRECTION</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-for-collap">
                <div class="find-distributor-list collapsed  hide-box text-delta" data-toggle="collapse"
                    data-parent="#find-distributor-type" href="#collapse-fad-europe">

                    <h5>EUROPE</h5>
                </div>
                <div id="collapse-fad-europe" class="find-distributor-list-sub collapse"
                    data-parent="#find-distributor-type">
                    <div class="force-overflow">
                        <div class="find-distributor-address">
                            <p class="text-sixteen-dark mr-b-1">ASTONE TECHNOLOGY</p>
                            <p>41-43, rue Perier, 92120 Montrouge, France
                                <br>Tel: +33 (0)1 55 58 04 04
                                <br>Email: contact@via-design.fr
                                <br>Web: http://www.astone-technology.com/
                            </p>
                            <button class="btn-subscribe">GET DIRECTION</button>
                        </div>
                        <div class="find-distributor-address">
                            <p class="text-sixteen-dark mr-b-1">AVNET-ABACUS</p>
                            <p>All European countries + Israel + South Africa
                                <br>Web: http://www.avnet-abacus.eu/
                            </p>
                            <button class="btn-subscribe">GET DIRECTION</button>
                        </div>
                        <div class="find-distributor-address">
                            <p class="text-sixteen-dark mr-b-1">CEMATEC NV / SA</p>
                            <p>Wijngaardveld 11 B-9300 Aalst Belgium
                                <br>Tel: +32 53 606767
                                <br>Email: info@cematec.com
                                <br>Web: http://www.cematec.com
                            </p>
                            <button class="btn-subscribe">GET DIRECTION</button>
                        </div>
                        <div class="find-distributor-address">
                            <p class="text-sixteen-dark mr-b-1">MPL Power Elektro sp. z o.o.</p>
                            <p>44-119 Gliwice, Wschodnia 40, Poland
                                <br>Tel: +48 32 44 00 850
                            </p>
                            <button class="btn-subscribe">GET DIRECTION</button>
                        </div>
                        <div class="find-distributor-address">
                            <p class="text-sixteen-dark mr-b-1">Neumüller Elektronik GmbH</p>
                            <p>Gewerbegebiet Ost 7 91085 Weisendorf, Germany
                                <br>Tel: +49 9135 73666-0
                                <br>Email: info@neumueller.com
                                <br>Web: http://www.neumueller.com
                            </p>
                            <button class="btn-subscribe">GET DIRECTION</button>
                        </div>
                        <div class="find-distributor-address">
                            <p class="text-sixteen-dark mr-b-1">SGE-SYSCOM S.P.A</p>
                            <p>Sede Commerciale e Amministrativa, Via Gran Sasso, 35 -
                                <br>20092 CINISELLO BALSAMO (MI), Italy
                                <br>Tel: +39 02 617901 (15 Linee r.a.)
                                <br>Fax: +39 02 611199
                                <br>Email: gronzino@sge-syscom.com
                                <br>Web: http://www.sge-syscom.com
                            </p>
                            <button class="btn-subscribe">GET DIRECTION</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-for-collap">
                <div class="find-distributor-list collapsed  hide-box text-delta" data-toggle="collapse"
                    data-parent="#find-distributor-type" href="#collapse-fad-japan">

                    <h5>JAPAN</h5>
                </div>
                <div id="collapse-fad-japan" class="find-distributor-list-sub collapse"
                    data-parent="#find-distributor-type">
                    <div class="force-overflow">
                        <div class="find-distributor-address">
                            <p class="text-sixteen-dark mr-b-1">Okaya Electronics Corp.</p>
                            <p>Kandashinko Bldg. 7F, 2-1 Kandatacho Chiyoda-ku, Tokyo101-0046
                                <br>Tel: +81-3-5207-2750
                                <br>Web: https://www.oec.okaya.co.jp/
                            </p>
                            <button class="btn-subscribe">GET DIRECTION</button>
                        </div>
                        <div class="find-distributor-address">
                            <p class="text-sixteen-dark mr-b-1">Kaga Micro Solution Co.,LTD</p>
                            <p>Hatchobori Plaza Building, 3-27-10 Hatchobori,Chuo-ku Tokyo 104-0032
                                <br>Tel: +81-3-5931-0160
                                <br>Web: http://www.microsol.co.jp/index.html
                            </p>
                            <button class="btn-subscribe">GET DIRECTION</button>
                        </div>
                        <div class="find-distributor-address">
                            <p class="text-sixteen-dark mr-b-1">Tsuzuki Denki Co., Ltd.</p>
                            <p>2-5-3, Nishi-Shinbashi, Minato-Ku, Tokyo 105-8420, Japan
                                <br>Tel: +81-3-3502-2521
                                <br>Web: http://www.tsuzuki.co.jp
                            </p>
                            <button class="btn-subscribe">GET DIRECTION</button>
                        </div>
                        <div class="find-distributor-address">
                            <p class="text-sixteen-dark mr-b-1">Bellnix Co., Ltd.</p>
                            <p>5-7-8,Negishi,Minami-Ku,Saitama-Shi,Saitama-Ken,336-0024,Japan
                                <br>Tel: +81-48-864-7733
                                <br>Web: http://www.bellnix.co.jp/
                            </p>
                            <button class="btn-subscribe">GET DIRECTION</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-for-collap">
                <div class="find-distributor-list collapsed  hide-box text-delta" data-toggle="collapse"
                    data-parent="#find-distributor-type" href="#collapse-fad-korea">

                    <h5>KOREA</h5>
                </div>
                <div id="collapse-fad-korea" class="find-distributor-list-sub collapse"
                    data-parent="#find-distributor-type">
                    <div class="force-overflow">
                        <div class="find-distributor-address">
                            <p class="text-sixteen-dark mr-b-1">Bluecosmos</p>
                            <p>Chunui Techno Tower 4F RM 404, 80 Jomaru-ro 385 Beongil,
                                <br>Bucheon-si, Gyeonggi-do, Korea
                                <br>Tel: +82-32-662-2350
                                <br>Fax: +82-32-662-2351
                                <br>Email: shawn.yoon@bluecosmos.co.kr
                                <br>Web: http://www.bluecosmos.co.kr
                            </p>
                            <button class="btn-subscribe">GET DIRECTION</button>
                        </div>
                        <div class="find-distributor-address">
                            <p class="text-sixteen-dark mr-b-1">KEC</p>
                            <p>5, Mabang-ro 10-gil, Seocho-gu, Seoul, Republic of Korea, 06775
                                <br>Tel : +82-2025-5702
                                <br>Email : swlee@kec.co.kr
                                <br>Web : www.kec.co.kr
                            </p>
                            <button class="btn-subscribe">GET DIRECTION</button>
                        </div>
                        <div class="find-distributor-address">
                            <p class="text-sixteen-dark mr-b-1">One Corporation</p>
                            <p>1302, 648, Seobusaet-Gil, Geumcheon-Gu, Seoul, Korea, 08504
                                <br>Tel: +82-3283-4105
                                <br>Email: sam@onecorp.co.kr
                                <br>Web: http://www.deltapsu.co.kr/
                            </p>
                            <button class="btn-subscribe">GET DIRECTION</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-for-collap">
                <div class="find-distributor-list collapsed  hide-box text-delta" data-toggle="collapse"
                    data-parent="#find-distributor-type" href="#collapse-fad-taiwan">

                    <h5>TAIWAN</h5>
                </div>
                <div id="collapse-fad-taiwan" class="find-distributor-list-sub collapse"
                    data-parent="#find-distributor-type">
                    <div class="force-overflow">
                        <div class="find-distributor-address">
                            <p class="text-sixteen-dark mr-b-1">ACE PILLAR CO., LTD.</p>
                            <p>2F, No.7, Lane 83, Sec. 1, Kuang - Fu Rd., San – Chung Dist.,
                                <br>New Taipei City, Taiwan, R.O.C.
                                <br>Tel: +886-2-2995-8400
                                <br>Email: sales@acepillar.com.tw
                                <br>Web: www.acepillar.com.tw
                            </p>
                            <button class="btn-subscribe">GET DIRECTION</button>
                        </div>
                        <div class="find-distributor-address">
                            <p class="text-sixteen-dark mr-b-1">Honya Electronic CO., LTD.</p>
                            <p>8F, No.99, Sec 3, Nankang Rd., Taipei, Taiwan, R.O.C.
                                <br>Tel: +886-2-2785-6812
                                <br>Email: rickhu@honyabiz.com.tw
                                <br>Web: http://www.honyabiz.com.tw
                            </p>
                            <button class="btn-subscribe">GET DIRECTION</button>
                        </div>
                        <div class="find-distributor-address">
                            <p class="text-sixteen-dark mr-b-1">FIRMTECH ELECTRONICS CO., LTD. ( 聯新 / 聯發科 )</p>
                            <p>2F., No.7, LN. 420, Sec. 5, Cheng gong Rd., Nei-hu Dist., Taipei
                                <br>City 11477, Taiwan, R.O.C.
                                <br>Tel: +886-2-2633-0559 (TW) ; +86-755-26612663 (CN)
                                <br>Mobile: 1300-6699-879 & 0937-525-975 (Alpha Liu)
                                <br>Email: rebecca@firmtek.net ; alpha.liu@firmtek.net
                                <br>Web: http://www.firmtek.net
                            </p>
                            <button class="btn-subscribe">GET DIRECTION</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-for-collap">
                <div class="find-distributor-list collapsed  hide-box text-delta" data-toggle="collapse"
                    data-parent="#find-distributor-type" href="#collapse-fad-thailand">

                    <h5>THAILAND</h5>
                </div>
                <div id="collapse-fad-thailand" class="find-distributor-list-sub collapse"
                    data-parent="#find-distributor-type">
                    <div class="force-overflow">
                        <div class="find-distributor-address">
                            <p class="text-sixteen-dark mr-b-1">Electronics Source Co.,Ltd.</p>
                            <p>256 Floor 5 and 6 Phahonyothin Road,
                                <br>Sam Sen Nai, Phayathai,
                                <br>Bangkok 10400, Thailand
                                <br>Tel: +662-062-4970
                                <br>Fax: +662-062-4999
                                <br>Email: info@es.co.th
                                <br>Web: http://www.es.co.th
                            </p>
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