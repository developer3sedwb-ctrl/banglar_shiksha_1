<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequestStudentVocationalDetails extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'exposure_vocational_activities_y_n' => ['required', 'in:1,2'],
            'undertook_vocational_course' => ['required', 'in:1,2'],

            // Required only when course = YES
            'trade_sector'      => ['required_if:undertook_vocational_course,1', 'nullable', 'integer'],
            'job_role'          => ['required_if:undertook_vocational_course,1', 'nullable', 'integer'],

            'theory_hours'      => ['required_if:undertook_vocational_course,1', 'nullable', 'integer', 'min:0'],
            'practical_hours'   => ['required_if:undertook_vocational_course,1', 'nullable', 'integer', 'min:0'],
            'industry_hours'    => ['required_if:undertook_vocational_course,1', 'nullable', 'integer', 'min:0'],
            'field_visit_hours' => ['required_if:undertook_vocational_course,1', 'nullable', 'integer', 'min:0'],

            'appeared_exam'     => ['required_if:undertook_vocational_course,1', 'nullable', 'in:0,1,2'],
            'marks_obtained'    => ['required_if:appeared_exam,1,2', 'nullable', 'numeric'],

            'placement_applied'     => ['required_if:undertook_vocational_course,1', 'nullable', 'in:1,2,3'],
            'apprenticeship_applied'=> ['required_if:undertook_vocational_course,1', 'nullable', 'in:1,2,3'],

            'nsqf_level'        => ['required_if:undertook_vocational_course,1', 'nullable', 'integer'],
            'employment_status' => ['required_if:undertook_vocational_course,1', 'nullable', 'in:0,1,2,3'],

            'salary_offered'    => ['required_if:employment_status,1', 'nullable', 'numeric'],
        ];
    }


}
