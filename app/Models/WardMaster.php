<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WardMaster extends Model
{
    use HasFactory, SoftDeletes;

    // Table name
    protected $table = 'bs_gs_ward_master';

    // Primary key
    protected $primaryKey = 'id';

    // Auto-incrementing primary key
    public $incrementing = true;

    // PostgreSQL uses bigint
    protected $keyType = 'int';

    // Enable Laravel timestamps (since created_at, updated_at exist)
    public $timestamps = true;

    // Fillable columns (mass-assignable)
    protected $fillable = [
        'name',
        'block_munc_corp_id',
        'schcd',
        'status',
    ];

    // Use 'deleted_at' column for soft deletes
    protected $dates = ['deleted_at'];

    /**
     * Relationship: A Ward belongs to a Block/Municipality/Corporation.
     * (assuming there is a table `bs_block_munc_corp_master`)
     */
    public function blockMunicipality()
    {
        return $this->belongsTo(BlockMaster::class, 'block_munc_corp_id');
    }
}
