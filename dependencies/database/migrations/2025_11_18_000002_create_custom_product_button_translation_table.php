<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomProductButtonTranslationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('custom_product_button_translation')) {
            Schema::dropIfExists('custom_product_button_translation');
        }
        Schema::create('custom_product_button_translation', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('button_id');
            $table->string('name')->comment('按鈕顯示文字');
            $table->string('local')->comment('語言代碼');
            $table->timestamps();

            $table->foreign('button_id')->references('id')->on('custom_product_button')->onDelete('cascade');
            $table->unique(['button_id', 'local']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('custom_product_button_translation');
    }
}