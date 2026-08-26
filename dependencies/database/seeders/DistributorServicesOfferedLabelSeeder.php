<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DistributorServicesOfferedLabelSeeder extends Seeder
{
    /**
     * 補上經銷商卡片「Services Offered」標題的靜態字。
     * blade（find-distributor.blade.php）讀的是 key `Services_Offered`，而既有
     * DistributorLabelSeeder 只建了 `Services`（左側篩選用），兩者語意不同需分開。
     * 各語系一律先填英文，實際在地化由後台逐一處理。Idempotent by key_word + local。
     *
     * @return void
     */
    public function run()
    {
        $key  = 'Services_Offered';
        $word = 'Services Offered';

        if (!DB::table('static_keyword')->where('key_word', $key)->exists()) {
            DB::table('static_keyword')->insert(['key_word' => $key]);
            echo "Created static_keyword: {$key}\n";
        }

        $languages = DB::table('language')->pluck('name')->toArray();

        foreach ($languages as $local) {
            $exists = DB::table('static_keyword_translations')
                ->where('key_word', $key)->where('local', $local)->exists();
            if ($exists) {
                DB::table('static_keyword_translations')
                    ->where('key_word', $key)->where('local', $local)
                    ->update(['word' => $word]);
            } else {
                DB::table('static_keyword_translations')->insert([
                    'key_word' => $key, 'word' => $word, 'local' => $local,
                ]);
            }
        }

        echo "Seeded label '{$key}' for locales: " . implode(',', $languages) . "\n";
    }
}
