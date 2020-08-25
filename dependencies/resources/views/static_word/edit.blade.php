@extends('layouts.admin')
@section('style')

@endsection
@section('content')
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Edit Static Word</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <a href="{{route('static_word')}}">Static Words</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- Content -->
<div class="content">
    <div class="block block-rounded block-bordered">
        <div class="block-header block-header-default">
            <h3 class="block-title">Information</h3>
        </div>
        <div class="block-content">
            <form action="{{route('update_staticword')}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                        <label for="example-select">Key_word</label>
                        {{$static_word[0]->key_word}}
                        <input type="hidden" class="form-control" name="key_word" value="{{$static_word[0]->key_word}}" placeholder="Enter text..."  >
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
                        foreach($static_word as $item2) { 
                            if ($item->name == $item2->local) {
                                $current = $item2;
                                break;
                            }
                        }
                      ?>
                           <input type="hidden" name="lang_loop[]" value="{{$item->name}}">
                             
                           <div class="tab-pane {{($loop->iteration == 1)?"active":""}}" id="btabs-alt-static-{{$item->name}}" role="tabpanel">
                        <div class="form-group">
                            <label for="example-text-input"><span class="req-fed">*</span>Word</label>
                            <input type="text" class="form-control" name="word[{{$item->name}}]" value="{{isset($current->word) ? $current->word :''}}" placeholder="Enter text..." required>
                        </div>
                           </div>
                        @endforeach
                        </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="text-center form-group mt-4">
                            <button class="btn btn-info" type="submit">Update </button>
                            <a href="{{route('static_word')}}" class="btn btn-secondary">
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

@endsection
