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
        Schema::create('bs_student_activate_deactivate_track', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('school_code_fk');
            $table->foreign('school_code_fk')->references('id')->on('bs_school_master');
            $table->smallInteger('district_code_fk');
            $table->foreign('district_code_fk')->references('id')->on('bs_district_master');
            $table->unsignedInteger('circle_code_fk');
            $table->foreign('circle_code_fk')->references('id')->on('bs_circle_master');
            $table->char('student_code',14)->unique();
            $table->unsignedSmallInteger('cur_class_code_fk');
            $table->foreign('cur_class_code_fk')->references('id')->on('bs_class_master');
            $table->unsignedSmallInteger('cur_section_code_fk')->nullable();
            $table->foreign('cur_section_code_fk')->references('id')->on('bs_class_section_master');
            $table->unsignedSmallInteger('deactivate_reason_code_fk');
            $table->foreign('deactivate_reason_code_fk')->references('id')->on('bs_reason_student_deactivation_master');
            $table->smallInteger('operation_by')->nullable();
            $table->smallInteger('operation_by_stake_cd')->nullable();
            $table->timestamp('operation_time')->nullable();
            $table->string('operation_ip',15)->nullable();
            $table->smallInteger('prev_status')->nullable();
            $table->smallInteger('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
            $table->index('student_code');
            $table->index('school_code_fk');
            $table->index('district_code_fk');        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bs_student_activate_deactivate_track');
    }
};
