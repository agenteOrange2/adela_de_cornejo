<?php

namespace Database\Seeders;

use App\Models\Grade;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GradesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $grades = [
            ['name' => 'Primero', 'education_level_id' => 1], // Preescolar
            ['name' => 'Segundo', 'education_level_id' => 1], // Preescolar
            ['name' => 'Tercero', 'education_level_id' => 1], // Preescolar
            ['name' => 'Primero', 'education_level_id' => 2], // Primaria
            ['name' => 'Segundo', 'education_level_id' => 2], // Primaria
            ['name' => 'Tercero', 'education_level_id' => 2], // Primaria
            ['name' => 'Cuarto', 'education_level_id' => 2], // Primaria
            ['name' => 'Quinto', 'education_level_id' => 2], // Primaria
            ['name' => 'Sexto', 'education_level_id' => 2], // Primaria
            ['name' => 'Primero', 'education_level_id' => 3], // Secundaria
            ['name' => 'Segundo', 'education_level_id' => 3], // Secundaria
            ['name' => 'Tercero', 'education_level_id' => 3], // Secundaria
        ];

        foreach ($grades as $grade) {
            Grade::firstOrCreate($grade);
        }
    }
}
