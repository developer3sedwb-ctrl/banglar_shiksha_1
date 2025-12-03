<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequestStudentEntry extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'student_name'                    => 'required|string|max:500',
            'student_name_as_per_aadhaar'     => 'nullable|string|max:500',
            'gender'                          => 'required|integer|exists:bs_gender_master,id',
            'dob'                             => 'required|date',
            'father_name'                     => 'required|string|max:500',
            'mother_name'                     => 'required|string|max:500',
            'guardian_name'                   => 'required|string|max:500',
            'aadhaar_child'                   => 'nullable|digits:12|unique:bs_student_general_info_temp,aadhaar_number',
            'mother_tongue'                   => 'required|integer|exists:bs_mother_tongue_master,id',
            'social_category'                 => 'required|integer|exists:bs_social_category_master,id',
            'religion'                        => 'required|integer|exists:bs_religion_master,id',
            'bpl_beneficiary'                 => 'required|in:0,1',
            'antyodaya_anna_yojana'           => 'required_if:bpl_beneficiary,1|nullable',
            'bpl_number'                      => 'required_if:bpl_beneficiary,1|nullable',
            'disadvantaged_group'             => 'required|in:0,1',
            'cwsn'                            => 'required|in:0,1',
            'type_of_impairment'              => 'required_if:cwsn,1|nullable',
            'disability_percentage'           => 'required_if:cwsn,1|nullable|integer|min:0|max:100',
            'nationality'                     => 'required|integer|exists:bs_nationality_master,id',
            'out_of_school'                   => 'required|in:0,1',
            'mainstreamed'                    => 'required_if:out_of_school,1|nullable',
            'blood_group'                     => 'nullable|integer|exists:bs_blood_group_master,id',
            'birth_reg_no'                    => 'nullable|string|max:50',
            'identification_mark'             => 'nullable|string|max:100',
            'health_id'                       => 'nullable|string|max:50',
            'relationship_with_guardian'      => 'required|integer|exists:bs_guardian_relationship_master,id',
            'family_income'                   => 'required|integer|exists:bs_income_master,id',
            'student_height'                  => 'required|integer|min:1|max:300',
            'student_weight'                  => 'required|integer|min:1|max:500',
            'guardian_qualifications'         => 'required|integer|exists:bs_guardian_qualification_master,id',



             // ---- Enrollment fields (added) ----
            // Admission number in school (optional but validated if present)
            'admission_number'                => 'nullable|string|max:10',

            // Previous academic year status (required to determine previous-class related fields)
            'admission_status_prev'           => 'required|integer|exists:bs_previous_schooling_type_master,id',

            // If previous status indicates there was a previous class (UI used "1" to show those fields)
            'prev_class_appeared_exam'        => 'required_if:admission_status_prev,1|nullable',
            'previous_class_result_examination' => 'required_if:prev_class_appeared_exam,1|nullable|integer|exists:bs_stu_appeared_master,id',
            'percentage_of_overall_marks'     => 'required_if:prev_class_appeared_exam,1|nullable|numeric|min:0|max:100',
            'no_of_days_attended'             => 'required_if:admission_status_prev,1|nullable|integer|min:0|max:365',
            'previous_class'                  => 'required_if:admission_status_prev,1|nullable|integer|exists:bs_class_master,id',
            'class_section'                   => 'required_if:admission_status_prev,1|nullable|integer|exists:bs_class_section_master,id',
            'student_stream'                  => 'required_if:admission_status_prev,1|nullable|integer|exists:bs_stream_master,id',
            'previous_student_roll_no'        => 'required_if:admission_status_prev,1|nullable|string|max:10',

            // Present/current enrollment
            'present_class'                   => 'required|integer|exists:bs_class_master,id',
            'accademic_year'                  => 'required|integer', // validate values via controller if needed
            'present_section'                 => 'required|integer|exists:bs_school_classwise_section,id',
            'school_medium'                   => 'required|integer|exists:bs_school_medium,id',
            'admission_date_present'          => 'nullable|date',
            'present_roll_no'                 => 'nullable|integer|min:0',
            'admission_type'                  => 'nullable|integer|exists:bs_admission_type_master,id',
        ];
    }

        protected function prepareForValidation()
        {
            $intFields = [
                'gender', 'mother_tongue', 'social_category', 'religion',
                'nationality', 'blood_group', 'relationship_with_guardian',
                'family_income', 'guardian_qualifications' , 'antyodaya_anna_yojana',
                    // enrollment ints
            'admission_status_prev', 'prev_class_appeared_exam',
            'previous_class_result_examination', 'previous_class', 'class_section',
            'student_stream', 'present_class', 'accademic_year', 'present_section',
            'school_medium', 'admission_type',
            ];

        foreach ($intFields as $field) {
            if ($this->filled($field)) {
                $this->merge([$field => (int) $this->{$field}]);
            }
        }
    }

}
