<?php

namespace Database\Factories;

use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $images = ['https://images.pexels.com/photos/879109/pexels-photo-879109.jpeg', 'https://images.pexels.com/photos/3861969/pexels-photo-3861969.jpeg',
            'https://images.pexels.com/photos/3861961/pexels-photo-3861961.jpeg',
            'https://images.pexels.com/photos/4974915/pexels-photo-4974915.jpeg'];

        return [
            'path' => $images[rand(0,3)],
        ];
    }

}
