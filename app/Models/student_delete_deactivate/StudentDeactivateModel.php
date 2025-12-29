<?php

namespace App\Models\student_delete_deactivate;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\ReasonStudentDeactivationMaster;
use App\Models\StudentMaster;
use App\Models\ClassMaster;
use App\Models\ClassSectionMaster;
use App\Models\SchoolMaster;

class StudentDeactivateModel extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'bs_student_activate_deactivate_track';
    protected $primaryKey = 'id';

    protected $fillable = [
        'student_code',
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
        'prev_status',
        'status'
    ];
    public function deleteReason()
    {
        return $this->belongsTo(ReasonStudentDeactivationMaster::class, 'deactivate_reason_code_fk','id');
    }
    public function studentInfo()
    {
        return $this->belongsTo(StudentMaster::class, 'student_code','student_code');
    }
    public function currentClass()
    {
        return $this->belongsTo(ClassMaster::class, 'cur_class_code_fk', 'id');
    }
    public function currentSection()
    {
        return $this->belongsTo(ClassSectionMaster::class, 'cur_section_code_fk', 'id');
    }
    public function schoolInfo()
    {
        return $this->belongsTo(SchoolMaster::class,'school_code_fk','id');
    }

}
