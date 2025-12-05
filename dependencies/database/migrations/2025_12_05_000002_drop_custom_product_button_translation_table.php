<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropCustomProductButtonTranslationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('custom_product_button_translation');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Recreate the translation table if rollback is needed
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
}