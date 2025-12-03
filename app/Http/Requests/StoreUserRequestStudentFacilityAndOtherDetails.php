<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequestStudentFacilityAndOtherDetails extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

public function rules(): array
{
    $rules = [

        // Facilities
        'facilities_provided_for_the_yeear' => 'required|in:1,2',
        'free_transport_facility'           => 'required|in:1,2',
        'free_host_facility'                => 'required|in:1,2',
        'free_bicycle'                      => 'required|in:1,2',
        'free_uniforms'                     => 'required|in:1,2',
        'free_escort'                       => 'required|in:1,2',
        'free_shoe'                         => 'required|in:1,2',
        'free_exercise_book'                => 'required|in:1,2',
        'complete_free_books'               => 'required|in:1,2',

        // Scholarships
        'central_scholarship'               => 'required|in:1,2',
        'state_scholarship'                 => 'required|in:1,2',
        'other_scholarship'                 => 'required|in:1,2',

        // Gifted / Extracurricular
        'child_hyperactive_disorder'        => 'required|in:1,2',
        'stu_extracurricular_activity'      => 'required|in:1,2',

        // Other Details
        'provided_mentors'                  => 'required|in:1,2',
        'whether_participated_nurturance_camp' => 'required|in:1,2',
        'participated_competitions'         => 'required|in:1,2',
        'ncc_nss_guides'                    => 'required|in:1,2',
        'rte_free_education'                => 'required|in:1,2',
        'homeless'                          => 'required|in:1,2,999',
        'special_training'                  => 'required|in:1,2',

        // Digital
        'able_to_handle_devices'            => 'required|in:1,2',
        'internet_access'                   => 'required|in:1,2',
    ];

    // ---------------------------------------------------
    // CONDITIONAL RULES (WORKS NOW)
    // ---------------------------------------------------

    // Central scholarship = YES
    if ($this->input('central_scholarship') == 1) {
        $rules['central_scholarship_name']   = 'required|numeric|min:1|max:99';
        $rules['central_scholarship_amount'] = 'required|numeric|min:1';
    }

    // State scholarship = YES
    if ($this->input('state_scholarship') == 1) {
        $rules['state_scholarship_name']   = 'required|numeric|min:1|max:15';
        $rules['state_scholarship_amount'] = 'required|numeric|min:1';
    }

    // Other scholarship = YES
    if ($this->input('other_scholarship') == 1) {
        $rules['other_scholarship_amount'] = 'required|numeric|min:1';
    }

    // Extracurricular YES → gifted fields required
    if ($this->input('stu_extracurricular_activity') == 1) {
        $rules['gifted_math']      = 'required|in:1,2';
        $rules['gifted_language']  = 'required|in:1,2';
        $rules['gifted_science']   = 'required|in:1,2';
        $rules['gifted_technical'] = 'required|in:1,2';
        $rules['gifted_sports']    = 'required|in:1,2';
        $rules['gifted_art']       = 'required|in:1,2';
    }

    // Nurturance Camp = NO
    if ($this->input('whether_participated_nurturance_camp') == 2) {
        $rules['state_nurturance']   = 'required|in:1,2';
        $rules['national_nurturance'] = 'required|in:1,2';
    }

    return $rules;
}

}
