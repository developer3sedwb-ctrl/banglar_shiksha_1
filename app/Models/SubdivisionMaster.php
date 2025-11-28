<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubdivisionMaster extends Model
{
    use SoftDeletes;

    protected $table = 'bs_subdivision_master';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'district_id',
        'schcd',
        'name',
        'status',
    ];

    protected $casts = [
        'district_id' => 'integer',
        'status'      => 'integer',
        'created_at'  => 'datetime',
        'updated_at'  => 'datetime',
        'deleted_at'  => 'datetime',
    ];

    protected $attributes = [
        'status' => 1,
    ];

    /**
     * Relationship: belongs to District
     */
    public function district()
    {
        return $this->belongsTo(DistrictMaster::class, 'district_id');
    }
}
