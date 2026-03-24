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
        $redirectMap = $this->parseCsvFile($csvPath);
        
        $this->info("Generating PHP array file...");
        $phpContent = "<?php\n\n// Auto-generated redirect map from CSV\n// Generated at: " . date('Y-m-d H:i:s') . "\n\nreturn " . var_export($redirectMap, true) . ";\n";
        
        File::put($phpPath, $phpContent);
        
        $this->info("Generated {$phpPath} with " . count($redirectMap) . " redirects");
        $this->info("File size: " . $this->humanFilesize(File::size($phpPath)));
        
        return Command::SUCCESS;
    }
    
    private function parseCsvFile($csvPath)
    {
        $redirectMap = [];
        $handle = fopen($csvPath, 'r');
        $lineNumber = 0;
        
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $lineNumber++;
            
            if ($lineNumber <= 15) {
                continue;
            }
            
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
    
    private function humanFilesize($size, $precision = 2) {
        $units = array('B','kB','MB','GB','TB','PB','EB','ZB','YB');
        for ($i = 0; $size >= 1024 && $i < count($units) - 1; $i++) {
            $size /= 1024;
        }
        return round($size, $precision) . ' ' . $units[$i];
    }
}
