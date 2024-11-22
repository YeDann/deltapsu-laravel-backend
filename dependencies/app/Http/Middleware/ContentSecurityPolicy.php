<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ContentSecurityPolicy
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        //UAT
        $cspDirectives = [
            "default-src 'self';",
            "script-src 'self' 'unsafe-inline' https://hcaptcha.com https://cookiecdn.com https://code.jquery.com https://www.googletagmanager.com https://cdnjs.cloudflare.com https://cdn.jsdelivr.net https://www.google.com https://www.gstatic.com;",
            "img-src 'self' data:;",
            "object-src 'none';",
            "style-src 'self' 'unsafe-inline';",
            "font-src 'self';",
            "media-src 'none';",
            "frame-src 'self' https://www.youtube.com https://www.googletagmanager.com https://www.google.com;",
            "connect-src 'self' https://104.42.107.127 https://www.google.com https://www.googletagmanager.com https://www.gstatic.com https://www.google-analytics.com https://pagead2.googlesyndication.com;",
        ];

        //PRODUCTION CN


        $response->headers->set('Content-Security-Policy', implode('; ', $cspDirectives));
        $response->headers->set('X-Content-Security-Policy', implode('; ', $cspDirectives));
        $response->headers->set('X-WebKit-CSP', implode('; ', $cspDirectives));

        return $response;
    }
}
