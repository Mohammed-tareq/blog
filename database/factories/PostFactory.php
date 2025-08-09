<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

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

            "title"=> fake()->sentence(5),
            'desc'=> fake()->paragraph(5),
            'status'=> rand(0, 1),
            'comment_able' => fake()->randomElement([1,0]),
            'user_id'=> User::inRandomOrder()->first()->id,
            'nums_of_view'=> rand(0, 1000),
            "category_id"=> Category::inRandomOrder()->first()->id,
            'created_at' => $date = fake()->date('Y-m-d h:m:s'),
            'updated_at' => $date,

        ];
    }
}
