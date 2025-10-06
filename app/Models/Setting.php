<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{

    protected $fillable = [
        'site_name',
        'logo',
        'favicon',
        'email',
        'phone',
        'street',
        'city',
        'country',
        'facebook',
        'twitter',
        'instagram',
        'youtube',
    ];
}
