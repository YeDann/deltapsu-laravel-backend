{{--
    經銷商庫存查詢 Modal（共用 partial）— 列表頁 product.blade.php 與詳情頁 productdetails.blade.php 共用。
    Stock 按鈕 onclick="checkStock(proCode)" 即可開啟；後端走 /stock-check（DilpClient → netCOMPONENTS DILP）。
    需 jQuery（layout 於 container 前已載）；.modal('show') 為點擊才呼叫，屆時 bootstrap.js 已載。
    含洲→國兩層篩選、多語（國名 intl／洲名 static word）、手機版版型。
--}}
<style>
    #stockModal .modal-content { border: 0; border-radius: 10px; box-shadow: 0 12px 44px rgba(0,0,0,.16); }
    /* 內容比視窗高時：限制 modal 高度、body 內部捲動、header(×)/footer 固定，避免 modal 撐出畫面 */
    #stockModal .modal-content { max-height: calc(100vh - 3.5rem); }
    #stockModal .modal-header, #stockModal .modal-footer { flex-shrink: 0; }
    #stockModal .modal-body { overflow-y: auto; }
    #stockModal .modal-header { border-bottom: 0; padding: 22px 28px 4px; display: flex; align-items: center; }
    #stockModal .modal-title { font-size: 22px; font-weight: 700; color: #000; margin-right: auto; }
    #stockModal .stock-region {
        border: 1px solid #ccd2dd; border-radius: 4px; background: #fff;
        padding: 6px 30px 6px 16px; font-size: 14px; color: #333; cursor: pointer; max-width: 200px;
        -webkit-appearance: none; appearance: none; outline: none;
        background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="12" height="8" viewBox="0 0 12 8"><path fill="none" stroke="%23888888" stroke-width="1.6" d="M1 1l5 5 5-5"/></svg>');
        background-repeat: no-repeat; background-position: right 12px center;
    }
    #stockModal .stock-country { margin-left: 8px; }
    #stockModal .modal-header .close { font-size: 28px; font-weight: 400; opacity: .5; margin: 0 0 0 14px; }
    #stockModal .modal-body { padding: 4px 28px 22px; }
    #stockModal table { width: 100%; margin: 0; }
    /* 覆寫站上 legacy table 邊框：scoped 於 #stockModal，只保留列底線，去掉每列框 */
    #stockModal table th, #stockModal table td {
        border: 0 !important; border-bottom: 1px solid #ececec !important;
        padding: 15px 10px; vertical-align: middle; text-align: left;
    }
    #stockModal thead th { border-bottom: 1px solid #d6d6d6 !important; color: #000; font-weight: 700; font-size: 15px; }
    /* 長料號/長經銷商名在需要時可斷字，避免不可斷區塊把表格撐爆、Buy Now 溢出 modal */
    #stockModal tbody td { color: #333; font-size: 15px; overflow-wrap: anywhere; word-break: break-word; }
    #stockModal tbody tr:hover { background: #f7f9fc; }
    #stockModal th.stock-action, #stockModal td.stock-action { text-align: right; width: 1%; white-space: nowrap; }
    #stockModal th.stock-availability, #stockModal td.stock-availability { text-align: center; }
    #stockModal th.stock-date, #stockModal td.stock-date { text-align: center; white-space: nowrap; }
    #stockModal .btn-buy {
        display: inline-block; background: #0087DC; color: #fff;
        border: 0; border-radius: 4px; padding: 8px 12px;
        font-size: 14px; font-weight: 600; line-height: 1.5; white-space: nowrap;
        text-decoration: none; cursor: pointer; transition: background .15s;
        width: 160px; text-align: center;   /* 固定寬度：Buy Now 與 Go to Distributor 等寬對齊（slide 19） */
    }
    #stockModal .btn-buy:hover { background: #1E50C8; color: #fff; text-decoration: none; }
    #stockModal .btn-buy:disabled, #stockModal .btn-buy[disabled] { background: #c0c4cc; cursor: not-allowed; }
    /* 無購物車連結時改顯示聯絡鈕（文字走 Stock_contact、點擊 mailto 該經銷商）：外框藍字以別於實心藍 Buy Now；inset box-shadow 當外框不影響高度 */
    #stockModal .btn-buy.btn-buy-contact { background: #fff; color: #0087DC; box-shadow: inset 0 0 0 1px #0087DC; }
    #stockModal .btn-buy.btn-buy-contact:hover { background: #0087DC; color: #fff; }
    #stockModal .stock-state { padding: 30px 0; text-align: center; }
    /* footer：其他購買選項 / 業務支援 + Contact Us（連 /contact/support） */
    #stockModal .modal-footer { border-top: 1px solid #ececec; background: #f7f8fa; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px; padding: 16px 28px; display: flex; align-items: center; justify-content: space-between; gap: 16px; }
    #stockModal .modal-footer > * { margin: 0; }
    #stockModal .stock-footer-text { color: #666; font-size: 14px; }
    #stockModal .btn-contact { color: #0087DC; font-size: 14px; font-weight: 600; text-decoration: underline; white-space: nowrap; }
    #stockModal .btn-contact:hover { color: #1E50C8; text-decoration: underline; }
    #stockModal .stock-powered { color: #888; font-size: 13px; display: inline-flex; align-items: center; gap: 8px; }
    #stockModal .nc-logo { height: 22px; vertical-align: middle; }
    #stockModal .stock-footer-right { display: inline-flex; align-items: center; gap: 18px; }
    /* 窄 modal（含平板 768–991：BS4 .modal-lg 要 ≥992 才 800px，否則退回 500px）縮小 padding / 字級 + 堆疊 header，
       避免桌機版 header（標題＋兩下拉並排＋×）與表格塞不下、× 被擠出 modal、Buy Now 被裁 */
    @media (max-width: 991px) {
        /* 兩個下拉(洲/國)在窄螢幕並排會擠，故標題自成一列、兩下拉換到第二列平分寬度、關閉鈕固定右上 */
        #stockModal .modal-header { padding: 18px 16px 4px; position: relative; flex-wrap: wrap; }
        #stockModal .modal-title { font-size: 18px; flex: 1 1 100%; margin-right: 0; margin-bottom: 8px; }
        #stockModal .stock-region { font-size: 12px; padding: 5px 26px 5px 12px; max-width: none; flex: 1 1 100%; }
        #stockModal .stock-country { margin-left: 0; margin-top: 8px; }
        #stockModal .modal-header .close { position: absolute; right: 16px; top: 4px; margin: 0; }
        #stockModal .modal-body { padding: 4px 14px 18px; }
        /* 安全網：5 欄真的塞不下時整張表可橫向捲動，避免 Buy Now 被 modal 右緣裁掉 */
        #stockModal #stockTableWrap { overflow-x: auto; -webkit-overflow-scrolling: touch; }
        #stockModal table th, #stockModal table td { padding: 10px 5px; font-size: 13px; }
        #stockModal thead th { font-size: 13px; }
        #stockModal td.stock-date, #stockModal th.stock-date { white-space: normal; }
        #stockModal .btn-buy { padding: 6px 8px; font-size: 12px; width: 140px; }
        /* footer：直排堆疊，否則 space-between 在窄螢幕會把 Contact Us 推出右緣裁掉 */
        #stockModal .modal-footer { flex-direction: column; align-items: flex-start; gap: 10px; padding: 14px 16px; }
        #stockModal .stock-footer-right { flex-wrap: wrap; gap: 6px 12px; }
    }
</style>
<div class="modal fade" id="stockModal" tabindex="-1" role="dialog" aria-labelledby="stockModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="stockModalTitle"></h5>
                <select id="stockRegion" class="stock-region" style="display:none;" aria-label="Region filter">
                    <option value="">{{ $staticContent['Stock_all_regions'] ?? 'All Regions' }}</option>
                </select>
                <select id="stockCountry" class="stock-region stock-country" style="display:none;" aria-label="Country filter">
                    <option value="">{{ $staticContent['Stock_all_countries'] ?? 'All Countries' }}</option>
                </select>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="stockLoading" class="stock-state" style="display:none;">{{ $staticContent['Stock_loading'] ?? 'Loading…' }}</div>
                <div id="stockError" class="stock-state text-danger" style="display:none;">{{ $staticContent['Stock_error'] ?? 'Unable to load stock' }}</div>
                <div id="stockEmpty" class="stock-state text-muted" style="display:none;">{{ $staticContent['Stock_no_results'] ?? 'No stock found' }}</div>
                <div id="stockTableWrap" style="display:none;">
                    <table class="mb-0">
                        <thead>
                            <tr>
                                <th>{{ $staticContent['Stock_model_name'] ?? 'Model Name' }}</th>
                                <th>{{ $staticContent['Stock_distributor'] ?? 'Distributor' }}</th>
                                <th class="stock-availability">{{ $staticContent['Stock_availability'] ?? 'Availability' }}</th>
                                <th class="stock-date">{{ $staticContent['Stock_upload_date'] ?? 'Date Updated' }}</th>
                                <th class="stock-action"></th>
                            </tr>
                        </thead>
                        <tbody id="stockTableBody"></tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer stock-footer">
                <span class="stock-powered">{{ $staticContent['Stock_powered_by'] ?? 'Powered by' }} <a href="https://www.netcomponents.com" target="_blank" rel="noopener"><img class="nc-logo" src="{{ asset('frontend-asset/image/netcomponents-logo.svg') }}" alt="netCOMPONENTS"></a></span>
                <span class="stock-footer-right">
                    <span class="stock-footer-text">{{ $staticContent['Stock_sales_support'] ?? 'For other purchasing options or sales support:' }}</span>
                    <a href="{{ route('contactSupport') }}" class="btn-contact">{{ $staticContent['contact_us'] ?? 'Contact Us' }}</a>
                </span>
            </div>
        </div>
    </div>
</div>
<script>
    // 兩層（洲→國）篩選用：洲代碼 → 在地洲名（intl 無法在地化洲名，故改用後台靜態字；未知洲 fallback DILP 英文）
    var stockRegionLabels = {
        'AM': '{{ addslashes($staticContent['Stock_region_am'] ?? 'North America') }}',
        'SA': '{{ addslashes($staticContent['Stock_region_sa'] ?? 'South America') }}',
        'EU': '{{ addslashes($staticContent['Stock_region_eu'] ?? 'Europe') }}',
        'AS': '{{ addslashes($staticContent['Stock_region_as'] ?? 'Asia') }}',
        'AF': '{{ addslashes($staticContent['Stock_region_af'] ?? 'Africa') }}',
        'OC': '{{ addslashes($staticContent['Stock_region_oc'] ?? 'Oceania') }}',
        'ME': '{{ addslashes($staticContent['Stock_region_me'] ?? 'Middle East') }}'
    };
    var stockCountryMeta = {};   // 本次查詢：國碼 → {name, region}
    var stockRegionMeta = {};    // 本次查詢：洲碼 → 顯示用在地洲名
    var stockAllCountriesLabel = '{{ addslashes($staticContent['Stock_all_countries'] ?? 'All Countries') }}';
    // 無購物車連結時的聯絡鈕（文字走 Stock_contact）：點擊向後端要該經銷商 email → mailto；拿不到則 fallback 我方業務支援
    var stockContactLabel = '{{ addslashes($staticContent['Stock_contact'] ?? 'Go to Distributor') }}';
    var stockContactUrl = '{{ route('stockContact') }}';
    var stockSupportUrl = '{{ route('contactSupport') }}';

    // 依目前選的洲重建國家下拉（空 = 全部國家）；無對應國家則隱藏國下拉
    function rebuildStockCountryOptions(regionFilter) {
        var $country = $('#stockCountry');
        $country.empty().append($('<option>').val('').text(stockAllCountriesLabel));
        var codes = Object.keys(stockCountryMeta).filter(function (code) {
            return !regionFilter || stockCountryMeta[code].region === regionFilter;
        });
        codes.sort(function (a, b) {
            return stockCountryMeta[a].name.localeCompare(stockCountryMeta[b].name);
        }).forEach(function (code) {
            $country.append($('<option>').val(code).text(stockCountryMeta[code].name));
        });
        $country.val('').toggle(codes.length > 0);
    }

    // 套用篩選：列需同時通過「洲」與「國」條件（任一為空 = 不限）
    function applyStockFilter() {
        var region = $('#stockRegion').val();
        var country = $('#stockCountry').val();
        $('#stockTableBody tr').each(function () {
            var regions = ($(this).attr('data-regions') || '').split(',');
            var countries = ($(this).attr('data-countries') || '').split(',');
            var okRegion = !region || regions.indexOf(region) !== -1;
            var okCountry = !country || countries.indexOf(country) !== -1;
            $(this).toggle(okRegion && okCountry);
        });
    }

    // 查詢經銷商庫存（Stock 按鈕入口）：開 Modal → AJAX 查 DILP → 渲染經銷商表 / 查無 / 錯誤。
    function checkStock(proCode) {
        var $loading = $('#stockLoading'), $error = $('#stockError'),
            $empty = $('#stockEmpty'), $wrap = $('#stockTableWrap'), $body = $('#stockTableBody');
        var buyNow = '{{ addslashes($staticContent['Stock_buy_now'] ?? 'Buy Now') }}';

        $('#stockModalTitle').text(proCode);
        var $region = $('#stockRegion'), $country = $('#stockCountry');
        $region.find('option:not(:first)').remove();
        $country.find('option:not(:first)').remove();
        $region.val('').hide();
        $country.val('').hide();
        $body.empty();
        $error.hide(); $empty.hide(); $wrap.hide();
        $loading.show();
        $('#stockModal').modal('show');

        $.get('{{ route('stockCheck') }}', { code: proCode })
            .done(function (res) {
                $loading.hide();
                if (!res || res.ok !== true) { $error.show(); return; }
                var rows = res.rows || [];
                if (rows.length === 0) { $empty.show(); return; }
                stockCountryMeta = {};
                stockRegionMeta = {};
                rows.forEach(function (r) {
                    var qty = (r.availability === null || r.availability === undefined) ? '' : r.availability;
                    // 僅接受 http(s) 連結當 Buy Now（防 javascript: 等注入）；無連結則改顯示聯絡鈕（mailto 該經銷商）
                    var validUrl = r.buyUrl && /^https?:\/\//i.test(r.buyUrl);
                    var $action = validUrl
                        ? $('<a>').addClass('btn-buy')
                            .attr({ href: r.buyUrl, target: '_blank', rel: 'noopener' }).text(buyNow)
                        : $('<button>').attr('type', 'button').addClass('btn-buy btn-buy-contact')
                            .attr({ 'data-dist-id': r.distributorId || '', 'data-part': r.part || '' })
                            .text(stockContactLabel);
                    // 整理該列的國家 / 洲（去重），並累積到全域 meta 供建立下拉與連動
                    var cCodes = [], rCodes = [];
                    (r.countries || []).forEach(function (c) {
                        if (!c.code) { return; }
                        cCodes.push(c.code);
                        stockCountryMeta[c.code] = { name: c.name || c.code, region: c.region || '' };
                        if (c.region) {
                            if (rCodes.indexOf(c.region) === -1) { rCodes.push(c.region); }
                            if (!stockRegionMeta[c.region]) {
                                stockRegionMeta[c.region] = stockRegionLabels[c.region] || c.regionName || c.region;
                            }
                        }
                    });
                    $('<tr>')
                        .attr('data-countries', cCodes.join(','))
                        .attr('data-regions', rCodes.join(','))
                        .append($('<td>').text(r.part || ''))
                        .append($('<td>').text(r.distributor || ''))
                        .append($('<td>').addClass('stock-availability').text(qty))
                        .append($('<td>').addClass('stock-date').text(r.uploadDate || ''))
                        .append($('<td>').addClass('stock-action').append($action))
                        .appendTo($body);
                });
                // 洲下拉：依在地洲名排序填入（值=洲碼），有 >1 選項才顯示
                Object.keys(stockRegionMeta).sort(function (a, b) {
                    return stockRegionMeta[a].localeCompare(stockRegionMeta[b]);
                }).forEach(function (code) {
                    $region.append($('<option>').val(code).text(stockRegionMeta[code]));
                });
                $region.toggle($region.find('option').length > 1);
                // 國下拉：先列全部國家（選洲後會連動縮窄）
                rebuildStockCountryOptions('');
                $wrap.show();
            })
            .fail(function () {
                $loading.hide();
                $error.show();
            });
    }

    // Modal 關閉時先移除焦點，避免 Bootstrap 把 aria-hidden 套在仍持有焦點的關閉鈕上（無障礙警告）
    $('#stockModal').on('hide.bs.modal', function () {
        if (document.activeElement && typeof document.activeElement.blur === 'function') {
            document.activeElement.blur();
        }
    });

    // 洲 → 國 連動篩選：選洲時重建國家下拉並套用；選國時直接套用
    $('#stockRegion').on('change', function () {
        rebuildStockCountryOptions($(this).val());
        applyStockFilter();
    });
    $('#stockCountry').on('change', function () {
        applyStockFilter();
    });

    // 無購物車連結的聯絡鈕：向後端要該經銷商 email → 開 mailto（主旨帶料號）；拿不到 email / 失敗 → fallback 我方業務支援
    $('#stockTableBody').on('click', '.btn-buy-contact', function () {
        var $btn = $(this);
        var id = $btn.attr('data-dist-id');
        var part = $btn.attr('data-part') || '';
        if (!id) { window.location.href = stockSupportUrl; return; }
        if ($btn.data('loading')) { return; }   // 防連點重複請求
        $btn.data('loading', true);
        $.get(stockContactUrl, { id: id })
            .done(function (res) {
                if (res && res.ok && res.email) {
                    window.location.href = 'mailto:' + res.email + '?subject=' + encodeURIComponent(part);
                } else {
                    window.location.href = stockSupportUrl;   // 經銷商無 email → 我方業務支援
                }
            })
            .fail(function () { window.location.href = stockSupportUrl; })
            .always(function () { $btn.data('loading', false); });
    });
</script>
