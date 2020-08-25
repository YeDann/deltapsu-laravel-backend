@extends('layouts.front-end')
@section('css')
<style>

    
</style>
@endsection
@section('container')
<div class="padding-top-content">
</div>
<div class="products-index-nav visible-up-922">
    <div class="bg-bredcrumb">
        <div class="container">
            <nav aria-label="breadcrumb" id="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item text-breadcrumb-home"><a href="{{route('index','home')}}">HOME</a></li>
                    <li class="breadcrumb-item active text-breadcrumb-home dropdown" aria-current="page"><a
                            href="#" data-toggle="dropdown" id="tools-dropdown">ABOUT</a>
                            <ul class="dropdown-menu">
                                <li><a href="#" id="tools-dropdown" class="text-bold">ABOUT</a></li>
                                <hr>
                             
                              </ul>   
                    </li>
                    <li class="breadcrumb-item active text-breadcrumb" aria-current="page"><a href="#">DELTAPSU</a></li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="padding-top-content-breadcrumb visible-up-922"></div>
<div class="box-deltapsu mb-5">
    <div class="container">
        <h2 class="text-title-delta visible-tablets-up">DELTAPSU (Power Supply Unit)</h2>
        <h3 class="text-title-delta visible-mobile">DELTAPSU <br> (Power Supply Unit)</h3>
        <div class="row padding-mobile ">
            <div class="col-12">
                <p> Delta Electronics Group is a multi-billion dollar global company and the world’s leading producer of power supplies for the top names in industrial, medical and consumer electronics devices. For more than 40 years, Delta has been a well regarded and trusted ODM (Original Design Manufacturer) partner by many top tier companies on the Fortune® 500 list. These companies expect nothing less than the best technology, quality and reliability. With Delta’s continuing growth, innumerable industrial awards and expanding customer base for decades, the results speak for itself. </p>
                <p class="py-4">In 2008, Delta introduced its own brand of standard power supply units (PSU) which offer customers the same world class technology and quality that Delta’s ODM partners demand. Due to the fast growing popularity of Delta’s CliQ DIN Rail Power Supply and PMC Panel Mount Power Supply series, Delta has been introducing many more standard power supply form factors for a wide-variety of demanding applications from factory automation to F&B industry. Delta now offers more than four types of power supplies including medical grade type and more than 500 models in the portfolio that is continuously expanding.</p>        
                <p> For more information or enquiries, please do not hesitate to contact your local Delta Electronics distributor or visit www.DeltaPSU.com.</p>
            </div>
        </div>
        
        <div class="row padding-mobile column-pic-text">
            <img class="col-lg-5 col-md-12 img-my-mobeile" src="{{asset('/frontend-asset/image/banner-deltapsu-power-supply-unit_201508101439183122623766@2x.png')}}" alt="">
            <div class="col-lg-7 col-md-12" >
                <p class="text-delta visible-up-922">Suscipit nunc efficitur </p>
                <p class="text-detail">Delta was ranked at the highest A-level of the Climate Performance Leadership Index (CPLI) of the 2014 Carbon Disclosure Project (CDP). We were the only company from Greater China to be named to the CPLI from nearly 2,000 listed companies. Delta continues its dedication to developing technologies and solutions that aim to reduce global warming and ensure a sustainable future for mankind.</p>
            </div>
        </div>
    </div>
</div>


@endsection


@section('js')
<script>

    
</script>
@endsection