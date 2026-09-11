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
        // 現階段 CSP header 還沒放 nonce-xxx，所以這個屬性只是先標記、不影響行為；
        // 等全站 inline script 標記完，才會把 nonce 寫進 header 並移除 'unsafe-inline'。
        Blade::directive('cspNonce', function () {
            return "<?php echo 'nonce=\"'.e(request()->attributes->get('csp_nonce')).'\"'; ?>";
        });
    }
}
