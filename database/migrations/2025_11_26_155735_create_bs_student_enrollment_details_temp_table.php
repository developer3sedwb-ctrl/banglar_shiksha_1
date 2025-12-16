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
        Schema::create('bs_student_enrollment_details_temp', function (Blueprint $table) {
            $table->bigIncrements('id');
            // School FK
            $table->unsignedBigInteger('school_id_fk');
            $table->foreign('school_id_fk')->references('id')->on('bs_school_master');
            // Admission fields
            $table->string('admission_no', 100);
            $table->date('admission_date')->nullable(); 
            // Previous year status
            $table->smallInteger('status_pre_year');
            $table->foreign('status_pre_year')->references('id')->on('bs_previous_schooling_type_master');
            // Previous exam appearance
            $table->smallInteger('prev_class_appeared_exam')->nullable(); 
            $table->smallInteger('prev_class_exam_result')->nullable(); 
            $table->decimal('prev_class_marks_percent', 10, 2)->nullable(); 
            // Days attended
            $table->smallInteger('attendention_pre_year')->nullable(); 
            // Previous class details
            $table->smallInteger('pre_roll_number')->nullable();
            $table->smallInteger('pre_class_code_fk');
            $table->foreign('pre_class_code_fk')->references('id')->on('bs_class_master');
            $table->smallInteger('pre_section_code_fk');
            $table->foreign('pre_section_code_fk')->references('id')->on('bs_class_section_master');
            $table->smallInteger('pre_stream_code_fk')->nullable(); 
            $table->foreign('pre_stream_code_fk')->references('id')->on('bs_stream_master');
            // Present class details
            $table->smallInteger('cur_class_code_fk')->nullable(); 
            $table->foreign('cur_class_code_fk')->references('id')->on('bs_class_master');
            $table->smallInteger('cur_section_code_fk')->nullable(); 
            $table->foreign('cur_section_code_fk')->references('id')->on('bs_class_section_master');
            $table->smallInteger('cur_stream_code_fk')->nullable(); 
            $table->foreign('cur_stream_code_fk')->references('id')->on('bs_stream_master');
            $table->smallInteger('cur_roll_number')->nullable(); 
            // Academic year + Medium + Admission type
            $table->smallInteger('academic_year');
            $table->smallInteger('medium_code_fk');
            $table->foreign('medium_code_fk')->references('id')->on('bs_medium_master');
            $table->smallInteger('admission_type_code_fk');
            $table->foreign('admission_type_code_fk')->references('id')->on('bs_admission_type_master');
            $table->string('entry_ip', 15)->nullable();
            $table->string('update_ip', 15)->nullable();
            $table->smallInteger('status')->default(1);
            $table->timestamps();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->softDeletes();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bs_student_enrollment_details_temp');
    }
};
