<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'title' => fake()->sentence(3),
            'message' => fake()->paragraph(3),
            'ip_address' => fake()->ipv4(),
            'created_at' => $date = fake()->date('Y-m-d H:i:s'),
            'updated_at' => $date,
        ];
    }
}
