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
            "script-src 'self' 'unsafe-inline' https://*.google.com https://*.googletagmanager.com https://*.gstatic.com https://cdn.jsdelivr.net https://code.jquery.com https://cdnjs.cloudflare.com https://cookiecdn.com https://snap.licdn.com https://*.youtube.com https://s.ytimg.com",
            "style-src 'self' 'unsafe-inline' https://cdn.jsdelivr.net",
            "img-src 'self' data: https://*.youtube.com https://*.ytimg.com https://*.linkedin.com https://cookiecdn.com https://*.deltapsu.com",
            "font-src 'self'",
            "object-src 'none'",
            "media-src 'self' https://*.youtube.com https://*.ytimg.com",
            "frame-src 'self' https://*.youtube.com https://*.google.com https://*.googletagmanager.com",
            "connect-src 'self' https://*.google.com https://*.googletagmanager.com https://*.gstatic.com https://*.google-analytics.com https://*.doubleclick.net https://*.youtube.com https://*.ytimg.com https://api.cookiewow.com https://*.linkedin.com https://*.googlesyndication.com"
        ];

        $response->headers->set('Content-Security-Policy', implode('; ', $cspDirectives));
        $response->headers->set('Cache-Control', 'no-store');

        return $response;
    }
}
