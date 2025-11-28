<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CircleMaster extends Model
{
    use HasFactory;
    protected $table    = 'bs_circle_master';
    protected $fillable = ["district_id", "schcd", "name", "status"];
}