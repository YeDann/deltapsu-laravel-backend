@extends('layouts.admin')
@section('content')
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">{{ $typeLabel }}</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">{{ $typeLabel }}</li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
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
            <form action="{{route('distributorCategory.update')}}" method="POST">
                {{csrf_field()}}
                <input type="hidden" name="type" value="{{ $type }}">
                <input type="hidden" name="type_id" value="{{ $contents[0]->id }}">
                <div class="row push">
                    <div class="col-lg-8 col-xl-5">
                        <div class="block block-rounded block-bordered">
                            <ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs" role="tablist">
                                @foreach ($language as $item)
                                <input type="hidden" name="langloop[]" value="{{$item->name}}">
                                <li class="nav-item">
                                    <a class="nav-link {{ $loop->iteration == 1 ? 'active' : '' }}" href="#tab-{{$item->name}}" style="text-transform: capitalize;">{{$item->name}}</a>
                                </li>
                                @endforeach
                            </ul>
                            <div class="block-content tab-content">
                                @foreach ($language as $item)
                                @php
                                    $current = null;
                                    foreach($contents as $c) { if ($item->name == $c->local) { $current = $c; break; } }
                                @endphp
                                <div class="tab-pane {{ $loop->iteration == 1 ? 'active' : '' }}" id="tab-{{$item->name}}" role="tabpanel">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control" name="name[{{$item->name}}]" value="{{ isset($current->name) ? $current->name : '' }}">
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @if($type === 'sales_territory')
                        <div class="form-group">
                            <label>Region</label>
                            <select class="form-control" name="continent_id">
                                <option value="">— Select region —</option>
                                @foreach($continents as $cont)
                                <option value="{{$cont->id}}" {{ (isset($contents[0]->continent_id) && $contents[0]->continent_id == $cont->id) ? 'selected' : '' }}>{{$cont->name}}</option>
                                @endforeach
                            </select>
                            <small class="text-muted">此銷售區域會出現在前台對應的地區頁籤下。</small>
                        </div>
                        @endif
                        <div class="form-group">
                            <label>Order</label>
                            <input type="text" class="form-control" name="order_seq" value="{{ $contents[0]->order_seq }}" placeholder="Number">
                        </div>
                        <div class="form-group">
                            <label class="d-block">Status</label>
                            <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                <input type="radio" class="custom-control-input" id="status-1" name="status" value="1" {{ $contents[0]->status == 1 ? 'checked' : '' }}>
                                <label class="custom-control-label" for="status-1">Show</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                <input type="radio" class="custom-control-input" id="status-0" name="status" value="0" {{ $contents[0]->status == 0 ? 'checked' : '' }}>
                                <label class="custom-control-label" for="status-0">Hide</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success" type="submit">Update</button>
                            <a href="{{route('distributorCategory.index', $type)}}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
