<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndustryKnowHowTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('industry_know_how_type', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('color_type')->nullable();
            $table->integer('order_seq')->default(0);
            $table->timestamps();
        });

        Schema::create('industry_know_how_type_translation', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fk_ikht_id');
            $table->string('title')->nullable();
            $table->string('local')->nullable();
            $table->timestamps();

            $table->foreign('fk_ikht_id')->references('id')->on('industry_know_how_type')->onDelete('cascade');
        });

        Schema::create('product_industry_know_how_has_categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('content_id');
            $table->unsignedBigInteger('categories_id');
            $table->timestamps();

            $table->foreign('content_id', 'fk_ikh_content_id')->references('id')->on('contents')->onDelete('cascade');
            $table->foreign('categories_id', 'fk_ikh_cat_id')->references('id')->on('industry_know_how_type')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_industry_know_how_has_categories');
        Schema::dropIfExists('industry_know_how_type_translation');
        Schema::dropIfExists('industry_know_how_type');
    }
}
