@extends('layouts.front-end')
@section('css')
<style>
    .text-editor img { max-width: 100%; }
    .text-editor b { font-weight: bold; }

    /* 地區頁籤：外層用 .box-news 套用 News 頁完全相同的 nav-tabs 樣式（字色 #888、active 藍底線、線色 #dcdcdc） */
    #fd-region-tabs .nav-link { margin: -2px 20px; }
    .fd-region-tab { cursor: pointer; }

    /* 篩選列：灰底圓角框（比照 slide 7 mockup） */
    .fd-filters { padding: 24px; background: #f0f0f0; border-radius: 6px; }
    /* 下拉：白底外框 + 上方標籤（比照 mockup「Please Select」），兩欄並排 */
    /* 下拉列與下方三欄共用同一組 fd-col-* 寬度(2:2:1)＋padding，確保上下完全對齊 */
    .fd-dropdowns-row { display: flex; margin-bottom: 20px; }
    .fd-dd { padding: 0 24px; min-width: 0; }
    .fd-dd:first-child { padding-left: 0; }
    .fd-dd-label { font-weight: 700; font-size: 14px; color: #000; margin-bottom: 8px; }
    .fd-select {
        width: 100%; height: 40px; padding: 0 34px 0 10px;
        border: 1px solid #ccc; border-radius: 4px; color: #333; cursor: pointer;
        font-size: 14px;
        /* 自訂箭頭：原生箭頭貼右邊無法留間距，改 appearance:none + SVG，箭頭離右邊框 12px（slide 8） */
        -webkit-appearance: none; -moz-appearance: none; appearance: none;
        background: #fff url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath fill='none' stroke='%23333333' stroke-width='1.6' d='M1 1.5 6 6.5 11 1.5'/%3E%3C/svg%3E") no-repeat right 12px center;
        background-size: 12px;
    }
    .fd-select:focus { outline: none; border-color: #0087DC; }
    .fd-section-title { font-weight: 700; font-size: 14px; color: #000; margin: 0 0 12px; }
    /* 三欄並排（Specialized Applications｜Product Lines｜Services），欄間灰色分隔線（比照 mockup） */
    .fd-filter-columns { display: flex; }
    .fd-filter-col { padding: 0 24px; }
    .fd-filter-col:first-child { padding-left: 0; }
    .fd-filter-col + .fd-filter-col { border-left: 1px solid #d5d5d5; }
    .fd-col-apps { flex: 2; }
    .fd-col-lines { flex: 2; }
    .fd-col-services { flex: 1; }
    .fd-filter-group { display: grid; gap: 12px 16px; }
    .fd-group-apps { grid-template-columns: repeat(2, minmax(0, 1fr)); }
    .fd-group-lines { grid-template-columns: repeat(2, minmax(0, 1fr)); }
    .fd-group-services { grid-template-columns: 1fr; }
    @media (max-width: 767px) {
        .fd-dropdowns-row { flex-direction: column; }
        .fd-dd { padding: 0 0 14px; }
        .fd-dd-empty { display: none; }
        .fd-filter-columns { flex-direction: column; }
        .fd-filter-col { padding: 16px 0 0; }
        .fd-filter-col:first-child { padding-top: 0; }
        .fd-filter-col + .fd-filter-col { border-left: none; border-top: 1px solid #d5d5d5; }
        .fd-filter-group { grid-template-columns: repeat(2, minmax(0, 1fr)); }
    }
    /* align-items:flex-start 讓多行項目的 checkbox 對齊第一行（非垂直置中）；input margin-top 微調對齊第一行文字 */
    .fd-check { display: flex; align-items: flex-start; gap: 4px; font-size: 14px; font-weight: 400; color: #333; cursor: pointer; }
    .fd-check input { margin-right: 6px; margin-top: 3px; flex-shrink: 0; }

    /* 結果卡：一列一家、三欄（資訊 / 徽章 / 產品線），比照 Slide5 */
    .fd-results { margin-top: 24px; }
    .fd-card { display: flex; align-items: center; gap: 28px; border: 1px solid #dcdcdc; border-radius: 6px; padding: 22px 26px; margin-bottom: 20px; }
    /* 卡片左右 1:2（左=資訊+按鈕、右=Expertise/Product Lines/Services 三區塊），比照 mockup */
    .fd-card-info { flex: 1; min-width: 0; }
    .fd-card-detail { flex: 2; min-width: 0; }
    .fd-card-section { margin-bottom: 16px; }
    .fd-card-section:last-child { margin-bottom: 0; }
    .fd-card-sec-title { font-weight: 700; font-size: 16px; color: #000; margin-bottom: 8px; }
    .fd-card-grid { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 8px 16px; }
    .fd-card-chk { font-size: 14px; color: #333; display: flex; align-items: flex-start; }
    .fd-card-chk .chk { margin-right: 6px; font-weight: bold; flex-shrink: 0; }
    .chk-blue { color: #0087DC; }
    .chk-green { color: #2e7d32; }
    .fd-svc-icon { width: 18px; height: 18px; margin-right: 6px; flex-shrink: 0; }
    @media (max-width: 767px) {
        .fd-card { flex-direction: column; gap: 14px; }
        .fd-card-info, .fd-card-detail { flex: auto; }
        .fd-card-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
    }
    .fd-logo { max-height: 96px; max-width: 300px; display: block; margin-bottom: 12px; }
    .fd-name { font-size: 18px; font-weight: 700; color: #000; margin-bottom: 8px; }
    .fd-address { font-size: 16px; color: #333; line-height: 1.6; }
    .fd-address a { color: #0087DC; word-break: break-word; }
    /* 卡片按鈕：grid 等分使每顆同寬。≥1200 與 <768 一排 3 個；768–1199 左欄較窄改一排 2 個（第 3 個落到第二行）。
       minmax(0,1fr) 與 button 的 min-width:0 蓋掉全域 .btn-subscribe 的 min-width，避免按鈕撐爆格子；white-space:normal 讓長字(德文等)換行不裁。 */
    .fd-card-btns { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 8px; margin-top: 16px; }
    .fd-card-btns a { min-width: 0; display: flex; }
    .fd-card-btns button {
        width: 100%; min-width: 0; min-height: 44px; padding: 4px 6px; border-radius: 5px;
        background: #0087DC; color: #fff; border: 2px solid transparent;
        font-size: 14px; font-weight: normal; cursor: pointer; white-space: normal; line-height: 1.15; text-align: center;
        display: inline-flex; align-items: center; justify-content: center;
    }
    .fd-card-btns button:hover { background: #1E50C8; }
    @media (min-width: 768px) and (max-width: 1199px) {
        .fd-card-btns { grid-template-columns: repeat(2, minmax(0, 1fr)); }
    }
    .fd-empty { text-align: center; color: #646464; padding: 40px 0; }
    /* 手機字級（放最後，確保蓋過上方 .fd-name / .fd-address 基準值）：公司名 16、區塊標題＋地址 14、勾選項 12 */
    @media (max-width: 767px) {
        .fd-name { font-size: 16px; }
        .fd-card-sec-title, .fd-address { font-size: 14px; }
        .fd-card-chk { font-size: 12px; }
    }
</style>
@endsection
@section('meta')
<title>{{isset($metatag[0]->title)? $metatag[0]->title :''}}</title>
<meta name="description" content="{{isset($metatag[0]->description)? $metatag[0]->description :''}}">
<link rel="canonical" href="{{url()->current()}}" />
@endsection
@section('container')
<div class="padding-top-content"></div>
<div class="products-index-nav visible-up-922">
    <div class="bg-bredcrumb">
        <div class="container">
            <nav aria-label="breadcrumb" id="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item text-breadcrumb-home"><a
                            href="{{route('index','home')}}">{{$staticContent['Home']}}</a></li>
                    <li class="breadcrumb-item active text-breadcrumb-home dropdown" aria-current="page"><a href="#"
                            data-toggle="dropdown" id="tools-dropdown">{{$staticContent['Where_to_Buy']}}</a>
                        <ul class="dropdown-menu">
                            <li><a href="#" id="tools-dropdown" class="text-bold">{{$staticContent['Where_to_Buy']}}</a></li>
                            <hr>
                            <li><a href="{{route('contactSupport')}}">{{$staticContent['contact_us']}}</a></li>
                            <li><a href="{{route('contactFindDistributor')}}">{{$staticContent['find_a_distributor']}}</a></li>
                            <li><a href="{{route('contactSalesOffices')}}">{{$staticContent['sales_offices']}}</a></li>
                        </ul>
                    </li>
                    <li class="breadcrumb-item active text-breadcrumb" aria-current="page"><a
                            href="#">{{$staticContent['find_a_distributor']}}</a></li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="padding-top-content-breadcrumb visible-up-922"></div>
<div class="box-find-distributor pb-5">
    <div class="container">
        <h2 class="text-title-delta visible-tablets-up">{{$staticContent['find_a_distributor']}}</h2>
        <h3 class="text-title-delta visible-mobile">{{$staticContent['find_a_distributor']}}</h3>
        <h4 class="d-flex justify-content-center mb-4 text-center" style="margin-top: -1rem">{{isset($metatag[0]->h1)? $metatag[0]->h1 :''}}</h4>

        <div id="find-distributor-app" class="box-news">
            {{-- 地區頁籤（樣式同 News 頁，JS 切換不換頁） --}}
            <div class="nav nav-tabs d-flex justify-content-center border-b-2px mb-5" id="fd-region-tabs" role="tablist">
                @foreach($continents as $i => $item)
                <a class="nav-item nav-link font-size-tab fd-region-tab {{ $i == 0 ? 'active' : '' }}" href="#" data-continent="{{$item->id}}">{{$item->name}}</a>
                @endforeach
            </div>

            {{-- 篩選列 --}}
            @php
                $filterGroups = [
                    ['key' => 'apps', 'label' => $staticContent['Specialized_Applications'] ?? 'Specialized Applications', 'items' => $catLists['distributor_specialized_application']],
                    ['key' => 'lines', 'label' => $staticContent['Product_Lines'] ?? 'Product Lines', 'items' => $catLists['distributor_product_line']],
                    ['key' => 'services', 'label' => $staticContent['Services'] ?? 'Services', 'items' => $catLists['distributor_service']],
                ];
            @endphp
            <div class="fd-filters mb-4">
                <div class="fd-dropdowns-row">
                    <div class="fd-dd fd-col-apps">
                        <div class="fd-dd-label">{{ $staticContent['Sales_Territory'] ?? 'Sales Territory' }}</div>
                        <select class="fd-select fd-filter-territory">
                            <option value="">{{ $staticContent['Please_Select'] ?? 'Please Select' }}</option>
                        </select>
                    </div>
                    <div class="fd-dd fd-col-lines">
                        @if(count($certList) > 0)
                        <div class="fd-dd-label">{{ $staticContent['Expertise'] ?? 'Expertise' }}</div>
                        <select class="fd-select fd-filter-certification fd-cert-wrap">
                            <option value="">{{ $staticContent['Please_Select'] ?? 'Please Select' }}</option>
                            @foreach($certList as $certName)
                            <option value="{{ $certName }}">{{ $certName }}</option>
                            @endforeach
                        </select>
                        @endif
                    </div>
                    <div class="fd-dd fd-dd-empty fd-col-services"></div>
                </div>
                <div class="fd-filter-columns">
                    @foreach($filterGroups as $g)
                    <div class="fd-filter-col fd-col-{{ $g['key'] }}">
                        <div class="fd-section-title">{{ $g['label'] }}</div>
                        <div class="fd-filter-group fd-group-{{ $g['key'] }}">
                            @foreach($g['items'] as $c)
                            <label class="fd-check"><input type="checkbox" class="fd-filter-cb" data-group="{{$g['key']}}" value="{{$c->slug}}"> {{$c->name}}</label>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- 結果卡 --}}
            <div class="fd-results">
                @foreach($offices as $office)
                <div class="fd-card"
                     data-continent="{{$office->continent_id}}"
                     data-apps="{{ implode(',', $office->apps) }}"
                     data-lines="{{ implode(',', $office->lines) }}"
                     data-services="{{ implode(',', $office->services) }}"
                     data-territories="{{ implode('|', $office->territories) }}"
                     data-certs="{{ implode('|', $office->certs) }}">
                    <div class="fd-card-info">
                        @if($office->logo)
                        <img class="fd-logo" src="{{config('app.url')}}/medias/distributor/{{$office->logo}}" alt="{{$office->title}}">
                        @endif
                        <div class="fd-name">{{$office->title}}</div>
                        <div class="fd-address text-editor">{!! $office->content !!}</div>
                        <div class="fd-card-btns">
                            <a href="https://www.google.com/maps/?q={{$office->lat}},{{$office->lon}}&sensor=true" target="_blank">
                                <button class="btn-subscribe">{{ $staticContent['GetDirection'] ?? 'Get Direction' }}</button>
                            </a>
                            @if($office->status_cer == 1)
                            <a href="{{config('app.url')}}/medias/distributor/{{$office->file_cer}}" target="_blank">
                                <button class="btn-certi">{{ $staticContent['Certificate'] ?? 'Certificate' }}</button>
                            </a>
                            @endif
                            @if($office->local == 'tw' && $office->id == 47)
                            {{-- 羅昇企業：電商網站按鈕（特定 office，比照原版保留；放最後一個） --}}
                            <a href="https://www.acepillar-ec.com/collections/delta" target="_blank">
                                <button class="btn-subscribe">電商網站</button>
                            </a>
                            @endif
                        </div>
                    </div>
                    <div class="fd-card-detail">
                        @if(count($certList) > 0)
                        <div class="fd-card-section">
                            <div class="fd-card-sec-title">{{ $staticContent['Expertise'] ?? 'Expertise' }}</div>
                            <div class="fd-card-grid">
                                @foreach($office->certs as $cert)
                                <div class="fd-card-chk"><span class="chk chk-blue">&#10003;</span>{{ $cert }}</div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                        <div class="fd-card-section">
                            <div class="fd-card-sec-title">{{ $staticContent['Product_Lines'] ?? 'Product Lines' }}</div>
                            <div class="fd-card-grid">
                                @foreach($catLists['distributor_product_line'] as $c)@if(in_array($c->slug, $office->lines))
                                <div class="fd-card-chk"><span class="chk chk-green">&#10003;</span>{{ $c->name }}</div>
                                @endif @endforeach
                            </div>
                        </div>
                        <div class="fd-card-section">
                            <div class="fd-card-sec-title">{{ $staticContent['Services_Offered'] ?? 'Services Offered' }}</div>
                            <div class="fd-card-grid">
                                @foreach($catLists['distributor_service'] as $c)@if(in_array($c->slug, $office->services))
                                <div class="fd-card-chk fd-svc"><img class="fd-svc-icon" src="{{asset('frontend-asset/image/distributor-service/'.$c->slug.'.svg')}}" onerror="this.remove()">{{ $c->name }}</div>
                                @endif @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="fd-empty">{{ $staticContent['No_Results'] ?? 'No matching distributors' }}</div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
$(function () {
    var $cards = $('.fd-card');
    var activeContinent = $('#fd-region-tabs .fd-region-tab.active').data('continent');

    function checkedVals(group) {
        return $('.fd-filter-cb[data-group="' + group + '"]:checked').map(function () { return $(this).val(); }).get();
    }
    // 類內 OR：未勾任何 → 不限制；有勾 → 卡片含任一即通過
    function groupMatch(card, group) {
        var vals = checkedVals(group);
        if (vals.length === 0) return true;
        var have = ($(card).attr('data-' + group) || '').split(',');
        return vals.some(function (v) { return have.indexOf(v) !== -1; });
    }

    var territoryByContinent = @json($territoryByContinent);

    function fillSelect($sel, items, keep) {
        var map = {};
        (items || []).forEach(function (x) { x = ('' + x).trim(); if (x) map[x.toLowerCase()] = x; });
        $sel.find('option:not(:first)').remove();
        var keys = Object.keys(map).sort();
        keys.forEach(function (k) { $sel.append($('<option>').val(map[k]).text(map[k])); });
        $sel.val(keep && map[keep.toLowerCase()] ? keep : '');
        return keys.length;
    }

    // Certifications：選項由後端 $certList（認證分類表）直接 render，整頁固定，不隨地區變動。

    // Sales Territory：依目前地區過濾；該地區沒有設定就隱藏整個下拉。
    function rebuildDropdowns() {
        var n = fillSelect($('.fd-filter-territory'), territoryByContinent[activeContinent] || [], $('.fd-filter-territory').val());
        $('.fd-filter-territory').toggle(n > 0);
    }

    // 類間 AND
    function applyFilter() {
        var terr = ('' + ($('.fd-filter-territory').val() || '')).toLowerCase();
        var cert = ('' + ($('.fd-filter-certification').val() || '')).toLowerCase();
        var shown = 0;
        $cards.each(function () {
            var $c = $(this);
            var ok = ('' + $c.attr('data-continent')) === ('' + activeContinent);
            if (ok && terr) ok = ('' + ($c.attr('data-territories') || '')).toLowerCase().split('|').indexOf(terr) !== -1;
            if (ok && cert) ok = ('' + ($c.attr('data-certs') || '')).toLowerCase().split('|').indexOf(cert) !== -1;
            if (ok) ok = groupMatch(this, 'apps');
            if (ok) ok = groupMatch(this, 'lines');
            if (ok) ok = groupMatch(this, 'services');
            $c.toggle(ok);
            if (ok) shown++;
        });
        $('.fd-empty').toggle(shown === 0);
    }

    $('#fd-region-tabs').on('click', '.fd-region-tab', function (e) {
        e.preventDefault();
        $('.fd-region-tab').removeClass('active');
        $(this).addClass('active');
        activeContinent = $(this).data('continent');
        rebuildDropdowns();
        applyFilter();
    });
    $('.fd-filter-territory, .fd-filter-certification').on('change', applyFilter);
    $('.fd-filter-cb').on('change', applyFilter);

    rebuildDropdowns();
    applyFilter();
});
</script>
@endsection
