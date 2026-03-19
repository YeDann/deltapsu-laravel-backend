@php
    // 獲取所有啟用的語言
    $languages = DB::table('language')->where('status', 1)->get(['name', 'abbreviation']);
    
    // 獲取當前URL和語言
    $currentUrl = url()->current();
    $currentLang = app()->getLocale();
@endphp

@foreach($languages as $language)
    @php
        $langCode = $language->name; // name 欄位才是語言代碼 (en, cn, tw 等)
        
        // 生成該語言的URL
        $langUrl = str_replace('/' . $currentLang . '/', '/' . $langCode . '/', $currentUrl);
        
        // 如果當前URL沒有語言前綴，則加上語言前綴
        if (!strpos($currentUrl, '/' . $currentLang . '/')) {
            $langUrl = str_replace(config('app.url'), config('app.url') . '/' . $langCode, $currentUrl);
        }
    @endphp
    <link rel="alternate" href="{{ $langUrl }}" hreflang="{{ $langCode }}" />
@endforeach