<?php

namespace App\Models\student_info;

use Illuminate\Database\Eloquent\Model;
use App\Models\Bank;  // <-- IMPORTANT

class BranchList extends Model
{
    protected $table = 'bs_bank_branch_master';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'bank_id_fk',
        'bank_name',
        'bank_code',
        'branch_ifsc',
        'address',
        'contact',
        'city',
        'district',
        'state',
        'status'
    ];

    public function bank()
    {
        return $this->belongsTo(Bank::class, 'bank_id_fk', 'id');
    }
}
