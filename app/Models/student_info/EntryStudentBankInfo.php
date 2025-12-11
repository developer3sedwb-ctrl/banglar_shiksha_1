<?php

namespace App\Models\student_info;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class EntryStudentBankInfo extends Model
{
    use SoftDeletes;
    protected $table = 'bs_student_bank_details_temp';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'school_id_fk',
        'bank_id_fk',
        'branch_id_fk',
        'bank_ifsc',
        'stu_bank_acc_no',
        'status',
        // System
        'entry_ip',
        'update_ip',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by',
        'deleted_at',
    ];

    protected $casts = [
        'school_id_fk'  => 'integer',
        'bank_id_fk'    => 'integer',
        'branch_id_fk'  => 'integer',

        'status'        => 'integer',
        'created_by'    => 'integer',
        'updated_by'    => 'integer',

        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
        'deleted_at'    => 'datetime',
    ];
}
