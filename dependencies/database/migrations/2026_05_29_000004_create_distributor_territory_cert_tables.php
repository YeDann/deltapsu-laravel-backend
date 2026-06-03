<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistributorTerritoryCertTables extends Migration
{
    /**
     * Sales Territory 與 Certification 升級為可管理清單（同三分類結構）+ 經銷商關聯 pivot。
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distributor_sales_territory', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->nullable();
            $table->boolean('status')->default(1);
            $table->integer('order_seq')->default(0);
            $table->timestamps();
        });

        Schema::create('distributor_sales_territory_translation', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fk_id');
            $table->string('name')->nullable();
            $table->string('local')->nullable();
            $table->timestamps();

            $table->foreign('fk_id')->references('id')->on('distributor_sales_territory')->onDelete('cascade');
        });

        Schema::create('distributor_certification', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->nullable();
            $table->boolean('status')->default(1);
            $table->integer('order_seq')->default(0);
            $table->timestamps();
        });

        Schema::create('distributor_certification_translation', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fk_id');
            $table->string('name')->nullable();
            $table->string('local')->nullable();
            $table->timestamps();

            $table->foreign('fk_id')->references('id')->on('distributor_certification')->onDelete('cascade');
        });

        Schema::create('office_has_sales_territory', function (Blueprint $table) {
            $table->id();
            $table->integer('office_id');
            $table->unsignedBigInteger('category_id');
            $table->timestamps();

            $table->foreign('office_id')->references('id')->on('office')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('distributor_sales_territory')->onDelete('cascade');
        });

        Schema::create('office_has_certification', function (Blueprint $table) {
            $table->id();
            $table->integer('office_id');
            $table->unsignedBigInteger('category_id');
            $table->timestamps();

            $table->foreign('office_id')->references('id')->on('office')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('distributor_certification')->onDelete('cascade');
        });
    }

    /**
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('office_has_sales_territory');
        Schema::dropIfExists('office_has_certification');
        Schema::dropIfExists('distributor_sales_territory_translation');
        Schema::dropIfExists('distributor_sales_territory');
        Schema::dropIfExists('distributor_certification_translation');
        Schema::dropIfExists('distributor_certification');
    }
}
