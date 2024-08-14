<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('education_level_pdf', function (Blueprint $table) {
            $table->foreignId('education_level_id')->constrained(); // Relación con el nivel educativo
            $table->foreignId('pdf_id')->constrained('pdfs'); // Relación con el PDF
            $table->foreignId('plantel_id')->constrained('plantels'); // Relación con el plantel
            $table->foreignId('school_cycle_id')->constrained('school_cycles');
            $table->unsignedTinyInteger('month'); // Mes al que corresponde el PDF
            $table->timestamps();
    
            $table->unique(['education_level_id', 'pdf_id', 'plantel_id', 'month'], 'unique_level_pdf_plantel_month');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education_level_pdf');
    }
};
