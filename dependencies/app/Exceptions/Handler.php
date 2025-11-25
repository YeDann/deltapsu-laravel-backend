<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     */
    public function report(\Throwable $exception): void
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  Request  $request
     */
    public function render($request, \Throwable $exception)
    {
        if ($exception instanceof TokenMismatchException) {
            return redirect('/backend/login')
                ->with('flash_message', 'The session has expired. Please try again.');
        }

        if ($this->isHttpException($exception) && 404 == $exception->getStatusCode()) {
            $lang = App::getLocale();
            $cacheDuration = 60;

            $language = Cache::remember(
                "language_{$lang}",
                $cacheDuration,
                fn () => DB::table('language')
                    ->where('status', 1)
                    ->orderBy('order_seq', 'asc')
                    ->get()
            );

            $navCategories = Cache::remember("navcategories_{$lang}", $cacheDuration, function () use ($lang) {
                return DB::table('categories_has_main_pro as chmp')
                    ->join('sub_pro_categories as sc', 'chmp.cate_id', '=', 'sc.sub_pro_id')
                    ->join('sub_pro_categories_translation as sct', 'sct.sub_pro_id', '=', 'sc.sub_pro_id')
                    ->select('sc.*', 'sct.*', 'chmp.*')
                    ->where('sct.local', $lang)
                    ->orderBy('chmp.order_seq', 'asc')
                    ->get();
            });

            $categoriesByMain = collect([1, 2, 3, 4])->mapWithKeys(function ($id) use ($lang, $cacheDuration) {
                $cacheKey = "navcategories{$id}_{$lang}";

                return [
                    $id => Cache::remember($cacheKey, $cacheDuration, function () use ($lang, $id) {
                        return DB::table('categories_has_main_pro as chmp')
                            ->join('sub_pro_categories as sc', 'chmp.cate_id', '=', 'sc.sub_pro_id')
                            ->join('sub_pro_categories_translation as sct', 'sct.sub_pro_id', '=', 'sc.sub_pro_id')
                            ->select('sc.*', 'sct.*', 'chmp.*')
                            ->where('sct.local', $lang)
                            ->where('chmp.main_cateid', $id)
                            ->orderBy('chmp.order_seq', 'asc')
                            ->get();
                    }),
                ];
            });

            $navApplication = Cache::remember("navapplication_{$lang}", $cacheDuration, function () use ($lang) {
                return DB::table('application as ap')
                    ->join('application_translation as apt', 'ap.id', '=', 'apt.app_id')
                    ->where('apt.local', $lang)
                    ->select('ap.*', 'ap.id as applica_id', 'apt.name', 'apt.content', 'apt.overview')
                    ->orderBy('ap.order_seq', 'asc')
                    ->get();
            });

            $navAboutUs = Cache::remember("navaboutus_{$lang}", $cacheDuration, function () use ($lang) {
                return DB::table('about_us as au')
                    ->join('about_us_translations as aut', 'au.id', '=', 'aut.abt_id')
                    ->where('aut.local', '=', $lang)
                    ->select('au.*', 'aut.*')
                    ->get();
            });

            $countryEmails = Cache::remember("countryemails_{$lang}", $cacheDuration, function () {
                return DB::table('email_notification')
                    ->where('type', 1)
                    ->orderBy('country', 'asc')
                    ->get();
            });

            $mailChimpCountry = Cache::remember("mail_chimp_country_{$lang}", $cacheDuration, function () {
                return DB::table('mail_chimp_country')
                    ->orderBy('name', 'asc')
                    ->get();
            });

            $staticWordCache = Cache::remember("static_word_{$lang}", $cacheDuration, function () use ($lang) {
                return DB::table('static_keyword as w')
                    ->join('static_keyword_translations as skt', 'skt.key_word', '=', 'w.key_word')
                    ->select('w.*', 'skt.*')
                    ->where('skt.local', $lang)
                    ->get();
            });

            if ($staticWordCache->isEmpty()) {
                $staticWordCache = Cache::remember('static_word_en', $cacheDuration, function () {
                    return DB::table('static_keyword as w')
                        ->join('static_keyword_translations as skt', 'skt.key_word', '=', 'w.key_word')
                        ->select('w.*', 'skt.*')
                        ->where('skt.local', 'en')
                        ->get();
                });
            }

            $wordArray = $staticWordCache->pluck('word', 'key_word')->all();

            view()->share('mail_chimp_country', $mailChimpCountry);

            return response()->view('errors.404', [
                'staticContent' => $wordArray,
                'mail_chimp_country' => $mailChimpCountry,
                'countryemails' => $countryEmails,
                'navaboutus' => $navAboutUs,
                'navcategories4' => $categoriesByMain[4] ?? [],
                'navcategories3' => $categoriesByMain[3] ?? [],
                'navcategories2' => $categoriesByMain[2] ?? [],
                'navcategories1' => $categoriesByMain[1] ?? [],
                'navapplication' => $navApplication,
                'navcategories' => $navCategories,
                'language' => $language,
            ], 404);
        }

        return parent::render($request, $exception);
    }
}
