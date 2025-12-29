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
        Schema::create('bs_student_delete_track', function (Blueprint $table) {
            $table->bigIncrements('id');
            // Location / School Info
            $table->integer('district_code_fk')->nullable();
            $table->integer('circle_code_fk')->nullable();
            $table->unsignedBigInteger('school_code_fk')->nullable();
            // Student Info
            $table->char('student_code',14)->unique();
            $table->string('student_name', 100)->nullable();
            // Delete Tracking
            $table->integer('delete_reason_code_fk')->nullable();
            // $table->integer('delete_reject_status')->nullable();
            $table->char('prev_delete_status', 1)->nullable();
            // Audit Fields
            $table->string('entry_ip', 15)->nullable();
            $table->unsignedBigInteger('enter_by')->nullable();
            $table->smallInteger('enter_by_stake_cd')->nullable();
            $table->string('update_ip', 15)->nullable();
            $table->unsignedBigInteger('update_by')->nullable();
            $table->smallInteger('update_by_stake_cd')->nullable();
            $table->smallInteger('status')->default(1)->comment('1 = active, 0 = inactive');
            $table->timestamps();
            $table->softDeletes();
            // Indexes (recommended for performance)
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
        Schema::dropIfExists('bs_student_delete_track');
    }
};
