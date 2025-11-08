<?php

namespace App\Models;

use Couchbase\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Admin extends Authenticatable

{
    use Notifiable;

    protected $guard = 'admin';

    protected $fillable = [
        'name',
        'user_name',
        'email',
        'password',
        'status',
        'authoriz_id'
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'password' => 'hashed',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function authoriz()
    {
        return $this->belongsTo(Authoriz::class);
    }

    public function hasPermission($authriozCheck)
    {
        $authorizations = $this->authoriz;
        if (!$authorizations || !is_array($authorizations->permissions)) {
            return false;
        }
        return in_array($authriozCheck, $authorizations->permissions);

    }

    public function receivesBroadcastNotificationsOn(): string
    {
        return 'admins.'.$this->id;
    }

    public function status(){
        return $this->status == 1 ? 'Active' : 'Inactive';
    }


}