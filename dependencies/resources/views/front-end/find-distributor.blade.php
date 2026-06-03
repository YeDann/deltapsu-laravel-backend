@extends('layouts.front-end')
@section('css')
<style>
    .text-editor img { max-width: 100%; }
    .text-editor b { font-weight: bold; }

    /* 地區頁籤：外層用 .box-news 套用 News 頁完全相同的 nav-tabs 樣式（字色 #888、active 藍底線、線色 #dcdcdc） */
    #fd-region-tabs .nav-link { margin: -2px 20px; }
    .fd-region-tab { cursor: pointer; }

    /* 篩選列（白底、無外框，貼齊圖示樣式） */
    .fd-filters { padding: 8px 0 0; }
    .fd-inline-dropdowns { display: flex; flex-wrap: wrap; gap: 28px; margin-bottom: 10px; }
    .fd-mini-select {
        border: none; background: transparent; font-weight: 600; font-size: 14px;
        color: #000; cursor: pointer; padding: 0 4px 0 0; margin-left: -4px; width: 170px;
    }
    .fd-mini-select:focus { outline: none; }
    .fd-section-title { font-weight: 700; font-size: 14px; color: #000; margin: 16px 0 8px; }
    /* 每區塊固定欄數對齊（比照圖：應用 5 / 產品線 4 / 服務 3），短標籤不再卡 min-width 亂折 */
    .fd-filter-group { display: grid; gap: 8px 16px; margin-bottom: 8px; }
    .fd-filter-group.fd-group-apps { grid-template-columns: repeat(5, minmax(0, 1fr)); }
    .fd-filter-group.fd-group-lines { grid-template-columns: repeat(4, minmax(0, 1fr)); }
    .fd-filter-group.fd-group-services { grid-template-columns: repeat(3, minmax(0, 1fr)); }
    @media (max-width: 767px) { .fd-filter-group { grid-template-columns: repeat(2, minmax(0, 1fr)) !important; } }
    .fd-check { display: flex; align-items: center; gap: 4px; font-size: 14px; font-weight: 400; color: #333; cursor: pointer; }
    .fd-check input { margin-right: 6px; }

    /* 結果卡：一列一家、三欄（資訊 / 徽章 / 產品線），比照 Slide5 */
    .fd-results { margin-top: 24px; }
    .fd-card { display: flex; gap: 28px; border: 1px solid #dcdcdc; border-radius: 6px; padding: 22px 26px; margin-bottom: 20px; }
    .fd-card-info { flex: 0 0 40%; max-width: 40%; }
    .fd-card-badges { flex: 0 0 24%; display: flex; flex-direction: column; align-items: flex-start; gap: 6px; }
    .fd-card-lines { flex: 1; }
    @media (max-width: 767px) {
        .fd-card { flex-direction: column; gap: 14px; }
        .fd-card-info, .fd-card-badges { flex: auto; max-width: 100%; }
    }
    .fd-logo { max-height: 44px; max-width: 200px; display: block; margin-bottom: 12px; }
    .fd-name { font-size: 16px; font-weight: 700; color: #000; margin-bottom: 8px; }
    .fd-address { font-size: 14px; color: #333; line-height: 1.6; }
    .fd-address a { color: #0087DC; word-break: break-word; }
    .fd-tag { background: #0087DC; color: #fff; font-size: 12px; border-radius: 3px; padding: 4px 10px; }
    .fd-line-item { font-size: 14px; color: #333; margin-bottom: 8px; }
    .fd-line-item .chk { color: #2e7d32; margin-right: 8px; font-weight: bold; }
    .fd-empty { text-align: center; color: #646464; padding: 40px 0; }
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
                <div class="fd-inline-dropdowns">
                    <select class="fd-mini-select fd-filter-territory">
                        <option value="">{{ $staticContent['Sales_Territory'] ?? 'Sales Territory' }}</option>
                    </select>
                    <select class="fd-mini-select fd-filter-certification fd-cert-wrap">
                        <option value="">{{ $staticContent['Certifications'] ?? 'Certifications' }}</option>
                    </select>
                </div>
                @foreach($filterGroups as $g)
                <div class="fd-section-title">{{ $g['label'] }}</div>
                <div class="fd-filter-group fd-group-{{ $g['key'] }}">
                    @foreach($g['items'] as $c)
                    <label class="fd-check"><input type="checkbox" class="fd-filter-cb" data-group="{{$g['key']}}" value="{{$c->slug}}"> {{$c->name}}</label>
                    @endforeach
                    @if($g['key'] === 'lines')
                    <label class="fd-check"><input type="checkbox" class="fd-all" data-group="{{$g['key']}}"> {{ $staticContent['All'] ?? 'All' }}</label>
                    @endif
                </div>
                @endforeach
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
                    </div>
                    <div class="fd-card-badges">
                        @foreach($office->certs as $cert)<span class="fd-tag">{{ $cert }}</span>@endforeach
                    </div>
                    <div class="fd-card-lines">
                        @foreach($catLists['distributor_product_line'] as $c)@if(in_array($c->slug, $office->lines))<div class="fd-line-item"><span class="chk">&#10003;</span>{{$c->name}}</div>@endif @endforeach
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
        Object.keys(map).sort().forEach(function (k) { $sel.append($('<option>').val(map[k]).text(map[k])); });
        $sel.val(keep && map[keep.toLowerCase()] ? keep : '');
    }

    // 依目前地區重建下拉：Sales Territory 依管理端設定的地區；Certifications 由該區經銷商彙整
    function rebuildDropdowns() {
        fillSelect($('.fd-filter-territory'), territoryByContinent[activeContinent] || [], $('.fd-filter-territory').val());
        var certs = [];
        $cards.each(function () {
            if (('' + $(this).attr('data-continent')) !== ('' + activeContinent)) return;
            ('' + ($(this).attr('data-certs') || '')).split('|').forEach(function (x) { if (x.trim()) certs.push(x.trim()); });
        });
        fillSelect($('.fd-filter-certification'), certs, $('.fd-filter-certification').val());
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
    $('.fd-all').on('change', function () {
        var g = $(this).data('group');
        $('.fd-filter-cb[data-group="' + g + '"]').prop('checked', $(this).prop('checked'));
        applyFilter();
    });

    rebuildDropdowns();
    applyFilter();
});
</script>
@endsection
