<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class CsvRedirectMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // 獲取當前完整URL
        $currentUrl = $request->fullUrl();
        
        // 從緩存或文件中獲取重定向映射
        $redirectMap = $this->getRedirectMap();
        
        // 檢查是否需要重定向
        if (isset($redirectMap[$currentUrl])) {
            $targetUrl = $redirectMap[$currentUrl];
            Log::info("CSV Redirect: {$currentUrl} -> {$targetUrl}");
            return redirect($targetUrl, 301);
        }
        
        return $next($request);
    }
    
    private function getRedirectMap()
    {
        // 直接載入預處理的 PHP 陣列檔案 (超快速)
        $phpPath = storage_path('app/redirect_map.php');
        
        if (!File::exists($phpPath)) {
            Log::warning("PHP redirect map file not found: {$phpPath}. Run 'php artisan redirects:generate' to create it.");
            return [];
        }
        
        try {
            return include $phpPath;
        } catch (\Exception $e) {
            Log::error("Error loading PHP redirect map: " . $e->getMessage());
            return [];
        }
    }
}