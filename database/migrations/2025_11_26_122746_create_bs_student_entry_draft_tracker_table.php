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
        Schema::create('bs_student_entry_draft_tracker', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('school_id_fk');
            $table->foreign('school_id_fk')
                ->references('id')
                ->on('bs_school_master');
            $table->smallInteger('step_number');
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
        Schema::dropIfExists('bs_student_entry_draft_tracker');
    }
};
