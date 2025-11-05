<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'name' => 'tareq',
            'user_name' => 'tareq',
            'email' => 'admin@g.com',
            'password' => bcrypt('1234567'),
            'status' => true,
            'authoriz_id' => 1
        ]);
    }
}
