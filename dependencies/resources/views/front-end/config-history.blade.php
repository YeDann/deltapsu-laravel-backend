@extends('layouts.front-end')
@section('css')
<link rel="stylesheet" href="{{asset('/frontend-asset/css/vanilla-calendar-min.css')}}">
<style>
    @media (max-width: 992px) {
        .resources-download {
            padding: 12px;
        }
    }

    .bg-back {
        background-color: #444444;
        color: #fff;
        font-weight: bold;
        border: 1px solid #E3EFF8;
        font-size: 14px;

    }

    .bg-bule {
        background-color: #F0F5FA;
        color: #444444;
        font-weight: 400;
        border: 1px solid #E3EFF8;
        font-size: 14px;

    }

    .bg-bule.active {
        color: #76B900;
        font-weight: bold;
    }

    .bg-bule.no-active {
        color: #F08200;
        font-weight: bold;

    }
</style>
@endsection
@section('meta')
<title>{{isset($metatag[0]->title)? $metatag[0]->title :''}}</title>
<meta name="description" content="{{isset($metatag[0]->description)? $metatag[0]->description :''}}">
<link rel="canonical" href="{{url()->current()}}" />
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
                    <li class="breadcrumb-item active text-breadcrumb-home" aria-current="page"><a href="#">
                            {{$staticContent['Partners']}}</a></li>
                    <li class="breadcrumb-item active text-breadcrumb-home" aria-current="page"><a
                            href="{{route('marketingResources')}}">{{$staticContent['Marketing_Resources']}}</a></li>
                    <li class="breadcrumb-item active text-breadcrumb" aria-current="page"><a
                            href="#">{{$staticContent['Configurable_History']}}</a></li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="padding-top-content-breadcrumb visible-up-922"></div>
<div class="box-events mb-5">
    <div class="container">
        <h2 class="text-title-delta visible-up-922">{{$staticContent['Configurable_History']}} </h2>
        <h3 class="text-title-delta invisible-up-922">{{$staticContent['Configurable_History']}} </h3>
        <div class="row mb-4">
            <div class="col-lg-9 col-md-6"></div>
            <div class="col-lg-3 col-md-6">
                <div class="form-group">
                    <select class="form-control" id="filterData" onchange="filterData(this.value)">
                        <option value="">Default</option>
                        <option value="desc">Newest - Oldest</option>
                        <option value="asc">Oldest - Newest</option>
                        <!--                         <option value="name_asc">Model Name A-Z</option>
                        <option value="name_desc">Model Name Z-A</option> -->
                    </select>
                </div>
            </div>
        </div>
        @foreach ($con_his as $item)
        <div class="row mb-4 m-0 moreBox" style="display: none;">
            <div class="col-md-3 p-0 bg-back">
                <div class="p-2">Enquiry Date</div>
            </div>
            <div class="col-md-3 p-0 bg-bule">
                <div class="p-2">{{$item->created_at}}</div>
            </div>
            <div class="col-md-3 p-0  bg-back">
                <div class="p-2"> Country</div>
            </div>
            <div class="col-md-3 p-0 bg-bule">
                <div class="p-2">{{isset($item->country)?$item->country:'-'}}</div>
            </div>
            <div class="col-md-3 p-0 bg-back">
                <div class="p-2">
                    Factory Model Name
                </div>
            </div>
            <div class="col-md-3 p-0 bg-bule">
                <div class="p-2">
                    {{isset($item->factory_model)?$item->factory_model:'-'}}
                </div>
            </div>
            <div class="col-md-3 p-0 bg-back">
                <div class="p-2">
                    Email
                </div>
            </div>
            <div class="col-md-3 p-0 bg-bule">
                <div class="p-2">
                    {{isset($item->email)?$item->email:'-'}}
                </div>
            </div>
            <div class="col-md-3 p-0 bg-back">
                <div class="p-2">
                    Customer Model Name
                </div>
            </div>
            <div class="col-md-3 p-0 bg-bule">
                <div class="p-2">
                    {{$item->customer_model}}
                </div>
            </div>
            <div class="col-md-3 p-0 bg-back">
                <div class="p-2">
                    Enquiry Status
                </div>
            </div>
            <div class="col-md-3 p-0 bg-bule  {{$item->type_his == 0?'no-active':'active'}}">
                <div class="p-2">
                    {{$item->type_his == 0?'NO':''}}
                    {{$item->type_his == 3?'Send PDF':''}}
                    {{$item->type_his == 1?'YES':''}}
                </div>
            </div>
            <div class="col-md-3 p-0 bg-back">
                <div class="p-2">
                    Message
                </div>
            </div>
            <div class="col-md-3 p-0 bg-bule">
                <div class="p-2">
                    {{isset($item->Message)?$item->Message:'-'}}
                </div>
            </div>
            <div class="col-md-3 p-0 bg-back">
                <div class="p-2">
                    Configurable Detail
                </div>
            </div>
            <div class="col-md-3 p-0 bg-bule">
                <div class="p-2">
                    <a href="{{config('app.url')}}/config_history/{{$item->file}}" target="_blank">
                        <button class="btn-downlode ">View</button>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
        <div class="row">
            <div class="col-lg-12 text-center">
                <div id="loadMore" class="btn btn-boxen" onclick="loadeMore(event,4)">{{$staticContent['See_More']}}
                </div>
            </div>
        </div>
        {{-- @foreach ($con_his as $item)
        <table class="table">
            <thead>
                <tr>
                    <th scope="col" class="bg-back">Enquiry Date</th>
                    <th scope="col" class="bg-bule">{{$item->created_at}}</th>
                    <th scope="col" class="bg-back">Country</th>
                    <th scope="col" class="bg-bule">{{isset($item->country)?$item->country:'-'}}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th class="bg-back">Factory Model Name</th>
                    <td class="bg-bule">{{isset($item->factory_model)?$item->factory_model:'-'}} </td>
                    <td class="bg-back">Email</td>
                    <td class="bg-bule">{{isset($item->email)?$item->email:'-'}}</td>
                </tr>
                <tr>
                    <th class="bg-back">Customer Model Name</th>
                    <td class="bg-bule">{{$item->factory_model}}</td>
                    <td class="bg-back"> Enquiry Status</td>
                    <td class="bg-bule {{$item->type_his == 0?'no-active':'active'}}">{{$item->type_his ==
                        0?'NO':'YES'}}</td>
                </tr>
                <tr>
                    <th class="bg-back">Message</th>
                    <td class="bg-bule">{{isset($item->Message)?$item->Message:'-'}}</td>
                    <td class="bg-back">Configurable Detail</td>
                    <td class="bg-bule"> <button class="btn-downlode ">View</button></td>
                </tr>
            </tbody>
        </table>
        @endforeach --}}


    </div>
</div>
@endsection
@section('js')
<script>
    $( document ).ready(function() {
        $(".moreBox").slice(0, 8).show();
    });
    function loadeMore(event,i){
    if ($(".moreBox:hidden").length != 0) {
      $("#loadMore").show();
    }  
      event.preventDefault();
     
      $(".moreBox:hidden").slice(0, 4).slideDown();
      if ($(".moreBox:hidden").length == 0) {
        $("#loadMore").fadeOut('hide');
      }
    }

    var getUrlParameter = function getUrlParameter(sParam) {
        var sPageURL = window.location.search.substring(1),
            sURLVariables = sPageURL.split('&'),
            sParameterName,
            i;

        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');

            if (sParameterName[0] === sParam) {
                return typeof sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
            }
        }
        return false;
    };

    var sortName = getUrlParameter('sort');

    $(`#filterData option[value=${sortName}]`).attr("selected",true);

    function filterData(order){

        if(order == ""){
            window.history.pushState("myhistory", "Title", `?reset=1`)
            window.location.reload()
        }else{
            window.history.pushState("myhistory", "Title", `?sort=${order}`)
            window.location.reload()
        }

    }
        
</script>
@endsection