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
        Schema::create('school_cycles', function (Blueprint $table) {
            $table->id();
            $table->string('name');  // Por ejemplo, "2024 - 2025"
            $table->date('start_date');  // Fecha de inicio
            $table->date('end_date');    // Fecha de fin
            $table->boolean('is_current')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_cycles');
    }
};
