<?php

namespace App\Models\student_info;

use Illuminate\Database\Eloquent\Model;

class StudentInfo extends Model
{
    protected $table = 'bs_student_general_info_temp';
    protected $primaryKey = 'id';
    public $timestamps = true; // created_at/updated_at
    // Use guarded or fillable — fillable example below
    protected $fillable = [
        'studentname',
        'studentname_as_per_aadhaar',
        'school_id_fk',
        'gender_code_fk',
        'dob', // see note below
        'fathername',
        'mothername',
        'guardian_name',
        'aadhaar_number',
        'mothertonge_code_fk',
        'social_category_code_fk',
        'religion_code_fk',
        'bpl_y_n',
        'bpl_no',
        'bpl_aay_beneficiary_y_n',
        'disadvantaged_group_y_n',
        'cwsn_y_n',
        'cwsn_disability_type_code_fk',
        'disability_percentage',
        'nationality_code_fk',
        'out_of_sch_child_y_n',
        
        'child_mainstreamed',   
        'blood_group_code_fk',
        'birth_registration_number',
        'identification_mark',
        'health_id',
        'stu_guardian_relationship',
        'guardian_family_income',
        'stu_height_in_cms',
        'stu_weight_in_kgs',
        'guardian_qualification',
        'cur_stream_code_fk',
        'created_by',
        'updated_by',
    ];

    // cast types where appropriate
    protected $casts = [
        'school_id_fk' => 'integer',
        'gender_code_fk' => 'integer',
        'mothertonge_code_fk' => 'integer',
        'social_category_code_fk' => 'integer',
        'religion_code_fk' => 'integer',
        'bpl_y_n' => 'integer',
        'bpl_aay_beneficiary_y_n' => 'integer',
        'disadvantaged_group_y_n' => 'integer',
        'cwsn_y_n' => 'integer',
        'cwsn_disability_type_code_fk' => 'integer',
        'disability_percentage' => 'integer',
        'nationality_code_fk' => 'integer',
        'out_of_sch_child_y_n' => 'integer',
        'blood_group_code_fk' => 'integer',
        'stu_guardian_relationship' => 'integer',
        'guardian_family_income' => 'integer',
        'stu_height_in_cms' => 'integer',
        'stu_weight_in_kgs' => 'integer',
        'guardian_qualification' => 'integer',
        'created_by' => 'integer',
        'updated_by' => 'integer',
    ];
}
