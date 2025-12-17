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
        Schema::create('bs_student_dropbox_archive', function (Blueprint $table) {
           $table->bigIncrements('id');
            $table->char('student_code', 14)->index();
            $table->char('academic_year', 4);
            $table->unsignedSmallInteger('cur_class_code_fk');
            $table->foreign('cur_class_code_fk')->references('id')->on('bs_class_master')->onDelete('restrict')->onUpdate('cascade');
            $table->unsignedBigInteger('school_code_fk');
            $table->foreign('school_code_fk')->references('id')->on('bs_school_master')->onDelete('restrict')->onUpdate('cascade');
            $table->unsignedBigInteger('circle_code_fk');
            $table->foreign('circle_code_fk')->references('id')->on('bs_circle_master')->onDelete('restrict')->onUpdate('cascade');
            $table->unsignedBigInteger('block_munc_code_fk')->nullable();
            $table->foreign('block_munc_code_fk')->references('id')->on('bs_block_munc_corp_master')->onDelete('restrict')->onUpdate('cascade');
            $table->unsignedBigInteger('district_code_fk');
            $table->foreign('district_code_fk')->references('id')->on('bs_district_master')->onDelete('restrict')->onUpdate('cascade');
            $table->unsignedBigInteger('gs_ward_code_fk')->nullable();
            $table->foreign('gs_ward_code_fk')->references('id')->on('bs_gs_ward_master')->onDelete('restrict')->onUpdate('cascade');
            
            $table->unsignedBigInteger('reason_code_fk')->nullable();
            $table->foreign('reason_code_fk')->references('id')->on('bs_drop_student_reason_master')->onDelete('restrict')->onUpdate('cascade');
            $table->unsignedBigInteger('not_transfer_reason_code_fk')->nullable();
            $table->foreign('not_transfer_reason_code_fk')->references('id')->on('bs_reason_master_not_transferred_in_master')->onDelete('restrict')->onUpdate('cascade');
            $table->string('uniform_status', 15)->nullable();
            
            $table->string('entry_ip',15)->nullable();
            $table->unsignedBigInteger('enter_by')->nullable();
            $table->unsignedSmallInteger('enter_by_stake_cd')->nullable();
             $table->string('update_ip',15)->nullable();
            $table->unsignedBigInteger('update_by')->nullable();
            $table->unsignedSmallInteger('update_by_stake_cd')->nullable();
            $table->timestamps();
            // ->comment('the field entry_time will be stored at created_at field');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bs_student_dropbox_archive');
    }
};
