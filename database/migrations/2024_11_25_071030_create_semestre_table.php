<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/YYYY_MM_DD_create_semestre_table.php

    public function up()
    {
        Schema::create('semestre', function (Blueprint $table) {
            $table->id();
            $table->string('semestre', 10);  // Ej: '2023-I'
            $table->boolean('estado')->default(true);  // 1: Activo, 0: Inactivo
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('semestre');
    }

};