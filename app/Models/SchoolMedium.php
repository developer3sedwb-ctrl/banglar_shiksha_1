<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SchoolMedium extends Model
{
    use SoftDeletes;

    protected $table = 'bs_school_medium';

    protected $fillable = [
        'school_code_fk',
        'medium_code_fk',
    ];

    /**
     * Get the school related to this record.
     */
    public function school()
    {
        return $this->belongsTo(SchoolMaster::class, 'school_code_fk', 'id');
    }

    /**
     * Get the medium related to this record.
     */
    public function medium()
    {
        return $this->belongsTo(MediumMaster::class, 'medium_code_fk', 'id');
    }
}
