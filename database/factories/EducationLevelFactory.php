<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EducationLevel>
 */
class EducationLevelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement(['Preescolar', 'Primaria', 'Secundaria']),
            'plantel_id' => $this->faker->numberBetween(1, 2)  // Asegúrate de que estos IDs de plantel existan
        ];
    }
}
