<?php

namespace App\Models\student_info;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentVocationalDetails extends Model
{
    use SoftDeletes;

    protected $table = 'bs_student_vocational_details_temp';

    protected $primaryKey = 'id';

    protected $fillable = [
        'school_id_fk',
        'district_code_fk',
        'subdivision_code_fk',
        'block_munc_code_fk',
        'circle_code_fk',
        'gs_ward_code_fk',

        'exposure_vocational_activities_y_n',
        'undertake_vocational_course_y_n',

        'vocational_course_code_fk',
        'vocational_trade_sector_code_fk',
        'vocational_job_role_code_fk',

        'vocational_class_attended_theory',
        'vocational_class_attended_practical',
        'vocational_class_attended_industry_training',
        'vocational_class_attended_field_visit',

        'prev_class_exam_appeared_fk',
        'prev_class_marks_percent_voc',

        'applied_for_placement_code_fk',
        'applied_for_apprenticeship_code_fk',

        'vocational_nsqf_level_code_fk',
        'vocational_placement_status_code_fk',
        'vocational_salary_offered',

        'status',
        'entry_ip',
        'update_ip',
        'created_by',
        'updated_by'
    ];

    protected $casts = [
        'exposure_vocational_activities_y_n' => 'integer',
        'undertake_vocational_course_y_n'    => 'integer',

        'vocational_class_attended_theory'            => 'integer',
        'vocational_class_attended_practical'         => 'integer',
        'vocational_class_attended_industry_training' => 'integer',
        'vocational_class_attended_field_visit'       => 'integer',

        'prev_class_marks_percent_voc' => 'decimal:2',

        'vocational_salary_offered' => 'integer',
    ];

    /* ---------------------------------------
       RELATIONSHIPS 
    ----------------------------------------*/

    // School
    // public function school()
    // {
    //     return $this->belongsTo(\App\Models\SchoolMaster::class, 'school_id_fk');
    // }

    // // District
    // public function district()
    // {
    //     return $this->belongsTo(\App\Models\DistrictMaster::class, 'district_code_fk');
    // }

    // // Subdivision
    // public function subdivision()
    // {
    //     return $this->belongsTo(\App\Models\SubdivisionMaster::class, 'subdivision_code_fk');
    // }

    // // Block / Municipality
    // public function block()
    // {
    //     return $this->belongsTo(\App\Models\BlockMaster::class, 'block_munc_code_fk');
    // }

    // // Circle
    // public function circle()
    // {
    //     return $this->belongsTo(\App\Models\CircleMaster::class, 'circle_code_fk');
    // }

    // // Ward
    // public function ward()
    // {
    //     return $this->belongsTo(\App\Models\WardMaster::class, 'gs_ward_code_fk');
    // }

    // // Trade Sector
    // public function tradeSector()
    // {
    //     return $this->belongsTo(\App\Models\VocationalTradeSectorMaster::class, 'vocational_trade_sector_code_fk');
    // }

    // // Job Role
    // public function jobRole()
    // {
    //     return $this->belongsTo(\App\Models\VocationalJobRoleMaster::class, 'vocational_job_role_code_fk');
    // }
}
