<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolClasswiseSection extends Model
{
    protected $table = 'bs_school_classwise_section';

    protected $primaryKey = 'id';

    protected $fillable = [
        'ac_year',
        'school_code_fk',
        'class_code_fk',
        'no_of_section',
    ];
}
