<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 取得 main_pro_categories_translations 中 file 欄位不為 null 的資料，並且 local 為 'en'
        $mainTransDataHasFile = DB::table('main_pro_categories_translations')->whereNotNull('file')->where('file', '<>', '')->get();

        foreach($mainTransDataHasFile as $mainTrans) {
            $fileName = $mainTrans->file;
            
            if($mainTrans->local !== 'en'){
                $filePath = base_path('/../medias/categories/') . $fileName;
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }else{
                DB::table('main_pro_categories')->where('main_id', $mainTrans->main_pro_id)->update(['file' => $fileName]);
            }
        }

        Schema::table('main_pro_categories_translations', function (Blueprint $table) {
            $table->dropColumn('file');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('main_pro_categories_translations', function (Blueprint $table) {
            $table->string('file')->nullable()->after('content');
        });
    }
};
