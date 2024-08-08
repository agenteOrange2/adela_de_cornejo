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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->mediumText('description');
            $table->string('image_path')->nullable();
            $table->date('date'); // Solo fecha
            $table->dateTime('start_time'); // Fecha y hora
            $table->dateTime('end_time'); // Fecha y hora
            $table->string('location')->nullable();
            $table->string('maps')->nullable();
            $table->string('organizer')->nullable();
            $table->string('status')->default('planned');
            $table->string('type')->nullable();
            $table->boolean('is_published')
                  ->default(false);            
            $table->foreignId('user_id')
                  ->constrained();             
            $table->timestamp('published_at')
                  ->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
