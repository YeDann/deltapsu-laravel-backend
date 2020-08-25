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
                    <li class="breadcrumb-item active text-breadcrumb" aria-current="page"><a href="#">DELTA R&D</a></li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="padding-top-content-breadcrumb visible-up-922"></div>
<div class="box-deltapsu mb-5">
    <div class="container">
        <h2 class="text-title-delta visible-up-922">DELTA R&D</h2>
        <h3 class="text-title-delta invisible-up-922">DELTA R&D</h3>
        <img class="col-12  visible-up-922" src="{{asset('/frontend-asset/image/banner-delta-rd_201508101439180101987642@2x.png')}}" alt="">
        <p class="col-12 mt-4">As a power management products market leader, Delta Electronics Group owns numerous worldwide patents. With our unyielding pursuit for excellence in 
            <br>    quality and technology, we have been continuously investing in R&D talents and state-of-the-art facilities globally. Delta R&D centers can be found in Germany, 
            <br>    China, Thailand, USA, Europe and many other parts of the world.</p>
        <img class="col-12  invisible-up-922 mt-4" src="{{asset('/frontend-asset/image/banner-delta-rd_mobile@2x.png')}}" alt="">    
        
    </div>
</div>
@endsection


@section('js')
<script>

    
</script>
@endsection