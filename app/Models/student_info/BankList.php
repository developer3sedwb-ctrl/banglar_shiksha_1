<?php

namespace App\Models\student_info;

use Illuminate\Database\Eloquent\Model;

class BankList extends Model
{
 
    protected $table = 'bs_bank_code_name_master';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'bank_code',
        'bank_ifsc',
        'digit_in_account_no',
        'status'
    ];

    /**
     * Relationship: A bank has many branches
     */
    public function branches()
    {
        return $this->hasMany(BankBranch::class, 'bank_id_fk', 'id');
    }

    /**
     * Scope: only active banks (status = 1)
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    /**
     * Accessor: bank name formatted
     */
    public function getDisplayNameAttribute()
    {
        return strtoupper($this->name);
    }
}
