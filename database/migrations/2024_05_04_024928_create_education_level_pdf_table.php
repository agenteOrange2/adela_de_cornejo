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
            $table->foreignId('education_level_id')->constrained();
            $table->foreignId('pdf_id')->constrained('pdfs');
            $table->foreignId('plantel_id')->constrained('plantels');
            $table->foreignId('school_cycle_id')->constrained('school_cycles')->onDelete('cascade');            
            $table->unsignedTinyInteger('month')->nullable();
            $table->timestamps();
        
            $table->unique(['education_level_id', 'pdf_id', 'plantel_id'], 'unique_level_pdf_plantel');
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
