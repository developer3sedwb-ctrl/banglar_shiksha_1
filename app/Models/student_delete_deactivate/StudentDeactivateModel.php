<?php

namespace App\Models\student_delete_deactivate;

use Illuminate\Database\Eloquent\Model;

class StudentDeactivateModel extends Model
{
    protected $table = 'bs_student_activate_deactivate_track';
    protected $primaryKey = 'id';

    protected $fillable = [
        'school_code_fk',
        'district_code_fk',
        'circle_code_fk',
        'cur_class_code_fk',
        'cur_section_code_fk',
        'deactivate_reason_code_fk',
        'operation_by',
        'operation_by_stake_cd',
        'operation_time',
        'operation_ip',
        'prev_status'
    ];

}
