<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory,Sluggable;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'comment_able',
        'status',
        'category_id',
        'user_id',
        'admin_id',
        'num_of_views',
        'small_desc',
        'tags',
    ];

    protected $casts = [
        'tags' => 'array',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopeActiveUser($q)
    {
       $q->where(function($q){
           $q->whereHas('user',fn($q) => $q->active())
           ->orWhere('user_id',null);
       });
    }

    public function scopeActiveCategory($q)
    {
        $q->whereHas('category',fn($q) => $q->active());
    }

    public function status()
    {
        return $this->status == 1 ? 'Active' : 'Inactive';
    }
    public function comment_able()
    {
        return $this->comment_able == 1 ? 'Active' : 'Inactive';
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}

