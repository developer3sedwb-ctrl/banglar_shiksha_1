<?php

namespace App\Models\student_info;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentFacilityAndOtherDetails extends Model
{
    use SoftDeletes;

    protected $table = 'bs_student_facilities_and_other_details_temp';

    protected $fillable = [
        'school_id_fk',
        'district_code_fk',
        'subdivision_code_fk',
        'block_munc_code_fk',
        'circle_code_fk',
        'gs_ward_code_fk',
        'academic_year',

        // Facilities Provided
        'facilities_provided_y_n',
        'free_uniform_y_n',
        'free_transport_facility_y_n',
        'free_escort_y_n',
        'free_hostel_y_n',
        'free_mobile_tab_comp_y_n',
        'free_cycle_y_n',

        // Scholarship - Central
        'central_scholarship_rcv_y_n',
        'central_scholarship_code_fk',
        'central_scholarship_amount',

        // Scholarship - State
        'state_scholarship_rcv_y_n',
        'state_scholarship_code_fk',
        'state_scholarship_amount',

        // Scholarship - Other
        'other_scholarship_rcv_y_n',
        'other_scholarship_amount',

        // CWSN
        'facilities_provided_cwsn_y_n',
        'screened_for_specific_learning_disability_y_n',
        'type_of_specific_learning_disability',
        'screened_for_autism_spectrum_disorder_y_n',
        'screened_for_attention_deficit_hyperactive_disorder_y_n',

        // Gifted / Talented fields
        'extracurricular_activity_involved_y_n',
        'gifted_talented_child_in_mathematics',
        'gifted_talented_child_in_language',
        'gifted_talented_child_in_science',
        'gifted_talented_child_in_technical',
        'gifted_talented_child_in_sports',
        'gifted_talented_child_in_art',

        // Other Details – Nurturance Camps
        'provided_mentors_y_n',
        'participated_in_nurturance_camps_y_n',
        'state_level_y_n',
        'national_level_y_n',

        // Other participation & benefits
        'appeared_state_olympiads_national_level_competition_y_n',
        'participate_in_ncc_nss_scouts_guides_y_n',
        'free_education_as_per_rte_act_y_n',
        'child_homeless',
        'complete_set_of_free_books_y_n',
        'free_shoe_y_n',
        'disadvantaged_group_y_n',
        'free_exercise_book_y_n',
        'special_training_facility_y_n',

        // CWSN receiving items
        'received_cwsn_braille_book_y_n',
        'received_cwsn_braille_kit_y_n',
        'received_cwsn_low_vision_kit_y_n',
        'received_cwsn_braces_y_n',
        'received_cwsn_crutches_y_n',
        'received_cwsn_wheel_chair_y_n',
        'received_cwsn_tri_cycle_y_n',
        'received_cwsn_caliper_y_n',
        'received_cwsn_escort_y_n',
        'received_cwsn_hearing_aid_y_n',
        'received_cwsn_stipend_y_n',
        'received_cwsn_other_y_n',

        // Special Scholarship (Kanyashree)
        'received_scholarship_kanyashree_code_fk',
        'kanyashree_scholarship_amount',

        // CWSN Facility Code
        'facilities_received_cwsn_code_fk',

        // Digital
        'digital_device_inc_internet_yn',
        'digital_device_inc_internet_fk',

        // System fields
        'entry_ip',
        'update_ip',
        'status',
        'created_by',
        'updated_by',
    ];
}
