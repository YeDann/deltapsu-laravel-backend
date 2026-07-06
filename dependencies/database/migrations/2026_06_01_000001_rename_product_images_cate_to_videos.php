<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class RenameProductImagesCateToVideos extends Migration
{
    /**
     * 行銷資源分類「Product Images」改名為「Product Images / Videos」（含影片混排）。
     * 以 en 名稱定位 cate_id（env-safe），逐語系更新顯示名；tw/cn/jp 在地化。
     */
    public function up()
    {
        $cateId = DB::table('marketing_resource_cate_translations')
            ->where('local', 'en')
            ->where('name', 'Product Images')
            ->value('mk_fk_id');

        if (!$cateId) {
            return; // 找不到（可能已改名或此環境無此分類）就不動
        }

        $this->applyNames($cateId, [
            'en' => 'Product Images / Videos',
            'de' => 'Product Images / Videos',
            'tr' => 'Product Images / Videos',
            'ru' => 'Product Images / Videos',
            'tw' => '產品照片/影片',
            'cn' => '产品照片/影片',
            'jp' => '製品イメージ/動画',
        ]);
    }

    public function down()
    {
        $cateId = DB::table('marketing_resource_cate_translations')
            ->where('local', 'en')
            ->where('name', 'Product Images / Videos')
            ->value('mk_fk_id');

        if (!$cateId) {
            return;
        }

        $this->applyNames($cateId, [
            'en' => 'Product Images',
            'de' => 'Product Images',
            'tr' => 'Product Images',
            'ru' => 'Product Images',
            'tw' => '產品照片',
            'cn' => '产品照片',
            'jp' => '製品イメージ',
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
