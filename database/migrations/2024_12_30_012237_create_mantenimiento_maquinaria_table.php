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
        
        Schema::create('mantenimiento_maquinaria', function (Blueprint $table) {
            $table->id(); // AUTO_INCREMENT y PRIMARY KEY
            $table->unsignedBigInteger('producto_id'); // FOREIGN KEY -> producto(id)
            $table->unsignedBigInteger('venta_id'); // FOREIGN KEY -> venta(id)
            $table->date('fecha_mantenimiento'); // Campo de fecha
            $table->string('tipo_mantenimiento', 100); // VARCHAR(100)
            $table->text('descripcion'); // TEXT
            $table->decimal('costo', 10, 2); // DECIMAL(10, 2)
            $table->string('estado_post_mantenimiento', 100); // VARCHAR(100)
            $table->timestamps(); // Campos created_at y updated_at

            // Definir las claves foráneas
            $table->foreign('producto_id')->references('id')->on('productos')->onDelete('cascade');
            $table->foreign('venta_id')->references('id')->on('ventas')->onDelete('cascade');
        });
    }

   
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mantenimiento_maquinaria');
    }
};
