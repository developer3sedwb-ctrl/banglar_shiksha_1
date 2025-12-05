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
        Schema::create('bs_student_contact_info_temp', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('school_id_fk');
            $table->foreign('school_id_fk')->references('id')->on('bs_school_master');
            $table->smallInteger('stu_country_code_fk');
            $table->foreign('stu_country_code_fk')->references('id')->on('bs_country_master');  // Select Country
            $table->string('stu_contact_address', 300);   // Address
            $table->smallInteger('stu_contact_district')->nullable(); // District
            $table->foreign('stu_contact_district')->references('id')->on('bs_district_master');
            $table->string('stu_contact_other_district', 50)->nullable();
            $table->string('stu_contact_panchayat', 100); // Panchayat
            $table->string('stu_police_station', 100);    // Police Station
            $table->integer('stu_mobile_no')->nullable();            // Mobile No
            $table->smallInteger('stu_state_code_fk');    // Select State
            $table->foreign('stu_state_code_fk')->references('id')->on('bs_state_master');
            $table->string('stu_contact_habitation', 300); // Habitation/Locality
            $table->smallInteger('stu_contact_block')->nullable();    // Block/Munc/Corp
            $table->foreign('stu_contact_block')->references('id')->on('bs_block_munc_corp_master');
            $table->string('stu_contact_other_block', 50)->nullable(); 
            $table->string('stu_post_office', 300);       // Post Office
            $table->char('stu_pin_code', 6);              // Pin Code
            $table->string('stu_email', 100)->nullable();             // Email
            //gurdian contact info
                // Address equal flag
            $table->smallInteger('address_equal')->default(0);

            // Guardian Contact Details
            $table->smallInteger('guardian_country_code_fk')->nullable();
            $table->foreign('guardian_country_code_fk')->references('id')->on('bs_country_master');  // Select Country
            $table->smallInteger('guardian_state_code_fk')->nullable();
            $table->foreign('guardian_state_code_fk')->references('id')->on('bs_state_master');
            $table->string('guardian_contact_address', 300)->nullable();
            $table->string('guardian_contact_habitation', 300)->nullable();
            $table->smallInteger('guardian_contact_district')->nullable();
            $table->foreign('guardian_contact_district')->references('id')->on('bs_district_master');
            $table->string('guardian_contact_other_district', 50)->nullable(); // Panchayat
            $table->smallInteger('guardian_contact_block')->nullable();

            $table->foreign('guardian_contact_block')->references('id')->on('bs_block_munc_corp_master');
            $table->string('guardian_contact_other_block', 50)->nullable();
            $table->string('guardian_contact_panchayat', 100)->nullable();
            $table->string('guardian_post_office', 300)->nullable();
            $table->string('guardian_police_station', 100)->nullable();
            $table->char('guardian_pin_code', 6)->nullable();
            $table->unsignedBigInteger('guardian_mobile_no')->nullable();
            $table->string('guardian_email', 100)->nullable();
            // Student Code (to link with master)
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
        Schema::dropIfExists('bs_student_contact_info_temp');
    }
};
