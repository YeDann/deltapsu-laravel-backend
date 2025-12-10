<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomProductButtonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('custom_product_button')) {
            Schema::dropIfExists('custom_product_button');
        }
        Schema::create('custom_product_button', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->comment('按鈕顯示文字');
            $table->string('link', 500)->comment('按鈕連結');
            $table->text('products')->nullable()->comment('關聯商品IDs (逗號分隔)');
            $table->tinyInteger('status')->default(1)->comment('啟用狀態');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('custom_product_button');
    }
}