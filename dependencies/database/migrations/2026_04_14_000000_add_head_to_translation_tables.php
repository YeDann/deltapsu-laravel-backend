<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHeadToTranslationTables extends Migration
{
    public function up()
    {
        Schema::table('contents_translations', function (Blueprint $table) {
            $table->text('head')->nullable();
        });
        Schema::table('application_translation', function (Blueprint $table) {
            $table->text('head')->nullable();
        });
        Schema::table('products_translation', function (Blueprint $table) {
            $table->text('head')->nullable();
        });
        Schema::table('main_pro_categories_translations', function (Blueprint $table) {
            $table->text('head')->nullable();
        });
    }

    public function down()
    {
        Schema::table('contents_translations', function (Blueprint $table) {
            $table->dropColumn('head');
        });
        Schema::table('application_translation', function (Blueprint $table) {
            $table->dropColumn('head');
        });
        Schema::table('products_translation', function (Blueprint $table) {
            $table->dropColumn('head');
        });
        Schema::table('main_pro_categories_translations', function (Blueprint $table) {
            $table->dropColumn('head');
        });
    }
}
