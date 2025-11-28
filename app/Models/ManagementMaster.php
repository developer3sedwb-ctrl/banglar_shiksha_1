<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ManagementMaster extends Model
{
    
    use SoftDeletes;

    protected $table = 'bs_management_master';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'status',
    ];

    protected $casts = [
        'id' => 'integer',
        'status' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    // Relationships
    public function mappings()
    {
        return $this->hasMany(ManagementAndSchoolCategoryTypeMappingMaster::class, 'school_management_code_pk', 'id');
    }
}
