<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryMaster extends Model
{
    use SoftDeletes;

    protected $table = 'bs_category_master';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'name',
        'class_list',
        'status',
    ];

    protected $casts = [
        'class_list' => 'array',
        'status' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    // Optional: Default attribute values
    protected $attributes = [
        'status' => 1,
    ];
}
