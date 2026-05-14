@php
    // 獲取所有啟用的語言
    $languages = DB::table('language')->where('status', 1)->get(['name', 'abbreviation']);
    
    // 語言代碼映射到標準格式
    $langMapping = [
        'en' => 'en',
        'cn' => 'zh-CN',
        'tw' => 'zh-TW', 
        'de' => 'de',
        'jp' => 'ja',
        'tr' => 'tr'
    ];
    
    // 獲取當前URL和語言
    $currentUrl = url()->current();
    $currentLang = app()->getLocale();
@endphp

@foreach($languages as $language)
    @php
        $langCode = $language->name; // name 欄位才是語言代碼 (en, cn, tw 等)
        $hreflangCode = $langMapping[$langCode] ?? $langCode; // 轉換為標準代碼
        
        // 生成該語言的URL（處理 /en/ 中間 和 /en 結尾兩種情況）
        if (preg_match('#/' . preg_quote($currentLang, '#') . '(/|$)#', $currentUrl)) {
            $langUrl = preg_replace(
                '#/' . preg_quote($currentLang, '#') . '(/|$)#',
                '/' . $langCode . '$1',
                $currentUrl
            );
        } else {
            // URL 完全沒有語言前綴，加上語言前綴
            $langUrl = rtrim(config('app.url'), '/') . '/' . $langCode . '/' . ltrim(str_replace(config('app.url'), '', $currentUrl), '/');
        }
    @endphp
    <link rel="alternate" href="{{ $langUrl }}" hreflang="{{ $hreflangCode }}" />
@endforeach

{{-- x-default 指向英文版本 --}}
@php
    if (preg_match('#/' . preg_quote($currentLang, '#') . '(/|$)#', $currentUrl)) {
        $defaultUrl = preg_replace(
            '#/' . preg_quote($currentLang, '#') . '(/|$)#',
            '/en$1',
            $currentUrl
        );
    } else {
        $defaultUrl = rtrim(config('app.url'), '/') . '/en/' . ltrim(str_replace(config('app.url'), '', $currentUrl), '/');
    }
@endphp
<link rel="alternate" href="{{ $defaultUrl }}" hreflang="x-default" />