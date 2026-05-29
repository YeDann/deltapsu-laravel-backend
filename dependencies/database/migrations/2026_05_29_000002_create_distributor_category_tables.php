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
        foreach (['specialized_application', 'product_line', 'distributor_service'] as $base) {
            Schema::create($base, function (Blueprint $table) {
                $table->id();
                $table->string('slug')->nullable();
                $table->boolean('status')->default(1);
                $table->integer('order_seq')->default(0);
                $table->timestamps();
            });

            Schema::create($base . '_translation', function (Blueprint $table) use ($base) {
                $table->id();
                $table->unsignedBigInteger('fk_id');
                $table->string('name')->nullable();
                $table->string('local')->nullable();
                $table->timestamps();

                $table->foreign('fk_id')->references('id')->on($base)->onDelete('cascade');
            });
        }
    }

    /**
     * @return void
     */
    public function down()
    {
        foreach (['specialized_application', 'product_line', 'distributor_service'] as $base) {
            Schema::dropIfExists($base . '_translation');
            Schema::dropIfExists($base);
        }
    }
}
