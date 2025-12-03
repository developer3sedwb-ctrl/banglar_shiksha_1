<?php
namespace App\Models\student_info;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentEntryDraftTracker extends Model
{
    use SoftDeletes;

    protected $table = 'bs_student_entry_draft_tracker';

    protected $fillable = [
        'school_id_fk',
        'step_number',
        'created_by',
        'updated_by'
    ];
}
