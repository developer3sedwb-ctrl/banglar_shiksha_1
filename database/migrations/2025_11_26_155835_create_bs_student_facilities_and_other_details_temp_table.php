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
        Schema::create('bs_student_facilities_and_other_details_temp', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('school_id_fk');
            $table->foreign('school_id_fk')
                ->references('id')
                ->on('bs_school_master');
             // Facilities Provided
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
            $table->smallInteger('academic_year')->nullable();
            $table->smallInteger('facilities_provided_y_n')->nullable();
            $table->smallInteger('free_uniform_y_n')->nullable();
            $table->smallInteger('free_transport_facility_y_n')->nullable();
            $table->smallInteger('free_escort_y_n')->nullable();
            $table->smallInteger('free_hostel_y_n')->nullable();
            $table->smallInteger('free_mobile_tab_comp_y_n')->nullable();
            $table->smallInteger('free_cycle_y_n')->nullable();

            $table->smallInteger('central_scholarship_rcv_y_n')->nullable();
            $table->smallInteger('central_scholarship_code_fk')->nullable();

            $table->smallInteger('state_scholarship_rcv_y_n')->nullable();
            $table->smallInteger('state_scholarship_code_fk')->nullable();

            $table->smallInteger('other_scholarship_rcv_y_n')->nullable();
            $table->integer('other_scholarship_amount')->nullable();

            $table->smallInteger('facilities_provided_cwsn_y_n')->nullable();
            $table->smallInteger('screened_for_specific_learning_disability_y_n')->nullable();
            $table->smallInteger('type_of_specific_learning_disability')->nullable();
            $table->smallInteger('screened_for_autism_spectrum_disorder_y_n')->nullable();
            $table->smallInteger('screened_for_attention_deficit_hyperactive_disorder_y_n')->nullable();

            $table->smallInteger('extracurricular_activity_involved_y_n')->nullable();
            $table->smallInteger('gifted_talented_child_in_mathematics')->nullable();
            $table->smallInteger('gifted_talented_child_in_language')->nullable();
            $table->smallInteger('gifted_talented_child_in_science')->nullable();
            $table->smallInteger('gifted_talented_child_in_technical')->nullable();
            $table->smallInteger('gifted_talented_child_in_sports')->nullable();
            $table->smallInteger('gifted_talented_child_in_art')->nullable();

            $table->smallInteger('provided_mentors_y_n')->nullable();
            $table->smallInteger('participated_in_nurturance_camps_y_n')->nullable();
            $table->smallInteger('state_level_y_n')->nullable();
            $table->smallInteger('national_level_y_n')->nullable();

            $table->smallInteger('appeared_state_olympiads_national_level_competition_y_n')->nullable();
            $table->smallInteger('participate_in_ncc_nss_scouts_guides_y_n')->nullable();
            $table->smallInteger('free_education_as_per_rte_act_y_n')->nullable();

            $table->smallInteger('child_homeless')->nullable();
            $table->smallInteger('complete_set_of_free_books_y_n')->nullable();
            $table->smallInteger('free_shoe_y_n')->nullable();
            $table->smallInteger('disadvantaged_group_y_n')->nullable();
            $table->smallInteger('free_exercise_book_y_n')->nullable();
            $table->smallInteger('special_training_facility_y_n')->nullable();
            $table->integer('central_scholarship_amount')->nullable();
            $table->integer('state_scholarship_amount')->nullable();
            $table->smallInteger('received_cwsn_braille_book_y_n')->nullable();
            $table->smallInteger('received_cwsn_braille_kit_y_n')->nullable();
            $table->smallInteger('received_cwsn_low_vision_kit_y_n')->nullable();
            $table->smallInteger('received_cwsn_braces_y_n')->nullable();
            $table->smallInteger('received_cwsn_crutches_y_n')->nullable();
            $table->smallInteger('received_cwsn_wheel_chair_y_n')->nullable();
            $table->smallInteger('received_cwsn_tri_cycle_y_n')->nullable();
            $table->smallInteger('received_cwsn_caliper_y_n')->nullable();
            $table->smallInteger('received_cwsn_escort_y_n')->nullable();
            $table->smallInteger('received_cwsn_hearing_aid_y_n')->nullable();
            $table->smallInteger('received_cwsn_stipend_y_n')->nullable();
            $table->smallInteger('received_cwsn_other_y_n')->nullable();

            $table->smallInteger('received_scholarship_kanyashree_code_fk')->nullable();
            $table->integer('kanyashree_scholarship_amount')->nullable();

            $table->smallInteger('facilities_received_cwsn_code_fk')->nullable();

            $table->smallInteger('digital_device_inc_internet_yn')->nullable();
            $table->smallInteger('digital_device_inc_internet_fk')->nullable();
            $table->string('entry_ip', 15)->nullable();
            $table->string('update_ip', 15)->nullable();
            $table->smallInteger('status')->default(1);
            $table->timestamps();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bs_student_facilities_and_other_details_temp');
    }
};
