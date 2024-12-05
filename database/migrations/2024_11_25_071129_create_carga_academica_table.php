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
        Schema::create('carga_academica', function (Blueprint $table) {
            $table->id();
            $table->string('id_curso', 8);
            $table->string('id_usuario', 5);
            $table->integer('nro_creditos');
            $table->boolean('es_teorico');  // 1: Teórico, 0: Práctico
            $table->foreignId('id_malla')->nullable()->constrained('malla')->onDelete('cascade');
            $table->foreignId('id_semestre')->constrained('semestre');
            $table->unique(['id_curso', 'id_semestre']);  // Restricción única
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carga_academica');
    }
};
