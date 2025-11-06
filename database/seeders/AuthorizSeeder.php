<?php

namespace Database\Seeders;

use App\Models\Authoriz;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissionSeed = [];
        foreach (config('authoriz.permission') as $group => $permissions) {

            foreach ($permissions as $key=>$permission) {
                $permissionSeed[] = $group . '.' . $key;
            }
        }
        Authoriz::create([
            'role' => 'Super Admin',
            'permissions' => $permissionSeed,
        ]);
    }
}
