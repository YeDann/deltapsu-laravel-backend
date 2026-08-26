<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistributorCategoryTables extends Migration
{
    /**
     * 三張可管理的經銷商分類表，各帶多語 _translation：
     * Specialized Application / Product Line / Service。
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distributor_specialized_application', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->nullable();
            $table->boolean('status')->default(1);
            $table->integer('order_seq')->default(0);
            $table->timestamps();
        });

        Schema::create('distributor_specialized_application_translation', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fk_id');
            $table->string('name')->nullable();
            $table->string('local')->nullable();
            $table->timestamps();

            $table->foreign('fk_id')->references('id')->on('distributor_specialized_application')->onDelete('cascade');
        });

        Schema::create('distributor_product_line', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->nullable();
            $table->boolean('status')->default(1);
            $table->integer('order_seq')->default(0);
            $table->timestamps();
        });

        Schema::create('distributor_product_line_translation', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fk_id');
            $table->string('name')->nullable();
            $table->string('local')->nullable();
            $table->timestamps();

            $table->foreign('fk_id')->references('id')->on('distributor_product_line')->onDelete('cascade');
        });

        Schema::create('distributor_service', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->nullable();
            $table->boolean('status')->default(1);
            $table->integer('order_seq')->default(0);
            $table->timestamps();
        });

        Schema::create('distributor_service_translation', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fk_id');
            $table->string('name')->nullable();
            $table->string('local')->nullable();
            $table->timestamps();

            $table->foreign('fk_id')->references('id')->on('distributor_service')->onDelete('cascade');
        });
    }

    /**
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('distributor_specialized_application_translation');
        Schema::dropIfExists('distributor_specialized_application');
        Schema::dropIfExists('distributor_product_line_translation');
        Schema::dropIfExists('distributor_product_line');
        Schema::dropIfExists('distributor_service_translation');
        Schema::dropIfExists('distributor_service');
    }
}
