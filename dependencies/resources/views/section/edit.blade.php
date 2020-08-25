@extends('layouts.admin')
@section('style')

@endsection
@section('content')
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Edit Section</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <a href="{{route('section.index')}}" >All Section</a></li>
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
            <h3 class="block-title">Section Information</h3>
        </div>
        <div class="block-content">
            <form action="{{route('sectionUpdate')}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <!-- Basic Elements -->
                <input type="hidden" name="section_id" value="{{$section[0]->section_id}}">
                <div class="row justify-content-center ">
                    <div class="block block-rounded block-bordered col-md-8">
                        <ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs" role="tablist">
                            @foreach ($languages as $item)
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
                            @foreach ($languages as $item)
                            <?php 
                            $current = null;
                            foreach($section as $item2) { 
                                if ($item->name == $item2->local) {
                                    $current = $item2;
                                    break;
                                }
                            }
                          ?>
                        <input type="hidden" name="section_loop[]" value="{{$item->name}}" >
                         <div class="tab-pane {{($loop->iteration == 1)?'active':''}}" id="btabs-alt-static-{{$item->name}}" role="tabpanel">
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="text" class="form-control" name="name[{{$item->name}}]"
                                        value="{{isset($current->name) ? $current->name :''}}">
                                </div>
                                <div class="form-group">
                                    <label for="">Sort Name</label>
                                    <input type="text" class="form-control" name="sortname[{{$item->name}}]"
                                        value="{{isset($current->sortname) ? $current->sortname :''}}">
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="block-content tab-content">
                            <button type="submit" class="btn btn-success text-uppercase mb-4">Update 
                            </button>
                            <a href="{{route('section.index')}}"
                                class="btn btn-secondary text-uppercase mb-4">Cancel
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
