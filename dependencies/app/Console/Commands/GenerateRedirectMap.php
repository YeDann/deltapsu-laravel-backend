<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GenerateRedirectMap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'redirects:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate redirect map from CSV file to PHP array for faster loading';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $csvPath = storage_path('app/psu.deltaww.csv');
        $phpPath = storage_path('app/redirect_map.php');
        
        if (!File::exists($csvPath)) {
            $this->error("CSV file not found: {$csvPath}");
            return Command::FAILURE;
        }
        
        $this->info("Parsing CSV file...");
        $redirectMaps = $this->parseCsvFile($csvPath);
        
        $this->info("Generating PHP array file...");
        $phpContent = "<?php\n\n// Auto-generated redirect map from CSV\n// Generated at: " . date('Y-m-d H:i:s') . "\n\nreturn " . var_export($redirectMaps, true) . ";\n";
        
        File::put($phpPath, $phpContent);
        
        $total301 = count($redirectMaps['301']);
        $total410 = count($redirectMaps['410']);
        $this->info("Generated {$phpPath} with {$total301} 301 redirects and {$total410} 410 Gone responses");
        $this->info("File size: " . $this->humanFilesize(File::size($phpPath)));
        
        return Command::SUCCESS;
    }
    
    private function parseCsvFile($csvPath)
    {
        $redirectMaps = [
            '301' => [],
            '410' => []
        ];
        
        $handle = fopen($csvPath, 'r');
        $lineNumber = 0;
        
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $lineNumber++;
            
            if ($lineNumber <= 15) {
                continue;
            }
            
            $sourceUrl = trim($data[0] ?? '');
            $instruction = trim($data[1] ?? '');
            $targetUrl = trim($data[2] ?? '');
            
            // 處理 301 重定向
            if (strpos($instruction, 'Set 301 redirect to new link') !== false) {
                if (!empty($sourceUrl) && !empty($targetUrl)) {
                    $redirectMaps['301'][$sourceUrl] = $targetUrl;
                }
            }
            
            // 處理 410 Gone
            if (strpos($instruction, 'Set 410') !== false && strpos($instruction, 'Gone') !== false) {
                if (!empty($sourceUrl)) {
                    $redirectMaps['410'][$sourceUrl] = true;
                }
            }
        }
        
        fclose($handle);
        return $redirectMaps;
    }
    
    private function humanFilesize($size, $precision = 2) {
        $units = array('B','kB','MB','GB','TB','PB','EB','ZB','YB');
        for ($i = 0; $size >= 1024 && $i < count($units) - 1; $i++) {
            $size /= 1024;
        }
        return round($size, $precision) . ' ' . $units[$i];
    }
}
