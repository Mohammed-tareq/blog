<?php

namespace Database\Seeders;

use App\Models\Category;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = ['Sport Category', 'Technology Category', 'Travel Category', 'Food Category', 'Fashion Category', 'Health Category', 'Entertainment Category', 'Lifestyle Category', 'Other Category'];

        foreach ($data as $item){
            Category::create([
                'name' => $item,
                'slug' => Str::slug($item),
                'status' => true,
                'description' => Factory::create()->paragraph(3),
            ]);
        }
    }
}
