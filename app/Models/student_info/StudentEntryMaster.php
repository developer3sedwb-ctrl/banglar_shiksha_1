<?php

namespace App\Models\student_info;

use Illuminate\Database\Eloquent\Model;

class StudentEntryMaster extends Model
{
    protected $table = 'bs_student_master';

    // Composite primary key
    protected $primaryKey = ['district_code_fk', 'student_code'];
    public $incrementing = false;
    protected $keyType = 'string';

    public $timestamps = true;

    protected $fillable = [
        'id',
        'district_code_fk',
        'subdivision_code_fk',
        'circle_code_fk',
        'gs_ward_code_fk',
        'academic_year',
        'student_code',
        'studentname',
        'studentname_as_per_aadhaar',
        'school_id_fk',
        'gender_code_fk',
        'dob',
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
        'stu_country_code_fk',
        'stu_contact_address',
        'stu_contact_district',
        'stu_contact_panchayat',
        'stu_police_station',
        'stu_mobile_no',
        'stu_state_code_fk',
        'stu_contact_habitation',
        'stu_contact_block',
        'stu_post_office',
        'stu_pin_code',
        'stu_email',
        'address_equal',
        'guardian_country_code_fk',
        'guardian_state_code_fk',
        'guardian_contact_address',
        'guardian_contact_habitation',
        'guardian_contact_district',
        'guardian_contact_block',
        'guardian_contact_panchayat',
        'guardian_post_office',
        'guardian_police_station',
        'guardian_pin_code',
        'guardian_mobile_no',
        'guardian_email',
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
        'medium_code_fk',
        'admission_type_code_fk',
        'bank_ifsc',
        'stu_bank_acc_no',
        'status',
        'entry_ip',
        'update_ip',
        'created_by',
        'updated_by',
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'dob' => 'date',
        'admission_date' => 'date',
        'prev_class_marks_percent' => 'float',
    ];

    /**
     * Override Eloquent for composite keys
     */
    // protected function setKeysForSaveQuery($query)
    // {
    //     return $query->where('district_code_fk', $this->getAttribute('district_code_fk'))
    //                  ->where('student_code', $this->getAttribute('student_code'));
    // }
}
