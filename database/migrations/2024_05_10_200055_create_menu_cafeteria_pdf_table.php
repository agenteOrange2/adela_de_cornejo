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
        Schema::create('menu_cafeteria_pdf', function (Blueprint $table) {
            $table->unsignedBigInteger('pdf_id');
            $table->unsignedBigInteger('plantel_id');
            $table->unsignedBigInteger('school_cycle_id');
            $table->unsignedTinyInteger('month'); // No permitir valores nulos
            $table->timestamps();

            $table->primary(['pdf_id', 'plantel_id', 'school_cycle_id', 'month']);

            // Si hay relaciones foráneas, las puedes agregar aquí
            $table->foreign('pdf_id')->references('id')->on('pdfs')->onDelete('cascade');
            $table->foreign('plantel_id')->references('id')->on('plantels')->onDelete('cascade');
            $table->foreign('school_cycle_id')->references('id')->on('school_cycles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_cafeteria_pdf');
    }
};
