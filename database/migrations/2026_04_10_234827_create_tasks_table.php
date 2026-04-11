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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();                          // ID único automático
            $table->string('title');               // Título de la tarea
            $table->text('description')->nullable(); // Descripción (opcional)
            $table->boolean('completed')->default(false); // ¿Completada? Si/No
            $table->timestamps();                  // created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
