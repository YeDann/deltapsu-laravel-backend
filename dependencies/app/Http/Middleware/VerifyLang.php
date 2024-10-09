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
        $lang = App::getLocale();
        if($lang){
        // Check if the language exists in the database
           $check_lang = DB::table('language')
                    ->where('language.name','=', $lang)
                    ->where('language.status', '=', 1)
                    ->first();
                if (!$check_lang) {
                    App::setLocale('cn');
                    return redirect('/cn/404');
                }
        }
        return $next($request);
    }
}