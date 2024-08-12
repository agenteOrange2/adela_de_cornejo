<?php

namespace Database\Seeders;

use App\Models\Grade;
use App\Models\EducationLevel;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $preescolar = EducationLevel::where('name', 'Preescolar')->first();
        $primaria = EducationLevel::where('name', 'Primaria')->first();
        $secundaria = EducationLevel::where('name', 'Secundaria')->first();

        // Grados para Preescolar
        Grade::factory()->create(['name' => 'Primer Grado', 'education_level_id' => $preescolar->id]);
        Grade::factory()->create(['name' => 'Segundo Grado', 'education_level_id' => $preescolar->id]);
        Grade::factory()->create(['name' => 'Tercer Grado', 'education_level_id' => $preescolar->id]);

        // Grados para Primaria
        Grade::factory()->create(['name' => 'Primer Grado', 'education_level_id' => $primaria->id]);
        Grade::factory()->create(['name' => 'Segundo Grado', 'education_level_id' => $primaria->id]);
        Grade::factory()->create(['name' => 'Tercer Grado', 'education_level_id' => $primaria->id]);
        Grade::factory()->create(['name' => 'Cuarto Grado', 'education_level_id' => $primaria->id]);
        Grade::factory()->create(['name' => 'Quinto Grado', 'education_level_id' => $primaria->id]);
        Grade::factory()->create(['name' => 'Sexto Grado', 'education_level_id' => $primaria->id]);

        // Grados para Secundaria
        Grade::factory()->create(['name' => 'Primer Grado', 'education_level_id' => $secundaria->id]);
        Grade::factory()->create(['name' => 'Segundo Grado', 'education_level_id' => $secundaria->id]);
        Grade::factory()->create(['name' => 'Tercer Grado', 'education_level_id' => $secundaria->id]);
    }
}
