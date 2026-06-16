<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StockModalCopyFixSeeder extends Seeder
{
    /**
     * copy fixes for the Stock-checking Modal:
     *   1. Rename first-column header key Stock_model_number → Stock_model_name ("Model Name").
     *   2. Update footer copy Stock_sales_support → "For other purchasing options or sales support:".
     *
     * Both keys were already seeded by StockModalKeywordSeeder (insert-only),
     * so these changes can't be applied by editing it.
     *
     * 防呆（不洗掉後台改過的值，可重複執行）：
     *   - 改名只在舊 key 仍存在時搬一次；新 key 用 insert-if-not-exists。
     *   - footer 只把「仍是舊預設值」那筆換成新值；後台改過的、已是新值的、不存在的各自略過/補。
     *
     * @return void
     */
    public function run()
    {
        $languages = DB::table('language')->get();

        // 1) 表頭改名 Stock_model_number → Stock_model_name（防呆：舊 key 還在才搬一次）
        if (DB::table('static_keyword')->where('key_word', 'Stock_model_number')->exists()) {
            DB::table('static_keyword_translations')->where('key_word', 'Stock_model_number')->delete();
            DB::table('static_keyword')->where('key_word', 'Stock_model_number')->delete();

            $this->insertKeywordIfMissing('Stock_model_name', [
                'en' => 'Model Name',
                'tw' => '型名',
                'cn' => '型名',
                'de' => 'Modellname',
                'jp' => '型名',
                'tr' => 'Model Adı',
            ], $languages);

            echo "Renamed Stock_model_number → Stock_model_name\n";
        }

        // 2) footer 文案：[舊預設值 → 新值]，只換仍是舊預設值的那筆
        $this->replaceWordIfOldDefault('Stock_sales_support', [
            'en' => ['For other buy options / Sales support', 'For other purchasing options or sales support:'],
            'tw' => ['其他購買選項 / 業務支援', '其他購買選項或業務支援：'],
            'cn' => ['其他购买选项 / 销售支持', '其他购买选项或销售支持：'],
            'de' => ['Weitere Kaufoptionen / Vertriebssupport', 'Für weitere Kaufoptionen oder Vertriebssupport:'],
            'jp' => ['その他の購入オプション / 営業サポート', 'その他の購入オプションまたは営業サポート：'],
            'tr' => ['Diğer satın alma seçenekleri / Satış desteği', 'Diğer satın alma seçenekleri veya satış desteği için:'],
        ], $languages);
    }

    /**
     * 建立 static_keyword 及各語系翻譯：主表與每語系翻譯都「不存在才插」（不覆寫既有/後台改過的值）。
     * 缺對應語系字串時 fallback 到 en。
     */
    private function insertKeywordIfMissing($key, array $translations, $languages)
    {
        if (!DB::table('static_keyword')->where('key_word', $key)->exists()) {
            DB::table('static_keyword')->insert(['key_word' => $key]);
        }

        foreach ($languages as $language) {
            $local = $language->name;

            $exists = DB::table('static_keyword_translations')
                ->where('key_word', $key)
                ->where('local', $local)
                ->exists();

            if (!$exists) {
                DB::table('static_keyword_translations')->insert([
                    'key_word' => $key,
                    'word' => $translations[$local] ?? $translations['en'],
                    'local' => $local,
                ]);
            }
        }
    }

    /**
     * 把某 key 各語系「仍是舊預設值」的翻譯更新為新值；後台改過的不動，缺翻譯則補新值。
     *
     * @param array $map  local => [oldDefault, newValue]，缺語系 fallback en
     */
    private function replaceWordIfOldDefault($key, array $map, $languages)
    {
        if (!DB::table('static_keyword')->where('key_word', $key)->exists()) {
            DB::table('static_keyword')->insert(['key_word' => $key]);
        }

        foreach ($languages as $language) {
            $local = $language->name;
            [$old, $new] = $map[$local] ?? $map['en'];

            $row = DB::table('static_keyword_translations')
                ->where('key_word', $key)
                ->where('local', $local)
                ->first();

            if (!$row) {
                // 缺翻譯 → 補新值（防呆：不存在才插）
                DB::table('static_keyword_translations')->insert([
                    'key_word' => $key,
                    'word' => $new,
                    'local' => $local,
                ]);
            } elseif ($row->word === $old) {
                // 仍是舊預設值 → 換新值（後台改過的、已是新值的都不動）
                DB::table('static_keyword_translations')
                    ->where('key_word', $key)
                    ->where('local', $local)
                    ->update(['word' => $new]);
                echo "Updated {$key} [{$local}] → {$new}\n";
            }
        }
    }
}
