<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistrictMaster extends Model
{
    use HasFactory;
    protected $table = 'bs_district_master';
    protected $fillable = ['previous_id', 'state_id', 'schcd', 'name', 'district_type', 'ddo_code', 'treasury_code', 'status'];
}
