@extends('layouts.admin')
@section('content')
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">{{ $typeLabel }}</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">{{ $typeLabel }}</li>
                    <li class="breadcrumb-item active" aria-current="page">Create</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="content">
    <div class="block block-rounded block-bordered">
        <div class="block-header block-header-default">
            <h3 class="block-title"><a href="{{route('distributorCategory.index', $type)}}" class="btn btn-info"><i class="fa fa-chevron-left"></i> {{ $typeLabel }}</a></h3>
        </div>
        <div class="block-content">
            <form action="{{route('distributorCategory.store', $type)}}" method="POST">
                {{csrf_field()}}
                <div class="row push">
                    <div class="col-lg-8 col-xl-5">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name" placeholder="Enter name...">
                            <small class="text-muted">先輸入英文名稱，建立後可在編輯頁補各語系翻譯。</small>
                        </div>
                        @if($type === 'sales_territory')
                        <div class="form-group">
                            <label>Region</label>
                            <select class="form-control" name="continent_id">
                                <option value="">— Select region —</option>
                                @foreach($continents as $cont)
                                <option value="{{$cont->id}}">{{$cont->name}}</option>
                                @endforeach
                            </select>
                            <small class="text-muted">此銷售區域會出現在前台對應的地區頁籤下。</small>
                        </div>
                        @endif
                        <div class="form-group">
                            <button class="btn btn-success" type="submit">Create</button>
                            <a href="{{route('distributorCategory.index', $type)}}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
