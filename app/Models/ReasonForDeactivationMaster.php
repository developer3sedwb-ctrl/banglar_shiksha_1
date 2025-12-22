<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ReasonForDeactivationMaster extends Model
{
    //
    use SoftDeletes;
    protected $table = 'bs_reason_student_deactivation_master';

}
