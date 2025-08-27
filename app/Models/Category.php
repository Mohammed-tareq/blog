<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
        'slug',
        'status',
    ];


    public function posts()
    {
        return $this->hasMany(Post::class , 'category_id');
    }
    public function scopeActiveCategory($q)
    {
        return $q->where('status', 1);
    }
}
