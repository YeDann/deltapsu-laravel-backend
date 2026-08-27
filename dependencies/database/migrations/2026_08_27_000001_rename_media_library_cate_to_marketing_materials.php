<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class RenameMediaLibraryCateToMarketingMaterials extends Migration
{
    /**
     * 行銷資源分類「Media Library」改名為「Marketing Materials」。
     * 以 en 名稱定位 cate_id（env-safe），逐語系更新顯示名；tw/cn/jp 在地化。
     *
     * 舊名同時接受更名前的「Product Images / Videos」與「Product Images」，
     * 因為各站不一定都跑過前面兩支更名 migration。
     */
    public function up()
    {
        $cateId = DB::table('marketing_resource_cate_translations')
            ->where('local', 'en')
            ->whereIn('name', ['Media Library', 'Product Images / Videos', 'Product Images'])
            ->value('mk_fk_id');

        if (!$cateId) {
            return; // 找不到（可能已改名或此環境無此分類）就不動
        }

        $this->applyNames($cateId, [
            'en' => 'Marketing Materials',
            'de' => 'Marketing Materials',
            'tr' => 'Marketing Materials',
            'ru' => 'Marketing Materials',
            'tw' => '行銷素材',
            'cn' => '营销素材',
            'jp' => 'マーケティング資料',
        ]);
    }

    public function down()
    {
        $cateId = DB::table('marketing_resource_cate_translations')
            ->where('local', 'en')
            ->where('name', 'Marketing Materials')
            ->value('mk_fk_id');

        if (!$cateId) {
            return;
        }

        $this->applyNames($cateId, [
            'en' => 'Media Library',
            'de' => 'Media Library',
            'tr' => 'Media Library',
            'ru' => 'Media Library',
            'tw' => '媒體庫',
            'cn' => '媒体库',
            'jp' => 'メディアライブラリ',
        ]);
    }

    private function applyNames($cateId, array $names)
    {
        foreach ($names as $local => $name) {
            DB::table('marketing_resource_cate_translations')
                ->where('mk_fk_id', $cateId)
                ->where('local', $local)
                ->update(['name' => $name]);
        }
    }
}
