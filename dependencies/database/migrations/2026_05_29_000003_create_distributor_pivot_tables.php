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
        $pivots = [
            'office_has_specialized_application' => 'specialized_application',
            'office_has_product_line'            => 'product_line',
            'office_has_service'                 => 'distributor_service',
        ];

        foreach ($pivots as $pivot => $category) {
            Schema::create($pivot, function (Blueprint $table) use ($category) {
                $table->id();
                $table->integer('office_id');
                $table->unsignedBigInteger('category_id');
                $table->timestamps();

                $table->foreign('office_id')->references('id')->on('office')->onDelete('cascade');
                $table->foreign('category_id')->references('id')->on($category)->onDelete('cascade');
            });
        }
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
