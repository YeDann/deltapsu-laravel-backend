<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ContentSecurityPolicy
{
    public function handle(Request $request, Closure $next)
    {
        // 每個 request 一組 nonce，供 Blade 的 @cspNonce 標記自家 inline <script>。
        // 注意：這個 nonce 目前「刻意不寫進 CSP header」。header 一旦出現 nonce-xxx，
        // 支援 nonce 的瀏覽器就會直接忽略 'unsafe-inline'，屆時所有還沒帶 nonce 的
        // inline script 會被全數擋下。要等全站 inline script 都標記完，才可一併
        // 加入 nonce-xxx 並移除 'unsafe-inline'。
        $nonce = base64_encode(random_bytes(16));
        $request->attributes->set('csp_nonce', $nonce);
        View::share('cspNonce', $nonce);

        $response = $next($request);

        // 本機開發前後台可能用不同 host（localhost / 127.0.0.1），圖片等資產網址寫死 config('app.url')，
        // 跨 host 時會被 CSP 'self' 擋。僅在 local 環境放行這兩個 host（正式站 config url = 正式域名 = 'self'，無需）。
        $dev = app()->environment('local') ? ' http://localhost:8000 http://127.0.0.1:8000' : '';

        $cspDirectives = [
            "default-src 'self'",
            // 已移除 'unsafe-inline'：站內 inline <script> 一律由 @cspNonce 帶上本次請求的 nonce，
            // 事件屬性（onclick 等）已全面改為 data-fn-* 事件委派。白名單網域不受 nonce 影響，照常放行。
            "script-src 'self' 'nonce-{$nonce}' https://*.google.com https://*.googleapis.com https://*.googletagmanager.com https://*.gstatic.com https://cdn.jsdelivr.net https://code.jquery.com https://cdnjs.cloudflare.com https://cookiecdn.com https://snap.licdn.com https://*.youtube.com https://s.ytimg.com https://*.youtube-nocookie.com https://googleads.g.doubleclick.net https://www.googleadservices.com https://sc.lfeeder.com",
            // style-src 暫時保留 'unsafe-inline'：後台所見即所得編輯器產生的 style="" 存在資料庫
            // （約 9400 筆內容），不在程式碼內、無法以 nonce 覆蓋（nonce 對屬性無效）。
            "style-src 'self' 'unsafe-inline' https://cdn.jsdelivr.net",
            "img-src 'self' data:{$dev} https://*.google.com https://*.google.com.tw https://*.googleapis.com https://*.youtube.com https://*.ytimg.com https://*.linkedin.com https://cookiecdn.com https://*.deltapsu.com https://filecenter.deltaww.com https://*.googletagmanager.com https://www.gstatic.com https://*.youtube-nocookie.com https://*.lfeeder.com",
            "font-src 'self' https://filecenter.deltaww.com",
            "object-src 'none'",
            // 擋 <base> 標籤劫持（XSS 常見手法：改寫相對路徑把資源導向攻擊者）。全站沒用 <base>。
            "base-uri 'none'",
            // 表單只能送回本站。全站 form action 都是相對路徑，不影響現有功能。
            "form-action 'self'",
            // 防點擊劫持。不能用 'none'：行銷資源的 PDF 預覽會用同源 iframe 嵌自己的 previewMarketingResource。
            "frame-ancestors 'self'",
            "media-src 'self' blob:{$dev} https://filecenter.deltaww.com https://*.youtube.com https://*.ytimg.com https://*.youtube-nocookie.com https://*.googlevideo.com",
            "frame-src 'self' https://*.youtube.com https://*.google.com https://*.googletagmanager.com https://*.youtube-nocookie.com https://*.googlevideo.com https://*.youku.com https://*.bilibili.com",
            "connect-src 'self'{$dev} https://*.google.com https://*.googleapis.com https://*.googletagmanager.com https://*.gstatic.com https://*.google-analytics.com https://*.doubleclick.net https://*.youtube.com https://*.ytimg.com https://api.cookiewow.com https://*.linkedin.com https://*.googlesyndication.com https://*.youtube-nocookie.com https://*.googlevideo.com"
        ];

        $response->headers->set('Content-Security-Policy', implode('; ', $cspDirectives));
        $response->headers->set('Cache-Control', 'no-store');

        return $response;
    }
}
