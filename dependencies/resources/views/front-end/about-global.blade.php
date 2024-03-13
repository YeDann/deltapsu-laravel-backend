@extends('layouts.front-end')
@section('css')
<style>
    /* map */

    .wrp-map {
        position: relative;
        display: block;
        z-index: 1;
    }

    .wrp-map img {
        position: absolute;
        top: 0;
        left: 0;
        z-index: 100;
        display: none;
    }

    .wrp-map img {
        position: absolute;
        width: 100%;
        top: 0;
        left: 0;
        z-index: 100;
        display: none;
    }

    .wrp-map img.img-first {
        display: block;
    }

    .wrp-map img.img-line {
        display: block;
        position: relative;
        z-index: 200;
    }

    .wrp-map area {
        outline-color: #0087DC;
    }

    .mb30 {
        margin-bottom: 30px !important;
    }

    .img-responsive {
        max-width: 100%;
        height: auto;
    }
</style>
@endsection
@section('meta')
<title>{{isset($aboutus[0]->metaTitle)? $aboutus[0]->metaTitle :''}}</title>
<meta name="description" content="{{isset($aboutus[0]->metaDescription)? $aboutus[0]->metaDescription :''}}">
<meta name="keywords" content="{{isset($aboutus[0]->metaKeyword) ? $aboutus[0]->metaKeyword :''}}">
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
                            data-toggle="dropdown" id="tools-dropdown">{{$staticContent['About']}}</a>
                        <ul class="dropdown-menu">
                            <li><a href="#" id="tools-dropdown" class="text-bold">{{$staticContent['About']}}</a></li>
                            <hr>

                            @foreach ($navaboutus as $abt)
                            <li><a href="{{route('aboutUs',$abt->stug)}}" class="">{{$abt->title}}</a></li>

                            @endforeach
                        </ul>
                    </li>
                    <li class="breadcrumb-item active text-breadcrumb" aria-current="page"><a
                            href="#">{{$aboutus[0]->title}}</a></li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="padding-top-content-breadcrumb visible-up-922"></div>
<div class="box-deltapsu">
    <div class="container">
        <h2 class="text-title-delta visible-up-922">{{$aboutus[0]->title}}</h2>
        <h3 class="text-title-delta invisible-up-922">{{$aboutus[0]->title}}</h3>
        <div class="text-detail">
            <?php echo $aboutus[0]->content  ?>
        </div>
        <div class="visible-up-922">
            <div class="row">
                <div class="col-md-12 content">
                    <div class="text-center mb30">
                        <div class="wrp-map">
                            <img src="{{asset('/frontend-asset/image/global-map/Map.webp')}}"
                                class="img-responsive img-first">
                            <img src="{{asset('/frontend-asset/image/global-map/M-America.webp')}}" class="m-americas"
                                style="display: none; opacity: 1;">
                            <img src="{{asset('/frontend-asset/image/global-map/M-Asia.webp')}}" class="m-asia">
                            <img src="{{asset('/frontend-asset/image/global-map/M-Europe.webp')}}" class="m-europe">
                            <img src="{{asset('/frontend-asset/image/global-map/Clear.webp')}}"
                                class="img-responsive img-line" usemap="#area-world" height="592" width="1140"
                                style=" height: auto;">
                            {{-- <img src="{{asset('/frontend-asset/image/global-map/line.png')}}"> --}}
                            <map name="area-world" id="area-world">
                                <area href="http://www.delta-americas.com/" target="_blank" class="americas"
                                    shape="poly"
                                    coords="7.25,25.77,8.18,25.10,10.27,23.98,12.70,25.32,14.56,25.32,15.72,25.54,17.46,25.54,19.78,26.22,21.29,26.66,21.64,25.99,24.42,26.89,24.54,24.87,24.19,23.98,25.58,24.87,26.39,25.54,26.39,26.66,27.32,25.32,27.67,26.44,26.86,27.56,26.04,29.12,24.88,30.69,25.35,33.15,26.74,33.82,27.78,35.61,28.36,36.06,28.36,34.72,28.83,33.37,28.36,31.58,28.60,30.24,29.76,30.47,30.45,30.69,30.80,32.03,31.73,31.36,32.66,32.93,32.66,34.27,33.82,35.16,33.93,36.73,34.63,38.52,33.93,38.74,33.35,38.74,33.12,36.95,31.38,37.40,32.19,38.30,32.31,39.41,32.77,39.64,31.73,41.20,31.38,40.31,30.57,40.98,30.34,42.55,29.29,43.67,29.18,45.68,28.02,47.02,28.13,48.59,27.78,49.93,27.20,48.36,26.39,48.14,25.35,48.14,24.30,49.03,23.96,51.27,24.54,53.06,25.46,53.06,26.28,52.39,26.39,53.96,26.39,54.63,27.44,54.63,27.44,57.31,28.60,57.98,29.76,56.86,31.03,57.09,32.19,57.31,33.00,58.21,33.35,59.10,34.63,60.00,35.32,61.79,36.37,62.46,37.06,63.35,38.34,63.80,38.69,65.81,37.88,68.50,37.76,71.18,36.83,72.75,35.67,73.87,35.44,75.21,34.86,77.00,34.28,78.79,33.58,79.01,33.35,81.25,32.54,81.25,32.31,82.14,31.73,82.82,31.84,84.16,31.03,84.83,31.38,86.17,30.80,87.29,31.03,88.63,31.38,89.53,29.87,89.97,29.52,87.96,29.29,85.50,29.76,83.49,29.41,82.14,29.64,80.13,29.76,76.33,30.34,71.18,28.94,69.17,27.78,65.14,27.90,63.13,28.36,61.11,28.60,59.33,27.78,58.88,26.28,57.09,25.23,55.30,23.84,55.30,22.22,53.73,21.87,51.94,20.71,51.94,19.20,46.13,17.81,44.34,17.58,40.76,16.88,37.62,15.84,35.61,14.79,33.60,13.98,31.81,11.89,31.36,11.31,31.81,8.18,34.72,8.87,32.03,8.29,31.58,7.48,30.69,8.41,29.35,7.37,27.78,8.29,27.11">
                                <area href="http://www.deltaww.com/default.aspx?hl=zh-TW" target="_blank" class="asia"
                                    shape="poly"
                                    coords="58.12,56.19,59.40,55.52,60.90,53.28,60.56,50.60,61.95,50.38,62.88,51.05,63.34,52.61,64.27,52.61,64.62,55.97,65.20,57.98,65.66,58.43,66.01,56.19,66.47,54.63,67.75,53.06,68.56,51.72,69.14,54.40,69.84,55.07,69.95,57.54,70.07,58.88,69.03,60.00,70.07,62.23,70.88,64.47,71.93,65.14,74.01,66.71,73.67,65.37,72.51,64.47,71.35,62.01,71.35,60.44,70.19,57.31,70.65,56.64,71.69,57.76,72.97,57.09,72.62,53.51,73.43,52.39,75.17,50.82,75.87,48.59,75.75,45.68,75.99,43.67,75.17,43.22,76.57,42.99,76.80,45.01,77.49,44.56,77.26,42.99,78.07,41.20,79.47,39.86,80.05,37.62,80.28,34.27,79.00,34.05,81.32,31.36,83.06,31.81,84.45,29.79,84.69,30.91,83.64,32.93,83.99,36.73,85.61,32.93,86.31,30.69,87.94,30.69,89.79,28.90,89.91,27.56,91.30,27.56,91.88,26.22,90.02,25.10,87.70,23.98,86.89,25.32,85.73,24.43,85.15,25.10,84.45,23.31,82.71,23.31,82.25,22.41,81.55,22.86,80.63,21.52,79.81,22.86,78.42,23.31,77.73,23.08,77.03,21.96,76.22,21.96,75.87,22.41,73.20,21.29,73.78,19.73,72.39,19.50,72.27,18.39,70.65,19.28,68.91,19.95,67.17,20.85,66.24,21.74,65.43,22.41,64.85,21.96,64.62,24.65,63.69,28.01,62.53,31.36,61.37,36.95,60.32,39.86,59.63,41.43,57.66,42.32,54.87,41.88,53.83,42.99,53.71,43.89,55.45,45.01,55.34,47.47,55.80,50.15,56.50,52.84,57.31,54.18,57.42,56.19">
                                <area href="http://www.delta-emea.com/default.aspx?hl=en-GB" target="_blank"
                                    class="europe" shape="poly"
                                    coords="56.73,41.65,58.82,41.43,60.09,39.19,60.79,36.06,61.95,32.70,63.81,27.33,64.27,24.65,64.04,22.64,63.11,24.43,62.06,25.10,60.32,23.08,61.72,21.07,63.23,19.73,62.99,19.06,61.48,19.95,58.93,23.31,59.63,24.65,58.82,25.77,57.54,26.66,56.61,25.77,54.52,24.65,53.36,23.75,51.28,25.10,49.88,27.33,48.84,29.35,48.03,32.26,48.72,34.27,48.38,35.61,47.33,35.61,46.52,33.37,45.82,31.81,45.24,33.15,44.66,33.37,44.32,35.84,44.55,36.95,45.48,35.84,45.24,37.40,45.71,38.07,46.40,40.31,45.82,40.76,44.43,40.76,44.78,43.22,44.78,44.78,46.64,44.11,47.45,41.43,48.96,40.76,49.54,41.88,50.00,42.99,49.77,44.56,51.16,43.22,52.20,43.67,53.02,43.89,52.67,42.32,54.18,40.53,55.22,39.86,55.80,40.53">
                            </map>


                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="invisible-up-922 mb-5 mt-4">
            <a class="btn btn-subscribe w-100 mb-3"
                href="http://www.delta-americas.com/">{{$staticContent['America']}}</a>
            <a class="btn btn-subscribe w-100 mb-3"
                href="http://www.deltaww.com/default.aspx?hl=zh-TW">{{$staticContent['Asia']}}</a>
            <a class="btn btn-subscribe w-100 mb-3"
                href="http://www.delta-emea.com/default.aspx?hl=en-GB">{{$staticContent['Europe']}}</a>
        </div>

    </div>
</div>

@endsection


@section('js')
<script type="text/javascript">
    $(function(){
     var fp_ratio = 1.9259,
         img_fp = $('img.img-line'),
         width = img_fp.width(),
         height = Math.round(width/fp_ratio),
         pw = width/100,
         ph = height/100;
         img_fp.attr({width:width,height:height});
         $('#area-world area').each(function(){
           //alert($(this).attr("class"));
             var arr = $(this).attr('coords').split(',');
             var arr2 = [];
             $.each(arr,function(k,v){
                 arr2[k] = (k%2==0)?Math.round(v*pw):Math.round(v*ph);
             });
             $(this).attr('coords',(arr2.join()));

         });
         $('img.img-line').rwdImageMaps();
         $("#area-world area").hover(function(){
           $('img.m-'+$(this).attr('class')).stop().fadeIn(300);
         },function(){
           $('img.m-'+$(this).attr('class')).fadeOut(200);
         })
   });

</script>

@endsection