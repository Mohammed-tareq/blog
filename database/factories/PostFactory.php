<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

              'title' => $name =fake()->sentence(3),
                'slug' => Str::slug($name),
                'description' => fake()->paragraph(3),
                'status' => 1,
                'num_of_views' => rand(0,1000),
                'user_id' => User::inRandomOrder()->first()->id,
                'category_id' => Category::inRandomOrder()->first()->id,
                'comment_able' => 1,
                'created_at' => $date = fake()->date('Y-m-d H:i:s'),
                'updated_at' => $date,

        ];
    }
}
