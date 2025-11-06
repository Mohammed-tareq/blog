<?php

namespace App\Providers;

use App\Models\Admin;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as AuthServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class CheckRoleProvider extends AuthServiceProvider
{



    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */

    public function boot(): void
    {
        $this->registerPolicies();


        foreach (config('authoriz.permission') as $grp => $permissions) {

            foreach ($permissions as $key => $permission) {

                Gate::define($grp.'.'.$key, function ($user) use ($grp,$key) {

                    return $user->hasPermission($grp.'.'.$key);
                });
            }

        }
    }
}
