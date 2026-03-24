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
        
        // 生成該語言的URL
        $langUrl = str_replace('/' . $currentLang . '/', '/' . $langCode . '/', $currentUrl);
        
        // 如果當前URL沒有語言前綴，則加上語言前綴
        if (!strpos($currentUrl, '/' . $currentLang . '/')) {
            $langUrl = str_replace(config('app.url'), config('app.url') . '/' . $langCode, $currentUrl);
        }
    @endphp
    <link rel="alternate" href="{{ $langUrl }}" hreflang="{{ $hreflangCode }}" />
@endforeach

{{-- x-default 指向英文版本 --}}
@php
    $defaultUrl = str_replace('/' . $currentLang . '/', '/en/', $currentUrl);
    if (!strpos($currentUrl, '/' . $currentLang . '/')) {
        $defaultUrl = str_replace(config('app.url'), config('app.url') . '/en', $currentUrl);
    }
@endphp
<link rel="alternate" href="{{ $defaultUrl }}" hreflang="x-default" />