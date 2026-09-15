<?php

namespace App\Providers;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        //URL::forceScheme('https');

        // 用法：<script @cspNonce> ... </script>，輸出 nonce="xxx"。
        // nonce 由 ContentSecurityPolicy middleware 逐 request 產生。
        // CSP header 已移除 'unsafe-inline'，因此站內 inline <script> 一律要帶上本 directive，
        // 會注入 inline script 的第三方 loader（GTM、reCAPTCHA）也要帶，否則注入的內容會被擋。
        Blade::directive('cspNonce', function () {
            return "<?php echo 'nonce=\"'.e(request()->attributes->get('csp_nonce')).'\"'; ?>";
        });

        // 用法：@cspHead($head)，輸出後台自填的 <head> 內容並補上 nonce。
        // 這些內容（GSC 驗證碼、追蹤碼）存在 DB，不在程式碼內、無法逐一標記，
        // 故於輸出時為沒有 src 也沒有 nonce 的 <script 補上本次請求的 nonce。
        // 信任邊界不變：此欄位本就設計給管理員填任意 head 內容。
        Blade::directive('cspHead', function ($expression) {
            return "<?php echo preg_replace("
                . "'/<script(?![^>]*\\\\bsrc=)(?![^>]*\\\\bnonce=)/i', "
                . "'<script nonce=\"'.e(request()->attributes->get('csp_nonce')).'\"', "
                . "{$expression} ?? ''"
                . "); ?>";
        });
    }
}
