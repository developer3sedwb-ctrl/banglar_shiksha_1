<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('bs_school_master', function (Blueprint $table) {
            // Add FK constraints with proper table references
            $table->foreign('school_category_code_fk')
                  ->references('id')
                  ->on('bs_school_category_master')
                  ->onDelete('set null');

            $table->foreign('school_management_code_fk')
                  ->references('id')
                  ->on('bs_management_master')
                  ->onDelete('set null');

            $table->foreign('sch_cat_type_code_fk')
                  ->references('id')
                  ->on('bs_school_category_type_master')
                  ->onDelete('set null');

            $table->foreign('district_code_fk')
                  ->references('id')
                  ->on('bs_district_master')
                  ->onDelete('set null');

            $table->foreign('block_munc_corp_code_fk')
                  ->references('id')
                  ->on('bs_block_munc_corp_master')
                  ->onDelete('set null');

            $table->foreign('gs_ward_code_fk')
                  ->references('id')
                  ->on('bs_gs_ward_master')
                  ->onDelete('set null');

            $table->foreign('circle_code_fk')
                  ->references('id')
                  ->on('bs_circle_master')
                  ->onDelete('set null');

            $table->foreign('cluster_code_fk')
                  ->references('id')
                  ->on('bs_cluster_master')
                  ->onDelete('set null');

            $table->foreign('subdiv_code_fk')
                  ->references('id')
                  ->on('bs_subdivision_master')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bs_school_master', function (Blueprint $table) {
            // Drop foreign keys in reverse order
            $table->dropForeign(['subdiv_code_fk']);
            $table->dropForeign(['cluster_code_fk']);
            $table->dropForeign(['circle_code_fk']);
            $table->dropForeign(['gs_ward_code_fk']);
            $table->dropForeign(['block_munc_corp_code_fk']);
            $table->dropForeign(['district_code_fk']);
            $table->dropForeign(['sch_cat_type_code_fk']);
            $table->dropForeign(['school_management_code_fk']);
            $table->dropForeign(['school_category_code_fk']);
        });
    }
};
