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
                    <li class="breadcrumb-item text-breadcrumb-home"><a href="{{route('index','home')}}">{{$staticContent['Home']}}</a></li>
                    <li class="breadcrumb-item active text-breadcrumb-home dropdown" aria-current="page"><a
                            href="#" data-toggle="dropdown" id="tools-dropdown">{{$staticContent['About']}}</a>
                            <ul class="dropdown-menu">
                                <li><a href="#" id="tools-dropdown" class="text-bold">{{$staticContent['About']}}</a></li>
                                <hr>
                                @foreach ($navaboutus as $abt)
                                <li><a href="{{route('aboutUs',$abt->stug)}}">{{$abt->title}}</a></li>
                                @endforeach
                              </ul>   
                    </li>
                    <li class="breadcrumb-item active text-breadcrumb" aria-current="page"><a href="#">{{$aboutus[0]->title}}</a></li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="padding-top-content-breadcrumb visible-up-922"></div>
<div class="box-deltapsu mb-5">
    <div class="container">
    <h2 class="text-title-delta visible-up-922">{{$aboutus[0]->title}}</h2>
        <h3 class="text-title-delta invisible-up-922">{{$aboutus[0]->title}}</h3>
        <div class="text-editor">
            <?php echo $aboutus[0]->content  ?>
        </div>
       
       
        
    </div>
</div>


@endsection


@section('js')
<script>

    
</script>
@endsection