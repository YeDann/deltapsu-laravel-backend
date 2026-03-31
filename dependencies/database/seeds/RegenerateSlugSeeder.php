<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegenerateSlugSeeder extends Seeder
{
    /**
     * 重新產生 EOL / Video / Industry Know-How 的 slug
     * 使用與 base Controller::clean() 相同邏輯
     *
     * php artisan db:seed --class=RegenerateSlugSeeder
     */
    public function run()
    {
        $types = ['event', 'eol', 'video', 'industry-know-how'];

        foreach ($types as $type) {
            $contents = DB::table('contents as c')
                ->join('contents_translations as ct', 'ct.content_id', '=', 'c.id')
                ->where('c.content_type', $type)
                ->where('ct.local', 'en')
                ->select('c.id', 'c.slug', 'ct.title')
                ->get();

            $updated = 0;
            foreach ($contents as $item) {
                $re1 = str_replace("/", "_", $item->title);
                $key = str_replace(" ", "-", $re1);
                $newSlug = $this->clean($key);

                if ($newSlug !== $item->slug) {
                    DB::table('contents')
                        ->where('id', $item->id)
                        ->update(['slug' => $newSlug]);

                    $this->command->line("[{$type}] #{$item->id}: {$item->slug} → {$newSlug}");
                    $updated++;
                }
            }

            $this->command->info("[{$type}] 共更新 {$updated} 筆 / 共 " . count($contents) . " 筆");
        }
    }

    protected function clean($text)
    {
        // 與 base Controller::clean() 邏輯相同
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        $text = trim($text, '-');
        $text = strtolower($text);
        $text = preg_replace('~[^-\w]+~', '', $text);

        return empty($text) ? 'n-a' : $text;
    }
}
