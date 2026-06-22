@extends('layouts.admin')
@section('style')

@endsection
@section('content')
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Edit </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page"><a href="{{route('getContinent' ,$type_id)}}">Continents</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="{{route('getOffices',['contentId'=>$conid , 'type_id'=>$type_id])}}">
                            @if($type_id == 1)
                            Sales Offices
                            @else
                            Distributors
                            @endif
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>


            </nav>
        </div>
    </div>
</div>
<!-- Content -->
<div class="content">

    @if(Session::has('flash_message'))
    <div class="alert alert-success" role="alert">
        <button class="close" data-dismiss="alert"></button>
        {!! Session('flash_message') !!}
    </div>
    @endif
    @if(Session::has('error_message'))
    <div class="alert alert-danger" role="alert">
        <button class="close" data-dismiss="alert"></button>
        {!! Session('error_message') !!}
    </div>
    @endif
    <div class="block block-rounded block-bordered">
        <div class="block-header block-header-default">
            <h3 class="block-title">Information</h3>
        </div>
        <div class="block-content">
            <form action="{{route('updateOffices')}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <input type="hidden" class="form-control" name="f_id" value="{{$offices[0]->id}}">
                <input type="hidden" class="form-control" name="type_id" value="{{$type_id}}">
               <input type="hidden" class="form-control" name="con_id" value="{{$conid}}">
                <!-- Basic Elements -->
                <div class="row">
                    <div class="col-lg-12">

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
                                    foreach($offices as $item2) {
                                        if ($item->name == $item2->local) {
                                            $current = $item2;
                                            break;
                                        }
                                    }
                               ?>
                                    <input type="hidden" name="lang_loop[]" value="{{$item->name}}">
                                    <div class="tab-pane {{($loop->iteration == 1)?"active":""}}" id="btabs-alt-static-{{$item->name}}" role="tabpanel">

                                            <div class="form-group">
                                                    <label for="example-select">Title </label>
                                                    <input type="text" class="form-control" name="title[{{$item->name}}]" value="{{isset($current->title)? $current->title:""}}" placeholder="Enter Text" >
                                                </div>
                                                <div class="form-group">
                                                        <label for="example-select">Sub Title</label>
                                                        <input type="text" class="form-control " name="sub_title[{{$item->name}}]" value="{{isset($current->sub_title)? $current->sub_title:""}}" placeholder="Enter Text" >
                                                </div>
                                                @if($type_id != 2)
                                                <div class="form-group">
                                                        <label for="example-select">Content</label>
                                                        <textarea name="content[{{$item->name}}]"class="jsnotenew">{{isset($current->content)? $current->content:""}}</textarea>
                                                </div>
                                                @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @if($type_id == 2)
                            {{-- 經銷商基本資訊 --}}
                            @if(isset($offices[0]->logo) && $offices[0]->logo)
                            <div class="form-group">
                                <label class="d-block">Current Logo</label>
                                <img src="{{config('app.url')}}/medias/distributor/{{$offices[0]->logo}}" style="max-height:60px;">
                                <input type="hidden" name="oldLogo" value="{{$offices[0]->logo}}">
                            </div>
                            @endif
                            <div class="form-group">
                                <label>Logo</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="logo" id="logo_input" accept="image/*" data-toggle="custom-file-input">
                                    <label class="custom-file-label" for="logo_input">Choose logo image</label>
                                </div>
                                @php $logoUnit = strtoupper(substr(ini_get('upload_max_filesize'), -1)); $logoMaxBytes = (int) ini_get('upload_max_filesize') * (['K'=>1024,'M'=>1048576,'G'=>1073741824][$logoUnit] ?? 1); @endphp
                                <small class="text-muted">圖檔可日後再上傳；未上傳時前台以名稱呈現。上限約 {{ floor($logoMaxBytes/1048576) }} MB。</small>
                                {{-- 選檔後即時縮圖預覽 + 超過上限即時提醒（門檻 = 伺服器 upload_max_filesize），存檔成功會在上方 Current Logo 顯示 --}}
                                <div class="mt-2"><img id="logo_preview" src="" alt="" style="max-height:60px;display:none;border:1px solid #e3e3e3;border-radius:4px;"></div>
                            </div>
                            <script>
                                (function () {
                                    var inp = document.getElementById('logo_input'), prev = document.getElementById('logo_preview'), max = {{ $logoMaxBytes }};
                                    if (!inp || !prev) { return; }
                                    inp.addEventListener('change', function () {
                                        var f = this.files && this.files[0];
                                        if (!f) { prev.style.display = 'none'; return; }
                                        if (max && f.size > max) {
                                            alert('Logo 檔案過大（' + (f.size / 1048576).toFixed(1) + ' MB），上限約 ' + Math.floor(max / 1048576) + ' MB。請壓縮或換較小的圖，否則不會上傳成功。');
                                            this.value = '';
                                            $('.custom-file-label[for="logo_input"]').text('Choose logo image');
                                            prev.style.display = 'none';
                                            return;
                                        }
                                        var r = new FileReader();
                                        r.onload = function (e) { prev.src = e.target.result; prev.style.display = 'inline-block'; };
                                        r.readAsDataURL(f);
                                    });
                                })();
                            </script>
                            <div class="form-group"><label>Address</label><textarea class="form-control" name="address" rows="3">{{$offices[0]->address ?? ''}}</textarea></div>
                            <div class="form-group"><label>Telephone</label><input type="text" class="form-control" name="telephone" value="{{$offices[0]->telephone ?? ''}}"></div>
                            <div class="form-group"><label>Email</label><input type="text" class="form-control" name="email" value="{{$offices[0]->email ?? ''}}"></div>
                            <div class="form-group"><label>Website</label><input type="text" class="form-control" name="website" value="{{$offices[0]->website ?? ''}}" placeholder="https://..."></div>
                            <div class="form-group"><label>Google Maps URL</label><input type="text" class="form-control" name="google_maps" value="{{$offices[0]->google_maps ?? ''}}"></div>

                            {{-- 五類分類勾選（含 Sales Territory / Certification） --}}
                            @php
                                $catGroups = [
                                    ['field' => 'distributor_sales_territory', 'label' => 'Sales Territory', 'items' => $categories['distributor_sales_territory'], 'sel' => 'distributor_sales_territory'],
                                    ['field' => 'distributor_expertise', 'label' => 'Expertise', 'items' => $categories['distributor_expertise'], 'sel' => 'distributor_expertise'],
                                    ['field' => 'distributor_specialized_application', 'label' => 'Specialized Application', 'items' => $categories['distributor_specialized_application'], 'sel' => 'distributor_specialized_application'],
                                    ['field' => 'distributor_product_line', 'label' => 'Product Line', 'items' => $categories['distributor_product_line'], 'sel' => 'distributor_product_line'],
                                    ['field' => 'distributor_service', 'label' => 'Service', 'items' => $categories['distributor_service'], 'sel' => 'distributor_service'],
                                ];
                            @endphp
                            @foreach($catGroups as $g)
                            <div class="form-group">
                                <label class="d-block">{{ $g['label'] }}</label>
                                @foreach($g['items'] as $c)
                                <div class="custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="{{$g['field']}}_{{$c->id}}" name="{{$g['field']}}[]" value="{{$c->id}}" {{ isset($selected) && in_array($c->id, $selected[$g['sel']]) ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="{{$g['field']}}_{{$c->id}}">{{ $c->name }}</label>
                                </div>
                                @endforeach
                            </div>
                            @endforeach

                            @if(isset($offices[0]->file_cer))
                            <div class="form-group">
                                <label for="example-select"> Old File</label>
                                <a href="{{config('app.url')}}/medias/distributor/{{isset($offices[0]->file_cer) ? $offices[0]->file_cer :''}}">{{isset($offices[0]->file_cer) ? $offices[0]->file_cer :''}}</a>


                                <a href="{{route('removefileCerDis',[$offices[0]->id])}}"  class="btn btn btn-danger"><i class="fa fa-trash"></i> </a>

                                <input type="hidden" name="oldfileCer" value="{{$offices[0]->file_cer}}">
                            </div>
                            @endif
                            <div class="form-group">
                                <label for="example-select">File Certificate</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="filecer" data-toggle="custom-file-input" id="file_input" >
                                    <label class="custom-file-label" for="file_input">Choose file</label>

                                </div>
                           </div>
                           <div class="form-group">
                            <label class="d-block">Certificate Status</label>
                            <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                    <input type="radio" class="custom-control-input" id="status-cer1" name="status_cer" value="1" {{$offices[0]->status_cer == 1?'checked':''}}>
                                    <label class="custom-control-label" for="status-cer1">Show Certificate</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                    <input type="radio" class="custom-control-input" id="status-cer2" name="status_cer" value="0" {{$offices[0]->status_cer == 0?'checked':''}} >
                                    <label class="custom-control-label" for="status-cer2">Hide Certificate</label>
                                </div>
                        </div>
                          @endif

                        <div class="form-group">
                                <label class="d-block">Show</label>
                                <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                        <input type="radio" class="custom-control-input" id="status-1" name="status" value="1" {{$offices[0]->status == 1?'checked':''}}>
                                        <label class="custom-control-label" for="status-1">Show</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                        <input type="radio" class="custom-control-input" id="status-2" name="status" value="0"  {{$offices[0]->status== 0?'checked':''}}>
                                        <label class="custom-control-label" for="status-2">Hide</label>
                                    </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-10 col-md-offset-1">
                                    <label for="titleen" class="control-label">Location *</label>
                                    <input type="text" id="us2-address" class="form-control" />
                                    <div id="us2" style="width: 100%; height: 500px;"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="titleen" class="col-md-2 control-label">Latitude *</label>
                                <div class="col-md-6">
                                    <input type="text" id="us2-lat" name="lat" class="form-control" />
                                </div>
                            </div>

                            <div class="form-group">
                                    <label for="titleen" class="col-md-2 control-label">Longitude *</label>
                                    <div class="col-md-6">
                                        <input type="text" id="us2-lon" name="lon" class="form-control" />
                                    </div>
                            </div>
                        <div class="text-center mb-3">
                            <button class="btn btn-info col-md-1" type="submit" >Update  </button>
                            <a href="{{route('getOffices',['contentId'=>$conid , 'type_id'=>$type_id])}}"  class="btn btn-secondary col-md-1">
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
<script type="text/javascript" src='https://maps.google.com/maps/api/js?key=AIzaSyCPBj3pIdKpOMbIL4cChrzX_OJZSkaxIvM
&sensor=false&libraries=places'></script>
    <script src="https://cdn.jsdelivr.net/gh/Logicify/jquery-locationpicker-plugin@master/dist/locationpicker.jquery.min.js"></script>
<script>
    var lat = '{{$offices[0]->lat}}';
    var lon = '{{$offices[0]->lon}}';

    if(lat == '' && lon == '' ){
        lat = 0 ;
        lon = 0 ;
    }
    $('#us2').locationpicker({
        location:{
            latitude: lat,
            longitude: lon
        },
        enableAutocomplete: true,
        enableReverseGeocode: true,
        radius: 0,
        inputBinding: {
            latitudeInput: $('#us2-lat'),
            longitudeInput: $('#us2-lon'),
            radiusInput: $('#us2-radius'),
            locationNameInput: $('#us2-address')
        },
        onchanged: function (currentLocation, radius, isMarkerDropped) {
            var addressComponents = $(this).locationpicker('map').location.addressComponents;
            console.log(currentLocation);  //latlon
            updateControls(addressComponents); //Data
        }
    });

    function updateControls(addressComponents) {
        console.log(addressComponents);
    }

    // 貼上 Google Maps 完整網址 → 解析座標 → 連動地圖與 Latitude/Longitude。
    // 只支援「含座標的完整網址」（網址列那種，含 @緯,經 或 ll= / q= / !3d!4d）；
    // 分享短網址（maps.app.goo.gl / goo.gl）網址內沒有座標，無法在前端解析。
    function extractLatLngFromMapUrl(url) {
        if (!url) { return null; }
        var patterns = [
            /!3d(-?\d+(?:\.\d+)?)!4d(-?\d+(?:\.\d+)?)/,    // 地點實際座標（圖釘）：最精準，優先
            /[?&]q=(-?\d+(?:\.\d+)?),(-?\d+(?:\.\d+)?)/,   // ?q=lat,lng
            /[?&]ll=(-?\d+(?:\.\d+)?),(-?\d+(?:\.\d+)?)/,  // ?ll=lat,lng
            /@(-?\d+(?:\.\d+)?),(-?\d+(?:\.\d+)?)/,        // 地圖鏡頭中心：較不精準，後援
            /(-?\d{1,2}(?:\.\d+)?),\s*(-?\d{1,3}(?:\.\d+)?)/
        ];
        for (var i = 0; i < patterns.length; i++) {
            var m = url.match(patterns[i]);
            if (m) {
                var lat = parseFloat(m[1]), lng = parseFloat(m[2]);
                if (lat >= -90 && lat <= 90 && lng >= -180 && lng <= 180) {
                    return { latitude: lat, longitude: lng };
                }
            }
        }
        return null;
    }
    $('input[name="google_maps"]').on('change', function () {
        var val = (this.value || '').trim();
        if (val === '') { return; }
        var loc = extractLatLngFromMapUrl(val);
        if (loc) {
            $('#us2').locationpicker('location', loc);
            $('#us2-lat').val(loc.latitude);
            $('#us2-lon').val(loc.longitude);
        } else {
            alert('Could not parse coordinates from this Google Maps URL.\nPlease paste the full URL from the browser address bar (the one containing @lat,lng). Short share links (maps.app.goo.gl / goo.gl) do not contain coordinates and cannot be parsed.');
        }
    });
</script>
@endsection
