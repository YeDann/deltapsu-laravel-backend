<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class RenameProductImagesVideosCateToMediaLibrary extends Migration
{
    /**
     * 行銷資源分類「Product Images / Videos」改名為「Media Library」。
     * 以 en 名稱定位 cate_id（env-safe），逐語系更新顯示名；tw/cn/jp 在地化。
     *
     * 舊名同時接受更名前的「Product Images」，因為各站不一定都跑過
     * 2026_06_01_000001_rename_product_images_cate_to_videos。
     */
    public function up()
    {
        $cateId = DB::table('marketing_resource_cate_translations')
            ->where('local', 'en')
            ->whereIn('name', ['Product Images / Videos', 'Product Images'])
            ->value('mk_fk_id');

        if (!$cateId) {
            return; // 找不到（可能已改名或此環境無此分類）就不動
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

    public function down()
    {
        $cateId = DB::table('marketing_resource_cate_translations')
            ->where('local', 'en')
            ->where('name', 'Media Library')
            ->value('mk_fk_id');

        if (!$cateId) {
            return;
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
