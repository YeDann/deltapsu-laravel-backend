<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ContentSecurityPolicy
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

       $cspDirectives = [
            "default-src 'self'",
            "script-src 'self' 'unsafe-inline' https://cookiecdn.com https://code.jquery.com https://www.googletagmanager.com https://analytics.google.com https://cdnjs.cloudflare.com https://cdn.jsdelivr.net https://www.google.com https://www.gstatic.com https://snap.licdn.com",
            "img-src 'self' data: https://px.ads.linkedin.com https://cookiecdn.com https://deltapsu.com https://www.deltapsu.com https://psu.deltaww.com",
            "object-src 'none'",
            "style-src 'self' 'unsafe-inline' https://cdn.jsdelivr.net",
            "font-src 'self'",
            "media-src 'none'",
            "frame-src 'self' https://www.youtube.com https://www.googletagmanager.com https://www.google.com https://analytics.google.com",
            "connect-src 'self' https://api.cookiewow.com https://www.google.com https://www.googletagmanager.com  https://www.gstatic.com https://analytics.google.com https://www.google-analytics.com https://pagead2.googlesyndication.com https://px.ads.linkedin.com https://www.youtube.com https://img.youtube.com https://stats.g.doubleclick.net https://i.ytimg.com"
        ];

        $response->headers->set('Content-Security-Policy', implode('; ', $cspDirectives));
        $response->headers->set('Cache-Control', 'no-store');


        return $response;
    }
}
