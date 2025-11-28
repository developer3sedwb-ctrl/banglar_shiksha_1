<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClusterMaster extends Model
{
    use SoftDeletes;

    protected $table = 'bs_cluster_master';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'name',
        'district_id',
        'block_munc_corp_id',
        'schcd',
        'status',
    ];

    protected $casts = [
        'district_id'         => 'integer',
        'block_munc_corp_id'  => 'integer',
        'status'              => 'integer',
        'created_at'          => 'datetime',
        'updated_at'          => 'datetime',
        'deleted_at'          => 'datetime',
    ];

    protected $attributes = [
        'status' => 1,
    ];

    // 🔹 Relationships (optional, if related tables exist)
    public function district()
    {
        return $this->belongsTo(BsDistrictMaster::class, 'district_id');
    }

    public function blockOrMunicipality()
    {
        return $this->belongsTo(BsBlockMuncCorpMaster::class, 'block_munc_corp_id');
    }
}
