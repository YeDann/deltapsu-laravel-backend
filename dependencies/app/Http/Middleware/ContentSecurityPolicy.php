<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ContentSecurityPolicy
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // 本機開發前後台可能用不同 host（localhost / 127.0.0.1），圖片等資產網址寫死 config('app.url')，
        // 跨 host 時會被 CSP 'self' 擋。僅在 local 環境放行這兩個 host（正式站 config url = 正式域名 = 'self'，無需）。
        $dev = app()->environment('local') ? ' http://localhost:8000 http://127.0.0.1:8000' : '';

        $cspDirectives = [
            "default-src 'self'",
            "script-src 'self' 'unsafe-inline' https://*.google.com https://*.googleapis.com https://*.googletagmanager.com https://*.gstatic.com https://cdn.jsdelivr.net https://code.jquery.com https://cdnjs.cloudflare.com https://cookiecdn.com https://snap.licdn.com https://*.youtube.com https://s.ytimg.com https://*.youtube-nocookie.com https://googleads.g.doubleclick.net https://www.googleadservices.com https://sc.lfeeder.com",
            "style-src 'self' 'unsafe-inline' https://cdn.jsdelivr.net",
            "img-src 'self' data:{$dev} https://*.google.com https://*.google.com.tw https://*.googleapis.com https://*.youtube.com https://*.ytimg.com https://*.linkedin.com https://cookiecdn.com https://*.deltapsu.com https://filecenter.deltaww.com https://*.googletagmanager.com https://www.gstatic.com https://*.youtube-nocookie.com https://*.lfeeder.com",
            "font-src 'self' https://filecenter.deltaww.com",
            "object-src 'none'",
            "media-src 'self' blob:{$dev} https://filecenter.deltaww.com https://*.youtube.com https://*.ytimg.com https://*.youtube-nocookie.com https://*.googlevideo.com",
            "frame-src 'self' https://*.youtube.com https://*.google.com https://*.googletagmanager.com https://*.youtube-nocookie.com https://*.googlevideo.com https://*.youku.com https://*.bilibili.com",
            "connect-src 'self'{$dev} https://*.google.com https://*.googleapis.com https://*.googletagmanager.com https://*.gstatic.com https://*.google-analytics.com https://*.doubleclick.net https://*.youtube.com https://*.ytimg.com https://api.cookiewow.com https://*.linkedin.com https://*.googlesyndication.com https://*.youtube-nocookie.com https://*.googlevideo.com"
        ];

        $response->headers->set('Content-Security-Policy', implode('; ', $cspDirectives));
        $response->headers->set('Cache-Control', 'no-store');

        return $response;
    }
}
