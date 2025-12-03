<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VocationalJobRoleMaster extends Model
{
    //
    protected $table = 'bs_vocational_job_role_master';

    protected $fillable = [
        'id',
        'name',
        'sector_code_fk',
        'status'
    ];

    public $incrementing = false; // because id values come from old master
    protected $keyType = 'int';

    /**
     * Job role belongs to a sector
     */
    public function sector()
    {
        return $this->belongsTo(VocationalTradeSectorMaster::class, 'sector_code_fk', 'id');
    }
}
