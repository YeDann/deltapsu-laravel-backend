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
        // 獲取當前完整URL，normalize scheme 與 /index.php 前綴
        $currentUrl = str_replace('psu.deltaww.com/index.php/', 'psu.deltaww.com/', $request->fullUrl());
        
        // 從緩存或文件中獲取重定向映射
        $redirectMaps = $this->getRedirectMaps();
        
        // 檢查 301 重定向
        if (isset($redirectMaps['301'][$currentUrl])) {
            $targetUrl = $redirectMaps['301'][$currentUrl];
            Log::info("CSV 301 Redirect: {$currentUrl} -> {$targetUrl}");
            return redirect($targetUrl, 301);
        }
        
        // 檢查 410 Gone
        if (isset($redirectMaps['410'][$currentUrl])) {
            Log::info("CSV 410 Gone: {$currentUrl}");
            return response()->view('errors.410', [], 410);
        }
        
        return $next($request);
    }
    
    private function getRedirectMaps()
    {
        // 直接載入預處理的 PHP 陣列檔案 (超快速)
        $phpPath = storage_path('app/redirect_map.php');
        
        if (!File::exists($phpPath)) {
            Log::warning("PHP redirect map file not found: {$phpPath}. Run 'php artisan redirects:generate' to create it.");
            return ['301' => [], '410' => []];
        }
        
        try {
            return include $phpPath;
        } catch (\Exception $e) {
            Log::error("Error loading PHP redirect map: " . $e->getMessage());
            return ['301' => [], '410' => []];
        }
    }
}