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
            // Guardian address same as student
            $table->tinyInteger('address_equal')->default(0); // 1 - Yes, 0 - No
            // Guardian contact fields (visible in the UI)
            $table->smallInteger('guardian_country_code_fk');         // Select Country
            $table->foreign('guardian_country_code_fk')->references('id')->on('bs_country_master');
            $table->smallInteger('guardian_state_code_fk');           // Select State
            $table->foreign('guardian_state_code_fk')->references('id')->on('bs_state_master');
            $table->string('guardian_contact_address', 300);          // Address
            $table->string('guardian_contact_habitation', 300);       // Habitation/Locality

            $table->smallInteger('guardian_contact_district');        // District
            $table->smallInteger('guardian_contact_block');           // Block/Munc/Corp
            $table->string('guardian_contact_panchayat', 100);        // Panchayat

            $table->string('guardian_post_office', 300);              // Post Office
            $table->string('guardian_police_station', 100);           // Police Station

            $table->char('guardian_pin_code', 6);                     // Pin Code
            $table->integer('guardian_mobile_no')->nullable();                   // Mobile Number
            $table->string('guardian_email', 100)->nullable();
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
