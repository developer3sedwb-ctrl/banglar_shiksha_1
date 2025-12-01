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
            'antyodaya_anna_yojana'           => 'nullable|in:0,1',  



            'disadvantaged_group'               => 'required|in:0,1',

            'cwsn'                             => 'required|in:0,1',
            'type_of_impairment'               => 'nullable',

            'nationality'                     => 'required|integer|exists:bs_nationality_master,id',
            'out_of_school'                   => 'required|in:0,1',

            'blood_group'                     => 'nullable|integer|exists:bs_blood_group_master,id',

            'birth_reg_no'                    => 'nullable|string|max:50',
            'identification_mark'             => 'nullable|string|max:100',
            'health_id'                       => 'nullable|string|max:50',

            'relationship_with_guardian'      => 'required|integer|exists:bs_guardian_relationship_master,id',
            'family_income'                   => 'required|integer|exists:bs_income_master,id',

            'student_height'                  => 'required|integer|min:1|max:300',
            'student_weight'                  => 'required|integer|min:1|max:500',

            'guardian_qualifications'         => 'required|integer|exists:bs_guardian_qualification_master,id',
        ];
    }

        protected function prepareForValidation()
        {
            $intFields = [
                'gender', 'mother_tongue', 'social_category', 'religion',
                'nationality', 'blood_group', 'relationship_with_guardian',
                'family_income', 'guardian_qualifications' , 'antyodaya_anna_yojana',
            ];

            foreach ($intFields as $field) {
                if ($this->filled($field)) {
                    $this->merge([$field => (int) $this->{$field}]);
                }
            }
        }

}
