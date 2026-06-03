<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddContinentToSalesTerritory extends Migration
{
    /**
     * Sales Territory 綁定所屬地區（continents type_id=2），供後台直接設定與前台分區呈現。
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sales_territory', function (Blueprint $table) {
            $table->integer('continent_id')->nullable()->after('slug');
        });
    }

    /**
     * @return void
     */
    public function down()
    {
        Schema::table('sales_territory', function (Blueprint $table) {
            $table->dropColumn('continent_id');
        });
    }
}
