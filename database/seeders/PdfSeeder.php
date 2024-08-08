<?php

namespace Database\Seeders;

use App\Models\Pdf;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PdfSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pdf::create([
            'name' => 'Documento Ejemplo',
            'file_path' => 'http://example.com/documento.pdf',            
        ]);
    }
}
