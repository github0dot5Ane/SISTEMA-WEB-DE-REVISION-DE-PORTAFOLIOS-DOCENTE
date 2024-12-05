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
        Schema::create('revision', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_portafolio');
            $table->string('criterio');
            $table->enum('resultado', ['Aprobado', 'Corregir','Pendiente']);
            $table->text('comentarios')->nullable();
            $table->date('fecha_revision');
            $table->unsignedBigInteger('id_semestre');
            $table->unsignedBigInteger('id_usuario_revisor');

            $table->foreign('id_portafolio')->references('id')->on('portafolio')->onDelete('cascade');
            $table->foreign('id_semestre')->references('id')->on('semestre')->onDelete('cascade');
            $table->foreign('id_usuario_revisor')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('revision');
    }
};
