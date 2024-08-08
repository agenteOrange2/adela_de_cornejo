<?php

namespace Database\Factories;

use App\Models\EducationLevel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $date = $this->faker->date();
        $startDateTime = $this->faker->dateTimeBetween($date . ' 00:00:00', $date . ' 23:59:59');
        $endDateTime = (clone $startDateTime)->modify('+2 hours');
    
        return [
            'title' => $this->faker->sentence,
            'slug' => $this->faker->slug,
            'excerpt' => $this->faker->text(200),
            'description' => $this->faker->text(500),
            'image_path' => $this->faker->imageUrl(),
            'date' => $this->faker->date(),
            'start_time' => $this->faker->dateTime(),
            'end_time' => $this->faker->dateTime(),
            'is_published' => $this->faker->boolean(50),
            'user_id' => $this->faker->numberBetween(1, 10),
            'education_level_id' => \App\Models\EducationLevel::inRandomOrder()->first()->id, // Asumiendo que los EducationLevel existen            
        ];
    }
}
