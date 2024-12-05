<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('portafolio', function (Blueprint $table) {
        $table->id(); // Esto se mantuvo igual, ya que se genera automáticamente
        $table->unsignedBigInteger('id_usuario'); // Cambié de unsignedInteger a unsignedBigInteger
        $table->unsignedBigInteger('id_carga');
        $table->date('fecha_subida');
        $table->enum('estado', ['Pendiente', 'Revisado', 'Corregir']);
        $table->unsignedBigInteger('id_semestre');
        $table->boolean('caratula')->default(0);
        $table->boolean('carga_lectiva')->default(0);
        $table->boolean('filosofia')->default(0);
        $table->boolean('cv')->default(0);
        $table->boolean('silabo')->default(0);
        $table->boolean('tipo_curso');  // 1: Teórico, 0: Práctico

        // Relacionando con la tabla 'users'
        $table->foreign('id_usuario')->references('id')->on('users')->onDelete('cascade'); // Cambié id_usuario a id

        // Relacionando con la tabla 'carga_academica'
        $table->foreign('id_carga')->references('id')->on('carga_academica')->onDelete('cascade');

        // Relacionando con la tabla 'semestre'
        $table->foreign('id_semestre')->references('id')->on('semestre')->onDelete('cascade');

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portafolio');
    }
};
