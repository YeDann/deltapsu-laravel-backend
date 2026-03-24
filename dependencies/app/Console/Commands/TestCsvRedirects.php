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
        $csvPath = storage_path('app/psu.deltaww.csv');
        
        if (!File::exists($csvPath)) {
            $this->error("CSV file not found: {$csvPath}");
            return Command::FAILURE;
        }
        
        $redirectMap = $this->parseCsvFile($csvPath);
        $this->info("Loaded " . count($redirectMap) . " redirect mappings");
        
        // 如果提供了URL參數，檢查特定URL
        if ($url = $this->option('url')) {
            if (isset($redirectMap[$url])) {
                $this->line("✓ {$url} -> {$redirectMap[$url]}");
            } else {
                $this->line("✗ No redirect found for: {$url}");
            }
            return Command::SUCCESS;
        }
        
        // 顯示前10個重定向映射作為示例
        $this->info("First 10 redirect mappings:");
        $count = 0;
        foreach ($redirectMap as $source => $target) {
            $this->line("  {$source} -> {$target}");
            if (++$count >= 10) break;
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
