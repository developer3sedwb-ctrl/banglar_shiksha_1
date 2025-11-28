<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ErrorLog extends Model
{
    protected $table = 'bs_error_logs';

    protected $fillable = [
        'query',
        'bindings',
        'error_message',
        'error_code',
        'file',
        'line',
        'url',
        'method',
        'ip'
   ];

    protected $casts = [
        'bindings' => 'array', // auto cast JSON to array
        // 'user_id' => 'integer',
        'line' => 'integer'
    ];

    /**
     * Optional: Relationship to User (if you want)
     */
    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }
}
