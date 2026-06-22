<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAddressToOffice extends Migration
{
    /**
     * office 新增單一地址欄（不分語言），供 distributor 卡片以結構化欄位顯示地址。
     * 取代 distributor 前台原本讀 office_translations.content 的做法；
     * content 欄保留給 Sales Offices（type_id=1）使用，不在此 migration 異動。
     *
     * @return void
     */
    public function up()
    {
        Schema::table('office', function (Blueprint $table) {
            $table->text('address')->nullable()->after('email');
        });
    }

    public function down()
    {
        Schema::table('office', function (Blueprint $table) {
            $table->dropColumn('address');
        });
    }
}
