<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * 行銷資源縮圖檔名（壓縮檔等手動縮圖／影片 poster）。獨立於主檔，換主檔不影響。
     * 舊上線資料無此欄（null）時，前台 fallback 用主檔同名 .jpg 慣例。
     *
     * @return void
     */
    public function up()
    {
        Schema::table('marketing_resource_translations', function (Blueprint $table) {
            $table->string('thumbnail', 500)->nullable()->after('file');
        });
    }

    /**
     * @return void
     */
    public function down()
    {
        Schema::table('marketing_resource_translations', function (Blueprint $table) {
            $table->dropColumn('thumbnail');
        });
    }
};
