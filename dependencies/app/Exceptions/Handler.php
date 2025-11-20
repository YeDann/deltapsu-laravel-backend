<?php

namespace App\Exceptions;

use DB;
use App;
use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof TokenMismatchException) {
            return redirect('/backend/login')->with('flash_message', 'The session has expired. Please try again.');
        }

        if ($this->isHttpException($exception)) {
            if (404 == $exception->getStatusCode()) {
                $lang = App::getLocale();
                $cacheDuration = 60; // ระยะเวลาแคชในนาที

                $cacheKeylanguages = 'language_' . $lang;
                $language = Cache::remember($cacheKeylanguages, $cacheDuration, function () {
                    return DB::table('language')->where('status', 1)->orderBy('order_seq', 'asc')->get();
                });

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

                // Cache navapplication
                $cacheKeyNavApplication = 'navapplication_' . $lang;
                $navApplication = Cache::remember($cacheKeyNavApplication, $cacheDuration, function () use ($lang) {
                    return DB::table('application as ap')
                    ->join('application_translation as apt', 'ap.id', '=', 'apt.app_id')
                    ->where('apt.local', $lang)
                    ->select('ap.*', 'ap.id as applica_id', 'apt.name', 'apt.content', 'apt.overview')
                    ->orderBy('ap.order_seq', 'asc')
                    ->get();
                });

                // Cache navcategories1
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

                // Cache navcategories2
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

                // Cache navcategories3
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

                // Cache navcategories4
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

                // Cache navaboutus
                $cacheKeyNavAboutUs = 'navaboutus_' . $lang;
                $navAboutUs = Cache::remember($cacheKeyNavAboutUs, $cacheDuration, function () use ($lang) {
                    return DB::table('about_us as au')
                    ->join('about_us_translations as aut', 'au.id', '=', 'aut.abt_id')
                    ->where('aut.local', '=', $lang)
                    ->select('au.*', 'aut.*')
                    ->get();
                });

                // Cache countryemails
                $cacheKeyCountryEmails = 'countryemails_' . $lang;
                $countryEmails = Cache::remember($cacheKeyCountryEmails, $cacheDuration, function () {
                    return DB::table('email_notification as et')
                    ->select('et.*')
                    ->where('et.type', 1)
                    ->orderBy('et.country', 'asc')
                    ->get();
                });

                // Cache mail_chimp_country
                $cacheKeyMailChimpCountry = 'mail_chimp_country_' . $lang;
                $mailChimpCountry = Cache::remember($cacheKeyMailChimpCountry, $cacheDuration, function () {
                    return DB::table('mail_chimp_country as mc')
                    ->select('mc.*')
                    ->orderBy('mc.name', 'asc')
                    ->get();
                });

                // Cache static_word
                $cacheKeyStaticWord = 'static_word_' . $lang;
                $staticWordCache = Cache::remember($cacheKeyStaticWord, $cacheDuration, function () use ($lang) {
                    return DB::table('static_keyword as w')
                    ->join('static_keyword_translations as skt', 'skt.key_word', '=', 'w.key_word')
                    ->select('w.*', 'skt.*')
                    ->where('skt.local', $lang)
                    ->get();
                });

                if (0 == count($staticWordCache)) {
                    $cacheKeyStaticWordEn = 'static_word_en';
                    $staticWordCache = Cache::remember($cacheKeyStaticWordEn, $cacheDuration, function () {
                        return DB::table('static_keyword as w')
                        ->join('static_keyword_translations as skt', 'skt.key_word', '=', 'w.key_word')
                        ->select('w.*', 'skt.*')
                        ->where('skt.local', 'en')
                        ->get();
                    });
                }

                $wordArray = [];
                foreach ($staticWordCache as $word) {
                    $wordArray[$word->key_word] = $word->word;
                }

                view()->share('mail_chimp_country', $mailChimpCountry);

                return response()->view(
                    'errors.' . '404',
                    [
                        'staticContent' => $wordArray,
                        'mail_chimp_country' => $mailChimpCountry,
                        'countryemails' => $countryEmails,
                        'navaboutus' => $navAboutUs,
                        'navcategories4' => $navCategories4,
                        'navcategories3' => $navCategories3,
                        'navcategories2' => $navCategories2,
                        'navcategories1' => $navCategories1,
                        'navapplication' => $navApplication,
                        'navcategories' => $navCategories,
                        'language' => $language,
                    ],
                    404
                );
            }
        }

        return parent::render($request, $exception);
    }
}
