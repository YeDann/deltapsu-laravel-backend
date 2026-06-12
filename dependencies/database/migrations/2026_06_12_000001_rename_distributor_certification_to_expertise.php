<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameDistributorCertificationToExpertise extends Migration
{
    /**
     * Distributor 分類「Certification」更名為「Expertise」（客戶需求）。
     * 只改表名與外鍵約束名；欄位（fk_id / category_id / office_id）為通用名、不動。
     *
     * @return void
     */
    public function up()
    {
        // 1) 先卸掉舊外鍵（約束名依舊表名推導，須在 rename 前 drop）
        Schema::table('distributor_certification_translation', function (Blueprint $table) {
            $table->dropForeign(['fk_id']);
        });
        Schema::table('office_has_certification', function (Blueprint $table) {
            $table->dropForeign(['office_id']);
            $table->dropForeign(['category_id']);
        });

        // 2) 改表名
        Schema::rename('distributor_certification', 'distributor_expertise');
        Schema::rename('distributor_certification_translation', 'distributor_expertise_translation');
        Schema::rename('office_has_certification', 'office_has_expertise');

        // 3) 用新表名重建外鍵（約束名自動成 distributor_expertise_* / office_has_expertise_*）
        Schema::table('distributor_expertise_translation', function (Blueprint $table) {
            $table->foreign('fk_id')->references('id')->on('distributor_expertise')->onDelete('cascade');
        });
        Schema::table('office_has_expertise', function (Blueprint $table) {
            $table->foreign('office_id')->references('id')->on('office')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('distributor_expertise')->onDelete('cascade');
        });
    }

    /**
     * @return void
     */
    public function down()
    {
        Schema::table('distributor_expertise_translation', function (Blueprint $table) {
            $table->dropForeign(['fk_id']);
        });
        Schema::table('office_has_expertise', function (Blueprint $table) {
            $table->dropForeign(['office_id']);
            $table->dropForeign(['category_id']);
        });

        Schema::rename('distributor_expertise', 'distributor_certification');
        Schema::rename('distributor_expertise_translation', 'distributor_certification_translation');
        Schema::rename('office_has_expertise', 'office_has_certification');

        Schema::table('distributor_certification_translation', function (Blueprint $table) {
            $table->foreign('fk_id')->references('id')->on('distributor_certification')->onDelete('cascade');
        });
        Schema::table('office_has_certification', function (Blueprint $table) {
            $table->foreign('office_id')->references('id')->on('office')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('distributor_certification')->onDelete('cascade');
        });
    }
}
