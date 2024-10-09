<?php

namespace App\Http\Middleware;
use DB;
use App;
use Closure;
class VerifyLang

{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // $lang = $request->route('lang'); // Assuming lang is a route parameter
     
         $lang = App::getLocale();

        // // Check if the language exists in the database
        $check_lang = DB::table('language')
            ->where('language.name', '=', $lang)
            ->where('language.status', '=', 1)
            ->first();
        // return dd($check_lang);

        if (!$check_lang) {
            // Redirect to 404 if language does not exist
            abort(404);
        }

        return $next($request);
    }
}