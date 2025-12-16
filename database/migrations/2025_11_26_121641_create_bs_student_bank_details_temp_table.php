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
        Schema::create('bs_student_bank_details_temp', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('school_id_fk');
            $table->foreign('school_id_fk')->references('id')->on('bs_school_master');
            // Guardian address same as student
            // $table->integer('stu_bank');
            // $table->foreign('stu_bank')->references('id')->on('bs_bank_master');
            // $table->integer('stu_bank_branch');
            // $table->foreign('stu_bank_branch')->references('id')->on('bs_bank_branch_master');
            $table->string('bank_ifsc', 20);
            $table->string('stu_bank_acc_no', 50);
            $table->smallInteger('status')->default(1);
            $table->string('entry_ip', 15)->nullable();
            $table->string('update_ip', 15)->nullable();                    
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
        Schema::dropIfExists('bs_student_bank_details_temp');
    }
};
