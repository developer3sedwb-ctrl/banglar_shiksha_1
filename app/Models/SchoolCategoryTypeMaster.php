<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SchoolCategoryTypeMaster extends Model
{
    use SoftDeletes;

    protected $table = 'bs_school_category_type_master';
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
}
