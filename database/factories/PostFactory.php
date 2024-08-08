<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Posts>
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
            'title' => $this->faker->sentence,
            'slug' => $this->faker->slug,
            'excerpt' => $this->faker->text(200),
            'body' => $this->faker->text(1000),
            'image_path' => $this->faker->imageUrl(),
            'is_published' => $this->faker->boolean,
            'user_id' => $this->faker->numberBetween(1, 10),
            'published_at' => $this->faker->dateTimeThisYear()
        ];
    }
}
