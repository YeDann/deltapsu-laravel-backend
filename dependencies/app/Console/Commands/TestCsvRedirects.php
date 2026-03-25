<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class TestCsvRedirects extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:csv-redirects {--url=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test CSV redirect mappings';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $phpPath = storage_path('app/redirect_map.php');
        
        if (!File::exists($phpPath)) {
            $this->error("PHP redirect map file not found: {$phpPath}");
            return Command::FAILURE;
        }
        
        $redirectMaps = include $phpPath;
        $total301 = count($redirectMaps['301']);
        $total410 = count($redirectMaps['410']);
        $this->info("Loaded {$total301} 301 redirects and {$total410} 410 Gone responses");
        
        // 如果提供了URL參數，檢查特定URL
        if ($url = $this->option('url')) {
            if (isset($redirectMaps['301'][$url])) {
                $this->line("✓ 301 Redirect: {$url} -> {$redirectMaps['301'][$url]}");
            } elseif (isset($redirectMaps['410'][$url])) {
                $this->line("✓ 410 Gone: {$url}");
            } else {
                $this->line("✗ No redirect found for: {$url}");
            }
            return Command::SUCCESS;
        }
        
        // 顯示前10個301重定向映射作為示例
        $this->info("First 10 301 redirect mappings:");
        $count = 0;
        foreach ($redirectMaps['301'] as $source => $target) {
            $this->line("  {$source} -> {$target}");
            if (++$count >= 10) break;
        }
        
        // 顯示前5個410響應作為示例
        $this->info("First 5 410 Gone responses:");
        $count = 0;
        foreach ($redirectMaps['410'] as $source => $value) {
            $this->line("  {$source} -> 410 Gone");
            if (++$count >= 5) break;
        }
        
        return Command::SUCCESS;
    }
    
    private function parseCsvFile($csvPath)
    {
        $redirectMap = [];
        $handle = fopen($csvPath, 'r');
        $lineNumber = 0;
        
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $lineNumber++;
            
            // 跳過標題行和前15行
            if ($lineNumber <= 15) {
                continue;
            }
            
            // 檢查是否為重定向行
            if (isset($data[1]) && isset($data[2]) && 
                strpos($data[1], 'Set 301 redirect to new link') !== false) {
                
                $sourceUrl = trim($data[0]);
                $targetUrl = trim($data[2]);
                
                if (!empty($sourceUrl) && !empty($targetUrl)) {
                    $redirectMap[$sourceUrl] = $targetUrl;
                }
            }
        }
        
        fclose($handle);
        return $redirectMap;
    }
}
