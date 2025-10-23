<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SanitizeUrl
{
    /**
     * Allowed pattern for each path segment.
     * ปรับ pattern ตามความต้องการของเว็บคุณ
     */
    protected $segmentPattern = '/^[A-Za-z0-9\-_\.]+$/';

    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // get current path and query
        $path = ltrim($request->getPathInfo(), '/'); // no leading slash
        $segments = $path === '' ? [] : explode('/', $path);

        $sanitizedSegments = [];
        $changed = false;

        foreach ($segments as $seg) {
            // allow only safe characters per segment
            if (preg_match($this->segmentPattern, $seg)) {
                $sanitizedSegments[] = $seg;
            } else {
                // try to sanitize: strip all characters not allowed
                $clean = preg_replace('/[^A-Za-z0-9\-_\.]/', '', $seg);

                // if numeric id expected, you could allow digits only etc.
                // if clean result is empty -> remove segment
                if ($clean === '' ) {
                    // drop it (or you may set to fallback)
                    $changed = true;
                    continue;
                }

                $sanitizedSegments[] = $clean;
                $changed = true;
            }
        }

        // if nothing changed -> continue request normally
        if (! $changed) {
            return $next($request);
        }

        // Rebuild URL
        $newPath = implode('/', $sanitizedSegments);
        $query = $request->getQueryString();
        $newUrl = url($newPath . ($query ? '?' . $query : ''));

         return dd($newUrl,'$newUrl');

        // Safety: ensure hostname is ours
        $host = parse_url(config('app.url') ?: url('/'), PHP_URL_HOST) ?: $request->getHost();
        $newHost = parse_url($newUrl, PHP_URL_HOST);
        if ($newHost !== null && $newHost !== $host) {
            // suspicious -> abort or fallback to root
            return redirect()->to(url('/'))->withStatus(301);
        }

        // Redirect (302) to sanitized URL (so links/bookmarks get corrected)
        return redirect()->to($newUrl, 301);
    }
}
