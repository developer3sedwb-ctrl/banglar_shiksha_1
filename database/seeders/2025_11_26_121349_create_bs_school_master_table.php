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
            $table->bigInteger('schcd')->nullable()->comment('schcd == DISE Code');

            $table->string('school_name', 255);           
            $table->smallInteger('ac_year')->nullable()->comment('Need_to_discuss');;
            $table->smallInteger('establishment_year')->nullable();

            $table->unsignedSmallInteger('rurb_code_fk')->comment('1=Urban,2=Rural');
            $table->unsignedSmallInteger('high_class')->comment('4=Class IV, 5=Class V, 8=Class VIII, 10=Class X, 12=Class XII');
            $table->unsignedSmallInteger('low_class')->comment('-2=NURSERY, -1=LKG, 0=PRE PRIMARY, 1=Class I, 2=Class II, 3=Class III, 4=Class IV, 5=Class V, 6=Class VI, 7=Class VII, 8=Class VIII, 9=Class IX, 10=Class X, 11=Class');
            $table->unsignedSmallInteger('uniform_status')->comment('0=No,1=Yes');
            $table->unsignedSmallInteger('student_lock_status')->comment('0=No,1=Yes');
            $table->unsignedSmallInteger('school_type_code_fk')->comment('1=Girls,2=Co-Educational,3=Boys');


            // foreign key reference columns
            $table->unsignedBigInteger('school_category_code_fk')->comment('FK to bs_category_master');

            // foreign key reference school management
            $table->unsignedBigInteger('school_management_code_fk')->comment('FK to bs_management_master');
            $table->unsignedBigInteger('sch_cat_type_code_fk')->comment('FK to bs_management_master -> bs_school_category_type_master');

            // foreign key reference school location
            $table->unsignedBigInteger('district_code_fk')->comment('FK to bs_district_master');
            $table->unsignedBigInteger('block_munc_corp_code_fk')->comment('FK to bs_district_master -> bs_block_munc_corp_master');
            $table->unsignedBigInteger('gs_ward_code_fk')->comment('FK to bs_block_munc_corp_master -> bs_gs_ward_master');

            $table->unsignedBigInteger('circle_code_fk')->comment('FK to bs_district_master -> bs_circle_master');
            $table->unsignedBigInteger('cluster_code_fk')->comment('FK to bs_district_master -> bs_cluster_master');
            $table->unsignedBigInteger('subdiv_code_fk')->comment('FK to bs_district_master -> bs_subdivision_master');

            $table->softDeletes();
            $table->timestamps();
        });

        // Add FK constraints
        Schema::table('bs_school_master', function (Blueprint $table) {
            $table->foreign('school_category_code_fk')->references('id')->on('bs_school_category_type_master');

            $table->foreign('school_management_code_fk')->references('id')->on('bs_management_master');
            $table->foreign('sch_cat_type_code_fk')->references('id')->on('bs_school_category_type_master');
            
            $table->foreign('district_code_fk')->references('id')->on('bs_district_master');
            $table->foreign('block_munc_corp_code_fk')->references('id')->on('bs_block_munc_corp_master');
            $table->foreign('gs_ward_code_fk')->references('id')->on('bs_gs_ward_master');

            $table->foreign('circle_code_fk')->references('id')->on('bs_circle_master');
            $table->foreign('cluster_code_fk')->references('id')->on('bs_cluster_master');
            $table->foreign('subdiv_code_fk')->references('id')->on('bs_subdivision_master');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_master');
    }
};
