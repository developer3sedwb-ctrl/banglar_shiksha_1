<?php

namespace App\Models\student_info;

use Illuminate\Database\Eloquent\Model;

class StudentEnrollmentInfo extends Model
{

    // use SoftDeletes; 

    protected $table = 'bs_student_enrollment_details_temp';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'school_id_fk',
        'admission_no',
        'admission_date',
        'status_pre_year',
        'prev_class_appeared_exam',
        'prev_class_exam_result',
        'prev_class_marks_percent',
        'attendention_pre_year',
        'pre_roll_number',
        'pre_class_code_fk',
        'pre_section_code_fk',
        'pre_stream_code_fk',
        'cur_class_code_fk',
        'cur_section_code_fk',
        'cur_stream_code_fk',
        'cur_roll_number',
        'academic_year',
        'medium_code_fk',
        'admission_type_code_fk',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'school_id_fk'              => 'integer',
        'status_pre_year'           => 'integer',
        'prev_class_appeared_exam'  => 'integer',
        'prev_class_exam_result'    => 'integer',
        'prev_class_marks_percent'  => 'float',
        'attendention_pre_year'     => 'integer',
        'pre_roll_number'           => 'integer',
        'pre_class_code_fk'         => 'integer',
        'pre_section_code_fk'       => 'integer',
        'pre_stream_code_fk'        => 'integer',
        'cur_class_code_fk'         => 'integer',
        'cur_section_code_fk'       => 'integer',
        'cur_stream_code_fk'        => 'integer',
        'cur_roll_number'           => 'integer',
        'academic_year'             => 'integer',
        'medium_code_fk'            => 'integer',
        'admission_type_code_fk'    => 'integer',
        'created_by'                => 'integer',
        'updated_by'                => 'integer',
    ];
}
