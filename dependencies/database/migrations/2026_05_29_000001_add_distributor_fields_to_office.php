<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDistributorFieldsToOffice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('office', function (Blueprint $table) {
            // 經銷商（type_id=2）專屬的語言中性欄位；Sales Offices（type_id=1）不使用
            $table->string('logo')->nullable();           // logo 檔名，圖檔之後客戶補
            $table->string('website')->nullable();
            $table->string('telephone')->nullable();
            $table->string('email')->nullable();
            $table->string('google_maps', 1024)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('office', function (Blueprint $table) {
            $table->dropColumn([
                'logo', 'website', 'telephone', 'email',
                'google_maps',
            ]);
        });
    }
}
