<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistributorPivotTables extends Migration
{
    /**
     * 經銷商（office type_id=2）↔ 三類分類的多對多關聯。
     * office.id 為 legacy signed int，故 office_id 用 integer 對應。
     *
     * @return void
     */
    public function up()
    {
        Schema::create('office_has_specialized_application', function (Blueprint $table) {
            $table->id();
            $table->integer('office_id');
            $table->unsignedBigInteger('category_id');
            $table->timestamps();

            $table->foreign('office_id')->references('id')->on('office')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('distributor_specialized_application')->onDelete('cascade');
        });

        Schema::create('office_has_product_line', function (Blueprint $table) {
            $table->id();
            $table->integer('office_id');
            $table->unsignedBigInteger('category_id');
            $table->timestamps();

            $table->foreign('office_id')->references('id')->on('office')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('distributor_product_line')->onDelete('cascade');
        });

        Schema::create('office_has_service', function (Blueprint $table) {
            $table->id();
            $table->integer('office_id');
            $table->unsignedBigInteger('category_id');
            $table->timestamps();

            $table->foreign('office_id')->references('id')->on('office')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('distributor_service')->onDelete('cascade');
        });
    }

    /**
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('office_has_specialized_application');
        Schema::dropIfExists('office_has_product_line');
        Schema::dropIfExists('office_has_service');
    }
}
