<div class="tab-pane active" id="btabs-alt-static-{{$item->local}}" role="tabpanel">
    <div class="col-lg-12 col-xl-12">
        <div class="form-group">
            <label for="example-select">Title</label>
            <input type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" name="title"
                value="{{$item->field_name}}">
        </div>
        <div class="form-group">
            <label for="">Section</label>
            <select name="section" id="" class="form-control">
                @foreach ($section as $sec)
                @if($pd_field[0]->section_id == $sec->section_id)
                <option value="{{$sec->id}}" selected>{{$sec->name}}</option>
                @else
                <option value="{{$sec->id}}">{{$sec->name}}</option>
                @endif
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label class="d-block">Type</label>
            @if($item->type == "text")
            <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                <input type="radio" class="custom-control-input" id="status-line-1" name="type" value="text" checked>
                <label class="custom-control-label" for="status-line-1">Text</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                <input type="radio" class="custom-control-input" id="status-line-2" name="type" value="number">
                <label class="custom-control-label" for="status-line-2">Number</label>
            </div>
            @elseif($item->type == "number")
            <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                <input type="radio" class="custom-control-input" id="status-line-1" name="type" value="text">
                <label class="custom-control-label" for="status-line-1">Text</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                <input type="radio" class="custom-control-input" id="status-line-2" name="type" value="number" checked>
                <label class="custom-control-label" for="status-line-2">Number</label>
            </div>
            @endif
        </div>
        <div class="form-group">
            <label for="example-select">Unit</label>
            <input type="text" class="form-control {{ $errors->has('unit') ? 'is-invalid' : '' }}" name="unit">
        </div>
        <hr>
        <div class="form-group pb-5">
            <button class="btn btn-success col-md-2" type="submit">Create <i class="fa fa-plus"></i>
            </button>
            <a href="{{route('product-field.index')}}" class="btn btn-secondary col-md-2">Cancel <i
                    class="fa fa-times"></i></a>
        </div>
    </div>

</div>
