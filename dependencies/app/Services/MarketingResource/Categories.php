<?php

declare(strict_types=1);

namespace App\Services\MarketingResource;

use Illuminate\Support\Facades\DB;

/**
 * 行銷資源分類的英文名 → cate_id 解析。
 *
 * 前台縮圖網格、前台預覽白名單、後台縮圖欄位三處需要同一份分類清單，
 * 各自複製名單會分岔（曾因此讓圖庫分類在後台看不到縮圖欄位），故集中在此。
 * 以英文名定位而非寫死 id，因為各環境的 cate_id 不一致。
 */
class Categories
{
    /** 套用縮圖網格版型（縮圖 + 預覽/下載 icon）的分類英文名。 */
    public const GRID = ['Media Library', 'Product Images', 'Product Images / Videos', 'Catalogs', 'Leaflets', 'Sales Tool'];

    /** 圖庫分類：一個共用檔（含縮圖）套用所有語系；含歷次更名前後的名稱。 */
    public const GALLERY = ['Media Library', 'Product Images', 'Product Images / Videos'];

    /**
     * 縮圖網格分類的 cate_id。
     *
     * @return array<int, int>
     */
    public static function gridIds(): array
    {
        return self::idsFor(self::GRID);
    }

    /**
     * 圖庫分類的 cate_id；查無回 null。
     */
    public static function galleryId(): ?int
    {
        return self::idsFor(self::GALLERY)[0] ?? null;
    }

    /**
     * @param array<int, string> $names
     * @return array<int, int>
     */
    private static function idsFor(array $names): array
    {
        return DB::table('marketing_resource_cate_translations')
            ->where('local', 'en')
            ->whereIn('name', $names)
            ->pluck('mk_fk_id')
            ->map(fn ($v) => (int) $v)
            ->values()
            ->all();
    }
}
