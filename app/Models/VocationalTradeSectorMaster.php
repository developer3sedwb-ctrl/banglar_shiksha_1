<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VocationalTradeSectorMaster extends Model
{
    //
    protected $table = 'bs_vocational_trade_sector_master';

    protected $fillable = [
        'id',
        'name',
        'status'
    ];

    public $incrementing = false; // Because ID is manually inserted
    protected $keyType = 'int';

    /**
     * A sector has many job roles
     */
    public function jobRoles()
    {
        return $this->hasMany(VocationalJobRoleMaster::class, 'sector_code_fk', 'id');
    }
}
