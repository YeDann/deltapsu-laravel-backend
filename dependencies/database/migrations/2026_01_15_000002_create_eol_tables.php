<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEolTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eol_type', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(); // Keeping generic name
            $table->string('color_type')->nullable();
            $table->integer('order_seq')->default(0);
            $table->timestamps();
            $table->integer('sort')->default(0); 
        });

        Schema::create('eol_type_translation', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('eol_type_id');
            $table->string('name')->nullable(); // Using 'name' to match controller logic usually
            $table->string('local')->nullable();
            
            // Extra columns that might be used based on other controllers (e.g. description, meta) if needed, 
            // but SuccessCaseTypeTranslation only had title/local? 
            // Wait, SuccessCaseTypeTranslation has 'title' in migration but 'name' in Controller?
            // Let's check SuccessCaseTypeController to be sure about column names.
            
            $table->timestamps();

            $table->foreign('eol_type_id')->references('id')->on('eol_type')->onDelete('cascade');
        });

        Schema::create('product_eol_has_categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('content_id');
            $table->unsignedBigInteger('categories_id');
            $table->timestamps();

            $table->foreign('content_id')->references('id')->on('contents')->onDelete('cascade');
            $table->foreign('categories_id')->references('id')->on('eol_type')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_eol_has_categories');
        Schema::dropIfExists('eol_type_translation');
        Schema::dropIfExists('eol_type');
    }
}
