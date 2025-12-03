<?php

namespace App\Models\student_info;

use Illuminate\Database\Eloquent\Model;

class StudentContactInfo extends Model
{
    protected $table = 'bs_student_contact_info_temp';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
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

        'status',
        'entry_ip',
        'update_ip',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by',
        'deleted_at',
    ];

    protected $casts = [
        'stu_country_code_fk'       => 'integer',
        'stu_contact_district'      => 'integer',
        'stu_state_code_fk'         => 'integer',
        'stu_contact_block'         => 'integer',

        'guardian_country_code_fk'  => 'integer',
        'guardian_state_code_fk'    => 'integer',
        'guardian_contact_district' => 'integer',
        'guardian_contact_block'    => 'integer',

        'address_equal'             => 'integer',

        'status'                    => 'integer',
        'created_by'                => 'integer',
        'updated_by'                => 'integer',

        'created_at'                => 'datetime',
        'updated_at'                => 'datetime',
        'deleted_at'                => 'datetime',
    ];

}
