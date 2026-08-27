@extends('layouts.front-end')
@section('css')
<style>
    .tab-content>.active {
        justify-content: unset !important;

        display: block;
    }

    .tab-content {
        margin-top: 24px;
    }

    .search-space {
        margin-bottom: 24px;
    }

    .nav-tabs .nav-link {
        margin: -2px 16px;
    }

    .box-search-input {
        width: 270px;
    }

    .box-search-input .searchinput-filters-input input {
        font-size: 16px;
    }

    .box-search-icon {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-search-border {
        font-size: 18px;
    }

    @media (max-width:375px) {
        .box-search-filter {
            width: 70%;
        }

        .btn-search-border {
            width: 25%;
        }
    }

    .tab-content>.active {
        margin: 0;
    }

    /* Marketing Materials 縮圖網格（媒體中心樣式：縮圖 + 預覽/下載 icon） */
    .mr-image-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; }
    @media (max-width: 991px) { .mr-image-grid { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 575px) { .mr-image-grid { grid-template-columns: 1fr; } }
    .mr-img-card { position: relative; border: 1px solid #e3e3e3; border-radius: 6px; overflow: hidden; background: #fff; }
    .mr-img-thumb { width: 100%; height: 200px; object-fit: cover; display: block; background: #f2f2f2; }
    /* PDF 首頁縮圖（PDF.js 於前端 render 到此 canvas）：顯示頁面上緣、裁切成與圖片同框 */
    .mr-pdf-thumb { width: 100%; height: 200px; object-fit: cover; object-position: top; display: block; background: #f2f2f2; }
    .mr-img-noimg { width: 100%; height: 200px; display: flex; align-items: center; justify-content: center;
        text-align: center; padding: 12px; color: #888; font-size: 14px; background: #f7f7f7; }
    /* hover 時底部滑出小 bar：左邊檔名、右邊預覽/下載 icon */
    .mr-img-bar { position: absolute; left: 0; right: 0; bottom: 0; display: flex; align-items: center;
        justify-content: space-between; gap: 10px; padding: 8px 12px; background: rgba(0,0,0,.62); color: #fff;
        transform: translateY(100%); transition: transform .35s ease; }
    .mr-img-card:hover .mr-img-bar { transform: translateY(0); }
    /* 檔名區：檔名可捲、副檔名 [EXT] 固定在後永遠可見（長檔名也看得到檔型） */
    .mr-img-name { display: flex; align-items: baseline; gap: 4px; min-width: 0; flex: 1 1 auto; overflow: hidden; font-size: 13px; line-height: 1.3; }
    .mr-img-fname { flex: 0 1 auto; min-width: 0; overflow: hidden; }
    .mr-img-fname-inner { display: inline-block; white-space: nowrap; }
    .mr-img-ext { flex: 0 0 auto; opacity: .72; font-weight: 400; }
    /* 長檔名 hover 跑馬燈：JS 量測溢出後設 --mr-shift/--mr-dur 觸發；未溢出 shift=0 不動 */
    .mr-img-fname:hover .mr-img-fname-inner { animation: mr-marquee var(--mr-dur, 3s) linear infinite alternate; }
    @keyframes mr-marquee { to { transform: translateX(var(--mr-shift, 0px)); } }
    .mr-img-bar-actions { display: flex; gap: 6px; flex: 0 0 auto; }
    .mr-img-bar-actions form { margin: 0; }
    .mr-icon-btn { width: 30px; height: 30px; border-radius: 50%; background: rgba(255,255,255,.92); border: none;
        display: flex; align-items: center; justify-content: center; cursor: pointer; padding: 0; }
    .mr-icon-btn:hover { background: #fff; }
    .mr-icon-btn svg { width: 16px; height: 16px; stroke: #0087DC; }
    /* 觸控裝置沒有 hover，bar 直接顯示 */
    @media (hover: none) { .mr-img-bar { transform: translateY(0); } }

    /* 影片縮圖：與圖片同尺寸，靜止顯示第一幀、hover 播放（JS 控制） */
    .mr-video-thumb { width: 100%; height: 200px; object-fit: cover; display: block; background: #000; }
    /* 右上 ▶ 角標：標示這是影片（置頂右避免與底部 hover bar 重疊） */
    .mr-video-badge { position: absolute; right: 8px; top: 8px; width: 32px; height: 32px; border-radius: 50%;
        background: rgba(0,0,0,.6); display: flex; align-items: center; justify-content: center; pointer-events: none; }
    .mr-video-badge svg { width: 16px; height: 16px; fill: #fff; margin-left: 2px; }

    /* 預覽彈窗：無白色 header，圖片直接顯示，X 疊在圖片右上角 */
    #mr-preview-modal .mr-preview-content { background: transparent; border: none; box-shadow: none; }
    #mr-preview-modal .modal-body { overflow: hidden; border-radius: 4px; }
    #mr-preview-modal .modal-body img { display: block; width: 100%; height: auto; }
    #mr-preview-modal .modal-body video { display: block; width: 100%; height: auto; max-height: 82vh; background: #000; }
    .mr-preview-close { position: absolute; top: 10px; right: 10px; z-index: 10; width: 36px; height: 36px;
        border: none; border-radius: 50%; background: rgba(0,0,0,.55); color: #fff; font-size: 22px; line-height: 36px;
        text-align: center; cursor: pointer; padding: 0; }
    .mr-preview-close:hover { background: rgba(0,0,0,.85); }
</style>
@endsection
@section('meta')
<title>{{isset($metatag[0]->title)? $metatag[0]->title :''}}</title>
<meta name="description" content="{{isset($metatag[0]->description)? $metatag[0]->description :''}}">
<link rel="canonical" href="{{url()->current()}}" />
@endsection
@section('container')
<div class="padding-top-content">
</div>
<div class="products-index-nav visible-up-922">
    <div class="bg-bredcrumb">
        <div class="container">
            <nav aria-label="breadcrumb" id="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item text-breadcrumb-home"><a
                            href="{{route('index','home')}}">{{$staticContent['Home']}}</a></li>
                    {{-- <li class="breadcrumb-item active text-breadcrumb-home dropdown" aria-current="page"><a
                            href="#" data-toggle="dropdown" id="tools-dropdown">RESOURCES</a>
                        <ul class="dropdown-menu">
                            <li><a href="#" id="tools-dropdown" class="text-bold">RESOURCES</a></li>
                            <hr>
                            <li><a href="{{route('index','catalogs')}}">CATALOGS</a></li>
                            <li><a href="{{route('index','product-documents')}}">PRODUCT DOCUMENTS</a></li>
                            <li><a href="{{route('index','login')}}">PARTNERS</a></li>
                        </ul>
                    </li> --}}
                    <li class="breadcrumb-item active text-breadcrumb-home" aria-current="page"><a
                            href="#">{{$staticContent['Partners']}}</a></li>
                    <li class="breadcrumb-item active text-breadcrumb-home" aria-current="page"><a
                            href="{{route('marketingResources')}}">{{$staticContent['Marketing_Resources']}}</a></li>
                    <li class="breadcrumb-item active text-breadcrumb" aria-current="page"><a
                            href="#">{{$staticContent['Marketing_Resources_Downloads']}}</a></li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<?php 
function getDateformat($date){
       
       $eng_month_arr = array(
           "0" => "",
           "1" => "Jan",
           "2" => "Feb",
           "3" => "Mar",
           "4" => "Apr",
           "5" => "May",
           "6" => "Jun",
           "7" => "Jul",
           "8" => "Aug",
           "9" => "Sep",
           "10" => "Oct",
           "11" => "Nov",
           "12" => "Dec"
       );
       $publicDate = date_create($date);
       $pDate = explode("-", $publicDate->format('Y-n-d'));
       $datearray = [
           'm' =>  $eng_month_arr[$pDate[1]],
           'd'=>  $pDate[2],
           'y' => $pDate[0]

       ];
       return  $datearray;
}
?>
<div class="padding-top-content-breadcrumb visible-up-922"></div>
<section class="box-news pb-5">
    <div class="container">
        <h2 class="text-title-delta visible-tablets-up">{{$staticContent['Marketing_Resources_Downloads']}}</h2>
        <h3 class="text-title-delta visible-mobile">{{$staticContent['Marketing_Resources_Downloads']}}</h3>
        <select id="select-catalogs" onchange="selectdocumentType();" class="form-control invisible-up-922 border-radius-6">
            @foreach ($margetCate as $cate)
            <option value="{{$cate->cate_id}}">{{$cate->name}}</option>
            @endforeach
        </select>
        <div class="row">
            <div class="col-md-12">
                <div class="nav nav-tabs d-flex justify-content-center border-b-2px visible-up-922 mb-4" id="nav-tab"
                    role="tablist">
                    @foreach ($margetCate as $cate)
                    <a class="nav-item nav-link font-size-tab {{$loop->iteration == 1?'active':'' }}"
                        onclick="setdatainput({{$cate->cate_id}});" id="pop-tab{{$cate->cate_id}}" data-toggle="tab"
                        href="#pop{{$cate->cate_id}}" role="tab" aria-controls="pop{{$cate->cate_id}}"
                        aria-selected="true" data-val="{{$cate->cate_id}}">{{$cate->name}}
                    </a>
                    @endforeach


                </div>
                <div class="tab-content" id="nav-tabContent">
                    @foreach ($margetCate as $cate)
                    <div class="tab-pane fade {{$loop->iteration == 1?'show active':'' }} " id="pop{{$cate->cate_id}}"
                        role="tabpanel" aria-labelledby="pop{{$cate->cate_id}}-tab">
                        <form onsubmit="searchmarketingbycate()">
                            <div class="search-space d-flex justify-content-center w-100">
                                <div class="box-search-input  mr-3">

                                    <div class="box-search-icon" style="border-top-left-radius: 6px;border-bottom-left-radius: 6px;">
                                        <img src="{{asset('frontend-asset/image/search-filters-icon.svg')}}" alt="">
                                    </div>
                                    <label for="searchinput" class="searchinput-filters-input">
                                        <input type="hidden" name="cateid" value="1">
                                        <input type="text" name="modelname" style="border-top-right-radius: 6px;border-bottom-right-radius: 6px;"
                                            placeholder="{{$staticContent['Search_By_Name']}}">
                                    </label>
                                </div>

                                <button class="btn-search-border">{{$staticContent['Search']}}</button>

                            </div>
                        </form>
                        @php $isGrid = in_array($cate->cate_id, $gridCateIds ?? []); @endphp
                        <div class="contentdatasearch">
                        @if($isGrid)
                            {{-- 縮圖網格版型（縮圖 + 預覽/下載 icon）；PDF 未上傳縮圖時才用 PDF.js render 首頁 --}}
                            <div class="mr-image-grid">
                            @foreach ($margeting as $marget)
                            @if($marget->cate_id == $cate->cate_id)
                            @php $ext = strtolower(pathinfo($marget->file, PATHINFO_EXTENSION));
                                 $isImage = in_array($ext, ['jpg','jpeg','png','gif','webp']);
                                 $isVideo = in_array($ext, ['mp4','webm','mov']);
                                 $isPdf = ($ext === 'pdf');
                                 $mrSrc = route('previewMarketingResource').'?doc='.urlencode($marget->file).'&v='.($marget->updated_at ? \Illuminate\Support\Carbon::parse($marget->updated_at)->timestamp : '1');
                                 $mrPoster = null;
                                 $mrDir = base_path('../uploads_delta/partner/marketing_resources/');
                                 // 縮圖一律優先（含圖片、影片）；無此欄時 fallback 主檔同名 .jpg 慣例（影片自動 poster / 舊資料）。
                                 // 圖片不吃同名 .jpg 慣例：主檔就是 .jpg 時會指到自己，等於繞過 previewMarketingResource 的權限檢查
                                 if (!empty($marget->thumbnail) && is_file($mrDir.$marget->thumbnail)) {
                                     $mrPoster = asset('uploads_delta/partner/marketing_resources/'.$marget->thumbnail);
                                 } elseif (!$isImage && !$isPdf) {
                                     $posterName = pathinfo($marget->file, PATHINFO_FILENAME).'.jpg';
                                     if (is_file($mrDir.$posterName)) {
                                         $mrPoster = asset('uploads_delta/partner/marketing_resources/'.$posterName);
                                     }
                                 } @endphp
                            <div class="mr-img-card">
                                @if($isImage && !$mrPoster)
                                <img class="mr-img-thumb lazyload" loading="lazy" alt="{{$marget->name}}" data-src="{{ $mrSrc }}">
                                @elseif($isVideo)
                                <video class="mr-video-thumb" muted preload="none" playsinline @if($mrPoster) poster="{{ $mrPoster }}" @endif data-src="{{ $mrSrc }}"></video>
                                <span class="mr-video-badge"><svg viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg></span>
                                @elseif($mrPoster)
                                <img class="mr-img-thumb lazyload" loading="lazy" alt="{{$marget->name}}" data-src="{{ $mrPoster }}">
                                @elseif($isPdf)
                                <canvas class="mr-pdf-thumb" data-src="{{ $mrSrc }}" aria-label="{{$marget->name}}"></canvas>
                                @else
                                <div class="mr-img-noimg">{{ strtoupper($ext) }}</div>
                                @endif
                                <div class="mr-img-bar">
                                    <span class="mr-img-name" title="{{$marget->name}}"><span class="mr-img-fname"><span class="mr-img-fname-inner">{{$marget->name}}</span></span><span class="mr-img-ext">[{{ strtoupper($ext) }}]</span></span>
                                    <div class="mr-img-bar-actions">
                                        @if($isImage || $isVideo || $isPdf)
                                        <button type="button" class="mr-icon-btn mr-preview-trigger" title="{{$staticContent['Preview'] ?? 'Preview'}}"
                                            data-file="{{$marget->file}}" data-name="{{$marget->name}}">
                                            <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                        </button>
                                        @endif
                                        <form method="POST" action="{{route('partnerLoginDoc_success')}}">
                                            {{csrf_field()}}
                                            <input type="hidden" name="section_id" value={{session('partner_id')}}>
                                            <input type="hidden" name="doc" value="{{$marget->file}}">
                                            <button type="submit" class="mr-icon-btn" title="{{$staticContent['Downloads']}}">
                                                <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M12 3v12"/><path d="M7 11l5 5 5-5"/><path d="M5 21h14"/></svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @endforeach
                            </div>
                        @else
                            @foreach ($margeting as $marget)
                            @if($marget->cate_id == $cate->cate_id )
                            <div class="resources-download">
                                <div class="detail-download">
                                    <h5>{{$marget->name}}</h5>
                                    <?php
                                $date = getDateformat($marget->created_at);
                               ?>
                                    <p>{{$staticContent['Uploaded_on']}} {{$date['d'].'-'.$date['m'].'-'.$date['y']}}
                                    </p>
                                </div>
                                <form method="POST" action="{{route('partnerLoginDoc_success')}}">
                                    {{csrf_field()}}
                                    <input type="hidden" name="section_id" value={{session('partner_id')}}>
                                    <input type="hidden" name="doc" value="{{$marget->file}}">
                                    <button class=" btn-downlode" type="submit">{{$staticContent['Downloads']}}</button>
                                </form>
                            </div>
                            @endif
                            @endforeach
                        @endif
                        </div>

                    </div>
                    @endforeach


                </div>
            </div>
        </div>
    </div>
</section>

{{-- 行銷資源預覽彈窗（PDF / 圖片） --}}
<div class="modal fade" id="mr-preview-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content mr-preview-content">
            <button type="button" class="mr-preview-close" data-dismiss="modal" aria-label="Close">&times;</button>
            <div class="modal-body p-0" id="mr-preview-body"></div>
        </div>
    </div>
</div>

@endsection


@section('js')

<script type="text/javascript" src="{{asset('/frontend-asset/js/pdfjs/pdf.min.js')}}"></script>
<script>
    // PDF.js worker 自帶同源（CSP worker-src 會 fallback 到 default-src 'self'，不能吃 CDN）
    if (window.pdfjsLib) { pdfjsLib.GlobalWorkerOptions.workerSrc = '{{asset('/frontend-asset/js/pdfjs/pdf.worker.min.js')}}'; }
    function selectdocumentType(){
        var typetab =  $('#select-catalogs').val();
        $('#pop-tab'+typetab).click();
       
      }
      function setdatainput(cateid){
        $("input[name=cateid]").val(cateid);
      }
      var margeting = <?= json_encode($margeting);?>;
      function searchmarketingbycate(){
        event.preventDefault();
        // 各 tab 的搜尋 form 共用 name，全域 $("input[name=...]") 只會取到第一個 tab → 必須限定在當前 active 分頁內取值與渲染
        var $pane = $('.tab-pane.active');
        var modelname = $pane.find('input[name=modelname]').val();
        var cateid = $pane.find('input[name=cateid]').val();
        var resultsearch  = [];
        var term = modelname; // search term (regex pattern)
        var search = new RegExp(term , 'i'); // prepare a regex object     
            margeting.filter(function(data){
            if(search.test(data.name)){
                var index = resultsearch.findIndex(function(x){
                  return  x.id === data.id;
                })
                if(data.cate_id == cateid ){
                    if(index == -1){
                        resultsearch.push(data);  
                    }
                }
                  
            }
           });


        var isProductImages = (mrGridCateIds.indexOf(parseInt(cateid, 10)) > -1);
        var eyeSvg = '<svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>';
        var dlSvg = '<svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M12 3v12"/><path d="M7 11l5 5 5-5"/><path d="M5 21h14"/></svg>';
        var dlBase = '{{config('app.url')}}/file_doc_2/marketing_resources/';
        var mrStaticBase = '{{ asset('uploads_delta/partner/marketing_resources') }}/';   // 影片縮圖(poster)靜態 base
        var html = '';
        $.each(resultsearch, function(index,value){
            var ext = (value['file']||'').split('.').pop().toLowerCase();
            var isImage = ['jpg','jpeg','png','gif','webp'].indexOf(ext) > -1;
            var isVideo = ['mp4','webm','mov'].indexOf(ext) > -1;
            var isPdf = ext === 'pdf';
            // 帶 updated_at 當 cache-buster：換檔後 v 改變、避免搜尋結果顯示舊快取圖（對齊初始 blade 的 &v）
            var mrSrc = mrPreviewBase+'?doc='+encodeURIComponent(value['file'])+'&v='+encodeURIComponent(value['updated_at']||'1');
            if (isProductImages) {
                // 縮圖網格：有人工縮圖一律優先，否則圖片→原圖、影片→自動截幀 poster、PDF→首頁、其他→佔位；皆可下載
                html += '<div class="mr-img-card">';
                if (isImage && value['thumbnail']) {
                    // 有人工縮圖就用它，省下為了 200px 的框去載全尺寸原圖；縮圖檔不存在才退回原圖
                    html += '<img class="mr-img-thumb" alt="'+value['name']+'" src="'+(mrStaticBase + value['thumbnail'])+'" data-mr-full-src="'+mrSrc+'" onerror="this.onerror=null; this.src=this.getAttribute(\'data-mr-full-src\')">';
                } else if (isImage) {
                    html += '<img class="mr-img-thumb lazyload" loading="lazy" alt="'+value['name']+'" data-src="'+mrSrc+'">';
                } else if (isVideo) {
                    var poster = value['thumbnail'] ? (mrStaticBase + value['thumbnail']) : (mrStaticBase + value['file'].replace(/\.[^.]+$/, '.jpg'));
                    html += '<video class="mr-video-thumb" muted preload="none" playsinline poster="'+poster+'" data-src="'+mrSrc+'"></video>';
                    html += '<span class="mr-video-badge"><svg viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg></span>';
                } else if (isPdf && value['thumbnail']) {
                    // PDF 有人工縮圖就直接用，不載 PDF.js（省首頁解析）；縮圖檔不存在才退回 canvas render
                    html += '<img class="mr-img-thumb" alt="'+value['name']+'" src="'+(mrStaticBase + value['thumbnail'])+'" data-mr-pdf-src="'+mrSrc+'" onerror="mrPdfThumbFallback(this)">';
                } else if (isPdf) {
                    html += '<canvas class="mr-pdf-thumb" data-src="'+mrSrc+'"></canvas>';
                } else {
                    // 其他檔（壓縮檔等）：優先用 DB 縮圖，否則試主檔同名 .jpg；載入失敗則置換佔位框
                    var thumb = value['thumbnail'] ? (mrStaticBase + value['thumbnail']) : (mrStaticBase + value['file'].replace(/\.[^.]+$/, '.jpg'));
                    html += '<img class="mr-img-thumb" alt="'+value['name']+'" src="'+thumb+'" onerror="mrThumbFallback(this,\''+ext.toUpperCase()+'\')">';
                }

                html += '<div class="mr-img-bar"><span class="mr-img-name" title="'+value['name']+'"><span class="mr-img-fname"><span class="mr-img-fname-inner">'+value['name']+'</span></span><span class="mr-img-ext">['+ext.toUpperCase()+']</span></span><div class="mr-img-bar-actions">';
                if (isImage || isVideo || isPdf) {
                    html += '<button type="button" class="mr-icon-btn mr-preview-trigger" data-file="'+value['file']+'" data-name="'+value['name']+'" title="Preview">'+eyeSvg+'</button>';
                }
                html += '<a class="mr-icon-btn" href="'+dlBase+value['file']+'" title="Download">'+dlSvg+'</a>';
                html += '</div></div></div>';
            } else {
                html += '<div class="resources-download">';
                html += '<div class="detail-download">';
                html +=  '<h5>'+value['name']+'</h5>';
                html += '<p>{{$staticContent['Uploaded_on']}} 13-Mar-2019 </p>';
                html += '</div>';
                html += '<a href="'+dlBase+value['file']+'">';
                html += '<button class="btn-downlode">DOWNLOAD</button>';
                html += '</a>';
                html += '</div>';
            }
        });
        if (isProductImages) { html = '<div class="mr-image-grid">'+html+'</div>'; }
        $pane.find('.contentdatasearch').html(html);
        mrObserveVideos();   // 搜尋後動態注入的影片也要 lazy-load / 手機捲動播放
        mrLoadImages();      // 動態注入的圖片：全站 lazyload 只處理初始 DOM、不接動態節點，手動把 data-src 載入
        mrObservePdfs();     // 動態注入的 PDF canvas 也要納入觀察、捲入視窗時 render 首頁

      }

      // 點檔名/標題區塊 → 彈窗預覽（僅 PDF / 圖片）。事件委派，含搜尋後動態項目
      var mrPreviewBase = @json(route('previewMarketingResource'));
      var mrGridCateIds = @json($gridCateIds ?? []);
      function mrNotice(text) {
          return '<div style="padding:48px 24px;text-align:center;color:#646464">' + text + '</div>';
      }
      // 搜尋渲染的壓縮檔縮圖若不存在（img onerror），置換成佔位框（初始 blade 已用 is_file 判斷，不需此路）
      function mrThumbFallback(img, ext) {
          var d = document.createElement('div');
          d.className = 'mr-img-noimg';
          d.textContent = ext;
          img.replaceWith(d);
      }
      // PDF 人工縮圖載入失敗（DB 有值但實體檔不見）：換回 canvas 走 PDF.js 首頁，不掉成灰底佔位框
      function mrPdfThumbFallback(img) {
          var c = document.createElement('canvas');
          c.className = 'mr-pdf-thumb';
          c.setAttribute('data-src', img.getAttribute('data-mr-pdf-src') || '');
          img.replaceWith(c);
          mrObservePdfs();
      }
      $(document).on('click', '.mr-preview-trigger', function () {
          var file = $(this).attr('data-file');
          var name = $(this).attr('data-name') || '';
          if (!file) return;
          var url = mrPreviewBase + '?doc=' + encodeURIComponent(file);
          $('#mr-preview-title').text(name);
          $('#mr-preview-body').html(mrNotice('Loading…'));
          // 開預覽前先暫停所有縮圖影片（手機捲動自動播放的那支），避免背景無聲影片繼續播
          document.querySelectorAll('.mr-video-thumb').forEach(function (v) { v.pause(); });
          $('#mr-preview-modal').modal('show');
          // 先用 HEAD 看回傳類型（不下載檔案本體，避免重複下載拖慢）再決定呈現：
          // PDF→高 iframe、圖片→img、其餘（如檔案不存在的提示）→小訊息
          fetch(url, { method: 'HEAD', credentials: 'same-origin' }).then(function (res) {
              var ct = (res.headers.get('content-type') || '').toLowerCase();
              if (ct.indexOf('pdf') > -1) {
                  $('#mr-preview-body').html('<iframe src="' + url + '" style="width:100%;height:78vh;border:0;"></iframe>');
              } else if (ct.indexOf('video') > -1) {
                  $('#mr-preview-body').html('<video src="' + url + '" controls autoplay playsinline style="width:100%;height:auto;max-height:82vh;display:block;background:#000;"></video>');
              } else if (ct.indexOf('image') > -1) {
                  $('#mr-preview-body').html('<img src="' + url + '" style="max-width:100%;display:block;margin:0 auto;">');
              } else {
                  $('#mr-preview-body').html(mrNotice('File not available for preview.'));
              }
          }).catch(function () {
              $('#mr-preview-body').html(mrNotice('File not available for preview.'));
          });
      });
      // 關閉開始時先移開 modal 內的焦點，避免焦點還在內部就被設 aria-hidden（無障礙警告）
      $('#mr-preview-modal').on('hide.bs.modal', function () {
          if (document.activeElement && this.contains(document.activeElement)) {
              document.activeElement.blur();
          }
      });
      $('#mr-preview-modal').on('hidden.bs.modal', function () {
          $('#mr-preview-body').empty();
          // 關閉預覽後：手機上讓仍在視窗內（達門檻）的縮圖影片接著播
          if (mrNoHover.matches) {
              document.querySelectorAll('.mr-video-thumb').forEach(function (v) {
                  var r = v.getBoundingClientRect();
                  if (!r.height) { return; }
                  var ratio = (Math.min(r.bottom, window.innerHeight) - Math.max(r.top, 0)) / r.height;
                  if (ratio >= 0.6) { var p = v.play(); if (p && p.catch) { p.catch(function () {}); } }
              });
          }
      });

      // 桌機：hover 播放、移開暫停退回開頭（muted 才能免點擊自動播）。事件委派，含搜尋後動態項目
      $(document).on('mouseenter', '.mr-video-thumb', function () {
          if (!this.getAttribute('src') && this.dataset.src) { this.src = this.dataset.src; }  // lazy：尚未載入則此時載入
          var p = this.play();
          if (p && p.catch) { p.catch(function () {}); }
      });
      $(document).on('mouseleave', '.mr-video-thumb', function () {
          this.pause();
          try { this.currentTime = 0; } catch (e) {}
      });

      // 影片 lazy-load + 手機捲到視窗內自動播放（靜音）、捲走暫停退回開頭；桌機不在捲動時自動播（交給 hover）
      var mrNoHover = window.matchMedia('(hover: none)');
      var mrVideoObserver = ('IntersectionObserver' in window) ? new IntersectionObserver(function (entries) {
          entries.forEach(function (e) {
              var v = e.target;
              if (e.isIntersecting) {
                  if (!v.getAttribute('src') && v.dataset.src) { v.src = v.dataset.src; }   // 進入視窗才載入該支
                  if (mrNoHover.matches) { var p = v.play(); if (p && p.catch) { p.catch(function () {}); } }
              } else if (mrNoHover.matches) {
                  v.pause();
                  try { v.currentTime = 0; } catch (err) {}
              }
          });
      }, { threshold: 0.6 }) : null;

      function mrObserveVideos() {
          if (!mrVideoObserver) return;
          document.querySelectorAll('.mr-video-thumb').forEach(function (v) {
              if (!v.dataset.mrObserved) { v.dataset.mrObserved = '1'; mrVideoObserver.observe(v); }
          });
      }
      // 搜尋動態注入的圖片不被全站 lazyload（只處理初始 DOM）接手，手動把 data-src 設為 src 載入
      function mrLoadImages() {
          document.querySelectorAll('.mr-img-thumb[data-src]').forEach(function (img) {
              if (!img.getAttribute('src')) { img.src = img.dataset.src; }
          });
      }

      // PDF 首頁縮圖：只在 canvas 捲入視窗（含隱藏分頁被切到）時才用 PDF.js render 第一頁，避免一次解析整頁 PDF 拖慢
      var mrPdfObserver = ('IntersectionObserver' in window) ? new IntersectionObserver(function (entries) {
          entries.forEach(function (e) {
              if (!e.isIntersecting) { return; }
              var c = e.target;
              mrPdfObserver.unobserve(c);
              mrRenderPdf(c);
          });
      }, { rootMargin: '300px' }) : null;

      function mrRenderPdf(canvas) {
          if (!window.pdfjsLib || !canvas.dataset.src || canvas.dataset.mrRendered) { return; }
          canvas.dataset.mrRendered = '1';
          pdfjsLib.getDocument({ url: canvas.dataset.src, withCredentials: true }).promise.then(function (pdf) {
              return pdf.getPage(1);
          }).then(function (page) {
              var targetW = canvas.clientWidth || 260;
              var base = page.getViewport({ scale: 1 });
              var vp = page.getViewport({ scale: targetW / base.width });
              canvas.width = vp.width;
              canvas.height = vp.height;
              return page.render({ canvasContext: canvas.getContext('2d'), viewport: vp }).promise;
          }).catch(function () { /* 失敗保持空框，眼睛預覽 / 下載仍可用 */ });
      }

      function mrObservePdfs() {
          document.querySelectorAll('.mr-pdf-thumb[data-src]').forEach(function (c) {
              if (c.dataset.mrObserved) { return; }
              c.dataset.mrObserved = '1';
              if (mrPdfObserver) { mrPdfObserver.observe(c); } else { mrRenderPdf(c); }
          });
      }

      // 長檔名 hover 跑馬燈：進入時量測溢出量，設 CSS 變數觸發 :hover 動畫（未溢出則不動）。事件委派含搜尋後動態項目
      $(document).on('mouseenter', '.mr-img-fname', function () {
          var inner = this.querySelector('.mr-img-fname-inner');
          if (!inner) { return; }
          var overflow = inner.scrollWidth - this.clientWidth;
          if (overflow > 4) {
              this.style.setProperty('--mr-shift', (-overflow) + 'px');
              this.style.setProperty('--mr-dur', Math.max(2, overflow / 40) + 's');
          } else {
              this.style.setProperty('--mr-shift', '0px');
          }
      });

      mrObserveVideos();
      mrObservePdfs();
</script>

@endsection