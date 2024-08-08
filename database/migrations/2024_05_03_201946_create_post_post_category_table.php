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
        Schema::create('post_post_category', function (Blueprint $table) {            
            $table->foreignId('post_id')->constrained()->onDelete('cascade');
            $table->foreignId('post_category_id')->constrained()->onDelete('cascade');
            $table->primary(['post_id', 'post_category_id']); // Clave primaria compuesta            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_post_category');
    }
};
