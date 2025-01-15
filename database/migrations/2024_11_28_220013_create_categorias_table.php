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
        // Crear la tabla categorias
        Schema::create('categorias', function (Blueprint $table) {
            $table->id(); // Llave primaria
            $table->string('nombre', 255)->unique(); // Nombre de la categoría
            $table->text('descripcion')->nullable(); // Descripción opcional de la categoría
            $table->timestamps(); // created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Eliminar la tabla categorias
        Schema::dropIfExists('categorias');
    }
};
