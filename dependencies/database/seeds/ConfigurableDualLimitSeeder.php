<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigurableDualLimitSeeder extends Seeder
{
    /**
     * Seed Configurable Power Selector 的 Dual Output 數上限說明文字（模板，含 {frame}/{n} placeholder）
     * 到 static_keyword / static_keyword_translations，6 語系。前端取出後以當前 frame 名與上限數替換。
     *
     * @return void
     */
    public function run()
    {
        // 模板含 {frame}（frame 名，如 MEG-3K0A）與 {n}（該 frame dual output 上限）placeholder，前端帶入
        $keywords = [
            'configurable_dual_limit_desc' => [
                'en' => 'The maximum number of dual output modules that can be installed in a single {frame} frame is {n} slots.',
                'de' => 'The maximum number of dual output modules that can be installed in a single {frame} frame is {n} slots.',
                'tw' => '{frame}機殼可安裝的雙輸出模組數量上限為 {n} 槽。',
                'cn' => '{frame}机壳可安装的双输出模块数量上限为 {n} 槽。',
                'jp' => '1基の{frame}フレームに搭載可能なデュアル出力モジュールの最大数は {n} スロットです。',
                'tr' => 'Tek bir {frame} ürününe takılabilecek maksimum çift çıkışlı modül sayısı {n} slottur.',
            ],
        ];

        $languages = DB::table('language')->get();

        foreach ($keywords as $key => $translations) {
            // 主表：key_word 不存在才新增
            if (!DB::table('static_keyword')->where('key_word', $key)->exists()) {
                DB::table('static_keyword')->insert(['key_word' => $key]);
                echo "Created static_keyword: {$key}\n";
            }

            // 翻譯表：每個語系補一筆（已存在則略過），缺對應字串 fallback en
            foreach ($languages as $language) {
                $local = $language->name;
                $word = $translations[$local] ?? $translations['en'];

                $exists = DB::table('static_keyword_translations')
                    ->where('key_word', $key)
                    ->where('local', $local)
                    ->exists();

                if (!$exists) {
                    DB::table('static_keyword_translations')->insert([
                        'key_word' => $key,
                        'word' => $word,
                        'local' => $local,
                    ]);
                    echo "Created translation: {$key} [{$local}]\n";
                }
            }
        }
    }
}
