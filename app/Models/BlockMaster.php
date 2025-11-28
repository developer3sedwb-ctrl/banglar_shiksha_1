<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlockMaster extends Model
{
    use SoftDeletes;

    protected $table = 'bs_block_munc_corp_master';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'district_id',
        'subdivision_id',
        'schcd',
        'name',
        'type',
        'status',
    ];

    protected $casts = [
        'district_id'   => 'integer',
        'subdivision_id'=> 'integer',
        'status'        => 'integer',
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
        'deleted_at'    => 'datetime',
    ];

    protected $attributes = [
        'status' => 1,
    ];

    // 🔹 Relationships (optional, if related models exist)
    public function district()
    {
        return $this->belongsTo(BsDistrictMaster::class, 'district_id');
    }

    public function subdivision()
    {
        return $this->belongsTo(BsSubdivisionMaster::class, 'subdivision_id');
    }
}
