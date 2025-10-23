<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SanitizeUrl
{
    /**
     * คำที่ถือว่าเป็นอันตรายใน URL (case-insensitive)
     */
    protected $dangerousPatterns = [
        '<script', 'script>', 'alert(', 'onerror=', 'onload=', 'onmouseover=',
        'onclick=', 'javascript:', 'data:text/html', '<iframe', '</iframe>',
        'eval(', 'document.cookie', 'window.location'
    ];

    public function handle(Request $request, Closure $next)
    {
        $path = urldecode($request->getPathInfo());
        $query = urldecode($request->getQueryString() ?? '');

        // รวม path และ query เพื่อเช็คง่าย ๆ
        $fullUrl = strtolower($path . '?' . $query);

        // ตรวจจับคำต้องห้าม
        foreach ($this->dangerousPatterns as $pattern) {
            if (strpos($fullUrl, strtolower($pattern)) !== false) {

                // 🔒 Log กรณีตรวจพบ (optional)
                \Log::warning('Blocked potentially malicious URL', [
                    'url' => $request->fullUrl(),
                    'ip' => $request->ip(),
                ]);

                // 🔥 บล็อกทันที — ป้องกัน XSS
                return response()->view('errors.blocked', [], 400);
            }
        }

        // ปลอดภัย → ผ่านไปต่อ
        return $next($request);
    }
}
