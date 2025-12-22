<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequestStudentDeactivate extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

protected function rules(): array
{
    return [
        'student_code' => [
            'required',
            'string',
            'size:14',                 // fixed-length student code
        ],

        'school_code_fk' => [
            'required',
            'integer',
            'exists:bs_school_master,id',
        ],

        'district_code_fk' => [
            'required',
            'integer',
            'exists:bs_district_master,id',
        ],

        'circle_code_fk' => [
            'required',
            'integer',
            'exists:bs_circle_master,id',
        ],

        'cur_class_code_fk' => [
            'required',
            'integer',
            'exists:bs_class_master,id',
        ],

        'cur_section_code_fk' => [
            'required',
            'integer',
            'exists:bs_section_master,id',
        ],

        'deactivate_reason_code_fk' => [
            'required',
            'integer',
            'exists:bs_student_deactivate_reason_master,id',
        ],

        'prev_status' => [
            'required',
            'string',
            'in:1,2,3',               // A=Active, I=Inactive, D=Deactivated
        ],
    ];
}



}