<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;

class ModifyRedirects
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
        $response = $next($request);

        if ($response instanceof RedirectResponse) {
            // 只對「GET 請求、且非導向登入頁」的轉址套 301（前台 SEO 正規化用）。
            // POST/AJAX 與導向 login 的轉址一律維持原狀態碼（通常 302）——否則 302→301 會被
            // 瀏覽器永久快取，導致表單/AJAX（如行銷資源縮圖上傳）被永久卡在導向 login。
            $isLoginRedirect = false !== strpos($response->getTargetUrl(), '/login');
            if ($request->isMethod('GET') && ! $isLoginRedirect) {
                $response->setStatusCode(301);
            }
        }

        return $response;
    }
}
