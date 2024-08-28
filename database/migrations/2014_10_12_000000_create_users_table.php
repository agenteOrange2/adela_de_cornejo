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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');            
            $table->string('last_name');
            $table->string('matricula');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->foreignId('plantel_id')->nullable()->constrained('plantels')->onDelete('set null');
            $table->foreignId('education_level_id')->nullable()->constrained('education_levels')->onDelete('set null');
            $table->foreignId('grade_id')->nullable()->constrained('grades')->onDelete('set null');            
            $table->foreignId('group_id')->nullable()->constrained('groups')->onDelete('set null'); // Agregar esta línea
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
