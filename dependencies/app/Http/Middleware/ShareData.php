<?php
namespace App\Http\Middleware;

use Closure;
use DB;
use App;
use Illuminate\Support\Facades\Cache;
class ShareData
{
    public function handle($request, Closure $next)
    {
        $lang = App::getLocale(); // หรืออาจจะได้จาก $request ก็ได้

        // แบ่งปันข้อมูลภาษา
      
        $cacheDuration = 60; // ระยะเวลาแคชในนาที


        $cacheKeylanguages = 'language_' . $lang;
        $language = Cache::remember($cacheKeylanguages, $cacheDuration, function () use ($lang) {
            return DB::table("language")->where('status', 1)->orderBy('order_seq', 'asc')->get();
        });
        view()->share('language', $language);



        // Cache navcategories
        $cacheKeyNavCategories = 'navcategories_' . $lang;
        $navCategories = Cache::remember($cacheKeyNavCategories, $cacheDuration, function () use ($lang) {
            return DB::table('categories_has_main_pro as chmp')
                ->join('sub_pro_categories as sc', 'chmp.cate_id', '=', 'sc.sub_pro_id')
                ->join('sub_pro_categories_translation as sct', 'sct.sub_pro_id', '=', 'sc.sub_pro_id')
                ->select('sc.*', 'sct.*', 'chmp.*')
                ->where('sct.local', $lang)
                ->orderBy('chmp.order_seq', 'asc')
                ->get();
        });
        view()->share('navcategories', $navCategories);

        // Cache navapplication
        // 應用領域 (Applications) 的下拉選單
        $cacheKeyNavApplication = 'navapplication_' . $lang;
        $navApplication = Cache::remember($cacheKeyNavApplication, $cacheDuration, function () use ($lang) {
            return DB::table('application as ap')
                ->join('application_translation as apt', 'ap.id', '=', 'apt.app_id')
                ->where('apt.local', $lang)
                ->select('ap.*', 'ap.id as applica_id', 'apt.name', 'apt.content', 'apt.overview')
                ->orderBy('ap.order_seq', 'asc')
                ->get();
        });
        view()->share('navapplication', $navApplication);

        // Cache navcategories1
        // 醫療電源（Medical_Power_Supplies）的下拉選單
        $cacheKeyNavCategories1 = 'navcategories1_' . $lang;
        $navCategories1 = Cache::remember($cacheKeyNavCategories1, $cacheDuration, function () use ($lang) {
            return DB::table('categories_has_main_pro as chmp')
                ->join('sub_pro_categories as sc', 'chmp.cate_id', '=', 'sc.sub_pro_id')
                ->join('sub_pro_categories_translation as sct', 'sct.sub_pro_id', '=', 'sc.sub_pro_id')
                ->select('sc.*', 'sct.*', 'chmp.*')
                ->where('sct.local', $lang)
                ->where('chmp.main_cateid', 1)
                ->orderBy('chmp.order_seq', 'asc')
                ->get();
        });
        view()->share('navcategories1', $navCategories1);

        // Cache navcategories2
        // 工業電源及模組（Industrial_Power_Supplies_&_Modules）的下拉選單
        $cacheKeyNavCategories2 = 'navcategories2_' . $lang;
        $navCategories2 = Cache::remember($cacheKeyNavCategories2, $cacheDuration, function () use ($lang) {
            return DB::table('categories_has_main_pro as chmp')
                ->join('sub_pro_categories as sc', 'chmp.cate_id', '=', 'sc.sub_pro_id')
                ->join('sub_pro_categories_translation as sct', 'sct.sub_pro_id', '=', 'sc.sub_pro_id')
                ->select('sc.*', 'sct.*', 'chmp.*')
                ->where('sct.local', $lang)
                ->where('chmp.main_cateid', 2)
                ->orderBy('chmp.order_seq', 'asc')
                ->get();
        });
        view()->share('navcategories2', $navCategories2);

        // Cache navcategories3
        // LED驅動器（LED_Driver）的下拉選單
        $cacheKeyNavCategories3 = 'navcategories3_' . $lang;
        $navCategories3 = Cache::remember($cacheKeyNavCategories3, $cacheDuration, function () use ($lang) {
            return DB::table('categories_has_main_pro as chmp')
                ->join('sub_pro_categories as sc', 'chmp.cate_id', '=', 'sc.sub_pro_id')
                ->join('sub_pro_categories_translation as sct', 'sct.sub_pro_id', '=', 'sc.sub_pro_id')
                ->select('sc.*', 'sct.*', 'chmp.*')
                ->where('sct.local', $lang)
                ->where('chmp.main_cateid', 3)
                ->orderBy('chmp.order_seq', 'asc')
                ->get();
        });
        view()->share('navcategories3', $navCategories3);

        // Cache navcategories4
        // 工業電池充電（Industrial_Battery_Charging）的下拉選單
        $cacheKeyNavCategories4 = 'navcategories4_' . $lang;
        $navCategories4 = Cache::remember($cacheKeyNavCategories4, $cacheDuration, function () use ($lang) {
            return DB::table('categories_has_main_pro as chmp')
                ->join('sub_pro_categories as sc', 'chmp.cate_id', '=', 'sc.sub_pro_id')
                ->join('sub_pro_categories_translation as sct', 'sct.sub_pro_id', '=', 'sc.sub_pro_id')
                ->select('sc.*', 'sct.*', 'chmp.*')
                ->where('sct.local', $lang)
                ->where('chmp.main_cateid', 4)
                ->orderBy('chmp.order_seq', 'asc')
                ->get();
        });

        view()->share('navcategories4', $navCategories4);

        // Cache navaboutus
        $cacheKeyNavAboutUs = 'navaboutus_' . $lang;
        $navAboutUs = Cache::remember($cacheKeyNavAboutUs, $cacheDuration, function () use ($lang) {
            return DB::table('about_us as au')
                ->join('about_us_translations as aut', 'au.id', '=', 'aut.abt_id')
                ->where('aut.local', '=', $lang)
                ->select('au.*', 'aut.*')
                ->get();
        });
        view()->share('navaboutus', $navAboutUs);

        // Cache countryemails
        $cacheKeyCountryEmails = 'countryemails_' . $lang;
        $countryEmails = Cache::remember($cacheKeyCountryEmails, $cacheDuration, function () {
            return DB::table('email_notification as et')
                ->select('et.*')
                ->where('et.type', 1)
                ->orderBy('et.country', 'asc')
                ->get();
        });
        view()->share('countryemails', $countryEmails);

        // Cache mail_chimp_country
        $cacheKeyMailChimpCountry = 'mail_chimp_country_' . $lang;
        $mailChimpCountry = Cache::remember($cacheKeyMailChimpCountry, $cacheDuration, function () {
            return DB::table('mail_chimp_country as mc')
                ->select('mc.*')
                ->orderBy('mc.name', 'asc')
                ->get();
        });
        view()->share('mail_chimp_country', $mailChimpCountry);

        // Cache static_word
        // 取得 靜態關鍵字 與 翻譯
        $cacheKeyStaticWord = 'static_word_' . $lang;
        $staticWordCache = Cache::remember($cacheKeyStaticWord, $cacheDuration, function () use ($lang) {
            return DB::table('static_keyword as w')
                ->join('static_keyword_translations as skt', 'skt.key_word', '=', 'w.key_word')
                ->select('w.*', 'skt.*')
                ->where('skt.local', $lang)
                ->get();
        });

        // 如果沒有找到對應語言的靜態關鍵字，則用英文
        if (count($staticWordCache) == 0) {
            $cacheKeyStaticWordEn = 'static_word_en';
            $staticWordCache = Cache::remember($cacheKeyStaticWordEn, $cacheDuration, function () {
                return DB::table('static_keyword as w')
                    ->join('static_keyword_translations as skt', 'skt.key_word', '=', 'w.key_word')
                    ->select('w.*', 'skt.*')
                    ->where('skt.local', 'en')
                    ->get();
            });
        }

        // 將靜態關鍵字轉換為關聯陣列，方便在視圖中使用
        $wordArray = [];
        foreach ($staticWordCache as $word) {
            $wordArray[$word->key_word] = $word->word;
        }

        view()->share('staticContent', $wordArray);

        $newsTypes = DB::table('news_type as nt')
            ->join('news_type_translation as ntt', 'ntt.fk_nt_id', '=', 'nt.id')
            ->select('nt.*', 'ntt.title as typename')
            ->where('ntt.local', $lang)
            ->orderBy('nt.order_seq', 'asc')
            ->get()
            ->keyBy('name');
        view()->share('newsTypes', $newsTypes);

        $logo_url = "https://www.deltaww.com";

        // Logo鏈結
        switch (strtoupper($lang)) {
            case 'SC':
                $logo_url = "https://www.deltaww.com/zh-TW/index";
                break;
            case 'TC':
                $logo_url = "https://www.deltaww.com/zh-TW/index";
                break;
            case 'DE':
                $logo_url = "https://www.delta-emea.com/de-DE/index";
                break;
            case 'JR':
                $logo_url = "https://www.delta-japan.jp/ja-JP/index";
                break;
            case 'TR':
                $logo_url = "https://www.deltaww.com/en-US/index";
                break;
            default:
                break;
        }

        view()->share('logoUrl', $logo_url);

        return $next($request);
    }
}

?>
