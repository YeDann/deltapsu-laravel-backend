@extends('layouts.front-end')
@section('css')
<style>
    .text-editor b{
        font-weight:bold;
        color: #000000;
        font-size: 22px;
    }
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
                    <li class="breadcrumb-item text-breadcrumb-home"><a href="{{route('index','home')}}">{{$staticContent['Home']}}</a></li>
                    <li class="breadcrumb-item active text-breadcrumb-home" aria-current="page"><a
                            href="#">{{$staticContent['Products']}}</a></li>
                    <li class="breadcrumb-item active text-breadcrumb-home" aria-current="page"><a href="#">{{$staticContent['Configurable_Power']}}</a></li>
                    <li class="breadcrumb-item active text-breadcrumb-ative" aria-current="page"><a
                            href="#"> {{$staticContent['Details']}}</a></li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="padding-top-content-breadcrumb visible-up-922"></div>
<div class="box-configurable-detail mb-5">
    <div class="container">
        <h2 class="text-title-delta visible-up-922">{{$staticContent['Configurable_Power']}}</h2>
        <h3 class="text-title-delta invisible-up-922">{{$staticContent['Configurable_Power']}}</h3>
        {{-- <h3 class="text-capitalize visible-up-922">Configure a Power Supply in your way with Delta AC-DC Configurable Power Supply</h3>
        <h4 class="text-capitalize invisible-up-922">Configure a Power Supply in your way with Delta AC-DC Configurable Power Supply</h4>
        <p class="mb-4">Delta Electronics is the world’s largest provider of switching power supplies. With its extensive experience in power supplies development and manufacturing, Delta created the MEG-A series 
            of AC-DC configurable power supply, for both medical and industrial applications. These isolated power modules enable the users to configure and combine output up to a maximum 2,100 
            watts using single or dual output modules.</p> --}}
           <div class="text-editor mb-4"> 
               {!!$subCategories[0]->content1 !!}
           </div>

        <div class="row add-space-mobile">
            <div class="col-xl-4  col-md-12">
                <div class="d-flex mb-4">
                    <img class="img-fluid m-auto w-100" src="{{asset('frontend-asset/image/Configurable-Power750.png')}}" alt="">
                </div>
                <div class="d-flex justify-content-center mb-4">
               
                    <a class="btn btn-enquiry mr-12px" href="{{route('LinktoEnquiry',[$subCategories[0]->sub_pro_id , $subCategories[0]->name,'MEG-1K2A4' ])}}">{{$staticContent['Enquiry']}}</a>
                <a class="btn btn-subscribe ml-12px" href="{{ route('producsList',[preg_replace('/\s+/', '-', 'Configurable Power'),7])}}">{{$staticContent['Product_lists']}}</a>
                </div>
            </div>
            <div class="col-xl-8 col-md-12">
                 <div class="text-editor mb-4"> 
                    {!!$subCategories[0]->content2 !!}
                </div>
                <div class="row add-space-mobile">
                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <h5 class="text-color-delta">{{$staticContent['Safety_Certificates']}}</h5>
                     
                        <div class="text-editor mb-4"> 
                            {!!$subCategories[0]->safety_cer !!}
                        </div>
                        <h5 class="text-color-delta">{{$staticContent['Dimensions']}}(L x W x H)</h5>
                  
                        <div class="text-editor mb-4"> 
                            {!!$subCategories[0]->dimension !!}
                        </div>
                        <h5 class="text-color-delta">{{$staticContent['Unit_Weight']}}</h5>
                        <div class="text-editor mb-4"> 
                            {!!$subCategories[0]->unit_wight !!}
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <h5 class="text-color-delta">{{$staticContent['Highlights_Features']}}</h5>
                        <div class="text-editor mb-4"> 
                            {!!$subCategories[0]->highlight !!}
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
</script>
@endsection