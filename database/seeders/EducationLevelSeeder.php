<?php

namespace Database\Seeders;

use App\Models\EducationLevel;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EducationLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
         EducationLevel::create([
             'name' => 'Preescolar',            
             
         ]);

         EducationLevel::create([
             'name' => 'Primaria',      
         ]);

         EducationLevel::create([
             'name' => 'Secundaria',                         
         ]);
        
        
    }
}
