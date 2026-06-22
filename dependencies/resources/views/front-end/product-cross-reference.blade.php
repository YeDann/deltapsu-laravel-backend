@extends('layouts.front-end')
@section('css')
<link rel="stylesheet" href="{{asset('/frontend-asset/css/vanilla-calendar-min.css')}}">
<style>
    @media (max-width: 992px) {
        .resources-download {
            padding: 12px;
        }
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
                            href="#">{{$staticContent['Product_Cross_Reference']}}</a></li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="padding-top-content-breadcrumb visible-up-922"></div>
<div class="box-events mb-5">
    <div class="container">
        <h2 class="text-title-delta visible-up-922">{{$staticContent['Product_Cross_Reference']}}</h2>
        <h3 class="text-title-delta invisible-up-922">{{$staticContent['Product_Cross_Reference']}}</h3>

        <div class="content-seles-kit">
            {{-- <div class="resources-download ">
                <div class="detail-download ">
                    <h5>IPS Sales Kit September 2019</h5>
                    <p>{{$staticContent['Uploaded_on']}} 13-Mar-2019 | XLS, 4.7 MB</p>
                </div>
                <button class="btn-downlode ">DOWNLOAD XLS</button>
            </div> --}}

            @foreach ($product_docs as $item)
            <div class="resources-download ">
                <div class="detail-download ">
                    <h5>{{$item->name}}</h5>
                    <p>{{$staticContent['Uploaded_on']}} {{$item->date_info}}</p>
                </div>
                {{-- <a href="{{config('app.url')}}/file_doc_2/marketing_resources/{{$item->file}}" download=""><button
                        class="btn-downlode ">{{$staticContent['Downloads']}}</button></a> --}}

                <form method="POST" action="{{route('partnerLoginDoc_success')}}">
                    {{csrf_field()}}
                    <input type="hidden" name="section_id" value={{session('partner_id')}}>
                    <input type="hidden" name="doc" value={{$item->file}}>
                    <button class="btn-downlode" type="submit">{{$staticContent['Downloads']}}</button>
                </form>
            </div>
            @endforeach

        </div>
    </div>
</div>



@endsection


@section('js')

<script>


</script>
@endsection