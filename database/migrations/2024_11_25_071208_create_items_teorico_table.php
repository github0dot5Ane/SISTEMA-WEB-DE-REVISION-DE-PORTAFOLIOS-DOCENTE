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
        Schema::create('items_teorico', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_portafolio');
            $table->boolean('avance_academico')->default(0);
            $table->boolean('registro_entrega_silabo')->default(0);
            $table->boolean('informe_examen_entrada')->default(0);
            $table->boolean('enunciado_y_solucion_exameN_1P')->default(0);
            $table->boolean('enunciado_y_solucion_exameN_2P')->default(0);
            $table->boolean('enunciado_y_solucion_exameN_3P')->default(0);
            $table->boolean('evidencia_actividades')->default(0);
            $table->boolean('registro_asistencia_1P')->default(0);
            $table->boolean('registro_asistencia_2P')->default(0);
            $table->boolean('registro_asistencia_3P')->default(0);
            $table->boolean('registro_notas_1P')->default(0);
            $table->boolean('registro_notas_2P')->default(0);
            $table->boolean('registro_notas_3P')->default(0);
            $table->boolean('cierre_portafolio')->default(0);

            $table->foreign('id_portafolio')->references('id')->on('portafolio')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items_teorico');
    }
};
