<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DistributorLabelSeeder extends Seeder
{
    /**
     * Seed the Find-a-Distributor filter UI labels into static_keyword /
     * static_keyword_translations (six locales). Idempotent by key_word.
     *
     * @return void
     */
    public function run()
    {
        // 各語系一律先填英文，實際在地化由後台逐一處理
        $labels = [
            'Sales_Territory'          => 'Sales Territory',
            'Certifications'           => 'Certifications',
            'Specialized_Applications' => 'Specialized Applications',
            'Product_Lines'            => 'Product Lines',
            'Services'                 => 'Services',
            'No_Results'               => 'No matching distributors',
            'Telephone'                => 'Tel',
        ];

        $languages = DB::table('language')->pluck('name')->toArray();

        foreach ($labels as $key => $word) {
            if (!DB::table('static_keyword')->where('key_word', $key)->exists()) {
                DB::table('static_keyword')->insert(['key_word' => $key]);
                echo "Created static_keyword: {$key}\n";
            }
            foreach ($languages as $local) {
                $exists = DB::table('static_keyword_translations')->where('key_word', $key)->where('local', $local)->exists();
                if ($exists) {
                    DB::table('static_keyword_translations')->where('key_word', $key)->where('local', $local)->update(['word' => $word]);
                } else {
                    DB::table('static_keyword_translations')->insert([
                        'key_word' => $key, 'word' => $word, 'local' => $local,
                    ]);
                }
            }
        }
    }
}
