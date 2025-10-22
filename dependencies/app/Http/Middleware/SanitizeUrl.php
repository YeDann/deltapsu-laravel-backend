<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SanitizeUrl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // sanitize path segments
        $segments = $request->segments(); // array ของ path segments
        foreach ($segments as $i => $seg) {
            // ลบตัวอักษรแปลก ๆ เช่น script tag หรือ special char
            $segments[$i] = preg_replace('/[^A-Za-z0-9\-_\.]/', '', $seg);
        }

        // rebuild path
        $sanitizedPath = '/' . implode('/', $segments);

        // ถ้ามี query string ก็ sanitize key/value
        $query = [];
        foreach ($request->query() as $k => $v) {
            $safeKey = preg_replace('/[^A-Za-z0-9_\-\.]/', '', $k);
            if (is_array($v)) {
                $safeVal = json_encode($v, JSON_UNESCAPED_UNICODE);
            } else {
                $safeVal = preg_replace('/(alert\s*\(|<script|javascript:)/i', '', (string)$v);
            }
            $query[$safeKey] = $safeVal;
        }

        // สร้าง Request ใหม่แบบ sanitized
        $request->server->set('REQUEST_URI', $sanitizedPath . (!empty($query) ? '?' . http_build_query($query) : ''));

        // Optionally replace path and query parameters in Request object
        $request->server->set('PATH_INFO', $sanitizedPath);
        foreach ($query as $k => $v) {
            $request->query->set($k, $v);
        }

        return $next($request);
    }
}
