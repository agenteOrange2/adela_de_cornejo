<?php

namespace Database\Seeders;

use App\Models\Plantel;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PlantelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Plantel::create([
            'name' => 'Plantel IV Siglos',
            'image_path' => 'https://dummyimage.com/400x400',
            'description' => 'Instalaciones de calidad para el aprendizaje de los alunmnos de manera mas eficiente y comoda',
            'address' => 'Calzada del Río 9950, Col. Partido Senecú',
            'phone' => '656-611-50-70',
            'email' => 'direccion@adeladecornejo.com',
            'identifier' => 'a',

        ]);

        Plantel::create([
            'name' => 'Plantel Triunfo',
            'image_path' => 'https://dummyimage.com/400x400',
            'description' => 'Instalaciones de calidad para el aprendizaje de los alunmnos de manera mas eficiente y comoda',
            'address' => 'Plutarco Elias Calles 228, Col. 2da. Burócrata, CP 32340',
            'phone' => '656-611-50-20',
            'email' => 'direccion@adeladecornejo.com',
            'identifier' => 'e',
        ]);
    }
}
