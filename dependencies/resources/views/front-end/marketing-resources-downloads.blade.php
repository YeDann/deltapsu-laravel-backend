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

    /* Product Images 縮圖網格（媒體中心樣式：縮圖 + 預覽/下載 icon） */
    .mr-image-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; }
    @media (max-width: 991px) { .mr-image-grid { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 575px) { .mr-image-grid { grid-template-columns: 1fr; } }
    .mr-img-card { position: relative; border: 1px solid #e3e3e3; border-radius: 6px; overflow: hidden; background: #fff; }
    .mr-img-thumb { width: 100%; height: 200px; object-fit: cover; display: block; background: #f2f2f2; }
    .mr-img-noimg { width: 100%; height: 200px; display: flex; align-items: center; justify-content: center;
        text-align: center; padding: 12px; color: #888; font-size: 14px; background: #f7f7f7; }
    /* hover 時底部滑出小 bar：左邊檔名、右邊預覽/下載 icon */
    .mr-img-bar { position: absolute; left: 0; right: 0; bottom: 0; display: flex; align-items: center;
        justify-content: space-between; gap: 10px; padding: 8px 12px; background: rgba(0,0,0,.62); color: #fff;
        transform: translateY(100%); transition: transform .35s ease; }
    .mr-img-card:hover .mr-img-bar { transform: translateY(0); }
    .mr-img-fname { font-size: 13px; line-height: 1.3; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
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
                        @php $isProductImages = (isset($previewCateId) && $cate->cate_id == $previewCateId); @endphp
                        <div class="contentdatasearch">
                        @if($isProductImages)
                            {{-- Product Images：圖片縮圖網格（縮圖 + 預覽/下載 icon） --}}
                            <div class="mr-image-grid">
                            @foreach ($margeting as $marget)
                            @if($marget->cate_id == $cate->cate_id)
                            @php $ext = strtolower(pathinfo($marget->file, PATHINFO_EXTENSION));
                                 $isImage = in_array($ext, ['jpg','jpeg','png','gif','webp']);
                                 $isVideo = in_array($ext, ['mp4','webm','mov']);
                                 $mrSrc = route('previewMarketingResource').'?doc='.urlencode($marget->file).'&v='.($marget->updated_at ? \Illuminate\Support\Carbon::parse($marget->updated_at)->timestamp : '1');
                                 $mrPoster = null;
                                 if ($isVideo) {
                                     $posterName = pathinfo($marget->file, PATHINFO_FILENAME).'.jpg';
                                     if (is_file(base_path('../uploads_delta/partner/marketing_resources/').$posterName)) {
                                         $mrPoster = asset('uploads_delta/partner/marketing_resources/'.$posterName);
                                     }
                                 } @endphp
                            <div class="mr-img-card">
                                @if($isImage)
                                <img class="mr-img-thumb lazyload" loading="lazy" alt="{{$marget->name}}" data-src="{{ $mrSrc }}">
                                @elseif($isVideo)
                                <video class="mr-video-thumb" muted preload="none" playsinline @if($mrPoster) poster="{{ $mrPoster }}" @endif data-src="{{ $mrSrc }}"></video>
                                <span class="mr-video-badge"><svg viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg></span>
                                @else
                                <div class="mr-img-noimg">{{ strtoupper($ext) }}</div>
                                @endif
                                <div class="mr-img-bar">
                                    <span class="mr-img-fname" title="{{$marget->name}}">{{$marget->name}}</span>
                                    <div class="mr-img-bar-actions">
                                        @if($isImage || $isVideo)
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

<script>
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


        var isProductImages = (mrPreviewCateId && cateid == mrPreviewCateId);
        var eyeSvg = '<svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>';
        var dlSvg = '<svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M12 3v12"/><path d="M7 11l5 5 5-5"/><path d="M5 21h14"/></svg>';
        var dlBase = '{{config('app.url')}}/file_doc_2/marketing_resources/';
        var mrStaticBase = '{{ asset('uploads_delta/partner/marketing_resources') }}/';   // 影片縮圖(poster)靜態 base
        var html = '';
        $.each(resultsearch, function(index,value){
            var ext = (value['file']||'').split('.').pop().toLowerCase();
            var isImage = ['jpg','jpeg','png','gif','webp'].indexOf(ext) > -1;
            var isVideo = ['mp4','webm','mov'].indexOf(ext) > -1;
            var mrSrc = mrPreviewBase+'?doc='+encodeURIComponent(value['file']);
            if (isProductImages) {
                // Product Images / Videos：圖片→縮圖、影片→hover 播放+▶ 角標、其他→佔位；皆可下載
                html += '<div class="mr-img-card">';
                if (isImage) {
                    html += '<img class="mr-img-thumb lazyload" loading="lazy" alt="'+value['name']+'" data-src="'+mrSrc+'">';
                } else if (isVideo) {
                    var poster = mrStaticBase + value['file'].replace(/\.[^.]+$/, '.jpg');   // 縮圖不存在則瀏覽器自動略過
                    html += '<video class="mr-video-thumb" muted preload="none" playsinline poster="'+poster+'" data-src="'+mrSrc+'"></video>';
                    html += '<span class="mr-video-badge"><svg viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg></span>';
                } else {
                    html += '<div class="mr-img-noimg">'+ext.toUpperCase()+'</div>';
                }
                html += '<div class="mr-img-bar"><span class="mr-img-fname" title="'+value['name']+'">'+value['name']+'</span><div class="mr-img-bar-actions">';
                if (isImage || isVideo) {
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

      }

      // 點檔名/標題區塊 → 彈窗預覽（僅 PDF / 圖片）。事件委派，含搜尋後動態項目
      var mrPreviewBase = @json(route('previewMarketingResource'));
      var mrPreviewCateId = @json($previewCateId ?? null);
      function mrNotice(text) {
          return '<div style="padding:48px 24px;text-align:center;color:#646464">' + text + '</div>';
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
      mrObserveVideos();
</script>

@endsection