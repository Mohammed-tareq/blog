<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable =[
        'site_name',
        'email',
        'favicon',
        'logo',
        'facebook',
        'instagram',
        'youtube',
        'twitter',
        'phone',
        'country',
        'city',
        'street',
    ];
}
