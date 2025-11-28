<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;
    protected $table = 'bs_modules';
    protected $fillable = ['parent_module_id', 'name','shortcode','url'];

    // 👇 Relation: A module can have many submodules
    public function submodules()
    {
        return $this->hasMany(Module::class, 'parent_module_id');
    }

    // 👇 Relation: A submodule belongs to a parent module
    public function parent()
    {
        return $this->belongsTo(Module::class, 'parent_module_id');
    }

}
