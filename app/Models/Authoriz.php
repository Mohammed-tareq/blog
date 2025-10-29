<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Authoriz extends Model
{
    protected $fillable = [
        'role',
        'permissions'
    ];

    protected $casts = [
        'permissions' => 'json'
    ];

}
