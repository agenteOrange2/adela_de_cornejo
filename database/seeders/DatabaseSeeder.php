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
            'name' => 'Elliot Alderson',
            'email' => 'frontend@kuiraweb.com',
            'password' => bcrypt('Password'),
        ]);

        $this->call([
            UserSeeder::class,
            PlantelSeeder::class, // Si tienes un seeder para 'Plantels'
            EducationLevelSeeder::class,            
            PostCategorySeeder::class,
            PostSeeder::class,
            EventCategorySeeder::class,
            EventSeeder::class,
            PdfSeeder::class
        ]);
    }
}
