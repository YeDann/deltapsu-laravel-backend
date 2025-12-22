<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuccessCaseTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('success_case_type', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('color_type')->nullable();
            $table->integer('order_seq')->default(0);
            $table->timestamps();
        });

        Schema::create('success_case_type_translation', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fk_sct_id');
            $table->string('title')->nullable();
            $table->string('local')->nullable();
            $table->timestamps();

            $table->foreign('fk_sct_id')->references('id')->on('success_case_type')->onDelete('cascade');
        });

        Schema::create('product_success_case_has_categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('content_id');
            $table->unsignedBigInteger('categories_id');
            $table->timestamps();

            $table->foreign('content_id')->references('id')->on('contents')->onDelete('cascade');
            $table->foreign('categories_id')->references('id')->on('success_case_type')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_success_case_has_categories');
        Schema::dropIfExists('success_case_type_translation');
        Schema::dropIfExists('success_case_type');
    }
}
