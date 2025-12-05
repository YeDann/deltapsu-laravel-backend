<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyCustomProductButtonAddLanguageNote extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('custom_product_button', function (Blueprint $table) {
            // Re-add name column that was previously removed
            $table->string('name')->after('id')->comment('按鈕顯示文字');
            $table->string('local', 10)->default('en')->comment('語系代碼')->after('name');
            $table->text('note')->nullable()->comment('備註說明')->after('local');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('custom_product_button', function (Blueprint $table) {
            $table->dropColumn(['name', 'local', 'note']);
        });
    }
}