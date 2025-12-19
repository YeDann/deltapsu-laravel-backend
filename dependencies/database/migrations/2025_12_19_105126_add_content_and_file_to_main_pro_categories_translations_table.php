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
        Schema::table('main_pro_categories_translations', function (Blueprint $table) {
            $table->text('content')->nullable()->after('name');
            $table->string('file')->nullable()->after('content');
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
            $table->dropColumn(['content', 'file']);
        });
    }
};
