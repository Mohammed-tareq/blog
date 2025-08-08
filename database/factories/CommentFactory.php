<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'comment'=> fake()->paragraph(2),
            'ip_address'=> fake()->paragraph(2),
            'user_id'=> User::inRandomOrder()->first()->id,
            "post_id"=> Post::inRandomOrder()->first()->id,
            'status'=> fake()->randomElement([1,0]),

            'created_at' => $date = fake()->date('Y-m-d h:m:s'),
            'updated_at' => $date,

        ];
    }
}
