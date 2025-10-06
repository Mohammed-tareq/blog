<?php

namespace Database\Factories;

use App\Models\Comment;
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
                'comment' => fake()->paragraph(3),
                'ip_address' => fake()->ipv4(),
                'user_id' => User::inRandomOrder()->first()->id,
                'post_id' => Post::inRandomOrder()->first()->id,
                'status' => rand(0,1),
                'created_at' => $date = fake()->date('Y-m-d H:i:s'),
                'updated_at' => $date,
        ];
    }
}
