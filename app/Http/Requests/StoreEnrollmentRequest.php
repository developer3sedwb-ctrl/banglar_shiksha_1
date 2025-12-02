<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEnrollmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            // -------------------------
            // Admission Basic
            // -------------------------
            'admission_number'     => 'nullable|string|max:10',
            // 

            // -------------------------
            // Previous Academic Year
            // -------------------------
            'admission_status_prev' => 'required|integer|exists:bs_previous_schooling_type_master,id',

            // If previous schooling = "1" → show previous-class details
            'prev_class_appeared_exam'         => 'required_if:admission_status_prev,1|nullable|integer',
            'previous_class_result_examination'=> 'required_if:prev_class_appeared_exam,1|nullable|integer|exists:bs_stu_appeared_master,id',
            'percentage_of_overall_marks'      => 'required_if:prev_class_appeared_exam,1|nullable|numeric|min:0|max:100',
            'no_of_days_attended'              => 'required_if:admission_status_prev,1|nullable|integer|min:0|max:365',

            'previous_class'  => 'required_if:admission_status_prev,1|nullable|integer|exists:bs_class_master,id',
            'class_section'   => 'required_if:admission_status_prev,1|nullable|integer|exists:bs_class_section_master,id',
            'student_stream'  => 'required_if:admission_status_prev,1|nullable|integer|exists:bs_stream_master,id',
            'previous_student_roll_no' => 'required_if:admission_status_prev,1|nullable|string|max:10',

            // -------------------------
            // Present / Current Year
            // -------------------------
            'present_class'   => 'required|integer|exists:bs_class_master,id',
            'accademic_year'  => 'required|integer|min:2000|max:2100', // adjust range if needed
            'present_section' => 'required|integer|exists:bs_school_classwise_section,id',
            'school_medium'   => 'required|integer|exists:bs_school_medium,id',
            'present_roll_no' => 'nullable|integer|min:0',
            'admission_date_present' => 'nullable|date',
            'admission_type'  => 'nullable|integer|exists:bs_admission_type_master,id',
        ];
    }

    /**
     * Prepare values before validation: convert strings to integers.
     */
    protected function prepareForValidation()
    {
        $intFields = [
            'admission_status_prev', 'prev_class_appeared_exam',
            'previous_class_result_examination', 'previous_class',
            'class_section', 'student_stream', 'present_class',
            'accademic_year', 'present_section', 'school_medium',
            'admission_type'
        ];

        foreach ($intFields as $field) {
            if ($this->filled($field)) {
                $this->merge([
                    $field => (int)$this->{$field}
                ]);
            }
        }
    }
}
