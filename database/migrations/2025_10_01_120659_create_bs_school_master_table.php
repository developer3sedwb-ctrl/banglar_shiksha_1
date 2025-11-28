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
        Schema::create('bs_school_master', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('schcd')->nullable()->unique()->comment('schcd == DISE Code');

            $table->string('school_name', 255);
            $table->smallInteger('ac_year')->nullable()->comment('Academic year');
            $table->smallInteger('establishment_year')->nullable();

            $table->unsignedSmallInteger('rurb_code_fk')->comment('1=Urban,2=Rural');
            $table->unsignedSmallInteger('high_class')->comment('4=Class IV, 5=Class V, 8=Class VIII, 10=Class X, 12=Class XII');
            $table->unsignedSmallInteger('low_class')->comment('-2=NURSERY, -1=LKG, 0=PRE PRIMARY, 1=Class I, 2=Class II, 3=Class III, 4=Class IV, 5=Class V, 6=Class VI, 7=Class VII, 8=Class VIII, 9=Class IX, 10=Class X, 11=Class XI, 12=Class XII');
            $table->unsignedSmallInteger('uniform_status')->default(0)->comment('0=No,1=Yes');
            $table->unsignedSmallInteger('student_lock_status')->default(0)->comment('0=No,1=Yes');
            $table->unsignedSmallInteger('school_type_code_fk')->comment('1=Girls,2=Co-Educational,3=Boys');

            // foreign key reference columns
            $table->unsignedBigInteger('school_category_code_fk')->nullable()->comment('FK to bs_school_category_master');
            $table->unsignedBigInteger('school_management_code_fk')->nullable()->comment('FK to bs_management_master');
            $table->unsignedBigInteger('sch_cat_type_code_fk')->nullable()->comment('FK to bs_school_category_type_master');

            // foreign key reference school location
            $table->unsignedBigInteger('district_code_fk')->nullable()->comment('FK to bs_district_master');
            $table->unsignedBigInteger('block_munc_corp_code_fk')->nullable()->comment('FK to bs_block_munc_corp_master');
            $table->unsignedBigInteger('gs_ward_code_fk')->nullable()->comment('FK to bs_gs_ward_master');
            $table->unsignedBigInteger('circle_code_fk')->nullable()->comment('FK to bs_circle_master');
            $table->unsignedBigInteger('cluster_code_fk')->nullable()->comment('FK to bs_cluster_master');
            $table->unsignedBigInteger('subdiv_code_fk')->nullable()->comment('FK to bs_subdivision_master');

            $table->softDeletes();
            $table->timestamps();

            // Add indexes for better performance
            $table->index('schcd');
            $table->index('school_name');
            $table->index(['district_code_fk', 'block_munc_corp_code_fk']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bs_school_master');
    }
};
