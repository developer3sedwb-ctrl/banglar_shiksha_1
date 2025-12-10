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
        Schema::create('bs_student_vocational_details_temp', function (Blueprint $table) {
            $table->bigIncrements('id');
            // FK: School
            $table->unsignedBigInteger('school_id_fk');
            $table->foreign('school_id_fk')->references('id')->on('bs_school_master');
            $table->smallInteger('district_code_fk');
            $table->foreign('district_code_fk')->references('id')->on('bs_district_master');
            $table->smallInteger('subdivision_code_fk')->nullable();
            $table->foreign('subdivision_code_fk')->references('id')->on('bs_subdivision_master');
            $table->smallInteger('block_munc_code_fk')->nullable();
            $table->foreign('block_munc_code_fk')->references('id')->on('bs_block_munc_corp_master');
            $table->smallInteger('circle_code_fk')->nullable();
            $table->foreign('circle_code_fk')->references('id')->on('bs_circle_master');
            $table->integer('gs_ward_code_fk')->nullable();
            $table->foreign('gs_ward_code_fk')->references('id')->on('bs_gs_ward_master');
            // FK: Student (if used)
            /* -----------------------------
            VOCATIONAL FIELDS (Exact as per ep_student_vocational_details)
            ----------------------------- */
            // YES/NO fields
            $table->smallInteger('exposure_vocational_activities_y_n')->nullable();
            $table->smallInteger('undertake_vocational_course_y_n')->nullable();

            // FK fields
            $table->integer('vocational_course_code_fk')->nullable();
            $table->bigInteger('vocational_trade_sector_code_fk')->nullable();
            $table->bigInteger('vocational_job_role_code_fk')->nullable();

            // Duration fields
            $table->integer('vocational_class_attended_theory')->nullable();
            $table->integer('vocational_class_attended_practical')->nullable();
            $table->integer('vocational_class_attended_industry_training')->nullable();
            $table->integer('vocational_class_attended_field_visit')->nullable();

            // Exam details
            $table->integer('prev_class_exam_appeared_fk')->nullable();
            $table->decimal('prev_class_marks_percent_voc', 10, 2)->nullable();

            // Placement / apprenticeship
            $table->integer('applied_for_placement_code_fk')->nullable();
            $table->integer('applied_for_apprenticeship_code_fk')->nullable();

            // NSQF / placement / salary
            $table->bigInteger('vocational_nsqf_level_code_fk')->nullable();
            $table->bigInteger('vocational_placement_status_code_fk')->nullable();
            $table->bigInteger('vocational_salary_offered')->nullable();

            // System fields
            $table->smallInteger('status')->default(1);
            $table->string('entry_ip', 15)->nullable();
            $table->string('update_ip', 15)->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('update_by_stake_cd')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bs_student_vocational_details_temp');
    }
};
