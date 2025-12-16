<?php


namespace App\Models\student_info;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentAdditionalInfo extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'bs_student_master_other_addon_data_temp';

    protected $primaryKey = 'id';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'school_id_fk',
        'district_code_fk',
        'rte_entitlement_claimed_amount',
        'disabality_certificate_y_n',
        'stu_residance_sch_distance_code_fk',
        'cur_class_appeared_exam',
        'cur_class_marks_percent',
        'attendention_cur_year',
        'entry_ip',
        'update_ip',
        'status',
        'created_by',
        'updated_by',
        'update_by_stake_cd',
    ];

    protected $casts = [
        'cur_class_marks_percent' => 'decimal:2',
        'status' => 'integer',
    ];
}
