@extends('layouts.front-end')
@section('css')
<style>
    hr {
        border-top: 2px solid #E3EFF8;
    }

    .content img {
        max-width: 100%;
    }

    .content b {
        font-weight: bold;
    }
</style>
@endsection
@section('meta')
<title>{{isset($metatag[0]->title)? $metatag[0]->title :''}}</title>
<meta name="description"
    content="{!! trim(iconv_substr(strip_tags(isset($contents[0]->meta_description)? $contents[0]->meta_description:''),0,155,'UTF-8')) !!}" />
<meta property="og:title" content="{{isset($metatag[0]->title)? $metatag[0]->title :''}}" />
<meta property="og:description"
    content="{!! trim(iconv_substr(strip_tags(isset($contents[0]->meta_description)? $contents[0]->meta_description:''),0,155,'UTF-8')) !!}" />

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
                                data-toggle="dropdown" id="tools-dropdown"> {{$staticContent['Technical_Support']}}</a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="#" class="text-bold">
                                    {{ isset($staticContent['Technical_Support'])
                                        ? $staticContent['Technical_Support']
                                        : 'Technical Support' }}
                                </a>
                            </li>
                            <hr>
                            <!-- Catalog / Documents -->
                            <li>
                                <a href="{{ route('index','catalogs') }}">
                                    {{ isset($staticContent['catalogs']) ? $staticContent['catalogs'] : 'Catalogs' }}
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('index','product-documents') }}">
                                    {{ isset($staticContent['Product_Documents']) ? $staticContent['Product_Documents'] : 'Product Documents' }}
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('productCoparison') }}">
                                    {{ isset($staticContent['product_comparison'])
                                        ? $staticContent['product_comparison']
                                        : 'Product Comparison' }}
                                </a>
                            </li>

                            <!-- News / Media -->
                            <li>
                                <a href="{{ route('index', [
                                    'page' => 'news',
                                    'type' => slugifyHead(isset($newsTypes['Industry Know-How']) ? $newsTypes['Industry Know-How']->typename : 'Industry Know-How'),
                                    'type-id' => isset($newsTypes['Industry Know-How']) ? $newsTypes['Industry Know-How']->id : ''
                                ]) }}">
                                    {{ isset($newsTypes['Industry Know-How'])
                                        ? $newsTypes['Industry Know-How']->typename
                                        : 'Industry Know-How' }}
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('index', ['page' => 'videos']) }}">
                                    {{ isset($staticContent['Videos']) ? $staticContent['Videos'] : 'Videos' }}
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('index', [
                                    'page' => 'news',
                                    'type' => slugifyHead(isset($newsTypes['Product Notice']) ? $newsTypes['Product Notice']->typename : 'Product Notice'),
                                    'type-id' => isset($newsTypes['Product Notice']) ? $newsTypes['Product Notice']->id : ''
                                ]) }}">
                                    {{ isset($newsTypes['Product Notice'])
                                        ? $newsTypes['Product Notice']->typename
                                        : 'Product Notice' }}
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('index', [
                                    'page' => 'news',
                                    'type' => slugifyHead(isset($newsTypes['EOL']) ? $newsTypes['EOL']->typename : 'EOL'),
                                    'type-id' => isset($newsTypes['EOL']) ? $newsTypes['EOL']->id : ''
                                ]) }}">
                                    {{ isset($newsTypes['EOL'])
                                        ? $newsTypes['EOL']->typename
                                        : 'EOL' }}
                                </a>
                            </li>

                            <!-- Support -->
                            <li>
                                <a href="{{ route('index','faqs') }}">
                                    {{ isset($staticContent['FAQs']) ? $staticContent['FAQs'] : 'FAQs' }}
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('contactSupport') }}">
                                    {{ isset($staticContent['Technical_Service'])
                                        ? $staticContent['Technical_Service']
                                        : 'Technical Service' }}
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="breadcrumb-item text-breadcrumb" aria-current="page"><a
                            href="{{route('index','faqs')}}">{{$staticContent['FAQs']}}</a></li>
                    <li class="breadcrumb-item active text-breadcrumb" aria-current="page"><a href="#">
                            {{isset($faqs[0]->title)? $faqs[0]->title:'' }}</a></li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="padding-top-content-breadcrumb visible-up-922"></div>
<section class="box-news  my-5 {{-- visible-up-922 --}}">
    <div class="container">
        <div class="box-news-detail">
            <h2 class="text-dark">
                {{isset($faqs[0]->title)? $faqs[0]->title:'' }}
            </h2>
        </div>
        <div class="content">
            @if(isset($faqs[0]->content))
            {!! $faqs[0]->content !!}
            @endif
        </div>
        <div class="">

        </div>

    </div>

    </div>
</section>



@endsection


@section('js')

@endsection