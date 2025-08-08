<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name"=> $this->faker->name,
            "slug"=> Str::slug($this->faker->name),
            "status"=> $this->faker->randomElement([1,0]),
            'created_at' => $date = fake()->date('Y-m-d h:m:s'),
            'updated_at' => $date,

        ];
    }
}
