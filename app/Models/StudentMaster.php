<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentMaster extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'bs_student_master';

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

    /**
     * Relationship with District
     */
    public function district()
    {
        return $this->belongsTo(DistrictMaster::class, 'district_code_fk', 'id');
    }

    /**
     * Relationship with Circle
     */
    public function circle()
    {
        return $this->belongsTo(CircleMaster::class, 'circle_code_fk', 'id');
    }

    /**
     * Relationship with Subdivision
     */
    public function subdivision()
    {
        return $this->belongsTo(SubdivisionMaster::class, 'subdivision_code_fk','id');
    }

    /**
     * Relationship with Block (using circle_code_fk)
     */
    public function block()
    {
        return $this->belongsTo(BlockMaster::class, 'circle_code_fk', 'id');
    }

    /**
     * Relationship with School
     */
    public function school()
    {
        return $this->belongsTo(SchoolMaster::class, 'school_code_fk', 'id');
    }

    /**
     * Relationship with Gender
     */
    public function gender()
    {
        return $this->belongsTo(GenderMaster::class, 'gender_code_fk', 'id');
    }


    public function currentClass()
    {
        return $this->belongsTo(ClassMaster::class, 'cur_class_code_fk', 'id');
    }
    public function currentSection()
    {
        return $this->belongsTo(ClassSectionMaster::class, 'cur_section_code_fk', 'id');
    }
    public function category()
    {
        return $this->belongsTo(CategoryMaster::class, 'social_category_code_fk', 'id');
    }

    /**
     * Relationship with Management (via School)
     */
    public function management()
    {
        return $this->hasOneThrough(
            ManagementMaster::class,
            SchoolMaster::class,
            'id', // Foreign key on SchoolMaster table
            'id', // Foreign key on ManagementMaster table
            'school_id_fk', // Local key on StudentMaster table
            'management_id' // Local key on SchoolMaster table
        );
    }

    /**
     * Scope for active students
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    /**
     * Scope for male students
     */
    public function scopeMale($query)
    {
        return $query->where('gender_code_fk', 'Male');
    }

    /**
     * Scope for female students
     */
    public function scopeFemale($query)
    {
        return $query->where('gender_code_fk', 'Female');
    }

    /**
     * Scope for BPL students
     */
    public function scopeBpl($query)
    {
        return $query->where('bpl_y_n', 'Y');
    }

    /**
     * Scope for CWSN students
     */
    public function scopeCwsn($query)
    {
        return $query->where('cwsn_y_n', 'Y');
    }

    /**
     * Accessor for student name
     */
    public function getStudentNameAttribute()
    {
        return $this->studentname ?? $this->studentname_as_per_aadhaar;
    }

    /**
     * Accessor for formatted Aadhaar number
     */
    public function getFormattedAadhaarAttribute()
    {
        if (!$this->aadhaar_number) {
            return null;
        }

        $aadhaar = str_replace(' ', '', $this->aadhaar_number);
        if (strlen($aadhaar) == 12) {
            return substr($aadhaar, 0, 4) . ' ' . substr($aadhaar, 4, 4) . ' ' . substr($aadhaar, 8, 4);
        }

        return $aadhaar;
    }

    /**
     * Accessor for age calculation
     */
    public function getAgeAttribute()
    {
        if (!$this->dob) {
            return null;
        }

        return \Carbon\Carbon::parse($this->dob)->age;
    }
}
