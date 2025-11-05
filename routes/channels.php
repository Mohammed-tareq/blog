<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;



Broadcast::channel('users.{id}', function ($user, $id) {
    return (int)$user->id === (int)$id;
});

Broadcast::channel('admins.{id}', function ($admin, $id)  {
    return (int)$admin->id === (int)$id;
},['guards' => ['admin']]);