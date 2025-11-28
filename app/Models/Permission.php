<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    protected $table = "bs_permissions";

    protected $fillable = [
        'role_id',
        'module_id',
        'submodule_id',
        'can_view_module',
    ];

    // Relationships
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function submodule()
    {
        return $this->belongsTo(Module::class);
    }
}
