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
                    <li class="breadcrumb-item text-breadcrumb-home"><a href="{{route('index','home')}}">Home</a></li>
                    <li class="breadcrumb-item active text-breadcrumb" aria-current="page"><a href="{{route('index','application')}}">Applications</a></li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="padding-top-content-breadcrumb visible-up-922"></div>
<div class="box-applications box-applications-mobile my-5">
    <div class="container">
        <div class="visible-tablets-up">
            <div class="box-applications  ">
                <div class="container">
                    <h2 class="text-title-delta-home ">Application</h2>
                    <div class="grid-container">
                        @foreach ($applications as $item)
                        <a href="" class="blogBox moreBox" style="display: none;">
                            <div class="grid-item ">
                                <div class="grid-sub-pic"
                                    style="background: url('{{config('app.url')}}/medias/categories/{{$item->thumbnail}}');">
                                    {{--  <img src="{{config('app.url')}}/medias/categories/{{$item->thumbnail}}" alt=""> --}}
                                </div>
                                <div class="grid-sub-text">
                                    <img src="{{config('app.url')}}/medias/categories/{{$item->color_icon}}" alt="">
                                    <p class="text-uppercase">{{$item->name}}</p>
                                    <ul class="app-detail-bullet">
                                        {{-- <li>Escalator & Elvator</li>
                                            <li>CCTV Surveilance</li>
                                            <li>HVAC Control</li> --}}
                                        <?php
                                            $str = $item->overview;
                                            $st = explode("\n", $str);
                                            for ($k = 0; $k < count($st); $k++) {
                                                echo $st[$k] = '<li>'
                                                        . $st[$k]
                                                        . '</li>';
                                            }
                                            ?>
                                    </ul>
        
                                </div>
                            </div>
                        </a>
                        @endforeach
        
                    </div>
                </div>
                <div class="text-center mr-24px" id="loadMore-application" style="">
                    <a href="#" class="btn btn-boxen">SEE MORE</a>
                </div>
            </div>
        </div>
        <div class="visible-mobile">
            <div class="box-applications-mobile  ">
                <div class="container">
                    <h2 class="text-title-delta-home ">APPLICATIONS </h2>
                    <div class="grid-container">
                        @foreach ($applications as $item)
                        <a href="" class="blogBox-mb moreBox-mb" style="display: none;">
                            <div class="grid-item ">
                                <div class="grid-sub-pic"
                                    style="background: url('{{config('app.url')}}/medias/categories/{{$item->thumbnail}}');">
                                </div>
                                <div class="grid-sub-text">
                                    <img src="{{config('app.url')}}/medias/categories/{{$item->color_icon}}" alt="">
                                    <p class="text-uppercase">{{$item->name}}</p>
                                    <ul class="app-detail-bullet">
        
                                        <?php
                                            $str = $item->overview;
                                            $st = explode("\n", $str);
                                            for ($k = 0; $k < count($st); $k++) {
                                                echo $st[$k] = '<li>'
                                                        . $st[$k]
                                                        . '</li>';
                                            }
                                            ?>
                                    </ul>
        
                                </div>
                            </div>
                        </a>
                        @endforeach
        
                    </div>
                </div>
                <div class="text-center mr-24px" id="loadMore-application-mobile" style="">
                    <a href="#" class="btn btn-boxen">SEE MORE</a>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection


@section('js')
<script>


</script>
<script>
    $(document).ready(function () {
        $('#nav-two').removeClass('scrolled');
    });

    function seeMore() {

        if ($(".blogBox-mb:hidden").length === 8) {
            $("#loadMore-application-mobile").hide();
        } else if ($(".blogBox-mb:hidden").length != 0) {
            $("#loadMore-application-mobile").show();
        }
        if ($(".blogBox:hidden").length === 8) {
            $("#loadMore-application").hide();
        } else if ($(".blogBox:hidden").length != 0) {
            $("#loadMore-application").show();
        }
        $("#loadMore-application").on('click', function (e) {
            e.preventDefault();
            $(".moreBox:hidden").slice(0, 2).slideDown();
            if ($(".moreBox:hidden").length == 0) {
                $("#loadMore-application").fadeOut('slow');
            }
        });
        $("#loadMore-application-mobile").on('click', function (e) {
            console.log("Length:" + $(".blogBox-mb:hidden").length);
            e.preventDefault();
            $(".moreBox-mb:hidden").slice(0, 2).slideDown();
            if ($(".moreBox-mb:hidden").length == 0) {
                $("#loadMore-application-mobile").fadeOut('slow');
            }
        });
    }

    function showBtnSeeMore(w) {
        if (w <= 1205) {
            $('#loadMore-application').show();
            $(".moreBox").slice(0, 4).show();
            $(".moreBox").slice(4, 9).hide();
            $(".moreBox-mb").slice(0, 4).show();
            $(".moreBox-mb").slice(4, 9).hide();
            seeMore();
        } else {
            $('#loadMore-application').hide();
            $(".moreBox").slice(0, 9).show();
            seeMore();
        }
    }
    $('#loadMore-application').hide();
    $('#loadMore-application-mobile').hide();
    $(document).ready(function () {
        var w = $(window).width();
        showBtnSeeMore(w);
    });
    $(window).resize(function () {
        var w = $(window).width(); // New width
        console.log(w)
        showBtnSeeMore(w);

    });

</script>
@endsection