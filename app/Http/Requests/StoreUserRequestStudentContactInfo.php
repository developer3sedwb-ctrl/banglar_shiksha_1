<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequestStudentContactInfo extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

   public function rules(): array
    {
        return [
            // ---------- Student Contact Info (using incoming request names) ----------

            'student_country'        => 'required|integer|exists:bs_country_master,id',
            'student_address'        => 'required|string|max:300',
            'student_district'       => 'required|integer|exists:bs_district_master,id',
            'student_panchayat'      => 'required|string|max:100',
            'student_police_station' => 'required|string|max:100',
            'student_mobile'         => 'nullable|digits_between:7,15',
            'student_state'          => 'required|integer|exists:bs_state_master,id',
            'student_locality'       => 'required|string|max:300',
            'student_block'          => 'required|integer|exists:bs_block_munc_corp_master,id',
            'student_post_office'    => 'required|string|max:300',
            'student_pincode'        => 'required|digits:6',
            'student_email'          => 'nullable|email|max:100',

            // 'address_equal'          => 'required|in:0,1',

            // ---------- Guardian Contact Info ----------

            'guardian_country'       => 'nullable|integer|exists:bs_country_master,id',
            'guardian_state'         => 'nullable|integer|exists:bs_state_master,id',
            'guardian_address'       => 'nullable|string|max:300',
            'guardian_locality'      => 'nullable|string|max:300',
            'guardian_district'      => 'nullable|integer|exists:bs_district_master,id',
            'guardian_block'         => 'nullable|integer|exists:bs_block_munc_corp_master,id',
            'guardian_panchayat'     => 'nullable|string|max:100',
            'guardian_post_office'   => 'nullable|string|max:300',
            'guardian_police_station'=> 'nullable|string|max:100',
            'guardian_pincode'       => 'nullable|digits:6',
            'guardian_mobile'        => 'nullable|digits_between:7,15',
            'guardian_email'         => 'nullable|email|max:100',

            // ---------- System Fields ----------
            // 'created_by'             => 'required|integer',
            'updated_by'             => 'nullable|integer',
        ];
    }

    protected function prepareForValidation()
    {
        // Cast incoming int-like fields
        $intFields = [
            'student_country', 'student_district', 'student_state',
            'student_block', 'address_equal',

            'guardian_country', 'guardian_state',
            'guardian_district', 'guardian_block',

            'created_by', 'updated_by'
        ];

        foreach ($intFields as $field) {
            if ($this->filled($field)) {
                $this->merge([$field => (int) $this->{$field}]);
            }
        }
    }
}
