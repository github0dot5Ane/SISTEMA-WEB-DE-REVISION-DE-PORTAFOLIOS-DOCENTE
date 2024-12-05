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
    Schema::table('users', function (Blueprint $table) {
        $table->boolean('es_administrador')->default(false)->after('password');
        $table->boolean('es_revisor')->default(false)->after('es_administrador');
        $table->boolean('activo')->default(true)->after('es_revisor');
    });
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn(['es_administrador', 'es_revisor', 'activo']);
    });
}

};
