@extends('layouts.admin')
@section('style')
<style>
    #test-label {
        height: 100px !important;
    }

    .btn-outline-secondary {
        border-color: #dcdcdc !important;
    }

    #item-wrap {
        margin: 8px 8px 8px 8px;
        background: #eee;
        padding: 5px 10px 30px 5px;
        -webkit-border-radius: 8px;
        -moz-border-radius: 8px;
        position: relative;
    }

    .text-count {
        right: 7px;
        bottom: 4px;
        position: absolute;
        font-size: 14px;
    }
</style>
@endsection
@section('content')
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Meta tags</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('metaTags')}}">Meta tags</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- Content -->
<div class="content mb-5">
    <div class="block block-rounded block-bordered">
        <div class="block-header block-header-default">
            <h3 class="block-title">Edit Meta tags</h3>
        </div>
        <div class="block-content mb-5">
            <form action="{{route('update_metaTag')}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}

                <div class="row justify-content-center">
                    <div class="col-lg-8 col-xl-8">
                        <input type="hidden" name="oldId" value="{{$oldid}}">
                        <div class="form-group">
                            <label for="example-select">Page Name<span class="req-fed">*</span></label>
                            <input type="text" class="form-control" name="page" placeholder="Enter Text."
                                value="{{$metatags[0]->page}}" disabled>
                        </div>

                        <div class="block block-rounded block-bordered">
                            <ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs" role="tablist">
                                @foreach ($language as $item)
                                @if($loop->iteration == 1)
                                <li class="nav-item">
                                    <a class="nav-link active" href="#btabs-alt-static-{{$item->name}}"
                                        style="text-transform: capitalize;">{{$item->name}}</a>
                                </li>
                                @else
                                <li class="nav-item">
                                    <a class="nav-link " href="#btabs-alt-static-{{$item->name}}"
                                        style="text-transform: capitalize;">{{$item->name}}</a>
                                </li>
                                @endif
                                @endforeach
                            </ul>
                            <div class="block-content tab-content">

                                @foreach ($language as $item)
                                <?php 
                                $current = null;
                                foreach($metatags as $item2) { 
                                    if ($item->name == $item2->local) {
                                        $current = $item2;
                                        break;
                                    }
                                }
                              ?>
                                <input type="hidden" name="lang_loop[]" value="{{$item->name}}">

                                <div class="tab-pane {{$loop->iteration == 1 ?'active':''}}"
                                    id="btabs-alt-static-{{$item->name}}" role="tabpanel">

                                    <div class="form-group">
                                        <label for="">H1</label>
                                        <span>Recommended 20-70 characters</span>
                                        <div id="item-wrap">
                                            <input id="input-h1-{{$item->name}}"
                                                onkeyup="countCharacter('h1-{{$item->name}}')" type="text"
                                                class="form-control" name="h1_title[{{$item->name}}]" maxlength="70"
                                                value="{{isset($current->h1)?$current->h1 :''}}">
                                            <div class="text-count">Count Character :
                                                <span id="count-h1-{{$item->name}}">
                                                    {{strlen($current->h1)}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Meta - Title </label>
                                        <span>Recommended 30-60 Character</span>
                                        <div id="item-wrap">
                                            <input id="input-metaTitle-{{$item->name}}"
                                                onkeyup="countCharacter('metaTitle-{{$item->name}}')"
                                                type="meta_title[{{$item->name}}]" class="form-control"
                                                name="meta_title[{{$item->name}}]"
                                                value="{{isset($current->title) ? $current->title :''}}">
                                            <div class="text-count">Count Character :
                                                <span id="count-metaTitle-{{$item->name}}">
                                                    {{strlen($current->meta_title)}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Meta - Description</label>
                                        <span>Recommended 70-155 Character</span>
                                        <div id="item-wrap">
                                            <textarea rows="4" id="input-metaDescription-{{$item->name}}"
                                                onkeyup="countCharacter('metaDescription-{{$item->name}}')"
                                                name="metaDescription[{{$item->name}}]"
                                                class="form-control">{{isset($current->description)?$current->description :''}}</textarea>
                                            <div class="text-count">Count Character :
                                                <span id="count-metaDescription-{{$item->name}}">
                                                    0</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @endforeach
                            </div>
                        </div>


                        {{-- <div class="form-group">
                            <label for="">Meta - Title</label>
                            <div id="item-wrap">
                                <input id="input-metaTitle-en" onkeyup="countCharacter('metaTitle-en')" type="text"
                                    class="form-control" name="metaTitle" value="{{$metatags[0]->meta_title}}">

                                <div class="text-count">Count Character :
                                    <span id="count-metaTitle-en"> {{strlen($metatags[0]->meta_title)}}</span>
                                </div>
                            </div>


                        </div>
                        <div class="form-group">
                            <label for="">Meta - Description</label>
                            <div id="item-wrap">
                                <textarea id="input-metaDescription-en" onkeyup="countCharacter('metaDescription-en')"
                                    name="metaDescription"
                                    class="form-control">{{$metatags[0]->meta_description}}</textarea>
                                <div class="text-count">Count Character :
                                    <span id="count-metaDescription-en">
                                        {{strlen($metatags[0]->meta_description)}}</span>
                                </div>
                            </div>
                        </div> --}}

                        <div class="form-group text-center">
                            <button class="btn btn-primary" type="submit">Update
                            </button>
                            <a href="{{route('metaTags')}}" class="btn btn-secondary">
                                Cancel
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('js')
<script type="text/javascript">
    function countCharacter(id){
           var str = $('#input-'+id).val();
          $('#count-'+id).text(str.length);
      }
</script>
@endsection