<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\EducationLevel;
use App\Models\Plantel;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {      
        //Usuario de prueba
        \App\Models\User::factory()->create([
            'name' => 'Elliot',
            'last_name' => 'Alderson',
            'matricula' => 'e2024',
            'email' => 'frontend@kuiraweb.com',
            'password' => bcrypt('Password'),
        ]);

        $this->call([
            UserSeeder::class,
            RolesTableSeeder::class,
            EducationLevelSeeder::class, // Primero los niveles educativos
            GradesTableSeeder::class,    // Después los grados
            GroupSeeder::class,    // Después los grados
            PlantelSeeder::class,
            PostCategorySeeder::class,
            PostSeeder::class,
            EventCategorySeeder::class,
            EventSeeder::class,
            PdfSeeder::class
        ]);        
    }
}
