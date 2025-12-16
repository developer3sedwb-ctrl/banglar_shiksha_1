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
        Schema::create('bs_student_master_other_addon_data_temp', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('school_id_fk');
            $table->foreign('school_id_fk')
                ->references('id')
                ->on('bs_school_master');
             // Facilities Provided
            $table->smallInteger('district_code_fk');
            $table->foreign('district_code_fk')->references('id')->on('bs_district_master');
            $table->integer('rte_entitlement_claimed_amount');
            $table->smallInteger('disabality_certificate_y_n');
            $table->smallInteger('stu_residance_sch_distance_code_fk');
            $table->foreign('stu_residance_sch_distance_code_fk')->references('id')->on('bs_student_residence_to_school_distance');
            $table->smallInteger('cur_class_appeared_exam');
            $table->decimal('cur_class_marks_percent',10, 2);
            $table->smallInteger('attendention_cur_year');

            $table->string('entry_ip', 15)->nullable();
            $table->string('update_ip', 15)->nullable();
            $table->smallInteger('status')->default(1);
            $table->timestamps();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->unsignedBigInteger('update_by_stake_cd')->nullable();
            $table->softDeletes();       
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bs_student_master_other_addon_data_temp');
    }
};
